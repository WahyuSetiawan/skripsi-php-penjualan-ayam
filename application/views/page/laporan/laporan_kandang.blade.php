@extends("_part.layoutLaporan")

@section('title',  $title)

@section("content")
<div id="outtable">
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kandang as $key => $value) { ?>
				<tr>
					<td style="width: 5%"><?= $key + 1 ?></td>
					<td><?= $value->nama ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
@endsection