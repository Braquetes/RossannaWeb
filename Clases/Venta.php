<?php
class venta{
  // Propiedades
  public $id_venta;
  public $id_producto;
  public $cantidad;
  public $precio;
  public $vendedor;
  public $fecha;
  public $cliente;
  // Metodos
  function set_id_venta($id_venta) {  $this->id_venta = $id_venta;  }
  function get_id_venta() { return $this->id_venta; }

  function set_id_producto($id_producto) {  $this->id_producto = $id_producto;  }
  function get_id_producto() { return $this->id_producto; }

  function set_cantidad($cantidad) {  $this->cantidad = $cantidad;  }
  function get_cantidad() { return $this->cantidad; }

  function set_precio($precio) {  $this->$precio = $precio;  }
  function get_precio() { return $this->$precio; }

  function set_vendedor($vendedor) {  $this->vendedor = $vendedor;  }
  function get_vendedor() { return $this->vendedor; }

  function set_fecha($fecha) {  $this->fecha = $fecha;  }
  function get_fecha() { return $this->fecha; }

  function set_cliente($cliente) {  $this->cliente = $cliente;  }
  function get_cliente() { return $this->cliente; }


}
?>
