<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Editar Mesa&nbsp;<i class="ti-view-grid"></i></h3>
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
				<form id="form-registro" action="<?= base_url()?>mesa/editar_enviar" autocomplete='off' method="POST">
					<input class="form-control" type="hidden" name="inputId" value="<?= $mesa->mes_codigo;?>">
					<div class="form-row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="inputNumero" class="font-weight-bold">
									Numero 
								</label>
								<input name="inputNumero" type="text" class="form-control" value="<?= $mesa->mes_numero; ?>" required>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group" id="contDni">
								<label for="inputEstado" class="font-weight-bold">
									Estado Inicial 
								</label>
								<select name="inputEstado" class="form-control" value="<?= $mesa->mes_estado; ?>">
									<option value="activo">Activo</option>
									<option value="inactivo">Inactivo</option>
									<option value="mantenimiento">Mantenimiento</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-12">
							<div class="form-group" id="contDni">
								<label for="inputDescripcion" class="font-weight-bold">
									Descripcion 
								</label>
								<textarea name="inputDescripcion" class="form-control" cols="10" rows="5"><?= $mesa->mes_descripcion; ?></textarea>
							</div>
						</div>

					</div>
					<div class="form-row">
						<div class="col-12 col-md-4">
							<button class="btn btn-warning text-dark">
								Enviar Cambios&nbsp;
								<i class="ti-export"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url()?>coda/cliente.registro.js"></script>
