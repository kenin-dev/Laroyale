<?php  

class ClienteModel extends CI_Model
{
	function select($tipo = 'todo',$valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM cliente";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
			case 'id':
				$sql = "SELECT * FROM cliente WHERE cli_codigo = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->row();
				break;
			case 'dni':
				$sql = "SELECT * FROM cliente WHERE cli_dni = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->row();
				break;
		}
	}

	function insert($data){
		$this->db->insert("cliente",$data);
		return $this->db->affected_rows();
	}

	function delete($id){
		$sql = "DELETE cliente WHERE cli_codigo = ?";
		$this->db->query($sql, array($id));
		return $this->db->affected_rows();
	}

	function update($id, $data){
		$this->db->where("cli_codigo",$id);
		$this->db->update("cliente",$data);
		return $this->db->affected_rows();
	}

	function activar($id){
		$sql = "UPDATE producto SET prod_estado = 0 WHERE prod_codigo = ?";
		$this->db->query($sql, array($id));
		return $this->db->affected_rows();
	}


}

?>