<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-default">
      
      <div class="box-body">
    	<table class='table table-striped TableAdvanced'>
  			<thead>
          <tr>
            <th>Carrera</th>
            <th>Grado</th>
            <th>Grupo</th>
            <th>Modalidad</th>
            <th>Acción</th>                                      
          </tr>
        </thead>
        <tbody>
        	<?php
          if (!is_null($prm) && !is_bool($prm)) {
            if ( count($prm)==1 ) {
              $c1 = $this->secure->randing(20)."x";
              $c2 = "x".$this->secure->randing(20);
              $row = $prm[0];

              echo '
                <tr>
                  <td>'.strtoupper($row->fk_carrera).'</td>
                  <td>'.$row->grado.'</td>
                  <td>'.strtoupper($row->letra).'</td>
                  <td>'.ucwords($row->fk_planesc).'</td>
                  <td class="text-center">
                    <a href="'.$helper->url($ctl, $acc, $c1.$row->id_grupo.$c2).'">
                      <div class="btn-group btn-group-xs">                      
                        <button class="btn btn-warning" title="ver">&nbsp;&nbsp;&nbsp;ver&nbsp;&nbsp;&nbsp;</button>
                      </div>
                    </a>
                  </td>
                </tr>
              ';
               
            } else {
              foreach ($prm as $row) {
                $c1 = $this->secure->randing(20)."x";
                $c2 = "x".$this->secure->randing(20);
                echo '
                  <tr>
                    <td>'.strtoupper($row->fk_carrera).'</td>
                    <td>'.$row->grado.'</td>
                    <td>'.strtoupper($row->letra).'</td>
                    <td>'.ucwords($row->fk_planesc).'</td>
                    <td class="text-center">
                      <a href="'.$helper->url($ctl, $acc, $c1.$row->id_grupo.$c2).'">
                        <div class="btn-group btn-group-xs">                      
                          <button class="btn btn-warning" title="ver">&nbsp;&nbsp;&nbsp;ver&nbsp;&nbsp;&nbsp;</button>
                        </div>
                      </a>
                    </td>
                  </tr>
                ';
              } 
            }       
          }
        	?>
        	
  			</tbody>
  		</table>
  		</div>
      <div class="box-footer">
        <a class="btn btn-primary" href="<?=$helper->url($ctl, 'crear', ID_DEFECTO)?>" title="Nuevo registro">
        	<b>Nuevo</b>
       	</a>
      </div>

    </div>
    </div>
  </div> 
</section>     
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