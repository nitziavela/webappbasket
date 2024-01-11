<?php 
    require_once("../../controllers/calendarioController.php");
    $objCalendariosController = new calendarioController();

    $objCalendariosController->deleteRol($_GET['id']); 
?>