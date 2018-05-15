<?php

include 'Conexion.php';
session_start();
if(!isset($_GET['opt'])) {
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        if($_GET['opt'] == 1){ 
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $input = json_decode($inputJSON, TRUE);
            $Nombre = $input['nombre'];
            $Tipo= $input['tipo'];
            
            $query = "SELECT Id FROM Tipo WHERE Nombre = '$Tipo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Tipo = $row['Id'];
    
            if ($con->connect_error) {
                echo json_encode('false');
            }
            $idEncuesta="Esto es malo";
            do{
                $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $long=strlen($char)-1;
                $j[0]=0;
                for($i=0;$i<6;$i++){
                    $c=rand(0,$long);
                    $n=$char[$c];
                    $j[0].=$n;
                }
                $idEncuesta = $j[0];
                $query1="SELECT * FROM Encuesta WHERE idEncuesta = '$idEncuesta'";
                $resultado = $con->query($query1);}

            while ($resultado->num_rows>0  || $idEncuesta='Esto es malo'); 
                $_SESSION['Encuesta'] = $idEncuesta;
                $_SESSION['NumPregunta'] = 1;
                $query = "INSERT INTO Encuesta VALUES ('$idEncuesta','$Nombre',$Tipo)";//luego sigo, tengo sueño xd
                $rs = $con->query($query);
                if ($rs) {
                    echo json_encode('true');
                    }
                    else {
                        echo json_encode('false');
                    }

            echo json_encode($result['nombre']);
        } 
        else if ($_GET['opt'] == 2)
        { //se registra pregunta
             
             if($result['nrespuesta'] == 0){ // es una respuesta abierta 
                
                echo json_encode($result['pregunta']);

                 $idPregunta="Esto es malo"
                 do{
                     $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                     $long=strlen($char)-1;
                     $j[0]=0;
                     for($i=0;$i<7;$i++){
                         $c=rand(0,$long);
                         $n=$char[$c];
                         $j[0].=$n;
                     }
                     $idPregunta = $j[0];
                     $query1="SELECT * FROM Pregunta WHERE idPregunta = '$idPregunta'";
                     $resultado = $con->query($query1);}
     
                 while ($resultado->num_rows>0 || $idPregunta='Esto es malo'); 
                 
     
                 $input = json_decode($inputJSON, TRUE);
                 $Pregunta = $input['pregunta'];
                 $Tipo= $input['tpregunta'];
                 $Numero= $input['numero'];
                 $R1= $input['r1'];
                 $Num= $_SESSION['NumPregunta'];
         
                 $con = new mysqli($host, $user2, $pass2, $db2);
                 $con->query("SET NAMES 'utf8'");
                 $query="";
                 if ($con->connect_error) {
                     echo json_encode('false');
                 }
                 
                     $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,null,null,null,null)";
                 
                     $rs = $con->query($query);
                     $_SESSION['NumPregunta']=$_SESSION['NumPregunta']+1;
                     if ($rs) {
                         echo json_encode('true');
                         }
                         else {
                             echo json_encode('false');
                         }
             }
            else { //es una pregunta con múltiple opción
             

                echo $_SESSION['Encuesta']; // ahí queda
            $idPregunta="Esto es malo"
            do{
                $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $long=strlen($char)-1;
                $j[0]=0;
                for($i=0;$i<7;$i++){
                    $c=rand(0,$long);
                    $n=$char[$c];
                    $j[0].=$n;
                }
                $idPregunta = $j[0];
                $query1="SELECT * FROM Pregunta WHERE idPregunta = '$idPregunta'";
                $resultado = $con->query($query1);}

            while ($resultado->num_rows>0 || $idPregunta='Esto es malo'); 
            

            $input = json_decode($inputJSON, TRUE);
            $Pregunta = $input['pregunta'];
            $Tipo= $input['tpregunta'];
            $Numero= $input['numero'];
            $R1= $input['r1'];
            $R2= $input['r2'];
            $R3= $input['r3'];
            $R4= $input['r4'];
            $R5= $input['r5'];
            $Num= $_SESSION['NumPregunta'];
    
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $query="";
            if ($con->connect_error) {
                echo json_encode('false');
            }
            if ($R2=='null')
            {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,Null,Null,Null,Null)";
            }
            else if ($R3=='null')
            {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,$R2,Null,Null,Null)";
            }
            else if ($R4=='null')
            {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,$R2,$R3,Null,Null)";
            }
            if ($R5=='null')
            {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,$R2,$R3,$R4,Null)";
            }
            else
            {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',$R1,$R2,$R3,$R4,$R5)";
            }
                $rs = $con->query($query);
                $_SESSION['NumPregunta'] = $_SESSION['NumPregunta']+1;
                if ($rs) {
                    echo json_encode('true');
                    }
                    else {
                        echo json_encode('false');
                    }
            }
        }
        
    }
?>
