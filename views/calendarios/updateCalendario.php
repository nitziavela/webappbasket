<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    require_once("../../controllers/equiposController.php");
    //instanciamos controlador para ejecutar la consulta
    $objcalendariosController = new calendarioController();
    $objEquipoController = new equiposController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objcalendariosController->readOne($_GET['id']);
    $equipos = $objEquipoController->read();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="mx-auto p-5">
        <div class="card">
            <div class="card-header">
                <span class="fa solid fa-people-group"></span> &nbsp; MODIFICAR CALENDARIO
            <div class="card-body">
                <form action="calendarioUpdate.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="idCalendario" class="form-label">ID DEL CALENDARIO</label>
                    <input type="number" class="form-control" name="idCalendario" 
                    id="idCalendario" value="<?php echo $rows[0]['idcalendarios'] ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="equipo_visitante" class="form-label">EQUIPO VISITANTE:</label><br>
                    <select name="equipo_visitante" id="equipo_visitante" class="form-control">
                        <?php foreach($equipos as $equipo){ ?>
                            <option value="<?php echo $equipo['idequipos'] ?>" <?php if($equipo['idequipos'] == $rows[0]['fk_equipo_visitante']){ echo 'selected';} ?>> <?php echo $equipo['nombre'] ?> </option>
                    <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="equipo_local" class="form-label">EQUIPO LOCAL:</label><br>
                    <select name="equipo_local" id="equipo_local" class="form-control">
                        <?php foreach($equipos as $equipo){ ?>
                            <option value="<?php echo $equipo['idequipos'] ?>" <?php if($equipo['idequipos'] == $rows[0]['fk_equipo_local']){ echo 'selected';} ?>> <?php echo $equipo['nombre'] ?> </option>
                    <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha_hora" class="form-label">FECHA Y HORA</label>
                    <input type="datetime-local" class="form-control" name="fecha_hora" value="<?php echo $rows[0]['fecha_hora'] ?>" 
                    id="fecha_hora">
                </div>
                <div class="mb-3">
                    <label for="sede" class="form-label">SEDE</label>
                    <input type="sede" class="form-control" name="sede" value="<?php echo $rows[0]['sede'] ?>" 
                    id="correo">
                </div>
                <div class="mb-3">
                    <label for="tipo_juego" class="form-label">TIPO DE JUEGO</label>
                    <input type="text" class="form-control" name="tipo_juego" value="<?php echo $rows[0]['tipo_juego'] ?>" 
                    id="tipo_juego">
                </div>
                <div class="mb-3">
                    <label for="equipo" class="form-label">EQUIPO GANADOR:</label><br>
                    <select name="equipo" id="equipo" class="form-control">
                        <?php foreach($equipos as $equipo){ ?>
                            <option value="<?php echo $equipo['idequipos'] ?>" <?php if($equipo['idequipos'] == $rows[0]['equipo_ganador']){ echo 'selected';} ?>> <?php echo $equipo['nombre'] ?> </option>
                    <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="razon_ganador" class="form-label">RAZON DEL GANADOR:</label>
                    <select name="razon_ganador" id="razon_ganador" class="form-control">
                        <option value="DEFAULT">DEFAULT</option>
                        <option value="ANOTACIONES">ANOTACIONES</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="marcador_visitante" class="form-label">MARCADOR DEL VISITANTE:</label>
                    <input type="number" name="marcador_visitante" id="marcador_visitante" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="marcador_local" class="form-label">MARCADOR DEL LOCAL:</label>
                    <input type="number" name="marcador_local" id="marcador_local" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="jornada" class="form-label">JORNADA:</label>
                    <select name="jornada" id="jornada" class="form-control">
                        <?php for($i = 1;$i <= $rows[0]['jornadas'];$i++){?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="colo-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="consultarCalendarios.php" class="btn btn-success">REGRESAR</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-body-secondary"></div>
        </div>
    </div>
</div>
</body>

<?php require_once("../admin/template/footer.php"); ?>