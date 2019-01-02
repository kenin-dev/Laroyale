<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Nueva Mesa&nbsp;<i class="ti-view-grid"></i></h3>
				<small>Registro</small>
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
			<div class="card-body p-4">
				<form id="form-registro" action="<?= base_url()?>mesa/registrar" autocomplete='off' method="POST">
					<div class="form-row">
						<div class="col-12 col-md-6">
							<div class="form-group" id="contDni">
								<label for="inputNumero" class="font-weight-bold">
									Numero 
								</label>
								<input name="inputNumero" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group" id="contDni">
								<label for="inputEstado" class="font-weight-bold">
									Estado Inicial 
								</label>
								<select name="inputEstado" class="form-control">
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
								<textarea name="inputDescripcion" class="form-control" cols="10" rows="5"></textarea>
							</div>
						</div>

					</div>
					<div class="form-row">
						<div class="col-12 col-md-4">
							<button class="btn btn-primary">
								Registrar Mesa&nbsp;
								<i class="ti-save"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url()?>coda/cliente.registro.js"></script>
