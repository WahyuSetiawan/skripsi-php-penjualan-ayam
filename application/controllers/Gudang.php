<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gudang extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(
				array(
					'ViewJumlahAyamModel',
					'KandangModel',
					'suppliermodel',
					'DetailJenisSupplierModel',
					'ViewStokGudangPakan',
					'PersediaanModel',
					"ViewStokGudangVaksin",
					"ViewHistoryTransaksiGudang",
					"TypeGudangModel",
					"DetailPembelianGudang",
					"DetailPengeluaranGudangModel"
				)
		);
	}

	public function index() {
		$this->data['gudang'] = $this->ViewStokGudangVaksin->get();
		$this->data['jumlah_ayam'] = $this->ViewJumlahAyamModel->get();
		$this->data['supplier'] = $this->suppliermodel->get();

		$this->blade->view("page.gudangvaksin", $this->data);
	}

	public function Transaksi($id = false, $page = 0) {
		$per_page = 1;

		if ($this->input->post('submit') !== null) {
			$data = array(
				"id_persediaan" => $this->input->post('id_persediaan'),
				"tanggal_transaksi" => $this->input->post('tanggal_transaksi'),
				"jumlah" => $this->input->post('jumlah'),
				"nominal" => $this->input->post('nominal')
			);

			if ($this->input->post('id') == "") {
				$this->DetailPembelianGudang->set($data);
			} else {
				$this->DetailPembelianGudang->put($data, $this->input->post('id'));
			}

			redirect(current_url());
		}

		if ($this->input->post('submit-pengeluaran') !== null) {
			$data = array(
				"id_persediaan" => $this->input->post('id_persediaan'),
				'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
				'id_kandang' => $this->input->post('id_kandang'),
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan')
			);

			if ($this->input->post('id') != "") {
				$this->DetailPengeluaranGudangModel->put($data, $this->input->post('id'));
			} else {
				echo "disini";
				$this->DetailPengeluaranGudangModel->set($data);
			}

			redirect(current_url());
		}
		
		if ($this->input->post('del-beli') !== null){
			$this->DetailPembelianGudang->del($this->input->post('id'));
			
			redirect(current_url());
		}
		
		if ($this->input->post('del-jual') !== null){
			$this->DetailPengeluaranGudangModel->del($this->input->post('id'));
			
			redirect(current_url());
		}

		$pagination = $this->getConfigPagination(site_url('gudangvaksin/transaksi/'), $this->ViewHistoryTransaksiGudang->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['gudang'] = $this->ViewHistoryTransaksiGudang->get(null, null, $id);
		$this->data['data'] = $this->ViewStokGudangVaksin->once($id);

		$this->data['type_gudang'] = $this->TypeGudangModel->get();
		$this->data['persediaan'] = $this->PersediaanModel->get();
		$this->data['kandang'] = $this->KandangModel->get();

		$this->blade->view('page.gudangvaksintransaksi', $this->data);
	}

}
