<?php  

class CategoriaModel extends CI_Model
{
	
	function SelectAll()
	{
		$this->db->where("estado","1");
		$resultados = $this->db->get("categorias");
		return $resultados->result();	
	}
}

?>