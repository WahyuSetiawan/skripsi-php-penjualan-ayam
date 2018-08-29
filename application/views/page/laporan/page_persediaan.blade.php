@extends("_part.layout",  $head)


@section("content")
<div class="row">
	<h3 class="title-5 m-b-25"><?php echo $title?></h3>

	<div class="col-lg-12  m-b-25">
		<a href="<?php echo base_url("laporan/vaksin/null/print") ?>" class="au-btn au-btn-icon au-btn--green au-btn--small btn-add-vaksin" type="button">
			<i class="zmdi zmdi-plus"></i>Print Data Persediaan</a>
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
							<td><?= $value->type ?></td>
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