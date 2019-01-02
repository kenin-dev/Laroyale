<?php  
/**
 * 
 */
class TipoClienteModel extends CI_Model
{
	
	function buscar($tipo,$id = 0)
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