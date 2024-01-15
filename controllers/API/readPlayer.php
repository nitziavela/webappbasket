<?php
	//Permitir acceso a todos
	header("Access-Control-Allow-Origin: *");
	//Decir que tu aplicacion contiene informacion en formato json con un charset utf-8
	header("Content-Type: application/json: charset=UTF-8");
	//Permitir solo el metodo POST
	header("Access-Control-Allow-Methods:_ POST");
	//El tiempo que caduca en segundos
	header("Access-Control-Max-Age: 3600");
	//Permitir los headers que anteriormente se crearon y otros para autorizaciones del navegador
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	require_once ('../../config/DataBase.php');
    require_once ('../../controllers/jugadoresController.php');

    $objJugadoresController = new jugadoresController();

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