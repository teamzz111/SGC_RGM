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
           $Id='06D7Y2U'; 
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
            global $array4;
            $arrayy;
            for($i=1; $i<=$NumPreguntas; $i++)
            {
                $query = "SELECT Pregunta, TipoPregunta FROM Pregunta WHERE Numero = '$i' AND idEncuesta= '$Id'";
                $result = $con->query($query);
                $row = $result ->fetch_array(MYSQLI_ASSOC);
                $Pregunta = $row['Pregunta'];
                $Tipo=$row['TipoPregunta'];
                $Preg = ""; $Resp1=""; $Cont1=0; $Resp2=""; $Cont2=0; $Resp3=""; $Cont3=0; $Resp4=""; $Cont4=0; $Resp5=""; $Cont5=0;
                if($Tipo=="tp2" || $Tipo=="tp3")
                {
                     $Preg = $Pregunta;
                     //array_push($array, array('Pregunta' => $Pregunta));

                    $query = "SELECT count(Respuesta1), Respuesta1 FROM Pregunta WHERE Numero= $i AND idEncuesta= '$Id'";
                  
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['count(Respuesta1)'];
                    $Respuesta= $row['Respuesta1'];
                    if($contador>0)
                    {
                        $Respuesta= $row['Respuesta1'];
                        $query = "SELECT count(Respuesta) FROM Respuesta WHERE Num= $i AND idEncuesta= '$Id' AND (Respuesta='true' OR Respuesta='$Respuesta')";
                        $result = $con->query($query);
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador = $row2["count(Respuesta)"];
                        $Resp1 = $row['Respuesta1'];
                        $Cont1 = $contador;
                        //array_combine($array, array('Respuesta' => $row['Respuesta1']));
                        //array_combine($array, array('Contador' => $contador));
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
                    
                        $row2 = $result ->fetch_array(MYSQLI_ASSOC);
                        $contador =$row2["count(Respuesta2)"];
                        $Resp2 = $row['Respuesta2'];
                        $Cont2 = $contador;
                        //array_push($array, array('Respuesta2' => $row['Respuesta2']));
                        //array_push($array, array('Contador2' => $contador));
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
                        $Resp3 = $row['Respuesta3'];
                        $Cont3 = $contador;
                        //array_push($array, array('Respuesta3' => $row['Respuesta3']));
                        //array_push($array, array('Contador3' => $contador));
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
                        $Resp4 = $row['Respuesta4'];
                        $Cont4 = $contador;
                        //array_push($array, array('Respuesta4' => $row['Respuesta4']));
                        //array_push($array, array('Contador4' => $contador));
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
                        $Resp5 = $row['Respuesta5'];
                        $Cont5 = $contador;
                        //array_push($array, array('Respuesta5' => $row['Respuesta5']));
                        //array_push($array, array('Contador5' => $contador));
                    }
                }
                if($i == 1){
                    $query = "SELECT Nombre FROM Encuesta WHERE idEncuesta = '$Id'";
                    $result = $con->query($query);
                    $row = $result ->fetch_array(MYSQLI_ASSOC);
                    $contador = $row['Nombre'];
                    $array4 = array('Nombre' => $contador, 'Pregunta' => $Preg, 'Respuesta1' => $Resp1,'Contador1' => $Cont1, 'Respuesta2' => $Resp2,'Contador2' => $Cont2, 'Respuesta3' => $Resp3,'Contador3' => $Cont3, 'Respuesta4' => $Resp4,'Contador4' => $Cont4,
                    'Respuesta5' => $Resp5,'Contador5' => $Cont5);
                    $arrayy = array_map('html_entity_decode', $array4);
                } else {
                    $array4 = array("Pregunta$i" => $Preg, 'Respuesta1' => $Resp1,'Contador1' => $Cont1, 'Respuesta2' => $Resp2,'Contador2' => $Cont2, 'Respuesta3' => $Resp3,'Contador3' => $Cont3, 'Respuesta4' => $Resp4,'Contador4' => $Cont4,
                    'Respuesta5' => $Resp5,'Contador5' => $Cont5);
                    array_push($arrayy, array_map('html_entity_decode', $array4));
                }

            }
        
            $res = json_encode($arrayy, JSON_UNESCAPED_UNICODE);
            echo '[';
            echo $res;
            echo ']';
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
        }
        else if ($_GET['opt'] == 4){ // Se desean obtener las encuestas y los que las han respondid
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con2 = new mysqli($host, $user, $pass, $db);
            
            $con->query("SET NAMES 'utf8'");
            
            $query="";
            
            if ($con->connect_error) 
            {
                echo json_encode('false');
                exit;
            }
            
            $query2 = "SELECT idEncuesta, Nombre, Cargo, Cargo2, Cargo3, Cargo4 FROM Encuesta";
            $result1 = $con->query($query2);
            $array = array();


            while($filita = mysqli_fetch_assoc($result1)){
                $arrayTemporal = array();
                $sqlUser = "SELECT count(*) FROM empleado WHERE ";
                $Inicial = 0; // Esta variable verifica si hubo una insercción despupes del where
                if($filita['Cargo'] == 'true'){
                    if($Inicial == 0){
                      $sqlUser = $sqlUser . "cargo_idCargos = 1 ";  
                      $Inicial = 1;
                    }
                }
                if($filita['Cargo2'] == 'true'){
                    if($Inicial == 0){
                      $sqlUser = $sqlUser . "cargo_idCargos = 2 ";  
                      $Inicial = 1;
                    } else {
                      $sqlUser = $sqlUser . " OR cargo_idCargos = 2 ";  
                    }
                }         
                if($filita['Cargo3'] == 'true'){
                    if($Inicial == 0){
                      $sqlUser = $sqlUser . "cargo_idCargos = 3 ";  
                      $Inicial = 1;
                    }else {
                      $sqlUser = $sqlUser . " OR cargo_idCargos = 3 ";  
                    }
                }
                if($filita['Cargo4'] == 'true'){
                    if($Inicial == 0){
                      $sqlUser = $sqlUser . "cargo_idCargos = 4";  
                      $Inicial = 1;
                    }else {
                      $sqlUser = $sqlUser . " OR cargo_idCargos = 4 ";  
                    }
                }

                $result3 = $con2->query($sqlUser);  
                $faltantes = mysqli_fetch_assoc($result3);
                $Id = $filita['idEncuesta'];
                $query = "SELECT count(*) FROM Realizado WHERE idEncuesta= '$Id'";
                $result = $con->query($query);        

                $array23 = [
                    "idEncuesta" => $filita['idEncuesta'],
                    "Nombre" => $filita['Nombre'],
                    "Faltantes" => $faltantes['count(*)']
                ];
                while ($fila = mysqli_fetch_assoc($result)) {
                    $array23['Respondido'] = $fila['count(*)'];    
                    array_push($array, $array23);
                     
                }
            }
             echo json_encode($array,JSON_UNESCAPED_UNICODE); 
        }
    }
?>
