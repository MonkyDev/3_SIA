<?php
class AlumnosController extends ControladorBase {
  public $conectar;
  public $adapter;
  public $secure;
  private $val;


  public function __construct() {
    parent::__construct();
    
    $this->conectar = new Conectar();
    $this->secure   = new Middleware();
    $this->adapter  = $this->conectar->cnxMySqli();
  }


  private function uncrypt($val, $pos){

    $prt = explode("x", $val);
    $this->val = $prt[$pos];

  return $this->val;
  }

  
  public function index(){
    $this->view("consultar", 
     [
      "title" => "consultar", 
      "sia" => "Administrativo",
      "ctl"   => "alumnos",
      "acc"   => "buscar",
      "prm" => ID_DEFECTO,
      "load" => 2                 
     ]  
    );
  }


  public function inscripcion() {
  
    $ObjQuery = new ModeloBase('ciclos_escolares', $this->adapter);
    $listGroup = $ObjQuery->getAllGruposCarrerasModalidad();
    $listCiclos = $ObjQuery->getAll();
    $ciclos = null; 
    $grupos = null;

    $mesLetra = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

    if ( !is_bool($listGroup) AND !is_bool($listCiclos)) {

      foreach($listGroup AS $rowG){
        $grupos .= "<option grado='$rowG->grado' plan='$rowG->fk_planesc' value='$rowG->id_grupo'>$rowG->desc_gpo</option>";
      }
      foreach($listCiclos AS $rowC){
        $insc = trim($rowC->mes_inicio." / ".$rowC->anio);
        $desc = trim($mesLetra[$rowC->mes_inicio]." / ".$mesLetra[$rowC->mes_fin]." ".$rowC->anio);
        $ciclos .= "<option curso='$rowC->fecha_curso' ciclo='$insc' value='$rowC->id'>$desc</option>";
      }

      $this->view("inscripcion", 
                 [
                  "title" => "inscripcion", 
                  "sia" => "Administrativo",
                  "ctl"   => "alumnos",
                  "acc"   => "crear",
                  "grupos"=> $grupos,
                  "ciclos"=> $ciclos
                 ]  
      );
    } else {
      die ("No es posible cargar el modulo, por falta de componentes...");
    }
  
  }
  

  public function crear(){
    $continue = true;
    $upload = true;
    $foto = "assets/images/photos/default/avatar.png";
    $alumno = new Alumnos($this->adapter);

      if( isset($_FILES["ocho"]) && $_FILES["ocho"]["size"] == 0)
        $upload = false;

      if ( $upload ) : 
        if (($_FILES["ocho"]["type"]=="image/jpeg" || $_FILES["ocho"]["type"]=="image/jpg" || $_FILES["ocho"]["type"]=="image/png") && $_FILES['ocho']["size"] <= 200000) {

          $extension = pathinfo($_FILES['ocho']['name']); 
          $extension = ".".$extension['extension'];
          $path = "assets/images/photos/alumnos/";
          $img_path = $path.$_POST["dos"].$extension;

          if( move_uploaded_file($_FILES['ocho']['tmp_name'], $img_path) ){
              $foto = $img_path;
              $continue = true;
              
          }  else
            $continue = false;

        } else
            $continue = false;

      else:
        $continue = true;
      endif;
      
      if ($continue && isset($_POST["dos"])) {

        $alumno->setMatricula(trim(htmlentities($_POST['dos'])));
        $alumno->setNombres(trim(htmlentities($_POST['tres'])));
        $alumno->setA_pat(trim(htmlentities($_POST['cuatro'])));
        $alumno->setA_mat(trim(htmlentities($_POST['cinco'])));
        $alumno->setSexo(trim(htmlentities($_POST['seis'])));
        $alumno->setCelular(trim(htmlentities($_POST['siete'])));
        $alumno->setFoto(trim(htmlentities($foto)));
        $alumno->setTipo_ingreso(trim(htmlentities($_POST['nueve'])));
        $alumno->setInscripcion(trim(htmlentities($_POST['diez'])));
        $alumno->setEdo(trim(htmlentities($_POST['once'])));
        $alumno->setfk_ciclo(trim(htmlentities($_POST['doce'])));
        $alumno->setfk_grupo(trim(htmlentities($_POST['trece'])));
        
        if ( is_bool($alumno->save()) ) {
          $this->redirect($_GET['controller'], 'inscripcion', ID_DEFECTO.'?flash=1'); 
          $this->conectar->OutCnx();

        } else
          die( $alumno->save() );

      } else 
          die ("Fallo el formato de la imagen o exede a los 200KB.");
    
  }

  public function buscar(){

    if ( isset($_POST['ipt_search']) AND !empty(trim($_POST['ipt_search'])) ) {
       
    $find = htmlentities($_POST['ipt_search']);
    $ObjAlumno = new ModeloBase('',$this->adapter);

    if( is_bool($result = $ObjAlumno->findAlumno(trim($find))) ) $load = 0; else $load = 1;

      $this->view("consultar", [
        "title" => "consultar", 
        "sia" => "Administrativo",
        "ctl" => "alumnos",
        "acc" => "ver",
        "load" => $load,
        "prm" => ID_DEFECTO,
        "datas" => $result
      ]);

    $this->conectar->OutCnx();
    } else 
       $this->redirect("alumnos", "index", ID_DEFECTO);
    
  }
  


  public function ver(){

    if ( isset($_GET["id"]) AND !empty(trim($_GET["id"])) ) {

      $catch_id =  $this->uncrypt( trim($_GET["id"]), 1 );

    $ObjQuery = new ModeloBase('ciclos_escolares', $this->adapter);
    $listGroup = $ObjQuery->getAllGruposCarrerasModalidad();
    $listCiclos = $ObjQuery->getAll();
    $ciclos = null; 
    $grupos = null;
    $mesLetra = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
          "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
          "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

    if ( !is_bool($listGroup) AND !is_bool($listCiclos)) {

      foreach($listGroup AS $rowG){
        $grupos .= "<option grado='$rowG->grado' plan='$rowG->fk_planesc' value='$rowG->id_grupo'>$rowG->desc_gpo</option>";
      }
      foreach($listCiclos AS $rowC){
        $insc = trim($rowC->mes_inicio." / ".$rowC->anio);
        $desc = trim($mesLetra[$rowC->mes_inicio]." / ".$mesLetra[$rowC->mes_fin]." ".$rowC->anio);
        $ciclos .= "<option curso='$rowC->fecha_curso' ciclo='$insc' value='$rowC->id'>$desc</option>";
      }

      $ObjAlumno = new Alumnos($this->adapter);
      $result = $ObjAlumno->getById( $catch_id );
      $data_alumno = $result[0];
      //var_dump($data_alumno);die;
      $this->view("inscripcion", 
        [
          "title" => "Datos del alumno", 
          "sia" => "Administrativo",
          "ctl" => "alumnos",
          "acc" => "editar",
          "alu" => $data_alumno,
          "grupos"=> $grupos,
          "ciclos"=> $ciclos
       ]
      );

    }else 
      die ("No es posible cargar el modulo, por falta de componentes...");

    }else 
      die ("No se recibieron parametros esperados...");

  }


  public function editar(){
    $continue = true;

    $alumno = new Alumnos($this->adapter);
    $catch_id =  $this->uncrypt( trim($_GET["id"]), 1 );
    $alumno->setId( $catch_id);
    
      if ( isset($_FILES["ocho"]) ) : 
        if (($_FILES["ocho"]["type"]=="image/jpeg" || $_FILES["ocho"]["type"]=="image/jpg" || $_FILES["ocho"]["type"]=="image/png") && $_FILES['ocho']["size"] <= 200000) {

          $extension = pathinfo($_FILES['ocho']['name']); 
          $extension = ".".$extension['extension'];
          $path = "assets/images/photos/alumnos/";
          $img_path = $path.$_POST["dos"].$extension;

          if( move_uploaded_file($_FILES['ocho']['tmp_name'], $img_path) ){
              $foto = $img_path;
              $alumno->setFoto(trim(htmlentities($foto)));
                if ( is_bool($alumno->updatePick()) )
                  $continue = true;
                else
                  $continue = false;

          }  else
            $continue = false;

        } else
            $continue = false;

      else :
        $continue = true;

      endif;


      if ($continue && isset($_GET["id"])) {

        
        $alumno->setMatricula(trim(htmlentities($_POST['dos'])));
        $alumno->setNombres(trim(htmlentities($_POST['tres'])));
        $alumno->setA_pat(trim(htmlentities($_POST['cuatro'])));
        $alumno->setA_mat(trim(htmlentities($_POST['cinco'])));
        $alumno->setSexo(trim(htmlentities($_POST['seis'])));
        $alumno->setCelular(trim(htmlentities($_POST['siete'])));
        $alumno->setTipo_ingreso(trim(htmlentities($_POST['nueve'])));
        $alumno->setInscripcion(trim(htmlentities($_POST['diez'])));
        $alumno->setEdo(trim(htmlentities($_POST['once'])));
        $alumno->setfk_ciclo(trim(htmlentities($_POST['doce'])));
        $alumno->setfk_grupo(trim(htmlentities($_POST['trece'])));
        
        if ( is_bool($alumno->update()) ) {
          $this->redirect($_GET['controller'], 'consultar', ID_DEFECTO.'?flash=1');
          $this->conectar->OutCnx();

        } else
            die ( $alumno->update() );

      } else 
          die ( "Fallo el formato de la imagen o exede a los 200KB." );

  }

  public function eliminar(){
    if ( isset($_GET["id"]) AND !empty(trim($_GET["id"]))) {
      $catch_id =  $this->uncrypt( trim($_GET["id"]), 1 );

      $alumno = new Alumnos($this->adapter);

      if( $alumno->deleteById($catch_id) ) {
        $this->redirect($_GET['controller'], 'consultar', ID_DEFECTO.'?flash=1');
        $this->conectar->OutCnx();        
      }else 
        die( "No se pudo eliminar el registro." );
      
    } else
      die( "No se recibieron los parametros esperados." );
  }
   
} /*END CLASS*/
