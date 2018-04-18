<?php
    $host = "localhost";
    $db = "bd";
    $pass = "";
    if(isset($_GET['opt'])) {
        $con = new mysqli($host, "root", $pass, $db);
        if ($con->connect_error) {
            die("Conexión errónea: " . $con->connect_error);
        }
        $rs;
        $query;

        if( $_GET['opt'] == 1 ) {
            $query = "SELECT nombre, nivel FROM cargo";
        }
        else{
            $query = "SELECT seccional.ciudad, seccional.pais FROM seccional";
        }
        $rs = $con->query($query);
        if ($rs) {

            $array = array();
            while ($fila = mysqli_fetch_assoc($rs)) {
    
                $array[] = array_map('utf8_encode', $fila);
            }

            $res = json_encode($array, JSON_NUMERIC_CHECK);
        } else {
            $res = null;
            echo mysqli_error($con);
        }
        mysqli_close($con);
        echo $res;
    }
?>