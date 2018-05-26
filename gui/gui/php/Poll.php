<?php
include 'Conexion.php';
session_start();
if($_GET['opt'] == 1) {
    $inputJSON = file_get_contents('php://input');
    $result = json_decode($inputJSON, true);
    $con = new mysqli($host, $user2, $pass2, $db2);
    $con->query("SET NAMES 'utf8'");

    $hoy = getdate();
    $feh = $hoy['year']."-".$hoy['mon']."-".$hoy['mday'];

    if ($_SESSION['job']==1)
    $query = "SELECT *  FROM Encuesta WHERE FechaCierre > '$feh' AND Cargo = 'true' ";
    else if ($_SESSION['job']==2)
    $query = "SELECT *  FROM Encuesta WHERE FechaCierre > '$feh' AND Cargo2 = 'true' ";
    else if ($_SESSION['job']==3)
    $query = "SELECT *  FROM Encuesta WHERE FechaCierre > '$feh' AND Cargo3 = 'true' ";
    else if ($_SESSION['job']==4)
    $query = "SELECT *  FROM Encuesta WHERE FechaCierre > '$feh' AND Cargo4 = 'true' ";

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
