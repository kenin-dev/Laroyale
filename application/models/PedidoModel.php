<?php  
/**
 * 
 */
class PedidoModel extends CI_Model
{
	
	function insertar()
	{
		
	}

	function buscar($oneline = false){

		if ($oneline) {
			
			$sql = "select * from pedido p where p.ped_estado = 'pendiente'";
			$resultado = $this->db->query($sql);
			return $resultado->result();

		}else{

			$sql = "select * from pedido p where p.ped_estado = 'pendiente'";
			$resultado = $this->db->query($sql);
			return $resultado->result();

		}
	}
}

?>