<?php  

class Producto extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model("ProductoModel");

		if (!$this->session->userdata('ses_sesion')) {
			redirect(base_url().'Autenticacion','refresh');	
		}
	}

	public function index(){
		$data = array(
			'productos' => $this->ProductoModel->select()
		);
		$this->load->view("layout/public/header.php");
		$this->load->view("producto/lista.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	public function registrar(){
		$data = array(
			'categorias' => $this->CategoriaModel->select()
		);
		$this->load->view("layout/public/header.php");
		$this->load->view("producto/registro.php",$data);
		$this->load->view("layout/public/footer.php");
	}

	public function registrar_envio(){
		$nombre = strtoupper($this->input->post('inputNombre'));
		$abreviatura = strtoupper($this->input->post('inputAbreviatura'));
		$descripcion = $this->input->post('inputDescripcion');
		$precio = $this->input->post('inputPrecio');
		$categoria = $this->input->post('inputCategoria');
		$estado = $this->input->post('inputEstado');

		if (count($this->ProductoModel->free_select('verificar',$nombre,$categoria))>1) {
				
			$this->session->set_flashdata('error', 'Ya existe un producto con el nombre y categoria especificados.');
			redirect(base_url().'producto/registrar','refresh');

		}else{

			$productoData = array(
				'prod_nombre' => $nombre,
				'prod_abreviatura' => $abreviatura,
				'prod_descripcion' => $descripcion,
				'prod_precio' => $precio,
				'prod_categoria' => $categoria,
				'prod_estado' => $estado
			);

			if ($this->ProductoModel->insert($productoData) > 0) {

				$this->session->set_flashdata('correcto', 'Producto registrado con exito.');
				redirect(base_url().'producto','refresh');
				
			}else{

				$this->session->set_flashdata('error', 'No se completo el proceso de registro, intente de nuevo.');
				redirect(base_url().'producto/registrar','refresh');
			}

		}
	}

	public function editar($id = null){
		if (is_null($id)) {
			
			$this->session->set_flashdata('error', 'Producto no encontrado.');
			redirect(base_url().'producto/registrar','refresh');

		}else{
			$producto = $this->ProductoModel->select('id',$id);
			if (count($producto) > 0) {
				
				$data = array(
					'categorias' => $this->CategoriaModel->select(),
					'producto' => $producto
				);
				$this->load->view("layout/public/header.php");
				$this->load->view("producto/editar.php",$data);
				$this->load->view("layout/public/footer.php");

			}else{

				$this->session->set_flashdata('error', 'Producto no encontrado.');
				redirect(base_url().'producto/registrar','refresh');

			}

		}
	}

	public function editar_envio(){
		$codigo = $this->input->post('inputCodigo');
		$nombre = strtoupper($this->input->post('inputNombre'));
		$abreviatura = strtoupper($this->input->post('inputAbreviatura'));
		$descripcion = $this->input->post('inputDescripcion');
		$precio = $this->input->post('inputPrecio');
		$categoria = $this->input->post('inputCategoria');
		$estado = $this->input->post('inputEstado');

		if (count($this->ProductoModel->free_select('verificar',$nombre,$categoria))>1) {
				
			$this->session->set_flashdata('error', 'Ya existe un producto con el nombre y categoria especificados.');
			redirect(base_url().'producto/registrar','refresh');

		}else{

			$productoData = array(
				'prod_nombre' => $nombre,
				'prod_abreviatura' => $abreviatura,
				'prod_descripcion' => $descripcion,
				'prod_precio' => $precio,
				'prod_categoria' => $categoria,
				'prod_estado' => $estado
			);

			if ($this->ProductoModel->update($productoData,$codigo) > 0) {

				$this->session->set_flashdata('correcto', 'Producto editado con exito.');
				redirect(base_url().'producto','refresh');
				
			}else{

				$this->session->set_flashdata('error', 'No se completo el proceso de edicion, intente de nuevo.');
				redirect(base_url().'producto/registrar','refresh');

			}

		}

	}

	function desactivar($id = null){
		if (is_null($id)) {
			redirect(base_url().'producto','refresh');
		}else{
			$activar = $this->ProductoModel->activar($id,0);
			if($activar > 0){
				$this->session->set_flashdata('correcto', 'Producto desactivado correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de desactivacion fallo, intente luego.!');
			}
			redirect(base_url().'producto','refresh');
		}
	}

	function activar($id = null){
		if (is_null($id)) {
			redirect(base_url().'producto','refresh');
		}else{
			$activar = $this->ProductoModel->activar($id,1);
			if($activar > 0){
				$this->session->set_flashdata('correcto', 'Producto activado correctamente!');
			}else{
				$this->session->set_flashdata('error', 'El proceso de activacion fallo, intente luego.!');
			}
			redirect(base_url().'producto','refresh');
		}
	}

	// public function categoria_productos_rest(){
	// 	$cate_id = $this->input->post('categoria');
	// 	$productos = $this->ProductoModel->select('categoria',$cate_id);
	// 	echo json_encode($productos);
	// }

	function consulta_rest(){
		echo json_encode($this->ProductoModel->select());
	}

	function consulta_rest_v2(){
		$cat = $this->input->post('id');
		echo json_encode($this->ProductoModel->select('categoria',$cat));
	}
}
?>