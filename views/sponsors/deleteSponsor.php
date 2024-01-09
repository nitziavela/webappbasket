<?php
    require_once("../../controllers/sponsorController.php");
    $objSponsorController = new sponsorController();
    
    //obtener el id desde el boton que mandara eliminar el registro
    $objSponsorController->delete($_GET['id']);
?>