<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesaModel extends CI_Model {

	function select($tipo = 'todo', $valor = 0){
		switch ($tipo) {
			case 'todo':
				$sql = "SELECT * FROM mesa";
				$consulta = $this->db->query($sql);
				return $consulta->result();
				break;
			case 'id':
				$sql = "SELECT * FROM mesa WHERE mes_codigo = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->result();
				break;
			case 'numero':
				$sql = "SELECT * FROM mesa WHERE mes_numero = ?";
				$consulta = $this->db->query($sql, array($valor));
				return $consulta->result();
				break;
		}
	}

	function insert($data){
		$this->db->insert("mesa",$data);
		return $this->db->affected_rows();
	}

	function delete($id){
		$sql = "DELETE mesa WHERE mes_codigo = ?";
		$this->db->query($sql, array($id));
		return $this->db->affected_rows();
	}

	function update($id, $data){
		$this->db->where("mes_codigo",$id);
		$this->db->update("mesa",$data);
		return $this->db->affected_rows();
	}

}
