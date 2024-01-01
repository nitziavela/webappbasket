<?php
    require_once("../admin/template/header.php");
    require_once("../../controllers/torneosController.php");
    //instanciamos controlador para ejecutar la consulta
    $objTorneosController = new torneosController();
    //Capturamos los regristros de la tabal en "filas"
    $rows = $objTorneosController->readTorneos();
?>

<div class="mx-auto p-5">
    <div class="card text-center">
        <div class="card-header">
            <span class="fa solid fa-trophy">LISTADO DE TORNEOS</span>
        </div>
        <div class="card-body">
            <table class="table table-hover table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TORNEO</th>
                        <th scope="col">ORGANIZADOR</th>
                        <th scope="col">ACCIONES</th>                         
                    </tr>
                </thead>
                <tbody>
                    <?php if($rows): ?>
                    <?php foreach($rows as $row): ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['nombreTorneo'] ?></th>
                        <th><?= $row['organizador'] ?></th>
                        <th>
                            <a href="readOneTorneo.php?id=<?= $row['id'] ?>" class="btn btn-primary"><span class="fa solid fa-list-check"></span></a>
                            <a href="updateTorneo.php?id=<?= $row['id'] ?>" class="btn btn-success"><span class="fa solid fa-pen-to-square"></span></a>
                            <!--Eliminar registro utilizando usando Ventana Modal -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#idModal<?= $row['id'] ?>">
                                <span class="fa solid fa-trash"></span>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="idModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="Modal<?= $row['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="Modal<?= $row['id'] ?>">¿Desea eliminar el torneo?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">Esta acción no se puede deshacer....</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <a href="deleteTorneo.php?id=<?= $row['id'] ?>" class="btn btn-danger"> Eliminar </a>
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
        <a href="admin.php" class="btn btn-primary">REGRESAR </a>
    </div>
</div>

<?php require_once("../admin/template/footer.php"); ?>