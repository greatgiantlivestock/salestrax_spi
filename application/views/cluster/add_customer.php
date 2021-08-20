					    
		<div class="widget-body" style="border-radius:25px;">
			<div class="widget-main">
				<div style="border-radius:25px;" class="modal-content">
								<div class="modal-bodyC">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/tambah_customer" method="post">	
											<input value="<?php echo $cluster_id ?>" type="hidden" name="cluster_id">
											<br>
											<div  class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Nama Cluster </label>
												<div class="col-sm-9">
													<input value="<?php echo $cluster_desc?>" type="text" Style="uppercase" readonly name="cluster_description" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Customer </label>
												<div class="col-sm-5">
													<select class="select_customer5" name="kode_customer" required>
														<?php echo $combo_cluster; ?>
													</select>
												</div>
											</div>	
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-success" style="border-radius:10px;">
														<i class="ace-icon fa fa-edit bigger-110"></i>
														Tambah
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px; border-radius:5px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>	
								</div>		   
				</div>
			</div>
		</div>