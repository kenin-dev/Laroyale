<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>Registrar Pago - Pedido #<?= $pedido->ped_id; ?></h3>
		</div>
		<div class="card-body">
			<div class="form-row align-items-center">
				
				<div class="col-auto">
			      <label for="pedidoID">
			      	<b>Pedido</b>
			      </label>
			      <input type="text" class="form-control text-center" value="<?= $pedido->ped_id;?>" id="pedidoID" readonly>
			    </div>

			    <div class="col-auto">
			      <label for="pedidoID">
			      	<b>Tipo consumo</b>
			      </label>
			      <input type="text" class="form-control text-center" value="<?= $pedido->ped_tipo_consumo;?>" id="pedidoID" readonly>
			    </div>

				<div class="col-auto">
			      <label for="pedidoID">
			      	<b>Destino</b>
			      </label>
			      <input type="text" class="form-control text-center" value="<?= $pedido->ped_destino;?>" name="pedidoSubtotal" readonly>
			    </div>

			    <div class="col-auto">
			      <label for="pedidoID">
			      	<b>Total a pagar</b>
			      </label>
			      <input type="text" class="form-control text-center" value="<?= $pedido->ped_subtotal;?>" name="pedidoSubtotal" readonly>
			    </div>

			</div>
			<div class="form-row align-items-center">
				
			    <div class="col-auto">
			    	<label for="">&nbsp;</label><br>
			    	<button id="b-agregar" class="btn btn-success" disabled>
						Agregar cuenta&nbsp;<i class="ti-plus"></i>
					</button>
			    </div>

			    <div class="col-auto">
			    	<label for="">&nbsp;</label><br>
			    	<button id="b-pagar" class="btn btn-primary" disabled>
						Registrar pago&nbsp;<i class="ti-wand"></i>
					</button>
			    </div>

			</div>
			<hr>


			<div id="contenidoPagos" class="col-md-12 p-3">
		
			</div>
		</div>
	</div>
</div>

<!-- 
					stdClass Object
(
    [ped_id] => 24
    [ped_fecha] => 2018-11-04
    [ped_subtotal] => 37.90
    [ped_tipo_consumo] => presencial
    [ped_destino] => Mesa 01
    [ped_estado] => pendiente
) -->
	

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