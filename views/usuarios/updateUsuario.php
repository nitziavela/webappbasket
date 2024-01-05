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
            <form action="usuariosUpdate.php?id=<?= $usuario[0]['idusuarios'] ?>" method="post">
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $usuario[0]['nombre'] ?>" required
                id="nombre">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">USUARIO </label>
                <input type="text" class="form-control" name="username" value="<?php echo $usuario[0]['username'] ?>" required
                id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">CONTRASEÑA</label>
                <input type="password" class="form-control" name="password" value="<?php echo $usuario[0]['password'] ?>" required
                id="password">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">ROL: </label>
                <select name="rol" id="rol">
                    <option value="ADMINISTRADOR" <?php if($usuario[0]['rol'] == 'ADMINISTRADOR') echo 'selected'; ?> > ADMINISTADOR </option>
                    <option value="ORGANIZADOR" <?php if($usuario[0]['rol'] == 'ORGANIZADOR') echo 'selected'; ?> > ORGANIZADOR </option>
                    <option value="JUGADOR" <?php if($usuario[0]['rol'] == 'JUGADOR') echo 'selected'; ?>  > JUGADOR </option>
                </select>
            </div>
            <div class="colo-12">
                <button type="submit" name="accion" value="agregarUsuario" class="btn btn-primary">Guardar</button>
                <a href="consultarUsuarios.php" class="btn btn-success">REGRESAR</a>
            </div>
            </form>
        </div>
        <div class="card-footer text-body-secondary"></div>
    </div>
</div>

<?php require_once("../admin/template/footer.php"); ?>