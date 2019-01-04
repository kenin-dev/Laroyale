<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Editar Producto&nbsp;<i class="ti-apple"></i></h3>
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
				<form id="form-registro" action="<?= base_url()?>producto/editar_envio" disabled autocomplete='off' method="POST">
					<input type="hidden" value="<?= $producto->prod_codigo; ?>" name="inputCodigo" >
					<div class="form-row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputCategoria" class="font-weight-bold">
									Tipo
								</label>
								<select name="inputCategoria" class="form-control" required>
									<option value="" class="text-danger" selected disabled hidden>Seleccionar</option>
									<?php foreach ($categorias as $cat): ?>
										<?php if ($cat->cat_codigo == $producto->prod_categoria): ?>
											<option value="<?= $cat->cat_codigo;?>" selected><?php echo $cat->cat_nombre; ?></option>
										<?php else: ?>
											<option value="<?= $cat->cat_codigo;?>"><?php echo $cat->cat_nombre; ?></option>			
										<?php endif ?>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputNombre" class="font-weight-bold">
									Nombre
								</label>
								<input name="inputNombre" type="text" class="form-control" value="<?= $producto->prod_nombre;?>" required>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Abreviatura
								</label>
								<input name="inputAbreviatura" type="text" class="form-control" value="<?= $producto->prod_abreviatura;?>" required>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputPrecio" class="font-weight-bold">
									Precio
								</label>
								<input name="inputPrecio" type="number" step="0.01" class="form-control" value="<?= $producto->prod_precio;?>" required>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="inputAbreviatura" class="font-weight-bold">
									Estado Inicial
								</label>
								<select name="inputEstado" class="form-control">
									<?php if ($producto->prod_estado == 1): ?>
										<option value="1" selected>Activo</option>
										<?php else: ?>
										<option value="1">Activo</option>
									<?php endif ?>
									
									<?php if ($producto->prod_estado == 0): ?>
										<option value="0" selected>Activo</option>
										<?php else: ?>
										<option value="0">Activo</option>
									<?php endif ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-12 col-md-12">
							<div class="form-group">
								<label for="inputDescripcion" class="font-weight-bold">Descripcion</label>
								<textarea name="inputDescripcion" class="form-control" cols="10" rows="4">
									<?php echo $producto->prod_descripcion; ?>
								</textarea>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4">
							<button class="btn btn-warning" id="b-editar" disabled>
								Actualizar Datos&nbsp;
								<i class="ti-export"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url()?>coda/producto.editar.js"></script>
