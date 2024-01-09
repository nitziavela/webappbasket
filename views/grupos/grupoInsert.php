<?php 
    require_once('../../controllers/gruposController.php');

    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $torneo = $_POST['torneo'];

    $objController = new grupoController();
    $objController->insert($nombre, $categoria, $torneo);
?>