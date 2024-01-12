<?php
    require_once('../../controllers/calendarioController.php');
    $objController = new calendarioController;

    $jugador = $_POST['idjugador'];
    $torneo = $_POST['idtorneo'];
    $equipo = $_POST['idequipo'];
    $calendario = $_POST['calendario'];
    $jornada = $_POST['jornada'];
    $triples = $_POST['triples'];
    $dobles = $_POST['dobles'];
    $faltas = $_POST['faltas'];

    $objController->insertResultados($jugador, $torneo, $equipo, $calendario, $jornada, $triples, $dobles, $faltas);

?>