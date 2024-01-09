<?php require_once("../admin/template/header.php"); ?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-user"></span> &nbsp; AGREGAR USUARIO
                </div>
                <div class="card-body">
                    <form action="sponsorInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombreTorneo" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO: </label>
                        <input type="file" id="logo" name="logo" accept="image/*">
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
    </div>
</body>
