<?php

class Grupos extends EntidadBase {

  private $id; 
  private $grado;
  private $fk_planesc;
  private $salon;
  private $turno;
  private $fk_carrera;
  private $letra;

  public function __construct($adapter) {
    $table = "grupos";
    parent::__construct($table, $adapter);
  } 

  public function set_id($id){
    $this->id = $id;
  }

  public function set_grado($grado){
    $this->grado = $grado;
  }

  public function set_fk_planesc($fk_planesc){
    $this->fk_planesc = $fk_planesc;
  }

  public function set_salon($salon){
    $this->salon = $salon;
  }

  public function set_turno($turno){
    $this->turno = $turno;
  }

  public function set_fk_carrera($fk_carrera){
    $this->fk_carrera = $fk_carrera;
  }

  public function set_letra($letra){
    $this->letra = $letra;
  }

  public function save(){

    $sql = "INSERT INTO grupos VALUES (
      'NULL',
      '".$this->fk_carrera."',
      '".$this->fk_planesc."',
      '".$this->turno."',
      ".$this->grado.",
      '".$this->letra."',
      '".$this->salon."',
      1,
      'NULL',
      'NULL'
    )";

    if ( $this->db()->query($sql) ) 
      $save = true;
    else 
      $save = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
          
  return $save;      
  }
  

  public function update(){

    $sql = "UPDATE grupos SET
            fk_carrera = '".$this->fk_carrera."',
            fk_planesc = '".$this->fk_planesc."',
            turno = '".$this->turno."',
            grado = ".$this->grado.",
            letra = '".$this->letra."',
            salon = '".$this->salon."'
            WHERE id = ".$this->id
    ;

    if ( $this->db()->query($sql) ) 
      $update = true;
    else 
      $update = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
          
  return $update;      
  } 

  public function delete(){

    $sql = "DELETE FROM grupos
            WHERE id = ".$this->id
    ;

    if ( $this->db()->query($sql) ) 
      $update = true;
    else 
      $update = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
          
  return $update;      
  } 


}
