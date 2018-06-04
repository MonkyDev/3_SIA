<?php
if ( isset($prm) ) {
?>
<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-default">
      
      <div class="box-header with-border">
        <h4><font color="#009688">Datos del registro</font></h4>
      </div>

      <form class="form_crear_gpo" action="<?= $helper->url($ctl, $acc, ID_DEFECTO)?>" method="POST"> 
        <div class="box-body">
        <input type="hidden" name="rndUnk" value="<?= $rndUnk?>">
        
        <div class="form-group col-md-4">
          <label>Literal</label>
          <input class="form-control" onkeyup="trun('siete',1,4)" id="siete" name="siete" required />
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
          <input class="form-control" onkeyup="trun('cuatro',5,1)" id="cuatro" name="cuatro" required />
        </div>

        <div class="form-group col-md-4">
          <label>Carreras</label>
            <select class="form-control SelectAdvanced" style="width: 100%;" id="seis" name="seis">
              <optgroup label="Buscar en Carreras">
                <option value="">-- Seleccione --</option>
                <?php 
                foreach ($prm AS $row) {
                  echo '<option value="'.$row->clave.'">'.$row->nombre." ".$row->descripcion.'</option>';
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

       <div class="box-footer text-right" id="action">
          <a class="btn btn-success exe" href="#"  id="_sav" title="Guardar"><strong>Guardar</strong></a>
          <input type="hidden" id="showNoty" value="null">
        </div>

      
      </form>
    </div>
    </div>
  </div>
</section>

<?php  if($notify) {?>
<script>
  function noty(){
      document.getElementById('showNoty').click();
  }
  window.onload = noty;
</script>
<?php unset($notify); } }?>