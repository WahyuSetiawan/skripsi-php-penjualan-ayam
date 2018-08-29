@extends("_part.layoutLaporan")

@section('title',  $title)

@section("content")
<div id="outtable">
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Tempat dan Tanggal</th>
				<th>Alamat</th>
				<th>No Telepon</th>
				<th>Gaji</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($karyawan as $key => $value) { ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td><?= $value->nama ?></td>
					<td><?= $value->tempat_lahir . ", " . $value->tanggal_lahir ?></td>
					<td><?= $value->alamat ?></td>
					<td><?= $value->no_hp ?></td>
					<td><?= $value->gaji ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
@endsection