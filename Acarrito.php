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
  <title>Rossana|Acarrito</title>
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
<?php
//En el carrito utilizamos datos del cliente, vendedor, fecha para llevarlos a la ventana de venta y tener un control de esos datos
$vendedor = $_POST["vendedor"];
$fecha = $_POST["fecha"];
$cliente = $_POST["cliente"]; ?>

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
          <a class="nav-link" href="Reventa.php">Reporte ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="estadisticas.php">Estadisticas</a>
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
  <?php
  require ("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
  require ("./Clases/Productos.php"); //Necesitamos el archivo en donde vienen las clases
  //Esta consulta llama a todos los productos para mostrarlos y que seleccione los que venderá
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos");
  ?>
  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
      </div>
      <div class="col-lg-11 pt-5">
        <h5 class="Title3">Elija producto a vender</h5>
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
              <th>Nombre</th>
              <th>Precio</th>
              <th>Disponibles</th>
              <th>Tamaño</th>
              <th style="width: 50px !important;">Cantidad</th>
              <th>Agregar</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {
              //El arreglo se llama $row y tiene un tamaño n de todos los productos, por el momento son 100
              while ($row  = mysqli_fetch_array($mostrarProductos)) {
                $array = array($row["id"],$row["nombre"],$row["precio"],$row["cantidad_existente"],$row["tipo"],$row["Tamaño"]);
                $producto = new productos();

                $producto->set_id($array[0]);
                $producto->set_nombre($array[1]);
                $producto->set_precio($array[2]);
                $producto->set_cantidad_existente($array[3]);
                $producto->set_tipo($array[4]);
                $producto->set_tamaño($array[5]);
            ?>
                <tr class="tr">
                  <form action="./controllers/model.php" method="POST">
                    <!--Formulario para enviar la cantidad comprada-->
                    <td><?php echo $producto->get_nombre(); ?></td> <!--Muestra el arreglo que tenga los datos de nombre y así con los demas campos-->
                    <td><?php echo $producto->get_precio() ?> Soles</td>
                    <td><?php echo $producto->get_tipo(); ?></td>
                    <td><?php echo $producto->get_tamaño(); ?></td>
                    <td><input type="number" name="cantidad" class="form-control" min="1" pattern="^[0-9]+"></td>
                    <td>
                      <input type="hidden" value="Llenarlista" name="Valor">
                      <input type="hidden" value="<?php echo $producto->get_precio() ?>" name="precio"> <!-- Estos input estan ocultos pero llevan la información para agregar un item-->
                      <input type="hidden" value="<?php echo $producto->get_id() ?>" name="ID">
                      <input type="hidden" value="<?php echo $vendedor; ?>" name="idVendedor">
                      <input type="hidden" value="<?php echo $fecha; ?>" name="fecha">
                      <input type="hidden" value="<?php echo $cliente; ?>" name="cliente">
                      <?php


                      require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
                      //Esta consulta es para llevar el control de la venta, ya que la tabla venta no tiene Id en AUTO_INCREMENT, necesita un ID y es este el que se manda con respecto al numero de venta que es en ese momento
                      $numero = mysqli_query($conexion, "SELECT * FROM `carrito` limit 1");

                      if ($numero->num_rows > 0) {
                        //Aquí selecciona ese ID
                        while ($row  = mysqli_fetch_array($numero)) {
                          //La venta es 0 y al ponerle + 1 se iguala a 1 y ese es el numero de venta, ese será el numero de venta que se enviará a venta
                          $x = $row["ID"] + 1;
                      ?>
                          <input type="hidden" value="<?php echo $x; ?>" name="numero"><!--Es enviado por metodo POST-->
                      <?php }
                      } ?>
                      <button class="btn Boton3" type="submit"><span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span> Agregar</button></a>

                    </td>
                  </form>
                </tr>
            <?php }
            } ?>
          </tbody>

          <tfoot class="thead">
            <tr>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Precio</th>
              <th>Disponibles</th>
              <th>Cantidad</th>
              <th class="tr_op2">Agregar</th>
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
