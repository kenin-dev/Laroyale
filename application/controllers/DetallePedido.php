<?php  

class DetallePedido extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model("CategoriaModel");
		$this->load->model("DetallePedidoModel");
		$this->load->model("MesaModel");
		$this->load->model("VentaModel");

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	function consulta_rest(){
		$id = $this->input->post('pedido');
		// $resp;
		if (strlen($id) > 0) {
			
			try {
				$detalle = $this->DetallePedidoModel->buscar($id);
				$resp = array(
					'resp_id' => 1,
					'resp_message' => 'datos encontrados',
					'resp_content' => $detalle
				);
			} catch (Exception $e) {
				$resp = array(
					'resp_id' => 0,
					'resp_message' => $e->getMessage(),
					'resp_content' => $e->getMessage()
				);
			}
		}else{

			$resp = array(
				'resp_id' => 0,
				'resp_message' => 'pedido no especificado',
				'resp_content' => ''
			);

		}

		echo json_encode($resp);
	}
}

?>