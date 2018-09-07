@extends("_part.layout",  $head)


@section("content")


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
								<option value="<?= $value->id ?>" <?= (@$_GET['id_kandang'] == $value->id) ? "selected" : "" ?>><?= $value->nama ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Ket : </label>
						<select class="form-control" name="ket">
							<option value="semua">Semua</option>
							<option value="pemasukan">Pemasukan</option>
							<option value="pengeluaran">Pengeluaran</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<select class="form-control" name="tahun">
							<?php foreach ($tahun_transaksi as $value) { ?>
								<option value="<?= $value->tahun ?>" <?= (@$_GET['tahun'] == $value->tahun) ? "selected" : "" ?>><?= $value->tahun ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Bulan</label>
						<select class="form-control" name="bulan">
							<option value="1" 	<?= (@$_GET['bulan'] == 1) ? "selected" : "" ?>>1</option>
							<option value="2"	<?= (@$_GET['bulan'] == 2) ? "selected" : "" ?>>2</option>
							<option value="3" 	<?= (@$_GET['bulan'] == 3) ? "selected" : "" ?>>3</option>
							<option value="4"	<?= (@$_GET['bulan'] == 4) ? "selected" : "" ?>>4</option>
							<option value="5"	<?= (@$_GET['bulan'] == 5) ? "selected" : "" ?>>5</option>
							<option value="6"	<?= (@$_GET['bulan'] == 6) ? "selected" : "" ?>>6</option>
							<option value="7" 	<?= (@$_GET['bulan'] == 7) ? "selected" : "" ?>>7</option>
							<option value="8"	<?= (@$_GET['bulan'] == 8) ? "selected" : "" ?>>8</option>
							<option value="9"	<?= (@$_GET['bulan'] == 9) ? "selected" : "" ?>>9</option>
							<option value="10"	<?= (@$_GET['bulan'] == 10) ? "selected" : "" ?>>10</option>
							<option value="11"	<?= (@$_GET['bulan'] == 11) ? "selected" : "" ?>>11</option>
							<option value="12"	<?= (@$_GET['bulan'] == 12) ? "selected" : "" ?>>12</option>
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
		<a href="<?php echo base_url("laporan/transaksi/null/print?" . $_SERVER['QUERY_STRING']) ?>" class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-vaksin" type="button">
			<i class="zmdi zmdi-plus"></i>Print Data Transaksi</a>
	</div>

	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Transaksi</th>
						<th>Nama</th>
						<th>Maksimal Ayam</th>
						<th>Ket</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($jumlah_ayam as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->tanggal_transaksi ?></td>
							<td><?= $value->nama_kandang ?></td>
							<td><?= $value->jumlah_ayam ?></td>
							<td><span class="<?= ($value->ket == "pemasukan") ? "status--process" : "status--denied" ?>"><?= $value->ket ?></span></td>
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