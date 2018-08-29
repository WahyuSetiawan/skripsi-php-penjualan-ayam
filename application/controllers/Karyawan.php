<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model(array('suppliermodel', 'KaryawanModel'));
	}

	public function index() {
		if (null !== ($this->input->post("submit"))) {
			$data = [
				'nama' => $this->input->post("nama"),
				'tanggal_lahir' => $this->input->post("tanggal_lahir"),
				'tempat_lahir' => $this->input->post("tempat_lahir"),
				'alamat' => $this->input->post("alamat"),
				'no_hp' => $this->input->post("telepon"),
				'gaji' => $this->input->post("gaji"),
				"username" => $this->input->post("username"),
				"password" => ($this->input->post("password")),
				"hint" => $this->input->post("password")
			];

			$this->KaryawanModel->set($data);

			redirect(current_url());
		}

		if (null !== ($this->input->post("put"))) {
			$data = [
				'nama' => $this->input->post("nama"),
				'tanggal_lahir' => $this->input->post("tanggal_lahir"),
				'tempat_lahir' => $this->input->post("tempat_lahir"),
				'alamat' => $this->input->post("alamat"),
				'no_hp' => $this->input->post("telepon"),
				'gaji' => $this->input->post("gaji"),
				"username" => $this->input->post("username"),
				"hint" => $this->input->post("password")
			];

			if ($this->input->post("password") != "") {
				$data["password"] = ($this->input->post("password"));
			}

			$this->KaryawanModel->put($data, $this->input->post('id'));

			redirect(current_url());
		}

		if (null !== ($this->input->post("del"))) {

			$this->KaryawanModel->remove($this->input->post('id'));

			redirect(current_url());
		}

		$per_page = 3;

		$pagination = $this->getConfigPagination(site_url('karyawan/index'), $this->KaryawanModel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['karyawan'] = $this->KaryawanModel->get($per_page, $this->data['page']);

		$this->blade->view("page.karyawan", $this->data);
	}

}
