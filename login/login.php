<?php
    include 'Security.php';

    session_start();
    $host = "localhost";
    $user = "root";
    $db = "bd";
    $pass = "";
    $key = "92AE31B89FEEB2A3"; //llave
    $con = new mysqli($host, $user, $pass, $db);

    if($con -> connect_error){
        die("Conexión errónea: " . $con->connect_error);
    }

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "SELECT cuenta.idCuenta, cuenta.contrasena, empleado.nombre, empleado.apellido, cuenta.cargo FROM Cuenta, empleado WHERE empleado.cedula = '$user' AND empleado.cedula = Cuenta.Empleado_cedula";

    $result = $con->query($query);

    if($result->num_rows > 0){
        $row = $result ->fetch_array(MYSQLI_ASSOC);
        if (password_verify(encrypt($pass), $row['contrasena']){
            echo 'true';
        }
        else{
            echo 'false';
        }
    }
    else{
        echo '1false';
    }

?>