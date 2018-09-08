<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model(array('kandangmodel', 'KaryawanModel', 'PersediaanModel', 'ViewJumlahAyamModel', 'viewHistoryTransaksi', 'KandangModel', 'ViewTransaksiAll'));

		$this->load->library('pdfgenerator');
	}

	public function index() {
		$this->blade->view("page.page_laporan", $this->data);
	}

	public function kandang($page = null, $print = null) {
		$per_page = 1000;

		$pagination = $this->getConfigPagination(site_url('kandang/index'), $this->kandangmodel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['kandang'] = $this->kandangmodel->get($this->data['per_page'], $this->data['page']);
		$this->data['title'] = "Laporan Kandang";

		if ($print != null) {
			$this->data['kandang'] = $this->kandangmodel->get();
			$laporan = $this->blade->render("page.laporan.laporan_kandang", $this->data);

			$this->pdfgenerator->generate($laporan, "laporankandang.pdf");

			return;
		}

		$this->blade->view("page.laporan.page_kandang", $this->data);
	}

	public function karyawan($page = null, $print = null) {
		$per_page = 1000;

		$pagination = $this->getConfigPagination(site_url('karyawan/index'), $this->KaryawanModel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['karyawan'] = $this->KaryawanModel->get($per_page, $this->data['page']);
		$this->data['title'] = "Laporan Karyawan";

		if ($print != null) {
			$this->data['karyawan'] = $this->KaryawanModel->get();
			$laporan = $this->blade->render("page.laporan.laporan_karyawan", $this->data);

			$this->pdfgenerator->generate($laporan, "laporankaryawan.pdf");

			return;
		}
		$this->blade->view('page.laporan.page_karyawan', $this->data);
	}

	public function stokAyam($page = null, $print = null) {
		$per_page = 1000;

		$pagination = $this->getConfigPagination(site_url('laporan/transaksi'), $this->ViewJumlahAyamModel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['kandang'] = $this->ViewJumlahAyamModel->get(false, $per_page, $this->data['page']);
		$this->data['title'] = "Laporan Stok Ayam";

		if ($print != null) {
			$this->data['kandang'] = $this->ViewJumlahAyamModel->get();
			$laporan = $this->blade->render("page.laporan.laporan_stok_ayam", $this->data);

			$this->pdfgenerator->generate($laporan, "laporankaryawan.pdf");

			return;
		}

		$this->blade->view('page.laporan.page_jumlah_stok', $this->data);
	}

	public function vaksin($page = null, $print = null) {
		$per_page = 1000;

		$pagination = $this->getConfigPagination(site_url('vaksin/index'), $this->PersediaanModel->countAll(), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);

		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;
		$this->data['vaksin'] = $this->PersediaanModel->get($per_page, $this->data['page']);
		$this->data['title'] = "Laporan Persediaan";

		if ($print != null) {
			$this->data['vaksin'] = $this->PersediaanModel->get();
			$laporan = $this->blade->render("page.laporan.laporan_persediaan", $this->data);

			$this->pdfgenerator->generate($laporan, "laporanvaksin.pdf");

			return;
		}

		$this->blade->view("page.laporan.page_persediaan", $this->data);
	}

	public function transaksi($page = null, $print = null, $idkandang = null) {
		$per_page = 3;
		$params = array();


		if ($this->input->get("ket") !== null) {
			if ($this->input->get("ket") !== "semua")
				$params['ket'] = $this->input->get("ket");
		}

		if ($this->input->get("id_kandang") !== null) {
			$params['id_kandang'] = $this->input->get("id_kandang");
		}

		if ($this->input->get("tahun") !== null) {
			$params['year(tanggal_transaksi)'] = $this->input->get("tahun");
		}

		if ($this->input->get("bulan") !== null) {
			$params['month(tanggal_transaksi)'] = $this->input->get("bulan");
		}

		$this->data['title'] = "Laporan Transaksi ";

		$pagination = $this->getConfigPagination(site_url('laporan/transaksi/'), $this->viewHistoryTransaksi->countAll($idkandang, $params), $per_page);
		$this->data['pagination'] = $this->pagination($pagination);
		$this->data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data['per_page'] = $per_page;

		if ($print != null) {
			$this->data['jumlah_ayam'] = $this->viewHistoryTransaksi->get($idkandang, null, null, $params);
			$laporan = $this->blade->render("page.laporan.laporan_transaksi", $this->data);

			$this->pdfgenerator->generate($laporan, "laporantransaksi.pdf");

			return;
		}

		$this->data['tahun_transaksi'] = $this->viewHistoryTransaksi->getTahun();
		$this->data['jumlah_ayam'] = $this->viewHistoryTransaksi->get($idkandang, $per_page, $this->data['page'], $params);
		$this->data['kandang'] = $this->kandangmodel->get();

		$this->blade->view("page.laporan.page_transaksi", $this->data);
	}

	public function gudang($page = null, $print = null, $idkandang = null) {
		$per_page = 3;
		$params = array();
		$where = array();

		$this->data['title'] = "Laporan";

		if ($this->input->get("ket") !== null) {
			if ($this->input->get("ket") !== "semua") {
				$params['ket'] = $this->input->get("ket");
			}
		}

		if ($this->input->get("id_kandang") !== null) {
			$params['id_kandang'] = $this->input->get("id_kandang");
			$this->data['data_ayam'] = $this->ViewJumlahAyamModel->once($params['id_kandang']);
			$where['id_detail_pemasukan_ayam'] = $this->data['data_ayam']->id_pembelian_terbaru;
		}

		if ($this->input->get("tahun") !== null) {
			$params['year(tanggal_transaksi)'] = $this->input->get("tahun");
		}

		if ($this->input->get("bulan") !== null) {
			$params['month(tanggal_transaksi)'] = $this->input->get("bulan");
		}

		if ($print != null) {
			if (!isset($params['id_kandang'])) {
				$this->session->set_flashdata('kesalahan', "Kandang Harus dipilih terlebih dahulu !");

				redirect('laporan/gudang');
			}

			$this->data['jumlah_ayam'] = $this->viewHistoryTransaksi->get($params['id_kandang'], null, null, $params);
			$this->data['data_ayam'] = $this->ViewJumlahAyamModel->once($params['id_kandang']);
			$this->data['transaksi'] = $this->ViewTransaksiAll->get(null, null, array('id_detail_pemasukan_ayam' => $this->data['data_ayam']->id_pembelian_terbaru));

			$this->data['title'] = $this->data['title'] . "<br>" . $this->data['data_ayam']->nama_kandang;

			if (isset($this->data['data_ayam'])) {
				$laporan = $this->blade->render("page.laporan.laporan_gudang", $this->data);
				echo $laporan;
			}


			//	$this->pdfgenerator->generate($laporan, "laporantransaksi.pdf");

			return;
		}

		$this->data['tahun_transaksi'] = $this->viewHistoryTransaksi->getTahun();
		$this->data['jumlah_ayam'] = $this->ViewTransaksiAll->get(null, null, $where);
		$this->data['kandang'] = $this->kandangmodel->get();

		$this->blade->view("page.laporan.page_gudang", $this->data);
	}

}
