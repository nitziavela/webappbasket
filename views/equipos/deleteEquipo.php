<?php
    require_once("../../controllers/equiposController.php");
    $objEquiposController = new equiposController();
    //obtener el id desde el boton que mandara eliminar el registro
    $objEquiposController->delete($_GET['id']);
?>