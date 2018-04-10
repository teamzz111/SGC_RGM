<?php
   session_start();

   if(!isset($_SESSION['job']) || !isset($_SESSION['username']) || !isset($_SESSION['loggedin']) ){
     echo json_encode('Nothing');
     exit(0);
    }
    else if(!isset($_GET['srv']) && $_SESSION['job'] == 0){
      show();
      exit(0);
    }
    switch($_GET['srv']){
      case 1:{
        show();
        break;
      }

      case 2: {
        session_unset();
        session_destroy();
        echo json_encode('true');
        break;
      }
    }


    function show(){
      $host = "localhost";
      $db = "bd";
      $pass = "";
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
