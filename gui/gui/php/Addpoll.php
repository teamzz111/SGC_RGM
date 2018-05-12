<?php
    session_start();
    $inputJSON = file_get_contents('php://input');
    $input= json_decode( $inputJSON );
    echo $input[0][0];
?>