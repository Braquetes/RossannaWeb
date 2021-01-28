<?php
class productos{
  // Propiedades
  public $id;
  public $nombre;
  public $precio;
  public $cantidad_existente;
  public $tipo;
  public $tamaño;
  // Metodos
  function set_id($id) {  $this->id = $id;  }
  function get_id() { return $this->id; }

  function set_nombre($nombre) {  $this->nombre = $nombre;  }
  function get_nombre() { return $this->nombre; }

  function set_precio($precio) {  $this->precio = $precio;  }
  function get_precio() { return $this->precio; }

  function set_cantidad_existente($cantidad_existente) {  $this->cantidad_existente = $cantidad_existente;  }
  function get_cantidad_existente() { return $this->cantidad_existente; }

  function set_tipo($tipo) {  $this->tipo = $tipo;  }
  function get_tipo() { return $this->tipo; }
  
  function set_tamaño($tamaño) {  $this->tamaño = $tamaño;  }
  function get_tamaño() { return $this->tamaño; }
}
?>
