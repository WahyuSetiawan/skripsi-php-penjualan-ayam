@extends("_part.layoutLaporan")

@section('title',  $title)

@section("content")
<div id="outtable">
	<table>
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
</div>
@endsection