<div class="col-12 col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Crear Cuenta </h3>
			<small><?php echo $pedido->ped_serie; ?></small>
		</div>
		<div class="card-body">
			<input id="e_pedido" data-id="<?= $pedido->ped_codigo;?>" type="hidden">
			<!-- <div class="row">
				<div class="col-md-6 col-lg-4 col-12">
					<div class="card">
			            <div class="p-0 clearfix">
			                <i class="ti-headphone-alt bg-warning p-4 font-2xl mr-3 float-left text-light"></i>
			                <input id="e_pedido" data-id="<?= $pedido->ped_codigo;?>" type="hidden">
			                <div class="h5 text-warning mb-0 pt-3">
			                	<?php echo $pedido->ped_tipo_nombre; ?>
			                </div>
			                <div class="text-muted text-uppercase font-weight-bold font-xs small">Consumo</div>
			            </div>
			        </div>
				</div>
				<div class="col-md-6 col-lg-6 col-12">
					<div class="card">
			            <div class="p-0 clearfix">
			                <i class="ti-location-pin bg-info p-4 font-2xl mr-3 float-left text-light"></i>
			                <div class="h5 text-info mb-0 pt-3">
			                	<?php echo $pedido->ped_destino; ?>
			                </div>
			                <div class="text-muted text-uppercase font-weight-bold font-xs small">Destino</div>
			            </div>
			        </div>
				</div>
				<div class="col-md-6 col-lg-4 col-12">
					<div class="card">
			            <div class="p-0 clearfix">
			                <i class="ti-calendar bg-danger p-4 font-2xl mr-3 float-left text-light"></i>
			                <div class="h5 text-danger mb-0 pt-3">
			                	<?php echo $pedido->ped_fecha; ?>
			                </div>
			                <div class="text-muted text-uppercase font-weight-bold font-xs small">Fecha</div>
			            </div>
			        </div>
				</div>
				<div class="col-md-4 col-lg-4 col-12">
					<div class="card">
			            <div class="p-0 clearfix">
			                <i class="ti-ticket bg-primary p-4 font-2xl mr-3 float-left text-light"></i>
			                <div class="h5 text-primary mb-0 pt-3">
			                	<?php echo $pedido->ped_subtotal; ?> S/
			                </div>
			                <div class="text-muted text-uppercase font-weight-bold font-xs small">Subtotal</div>
			            </div>
			        </div>
				</div>
			</div> -->
			<div class="row pl-3">
				
				<button id="b-agregar" data-pedido="<?= $pedido->ped_codigo;?>" class="btn btn-excel text-light" disabled>
					Cuenta&nbsp;
					<i class="ti-plus"></i>
				</button>
				&nbsp;
				<button id="b-registrar" class="btn btn-primary text-light" disabled>
					Registrar&nbsp;
					<i class="ti-plus"></i>
				</button>
			</div>
			<hr>
			
			<div id="contenedor_cuotas" class="row">

				 

			</div>

		</div>
	</div>
</div>

<div id="modalConsumos" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                	<b>Productos consumidos</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formConsumos">
	            <div id="formConsumos_content" class="modal-body row p-4">
		            <div class="text-center p-4">
		            	<img src="<?= base_url()?>cloud/otros/coolors_loader.svg" alt="">
		            	<p>
		            		<b>Cargando...</b>
		            	</p>
		            </div>	
	            </div>
	            <div class="modal-footer">
	            	<div class="form-check">
		            	<input id="ch_marcarTodo" type="checkbox" class="form-check-input">
		            	<label for="ch_marcarTodo" class="form-check-label">Marcar Todo</label>
	            	</div>
	                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
	                <button id="md_agregar" type="submit" class="btn btn-primary">Agregar</button>
	            </div>
            </form>
        </div>
    </div>
</div>

<div id="modalCliente" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                	<b>Cliente</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
	        <div class="modal-body p-3 col-12">
	        	
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="pill" href="#tab-buscar" role="tab" aria-controls="pills-home" aria-selected="true">
				    	Buscar&nbsp;
				    	<i class="ti-search"></i>
				    </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="pill" href="#tab-nuevo" role="tab" aria-controls="pills-profile" aria-selected="false">
				    	Nuevo&nbsp;
				    	<i class="ti-plus"></i>
				    </a>
				  </li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade show active" id="tab-buscar" role="tabpanel" aria-labelledby="pills-home-tab">
				  	
					<div class="form-row ">
						<div class="form-group col border-primary">
							<input type="text" class="form-control" placeholder="ingrese dni o apellido" id="in-FiltroCliente">
						</div>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th>Dni</th>
								<th>Cliente</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="md_filtro_cliente" class="overflow-auto">
							
						</tbody>
					</table>

				  </div>
				  <div class="tab-pane fade" id="tab-nuevo" role="tabpanel" aria-labelledby="pills-profile-tab">
				  	<div class="content">
				  		<div class="form-group">
				  			<label for="">Dni</label>
				  			<input type="text" class="form-control" id="nuevoDni">
				  		</div>
				  		<div class="form-group">
				  			<label for="">Nombres</label>
				  			<input type="text" class="form-control" id="nuevoNombre">
				  		</div>
				  		<div class="form-row">
				  			<div class="col">
				  				<label for="">Ap. Paterno</label>
				  				<input type="text" class="form-control" id="nuevoPaterno">
				  			</div>
				  			<div class="col">
				  				<label for="">Ap. Materno</label>
				  				<input type="text" class="form-control" id="nuevoMaterno">
				  			</div>
				  		</div>
				  		<div class="form-row p-2">
				  			<button id="b-registrarCliente" type="submit" class="btn btn-excel">
				  				Guardar&nbsp;
				  				<i class="ti-save"></i>
				  			</button>
				  		</div>
				  	</div>

				  </div>
				</div>

	        </div>
	        <div class="modal-footer">
	        	<!-- <div class="form-row">
	        		<input type="text" class="form-control">
	        	</div>
	        	<hr> -->
	            <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">cancelar</a>
	        </div>
        </div>
    </div>
</div>


<script src="<?= base_url()?>coda/cuenta.crear.js"></script>