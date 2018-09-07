<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model(array('viewHistoryTransaksi', 'ViewJumlahAyamModel', 'KandangPersediaanHistoryModel', 'ViewJumlahAyamModel', "AdminModel", "KaryawanModel"));
	}

	public function index() {
		if ($this->input->post('submit') !== null) {
			var_dump($this->input->post());

			if ($this->input->post('type') == "admin") {
				$this->AdminModel->put($this->session->userdata('id'), $this->input->post('username'), $this->input->post('password_baru'));

				redirect(current_url());
			}

			if ($this->input->post('type') == "karyawan") {
				$this->KaryawanModel->put(array("password" => $this->input->post('password_baru'), "hint" => $this->input->post('password_baru')), false, $this->input->post('username'));

				redirect(current_url());
			}
		}

		$this->data['transaksi'] = $this->viewHistoryTransaksi->get(null, 7);
		$this->data['jumlah_ayam'] = $this->ViewJumlahAyamModel->get();

		$persediaan = $this->ViewJumlahAyamModel->getJoinPersediaan();

		$timezone = 'WIB';
		$constraint = null;
		$rule = null;
		
		/*foreach ($persediaan as $key => $value) {
			$startDate = new \DateTime($value->tanggal_pembelian_terbaru, new \DateTimeZone($timezone));

			if (strtotime($value->tanggal_pembelian_terbaru) > strtotime($value->tanggal_penjualan_terbaru)) {
				$endDate = date_create($value->tanggal_pembelian_terbaru);
				date_add($endDate, date_interval_create_from_date_string("40 days"));
			} else {
				$endDate = new \DateTime(date("Y-m-t", $value->tanggal_penjualan_terbaru), new \DateTimeZone($timezone)); // Optional
			}

			$rule = (new \Recurr\Rule)
					->setStartDate($startDate)
					->setTimezone($timezone)
					->setInterval($value->durasi)
					->setFreq($value->type_durasi)
					->setUntil(new \DateTime(date_format($endDate, "Y-m-t")));

			$transformer = new \Recurr\Transformer\ArrayTransformer();

			$constraint = new \Recurr\Transformer\Constraint\BetweenConstraint(new \DateTime(date('Y-m-01') . " 00:00:00"), new \DateTime(date('Y-m-t') . " 23:59:59"), false);


			foreach ($transformer->transform($rule, $constraint) as $key => $value_date) {
				$datamodel = $this->KandangPersediaanHistoryModel->get(array(
					'tanggal' => $value_date->getStart()->format("Y-m-d"),
					'id_pembelian' => $value->id_pembelian_terbaru,
					'id' => $value->id_persediaan
				));

				$this->data['result'][$value_date->getStart()->format("Y-m-d")] = array(
					"id" => $value_date->getStart()->format("Ymd") . $value->id_kandang . $value->id_persediaan,
					"date" => $value_date->getStart()->format("Y-m-d"),
					"title" => "kandang " . $value->nama_kandang . " beri persediaan : " . $value->nama_persediaan . ((count($datamodel) >= 1) ? " (Telah Selesai)" : ''),
					"modal" => "#events-modal",
					"class" => (count($datamodel) >= 1) ? "event-success" : $value->type,
					"data" => $value,
					"start" => $value_date->getStart()->getTimestamp() * 1000, // Milliseconds
					"end" => $value_date->getEnd()->getTimestamp() * 1000 // Milliseconds
				);
			}

			krsort($this->data['result']);
		}*/

		$this->blade->view('index', $this->data);
	}

}
