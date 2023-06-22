<?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p061';

  $dbpass = 'MUUE5cc1fj29';

  $dbname = 'nf92p061';

  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
  mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
 ?>
