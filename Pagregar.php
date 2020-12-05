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
  <title>Rossan|Agregar</title>
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

<body class="body">
  <div class="container my-2 px-0 ">
    <section class=" my-md-5 text-center">
      <h3 class="my-4 pb-2 text-center Title1">AGREGAR PRODUCTO</h3>
      <form class="my-5 mx-md-5" action="./controllers/model.php" method="POST">
        <div class="row">
          <div class="col-md-4 mx-auto">
            <div class="card">
              <div class="card-body">
                <form class="text-center" style="color: #757575;">
                  <div class="md-form">
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                    <label for="form1">Nombre</label>
                  </div>
                  <div class="md-form">
                    <input type="text" id="precio" name="precio" class="form-control" required>
                    <label for="form1">Precio</label>
                  </div>
                  <div class="md-form">
                    <input type="text" id="tamaño" name="tamaño" class="form-control" required>
                    <label for="form1">Tamaño</label>
                  </div>
                  <div class="md-form">
                    <select id="tipo" name="tipo" class="form-control" required>
                      <option value="1">Abarrotes</option>
                      <option value="2">Confiteria</option>
                      <option value="3">Enlatados</option>
                      <option value="4">Bebidas</option>
                      <option value="5">Frutas y verduras</option>
                      <option value="6">Congelados</option>
                    </select>
                  </div>
                  <div class="md-form">
                    <input type="number" id="cantidad" name="cantidad" class="form-control" required>
                    <label for="form1">Agregar unidades</label>
                  </div>
                  <div class="text-center">
                    <a href="home.php"><button class="btn Boton5" type="button">Cancelar</button></a>
                    <button class="btn btn-info Boton1" type="submit" value="Agregar" name="Valor">Agregar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</html>
