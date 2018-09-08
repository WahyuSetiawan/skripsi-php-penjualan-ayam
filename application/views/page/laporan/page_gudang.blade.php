@extends("_part.layout",  $head)


@section("content")

<?php
$CI = &get_instance();
?>
<div class="row">
	<h3 class="title-5 m-b-25"><?php echo $title ?></h3>

	<div class="col-lg-12  m-b-25">
		<div class="card card-info">
			<form method="get" action="">
				<div class="card-header">
					Pemilah Data
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Kandang : </label>
						<select class="form-control" name="id_kandang">
							<?php foreach ($kandang as $key => $value) { ?>
								<option value="<?= $value->id_kandang ?>" <?= (@$_GET['id_kandang'] == $value->id_kandang) ? "selected" : "" ?>><?= $value->nama ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">Tampilkan Data</button>
				</div>
			</form>
		</div> 
	</div>

	<div class="col-lg-12  m-b-25">
		<?php if ($CI->session->flashdata('kesalahan')) { ?>
			<div class="alert alert-danger"><?= $CI->session->flashdata('kesalahan') ?></div>
		<?php } ?>

		<a href="<?php echo base_url("laporan/gudang/null/print?" . $_SERVER['QUERY_STRING']) ?>" class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-vaksin" type="button">
			<i class="zmdi zmdi-plus"></i>Print Data Transaksi</a>	

	</div>


	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Masuk</th>
						<th>Keluar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($jumlah_ayam as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->id_kandang ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->masuk ?></td>
							<td><?= $value->keluar ?></td>
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