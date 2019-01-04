<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Editar Categoria&nbsp;<i class="ti-pencil"></i></h3>
				<small>Actualizacion de datos</small>
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
			<div class="card-body p-4">
				<form id="form-registro" action="<?= base_url()?>categoria/editar_enviar" disabled autocomplete='off' method="POST" enctype="multipart/form-data">
					<input type="hidden" name="inputCodigo" value="<?= $categoria->cat_codigo;?>">
					<div class="form-row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputNombre" class="font-weight-bold">
									Nombre
								</label>
								<input name="inputNombre" type="text" class="form-control text-uppercase" required value="<?= $categoria->cat_nombre;?>">
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Abreviatura
								</label>
								<input name="inputAbreviatura" type="text" class="form-control text-uppercase" required value="<?= $categoria->cat_abreviatura;?>">
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Estado Inicial
								</label>
								<select name="inputEstado" class="form-control">
									<?php if ($categoria->cat_estado == 1): ?>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									<?php endif ?>
									<?php if ($categoria->cat_estado == 0): ?>
										<option value="1">Activo</option>
										<option value="0" selected>Inactivo</option>
									<?php endif ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-12 col-md-12">
							<div class="form-group">
								<label for="inputDescripcion" class="font-weight-bold">Descripcion</label>
								<textarea name="inputDescripcion" class="form-control" cols="10" rows="4"> <?= $categoria->cat_descripcion; ?> </textarea>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="inputImagen" class="font-weight-bold">Imagen Nueva</label>
								<input id="inputImagen" name="inputImagen" type="file" class="form-control">
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group text-center">
								<p for="inputImagen" class="font-weight-bold text-dark">&nbsp;</p>
								<a href="javascript:void()" class="text-danger" data-toggle="modal" data-target="#modal_imagen">
									Ver imagen actual&nbsp;
									<i class="ti-image"></i>
								</a>
								<!-- <h3 class="display-2">
									<i class="ti-image"></i>
								</h3> -->
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<button class="btn btn-warning" id="b-editar" disabled>
								Actualizar Datos&nbsp;
								<i class="ti-save"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_imagen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_titulo"><?php echo $categoria->cat_nombre; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
    	<img src="<?php echo base_url().$categoria->cat_imagen; ?>" alt="imagen_actual" class='img-responsive'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url()?>coda/categoria.editar.js"></script>
