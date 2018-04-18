<?php
   session_start();
   $host = "localhost";
   $db = "bd";
   $pass = "";
   $key = "92AE31B89FEEB2A3"; //llave
   switch($_GET['srv']){
   if(!isset($_SESSION['job']) || !isset($_SESSION['username']) || !isset($_SESSION['loggedin']) ){
     echo json_encode('Nothing');
     exit(0);
    }
    else if(!isset($_GET['srv']) && $_SESSION['job'] == 0){
      show(1);
      exit(0);
    }
      case 1:{
        show(1);
        break;
      }

      case 2: {
        session_unset();
        session_destroy();
        echo json_encode('true');
        break;
      }

      case 3: {
        echo json_encode('true');
        exit(0);
      }
      case 4: {
        show(2);
      }


    }


    function show($tipo){
        
        $con = new mysqli($host, "root", $pass, $db);
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
        $userr = $_SESSION['username'];
        $query = '';
        if($tipo == 1){
          $query = "SELECT cuenta.idCuenta, empleado.nombre, empleado.apellido, cuenta.cargo FROM cuenta, empleado WHERE empleado.cedula = '$userr' AND empleado.cedula = cuenta.empleado_cedula";
        }
        else if($tipo == 2) {
          $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, cuenta.cargo, empleado.seccional_idSeccional, empleado.sexo FROM empleado, cuenta WHERE empleado.cedula = cuenta.empleado_cedula";
        }

        $rs = $con->query($query);
        $array = array();
        $count = 0;
        if ($rs) {
            $array = array();
            while ($fila = mysqli_fetch_assoc($rs)) {
                $count++;
                $array[] = array_map('utf8_encode', $fila);
            }
            if($count == 0 ) {
              echo json_encode('error');
              exit(0);
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
