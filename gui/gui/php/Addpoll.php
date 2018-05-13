<?php
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        if($_GET['opt'] == 1){
            //echo $result['nombre'];
            //echo $result['tipo']; ahí tienes los dos datos.
        } else if ($_GET['opt'] == 2){
             echo json_encode($result['r1']);
        }
        
    }
?>