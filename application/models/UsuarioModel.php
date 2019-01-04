<?php  

class UsuarioModel extends CI_Model
{
	
	function buscar($usuario,$pass)
	{
		$sql = "CALL proc_usuario_verificar(?,?)";
		$usuario = $this->db->query($sql, array($usuario,$pass));
		return $usuario->row();

	}

}

?>
