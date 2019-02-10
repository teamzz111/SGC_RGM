<?php

require_once 'Connection/Conexion.php';

if(!isset($_GET['opt'])) {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);
        $Ciudad = $input['ciudad'];
        $Pais = $input['pais'];
        $Departamento = $input['departamento'];
        $Direccion = $input['direccion'];
        $Lider = $input['lider'];
        $Tipo = $input['tipo'];

        $con = new mysqli($host, $user, $pass, $db);
        $con->query("SET NAMES 'utf8'");
        if ($con->connect_error) {
            echo json_encode('falseC');
        }
            $query = "INSERT INTO seccional VALUES (0, '$Ciudad', '$Pais', '$Departamento', $Direccion, '$Lider', $Tipo)";
            $rs = $con->query($query);
            if ($rs) {
                echo json_encode('true');
                }
                else {
                    echo json_encode('false');
                }
        }
?>
