<?php
    require_once("../../controllers/torneosController.php");
    $objTorneosController = new torneosController();
    //obtener el id desde el boton que mandara eliminar el registro
    $objTorneosController->delete($_GET['id']);
?>