<?php
require_once("../admin/template/header.php");
require_once("../../controllers/jugadoresController.php");
require_once("../../controllers/torneosController.php");

//instanciamos controlador para ejecutar la consulta
$objTorneosController = new torneosController();
$objJugadoresController = new jugadoresController();

//Capturamos los registros de la tabla en "filas"
$torneos = $objTorneosController->readTorneos();

// Inicializamos la variable $equipos
$jugadores = array();

// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $torneo = $_POST['torneo'];
    $jugadores = $objJugadoresController->readByTorneo($torneo);
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
                    <span class="fa solid fa-chess-board"></span>&nbsp;STANDING JUGADORES
                </div>
                <div class="card-body">
                    <form action="consultarStandingJugador.php" method="post">
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
                                <th scope="col">JUGADOR</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">TRIPLES</th>
                                <th scope="col">DOBLES</th>
                                <th scope="col">FALTAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($jugadores) : ?>
                                <?php foreach ($jugadores as $k => $row) : ?>
                                    <tr>
                                        <th><?= $k ?></th>
                                        <th><?= $row['nombre_jugador'] ?></th>
                                        <th><?= $row['nombre_equipo'] ?></th>
                                        <th><?= $row['triples'] ?></th>
                                        <th><?= $row['dobles'] ?></th>
                                        <th><?= $row['faltas'] ?></th>
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