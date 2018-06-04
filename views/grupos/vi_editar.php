<?php
if ($prm != 'null') {
$row = $prm[0];
?>
<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-default">
      
      <div class="box-header with-border">
        <h4><font color="#009688">Datos del registro</font></h4>
      </div>

      <form class="form_crear" action="<?= $helper->url($ctl, $acc, $_GET['id'])?>" method="POST">  
      <div class="box-body">

        <div class="form-group col-md-4">
          <label>Literal</label>
          <input class="form-control" onkeyup="trun('siete',1,4)" id="siete" name="siete" value="<?=$row->letra?>" required />
        </div>

        <div class="form-group col-md-4">
          <label>Grado</label>
          <select class="form-control"  id="dos" name="dos">
            <option value="">-- Seleccione --</option>
            <?php 
            for ($i = 1; $i <= 10; $i++) {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
          </select>
        </div>

        <div class="form-group col-md-4">
          <label>Salon</label>
          <input class="form-control" onkeyup="trun('cuatro',5,1)" id="cuatro" value="<?=$row->salon?>" name="cuatro" required />
        </div>

        <div class="form-group col-md-4">
          <label>Carreras</label>
            <select class="form-control SelectAdvanced" style="width: 100%;" id="seis" name="seis">
              <optgroup label="Buscar en Carreras">
                <option value="">-- Seleccione --</option>
                <?php 
                foreach ($carreras AS $car) {
                  echo '<option value="'.$car->clave.'">'.$car->nombre." ".$car->descripcion.'</option>';
                }
                ?>
              </optgroup>        
            </select>
        </div>

        <div class="form-group col-md-4">
          <label>Modalidad</label>
          <select class="form-control"  id="tres" name="tres">
            <option value="">-- Seleccione --</option>
            <option value="CUA">Cuatrimestral</option>
            <option value="SEM">Semestral</option>
          </select>
        </div>

        <div class="form-group col-md-4">
          <label>Turno</label>
          <select class="form-control"  id="cinco" name="cinco">
            <option value="">-- Seleccione --</option>
            <option value="MAT">Mátutino</option>
            <option value="VES">Vespertino</option>
            <option value="MIX">Mixto</option>
          </select>
        </div>
      </div>
      <div class="box-footer">
        <div class="btn-group" id="make">
          <a class="btn btn-primary exe" href="#" id="_new" title="Nuevo"><i class="fa fa-plus fa-md"></i></a>
          <a class="btn btn-danger exe" href="#" id="_del" title="Eliminar"><i class="fa fa-trash fa-md"></i></a>        
        </div>

        <div class="btn-group pull-right" id="action" style="display: none;">
          <a class="btn btn-success exe" href="#"  id="_sav" title="Guardar"><b>Guardar</b></a>
          <input type="hidden" id="showNoty" value="null">
        </div>
         <div class="btn-group float-right" id="trash" style="display: none;">
           <a class="btn btn-danger" href="<?= $helper->url($ctl, "eliminar", $prm->id)?>" title="Eliminar">
            <i class="fa fa-trash"></i>
          </a>
        </div>
      </div>

      
      </form>
    </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  document.getElementById("dos").value = <?= $row->grado ?>;
  document.getElementById("tres").value = '<?= $row->fk_planesc ?>';
  document.getElementById("cinco").value = '<?= $row->turno ?>';
  document.getElementById("seis").value = '<?= $row->fk_carrera ?>';
</script>

<?php  if($notify) {?>
<script>
  function noty(){
      document.getElementById('showNoty').click();
  }
  window.onload = noty;
</script>
<?php unset($notify); } }?>