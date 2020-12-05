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
  <title>Rossana|Trabajadores</title>
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
  .tr_op4 {
    width: 300px !important;
  }

  .tr_op5 {
    width: 150px !important;
  }

  .tr_op6 {
    width: 50px !important;
  }

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
      <div class="col-lg-12 p-5">
        <div class="row">
          <div class="col text-center">
            <strong><label for="">Trabajadores</label></strong>
          </div>
        </div>
        <div class="table-responsive">
          <!--Clientes-->
          <table id="example" class="table table-bordered  display" cellspacing="0" width="100%">
            <thead class="thead">
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Cargo</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Opciones</th>
              </tr>
            </thead>

            <tbody>
              <?php
              require("./BaseDatos/Conexion.php"); //Muestra el historial de los productos en venta por cada uno
              //Muestra los datos de los empleados
              $mostrarEmpleados = mysqli_query($conexion, "SELECT * FROM `empleados` INNER JOIN puesto on `puesto`.`Id_puesto` = `empleados`.`cargo`");
              if ($mostrarEmpleados->num_rows > 0) {
                while ($row  = mysqli_fetch_array($mostrarEmpleados)) {
              ?>
                  <tr class="tr">

                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["nombres"]; ?></td>
                    <td><?php echo $row["apellido_p"]; ?></td>
                    <td><?php echo $row["apellido_m"]; ?></td>
                    <td><?php echo $row["usuario"]; ?></td>
                    <td><?php echo $row["contraseña"]; ?></td>
                    <td><?php echo $row["Puesto"]; ?></td>
                    <td><input type="time" value="<?php echo $row["turno_entrada"]; ?>" disabled style="width: 110px;"></td>
                    <td><input type="time" value="<?php echo $row["turno_salida"]; ?>" disabled style="width: 110px;"></td>
                    <td>
                      <form action="Etrabajador.php" method="POST">
                        <input type="hidden" value="<?php echo $row["id"]; ?>" name="ID">
                        <button class="btn Boton4" type="submit">Editar
                          <span> <i class="fas fa-edit"></i></span></button>
                      </form>
                      <form action="./controllers/model.php" method="POST">
                        <input type="hidden" name="Valor" value="EliminarEmpleado">
                        <input type="hidden" value="<?php echo $row["id"]; ?>" name="ID">
                        <button class="btn Boton7" type="submit"><span>
                            <i class="fa fa-eraser" aria-hidden="false"></i></span>
                        </button>
                      </form>
                    </td>

                  </tr>
              <?php }
              } ?>
            </tbody>

            <tfoot class="thead">
              <tr>
                <th class="tr_op6">Id</th>
                <th class="tr_op">Nombre</th>
                <th class="tr-op">Apellido paterno</th>
                <th class="tr-op">Apellido materno</th>
                <th class="tr-op">Usuario</th>
                <th class="tr-op">Contraseña</th>
                <th class="tr-op">Cargo</th>
                <th class="tr-op">Entrada</th>
                <th class="tr-op">Salida</th>
                <th class="tr-op">Opciones</th>
              </tr>
            </tfoot>
          </table>
          <!--Clientes-->
        </div>
      </div>
    </div>
    <a href="Atrabajador.php">
      <button type="button" class="btn-flotante" data-toggle="modal" data-target="#modalPoll-1">
        Agregar Trabajador</button>
    </a>
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