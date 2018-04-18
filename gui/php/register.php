<?php
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


?>