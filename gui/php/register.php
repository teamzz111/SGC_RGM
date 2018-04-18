<?php
    include 'test.php';
    if(isset($_GET['opt']) && $_GET['opt'] == 1){
        $con = new mysqli($host, "root", $pass, $db);
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
        $rs;
        $query = "SELECT seccional.idSeccional, cargo.idCargo  FROM seccional, cargo;

    }


?>