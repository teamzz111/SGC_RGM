<?php

    if(!isset($_GET['opt'])) {
            include 'test.php';
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE); 
   
            $Cedula = $input['cedula'];
            $Nombre = $input['nombre'];
     
            $Apellido = $input['apellido'];
        
            $Correo = $input['correo'];
            $Telefono = $input['telefono'];
            $Direccion = $input['direccion'];
            $Numero = $input['numero'];
              
            $Genero = $input['genero'];

            $Cargo = $input['cargo'];
            $Seccional = $input['seccional'];

            $con = new mysqli($host, "root", $pass, $db);
            if ($con->connect_error) {
                echo json_encode('false'); 
            }
            $query1="SELECT * FROM empleado WHERE cedula=".$Cedula;
            $resultado = $con ->query($query1);        
    
            if ($resultado->num_rows>0) {
                echo json_encode('nel');
            }
            else{
                $query = "SELECT nivel FROM cargo WHERE nombre = '$Cargo'";
                $resultado = $con->query($query);
                $row = $resultado->fetch_array(MYSQLI_ASSOC);
                $Cargo = $row['nivel'];
                
                $query3 = "SELECT idSeccional FROM seccional WHERE ciudad = '$Seccional'";
                $resultado3 = $con->query($query3);
                $row3 = $resultado3->fetch_array(MYSQLI_ASSOC); 
                $Seccional = $row3['idSeccional']; 
                if($Genero=='Hombre'){$Gen='m';}
                if($Genero=='Mujer'){$Gen='f';}
                if($Genero=='Otro'){$Gen='o';}

                $query = "INSERT INTO `empleado` VALUES ($Cedula, '$Nombre', '$Apellido', '$Correo', $Telefono, '$Direccion', $Numero, $Gen, $Seccional , $Cargo)";
                $rs = $con->query($query);
                if ($rs) { 
                    echo json_encode('true');
                } 
                else { 
                    echo json_encode('false'); 
                }
                $query1= "INSERT INTO `cuenta` VALUES ($Cedula,'123456789')";
                
            
                $result = $con->query($query1);
            
                if ($result) { 
                    echo json_encode('true2');
                } 
                else { 
                    echo json_encode('false2'); 
                }
            }
        }
   
    
    else{
        include 'test.php';
        $query;
        if($_GET['opt'] == 1) {
            $query = "SELECT nombre, nivel FROM cargo";
        }
        else{
            $query = "SELECT ciudad, pais FROM seccional";
        }
        $con = new mysqli($host, "root", $pass, $db);
        $rs = $con->query($query);
        $array = array();
        $count = 0;
        if ($rs) {
            $array = array();
            while ($fila = mysqli_fetch_assoc($rs)) {
                $count++;
                $array[] = array_map('utf8_encode', $fila);
            }
            if($count == 0 ) {
                echo json_encode('error');
                exit(0);
            }
            $res = json_encode($array, JSON_NUMERIC_CHECK);
        }else{
            $res = null;
            echo mysqli_error($con);
            }
        mysqli_close($con);
        echo $res;
        
    }

    
    
?>