<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Noter les élèves</title>
</head>

<body>
	<h1>Noter les élèves</h1></br></br></br>

	<?php
		date_default_timezone_set('Europe/Paris');
		$date_actuelle = date("Ymd");

    include('connexion.php');
		 // Requête SQL qui sélectionne toutes les séances du passé
		$req_seances = "SELECT idseance, DateSeance, nom FROM seances INNER JOIN themes ON seances.Idtheme = themes.idtheme WHERE DateSeance>=CURDATE()";
		$liste_seances = mysqli_query($connect,$req_seances);
		if (!$liste_seances)
			{
			echo "Requête invalide. Erreur : <br>".mysqli_error($connect);
			echo "<br> <input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' /> </td>";
			exit();
		}
		// Formulaire pour choisir une séance à valider
		echo "<table>";

		echo "<FORM METHOD='POST' ACTION='valider_seance.php' >";
		echo "<tr><td><label for='choix_seance'>Sélectionnez une séance : </label></td>";
    echo "<td><select id='choix_seance' name='seance' BORDER='1'>";


		foreach ($liste_seances as $seance) {
  		echo "<option value=".$seance['idseance']."> Séance du thème ".$seance['nom']." du ".$seance['DateSeance']."</option>";
    }

		echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
