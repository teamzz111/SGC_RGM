 <?php
    session_start();
    include 'test.php';
    $con = new mysqli($host, "root", $pass, $db);
        if($con -> connect_error){
            die("Conexión errónea: " . $con->connect_error);
        }
            $rs;
         $a = 0; 
        if($_GET['opt1'] == 10){
            $asd = $_GET['cc'];
            $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, cuenta.cargo, empleado.seccional_idSeccional, empleado.sexo  FROM empleado, cuenta WHERE empleado.cedula = ".$asd;
            $a = 2;
        }
        else {
            $userr = $_SESSION['username'];
            $query;
            $query = "SELECT empleado.cedula, empleado.nombre, empleado.apellido, empleado.email, empleado.telefono, empleado.direccion, empleado.numero, cuenta.cargo, empleado.seccional_idSeccional, empleado.sexo  FROM empleado, cuenta WHERE (";

            if ($_GET['opt1'] == 1) {
                $query = $query . " cuenta.cargo = 4";
                $a = 1;
            }
            if ($_GET['opt2'] == 1) {
                if ($a == 0) {
                    $query = $query . " cuenta.cargo = 2";
                    $a = 1;
                } else {
                    $query = $query . " OR cuenta.cargo = 2";
                }
            }
            if ($_GET['opt3'] == 1) {
                if ($a == 0) {
                    $query = $query . " cuenta.cargo = 1";
                    $a = 1;
                } else {
                    $query = $query . " OR cuenta.cargo = 1";
                }

            }
            if ($_GET['opt4'] == 1) {
                if ($a == 0) {
                    $query = $query . " cuenta.cargo = 3";
                    $a = 1;
                } else {
                    $query = $query . " OR cuenta.cargo = 3";
                }

            }
            if ($_GET['opt1'] == 0 && $_GET['opt2'] == 0 && $_GET['opt3'] == 0 && $_GET['opt4'] == 0) {
                echo json_encode('error no hay nada');
                exit(0);
            }
        }
            if ($a == 0) {
                $rs = $con->query($query . " cuenta.empleado_cedula = empleado.cedula)");
            } else if($a == 1) {
                $rs = $con->query($query . ") AND cuenta.empleado_cedula = empleado.cedula");
            }
            else{
            $rs = $con->query($query . " AND cuenta.empleado_cedula = empleado.cedula");
            }

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
    
?>