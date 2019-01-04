<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Categorias&nbsp;<i class="ti-star"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12">
				<a href="<?= base_url()?>categoria/registrar" class="btn btn-primary text-light">
					Nueva Categoria&nbsp;
					<i class="ti-plus"></i>
				</a>
				<hr>
			</div>

      <div class="col-12 p-4">
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
              <th scope="col">#</th>
              <th scope="col">Nombres</th>
               <th scope="col">abreviatura</th>
              <th scope="col">Imagen</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Estado</th>
              <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
              <?php if (!empty($categorias)): ?>
                <?php $cont = 0; ?>
                <?php foreach ($categorias as $c): ?>
                  <?php $cont++; ?>
                <tr>
                  <td><?php echo $cont ?></td>
                  <td><?php echo $c->cat_nombre; ?></td>
                  <td><?php echo $c->cat_abreviatura; ?></td>
                  <td class="text-center">
                    <a href="javascript:void(0)" data-url='<?= $c->cat_imagen ?>' data-categoria='<?= $c->cat_nombre ?>' class='text-danger imagen-prev'>
                      ver&nbsp;<i class="ti-image"></i> 
                    </a>
                  </td>
                  <td><?php echo $c->cat_descripcion; ?></td>
                  <td>
                    <?php if ($c->cat_estado == 1): ?>
                      <span class="badge badge-danger">Activo</span>
                    <?php endif ?>

                    <?php if ($c->cat_estado == 0): ?>
                      <span class="badge badge-dark">Inactivo</span>
                    <?php endif ?>
                  </td>
                  <td>
                    <?php if ($c->cat_estado == 1): ?>
                    <a href="<?= base_url()?>categoria/desactivar/<?= $c->cat_codigo?>" class="btn btn-dark btn-lg ti-heart-broken" title='desactivar'></a>
                    <?php endif ?>
                    
                    <?php if ($c->cat_estado == 0): ?>
                    <a href="<?= base_url()?>categoria/activar/<?= $c->cat_codigo?>" class="btn btn-danger btn-lg ti-heart" title='activar'></a>
                    <?php endif ?>

                    <a href="<?= base_url()?>categoria/editar/<?= $c->cat_codigo?>" class="btn btn-warning btn-lg ti-pencil" title='editar'>
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

<div class="modal fade" id="modal_imagen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_titulo">Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
 
document.addEventListener('DOMContentLoaded', function(e){
  document.addEventListener('click', function(e){

    if(e.target.matches('.imagen-prev')){
      let contenedor = document.getElementById('modal_body')
      let titulo = document.getElementById('modal_titulo')
      contenedor.innerHTML = ''
      let url  = e.target.dataset.url
      let img  = document.createElement('img')
      img.setAttribute('src', srv.url()+url)
      img.setAttribute('class', 'img-responsive')
      
      contenedor.appendChild(img)
      titulo.textContent = e.target.dataset.categoria
      $('#modal_imagen').modal('show')
    }

  }, false)
}, true)

</script>