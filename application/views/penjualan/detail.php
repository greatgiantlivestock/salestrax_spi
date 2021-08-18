<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
	body {font-family: Arial, Helvetica, sans-serif;}

	/* Add Animation */
	.modal-content, #caption {    
		-webkit-animation-name: zoom;
		-webkit-animation-duration: 0.6s;
		animation-name: zoom;
		animation-duration: 0.6s;
	}

	@-webkit-keyframes zoom {
		from {-webkit-transform:scale(0)} 
		to {-webkit-transform:scale(1)}
	}

	@keyframes zoom {
		from {transform:scale(0)} 
		to {transform:scale(1)}
	}
</style>
<div class="w3-container">
  <h2>Detail Aktifitas Kunjungan Sales/MD</h2>

  <!-- <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Fade In Modal</button> -->

  <!-- <div id="id01" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h2>Modal Header</h2>
      </header>
      <div class="w3-container">
        <p>Some text..</p>
        <p>Some text..</p>
      </div>
      <footer class="w3-container w3-teal">
        <p>Modal Footer</p>
      </footer>
    </div>
  </div> -->
</div>
<div>					    
	<div class="widget-box" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title">
				<?php $data_= $detail_visit->row();?>
				<?php echo "Sales/MD : "; echo $data_->nama_karyawan; ?>

				<a style="float:right;margin-right:10px;" class="btn btn-xs btn-success text-center" href="<?php echo base_url().'Rekap_salesman/cetak/';echo $data_->id_rencana_header; ?>"  
					onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); return false;">
					<i class="ace-icon fa fa-print"></i>
					<span class="bigger-110">Print</span>
				</a>
			</h5>
		</div>
		<div class="widget-body" id="print_area">
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
				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="background: #22313F;color:#fff;">No</th>									
							<th style="background: #22313F;color:#fff;">Kunjungan</th>									
							<th style="background: #22313F;color:#fff;">Absen</th>									
							<th style="background: #22313F;color:#fff;">Display</th>									
							<th style="background: #22313F;color:#fff;">Chiller</th>
							<th style="background: #22313F;color:#fff;">Kompetitor</th>
							<th style="background: #22313F;color:#fff;">Aktifitas SPG</th>
							<th style="background: #22313F;color:#fff;">Map</th>
						</tr> 
					</thead>

					<tbody>
								<?php
								$no = 1;
								$jum_total = 0;		
										foreach($detail_visit->result_array() as $data) { ?>
										<tr>
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php echo $no; ?>
											</td>										
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php echo $data['nama_customer']; ?>
												<br>
												<?php echo $data['tanggal_checkout']; ?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['foto']){?>
													<?php if($data['prospect'] == 1){?>
														<a  
															href="<?php echo base_url(); ?>Rekap_salesman/downloadProspect/<?php echo $data['foto']; ?>">
															<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/prospect/";echo $data['foto']; ?>" border="0"/> <br>
														</a>
													<?php }else{?>
														<a  
															href="<?php echo base_url(); ?>Rekap_salesman/downloadCheckin/<?php echo $data['foto']; ?>">
															<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/checkin/";echo $data['foto']; ?>" border="0"/> <br>
														</a>
													<?php }?>
												<?php }?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['foto_display']){?>
													<a  
														href="<?php echo base_url(); ?>Rekap_salesman/downloadDisplay/<?php echo $data['foto_display']; ?>">
														<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/display_report/";echo $data['foto_display']; ?>" border="0"/> <br>
													</a>	
													<?php echo $data['keterangan_display']; ?>
												<?php }?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['foto_chiller']){?>
													<a  
														href="<?php echo base_url(); ?>Rekap_salesman/downloadChiller/<?php echo $data['foto_chiller']; ?>">
														<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/chiller_report/";echo $data['foto_chiller']; ?>" border="0"/> <br>
													</a>
													<?php echo "Suhu Chiller "; echo $data['suhu']; echo " Derajat C"; ?>
												<?php }?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['foto_kompetitor']){?>
													<a  
														href="<?php echo base_url(); ?>Rekap_salesman/downloadKompetitor/<?php echo $data['foto_kompetitor']; ?>">
														<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/kompetitor_report/";echo $data['foto_kompetitor']; ?>" border="0"/> <br>
													</a>
													<?php echo $data['keterangan_kompetitor']; ?>
												<?php }?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['foto_spg']){?>
													<a  
														href="<?php echo base_url(); ?>Rekap_salesman/downloadSpg/<?php echo $data['foto_spg']; ?>">
														<img style="width:200px; height:200px"; src="<?php echo base_url(); echo "/upload/spg_report/";echo $data['foto_spg']; ?>" border="0"/> <br>
													</a>
													<?php echo $data['keterangan_spg']; ?>
												<?php }?>
											</td>						
											<td <?php if($data['prospect'] == 1){?> Style="background:#ee8033;"<?php }?>>
												<?php if($data['lats']){?>
													<?php echo '<iframe width="200" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='.$data['lats'].','.$data['longs'].'&hl=es;z=16&amp;output=embed"></iframe>'?>
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

	<!-- The Modal -->
	<div id="myModal" class="modal">
	<span class="close">&times;</span>
	<img class="modal-content" id="img01">
	<div id="caption"></div>
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