<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rossan|Inventario</title>
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
  <!--Inicio-->
  <div class="container mt-5">
    <section class="dark-grey-text text-center">
      <h2 class="font-weight-bold mb-4 pb-2">Departamentos</h2><br><br>
      <div class="row">
        <div class="col-lg-2 col-md-12 mb-5">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/abarrotes.jpeg" alt="Sample image" style="height: 90px !important; width: 170px !important;">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="1">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='Abarrotes' name='Valor'>
              <a class="pink-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-shopping-basket pr-2"></i>Abarrotes</h6>
              </a>
            </button>
          </form>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/confiteria.jpeg" alt="Sample image" style="height: 90px !important; width: 170px !important;">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="2">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='Confiteria' name='Valor'>
              <a class="deep-orange-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-candy-cane pr-2"></i>Confiteria</h6>
              </a>
            </button>
          </form>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/enlatados.jpg" alt="Sample image">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="3">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='Enlatados' name='Valor'>
              <a class="black-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-wine-bottle pr-2"></i>Enlatados</h6>
              </a>
            </button>
          </form>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/bebidas.png" alt="Sample image">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="4">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='Bebidas' name='Valor'>
              <a class="green-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-wine-glass pr-2"></i>Bebidas</h6>
              </a>
            </button>
          </form>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/frutas y verduras.jpg" alt="Sample image">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="5">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='FrutasyVerduras' name='Valor'>
              <a class="gray-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-apple-alt pr-2"></i>Frutas y verduras</h6>
              </a>
            </button>
          </form>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
          <div class="view overlay rounded z-depth-2 mb-4">
            <img class="img-fluid" src="img/congelados.jpg" alt="Sample image">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <form action="InvenIn.php" method="POST">
            <input type="hidden" id="id_depa" name="id_depa" class="form-control mb-4" value="6">
            <button class="btn btn-md m-0 px-3 py-2 z-depth-0 Boton2" type="submit">
              <input type='hidden' value='Congelados' name='Valor'>
              <a class="red-text">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-ice-cream pr-2"></i>Congelados</h6>
              </a>
            </button>
          </form>
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