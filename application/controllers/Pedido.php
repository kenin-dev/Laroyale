<?php  

class Pedido extends CI_Controller
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

	public function index(){
		$data  = array(
			'pedidos' => $this->PedidoModel->buscar(), 
		);

		$this->load->view("layout/public/header.php");
		$this->load->view("pedido/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	public function vista($id = null){
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
				$this->load->view("pedido/vista.php",$data);
				$this->load->view("layout/public/footer.php");
			}else{
				redirect(base_url().'pedido','refresh');
			}
		}
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

		//echo json_encode($detalle[0]['producto_id']);
		// echo $pedido['fecha'];
		if ( strlen($pedido['fecha'])>0 && strlen($pedido['subtotal'])>0 && strlen($pedido['destino'])>0 && count($detalle)>0 ) {

			try {
				$this->db->trans_begin();
				$pedidoData = array(
					'ped_fecha' => $pedido['fecha'],
					'ped_subtotal' => $pedido['subtotal'],
					'ped_tipo_consumo' => $pedido['tipo_consumo'],
					'ped_destino' => $pedido['destino'],
					'ped_estado' => $pedido['estado']
				);

				$pedidoIns = $this->PedidoModel->insertar($pedidoData);
				$cont = 0;
				for($i=0; $i < count($detalle); $i++){
					$detalleData = array(
						'pedido_id'   => $pedidoIns,
						'producto_id' => $detalle[$i]['producto_id'], 
						'dp_precio'   => $detalle[$i]['precio'],
						'dp_cantidad' => $detalle[$i]['cantidad'],
						'dp_importe'  => $detalle[$i]['importe'],
						'dp_detalle'  => $detalle[$i]['detalle']
					);

					$this->PedidoModel->insertar_detalle($detalleData);
					$cont++;
				}
				$resp = array(
					'code' => 1,
					'message' => 'Pedido registrado con exito.',
					'content' => $pedidoIns
				);
				$this->db->trans_commit();	
			} catch (Exception $e) {
				
				$resp = array(
					'code' => 0,
					'message' => $e->getMessage(),
					'content' => ''
				);
				die(json_encode($resp));
			}
			
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