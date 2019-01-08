<?php  

class PedidoDetalleModel extends CI_Model
{
	
	function select($tipo = 'todo', $valor = 0){
		switch ($tipo) {
			case 'todo':
				// $sql = "CALL proc_pedido";
				break;
			
			default:
				# code...
				break;
		}
	}

	function insert($data){
		$this->db->insert("pedido_detalle",$data);
		// return $this->db->affected_rows();
	}

	// function insert($ped,$prod,$cant,$prec,$imp,$det){
	// 	$sql = "INSERT INTO pedido_detalle(pdet_pedido,pdet_producto,pdet_cantidad,pdet_precio,pdet_importe,pdet_detalle) VALUES(NULL,?,?,?,?,?,?)";
	// 	$this->db->query($sql,array($ped,$prod,$cant,$prec,$imp,$det));
	// 	return $this->db->affected_rows();
	// }
}

?>


