<?php 
    require_once('../../controllers/usuariosController.php');

    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $objController = new usuarioController();
    $objController->agregarUsuario($nombre, $username, $password, $rol);
?>