<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Consulter les informations de l'élève</title>
</head>

<body>
	<h1>Consulter les informations de l'élève</h1></br></br>
	<?php
		include ('connexion.php');
		$table_eleves = mysqli_query($connect,"SELECT * FROM eleves ORDER by nom");	 // Requête pour sélectionner tous les élèves
    if (!$table_eleves) {
      echo "Impossible d'afficher la liste de tous les élèves. Requête invalide. <br>". mysqli_error($connect);
			echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
			exit;
    }

		echo "<table>";

		//Formulaire pour sélectionner un élève

		echo "<FORM METHOD='POST' ACTION='consulter_eleve.php'>";
		echo "<tr><td><label for='choix_eleve'>Choix de l'élève :</label></td><td><select name='eleve' BORDER='1'>";

		while ($eleve = mysqli_fetch_array($table_eleves, MYSQLI_ASSOC))
		{
			echo "<option id='choix_eleve' value=". $eleve['ideleve']."> ".$eleve['prenom']. " ".$eleve['nom']." </option>";
      echo "<br>";
		}

		echo "<tr><td><br><INPUT type='submit' value='Valider'></td></tr>";

		echo "</FORM>";

		echo "</table>";

		mysqli_close($connect);
	?>


</body>
</html>
