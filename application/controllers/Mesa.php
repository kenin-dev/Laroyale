<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('MesaModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}	
	}

	public function index(){
		$data  = array(
			'mesas' => $this->MesaModel->select(), 
		);
		$this->load->view("layout/public/header");
		$this->load->view("mesa/lista",$data);
		$this->load->view("layout/public/footer");

	}

	public function nuevo(){
		$this->load->view("layout/public/header");
		$this->load->view("mesa/registro");
		$this->load->view("layout/public/footer");
	}

	public function registrar(){
		$numero = $this->input->post('inputNumero');
		$descripcion = $this->input->post('inputDescripcion');

		if (strlen($numero) > 0) {
			if (count($this->MesaModel->select('numero',$numero)) > 0) {
				
				$this->session->set_flashdata('error', 'El numero de la mesa ya existe, intente con otro.');
				redirect(base_url().'Mesa/nuevo','refresh');
			}else{
				try {
					$mesaData = array(
						'mes_numero' => $numero,
						'mes_descripcion' => $descripcion
					);

					$this->MesaModel->insert($mesaData);
					$this->session->set_flashdata('correcto', 'Mesa registrada con exito.');
					redirect(base_url().'Mesa','refresh');
					
				} catch (Exception $e) {
					$this->session->set_flashdata('error', $e->getMessage());
					redirect(base_url().'Mesa/nuevo','refresh');
				}

			}
		}else{
			$this->session->set_flashdata('error', 'Datos incompletos, intente otra vez.');
			redirect(base_url().'Mesa/nuevo','refresh');
		}
	} 

	public function eliminar($id = null){
		if (is_null($id)) {
			redirect(base_url().'mesa','refresh');
		}else{
			$eliminar = $this->MesaModel->delete($id);
			if($eliminar > 0){
				$this->session->set_flashdata('correcto', 'Mesa eliminada correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de eliminacion fallo, intente luego.!');
			}
			redirect(base_url().'mesa','refresh');
		}
	}

	function editar($id = null){
		if (is_null($id)) {
			redirect(base_url().'mesa','refresh');

		}else{
			$mesa = $this->MesaModel->select('id',$id);
			if(count($mesa)){
				$data = array(
					'mesa' => $mesa
				);	

				$this->load->view("layout/public/header.php");
				$this->load->view("mesa/editar.php",$data);
				$this->load->view("layout/public/footer.php");
			}else{
				$this->session->set_flashdata('error', 'Cliente no encontrado!');
				redirect(base_url().'cliente','refresh');
			}
		}
	}

	function editar_enviar(){
		$id = $this->input->post('inputId');
		$numero = $this->input->post('inputNumero');
		$descripcion = $this->input->post('inputDescripcion');
		$estado = $this->input->post('inputEstado');

		if(strlen($id) > 0){
			try {
				$this->db->trans_begin();
				$mesaData = array(
					'mesa_numero' => $numero,
					'mesa_descripcion' => $descripcion,
					'mesa_estado' => $estado
				);
				$actualizar = $this->MesaModel->update($id,$mesaData);
				$this->db->trans_commit();
				$this->session->set_flashdata('correcto', 'Datos actualizados');
				// redirect(base_url().'mesa','refresh');
			} catch (Exception $e) {
				$this->session->set_flashdata('error', $e->getMessage());
			}
			redirect(base_url().'mesa','refresh');
		}else{
			$this->session->set_flashdata('error', 'mesa no especificada');
			redirect(base_url().'mesa','refresh');
		}

	}

	function consulta_rest(){
		$mesas = $this->MesaModel->select();
		echo json_encode($mesas);
	}

}

?>