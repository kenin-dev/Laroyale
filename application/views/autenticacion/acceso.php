<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
	<title>Laroyale - Acceso</title>
	<link rel="shortcut icon" href="<?= base_url()?>template/images/hamburger.png">
	<link rel="stylesheet" href="<?= base_url()?>template/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url()?>template/vendors/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>template/vendors/themify-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url()?>template/assets/css/login-style.css">
  <link rel="stylesheet" href="<?= base_url();?>template/library/iziToast/iziToast.min.css">
  <link rel="stylesheet" href="<?= base_url()?>template/fonts/Open Sans/open_sans.css">
</head>
<body style="font-family: 'Open Sans','segoe ui';">
	<div class="container">
		<form id="acceso_form" class="form-signin text-center" method="POST" action="<?= base_url()?>Autenticacion/login" autocomplete="off">
  	    <img class="img-responsive justify-content-center" src="<?= base_url()?>template/images/laroyale_medio_dark.png" alt="" width="300">
  	    <h1 class="h5 font-weight-bold">Acceso al sistema</h1>
  	    <hr>
  	    <label for="inputUsername" class="sr-only">Usuario</label>
  	    <input type="text" name="inputUsername" class="form-control text-center" placeholder="Usuario"  autofocus>
	      <label for="inputPass" class="sr-only">Contraseña</label>
	      <input name="inputPass" type="password" class="form-control text-center" placeholder="Contraseña" >
	      <button id="b-enviar" disabled class="btn btn-lg btn-primary btn-block" type="submit">
	      	Entrar&nbsp;
	      	<i class="fa fa-location-arrow"></i>
	      </button>
			 <p>&nbsp;</p> 	
	      <div class="checkbox mb-3">
		      <a id="e-recuperar" href="" class="text-primary"><b>Olvide mi contraseña.</b></a>
		    </div>
	    </form>
	</div>
</body>
</html>
<script src="<?= base_url();?>template/library/iziToast/iziToast.min.js"></script>
<script src="<?php echo base_url()?>coda/app.js"></script>
<script src="<?= base_url()?>coda/acceso.code.js"></script>
