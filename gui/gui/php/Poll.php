<?php
include 'Conexion.php';
session_start();
if($_GET['opt'] == 1) {
    $inputJSON = file_get_contents('php://input');
    $result = json_decode($inputJSON, true);
    $con = new mysqli($host, $user, $pass, $db);
    $con->query("SET NAMES 'utf8'");
    $Fecha= $input['fecha'];
    $Administrador = $input['administrador'];
    $Coordinador =$input['coordinador'];
    $Lider = $input['liderdeproceso'];
    $Usuario = $input['usuario'];

    if (($_SESSION['job']==1 && $Administrador== 'true'||($_SESSION['job']==2 && $Coordinador== 'true')||
    ($_SESSION['job']==3 && $Lider== 'true')||($_SESSION['job']==4 && $Usuario== 'true')))
    {
        $query = "SELECT *  FROM Encuesta WHERE Fecha = '$Fecha' ";
        $resultado = $con->query($query); 

        if ($resultado)
        {
            if($resultado->num_rows > 0)
            {
                $array = array();
                while ($fila = mysqli_fetch_assoc($resultado)) {

                    $array[] = array_map('html_entity_decode', $fila);
                }
                $res = json_encode($array, JSON_UNESCAPED_UNICODE); 
            }
            else
            {
                $res=null;
                echo json_encode("nel");
            }
            
        }
        mysqli_close($con);
        echo $res;
    }
}
    else if ($_GET['opt'] == 2)
    {
        $inputJSON = file_get_contents('php://input');
        $result = json_decode($inputJSON, true);
        
        $con = new mysqli($host, $user, $pass, $db);
        $con->query("SET NAMES 'utf8'");
        $Id= $input['id'];
        
        $query = "SELECT Pregunta, Numero, Respuesta1, Respuesta2, Respuesta3, Respuesta4, Respuesta5  FROM Pregunta     WHERE idEncuesta='$Id'";
        $resultado = $con->query($query);
        if ($resultado)
        {
            if($resultado->num_rows >0)
            {
                $array = array();
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $array[] = array_map('html_entity_decode', $fila);
                }
                $res = json_encode($array, JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $res=null;
                echo json_encode("nel");
            }
        }
        mysqli_close($con);
        echo $res;
    }


?>
