<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Désinscrire un élève d'une séance</title>
</head>

<body>
	<h1>Désinscrire un élève d'une séance</h1></br></br></br>

	<?php
		date_default_timezone_set('Europe/Paris');
		$date_actuelle = New DateTime(date('Y-m-d'));

		include ('connexion.php');
		$seances = mysqli_query($connect,"SELECT * FROM seances"); //on recherche tous les seances
		$liste_eleves = mysqli_query($connect,"SELECT * FROM eleves"); //on recherche tous les eleves

		if (!$seances)
		{
			echo "Erreur : <br>".mysqli_error($connect);
			exit;
		}
		 if (!$liste_eleves)
		 {
			echo "Erreur : <br>".mysqli_error($connect);
 			exit;
		 }

		echo "<table>";

		echo "<FORM METHOD='POST' ACTION='desinscrire_seance.php'>";
		echo "<tr><td><label for='seance'>Choisissez une séance :<br></label></td>";//On fait un formulaire pour choisir la seance
		echo "<td><select id='seance' name='seance'>";


		foreach ($seances as $seance)
		{
			$idtheme_seance_selectionnee = $seance['Idtheme'];
			$infos_theme_de_seance = mysqli_query($connect,"SELECT * FROM themes WHERE idtheme =$idtheme_seance_selectionnee");
			$detail_theme = mysqli_fetch_array($infos_theme_de_seance, MYSQLI_ASSOC);

      date_default_timezone_set('Europe/Paris');
      $date_seance_a_verifier = New DateTime($seance['DateSeance']);

			if ($date_seance_a_verifier >= $date_actuelle)
			{
				echo "<option id='seance' value=".$seance['idseance'].">Séance du thème ".$detail_theme['nom']." du ".$seance['DateSeance']."</option>";
			}
		}

		echo "</select></td></tr>";

		echo "<tr><td><label for='eleve'>Choisissez un élève :<br></label></td>"; //De même on choisit l'élève
		echo "<td><select id='eleve' name='eleve'>";

		foreach ($liste_eleves as $eleve)
		{
			echo "<option value=".$eleve['ideleve'].">".$eleve['prenom']." ".$eleve['nom']." né le ".$eleve['dateNaiss']."</option>";
		}
		echo "</select></td></tr>";
		echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
