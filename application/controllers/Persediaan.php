<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Persediaan extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model(array('kandangmodel', 'PersediaanModel'));
	}

	public function index() {
		if (null !== ($this->input->post("submit"))) {
			$data = [
				'nama' => $this->input->post("nama"),
				'keterangan' => $this->input->post("keterangan"),
				'cara_pemakaian' => $this->input->post("cara_pemakaian"),
				'type_durasi' => $this->input->post('type_durasi'),
				'durasi' => $this->input->post('durasi'),
				'type' => $this->input->post("type")
			];

			$this->PersediaanModel->set($data);

			redirect(current_url());
		}

		if (null !== ($this->input->post("put"))) {
			$data = [
				'nama' => $this->input->post("nama"),
				'keterangan' => $this->input->post("keterangan"),
				'cara_pemakaian' => $this->input->post("cara_pemakaian"),
				'type_durasi' => $this->input->post('type_durasi'),
				'durasi' => $this->input->post('durasi'),
				'type' => $this->input->post("type")
			];

			$this->PersediaanModel->put($data, $this->input->post('id'));

			redirect(current_url());
		}

		if (null !== ($this->input->post("del"))) {

			$this->PersediaanModel->remove($this->input->post('id'));

			redirect(current_url());
		}

		$per_page = 3;

		$pagination = $this->getConfigPagination(site_url('vaksin/index'), $this->PersediaanModel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['vaksin'] = $this->PersediaanModel->get($per_page, $this->data['page']);

		$this->blade->view("page.data_persediaan", $this->data);
	}

}
