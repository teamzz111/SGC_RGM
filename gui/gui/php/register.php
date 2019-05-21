<?php

include '../../../Conexion.php';
include '../../../Security.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(!isset($_GET['opt'])) {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);

        $Cedula = $input['cedula'];
        $Nombre = $input['nombre'];

        $Apellido = $input['apellido'];

        $Correo = $input['correo'];
        $Telefono = $input['telefono'];
        $Direccion = $input['direccion'];
        $Numero = $input['numero'];

        $Genero = $input['genero'];

        $Cargo = $input['cargo'];
        $Seccional = $input['seccional']; 

        $con = new mysqli($host, $user, $pass, $db);
        $con->query("SET NAMES 'utf8'");
        if ($con->connect_error) {
            echo json_encode('falseC');
        }
        $query1="SELECT * FROM empleado WHERE cedula=".$Cedula;
        $resultado = $con ->query($query1);

        if ($resultado->num_rows>0) {
            echo json_encode('nel');
        }
        else{
            $query = "SELECT idCargos FROM cargo WHERE nombre = '$Cargo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Cargo = $row['idCargos'];

            $query3 = "SELECT idSeccional FROM seccional WHERE ciudad = '$Seccional'";
            $resultado3 = $con->query($query3);
            $row3 = $resultado3->fetch_array(MYSQLI_ASSOC);
            $Seccional1 = $row3['idSeccional'];


            $Gen ='m';
            if($Genero=='Hombre') {$Gen ='m';}
            if($Genero=='Mujer') {$Gen ='f';}
            if($Genero=='Otro') {$Gen ='o';}

            $query = "INSERT INTO `empleado` VALUES ($Cedula, '$Nombre', '$Apellido', '$Correo', $Telefono, '$Direccion', $Numero, '$Gen', $Seccional1, $Cargo)";
            $rs = $con->query($query);
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
        
			                          
			try {
                $mail = new PHPMailer(true);    
				$mail->SMTPDebug = 0;                               
				$mail->isSMTP();                                 
				$mail->Host = '	mx1.hostinger.co';  			
				$mail->SMTPAuth = true;                              
				$mail->Username = 'support@sgc.andreslargo.com';             
				$mail->Password = 'LrQ2KSSeJ6El';
				$mail->SMTPSecure = 'tls';                          
				$mail->Port = 587;        
				$mail->CharSet = 'UTF-8';
				$mail->setFrom('support@sgc.andreslargo.com', 'Sistema SGC');
				$mail->addAddress($Correo);
				$mail->AddEmbeddedImage('../dist/assets/img/sgc.png', 'logo_2u');
				$mail->isHTML(true);                           
				$mail->Subject = 'Registro exitoso';
                $mail->Body = " 

                <html>

                <body style= \"background: #000; color: #fff; padding: 19px; text-align: center;\">
                    <header style =\"font-family:\'Sans Serif\';\">
                        <img style = \"max-width: 250px;\" src='cid:logo_2u' />
                        <h1 style= \" color: #ffffff; font-size:22px;\">
                            <strong style= \"color: #ffffff;\">¡Enhorabuena</strong> $Nombre $Apellido!<br><br>
                        Con el documento $Cedula has sido registrado exitosamente en nuestro sistema.</h1>
                    </header>

                    <main style= \"color: #fff; font-size: 22px;\">
                        <h3 style= \"color: #fff; font-size: 22px;\">
                            Al iniciar sesión te pedimos que cambies tu contraseña por seguridad.
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
				$mail->AltBody = "¡Bienvenido $Nombre! a SGC";

				$mail->send();


                $query1= "INSERT INTO `cuenta` VALUES ('$crip','Activo',$Cedula)";
                
                $result = $con->query($query1);

                if ($result && $rs) {
                echo json_encode('true2');
                }
            } catch (Exception $e) {
				echo json_encode('false');
			}
        }
    }


else{
    include 'test.php';
    $query;
    if($_GET['opt'] == 1) {
        $query = "SELECT nombre, nivel FROM cargo";
    }
    else{
        $query = "SELECT ciudad, pais FROM seccional";
    }
    $con = new mysqli($host, $user, $pass, $db);
    $rs = $con->query($query);
    $array = array();
    $count = 0;
    if ($rs) {
        $array = array();
        while ($fila = mysqli_fetch_assoc($rs)) {
            $count++;
            $array[] = array_map('html_entity_decode', $fila);
        }
        if($count == 0 ) {
            echo json_encode('error');
            exit(0);
        }
        $res = json_encode($array, JSON_NUMERIC_CHECK);
    }else{
        $res = null;
        echo $con->error;
        }
    mysqli_close($con);
    echo $res;

}

?>
