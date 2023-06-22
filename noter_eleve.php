<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Noter les élèves</title>
</head>

<body>
	<h1>Noter les élèves</h1></br></br>
	<?php

		$seance = $_POST['seance'];
		$erreur = $_POST['nb_fautes'];

		if(!is_numeric($erreur))
		{
			echo "Soyons sérieux. Le nombre de fautes doit être un nombre.";
			echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
			exit();
		}


    include ('connexion.php');

		$infos_inscription_seance = mysqli_query($connect,"SELECT * FROM inscription2 WHERE idseance = $seance"); // Requête pour obtenir les lignes de la table inscription où cette séance apparaît

		foreach ($infos_inscription_seance as $eleve_inscrit)
		{
			$note_eleve_inscrit = $eleve_inscrit['note'];
			$note = 40 - $erreur;

			if ($erreur <= 40 && $erreur >= 0) // On vérifie que la note est comprise entre 0 et 40
			{
				$changer_note = mysqli_query($connect,"UPDATE inscription2 SET note = $note WHERE ideleve = $eleve_inscrit['ideleve'] and idseance = $seance;"); // On entre la note si c'est le cas
				if(!$changer_note)
				{
					echo "<br> Impossible de changer la note. La requête a échoué : <br>".mysqli_error($connect);
					echo "<br> <input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
				}
				else {
					echo "L'élève a bien été noté et a obtenu une note égale à $note points sur 40.";
				}
			}
			else {
				echo "Vous avez spécifié un nombre d'erreurs supérieur à 40 ou inférieur à 0. ";
		}

		mysqli_close($connect);
	?>


</body>
</html>
