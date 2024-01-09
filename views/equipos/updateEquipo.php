<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/equiposController.php");
    require_once("../../controllers/torneosController.php");
    $objEquiposController = new equiposController();
    $objTorneosController = new torneosController();

    //obtener el id desde el boton que mandara eliminar el registro
    $equipo = $objEquiposController->readOne($_GET['id']);
    $torneos = $objTorneosController->readTorneos();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; MODIFICAR EQUIPO
                </div>
                <div class="card-body">
                    <form action="equipoUpdate.php" method="post">
                    <div class="mb-3">
                        <label for="idEquipo" class="form-label">ID DEL EQUIPO</label>
                        <input type="number" class="form-control" name="idEquipo" 
                        id="idEquipo" value="<?= $equipo['idequipos'] ?>" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $equipo['nombre'] ?>" 
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="nombrecapitan" class="form-label">NOMBRE DEL CAPITÁN</label>
                        <input type="text" class="form-control" name="nombrecapitan" value="<?php echo $equipo['nombre_capitan'] ?>" 
                        id="nombrecapitan">
                    </div>
                    <div class="mb-3">
                        <label for="correocapitan" class="form-label">CORREO DEL CAPITÁN</label>
                        <input type="email" class="form-control" name="correocapitan" value="<?php echo $equipo['correo_capitan'] ?>" 
                        id="correocapitan">
                    </div>
                    <div class="mb-3">
                        <label for="telefonocapitan" class="form-label">TELÉFONO DEL CAPITÁN</label>
                        <input type="number" class="form-control" name="telefonocapitan" value="<?php echo $equipo['telefono_capitan'] ?>" 
                        id="telefonocapitan">
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <select name="torneos" id="torneos">
                            <?php foreach($torneos as $torneo){ ?>
                                <option value="<?php echo $torneo['idtorneos'] ?>" <?php if($torneo['idtorneos'] == $equipo['fk_torneo']){ echo 'selected';} ?>> <?php echo $torneo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO </label>
                        <br>
                        <img src="<?php echo $equipo['logo'] ?>" alt="LOGO DEL EQUIPO" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                        <input type="file" name="logo" id="logo" accept="image/*">
                        <input type="text" name="nombre_logo" id="nombre_logo" value="<?php echo $equipo['logo'] ?>" style="display:none;">
                    </div>
                    <div class="colo-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="consultarEquipos.php" class="btn btn-success">REGRESAR</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>