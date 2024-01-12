<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/equiposController.php");
    $objEquiposController = new equiposController();
    $equipos = $objEquiposController ->read();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; AGREGAR PARTIDO
                </div>
                <div class="card-body">
                    <form action="insertPartidos.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="equipo_local" class="form-label">EQUIPO LOCAL</label><br>
                        <select name="equipo_local" id="equipo_local">
                            <?php foreach($equipos as $equipo){ ?>
                                <option value="<?php echo $equipo['idequipos'] ?>"> <?php echo $equipo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="equipo_visitante" class="form-label">EQUIPO VISITANTE</label><br>
                        <select name="equipo_visitante" id="equipo_visitante">
                            <?php foreach($equipos as $equipo){ ?>
                                <option value="<?php echo $equipo['idequipos'] ?>"> <?php echo $equipo['nombre'] ?> </option>
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