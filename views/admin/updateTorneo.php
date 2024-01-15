<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/torneosController.php");
    require_once("../../controllers/sponsorController.php");
    require_once("../../controllers/usuariosController.php");
    //Se instancia el controlador para ejecutar la consulta
    $objTorneosController = new torneosController();

    $objSponsorController = new sponsorController();
    $sponsors = $objSponsorController -> read();
    //Se capturan los regristros de la tabal en "filas"
    $lstTorneo = $objTorneosController->readOneTorneo($_GET['id']);

    $pat = explode(",", $lstTorneo['patrocinadores']);
?>

<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header">INFORMACIÓN DEL TORNEO</div>
        <div class="card-body">
            <form action="torneoUpdate.php" method="post">
                <div class="mb-3">
                    <label for="idTorneo" class="form-label">ID DEL TORNEO</label>
                    <input type="text" class="form-control" name="idtorneo" 
                    id="idtorneo" value="<?= $lstTorneo['idtorneos'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO (ID: <?= $lstTorneo['idtorneos'] ?>)</label>
                    <input type="text" class="form-control" name="txtNombreTorneo" 
                    id="nombreTorneo" value="<?= $lstTorneo['nombre'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="organizador" class="form-label">ORGANIZADOR (nombre completo) </label>
                    <input type="text" class="form-control" name="txtOrganizador" 
                    id="organizador" value="<?= $lstTorneo['organizador'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="patrocinador" class="form-label">PATROCINADOR(ES) </label><br>
                    <?php
                        foreach($sponsors as $patrocinador){ ?>
                            <input type="checkbox" name="patrocinadores[]" id="<?php echo "opcion".$patrocinador['nombre']; ?> " value="<?php echo $patrocinador['idpatrocinadores']; ?>" 
                            <?php foreach($pat as $patros){
                                if($patrocinador['nombre'] == $patros){ 
                                    echo 'checked'; 
                                    } } ?>> <?php echo $patrocinador['nombre']; ?> <br>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col mb-3">     
                        <label for="sede" class="form-label">SEDE (cancha) </label>
                        <input type="text" class="form-control" name="txtSede" id="sede" value="<?= $lstTorneo['sede'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="categoria" class="form-label">CATEGORÍA</label>
                        <input list="lstCategorias" name="txtCategoria" id="categoria" 
                        class="form-control" value="<?= $lstTorneo['categoria'] ?>" >
                        <datalist id="lstCategorias">
                            <option value="1ra. fuerza">
                            <option value="2da. fuerza">  
                            <option value="Veteranos">
                            <option value="Libre">
                            <option value="Juvenil">
                            <option value="Femenil">
                            <option value="Empresarial">
                            <option value="Infantil">
                            <option value="Minibasket">
                        </datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                        <input type="text" name="txtPremio1" id="premio1" class="form-control" value="<?= $lstTorneo['premio1'] ?>" >
                    </div>
                    <div class="col mb-3">
                    <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                        <input type="text" name="txtPremio2" id="premio2" class="form-control" value="<?= $lstTorneo['premio2']?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio3" class="form-label">PREMIO 3ER. LUGAR</label>
                        <input type="text" name="txtPremio3" id="premio3" class="form-control" value="<?= $lstTorneo['premio3'] ?>" >
                    </div>
                    <div class="col mb-3">
                    <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEÓN CANASTERO) </label>
                        <input type="text" name="txtOtroPremio" id="otroPremio" class="form-control" value="<?= $lstTorneo['premio_otro'] ?>" > 
                    </div>
                </div>
                <!-- Usuario y contraseña para el Organizador del Torneo -->
                <div class="col mb-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="readAllTorneos.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <div class="card-footer text-body-secondary">DETALLE TORNEO</div>
    </div>
</div>

<?php require_once("../admin/template/footer.php"); ?>