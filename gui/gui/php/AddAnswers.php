<?php

require 'Conexion.php';
    session_start();
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $input = json_decode($inputJSON, TRUE);
            $idRespuesta="Esto es malo";
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
                $idRespuesta = $j[0];
                $query1="SELECT * FROM Respuesta WHERE idRespuesta = '$idRespuesta'";
                $resultado = $con->query($query1);
                        }
            while ($resultado->num_rows > 0  || $idRespuesta =='Esto es malo'); 
           
            $Id = $input['id'];
            $R1= $input['r1'];
            $R2= $input['r2'];
            $R3= $input['r3'];
            $R4= $input['r4'];
            $R5= $input['r5'];
            $Num= $_SESSION['NumRespuesta'];
            
    
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            $query="";
            if ($con->connect_error) {
                echo json_encode('false');
                exit;
            }
            if ($R1=='nulll') {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta',Null,Null,Null,Null,Null,$Num,'$Id')";
            }
            else if ($R2=='nulll') {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1',Null,Null,Null,Null,$Num,'$Id')";
            }
            else if ($R3=='nulll') {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1','$R2',Null,Null,Null,$Num,'$Id')";
            }
            else if ($R4=='nulll') {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1','$R2','$R3',Null,Null,$Num,'$Id')";
            }
            else if ($R5=='nulll') {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1','$R2','$R3','$R4',Null,$Num,'$Id')";
            } else {
                $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1','$R2','$R3','$R4','$R5',$Num,'$Id')";
            }
            $rs = $con->query($query);
            $_SESSION['NumRespuesta'] = $_SESSION['NumRespuesta']+1;
            if ($rs) {
                echo json_encode('true');
            } else {
                echo json_encode('false');
            }
        
        
    }
?>
