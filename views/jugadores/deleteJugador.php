<?php
    require_once("../../controllers/jugadoresController.php");
    $objJugadoresController = new jugadoresController();
    //obtener el id desde el boton que mandara eliminar el registro
    $objJugadoresController->delete($_GET['id']);
?>