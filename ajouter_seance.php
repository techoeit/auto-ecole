<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Ajout d'une séance</title>
  </head>
  <body>

    <?php

    function retourner_formulaire ($msg) {
      echo <<< EOT
      $msg
      <br>
      <p> Pour remplir le formulaire une nouvelle fois, il suffit de cliquer <a href='ajout_seance.php'>ici</a>. </p>
      EOT; }



    $date_seance = $_POST['DateSeance'];
    $eff_max = $_POST['EffMax'];


    date_default_timezone_set('Europe/Paris');
    $date_seance_a_verifier = New DateTime($date_seance);
    $date_actuelle = New DateTime(date('Y-m-d'));

    //  Sanity checks  (cohérence des données)
    if (!isset($_POST['menuChoixTheme'])) // si l'utilisateur ne choisit aucun thème
    {
      die(retourner_formulaire("Veuillez sélectionner un thème."));
    }

    if (empty($date_seance))
    {
      die(retourner_formulaire("Veuillez renseigner une date pour la séance."));
    }


    if (empty($eff_max))
    {
      die(retourner_formulaire("Veuillez renseigner l'effectif maximal de la séance."));
    }

    if (!is_numeric($eff_max))
    {
      die(retourner_formulaire("L'effectif maximal de la séance doit être un nombre."));
    }
    if ($eff_max < 1)
    {
      die(retourner_formulaire("L'effectif maximal de la séance doit être un nombre supérieur ou égal à 1."));
    }

    if ($date_seance_a_verifier < $date_actuelle)
    {
      die(retourner_formulaire("Vous avez sélectionné une date dans la passé !"));
    }
      $idtheme = $_POST['menuChoixTheme'];
      include ('connexion.php');

      $requete_verif_seances = "SELECT * FROM seances WHERE DateSeance = '$date_seance' and idtheme = '$idtheme'";
      $verif_seance = mysqli_query($connect, $requete_verif_seances); // table des séances du même thème programmée à la même date que celle qu'on veut ajouter
      if (!$verif_seance)
      {
        echo "La requête a échoué. Voici le code de l'erreur : <br>".mysqli_error($connect);
        echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
        exit;
      }
      $nb_seances_prob = mysqli_num_rows($verif_seance);
      if ($nb_seances_prob) // appliquer le choix d'implémentation
      {
        retourner_formulaire("Il est impossible d'ajouter la séance souhaitée, car une séance du même thème prévue le même jour a déjà êté ajoutée.");
        echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
        mysqli_close($connect);
        exit;
      }

      $liste_seances = mysqli_query($connect, "SELECT * FROM seances");
      if (!$liste_seances)
      {
        echo "La requête a échoué. Voici le code de l'erreur : <br>".mysqli_error($connect);
        echo "<input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
        exit;
      }

      $requete_insertion = "INSERT INTO seances values(null, '$date_seance', $eff_max, $idtheme);";
      $ajout_seance = mysqli_query($connect, $requete_insertion);
      if (!$ajout_seance) {
        echo "Insertion impossible ; votre requête est invalide. Voici le code de l'erreur : ".mysqli_error($connect);
        echo "<br> <input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
        exit;
      }
      else
      {
        echo "Ajout de séance réussi !";
        echo "<br> <input type='button' onclick=\"window.location='autoecole.html'\" value='Accueil' />";
      }

      mysqli_close($connect);
?>
  </body>
</html>
