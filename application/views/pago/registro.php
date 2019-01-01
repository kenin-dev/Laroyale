<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Registrar Pago</h3>
		</div>
		<div class="card-body">
			<div class="row">
				
				<div class="col-md-2">
					<div class="group-input">
						<label for=""><b>Pedido</b></label>
						<input type="text" class="form-control text-center" value="<?= $pedido->ped_id;?>" id="pedidoID" readonly>
					</div>
				</div>

				<div class="col-md-4 col-lg-3">
					<div class="group-input">
						<label for=""><b>Total a pagar</b></label>
						<input type="text" class="form-control text-center" value="<?= $pedido->ped_subtotal;?>" name="pedidoSubtotal" readonly>
					</div>
				</div>

				<div class="col-md-4 col-lg-3">
					<label for="">&nbsp;</label>
					<button id="b-agregar" class="btn btn-primary btn-block" disabled>
						Agregar cuenta&nbsp;
						<i class="ti-plus"></i>
					</button>
				</div>

	
			</div>
			<hr>
			<div id="contenidoPagos" class="col-md-12 p-4">

			</div>
			<div class="row">
				<pre id="consola">
					
				</pre>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ClienteModal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url()?>coda/pago.registro.js"></script>