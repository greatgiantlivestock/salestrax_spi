
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
<div class="span12">					    
	<div class="widget-box ">
		<div class="widget-header">
			<h5 class="bigger lighter">
				<i class="fa fa-key"> </i>
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>

 <?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 <?php } ?>
				<form class="form-horizontal"  action="<?php echo base_url(); ?>password/save" method="post"/>

					<div class="form-group">
						<label class="col-md-2"> Password Lama </label>

						<div class="col-md-4">
							<input  style="width:100%;" type="password" name="password_lama"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2"> Password Baru </label>

						<div class="col-md-4">
							<input  style="width:100%;" type="password" name="password" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2"> Konfirmasi Password Baru </label>

						<div class="col-md-4">
							<input  style="width:100%;" type="password" name="password_konfirm" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button class="btn btn-info">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Simpan
							</button>
							<a href="<?php echo base_url(); ?>password" class="btn btn-danger" type="reset">
								<i class="ace-icon fa fa-undo bigger-110"></i>
								Batal
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>