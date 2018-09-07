@extends("_part.layout",  $head)


@section("content")


<div class="row">
	<h3 class="title-5 m-b-25"><?php echo $title?></h3>

	<div class="col-lg-12  m-b-25">
		<a href="<?php echo base_url("laporan/karyawan/null/print") ?>" class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-vaksin" type="button">
			<i class="zmdi zmdi-plus"></i>Print Data Karyawan</a>
	</div>
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-25">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>No Telepon</th>
						<th>Tanggung Jawab Kandang</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($karyawan as $key => $value) { ?>
						<tr>
							<td><?= $key + 1 ?></td>
							<td><?= $value->nama ?></td>
							<td><?= $value->no_hp ?></td>
							<td><?= $value->kandang->nama ?></td>
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