<?php

require 'Conexion.php';
    session_start();
    if(isset($_GET['opt'])){
        f($_GET['opt'] == 1){
            $inputJSON = file_get_contents('php://input');
            $result = json_decode($inputJSON, true);
            $con = new mysqli($host, $user, $pass, $db);
            $con->query("SET NAMES 'utf8'");
            
            $query = "SELECT *  FROM Encuesta WHERE idEncuesta=";
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
        if($_GET['opt'] == 2){
            
            $inputJSON = file_get_contents('php://input');
            $result = json_decode($inputJSON, true);
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $Id = $input['id'];
            $input = json_decode($inputJSON, TRUE);
            $query="";
            if ($con->connect_error) 
            {
                echo json_encode('false');
                exit;
            }
            $query = "SELECT count(Respuesta) from Respuesta";
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $v1 = $row['count(Respuesta)'];

            $query = "SELECT count(Respuesta2) from Respuesta";
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $v1 = $v1+$row['count(Respuesta2)'];

            $query = "SELECT count(Respuesta3) from Respuesta";
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $v1 = $v1+$row['count(Respuesta3)'];

            $query = "SELECT count(Respuesta4) from Respuesta";
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $v1 = $v1+$row['count(Respuesta4)'];

            $query = "SELECT count(Respuesta5) from Respuesta";
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $v1 = $v1+$row['count(Respuesta5)'];
            
            $query = "SELECT count(*) FROM Encuesta WHERE idEncuesta= '$Id'" ;
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $NumPreguntas = $row['count(*)'];

            $contador1=0;
            $contador2=0;
            $contador3=0;
            $contador4=0;
            $contador5=0;

            for($i=1; $i<=$NumPreguntas; $i++)
            {
                $query = "SELECT count(Respuesta1) FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador1 = $contador1+$row['count(Respuesta1)'];

                $query = "SELECT count(Respuesta2) FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador2 = $contador2+$row['count(Respuesta2)'];

                $query = "SELECT count(Respuesta3) FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador3 = $contador3+$row['count(Respuesta3)'];

                $query = "SELECT count(Respuesta4) FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador4 = $contador4+$row['count(Respuesta4)'];

                $query = "SELECT count(Respuesta5) FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador5 = $contador5+$row['count(Respuesta5)'];


            }



            //ira woman vas a hacer un for con el número de registros que tenga la encuesta con el id
            //tal cosa y en ese for a sumar todas las respuestas que tienen las preguntas, con ese 
            //número hacer un for para ver la cantidad de respuestas que escogieron esas preguntas
            //osea la cantidad de Respuesta.Respuesta que hay de esas Pregunta.Respuesta    
            //finalmente imprimir, la pregunta, las posiblidades de respuesta y la cantidad de cada una
            
            if ($result) {echo json_encode('true');}
            else {echo json_encode('false');}
        }
    }
?>
