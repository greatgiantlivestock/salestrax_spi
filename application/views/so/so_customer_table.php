<style type="text/css">
    body {
        margin: 0;
        padding: 0;
    }
    .img {
        background: #ffffff;
        padding: 12px;
        border: 1px solid #999999;
    }
    .shiva {
        -moz-user-select: none;
        background: #2A49A5;
        border: 1px solid #082783;
        box-shadow: 0 1px #4C6BC7 inset;
        color: white;
        padding: 3px 5px;
        text-decoration: none;
        text-shadow: 0 -1px 0 #082783;
        font: 12px Verdana, sans-serif;
    }
	pre {
		display: block;
		font-family: Verdana;
		white-space: pre;
		margin: 0;
		padding: 0;
	}
	@keyframes blinkrainbow{
		0%{color:#FF0000}
		56%{color: #0000FF}
		70%{color:#4B0082}
		84%{color:#8B00FF}
		100%{color:#FF0000}
	}
	@-webkit-keyframes blinkrainbow{
		0%{color:#FF0000}
		56%{color: #0000FF}
		70%{color:#4B0082}
		84%{color:#8B00FF}
		100%{color:#FF0000}
	}
	.blinkrainbow{
		-webkit-animation:blinkrainbow 2s linear infinite;
		-moz-animation:blinkrainbow 2s linear infinite;
		animation:blinkrainbow 2s linear infinite
	}
	
</style>
<head>
	<!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"> -->
	<!-- <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script> -->
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#search_cus_sold').autocomplete({
                source: "<?php echo site_url('SO_customer/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    // $("#form_search").submit(); 
                }
            });
		    $('#search_cus_ship').autocomplete({
                source: "<?php echo site_url('SO_customer/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    // $("#form_search").submit(); 
                }
            });
		});
	</script>
	<script type="text/javascript">
		$(function(){
			$.ajaxSetup({
				type:"POST",
				url: "<?php echo base_url('SO_customer/ambil_data') ?>",
				cache: false,
			});
			$("#customer").change(function(){
				var value=$(this).val();
				if(value !=""){
					$.ajax({
						data:{modul:'customer_pilih',kode_customer:value},
						success: function(respond){
							$("#alamat").val(respond);
						}
					})
				}
			});
			$("#no_rencana").change(function(){
				var value=$(this).val();
				if(value==0 || value==""){
					document.location.href="<?php echo base_url(); ?>SO_customer";
				}else{
					document.location.href="<?php echo base_url(); ?>SO_customer/index/"+value;
				}
			})
		})
	</script>
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
				"dom":'<"toolbar">frtip',
				columns: [
					null,
					null,
					null,
					null,
					null,
					null,
					null
				],
                responsive: true,
				bPaginate: true,
				bLengthChange: false,
				bFilter: true,
				bInfo: false,
				bAutoWidth: false,
                order: [[ 0, "desc" ]]
            
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
</head>
	<div class="widget-box"  id="widget-box-9" style="no-padding-bottom">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
		</div>-->
		<div class="widget-header">
		<!-- <span class="blinkrainbow"><i class="fa fa-exclamation-triangle"> </i> <?php echo $msg; ?> <i class="fa fa-exclamation-triangle"> </i></span> -->
			<!-- <h5 class="widget-title"> 
				<span class="blinkrainbow"> 
					<i class="fa fa-exclamation-triangle"> </i>  
					<i class="fa fa-exclamation-triangle"> </i>
				</span>
			</h5> -->
		</div>
		<div>
			<?php if($this->session->flashdata('error')) { ?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<?php echo $this->session->flashdata('error'); ?>
		</div> 
		<?php } ?>
		</div>
		<div class="widget-body" id="AppsAll">
			<form class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/save" method="post" enctype="multipart/form-data">
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<input type="hidden" name="id_request" value="<?php echo $id_request; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-6">
						<table class="tbl_input">
							<tr>
								<td>
									<div class="input-group col-xs-12">
                                            <?php if(
                                                $this->session->userdata("username")=="wulan"||$this->session->userdata("username")=="admin.alsut"
												|| $this->session->userdata("username")=="admin.bonanza" || $this->session->userdata("username")=="admin.kmy"
												||$this->session->userdata("username")=="fenda" || $this->session->userdata("username")=="admin.kacs"
												||$this->session->userdata("username")=="lim.khim"
                                            ){?>
    											<select class="select_customer" id='no_rencana' style="width:100%;<?php echo $color_edit; ?>" name="nomor_order">
    												<?php echo $combo_nomor_order; ?>
    											</select>
    										<?php }else{?>
    										    <select id='no_rencana' class="select_customer" style="width:100%;<?php echo $color_edit; ?>" name="nomor_order">
    												<?php echo $combo_nomor_order; ?>
    											</select>
    										<?php }?>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>				
				<div class="row">
					<div class="col-md-6">
						<table class="tbl_input">
							<tr>
								<td style="width:40%;" colspan="2">
									Customer / Outlet
									<input type="text" name="id_customer_ship" value="<?php echo $id_customer_ship; ?>" class="form-control" id="search_cus_ship" placeholder="Ketik sebagian nama customer dan pilih dari list yang muncul.." style="75%;">
								</td>
							</tr>
							<tr>
								<td style="width:40%;" colspan="2">
									Tanggal Rencana Kirim
									<input style="width:37%;" <?php echo $color; ?> type="date"  class="form-control " name="tanggal_kirim" value="<?php echo $tanggal_kirim; ?>"required>						
								</td>
							</tr>
							<tr>
								<td style="width:40%;" colspan="2">
									No. PO
									
									<input <?php echo $color; ?> style="text-transform:uppercase" placeholder="Ketik Nomor PO Jika Ada" class="form-control " name="no_po" value="<?php echo $no_po; ?>" >						
								</td>
							</tr>	
							<tr>
								<td style="width:40%;" colspan="2">
									Catatan
									
									<input <?php echo $color; ?> style="text-transform:uppercase" placeholder="Ketik Catatan Jika Ada" class="form-control " name="catatan" value="<?php echo $catatan; ?>" >						
								</td>
							</tr>
							<tr>
								<td style="width:40%;" colspan="2">
									Upload File PO (Gambar atau Pdf)
									<input <?php echo $color; ?>  class="form-control" type="file" name="file_upload" value="<?php echo $title; ?>"  >
								</td>
							</tr>								
							<?php if($title!=null){ ?>
								<tr>
									<td style="width:40%;">
										File PO
										<input <?php echo $color; ?>  class="form-control "  value="<?php echo $title; ?>"  >						
									</td>
								</tr>
							<?php } ?>
									<!-- <tr>
										<td style="width:40%;" colspan="2">
											Sisa Stock Customer Hari ini (Khusus Produk Susu di Modern Market) :
										</td>
									</tr>	
									<tr class="spacer">
										<td style="width:10%;">
											<b>Hometown 1 L</b>
										</td>
									</tr>	
									<tr class="spacer">
										<td>
											<div class="input-group col-xs-11">
												<input <?php echo $color; ?> class="form-control " name="h1" value="<?php echo $h1; ?>" >						
											</div>
										</td>
										<td>
											<div class="input-group col-xs-12">
												<input <?php echo $color; ?> placeholder="Detail Exp H1" class="form-control " name="r1" value="<?php echo $r1; ?>" >						
											</div>
										</td>
									</tr>	
									<tr>	
										<td style="width:10%;">
											<b>Hometown 2 L</b>
										</td>
									</tr>	
									<tr>
										<td>
											<div class="input-group col-xs-11">
												<input <?php echo $color; ?> class="form-control " name="h2" value="<?php echo $h2; ?>" >						
											</div>
										</td>
										<td>
											<div class="input-group col-xs-12">
												<input <?php echo $color; ?> placeholder="Detail Exp H2" class="form-control " name="r2" value="<?php echo $r2; ?>" >						
											</div>
										</td>
									</tr>
									<tr>	
										<td style="width:10%;">
											<b>Hometown 3 L</b>
										</td>
									</tr>
									<tr>
										<td>
											<div class="input-group col-xs-11">
												<input <?php echo $color; ?> class="form-control " name="h3" value="<?php echo $h3; ?>" >						
											</div>
										</td>
										<td>
											<div class="input-group col-xs-12">
												<input <?php echo $color; ?> placeholder="Detail Exp H3" class="form-control " name="r3" value="<?php echo $r3; ?>" >						
											</div>
										</td>
									</tr>	 -->
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr style="margin-top: 10px; margin-bottom: 3px;">
							<?php echo $btn_nota; ?>
	
							<?php if(!$id_request==''){?>
								<?php if($this->session->userdata("id_role")==4 || $this->session->userdata("id_role")==5 || $this->session->userdata("username")=="wulan" || $this->session->userdata("username")=="lim.khim" || $this->session->userdata("username")=="sartika"){?>
									<a class="btn btn-xs btn-danger" style="border-radius: 25px;background:rgba(0,0,0,0.2);" <?php echo $disable; ?> onclick="return confirm('Hapus data Request?');" href="<?php echo base_url().'SO_customer/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus</a>
								<?php }?>
								<?php if($this->session->userdata("nama_karyawan")=="WULAN ANJAR SARI" || $this->session->userdata("nama_karyawan")=="LIM KHIM" || $this->session->userdata("nama_karyawan")=="SALES GGL" || $this->session->userdata("nama_karyawan")=="SARTIKA"){?>
									<a id="openModalCopyRencana" style="border-radius: 25px;background:rgba(0,0,0,0.2);" <?php echo $disable?>  
										href="#" class="btn btn-xs btn-success"
										data-id_request="<?php echo $id_request ?>" 
										data-toggle="modal" 
										data-target="#ModalCopyRencana"><i class="fa fa-copy"> </i> Salin
									</a>
									<a id="openModalDuplicateRencana" <?php echo $disable?>  
										href="#" class="btn btn-xs btn-warning" style="border-radius: 25px;background:rgba(0,0,0,0.2);" 
										data-toggle="modal" 
										data-target="#ModalduplicateRencana"><i class="fa fa-paste"> </i> Gandakan
									</a>
								<?php }?>
							<?php }?>								
						<hr style="margin-top: 3px; margin-bottom: 10px;">
					</div>
				</div>
			</form>
				<div class="space-1"></div>
				<div class="row"> 
					<div class="col-md-12">
					 	<a id="openModalAddDetail" style="border-radius: 25px;background:rgba(0,0,0,0.2);" <?php echo $disable?>  
							href="#" class="btn btn-xs btn-primary" 
							data-nomor_rencana="$nomor_rencana" data-id_customer="<?php echo $id_customer?>" data-id_rencana_header="$id_rencana_header" data-id_rencana_detail="$id_rencana_detail" 
							data-tanggal_rencana="$tanggal_rencana" data-tanggal_penetapan="tanggal_penetapan" tanggal-keterangan="$keterangan"
						    data-toggle="modal" data-tipe="add"
							data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Detail
						</a>
						<div class="col-md-12 text-left">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='100'>
								<thead>
									<tr>	
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;no-padding;color:#fff;">    Trx    </pre></th>	
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">          Produk          </pre></th>	
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">  Qty  </pre></th>
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Unit</pre></th>
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Dikirim dari</pre></th>
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Ket</pre></th>
										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Aksi</pre></th>
									</tr> 
								</thead>
								<tbody>
									<?php
									$no = 1; 
											foreach($request_detail->result_array() as $data) { ?>
											<tr class="odd gradeX">
												<td><?php echo $data['nama_transaksi']; ?><i class="glyphicon glyphicon-chevron-down"></i></td>
												<td><?php echo $data['nama_product']; ?></td>
												<td><?php echo $data['qty']; ?></td>
												<td><?php echo $data['nama_satuan']; ?></td>
												<td><?php echo $data['description']; ?></td>
												<td><?php echo $data['keterangan']; ?></td>
												<td>
													<a style="border-radius:25px;" id="openModalEditDetail" href="#" class="label label-primary" 
														data-id_detail_request="<?php echo $data['id_detail_request']; ?>" 
														data-id_jenis_transaksi="<?php echo $data['id_jenis_transaksi']; ?>" 
														data-id_shipping_point="<?php echo $data['id_shipping_point']; ?>" 
														data-satuan="<?php echo $data['satuan']; ?>" 
														data-id_product="<?php echo $data['id_product']; ?>" 
														data-qty="<?php echo $data['qty']; ?>" 
														data-keterangan="<?php echo $data['keterangan']; ?>" 
														data-tipe="edit"
														data-toggle="modal" 
														data-target="#ModalEditDetail">
													<i class="fa fa-edit"></i></a> 
                                                    <?php if($this->session->userdata("username")=="wulan" || $this->session->userdata("username")=="lim.khim" || $this->session->userdata("username")=="sartika" || $this->session->userdata("id_role")==4){?>
													    <a style="border-radius:25px;" href="<?php echo base_url().'SO_customer/hapus_detail/'.$data['id_detail_request'].'/'.$data['id_request']; ?>" class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"></i></a> 
                                                    <?php }?>
												</td>
											</tr>
											<?php  	
												$no++; } ?>
								</tbody>					
							</table>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
									<a <?php echo $disable; ?> class="btn btn-xs btn-success" style="border-radius: 25px;background:rgba(0,0,0,0.2);" href="<?php echo base_url().'SO_customer'; ?>" >Selesai</a>
									</tr> 
								</thead>			
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- <div class="modal fade" id="ModalInputDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
		<div class="modal fade" id="ModalInputDetail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px;" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/save_detail" method="post"/>	
						<input id="tipe" type="hidden" name="tipe" readonly>	
						<input id="id_request" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>			
							
							<script type="text/javascript">
								$(function(){
									$.ajaxSetup({
										type:"POST",
										url: "<?php echo base_url('SO_customer/ambil_data') ?>",
										cache: false,
									});
									// $("#product").change(function(){
									// 	var value=$(this).val();
									// 	var id_customer=$('#id_customer_so').val();
									// 	console.log("Message here",id_customer);
									// 	if(value !=""){
									// 		$.ajax({
									// 			data:{modul:'pilih_satuan',id_product:value},
									// 			success: function(respond){
									// 				$("#satuan").val(respond);
									// 			}
									// 		})
									// 		$.ajax({
									// 			data:{modul:'plant_group',id_product:value,id_customer:id_customer},
									// 			success: function(respond){
									// 				$("#shipping_point").html(respond);
									// 			}
									// 		})
									// 	}
									// });
									// $("#product").change(function(){
									// 	var value=$(this).val();
									// 	if(value !=""){
									// 		$.ajax({
									// 			data:{modul:'pilih_satuan',id_product:value},
									// 			success: function(respond){
									// 				$("#satuan").val(respond);
									// 			}
									// 		})
									// 		$.ajax({
									// 			data:{modul:'plant_group',id_product:value},
									// 			success: function(respond){
									// 				$("#shipping_point").html(respond);
									// 			}
									// 		})
									// 		$.ajax({
									// 			data:{modul:'plant_group',id_product:value,id_customer:id_customer},
									// 			success: function(respond){
									// 				$("#shipping_point").html(respond);
									// 			}
									// 		})
									// 	}
									// });
								})
							</script>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Jenis Transaksi </label>
								<div class="col-sm-6">
								<?php 
									$username = $this->session->userdata("username");
									
									if($username == "wulan" || $username == "sartika" || $username == "lim.khim" ||$username=="admin.kmy"||$username=="sales.ggl"){?>
										<select id="jenis_transaksi" class="select_customer" style="width:100%;<?php echo $color_edit; ?>" name="id_jenis_transaksi" <?php echo $disable; ?>>
											<?php echo $combo_jenis_transaksi; ?>
										</select>
									<?php }else{ ?>
										<select id="jenis_transaksi" class="select_customer" style="width:100%;<?php echo $color_edit; ?>" name="id_jenis_transaksi" <?php echo $disable; ?>>
											<?php echo $combo_jenis_transaksi; ?>
										</select>
									<?php }?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Produk</label>
								<div class="col-sm-6">
									<?php 
										$username = $this->session->userdata("username");
									
										if($username == "wulan" || $username == "sartika" || $username == "lim.khim" ||$username=="admin.kmy"||$username=="sales.ggl"){?>
										<select id="product" style="width:100%;<?php echo $color_edit; ?>" name="id_product">
											<?php echo $combo_product; ?>
										</select>
									<?php }else {?>
										<select id="product" class="select_customer1" style="width:100%;<?php echo $color_edit; ?>" name="id_product">
											<?php echo $combo_product; ?>
										</select>
									<?php }?>
								</div>
							</div>
							<div class="form-group" style="display: none">
								<label class="col-sm-3 control-label no-padding-right"> Satuan </label>
								<div class="col-sm-6">
									<input id="satuan" <?php echo $color; ?> style="text-transform:uppercase" class="form-control "  
									name="satuan" readonly>
								</div>
							</div>		
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Qty </label>
								<div class="col-sm-6">
									<input id="qty" class="form-control " type="text" name="qty" <?php echo $color; ?>/>
									<input id="id_customer_so" class="form-control " type="hidden" name="id_customer_dt" <?php echo $color; ?>/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Dikirim dari</label>
								<div class="col-sm-6">
									<select id="shipping_point" class="select_customer2" style="width:100%;<?php echo $color_edit; ?>" name="id_shipping_point">
										<?php echo $combo_shipping_point; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>
								<div class="col-sm-6">
									<input id="keterangan" <?php echo $color; ?> class="form-control " type="text" name="keterangan" <?php echo $disable; ?>>
								</div>
							</div>										
							<div class="form-group text-center">
								<button style="border-radius: 25px;background:rgba(0,0,0,0.2);"  class="btn btn-success btn-xs" <?php echo $disable; ?>><?php echo $btn_name; ?></button>
								<?php echo $btn_batal_edit; ?>
							</div>				
					</form>			
			</div>		   
        </div>
    </div>
	</div>
	<!-- <div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
	<div class="modal fade" id="ModalEditDetail"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/save_detail" method="post"/>	
						<input id="tipe1" type="hidden" name="tipe" readonly>	
						<input id="id_request1" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>			
						<input id="id_detail_request1" type="hidden" name="id_detail_request" readonly>			
							
							<script type="text/javascript">
								$(function(){
									$.ajaxSetup({
										type:"POST",
										url: "<?php echo base_url('SO_customer/ambil_data') ?>",
										cache: false,
									});
									// $("#product1").change(function(){
									// 	var value=$(this).val();
									// 	if(value !=""){
									// 		$.ajax({
									// 			data:{modul:'pilih_satuan',id_product:value},
									// 			success: function(respond){
									// 				$("#satuan").val(respond);
									// 			}
									// 		})
									// 		$.ajax({
									// 			data:{modul:'plant_group',id_product:value},
									// 			success: function(respond){
									// 				$("#id_shipping_point").html(respond);
									// 			}
									// 		})
									// 	}
									// });
								})
							</script>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Jenis Transaksi </label>
								<div class="col-sm-9">
									<select id="jenis_transaksi1" style="width:100%;<?php echo $color_edit; ?>" name="id_jenis_transaksi" <?php echo $disable; ?>>
										<?php echo $combo_jenis_transaksi; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Produk</label>
								<div class="col-sm-9">
									<!-- <select id="product1" class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="id_product">
										<?php echo $combo_product; ?>
									</select> -->
									<?php 
										$username = $this->session->userdata("username");
									
										if($username == "wulan"){?>
										<select id="product1" class="select_customer" style="width:100%;<?php echo $color_edit; ?>" name="id_product">
											<?php echo $combo_product; ?>
										</select>
									<?php }else {?>
										<select id="product1" style="width:100%;<?php echo $color_edit; ?>" name="id_product">
											<?php echo $combo_product; ?>
										</select>
									<?php }?>
								</div>
							</div>
							<div class="form-group" >
								<label class="col-sm-3 control-label no-padding-right"> Satuan </label>
								<div class="col-sm-9">
									<input id="satuan1" <?php echo $color; ?> style="text-transform:uppercase" class="form-control "  
									name="satuan" readonly>
								</div>
							</div>		
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Qty </label>
								<div class="col-sm-9">
									<input id="qty1" class="form-control " type="text" name="qty" <?php echo $color; ?>/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Dikirim dari</label>
								<div class="col-sm-6">
									<select id="id_shipping_point" style="width:100%;<?php echo $color_edit; ?>" name="id_shipping_point">
										<?php echo $combo_shipping_point; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>
								<div class="col-sm-9">
									<input id="keterangan1" <?php echo $color; ?> class="form-control " type="text" name="keterangan" <?php echo $disable; ?>>
								</div>
							</div>										
							<div class="form-group text-center">
								<button class="btn btn-success btn-xs" <?php echo $disable; ?>><?php echo $btn_name; ?></button>
								<?php echo $btn_batal_edit; ?>
							</div>				
					</form>			
			</div>		   
        </div>
		</div>
	</div>
	<!-- <div class="modal fade" id="ModalCopyRencana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
	<div class="modal fade" id="ModalCopyRencana" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Copy Data Order</h4>
			</div>
			<div class="modal-body">
					<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/salin" method="post"/>	
						<input type="hidden" name="id_requestCopy" value="<?php echo $id_request; ?>" readonly>				
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Rencana Kirim </label>
							<div class="col-sm-9">
							<input required class="form-control " type="date" name="tanggal_rencanaCopy">
							</div>
						</div>																			
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> No. PO </label>
							<div class="col-sm-9">
							<input  class="form-control" style="text-transform:uppercase"  type="text" name="no_poCopy">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Catatan </label>
							<div class="col-sm-9">
							<input  class="form-control" style="text-transform:uppercase"  type="text" name="keteranganCopy">
							</div>
						</div>																		
						<div class="form-group text-center">
							<button class="btn btn-success btn-xs">Salin Data Order</button>
							<?php echo $btn_batal_edit; ?>
						</div>
					</form>			
			</div>		   
		</div>
	</div>
	</div>
	<!-- <div class="modal fade" id="ModalduplicateRencana"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
	<div class="modal fade" id="ModalduplicateRencana"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Gandakan Data Order</h4>
			</div>
			<div class="modal-body">
					<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_customer/duplicate" method="post"/>	
						<input type="hidden" name="id_requestDuplicate" value="<?php echo $id_request; ?>" readonly>				
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Gandakan Sebanyak </label>
							<div class="col-sm-9">
							<input required class="form-control " type="number" name="jml_duplicate">
							</div>
						</div>																																				
						<div class="form-group text-center">
							<button class="btn btn-success btn-xs">Gandakan</button>
							<?php echo $btn_batal_edit; ?>
						</div>
					</form>			
			</div>		   
		</div>
	</div>
	</div>