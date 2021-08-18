<div class="span12">					    
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="bigger lighter">
				<i class="icon-table"></i>
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
				<form class="form-horizontal"  action="<?php echo base_url(); ?>master_satuan/save" method="post"/>
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_satuan" value="<?php echo $id_satuan; ?>" readonly>
					
		

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right"> Nama Satuan </label>

						<div class="col-sm-9">
							<input  style="width:40%;" type="text" name="nama_satuan" value="<?php echo $nama_satuan; ?>"/>
						</div>
					</div>					
					
					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Simpan
							</button>

							&nbsp; &nbsp; &nbsp;
							<a href="<?php echo base_url(); ?>master_satuan" class="btn btn-danger" type="reset">
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