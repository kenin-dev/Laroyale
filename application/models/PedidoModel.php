<?php  

class PedidoModel extends CI_Model
{
	
	function insert($data)
	{
		$this->db->insert("pedido",$data);
		return $this->db->insert_id();	
	}

	function select($tipo = 'todo',$valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM pedido";
				$todo = $this->db->query($sql);
				return $todo->result();
				break;
			case 'pendiente':
				$sql = "SELECT * FROM pedido WHERE ped_estado = 'P' ORDER BY ped_fecha DESC";
				$todo = $this->db->query($sql);
				return $todo->result();
				break;
			case 'entregado':
				$sql = "SELECT * FROM pedido WHERE ped_estado = 'E' ORDER BY ped_fecha DESC";
				$todo = $this->db->query($sql);
				return $todo->result();
				break;
			case 'anulado':
				$sql = "SELECT * FROM pedido WHERE ped_estado = 'A' ORDER BY ped_fecha DESC";
				$todo = $this->db->query($sql);
				return $todo->result();
				break;
			case 'id':
				# code...
				break;
		}

	}


}

?>