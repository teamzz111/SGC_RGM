<?php

include 'Connection/Conexion.php';
session_start();
if(isset($_GET['opt'])) {
 

    if($_GET['opt'] == 1)
    {
        //llenar campos
        if(!isset($_GET['cc']))
        {
            echo json_encode('Nothing');
        } else {
            //echo $_GET['cc'];
            if ($_GET['cc'] == -20){
                $query = "SELECT e.cedula, e.nombre, e.apellido, e.email, e.telefono, e.direccion, e.numero, e.sexo, e.idSeccional, c.nombre as cargo, s.ciudad as seccional FROM empleado as e, cargo as c, seccional as s WHERE e.cargo_idCargos=c.idCargos AND s.idSeccional = e.idSeccional and e.cedula =".$_SESSION['username'];
                
            
            }
            else {
                $query = "SELECT e.cedula, e.nombre, e.apellido, e.email, e.telefono, e.direccion, e.numero, e.sexo, e.idSeccional, c.nombre as cargo, s.ciudad as  seccional FROM empleado as e, cargo as c, seccional as s WHERE e.cargo_idCargos=c.idCargos AND s.idSeccional = e.idSeccional and e.cedula =".$_GET['cc'];
            }
            $resultado = $con->query($query);

            if ($resultado)
            {
                if($resultado->num_rows > 0)
                {
                    $array = array();
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                        $array[] = array_map('html_entity_decode', $fila);
                    }
                    $res = json_encode($array, JSON_NUMERIC_CHECK);// se supone que esto es slo que tengo que mandar no? V: , si pero no existe
                    echo $res;
                }
                else
                {
                    echo json_encode('false');
                }
            }
            else {
                echo $con->error;
            }
        }
    }
    else if ($_GET['opt'] == 2)
    {
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

            $query = "SELECT idCargos FROM cargo WHERE nombre = '$Cargo'";
            $resultado = $con->query($query);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
            $Cargo = $row['idCargos'];

            $query3 = "SELECT idSeccional FROM seccional WHERE ciudad = '$Seccional'";
            $resultado3 = $con->query($query3);
            $row3 = $resultado3->fetch_array(MYSQLI_ASSOC);
            $Seccional = $row3['idSeccional'];
            $Gen ='m';

            if($Genero=='Hombre') {$Gen ='m';}
            if($Genero=='Mujer') {$Gen ='f';}
            if($Genero=='Otro') {$Gen ='o';}
            $query = "UPDATE empleado SET nombre='$Nombre', apellido='$Apellido', email='$Correo', telefono=$Telefono, direccion='$Direccion', numero=$Numero,sexo='$Gen'  WHERE cedula=$Cedula";

            $rs = $con->query($query);
            if ($rs) {
                echo json_encode('true');
            }
            else {
                echo json_encode('false');
                }
            }

    }


?>
