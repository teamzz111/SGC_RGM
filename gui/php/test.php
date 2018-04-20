<?php
   session_start();
   global $host, $db, $pass, $key;
   $host = "localhost";
   $db = "bd";
   $pass = "";
   $key = "92AE31B89FEEB2A3"; //llave
   if(!isset($_SESSION['job']) || !isset($_SESSION['username']) || !isset($_SESSION['loggedin']) ){
     echo json_encode('Nothing');
     exit(0);
    }
    else if(!isset($_GET['srv']) && $_SESSION['job'] == 0){
      show(1, $host, $db, $pass, $key);
      exit(0);
    }
    switch($_GET['srv']){
      case 1:{
        show(1, $host, $db, $pass, $key);
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
        show(2, $host, $db, $pass, $key);
      }


    }


    function show($tipo, $host, $db,  $pass, $key){
        
        $con = new mysqli($host, "root", $pass, $db);
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
        $userr = $_SESSION['username'];
        $query = '';
        if($tipo == 1){
          $query = "SELECT empleado.nombre, empleado.apellido, empleado.cargo_idCargos FROM empleado WHERE empleado.cedula = $userr";
        }
        else if($tipo == 2) {
          $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, empleado.idCargos, empleado.idSeccional, empleado.sexo FROM empleado";
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
