<!DOCTYPE html>
<html>
	<head>
		<title>Report Table</title>
		<style type="text/css">
			#outtable{
				border:1px solid #e3e3e3;
				width:100%;
			}

			.short{
				width: 50px;
			}

			.normal{
				width: 150px;
			}

			table{
				width: 100%;
				border-collapse: collapse;
				font-family: arial;
				color:#5E5B5C;
			}

			thead th{
				text-align: left;
				border-left: 1px solid #e3e3e3;
				padding: 10px;
			}

			tbody td{
				border-top: 1px solid #e3e3e3;
				border-left: 1px solid #e3e3e3;
				padding: 10px;
			}

			div.kop{
				width: 100%;
				text-align: center;
				margin-bottom: 20px
			}

			div.nama{
				width: 100%
			}

			div.kop .date{
				width: 100%;
				text-align: right
			}
		</style>
	</head>
	<body>

		<div class="kop">
			<div>
				<h2>@yield('title')</h2>	
			</div>
		</div>

		@yield("content")
	</body>
</html>