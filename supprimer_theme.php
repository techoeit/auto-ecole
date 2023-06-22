<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
  <title>Supprimer un thème</title>
</head>
<h1>Supprimer un thème</h1>
<?php
  include ('connexion.php');
  $id_theme_a_supprimer = $_POST['idtheme'];
  $infos_theme = mysqli_query($connect, "SELECT * from themes WHERE supprime = 1 AND idtheme = $id_theme_a_supprimer");
  if (!$infos_theme) {
    echo "<br>Erreur: ".mysqli_error($connect);
    echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
    exit;
  }
  if (!mysqli_num_rows($infos_theme))
  {
    $requete_suppression_theme = "UPDATE themes SET supprime = 1 WHERE idtheme = $id_theme_a_supprimer;";
    $suppression_theme = mysqli_query($connect, $requete_suppression_theme);
    if (!$suppression_theme) {
      echo "<br>Erreur: ".mysqli_error($connect);
      exit;
    }
  }
  else {
    echo <<< EOT
    <br>
    <p> Le thème a été supprimé auparavant ! </p>
    <table>
      <tr>
        <td>
          <a href="autoecole.html" >
          <button type="button"><span>Accueil</span></button>
          </a>
        </td>
        <td>
          <a href="suppression_theme.php" >
          <button type="button" ><span>Recommencer</span></button>
          </a>
        </td>
      </tr>
    <table>
    EOT;
  }
  mysqli_close($connect);

?>
