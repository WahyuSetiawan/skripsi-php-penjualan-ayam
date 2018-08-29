
<div>
	<div class="row">
		<div class="col-md-12">
			<div class="overview-wrap">
				<h2 class="title-1">overview Sistem Informasi Manajemen Peternakan Ayam Barokah</h2>
			</div>
		</div>
	</div>
	<div class="row m-t-25">
		<div class="col-sm-6 col-lg-3">
			<div class="overview-item overview-item--c1">
				<div class="overview__inner">
					<div class="overview-box clearfix">
						<div class="icon">
							<i class="zmdi zmdi-shopping-o"></i>
						</div>
						<div class="text">
							<h2 id="bar1">0</h2>
							<span>Jumlah Pembelian Ayam</span>
						</div>
					</div>
					<div class="overview-chart">
						<canvas id="widgetChart1"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="overview-item overview-item--c2">
				<div class="overview__inner">
					<div class="overview-box clearfix">
						<div class="icon">
							<i class="zmdi zmdi-tags"></i>
						</div>
						<div class="text">
							<h2 id="bar2">0</h2>
							<span>Jumlah Ayam Terjual</span>
						</div>
					</div>
					<div class="overview-chart">
						<canvas id="widgetChart2"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="overview-item overview-item--c3">
				<div class="overview__inner">
					<div class="overview-box clearfix">
						<div class="icon">
							<i class="zmdi zmdi-calendar-note"></i>
						</div>
						<div class="text">
							<h2 id="bar3">0</h2>
							<span>Kerugian Ayam</span>
						</div>
					</div>
					<div class="overview-chart">
						<canvas id="widgetChart3"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="overview-item overview-item--c4">
				<div class="overview__inner">
					<div class="overview-box clearfix">
						<div class="icon">
							<i class="zmdi zmdi-money"></i>
						</div>
						<div class="text">
							<h2 id="bar4">Rp. 0</h2>
							<span>Total Penjualan</span>
						</div>
					</div>
					<div class="overview-chart">
						<canvas id="widgetChart4"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="au-card recent-report">
				<div class="au-card-inner">
					<h3 class="title-2">Diagram Tahun</h3>
					<div class="chart-info">
						<div class="chart-info__left">
							<div class="chart-note">
								<span class="dot dot--blue"></span>
								<span>Penjualan</span>
							</div>
							<div class="chart-note mr-0">
								<span class="dot dot--green"></span>
								<span>Pembelian</span>
							</div>
						</div>
						<div class="chart-info__right" style="display: none">
							<div class="chart-statis">
								<span class="index incre">
									<i class="zmdi zmdi-long-arrow-up"></i>25%</span>
								<span class="label">products</span>
							</div>
							<div class="chart-statis mr-0">
								<span class="index decre">
									<i class="zmdi zmdi-long-arrow-down"></i>10%</span>
								<span class="label">services</span>
							</div>
						</div>
					</div>
					<div class="recent-report__chart">
						<canvas id="recent-rep-chart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="au-card chart-percent-card">
				<div class="au-card-inner">
					<h3 class="title-2 tm-b-5">Perbandingan Jumlah Sekarang</h3>
					<div class="row no-gutters">
						<div class="col-xl-6">
							<div class="chart-note-wrap">
								<div class="chart-note mr-0 d-block">
									<span class="dot dot--blue"></span>
									<span>Penjualan</span>
								</div>
								<div class="chart-note mr-0 d-block">
									<span class="dot dot--green"></span>
									<span>Pembelian</span>
								</div>
								<div class="chart-note mr-0 d-block">
									<span class="dot dot--red"></span>
									<span>Kerugian</span>
								</div>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="percent-chart">
								<canvas id="percent-chart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2 class="title-1 m-b-25">Riwayat Transaksi Terakhir</h2>
			<div class="table-responsive table--no-card m-b-40">
				<table class="table table-borderless table-striped table-earning">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Type</th>
							<th>Kandang</th>
							<th class="text-right">Nominal</th>
							<th class="text-right">Jumlah Ayam</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($transaksi as $value) { ?>
							<tr>
								<td><?= $value->tanggal_transaksi ?></td>
								<td>
									<?php
									switch ($value->ket) {
										case "beli":
											?>
											<span class="dot dot--green"></span>
											<?php
											break;
										case "jual":
											?>
											<span class="dot dot--blue"></span>
											<?php
											break;
										case "rugi":
											?>
											<span class="dot dot--red"></span>
											<?php
											break;
									}
									?>
									<?= $value->ket ?>
								</td>
								<td><?= $value->nama_kandang ?></td>
								<td class="text-right">Rp. <?= number_format($value->nominal, 2) ?></td>
								<td class="text-right"><?php
									switch ($value->ket) {
										case "beli":
											?>
											+
											<?php
											break;
										case "jual":
											?>
											-
											<?php
											break;
										case "rugi":
											?>
											-
											<?php
											break;
									}
									?><?= $value->jumlah_ayam ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
