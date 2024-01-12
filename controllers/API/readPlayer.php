<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json: charset=UTF-8");
	header("Access-Control-Allow-Methods:_ POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	require_once ('../../config/DataBase.php');
    require_once ('../../controllers/jugadoresController.php');

	$objBaseDatos = new Database();
    $objJugadoresController = new jugadoresController();

	$db = $objBaseDatos->connect();
	$jugador = $objJugadoresController->readOne($_GET['id']);
    if($jugador){
		// Crear arreglo con los valores
		$emp_arr = array(
            'idjugadores' => $jugador['idjugadores'],
            'nombre' => $jugador['nombre'],
            'apellido1' => $jugador['apellido1'],
            'apellido2' => $jugador['apellido2'],
            'fechanac' => $jugador['fecha_nac'],
            'correo' => $jugador['correo'],
            'tipo_sangre' => $jugador['tipo_sangre'],
            'contacto_emergencia' => $jugador['contacto_emergencia'],
            'fotografia' => $jugador['fotografia'],
            'triples' => $jugador['triples'],
            'dobles' => $jugador['dobles'],
            'faltas' => $jugador['faltas'],
            'posicion' => $jugador['posicion'],
            'nombre_equipo' => $jugador['nombre_equipo']

		);
		http_response_code(200);
		echo json_encode($emp_arr);
	}else{
		http_response_code(404);
		echo json_encode("Jugador no encontrado... ");
	}
?>