<?php
    require_once("../../controllers/gruposController.php");
    $objGruposController = new grupoController();
    //obtener el id desde el boton que mandara eliminar el registro
    $objGruposController->delete($_GET['id']);
?>