<?php
	include 'Security.php';

    session_start();
    $host = "localhost";
    $db = "bd";
    $pass = "";
    $key = "92AE31B89FEEB2A3"; //llave
    $con = new mysqli($host, "root", $pass, $db);

	$char='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$long=strlen($char);
	$j[0]=0;
	for($i=0;$i<9;$i++){
		$c=rand(0,$long);
		$n=0;
		$n=$char[$c];
		$j[0].=$n;
	}
	echo $j[0];
	$crip = encrypt($j[0],$key);

	if($con -> connect_error){
        die("Conexión errónea: " . $con->connect_error);
	}
	if($_GET['auth'] == 1){
        $user = $_POST['user'];
        $email = $_POST['email'];
        $query = "UPDATE 'cuenta' SET contrasena='$crip' WHERE empleado_cedula='$username'";
		
        $result = $con->query($query);

        if($result){
			<script language="javascript">
			alert("true");
			</script>
            
            }
            else{
				echo "false";
				<script language="javascript">
				alert("false");
				</script>
            }
        }
        else{
            echo "0";
        }
    }
    else{
        
    }





	/*
	otroooo
	
	$r = mysql_fetch_assoc($res);
		$username = $r['user'];
		$email = $r['email'];
		
		$usql = "UPDATE 'cuenta' SET contrasena='$crip' WHERE empleado_cedula='$username'";
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
		}*/
?>