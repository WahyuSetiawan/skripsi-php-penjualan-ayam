@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Kandang</h3>

	<div class="col-lg-12  m-b-25">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-kandang" type="button">
			<i class="zmdi zmdi-plus"></i>Tambah Kandang</button>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Maksimal Ayam</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($kandang as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->maksimal_jumlah ?></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-primary edit-kandang" data-supplier='<?= json_encode($value) ?>'><i class="fa fa-pen-square"></i></button>
								<button type="button" class="btn btn-danger del-kandang" data-supplier='<?= json_encode($value) ?>'><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modalKandang" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-kandang">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Tambah Kandang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<div class="col-8">
						<div class="form-group">
							<label>Nama Kandang</label>
							<input type="text" class="form-control" name="nama">
						</div>
					</div>
					<div class="col-3">
						<div class="form-group">
							<label>Maksimal Jumlah</label>
							<input type="text" class="form-control" name="maksimal_jumlah">
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

<div class="modal" id="modal-del-supplier">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Hapus Supplier</h3>
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
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/additional-methods.min.js') ?>"></script>

<script>
	$(document).on("click", ".btn-add-kandang", function () {
		var modal = $('#modalKandang');

		modal.find('form').find("input[name='id']").val("");
		modal.find('form').find("input[name='nama']").val("");
		modal.find('form').find("input[name='tanggal']").val("");
		modal.find('form').find("input[name='maksimal_jumlah']").val("");
		modal.find('form').find("button[name='submit']").attr('name', 'submit');

		modal.modal('show');
	});

	$(document).on("click", ".edit-kandang", function () {
		var data = $(this).data('supplier');
		var modal = $('#modalKandang');

		modal.find('form').find("input[name='id']").val(data.id);
		modal.find('form').find("input[name='nama']").val(data.nama);
		modal.find('form').find("input[name='tanggal']").val(data.tanggal);
		modal.find('form').find("input[name='maksimal_jumlah']").val(data.maksimal_jumlah);
		modal.find('form').find("button[name='submit']").attr('name', 'put');

		modal.modal('show');
	});

	$(document).on("click", '.del-kandang', function () {
		var data = $(this).data('supplier');

		var modal = $("#modal-del-supplier");

		modal.find('form').find("input[name='id']").val(data.id);
		modal.find('form').find("span[class='id']").html(data.id);
		modal.find('form').find("span[class='nama']").html(data.nama);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-kandang").validate({
			rules: {
				nama: {
					required: true,
					minlength: 1
				},
				maksimal_jumlah: {
					number: true,
					min: 1,
				}
			},
			messages: {
				nama: {
					required: "Nama tidak boleh kosong",
					minlength: "Minimal karakter adalah 1"
				},
				maksimal_jumlah: {
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