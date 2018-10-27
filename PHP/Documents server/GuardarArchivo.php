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

	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";	
		} else {
		
		$permitidos = array("applicationvnd.ms-excel","application/msword","application/pdf");
	
		
		if(in_array($_FILES["archivo"]["type"], $permitidos) ){
			
			$ruta = 'documento/'.$Proceso.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				
				if($resultado){
					echo "Archivo Guardado";
					} else {
					echo "Error al guardar archivo";
				}
				
				} else {
				echo "Archivo ya existe";
			}
			
			} else {
			echo "Archivo no permitido";
		}
		
	}
	
?>

   
    mysqli_close($con);
}
   


?>      
