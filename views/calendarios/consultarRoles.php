<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/calendarioController.php");
    //instanciamos controlador para ejecutar la consulta
    $objcalendariosController = new calendarioController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objcalendariosController->readRoles();
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
            <div class="card text-center">
                <div class="card-header">
                    <span class="fa solid fa-chess-board"></span>&nbsp;ROLES
                <div class="card-body">
                    <table class="table table-hover table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">JORNADAS</th>
                                <th scope="col">TORNEO</th>            
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($rows): ?>
                            <?php foreach($rows as $row): ?>
                            <tr>
                                <th><?= $row['idrol_juegos'] ?></th>
                                <th><?= $row['jornadas'] ?></th>
                                <th><?= $row['nombre_torneo'] ?></th>
                                <th style="width: 150px">
                                    <a href="consultarRol.php?id=<?= $row['idrol_juegos'] ?>" class="btn btn-primary"><span class="fa solid fa-list-check"></span></a>
                                    <a href="updateRol.php?id=<?= $row['idrol_juegos'] ?>" class="btn btn-success"><span class="fa solid fa-pen-to-square"></span></a>
                                    <!--Eliminar registro utilizando usando Ventana Modal -->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModal<?= $row['idrol_juegos'] ?>">
                                        <span class="fa solid fa-trash"></span>
                                    </button>
                                    <!-- Modal se puso hasta el ultimo para no causar conflicto con el css del body-->
                                    <div class="modal fade" id="idModal<?= $row['idrol_juegos'] ?>" tabindex="-1" aria-labelledby="Modal<?= $row['idrol_juegos'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="Modal<?= $row['idrol_juegos'] ?>">¿Desea eliminar el torneo?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Esta acción no se puede deshacer....</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="deleteRol.php?id=<?= $row['idrol_juegos'] ?>" class="btn btn-danger"> Eliminar </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th> 
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No hay roles aún.</td>
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