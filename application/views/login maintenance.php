<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Website Maintenance</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

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
			.login-layout {
				background: #000000;
			}
		</style>

	</head>

	<body class="login-layout" style="background-image: url(<?php echo base_url();?>/marketing.jpg);background-size: cover;">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div style="margin-top:60px;" class="login-container">
							<div class="center">
								<h1>
									<span style="color:#FFF;" id="id-text2"><span class="red"><b>GGL-SalesTrax</b></span></span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" style="border-radius: 25px;">
									<div class="widget-body" style="border-radius: 25px;">
										<div class="widget-main" style="border-radius: 25px;">
											<!--<h4 class="header white lighter bigger">-->
											<!--	<i class="ace-icon fa fa-coffee white"></i>-->
											<!--		Silahkan Login-->
											<!--</h4>-->

											<div class="space-6"></div>

											<form action="<?php echo base_url(); ?>login/cobaLogin" method="post">
												<fieldset>
												    <h4>Halaman web sedang dalam perbaikan, kami akan segera kembali..</h4>
												    <img style="width:320px" src="<?php echo base_url();?>/maintenance.gif">
												<center>    IT Support Great Giant Livestock, 11014, 11092, 11018, 082186838585</center>
													<!--<label class="block clearfix">-->
													<!--	<span class="block input-icon input-icon-right">-->
													<!--		<input type="text" class="form-control" name="username" placeholder="Username" />-->
													<!--		<i class="ace-icon fa fa-user"></i>-->
													<!--	</span>-->
													<!--</label>-->

													<!--<label class="block clearfix">-->
													<!--	<span class="block input-icon input-icon-right">-->
													<!--		<input type="password" class="form-control" name="password" placeholder="Password" />-->
													<!--		<i class="ace-icon fa fa-lock"></i>-->
													<!--	</span>-->
													<!--</label>-->

													<div class="space"></div>

													<!--<div class="clearfix">-->
														

													<!--	<button class="width-35 pull-right btn btn-sm btn-primary" style="border-radius: 12px;margin-bottom:5px;">-->
													<!--		<i class="ace-icon fa fa-key"></i>-->
													<!--		<span class="bigger-110">Login</span>-->
													<!--	</button>-->
													<!--</div>-->


<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>

													<div class="space-4"></div>
												</fieldset>
											</form>

											

											<div class="space-6"></div>

											
										</div><!-- /.widget-main -->

									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

			
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>asset/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='asset/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo base_url();?>asset/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="<?php echo base_url();?>asset/js/ace-elements.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
		</script>
	</body>
</html>
