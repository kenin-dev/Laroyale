<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Nuevo Producto&nbsp;<i class="ti-apple"></i></h3>
				<small>Registro</small>
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
				<form id="form-registro" action="<?= base_url()?>producto/registrar_envio" disabled autocomplete='off' method="POST">
					<div class="form-row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputCategoria" class="font-weight-bold">
									Tipo
								</label>
								<select name="inputCategoria" class="form-control" required>
									<option value="" class="text-danger" selected disabled hidden>Seleccionar</option>
									<?php foreach ($categorias as $cat): ?>
									<option value="<?= $cat->cat_codigo;?>"><?php echo $cat->cat_nombre; ?></option>				
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputNombre" class="font-weight-bold">
									Nombre
								</label>
								<input name="inputNombre" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Abreviatura
								</label>
								<input name="inputAbreviatura" type="text" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputPrecio" class="font-weight-bold">
									Precio
								</label>
								<input name="inputPrecio" type="number" step="0.01" class="form-control" required>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Estado Inicial
								</label>
								<select name="inputEstado" class="form-control">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-12 col-md-12">
							<div class="form-group">
								<label for="inputDescripcion" class="font-weight-bold">Descripcion</label>
								<textarea name="inputDescripcion" class="form-control" cols="10" rows="4"></textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<button class="btn btn-primary" id="b-registrar" disabled>
								Registrar Producto&nbsp;
								<i class="ti-save"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url()?>coda/producto.registro.js"></script>
