<?php
session_start();
require_once("config/DataBase.php");

$connection = new DataBase();
$PDO = $connection->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $consulta = "SELECT idusuarios, username, nombre, rol FROM usuarios WHERE username = :usuario AND password = :contrasena";
    $stmt = $PDO->prepare($consulta);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->execute();


    $usuarioDatos = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuarioDatos) {
        $_SESSION["id"] = $usuarioDatos["idusuarios"];
        $_SESSION["username"] = $usuarioDatos["username"];
        $_SESSION["nombre_usuario"] = $usuarioDatos["nombre"];
        $_SESSION["rol"] = $usuarioDatos["rol"];
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/3cf56650b0.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">

                        <!-- Formulario de inicio de sesión -->
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required placeholder="Nombre de Usuario">
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required placeholder="Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
 <!-- Bootstrap JS y Popper.js -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>