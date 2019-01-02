<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Pedidos&nbsp;<i class="ti-timer"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12">
				<a href="javascript:click()" class="btn btn-primary text-light">
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
                                    <td>
                                      <a href="<?= base_url()?>pedido/vista/<?= $pd->ped_id;?>" class="btn btn-info">Ver <i class="ti-new-window"></i></a>
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
<script>
  function click(){
    // const {value: formValues} = await Swal({
    //   title: 'Tipo de pedido',
    //   html : 
    //   '<a class="btn btn-dark btn-lg btn-block">Presencial</a>'+
    //   '<a class="btn btn-dark btn-lg btn-block">Delivery</a>',

    // })
    // if (formValues) {
    //   Swal(json.stringify(formValues))
    // }
    Swal({
      title: 'Tipo de pedido',
      type: 'info',
      // input: 'range',
      html : 
      '<a href="'+srv.url()+'pedido/nuevo/presencial" class="btn btn-dark btn-lg btn-block text-light">Presencial&nbsp;'+
      '<span class="fa fa-ticket"></span></a>'+
      '<a href="'+srv.url()+'pedido/nuevo/delivery" class="btn btn-dark btn-lg btn-block text-light">Delivery&nbsp'+
      '<span class="ti-truck"></span></a>',
      showCancelButton: true,
      showConfirmButton: false,
      cancelButtonText: 'Cancelar',
      cancelButtonColor: '#fd0054'
    })
  }
</script>