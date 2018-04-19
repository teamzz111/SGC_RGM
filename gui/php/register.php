<?php
   // include 'test.php';

        if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion'])&& isset($_POST['numero'])/**/)
        {
            $Cedula = $_POST['cedula'];
            $Nombre = $_POST['nombre'];
            $Apellido = $_POST['apellido'];
            $Correo = $_POST['correo'];
            $Telefono = $_POST['telefono'];
            $Direccion = $_POST['direccion'];
            $Numero = $_POST['numero'];
            echo $_POST['cedula'];
            $db = "bd";
            $host = "localhost";
            $pw = "";
            $user = "root";
            $con = new mysqli($host, "root", $pw, $db);
            if($con -> connect_error){
                die("Conexión errónea: " . $con->connect_error);
            }
        
$query = "INSERT INTO `empleado` VALUES ('$Cedula', '$Nombre', '$Apellido', '$Correo', '$Telefono', '$Direccion', '$Numero', 'm', 1,0)";  
            $rs = $con->query($query);
            echo $query;
                   if($rs){
            echo '<script language="javascript">alert("Empleaducho añadido");</script>'; 
                   }
                   else
                {
                    echo $con->error;
                    echo 'hola';
                }
        }
        else   
        {
            echo "llene el campo gonorrea ome gonorrea";
        }
      
    


    
    
?>