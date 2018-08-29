<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class KaryawanModel extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get() {
		return $this->db->get('karyawan')->result();
	}

	public function set($data) {
		if (isset($data['password'])) {
			$data['password'] = crypt($data['password'], '$1$somethin$');
		}

		return $this->db->insert('karyawan', $data);
	}
	

	public function put($data, $id = false, $username = false) {

		if (isset($data['password'])) {
			$data['password'] = crypt($data['password'], '$1$somethin$');
		}

		if ($id != FALSE) {
			$this->db->where('id', $id);
		}

		if ($username != FALSE) {
			$this->db->where('username', $username);
		}
		
		return $this->db->update('karyawan', $data);
	}

	public function remove($id) {
		$this->db->where('id', $id);
		return $this->db->delete('karyawan');
	}

	public function countAll() {
		return $this->db->count_all('karyawan');
	}

	public function login($username, $password) {
		$this->db->where('username', $username);
		$admin = $this->db->get('karyawan')->row();

		if ($admin != null) {
			if (password_verify($password, $admin->password)) {
				return $admin;
			}
		}

		return false;
	}

}
