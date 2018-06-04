<?php
class GruposController extends ControladorBase {
  public $conectar;
  public $adapter;
  public $secure;
  private $val;

  public function __construct() {
     parent::__construct();

     $this->conectar = new Conectar();
     $this->secure   = new Middleware();
     $this->adapter = $this->conectar->cnxMySqli();
  }

  
  private function uncrypt($val, $pos){

    $prt = explode("x", $val);
    $this->val = $prt[$pos];

  return $this->val;
  }


  public function index() {    

    $ObjGrupos = new ModeloBase('', $this->adapter);
    $result = $ObjGrupos->getAllGrupos();
    //var_dump($result);die;
    $this->view("grupos", 
      [
        "title" => "grupos", 
        "sia" => "Administrativo",
        "ctl" => "grupos",
        "acc" => "ver",
        "prm" => $result
      ]
    );

  }


  public function crear() {
    if (isset($_POST['dos']) AND !empty(trim($_POST['dos'])) ) {
      if ( isset($_POST['rndUnk']) AND trim($_POST['rndUnk']) == $_SESSION['uniqe'] ) :
      
      //var_dump($_POST);die;
      $grupo = new Grupos($this->adapter);

      $grupo->set_grado(trim(htmlentities($_POST['dos'])));
      $grupo->set_fk_planesc(trim(htmlentities($_POST['tres'])));
      $grupo->set_salon(trim(htmlentities($_POST['cuatro'])));
      $grupo->set_turno(trim(htmlentities($_POST['cinco'])));
      $grupo->set_fk_carrera(trim(htmlentities($_POST['seis'])));
      $grupo->set_letra(trim(htmlentities($_POST['siete'])));

      unset($_SESSION['uniqe']);
      
        if ( is_bool($grupo->save()) ) {
          $_SESSION['uniqe'] = uniqid();
          $this->redirect($_GET['controller'],ACCION_DEFECTO,ID_DEFECTO.'?flash=1');
          $this->conectar->OutCnx();

        } else
          die( $grupo->save() );

       else:
          $this->redirect($_GET['controller'],ACCION_DEFECTO,ID_DEFECTO);
      endif;
          
    } else {

      $ObjCarreras = new ModeloBase('', $this->adapter);
      $result = $ObjCarreras->getAllCarreras();
      $_SESSION['uniqe'] = uniqid();
      $this->view("crear", 
        [
          "title" => "crear grupo", 
          "sia" => "Administrativo",       
          "ctl" => "grupos",
          "acc" => "crear",
          "prm" => $result,
          "notify" => false,
          "rndUnk" => $_SESSION['uniqe'],
        ]
      );
    }

  }


  public function ver() {
    if ( isset($_GET["id"]) ) {
    $id_grupo = $this->uncrypt($_GET["id"], 1);
    $ObjCarreras = new ModeloBase('', $this->adapter);
    $carreras = $ObjCarreras->getAllCarreras();

    $ObjGrupos = new Grupos($this->adapter);
    $result = $ObjGrupos->getById($id_grupo);

    //var_dump($carreras);die;
    $this->view("editar", 
      [
        "title" => "editar grupo", 
        "sia" => "Administrativo",       
        "ctl" => "grupos",
        "acc" => "editar",
        "prm" => $result,
        "carreras" => $carreras,
        "notify" => false
      ]
    );

    }

  }


  public function editar() {
    if ( isset($_GET["id"]) ) {

      $grupo = new Grupos($this->adapter);
      $id_grupo = $this->uncrypt($_GET["id"], 1);
      
      $grupo->set_id($id_grupo);
      $grupo->set_grado(trim(htmlentities($_POST['dos'])));
      $grupo->set_fk_planesc(trim(htmlentities($_POST['tres'])));
      $grupo->set_salon(trim(htmlentities($_POST['cuatro'])));
      $grupo->set_turno(trim(htmlentities($_POST['cinco'])));
      $grupo->set_fk_carrera(trim(htmlentities($_POST['seis'])));
      $grupo->set_letra(trim(htmlentities($_POST['siete'])));


        if ( $grupo->update() ) {
          $this->redirect($_GET['controller'],ACCION_DEFECTO,ID_DEFECTO.'?flash=1');          
          $this->conectar->OutCnx();
        } else
            echo $grupo->update();

    } else 
        die( "Fallo la modificación del registro." );

  }


  public function eliminar(){
    if ( isset($_GET["id"]) ) {
      $carreras = new Grupos($this->adapter);
      $id_grupo = $this->uncrypt($_GET["id"], 1);
      
      if( $carreras->deleteById($id_grupo) ) {
        $this->redirect("grupos", ACCION_DEFECTO, ID_DEFECTO.'?flash=1');
        $this->conectar->OutCnx();        
      }else 
        echo "No sé pudo eliminar el registro.";
      
    }
  }


   
}