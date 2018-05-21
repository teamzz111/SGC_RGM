<?php
    $user = $_POST['fname'];
    $mail = $_POST['textarea'];
    $titulo = "MENSAJE DE USUARIO";
    $correo = $_POST['lname'];
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $headers .= "From: '$user' < '$correo' >\r\n";
    //Enviamos el mensaje a tu_dirección_email 
    $bool = mail("support@sgc.andreslargo.com",$titulo,$mail,$headers);
    if($bool){
        echo "true";
    }else{
        echo "false";
    }
?>