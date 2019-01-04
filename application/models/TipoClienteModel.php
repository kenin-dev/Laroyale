<?php  

class TipoClienteModel extends CI_Model
{
	
	function select($tipo = 'todo',$id = 0)
	{
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM tipo_cliente";
				$tipos = $this->db->query($sql);
				return $tipos->result();
				break;
			
		}
	}
}
?>