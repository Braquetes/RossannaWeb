<?php
class empleados{
  // Propiedades
  public $id;
  public $nombres;
  public $apellido_p;
  public $apellido_m;
  public $usuario;
  public $contraseña;
  public $cargo;
  public $turno_entrada;
  public $turno_salida;

  // Metodos
  function set_id($id) {  $this->id = $id;  }
  function get_id() { return $this->id; }

  function set_nombres($nombres) {  $this->nombres = $nombres;  }
  function get_nombres() { return $this->nombres; }

  function set_apellido_p($apellido_p) {  $this->apellido_p = $apellido_p;  }
  function get_apellido_p() { return $this->apellido_p; }

  function set_apellido_m($apellido_m) {  $this->apellido_m = $apellido_m;  }
  function get_apellido_m() { return $this->apellido_m; }

  function set_usuario($usuario) {  $this->usuario = $usuario;  }
  function get_usuario() { return $this->usuario; }

  function set_contraseña($contraseña) {  $this->contraseña = $contraseña;  }
  function get_contraseña() { return $this->contraseña; }

  function set_cargo($cargo) {  $this->cargo = $cargo;  }
  function get_cargo() { return $this->cargo; }

  function set_turno_entrada($turno_entrada) {  $this->turno_entrada = $turno_entrada;  }
  function get_turno_entrada() { return $this->turno_entrada; }

  function set_turno_salida($turno_salida) {  $this->turno_salida = $turno_salida;  }
  function get_turno_salida() { return $this->turno_salida; }
}
?>
