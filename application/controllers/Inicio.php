<?php  


class Inicio extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');
		}
		
	}

	function index(){
		$this->load->view("layout/public/header.php");
		$this->load->view("inicio/dashboard.php");
		$this->load->view("layout/public/footer.php");
	}
}

?>