<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaiss = $_POST['naissance'];

  if ((!isset($_POST['choix'])) || ($_POST['choix'] == 1))
  {
    include ('connexion.php');

    $nom_echap = mysqli_real_escape_string($connect, $nom);
    $prenom_echap = mysqli_real_escape_string($connect, $prenom);

    date_default_timezone_set('Europe/Paris');
    $date_inscription = date('Y-m-d'); // La date d'inscription correspond à la date du jour

    $requete_ajout_eleve = "insert into eleves values (null,'$nom_echap','$prenom_echap','$dateNaiss', '$date_inscription')";


    $ajout_eleve = mysqli_query($connect, $requete_ajout_eleve);

    if (!$ajout_eleve)
    {
      echo "<br>Impossible d'ajouter l'élève. La requête a échoué. <br>  ".mysqli_error($connect);
      echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
      exit;
    }
    mysqli_close($connect);
  }
    else // si l'utilisateur n'a pas choisir d'ajouter l'élève (malgré l'éventuelle présence d'homonyme(s))
    {
      echo "Ajout d'élève annulé.";
      echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
      exit;
    }
  ?>

  </body>
</html>
