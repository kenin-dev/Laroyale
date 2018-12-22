<?php  

class UsuarioModel extends CI_Model
{
	
	function buscar($usuario,$pass)
	{
		$sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
		$usuario = $this->db->query($sql, array($usuario,$pass));
		return $usuario->row();

		// $sql = "select * from usuarios where username='$usuario' and password='$pass'";
		// $usuario = $this->db->query($sql);
		// return $usuario->row();
	}

}

?>
