@extends("_part.layoutLaporan")

@section('title',  $title)

@section("content")
<div id="outtable">
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Maksimal Ayam</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kandang as $key => $value) { ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td><?= $value->nama ?></td>
					<td><?= $value->maksimal_jumlah ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
@endsection