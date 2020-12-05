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
  <title>Rossana|Venta</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
</head>
<style>
  /*Boton flotante*/
  .btn-flotante {
    font-size: 10px;
    /* Cambiar el tamaño de la tipografia */
    text-transform: uppercase;
    /* Texto en mayusculas */
    font-weight: bold;
    /* Fuente en negrita o bold */
    color: #ffffff;
    /* Color del texto */
    border-radius: 5px;
    /* Borde del boton */
    letter-spacing: 2px;
    /* Espacio entre letras */
    background-color: #E91E63;
    /* Color de fondo */
    padding: 18px 30px;
    /* Relleno del boton */
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
    text-decoration: none !important;
    border-color: white !important;
    border-style: none !important;
  }

  .btn-flotante:hover {
    background-color: #2c2fa5;
    /* Color de fondo al pasar el cursor */
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
    text-decoration: none !important;
  }

  @media only screen and (max-width: 600px) {
    .btn-flotante {
      font-size: 14px;
      padding: 12px 20px;
      bottom: 20px;
      right: 20px;
      text-decoration: none !important;
    }
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
  <!--Inicio-->
  <div class="container">
    <div class="row">
      <div class="col-lg-4 p-5">
        <!--Columna del Cliente-->
        <?php
        //Se verifica que sea un empleado para poder hacer una venta, ya que un administrador no puede
        if ($_SESSION["user"]) {
          $usuario = $_SESSION["user"];
          require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
          require("./Clases/Empleados.php"); //Necesitamos el archivo en donde vienen las clases
          //Mostrará los datos del vendedor que tiene activa la sesión
          $mostrarCarro = mysqli_query($conexion, "SELECT * from empleados where usuario = '" . $usuario . "'");
          if ($mostrarCarro->num_rows > 0) {
            while ($row  = mysqli_fetch_array($mostrarCarro)) {
              $array = array($row["id"],$row["nombres"],$row["apellido_p"],$row["apellido_m"],$row["usuario"],$row["contraseña"],$row["cargo"],$row["turno_entrada"],$row["turno_salida"]);
              $empleado = new empleados();

              $empleado->set_id($array[0]);
              $empleado->set_nombres($array[1]);
              $empleado->set_apellido_p($array[2]);
              $empleado->set_apellido_m($array[3]);
              $empleado->set_usuario($array[4]);
              $empleado->set_contraseña($array[5]);
              $empleado->set_cargo($array[6]);
              $empleado->set_turno_entrada($array[7]);
              $empleado->set_turno_salida($array[8]);
        ?>

              <form class="text-left pt-5" action="Acarrito.php" method="POST">
                <!--Formulario-->
                <strong><label for=""><span><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                    Vendedor</label></strong>
                <input type="text" id="vendedor" class="form-control mb-4" placeholder="<?php echo $empleado->get_nombres();
                                                                                        echo " ";
                                                                                        echo $empleado->get_apellido_p();
                                                                                        echo " ";
                                                                                        echo $empleado->get_apellido_m(); ?>" disabled>
                <strong><label for=""><span><i class="fa fa-male" aria-hidden="true"></i></span>
                    Cliente</label></strong>
                <input type="hidden" value="<?php echo $empleado->get_id(); ?>" name="vendedor">
                <?php
                global $cliente;
                require("./BaseDatos/Conexion.php");
                $mostrarCarro = mysqli_query($conexion, "SELECT * from carrito WHERE `Id_carro` > 59 limit 1");
                if ($mostrarCarro->num_rows > 0) {
                  while ($row = mysqli_fetch_array($mostrarCarro)) {
                    $cliente = $row['Cliente'];
                ?>
                    <input type="text" id="cliente" class="form-control mb-4" value="<?php echo $cliente; ?>" name="cliente">
                  <?php }
                } else {
                  ?>
                  <input type="text" id="cliente" class="form-control mb-4" placeholder="Nombre del cliente" name="cliente">
                <?php
                } ?>
                <div class="md-form md-outline input-with-post-icon datepicker">
                  <?php $fcha = date("Y-m-d"); ?>
                  <input type="date" class="form-control" value="<?php echo $fcha; ?>" name="fecha">
                  <label for=""><?php echo $fcha; ?></label>
                </div>
                <a href="Acarrito.php"><button class="btn btn-info btn-block Boton8" type="submit">
                    <span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    Agregar producto</button></a>
                <!--Columna del Cliente-->
              </form>
        <?php }
          }
        } ?>
      </div>
      <div class="col-lg-8 p-5">
        <!--Columna del formulario-->
        <div class="row">

          <?php
          require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
          //Mostrará todo sobre la venta y lo que hay en el carrito, pero no podrá hacer ninguna venta
          $mostrarCarro = mysqli_query($conexion, "SELECT * from carrito limit 1");
          if ($mostrarCarro->num_rows > 0) {
            while ($row  = mysqli_fetch_array($mostrarCarro)) {
          ?>
              <div class="col text-right">
                <strong><label for="">Num. de Venta: <?php echo $x = $row['ID'] + 1; ?></label></strong>
              </div>
          <?php }
          } ?>
        </div>
        <div class="table-responsive">
          <table class="table product-table mb-0">
            <thead class="mdb-color lighten-5">
              <tr>
                <th></th>
                <th class="font-weight-bold">
                  <strong>Producto</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Tamaño</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Precio</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Cantidad</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Total</strong>
                </th>


                <?php
                require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
                //Esta consulta almacena el total de lo que se va vendiendo
                $mostrarCarro = mysqli_query($conexion, "SELECT ROUND(SUM(Precio*Cantidad),2) as total FROM carrito");
                if ($mostrarCarro) {
                  while ($row = mysqli_fetch_array($mostrarCarro)) {
                ?>
                    <th><?php echo "$";
                        echo $row['total']; ?></th>
                <?php }
                } ?>

              </tr>
            </thead>
            <?php
            require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
            require("./Clases/Carrito.php"); //Necesitamos el archivo en donde vienen las clases
            require("./Clases/Productos.php"); //Necesitamos el archivo en donde vienen las clases
            //Muestra los productos que se han agregado al carrito y que se van a vender
            $mostrarCarro = mysqli_query($conexion, "SELECT * from carrito inner join productos on productos.id = carrito.Id_producto WHERE `Id_carro` > 59");
            if ($mostrarCarro->num_rows > 0) {
              while ($row  = mysqli_fetch_array($mostrarCarro)) {
                $array = array($row["Id_carro"],$row["Id_producto"],$row["Cantidad"],$row["Precio"],$row["Vendedor"],$row["Fecha"],$row["Cliente"],$row["ID"],$row["nombre"],$row["Tamaño"]);

                $carrito = new carrito();
                $producto = new productos();

                $carrito->set_id_carro($array[0]);
                $carrito->set_id_producto($array[1]);
                $carrito->set_cantidad($array[2]);
                $carrito->set_precio($array[3]);
                $carrito->set_vendedor($array[4]);
                $carrito->set_fecha($array[5]);
                $carrito->set_cliente($array[6]);
                $carrito->set_id($array[7]);
                $producto->set_nombre($array[8]);
                $producto->set_tamaño($array[9]);
            ?>
                <tbody>
                  <tr>
                    <th scope="row">
                    </th>
                    <td>
                      <strong><?php echo $producto->get_nombre(); ?></strong>
                    </td>
                    <td><?php echo $producto->get_tamaño(); ?></td>
                    <td>$<?php echo $carrito->get_precio(); ?></td>
                    <td>
                      <?php echo $carrito->get_cantidad(); ?>
                    </td>
                    <td class="font-weight-bold">
                      $<?php echo $carrito->get_precio() * $carrito->get_cantidad() ?>
                    </td>
                    <td>
                      <form action="./controllers/model.php" method="POST">
                        <input type="hidden" value="Listamenos" name="Valor">
                        <input type="hidden" value="<?php echo $carrito->get_id_carro(); ?>" name="id_carro">
                        <input type="hidden" value="<?php echo $carrito->get_id_producto(); ?>" name="id_producto">
                        <input type="hidden" value="<?php echo $carrito->get_cantidad(); ?>" name="cantidad">
                        <button type="submit" class="btn btn-sm btn-primary">X
                        </button>
                      </form>
                    </td>
                  </tr>
                </tbody>
            <?php }
            } ?>
          </table>
        </div>
        <div class="row">
          <div class="col text-left">
            <form action="./controllers/model.php" method="POST">
                  <input type="hidden" value="CancelarVenta" name="Valor">
                  <input type="hidden" value="<?php echo $carrito->get_id_producto ?>" name="Id_producto">
                  <input type="hidden" value="<?php echo $carrito->get_cantidad; ?>" name="Cantidad">
              <button type="submit" class="btn Boton5"><span><i class="fa fa-ban" aria-hidden="true"></i></span>
                Cancelar</button></a>
            </form>
            <a onclick="if(!confirm('Esta apunto de confirmar la venta ¿Esta seguro?')){return false;}" target="_blank" href="./FPDF/index.php" class="btn Boton4"><span><i class="fa fa-check" aria-hidden="true"></i></span>
              Generar</a>
          </div>
        </div>

        <!--Formulario-->
        <!--Columna del formulario-->
      </div>
    </div>
  </div>
  <!--Inicio-->

  <!--Modal-->
  <button type="button" class="btn-flotante" data-toggle="modal" data-target="#modalPoll-1">
    Rossana</button>
  <div class="modal fade right" id="modalPoll-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="heading lead">Información del Ticket
          </p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i>
            <p class="text-center">
              <strong>Actualiza la Información del ticket</strong>
            </p>
          </div>
          <hr>
          <form action="./controllers/model.php" method="POST">
            <div class="md-form">
              <input type="text" name="bodega" class="form-control">
              <label for="form1">Nombre de la bodega</label>
            </div>
            <div class="md-form">
              <input type="text" name="direccion" class="form-control" required>
              <label for="form1">Dirección</label>
            </div>
            <div class="md-form">
              <input type="time" name="horario" class="form-control" required>
              <label for="form1">Horario de apertura</label>
            </div>
            <div class="md-form">
              <input type="time" name="horario2" class="form-control" required>
              <label for="form1">Horario de cierre</label>
            </div>
            <div class="md-form">
              <input type="text" name="telefono" class="form-control" required>
              <label for="form1">Telefono</label>
            </div>
            <div class="md-form">
              <input type="text" name="saludo" class="form-control" required>
              <label for="form1">Saludo</label>
            </div>
            <div class="md-form">
              <input type="text" name="saludo2" class="form-control" required>
              <label for="form1">Saludo final</label>
            </div>
            <input type="hidden" value="ActualizarTicket" name="Valor">
            <button class="btn btn-primary waves-effect waves-light"><a type="submit">Actualizar
                <i class="fa fa-paper-plane ml-1"></i>
              </a></button>
            <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
          </form>
        </div>
      </div>
    </div>
    <!--Modal-->



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
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
