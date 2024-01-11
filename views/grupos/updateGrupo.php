<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/gruposController.php");
    require_once("../../controllers/torneosController.php");
    $objTorneosController = new torneosController();
    $objGruposController = new grupoController();

    //obtener el id desde el boton que mandara eliminar el registro
    $grupo = $objGruposController->readOne($_GET['id']);
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
                    <span class="fa solid fa-people-group"></span> &nbsp; MODIFICAR GRUPO
                </div>
                <div class="card-body">
                    <form action="grupoUpdate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="idGrupo" class="form-label">ID</label>
                        <input type="number" class="form-control" name="idGrupo" 
                        id="idGrupo" value="<?= $grupo['idgrupos'] ?>" readonly >
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $grupo['nombre'] ?>" 
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">CATEGORIA</label>
                        <input type="text" class="form-control" name="categoria" value="<?php echo $grupo['categoria'] ?>" 
                        id="categoria">
                    </div>
                    <div class="mb-3">
                        <label for="torneos" class="form-label">TORNEO AL QUE PERTENECE:</label><br>
                        <select name="torneos" id="torneos">
                            <?php foreach($torneos as $torneo){ ?>
                                <option value="<?php echo $torneo['idtorneos'] ?>" <?php if($torneo['idtorneos'] == $grupo['fk_torneo']){ echo 'selected';} ?>> <?php echo $torneo['nombre'] ?> </option>
                        <?php } ?>
                        </select>
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