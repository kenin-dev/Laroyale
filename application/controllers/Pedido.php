<?php  

class Pedido extends CI_Controller
{
	function __construct(){

		parent::__construct();
		$this->load->model('PedidoModel');
		$this->load->model('PedidoDetalleModel');
		$this->load->model('TipoPedidoModel');
		$this->load->model('MesaModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}

	}	

	function index(){

		$data = array(
			'pendiente' => $this->PedidoModel->select('estado','P'),
			'entregado' => $this->PedidoModel->select('estado','E'),
			'anulado' => $this->PedidoModel->select('estado','A')
		);
		$this->load->view('layout/public/header.php');
		$this->load->view('pedido/lista.php', $data);
		$this->load->view('layout/public/footer.php');

	}

	function nuevo(){

		$data = array(
			'tipo_pedido' => $this->TipoPedidoModel->select(),
			'mesas' => $this->MesaModel->select()
		);
		$this->load->view('layout/public/header.php');
		$this->load->view('pedido/registro.php', $data);
		$this->load->view('layout/public/footer.php');

	}

	function registrar(){
		$pedido  = $this->input->post('pedido');
		$detalle = $this->input->post('detalle');
		// echo json_encode($detalle[0]['nombre']);
		// print_r(json_encode($pedido));
		
		try {
			$this->db->trans_begin();
			$p_registro = $this->PedidoModel->insert($pedido['tipo'],$pedido['destino'],$pedido['referencia'],$pedido['subtotal']);

			$id_ped = $p_registro->pedido;
			$acum = 0;
			for($d = 0;$d < count($detalle);$d++){
				$obj = array(
					'pdet_pedido' => $id_ped,
					'pdet_producto' => $detalle[$d]['id'],
					'pdet_cantidad' => $detalle[$d]['cantidad'],
					'pdet_precio' => $detalle[$d]['precio'],
					'pdet_importe' => $detalle[$d]['total'],
					'pdet_detalle' => $detalle[$d]['detalle'],
				);

				if ($this->PedidoDetalleModel->insert($obj)) {
					$acum++;
				}
			}

			$resp = array(
				'codigo' => '1',
				'mensaje' => 'Pedido registrado correctamente',
				'contenido' => $id_ped
			);

			echo json_encode($resp);

			$this->db->trans_commit();
		} catch (Exception $e) {
			$this->db->trans_rollback();

			$resp = array(
				'codigo' => '0',
				'mensaje' => 'El registro no se completo',
				'contenido' => $e->getMessage()
			);

			echo json_encode($resp);

		}

	}

	function anulacion($id = null){
		if (is_null($id)) {
			$this->session->set_flashdata('error', 'El proceso de anulacion no se completo, intente nuevamente.');

		}else{

			$anular = $this->PedidoModel->update('estado','A',$id);
			if ($anular > 0) {
				$this->session->set_flashdata('correcto', 'Pedido anulado.');
			}else{
				$this->session->set_flashdata('error', 'El proceso de anulacion no se completo, intente nuevamente.');

			}
		}
		redirect(base_url().'pedido','refresh');
	}

	function editar(){

		$data = array(
			'tipo_pedido' => $this->TipoPedidoModel->select(),
			'mesas' => $this->MesaModel->select()
		);
		$this->load->view('layout/public/header.php');
		$this->load->view('pedido/editar.php', $data);
		$this->load->view('layout/public/footer.php');

	}

}

