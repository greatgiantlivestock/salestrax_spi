<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login Page</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace-fonts.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>asset/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
		<script src="<?php echo base_url();?>asset/js/ace-extra.js"></script>
		<style>
			.login-layout {
				background: #000000;
			}
		</style>
	</head>

	<body class="login-layout" style="background-image: url(<?php echo base_url();?>/spi_walpp.JPG);background-size: cover;">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div style="margin-top:100px;" class="login-container">
							<div class="center">
								<h1>
									<span style="color:#FFF;" id="id-text2"><span class="blue"><b>SPI </b></span><span class="red"><b>SalesTrax</b></span></span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" style="border-radius: 25px;background:rgba(0,0,0,0.2);">
									<div class="widget-body" style="border-radius: 25px;background:rgba(0,0,0,0.2);">
										<div class="widget-main" style="border-radius: 25px;background:rgba(0,0,0,0.2);">
											<h4 class="header white lighter bigger">
												<i class="ace-icon fa fa-coffee white"></i>
													Silahkan Login
											</h4>

											<div class="space-6"></div>

											<form action="<?php echo base_url(); ?>login/cobaLogin" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="username" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<div class="space"></div>
													<div class="clearfix">
														<button class="width-35 pull-right btn btn-sm btn-primary" style="border-radius: 12px;margin-bottom:5px;">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>
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
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo base_url();?>asset/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>asset/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace-elements.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace.js"></script>
		<!--<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
		</script>
		-->
		<!--<script type="text/javascript"> var infolinks_pid = 3262395; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>-->
	</body>
</html>
