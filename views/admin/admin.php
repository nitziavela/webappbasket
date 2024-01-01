<?php require_once("../admin/template/header.php"); ?>

<div class="mx-auto p-5">
    <div class="card text-center">
        <div class="card-header">MENÚ</div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="row mb-3">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">CREAR TORNEO</div>
                            <div class="card-body">
                                <a href="frmtorneos.php" class="btn btn-primary"><img src="../img/torneo-admin.png" alt="Crear un torneo" width="180" height="180"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-header">LISTA DE TORNEOS</div>
                            <div class="card-body">
                                <a href="readAllTorneos.php" class="btn btn-primary"><img src="../img/torneo-lista-admin.png" alt="Listar torneos." width="180" height="180"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Añadimos otra fila con dos columnas con dos cards -->
                <div class="row mb-3">
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-header">ESTADÍSTICAS</div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-header">AUNCIOS</div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-body-secondary">Configuración de torneos. Web App Basket-Ball</div>

<?php require_once("../admin/template/footer.php"); ?>