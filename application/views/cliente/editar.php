<div class="container" >
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3>Editar Cliente&nbsp;<i class="ti-pencil"></i></h3>
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
				<form id="form-registro" action="<?= base_url()?>cliente/editar_enviar" disabled autocomplete='off' method="POST">
					<input class="form-control" type="hidden" name="inputId" value="<?= $cliente->cli_codigo;?>">
					<div class="form-row">
						<div class="col-12 col-md-6">
							<div class="form-group" id="contDni">
								<label for="inputNumerodoc" class="font-weight-bold">
									Num. Documento
								</label>
								<input name="inputNumerodoc" type="number" class="form-control" value="<?= $cliente->cli_dni;?>" required>
								<div id="feedDni" class="">
							    </div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">Tipo Cliente</label>
								<select name="inputTipocli" class="form-control">
									<!-- <option value="" selected disabled hidden>--SELECCIONAR--</option> -->
									<?php foreach ($tipo_cliente as $tc): ?>
										<?php if ($tc->tcli_codigo === $cliente->cli_tipocliente): ?>
										<option value="<?php echo $tc->tcli_codigo; ?>" selected>
											<?php echo $tc->tcli_titulo;?>
										</option>
										<?php else: ?>
										<option value="<?php echo $tc->tcli_codigo; ?>">
											<?php echo $tc->tcli_titulo;?>
										</option>											
										<?php endif ?>
									<?php endforeach ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="">Nombres</label>
								<input name="inputNombres" type="text" class="form-control" value="<?= $cliente->cli_nombres;?>" required>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="">Apellido Paterno</label>
								<input name="inputPaterno" type="text" class="form-control" value="<?= $cliente->cli_paterno;?>" required>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label for="">Apellido Materno</label>
								<input name="inputMaterno" type="text" class="form-control" value="<?= $cliente->cli_materno;?>" required>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">Telefono</label>
								<input name="inputTelefono" type="text" class="form-control" value="<?= $cliente->cli_telefono;?>">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">Direcion</label>
								<input name="inputDireccion" type="text" class="form-control" value="<?= $cliente->cli_direccion;?>">
							</div>
						</div>
						
					</div>
					<div class="form-row">
						<div class="col-md-4">
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
