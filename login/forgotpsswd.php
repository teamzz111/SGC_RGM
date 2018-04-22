<?php
	include 'Security.php';

    session_start();
    $host = "localhost";
    $db = "bd";
    $pass = "";
    $key = "92AE31B89FEEB2A3"; //llave
	mysql_connect($host,"root",$pass)or die (mysql_error());
	mysql_select_db($db)or die (mysql_error());

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
	$query = mysql_query("SELECT email FROM empleado WHERE cedula ='$user'")or die (mysql_error());
	while($r=mysql_fetch_array($query)){
		if($r[0] == $email){
			mysql_query("UPDATE cuenta SET contrasena='$crip' WHERE empleado_cedula='$user'")or die (mysql_error());
			echo "<br>";
			echo $crp." es la nueva clave de acceso.";
			echo "<br>";
			echo $crip." es su encriptacion.";
		}
		else{
			echo "Usuario no encontrado.";
		}
		
	}
    
?>