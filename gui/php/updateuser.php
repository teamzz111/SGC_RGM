<?php

if(isset($_GET['opt'])) {
    include 'test.php';
    $con = new mysqli($host, "root", $pass, $db);
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
            $query = "SELECT e.nombre, e.apellido, e.email, e.telefono, e.direccion, e.numero, e.sexo, e.idSeccional, c.nombre as cargo FROM empleado as e, cargo as c WHERE e.cargo_idCargos=c.idCargos and e.cedula =".$_GET['cc'];
            $resultado = $con->query($query);
           
            if ($resultado)
            {
                if($resultado->num_rows > 0)
                {
                    $array = array();
                    $count=0;
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $count++;
                        $array[] = array_map('utf8_encode', $fila);
                    }
                    if($count == 0 ) {
                        echo json_encode('error');
                        exit(0);
                    }
                    $res = json_encode($array, JSON_NUMERIC_CHECK);// se supone que esto es slo que tengo que mandar no? V: , si pero no existe
                    echo $res;
                }
                else
                {
                    echo json_encode("nel");
                }
            }
            else {
                echo json_encode('existe');
            }
        }
    }
    else if ($_GET['opt'] == 2)
    {
        
        //Modificar
        // BUSCA LA COSA $_GET['cc]
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
                $Seccional = $row3['idSeccional']; 
                $Gen ='m';
                if($Genero=='Hombre') {$Gen ='m';}
                if($Genero=='Mujer') {$Gen ='f';}
                if($Genero=='Otro') {$Gen ='o';}
                $cece = $_GET['cc'];
                $query = "UPDATE empleado SET nombre='$Nombre', apellido='$Apellido', email='$Correo', telefono=$Telefono, direccion='$Direccion', numero=$Numero,sexo='$Gen', idSeccional=$Seccional, cargo_idCargos=$Cargo WHERE cedula=$cece";
                $rs = $con->query($query);
                echo $rs;
                if ($rs) {
                    echo json_encode('true');
                } 
                else { 
                    echo json_encode('false'); 
                }
            }

    }
}

?> 