<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Inscription</title>
</head>

<body>
	<h1>Inscription</h1></br></br>
	<?php
	function retourner_formulaire ($msg) {
		echo <<< EOT
		<p>$msg<p>
		<br>
		<p> Pour remplir le formulaire d'ajout d'un(e) élève une nouvelle fois, il suffit de cliquer <a href='/ajout_eleve.php'>ici</a>. </p>
		EOT; }

	// Sanity checks
	$nom = $_POST['prenom'];
	$prenom = $_POST['nom'];
	$dateNaiss = $_POST['dateNaiss'];

	date_default_timezone_set('Europe/Paris');
	$dateNaiss_a_verifier = New DateTime($dateNaiss);
	$date_actuelle = New DateTime(date('Y-m-d'));

	if (empty($nom))
	{
		die(retourner_formulaire("Le formulaire est incomplet. Vous avez oublié de taper le nom de famille de l'élève !"));
	}

	if (empty($prenom))
	{
		die(retourner_formulaire("Le formulaire est incomplet. Vous avez oublié de taper le prénom de l'élève !"));
	}

	if (empty($dateNaiss))
	{
		die(retourner_formulaire("Le formulaire est incomplet. Vous avez oublié de renseigner la date de naissance de l'élève !"));
	}

	if ($dateNaiss_a_verifier > $date_actuelle) {
		die(retourner_formulaire("Vous avez sélectionné une date de naissance dans le futur !"));
	}

	include ('connexion.php');

	$requete_verif_homonyme = "SELECT * FROM eleves WHERE nom = '$nom' and prenom = '$prenom';"; // requête pour voir si un élève ayant déjà ce nom et prénom existe déjà

	$table_homonyme = mysqli_query($connect, $requete_verif_homonyme);
	if (!$table_homonyme)
	{
		echo "<br>Erreur: ".mysqli_error($connect);
		echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
    exit;
	}
	$nb_homonymes = mysqli_num_rows($table_homonyme); // le nombre de tuples dans la table des homonymes

	if($nb_homonymes) // Si un homonyme existe, on demande confirmation en signalant qu'un homonyme existe
	{
		echo "</br><subtitle>La personne de prénom ".$prenom." et de nom ".$nom." est déjà enregistrée dans nos bases de données. Êtes-vous sûr(e) qu'il s'agit bien d'un(e) nouvel(le) élève ?</subtitle></br></br></br>";
		echo "<table>";

		echo "<FORM METHOD='POST' ACTION='ajouter_eleve.php' >";
		echo "<tr><td><INPUT TYPE='radio' VALUE='1' NAME='choix' ID='choix1'><label for='choix1'>Oui</label></td><td><INPUT TYPE='radio' VALUE='0' NAME='choix' ID='choix2'><label for='choix2'>Non</label></td></tr>";
		echo "<input type='hidden' name='nom' value='".$nom."'>";
		echo "<input type='hidden' name='prenom' value='".$prenom."'>";
		echo "<input type='hidden' name='naissance' value='".$dateNaiss."'>";
		echo "<tr><td><INPUT TYPE='submit' VALUE='Valider'></td></tr>";
		echo "</form>";
		echo "</table>";
	}
	else // Sinon, on demande juste confirmation des infos entrées
	{
		echo "Confirmez-vous les informations entrées ?";
		echo "<FORM METHOD='POST' ACTION='ajouter_eleve.php' >";
		echo "<input type='hidden' name='nom' value='".$nom."'>";
		echo "<input type='hidden' name='prenom' value='".$prenom."'>";
		echo "<input type='hidden' name='naissance' value='".$dateNaiss."'>";
		echo "<tr><td><br><br><INPUT TYPE='submit' VALUE='Valider'></tr></td>";
		echo "</table>";
		echo "</form>";
	}


	?>


</body>
</html>
