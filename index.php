<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bienvenido</title>

  <!-- Bootstrap CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="index.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <script src="https://kit.fontawesome.com/3cf56650b0.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="content">
    <header class="header-img">
    </header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
          <?php if($_SESSION['rol'] == 'ADMINISTRADOR'){ ?>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="menuUsuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-user"></i>&nbsp;Usuarios
              </a>
              <div class="dropdown-menu" aria-labelledby="menuUsuarios">
                <a class="dropdown-item" href="views/usuarios/frmUsuarios.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                <a class="dropdown-item" href="views/usuarios/consultarUsuarios.php"><i class="fa-solid fa-address-book" style="color: #005eff;"></i>&nbsp;Consultar</a>
              </div>
            </li>
            <?php
              } 
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="menuTorneos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-award"></i>&nbsp;Torneos
              </a>

              <div class="dropdown-menu" aria-labelledby="menuTorneos">
                <a class="dropdown-item" href="views/admin/frmTorneos.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                <a class="dropdown-item" href="views/admin/readAllTorneos.php"><i class="fa-solid fa-address-book" style="color: #005eff;"></i>&nbsp;Consultar</a>
                <hr class="dropdown-divider">

                 <!-- Patrocinadores -->
                 <div class="nav-item dropend">
                  <a class="nav-link dropdown-toggle" href="#" id="menuPatrocinadores" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-comment-dollar" style="color: #99EBEE;"></i>&nbsp;Patrocinadores
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menuPatrocinadores">
                    <a class="dropdown-item" href="views/sponsors/frmSponsor.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                    <a class="dropdown-item" href="views/sponsors/consultarSponsors.php"><i class="fa-solid fa-address-book" style="color: #005eff;"></i>&nbsp;Consultar</a>
                  </div>
                </div> 

              <!-- Grupos -->
                <hr class="dropdown-divider">
                <div class="nav-item dropend">
                  <a class="nav-link dropdown-toggle" href="#" id="menuGrupos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-users" style="color: #DC00FE;"></i>&nbsp;Grupos
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menuGrupos">
                    <a class="dropdown-item" href="views/grupos/frmGrupo.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                    <a class="dropdown-item" href="views/grupos/consultarGrupos.php"><i class="fa-solid fa-address-book" style="color: #005eff;"></i>&nbsp;Consultar</a>
                  </div>
                </div> 

                <!-- Equipos -->
                <div class="nav-item dropend">
                <hr class="dropdown-divider">
                  <a class="nav-link dropdown-toggle" href="#" id="menuEquipos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-users-rays" style="color: #EF1963;"></i>&nbsp;Equipos
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menuEquipos">
                  <a class="dropdown-item" href="views/equipos/frmEquipo.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                  <a class="dropdown-item" href="views/equipos/consultarEquipos.php"><i class="fa-solid fa-address-book" style="color: #d76c14;"></i>&nbsp;Consultar</a>
                  </div>
                </div>

                <!-- Jugadores -->
                <div class="nav-item dropend">
                  <hr class="dropdown-divider">
                  <a class="nav-link dropdown-toggle" href="#" id="menuJugadores" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-person-running" style="color: #ead78f;"> </i>&nbsp;Jugadores  
                  </a>
                  <div class="dropdown-menu" aria-labelledby="menuJugadores">
                  <a class="dropdown-item" href="views/jugadores/frmJugador.php"><i class="fa-solid fa-user-plus" style="color: #17e84b;"></i>&nbsp;Agregar</a>
                    <a class="dropdown-item" href="views/jugadores/consultarJugadores.php"><i class="fa-solid fa-address-book" style="color: #005eff;"></i>&nbsp;Consultar</a>
                  </div>
                </div>

              <!-- Calendarios -->
              <div class="nav-item dropend">
              <hr class="dropdown-divider">
                <a class="nav-link dropdown-toggle" href="#" id="menuCalendarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-regular fa-calendar-days" style="color: #617ba8"></i>&nbsp;Calendarios
                </a>
                <div class="dropdown-menu" aria-labelledby="menuCalendarios">
                  <a class="dropdown-item" href="#"><i class="fa-regular fa-futbol" style="color: #1e2294;"> </i>&nbsp;Agregar Partido</a>
                  <a class="dropdown-item" href="#"><i class="fa-solid fa-calendar-days" style="color: #6f6b67;"></i>&nbsp;Consultar Calendario</a>
                </div>
              </div>

              <div class="nav-item dropend">
              <hr class="dropdown-divider">
              <a class="nav-link dropdown-toggle" href="#" id="menuResultados" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-regular fa-file-lines" style="color: #544126;"></i>&nbsp;Captura de Resultados 
              </a>
              <div class="dropdown-menu" aria-labelledby="menuResultados">
                <a class="dropdown-item" href="#"><i class="fa-regular fa-clipboard" style="color: #1aba17;"> </i>&nbsp;Capturar</a>
                <a class="dropdown-item" href="#"><i class="fa-solid fa-address-card" style="color: #d76c14;"> </i>&nbsp;Consultar</a>
              </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="menuStanding" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa-solid fa-cat" style="color: #805b64;"></i>&nbsp;Standing 
              </a>
              <div class="dropdown-menu" aria-labelledby="menuStanding">
                <a class="dropdown-item" href="#"><i class="fa-solid fa-list" style="color: #11e4ba;"> </i>&nbsp;General</a>
                <a class="dropdown-item" href="#"><i class="fa-solid fa-basketball" style="color: #c46212;"> </i>&nbsp;Canasteros</a>
                <a class="dropdown-item" href="#"><i class="fa-brands fa-medium" style="color: #54aacf;"> </i>&nbsp;Triples</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="logout.php" class="nav-link">Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </nav>
      <h2>Bienvenido, <?php echo $_SESSION["nombre_usuario"]; ?></h2>
      <?php require_once("views/admin/template/footer.php"); ?>
    </div>

  <!-- Bootstrap JS y Popper.js -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>