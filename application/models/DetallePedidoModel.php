<?php  

class DetallePedidoModel extends CI_Model
{
	
	function buscar($id){
		$sql = "SELECT dp.dp_id,dp.pedido_id,concat(c.abreviatura,' ',p.nombre) as 'dp_producto',p.abreviatura as 'dp_producto_abrev',dp.dp_precio,dp.dp_cantidad,dp.dp_importe,dp.dp_detalle FROM detalle_pedido dp INNER JOIN productos p ON p.id = dp.producto_id INNER JOIN categorias c ON c.id = p.categoria_id WHERE pedido_id = ?";
		$detalle = $this->db->query($sql, array($id));
		return $detalle->result();
	}
}

?>