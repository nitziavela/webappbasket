<?php
    require_once("../../controllers/gruposController.php");

    $objController = new grupoController();

    $id = $_POST['idGrupo'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $torneo = $_POST['torneos'];

    $objController->update($id,$nombre,$categoria, $torneo);
?>