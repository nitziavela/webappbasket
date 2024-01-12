<?php 

    require_once("../admin/template/header.php"); 
    require_once("../../controllers/equiposController.php");
    $objEquiposController = new equiposController();

    //obtener el id desde el boton que mandara eliminar el registro
    //$equipo = $objEquiposController->readOne($_GET['id']);

     //Llamar a la api
     $apiUrl = 'http://localhost/webappbasket/controllers/api/readTeam.php?id='.$_GET['id'];

     // Realizar la solicitud GET a la API REST
     $jsonData = file_get_contents($apiUrl);

     // Decodificar la respuesta JSON
     $equipo = json_decode($jsonData, true);

?>
<head>
<link href="../admin/template/template.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="mx-auto p-5">
            <div class="card">
                <div class="card-header">
                    <span class="fa solid fa-people-group"></span> &nbsp; CONSULTAR EQUIPO
                </div>
                <div class="card-body">
                    <form action="sponsorInsert.php" method="post">
                    <div class="mb-3">
                        <label for="nombreTorneo" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $equipo['nombre'] ?>" readonly
                        id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="nombrecapitan" class="form-label">NOMBRE DEL CAPITÁN</label>
                        <input type="text" class="form-control" name="nombrecapitan" value="<?php echo $equipo['nombre_capitan'] ?>" readonly
                        id="nombrecapitan">
                    </div>
                    <div class="mb-3">
                        <label for="correocapitan" class="form-label">CORREO DEL CAPITÁN</label>
                        <input type="text" class="form-control" name="correocapitan" value="<?php echo $equipo['correo_capitan'] ?>" readonly
                        id="correocapitan">
                    </div>
                    <div class="mb-3">
                        <label for="telefonocapitan" class="form-label">TELÉFONO DEL CAPITÁN</label>
                        <input type="text" class="form-control" name="telefonocapitan" value="<?php echo $equipo['telefono_capitan'] ?>" readonly
                        id="telefonocapitan">
                    </div>
                    <div class="mb-3">
                        <label for="torneo" class="form-label">TORNEO AL QUE PERTENECE:</label>
                        <input type="text" class="form-control" name="torneo" value="<?php echo $equipo['nombre_torneo'] ?>" readonly
                        id="torneo">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">LOGO </label>
                        <br>
                        <img src="<?php echo $equipo['logo'] ?>" alt="" style ="width: 200px; text-align: center; display: block; margin: 0 auto;">
                    </div>
                    <div class="colo-12">
                            <a href="consultarEquipos.php" class="btn btn-success">REGRESAR</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </div>
</body>

<?php require_once("../admin/template/footer.php"); ?>