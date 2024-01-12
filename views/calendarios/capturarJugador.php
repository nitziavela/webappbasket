<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    require_once("../../controllers/jugadoresController.php");
    require_once("../../controllers/equiposController.php");
    $calendariosController = new calendarioController();
    $jugadoresController = new jugadoresController();
    $equiposController = new equiposController();

?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; CAPTURAR RESULTADOS DE JUGADORES
                </div>
                <div class="card-body">
                    <form action="resultadosInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3" style="display:none;">
                        <label for="idjugador" class="form-label">IDJUGADOR</label>
                        <input type="text" class="form-control" name="idjugador" value="<?php echo $_GET['idjugador'] ?>"
                        id="idjugador">
                    </div>
                    <div class="mb-3" style="display:none;">
                        <label for="idequipo" class="form-label">IDEQUIPO</label>
                        <input type="text" class="form-control" name="idequipo"  value="<?php echo $_GET['idequipo'] ?>"
                        id="idequipo">
                    </div>
                    <div class="mb-3" style="display:none;">
                        <label for="idtorneo" class="form-label">IDTORNEO</label>
                        <input type="text" class="form-control" name="idtorneo"  value="<?php echo $_GET['idtorneo'] ?>"
                        id="idtorneo">
                    </div>
                    <div class="mb-3">
                        <label for="idcalendario" class="form-label">IDCALENDARIO</label>
                        <input type="text" class="form-control" name="idcalendario" value=" <?php echo $_GET['idcalendario'] ?> "
                        id="idcalendario" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jornada" class="form-label">JORNADA</label>
                        <input type="text" class="form-control" name="jornada" value="<?php echo $_GET['jornada'] ?>" readonly
                        id="jornada">
                    </div>
                    <div class="mb-3">
                        <label for="triples" class="form-label">TRIPLES</label>
                        <input type="number" class="form-control" name="triples" placeholder="Escribe el numero de triples..." required
                        id="triples">
                    </div>
                    <div class="mb-3">
                        <label for="dobles" class="form-label">DOBLES</label>
                        <input type="number" class="form-control" name="dobles" placeholder="Escribe el numero de dobles..." required
                        id="dobles">
                    </div>
                    <div class="mb-3">
                        <label for="faltas" class="form-label">FALTAS</label>
                        <input type="number" class="form-control" name="faltas" placeholder="Escribe el numero de faltas..." required
                        id="faltas">
                    </div>
                    <div class="col mb-3">
                        <button type="submit" name="accion" value="agregarUsuario" class="btn btn-primary">Guardar</button>
                        <a href="../../index.php" class="btn btn-danger">Cancelar</a>
                    </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>