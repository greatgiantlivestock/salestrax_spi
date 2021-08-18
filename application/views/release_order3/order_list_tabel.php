<style type="text/css">
	pre {
		display: block;
		font-family: Verdana;
		white-space: pre;
		margin: 0;
		padding: 0;
	}
	* {
	box-sizing: border-box;
	}
	#myInput {
	background-image: url('/css/searchicon.png');
	background-position: 10px 10px;
	background-repeat: no-repeat;
	width: 50%;
	font-size: 16px;
	padding: 12px 20px 12px 10px;
	border: 1px solid #ddd;
	}
	#myTable {
	border-collapse: collapse;
	width: 100%;
	border: 1px solid #ddd;
	font-size: 12px;
	}
	#myTable th, #myTable td {
	text-align: left;
	padding: 12px;
	}
	#myTable tr {
	border-bottom: 1px solid #ddd;
	}
	#myTable tr.header, #myTable tr:hover {
	background-color: #f1f1f1;
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
			$("#checkAll").click(function () {
				$('input:checkbox').not(this).prop('checked', this.checked);
				var checkBox = document.getElementById("checkAll");
				var table = document.getElementById("dataTables-example");
				var count = table.rows.length;
				var calc = count - 3;
			});
		});
		function contoh(id_request){
// 			var table = document.getElementById("dataTables-example");
// 			var count = x.parentNode.parentNode.rowIndex;
// 			var req_id = table.rows[count].cells[24].innerHTML;
			// var req_id = str.substring(0,4);
			var url = '<?php echo base_url('Release_order/get_row/')?>'+id_request;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-body').html(msg);
					}
			});
		}
		function contoh1(id_request){
			var url = '<?php echo base_url('Release_order/get_row1/')?>'+id_request;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-body-edit').html(msg);
					}
			});
		}
		function detailPrd(id_request){
		    console.log(id_request);
			var url = '<?php echo base_url('Release_order/get_detail_prd/')?>'+id_request;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-body1').html(msg);
					}
			});
		}
	</script>
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
				bAutoWidth: false , 
				responsive: true,
				bPaginate: false,
				bLengthChange: false,
				bFilter: true,
				bInfo: false,
                "order": [[ 1, "desc" ]]
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

		<?php foreach($q_tarik_data->result_array() as $data) { ?>
			function my<?php echo $data['id_request'];?>() {
				var x = document.getElementById("bt<?php echo $data['id_request'];?>");
				var y = document.getElementById("bt<?php echo $data['id_request'];?>1");
				if (x.style.display === "none") {
					x.style.display = "block";
					y.style.display = "none";
				} else {
					x.style.display = "none";
					y.style.display = "block";
				}
			}
			// function myFunction<?php echo $data['id_request'];?>() {
			// 	var x = document.getElementById("bt<?php echo $data['id_request'];?>");
			// 	var y = document.getElementById("bt<?php echo $data['id_request'];?>1");
			// 		x.style.display = "none";
			// 		y.style.display = "block";
			// }
			// function myFunction<?php echo $data['id_request'];?>1() {
			// 	var x = document.getElementById("bt<?php echo $data['id_request'];?>");
			// 	var y = document.getElementById("bt<?php echo $data['id_request'];?>1");
			// 		x.style.display = "block";
			// 	y.style.display = "none";
			// }
		<?php } ?>
    </script>
	<div class="widget-box " id="widget-box-9">
		<div class="widget-body" id="AppsAll">
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
						<div class="col-md-12">
						<form style="margin-bottom:0;" action="<?php echo base_url(); ?>Release_order/release" method="post"/>
						<?php if($this->session->userdata("username")=="admin.alsut"){ ?>
							<div class="col-md-12 text-left" style="height: 450px;overflow-y: scroll;">
								<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover" data-page-length='100' id="myTable">
						<?php }else{ ?>
							<div class="col-md-12 text-right">	
								<button disabled style="margin-bottom:10px;border-radius:25px; background-color: #ADDAC3;"> Data Sudah Lengkap <i class="fa fa-check"> </i></button>
							</div>
							<div class="col-md-12 text-right">	
								<button disabled style="margin-bottom:10px;border-radius:25px; background-color: #FAAA17;"> Data Belum Lengkap <i class="fa fa-close"> </i></button>
							</div>
							<div class="col-md-12 text-left">
								<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover" data-page-length='100' id="myTable">
						<?php } ?>
								<thead>
									<tr >													
										<th style="background: #22313F;color:#fff;"></th>
										<th style="background: #22313F;color:#fff;"><input style="width:20px;height:20px;" type="checkbox" id="checkAll"/> All </th>
										<th style="font-size:1;background: #22313F;color:#fff;"> Sales   </th>																	
										<th style="font-size:1;background: #22313F;color:#fff;"> MD   </th>																	
										<th style="display:none;background: #22313F;color:#fff;">No. Order</th>							
										<th style="display:none;background: #22313F;color:#fff;">Sold to Party</th>
										<th style="background: #22313F;color:#fff;"> Ship to Party </th>
										<th style="background: #22313F;color:#fff;">Jenis</th>
										<th style="background: #22313F;color:#fff;">Produk</th>
										<th style="background: #22313F;color:#fff;">Qty</th>
										<th style="background: #22313F;color:#fff;">UOM</th>
										<th style="background: #22313F;color:#fff;">Region</th>
										<th style="background: #22313F;color:#fff;">Cluster</th>
										 <th style="background: #22313F;color:#fff;">Alamat</th>
										<th style="background: #22313F;color:#fff;">No. PO</th>	
										<th style="background: #22313F;color:#fff;">Tanggal Order</th>																	
										<th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 1)</th>																	
										<th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 2)</th>																	
										<th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 3)</th>																	
										<th style="background: #22313F;color:#fff;">Tanggal Rencana Kirim</th>									
										<th style="background: #22313F;color:#fff;">Tanggal Realisasi Kirim</th>								
										<th style="background: #22313F;color:#fff;">Catatan Customer</th>
										<th style="background: #22313F;color:#fff;">Ket</th>
										<th style="background: #22313F;color:#fff;">Shipping Point</th>	
										<th style="background: #22313F;color:#fff;">Shipment Status</th>
										<th style="background: #22313F;color:#fff;">Action</th>	
									</tr> 
								</thead>
								<tbody>
									<?php
									$no = 1;
									$jum_total = 0; 
									foreach($q_tarik_data->result_array() as $data) { ?>
										<?php if($data['id_shipping_point'] > 0 && $data['id_sales_person'] > 0){?>
											<tr style="background: #ADDAC3;">		
													<td style="padding:9px;" onclick="my<?php echo $data['id_request'];?>()">
														<a id="bt<?php echo $data['id_request'];?>" style="border-radius: 15px;background-color: #459cff;" disabled
															href="#"> <i style="margin-left:5px;margin-right:5px;background-color:#459cff;" class="fa fa-plus"> </i> 
														</a>
														<a id="bt<?php echo $data['id_request'];?>1" style="border-radius: 15px;display:none;background-color: #ff4040;" disabled
															href="#"> <i style="margin-left:5px;margin-right:5px;background-color:#ff4040;" class="fa fa-minus"> </i> 
														</a>
													</td>
													<td>
														<input style="width:20px;height:20px;" class="check" type="checkbox" name="ck_id_detail[]" value="<?php echo $data['id_request'];?>">
														<span class="lbl"></span>
													</td>
													<td ><?php echo $data['sales_pers']; ?></td>									
													<td ><?php echo $data['nama']; ?></td>									
													<td style="display:none;"><?php echo $data['no_request']; ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_ship']; ?></td>
													<td>
														<?php
															if($data['nama_transaksi']=="Penjualan"){
																echo "PO";
															}else if ($data['nama_transaksi']=="Tukar Guling"){
																echo "TG";
															}else{
																echo $data['nama_transaksi'];
															}  
														?>
													</td>
													<td>
														<?php 
															if($data['nama_product']=="FG Milk Botol 1 Liter"){
																echo "1 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 2 Liter"){
																echo "2 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 3 Liter"){
																echo "3 Ltr";
															}else{
																echo $data['nama_product']; 
															}
														?>
														<a style="border-radius: 25px;" 
															href="#" 
															onclick="detailPrd(<?php echo $data['id_request']; ?>)" data-toggle="modal" 
															data-target="#ModalDetailProduct"> Detail
														</a>
													</td>	
													<td><?php echo $data['qty']; ?></td>
													<td><?php echo $data['satuan']; ?></td>
													<td><?php echo $data['city']; ?></td>
													<td><?php echo $data['nama_cluster']; ?></td>
													<td><?php echo $data['alamat']; ?></td>							
													<td><?php echo $data['no_po']; ?></td>	
													<td>
														<?php
															echo $data['tanggal_request'];
															$date_3 = strtotime($data['tanggal_request']); 
															$dday3 = date("D", $date_3);
															echo " ("; echo strtoupper($dday3);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim2'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim3'];
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
															$date_4 = strtotime($data['tanggal_kirim']); 
															$dday4 = date("D", $date_4);
															echo " ("; echo strtoupper($dday4);  echo ") "; 
														?>
													</td>
													<td>
														<?php 
															if($data['tanggal_shipping']==null){
																echo "";
															}else{
																echo $data['tanggal_shipping'];
																$date_5 = strtotime($data['tanggal_shipping']); 
																$dday5 = date("D", $date_5);
																echo " ("; echo strtoupper($dday5);  echo ") "; 
															}
														?>
													</td>
													<td><?php echo $data['catatan']; ?></td>
													<td><?php echo $data['keterangan']; ?></td>
													<td><?php echo $data['description']; ?></td>
													<td><?php echo $data['nama_status_kirim']; ?></td>
													<td style="text-align:center;width:100px;">
														<a style="border-radius: 25px;" 
															href="#" class="btn btn-xs btn-primary" 
															onclick="contoh(<?php echo $data['id_request']; ?>)"
															data-id_request="<?php echo $data['id_request']?>" 
															data-kode_customer="<?php echo $data['kode_cust_ship']?>" 
															data-id_detail_request="<?php echo $data['id_detail_request']?>" 
															data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
															data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
															data-pers_numb1="<?php echo $data['pers_numb']?>" 
															data-cust_ship="<?php echo $data['cust_ship']?>"
															data-tipe="<?php echo "edit"?>" data-toggle="modal" 
															data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
														</a>
														<a style="border-radius: 25px;" 
															href="#" class="btn btn-xs btn-danger" 
															onclick="contoh1(<?php echo $data['id_request']; ?>)"
															data-tipe="<?php echo "edit"?>" data-toggle="modal" 
															data-target="#ModalEditDetailProduct"><i class="fa fa-edit"></i> Edit Product
														</a>
													</td>
											</tr>
										<?php }else{ ?>
											<tr style="background: #FAAA17;">		
													<td style="padding:9px;" onclick="my<?php echo $data['id_request'];?>()">
														<a id="bt<?php echo $data['id_request'];?>" style="border-radius: 15px;background-color: #459cff;" disabled
															href="#"> <i style="margin-left:5px;margin-right:5px;background-color:#459cff;" class="fa fa-plus"> </i> 
														</a>
														<a id="bt<?php echo $data['id_request'];?>1" style="border-radius: 15px;background-color: #ff4040;display:none" disabled
															href="#"> <i style="margin-left:5px;margin-right:5px;background-color:#ff4040;" class="fa fa-minus"> </i> 
														</a>
													</td>
													<td>
														<input class="check" style="width:20px;height:20px;" type="checkbox" name="ck_id_detail[]" value="<?php echo $data['id_request'];?>">
														<span class="lbl"></span>
													</td>
													<td ><?php echo $data['sales_pers']; ?></td>									
													<td ><?php echo $data['nama']; ?></td>									
													<td style="display:none;"><?php echo $data['no_request']; ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_ship']; ?></td>
													<td>
														<?php
															if($data['nama_transaksi']=="Penjualan"){
																echo "PO";
															}else if ($data['nama_transaksi']=="Tukar Guling"){
																echo "TG";
															}else{
																echo $data['nama_transaksi'];
															}  
														?>
													</td>
													<td>
														<?php 
															if($data['nama_product']=="FG Milk Botol 1 Liter"){
																echo "1 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 2 Liter"){
																echo "2 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 3 Liter"){
																echo "3 Ltr";
															}else{
																echo $data['nama_product']; 
															}
														?>
														<a style="border-radius: 25px;" 
															href="#" 
															onclick="detailPrd(<?php echo $data['id_request']; ?>)" data-toggle="modal" 
															data-target="#ModalDetailProduct"> Detail
														</a>
													</td>	
													<td><?php echo $data['qty']; ?></td>
													<td><?php echo $data['satuan']; ?></td>
													<td><?php echo $data['city']; ?></td>
													<td><?php echo $data['nama_cluster']; ?></td>
													<td><?php echo $data['alamat']; ?></td>							
													<td><?php echo $data['no_po']; ?></td>	
													<td>
														<?php
															echo $data['tanggal_request'];
															$date_3 = strtotime($data['tanggal_request']); 
															$dday3 = date("D", $date_3);
															echo " ("; echo strtoupper($dday3);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim2'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim3'];
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
															$date_4 = strtotime($data['tanggal_kirim']); 
															$dday4 = date("D", $date_4);
															echo " ("; echo strtoupper($dday4);  echo ") "; 
														?>
													</td>
													<td>
														<?php 
															if($data['tanggal_shipping']==null){
																echo "";
															}else{
																echo $data['tanggal_shipping'];
																$date_5 = strtotime($data['tanggal_shipping']); 
																$dday5 = date("D", $date_5);
																echo " ("; echo strtoupper($dday5);  echo ") "; 
															}
														?>
													</td>
													<td><?php echo $data['catatan']; ?></td>
													<td><?php echo $data['keterangan']; ?></td>
													<td><?php echo $data['description']; ?></td>
													<td><?php echo $data['nama_status_kirim']; ?></td>
													<td style="text-align:center;width:100px;">
														<a style="border-radius: 25px;" 
															href="#" class="btn btn-xs btn-primary" 
															data-id_request="<?php echo $data['id_request']?>" 
															onclick="contoh(<?php echo $data['id_request'];?>)"
															data-kode_customer="<?php echo $data['kode_cust_ship']?>" 
															data-id_detail_request="<?php echo $data['id_detail_request']?>" 
															data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
															data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
															data-pers_numb1="<?php echo $data['pers_numb']?>" 
															data-cust_ship="<?php echo $data['cust_ship']?>"
															data-tipe="<?php echo "edit"?>" 
															data-toggle="modal" 
															data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
														</a>
														<a style="border-radius: 25px;"
															href="#" class="btn btn-xs btn-danger" 
															onclick="contoh1(<?php echo $data['id_request']; ?>)"
															data-tipe="<?php echo "edit"?>" data-toggle="modal" 
															data-target="#ModalEditDetailProduct"><i class="fa fa-edit"></i> Edit Product
														</a>
													</td>
											</tr>
										<?php }?>
									<?php $no++; }?>	
								</tbody>	
							</table>
						</div>
						<div style="margin-bottom: 20px;" class="row">
								<div class="col-md-12 text-center">	
									<button id="execute_release" class="btn btn-ms btn-success text-center" style="margin-top:10px;border-radius:25px"><i class="fa fa-check"> </i> Release</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div id="myModal" class="modal fade" role="dialog">
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
	</div> -->
	<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update Data Customer Order</h4>
								</div>
								<div class="modal-body">
										<!-- <form  class="form-horizontal"  action="<?php echo base_url(); ?>Release_order/save" method="post"/>	
											<input id="tipe" type="hidden" name="tipe">
											<input id="id_shipping" type="hidden" name="id_shipping">
											<input id="id_request_ol" type="hidden" name="id_request">
											<input id="id_detail_request" type="hidden" name="id_detail_request">
											<input id="tanggal_mulai1" type="hidden" name="tanggal_mulai">
											<input id="tanggal_sampai1" type="hidden" name="tanggal_sampai">
											<input id="kode_shipping_point1" type="hidden" name="kode_shipping_point">
											<input id="nama_status_kirim1" type="hidden" name="nama_status_kirim">
											<input id="cust_ship" type="hidden" name="cust_ship">
											<table class="tbl_input">
												<tr>
													<td colspan="6">
														Shipping Point										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="id_shipping_point" style="width:50%;" class='select_customer' name="id_shipping_point" required>
																<?php echo $combo_shipping_point_id; ?>
															</select>					
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Sales Person
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="pers_numb1" style="width:50%;" class="select_customer" name="pers_numb1">
																<?php echo $combo_sales_person; ?>
															</select>						
														</div>
													</td>
												</tr>
												<tr>
													<td colspan="6">
														Delivery Date
													</td>
													<td colspan="6">
														<div class="input-group col-xs-6">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
															<input id="tgl3" style="width:60%;" class="form-control " type="text" name="tanggal_shipping" required>	
														</div>
													</td>
												</tr>
											</table>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button style="border-radius:25px" class="btn btn-ms btn-success">
														<i class="ace-icon fa fa-edit bigger-110"></i>
														Simpan
													</button>
													<button type="button" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												 </div>
											</div>					
										</form>			 -->
								</div>		   
						</div>
					</div>
	</div>	
	<div class="modal fade" id="ModalEditDetailProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" style="width: 100%;height: 100%;margin: 0;padding: 0;">
						<div style="border-radius:25px;height: auto;min-height: 100%;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update Product Detail Order</h4>
								</div>
								<div class="modal-body-edit">
								</div>	
								<div class="modal-footer" style="position: absolute; bottom: 0; width: 100%; border-radius:25px;">
                					<button style="border-radius:25px;" type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                				</div>	   
						</div>
					</div>
	</div>	
	<div class="modal fade" id="ModalDetailProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Detail Product</h4>
								</div>
								<div class="modal-body1">
								</div>		   
								<div class="modal-footer" style="border-radius:25px;">
                					<button style="border-radius:25px;" type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                				</div>
						</div>
					</div>
			</div>	