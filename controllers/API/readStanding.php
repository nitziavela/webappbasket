<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json: charset=UTF-8");
	header("Access-Control-Allow-Methods:_ POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	require_once ('../../config/DataBase.php');
    require_once ('../../controllers/equiposController.php');

    $objEquiposController = new equiposController();

	$equipos = $objEquiposController->readStandingGeneral($_GET['id']);
    if($equipos){
        $emp_arr = array(); // Inicializar el array antes del bucle
        foreach($equipos as $key => $equipo){
            // Crear arreglo con los valores
            $emp_arr[$key] = array(
                'idequipos' => $equipo['idequipos'],
                'nombre' => $equipo['nombre'],
                'juegos_jugados' => $equipo['juegos_jugados'],
                'juegos_ganados' => $equipo['juegos_ganados'],
                'juegos_perdidos' => $equipo['juegos_perdidos'],
                'puntos_a_favor' => $equipo['puntos_a_favor'],
                'puntos_en_contra' => $equipo['puntos_en_contra'],
                'diferencia' => $equipo['diferencia'],
                'puntaje' => $equipo['puntaje'],
            );
        }
		
		http_response_code(200);
		echo json_encode($emp_arr);
	}else{
		http_response_code(404);
		echo json_encode("Torneo no encontrado... ");
	}
?>