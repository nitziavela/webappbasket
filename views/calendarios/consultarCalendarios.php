<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    //instanciamos controlador para ejecutar la consulta
    $objcalendariosController = new calendarioController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objcalendariosController->read();
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
        <?php foreach($rows as $row){ ?>
           <?php  print_r($row); ?>
            <div class="card text-center">
                <div class="card-header">
                    <span class="fa solid fa-chess-board"></span>&nbsp;ENCUENTROS
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <div class="widget-body mb-3">
                                <div class="widget-vs">
                                    <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                                        <div class="team-1 text-center">
                                        <img src="<?php echo $row['logo_local'] ?>" alt="Logo Equipo Local" style="width:120px">
                                        <h3><?php echo $row['equipo_local'] ?></h3>
                                        <ul><?php
                                            $jugadores_visitante = explode(",", $row['jugadores_visitante']);
                                            $jugadores_local = explode(",", $row['jugadores_local']);
                                            foreach($jugadores_local as $jugador){
                                            ?>
                                            <li style="color:aliceblue;">
                                                <?php echo $jugador; ?>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        </div>
                                        <div>
                                        <span class="team-vs score"><span><?php echo $row['marcador_local'].' - '.$row['marcador_visitante'];  ?></span></span>
                                        </div>
                                        <div class="team-2 text-center">
                                        <img src="<?php echo $row['logo_visitante'] ?>" alt="Logo Equipo Visitante" style="width:120px">
                                        <h3><?php echo $row['equipo_visitante'] ?></h3>
                                        <ul><?php
                                            foreach($jugadores_visitante as $jugador){
                                            ?>
                                            <li style="color:aliceblue;">
                                                <?php echo $jugador; ?>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <div class="text-center widget-vs-contents mb-4"><br><br>
                            <span class="d-block"><?php echo $row['sede'] ?></span>
                            <span class="d-block"><?php echo $row['fecha_hora'] ?></span>
                            <span class="d-block"><?php echo $row['tipo_juego'] ?></span>
                        </div>
                        </div>
                        </div>
            <div class="mx-auto p-2">
                <a href="consultarCalendario.php?id=<?= $row['idcalendarios'] ?>" class="btn btn-primary" title="Consultar Calendario"><span class="fa solid fa-list-check"></span></a>
                <?php if($row['equipo_ganador'] == NULL){ ?>
                <a href="updateCalendario.php?id=<?= $row['idcalendarios'] ?>" class="btn btn-success" title="Modificar Calendario"><span class="fa solid fa-pen-to-square"></span></a>
                <!--Eliminar registro utilizando usando Ventana Modal -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModal<?= $row['idcalendarios'] ?>" title="Eliminar Calendario">
                    <span class="fa solid fa-trash"></span>
                </button>
                <!-- Modal se puso hasta el ultimo para no causar conflicto con el css del body-->
                <div class="modal fade" id="idModal<?= $row['idcalendarios'] ?>" tabindex="-1" aria-labelledby="Modal<?= $row['idcalendarios'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="Modal<?= $row['idcalendarios'] ?>">¿Desea eliminar el torneo?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Esta acción no se puede deshacer....</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <a href="deleteCalendario.php?id=<?= $row['idcalendarios'] ?>" class="btn btn-danger" title="Eliminar Calendario"> Eliminar </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="capturarResultados.php?idcalendario=<?= $row['idcalendarios'] ?>&equipo_local=<?= $row['fk_equipo_local'] ?>&equipo_visitante=<?= $row['fk_equipo_visitante'] ?>&idtorneo=<?= $row['fk_torneo'] ?>&jornada=<?= $row['jornada'] ?>" class="btn btn-warning" title="Capturar Resultados"><span class="fa solid fa-clipboard-list"></span></a>
                <a href="consultarResultados.php?id=<?= $row['idcalendarios'] ?>" class="btn btn-success" title="Consultar Resultados"><span class="fa solid fa-square-poll-vertical"></span></a>
                <?php } ?> 
            </div>
            <?php } ?> 
        </div>
    </div>
</body>
