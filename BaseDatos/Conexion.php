<?php

//Conexión para la base de datos en un servidor

$usr = "Mochila_Bodega"; //Usuario de la base de datos
$pw = "Rodo137946"; // Contraseña de la base de datos
$db = "Mochila_Rossana"; //Nombre de la base de datos
$host = "54.233.121.104"; //Ip del servidor


//Modelo Try - catch para la conexión

try {
    $conexion = new mysqli($host, $usr, $pw, $db); //Las variables conexión sera la utilizada para llamar a la base de datos
    $conexion->set_charset("utf8"); //Debemos poner los caracteres UTF-8 para que reconozca los acentos y otros caracteres
    if ($conexion->connect_errno) { //Si los parametros que recibió no fueron correctos enviará el mensaje de error
        die("La conexión ha fallado" . $conexion->connect_errno);
    }
} catch (mysqli_sql_exception $e) {
    throw $e; // Al no poder conectar con la base de datos, no dira cual es el error y en donde se encuentra
}

?>
