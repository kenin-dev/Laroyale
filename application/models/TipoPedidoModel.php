<?php  

class TipoPedidoModel extends CI_Model
{
	
	function select($tipo = 'todo', $valor = 0)
	{
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM tipo_pedido";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
		}
	}
}

?>