<?php

class Alumnos extends EntidadBase {

   private $id;
   private $matricula;
   private $nombres;
   private $a_pat;
   private $a_mat;
   private $sexo;
   private $celular;
   private $foto;
   private $tipo_ingreso;
   private $inscripcion;   
   private $fk_ciclo;
   private $fk_grupo;
   private $edo;

  public function __construct($adapter) {
    $table = "alumnos";
    parent::__construct($table, $adapter);
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setMatricula($matricula) {
    $this->matricula = $matricula;
  }

  public function setNombres($nombres) {
    $this->nombres = $nombres;
  }

  public function setA_pat($a_pat) {
    $this->a_pat = $a_pat;
  }

  public function setA_mat($a_mat) {
    $this->a_mat = $a_mat;
  }

  public function setSexo($sexo) {
    $this->sexo = $sexo;
  }

  public function setCelular($celular) {
    $this->celular = $celular;
  }

  public function setFoto($foto) {
    $this->foto = $foto;
  }

  public function setTipo_ingreso($tipo_ingreso) {
    $this->tipo_ingreso = $tipo_ingreso;
  }

  public function setInscripcion($inscripcion) {
    $this->inscripcion = $inscripcion;
  }

  public function setEdo($edo) {
    $this->edo = $edo;
  }

  public function setfk_ciclo($fk_ciclo) {
    $this->fk_ciclo = $fk_ciclo;
  }

  public function setfk_grupo($fk_grupo) {
    $this->fk_grupo = $fk_grupo;
  }

  public function save(){

    $sql = "INSERT INTO alumnos VALUES (
      'NULL',
      '".$this->matricula."',
      '".$this->nombres."',
      '".$this->a_pat."',
      '".$this->a_mat."',
      '".$this->sexo."',
      '".$this->celular."',
      '".$this->foto."',
      '".$this->tipo_ingreso."',
      '".$this->inscripcion."',     
      ".$this->fk_ciclo.",
      '".$this->fk_grupo."',
       ".$this->edo.",
      NULL,
      NULL
    )";

    if ( $this->db()->query($sql) ) 
      $save = true;
    else 
      $save = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
          
  return $save;      
  } 

  public function update(){

  $sql = "UPDATE alumnos SET
          matricula = '".$this->matricula."',
          nombres = '".$this->nombres."',
          a_pat = '".$this->a_pat."',
          a_mat = '".$this->a_mat."',
          sexo = '".$this->sexo."',
          celular = '".$this->celular."',
          tipo_ingreso = '".$this->tipo_ingreso."',
          inscripcion = '".$this->inscripcion."',
          edo = ".$this->edo.",
          fk_ciclo = ".$this->fk_ciclo.",
          fk_grupo = '".$this->fk_grupo."'
          WHERE id = ".$this->id          
         ;

  if ( $this->db()->query($sql) ) 
    $update = true;
  else 
    $update = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
        
  return $update;      
  } 

  public function updatePick(){

  $sql = "UPDATE alumnos SET
          foto = '".$this->foto."'
          WHERE id = ".$this->id          
         ;

  if ( $this->db()->query($sql) ) 
    $update = true;
  else 
    $update = "Falló la consulta: (".$this->db()->errno.")__".$this->db()->error;
        
  return $update;      
  } 



}
