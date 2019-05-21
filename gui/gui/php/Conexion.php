<?php

  global $host, $db, $pass, $key, $user, $db2, $pass2, $user2;
  $host = "localhost";
  //$host = "localhost";
  $db = "sgc";
  $pass = "";
  $user = "root";
  $key = "92AE31B89FEEB2A3"; //llave

  $con = mysqli_connect($host, $user, $pass, $db);
  $con2 = mysqli_connect($host, $user2, $pass2, $db2);
  if($con -> connect_error){
    die("Conexión errónea: " . $con->connect_error);
}
 ?>
