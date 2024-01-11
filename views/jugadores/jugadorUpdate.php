<?php
    require_once("../../controllers/jugadoresController.php");

    $objController = new jugadoresController();

    $id = $_POST['idJugador'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellidopaterno'];
    $apellido2 = $_POST['apellidomaterno'];
    $fechanac = $_POST['fechanac'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $tipo_sangre = $_POST['tipo_sangre'];
    if(!empty($_FILES['foto']['name'])){  
        $fotografia = $_FILES['foto'];
    } else{
        $fotografia = $_POST['nombre_foto'];
    }
    $equipo = $_POST['equipo'];
    $posicion = $_POST['posicion'];

    $objController->update($id,$nombre,$apellido1,$apellido2,$fechanac,$correo, $celular, $tipo_sangre,$fotografia, $equipo, $posicion);
?>