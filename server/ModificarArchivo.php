<?php
include 'Conexion.php';
session_start();
if($_GET['opt'] == 1) {
    $inputJSON = file_get_contents('php://input');
    $result = json_decode($inputJSON, true);
    $con = new mysqli($host, $user2, $pass2, $db2);
    $con->query("SET NAMES 'utf8'");

    $Proceso = "Killmiplis";

    $hoy = getdate();
    $feh = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];

    $path = 'documento/'.$Proceso.'/';
    if(file_exists($path)){
        $directorio = opendir($path);
        while ($archivo = readdir($directorio))
        {
            if (!is_dir($archivo)){
                echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver Archivo Adjunto'><span class='glyphicon glyphicon-picture'></span></a>";
            }
        }
    }
							
		
	}
	mysqli_close($con);
}
   


?>     

   
    