<?php require_once("../admin/template/header.php"); ?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-user"></span> &nbsp; AGREGAR GRUPO
                </div>
                <div class="card-body">
                    <form action="grupoInsert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre..." required
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">CATEGORIA: </label>
                        <select name="categoria" id="categoria">
                            <option value="1ra. fuerza">1ra. fuerza</option>
                            <option value="2da. fuerza">2da. fuerza</option>
                            <option value="Veteranos">Veteranos</option>
                            <option value="Libre">Libre</option>
                            <option value="Juvenil">Juvenil</option>
                            <option value="Femenil">Femenil</option>
                            <option value="Empresarial">Empresarial</option>
                            <option value="Infantil">Infantil</option>
                            <option value="Minibasket">Minibasket</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <button type="submit" name="accion" value="agregarGrupo" class="btn btn-primary">Guardar</button>
                        <a href="../../index.php" class="btn btn-danger">Cancelar</a>
                    </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>