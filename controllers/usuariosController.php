<?php

//Login para entrar al sistema
$user = $_POST["user"];
$pass = $_POST["pass"];

//Si recibe la variable $user y $pass para entrar a este if, en caso de no recibirlos envia a el último else
if(isset($user) AND isset($pass)){
    require("../BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Consulta en la base de datos si hay algún registro que coincida con con los parametros recibidos
    $log = mysqli_query($conexion, "SELECT * FROM empleados WHERE usuario = '" . $user . "' AND contraseña = '" . $pass . "'");
    if($log->num_rows > 0){//Encontro un registro igual
        while($row = mysqli_fetch_array($log)){ //Este arreglo trae todos los campos de la tabla para utilizarlos despues
            @session_start();   //Se incia una sesión
            $_SESSION["user"] = $_POST["user"]; //Almacenamos el usuario, password, cargo 
            $_SESSION["pass"] = $_POST["pass"];
            $_SESSION["Puesto"] = $row["cargo"];
        }
        //Envia a la ventana home ya que si pudo ingresar
        echo"<script type='text/javascript'>
            window.location='../home.php';
            </script>";
    }else{//No econtro ningun registro con esos datos
        //Envia a la ventana login de nuevo para entrar de nuevo
        echo"<script type='text/javascript'>
            window.location='../login.html';
            </script>";
    }
}else{//Datos vacios, este else esta unido al primer if
    //Envia a la ventana login para ingresar datos
    echo"<script type='text/javascript'>
            window.location='../login.html';
            </script>";
}
?>