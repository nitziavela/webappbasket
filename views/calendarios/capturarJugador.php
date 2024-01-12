<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendariosController.php");
    $calendariosController = new calendarioController();
    $torneos = $calendariosController ->read();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; AGREGAR ROL
                </div>
                <div class="card-body">
                    <form action="resultadosInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="jornadas" class="form-label">JORNADAS</label>
                        <input type="text" class="form-control" name="jornadas" placeholder="Escribe el numero de jornadas..." required
                        id="jornadas">
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <select name="torneos" id="torneos">
                            <?php foreach($torneos as $torneo){ ?>
                                <option value="<?php echo $torneo['idtorneos'] ?>"> <?php echo $torneo['nombre'] ?> </option>
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