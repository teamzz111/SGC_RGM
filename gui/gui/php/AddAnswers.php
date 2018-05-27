<?php

require 'Conexion.php';
    session_start();
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        global $result;
        $result = json_decode($inputJSON, true);
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
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
           
            $Id = $result['id'];
            $R1 = $result['r1'];
            $R2 = $result['r2'];
            $R3 = $result['r3'];
            $R4 = $result['r4'];
            $R5 = $result['r5'];
            $var = $result['conf'];
            $Num= $_SESSION['NumRespuesta'];
            
    
            $con->query("SET NAMES 'utf8'");
            $query="";
            if ($con->connect_error) {
                echo json_encode('false');
                exit;
            }
            $query = "INSERT INTO Respuesta VALUES ('$idRespuesta','$R1','$R2','$R3','$R4','$R5',$Num,'$Id')";
            
            $rs = $con->query($query);
     
            $_SESSION['NumRespuesta'] = $_SESSION['NumRespuesta']+1;
            if ($rs) {
                echo json_encode('true');
                if($var == 'true'){
                    $_SESSION['NumRespuesta'] = 1;
                    $user = $_SESSION['username'];
                    $query = "INSERT INTO Realizado VALUES ('$user', '$Id')";
                    $rs = $con->query($query);
                }
            } else {
                echo json_encode('false');
            }
        
        
    }
?>
