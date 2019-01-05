<?php  

class Categoria extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ProductoModel');

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	function index(){

		$data = array(
			'categorias' => $this->CategoriaModel->select('todo')
		);
		$this->load->view("layout/public/header.php");
		$this->load->view("categoria/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	function registrar(){
		$this->load->view("layout/public/header.php");
		$this->load->view("categoria/registro.php");
		$this->load->view("layout/public/footer.php");
	}

	function registrar_envio(){
		$nombre   = $this->input->post('inputNombre');
		$abrev    = $this->input->post('inputAbreviatura');
		$descrip  = $this->input->post('inputDescripcion');
		$estado   = $this->input->post('inputEstado');
		$imagen   = 'cloud/categoria/default_categoria.jpg';

		if ($_FILES['inputImagen']['error'] == 0) {

			$ruta = 'cloud/categoria';	
			$config['upload_path']   = './'.$ruta;
			$config['file_name']     = $nombre;
			$config['overwrite']     = true;
		    $config['allowed_types'] = 'jpg|jpeg|png';
		    $config['max_size']      = 1024;
		    $config['max_width']     = 1920;
		    $config['max_height']    = 1280;

		    $this->load->library('upload', $config);

		    if (!$this->upload->do_upload('inputImagen')){
		        $error = array('error' => $this->upload->display_errors());
		        $this->session->set_flashdata('error', 'La imagen debe medir menos de 1920px de ancho y 1080px de alto, ademas de pesar menos de 2mb.');
		        redirect(base_url().'categoria/registrar','refresh');
		    }else{
		        $data = array('upload_data' => $this->upload->data('file_ext'));
		        $imagen = $ruta.'/'.str_replace(' ','_',$nombre).$data['upload_data'];
		    }

		}

		$categoriaData = array(
			'cat_nombre' => $nombre,
			'cat_abreviatura' => $abrev,
			'cat_descripcion' => $descrip,
			'cat_imagen' => $imagen,
			'cat_estado' => $estado
		);

		if ($this->CategoriaModel->insert($categoriaData)>0) {
			$this->session->set_flashdata('correcto', 'Categoria registrada con exito.');
		}else{
			$this->session->set_flashdata('error', 'el proceso de registro no se completo, intente de nuevo.');
		}

		redirect(base_url().'categoria','refresh');
		
	}

	function desactivar($id = null){
		if (is_null($id)) {
			redirect(base_url().'cliente','refresh');
		}else{
			$eliminar = $this->CategoriaModel->activar($id,0);
			if($eliminar > 0){
				$this->session->set_flashdata('correcto', 'Categoria desactivada correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de desactivacion fallo, intente luego.!');
			}
			redirect(base_url().'categoria','refresh');
		}
	}

	function activar($id = null){
		if (is_null($id)) {
			redirect(base_url().'cliente','refresh');
		}else{
			$eliminar = $this->CategoriaModel->activar($id,1);
			if($eliminar > 0){
				$this->session->set_flashdata('correcto', 'Categoria activada correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de activacion fallo, intente luego.!');
			}
			redirect(base_url().'categoria','refresh');
		}
	}

	function editar($id = null){

		if (is_null($id)) {

			redirect(base_url().'categoria','refresh');

		}else{
			$categoria = $this->CategoriaModel->select('id',$id);
			if(count($categoria)){
				$data = array(
					'categoria' => $categoria
				);	

				$this->load->view("layout/public/header.php");
				$this->load->view("categoria/editar.php",$data);
				$this->load->view("layout/public/footer.php");
			}else{
				$this->session->set_flashdata('error', 'Cliente no encontrado!');
				redirect(base_url().'cliente','refresh');
			}
		}

	}

	function editar_enviar(){
		$codigo   = $this->input->post('inputCodigo');
		$nombre   = $this->input->post('inputNombre');
		$abrev    = $this->input->post('inputAbreviatura');
		$descrip  = $this->input->post('inputDescripcion');
		$estado   = $this->input->post('inputEstado');
		$imagen   = 'cloud/categoria/default_categoria.jpg';

		$categoriaData = array(
			'cat_nombre' => $nombre,
			'cat_abreviatura' => $abrev,
			'cat_descripcion' => $descrip,
			'cat_imagen' => $imagen,
			'cat_estado' => $estado
		);

		if ($_FILES['inputImagen']['error'] == 0) {

			$ruta = 'cloud/categoria';	
			$config['upload_path']   = './'.$ruta;
			$config['file_name']     = $nombre;
			$config['overwrite']     = true;
		    $config['allowed_types'] = 'jpg|jpeg|png';
		    $config['max_size']      = 1024;
		    $config['max_width']     = 1920;
		    $config['max_height']    = 1280;

		    $this->load->library('upload', $config);

		    if (!$this->upload->do_upload('inputImagen')){
		        $error = array('error' => $this->upload->display_errors());
		        $this->session->set_flashdata('error', 'La imagen debe medir menos de 1920px de ancho y 1080px de alto, ademas de pesar menos de 2mb.');
		        redirect(base_url().'categoria/registrar','refresh');
		    }else{
		        $data = array('upload_data' => $this->upload->data('file_ext'));
		        $categoriaData['cat_imagen'] = $ruta.'/'.str_replace(' ','_',$nombre).$data['upload_data'];
		    	// array_push($categoriaData,$imagen);
		    	// $categoriaData['cat_imagen'] = 'nothing';
		    }

		}else{
			unset($categoriaData['cat_imagen']);
		}

		// print_r($categoriaData);

		if ($this->CategoriaModel->update($categoriaData,$codigo)>0) {
			$this->session->set_flashdata('correcto', 'Categoria registrada con exito.');
		}else{
			$this->session->set_flashdata('error', 'el proceso de registro no se completo, intente de nuevo.');
		}

		redirect(base_url().'categoria','refresh');

	}

	function consulta_rest(){
		echo json_encode($this->CategoriaModel->select('activo'));
	}

}
?>