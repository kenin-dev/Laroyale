<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laroyale System</title>
    <meta name="description" content="Laroyale System>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="<?= base_url()?>template/images/hamburger.png">
    <link rel="shortcut icon" href="<?= base_url()?>template/images/hamburger.png">
    <link rel="stylesheet" href="<?= base_url()?>template/vendors/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url()?>template/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()?>template/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url()?>template/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url()?>template/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url();?>template/library/iziToast/iziToast.min.css">
    <link rel="stylesheet" href="<?= base_url()?>template/assets/css/style.css">
    <link href="<?= base_url();?>template/library/datatable/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url();?>template/library/datatable/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url()?>template/library/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url()?>template/library/print.js/print.min.css">
    <link rel="stylesheet" href="<?= base_url()?>template/fonts/iconfood/style.css">
    <link rel="stylesheet" href="<?= base_url()?>template/assets/css/app.css">
    <link rel="stylesheet" href="<?= base_url()?>template/assets/css/loaders.css">
    <link rel="stylesheet" href="<?= base_url()?>template/fonts/Open Sans/open_sans.css">
    <link rel="stylesheet" href="<?= base_url()?>template/fonts/Roboto Mono/roboto_mono.css">
    <!-- <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css"> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->
</head>
<body>
    <!-- Barra Inicio -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="<?= base_url()?>template/images/laroyale_small.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="<?= base_url()?>template/images/laroyale_abrev.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav"> 
                    <h3 class="menu-title">Menu</h3>
                    <li class="active">
                        <a href="<?= base_url()?>">
                            <i class="menu-icon fa fa-dashboard"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-shopping-cart"></i>
                            Movimientos
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="ti-ticket"></i>
                                <a href="<?= base_url()?>pedido">Pedidos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon ti-slice"></i>
                            Mantenimiento
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="ti-user"></i>
                                <a href="<?= base_url()?>cliente">Clientes</a>
                            </li>
                            <li>
                                <i class="ti-star"></i>
                                <a href="<?= base_url()?>categoria">Categorias</a>
                            </li>
                            <li>
                                <i class="ti-apple"></i>
                                <a href="<?= base_url()?>producto">Productos</a>
                            </li>
                            <li>
                                <i class="ti-view-grid"></i>
                                <a href="<?= base_url()?>mesa">Mesas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon ti-image"></i>
                            Reportes
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon ti-view-list"></i>
                                <a href="forms-basic.html">Ventas Totales</a>
                            </li>
                            <li>
                                <i class="menu-icon ti-view-grid"></i>
                                <a href="forms-advanced.html">Venta del Dia</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </aside>

    <!-- Barra Fin -->


    <!-- Contenido Inicio -->

    <div id="right-panel" class="right-panel">
        
        <!-- header Inicio -->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-angle-left"></i></a>
                   
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?= base_url()?>template/images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <p><?= $this->session->userdata('ses_nombre')?></p>
                            <div class="divider"></div>
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Mi Perfil</a>

                            <!-- <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Configuracion</a> -->

                            <a class="nav-link" href="<?= base_url()?>Autenticacion/logout"><i class="fa fa-power-off"></i> Desconectar</a>
                        </div>
                    </div>

                    <!-- <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>

        </header>