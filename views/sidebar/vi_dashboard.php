<aside class="main-sidebar" style="background: #134A45;">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../../assets/images/photos/default/perfil.jpg" class="img-circle" alt="...">
      </div>
      <div class="pull-left info">
        <p><?= strtoupper($_SESSION['usuario']['name'])?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENÚ PRINCIPAL</li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-group"></i> <span>Alumnos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="<?=$helper->url("alumnos", ACCION_DEFECTO, ID_DEFECTO)?>"><i class="fa fa-circle-o"></i>Consultar</a></li>
          <li class="active"><a href="<?=$helper->url("alumnos", "inscripcion", ID_DEFECTO)?>"><i class="fa fa-circle-o"></i>Inscripcion</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-institution"></i> <span>Escolares</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="<?=$helper->url("grupos", ACCION_DEFECTO, ID_DEFECTO)?>"><i class="fa fa-circle-o"></i>Grupos</a></li>
        </ul>
      </li>

    </ul>
     <ul class="sidebar-menu" data-widget="tree">
      <li class="header">CONFIGURACIONES</li>
       <li class="treeview">
        <a href="#">
          <i class="fa fa-account"></i> <span>Cuenta</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="<?=$helper->url("out", "unsetlog", ID_DEFECTO)?>"><i class="fa fa-circle-o"></i>Salir</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>

<div class="content-wrapper">
<section class="content-header">
  <h1>
    <i class="fa fa-cloud"></i><?= ucwords($title)?> |
    <small>Sistema Modular del <?= ucwords($sia)?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=$helper->url()?>"><i class="fa fa-home"></i> Home</a></li>
    <!-- <li class="active"><?= ucwords($_GET['controller']) ?></li> -->
  </ol>
</section>