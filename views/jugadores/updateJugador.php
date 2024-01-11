<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/jugadoresController.php");
    require_once("../../controllers/equiposController.php");
    $objjugadoresController = new jugadoresController();
    $objEquiposController = new equiposController();

    //obtener el id desde el boton que mandara eliminar el registro
    $jugadores = $objjugadoresController->readOne($_GET['id']);
    $equipos = $objEquiposController->read();
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
                    <form action="jugadorUpdate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="idJugador" class="form-label">ID DEL EQUIPO</label>
                        <input type="number" class="form-control" name="idJugador" 
                        id="idJugador" value="<?= $jugadores['idjugadores'] ?>" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $jugadores['nombre'] ?>" 
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellidopaterno" class="form-label">APELLIDO PATERNO:</label>
                        <input type="text" class="form-control" name="apellidopaterno" value="<?php echo $jugadores['apellido1'] ?>" 
                        id="apellidopaterno">
                    </div>
                    <div class="mb-3">
                        <label for="apellidomaterno" class="form-label">APELLIDO MATERNO:</label>
                        <input type="text" class="form-control" name="apellidomaterno" value="<?php echo $jugadores['apellido2'] ?>" 
                        id="apellidomaterno">
                    </div>
                    <div class="mb-3">
                        <label for="fechanac" class="form-label">FECHA DE NACIMIENTO</label>
                        <input type="date" class="form-control" name="fechanac" value="<?php echo $jugadores['fechanac'] ?>" 
                        id="fechanac">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">CORREO</label>
                        <input type="email" class="form-control" name="correo" value="<?php echo $jugadores['correo'] ?>" 
                        id="correo">
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">TELÉFONO</label>
                        <input type="number" class="form-control" name="celular" value="<?php echo $jugadores['celular'] ?>" 
                        id="celular">
                    </div>
                    <div class="mb-3">
                        <label for="tipo_sangre" class="form-label">TIPO DE SANGRE</label>
                        <input type="text" class="form-control" name="tipo_sangre" value="<?php echo $jugadores['tipo_sangre'] ?>" 
                        id="tipo_sangre">
                    </div>
                    <div class="mb-3">
                        <label for="equipo" class="form-label">EQUIPO AL QUE PERTENECE:</label><br>
                        <select name="equipo" id="equipo">
                            <?php foreach($equipos as $equipo){ ?>
                                <option value="<?php echo $equipo['idequipos'] ?>" <?php if($equipo['idequipos'] == $jugadores['fk_equipo']){ echo 'selected';} ?>> <?php echo $equipo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fotografia" class="form-label">FOTOGRAFIA </label>
                        <br>
                        <img src="<?php echo $jugadores['fotografia'] ?>" alt="FOTOGRAFIA" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                        <input type="file" name="foto" id="foto" accept="image/*">
                        <input type="text" name="nombre_foto" id="nombre_foto" value="<?php echo $jugadores['fotografia'] ?>" style="display:none;">
                    </div>
                    <div class="mb-3">
                        <label for="posicion" class="form-label">POSICION:</label>
                        <input type="text" class="form-control" name="posicion" value="<?php echo $jugadores['posicion'] ?>" 
                        id="posicion">
                    </div>
                    <div class="colo-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="consultarJugadores.php" class="btn btn-success">REGRESAR</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>