<?php

  global $host, $db, $pass, $key, $user, $con;
  $host = "sql100.hostlibre.ml";
  //$host = "localhost";
  $db = "teolo_21117533_sgc";
  $pass = "3192934192321";
  $user = "teolo_21117533";
  $key = "92AE31B89FEEB2A3"; //llave

  
  $db2 = "teolo_21117533_encuestas";
  $pass2 = "3192934192321";
  $user2 = "teolo_21117533";

  $con = new mysqli($host, $user, $pass, $db);
  $con->query("SET NAMES 'utf8'");

 ?>
