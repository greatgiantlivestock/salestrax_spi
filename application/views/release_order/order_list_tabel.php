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
										<th style="background: #22313F;color:#fff;"><input style="width:20px;height:20px;" type="checkbox" id="checkAll"/> All </th>															
										<th style="background: #22313F;color:#fff;">No. Salestrax</th>							
										<th style="display:none;background: #22313F;color:#fff;">Sold to Party</th>
										<th style="background: #22313F;color:#fff;"> Ship to Party </th>
										<th style="background: #22313F;color:#fff;"> Order Type </th>
										<th style="background: #22313F;color:#fff;">Produk</th>
										<th style="background: #22313F;color:#fff;">No. PO</th>	
										<th style="background: #22313F;color:#fff;">Tanggal PO</th>	
										<th style="background: #22313F;color:#fff;">Tanggal Kirim</th>	
										<th style="background: #22313F;color:#fff;">Shipping Point</th>																	
										<th style="background: #22313F;color:#fff;">Cluster</th>																	
										<th style="font-size:1;background: #22313F;color:#fff;"> Created By  </th>	
										<th style="background: #22313F;color:#fff;">Action</th>	
									</tr> 
								</thead>
								<tbody>
									<?php
									$no = 1;
									$jum_total = 0; 
									foreach($q_tarik_data->result_array() as $data) { ?>
										<?php if($data['id_shipping_point'] > 0 && $data['cluster_description']!=''){?>
											<tr style="background: #ADDAC3;">	
													<td>
														<input style="width:20px;height:20px;" class="check" type="checkbox" name="ck_id_detail[]" value="<?php echo $data['id_request'];?>">
														<span class="lbl"></span>
													</td>
													<td ><?php $id_sstx = (int)$data['id_request']+1000000000; echo $id_sstx ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['nama_transaksi']; ?></td>
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
													<td><?php echo $data['no_po']; ?></td>	
													<td>
														<?php
															echo $data['tanggal_po'];
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
														?>
													</td>
													<td>
													    <?php
													        if($data['description']=='Belum ada Shipping Point'){
													            echo '';
													        }else{
													            echo $data['description'];
													        }
													    ?>
													</td>
													<td ><?php echo $data['cluster_description']; ?></td>									
													<td ><?php echo $data['nama']; ?></td>	
													<td style="text-align:center;width:100px;">
														<a style="border-radius: 5px;" id="openModalEditShipping1"
															href="#" class="btn btn-xs btn-primary" 
															data-id_request="<?php echo $data['id_request']?>" 
															data-kode_customer="<?php echo $data['kode_customer']?>" 
															data-tanggal_kirim="<?php echo $data['tanggal_kirim']?>" 
															data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
															data-cust_ship="<?php echo $data['cust_sold']?>"
															data-tipe="<?php echo "edit"?>" 
															data-toggle="modal" 
															data-target="#ModalEditDetail1"><i class="fa fa-plus"></i>
														</a>
														<!-- <a style="border-radius: 5px;" 
															href="#" class="btn btn-xs btn-danger" 
															onclick="contoh1(<?php echo $data['id_request']; ?>)"
															data-tipe="<?php echo "edit"?>" data-toggle="modal" 
															data-target="#ModalEditDetailProduct"><i class="fa fa-edit"></i>
														</a> -->
													</td>
											</tr>
										<?php }else{ ?>
											<tr style="background: #FAAA17;">	
													</td>
													<td>
														<input class="check" style="width:20px;height:20px;" type="checkbox" name="ck_id_detail[]" value="<?php echo $data['id_request'];?>">
														<span class="lbl"></span>
													</td>
													<td ><?php $id_sstx = (int)$data['id_request']+1000000000; echo $id_sstx ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['nama_transaksi']; ?></td>
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
													<td><?php echo $data['no_po']; ?></td>
													<td>
														<?php
															echo $data['tanggal_po'];
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
														?>
													</td>
													<td>
													    <?php
													        if($data['description']=='Belum ada Shipping Point'){
													            echo '';
													        }else{
													            echo $data['description'];
													        }
													    ?>
													</td>
													<td ><?php echo $data['cluster_description']; ?></td>									
													<td ><?php echo $data['nama']; ?></td>									
													<td style="text-align:center;width:100px;">
														<a style="border-radius: 5px;" id="openModalEditShipping12"
															href="#" class="btn btn-xs btn-primary" 
															data-id_request="<?php echo $data['id_request']?>" 
															data-id_customer="<?php echo $data['id_customer']?>" 
															data-matgr="<?php echo $data['matgr']?>" 
															data-kode_customer="<?php echo $data['kode_customer']?>" 
															data-id_detail_request="<?php echo $data['id_detail_request']?>" 
															data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
															data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
															data-pers_numb1="<?php echo $data['pers_numb']?>" 
															data-cust_sold="<?php echo $data['cust_sold']?>"
															data-tipe="<?php echo "edit"?>" 
															data-toggle="modal" 
															data-target="#ModalEditDetail2"><i class="fa fa-plus"></i>
														</a>
														<!-- <a style="border-radius: 5px;"
															href="#" class="btn btn-xs btn-danger" 
															onclick="contoh1(<?php echo $data['id_request']; ?>)"
															data-tipe="<?php echo "edit"?>" data-toggle="modal" 
															data-target="#ModalEditDetailProduct"><i class="fa fa-edit"></i>
														</a> -->
													</td>
											</tr>
										<?php }?>
									<?php $no++; }?>	
								</tbody>	
							</table>
						</div>
						<div style="margin-bottom: 20px;" class="row">
								<div class="col-md-12 text-center">	
									<button id="execute_release" onClick="javascript: return confirm('Apakah data yang akan di-Release sudah dikoreksi?');" class="btn btn-ms btn-success text-center" style="margin-top:10px;border-radius:25px"><i class="fa fa-check"> </i> Release</button>
									
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ModalEditDetail1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update Data Customer Order</h4>
								</div>
								<div class="modal-body">
										 <form  action="<?php echo base_url(); ?>Release_order/save" method="post"/>	
											<input id="tipe" type="hidden" name="tipe">
											<input id="id_shipping" type="hidden" name="id_shipping">
											<input id="id_request_ol" type="hidden" name="id_request">
											<input id="id_detail_request" type="hidden" name="id_detail_request">
											<input id="tanggal_mulai1" type="hidden" name="tanggal_mulai">
											<input id="tanggal_sampai1" type="hidden" name="tanggal_sampai">
											<input id="kode_shipping_point1" type="hidden" name="kode_shipping_point">
											<input id="nama_status_kirim1" type="hidden" name="nama_status_kirim">
											<input id="cust_sold1" type="hidden" name="cust_sold">
											<input id="kode_customer1" type="hidden" name="kode_customer">
											<input id="matgr1" type="hidden" name="matgr">
											<table class="tbl_input">
												<tr>
													<td colspan="6">
														Customer										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<input style="width:70%;" id="nm_cust1">				
														</div>
													</td>
												</tr>
												<!-- <tr>
													<td colspan="6">
														Material Group										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="matgr11" disabled style="width:50%;" class='select_customer' required>
																<?php echo $combo_matgr; ?>
															</select>					
														</div>
													</td>
												</tr> -->
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
														Cluster
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="pers_numb1" style="width:50%;" class="select_customer" name="pers_numb1">
																<?php echo $combo_cluster; ?>
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
										</form>			 
								</div>		   
						</div>
					</div>
	</div>
	<div class="modal fade" id="ModalEditDetail2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update Data Customer Order</h4>
								</div>
								<div class="modal-body">
										 <form  class="form-horizontal"  action="<?php echo base_url(); ?>Release_order/save" method="post"/>	
											<input id="tipe2" type="hidden" name="tipe">
											<input id="id_shipping2" type="hidden" name="id_shipping">
											<input id="id_request_ol2" type="hidden" name="id_request">
											<input id="id_detail_request2" type="hidden" name="id_detail_request">
											<input id="tanggal_mulai12" type="hidden" name="tanggal_mulai">
											<input id="tanggal_sampai12" type="hidden" name="tanggal_sampai">
											<input id="kode_shipping_point12" type="hidden" name="kode_shipping_point">
											<input id="nama_status_kirim12" type="hidden" name="nama_status_kirim">
											<input id="cust_sold2" type="hidden" name="cust_sold">
											<input id="kode_customer2" type="hidden" name="kode_customer">
											<input id="matgr2" type="hidden" name="matgr">
											<table class="tbl_input">
												<tr>
													<td colspan="6">
														Customer										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<input style="width:70%;" id="nm_cust12">					
														</div>
													</td>
												</tr>
												<!-- <tr>
													<td colspan="6">
														Material Group										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="matgr21" disabled style="width:50%;" class='select_customer' required>
																<?php echo $combo_matgr; ?>
															</select>					
														</div>
													</td>
												</tr> -->
												<tr>
													<td colspan="6">
														Shipping Point										
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="id_shipping_point2" style="width:50%;" class='select_customer' name="id_shipping_point" required>
																<?php echo $combo_shipping_point_id; ?>
															</select>					
														</div>
													</td>
												</tr>
												<!-- <tr>
													<td colspan="6">
														Sales Person
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="pers_numb12" style="width:50%;" class="select_customer" name="pers_numb1">
																<?php echo $combo_sales_person; ?>
															</select>						
														</div>
													</td>
												</tr> -->
												<tr>
													<td colspan="6">
														Cluster
													</td>
													<td colspan="6">
														<div class="input-group col-xs-12">
															<select id="pers_numb2" style="width:50%;" class="select_customer" name="pers_numb12">
																<?php echo $combo_cluster; ?>
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
															<input id="tgl32" style="width:60%;" class="form-control " type="text" name="tanggal_shipping" required>	
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
										</form>			 
								</div>		   
						</div>
					</div>
	</div>	
	<div class="modal fade" id="ModalEditDetailProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" style="width: 100%;height: 100%;margin: 0;padding: 0;">
						<div style="border-radius:25px;height: auto;min-height: 100%;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Edit Product Detail Order</h4>
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
			
	<script type="text/javascript">
		$(document).ready(function () {
			$('a').on('click', function () {
				var image = $(this).attr('src');
				$('#myModal').on('show.bs.modal', function () {
					$(".img-responsive").attr("src", image);
				});
			});
			$('#ModalEditDetailProduct').on('hidden.bs.modal', function (event) {
                // Destroy modal
                $('#ModalEditDetailProduct').modal('dispose');
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
		function disable_f5(e){
          if ((e.which || e.keyCode) == 116){
              e.preventDefault();
          }
        }
        
        $(document).ready(function(){
            $(document).bind("keydown", disable_f5);    
        });
        $(document).keydown(function(e) {
        if (e.keyCode == 82 && e.ctrlKey) {
            e.preventDefault();
        }
    });
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
		<?php } ?>
    </script>