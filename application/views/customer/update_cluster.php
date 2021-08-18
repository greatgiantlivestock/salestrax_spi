<div>	
		<div class="widget-body" style="border-radius:25px;" >
			<div class="widget-main">
			<form  class="form-horizontal"  action="<?php echo base_url(); ?>Customer/edit" method="post">		
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kode Customer </label>
								<div class="col-sm-6">
									<input value="<?php echo $kode_customerCl?>"   class="form-control " readonly  type="text" name="kode_customer" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Nama Customer</label>
								<div class="col-sm-6">
									<input value="<?php echo $nama_customerCl?>"  class="form-control " readonly type="text" name="nama_customer" >
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kota </label>
								<div class="col-sm-6">
									<input value="<?php echo $cityCl?>"  class="form-control " readonly type="text" name="city">
								</div>
							</div>										
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Alamat </label>
								<div class="col-sm-6">
									<input value="<?php echo $alamatCl?>"  class="form-control " readonly type="text" name="alamat">
								</div>
							</div>												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Cluster </label>
								<div class="col-sm-6">
									<select class='select_kegiatan' style="width:100%;" name="cluster_id">
										<?php echo $combo_material_group; ?>
									</select>
								</div>
							</div>
							<div style="border-radius:25px;" class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-12">
										<button type="submit" style="border-radius:25px" class="btn btn-ms btn-success">
											<i class="ace-icon fa fa-edit bigger-110"></i>Simpan
										</button>
										<button type="botton" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
											<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
										</button>
									</div>
							</div>								
					</form>
			</div>
	</div>