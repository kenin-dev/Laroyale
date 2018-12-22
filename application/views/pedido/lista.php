<div class="col-md-12">
	
	<div class="card">
		<div class="card-header">
			<h3>Pedidos&nbsp;<i class="ti-timer"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12">
				<a href="" class="btn btn-primary">
					Nuevo Pedido&nbsp;
					<i class="ti-plus"></i>
				</a>
				<hr>
			</div>
			<div class="col-12">
				<table id="dtable" class="table table-bordered">
                	<thead class="thead-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Tipo de consumo</th>
                            <th scope="col">Destino</th>
                            <th scope="col">subtotal</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($pedidos)): ?>
                      	<?php foreach ($pedidos as $pd): ?>
                      			<tr>
                      				<td><?php echo $pd->ped_id;?></td>
                                    <td><?php echo $pd->ped_fecha;?></td>
                                    <td><?php echo $pd->ped_tipo_consumo;?></td>
                                    <td><?php echo $pd->ped_destino;?></td>
                                    <td><?php echo $pd->ped_subtotal;?></td>
                      				<td></td>
                      			</tr>
                      		<?php endforeach ?>	
                      <?php endif ?>
					</tbody>
                </table>
			</div>
		</div>
	</div>
</div>
