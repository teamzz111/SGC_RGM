<?php
	include 'Security.php';

    session_start();
    $host = "localhost";
    $db = "bd";
    $pass = "";
    $key = "92AE31B89FEEB2A3"; //llave
    $con = new mysqli($host, "root", $pass, $db);

	$password = rand(999,99999);
	$password_hash = md5($pass);

	$r = mysql_fetch_assoc($res);
		$username = $r['user'];
		$email = $r['email'];
		
		$usql = "UPDATE 'cuenta' SET contrasena='$password_hash' WHERE empleado_cedula=´$username´";
		$result = mysqli_query($connection, $usql);
		if($result){
			$mail = "Prueba de mensaje";
			//Titulo
			$titulo = "PRUEBA DE TITULO";
			//cabecera
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			//dirección del remitente 
			$headers .= "From: Geeky Theory < jamorales516@icloud.com >\r\n";
			//Enviamos el mensaje a jamorales516@icloud.com
			$bool = mail("jamorales516@icloud.com",$titulo,$mail,$headers);
			if($bool){
				echo "Mensaje enviado";
			}else{
				echo "Mensaje no enviado";
			}
		}
?>