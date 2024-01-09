<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/gruposController.php");
    $objGrupoController = new grupoController();

    //obtener el id desde el boton que mandara eliminar el registro
    $grupo = $objGrupoController->readOne($_GET['id']);

?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-user"></span> &nbsp; CONSULTAR GRUPO
                </div>
                <div class="card-body">
                    <form action="sponsorInsert.php" method="post">
                    <div class="mb-3">
                        <label for="nombreTorneo" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $grupo['nombre'] ?>" readonly
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">CATEGORIA </label>
                        <br>
                        <input type="text" class="form-control" name="categoria" value="<?php echo $grupo['categoria'] ?>" readonly
                        id="categoria">
                    </div>
                    <div class="colo-12">
                            <a href="consultarGrupos.php" class="btn btn-success">REGRESAR</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>