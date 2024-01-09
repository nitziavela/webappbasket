<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/sponsorController.php");
    $objSponsorController = new sponsorController();

    //obtener el id desde el boton que mandara eliminar el registro
    $sponsor = $objSponsorController->readOne($_GET['id']);

?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-user"></span> &nbsp; CONSULTAR PATROCINADOR
                </div>
                <div class="card-body">
                    <form action="sponsorInsert.php" method="post">
                    <div class="mb-3">
                        <label for="nombreTorneo" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $sponsor['nombre'] ?>" readonly
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO </label>
                        <br>
                        <img src="<?php echo $sponsor['logo'] ?>" alt="" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                    </div>
                    <div class="colo-12">
                            <a href="consultarSponsors.php" class="btn btn-success">REGRESAR</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>