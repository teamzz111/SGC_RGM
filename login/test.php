<?php
   session_start();
    $host = "localhost";
    $db = "bd";
    $pass = "nicky246";
    $key = "92AE31B89FEEB2A3"; //llave
    if(!isset($_GET['option']) && $_SESSION['job'] != 0 || isset($_GET['option']) && $_SESSION['job'] != 0){
            echo 'Nothing.';
    }
    if($_GET['option'] == 1){
        show();
    }

    function show(){
        $con = new mysqli($host, "root", $pass, $db);
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
        $userr = $_SESSION['username'];
        $query = "SELECT cuenta.idCuenta, empleado.nombre, empleado.apellido, cuenta.cargo FROM Cuenta, empleado WHERE empleado.cedula = '$userr' AND empleado.cedula = Cuenta.Empleado_cedula";
        
        $rs = $con->query($query);
        $array = array();
        if ($rs) {
            $array = array();
            while ($fila = mysqli_fetch_assoc($rs)) {	
                $array[] = array_map('utf8_encode', $fila);
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