<?php
    include '../Security.php';
    include '../Conexion.php';

    session_start();

    if($_GET['auth'] == 1){

        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = "SELECT cuenta.contrasena, empleado.cargo_idCargos, cargo.nivel FROM cuenta, empleado, cargo WHERE cuenta.cedula = $user AND empleado.cedula = $user AND empleado.cargo_idCargos = cargo.idCargos AND cuenta.contrasena ='". encrypt($pass, $key)."'";

        $result = $con->query($query);

        if($result->num_rows > 0){
            $row = $result ->fetch_array(MYSQLI_ASSOC);
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user;
                $_SESSION['job'] = $row['nivel'];
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
