<?php  

class ProductoModel extends CI_Model
{
	
        function SelectCategoria($categoria)
	{
        	$this->db->select("p.*,c.nombre as categoria,c.imagen as imagen");
                $this->db->from("productos p");
                $this->db->join("categorias c","p.categoria_id = c.id");
                $this->db->where("p.estado","1");
                $this->db->where("p.categoria_id", $categoria);
                $resultados = $this->db->get();
                return $resultados->result();
	}
}

?>