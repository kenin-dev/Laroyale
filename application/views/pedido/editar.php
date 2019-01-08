

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Editar Pedido&nbsp;<i class="fa fa-pencil"></i></h3>
			<small>Actualizacion de datos</small>
		</div>
		<div class="card-body">
			<div class="col-12 col-md-12 p-4">
				<img src="<?= base_url()?>cloud/diseño.jpg" class="img-responsive rounded">
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

<script src="<?= base_url()?>coda/pedido.editar.js"></script>