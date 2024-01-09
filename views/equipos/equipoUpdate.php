<?php
    require_once("../../controllers/equiposController.php");

    $objController = new equiposController();

    $id = $_POST['idEquipo'];
    $nombre = $_POST['nombre'];
    $nombrecapitan = $_POST['nombrecapitan'];
    $correocapitan = $_POST['correocapitan'];
    $telefonocapitan = $_POST['telefonocapitan'];
    $torneos = $_POST['torneos'];
    if($_FILES){  
        $logo = $_FILES['logo'];
    } else{
        $logo = $_POST['nombre_logo'];
    }

    $objController->update($id,$nombre,$nombrecapitan,$correocapitan,$telefonocapitan,$logo, $torneos);
?>