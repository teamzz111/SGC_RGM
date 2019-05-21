<?php
    include '../../../Conexion.php';

   session_start();

   if(!isset($_SESSION['job']) || !isset($_SESSION['username']) || !isset($_SESSION['loggedin']) ){
     echo json_encode('Nothing');
     exit(0);
    }
    else if(!isset($_GET['srv']) && $_SESSION['job'] == 0){
      show(1, $host, $db, $pass, $user, $key);
      exit(0);
    }
    else if(!isset($_GET['srv'])){

    }
    else{
        switch($_GET['srv']){
            case 1:{
                show(1, $host, $db, $pass, $user, $key);
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
                show(2, $host, $db, $pass, $user, $key);
                break;
            }
            case 6:{
                break;
            }
            case 7: {
                show(3, $host, $db, $pass, $user, $key);
                break;
            }
            case 8: {
                show(4, $host, $db, $pass, $user, $key);
                break;
            }
        }
    }

    function show($tipo, $host, $db,  $pass, $user, $key){
        global $a;
        $a = 0;
        $con = new mysqli($host, $user, $pass, $db);
        header('Content-Type: text/html; charset=UTF-8');
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
        $userr = $_SESSION['username'];
        $query = '';
        
        $con->query("SET NAMES 'utf8'");
        if($tipo == 1){
          $query = "SELECT empleado.nombre, empleado.apellido, empleado.cargo_idCargos, cargo.nivel FROM empleado, cargo WHERE empleado.cedula = $userr AND empleado.cargo_idCargos = cargo.idCargos";
          $rs = $con->query($query);
        }
        else if($tipo == 2) {
          $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, empleado.cargo_idCargos, empleado.idSeccional, empleado.sexo FROM empleado";
          $rs = $con->query($query);
        }
        else if(isset($_GET['cc']) && $tipo == 3){
            $asd = $_GET['cc'];
            $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, empleado.cargo_idCargos, empleado.idSeccional, empleado.sexo  FROM empleado, cuenta WHERE empleado.cedula = ".$asd;
            $a = 2;
        }
        else if($tipo == 3) {
            $userr = $_SESSION['username'];
            $query;
            $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, empleado.cargo_idCargos, empleado.idSeccional, empleado.sexo  FROM empleado, cuenta WHERE (";
            $a = 0;
            if ($_GET['opt1'] == 1) {
                $query = $query . " empleado.cargo_idCargos = 4";
                $a = 1;
            }
            if ($_GET['opt2'] == 1) {
                if ($a == 0) {
                    $query = $query . " empleado.cargo_idCargos = 2";
                    $a = 1;
                } else {
                    $query = $query . " OR empleado.cargo_idCargos = 2";
                }
            }
            if ($_GET['opt3'] == 1) {
                if ($a == 0) {
                    $query = $query . " empleado.cargo_idCargos = 1";
                    $a = 1;
                } else {
                    $query = $query . " OR empleado.cargo_idCargos = 1";
                }

            }
            if ($_GET['opt4'] == 1) {
                if ($a == 0) {
                    $query = $query ." empleado.cargo_idCargos = 3";
                    $a = 1;
                } else {
                    $query = $query . " OR empleado.cargo_idCargos = 3";
                }

            }
            if ($_GET['opt1'] == 0 && $_GET['opt2'] == 0 && $_GET['opt3'] == 0 && $_GET['opt4'] == 0) {
                echo json_encode('errorn');
                exit(0);
            }
        }
        else if ($tipo == 4){
            echo json_encode($_SESSION['job']);
            exit(0);
        }
        if($tipo == 3){
            if ($a == 0) {
                $rs = $con->query($query." cuenta.cedula = empleado.cedula)");
            } else if($a == 1) {
                $rs = $con->query($query." ) AND cuenta.cedula = empleado.cedula");
            } else{
                $rs = $con->query($query . " AND cuenta.cedula = empleado.cedula");
            }
        }
    
    $array = array();
    $count = 0;
    if ($rs) {
        $array = array();
        while ($fila = mysqli_fetch_assoc($rs)) {
            $count++;
            $array[] = array_map('html_entity_decode', $fila);
            }
            if($count == 0 ) {
              echo json_encode('error');
              exit(0);
            }
            $res = json_encode($array, JSON_UNESCAPED_UNICODE);
        }else{
            $res = null;
            echo mysqli_error($con);
        }
        mysqli_close($con);
        echo $res;
    }
?>
