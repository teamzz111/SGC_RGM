<?php
    include 'test.php';
    $con = new mysqli($host, $user, $pass, $db);
    global $query;
    $query = "";
    if($_GET['opt'] == 1 && isset($_GET['cc'])){
        $rs = $con->query("SELECT estado FROM cuenta WHERE cedula =".$_GET['cc']);
        if($rs){
            if($rs -> num_rows > 0){
                $a = $rs->fetch_array(MYSQLI_ASSOC);
                echo json_encode($a['estado']);
                exit(0);
            }
            else{
                echo json_encode('no');
            }
        }
        else{
            echo json_encode('nel');
        }
    }
    else if ($_GET['opt'] == 2)  {
        $query = "UPDATE cuenta SET estado = 'Desactivado'  WHERE cedula =".$_GET['cc'];
    }
    else {
        $query = "UPDATE cuenta SET estado = 'Activo'  WHERE cedula =".$_GET['cc'];
    }
    $rs = $con->query($query);
    echo json_encode('exito');
    /*if($rs){
        json_encode('true');
    }
     else {
        echo json_encode('nel');
    }*/

?>