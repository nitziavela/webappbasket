<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/usuariosController.php");
    //instanciamos controlador para ejecutar la consulta
    $objUsuariosController = new usuarioController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objUsuariosController->consultarUsuarios();
?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card text-center">
                <div class="card-header">
                    <span class="fa solid fa-user"></span>&nbsp;USUARIOS
                </div>
                <div class="card-body">
                    <table class="table table-hover table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">USUARIO</th>
                                <th scope="col">ROL</th>
                                <th scope="col">ACCIONES</th>                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($rows): ?>
                            <?php foreach($rows as $row): ?>
                            <tr>
                                <th><?= $row['idusuarios'] ?></th>
                                <th><?= $row['nombre'] ?></th>
                                <th><?= $row['username'] ?></th>
                                <th><?= $row['rol'] ?></th>
                                <th>
                                    <a href="consultarUsuario.php?id=<?= $row['idusuarios'] ?>" class="btn btn-primary"><span class="fa solid fa-list-check"></span></a>
                                    <a href="updateUsuario.php?id=<?= $row['idusuarios'] ?>" class="btn btn-success"><span class="fa solid fa-pen-to-square"></span></a>
                                    <!--Eliminar registro utilizando usando Ventana Modal -->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModal<?= $row['idusuarios'] ?>">
                                        <span class="fa solid fa-trash"></span>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="idModal<?= $row['idusuarios'] ?>" tabindex="-1" aria-labelledby="Modal<?= $row['idusuarios'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="Modal<?= $row['idusuarios'] ?>">¿Desea eliminar el torneo?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Esta acción no se puede deshacer....</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="deleteUsuario.php?id=<?= $row['idusuarios'] ?>" class="btn btn-danger"> Eliminar </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th> 
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No hay torneos aún.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-auto p-2">
                <a href="../../index.php" class="btn btn-primary">REGRESAR </a>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>