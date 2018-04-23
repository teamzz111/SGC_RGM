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
            $Seccional = $input['seccional']; // esto estás segura de q está bn? o sea muestra el dato elqu

            $con = new mysqli($host, $user, $pass, $db);
            $con->query("SET NAMES 'utf8'");
            if ($con->connect_error) {
                echo json_encode('falseC'); 
            }
            $query1="SELECT * FROM empleado WHERE cedula=".$Cedula;
            $resultado = $con ->query($query1);        
    
            if ($resultado->num_rows>0) {
                echo json_encode('nel');
            }
            else{
                $query = "SELECT idCargos FROM cargo WHERE nombre = '$Cargo'";
                $resultado = $con->query($query);
                $row = $resultado->fetch_array(MYSQLI_ASSOC);
                $Cargo = $row['idCargos'];
                
                $query3 = "SELECT idSeccional FROM seccional WHERE ciudad = '$Seccional'";
                $resultado3 = $con->query($query3);
                $row3 = $resultado3->fetch_array(MYSQLI_ASSOC); 
                $Seccional1 = $row3['idSeccional']; 


                $Gen ='m';
                if($Genero=='Hombre') {$Gen ='m';}
                if($Genero=='Mujer') {$Gen ='f';}
                if($Genero=='Otro') {$Gen ='o';}

                $query = "INSERT INTO `empleado` VALUES ($Cedula, '$Nombre', '$Apellido', '$Correo', $Telefono, '$Direccion', $Numero, '$Gen', $Seccional1, $Cargo)";
                $rs = $con->query($query);

                $query1= "INSERT INTO `cuenta` VALUES ('UbcFeuR35Wcuy+vusRINTg==','Activo',$Cedula)";
                
            
                $result = $con->query($query1);
                
                if ($result && $rs) { 
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
            }
        mysqli_close($con);
        echo $res;
        
    }

    
    
?>