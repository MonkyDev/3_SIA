<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-default">
        
      <div class="box-header with-border">
        <h4><font color="#009688">Datos Personales</font></h4>
      </div>

      <form class="form_crear" action="<?= $helper->url($ctl, $acc, isset($_GET['id'])? $_GET['id'] : ID_DEFECTO)?>" method="POST" enctype="multipart/form-data">            

        <div class="box-body">
        <span class="row">
        <div class="form-group col-md-4">
          <label>Nombre(s)</label>
          <input class="form-control" id="tres" name="tres" onkeyup="trun('tres',255,4)" 
          value="<?= isset($alu)? $alu->nombres : ''?>" required autofocus />
        </div>

        <div class="form-group col-md-4">
          <label>A. Paterno</label>
          <input class="form-control" id="cuatro" onkeyup="trun('cuatro',255,4)" name="cuatro"
          value="<?= isset($alu)? $alu->a_pat : ''?>" required />
        </div>

        <div class="form-group col-md-4">
          <label>A. Materno</label>
          <input class="form-control" id="cinco" onkeyup="trun('cinco',255,4)" name="cinco"
          value="<?= isset($alu)? $alu->a_mat : ''?>" required />
        </div>
        </span>
        <span class="row">
        <div class="form-group col-md-4">
          <label>Genero</label>
          <select class="form-control"  id="seis" name="seis">
            <option value="">-- Seleccione --</option>
            <option value="H">Hombre</option>
            <option value="M">Mujer</option>
          </select>
        </div>

        <div class="form-group col-md-4">
          <label>Celular</label>
          <input class="form-control" id="siete" onkeyup="trun('siete',13,2)" name="siete" 
          value="<?= isset($alu)? $alu->celular : ''?>"required/>
        </div>
        </span>
        <span class="row">
        <ul class="nav nav-tabs">
          <h5><font color="#009688">Datos Escolares</font></h5>
        </ul>
        <br>
        <span class="row">      
        <div class="form-group col-md-4">
          <label>Matricula</label>
          <input class="form-control" id="dos" onkeyup="trun('dos',10,1)" name="dos" 
          value="<?= isset($alu)? $alu->matricula : ''?>"required/>
        </div>
              
        <div class="form-group col-md-4">
          <label>Ciclo Escolar</label>
            <select class="SelectAdvanced" style="width: 100%" id="doce" name="doce">
              <optgroup label="Buscar en Ciclos">
                <option value="">-- Seleccione --</option>
                <?=$ciclos?>
              </optgroup>        
            </select>
        </div>

        <div class="form-group col-md-4">
          <label>Grupo</label>
            <select class="SelectAdvanced" style="width: 100%" id="trece" name="trece">
              <optgroup label="Buscar en Grupos">
                <option value="">-- Seleccione --</option>
                <?=$grupos?>
              </optgroup>
            </select>
        </div> 
        </span>
        <span class="row">
        <div class="form-group col-md-4">
          <label>Fecha de Inscripción</label>
          <input class="form-control" id="diez" onkeyup="trun('diez',10,3)" name="diez" 
          value="<?= isset($alu)? $alu->inscripcion : ''?>"required />
        </div>   

        <div class="form-group col-md-4">
          <label>Tipo de ingreso</label>
          <select class="form-control"  id="nueve" name="nueve">
            <option value="">-- Seleccione --</option>
            <option value="Nuevo Ingreso">Nuevo</option>
            <option value="Regular">Regular</option>
            <option value="Repetidor">Repetidor</option>
          </select>
        </div>        

        <div class="form-group col-md-4">
          <input type="hidden" id="once" name="once" value="1">
        </div>
        </span>
        <ul class="nav nav-tabs">
          <h5><font color="#009688">Fotografía</font></h5>
        </ul>
        <br>
        <?php
        if ( isset($alu) ) { ?>
        <div class="form-group col-md-4">
          <button class="btn btn-warning" type="button" id="btn" onclick="newPick()">Nueva Foto</button>
          <input type="file" id="ocho" name="ocho" required disabled style="display: none;" />
          <input type="hidden" id="max" name="MAX_FILE_SIZE" value="200000" disabled>        
        </div>
        <?php } else {?>
        <div class="form-group col-md-4">
          <label>Foto del alumno</label>
          <input type="file" id="ocho" name="ocho" required/>
          <input type="hidden" id="max" name="MAX_FILE_SIZE" value="200000">        
        </div> 
        <?php } ?>
      </div>

      <div class="box-footer" id="make">
        <a class="btn btn-primary exe" href="#" id="_new" title="Nuevo"><i class="fa fa-plus fa-md"></i></a>
        <a class="btn btn-danger exe" href="#" id="_del" title="Eliminar"><i class="fa fa-minus fa-md"></i></a> 
        <input type="hidden" id="_bam" name="_bam" value="<?= $helper->url($ctl, "eliminar", $_GET['id'])?>">  
        <!-- <a class="btn btn-primary exe" href="#" id="_upd" title="Modificar"><i class="fa fa-edit fa-md"></i></a> -->
      </div>

      <div class="box-footer text-right" id="action" style="display: none;">
        <a class="btn btn-success exe" href="#"  id="_sav" title="Guardar"><b>Guardar</b></a>
        <!-- <a class="btn btn-default exe" href="#" id="_cnc" title="Cancelar"><b></b>Cancelar</a> -->
<!--         <a class="btn btn-info" href="#" id="showPeri" title="Ver periodos"><b></b></a>
 -->        <input type="hidden" id="showNoty" value="null">
      </div>

      </form>   

    </div>
    </div>
  </div>
</section>

<?php if ( isset($alu) ){?>
<script type="text/javascript">
  document.getElementById("seis").value   = "<?=(string)$alu->sexo ?>";
  document.getElementById("doce").value   =  <?=$alu->fk_ciclo?>;
  document.getElementById("trece").value  = "<?=(string)$alu->fk_grupo?>";
  document.getElementById("nueve").value  = "<?=(string)$alu->tipo_ingreso?>";
  document.getElementById("once").value   =  <?=$alu->edo?>;
</script>
<?php } ?>


<?php
$uri = $_SERVER["REQUEST_URI"];  
$flash = explode('?', $uri);
if( isset($flash[1]) ){
$part_flash = explode('=', $flash[1]);
if ( $part_flash[0]=='flash' && $part_flash[1]==1 ){?>
<script type="text/javascript">
 window.onload = alert('Acción realizada correctamente!');
</script>
<?php }}?>