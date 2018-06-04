<?php 

class ModeloBase extends EntidadBase {
  private $table;

  public function __construct($table, $adapter) {
     $this->table = (string) $table;
     parent::__construct($table, $adapter);

  }

  public function getAllGruposCarrerasModalidad(){
    $sql = "  
            SELECT
            gpo.id AS id_grupo,
            gpo.grado,fk_planesc,
            CONCAT(gpo.grado,'',gpo.letra,' ',car.clave,' ',gpo.fk_planesc) AS desc_gpo
            FROM grupos gpo
            INNER JOIN carreras car ON car.clave = gpo.fk_carrera
            INNER JOIN planes_escolares psc ON psc.id = gpo.fk_planesc
            ORDER BY id_grupo
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function getAllGrupos(){
    $sql = "  
            SELECT
            gpo.id AS id_grupo,
            fk_carrera,
            gpo.grado,gpo.letra,gpo.fk_planesc
            FROM grupos gpo
            INNER JOIN carreras car ON car.clave = gpo.fk_carrera
            INNER JOIN planes_escolares psc ON psc.id = gpo.fk_planesc
            ORDER BY id_grupo
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[] =$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function getAllCarreras(){
    $sql = "  
            SELECT  c.id AS id_carrera,clave,nombre,descripcion
            FROM plan_estudios p
            INNER JOIN carreras c on c.clave = p.clave_carrera
            INNER JOIN planes_escolares e on e.id = p.fk_planesc             
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function findAlumno($find){
    $query = $this->db()->query("
      SELECT *,
      alu.id AS id_alu,
      CONCAT_WS( ' ', TRIM(a_pat) , TRIM(a_mat), TRIM(nombres) ) AS NombreCompleto
      FROM alumnos alu
      INNER JOIN grupos gpo ON gpo.id = alu.fk_grupo
      WHERE matricula
      LIKE '%$find%'
      OR  CONCAT_WS( ' ', TRIM(a_pat) , TRIM(a_mat) )  LIKE '%$find%'"
    );

     if($query){
       if( $query->num_rows > 1 ){
           while( $row = $query->fetch_object() ) {
              $resultSet[] = $row;
           }

       }else if( $query->num_rows == 1 ){
           $row = $query->fetch_object();
               $resultSet[] = $row;
           
       }else
           $resultSet = false;
         
     }else
         $resultSet = false;
     
  return $resultSet;
  }

/*
  public function getAllGruposXCarrerasXModalidad(){
    $sql = "  
            SELECT
            gpo.id AS id_grupo,
            gpo.grado,fk_planesc,
            CONCAT(gpo.grado,'',gpo.grupo,' ',car.clave,' ',gpo.fk_planesc) AS desc_gpo
            FROM grupos gpo
            INNER JOIN carreras car ON car.id = gpo.fk_carrera
            INNER JOIN planes_escolares psc ON psc.id = gpo.fk_planesc
            ORDER BY id_grupo
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }


  public function getAllCiclosXPlanEscolar(){
    $sql = "  
            SELECT cie.id,mes_inicio,mes_fin,anio,descripcion
            FROM ciclo_escolar cie
            INNER JOIN plan_escolar pes ON pes.id = cie.fk_plnesc
            
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function getCiclosXPlanEscolarById($id){
    $sql = "  
            SELECT cie.id,mes_inicio,mes_fin,anio,descripcion,fk_plnesc
            FROM ciclo_escolar cie
            INNER JOIN plan_escolar pes ON pes.id = cie.fk_plnesc
            WHERE cie.id = ".$id
          ;
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function getAllCarreras(){
    $sql = "  
            SELECT  c.id AS id_carrera,nombre,descripcion
            FROM plan_estudios p
            INNER JOIN carreras c on c.id = p.fk_carrera
            INNER JOIN planes_escolares e on e.id = p.fk_planesc             
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function getAllGruposXCarreras(){
    $sql = "  
            SELECT gpo.id AS id_grupo,gpo.grado,gpo.grupo,pes.descripcion,car.clave
            FROM grupos gpo
            INNER JOIN carreras car ON car.id = gpo.fk_carrera
            INNER JOIN planes_escolares pes ON pes.id = gpo.fk_planesc         
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function get_id_alu_by_anio_disc($anio, $disc){
    $sql = "  
            SELECT
            CONCAT(CAR.nombre,' ',PLE.descripcion) AS desc_carrera,
            CONCAT(nombres,' ',a_pat,' ',a_mat) AS nomb_alumno,
            GPO.grado,
            ALU.matricula,
            DIS.descripcion,
            PAR.anio
            FROM participaciones PAR
            INNER JOIN alumnos ALU ON ALU.id = PAR.id_alumno
            INNER JOIN grupos GPO ON GPO.id_grupo = ALU.id_grupo
            INNER JOIN plan_escolar PLE ON PLE.id_plnesc = GPO.fk_modali
            INNER JOIN carreras CAR ON CAR.id_carrera = GPO.fk_carrera
            INNER JOIN disciplinas DIS ON DIS.id = PAR.id_disciplina
            WHERE anio = '".$anio."'
            AND id_disciplina = ".$disc."
            AND PAR.edo = 1 
            ORDER BY DIS.descripcion       
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }

  public function get_id_alu_by_periodo_edo($anio, $periodo, $edo){
    $sql = "  
            SELECT
            CONCAT(CAR.nombre,' ',PLE.descripcion) AS desc_carrera,
            CONCAT(nombres,' ',a_pat,' ',a_mat) AS nomb_alumno,
            GPO.grado,
            ALU.matricula,
            DIS.descripcion,
            PAR.anio,
            DATE_FORMAT(PAR.create_at, '%m') AS registro,
            PAR.edo
            FROM participaciones PAR
            INNER JOIN alumnos ALU ON ALU.id = PAR.id_alumno
            INNER JOIN grupos GPO ON GPO.id_grupo = ALU.id_grupo
            INNER JOIN plan_escolar PLE ON PLE.id_plnesc = GPO.fk_modali
            INNER JOIN carreras CAR ON CAR.id_carrera = GPO.fk_carrera
            INNER JOIN disciplinas DIS ON DIS.id = PAR.id_disciplina
            WHERE YEAR(PAR.create_at) = '".$anio."'
            AND MONTH(PAR.create_at) BETWEEN ".$periodo."
            AND PAR.edo = ".$edo."
            ORDER BY DIS.descripcion       
           ";
    if ( $result = $this->db()->query($sql) ){
      if ($result->num_rows == 1 ) {
        $row = $result->fetch_object();
          $resultSet[]=$row;

      } elseif ( $result->num_rows > 1 ) {
        while( $row = $result->fetch_object() ) {
          $resultSet[]=$row;
        }

      } else
        $resultSet = false;

    } else
      $resultSet = false;
      
  return $resultSet;
  }
  
  */
  /*------------------ DETERMINAMOS, que los usuarios al fua son con el estado 9----------------*/
  public function getDatasUsuario($id){
    $query = $this->db()->query("
      SELECT
      ams.id as id_administrativo,
      fk_cuenta,name,password,nombre,usr.type
      FROM users usr
      INNER JOIN administrativos ams ON ams.id = usr.fk_cuenta
      WHERE usr.edo = 1
      AND usr.id = ".$id."
      ");

     if($query){
       if( $query->num_rows > 1 ){
           while( $row = $query->fetch_object() ) {
              $resultSet[] = $row;
           }

       }else if( $query->num_rows == 1 ){
           $row = $query->fetch_object();
               $resultSet = $row;
           
       }else
           $resultSet = false;
         
     }else
         $resultSet = false;
     
  return $resultSet;
  }

}