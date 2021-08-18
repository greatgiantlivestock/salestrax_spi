<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>

<script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>

<script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
<script>

	$(document).ready(function() {

		$('#dataTables-example').DataTable({

			"dom":'<"toolbar">frtip',

			responsive: true,

			bPaginate: true,

			bLengthChange: false,

			bFilter: true,

			bInfo: false,

			bAutoWidth: false,

			order: [[ 1, "desc" ]]

		});

	});

</script>

	<div class="widget-box widget-color-nurmal" id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-tags"> </i> <?php echo $judul; ?></h5>
		</div> -->
		<div class="widget-body">
		<form class="form-horizontal"  action="<?php echo base_url(); ?>Stock_customer/lihat_report" method="post"/>

			<input type="hidden" name="tanggal1" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal2" value="<?php echo $tanggal_sampai; ?>">
			<input type="hidden" name="nama_karyawan" value="<?php echo $nama_karyawan; ?>">
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			
			<div class="widget-main">
				<div class="row">
					<div class="col-md-8">
						<table class="tbl_input">
							<tr>
								<td>
									Customer
								</td>
								<td>
									<select style="width:80%;" <?php echo $color; ?> required class="select_customer" name="id_customer">
										<?php echo $combo_customer; ?>
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
					<div class="col-md-12 text-center">
						<!-- <a class="btn btn-xs btn-success text-center" 
							href="<?php echo base_url().'report_rencana/cetak/'.$tanggal_mulai.'/'.
							$tanggal_sampai.'/'.$nama_karyawan; ?>" <?php echo $disable; ?> 
							onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); 
							return false;">
							<i class="ace-icon fa fa-print"></i>
							<span class="bigger-110">Print</span>
						</a> -->
								
						<a class="btn btn-xs btn-primary text-center"
							href="javascript://" onclick="exportStockCustomer('xls');"
							<?php echo $disable; ?>>
							<i class="glyphicon glyphicon-export"></i>
							<span class="bigger-110"> Export to Excel</span>
						</a>
					</div>
						<table id="dataTables-example" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;">Customer</th>									
									<th style="background: #22313F;color:#fff;">Nama Produck</th>									
									<th style="background: #22313F;color:#fff;">Qty</th>		
									<th style="background: #22313F;color:#fff;">Tanggal Update</th>
								</tr> 
							</thead>

							<tbody>
								<?php
								$no = 1;
								$jum_total = 0;
								if($this->session->userdata("id_role") <=2){
									$q_tarik_data = $this->db->query("");
								}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4 || $this->session->userdata("id_role") == 6){
									$q_tarik_data = $this->db->query("SELECT dt_stock.*,nama_customer,nama_product FROM(SELECT stock_customer.* FROM(SELECT MAX(id_stock) 
																	AS id_stock FROM stock_customer GROUP BY id_customer,id_product)AS max_ JOIN stock_customer 
																	ON max_.id_stock=stock_customer.id_stock)AS dt_stock JOIN mst_customer 
																	ON dt_stock.id_customer=mst_customer.id_customer JOIN mst_product 
																	ON dt_stock.id_product=mst_product.id_product WHERE dt_stock.id_customer='$id_customer'");
								}else if($this->session->userdata("id_role") == 5){
									$departemen=$this->session->userdata('id_departemen');
									$id_karyawan=$this->session->userdata('id_karyawan');
									$q_tarik_data = $this->db->query("");
								}else{
									redirect("Login");
								}		
								
								foreach($q_tarik_data->result_array() as $data) { ?>
									<tr>
										<td><?php echo $data['nama_customer']; ?></td>						
										<td><?php echo $data['nama_product']; ?></td>						
										<td><?php echo $data['qty']; ?></td>		
										<td><?php echo $data['tanggal_update'];?>
										</td>
										<!--
										<td><div>
												<a id="openModalEditOpname" href="#" class="label label-primary" 
												data-kegiatan="<?php echo $data['id_rencana_header']?>" 
												data-departemen="" data-wilayah="" href="#" data-toggle="modal" 
												data-target="#ModalInputKegiatan">Detail</a>
											</div>
										</td>
										-->
									</tr>
									<?php
									$no++; 
								} ?>
							</tbody>							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

 <!-- <div class="modal fade" id="ModalInputKegiatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detail Rencana</h4>
            </div>

            <div class="modal-body">
			<form>
				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Nama Karyawan</th>	
							<th>Kegiatan</th>
							<th>Customer</th>
							<th>Status</th>
						</tr> 
					</thead>

					<tbody>
						<?php
						$id='38';
						?>
						<input id="nama_kegiatan" type="text" name="keterangan">
						<?php 
						$rcn_dt = $this->db->query("SELECT trx_rencana_detail.id_rencana_detail,
													trx_rencana_detail.id_rencana_header,trx_rencana_detail.status_rencana,
													mst_kegiatan.nama_kegiatan,mst_customer.nama_customer, 
													trx_rencana_detail.id_karyawan, tk_personal.nama_karyawan 
													FROM trx_rencana_detail JOIN tk_personal 
													ON tk_personal.id_karyawan = trx_rencana_detail.id_karyawan 
													JOIN mst_kegiatan ON trx_rencana_detail.id_kegiatan=mst_kegiatan.id_kegiatan
													JOIN mst_customer ON trx_rencana_detail.id_customer=mst_customer.id_customer
													WHERE trx_rencana_detail.id_rencana_header= '$id'
													ORDER BY trx_rencana_detail.id_rencana_detail DESC"); 
						$no = 1;
						foreach($rcn_dt->result_array() as $data) { ?>	
							<tr>
								<td><?php echo $data['nama_karyawan']; ?></td>
								<td><?php echo "Belum Terealisasi"; ?></td>
								<td><?php echo "Belum Terealisasi"; ?></td>
								<td><?php echo "Belum Terealisasi"; ?> </td>
							</tr>
						<?php 
						$no++; } ?>	
					</tbody>							
				</table>
			</form>
	        <div class="modal-footer">	
			    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
			</div>  
        </div>
    </div>
</div> -->

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