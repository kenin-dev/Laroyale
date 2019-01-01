<div class="col-md-12">
	
	<div class="card">
		<div class="card-header">
			<h3>
				Pedido # <?php echo $pedido->ped_id; ?>
				&nbsp;
				<?php 
				switch ($pedido->ped_estado) {
					case 'pendiente':
						echo "<b class='text-warning'>[ Pendiente ]</b>";
						break;
					case 'finalizado':
						// echo "[ Finalizado ]";
						echo "<b class='text-primary'>[ Finalizado ]</b>";
						break;
					default:
						# code...
						break;
				}
				?>
			</h3>
		</div>	
		<div class="card-body">
			<div class="col-md-12">
			<?php switch ($pedido->ped_estado) {
				case 'pendiente':
					echo "<a href='javascript:OrdenPrint()' class='btn btn-dark text-light'>Imprimir Orden&nbsp;<i class='ti-printer'></i></a>&nbsp;";

					echo "<a href='' class='btn btn-info' >Editar&nbsp;<i class='ti-pencil'></i></a>";

					echo "&nbsp;";

					echo "<a href='' class='btn btn-danger' >Anular&nbsp;<i class='ti-close'></i></a>";
					break;
				case 'finalizado':
					echo "<a href='javascript:OrdenPrint()' class='btn btn-dark text-light'>Imprimir Orden&nbsp;<i class='ti-printer'></i></a>&nbsp;";
					break;
					break;
			} ?>
			
			</div>
			<div class="col-12">
				<!-- <hr> -->
				<br>	
				<div class="col-6">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="2" class="text-center">
									<b>Datos Generales</b>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<b>
										<i class="ti-calendar"></i>
										&nbsp;
										Fecha: 
									</b>
								</td>
								<td><?php echo $pedido->ped_fecha; ?></td>
							</tr>
							<tr>
								<td>
									<b>
										<i class="ti-direction-alt"></i>
										&nbsp;
										Tipo Consumo: 
									</b>
								</td>
								<td><?php echo $pedido->ped_tipo_consumo; ?></td>
							</tr>
							<tr>
								<td>
									<b>
										<i class="ti-location-pin"></i>
										&nbsp;
										Destino/Mesa: 
									</b>
								</td>
								<td><?php echo $pedido->ped_destino; ?></td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="4" class="text-center">
									<b>Productos Consumidos</b>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<b>Producto</b>
								</td>
								<td class="text-center">
									<b>Precio</b>
								</td>
								<td class="text-center">
									<b>Cantidad</b>
								</td>
								<td class="text-center">
									<b>Total</b>
								</td>
							</tr>
						</thead>
						<tbody>
							<?php $prod_total = 0; ?>
							<?php foreach ($detalle as $dp): ?>
								<?php $prod_total = $prod_total+$dp->dp_importe; ?>
								<tr>
									<td>
										<label class="text-dark">
											<?php echo $dp->dp_producto;?>
											<p>
												<small class="text-danger p-0">
													<?php echo $dp->dp_detalle; ?>
												</small>
											</p>
										</label>
										
									</td>
									<td>
										<?php echo $dp->dp_precio; ?>
									</td>
									<td>
										<?php echo $dp->dp_cantidad; ?>
									</td>
									<td>
										<?php echo $dp->dp_importe; ?>
									</td>
								</tr>
							<?php endforeach ?>
								<tr>
									<td colspan="3">
										<b>
											Total
										</b>
									</td>
									<td>
										<b>
											<?php echo number_format($prod_total,2); ?>
										</b>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<b>Pagos realizados</b>
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Cliente</th>
										<th>Importe</th>
									</tr>
								</thead>
								<tbody>
								<?php if (empty($pago)): ?>
									<tr class="text-center">
										<td colspan="3">
											<h4 class="text-secondary">
												Este pedido no tiene pagos&nbsp;
												<i class="ti-face-sad"></i>
											</h4>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="text-center">
											<?php if ($pedido->ped_estado==='pendiente'): ?>
												<a href="<?= base_url()?>pago/registro/<?= $pedido->ped_id;?>" class="btn btn-primary">
													Agregar Pago&nbsp;
													<i class="ti-plus"></i>
												</a>
											<?php endif ?>
										</td>
									</tr>
								<?php else: ?>
									<?php $i=0; ?>
									<?php foreach ($pago as $p): ?>
										<tr>
											<td>
												<?php 
													$i++;
													echo $i;
												?>
											</td>
											<td>
												<?php 
													echo $p->ven_cliente;
												?>
											</td>
											<td>
												<?php  
													echo $p->ven_total;
												?>
											</td>
										</tr>
									<?php endforeach ?>
								<?php endif ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url()?>coda/pedido.vista.js"></script>

<div class="modal fade print_text" id="modal_orden" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content container">
            <div class="modal-header mx-auto">
                <!-- <img src="<?= base_url()?>template/images/laroyale_medio_dark.png" alt="" class="img-responsive"> -->
                <h3>
                	<b>Pedido de Atencion Nº <?php echo $pedido->ped_id; ?></b>
                </h3>
            </div>
            <div class="modal-body text-justify">
            	<div class="col-md-12 p-3">
            		<p class="text-dark">
            			<b>Tipo de consumo: </b>
            			<?php echo $pedido->ped_tipo_consumo; ?>
            		</p>
            		<p class="text-dark">
            			<b>Destino: </b>
            			<?php echo $pedido->ped_destino; ?>
            		</p>
            		
            	</div>

            	<div class="col-md-12 p-4">
            		<p class="text-dark">Orden</p>
	            	<hr class="hr-text">
					<ul>
						<?php foreach ($detalle as $dp): ?>
							<li>
								<p class="text-dark"><?php echo $dp->dp_producto; ?>
								&nbsp;( <?php echo $dp->dp_cantidad; ?> ) 
							<small><?php echo $dp->dp_detalle; ?></small></p>

							</li>
						<?php endforeach ?>
					</ul>
            	</div>
            </div>
            <div class="modal-footer">
            	
            </div>
        </div>
    </div>
</div>