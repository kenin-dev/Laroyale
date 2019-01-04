<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Mesas&nbsp;<i class="ti-view-grid"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12 p-4">
				<a href="<?= base_url()?>mesa/nuevo" class="btn btn-primary text-light">
					Nueva Mesa&nbsp;
					<i class="ti-plus"></i>
				</a>
				<hr>
			</div>
      
      <div class="col-12">
        <?php if ($this->session->flashdata('correcto')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Correcto : </strong>&nbsp;<?php echo $this->session->flashdata('correcto'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error : </strong>&nbsp;<?php echo $this->session->flashdata('error'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php endif ?>
      </div>

			<div class="col-12">
				<table id="dtable" class="table table-bordered">
          <thead class="thead-secondary">
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Numero</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
              <?php if (!empty($mesas)): ?>
                <?php $cont = 0; ?>
                <?php foreach ($mesas as $ms): ?>
                  <?php $cont++; ?>
                <tr class="">
                  <!-- <td><?php echo $cont ?></td> -->
                  <td><?php echo $ms->mes_numero; ?></td>
                  <td><?php echo $ms->mes_descripcion; ?></td>
                  <td>
                    <a id="mesa-eliminar" href="<?= base_url()?>mesa/eliminar/<?= $ms->mes_codigo ?>" data-mesa='<?= $ms->mes_numero ?>' class="btn btn-danger btn-lg ti-trash">
                    </a> 
                    <a href="<?= base_url()?>mesa/editar/<?= $ms->mes_codigo?>" class="btn btn-warning btn-lg ti-pencil">
                    </a>
                  </td>
                </tr>
                <?php endforeach ?>
              <?php endif ?>
            </tbody>
        </table>
			</div>
		</div>
	</div>
</div>
<script>
 
  document.addEventListener('DOMContentLoaded', function(e){
    document.addEventListener('click', function(e){
      if(e.target.matches('#mesa-eliminar')){
        let mesa = e.target.dataset.mesa
        let resp = confirm('Eliminar a '+mesa+'?')
        if (resp) {
          console.log('enviado para eliminar: '+mesa)
        }else{
          e.preventDefault()
        }
      }
    }, false)

  }, true)

</script>