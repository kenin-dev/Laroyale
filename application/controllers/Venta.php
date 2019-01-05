<?php  

class Venta extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('VentaModel');
		$this->load->model('ProductoModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

}
?>