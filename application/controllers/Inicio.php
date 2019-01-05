<?php  


class Inicio extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ReporteModel');
		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');
		}
		
	}

	function index(){
		$data = array(
			'cliente_total' => $this->ReporteModel->cliente('cantidad_total')
		);
		
		$this->load->view("layout/public/header.php");
		$this->load->view("inicio/dashboard.php",$data);
		$this->load->view("layout/public/footer.php");
	}
}

?>