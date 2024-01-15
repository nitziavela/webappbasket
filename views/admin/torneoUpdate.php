<?php
    require_once("../../controllers/torneosController.php");

    $objController = new torneosController();
    
    $id = $_POST['idtorneo'];
    $nombreTorneo = $_POST['txtNombreTorneo'];
    $organizador = $_POST['txtOrganizador'];
    $sede = $_POST['txtSede'];
    $patrocinadores = $_POST['patrocinadores'];
    $categoria = $_POST['txtCategoria'];
    $premio1 = $_POST['txtPremio1'];
    $premio2 = $_POST['txtPremio2'];
    $premio3 = $_POST['txtPremio3'];
    $otroPremio = $_POST['txtOtroPremio'];

    $objController->updateTorneo($id,$nombreTorneo,$organizador,$sede,$categoria,$premio1,$premio2,$premio3,$otroPremio);
?>