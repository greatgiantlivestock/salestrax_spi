<div>					    
	<div class="widget-box" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title">
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
					<?php if($this->session->flashdata('success')) { ?>
						<div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php echo $this->session->flashdata('success'); ?>
						</div> 
 					<?php }else if($this->session->flashdata('error')){ ?>
						<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php }?>
				<!-- <table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Customer</th>
							<th>Waktu Kunjungan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach($detail_visit->result_array() as $data) { ?>
										<tr>
											<td><?php echo $data['nama_customer']; ?></td>
											<td><?php echo $data['tanggal_checkout']; ?></td>
										</tr>
						<?php 	$no++; } ?>
					</tbody>
				</table> -->
				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;">No</th>									
									<th style="background: #22313F;color:#fff;">Customer / Tanggal Kunjungan</th>									
									<th style="background: #22313F;color:#fff;">Display</th>									
									<th style="background: #22313F;color:#fff;">Chiller</th>
									<th style="background: #22313F;color:#fff;">Kompetitor</th>
									<th style="background: #22313F;color:#fff;">Aktifitas SPG</th>
								</tr> 
							</thead>

							<tbody>
								<?php
								$no = 1;
								$jum_total = 0;		
										foreach($detail_visit->result_array() as $data) { ?>
										<tr>
											<td><?php echo $no; ?></td>										
											<td>
												<?php echo $data['nama_customer']; ?>
												<br>
												<?php echo $data['tanggal_checkout']; ?>
											</td>						
											<td>
												<?php if($data['foto_display']){?>
													<img style="width:200px; height:200px"; src="<?php echo "http://localhost/sales_order/upload/display_report/";echo $data['foto_display']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_display']; ?>
												<?php }?>
											</td>						
											<td>
												<?php if($data['foto_chiller']){?>
													<img style="width:200px; height:200px"; src="<?php echo "http://localhost/sales_order/upload/chiller_report/";echo $data['foto_chiller']; ?>" border="0"/> <br>
													<?php echo $data['suhu']; ?>
												<?php }?>
											</td>						
											<td>
												<?php if($data['foto_kompetitor']){?>
													<img style="width:200px; height:200px"; src="<?php echo "http://localhost/sales_order/upload/kompetitor_report/";echo $data['foto_kompetitor']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_kompetitor']; ?>
												<?php }?>
											</td>						
											<td>
												<?php if($data['foto_spg']){?>
													<img style="width:200px; height:200px"; src="<?php echo "http://localhost/sales_order/upload/spg_report/";echo $data['foto_spg']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_spg']; ?>
												<?php }?>
											</td>						
										</tr>
										<?php
										$no++; } ?>
							</tbody>
							</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ModalAddShp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Shipping Point</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/save_shipping_point" method="post"/>	
						<input id="tipe_shp" type="hidden" name="tipe" readonly>	
						<input id="id_user_shp" type="hidden" name="id_user" readonly>			

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>
								<div class="col-sm-9">
									<select class='select_kegiatan' style="width:60%;" name="description">
										<?php echo $combo_shipping_point_user; ?>
									</select>
								</div>
							</div>	

							<div>												
								<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-12">
											<button class="btn btn-success">
												<i class="ace-icon fa fa-check bigger-110"></i>Simpan
											</button>
											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
												<i class="ace-icon fa fa-undo bigger-110"></i>Batal
											</button>
										</div>
								</div>
							</div>								
					</form>			
			</div>		   
        </div>
		</div>
	</div>