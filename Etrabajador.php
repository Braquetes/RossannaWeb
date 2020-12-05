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
    <title>Rossan|ATrabajador</title>
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
            <h3 class="my-4 pb-2 text-center Title1">EDITAR TRABAJADOR</h3>
            <form class="my-5 mx-md-5" action="./controllers/model.php" method="POST">
                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <form class="text-center" style="color: #757575;">
                                    <?php
                                    $identificador = $_POST["ID"];
                                    require("./BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
                                    require("./Clases/Empleados.php"); //Necesitamos el archivo en donde vienen las clases
                                    //Vamos a editar empleados y traemos todos sus datos
                                    $mostrarCarro = mysqli_query($conexion, "SELECT * from empleados where `id` = '" . $identificador . "' ");
                                    if ($mostrarCarro->num_rows > 0) {
                                        while ($row = mysqli_fetch_array($mostrarCarro)) {
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
                                            <strong><label for=""><span><i class="fa fa-male" aria-hidden="true"></i></span>
                                                    Nombre</label></strong>
                                            <input type="text" id="trabajador" class="form-control mb-4" value="<?php echo $empleado->get_nombres(); ?>" placeholder="Nombre del trabajador" name="Nombre">
                                            <strong><label for=""><span></span>
                                                    Apellido paterno</label></strong>
                                            <input type="text" id="" class="form-control mb-4" placeholder="Apellido paterno" value="<?php echo $empleado->get_apellido_p(); ?>" name="Ap_p">
                                            <strong><label for=""><span></span>
                                                    Apellido materno</label></strong>
                                            <input type="text" id="" class="form-control mb-4" placeholder="Apellido materno" value="<?php echo $empleado->get_apellido_m(); ?>" name="Ap_m">
                                            <strong><label for=""><span><i class="fa fa-user" aria-hidden="true"></i></span>
                                                    Usuario</label></strong>
                                            <input type="text" id="" class="form-control mb-4" placeholder="Usuario" value="<?php echo $empleado->get_usuario(); ?>" name="User">
                                            <strong><label for=""><span><i class="fas fa-lock-open"></i></span>
                                                    Contraseña</label></strong>
                                            <input type="text" id="" class="form-control mb-4" placeholder="Contraseña" value="<?php echo $empleado->get_contraseña(); ?>" name="Pass">
                                            <strong><label for=""><span><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                                    Cargo</label></strong>
                                            <select name="puesto" class="form-control mb-4" required>
                                                <option selected disabled value=""> Elige una opción </option>
                                                <option value="1">Vendedor</option>
                                                <option value="2">Administrador</option>
                                            </select>
                                            <strong><label for=""><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                                    Horario de Entrada</label></strong>
                                            <input type="time" id="" class="form-control mb-4" name="Entrada" required value="<?php echo $empleado->get_turno_entrada(); ?>">
                                            <strong><label for=""><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                                    Horario de salida</label></strong>
                                            <input type="time" id="" class="form-control mb-4" name="Salida" required value="<?php echo $empleado->get_turno_salida(); ?>">
                                            <input type="hidden" name="Valor" value="EditarEmpleado">
                                            <input type="hidden" name="ID" value="<?php echo $row["id"]; ?>">
                                            <button class="btn btn-info btn-block Boton8" type="submit">
                                                Editar trabajador</button>
                                    <?php }
                                    } ?>
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
