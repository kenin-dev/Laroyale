<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesaModel extends CI_Model {

	public function getMesasTodas(){
		// $this->db->where("estado","1");
		$resultados = $this->db->get("mesa");
		return $resultados->result();
	}

	public function getMesasLibres(){
		$this->db->where("estado","libre");
		$resultados = $this->db->get("mesa");
		return $resultados->result();
	}

	public function insertar($data){
		$this->db->insert("mesa",$data);
		return $this->db->affected_rows();
	}

	public function consultar_mesa($valor,$busc = 'id'){
		switch ($busc) {
			case 'id':
				$sql = "select * from mesa where mesa_id = ?";
				$consulta = $this->db->query($sql,array($valor));
				return $consulta->row(); 
				break;
			case 'numero':
				$sql = "select * from mesa where mesa_numero = ?";
				$consulta = $this->db->query($sql,array($valor));
				return $consulta->row(); 
				break;
		}
	}


	public function eliminar($id){
		$sql = "delete from mesa where mesa_id = ?";
		$this->db->query($sql,array($id));
		return $this->db->affected_rows();
	}

	public function editar($id,$data){
		$this->db->where("mesa_id",$id);
		return $this->db->update("mesa",$data);
	}

}
