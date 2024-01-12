<?php 

require_once("../../controllers/calendarioController.php");
$objController = new calendarioController();

$id = $_POST['idCalendario'];
$equipo_visitante = $_POST['equipo_visitante'];
$equipo_local = $_POST['equipo_local'];
$fecha_hora = $_POST['fecha_hora'];
$sede = $_POST['sede'];
$tipo_juego = $_POST['tipo_juego'];
$equipo_ganador = $_POST['equipo_ganador'];
$razon_ganador = $_POST['razon_ganador'];
$marcador_visitante = $_POST['marcador_visitante'];
$marcador_local = $_POST['marcador_local'];
$jornada = $_POST['jornada'];

$objController->update($id, $equipo_visitante, $equipo_local, $fecha_hora, $sede, $tipo_juego, 
$equipo_ganador, $razon_ganador, $marcador_visitante, $marcador_local, $jornada);

?>