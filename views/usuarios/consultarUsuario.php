<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/usuariosController.php");
    $objUsuariosController = new usuarioController();

    //obtener el id desde el boton que mandara eliminar el registro
    $usuario = $objUsuariosController->consultarUsuario($_GET['id']);

?>
<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header">
            <span class="fa solid fa-user"></span> &nbsp; CONSULTAR USUARIO
        </div>
        <div class="card-body">
            <form action="usuariosInsert.php" method="post">
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $usuario[0]['nombre'] ?>" readonly
                id="nombre">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">USUARIO </label>
                <input type="text" class="form-control" name="username" value="<?php echo $usuario[0]['username'] ?>" readonly
                id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">CONTRASEÑA</label>
                <input type="password" class="form-control" name="password" value="<?php echo $usuario[0]['password'] ?>" readonly
                id="password">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">ROL: </label>
                <input type="text" class="form-control" name="rol" value="<?php echo $usuario[0]['rol'] ?>" readonly
                id="rol">
            </div>
            <div class="colo-12">
                    <a href="consultarUsuarios.php" class="btn btn-success">REGRESAR</a>
                </div>
            </form>
        </div>
        <div class="card-footer text-body-secondary"></div>
    </div>
</div>

<?php require_once("../admin/template/footer.php"); ?>