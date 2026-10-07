<?php

  global $host, $db, $pass, $key, $user, $db2, $pass2, $user2;
  $host = "YOUR_DB_HOST";
  //$host = "localhost";
  $db = "YOUR_DB_NAME";
  $pass = "";
  $user = "YOUR_DB_USER";
  $key = "YOUR_APP_KEY"; //llave

  $con = mysqli_connect($host, $user, $pass, $db);
  $con2 = mysqli_connect($host, $user2, $pass2, $db2);
  if($con -> connect_error){
    die("Conexión errónea: " . $con->connect_error);
}
 ?>
