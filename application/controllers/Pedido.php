<?php  
/**
 * 
 */
class Pedido extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('PedidoModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}	
	}

	public function index(){
		$data  = array(
			'pedidos' => $this->PedidoModel->buscar(), 
		);

		$this->load->view("layout/public/header.php");
		$this->load->view("pedido/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

}

?>