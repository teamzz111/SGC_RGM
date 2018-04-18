<?php
<<<<<<< HEAD
    $host = "localhost";
    $db = "bd";
    $pass = "";
    if(isset($_GET['opt'])) {
        $con = new mysqli($host, "root", $pass, $db);
        if ($con->connect_error) {
            die("Conexión errónea: " . $con->connect_error);
        }
        $rs;
        $query;

        if( $_GET['opt'] == 1 ) {
            $query = "SELECT nombre, nivel FROM cargo";
        }
        else{
            $query = "SELECT seccional.ciudad, seccional.pais FROM seccional";
        }
        $rs = $con->query($query);
        if ($rs) {
=======
   // include 'test.php';
    if(isset($_GET['opt'])){

    } else {

        if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion'])&& isset($_POST['numero'])/**/)
        {
            $Cedula = $_POST['cedula'];
            $Nombre = $_POST['nombre'];
            $Apellido = $_POST['apellido'];
            $Correo = $_POST['correo'];
            $Telefono = $_POST['telefono'];
            $Direccion = $_POST['direccion'];
            $Numero = $_POST['numero'];

            $db = "bd";
            $host = "localhost";
            $pw = "";
            $user = "root";
            $con = mysql_connect($host,$user,$pw) or die("No se pudo conectar con la bd. ");
            mysql_select_db($db,$con) or die("No se pudo conectar a la base de datos. ");
            mysql_query("INSERT INTO empleado(`cedula`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `numero`, `sexo`, `idSeccional`, `idCargos`) VALUES
            ('$Cedula', '$Nombre', '$Apellido', '$Correo', '$Telefono', '$Direccion', '$Numero', 'm', 1,0)");

        }
        else   
        {
            echo "llene el campo gonorrea ome gonorrea";
        }
      
    }
>>>>>>> 6fa9a4cf8ee90b6e6b37f128e743c63d3c5a931b

            $array = array();
            while ($fila = mysqli_fetch_assoc($rs)) {
    
                $array[] = array_map('utf8_encode', $fila);
            }

            $res = json_encode($array, JSON_NUMERIC_CHECK);
        } else {
            $res = null;
            echo mysqli_error($con);
        }
        mysqli_close($con);
        echo $res;
    }
?>