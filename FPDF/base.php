<?php

//Conexión para la base de datos en un servidor

$usr = "Mochila_Bodega"; //Usuario de la base de datos
$pw = "Rodo137946"; // Contraseña de la base de datos
$db = "Mochila_Rossana"; //Nombre de la base de datos
$host = "54.233.121.104"; //Ip del servidor

$mysqli =new mysqli($host, $usr, $pw, $db); //Las variables conexión sera la utilizada para llamar a la base de datos
$mysqli->set_charset("utf8"); //Debemos poner los caracteres UTF-8 para que reconozca los acentos y otros caracteres

?>
