@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Karyawan</h3>

	<div class="col-lg-12  m-b-25">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-karyawan" type="button">
			<i class="zmdi zmdi-plus"></i>Tambah Karyawan</button>
	</div>

	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Nama</th>
						<th>No Telepon</th>
						<th>Tng jawab. Kandang</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($karyawan as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->username ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->no_hp ?></td>
							<td><?= $value->kandang->nama ?></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-primary edit-karyawan" data-karyawan='<?= json_encode($value) ?>'><i class="fa fa-pen-square"></i></button>
								<button type="button" class="btn btn-danger del-karyawan" data-karyawan='<?= json_encode($value) ?>'><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modelKaryawan" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-karyawan">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Tambah Karyawan</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<div class="col-8">
						<div class="form-group">
							<label>Nama Karyawan</label>
							<input type="text" class="form-control" name="nama">
						</div>
					</div>
					<div class="col-7">
						<div class="form-group">
							<label>No Telepon Karyawan</label>
							<input type="text" class="form-control" name="telepon">
						</div>
					</div>
					<div class="col-8">
						<div class="form-group">
							<label>Tanggung jawab terhadap kandang :</label>
							<select class="form-control" name="kandang">
								<?php foreach ($kandang as $value) { ?>
									<option value="<?= $value->id ?>"><?= $value->nama ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-7">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username">
						</div>
					</div>
					<div class="col-7">
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control" name="password">
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

<div class="modal" id="modal-del-karyawan">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Hapus Karyawan</h3>
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
	$(document).on("click", ".btn-add-karyawan", function () {
		var modelKaryawan = $('#modelKaryawan');

		modelKaryawan.find("input[name='id']").val("");
		modelKaryawan.find("input[name='nama']").val("");
		modelKaryawan.find("textarea[name='alamat']").html("");
		modelKaryawan.find("input[name='telepon']").val("");
		modelKaryawan.find("input[name='password']").val("");
		modelKaryawan.find("input[name='password']").rules("add", {
			required: true
		});
		modelKaryawan.find("button[name='submit']").attr('name', 'submit');

		modelKaryawan.modal('show');
	});

	$(document).on("click", ".edit-karyawan", function () {
		var data = $(this).data('karyawan');

		var modelKaryawan = $('#modelKaryawan');

		modelKaryawan.find("input[name='id']").val(data.id);
		modelKaryawan.find("input[name='nama']").val(data.nama);
		modelKaryawan.find("input[name='telepon']").val(data.no_hp);
		modelKaryawan.find("input[name='username']").val(data.username);
		modelKaryawan.find("select[name='kandang']").val(data.id_kandang);
		modelKaryawan.find("input[name='password']").val("");
		modelKaryawan.find("input[name='password']").rules("remove", "required");
		modelKaryawan.find("button[name='submit']").attr('name', 'put');

		modelKaryawan.modal('show');
	});

	$(document).on("click", '.del-karyawan', function () {
		var data = $(this).data('karyawan');

		var modal = $("#modal-del-karyawan");

		modal.find("input[name='id']").val(data.id);
		modal.find("span[class='id']").html(data.id);
		modal.find("span[class='nama']").html(data.nama);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-karyawan").validate({
			rules: {
				nama: {
					required: true
				},
				gaji: {
					number: true
				},
				username: {
					required: true
				},
				password: {
					minlength: 5
				}
			},
			messages: {
				nama: {
					required: "Nama tidak boleh kosong"
				},
				gaji: {
					number: "Harus diisi berupa angka"
				},
				username: {
					required: "Username harus diisi"
				},
				password: {
					required: "Password harus diisi",
					minlength: "Password tidak boleh kurang dari 5"
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