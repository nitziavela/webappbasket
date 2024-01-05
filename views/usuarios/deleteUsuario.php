<?php
    require_once("../../controllers/usuariosController.php");
    $objUsuariosController = new usuarioController();

    //obtener el id desde el boton que mandara eliminar el registro
    $objUsuariosController->eliminarUsuario($_GET['id']);
?>