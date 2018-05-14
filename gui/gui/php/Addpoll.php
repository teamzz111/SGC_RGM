<?php

include 'Conexion.php';

if(!isset($_GET['opt'])) {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);
        $Nombre = $input['nombre'];
        $Tipo= $input['tipo'];

        $query = "SELECT Id FROM Tipo WHERE Nombre = '$Tipo'";
        $resultado = $con->query($query);
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        $Tipo = $row['idCargos'];

        $con = new mysqli($host, $user, $pass, $db);
        $con->query("SET NAMES 'utf8'");
        if ($con->connect_error) {
            echo json_encode('falseC');
        }
         $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $long=strlen($char)-1;
            $j[0]=0;
            for($i=0;$i<6;$i++){
                $c=rand(0,$long);
                $n=$char[$c];
                $j[0].=$n;
            }
            $crp = $j[0];
            $query = "INSERT INTO seccional VALUES ('CONTRASEÑA IRÁ AQUI','$Nombre',$Tipo)";//luego sigo, tengo sueño xd
            $rs = $con->query($query);
            if ($rs) {
                echo json_encode('true');
                }
                else {
                    echo json_encode('false');
                }
        }
?>
