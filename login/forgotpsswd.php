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
			$con->query("UPDATE cuenta SET contrasena='$crip' WHERE cedula=$user");
			echo "<br>";
			echo $crp." es la nueva clave de acceso.";
			echo "UPDATE cuenta SET contrasena='$crip' WHERE empleado_cedula=$user";
			echo "<br>";
			echo $crip." es su encriptacion.";
		}
		else{
			echo "Usuario no encontrado.";
		}
		
	}
    
?>