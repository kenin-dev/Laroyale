<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Productos&nbsp;<i class="ti-apple"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12 p-4">
				<a href="<?= base_url()?>producto/registrar" class="btn btn-primary text-light">
					Nuevo Producto&nbsp;
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
              <th scope="col">Nombre</th>
              <th scope="col">Abrev.</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Precio</th>
              <th scope="col">Tipo</th>
              <th scope="col">Estado</th>
              <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php $cont = 0; ?>
            <?php foreach ($productos as $p): ?>
              <?php $cont++; ?>
              <tr>
                <!-- <td><?php echo $cont; ?></td> -->
                <td><?php echo $p->prod_nombre; ?></td>
                <td><?php echo $p->prod_abreviatura; ?></td>
                <td><?php echo $p->prod_descripcion; ?></td>
                <td><?php echo $p->prod_precio; ?></td>
                <td><?php echo $p->prod_categoria_nombre; ?></td>
                <td>
                  <?php if ($p->prod_estado == 1): ?>
                  <span class="badge badge-success">Activo</span>
                  <?php else: ?>  
                  <span class="badge badge-warning">Inactivo</span>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($p->prod_estado == 1): ?>
                    <a href="<?= base_url()?>producto/desactivar/<?= $p->prod_codigo;?>" class="btn btn-dark ti-heart-broken" title="Desactivar">
                  <?php else: ?>
                    <a href="<?= base_url()?>producto/activar/<?= $p->prod_codigo;?>" class="btn btn-danger ti-heart" title="Activar">
                  <?php endif ?>

                  <a href="<?= base_url()?>producto/editar/<?= $p->prod_codigo;?>" class="btn btn-warning ti-pencil" title="editar">
                    
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
            </tbody>
        </table>
			</div>
		</div>
	</div>
</div>
<script>
  
  document.addEventListener('DOMContentLoaded', function(e){
    let tl = new TableLibrary('Productos')
    tl.inicializar()
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