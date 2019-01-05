<?php  

class CategoriaModel extends CI_Model
{
	
	function select($tipo = 'todo', $valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM categoria";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
			case 'activo':
				$sql = "SELECT * FROM categoria WHERE cat_estado = 1";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
			case 'id':
				$sql = "SELECT * FROM categoria WHERE cat_codigo = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->row();
				break;
		}
	}

	function update($data, $codigo){
		$this->db->where("cat_codigo",$codigo);
		$this->db->update("categoria",$data);
		return $this->db->affected_rows();
	}

	function insert($data){
		$this->db->insert("categoria",$data);
		return $this->db->affected_rows();
	}

	function activar($id, $valor){
		$sql = "UPDATE categoria SET cat_estado = ? WHERE cat_codigo = ?";
		$this->db->query($sql, array($valor,$id));
		return $this->db->affected_rows();
	}

}

?>