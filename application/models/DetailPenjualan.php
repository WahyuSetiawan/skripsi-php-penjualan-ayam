<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DetailPenjualan extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function set($data) {
		return $this->db->insert('detail_penjualan', $data);
	}

	public function put($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('detail_penjualan', $data);
	}

	public function del($id) {
		$this->db->where('id', $id);
		return $this->db->delete('detail_penjualan');
	}

}
