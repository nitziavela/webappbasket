<?php require_once("../admin/template/header.php"); ?>

<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header">
            <span class="fa solid fa-user"></span> &nbsp; AGREGAR USUARIO
        </div>
        <div class="card-body">
            <form action="usuariosInsert.php" method="post">
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required
                id="nombre">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">USUARIO </label>
                <input type="text" class="form-control" name="username" placeholder="Escribe el nombre de usuario..." required
                id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">CONTRASEÑA</label>
                <input type="password" class="form-control" name="password" placeholder="Escribe la contraseña..." required
                id="password">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">ROL: </label>
                <select name="rol" id="rol">
                    <option value="ADMINISTRADOR"> ADMINISTADOR </option>
                    <option value="ORGANIZADOR"> ORGANIZADOR </option>
                    <option value="JUGADOR"> JUGADOR </option>
                </select>
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

<?php require_once("../admin/template/footer.php"); ?>