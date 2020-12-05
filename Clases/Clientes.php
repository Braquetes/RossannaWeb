<?php
class clientes{
  // Propiedades
  public $id;
  public $nombre;
  // Metodos
  function set_id($id) {  $this->id = $id;  }
  function get_id() { return $this->id; }

  function set_nombre($nombre) {  $this->nombre = $nombre;  }
  function get_nombre() { return $this->nombre; }
}
?>
