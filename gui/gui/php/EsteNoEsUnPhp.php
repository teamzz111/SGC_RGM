<?php
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        if($_GET['opt'] == 1){ // se registra encuesta

            $input = json_decode($inputJSON, TRUE);
            $Nombre = $input['nombre'];
            $Tipo= $input['tipo'];
    
            $query = "SELECT Id FROM Tipo WHERE Nombre = '$Tipo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Tipo = $row['Id'];
    
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            if ($con->connect_error) {
                echo json_encode('false');
            }

            $crp="Esto es malo";
            do{
                $char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $long=strlen($char)-1;
                $j[0]=0;
                for($i=0;$i<6;$i++){
                    $c=rand(0,$long);
                    $n=$char[$c];
                    $j[0].=$n;
                }
                $crp = $j[0];
                $query1="SELECT * FROM Encuesta WHERE idEncuesta = '$crp'";
                $resultado = $con->query($query1);}

            while ($resultado->num_rows>0); 

                $query = "INSERT INTO Encuesta VALUES ('$crp','$Nombre',$Tipo)";//luego sigo, tengo sueño xd
                $rs = $con->query($query);
                if ($rs) {
                    echo json_encode('true');
                    }
                    else {
                        echo json_encode('false');
                    }

            echo json_encode($result['nombre']);
        } else if ($_GET['opt'] == 2){ //se registra pregunta
/*
            $input = json_decode($inputJSON, TRUE);
            $Nombre = $input['nombre'];
            $Tipo= $input['tipo'];
            $query = "SELECT Id FROM Tipo WHERE Nombre = '$Tipo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Tipo = $row['Id'];
    
            $con = new mysqli($host, $user2, $pass2, $db2);
            $con->query("SET NAMES 'utf8'");
            if ($con->connect_error) {
                echo json_encode('false');
            }
                $query = "INSERT INTO Encuesta VALUES ('CONTRASEÑA IRÁ AQUI','$Nombre',$Tipo)";
                $rs = $con->query($query);
                if ($rs) {
                    echo json_encode('true');
                    }
                    else {
                        echo json_encode('false');
                    }
 */
             if($result['nrespuesta'] == 0){ // es una respuesta abierta 
                 echo json_encode($result['pregunta']);
             }
            else { //es una pregunta con múltiple opción
                echo json_encode($result['r1']);
            }
        }
        
    }
?>