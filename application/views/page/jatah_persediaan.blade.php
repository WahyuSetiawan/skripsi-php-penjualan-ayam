@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Jatah Persediaan</h3>

	<div class="col-lg-12  m-b-25">
		<div class="card">
			<div class="card-header">
				Pilih Kandang
			</div>
			<div class="card-body">
				<form action="" method="get">
					<div class="form-group">
						<label>Kandang : </label>
						<select class="form-control" name="kandang">
							<?php foreach ($kandang as $value) { ?>
								<option value="<?php echo $value->id ?>" <?= ($id_kandang == $value->id) ? "selected" : "" ?> ><?php echo $value->nama ?></option>
							<?php } ?>
						</select>
					</div>
					<button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit">Pilih Kandang</button>
				</form>
			</div>
		</div>
	</div>

	<div class="col-lg-12  m-b-25">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-persediaan" type="button">
			<i class="zmdi zmdi-plus"></i>Tambah Persediaan</button>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Cara Pemakaian</th>
						<th>Durasi</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_persediaan as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->cara_pemakaian ?></td>
							<td><?= $value->durasi . " " . $value->type_durasi ?></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-primary edit-persediaan" data-persediaan='<?= json_encode($value) ?>'><i class="fa fa-pen-square"></i></button>
								<button type="button" class="btn btn-danger del-persediaan" data-persediaan='<?= json_encode($value) ?>'><i class="fa fa-trash"></i></button>
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
		<form action="" method="post" id="form-persediaan">
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
							<label>Persediaan</label>
							<select name="persediaan" class="form-control">
								<?php foreach ($persediaan as $key => $value) { ?> 
									<option value="<?= $value->id ?>" data-data='<?= json_encode($value) ?>'><?= $value->nama ?></option>
								<?php } ?>
							</select>
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
							<label>Tipe</label>
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
							<input type="text" class="form-control" name="durasi" placeholder="Durasi pemakaian persediaan pada ayam">
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

<div class="modal" id="modal-del-persediaan">
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

	$(document).on("click", "select[name='persediaan']", function () {
		var data = $(this).find(":selected").data("data");

		$("select[name='type_durasi']").val(data.type_durasi);
		$("select[name='type']").val(data.type);
		$("input[name='durasi']").val(data.durasi);
	});

	$(document).on("click", ".btn-add-persediaan", function () {
		var modal = $('#modalPersediaan');

		modal.find("input[name='id']").val("");
		modal.find("select[name='persediaan']").attr("disabled", false);
		//modal.find("button[name='submit']").attr('name', 'submit');

		modal.modal('show');
	});

	$(document).on("click", ".edit-persediaan", function () {
		var data = $(this).data('persediaan');
		var modal = $('#modalPersediaan');

		modal.find("input[name='id']").val(data.id);
		modal.find("input[name='durasi']").val(data.durasi);
		modal.find("select[name='type_durasi']").val(data.type_durasi);
		modal.find("select[name='type']").val(data.type);
		modal.find("select[name='persediaan']").val(data.id_persediaan);
		modal.find("select[name='persediaan']").attr("disabled", true);

		//modal.find("button[name='submit']").attr('name', 'put');

		modal.modal('show');
	});

	$(document).on("click", '.del-persediaan', function () {
		var data = $(this).data('persediaan');

		var modal = $("#modal-del-persediaan");

		modal.find('form').find("input[name='id']").val(data.id);
		modal.find('form').find("span[class='id']").html(data.id);
		modal.find('form').find("span[class='nama']").html(data.nama);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-persediaan").validate({
			rules: {
				durasi: {min: 1}
			},
			messages: {
				durasi: {min: "Untuk durasi tidak boleh diisi kurang dari angka 0"}
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