
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
				"dom":'<"toolbar">frtip',
                responsive: true,
				bPaginate: false,
                "order": [[ 0, "asc" ]]
            });
        });

		function contoh(x){
			var table = document.getElementById("dataTables-example");
			var count = x.parentNode.parentNode.rowIndex;
			var req_id = table.rows[count].cells[1].innerHTML;
			//var req_id = str;

			//console.log(str.substring(0,4));
			var url = '<?php echo base_url('shipment/get_row/')?>'+req_id;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-shp').html(msg);
					}
			});
		}
    </script>

	<style>
		/* The container */
		.container {
			display: block;
			position: relative;
			padding-left: 35px;
			margin-bottom: 12px;
			cursor: pointer;
			font-size: 14px;
			font-weight: normal;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		/* Hide the browser's default radio button */
		.container input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
		}

		/* Create a custom radio button */
		.checkmark {
			position: absolute;
			top: 0;
			left: 0;
			height: 25px;
			width: 25px;
			background-color: #eee;
			border-radius: 50%;
		}

		/* On mouse-over, add a grey background color */
		.container:hover input ~ .checkmark {
			background-color: #ccc;
		}

		/* When the radio button is checked, add a blue background */
		.container input:checked ~ .checkmark {
			background-color: #2196F3;
		}

		/* Create the indicator (the dot/circle - hidden when not checked) */
		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}

		/* Show the indicator (dot/circle) when checked */
		.container input:checked ~ .checkmark:after {
			display: block;
		}

		/* Style the indicator (dot/circle) */
		.container .checkmark:after {
			top: 9px;
			left: 9px;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: white;
		}
	</style>
<div id="widget-box-9">
	<!--<div class="widget-header" >
		<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
	</div>-->
	<div class="col-xs-12">
		<hr style="margin-bottom:5px; margin-top:5px">
				
				<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert" >
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
				<?php } ?>
				<?php if($this->session->flashdata('error')) { ?>
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?php echo $this->session->flashdata('error'); ?>
							</div> 
				<?php } ?>
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='100'>
					<thead>
						<tr>								
							<!-- <th style="background: #22313F;color:#fff;">Sales</th>										
							<th style="background: #22313F;color:#fff;">No. PO</th>									
							<th style="background: #22313F;color:#fff;">Sold to Party</th>									 -->
							<th style="background: #22313F;color:#fff;">No</th>						
							<th style="background: #22313F;color:#fff;">No Order</th>						
							<th style="background: #22313F;color:#fff;">DO</th>						
							<th style="background: #22313F;color:#fff;">Ket</th>						
							<th style="background: #22313F;color:#fff;">Ship to Party</th>						
							<th style="background: #22313F;color:#fff;">Shp Point</th>											
							<th style="background: #22313F;color:#fff;">Tgl Order</th>									
							<th style="background: #22313F;color:#fff;">Tgl Rcn Krm</th>									
							<th style="background: #22313F;color:#fff;">Tgl Real Krm</th>									
							<th style="background: #22313F;color:#fff;">Catatan</th>									
							<th style="background: #22313F;color:#fff;">Jenis</th>
							<!-- <th style="background: #22313F;color:#fff;">Produk</th>
							<th style="background: #22313F;color:#fff;">Qty</th>
							<th style="background: #22313F;color:#fff;">Satuan</th>
							<th style="background: #22313F;color:#fff;">Ket</th> -->
							<th style="background: #22313F;color:#fff;">Shp Stts</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$no = 1;
							$jum_total = 0; 
									
							foreach($q_tarik_data->result_array() as $data) { ?>
							<tr>					
								<!-- <td><?php echo substr($data['nama'],0,10); ?><i class="glyphicon glyphicon-chevron-down"></i></td>							
								<td><?php echo $data['no_po']; ?></td>						
								<td><?php echo $data['cust_sold']; ?></td>						 -->
								<td><?php echo $no; ?></td>	
								<td><?php echo $data['no_request']; ?></td>	
								<td><?php echo $data['no_do']; ?></td>	
								<td><?php echo $data['keterangan_do']; ?></td>	
								<td><?php echo $data['cust_ship']; ?></td>	
								<td><?php echo $data['alias']; ?></td>						
								<td><?php echo $data['tanggal_request']; ?></td>
								<td><?php echo $data['tanggal_kirim']; ?></td>
											<td><?php if($data['tanggal_shipping']==null){
												echo "";
											}else{
												echo $data['tanggal_shipping'];
											}?></td>
								<td><?php echo $data['catatan']; ?></td>
								<td><?php echo $data['nama_transaksi']; ?></td>
								<!-- <td><?php echo $data['nama_product']; ?></td>
								<td><?php echo $data['qty']; ?></td>
								<td><?php echo $data['nama_satuan']; ?></td>
								<td><?php echo $data['keterangan']; ?></td> -->
								<td>
									<?php echo $data['nama_status_kirim']; ?>
								</td>
							</tr>
						<?php $no++; }?>	
					</tbody>
					<!-- <tr>
						<td colspan='12'>
							<strong>Belum dikirim </strong>
						</td>
						<td>
							<center><strong><?php echo $qCount->bnyk_pengiriman ?> </strong></center>
						</td>
					</tr>
					<tr>
						<td colspan='12'>
							<strong>Sedang dikirim </strong>
						</td>
						<td>
							<center><strong><?php echo $qCount2->bnyk_pengiriman ?> </strong></center>
						</td>
					</tr>
					</tr>
					<tr>
						<td colspan='12'>
							<strong>Sudah dikirim </strong>
						</td>
						<td>
							<center><strong><?php echo $qCount1->bnyk_pengiriman ?> </strong></center>
						</td>
					</tr> -->
				</table>	

				<div style="margin-bottom: 20px;" class="row">
								<div class="col-md-12 text-center">
									<a class="btn btn-xs btn-primary text-center" style="margin-top:10px"
										href="javascript://" onclick="exportPengirimanList('xls');">
										<i class="glyphicon glyphicon-export"></i>
										<span class="bigger-110"> Export to Excel</span>
									</a>
								</div>
				</div>

			<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Edit Shipment Status</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipment/save" method="post"/>	
											<input id="tipe" type="hidden" name="tipe">
											<input id="id_shipping" type="hidden" name="id_shipping">
											<input id="id_request" type="hidden" name="id_request">
											<input id="id_detail_request" type="hidden" name="id_detail_request">
											<input id="id_jenis_transaksi" type="hidden" name="id_jenis_transaksi">

											<table class="tbl_input">
												<tr>
													<td colspan="6">
														Shipment Status
													</td>
													<td colspan="12">
														<div class="input-group col-xs-12">
															<select id="id_status_kirim" name="id_status_kirim" >
																<?php echo $combo_status_kirim; ?>
															</select>						
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Tanggal Rencana Kirim
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
															<input id="tgl2" class="form-control " type="text" name="tgl1" required>						
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Tanggal Realisasi kirim
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
															<input id="tgl" class="form-control " type="text" name="tanggal_shipping">						
														</div>
													</td>
												</tr>
												<?php if($this->session->userdata("id_role")!=6){?>
													<tr>
														<td colspan="6">
															Shipping Point
														</td>
														<td colspan="6">
															<div class="input-group col-xs-6">
																<select id="id_shipping_point" name="id_shipping_point">
																	<?php echo $combo_shipping_point; ?>
																</select>						
															</div>
														</td>
													</tr>
												<?php }?>
												<tr>
													<td colspan="6">
														No Do
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<input id="no_do" class="form-control " type="text" name="no_do" />					
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Keterangan
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<input id="ket_do" class="form-control " type="text" name="keterangan_do" />					
														</div>
													</td>
													<!-- <td colspan="6">
														<div class="input-group col-xs-6">
															<input type="radio" name="id_level" value="1"> Kirim
															<input type="radio" name="id_level" value="2"> Gantung
															<input type="radio" name="id_level" value="3"> Balik
														</div>
													</td> -->
												</tr>
											</table>
											
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-success">
														<i class="ace-icon fa fa-save bigger-110"></i>
														Simpan
													</button>

													&nbsp; &nbsp; &nbsp;
													<!--<a href="<?php echo base_url(); ?>shipment" class="btn btn-primary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Batal
														</a>
													-->
													<button type="button" class="btn btn-standar" style="margin-left: 0px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-close bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>

				

			<div class="modal fade" id="ModalEditOrder1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3>Stack Two</h3>
					</div>
					<div class="modal-body">
						<p>One fine body…</p>
						<p>One fine body…</p>
						<input type="text" data-tabindex="1">
						<input type="text" data-tabindex="2">
						<button class="btn" data-toggle="modal" href="#stack3">Launch modal</button>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn">Close</button>
						<button type="button" class="btn btn-primary">Ok</button>
					</div>
					</div>
				</div>
			</div>		

			<div id="modalDetailShp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-shp">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>