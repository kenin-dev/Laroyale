<?php  

class DetallePedido extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model("PedidoDetalleModel");

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	function consulta_rest(){
		$id = $this->input->post('pedido');
		$detalles = $this->PedidoDetalleModel->select('todo',$id);
		echo json_encode($detalles);
	}
}

?>