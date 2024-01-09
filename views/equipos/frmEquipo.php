<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/torneosController.php");
    $objTorneosController = new torneosController();
    $torneos = $objTorneosController ->readTorneos();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; AGREGAR EQUIPO
                </div>
                <div class="card-body">
                    <form action="equipoInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="nombreCapitan" class="form-label">NOMBRE DEL CAPITAN</label>
                        <input type="text" class="form-control" name="nombreCapitan" placeholder="Escribe el nombre del capitán..." required
                        id="nombreCapitan">
                    </div>
                    <div class="mb-3">
                        <label for="correoCapitan" class="form-label">CORREO DEL CAPITÁN</label>
                        <input type="email" class="form-control" name="correoCapitan" placeholder="Escribe el correo del capitán..." required
                        id="correoCapitan">
                    </div>
                    <div class="mb-3">
                        <label for="telefonoCapitan" class="form-label">TELÉFONO DEL CAPITÁN</label>
                        <input type="number" class="form-control" name="telefonoCapitan" placeholder="Escribe el teléfono del capitán..." required
                        id="telefonoCapitan">
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <select name="torneos" id="torneos">
                            <?php foreach($torneos as $torneo){ ?>
                                <option value="<?php echo $torneo['idtorneos'] ?>"> <?php echo $torneo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO: </label>
                        <input type="file" id="logo" name="logo" accept="image/*">
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