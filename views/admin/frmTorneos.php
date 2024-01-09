<?php 
    require_once("../admin/template/header.php"); 
    require_once("../../controllers/sponsorController.php");
    require_once("../../controllers/usuariosController.php");

    $objSponsorController = new sponsorController();
    $sponsors = $objSponsorController -> read();

    $objUsuarioController = new usuarioController();
    $organizadores = $objUsuarioController -> consultarOrganizadores();
?>
<head>
    <link href="../admin/template/template.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-trophy"></span>&nbsp;CAPTURAR LA INFORMACIÓN DEL TORNEO
                </div>
                <div class="card-body">
                    <form action="torneosInsert.php" method="post">
                    <div class="mb-3">
                        <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO </label>
                        <input type="text" class="form-control" name="txtNombreTorneo" 
                        id="nombreTorneo">
                    </div>
                    <div class="mb-3">
                        <label for="organizador" class="form-label">ORGANIZADOR </label><br>
                        <select name="organizadores" id="organizadores">
                            <?php 
                            foreach($organizadores as $organizador){ ?>
                                <option value="<?php echo $organizador['idusuarios'] ?>"><?php echo $organizador['nombre']; ?> </option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patrocinadores" class="form-label">PATROCINADOR(ES): </label><br>
                        <?php
                            foreach($sponsors as $patrocinador){ ?>
                            <input type="checkbox" name="patrocinadores[]" id="<?php echo "opcion".$patrocinador['nombre']; ?> " value="<?php echo $patrocinador['idpatrocinadores']; ?>"> <?php echo $patrocinador['nombre']; ?> <br>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col mb-3">     
                            <label for="sede" class="form-label">SEDE (cancha) </label>
                            <input type="text" class="form-control" name="txtSede" id="sede">
                        </div>
                        <div class="col mb-3">
                            <label for="categoria" class="form-label">CATEGORÍA</label>
                            <input list="lstCategorias" name="txtCategoria" id="categoria" class="form-control">
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
                            <input type="text" name="txtPremio1" id="premio1" class="form-control">
                        </div>
                        <div class="col mb-3">
                        <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                            <input type="text" name="txtPremio2" id="premio2" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="premio3" class="form-label">PREMIO 3ER. LUGAR</label>
                            <input type="text" name="txtPremio3" id="premio3" class="form-control">
                        </div>
                        <div class="col mb-3">
                        <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEÓN CANASTERO) </label>
                            <input type="text" name="txtOtroPremio" id="otroPremio" 
                            class="form-control">
                        </div>
                    </div>
                    <!-- Usuario y contraseña para el Organizador del Torneo -->
                    <div class="row">
                        <div class="col mb-3">
                            <label for="usuario" class="form-label">USUARIO</label>
                            <input type="text" name="txtUsuario" id="usuario" class="form-control">
                        </div>
                        <div class="col mb-3">
                        <label for="contrasena" class="form-label">CONTRASEÑA </label>
                            <input type="password" name="txtContrasena" id="contrasena" 
                            class="form-control">
                        </div>
                    </div>
                    <div class="col mb-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="../../index.php" class="btn btn-danger">Cancelar</a>
                    </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary">FORMULARIO PARA REGISTRAR TORNEOS</div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>