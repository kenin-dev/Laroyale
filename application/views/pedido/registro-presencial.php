<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Nuevo Pedido&nbsp;<i class="fa fa-ticket"></i></h3>
			<small>Presencial</small>
			<!-- <a href="javascript:Prn('PedidoCont')" class="btn btn-warning">Print</a> -->
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-6 col-xl-6 col-md-12">
					
					<?php if (count($categorias) > 0): ?>
					<?php foreach ($categorias as $cat): ?>
							
						<a class="" href="javascript:ver_productos(<?= $cat->id;?>)" data-ide="<?= $cat->id;?>">
							<div class="cds col-md-4 col-sm-6 border no-padding text-center" style='background: url(<?= base_url().$cat->imagen?>) rgba(0,0,0,0.4) no-repeat'>
								<div >
									<h4 class="cds-text f-medio text-center text-light">
										<?php echo $cat->nombre; ?>
									</h4>
								</div>
							</div>
						</a>

					<?php endforeach ?>
					<?php else: ?>
						<p class="text-center display-4"><i class="ti-face-sad"></i></p>
						<h4 class="text-center f-light">No se encontraron categorias de productos</h4>
					<?php endif ?>

				</div>
				<div id="PedidoCont" class="col-xl-6 col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header text-center">
							<strong>Datos del pedido</strong>
						</div>
						<div class="card-body card-block">
							<div class="row">
								<!-- <div class="col-md-8">
									<div class="form-group">
		                                <label class=" form-control-label">Direccion</label>
		                                <div class="input-group">
		                                    <div class="input-group-addon">
		                                    	<i class="ti-location-pin"></i>
		                                    </div>
		                                <input class="form-control" id="inputDestino">
		                                </div>
		                                <small class="form-text text-muted">ej. Av.nsq y nsc</small>
		                            </div>
								</div> -->
								<div class="col-6 col-md-6">
									<div class="form-group">
		                                <label class=" form-control-label">Mesa</label>
		                                <div class="input-group">
		                                    <div class="input-group-addon">
		                                    	<i class="ti-layout-column2"></i>
		                                    </div>
		                                <select id="inputDestino" class="form-control">
		                                	<option value="" selected disabled hidden>--SELECCIONAR--</option>
		                                	<?php if (count($mesas) > 0): ?>
		                                		<?php foreach ($mesas as $ms): ?>
		                                			<option value="<?= $ms->mesa_id;?>"><?php echo $ms->mesa_numero; ?></option>
		                                		<?php endforeach ?>
		                                	<?php else: ?>
		                                		<option value="" selected disabled hidden>
		                                			Sin mesas disponibles
		                                		</option>
		                                	<?php endif ?>

		                                </select>
		                                </div>
		                                <small class="form-text text-muted">ej. Av.nsq y nsc</small>
		                            </div>
								</div>
								<div class="col-6 col-md-6">
									<div class="form-group">
		                                <label class=" form-control-label">Fecha</label>
		                                <div class="input-group">
		                                    <div class="input-group-addon">
		                                    	<i class="ti-calendar"></i>
		                                    </div>
		                                <input class="form-control" id="inputFecha" readonly>
		                                </div>
		                                <!-- <small class="form-text text-muted">ej. Av.nsq y nsc</small>
 -->		                            </div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-md-4">
									<label class="form-control-label">
										Cantidad
									</label>
									<input type="text" name="inputCantidad" class="form-control" readonly>
								</div>
								<div class="col-sm-6 col-md-4">
									<label class="form-control-label">
										Subtotal
									</label>
									<input type="text" name="inputSubtotal" class="form-control" readonly>
								</div>
								<div class="col-sm-6 col-md-4">
									<label for="">&nbsp;</label>
									<br>
									<button id="PedidoCrear" class="btn btn-primary">
										Crear Pedido&nbsp;
										<i class="ti-plus"></i>
									</button>
								</div>
							</div>
							<hr>
							<div class="row">
								<!-- <p class="text-dark"><strong>Productos</strong></p> -->
								<div class="col-md-12">
									
									<table id="pedido_tabla" class="table table-responsive-sm" style="width: 100%">
										<thead>
											<tr>
												<th>Producto</th>
												<th>Precio</th>
												<th>Cantidad</th>
												<th>Total</th>
												<!-- <th>Detalle</th> -->
												<th>Accion</th>
											</tr>
										</thead>
										<tbody>
											<!-- <tr>
												<td>Hamburguesa</td>
												<td>18.5</td>
												<td>2</td>
												<td>37</td>
												<td>sin in so</td>
												<td>
													<button class="btn btn-danger">
														<i class="ti-close"></i>
													</button>
													<button class="btn btn-warning">
														<i class="ti-pencil"></i>
													</button>
												</td>
											</tr> -->
										</tbody>
									</table>
								</div>
							</div>
							<!-- <div class="row col-md-12">
								<pre id="console">
									
								</pre>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal_productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_productos_titulo" class="modal-title">Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table table-condensed">
               		<thead>
               			<tr>
               				<th>Abrev.</th>
               				<th>Nombre</th>
               				<th>Precio</th>
               				<th>Opcion</th>
               			</tr>
               		</thead>
               		<tbody>
               			<tr>
               				<td>HAM</td>
               				<td>Hamburgruesa</td>
               				<td>15.5</td>
               				<td>
               					<a href="" class="btn btn-primary">
               						<i class="ti-check"></i>
               					</a>
               				</td>
               			</tr>
               		</tbody>
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                	Cancelar&nbsp;
                	<i class="ti-close"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div id="modal_producto_editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_producto_editar" data-id="">
            	
	            <div class="modal-body">
	            	<div class="row">
						<div class="col-md-4 form-group">
							<label for="">Precio</label>
		                	<input type="text" class="form-control" name="editarPrecio" readonly>
						</div>
						<div class="col-md-4 form-group">
							<label for="">Cantidad</label>
		                	<input type="number" class="form-control" name="editarCantidad" max="999">
						</div>
						<div class="col-md-4 form-group">
							<label for="">Total</label>
		                	<input type="text" class="form-control" name="editarImporte" readonly>
						</div>
						<!-- <div class="form-group">
							<label for=""></label>
		                	<input type="text" class="form-control" name="editarCantidad">
						</div> -->
						<div class="col-md-12 form-group">
							<label for="">Detalle</label>
							<textarea name="editarDetalle" class="form-control" cols="30" rows="5"></textarea>
						</div>
	            	</div>
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-success">
	                	Guardar&nbsp;
	                	<i class="ti-save-alt"></i>
	                </button>
	                <a class="btn btn-danger text-light" data-dismiss="modal">
	                	Cancelar&nbsp;
	                	<i class="ti-close"></i>
	                </a>
	            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url()?>coda/pedido.registro.presencial.js"></script>
<style>
	.cds {
		min-height: 170px;
		width: 100%;
		/*background: rgba(0,0,0,0.4);*/
		display: flex;
		flex-flow: column;
		justify-content: center;
	}

	.f-light {
		font-weight: 300;
	}
	.f-medio {
		font-weight: 700;
	}
	
	.cds-text {
		text-shadow: 4px 2px 5px #1d2323;
	}
</style>