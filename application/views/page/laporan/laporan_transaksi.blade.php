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
				<th>Nama Supplier</th>
				<th>Keterangan</th>
				<th>Ket</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($jumlah_ayam as $key => $value) { ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td><?= $value->nama_kandang ?></td>
					<td><?= $value->jumlah_ayam ?></td>
					<td><?= $value->nama_supplier ?></td>
					<td><?= $value->keterangan ?></td>
					<td><span class="<?= ($value->ket == "beli") ? "status--process" : "status--denied" ?>"><?= $value->ket ?></span></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
@endsection