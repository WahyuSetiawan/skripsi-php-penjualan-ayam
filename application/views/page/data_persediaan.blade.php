@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Persediaan</h3>

	<div class="col-lg-12  m-b-25">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-vaksin" type="button">
			<i class="zmdi zmdi-plus"></i>Tambah Persediaan</button>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Keterangan</th>
						<th>Cara Pemakaian</th>
						<th>Durasi</th>
						<th>Waktu</th>
						<th>Type</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($vaksin as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->keterangan ?></td>
							<td><?= $value->cara_pemakaian ?></td>
							<td><?= $value->type_durasi ?></td>
							<td><?= $value->durasi ?></td>
							<td><?php
							switch ($value->type){
								case "event-important":
									echo "Merah";
									break;
								case "event-warning":
									echo "Kuning";
									break;
								case "event-info":
									echo "Biru";
									break;
								case "event-inverse":
									echo "Hitam";
									break;
								case "event-special":
									echo "Ungu";
									break;
							}
							
							?></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-primary edit-vaksin" data-vaksin='<?= json_encode($value) ?>'><i class="fa fa-pen-square"></i></button>
								<button type="button" class="btn btn-danger del-vaksin" data-vaksin='<?= json_encode($value) ?>'><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col">
				<?= $pagination ?>
			</div>
		</div>
	</div>
</div>

@endsection

@section("modal")

<!-- modal medium -->
<div class="modal fade" id="modalPersediaan" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-vaksin">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Tambah Persediaan</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<div class="col-8">
						<div class="form-group">
							<label>Nama Persediaan</label>
							<input type="text" class="form-control" name="nama">
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Keterangan</label>
							<input type="input" class="form-control" name="keterangan">
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Cara Pemakaian</label>
							<textarea class="form-control" name="cara_pemakaian"></textarea>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Tipe Durasi</label>
							<select name="type_durasi" class="form-control">
								<option value="MONTHLY">Bulan</option>
								<option value="WEEKLY">Minggu</option>
								<option value="DAILY">Hari</option>
							</select>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Tipe Durasi</label>
							<select name="type" class="form-control">
								<option value="event-important">Merah</option>
								<option value="event-warning">Kuning</option>
								<option value="event-info">Biru</option>
								<option value="event-inverse">Hitam</option>
								<option value="event-special">Ungu</option>
							</select>
						</div>
					</div>

					<div class="col-3">
						<div class="form-group">
							<label>Maksimal Jumlah</label>
							<input type="text" class="form-control" name="durasi" placeholder="Durasi pemakaian vaksin pada ayam">
						</div>
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

<div class="modal" id="modal-del-vaksin">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Hapus Persediaan</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					Anda yakin menghapus data <span class="id"></span> dengan nama <span class="nama"></span> ?
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
	$(document).on("click", ".btn-add-vaksin", function () {
		var modal = $('#modalPersediaan');

		modal.find('form').find("input[name='id']").val("");
		modal.find('form').find("input[name='nama']").val("");
		modal.find('form').find("input[name='tanggal']").val("");
		modal.find('form').find("input[name='maksimal_jumlah']").val("");
		modal.find('form').find("button[name='submit']").attr('name', 'submit');

		modal.modal('show');
	});

	$(document).on("click", ".edit-vaksin", function () {
		var data = $(this).data('vaksin');
		var modal = $('#modalPersediaan');

		modal.find("input[name='id']").val(data.id);
		modal.find("input[name='nama']").val(data.nama);
		modal.find("input[name='keterangan']").val(data.keterangan);
		modal.find("textarea[name='cara_pemakaian']").html(data.cara_pemakaian);
		modal.find("select[name='type_durasi']").val(data.type_durasi);
		modal.find("select[name='type']").val(data.type);
		modal.find("input[name='durasi']").val(data.durasi);
		modal.find("button[name='submit']").attr('name', 'put');

		modal.modal('show');
	});

	$(document).on("click", '.del-vaksin', function () {
		var data = $(this).data('vaksin');

		var modal = $("#modal-del-vaksin");

		modal.find('form').find("input[name='id']").val(data.id);
		modal.find('form').find("span[class='id']").html(data.id);
		modal.find('form').find("span[class='nama']").html(data.nama);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-vaksin").validate({
			rules: {
				nama: {
					required: true,
					minlength: 1
				},
				keterangan: {
					maxlength: 100
				},
				durasi: {
					required: true,
					number: true,
					min: 1,
				}
			},
			messages: {
				nama: {
					required: "Nama tidak boleh kosong",
					minlength: "Minimal karakter adalah 1"
				},
				keterangan: {
					maxlength: "Maksimal keterangan 100 karakter"
				},
				durasi: {
					required: "Durasi tidak boleh kosong",
					number: "Harus Berupa Angka",
					min: "Minimal jumlah yang dinputkan adalah 1"
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