<?php  


class Autenticacion extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('UsuarioModel');
	}

	function index(){
		if ($this->session->userdata('ses_sesion')) {
			redirect(base_url().'Inicio','refresh');
		}else{
			$this->load->view("autenticacion/acceso.php");
		}
	} 

	function login(){
		$username = $this->input->post('username');
		$pass     = $this->input->post('pass');

		$usuario = $this->UsuarioModel->buscar($username,$pass);

		if (is_null($usuario)) {
			
			$resp = array(
				'estado' => 0,
				'mensaje' => 'usuario no encontrado',
				'contenido' => ''
			);

		}else{
			$sesion = array(
				'ses_usuario' => $usuario->usu_codigo,
			 	'ses_nombre' => $usuario->usu_nombres,
			 	'ses_email' => $usuario->emp_email,
			 	'ses_telefono' => $usuario->emp_telefono,
			 	'ses_sesion' => true
			);
			$this->session->set_userdata($sesion);

			$resp = array(
				'estado' => 1,
				'mensaje' => 'Bienvenido '.$usuario->usu_nombres,
				'contenido' => $usuario
			);
		}

		echo json_encode($resp);
	}

	public function logout(){
		$this->session->sess_destroy();
		// session_destroy();
		redirect(base_url());
	}
}

?>