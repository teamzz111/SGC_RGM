<?php

  global $host, $db, $pass, $key, $user, $con;
  $host = "YOUR_DB_HOST";
  //$host = "localhost";
  $db = "YOUR_DB_NAME";
  $pass = "YOUR_DB_PASSWORD";
  $user = "YOUR_DB_USER";
  $key = "YOUR_APP_KEY"; //llave

  
  $db2 = "YOUR_SECOND_DB_NAME";
  $pass2 = "YOUR_SECOND_DB_PASSWORD";
  $user2 = "YOUR_SECOND_DB_USER";

  $con = new mysqli($host, $user, $pass, $db);
  $con->query("SET NAMES 'utf8'");

 ?>
