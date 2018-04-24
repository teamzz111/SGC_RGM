<?php
    include 'Security.php';
    include 'Conexion.php';

    session_start();

    $con = new mysqli($host, $user, $pass, $db);

    if($con -> connect_error){
        die("Conexión errónea: " . $con->connect_error);
    }
    if($_GET['auth'] == 1){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = "SELECT cuenta.contrasena, empleado.cargo_idCargos FROM cuenta, empleado WHERE cuenta.cedula = $user AND empleado.cedula = ".$user;

        $result = $con->query($query);

        if($result->num_rows > 0){
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            if (encrypt($pass, $key) == $row['contrasena']){
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user;
                $_SESSION['job'] = $row['cargo_idCargos'];
                echo "true";
            }
            else{
                echo "false";
            }
        }
        else{
            echo "0";
        }
    }
    else{

    }

?>
