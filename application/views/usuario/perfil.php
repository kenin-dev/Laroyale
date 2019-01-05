<div class="container">
    <div class="card">
        <div class="card-header">
            <strong class="card-title mb-3">Perfil</strong>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                <img class="rounded-circle mx-auto d-block" src="<?= base_url()?>cloud/usuario/chef_06.png" alt="Card image cap">
                <h5 class="text-sm-center mt-2 mb-1">
                    <?php echo $usuario->usu_nombres; ?>
                </h5>
                <div class="location text-sm-center">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $usuario->usu_direccion; ?>
                </div>
            </div>
            <hr>
            <div class="card-text text-sm-center">
                <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
            </div>
        </div>
    </div>
</div>