@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Detail Transaksi Keluar Masuk Gudang (Gudang : <?= $data->id_persediaan ?>)</h3>

	<div class="col-lg-12">
		<div class="col-lg-12  m-b-25">
			<div class="card">
				<div class="card-body">
					<div class="row  m-b-10">
						<div class="col-md-12">
							<h4>Informasi Gudang</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							Id  
						</div>
						<div class="col-md-3">
							: <?= $data->id_persediaan ?>
						</div>
						<div class="col-md-3">
							Jumlah  Sekarang 
						</div>
						<div class="col-md-3">
							: <strong><?= $data->jumlah ?></strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							Keterangan
						</div>
						<div class="col-md-9">
							: <?= $data->keterangan ?>
						</div>
						<div class="col-md-3">
							Cara Pemakaian
						</div>
						<div class="col-md-3">
							: <?= $data->cara_pemakaian ?>
						</div>
					</div>

				</div>
				<div class="card-footer">
					<button class="btn btn-success btn-add-pembelian-gudang" type="button">
						<i class="zmdi zmdi-plus"></i> Pemasukan</button>

					<button class="btn btn-info btn-add-pengeluaran-gudang" type="button">
						<i class="zmdi zmdi-plus"></i> Pengeluaran </button>
				</div>
			</div>
		</div>


		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Bibit</th>
						<th>Tanggal</th>
						<th>Jumlah</th>
						<th>Nominal</th>
						<th>Ket..</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($gudang as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->id ?></td>
							<td><?= $value->id_pemasukan_ayam ?></td>
							<td><?= $value->tanggal_transaksi ?></td>
							<td><?= $value->jumlah ?></td>
							<td><?= $value->nominal ?></td>
							<td><span class="<?= ($value->ket == "beli") ? "status--process" : "status--denied" ?>"><?= $value->ket ?></span></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-success pembelian-gudang" data-transaksi='<?= json_encode($value) ?>'><i class="fa fa-plus"></i> Ubah</button>
								<button type="button" class="btn btn-danger hapus-transaksi-gudang" data-transaksi='<?= json_encode($value) ?>'><i class="fa fa-minus"></i> Hapus</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection

@section("modal")

<!-- modal medium -->
<div class="modal fade" id="modal-pembelian" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-pembelian-gudang">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Pembelian  (Gudang : <?= $data->id_persediaan ?>)</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<input type="hidden" name="id_persediaan" value="<?= $data->id_persediaan ?>"/>
					<div class="col-5">
						<div class="form-group">
							<label>Supplier </label>
							<select class="form-control" name="id_suppliers">
								<?php foreach ($supplier as $value) { ?>
									<option value="<?= $value->id_supplier ?>"><?= $value->nama ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-5">
						<div class="form-group">
							<label>Bibit </label>
							<select class="form-control" name="id_pemasukan_ayam">
								<?php foreach ($bibit as $value) { ?>
									<option value="<?= $value->id_pembelian_terbaru ?>"><?= $value->nama_kandang . " (" . $value->id_pembelian_terbaru . ")" ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-5">
						<div class="form-group">
							<label>Tanggal Pembelian </label>
							<input type="text" class="form-control tanggal_transaksi" name="tanggal_transaksi">
						</div>
					</div>
					<div class="col-3">
						<div class="form-group">
							<label>Jumlah Gudang</label>
							<input type="number" class="form-control" name="jumlah" value="1">
						</div>
					</div>
					<div class="col-3">
						<div class="form-group">
							<label>Nominal</label>
							<input type="number" class="form-control" name="nominal" value="1">
						</div>
					</div>

					<div class="col-12">
						<p class="text-danger">
							Catatan : Penambahan pembelian akan mengubah tanggal jadwal vaksin mengikuti tanggal terbaru pada data pembelian Gudang
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- end modal medium -->

<!-- modal medium -->
<div class="modal fade" id="modal-pengeluaran" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-pengeluaran-gudang">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Pengeluaran Gudang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<input type="hidden" name="id_persediaan" value="<?= $data->id_persediaan ?>"/>

					<div class="col-7">
						<div class="form-group">
							<label>Tanggal Transaksi</label>
							<input type="text" class="form-control tanggal_transaksi" name="tanggal_transaksi" >
						</div>
					</div>

					<div class="col-5">
						<div class="form-group">
							<label>Bibit </label>
							<select class="form-control" name="id_pemasukan_ayam">
								<?php foreach ($bibit as $value) { ?>
									<option value="<?= $value->id_pembelian_terbaru ?>"><?= $value->nama_kandang . " (" . $value->id_pembelian_terbaru . ")" ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-5">
						<div class="form-group">
							<label>Jumlah</label>
							<input type="number" class="form-control" name="jumlah">
						</div>
					</div>

					<div class="col-5">
						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" class="form-control" name="keterangan">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit-pengeluaran">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- end modal medium -->

<!-- modal medium -->
<div class="modal fade" id="modal-kerugian" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-kerugian-gudang">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Kerugian Gudang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<input type="hidden" name="id_persediaan"/>

					<div class="col-12">
						<div class="form-group">
							<label>Tanggal</label>
							<input type="text" class="form-control tanggal_transaksi" name="tanggal" >
						</div>
					</div>

					<div class="col-12">
						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" class="form-control" name="keterangan" placeholder="Keterangan tentang kejadian">
						</div>
					</div>

					<div class="col-12">
						<div class="form-group">
							<label>Jumlah Gudang</label>
							<input type="number" class="form-control" name="jumlah" placeholder="Jumlah gudang yang berkurang">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submit-kerugian">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- end modal medium -->

<div class="modal" id="modal-hapus-transaksi-gudang">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Pembelian Gudang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					Anda yakin menghapus data transaksi <span class="id"></span> ?
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="del">Ya</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('js')


<script>
	$(document).on("click", ".btn-add-kerugian-gudang", function () {
		var modalKerugian = $('#modal-kerugian');

		modalKerugian.find("input[name='tanggal']").val(new Date().toJSON().slice(0, 19));
		modalKerugian.find("input[name='keterangan']").val("");
		modalKerugian.find("input[name='jumlah']").val(1);
		modalKerugian.find("button[type='submit']").attr('name', 'submit-kerugian');

		modalKerugian.modal('show');
	});

	$(document).on("click", ".btn-add-pengeluaran-gudang", function () {
		var modalPengeluaran = $('#modal-pengeluaran');

		modalPengeluaran.find("input[name='id']").val("");
		modalPengeluaran.find("input[name='tanggal_transaksi']").val(new Date().toJSON().slice(0, 19));
		modalPengeluaran.find("input[name='jumlah']").val("1");
		modalPengeluaran.find("input[name='keterangan']").val("");
		modalPengeluaran.find("button[type='submit']").attr('name', 'submit-pengeluaran');

		modalPengeluaran.modal("show");
	});

	$(document).on("click", ".btn-add-pembelian-gudang", function () {
		var modalPembelian = $('#modal-pembelian');

		modalPembelian.find("input[name='id']").val("");
		modalPembelian.find("input[name='tanggal_transaksi']").val(new Date().toJSON().slice(0, 19));
		modalPembelian.find("select[name='supplier']").val("");
		modalPembelian.find("input[name='nominal']").val("1");
		modalPembelian.find("input[name='jumlah']").val("1");
		modalPembelian.find("button[type='submit']").attr('name', 'submit');

		modalPembelian.modal('show');
	});

	$(document).on("click", ".pembelian-gudang", function () {
		var data = $(this).data('transaksi');

		switch (data.ket) {
			case "rugi":
				var modalKerugian = $('#modal-kerugian');

				modalKerugian.find("input[name='id']").val(data.id);
				modalKerugian.find("input[name='tanggal']").val(data.tanggal_transaksi);
				modalKerugian.find("input[name='keterangan']").val(data.keterangan);
				modalKerugian.find("input[name='jumlah']").val(data.jumlah_gudang);

				modalKerugian.modal('show');
				break;
			case "jual":
				var modalPengeluaran = $('#modal-pengeluaran');

				modalPengeluaran.find("input[name='id']").val(data.id);
				modalPengeluaran.find("select[name='id_kandang']").val(data.id_kandang);
				modalPengeluaran.find("input[name='tanggal_transaksi']").val(data.tanggal_transaksi);
				modalPengeluaran.find("input[name='jumlah']").val(data.jumlah);
				modalPengeluaran.find("input[name='keterangan']").val(data.keterangan);

				modalPengeluaran.modal("show");
				break;
			case "beli":
				var modalPembelian = $('#modal-pembelian');

				modalPembelian.find("input[name='id']").val(data.id);
				modalPembelian.find("input[name='tanggal_transaksi']").val(data.tanggal_transaksi);
				modalPembelian.find("input[name='jumlah']").val(data.jumlah);
				modalPembelian.find("input[name='nominal']").val(data.nominal);

				modalPembelian.modal('show');
				break;
		}
	});

	$(document).on("click", '.hapus-transaksi-gudang', function () {
		var data = $(this).data('transaksi');

		var modal = $("#modal-hapus-transaksi-gudang");

		modal.find("input[name='id']").val(data.id);
		modal.find("span[class='id']").html(data.id);
		modal.find("button[type='submit']").attr('name', 'del-' + data.ket);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-pembelian-gudang").validate({
			rules: {
				supplier: {
					required: true
				},
				umur: {
					required: true,
					number: true,
					min: 0
				},
				jumlah: {
					required: true,
					number: true,
					min: 1
				}
			},
			messages: {
				supplier: {
					required: "Supplier tidak boleh kosong"
				},
				umur: {
					required: "Umur tidak boleh kosong",
					number: "Umur harus berupa angka",
					min: "Minimal angka yang diinputkan andalah 0"
				},
				jumlah: {
					required: "Jumlah tidak boleh kosong",
					number: "Jumlah harus berupa angka",
					min: "Jumlah minimal 1"
				}
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				error.addClass("help-block");

				if (element.prop("type") == "checkbox") {
					error.insertAfter(element.parent("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).parent(".form-group").addClass("has-warning").removeClass("has-success");
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).parent(".form-group").addClass("has-success").removeClass("has-warning");
				$(element).addClass("is-valid").removeClass("is-invalid");
			}
		});
	});
</script>
@endsection