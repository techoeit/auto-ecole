<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Consulter les informations de l'élève</title>
</head>
<h1>Consulter les informations de l'élève</h1>
<?php
  include 'connexion.php';

  $ideleve = $_POST['eleve'];

  $infos_eleve = mysqli_query($connect, "SELECT * FROM eleves WHERE ideleve = $ideleve");
  if (!$infos_eleve) {
      echo "Impossible d'afficher les infomations de l'élève. Requête invalide. <br>". mysqli_error($connect);
      echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
      exit();
  }
  // sinon, afficher les infos de l'élève sélectionné
  echo <<< EOT
  <h2>Elève </h2>
  <table>
  <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date de naissance</th>
      <th>Date d'inscription</th>
  </tr>
  EOT;

  foreach ($infos_eleve as $eleve) {
      echo "<tr> <td>".$eleve['ideleve']."</td> <td>".$eleve['nom']."</td> <td>".$eleve['prenom']."</td> <td>".$eleve['dateNaiss']."</td> <td>".$eleve['dateInscription']. "</td></tr>";
    }


  echo"</table>";
  echo <<< EOT
  <br>
  <table>
  <tr>
  <td><a href="consultation_eleve.php"><button type="button" class='button effacer'><span>Retour</span></button></a></td>
  </tr>
  </table>
  EOT;

  mysqli_close($connect);
?>
