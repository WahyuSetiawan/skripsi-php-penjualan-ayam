<?php

class SupplierModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function set($data) {
		$this->db->insert('supplier', $data);

		return $this->db->insert_id();
	}

	public function get($limit = null, $offset = null, $param = array()) {
		if (isset($param['type_gudang'])) {
			$this->db->join('detail_supplier_jenis', 'detail_supplier_jenis.id_supplier = supplier.id', 'inner');

			$this->db->where('id_jenis', $param['type_gudang']);
		}
		
		$data = $this->db->get('supplier', $limit, $offset)->result();

		foreach ($data as &$value) {
			$value->jenis = $this->DetailJenisSupplierModel->get(null, null, null, array('id_supplier' => $value->id));
		}

		return $data;
	}

	public function put($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('supplier', $data);
	}

	public function remove($id) {
		$this->db->where('id', $id);
		$this->db->delete('supplier');
	}

	public function vaksinJoinKandang() {
		$this->db->join('detail_kandang_vaksin', 'detail_kandang_vaksin.id_vaksin = kandang.id', 'inner');
		$this->db->join('kandang', 'detail_kandang_vaksin.id_kandang = kandang.id', 'inner');

		return $this->db->get('vaksin')->result();
	}

	public function countAll() {
		return $this->db->count_all('supplier');
	}

}
