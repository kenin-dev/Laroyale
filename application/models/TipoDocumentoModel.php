<?php  

class TipoDocumentoModel extends CI_Model
{
	
	function select($tipo = 'todo',$id = 0)
	{
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM tipo_documento";
				$cliente = $this->db->query($sql);
				return $cliente->result();
				break;

			case 'uno':
				$sql = "SELECT * FROM tipo_documento WHERE tdoc_codigo = ?";
				$cliente = $this->db->query($sql, array($id));
				return $cliente->row();
				break;
		}
	}

	function eliminar($id){
		$sql = "UPDATE tipo_documento SET estado = 0 WHERE id = ?";
		$this->db->query($sql, array($id));
		return $this->db->affected_rows();
	}

	function editar($id, $data){
		$this->db->where("id",$id);
		$this->db->update("tipo_documento",$data);
		return $this->db->affected_rows();
	}

	function insertar($data){
		$this->db->insert("tipo_documento",$data);
		return $this->db->affected_rows();
	}
}
?>