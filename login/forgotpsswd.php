<?php
    include 'Security.php';

    session_start();
   $host = "localhost";
   $db = "u462448961_bd";
   $pass = "nicky246";
   $user = "u462448961_teamz";
    $key = "92AE31B89FEEB2A3"; //llave
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
			echo $crip." es su encriptacion.\";
			*/ 
			$titulo = "RECOVERY PASSWORD";
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			$headers .= "From: 'Recovery' < 'support@sgc.andreslargo.com' >\r\n";
			$mail = \"<html>
			<head>
			  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			  <style>
				@charset \\"UTF-8\\";
		  * {
			box-sizing: border-box;
			margin: 0;
		  }
		  
		  @font-face {
			  font-family: \"Sans\";
			  src: url(\"../fuentes/Sans/OpenSans-Light.ttf\") format(\"truetype\");
			  font-weight: 300;
			  font-style: normal;
			}
		  
			header {
			  position: fixed;
			  background: black;
			  width: 80%;
			  height: 70px;
			  margin:0% 0% 10% 10%;
			}
		  
			main {
				position: fixed   ;
				margin:80px 0% 10% 10%;
				padding: 4% 4% 10% 10%;
				width: 80%;
				height: 73%;
				font: 1em sans-serif;
				text-align: center;
				border: solid 1px black;
			}
		  
			main .psswd{
				color: black;
				font: 2em \"Amaranth\";
				padding: 10px;
				border: solid 1px black;
				text-align: center;
			}
		  
			footer{
			  position: absolute;
			  color: white;
			  background: black;
			  width: 80%;
			  height: 80px;
			  right: 10%;
			  bottom: 0;
			  left: 10%;
			  align-content: center;
			  text-align: center;
			  font: 1em \"Amaranth\";
			}
			  </style>
			  </head>
			  <body>
				<header id=\"heaader\">
				  <nav class=\"normal\">
					<ul>
					  <div class=\"izq\">
						<li class=\"a2\">
						  <a href=\"http://www.andreslargo.com/sgc\">
							<img src=\"sgc.png\" alt=\"\">
						  </a>
						</li>
					  </div>
					</ul>
				  </nav>
				</header>
				<main id=\"main\">
				  <nav class=\"normal\">
					<p>
					  Reset your Password
					</p>
					<br>
					<br>
					<br>
					<br>
					<p>
					  Hemos recibido una solicitud para reestablecer tu contraseña.
					</p>
					<br>
					<br>
					<p>
					  Tu nueva contraseña es: 
					</p>
					<br>
					<span class=\"psswd\">
						$crp
					</span>
					<br>
					<br>
					<br>
					<p>
					  Te recomendamos cambiarla en el momento de ingresar al sistema.
					</p>
					<br>
					<br>
					<a href=\"http://www.andreslargo.com/sgc/login.html\">Iniciar Sesión</a>
				  </nav>
				</main>
				<footer id=\"footer\">
					<br> Todos los derechos reservados.
					<br> <a href=\"http://www.andreslargo.com/sgc\">www.andreslargo.com/sgc</a>
					<br> Copyright 2018
				</footer>
			  </body>
		  </html>";
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