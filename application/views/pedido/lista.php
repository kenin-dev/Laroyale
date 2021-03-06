<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Pedidos&nbsp;<i class="ti-ticket"></i></h3>
      <br>
      <a href="<?= base_url()?>pedido/nuevo" class="btn btn-primary text-light">
          Nuevo Pedido&nbsp;
          <i class="ti-plus"></i>
      </a>
		</div>
    <div class="col-12">
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
		<div class="card-body">
      
      <ul class="nav nav-pills nav-justified mb-3 mt-2" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#nav-pendientes" role="tab" aria-controls="pills-home" aria-selected="true">Pendientes</a>
        </li>
        <li class="nav-item border">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#nav-entregados" role="tab" aria-controls="pills-profile" aria-selected="false">Entregados</a>
        </li>
        <li class="nav-item border">
          <a class="nav-link" id="tab-anulados" data-toggle="pill" href="#nav-anulados" role="tab" aria-controls="pills-profile" aria-selected="false">Anulados</a>
        </li>
      </ul>
      <div class="tab-content pl-3 pt-2" id="nav-tab">
        
        <div class="tab-pane fade show active" id="nav-pendientes" role="tabpanel" aria-labelledby="nav-home-tab">
          
          <table id="dtable" class="table table-bordered">
            <thead class="thead-secondary">
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Tipo consumo</th>
                <th scope="col">Destino</th>
                <th scope="col">Subtotal</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pendiente as $pen): ?>
                <tr>
                  <td><?php echo $pen->ped_fecha; ?></td>
                  <td><?php echo $pen->ped_serie; ?></td>
                  <td><?php echo $pen->ped_tipo_nombre; ?></td>
                  <td><?php echo $pen->ped_destino; ?></td>
                  <td><?php echo $pen->ped_subtotal; ?></td>
                  <td>
                    <a href="<?= base_url()?>pedido/anulacion/<?= $pen->ped_codigo;?>" data-serie="<?= $pen->ped_serie;?>" class="btn btn-danger text-light ti-na pen_anular" title="anular"></a>
                    <a href="<?= base_url()?>pedido/editar/<?= $pen->ped_codigo;?>" class="btn btn-warning text-dark ti-pencil" title="editar"></a>
                    <a href="<?= base_url()?>cuenta/crear/<?= $pen->ped_codigo;?>" class="btn btn-dark btn-sm text-light" title="Cuenta">
                      Cuenta&nbsp;
                      <i class="ti-credit-card"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

        <div class="tab-pane fade show" id="nav-entregados" role="tabpanel" aria-labelledby="nav-home-tab">
          
          <table id="dtable2" class="table table-bordered">
            <thead class="thead-secondary">
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Tipo consumo</th>
                <th scope="col">Destino</th>
                <th scope="col">Subtotal</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($entregado as $en): ?>
                <tr>
                  <td><?php echo $en->ped_fecha; ?></td>
                  <td><?php echo $en->ped_serie; ?></td>
                  <td><?php echo $en->ped_tipo; ?></td>
                  <td><?php echo $en->ped_destino; ?></td>
                  <td><?php echo $en->ped_subtotal; ?></td>
                  <td></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

        <div class="tab-pane fade show" id="nav-anulados" role="tabpanel" aria-labelledby="nav-home-tab">
          
          <table id="dtable3" class="table table-bordered">
            <thead class="thead-secondary">
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Serie</th>
                <th scope="col">Tipo consumo</th>
                <th scope="col">Destino</th>
                <th scope="col">Subtotal</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($anulado as $an): ?>
                <tr>
                  <td><?php echo $an->ped_fecha; ?></td>
                  <td><?php echo $an->ped_serie; ?></td>
                  <td><?php echo $an->ped_tipo; ?></td>
                  <td><?php echo $an->ped_destino; ?></td>
                  <td><?php echo $an->ped_subtotal; ?></td>
                  <td></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

      </div>
		</div>
	</div>
</div>
<script src="<?= base_url()?>coda/pedido.lista.js"></script>
