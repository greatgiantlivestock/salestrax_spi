<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $judul; ?> | Sales Canvassing</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap-datetimepicker.css" />

		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/select2.css" />



		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<script src="<?php echo base_url();?>asset/js/date-time/moment-with-locales.min.js"></script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>asset/js/jquery.js'>"+"<"+"/script>");
		</script>


		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>asset/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>asset/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>asset/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url();?>asset/js/date-time/bootstrap-datetimepicker.min.js"></script>

				<script src="<?php echo base_url();?>asset/js/highcharts.js"></script>


		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>asset/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url();?>asset/js/html5shiv.js"></script>
		<script src="<?php echo base_url();?>asset/js/respond.js"></script>
		<![endif]-->


		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="asset/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<style>
			.table thead tr th, .table tbody tr td {
				padding: 3px 10px;
			}
			.carousel .item , .carousel .item img {
				width: 100%;
				height: 450px;
			}
			.tbl_input {
				width: 100%;
			}
			.tbl_input tr td {
				padding: 5px 0;
			}

			.tbl_detail {
				width: 100%;
			}
			.tbl_detail tr td {
				padding: 3px 0;
			}
			.tbl_detail tr th {
				background: #59ABE3;
				border: 1px solid #4183D7;
			}
			.tbl_detail tr td {
				background: #E4F1FE;
				border: 1px solid #4183D7;
			}

		
		
	

			.tbl_jual_detail {
				width:100%;
				table-layout: fixed;
				border: 1px solid #ccc;			
			}
			.tbl_jual_detail th,
			.tbl_jual_detail td {
				padding: 5px;
				text-align: left;
				min-width: 200px;
			}


			.tbl_jual_detail thead {
				background-color: #ECECEC;
			}
			.tbl_jual_detail thead tr {
				display: block;
				position: relative;
			}
			.tbl_jual_detail tbody {
				display: block;
				overflow: auto;
				width: 100%;
				height: 200px;
				overflow-y: scroll;
				overflow-x: hidden;
			}
			.tbl_jual_detail tfoot {
				display: block;
				width: 100%;
			}
			.tbl_jual_detail tfoot tr {
				display: block;
				position: relative;
			}


			.show-details-btn:hover {
				cursor: pointer;
			}
		</style>		

	</head>




	<body class="no-skin">

		<div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							Edit Rencana yang ada
						</small>
					</a>
				</div>
			</div>
		</div>