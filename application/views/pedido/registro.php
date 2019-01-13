<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Nuevo Pedido&nbsp;<i class="fa fa-ticket"></i></h3>
			<small>Registro</small>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="row">
						<div class="col-md-6 col-12 form-group">
							<label for="" class="text-primary">
								<b>Tipo de pedido (*)</b>
							</label>
							<select id="pedidoTipo" class="form-control">
								<?php if (!empty($tipo_pedido)): ?>
									<?php foreach ($tipo_pedido as $tp): ?>
											<option value="<?= $tp->tped_codigo;?>">
												<?php echo $tp->tped_nombre; ?>
											</option>
									<?php endforeach ?>	
								<?php else: ?>
								<option value="" selected disabled hidden>Sin datos</option>
								<?php endif ?>
							</select>
						</div>
						<div class="col-md-6 col-12 form-group">
							<label for="">Destino</label>
							<select id="destinoPres" name="pedidoDestino" class="form-control">
								<?php foreach ($mesas as $ms): ?>
									<option value="<?= $ms->mes_numero;?>">
										<?php echo "Mesa ".$ms->mes_numero; ?>
									</option>
								<?php endforeach ?>	
							</select>
							<input id="destinoDel" type="text" class="form-control" style="none">
							
						</div>
						<div class="col-md-12 col-12 form-group" id="destinoContenedor">
							<label for="">
								<b>Referencia</b>
							</label>
							<input type="text" id="pedidoReferencia" class="form-control">
						</div>
						<div class="col-md-12 col-12 form-group">
							<button id="b-registrar" class="btn btn-primary btn-lg" disabled>
								Registrar Pedido&nbsp;
								<i class="ti-save"></i>
							</button>
						</div>

					</div>
					<hr>
					<div class="card">
						<!-- <h5 class="card-header">Orden</h5> -->
						<!-- <div class="card-body"> -->
							<table id="t-orden" class="table table-resposive card-body">
								<thead class="bg-dark text-light">
									<tr>
										<th scope="col">Producto</th>
										<th scope="col">Precio</th>
										<th scope="1">Cantidad</th>
										<th scope="col">Total</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="tb-orden">
									<tr>
										<td colspan="4" class="text-center">
											Use el catalogo para agregar productos.
										</td>
									</tr>
								</tbody>
							</table>
						<!-- </div> -->
					</div>
				</div>
				<div class="col-12 col-md-6">
					<h5 class="display-5 text-center">
						<b id="catalogo-titulo">Catalogo de productos</b>
					</h5>
						<br>
					<div id="mostrador" class="overflow-auto">
						<div class="col text-center">
							<img src="<?= base_url()?>cloud/otros/coolors_loader.svg" alt="Cargando">
							<h5 class="pb-2 display-5">Cargando catalogo...</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Agregar Detalle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="col-md-12">
            		<div class="">
            			<div class="form-group">
            				<label for="">
            					<b>Detalle</b>
            				</label>
            				<textarea id="i-modalDetalle" cols="20" rows="5" class="form-control"></textarea>
            			</div>
            		</div>
            	</div>
            </div>
			<div class="modal-footer">
	    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	           <button id="b-modalDetalle" type="button" class="btn btn-primary">
	           	Guardar
	           </button>
	        </div>
        </div>
	</div>
</div>

<div class="modal fade" id="modalCarga" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div id="modalCargaBody" class="modal-body">
            	<center class="col-md-12">
            		
					<div class="mx-auto lds-css ng-scope">
						<div style="width:100%;height:100%" class="lds-radio">
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
					<div class="text-center">
						<h5 class="display-5">Cargando...</h5>
					</div>
            	</center>
            </div>
			<div class="modal-footer">
	        </div>
        </div>
	</div>
</div>

<script src="<?= base_url()?>coda/pedido.registro.js"></script>