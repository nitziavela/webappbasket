<?php 
    require_once('../../controllers/equiposController.php');

    $nombre = $_POST['nombre'];
    $nombreCapitan = $_POST['nombreCapitan'];
    $correoCapitan = $_POST['correoCapitan'];
    $telefonoCapitan = $_POST['telefonoCapitan'];
    $torneos = $_POST['torneos'];
    $logo = $_FILES['logo'];

    $objController = new equiposController();
    $objController->insert($nombre, $nombreCapitan, $correoCapitan, $telefonoCapitan, $logo, $torneos);
?>