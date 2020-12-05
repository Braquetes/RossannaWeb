<?php

//Necesita este archivo para funcionaar, es la libreria de FPDF
require('./FPDF/fpdf.php');

//Creación de clase para los PFD del ticket
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo

        // Arial bold 15
        $this->SetFont('Arial', 'B', 7);
        // Movernos a la derecha
        $this->Cell(14);
        // Título
        require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
        $consultaa = "SELECT * FROM ticket"; //Selecciona los datos del ticket
        $respuestaa = $mysqli->query($consultaa); //Hace la consulta 
        while ($row = $respuestaa->fetch_assoc()) { //While que trae el arreglo de los datos del ticket en la variable $row
            //Tipo de letra y tamaño
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(30, 0, utf8_decode("". $row['nombre'] .""), 0, 0, 'C'); //El identificador del arreglo es el nombre del campo de dicha tabla
            // Salto de línea
            $this->Ln(7);
            //Movernos a la izquierda
            $this->Cell(14);
            $this->SetFont('Arial', 'B', 6);
            $this->Cell(30, 0, utf8_decode("".$row['direccion'].""), 0, 0, 'C'); //El identificador del arreglo es la direccion del campo de dicha tabla
            // Salto de línea
            $this->Ln(5);
            //Movernos a la izquierda
            $this->Cell(14);
            $this->Cell(30, 0, utf8_decode("" . $row['horario_apertura'] . " a.m. - " .$row['horario_cierre']." p.m."), 0, 0, 'C'); //El identificador del arreglo es el horario de apertura y cierre del campo de dicha tabla
            $this->Ln(5);

        }



        require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
        //Selecciona los datos que hay en el carro de compras en un arreglo de tamaño n con una cantidad de registrar que dependen de la tabla de carro
        $consulta = "SELECT * FROM carrito inner join productos on productos.id = carrito.Id_producto LEFT JOIN empleados on empleados.id = carrito.Vendedor where Id_carro > 59";
        //Se lleva acabo la consulta
        $respuesta = $mysqli->query($consulta);
        //While en donde se declara $row que almacena los arreglos y despues los utilizamos con su respectivo identificador
        while ($row = $respuesta->fetch_assoc()) {
            // Arial bold 15
            $this->SetFont('Arial', 'B',7);
            // Movernos a la derecha
            $this->Cell(9);
            // Título
            $this->Cell(40, 0, utf8_decode("Cliente: ".$row['Cliente'].""), 0, 0, 'C', 0);
            // Salto de línea
            $this->Ln(5);
            // Movernos a la derecha
            $this->Cell(12);
            // Título
            $this->Cell(40, 0, utf8_decode("Vendedor: ".$row['nombre']." " . $row['apellido_p'] ." " . $row['apellido_m'] . " "), 0, 0, 'C', 0);
            // Salto de línea
            $this->Ln(5);
            //Movernos a la izquierda
        }

        // Mensaje de tabla
        $this->Cell(-7);
        $this->Cell(25, 5, utf8_decode('Nombre'), 1, 0, 'C', 0);
        $this->Cell(15, 5, utf8_decode('Cantidad'), 1, 0, 'C', 0);
        $this->Cell(10, 5, utf8_decode('Precio'), 1, 0, 'C', 0);
        $this->Cell(15, 5, utf8_decode('Tamaño'), 1, 0, 'C', 0);
        $this->Cell(10, 5, utf8_decode('Total'), 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
        //Trae los datos del ticket que utilizaremos, en este caso saludo
        $consulta = "SELECT * FROM ticket";
        //Hacemos la consulta
        $respuesta = $mysqli->query($consulta);
        //While en donde se añade a $row el arreglo de los resultados
        while ($row = $respuesta->fetch_assoc()) {
        //Tipo y tamaño de letra
        $this->SetFont('Arial', 'B', 6);
        //Posición a la derecha
        $this->Cell(26);
        //Arreglo que trae la primera parte del saludo
        $this->Cell(10, 5, utf8_decode("" . $row['saludo'] . ""), 0, 0, 'C', 0);
        //Salto de linea
        $this->Ln(5);
        //Posición a la derecha
        $this->Cell(26);
        //Arreglo que trae la segunda parte del saludo
        $this->Cell(10, 5, utf8_decode("" . $row['saludo_2'] . ""), 0, 0, 'C', 0);
        }
    }
}

require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
//Empezamos a colocar el producto uno a uno de lo que se vendió con esta consulta
$consulta = "SELECT * FROM carrito inner join productos on productos.id = carrito.Id_producto where Id_carro > 59";
//Hacemos la consulta
$respuesta = $mysqli->query($consulta);

//Funciones de FPDF
$pdf = new PDF();
//Tamaño de papel
$pdf->AddPage('portrait', array(80,130));
//Tamaño de letra
$pdf->SetFont('Arial', '', 8);

//En $row guardamos los datos que utilizaremos
while($row = $respuesta-> fetch_assoc()){
    //Movernos a la izquierda
    $pdf->Cell(-7);
    $pdf->Cell(25,5,utf8_decode($row['nombre']),1,0,'C',0);
    $pdf->Cell(15,5,utf8_decode($row['Cantidad']),1,0,'C',0);
    $pdf->Cell(10,5,utf8_decode("$" .$row['Precio'].""),1,0,'C',0);
    $pdf->Cell(15,5,utf8_decode($row['Tamaño']),1,0,'C',0);
    $pdf->Cell(10,5,utf8_decode("$".$row['Precio']*$row['Cantidad'].""),1,1,'C',0);

    /*
    Una prueba para saber si se esta enviando todo bien al ticket
    $pdf->Cell(20,5,utf8_decode($row['Id_producto']),1,1,'C',0);
    $pdf->Cell(20,5,utf8_decode($row['Cantidad']),1,1,'C',0);
    $pdf->Cell(20,5,utf8_decode($row['Precio']),1,1,'C',0);
    $pdf->Cell(20,5,utf8_decode($row['Vendedor']),1,1,'C',0);
    $pdf->Cell(20,5,utf8_decode($row['Fecha']),1,1,'C',0);
    $pdf->Cell(20,5,utf8_decode($row['Cliente']),1,1,'C',0);
    */
    //Vamos a utilizar estas variables de nuevo, debemos crearlas para poder utilizaras despúes
    $ID = $row['ID'];
    $producto = $row['Id_producto'];
    $cantidad = $row['Cantidad'];
    $precio = $row['Precio'];
    $vendedor = $row['Vendedor'];
    $fecha = $row['Fecha'];
    $cliente = $row['Cliente'];

    require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Utilizamos un procedimiento para copiar los registros que hay en carrito y llevarlos a la tabla venta, esto para estadisticas
    $sqli = "CALL copiarTabla ('".$ID."','".$producto."','".$cantidad."','".$precio."','".$vendedor."','".$fecha."','".$cliente."');";
    //Hacemos la consulta
    $mysqli->query($sqli);

    require("../BaseDatos/Conexion.php"); //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Esta consulta es para seleccionar todos los productos que hay iguales en el inventario
    $log = mysqli_query($conexion, "SELECT * FROM inventario_estadistica WHERE `Id_producto` = '".$producto."'");
    //Si encuentra un registro significa que ya se vendió en el día el mismo producto para actualizar la cantidad vendida o agregarla
    if ($log->num_rows > 0) {
            require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
            $case = "update"; //El caso que usaremos en el procedimiento almacenado es update
            //Llamamos al procedimiento venta_inventario y actualizamos la cantidad por que en donde ya hay un registro
            $result = "CALL venta_inventario ('" . $ID . "','".$producto."','".$cantidad."','".$precio."','".$vendedor. "','" . $fecha . "','" . $cliente . "','".$case."')";
            $mysqli->query($result);
        }else{
            require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
            $case = "insert"; //El caso que usaremos en el procedimiento almacenado es insert
            //Llamamos al procedimiento venta_inventario y se inserta el producto
            $result = "CALL venta_inventario ('" . $ID . "','" . $producto . "','" . $cantidad . "','" . $precio . "','" . $vendedor . "','" . $fecha . "','" . $cliente . "','" . $case . "')";
            $mysqli->query($result);
        }
    }




require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
//Esta consulta solo es para obtener el total de esa venta 
$consulta = "SELECT ROUND(SUM(Precio*Cantidad),2) as total FROM carrito";
//Se hace la consulta
$respuesta = $mysqli->query($consulta);
//Se guarda en $row
while ($row = $respuesta->fetch_assoc()) {
    //Mover a la derecha
    $pdf->Cell(58);
    //Imprime el total en el PDF
    $pdf->Cell(10, 5, utf8_decode("$" . $row['total'] .""), 1, 1, 'C', 0);
}

//Declaramos la funcion que utilizaremos cuando vamos a borrar toda la información del carro de compras y dejarlo vacío para otra venta
function DELETE_carro()
{
    require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
    $s = "DELETE FROM carrito where `Id_carro` > 59"; //Borramos todo menos el primer regristro, este controla el numero de venta
    $mysqli->query($s);
}

//Declaramos la funcion que utilizaremos para que el numerod e venta aumente por cada venta hecha
function UPDATE_ID()
{
    require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Actualizamos el ID en el carrito + 1 para que cambie a la siguiente venta
    $sq = "UPDATE `carrito` SET `ID` = `ID` + 1 WHERE `carrito`.`Id_carro` = 59;";
    $mysqli->query($sq);
}

//Declaramos la funcion que utilizaremos para limpiar la tabla venta porque cuando se hace el registro tambien envia el primer registro y ese solo es de control
function LIMPIAR(){
    require 'base.php'; //Necesitamos el archivo en donde viene la conexión de la base de datos
    //Borramos de la tabla venta ese registro que es de control solamente
    $sq = "DELETE from venta where cantidad = 0 and precio = 0 and cliente = 'Ingresa cliente' ";
    $mysqli->query($sq);
}



DELETE_carro(); //Llamamos a la función
UPDATE_ID(); //Llamamos a la función
LIMPIAR(); //Llamamos a la función

$pdf->Output(); //Termina el proceso de FPDF y esta listo para imprimir
?>
