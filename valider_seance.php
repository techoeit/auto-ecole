<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1>Noter les élèves</h1></br></br></br>

	<?php
		$id_seance_a_noter = $_POST['seance'];

		date_default_timezone_set('Europe/Paris');
		$date_actuelle = date("Ymd");

		include ('connexion.php');
		$infos_inscription_seance = mysqli_query($connect,"SELECT * FROM inscription2 WHERE idseance = '$id_seance_a_noter'"); // On sélectionne les lignes de la table inscription comportant la séance selectionnée
		if (!$infos_inscription_seance)
		{
			echo "Erreur : ".mysqli_error($connect);
			exit;
		}

		// Formulaire pour noter les élèves inscrits à la séance

		echo "<FORM METHOD='POST' ACTION='noter_eleves.php' >";
		echo "<table>";
		echo "<tr><td><subtitles>Notez le nombre d'erreurs faites par chaque élève :</td></tr><br>";

		while ($seance = mysqli_fetch_array($infos_inscription_seance, MYSQLI_ASSOC))
		{
			$id_eleve_a_noter = $seance['ideleve'];
			$eleve_a_noter = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve = $id_eleve_a_noter"); // On selectionne les infos de l'élève en question
			if (!$eleve_a_noter)
			{
				echo "Erreur : ".mysqli_error($connect);
				echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
				exit;

			}
			$infos_eleve_a_noter = mysqli_fetch_array($eleve_a_noter, MYSQLI_ASSOC);
			$verif_deja_note = $infos_eleve_a_noter['note'];
			if (!is_null($verif_deja_note))  // si l'élève a déjà été noté
			{
				echo "<br><tr><td>".$infos_eleve_a_noter['prenom']." ".$infos_eleve_a_noter['nom']."</td><td><input type='number' min=0 max=40 name='nb_fautes' placeholder="."'$verif_deja_note'"." required></td></tr>";
			}
			else
			{
				echo "<br><tr><td>".$infos_eleve_a_noter['prenom']." ".$infos_eleve_a_noter['nom']."</td><td><input type='number' min=0 max=40 name='nb_fautes' required></td></tr>";
				echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
			}
		}
		echo "<input type='hidden' name='seance' value=".$id_seance_a_noter.">";

		echo "<tr><td><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
