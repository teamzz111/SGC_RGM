<?php
   // include 'test.php';
    $db = "bd";
    $host = "localhost";
    $pw = "";
    $user = "root";
    if(!isset($_GET['opt'])) {
        if (isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion']) && isset($_POST['numero'])/**/) 
        {
            $Cedula = $_POST['cedula'];
            $Nombre = $_POST['nombre'];
            $Apellido = $_POST['apellido'];
            $Correo = $_POST['correo'];
            $Telefono = $_POST['telefono'];
            $Direccion = $_POST['direccion'];
            $Numero = $_POST['numero'];
            echo $_POST['cedula'];

            $con = new mysqli($host, "root", $pw, $db);
            if ($con->connect_error) {
                die("Conexión errónea: " . $con->connect_error);
            }
            $query1="SELECT * FROM empleado WHERE cedula=".$Cedula;
            $resultado = $con ->query($query1);        
    
            if ($resultado->num_rows>0) {echo "nel";}
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
        else { echo json_encode('0'); }      
    }
    else{
        if($_GET['opt'] == 1){
            $query = "SELECT nombre, nivel FROM cargo";
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
    }

    
    
?>