<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php");
}
?>

<?php
if ($_SESSION["Puesto"] == 2) { ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rossana|Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e530d88f76.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/9a3779baf9.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>

  <body>
    <!--Navbar-->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
      <a class="navbar-brand" href="home.php">Bodega Rossana</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item dropdown">
            <a class="nav-link " id="navbarDropdownMenuLink-333" href="controllers/logout.php">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!--Navbar-->
    <!--Bienvenida-->
    <div class="container p-5">
      <div class="row">
        <div class="col-lg-12">
          <h5 class="Title2">Bienvenido Administrador</h5>
        </div>
      </div>
    </div>
    <!--Bienvenida-->
    <!--Inicio-->
    <div class="container my-5 p-5">
      <section class="text-center dark-grey-text">
        <div class="row">
          <div class="col-md-3 mb-3">
            <i class="fas fa-users blue-text fa-3x"></i><br>
            <a href="Trabajadores.php">
              <button type="button" class="btn btn-indigo my-4">Empleados</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="fas fa-user-tag red-text fa-3x"></i><br>
            <a href="Clientes.php">
              <button type="button" class="btn btn-default my-4">Clientes</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="far fa-chart-bar indigo-text fa-3x"></i><br>
            <a href="estadisticas.php">
              <button type="button" class="btn btn-info my-4">Estadíticas</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="fas fa-paper-plane purple-text fa-3x"></i><br>
            <a href="Pagregar.php">
              <button type="button" class="btn btn-primary my-4">Agregar Producto</button>
            </a>
          </div>
        </div>
      </section>
    </div>
    <!--Inicio-->
  </body>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

  </body>

  </html>

<?php } ?>


<?php if ($_SESSION["Puesto"] == 1) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rossana|Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/e530d88f76.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/9a3779baf9.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
  </head>

  <body class="body2">
    <!--Navbar-->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
      <a class="navbar-brand" href="home.php">Bodega Rossana</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item dropdown">
            <a class="nav-link " id="navbarDropdownMenuLink-333" href="controllers/logout.php">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!--Navbar-->
    <!--Bienvenida-->
    <div class="container p-5">
      <div class="row">
        <div class="col-lg-12">
          <h5 class="Title2">Bienvenido</h5>
        </div>
      </div>
    </div>
    <!--Bienvenida-->
    <!--Inicio-->
    <div class="container my-5 p-5">
      <section class="text-center dark-grey-text">
        <div class="row">
          <div class="col-md-3 mb-3">
            <i class="fas fa-book-open blue-text fa-3x"></i><br>
            <a href="inventario.php">
              <button type="button" class="btn btn-indigo my-4">Inventario</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="fa fa-map-marker-alt fa-3x indigo-text"></i><br>
            <a href="Geventa.php">
              <button type="button" class="btn btn-default my-4">Venta</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="far fa-chart-bar indigo-text fa-3x"></i><br>
            <a href="estadisticas.php">
              <button type="button" class="btn btn-info my-4">Estadíticas</button>
            </a>
          </div>
          <div class="col-md-3 mb-3">
            <i class="fas fa-paper-plane purple-text fa-3x"></i><br>
            <a href="Pagregar.php">
              <button type="button" class="btn btn-primary my-4">Agregar Producto</button>
            </a>
          </div>
        </div>
      </section>
    </div>
    <!--Inicio-->
  </body>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

  </html>

<?php } ?>