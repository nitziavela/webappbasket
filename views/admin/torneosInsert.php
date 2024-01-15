<?php
    require_once("../../controllers/torneosController.php");

    $nombreTorneo = $_POST['txtNombreTorneo'];
    $organizador = $_POST['organizadores'];
    $patrocinadores = $_POST['patrocinadores'];
    $sede = $_POST['txtSede'];
    $categoria = $_POST['txtCategoria'];
    $premio1 = $_POST['txtPremio1'];
    $premio2 = $_POST['txtPremio2'];
    $premio3 = $_POST['txtPremio3'];
    $otroPremio = $_POST['txtOtroPremio'];
    $usuario = $_POST['txtUsuario'];
    $contrasena = $_POST['txtContrasena'];

    $objController = new torneosController();

    $id = $objController->saveTorneo($nombreTorneo, $organizador, $sede, $categoria, 
    $premio1, $premio2, $premio3, $otroPremio, $usuario, $contrasena);
    
    foreach($patrocinadores as $patrocinador){
        $objController->saveSponsorsTorneo($id, $patrocinador, $usuario, $contrasena, $organizador);
     }
?>