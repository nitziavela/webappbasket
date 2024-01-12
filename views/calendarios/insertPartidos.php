<?php 
    require_once('../../controllers/calendarioController.php');
    $objController = new calendarioController();

    $equipo_local = $_POST['equipo_local'];
    $equipo_visitante = $_POST['equipo_visitante'];

    $objController->insert($equipo_local, $equipo_visitante);

?>