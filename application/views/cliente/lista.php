<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3>Clientes&nbsp;<i class="ti-user"></i></h3>
		</div>
		<div class="card-body">
			<div class="col-12 p-4">
				<a href="<?= base_url()?>cliente/registrar" class="btn btn-primary text-light">
					Nuevo Cliente&nbsp;
					<i class="ti-plus"></i>
				</a>
				<hr>
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

			<div class="col-12">
				<table id="dtable" class="table table-bordered">
          <thead class="thead-secondary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Dni</th>
              <th scope="col">Nombres</th>
              <th scope="col">Ape. Paterno</th>
              <th scope="col">Ape. Materno</th>
              <th scope="col">Direccion</th>
              <th scope="col">Telefono</th>
              <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
              <?php if (!empty($clientes)): ?>
                <?php $cont = 0; ?>
                <?php foreach ($clientes as $c): ?>
                  <?php $cont++; ?>
                <tr>
                  <td><?php echo $cont ?></td>
                  <td><?php echo $c->cli_dni; ?></td>
                  <td><?php echo $c->cli_nombres; ?></td>
                  <td><?php echo $c->cli_paterno; ?></td>
                  <td><?php echo $c->cli_materno; ?></td>
                  <td><?php echo $c->cli_direccion; ?></td>
                  <td><?php echo $c->cli_telefono; ?></td>
                  <td>
                    <a href="<?= base_url()?>cliente/editar/<?= $c->cli_codigo?>" class="btn btn-warning btn-lg ti-pencil">
                    </a>
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
 
  document.addEventListener('DOMContentLoaded', function(e){
    document.addEventListener('click', function(e){
      if(e.target.matches('#cliente-eliminar')){
        // alert('eliminar')
        let cliente = e.target.dataset.cliente
        // console.log(cliente)
        let resp = confirm('Eliminar a '+cliente+'?')
        if (resp) {
          console.log('enviado para eliminar: '+cliente)
        }else{
          e.preventDefault()
        }
      }
    }, false)

  }, true)

</script>