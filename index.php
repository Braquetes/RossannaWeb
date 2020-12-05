<?php

//Index
include("controllers/config.php");

//Verificamos si existe una sesion
if(isset($_SESSION["user"])){
}else{
    //Llamamos al login
    include("./login.html");
}

?>