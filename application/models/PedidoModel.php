<?php  

class PedidoModel extends CI_Model
{
	
	function insert($tip,$des,$ref,$sub)
	{
		$sql = "SELECT fx_pedido_registrar(?,?,?,?) as 'pedido'";
		$ins = $this->db->query($sql,array($tip,$des,$ref,$sub));
		return $ins->row();

		// $this->db->insert("pedido",$data);
		// return $this->db->insert_id();	
		// $sql = "CALL proc_pedido_registrar(?,?,?,?)";
		// return $this->db->insert_id();	
	}

	function select($tipo = 'todo',$valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM pedido";
				$todo = $this->db->query($sql);
				return $todo->result();
				break;
			case 'estado':
				$sql = "SELECT p.ped_codigo,p.ped_serie,p.ped_tipo,p.ped_destino,p.ped_referencia,p.ped_fecha,p.ped_subtotal,p.ped_estado,tp.tped_nombre as 'ped_tipo_nombre' FROM pedido p 
    				INNER JOIN tipo_pedido tp ON tp.tped_codigo = ped_tipo WHERE p.ped_estado = ? ORDER BY ped_fecha DESC";
				$todo = $this->db->query($sql, array($valor));
				return $todo->result();
				break;
			case 'id':
				$sql = "SELECT * FROM pedido WHERE ped_codigo = ?";
				$id = $this->db->query($sql, array($valor));
				return $id->row();
				break;
			case 'id_pendiente':
				$sql = "SELECT p.ped_codigo,p.ped_serie,p.ped_tipo,p.ped_destino,p.ped_referencia,p.ped_fecha,p.ped_subtotal,p.ped_estado,tp.tped_nombre as 'ped_tipo_nombre' FROM pedido p 
    				INNER JOIN tipo_pedido tp ON tp.tped_codigo = ped_tipo WHERE ped_codigo = ? AND ped_estado = 'P'";
				$id_pendiente = $this->db->query($sql, array($valor));
				return $id_pendiente->row();
				break;
		}
	}

	function update($tipo = 'normal',$valor = 0,$add){
		switch ($tipo) {
			case 'estado':
				$sql = "UPDATE pedido SET ped_estado = ? WHERE ped_codigo = ?";
				$this->db->query($sql, array($valor,$add));
				return $this->db->affected_rows();
				break;
			
			default:
				# code...
				break;
		}
	}

}

?>