<?php 

require_once("../../controllers/calendarioController.php");
    $objCalendariosController = new calendarioController();

    $objCalendariosController->delete($_GET['id']); 

?>