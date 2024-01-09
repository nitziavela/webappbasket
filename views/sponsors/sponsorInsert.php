<?php 
    require_once('../../controllers/sponsorController.php');

    $nombre = $_POST['nombre'];
    $logo = $_FILES['logo'];

    $objController = new sponsorController();
    $objController->insert($nombre, $logo);
?>