<?php  

class ProductoModel extends CI_Model
{
	
	function select($tipo = 'todo',$valor = 0)
	{
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT *,c.cat_nombre as 'prod_categoria_nombre' FROM producto p INNER JOIN categoria c ON c.cat_codigo = p.prod_categoria";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
			
			case 'activo':
				$sql = "SELECT * FROM producto WHERE prod_estado = 1";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;

			case 'id':
				$sql = "SELECT * FROM producto WHERE prod_codigo = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->row();
				break;

			case 'categoria':
				$sql = "SELECT * FROM producto WHERE prod_categoria = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->result();
				break;
		}
	}

	function update($data, $codigo){
		$this->db->where("prod_codigo",$codigo);
		$this->db->update("producto",$data);
		return $this->db->affected_rows();
	}

	function insert($data){
		$this->db->insert("producto",$data);
		return $this->db->affected_rows();
	}

	function activar($id, $estado){
		$sql = "UPDATE producto SET prod_estado = ? WHERE prod_codigo = ?";
		$this->db->query($sql, array($estado,$id));
		return $this->db->affected_rows();
	}

	function free_select($razon = 'verificar', $d1 = 0,$d2 = 0,$d3 = 0){
		switch ($razon) {
			case 'verificar':
				$sql = "SELECT * FROM producto WHERE prod_nombre = ? AND prod_categoria = ? ";
				$verificar = $this->db->query($sql,array($d1,$d2));
				return $verificar->result();
				break;
		}
	}
}

?>	

