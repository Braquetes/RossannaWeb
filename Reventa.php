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
  <title>Rossana|Reventa</title>
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
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="inventario.php">Inventario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Geventa.php">Generar venta</a>
        </li>
      </ul>
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
  <div class="container my-2 px-0 ">
    <section class=" my-md-5 text-center">
      <h3 class="my-4 pb-2 text-center Title1">GENERAR REPORTE</h3>
      <div class="row">
        <div class="col-6">
          <form class="my-5 mx-md-5" action="VistaRventa.php" method="POST">
            <div class="row">
              <div class="col-md-12 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <form class="text-center" style="color: #757575;">
                      <div class="md-form md-outline input-with-post-icon datepicker">
                        <input placeholder="Select date" type="date" name="Inicio" class="form-control" required>
                        <label for="example">De...</label>
                      </div>
                      <div class="md-form md-outline input-with-post-icon datepicker">
                        <input placeholder="Select date" type="date" name="Fin" class="form-control" required>
                        <label for="example">Hasta...</label>
                      </div>
                      <div class="text-center">
                        <input type="hidden" name="Valor" value="SoloTotal">
                        <button class="btn btn-info Boton1" type="submit">Solo el total</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-6">
          <form class="my-5 mx-md-5" action="VistaRventaE.php" method="POST">
            <div class="row">
              <div class="col-md-12 mx-auto">
                <div class="card">
                  <div class="card-body">
                    <form class="text-center" style="color: #757575;">
                      <div class="md-form md-outline input-with-post-icon datepicker">
                        <input placeholder="Select date" type="date" name="Inicio" class="form-control" required>
                        <label for="example">De...</label>
                      </div>
                      <div class="md-form md-outline input-with-post-icon datepicker">
                        <input placeholder="Select date" type="date" name="Fin" class="form-control" required>
                        <label for="example">Hasta...</label>
                      </div>
                      <div class="text-center">
                        <input type="hidden" name="Valor" value="Especifico">
                        <button class="btn btn-info Boton1" type="submit">Con productos especifícos</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>

    </section>
  </div>
  <div class="container my-5 pt-5 pb-3 px-4 z-depth-1">

    <?php
    require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
    //Muestra el producto mas vendido del día
    $mostrarCarro = mysqli_query($conexion, "SELECT *,(SELECT SUM(Cantidad)from venta WHERE Fecha = curdate() )as ProductosTotales from inventario_estadistica inner JOIN productos on inventario_estadistica.Id_producto = productos.id WHERE Fecha = curdate() ORDER BY Cantidad DESC LIMIT 1");
    while ($row = mysqli_fetch_array($mostrarCarro)) {
      if ($mostrarCarro->num_rows > 0) {
    ?>
        <!--Section: Block Content-->
        <section>
          <div class="row">
            <div class="col-md-6 mb-4">
              <h5 class="text-center font-weight-bold mb-4">Hoy</h5>
              <div class="d-flex justify-content-between">
                <small class="text-muted"><?php echo $row["nombre"] ?></small>
                <small><span><strong><?php echo $row["Cantidad"] ?></strong></span>/<span></span><?php echo $row["ProductosTotales"] ?></small>
              </div>
              <div class="progress md-progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo ($row["Cantidad"] * 100) / $row["ProductosTotales"]; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>

              <?php
            require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
            //Muestra el producto menos vendido del día
            $mostrarCarro = mysqli_query($conexion, "SELECT *,(SELECT SUM(Cantidad)from venta WHERE Fecha = curdate() )as ProductosTotales from inventario_estadistica inner JOIN productos on inventario_estadistica.Id_producto = productos.id WHERE Fecha = curdate() ORDER BY Cantidad ASC LIMIT 1;");
              while ($row = mysqli_fetch_array($mostrarCarro)) {
                if ($mostrarCarro->num_rows > 0) {
              ?>
                  <div class="d-flex justify-content-between">
                    <small class="text-muted"><?php echo $row["nombre"] ?></small>
                    <small><span><strong><?php echo $row["Cantidad"] ?></strong></span>/<span></span><?php echo $row["ProductosTotales"] ?></small>
                  </div>
                  <div class="progress md-progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($row['Cantidad'] * 100) / $row['ProductosTotales']; ?>%; background-color:  rgb(252, 125, 142)  !important;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"></div>
                  </div>
              <?php }
              } ?>

            </div>

          <?php } else {
          ?>
            <div class="col-md-6 mb-4">
              <h5 class="text-center font-weight-bold mb-4">No hubo ventas</h5>
            </div>
          </div>
        </section>
    <?php
        }
      } ?>

    <?php
    require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
    //Muestra el producto mas vendido del dia anterior
    $mostrarCarro = mysqli_query($conexion, "SELECT *,(SELECT SUM(Cantidad)from venta WHERE Fecha = CURDATE() - INTERVAL 1 day )as ProductosTotales from inventario_estadistica inner JOIN productos on inventario_estadistica.Id_producto = productos.id WHERE Fecha = CURDATE() - INTERVAL 1 day ORDER BY Cantidad DESC LIMIT 1");
    while ($row = mysqli_fetch_array($mostrarCarro)) {
      if ($row["ProductosTotales"] != NULL) {
    ?>
        <div class="col-md-6 mb-4">
          <h5 class="text-center font-weight-bold mb-4">Ayer</h5>
          <div class="d-flex justify-content-between">
            <small class="text-muted"><?php echo $row["nombre"] ?></small>
            <small><span><strong><?php echo $row["Cantidad"] ?></strong></span>/<span></span><?php echo $row["ProductosTotales"] ?></small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo ($row["Cantidad"] * 100) / $row["ProductosTotales"]; ?>%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <?php
        require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
        //Muestra el producto menos vendido de el día anterior
        $mostrarCarro = mysqli_query($conexion, "SELECT *,(SELECT SUM(Cantidad)from venta WHERE Fecha = CURDATE() - INTERVAL 1 day )as ProductosTotales from inventario_estadistica inner JOIN productos on inventario_estadistica.Id_producto = productos.id WHERE Fecha = CURDATE() - INTERVAL 1 day ORDER BY Cantidad ASC LIMIT 1");
          while ($row = mysqli_fetch_array($mostrarCarro)) {
            if ($mostrarCarro->num_rows > 0) {
          ?>
              <div class="d-flex justify-content-between">
                <small class="text-muted"><?php echo $row["nombre"] ?></small>
                <small><span><strong><?php echo $row["Cantidad"] ?></strong></span>/<span></span><?php echo $row["ProductosTotales"] ?></small>
              </div>
              <div class="progress md-progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo ($row["Cantidad"] * 100) / $row["ProductosTotales"]; ?>%; background-color:  rgb(252, 125, 142)  !important;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"></div>
              </div>
          <?php }
          } ?>
        </div>
      <?php } else { ?>
        <div class="col-md-6 mb-4">
          <h5 class="text-center font-weight-bold mb-4">No hubo ventas</h5>
        </div>
    <?php }
    }
    ?>
    <!--Inicio-->
</body>
<script>
  // Data Picker Initialization
  $('.datepicker').datepicker({
    inline: true
  });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</html>
