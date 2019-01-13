<?php  

class Cuenta extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model('PedidoDetalleModel');
		$this->load->model('CuentaModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	function index(){

	}

	function Crear($id = null){

		if (is_null($id)) {
			
			$this->session->set_flashdata('error', 'Pedido no especificado.');
			redirect(base_url().'cuenta','refresh');

		}else{
			
			$pedido = $this->PedidoModel->select('id_pendiente',$id);
			if (count($pedido) > 0) {
				
				$data = array(
					'pedido' => $pedido,
					'detalle' => $this->PedidoDetalleModel->select('todo',$id)
				);

				$this->load->view('layout/public/header.php');
				$this->load->view('cuenta/crear.php', $data);
				$this->load->view('layout/public/footer.php');

			}else{
				$this->session->set_flashdata('error', 'Pedido no encontrado.');
				redirect(base_url().'cuenta','refresh');
			}

		}

	}

}

?>