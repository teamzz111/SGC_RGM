<?php
    include 'Security.php';

    session_start();
    $host = "mysql.hostinger.co";
    $db = "u462448961_bd";
    $pass = "nicky246";
    $key = "92AE31B89FEEB2A3"; //llave
    $con = new mysqli($host, "u462448961_teamz", $pass, $db);

    if($con -> connect_error){
        die("Conexión errónea: " . $con->connect_error);
    }
    if($_GET['auth'] == 1){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = "SELECT contrasena, cargo FROM cuenta WHERE Empleado_cedula = '$user'";
        $result = $con->query($query);

        if($result->num_rows > 0){
            $row = $result ->fetch_array(MYSQLI_ASSOC);
            if (encrypt($pass, $key) == $row['contrasena']){
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user;
                $_SESSION['job'] = $row['cargo'];
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