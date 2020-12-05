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
  <title>Rossana|Clientes</title>
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
  .C-delete {
    background-color: #F15353 !important;
    color: white !important;
  }

  .C-delete:hover {
    border-color: #F15353 !important;
    background-color: white !important;
    color: black !important;
  }

  .tr_op4 {
    width: 300px !important;
  }

  .tr_op5 {
    width: 50px !important;
  }

  .tr_op6 {
    width: 50px !important;
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
        <form class="text-left pt-5" action="./controllers/model.php" method="POST">
          <!--Formulario-->
          <strong><label for=""><span><i class="fa fa-male" aria-hidden="true"></i></span>
              Cliente</label></strong>
          <input type="text" id="cliente" class="form-control mb-4" placeholder="Nombre del cliente" name="cliente">
          <input type="hidden" class="form-control mb-4" value="AgregarCliente" name="Valor">
          <button class="btn btn-info btn-block Boton8" type="submit">
              <span></span>
              Agregar cliente</button></a>
        </form>
        <!--Formulario-->
      </div>
      <div class="col-lg-8 p-5">
        <div class="row">
          <div class="col text-center">
            <strong><label for="">Clientes</label></strong>
          </div>
        </div>
        <div class="table-responsive">
          <!--Clientes-->
          <table id="example" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
            <thead class="thead">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
              require("./Clases/Clientes.php"); //Necesitamos el archivo en donde vienen las clases
              //Selecciona los clientes y muestra una tabla
              $mostrarClientes = mysqli_query($conexion, "SELECT * FROM `clientes`");
              if ($mostrarClientes->num_rows > 0) {
                while ($row  = mysqli_fetch_array($mostrarClientes)) {
                  $array = array($row["id"],$row["nombre"]);
                  $cliente = new clientes();

                  $cliente->set_id($array[0]);
                  $cliente->set_nombre($array[1]);
              ?>
                  <tr class="tr">
                    <td><?php echo $cliente->get_id(); ?></td>
                    <td><?php echo $cliente->get_nombre(); ?></td>
                    <td>
                      <form action="./controllers/model.php" method="POST">
                        <input type="hidden" id="id_cliente" name="Id_cliente" value="<?php echo $cliente->get_id(); ?>">
                        <input type="hidden" name="Valor" value="EliminarCliente">
                        <input class="btn btn-md m-0 px-3 py-2 z-depth-0 C-delete" type="submit" value="Eliminar">
                      </form>
                    </td>
                  </tr>
              <?php }
              } ?>
            </tbody>
            <tfoot class="thead">
              <tr>
                <th class="tr_op6">Id</th>
                <th class="tr_op4">Nombre</th>
                <th class="tr_op5">Opciones</th>
              </tr>
            </tfoot>
          </table>
          <!--Clientes-->
        </div>
      </div>
    </div>
  </div>
  <!--Inicio-->
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
