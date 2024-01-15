<?php
require_once("../admin/template/header.php");
require_once("../../controllers/equiposController.php");
require_once("../../controllers/torneosController.php");

//instanciamos controlador para ejecutar la consulta
$objTorneosController = new torneosController();

//Capturamos los registros de la tabla en "filas"
$torneos = $objTorneosController->readTorneos();

// Inicializamos la variable $equipos
$equipos = array();

// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Realizamos la solicitud GET a la API REST
    $apiUrl = 'http://localhost/webappbasket/controllers/api/readStanding.php?id=' . $_POST['torneo'];
    $jsonData = file_get_contents($apiUrl);

    // Decodificar la respuesta JSON
    $equipos = json_decode($jsonData, true);
}

?>
<head>
    <link href="../admin/template/template.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card text-center">
                <div class="card-header">
                    <span class="fa solid fa-chess-board"></span>&nbsp;STANDING GENERAL
                </div>
                <div class="card-body">
                    <form action="consultarStandingGeneral.php" method="post">
                        <label for="torneo">Buscar Torneo: </label>
                        <select name="torneo" id="torneo">
                            <?php foreach ($torneos as $torneo) : ?>
                                <option value="<?= $torneo['idtorneos'] ?>"><?= $torneo['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-secondary"><span class="fa-solid fa-magnifying-glass"></span></button>
                    </form>
                    <table class="table table-hover table">
                        <thead class="table-light">
                            <tr>
                            <th scope="col">NO.</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">JUGADOS</th>
                                <th scope="col">GANADOS</th>
                                <th scope="col">PERDIDOS</th>
                                <th scope="col">PUNTOS A FAVOR</th>
                                <th scope="col">PUNTOS EN CONTRA</th>
                                <th scope="col">DIFERENCIA DE PUNTOS</th>
                                <th scope="col">PUNTAJE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($equipos) : ?>
                                <?php foreach ($equipos as $k => $row) : ?>
                                    <tr>
                                        <th><?= $k ?></th>
                                        <th><?= $row['nombre'] ?></th>
                                        <th><?= $row['juegos_jugados'] ?></th>
                                        <th><?= $row['juegos_ganados'] ?></th>
                                        <th><?= $row['juegos_perdidos'] ?></th>
                                        <th><?= $row['puntos_a_favor'] ?></th>
                                        <th><?= $row['puntos_en_contra'] ?></th>
                                        <th><?= $row['diferencia'] ?></th>
                                        <th><?= $row['puntaje'] ?></th>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay standing aún.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-auto p-2">
                <a href="../../index.php" class="btn btn-primary">REGRESAR </a>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>