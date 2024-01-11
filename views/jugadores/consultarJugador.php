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
                    <span class="fa solid fa-clipboard-user"></span> &nbsp; JUGADOR
                </div>
                <div class="card-body">
                    <form action="jugadorUpdate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="idEquipo" class="form-label">ID DEL EQUIPO</label>
                        <input type="number" class="form-control" name="idEquipo" 
                        id="idEquipo" value="<?= $jugadores['idjugadores'] ?>" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $jugadores['nombre'] ?>" 
                        id="nombre" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="apellidopaterno" class="form-label">APELLIDO PATERNO:</label>
                        <input type="text" class="form-control" name="apellidopaterno" value="<?php echo $jugadores['apellido1'] ?>" 
                        id="apellidopaterno" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="apellidomaterno" class="form-label">APELLIDO MATERNO:</label>
                        <input type="text" class="form-control" name="apellidomaterno" value="<?php echo $jugadores['apellido2'] ?>" 
                        id="apellidomaterno" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="fechanac" class="form-label">FECHA DE NACIMIENTO</label>
                        <input type="date" class="form-control" name="fechanac" value="<?php echo $jugadores['fechanac'] ?>" 
                        id="fechanac" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">CORREO</label>
                        <input type="email" class="form-control" name="correo" value="<?php echo $jugadores['correo'] ?>" 
                        id="correo" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">TELÉFONO</label>
                        <input type="number" class="form-control" name="celular" value="<?php echo $equipo['celular'] ?>" 
                        id="celular" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="equipo" class="form-label"> EQUIPO AL QUE PERTENECE:</label>
                        <input type="text" class="form-control" name="equipo" value="<?php echo $jugadores['nombre_equipo'] ?>" 
                        id="equipo" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">FOTOGRAFIA</label>
                        <br>
                        <img src="<?php echo $jugadores['fotografia'] ?>" alt="FOTOGRAFIA" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                        <input type="text" name="nombre_fotografia" id="nombre_fotografia" value="<?php echo $jugadores['fotografia'] ?>" style="display:none;">
                    </div>
                    <div class="colo-12">
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