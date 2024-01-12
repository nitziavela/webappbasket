<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    require_once("../../controllers/equiposController.php");
    require_once("../../controllers/jugadoresController.php");
    
    //instanciamos controlador para ejecutar la consulta
    $objcalendariosController = new calendarioController();
    $objEquipoController = new equiposController();
    $objJugadoresController = new jugadoresController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objcalendariosController->readOne($_GET['idcalendario']);
    $equipolocal = $objEquipoController->readOne($_GET['equipo_local']);
    $equipovisitante = $objEquipoController->readOne($_GET['equipo_visitante']);
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="mx-auto p-5">
        <div class="card">
            <div class="card-header">
                <span class="fa solid fa-people-group"></span> &nbsp; CAPTURAR RESULTADOS
            <div class="card-body">
                <form action="calendarioUpdate.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="idCalendario" class="form-label">ID DEL CALENDARIO</label>
                    <input type="number" class="form-control" name="idCalendario" 
                    id="idCalendario" value="<?php echo $rows[0]['idcalendarios'] ?>" readonly>
                </div>
                <table class="table table-hover table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">EQUIPO</th>
                                <th scope="col">POSICION</th>      
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($rows): ?>
                            <?php foreach($rows as $row): 
                                $nombre_jugadores = explode(',', $row['jugadores_visitante']);
                                foreach($nombre_jugadores as $nombre_jugador):
                                    $nombre = explode(' ', $nombre_jugador);
                                    $jugador = $objJugadoresController->readByName($nombre[0]);
                            ?>
                            <tr>
                                <th><?= print_r($jugador);exit; $jugador['nombre_jugador'] ?></th>
                                <th><img src="<?= $jugador['logo'] ?>" alt="Logo del equipo"></th>
                                <th><?= $jugador['posicion'] ?></th>
                            </tr>
                            <?php endforeach; ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No hay jugadores aún.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <div class="colo-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="consultarCalendarios.php" class="btn btn-success">REGRESAR</a>
                    </div>
            </div>
            <div class="card-footer text-body-secondary"></div>
        </div>
    </div>
</div>
</body>

<?php require_once("../admin/template/footer.php"); ?>