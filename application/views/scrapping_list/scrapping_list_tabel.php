<style type="text/css">
	pre {
		display: block;
		font-family: Verdana;
		white-space: pre;
		margin: 0;
		padding: 0;
	}
	
</style>
	<script type="text/javascript">
	$(document).ready(function () {
		$('a').on('click', function () {
			var image = $(this).attr('src');
			$('#myModal').on('show.bs.modal', function () {
				$(".img-responsive").attr("src", image);
			});
		});
	});
	</script>

	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	</script>
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
				bAutoWidth: false , 
				responsive: true,
				bPaginate: true,
				bLengthChange: false,
				bFilter: true,
				bInfo: false,
                order: [[ 1, "DESC" ]]
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#edit_modal').on('show.bs.modal', function (e) {
                var idx = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type : 'post',
                    url : 'editcomplains.php',
                    data :  'idx='+ idx,
                    success : function(data){
                    $('.hasil-data').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<div class="widget-box " id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-shopping-cart"> </i> <?php echo $judul; ?></h5>
		</div> -->
		<div class="widget-body" id="AppsAll">
		<form class="form-horizontal"  action="<?php echo base_url(); ?>Scrapping_list/lihat_report" method="post"/>

			<!-- <input type="hidden" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>"> -->
			<input type="hidden" name="kode_shipping_point" value="<?php echo $kode_shipping_point; ?>">
			<input type="hidden" name="id_realisasi" value="<?php echo $id_realisasi; ?>">
			
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			
			<div class="widget-main">
				<div class="row">
					<div class="col-md-8">
						<table class="tbl_input">
							<!-- <tr>
								<td colspan="6">
									<h3>Tanggal Rencana Kirim</h>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<div class="input-group col-xs-10">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl" class="form-control " type="text" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" required>						
									</div>
								</td>
								<td style="width:50px">To </td>
								<td colspan="5">
									<div class="input-group col-xs-10">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl2" class="form-control " type="text" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>" required>						
									</div>
								</td>
							</tr> -->
							<!--
								<?php if ($this->session->userdata("id_role")<=2){?>
								<tr>
									<td>
										Departemen
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_departemen">
											<?php echo $combo_departemen; ?>
										</select>
									</td>
								</tr>				
								<?php }?>	
								<tr>
									<td>
										Nama Sales
									</td>
								</tr>	
								<tr>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_karyawan">
											<?php echo $combo_user; ?>
										</select>
									</td>			
								</tr>
								
								<tr>
									<td colspan="7">
										Shipping Point
									</td>
									<td colspan="5">
										Shipment Status
									</td>
								</tr>	
							-->
							<tr>
								<td colspan="7">
									<select class="select_karyawan" style="width:90%;" <?php echo $color; ?> name="id_shipping_point">
										<?php echo $combo_shipping_point_id; ?>
									</select>
								</td>			
								<td colspan="5">
									<select class="select_karyawan" name="id_realisasi">
										<?php echo $combo_realisasi; ?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/ style="margin-top: 10px; margin-bottom: 10px;">
						<?php echo $btn_nota; ?>
						<hr/ style="margin-top: 10px; margin-bottom: 10px;">
					</div>
				</div>
			</form>

				<div class="space-10"></div>

				<div class="row">
					<div class="col-md-12">
					<?php if($this->session->flashdata('error_update')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error_update'); ?>
                    </div> 
					<?php }else if($this->session->flashdata('success_update')){ ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success_update'); ?>
                    </div> 
 					<?php } ?>
 						</a>
						<div class="col-md-12 text-left">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='100'>
								<thead>
									<tr class="odd gradeX">							
										<th style="background: #22313F;color:#fff;"> Admin </th>																	
										<th style="background: #22313F;color:#fff;">No. Request</th>							
										<th style="background: #22313F;color:#fff;">Dikirim Dari</th>	
										<th style="background: #22313F;color:#fff;"> Dikirim Untuk </th>						
										<th style="background: #22313F;color:#fff;">Tanggal Request</th>
										<th style="background: #22313F;color:#fff;">Produk</th>
										<th style="background: #22313F;color:#fff;">Qty</th>
										<th style="background: #22313F;color:#fff;">UOM</th>
										<th style="background: #22313F;color:#fff;">Batch</th>									
										<th style="background: #22313F;color:#fff;">Catatan</th>										
										<th style="background: #22313F;color:#fff;">No. Document</th>	
										<th style="background: #22313F;color:#fff;">File</th>	
										<th style="background: #22313F;color:#fff;">Preview</th>		
										<th style="background: #22313F;color:#fff;">Status Realisasi</th>										
										<th style="background: #22313F;color:#fff;">Tanggal Realisasi</th>
										<th style="background: #22313F;color:#fff;">Action</th>
									</tr> 
								</thead>

								<tbody>
									<?php
									$no = 1;
									$jum_total = 0; 
									
									foreach($q_tarik_data->result_array() as $data) { ?>
										<tr>					
											<td><?php echo $data['nama']; ?><i class="glyphicon glyphicon-chevron-down"></i></td>									
											<td><?php echo $data['no_request']; ?></td>						
											<td><?php echo $data['cust_sold']; ?></td>
											<td><?php echo $data['cust_ship']; ?></td>
											<td><?php echo $data['tanggal_request']; ?></td>
											<td><?php echo $data['nama_product']; ?></td>	
											<td><?php echo $data['qty']; ?></td>
											<td><?php echo $data['nama_satuan']; ?></td>
											<td><?php echo $data['batch']; ?></td>		
											<td><?php echo $data['keterangan']; ?></td>					
											<td><?php echo $data['document_number']; ?></td>		
											<td>
												<?php if($data['title']==null){
													echo "";
													}else{?>
														<a class="label label-success" 
															href="<?php echo base_url(); ?>Scrapping_list/download/<?php echo $data['title']; ?>">
															<i class="glyphicon glyphicon-download"></i>
														</a>
													<?php }?>
											</td>	
											<td>
												<?php if($data['title']==null){
													echo "No file attach";
													}else{?>
														<!--<iframe style="width:100px;" src='<?php echo base_url().'upload/'.$data['title']; ?>'></iframe>-->
														<a href="#myModal" data-toggle="modal" src='<?php echo base_url().'upload/'.$data['title']; ?>'>Preview</a> 
													<?php }?>	
											</td>
											<td>
												<?php if($data['id_realisasi']==0){
													echo "Belum Teralisasi";
												}else{
													echo "Sudah Terealisai";
												} ?>
											</td>					
											<td><?php if($data['tanggal_realisasi']==null){
												echo "";
											}else{
												echo $data['tanggal_realisasi'];
											}?></td>
											<td style="text-align:center;width:100px;">
												<?php if($this->session->userdata("id_role")==5){?>
													
												<?php }else{?>
													<?php if($data['id_realisasi']==0){?>
														<a id="openModalScrapping" 
															href="#" class="label label-primary" 
															data-id_request="<?php echo $data['id_request']?>"  
															data-tanggal_realisasi="<?php echo $data['tanggal_realisasi']?>"  
															data-id_realisasi="<?php echo $data['id_realisasi']?>"  
															data-tipe="<?php echo "edit"?>" 
															data-toggle="modal" 
															data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
														</a>
													<?php }else{?>
														<a 
															href="#" class="label label-normal" 
															data-id_request="<?php echo $data['id_request']?>"  
															data-tipe="<?php echo "edit"?>" ><i class="fa fa-lock"></i> Update
														</a>
													<?php }?>
												<?php }?>
											</td>
										</tr>
									<?php $no++; }?>	
								</tbody>	
							</table>
							<div style="margin-bottom: 20px;" class="row">
								<div class="col-md-12 text-center">
									<!--
									<a class="btn btn-xs btn-success text-center" 
										href="<?php echo base_url().'Order_list/cetak/'.$tanggal_mulai.'/'.
										$tanggal_sampai.'/'.$nama_karyawan; ?>" <?php echo $disable; ?> 
										onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); 
										return false;">
										<i class="ace-icon fa fa-print"></i>
										<span class="bigger-110">Print</span>
									</a>
									-->	
									<a class="btn btn-xs btn-primary text-center" style="margin-top:10px"
										href="javascript://" onclick="exportScrappingList('xls');"
										<?php echo $disable; ?>>
										<i class="glyphicon glyphicon-export"></i>
										<span class="bigger-110"> Export to Excel</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body text-center">
					<iframe style="width:700px; height:400px" class="img-responsive" src=""></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Edit Status Realisasi</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Scrapping_list/save" method="post"/>	
											<input id="tipe" type="hidden" name="tipe">
											<input id="id_request12" type="hidden" name="id_request">

											<table class="tbl_input">
												<tr>
													<td colspan="6">
														Status Realisasi
													</td>
													<td colspan="6">
														<div class="input-group col-xs-8">
															<select id="id_realisasi12" name="id_realisasi">
																<?php echo $combo_realisasi; ?>
															</select>				
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Tanggal Realisasi
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
															<input id="tanggal_realisasi" class="form-control " type="date" name="tanggal_realisasi" required>						
														</div>
													</td>
												</tr>
												<!-- <tr>
													<td colspan="6">
														Shipping Point
													</td>
													<td colspan="6">
														<div class="input-group col-xs-10">
															<select id="id_shipping_point" class='select_customer' name="id_shipping_point" required>
																<?php echo $combo_shipping_point_id; ?>
															</select>					
														</div>
													</td>
												</tr> -->
											</table>
											
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-success">
														<i class="ace-icon fa fa-edit bigger-110"></i>
														Simpan
													</button>
													
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>

													<!--<a href="<?php echo base_url(); ?>shipment" class="btn btn-primary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Batal
													</a>-->
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>		