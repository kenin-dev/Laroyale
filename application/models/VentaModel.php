<?php  

class VentaModel extends CI_Model
{
	
	function busquedaPedido($id, $oneline = false)
	{	
		if ($oneline) {



		}else{
			
			$sql = "CALL pa_pedido_pagos(?)";
			$venta = $this->db->query($sql, array($id));
			return	$venta->result();

		}
	}
}
?>