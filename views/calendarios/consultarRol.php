<?php 
    require_once("../admin/template/header.php");
    require_once("../../controllers/torneosController.php");
    require_once("../../controllers/calendarioController.php");

    $objCalendariosController = new calendarioController();
    $objTorneosController = new torneosController();

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
                    <span class="fa solid fa-people-group"></span> &nbsp; CONSULTAR ROL
                </div>
                <div class="card-body">
                    <form action="rolesInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="jornadas" class="form-label">JORNADAS</label>
                        <input type="text" class="form-control" name="jornadas" id="jornadas" value="<?php  echo $roles['jornadas'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <input type="text" class="form-control" name="torneos" id="torneos" value="<?php  echo $roles['nombre_torneo'] ?>" readonly>
                    </div>
                    <div class="col mb-3">
                        <a href="../../index.php" class="btn btn-danger">Cancelar</a>
                    </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>