<?php  

class ReporteModel extends CI_Model
{
	
	function cliente($tipo,$valor = 0)
	{
		switch ($tipo) {
			case 'cantidad_total':
				$sql = "SELECT COUNT(*) AS 'cantidad' FROM cliente";
				$cantidad = $this->db->query($sql);
				return $cantidad->row();
				break;
			
			case 'cantidad_nuevos':
				$sql = "SELECT COUNT(*) FROM cliente WHERE";
				$cantidad = $this->db->query($sql);
				return $cantidad->row();
				break;
		}
	}
}

?>