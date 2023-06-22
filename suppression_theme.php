<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Supprimer un thème</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>
  <h1> Supprimer un thème </h1>

  <?php
  // connexion à la base de données
  include("connexion.php");

  // sélection de tous les élèves pour les afficher
  $requete_liste_themes_actifs = "SELECT * FROM themes WHERE supprime =0 ORDER BY nom";
  $liste_themes_actifs = mysqli_query($connect, $requete_liste_themes_actifs);

  if (!$liste_themes_actifs)
  {
    echo "<p>Erreur : </p><br>".mysqli_error($connect);
    echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
    exit;
  }

  // mise en place d'un formulaire qui affiche tous les thèmes
  echo "<FORM METHOD='POST' ACTION='supprimer_theme.php'";

  echo "<label for='idtheme' class='label'> Veuillez sélectionner un thème à supprimer</label><br>";
  echo "<select name='idtheme' id='idtheme' size=4>";
  while ($theme_actif = mysqli_fetch_array($liste_themes_actifs, MYSQLI_ASSOC))
  {
    echo "<option value=". $theme_actif['idtheme']. ">". $theme_actif['nom']. "</option>";
  }
  echo "</select>";
  echo "<br>";
  echo "<input type='submit' value='Supprimer ce thème'>";

  echo "</FORM>";

  mysqli_close($connect);

  ?>
</body>
</html>
