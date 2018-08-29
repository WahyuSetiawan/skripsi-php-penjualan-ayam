@extends("_part.layout",  $head)

@section("content")

<div class="row">
	<h3 class="title-5 m-b-25">Jumlah Persedian Gudang</h3>

	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">

			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Type Persediaan</th>
						<th>Nama</th>
						<th>Keterangan</th>
						<th>Jumlah</th>
						<th style="text-align: center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($gudang as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->ket_type_gudang ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->keterangan ?></td>
							<td><?= $value->jumlah ?> Unit</td>
							<td style="text-align: center">
								<button type="button" class="btn btn-success pembelian-gudang" data-vaksin='<?= json_encode($value) ?>'><i class="fa fa-plus"></i> Transaksi</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection

@section('js')
<script>
	$(document).on("click", ".btn-add-supplier", function () {
		var modalPembelian = $('#modal-pembelian');

		modalPembelian.find('form').find("input[name='id']").val("");
		modalPembelian.find('form').find("input[name='nama']").val("");
		modalPembelian.find('form').find("textarea[name='alamat']").html("");
		modalPembelian.find('form').find("input[name='telepon']").val("");
		modalPembelian.find('form').find("button[name='submit']").attr('name', 'submit');

		modalPembelian.modal('show');
	});

	$(document).on("click", ".pembelian-gudang", function () {
		var val = $(this).data("vaksin");

		document.location.href = "gudang/transaksi/" + val.id;
	});

	$(document).on("click", '.penjualan-gudang', function () {
		var val = $(this).data("vaksin");

		document.location.href = "gudang/transaksi/" + val.id;
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