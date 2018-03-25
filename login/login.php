<?php
    include 'Security.php';

    session_start();
    $host = "localhost";
    $user = "u462448961_teamz";
    $db = "u462448961_bd";
    $pass = "KSTgUUPnu5Mj";
    $key = "92AE31B89FEEB2A3"; //llave
    $con = new mysqli($host, $user, $pass, $db);

    if($con -> connect_error){
        die("Conexión errónea: " . $con->connect_error);
    }

    $user = $_POST['user'];
    $pass = $_POST['pass'];

   // $query = "SELECT cuenta.idCuenta, cuenta.contrasena, empleado.nombre, empleado.apellido, cuenta.cargo FROM Cuenta, empleado WHERE empleado.cedula = '$user' AND empleado.cedula = Cuenta.Empleado_cedula";
    $query = "SELECT contrasena FROM Cuenta WHERE Empleado_cedula = '$user'";

    $result = $con->query($query);
    //mysqli->close();
    if($result->num_rows > 0){
        $row = $result ->fetch_array(MYSQLI_ASSOC);
        if (encrypt($pass, $key) == $row['contrasena']){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
            echo "true";
        }
        else{
            echo "false";
        }
    }
    else{
        echo "0";
    }

?>