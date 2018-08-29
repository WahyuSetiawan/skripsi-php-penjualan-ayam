<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class JenisSupplierModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get($limit = null, $offset = null, $id= null, $where = array()) {
		$this->db->where($where);
		
		return $this->db->get('jenis_supplier', $limit, $offset)->result();
	}

	public function set($data) {
		return $this->db->insert('jenis_supplier', $data);
	}

	public function update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update('jenis_supplier', $data);
	}

	public function delete($id) {
		$this->db->where('jenis_supplier', $id);

		return $this->db->delete('jenis_supplier');
	}

}
