<?php
    require_once("../../controllers/usuariosController.php");
    $objUsuariosController = new usuarioController();
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    //obtener el id desde el boton que mandara eliminar el registro
    $objUsuariosController->updateUsuario($id, $nombre, $username, $password, $rol);
?>