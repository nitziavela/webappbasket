<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json: charset=UTF-8");
	header("Access-Control-Allow-Methods:_ POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	require_once ('../../config/DataBase.php');
    require_once ('../../controllers/equiposController.php');

	$objBaseDatos = new Database();
    $objEquiposController = new equiposController();

	$equipo = $objEquiposController->readOne($_GET['id']);
    if($equipo){
		// Crear arreglo con los valores
		$emp_arr = array(
            'idequipos' => $equipo['idequipos'],
            'nombre' => $equipo['nombre'],
            'nombre_capitan' => $equipo['nombre_capitan'],
            'correo_capitan' => $equipo['correo_capitan'],
            'telefono_capitan' => $equipo['telefono_capitan'],
            'logo' => $equipo['logo'],
            'nombre_torneo' => $equipo['nombre_torneo'],
            'juegos_ganados' => $equipo['juegos_ganados'],
            'juegos_perdidos' => $equipo['juegos_perdidos'],
            'puntos_a_favor' => $equipo['puntos_a_favor'],
            'puntos_en_contra' => $equipo['puntos_en_contra'],
            'partidos_perdidos_default' => $equipo['partidos_perdidos_default'],
		);
		http_response_code(200);
		echo json_encode($emp_arr);
	}else{
		http_response_code(404);
		echo json_encode("Jugador no encontrado... ");
	}
?>