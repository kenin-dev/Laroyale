<?php  

class UsuarioModel extends CI_Model
{
	
	function buscar($usuario,$pass)
	{
		$sql = "CALL proc_usuario_verificar(?,?)";
		$usuario = $this->db->query($sql, array($usuario,$pass));
		return $usuario->row();
	}

	function select($tipo = 'todo', $d1 = 0,$d2 = 0){
		switch ($tipo) {
			case 'usuario_pass':
				$sql = "CALL proc_usuario_verificar(?,?)";
				$usuario = $this->db->query($sql, array($d1,$d2));
				return $usuario->row();
				break;
			
			case 'id':
				$sql = "CALL proc_usuario_info(?)";
				$id  = $this->db->query($sql, array($valor));
				return $id->row();
				break;
		}
	}
}

?>
