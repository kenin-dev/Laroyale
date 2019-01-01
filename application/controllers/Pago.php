<?php  

class Pago extends CI_Controller
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

	function registro($id = null){
		if (is_null($id)) {
			redirect(base_url().'pedido','refresh');	
		}else{
			$pedido = $this->PedidoModel->buscar('',true,$id);
			if ($pedido) {
				$data = array(
					'pedido' => $pedido,
					'detalle' => $this->DetallePedidoModel->buscar($id),
					'pago' => $this->VentaModel->busquedaPedido($id)
				);

				$this->load->view("layout/public/header.php");
				$this->load->view("pago/registro.php",$data);
				$this->load->view("layout/public/footer.php");
			}else{
				redirect(base_url().'pedido','refresh');
			}
		}
	}


}

?>