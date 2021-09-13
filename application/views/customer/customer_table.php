<html> 
	<div class="widget-box " id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
		</div> -->
		<div class="widget-body" id="AppsAll">
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<input type="hidden" name="id_customer" value="<?php echo $id_customer; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-12">
						<!--<a id="openMdodalAddCustomer" style=" margin-bottom: 10px;" -->
						<!--	href="#" class="btn btn-xs btn-primary" href="#"  -->
						<!--	data-id_customer="$id_customer" href="#" data-toggle="modal" -->
						<!--	data-target="#ModalInputCustomer"><i class="fa fa-plus"> </i> Tambah Customer-->
						<!--</a>-->
								<?php if($this->session->flashdata('error')) { ?>
									<div style="margin-bottom: 10px;"  class="alert alert-danger alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<?php echo $this->session->flashdata('error'); ?>
									</div> 
								<?php } else if ($this->session->flashdata('success')) {?>
									<div style="margin-bottom: 10px;" class="alert alert-success alert-dismissible fade in" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
										<?php echo $this->session->flashdata('success'); ?>
									</div> 
								<?php } ?>
					</div>
					<div class="col-md-12">
					    <!-- <div class="input-group col-xs-3 pull-right" style="margin-bottom:5px;margin-top:5px;">
							<input placeholder="Ketik nama customer.." id="myInput" onkeyup="myFunction()" style="width:100%;" class="form-control " type="text">	
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>					
						</div>  -->
        				<!--<table id="dataTables-example" width="100%"  class="table table-striped table-bordered table-hover">-->
        				<table width="100%" id="myTable" class="table table-striped table-bordered table-hover">
						<!--<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">-->
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;display:none;">date</th>	
									<th style="background: #22313F;color:#fff;">Kode Customer</th>	
									<!-- <th>Sales 1</th>	
									<th>Sales 2</th>	 -->
									<th style="background: #22313F;color:#fff;">Nama Customer</th>		
									<th style="background: #22313F;color:#fff;">Region</th>	
									<th style="background: #22313F;color:#fff;">Kota</th>	
									<th style="background: #22313F;color:#fff;">Cluster</th>
									<th style="background: #22313F;color:#fff;">Alamat</th>
									<th style="background: #22313F;color:#fff;">Shipping Point</th>
									<!-- <th style="background: #22313F;color:#fff;">Sales Person</th> -->
									<!-- <th style="background: #22313F;color:#fff;">Status</th> -->
									<th style="background: #22313F;color:#fff;">Actions</th>
								</tr> 
							</thead>
							<tbody>
								<?php
								$no = 1;
								//if($customer != "") {
								//	if(!empty($customer->result_array())) { 
										foreach($customer->result_array() as $data) { ?>
										<tr >
											<td style="display:none;"><?php echo $data['date_update']; ?></td>
											<td><?php echo $data['kode_customer']; ?></td>
											<td><?php echo $data['nama_customer']; ?></td>
											<td><?php echo $data['region_desc']; ?></td>
											<td><?php echo $data['city']; ?></td>
											<td><?php echo $data['nama_cluster']; ?></td>
											<td><?php echo $data['alamat']; ?></td>
											<td>
												<?php if($data['jml']==null){ 
													echo "Belum ada";?>
												<?php 
												}else{?>
												<?php if($data['jml']==""){ echo "0";}else{echo $data['jml'];} ?>
												<a href="#" 
													data-toggle="modal"
													data-target="#modalDetailShp" 
													onclick="contoh(<?php echo $data['kode_customer']; ?>)">
													Detail
												</a>
												<?php }?>
											</td>
											<!-- <td>
												<?php if($data['jml1']==null){ 
													echo "Belum ada";?>
												<?php 
												}else{?>
												<?php if($data['jml1']==""){ echo "0";}else{echo $data['jml1'];} ?>
												<a href="#" 
													data-toggle="modal"
													data-target="#modalDetailShp1" 
													onclick="contoh1(<?php echo $data['kode_customer']; ?>)">
													Detail
												</a>
												<?php }?>
											</td> -->
											<!-- <td><?php echo $data['nama_status']; ?></td> -->
											<!-- <td width="170"> -->
											<td >
												<a style="border-radius:25px" id="openModalAddCustomer" 
													href="#" class="label label-primary"   
													data-id_customer="<?php echo $data['id_customer']; ?>" 
													data-kode_customer="<?php echo $data['kode_customer']; ?>" 
													data-nama_customer="<?php echo $data['nama_customer']; ?>" 
													data-no_hp="<?php echo $data['no_hp']; ?>" 
													data-nama_usaha="<?php echo $data['nama_usaha']; ?>" 
													data-wilayah="<?php echo $data['id_wilayah']; ?>" 
													data-city="<?php echo $data['city']; ?>" 
													data-alamat="<?php echo $data['alamat']; ?>" 
													data-pers_numb1="<?php echo $data['pers_numb1']; ?>" 
													data-status_customer="<?php echo $data['id_status_customer']; ?>" 
													data-tipe="<?php echo "add"; ?>" 
													data-toggle="modal" 
													data-target="#ModalAddCustomer"><i class="fa fa-plus"> </i> Shipping Point
												</a>
												<!-- <a style="border-radius:25px" id="openModalAddCluster"
													href="#" class="label label-warning"   
													data-id_customer="<?php echo $data['id_customer']; ?>" 
													data-kode_customer="<?php echo $data['kode_customer']; ?>" 
													data-nama_customer="<?php echo $data['nama_customer']; ?>"  
													data-city="<?php echo $data['city']; ?>" 
													data-alamat="<?php echo $data['alamat']; ?>" 
													data-cluster_id="<?php echo $data['cluster_id']; ?>" 
													data-tipe="<?php echo "add"; ?>" 
													data-toggle="modal" 
													data-target="#ModalAddCluster"><i class="fa fa-edit"> </i> Update Cluster
												</a> -->
												<a onclick="contoh1(<?php echo $data['id_customer'];?>);" style="border-radius: 25px;background:rgba(0,0,0,0.2);"  
													href="#" class="label btn-warning" data-toggle="modal" data-tipe="add"
													data-target="#ModalAddCluster"><i class="fa fa-edit"> </i> Update Cluster
												</a>
												<!-- <a style="border-radius:25px"  
													href="#" class="label label-success"   
													onclick="contoh2(<?php echo $data['kode_customer']; ?>)"
													data-tipe="<?php echo "add"; ?>" 
													data-toggle="modal" 
													data-target="#ModalAddSalesPers"><i class="fa fa-plus"> </i> Sales Person
												</a> -->
											</td>
										</tr>
										<?php  	
											$no++; } 
									?>
							</tbody>							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="ModalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Shipping Point</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Customer/save" method="post"/>	
						<input id="tipe12" type="hidden" name="tipe" readonly>	
						<input id="id_customer12" type="hidden" name="id_customer" readonly>			
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kode Customer </label>
								<div class="col-sm-6">
									<input id="kode_customer12" <?php echo $color; ?> class="form-control " readonly type="text" name="kode_customer" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left">Nama Customer</label>
								<div class="col-sm-6">
									<input id="nama_customer12" <?php echo $color; ?> class="form-control " readonly type="text" name="nama_customer" >
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Kota </label>
								<div class="col-sm-6">
									<input id="city12" <?php echo $color; ?> class="form-control " readonly type="text" name="city">
								</div>
							</div>										
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Alamat </label>
								<div class="col-sm-6">
									<input id="alamat12" <?php echo $color; ?> class="form-control " readonly type="text" name="alamat">
								</div>
							</div>												
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Shipping Point </label>
								<div class="col-sm-6">
									<select id="shipping_point" class='select_kegiatan' style="width:100%;<?php echo $color; ?>" name="id_shipping_point">
										<?php echo $combo_shipping_point; ?>
									</select>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Material Group </label>
								<div class="col-sm-6">
									<select id="matgr" class='select_kegiatan' style="width:100%;" name="matgr">
										<?php echo $combo_material_group; ?>
									</select>
								</div>
							</div> -->
							<div style="border-radius:25px;" class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-12">
										<button type="submit" id="ChangeNext" style="border-radius:25px" class="btn btn-ms btn-success">
											<i class="ace-icon fa fa-edit bigger-110"></i>Simpan
										</button>
										<button type="botton" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
											<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
										</button>
										<!-- <?php echo $btn_nota; ?>
										<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
													<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
												</button> -->
									</div>
							</div>								
					</form>			
			</div>		   
        </div>
		</div>
	</div>
	<div class="modal fade" id="ModalAddCluster" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Cluster</h4>
            </div>
            <div class="modal-body-cluster">
            	 				
			</div>		   
        </div>
		</div>
	</div>
	<!-- <div class="modal fade" id="ModalEditCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px;" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Customer</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>customer/save" method="post"/>	
						<input id="tipe1" type="hidden" name="tipe" readonly>	
						<input id="id_customer1" type="hidden" name="id_customer" readonly>			
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Kode Customer </label>
								<div class="col-sm-9">
									<input id="kode_customer1" <?php echo $color; ?> class="form-control " type="text" name="kode_customer" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Nama Customer</label>
								<div class="col-sm-9">
									<input id="nama_customer1" <?php echo $color; ?> class="form-control " type="text" name="nama_customer" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Nomor HP </label>
								<div class="col-sm-9">
									<input id="no_hp1" <?php echo $color; ?> class="form-control " type="number" name="no_hp">
								</div>
							</div>		
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Nama Usaha </label>
								<div class="col-sm-9">
									<input id="nama_usaha1" <?php echo $color; ?> class="form-control " type="text" name="nama_usaha">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>
								<div class="col-sm-9">
									<select id="wilayah1" class='select_kegiatan' style="width:100%;<?php echo $color; ?>" name="id_wilayah">
										<?php echo $combo_wilayah; ?>
									</select>
								</div>
							</div>									
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Kota </label>
								<div class="col-sm-9">
									<input id="city1" <?php echo $color; ?> class="form-control " type="text" name="city">
								</div>
							</div>										
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Alamat </label>
								<div class="col-sm-9">
									<input id="alamat1" <?php echo $color; ?> class="form-control " type="text" name="alamat">
								</div>
							</div>	
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-left"> Status Customer </label>
								<div class="col-sm-9">
									<select id="status_customer1" class='select_kegiatan' style="width:100%;<?php echo $color; ?>" name="id_status_customer">
										<?php echo $combo_status_customer; ?>
									</select>
								</div>
							</div>			
							<div class="form-group">
							</div>
								<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-12">
										<button type="submit" style="border-radius:25px" class="btn btn-ms btn-success">
											<i class="ace-icon fa fa-edit bigger-110"></i>Simpan
										</button>
										<button type="botton" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
											<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
										</button>
											<?php echo $btn_nota; ?>
											<?php echo $btn_batal; ?>
											<button type="button" class="btn btn-standar" style="border-radius:25px;margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
										</div>
								</div>								
					</form>			
			</div>		   
        </div>
		</div>
	</div> -->
	<div id="modalDetailShp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Shipping Point</h4>
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
	<div id="modalDetailShp1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Sales Person</h4>
        </div>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-shp1">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>-->
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "DESC" ]]
			});
        });
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
				searching: true,
                "order": [[ 0, "DESC" ]]
			});
        });
		function contoh(x){
// 			var table = document.getElementById("dataTables-example");
// 			var count = x.parentNode.parentNode.rowIndex;
// 			var req_id = table.rows[count].cells[1].innerHTML;
			// var req_id = str.substring(0,4);
			var url = '<?php echo base_url('Customer/get_row/')?>'+x;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-shp').html(msg);
					}
			});
		}
		// function contoh1(x){
		// 	var url = '<?php echo base_url('Customer/get_row1/')?>'+x;
		// 	$.ajax({
		// 			type: 'get',
		// 			url: url,
		// 			success: function (msg) {
		// 				$('.modal-shp1').html(msg);
		// 			}
		// 	});
		// }
		function contoh1(x){ 
			console.log("nilai X = "+x);
			var url = '<?php echo base_url('Customer/get_cluster/')?>'+x;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-body-cluster').html(msg);
					}
			});
		}
		function contoh2(id_request){
			var url = '<?php echo base_url('Customer/get_row2/')?>'+id_request;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-bodya').html(msg);
					}
			});
		}
		function myFunction() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("myTable");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}       
			}
		}
		$(document).on('click','#ChangeNext',function(event){
			$("#ModalAddCustomer").modal('hide');
                // if(confirm("Are you sure changing status?")){
                    // event.preventDefault();
                    // var statusid = $(this).attr('data-id');
                    // $.ajax({
                    //     url     : 'dbo.php',
                    //     method  : 'POST',
                    //     data    : {statusid : statusid},
                    //     success : function(data)
                    //     {
					// 		$("#ModalAddCustomer").modal('hide');
                    //         $('#exampleone').DataTable().ajax.reload();
                    //     }
                    // });
                // }
                // else{
                //     return false;
                // }
            });
		// $(document).on("click", "#openModalAddCustomer", function () {
		// var id_customer = $(this).data('id_customer');
		// var tipe = $(this).data('tipe');
		// var kode_customer = $(this).data('kode_customer');
		// var nama_customer = $(this).data('nama_customer');
		// var no_hp = $(this).data('no_hp');
		// var nama_usaha = $(this).data('nama_usaha');
		// var wilayah = $(this).data('wilayah');
		// var city = $(this).data('city');
		// var alamat = $(this).data('alamat');
		// var pers_numb1 = $(this).data('pers_numb1');
		// var pers_numb2 = $(this).data('pers_numb2');
		// var status_customer = $(this).data('status_customer');
		// var mst_shipping_point = $(this).data('shipping_point');
		// $(".modal-body #kode_customer12").val( kode_customer );
		// $(".modal-body #nama_customer12").val( nama_customer );
		// $(".modal-body #no_hp12").val( no_hp );
		// $(".modal-body #nama_usaha12").val( nama_usaha );
		// $(".modal-body #wilayah12").val(wilayah).trigger('change');
		// $(".modal-body #city12").val(city).trigger('change');
		// $(".modal-body #alamat12").val(alamat).trigger('change');
		// $(".modal-body #pers_numb12").val(pers_numb1).trigger('change');
		// $(".modal-body #pers_numb22").val(pers_numb2).trigger('change');
		// $(".modal-body #status_customer12").val(status_customer).trigger('change');
		// $(".modal-body #shipping_point2").val(shipping_point).trigger('change');
		// $(".modal-body #id_customer12").val(id_customer).trigger('change');
		// $(".modal-body #tipe12").val(tipe).trigger('change');
		// });
    </script>
</html>