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
			case 'filtro':
				$sql = "SELECT * FROM cliente WHERE cli_dni like concat(?,'%') OR cli_paterno like concat(?,'%')";
				$filtro = $this->db->query($sql, array($valor,$valor));
				return $filtro->result();
			case 'ver_dni':
				$sql = "SELECT * FROM cliente WHERE cli_dni=?";
				$ver_dni = $this->db->query($sql, array($valor));
				return $ver_dni->result();
		}
	}

	function insert($data){
		$this->db->insert("cliente",$data);
		return $this->db->affected_rows();
	}

	function insert2($data){
		$this->db->insert("cliente",$data);
		return $this->db->insert_id();
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