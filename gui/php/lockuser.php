<?php
    include 'test.php';
    $con = new mysqli($host, $user, $pass, $db);
    if($_GET['opt'] == 1 && isset($_GET['cc'])){
        $rs = $con->query("SELECT estado FROM cuenta WHERE cedula =".$_GET['cc']);
        if($rs){
            if($rs -> num_rows > 0){
                $a = $rs->fetch_array(MYSQLI_ASSOC);
                echo json_encode($a['estado']);
            }
            else{
                echo json_encode('no');
            }
        }
        else{
            echo json_encode('nel');
        }
    }
    else{
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE); 
        $estado = $input['estado'];
        $cc = $input['cedula'];
        $rs = $con->query("UPDATE cuenta SET estado = $estado WHERE cedula = $cc");
    }
?>