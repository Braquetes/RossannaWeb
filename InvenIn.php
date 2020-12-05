<?php
@session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../index.php");
}

$opcion = "agregar";
if (isset($_POST['Valor'])) {
  $opcion = $_POST['Valor'];
}

require("./Clases/Productos.php"); //Necesitamos el archivo en donde vienen las clases
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rossana|InvenIn</title>
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
<style>
  .tr_op3 {
    width: 190px !important;
  }
</style>

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
        <li class="nav-item">
          <a class="nav-link" href="Reventa.php">Reporte ventas</a>
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

  <!--Navbar-->
  <?php if ($opcion == 'Abarrotes') {
    $id_depa = $_POST['id_depa'];
    require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Muestra los productos que hay dependiendo el departamento
    $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
  ?>

    <!--Inicio-->
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-1 pt-4">
          <img src="img/inventario.JPG" alt="" height="50px">
        </div>
        <div class="col-lg-11 pt-5">
          <h5 class="Title3">Inventario de Abarrotes</h5>
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
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($mostrarProductos->num_rows > 0) {

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
                    <td><?php echo $producto->get_nombre(); ?></td>
                    <td><?php echo $producto->get_precio(); ?> Soles</td>
                    <td><?php echo $producto->get_cantidad_existente(); ?></td>
                    <td><?php echo $producto->get_tamaño(); ?></td>
                    <td>
                      <form action="Palta.php" method="POST">
                        <button class="btn Boton3" type="submit">Alta
                          <span><i class="fas fa-arrow-up"></i></span> </button></a>
                        <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                        <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                        <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                        <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                        <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                        <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                      </form>
                      <form action="PInven.php" method="POST">
                        <button class="btn Boton4" type="submit">Historial
                          <span><i class="far fa-clock"></i></span> </button></a>
                        <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                      </form>
                      <form action="./controllers/model.php" method="POST">
                        <button class="btn Boton7" type="submit"><span>
                            <i class="fa fa-eraser" aria-hidden="true"></i>
                            <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                            <input type="hidden" name="Valor" value="Eliminar">
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>
            </tbody>
            <tfoot class="thead">
              <tr>
                <th class="tr_op3">Nombre</th>
                <th class="tr_op3">Marca</th>
                <th class="tr_op3">Disponibles</th>
                <th class="tr_op3">Tamaño</th>
                <th class="tr_op">Opciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <br>
<?php
              }
            } ?>

<?php if ($opcion == 'Confiteria') {
  $id_depa = $_POST['id_depa'];
  require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
  //Muestra los productos que hay dependiendo el departamento
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
?>

  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-11 pt-5">
        <h5 class="Title3">Inventario de Confiteria</h5>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {

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
                  <td><?php echo $producto->get_nombre(); ?></td>
                  <td><?php echo $producto->get_precio(); ?> Soles</td>
                  <td><?php echo $producto->get_cantidad_existente(); ?></td>
                  <td><?php echo $producto->get_tamaño(); ?></td>
                  <td>
                    <form action="Palta.php" method="POST">
                      <button class="btn Boton3" type="submit">Alta
                        <span><i class="fas fa-arrow-up"></i></span> </button></a>
                      <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                      <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                      <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                      <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                      <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                      <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="PInven.php" method="POST">
                      <button class="btn Boton4" type="submit">Historial
                        <span><i class="far fa-clock"></i></span> </button></a>
                      <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="./controllers/model.php" method="POST">
                      <button class="btn Boton7" type="submit"><span>
                          <i class="fa fa-eraser" aria-hidden="true"></i>
                          <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                          <input type="hidden" name="Valor" value="Eliminar">
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th class="tr_op3">Nombre</th>
              <th class="tr_op3">Marca</th>
              <th class="tr_op3">Disponibles</th>
              <th class="tr_op3">Tamaño</th>
              <th class="tr_op">Opciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
<?php
            }
          } ?>


<?php if ($opcion == 'Enlatados') {
  $id_depa = $_POST['id_depa'];
  require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
  //Muestra los productos que hay dependiendo el departamento
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
?>

  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-11 pt-5">
        <h5 class="Title3">Inventario de Enlatados</h5>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {

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
                  <td><?php echo $producto->get_nombre(); ?></td>
                  <td><?php echo $producto->get_precio(); ?> Soles</td>
                  <td><?php echo $producto->get_cantidad_existente(); ?></td>
                  <td><?php echo $producto->get_tamaño(); ?></td>
                  <td>
                    <form action="Palta.php" method="POST">
                      <button class="btn Boton3" type="submit">Alta
                        <span><i class="fas fa-arrow-up"></i></span> </button></a>
                      <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                      <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                      <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                      <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                      <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                      <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="PInven.php" method="POST">
                      <button class="btn Boton4" type="submit">Historial
                        <span><i class="far fa-clock"></i></span> </button></a>
                      <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="./controllers/model.php" method="POST">
                      <button class="btn Boton7" type="submit"><span>
                          <i class="fa fa-eraser" aria-hidden="true"></i>
                          <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                          <input type="hidden" name="Valor" value="Eliminar">
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th class="tr_op3">Nombre</th>
              <th class="tr_op3">Marca</th>
              <th class="tr_op3">Disponibles</th>
              <th class="tr_op3">Tamaño</th>
              <th class="tr_op">Opciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
<?php
            }
          } ?>


<?php if ($opcion == 'Bebidas') {
  $id_depa = $_POST['id_depa'];
  require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
  //Muestra los productos que hay dependiendo el departamento
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
?>

  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-11 pt-5">
        <h5 class="Title3">Inventario de Bebidas</h5>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {

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
                  <td><?php echo $producto->get_nombre(); ?></td>
                  <td><?php echo $producto->get_precio(); ?> Soles</td>
                  <td><?php echo $producto->get_cantidad_existente(); ?></td>
                  <td><?php echo $producto->get_tamaño(); ?></td>
                  <td>
                    <form action="Palta.php" method="POST">
                      <button class="btn Boton3" type="submit">Alta
                        <span><i class="fas fa-arrow-up"></i></span> </button></a>
                      <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                      <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                      <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                      <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                      <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                      <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="PInven.php" method="POST">
                      <button class="btn Boton4" type="submit">Historial
                        <span><i class="far fa-clock"></i></span> </button></a>
                      <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="./controllers/model.php" method="POST">
                      <button class="btn Boton7" type="submit"><span>
                          <i class="fa fa-eraser" aria-hidden="true"></i>
                          <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                          <input type="hidden" name="Valor" value="Eliminar">
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th class="tr_op3">Nombre</th>
              <th class="tr_op3">Marca</th>
              <th class="tr_op3">Disponibles</th>
              <th class="tr_op3">Tamaño</th>
              <th class="tr_op">Opciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
<?php
            }
          } ?>



<?php if ($opcion == 'FrutasyVerduras') {
  $id_depa = $_POST['id_depa'];
  require("./BaseDatos/Conexion.php");//Necesitamos el archivo en donde viene la conexión de la base de datos
  //Muestra los productos que hay dependiendo el departamento
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
?>

  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-11 pt-5">
        <h5 class="Title3">Inventario de Frutas y Verduras</h5>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {

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
                  <td><?php echo $producto->get_nombre(); ?></td>
                  <td><?php echo $producto->get_precio(); ?> Soles</td>
                  <td><?php echo $producto->get_cantidad_existente(); ?></td>
                  <td><?php echo $producto->get_tamaño(); ?></td>
                  <td>
                    <form action="Palta.php" method="POST">
                      <button class="btn Boton3" type="submit">Alta
                        <span><i class="fas fa-arrow-up"></i></span> </button></a>
                      <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                      <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                      <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                      <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                      <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                      <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="PInven.php" method="POST">
                      <button class="btn Boton4" type="submit">Historial
                        <span><i class="far fa-clock"></i></span> </button></a>
                      <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="./controllers/model.php" method="POST">
                      <button class="btn Boton7" type="submit"><span>
                          <i class="fa fa-eraser" aria-hidden="true"></i>
                          <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                          <input type="hidden" name="Valor" value="Eliminar">
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th class="tr_op3">Nombre</th>
              <th class="tr_op3">Marca</th>
              <th class="tr_op3">Disponibles</th>
              <th class="tr_op3">Tamaño</th>
              <th class="tr_op">Opciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
<?php
            }
          } ?>


<?php if ($opcion == 'Congelados') {
  $id_depa = $_POST['id_depa'];
  require("./BaseDatos/Conexion.php");//Necesitamos el archivo en donde viene la conexión de la base de datos
  //Muestra los productos que hay dependiendo el departamento
  $mostrarProductos = mysqli_query($conexion, "SELECT * from productos where tipo =" . $id_depa);
?>

  <!--Inicio-->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-1 pt-4">
        <img src="img/inventario.JPG" alt="" height="50px">
      </div>
      <div class="col-lg-11 pt-5">Congelados</h5>
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
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($mostrarProductos->num_rows > 0) {

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
                  <td><?php echo $producto->get_nombre(); ?></td>
                  <td><?php echo $producto->get_precio(); ?> Soles</td>
                  <td><?php echo $producto->get_cantidad_existente(); ?></td>
                  <td><?php echo $producto->get_tamaño(); ?></td>
                  <td>
                    <form action="Palta.php" method="POST">
                      <button class="btn Boton3" type="submit">Alta
                        <span><i class="fas fa-arrow-up"></i></span> </button></a>
                      <input type="hidden" name="Nombre" value="<?php echo $producto->get_nombre(); ?>">
                      <input type="hidden" name="Precio" value="<?php echo $producto->get_precio(); ?>">
                      <input type="hidden" name="Cantidad" value="<?php echo $producto->get_cantidad_existente(); ?>">
                      <input type="hidden" name="Tamaño" value="<?php echo $producto->get_tamaño(); ?>">
                      <input type="hidden" name="Tipo" value="<?php echo $id_depa ?>">
                      <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="PInven.php" method="POST">
                      <button class="btn Boton4" type="submit">Historial
                        <span><i class="far fa-clock"></i></span> </button></a>
                      <input type="hidden" name="ID" value="<?php echo $producto->get_id(); ?>">
                    </form>
                    <form action="./controllers/model.php" method="POST">
                      <button class="btn Boton7" type="submit"><span>
                          <i class="fa fa-eraser" aria-hidden="true"></i>
                          <input type="hidden" name="id" value="<?php echo $producto->get_id(); ?>">
                          <input type="hidden" name="Valor" value="Eliminar">
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
          <tfoot class="thead">
            <tr>
              <th class="tr_op3">Nombre</th>
              <th class="tr_op3">Marca</th>
              <th class="tr_op3">Disponibles</th>
              <th class="tr_op3">Tamaño</th>
              <th class="tr_op">Opciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <br>
<?php
            }
          } ?>


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
