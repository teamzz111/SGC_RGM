<?php

require 'Conexion.php';
    session_start();
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        if($_GET['opt'] == 1){ 
            global $con;
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $input = json_decode($inputJSON, TRUE);
            $Nombre = $input['nombre'];
            $Tipo = $input['tipo'];
            
            $query = "SELECT Id FROM Tipo WHERE Nombre = '$Tipo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Tipo = $row['Id'];
    
            if ($con->connect_error) {
                echo json_encode('false');
            }
            $idEncuesta="Esto es malo";
            $resultado;
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
                $resultado = $con->query($query1);
                        }

            while ($resultado->num_rows > 0  || $idEncuesta =='Esto es malo'); 
           
           
                $_SESSION['Encuesta'] = $idEncuesta;
                $_SESSION['NumPregunta'] = 1;
                $query = "INSERT INTO Encuesta VALUES ('$idEncuesta','$Nombre',$Tipo, '10/05/18','10/04/14')";//luego sigo, tengo sueño xd
                
                $rs = $con->query($query);
                if ($rs) {
                    echo json_encode('true');
                    }
                    else {
                        echo json_encode('false');
                    }

          
        } 
        else if ($_GET['opt'] == 2)
        { //se registra pregunta
             
             if($result['nrespuesta'] == 0){ // es una respuesta abierta 
                
                //echo json_encode($result['pregunta']);
                $con = new mysqli($host, $user2, $pass2, $db2);
                 $idPregunta="Esto es malo";
                 do {
                     $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                     $long=strlen($char)-1;
                     $j[0]=0;
                     for($i=0;$i<7;$i++){
                         $c=rand(0,$long);
                         $n=$char[$c];
                         $j[0].=$n;
                     }
                     $idPregunta = $j[0];
                     $query1 = "SELECT * FROM Pregunta WHERE idPregunta = '$idPregunta'";
                     $resultado = $con->query($query1);
                    }
     
                 while ($resultado->num_rows>0 || $idPregunta=='Esto es malo'); 
                 
     
                 $input = json_decode($inputJSON, TRUE);
                 $Pregunta = $input['pregunta'];
                 $Tipo= $input['tpregunta'];
                // $Numero = $input['numero'];
                 $R1= $input['r1'];
                 $Num= $_SESSION['NumPregunta'];
                 $IdEn =  $_SESSION['Encuesta'];
         
                 $con = new mysqli($host, $user2, $pass2, $db2);
                 $con->query("SET NAMES 'utf8'");
                 $query="";
                 if ($con->connect_error) {
                     echo json_encode('false');
                 }
                 
                 
                     $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta',null,null,null,null,null,'$IdEn')";
                 
                     $rs = $con->query($query);
                     echo $query;
                     $_SESSION['NumPregunta']=$_SESSION['NumPregunta']+1;
                     if ($rs) {
                         echo json_encode('true');
                         }
                         else {
                             echo json_encode('false');
                         }
             }
            else { //es una pregunta con múltiple opción
             

                $con = new mysqli($host, $user2, $pass2, $db2);
                $con->query("SET NAMES 'utf8'");
                $idPregunta="Esto es malo";
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

            while ($resultado->num_rows>0 || $idPregunta=='Esto es malo'); 
            

            $input = json_decode($inputJSON, TRUE);
            $Pregunta = $input['pregunta'];
            $Tipo= $input['tpregunta'];
            $R1= $input['r1'];
            $R2= $input['r2'];
            $R3= $input['r3'];
            $R4= $input['r4'];
            $R5= $input['r5'];
            $IdEn=$_SESSION['Encuesta'];
            $Num= $_SESSION['NumPregunta'];
            
    
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $query="";
            if ($con->connect_error) {
                echo json_encode('false');
                exit;
            }
            if ($R2=='nulll') {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta','$R1',Null,Null,Null,Null,'$IdEn')";
            }
            else if ($R3=='nulll') {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta','$R1','$R2',Null,Null,Null,'$IdEn')";
            }
            else if ($R4=='nulll') {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta','$R1','$R2','$R3',Null,Null,'$IdEn')";
            }
            else if ($R5=='nulll') {
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta','$R1','$R2','$R3','$R4',Null,'$IdEn')";
            } else 
                $query = "INSERT INTO Pregunta VALUES ('$idPregunta','$Tipo',$Num,'$Pregunta','$R1','$R2','$R3','$R4','$R5','$IdEn')";
            
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
