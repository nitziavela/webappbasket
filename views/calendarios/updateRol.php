<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/torneosController.php");
    require_once("../../controllers/calendarioController.php");
    $objTorneosController = new torneosController();
    $objCalendariosController = new calendarioController();

    $torneos = $objTorneosController ->readTorneos();
    $roles = $objCalendariosController->readOneRol($_GET['id']); 
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; MODIFICAR ROL
                </div>
                <div class="card-body">
                    <form action="rolUpdate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="idroles" class="form-label">ID</label>
                        <input type="text" class="form-control" name="idroles" value="<?php echo $roles['idrol_juegos'] ?>" readonly
                        id="idroles">
                    </div>
                    <div class="mb-3">
                        <label for="jornadas" class="form-label">JORNADAS</label>
                        <input type="number" class="form-control" name="jornadas" placeholder="Escribe el numero de jornadas..." value="<?php echo $roles['jornadas'] ?>" required
                        id="jornadas">
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <select name="torneos" id="torneos">
                            <?php foreach($torneos as $torneo){ ?>
                                <option value="<?php echo $torneo['idtorneos'] ?>" <?php if($torneo['idtorneos'] == $roles['fk_torneo']){ echo 'selected'; } ?> > <?php echo $torneo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
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