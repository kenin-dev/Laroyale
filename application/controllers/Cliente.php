<?php  

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
			'clientes' => $this->ClienteModel->select('todo')
		);
		$this->load->view("layout/public/header.php");
		$this->load->view("cliente/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	function registrar(){
		$data = array(
			'tipo_cliente' => $this->TipoClienteModel->select('todo'),
			'tipo_documento' => $this->TipoDocumentoModel->select('todo')
		);	

		$this->load->view("layout/public/header.php");
		$this->load->view("cliente/registro.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	function registrar_envio(){
		$dni = $this->input->post('inputNumerodoc');
		$tipo_doc = $this->input->post('inputTipodoc');
		$nombres = $this->input->post('inputNombres');
		$paterno = $this->input->post('inputPaterno');
		$materno = $this->input->post('inputMaterno');
		$direccion = $this->input->post('inputDireccion');
		$telefono = $this->input->post('inputTelefono');
		$tipo_cliente = $this->input->post('inputTipocli');
		
		if (count($this->ClienteModel->select('dni',$dni)) > 0) {
			$this->session->set_flashdata('error', 'Ya existe un cliente con el dni especificado.');
			redirect(base_url().'cliente/nuevo','refresh');
		}else{
			try {
				$this->db->trans_begin();
				$clienteData = array(
					'cli_dni' => $dni,
					'cli_nombres' => $nombres,
					'cli_paterno' => $paterno,
					'cli_materno' => $materno,
					'cli_direccion' => $direccion,
					'cli_telefono' => $telefono,
					'cli_tipocliente' => $tipo_cliente
				);
				$registro = $this->ClienteModel->insert($clienteData);
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
			$cliente = $this->ClienteModel->select('id',$id);
			if(count($cliente)){
				$data = array(
					'cliente' => $cliente,
					'tipo_cliente' => $this->TipoClienteModel->select('todo'),
					'tipo_documento' => $this->TipoDocumentoModel->select('todo')
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
				'cli_dni' => $dni,
				'cli_nombres' => $nombres,
				'cli_paterno' => $paterno,
				'cli_materno' => $materno,
				'cli_direccion' => $telefono,
				'cli_telefono' => $direccion,
				'cli_tipocliente' => $tipo_cliente
			);
			$actualizar = $this->ClienteModel->update($id,$clienteData);
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

	function consulta_rest(){
		$valor = $this->input->post('valor');
		$resp = $this->ClienteModel->select('filtro',$valor);
		echo json_encode($resp);
	}

	function registro_rest(){
		$dni = $this->input->post('dni');
		$nombres = $this->input->post('nombres');
		$paterno = $this->input->post('paterno');
		$materno = $this->input->post('materno');
		$vrf = $this->ClienteModel->select('ver_dni',$dni);
		if (count($vrf) > 0) {

			$resp = array(
				'codigo'  => 0,
				'mensaje' => 'ya existe un cliente con ese dni',
				'contenido' => ''
			);
			echo json_encode($resp);
			die();
		}else{

			$data = array(
				'cli_dni' => $dni,
				'cli_nombres' => $nombres,
				'cli_paterno' => $paterno,
				'cli_materno' => $materno,
				'cli_direccion' => '',
				'cli_telefono' => '',
				'cli_tipocliente' => 1
			);
			$registro = $this->ClienteModel->insert2($data);
			if (count($registro) > 0) {
				$info = array(
					'id'=>$registro,
					'nombre' => $nombres.' '.$paterno.' '.$materno 
				);

				$resp = array(
					'codigo'  => 1,
					'mensaje' => 'Cliente registrado con exito',
					'contenido' => $info
				);
			}else{
				$resp = array(
					'codigo'  => 0,
					'mensaje' => 'El registro no se completo, intente de nuevo',
					'contenido' => ''
				);
			}
			echo json_encode($resp);
		}
		
	}
}
?>