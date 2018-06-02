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
           //$Id = $input['id'];
           $Id='07ATXCE'; 
            $input = json_decode($inputJSON, TRUE);
            $query="";
            if ($con->connect_error) 
            {
                echo json_encode('false');
                exit;
            }
            
            $query = "SELECT count(*) FROM Pregunta WHERE idEncuesta= '$Id'" ;
            $result = $con->query($query);
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            $NumPreguntas = $row['count(*)'];

            $contador=0;
            $Pregunta;

            $array = array();

            for($i=1; $i<=$NumPreguntas; $i++)
            {
                $query = "SELECT Pregunta, TipoPregunta FROM Pregunta WHERE Numero = '$i' AND idEncuesta= '$Id'";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $Pregunta = $row['Pregunta'];
                $Tipo=$row['TipoPregunta'];
              /*  echo $query;
                echo '<br>';
                echo $Tipo;
                echo '<br>';*/

                if($Tipo=="tp2" || $Tipo=="tp3")
                {
                    array_push($array, $Pregunta);

                    $query = "SELECT count(Respuesta1), Respuesta1 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                  
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta1)'];
                    $Respuesta= $row['Respuesta1'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta1'];
                        $query = "SELECT count(Respuesta) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta='true' OR Respuesta='$Respuesta')";
                       // echo $query;
                        $result = $con->query($query);
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador = $row2["count(Respuesta)"];
    
                        array_push($array, $row['Respuesta1']);
                        array_push($array, $contador);
                    }
    
                    $query = "SELECT count(Respuesta2), Respuesta2 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                    $result = $con->query($query);
                    
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta2)'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta2'];
                        $query = "SELECT count(Respuesta2) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta2='true' OR Respuesta='$Respuesta')";
                        $result = $con->query($query);
                        echo $query;
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador =$row2["count(Respuesta2)"];
    
                        array_push($array, $row['Respuesta2']);
                        array_push($array, $contador);
                    }
    
                    $query = "SELECT count(Respuesta3), Respuesta3 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta3)'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta3'];
                        $query = "SELECT count(Respuesta3) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta3='true' OR Respuesta='$Respuesta')";
                        $result = $con->query($query);
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador = $row2["count(Respuesta3)"];
    
                        array_push($array, $row['Respuesta3']);
                        array_push($array, $contador);
                    }
    
                    $query = "SELECT count(Respuesta4), Respuesta4 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta4)'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta4'];
                        $query = "SELECT count(Respuesta4) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta4='true' OR Respuesta='$Respuesta')";
                        $result = $con->query($query);
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador = $row2["count(Respuesta4)"];
    
                        array_push($array, $row['Respuesta4']);
                        array_push($array, $contador);
                    }
    
                    $query = "SELECT count(Respuesta5), Respuesta5 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta5)'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta5'];
                        $query = "SELECT count(Respuesta5) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta5='true' OR Respuesta='$Respuesta')";
                        $result = $con->query($query);
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador = +$row2["count(Respuesta5)"];
    
                        array_push($array, $row['Respuesta5']);
                        array_push($array, $contador);
                    }
                }
                
            }
           /* for ($i=0; $i<count($array); $i++)
            {
                echo  $array[$i];
                echo '<br>';
            }*/
            $array1 = array();
            $array1[] = array_map('html_entity_decode', $array);
            $res = json_encode($array1, JSON_NUMERIC_CHECK);
                    echo $res;
            if ($result) {echo json_encode('true');}
            else {echo json_encode('false');}
<<<<<<< HEAD
=======
        } 
        else if ($_GET['opt'] == 3){
            $inputJSON = file_get_contents('php://input');
            $result = json_decode($inputJSON, true);
            $encuesta = $result['id'];
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $user = $_SESSION['username'];
            $query = "INSERT INTO Realizado VALUES ('$user', '$encuesta')";
            $rs = $con->query($query);
            if($rs){
                echo json_encode('true');
            }
            else {
                echo json_encode('false');
            }
>>>>>>> ccb21725dad86800342a0920e162b6c8acc2592e
        }
    }
?>
