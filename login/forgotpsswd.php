<?php
	include 'Security.php';

    session_start();
   $host = "localhost";
   $db = "u462448961_bd";
   $pass = "nicky246";
   $user = "u462448961_teamz";
	$con = new mysqli($host, $user, $pass, $db);
	

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
			$con->query("UPDATE cuenta SET contrasena='$crip' WHERE cedula=$user");
			/*
			echo $crp." es la nueva clave de acceso.";
			echo "<br>";
			echo $crip." es su encriptacion.";
			*/ 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From: '$user' < '$correo' >\r\n";
			//Enviamos el mensaje a tu_dirección_email 
			$bool = mail("support@sgc.andreslargo.com",$titulo,$mail,$headers);
			
			$titulo = "RECOVERY PASSWORD";
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From: 'Recovery' < 'support@sgc.andreslargo.com' >\r\n";
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