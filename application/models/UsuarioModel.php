<?php  

class UsuarioModel extends CI_Model
{
	
	function buscar($usuario,$pass)
	{
		$sql = "CALL proc_usuario_verificar(?,?)";
		$usuario = $this->db->query($sql, array($usuario,$pass));
		return $usuario->row();
	}

	function select($tipo = 'todo', $valor = 0){
		switch ($tipo) {
			case 'todo':
				# code...
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
