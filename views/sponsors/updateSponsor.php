<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/sponsorController.php");

    $objSponsorsController = new sponsorController();

    //obtener el id desde el boton que mandara eliminar el registro
    $sponsor = $objSponsorsController->readOne($_GET['id']);
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; MODIFICAR PATROCINADOR
                </div>
                <div class="card-body">
                    <form action="sponsorUpdate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="idSponsor" class="form-label">ID DEL PATROCINADOR</label>
                        <input type="number" class="form-control" name="idSponsor" 
                        id="idSponsor" value="<?= $sponsor['idpatrocinadores'] ?>" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $sponsor['nombre'] ?>" 
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO </label>
                        <br>
                        <img src="<?php echo $sponsor['logo'] ?>" alt="LOGO DEL EQUIPO" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                        <input type="file" name="logo" id="logo" accept="image/*">
                        <input type="text" name="nombre_logo" id="nombre_logo" value="<?php echo $sponsor['logo'] ?>" style="display:none;">
                    </div>
                    <div class="colo-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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