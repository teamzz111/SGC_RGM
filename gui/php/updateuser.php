<?php

if(isset($_GET['opt'])) {
    include 'test.php';
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    if($_GET['opt'] == 1)
    {
        //llenar campos 
        if(!isset($_GET['cc']))
        {
            echo json_encode('Nothing');
        }
        else
        {
            $query = "SELECT * FROM empleado WHERE cedula =".$_GET['cc'];
            $resultado = $con->query($query);
            if ($resultado)
            {
                if($resultado->num_rows > 0)
                {
                    $array = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $count++;
                        $array[] = array_map('utf8_encode', $fila);
                    }
                    if($count == 0 ) {
                        echo json_encode('error');
                        exit(0);
                    }
                    $res = json_encode($array, JSON_NUMERIC_CHECK);
                }
                else
                {
                    echo json_encode("nel");
                }
            }
           
        }
    }
    else if ($_GET['opt'] == 2)
    {
        
        //Modificar
        // BUSCA LA COSA $_GET['cc]
    }
}

?> 