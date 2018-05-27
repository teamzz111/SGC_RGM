<?php
    require 'Conexion.php';
    session_start();
    if(isset($_GET['opt'])){
        if($_GET['opt'] == 1){
            $inputJSON = file_get_contents('php://input');
            $result = json_decode($inputJSON, true);
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            global $res;
            $hoy = getdate();
            $feh = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
            $query = "SELECT * FROM Encuesta WHERE FechaCierre <= DATE '$feh'";
       
            echo $feh;
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
            
            $query = "SELECT count(*) FROM Encuesta WHERE idEncuesta= '$Id'" ;
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $NumPreguntas = $row['count(*)'];

            $contador=0;
            $Pregunta;

            $array = array();

            for($i=1; $i<=$NumPreguntas; $i++)
            {
                $query = "SELECT Pregunta FROM Pregunta WHERE Numero = '$i'";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $Pregunta = $row['Pregunta'];

                array_push($array, $Pregunta);

                $query = "SELECT count(Respuesta1), Respuesta1 FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador = $row['count(Respuesta1)'];
                if($contador>0)
                {
                    $query = "SELECT count(Respuesta) FROM Respuesta WHERE Num= $i";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $contador+$row['count(Respuesta1)'];

                    array_push($array, $row['Respuesta1']);
                    array_push($array, $contador);
                }

                $query = "SELECT count(Respuesta2), Respuesta2 FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador = $row['count(Respuesta2)'];
                if($contador>0)
                {
                    $query = "SELECT count(Respuesta2) FROM Respuesta WHERE Num= $i";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $contador+$row['count(Respuesta2)'];

                    array_push($array, $row['Respuesta2']);
                    array_push($array, $contador);
                }

                $query = "SELECT count(Respuesta3), Respuesta3 FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador = $row['count(Respuesta3)'];
                if($contador>0)
                {
                    $query = "SELECT count(Respuesta3) FROM Respuesta WHERE Num= $i";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $contador+$row['count(Respuesta3)'];

                    array_push($array, $row['Respuesta3']);
                    array_push($array, $contador);
                }

                $query = "SELECT count(Respuesta4), Respuesta4 FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador = $row['count(Respuesta4)'];
                if($contador>0)
                {
                    $query = "SELECT count(Respuesta4) FROM Respuesta WHERE Num= $i";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $contador+$row['count(Respuesta4)'];

                    array_push($array, $row['Respuesta4']);
                    array_push($array, $contador);
                }

                $query = "SELECT count(Respuesta5), Respuesta5 FROM Pregunta WHERE Numero= $i";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $contador = $row['count(Respuesta5)'];
                if($contador>0)
                {
                    $query = "SELECT count(Respuesta5) FROM Respuesta WHERE Num= $i";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $contador+$row['count(Respuesta5)'];

                    array_push($array, $row['Respuesta5']);
                    array_push($array, $contador);
                }
            }
            if ($result) {echo json_encode('true');}
            else {echo json_encode('false');}
        }
    }
?>
