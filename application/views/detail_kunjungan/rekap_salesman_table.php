<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
	<script type="text/javascript">
	
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
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

			// console.log(str);
			// console.log("test", str);
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
								<a class="btn btn-xs btn-success text-center" href="<?php echo base_url().'rekap_salesman/cetak'; ?>" <?php echo $disable; ?> 
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
								</a>

								<a class="btn btn-xs btn-primary text-center"
									href="javascript://" onclick="exportRekapSalesman('xls');"
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
									<!-- <th style="display:none;">ID Rencana Header</th>										 -->
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
										foreach($q_rekap_biaya->result_array() as $data) { ?>
										<tr>
											<td><?php echo $no; ?></td>						
											<td><?php echo $data['nama_karyawan']; ?></td>						
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
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Detail Kunjungan</h4>
				</div>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-dt">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
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