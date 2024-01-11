<?php
    require_once('../../controllers/calendarioController.php');
    $objController = new calendarioController;

    $jornadas = $_POST['jornadas'];
    $torneo = $_POST['torneos'];

    $objController->insertRol($jornadas, $torneo)

?>