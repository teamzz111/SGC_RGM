<?php
	include 'Security.php';

    session_start();
    $host = "localhost";
    $db = "bd";
    $pass = "";
    $key = "92AE31B89FEEB2A3"; //llave
	$con = new mysqli($host, "root", $pass, $db);
	

	$char='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$long=strlen($char)-1;
	$j[0]=0;
	for($i=0;$i<9;$i++){
		$c=rand(0,$long);
		$n=$char[$c];
		$j[0].=$n;
	}
	$crp = $j[0];
	$crip = encrypt($j[0],$key);

	$user = $_POST['user'];
	$email = $_POST['email'];
	$query = $con->query("SELECT email FROM empleado WHERE cedula ='$user'");

	while($r = $query -> fetch_array(MYSQLI_ASSOC)){
		if($r['email'] == $email){
			$con->query("UPDATE cuenta SET contrasena='$crip' WHERE empleado_cedula=$user");
			/*
			echo "<br>";
			echo $crp." es la nueva clave de acceso.";
			echo "<br>";
			echo $crip." es su encriptacion.";
			*/ 
			$titulo = "RECOVERY PASSWORD";
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From: 'Recovery' < 'andresf-largor@unilibre.edu.co' >\r\n";
			$mail = "include("email-recovery/email.html")".$crp;
			//Enviamos el mensaje a tu dirección de email 
			$bool = mail($email,$titulo,$mail,$headers);
			if($bool){
				echo "true";
			}else{
				echo "false";
			}



		}
		else{
			echo "false";
		}
		
	}
    
?>