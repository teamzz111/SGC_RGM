<?php
	
	require 'conexion.php';
	$mysqli = new mysqli($host, $user, $pass, $db);
	$mysqli->query("SET NAMES 'utf8'");
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$estado_civil = $_POST['estado_civil'];
	$hijos = isset($_POST['hijo']) ? $_POST['hijos'] : 0;
	$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : null;
	
	$arrayIntereses = null;
	
	$num_array = count($intereses);
	$contador = 0;
	
	if($num_array>0){
		foreach ($intereses as $key => $value) {
			if ($contador != $num_array-1)
			$arrayIntereses .= $value.' ';
			else
			$arrayIntereses .= $value;
			$contador++;
		}
	}

	$idDocumento="Esto es malo";
	global $resultado;
	do{
		$char='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$long=strlen($char)-1;
		$j[0]=0;
		for($i=0;$i<6;$i++){
			$c=rand(0,$long);
			$n=$char[$c];
			$j[0].=$n;
		}
		$idDocumento = $j[0];
		$query1="SELECT * FROM documento WHERE idDocumento = '$idDocumento'";
		$resultado = $mysqli->query($query1);
		echo $mysqli->error;
	}
	while ($resultado->num_rows > 0  || $idDocumento =='Esto es malo'); 
	
	$hoy = getdate();
	$feh = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];
	
	$sql = "INSERT INTO Documento  VALUES ($idDocumento,'$nombre', '$hijos','$feh',null,null,'telefono')";
	$resultado = $mysqli->query($sql);
	$id_insert = $mysqli->insert_id;
	
	if($_FILES["archivo"]["error"]>0){
		echo "Error al cargar archivo";	
		} else {
		
			$permitidos = array("applicationvnd.ms-excel","application/msword","application/pdf");
		
		
		if(in_array($_FILES["archivo"]["type"], $permitidos) ){
			
			$ruta = 'files/';
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
			echo "Archivo no permitido o excede el tamaño";
		}
		
	}
	
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					
					<a href="index.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>
