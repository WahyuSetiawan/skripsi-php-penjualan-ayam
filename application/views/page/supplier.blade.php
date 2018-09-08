@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Supplier</h3>

	<div class="col-lg-12  m-b-25">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-supplier" type="button">
			<i class="zmdi zmdi-plus"></i>Tambah Supplier</button>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Supplier</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>No Telepon</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($supplier as $key => $value) { ?>
						<tr>
							<td><?= ($per_page * $page) + $key + 1 ?></td>
							<td><?= $value->id_supplier?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->alamat ?></td>
							<td><?= $value->notelepon ?></td>
							<td style="text-align: center">
								<button type="button" class="btn btn-primary edit-supplier" data-supplier='<?= json_encode($value) ?>'><i class="fa fa-pen-square"></i></button>
								<button type="button" class="btn btn-danger del-supplier" data-supplier='<?= json_encode($value) ?>'><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modalSupplier" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="" method="post" id="form-supplier">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Tambah Supplier</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					<div class="col-8">
						<div class="form-group">
							<label>Nama Supplier</label>
							<input type="text" class="form-control" name="nama">
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Alamat Supplier</label>
							<textarea class="form-control" name="alamat"></textarea>
						</div>
					</div>
					<div class="col-7">
						<div class="form-group">
							<label>No Telepon Supplier</label>
							<input type="text" class="form-control" name="telepon">
						</div>
					</div>
					<div class="col-7">
						<div class="form-group">
							<label>Jenis Supplier</label><br>
							<?php foreach ($jenis_supplier as $value) { ?>
								<input type="checkbox" name="jenis_supplier[]" value="<?= $value->id_type_gudang ?>">  <?= $value->keterangan ?>
							<?php } ?>
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
					<input type="hidden" name="id" class="id">
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
	$(document).on("click", ".btn-add-supplier", function () {
		var modalSupplier = $('#modalSupplier');

		modalSupplier.find("input[name='id']").val("");
		modalSupplier.find("input[name='nama']").val("");
		modalSupplier.find("textarea[name='alamat']").html("");
		modalSupplier.find("input[name='telepon']").val("");
		modalSupplier.find("button[name='submit']").attr('name', 'submit');
		modalSupplier.find('input[name="jenis_supplier[]"]').prop("checked", false);

		modalSupplier.modal('show');
	});

	$(document).on("click", ".edit-supplier", function () {
		var data = $(this).data('supplier');

		var modalSupplier = $('#modalSupplier');

		modalSupplier.find("input[name='id']").val(data.id_supplier);
		modalSupplier.find("input[name='nama']").val(data.nama);
		modalSupplier.find("textarea[name='alamat']").html(data.alamat);
		modalSupplier.find("input[name='telepon']").val(data.notelepon);
		modalSupplier.find("button[name='submit']").attr('name', 'put');

		modalSupplier.find('input[name="jenis_supplier[]"]').prop("checked", false);

		$.each(data.jenis, function (i, value) {
			modalSupplier.find('input[name="jenis_supplier[]"][value="' + value.id_jenis + '"]').prop("checked", true);
		});

		modalSupplier.modal('show');
	});

	$(document).on("click", '.del-supplier', function () {
		var data = $(this).data('supplier');

		var modal = $("#modal-del-supplier");

		modal.find(".id").val(data.id_supplier);
		modal.find("span[class='id']").html(data.id_supplier);
		modal.find("span[class='nama']").html(data.nama);

		modal.modal("show");
	});

	$(document).ready(function () {
		$("#form-supplier").validate({
			rules: {
				nama: {
					required: true
				}
			},
			messages: {
				nama: {
					required: "Nama tidak boleh kosong"
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