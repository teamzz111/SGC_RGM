<?php
    include 'Security.php';
    include 'Conexion.php';


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../PHPMailer/Exception.php';
	require '../PHPMailer/PHPMailer.php';
	require '../PHPMailer/SMTP.php';

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
	$query = $con->query("SELECT email, nombre FROM empleado WHERE cedula ='$user'");

	while($r = $query -> fetch_array(MYSQLI_ASSOC)){
		if($r['email'] == $email){
			$con->query("UPDATE cuenta SET contrasena='$crip', estado='Espera' WHERE cedula=$user");
			$mail = new PHPMailer(true);                   
			$nombre = $r['nombre'];
			try {
		
				$mail->SMTPDebug = 2;                           
				$mail->isSMTP();                            
				$mail->SMTPAuth = true;                               
				$mail->Username = 'contactsgc246@gmail.com';               
				$mail->Password = 'LrQ2KSSeJ6El';                          
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 587;
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);
				$mail->SMTPAuth = true;                             
				$mail->CharSet = 'UTF-8';
				$mail->setFrom('felipeflogxd@gmail.com', 'Sistema SGC');
				$mail->addAddress($email);          
				$mail->AddEmbeddedImage('../dist/assets/img/sgc.png', 'logo_2u');
				$mail->isHTML(true);                             
				$mail->Subject = '¿OLVIDASTE TU CONTRASEÑA?';
				$mail->Body = " 
				<html>
					<body style= \"background: #000; color: #fff; padding: 19px; text-align: center;\">
						<header style =\"font-family:\'Sans Serif\';\">
							<img style = \"max-width: 250px;\" src='cid:logo_2u' />
							<h1 style= \" color: #ffffff; font-size:22px;\">
								<strong style= \"color: #ffffff;\">¡Enhorabuena!</strong> $nombre <br><br>
							Hemos recibido tu solicitud para cambiar de contraseña.</h1>
						</header>

						<main style= \"color: ##FBF2EF; font-size: 22px; border: 1px;\">
							<h3 style= \"color: #fff; font-size: 22px;\">
								Al iniciar sesión te pediremos que cambies tu contraseña por seguridad.
								<br>
								Tu contraseña es:
								</h3>
								<br>
								<div style= \"width: 100%; max-width: 320px; margin: auto; border-radius: 5px; padding: 10px; background: #04FF00; color: #fff\">
									<b style = \"font-size: 22px;\">$crp</b>
								</div>
						</main>
						<br><br>
						<a style = \"font-size: 22px; background: black; color: white; border: 1px solid white; border-radius: 5px; padding: 10px; text-decoration: none; padding-right: 16px; padding-left: 16px; \" href = \"http://www.andreslargo.com/sgc/login.html\"> Inicia sesión </a>
						
						<p style = \"font-size: 22px; color: #fff;\">Cordialmente, SGC.</p>
					</body>

				</html>";
				$mail->AltBody = '¿Olvidaste tu contraeña?';
				$mail->send();
			} catch (Exception $e) {
				echo $e;
			}
		}
		else{
			echo "false";
		}

	}

?>
