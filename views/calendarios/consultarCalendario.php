<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    //instanciamos controlador para ejecutar la consulta
    $objcalendariosController = new calendarioController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objcalendariosController->readOne($_GET['id']);
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
                <a href="consultarCalendario.php" class="btn btn-primary"><span class="fa solid fa-arrow-left"></span></a>
            </div>
            <?php } ?> 
        </div>
    </div>
</body>