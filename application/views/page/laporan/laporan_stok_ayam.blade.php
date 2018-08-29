@extends("_part.layoutLaporan")

@section('title',  $title)

@section("content")
<div id="outtable">
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Kandang</th>
				<th>Maksimal Ayam</th>
				<th>Jumlah Ayam</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kandang as $key => $value) { ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td><?= $value->nama_kandang ?></td>
					<td><?= $value->maksimal_jumlah ?></td>
					<td><?= $value->jumlah_ayam ?></td>
					<td><?= $value->keterangan ?></td>
				</tr>
			<?php } ?>

		</tbody>
	</table>
</div>
@endsection