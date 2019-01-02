<?php  
/**
 * 
 */
class Cliente extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ClienteModel');
		$this->load->model('TipoClienteModel');
		$this->load->model('TipoDocumentoModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	function index(){

		$data = array(
			'clientes' => $this->ClienteModel->buscar('activos')
		);
		$this->load->view("layout/public/header.php");
		$this->load->view("cliente/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	function nuevo(){
		$data = array(
			'tipo_cliente' => $this->TipoClienteModel->buscar('todo'),
			'tipo_documento' => $this->TipoDocumentoModel->buscar('todo')
		);	

		$this->load->view("layout/public/header.php");
		$this->load->view("cliente/registro.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	function registrar(){
		$dni = $this->input->post('inputNumerodoc');
		$tipo_doc = $this->input->post('inputTipodoc');
		$nombres = $this->input->post('inputNombres');
		$paterno = $this->input->post('inputPaterno');
		$materno = $this->input->post('inputMaterno');
		$telefono = $this->input->post('inputTelefono');
		$direccion = $this->input->post('inputDireccion');
		$tipo_cliente = $this->input->post('inputTipocli');
		
		if (count($this->ClienteModel->buscar('dni',$dni)) > 0) {
			$this->session->set_flashdata('error', 'Ya existe un cliente con el dni especificado.');
			redirect(base_url().'cliente/nuevo','refresh');
		}else{
			try {
				$this->db->trans_begin();
				$clienteData = array(
					'nombre' => $nombres,
					'ape_paterno' => $paterno,
					'ape_materno' => $materno,
					'telefono' => $telefono,
					'direccion' => $direccion,
					'tipo_cliente_id' => $tipo_cliente,
					'tipo_documento_id' => $tipo_doc,
					'num_documento' => $dni,
					'estado' => 1
				);
				$registro = $this->ClienteModel->insertar($clienteData);
				$this->db->trans_commit();
				$this->session->set_flashdata('correcto', 'Cliente registrado');
				redirect(base_url().'cliente','refresh');

			} catch (Exception $e) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', $e->getMessage());
				redirect(base_url().'cliente/nuevo','refresh');
			}
			
		}
	}

	function eliminar($id = null){
		if (is_null($id)) {
			redirect(base_url().'cliente','refresh');
		}else{
			$eliminar = $this->ClienteModel->eliminar($id);
			if($eliminar > 0){
				$this->session->set_flashdata('correcto', 'Cliente eliminado correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de eliminacion fallo, intente luego.!');
			}
			redirect(base_url().'cliente','refresh');
		}
	}

	function editar($id = null){
		if (is_null($id)) {
			redirect(base_url().'cliente','refresh');
		}else{
			$cliente = $this->ClienteModel->buscar('uno',$id);
			if(count($cliente)){
				$data = array(
					'cliente' => $cliente,
					'tipo_cliente' => $this->TipoClienteModel->buscar('todo'),
					'tipo_documento' => $this->TipoDocumentoModel->buscar('todo')
				);	

				$this->load->view("layout/public/header.php");
				$this->load->view("cliente/editar.php",$data);
				$this->load->view("layout/public/footer.php");
			}else{
				$this->session->set_flashdata('error', 'Cliente no encontrado!');
				redirect(base_url().'cliente','refresh');
			}
		}
	}

	function editar_enviar(){
		$id = $this->input->post('inputId');
		$dni = $this->input->post('inputNumerodoc');
		$tipo_doc = $this->input->post('inputTipodoc');
		$nombres = $this->input->post('inputNombres');
		$paterno = $this->input->post('inputPaterno');
		$materno = $this->input->post('inputMaterno');
		$telefono = $this->input->post('inputTelefono');
		$direccion = $this->input->post('inputDireccion');
		$tipo_cliente = $this->input->post('inputTipocli');

		try {

			$this->db->trans_begin();
			$clienteData = array(
				'nombre' => $nombres,
				'ape_paterno' => $paterno,
				'ape_materno' => $materno,
				'telefono' => $telefono,
				'direccion' => $direccion,
				'tipo_cliente_id' => $tipo_cliente,
				'tipo_documento_id' => $tipo_doc,
				'num_documento' => $dni,
				'estado' => 1
			);
			$actualizar = $this->ClienteModel->editar($id,$clienteData);
			print_r($actualizar);
			$this->db->trans_commit();
			$this->session->set_flashdata('correcto', 'Datos actualizados');
			redirect(base_url().'cliente','refresh');

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', $e->getMessage());
			redirect(base_url().'cliente/nuevo','refresh');
		}

	}

	// Rest
	function verificarDni(){
		$dni = $this->input->post('dni');
		$cliente = $this->ClienteModel->buscar('dni',$dni);
		$resp = array(
			'codigo' => 0,
			'mensaje' => 'sin procesar',
			'contenido' => ''
		);

		if (count($cliente) > 0) {
			$resp['codigo'] = 1;
			$resp['mensaje'] = 'Ya existe un cliente con este dni';
			$resp['contenido'] = $cliente;
		}else{
			$resp['codigo'] = 0;
			$resp['mensaje'] = 'Dni disponible';
			$resp['contenido'] = $cliente;
		}

		echo json_encode($resp);

	}
}
?>