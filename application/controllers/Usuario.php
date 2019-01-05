<?php  

class Usuario extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('UsuarioModel');
		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');
		}
		
	}

	function perfil(){
		$id = $this->input->post('codigo');
		if (strlen($id) > 0) {
			$usuario = $this->UsuarioModel->select('id',$id);
			if (count($usuario) > 0) {
				
				$data = array(
					'usuario' => $usuario
				);
				$this->load->view("layout/public/header.php");
				$this->load->view("usuario/perfil.php",$data);
				$this->load->view("layout/public/footer.php");

			}else{
				redirect(base_url(),'refresh');
			}

		}else{
			redirect(base_url(),'refresh');
		}
	}


}

?>