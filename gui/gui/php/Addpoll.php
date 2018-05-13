<?php
    if(isset($_GET['opt'])){
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        if($_GET['opt'] == 1){ // se registra encuesta
            echo json_encode($result['nombre']);
            
        } else if ($_GET['opt'] == 2){ //se registra pregunta
             if($result['nrespuesta'] == 0){ // es una respuesta abierta 
                 echo json_encode($result['pregunta']);
             }
            else { //es una pregunta con múltiple opción
                echo json_encode($result['r1']);
            }
        }
        
    }
?>