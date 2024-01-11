<?php 
    require_once("../../controllers/calendarioController.php");
    $objCalendariosController = new calendarioController();

    $id = $_POST['idroles'];
    $jornadas = $_POST['jornadas'];
    $torneo = $_POST['torneos'];

    $roles = $objCalendariosController->updateRol($id, $jornadas, $torneo); 
?>
