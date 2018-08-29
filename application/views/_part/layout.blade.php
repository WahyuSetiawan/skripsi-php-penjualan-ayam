<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="au theme template">
		<meta name="author" content="Hau Nguyen">
		<meta name="keywords" content="au theme template">
		<meta name="base_url_controller" content="<?= $current_location ?>">
		<meta name="base_url" content="<?= base_url() ?>">

		<!-- Title Page-->
		<title>Dashboard</title>

		<!-- Fontfaces CSS-->
		<link href="<?php echo base_url('asset/') ?>css/font-face.css" rel="stylesheet" media="all">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="<?php echo base_url('asset/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap CSS-->
		<link href="<?php echo base_url('asset/') ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Vendor CSS-->
		<link href="<?php echo base_url('asset/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/wow/animate.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/slick/slick.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
		<link href="<?php echo base_url('asset/') ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

		<!-- Main CSS-->
		<link href="<?php echo base_url('asset/') ?>css/theme.css" rel="stylesheet" media="all">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" /> 
		<?php /* <link rel="stylesheet" href="<?php echo base_url("css/bootstrap-datetimepicker.min.css") ?>" /> */ ?>

		@yield("css")

	</head>

	<body class="animsition">
		<div class="page-wrapper">
			<!-- HEADER MOBILE-->
			<header class="header-mobile d-block d-lg-none">
				<div class="header-mobile__bar">
					<div class="container-fluid">
						<div class="header-mobile-inner">
							<a class="" href="index.html">
								<h1>SIMPAB</h1>
							</a>
							<button class="hamburger hamburger--slider" type="button">
								<span class="hamburger-box">
									<span class="hamburger-inner"></span>
								</span>
							</button>
						</div>
					</div>
				</div>
				<nav class="navbar-mobile">
					<div class="container-fluid">
						<ul class="navbar-mobile__list list-unstyled">
							@include("_part.sidemenu")
						</ul>
					</div>
				</nav>
			</header>
			<!-- END HEADER MOBILE-->

			<!-- MENU SIDEBAR-->
			<aside class="menu-sidebar d-none d-lg-block">
				<div class="logo">
					<a class="" href="<?php echo base_url() ?>">
						<h1>SIMPAB</h1>
					</a>
				</div>
				<div class="menu-sidebar__content js-scrollbar1" >
					@include("_part.sidemenu")
				</div>
			</aside>
			<!-- END MENU SIDEBAR-->

			<!-- PAGE CONTAINER-->
			<div class="page-container">
				<!-- HEADER DESKTOP-->
				<header class="header-desktop">
					<div class="section__content section__content--p30">
						<div class="container-fluid">
							<div class="header-wrap"> 
								<form class="form-header" action="" method="POST">
								</form>
								<div class="header-button">
									<div class="noti-wrap" style="display: none">
										<div class="noti__item js-item-menu">
											<i class="zmdi zmdi-notifications"></i>
											<span class="quantity">3</span>
											<div class="notifi-dropdown js-dropdown">
												<div class="notifi__title" id="title_nitify">
													<p>You have <span class="quan">0</span> Notifications</p>
												</div>
												<div class="notifi__item" id="notifi_example" style="display: none">
													<div class="bg-c1 img-cir img-40">
														<i class="zmdi zmdi-email-open"></i>
													</div>
													<div class="content">
														<p>You got a email notification</p>
														<span class="date">April 12, 2018 06:50</span>
													</div>
												</div>
												<div class="notifi__footer">
													<a href="<?php echo base_url("jadwalvaksin") ?>">Semua Jadwal Vaksin</a>
												</div>
											</div>
										</div>
									</div>
									<div class="account-wrap">
										<div class="account-item clearfix js-item-menu">
											<div class="image">
												<img src="<?php echo base_url('asset/') ?>images/1486395884-account_80606.png" alt="<?php echo ($username->username) ?>" />
											</div>
											<div class="content">
												<a class="js-acc-btn" href="#"><?php echo ($username->username) ?></a>
											</div>
											<div class="account-dropdown js-dropdown">
												<div class="info clearfix">
													<div class="image">
														<a href="#">
															<img src="<?= base_url('asset/') ?>images/1486395884-account_80606.png" alt="John Doe" />
														</a>
													</div>
													<div class="content">
														<h5 class="name">
															<a href="#"><?= ($username->username) ?></a>
														</h5>
														<span class="email"><?= ucfirst($type) ?></span>
													</div>
												</div>
												<div class="account-dropdown__footer">
													<a href="javascript:void(0)" id="change_password">
														<i class="zmdi zmdi-lock"></i>Ubah Password</a>
												</div>
												<div class="account-dropdown__footer">
													<a href="<?= base_url("login/out") ?>">
														<i class="zmdi zmdi-power"></i>Logout</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>
				<!-- HEADER DESKTOP-->

				@yield("modal")

				<!-- MAIN CONTENT-->
				<div class="main-content">
					<div class="section__content section__content--p30">
						<div class="container-fluid">
							@yield('content')
							<div class="row">
								<div class="col-md-12">
									<div class="copyright">
										<p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END MAIN CONTENT-->
				<!-- END PAGE CONTAINER-->
			</div>


			<!-- modal medium -->
			<div class="modal fade" id="modelChangePassword" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<form action="<?= base_url() ?>" method="post" id="form-change-password">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="mediumModalLabel">Ubah Password</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="hidden" name="username" value="<?= $username->username; ?>">
								<input type="hidden" name="type" value="<?= $type; ?>">
								<div class="col-12">
									<div class="form-group">
										<label>Password Baru</label>
										<input type="text" class="form-control" name="password_baru" id="password_baru">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label>Ulangi Password</label>
										<input type="text" class="form-control" name="ulangi_password">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>
						</div>

					</form>
				</div>
			</div>
			<!-- end modal medium -->

		</div>

		<!-- Jquery JS-->
		<script src="<?php echo base_url('asset/') ?>vendor/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js" type="text/javascript"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script> 

		<?php /*
		  <script src="<?php echo base_url("js/moment.min.js") ?>" type="text/javascript"></script>
		  <script src="<?php echo base_url("js/bootstrap-datetimepicker.min.js") ?>" type="text/javascript"></script>
		 * */ ?>

		<!-- Bootstrap JS-->
		<script src="<?php echo base_url('asset/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
		<!-- Vendor JS       -->
		<script src="<?php echo base_url('asset/') ?>vendor/slick/slick.min.js">
		</script>
		<script src="<?php echo base_url('asset/') ?>vendor/wow/wow.min.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
		</script>
		<script src="<?php echo base_url('asset/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/counter-up/jquery.counterup.min.js">
		</script>
		<script src="<?php echo base_url('asset/') ?>vendor/circle-progress/circle-progress.min.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
		<script src="<?php echo base_url('asset/') ?>vendor/select2/select2.min.js"></script>	
		<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script> -->
		<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
		<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script> -->
		<script type="text/javascript" src="<?php echo base_url('js/additional-methods.min.js') ?>"></script>

		<!-- jquery validation -->
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script> 

		<!-- <script type="text/javascript" src="<?/=echo base_url('js/jquery.validate.min.js')     ?>"></script> -- >
		<!--<script type="text/javascript" src="<?php //echo base_url('js/additional-methods.min.js')    ?>"></script>-->

		<script>
			var base_url = $("meta[name='base_url']").attr('content');

			$("#change_password").click(function () {
				var modal = $("#modelChangePassword");
				modal.modal("show");
			});

			$("#form-change-password").validate({
				rules: {
					password_baru: {
						required: true,
						minlength: 5
					},
					ulangi_password: {
						required: true,
						equalTo: "#password_baru",
						minlength: 5
					},

				},
				messages: {
					password_baru: {
						required: "Password tidak boleh kosong",
						minlength: "Minimal karakter 5 "
					},
					ulangi_password: {
						required: "Password tidak boleh kosong",
						equalTo: "Password tidak sama",
						minlength: "Minimal karakter 5 "
					},
				},
				errorElement: "em",
				errorPlacement: function (error, element) {
					error.addClass("help-block");

					if (element.prop("type") == "checkbox") {
						error.insertAfter(element.parent("label"));
					} else {
						error.insertAfter(element);
					}
				},
				highlight: function (element, errorClass, validClass) {
					$(element).parent(".form-group").addClass("has-warning").removeClass("has-success");
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).parent(".form-group").addClass("has-success").removeClass("has-warning");
					$(element).addClass("is-valid").removeClass("is-invalid");
				}
			});
		</script>

		<!-- Main JS-->
		<script src="<?php echo base_url('asset/') ?>js/main.js"></script>

		<script>
			$(document).ready(function () {
				var a = "nav.navbar-sidebar li.has-sub a[href='" + $("meta[name='base_url_controller']").attr('content') + "']";

				$(a).parent("li").addClass("active")
						.parents("li.has-sub").addClass("active")
						.find('a.js-arrow').trigger("click");
				$("nav.navbar-sidebar a[href='" + $(location).attr('href') + "']").parent("li").addClass("active");
			});
		</script>

		@yield("js")
	</body>
</html>
<!-- end document-->
