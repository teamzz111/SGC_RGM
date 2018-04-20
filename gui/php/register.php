<?php
    include 'test.php';
    if(!isset($_GET['opt'])) {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE); //convert JSON
        echo json_encode($input['cedula']);
        if (isset($input['cedula']) && isset($input['nombre']) && isset($input['apellido']) && isset($input['correo']) && isset($input['telefono']) && isset($input['direccion']) && isset($input['numero']) 
        && isset($input['genero']) && isset($input['cargo']) && isset ($input['seccional'])) 
        {
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
            
            $con = new mysqli($host, "root", $pw, $db);
            if ($con->connect_error) {
                die("Conexión errónea: " . $con->connect_error);
            }
            $query1="SELECT * FROM empleado WHERE cedula=".$Cedula;
            $resultado = $con ->query($query1);        
    
            if ($resultado->num_rows>0) {
                echo json_encode("nel");
            }
            else{
                $query = "INSERT INTO `empleado` VALUES ('$Cedula', '$Nombre', '$Apellido', '$Correo', '$Telefono', '$Direccion', '$Numero', 'm', 1,1)";
                $query1= "INSERT INTO `cuenta` VALUES ('$Cedula','123456789')";
                $rs = $con->query($query);
                $result = $con->query($query1);
                echo $query;
                if ($rs) { echo json_encode('true');} 
                else { echo json_encode('false'); }
            }
        }
        else { 
            //e0cho json_encode('0'); }      
    }}
    else{
        $query;
        if($_GET['opt'] == 1) {
            $query = "SELECT nombre, nivel FROM cargo";
        }
        else{
            $query = "SELECT ciudad, pais FROM seccional";
        }
        $con = new mysqli($host, "root", $pw, $db);
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