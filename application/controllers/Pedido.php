<?php  

class Pedido extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model("CategoriaModel");
		$this->load->model("MesaModel");

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

	public function nuevo($tipo = null){
		if (is_null($tipo)) {
			redirect(base_url().'pedido','refresh');
		}else{
			
			switch ($tipo) {
				case 'presencial':
					$data = array( 
						'categorias' => $this->CategoriaModel->SelectAll(),
						'mesas' => $this->MesaModel->getMesasTodas()		
					);

					$this->load->view("layout/public/header.php");
					$this->load->view("pedido/registro-presencial.php",$data);
					$this->load->view("layout/public/footer.php");
					break;
				case 'delivery':
					$data = array( 
						'categorias' => $this->CategoriaModel->SelectAll()	
					);
					
					$this->load->view("layout/public/header.php");
					$this->load->view("pedido/registro-delivery.php",$data);
					$this->load->view("layout/public/footer.php");
					break;
				default:
					# code...
					break;
			}
		}
	}

	public function registrarPresencial(){
		$pedido  = $this->input->post('pedido');
		$detalle = $this->input->post('detalle');

		// echo json_encode($detalle);
		// echo count($detalle);
		if ( strlen($pedido['fecha'])>0 && strlen($pedido['subtotal'])>0 && strlen($pedido['destino'])>0 && count($detalle)>0 ) {
			
		}else{

			$resp = array(
				'code' => 0,
				'message' => 'Datos incompletos',
				'content' => ''
			);
		}

		echo json_encode($resp);

	}

}

?>