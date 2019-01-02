<?php  
/**
 * 
 */
class ClienteModel extends CI_Model
{
	
	function buscar($tipo,$valor = 0)
	{
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM clientes";
				$cliente = $this->db->query($sql);
				return $cliente->result();
				break;

			case 'activos':
				$sql = "SELECT * FROM clientes WHERE estado = 1";
				$cliente = $this->db->query($sql);
				return $cliente->result();
				break;

			case 'uno':
				$sql = "SELECT * FROM clientes WHERE id = ?";
				$cliente = $this->db->query($sql, array($valor));
				return $cliente->row();
				break;
			case 'dni':
				$sql = "SELECT * FROM clientes WHERE num_documento = ?";
				$cliente = $this->db->query($sql, array($valor));
				return $cliente->result();
				break;
		}
	}

	function eliminar($id){
		$sql = "UPDATE clientes SET estado = 0 WHERE id = ?";
		$this->db->query($sql, array($id));
		return $this->db->affected_rows();
	}

	function editar($id, $data){
		$this->db->where("id",$id);
		$this->db->update("clientes",$data);
		return $this->db->affected_rows();
	}

	function insertar($data){
		$this->db->insert("clientes",$data);
		return $this->db->affected_rows();
	}
}
?>