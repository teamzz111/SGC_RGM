<?php
    $inputJSON = file_get_contents('php://input');
    $result = json_decode($inputJSON, true);
    //echo $result['nombre'];
    //echo $result['tipo']; ahí tienes los dos datos.

?>