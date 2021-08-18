<style>
	@import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400);
	.font-roboto {
	font-family: 'roboto condensed';
	}
	* {
	box-sizing: border-box;
	}
	body {
	.font-roboto();
	}
	.modal {
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	overflow: hidden;
	}
	.modal-dialog {
	position: fixed;
	margin: 0;
	width: 100%;
	height: 100%;
	padding: 0;
	}
	.modal-content {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	border: 2px solid #3c7dcf;
	border-radius: 0;
	box-shadow: none;
	}
	.modal-header {
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
	height: 50px;
	padding: 10px;
	background: #6598d9;
	border: 0;
	}
	.modal-title {
	font-weight: 300;
	font-size: 2em;
	color: #fff;
	line-height: 30px;
	}
	.modal-body {
	position: absolute;
	top: 50px;
	bottom: 60px;
	width: 100%;
	font-weight: 300;
	overflow: scroll;
	}
	.modal-footer {
	position: absolute;
	right: 0;
	bottom: 0;
	left: 0;
	height: 50px;
	padding: 10px;
	background: #f1f3f5;
	}
	// first
	&:first-child {
		margin-top: 0;
	}
	}
	p {
	font-size: 1.4em;
	line-height: 1.5;
	color: lighten(#5f6377, 20%);
	// last
	&:last-child {
		margin-bottom: 0;
	}
	}
	::-webkit-scrollbar {
	-webkit-appearance: none;
	width: 10px;
	background: #f1f3f5;
	border-left: 1px solid darken(#f1f3f5, 10%);
	}
	::-webkit-scrollbar-thumb {
	background: darken(#f1f3f5, 20%);
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
				bPaginate: false,
                "order": [[ 0, "desc" ]]
            });
        });
	$(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo base_url('rekap_salesman/ambil_data') ?>",
			cache: false,
		});
		$("#wilayah_").change(function(){
			var value=$(this).val();
			if(value != ""){
				$.ajax({
					data:{modul:'get_karyawan',nama_wilayah:value},
					success: function(respond){
						$("#karyawan_").html(respond);
					}
				})
			}
		});
	})
	function Detail_visit(x){
			var table = document.getElementById("dataTables-example");
			var count = x.parentNode.parentNode.rowIndex;
			var str = table.rows[count].cells[2].innerHTML;
			var url = '<?php echo base_url('Rekap_salesman/get_row/')?>'+str;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-dt').html(msg);
					}
			});
		}
	</script>
	<div  id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-shopping-cart"> </i> <?php echo $judul; ?></h5>
		</div> -->
		<div class="widget-body">
		<form class="form-horizontal"  action="<?php echo base_url(); ?>Rekap_salesman/lihat_report" method="post"/>
			<input type="hidden" name="tanggal1" value="<?php echo $tanggal1; ?>" readonly>
			<input type="hidden" name="tanggal2" value="<?php echo $tanggal2; ?>" readonly>
			<input type="hidden" name="nama_wilayah1" value="<?php echo $nama_wilayah; ?>" readonly>
			<input type="hidden" name="nama_karyawan1" value="<?php echo $nama_karyawan; ?>" readonly>
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-8">
						<table class="tbl_input">
							<tr>
								<td>
									Mulai Tanggal 
								</td>
								<td>
									<div class="input-group col-xs-8">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?>  class="form-control " type="date" name="mulai_tanggal" value="<?php echo $tanggal1; ?>" required>						
									</div>
								</td>
								<td>
									Sampai Tanggal 
								</td>
								<td>
									<div class="input-group col-xs-8">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?>  class="form-control " type="date" name="sampai_tanggal" value="<?php echo $tanggal2; ?>" required>						
									</div>
								</td>
							</tr>
							<?php if($this->session->userdata("id_role") <= 2){?>
								<tr>
									<td>
										Wilayah
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> id="wilayah_" class="select_customer" name="nama_wilayah">
											<?php echo $combo_wilayah; ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										Karyawan
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> id="karyawan_" class="select_customer" name="nama_karyawan">
											<?php echo $combo_karyawan; ?>
										</select>
									</td>
								</tr>
							<?php }else{?>
								<tr>
									<td>
										Karyawan
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_karyawan">
											<?php echo $combo_karyawan; ?>
										</select>
									</td>
								</tr>
							<?php }?>				
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
					<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 					<?php } ?>
 						</a>
				<div style="margin-bottom: 10px;" class="row">
							<div class="col-md-12 text-center">
								<!-- <a class="btn btn-xs btn-success text-center" href="<?php echo base_url().'rekap_salesman/cetak'; ?>" <?php echo $disable; ?> 
								onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); return false;">
									<i class="ace-icon fa fa-print"></i>
									<?php 
									$session['tanggal_rekap1'] = $tanggal1;
									$session['tanggal_rekap2'] = $tanggal2;
									$session['wilayah_rekap'] = $nama_wilayah;
									$session['karyawan_rekap'] = $nama_karyawan;
									$this->session->set_userdata($session);
									?>
									<span class="bigger-110">Print</span>
								</a> -->
								<a class="btn btn-xs btn-primary text-center"
									href="javascript://" onclick="exportRekapSales('xls');"
									<?php echo $disable; ?>>
									<i class="glyphicon glyphicon-export"></i>
									<span class="bigger-110"> Export to Excel</span>
								</a>
							</div>
						</div>
						<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;">No</th>									
									<th style="background: #22313F;color:#fff;">Sales/MD</th>										
									<th style="display:none;">id rencana</th>										
									<th style="background: #22313F;color:#fff;">Tanggal Rencana</th>									
									<th style="background: #22313F;color:#fff;">Jumlah Rencana</th>									
									<th style="background: #22313F;color:#fff;">Realisasi (%)</th>
									<th style="background: #22313F;color:#fff;">Jam Kerja</th>
									<?php if($this->session->userdata("id_role")==4){?>
										<th style="background: #22313F;color:#fff;">Lembur</th>
									<?php }?>
									<th style="background: #22313F;color:#fff;">Detail Kunjungan</th>
								</tr> 
							</thead>
							<tbody>
								<?php
								$no = 1;
								$jum_total = 0;		
										foreach($q_rekap_biaya->result_array() as $data) { ?>
										<tr>
											<td><?php echo $no; ?></td>						
											<td><?php echo $data['nama_karyawan']; ?></td>						
											<td style="display:none;"><?php echo $data['id_rencana_header']; ?></td>						
											<td><?php echo $data['tanggal_rencana']; ?></td>						
											<td><?php echo $data['jml_visit']; ?></td>						
											<td>
												<?php
													if($data['jml_visit_realisasi']!=''){
														echo $data['jml_visit_realisasi']; echo " ("; echo $data['jml_visit_realisasi']/$data['jml_visit']*100;echo "%)";
													}else{
														echo "0"; echo " (0%)";
													} 
												?>
											</td>						
											<td>
												<?php 
													$datetime1 = New DateTime($data['tanggal_checkout']);
													$datetime2 = New DateTime($data['tanggal_checkin']);
													$datediff = $datetime1->diff($datetime2);
													$datediff1 = $datediff->format('%a Hari %h Jam %i Menit');
													echo $datediff1; 
												?>
											</td>
											<?php if($this->session->userdata("id_role")==4){?>
												<td>
													<?php 
															$datetime1 = New DateTime($data['tanggal_checkout']);
															$datetime2 = New DateTime($data['tanggal_checkin']);
															$datediff = $datetime1->diff($datetime2);
															$datediff1 = $datediff->format('%h');
															if($datediff1 >= '8'){
																$datediff2 = $datediff1-'8';
																echo $datediff2;echo" Jam";	
															}
													?>
												</td>
											<?php }?>
											<td>
												<!-- <a id="openMapdetail" href="#" data-id_rencana_header="<?php echo $data['id_rencana_header']?>" 
													data-toggle="modal" data-tipe="add" data-id_rencana_header="<?php echo $data['id_rencana_header']; ?>" 
													data-target="#ModalInputDetail"> Detail
												</a> -->
												<?php if($data['jml_visit_realisasi']!=''){?>
													<a href="#"
														class="btn btn-xs btn-primary" 
														data-id_rencana_header="<?php echo $data['id_rencana_header']?>"
														data-toggle="modal"
														data-target="#modalDetailShp" 
														onclick="Detail_visit(this)">
														Detail
													</a>
												<?php }else{?>
													<a href="#"
														class="btn btn-xs btn-normal" >
														Detail
													</a>
												<?php }?>
											</td>
										</tr>
										<?php
										$no++; } ?>
							</tbody>
								<!-- <tr>
									<th colspan="5">Grand Total</th>
									<th style="width: 10%;">
										<?php echo $total->grand_tot;?>
									</th>
								</tr> -->
							</table>							
						</table>
					</div>
				</div>
			</div>
			<div id="modalDetailShp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" style="overflow-y: scroll;">
						<div class="modal-dt">
						</div>
					</div>
					<div class="modal-footer">
							<!-- <?php $data_= $q_rekap_biaya->row();?> -->
							<a data-dismiss="modal" style="float:right;margin-right:10px;" class="btn btn-xs btn-danger text-center" href="#" >
								<i class="ace-icon fa fa-close"></i>
								<span class="bigger-110">Close</span>
							</a>
							<!-- <a style="float:right;margin-right:10px;" class="btn btn-xs btn-success text-center" href="<?php echo base_url().'Rekap_salesman/cetak/';echo $data_->id_rencana_header; ?>"  
								onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); return false;">
								<i class="ace-icon fa fa-print"></i>
								<span class="bigger-110">Print</span>
							</a> -->
					</div>
				</div>
			</div>
			<div class="modal fade" id="ModalInputDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Detail Order</h4>
				</div>
				<div class="modal-body">
						<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/save_detail" method="post"/>	
								<div class="form-group text-center">
									<button class="btn btn-success btn-xs" <?php echo $disable; ?>><?php echo $btn_name; ?></button>
								</div>				
						</form>			
				</div>		   
			</div>
			<div  class="modal fade" id="ModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Lokasi Absen Karyawan</h4>
					</div>
					<form style="margin-bottom:0;" action="<?php echo base_url(); ?>penerimaan_sapi/save_terima" method="post"/>
						<input id="id_pengiriman" type="hidden" name="id_pengiriman" >
						<div class="modal-body" style="height: 350px;overflow-y: scroll;">					
							<div id="data_map"></div>
						</div>
				</div>
			</div>
		</div>
		</div>
	</div>
<?php 
	if($this->session->userdata("error_duplicate") == true) { 
		$this->session->unset_userdata('error_duplicate');
?>
<script type="text/javascript">    
	$(document).ready(function(){
		$("#ModalInput2 #tipe").val("add");
		$('#ModalInput2').modal('show');
	});
</script>
<?php } ?>