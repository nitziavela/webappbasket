<?php
require_once("../admin/template/header.php");
require_once("../../controllers/equiposController.php");
require_once("../../controllers/gruposController.php");
require_once("../../controllers/torneosController.php");

//instanciamos controlador para ejecutar la consulta
$objTorneosController = new torneosController();
$objEquiposController = new equiposController();
$objGruposControler = new grupoController();

//Capturamos los registros de la tabla en "filas"
$torneos = $objTorneosController->readTorneos();
$grupos = $objGruposControler ->read();

// Inicializamos la variable $equipos
$equipos = array();

// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $torneo = $_POST['torneo'];
    $grupo = $_POST['grupo'];
    // Realizamos la solicitud GET a la API REST
    $equipos = $objEquiposController->readStandingEquipos($torneo, $grupo);
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
                    <span class="fa solid fa-chess-board"></span>&nbsp;STANDING EQUIPOS
                </div>
                <div class="card-body">
                    <form action="consultarStandingEquipos.php" method="post">
                        <div style="display:inline-block; margin-right:50px;">
                        <label for="torneo">Buscar Torneo: </label>
                        <select name="torneo" id="torneo">
                            <?php foreach ($torneos as $torneo) : ?>
                                <option value="<?= $torneo['idtorneos'] ?>"><?= $torneo['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <label for="grupo">Buscar Grupo: </label>
                        <select name="grupo" id="grupo">
                            <?php foreach ($grupos as $grupo) : ?>
                                <option value=""></option>
                                <option value="<?= $grupo['idgrupos'] ?>"><?= $grupo['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-secondary"><span class="fa-solid fa-magnifying-glass"></span></button>
                    </form>
                    <table class="table table-hover table">
                        <thead class="table-light">
                            <tr>
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