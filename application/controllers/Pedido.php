<?php  

class Pedido extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model('TipoPedidoModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}

	}	

	function index(){

		$data = array(
			'pendiente' => $this->PedidoModel->select('pendiente'),
			'entregado' => $this->PedidoModel->select('entregado'),
			'anulado' => $this->PedidoModel->select('anulado')
		);
		$this->load->view('layout/public/header.php');
		$this->load->view('pedido/lista.php', $data);
		$this->load->view('layout/public/footer.php');

	}

	function nuevo(){

		$data = array(
			'tipo_pedido' => $this->TipoPedidoModel->select()
		);
		$this->load->view('layout/public/header.php');
		$this->load->view('pedido/registro.php', $data);
		$this->load->view('layout/public/footer.php');

	}
}