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
  <title>Rossana|VREspecifico</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
</head>

<body class="body1">
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
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-8 pt-5">
        <h5 class="Title3">Historial de productos especificos</h5>
      </div>
      <div class="col-lg-3">
        <div class="media white z-depth-1 rounded">
          <i class="far fa-money-bill-alt fa-lg teal z-depth-1 p-4 rounded-left text-white mr-3"></i>
          <div class="media-body p-1">
            <p class="text-uppercase text-muted mb-1"><small>Ventas</small></p>
            <?php
            $fecha1 = $_POST["Inicio"];
            $fecha2 = $_POST["Fin"];
            require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
            // Muestra el total de ganancias dependiendo de la fecha que fue seleccionada
            $muestraventas = mysqli_query($conexion, "SELECT SUM(Cantidad), ROUND(SUM(Precio*Cantidad),2) as Total, Fecha from inventario_estadistica where Fecha >='" . $fecha1 . "' and Fecha <= '" . $fecha2 . "' GROUP by Fecha");
            $TotalFinal = 0;
            if ($muestraventas->num_rows > 0) {
              while ($row = mysqli_fetch_array($muestraventas)) {

                $TotalFinal = $TotalFinal + $row["Total"];
              }
            ?>
              <h5 class="font-weight-bold mb-0">$ <?php echo $TotalFinal; ?></h5>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!--Inicio-->
  <!--Tabla-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
          <thead class="thead">
            <tr>
              <th>Fecha</th>
              <th>Producto</th>
              <th>Cantidad vendida</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody>

            <?php
            $fecha1 = $_POST["Inicio"];
            $fecha2 = $_POST["Fin"];
            require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
            //Muestra los datos a detalle de los productos vendidos
            $muestraventas = mysqli_query($conexion, "SELECT * FROM inventario_estadistica inner join productos on inventario_estadistica.Id_producto = productos.id  where Fecha >= '" . $fecha1 . "' and Fecha <= '" . $fecha2 . "'");
            if ($muestraventas->num_rows > 0) {
              while ($row = mysqli_fetch_array($muestraventas)) {
            ?>
                <tr class="tr">
                  <td><?php echo $row["Fecha"]; ?></td>
                  <td><?php echo $row["nombre"]; ?></td>
                  <td><?php echo $row["Cantidad"]; ?></td>
                  <td>$ <?php echo $row["Precio"] * $row["Cantidad"]; ?></td>
                </tr>

            <?php }
            } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th>Fecha</th>
              <th>Producto</th>
              <th>Cantidad vendida</th>
              <th>Total</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
  <!--Tabla-->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        responsive: true,
        "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar: ",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "sProcessing": "Procesando...",
        }
      });
    });
  </script>
</body>

</html>