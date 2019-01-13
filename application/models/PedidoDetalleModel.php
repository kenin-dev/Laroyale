<?php  

class PedidoDetalleModel extends CI_Model
{
	
	function select($tipo = 'todo', $valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT pd.pdet_codigo,pd.pdet_pedido,p.prod_codigo as 'pdet_producto',concat(c.cat_abreviatura,' ',p.prod_nombre) as 'pdet_producto_nombre',pd.pdet_cantidad,pd.pdet_precio,pd.pdet_importe,pd.pdet_detalle FROM pedido_detalle pd INNER JOIN producto p ON p.prod_codigo = pd.pdet_producto INNER JOIN categoria c ON p.prod_categoria = c.cat_codigo WHERE pdet_pedido = ?";
				$todo = $this->db->query($sql, array($valor));
				return $todo->result();
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


