<?php

include 'Conexion.php';

if(isset($_GET['opt'])) {
    $con = new mysqli($host, $user, $pass, $db);
    $con->query("SET NAMES 'utf8'");
    $Fecha= $input['fecha'];
    
    $query = "SELECT *  FROM Encuesta WHERE Fecha='$Fecha'";
            $resultado = $con->query($query);

            if ($resultado)
            {
                if($resultado->num_rows > 0)
                {
                    $array = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        $array[] = array_map('html_entity_decode', $fila);
                    }
                    $res = json_encode($array, JSON_UNESCAPED_UNICODE); 
                }
                else
                {
                    $res=null;
                    echo json_encode("nel");
                }
                
            }
            mysqli_close($con);
            echo $res;

    }


?>
