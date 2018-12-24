<?php  

class Producto extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// $this->load->model('PedidoModel');
		$this->load->model("ProductoModel");

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	public function index(){

	}

	public function categoria_productos_rest(){
		$cate_id = $this->input->post('categoria');
		$productos = $this->ProductoModel->SelectCategoria($cate_id);
		echo json_encode($productos);
	}
}
?>