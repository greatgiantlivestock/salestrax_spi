	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });
        });
		// function contoh(x){
		// 	var table = document.getElementById("dataTables-example");
		// 	var count = x.parentNode.parentNode.rowIndex;
		// 	var req_id = table.rows[count].cells[2].innerHTML;
		// 	var url = '<?php echo base_url('Sales/get_row/')?>'+req_id;
		// 	$.ajax({
		// 			type: 'get',
		// 			url: url,
		// 			success: function (msg) {
		// 				$('.modal-shp').html(msg);
		// 			}
		// 	});
		// }
    </script>
    <script>
	$(document).on("click", "#openModalEditSales1", function () {
				     var id = $(this).data('id');
				     var tipe = $(this).data('tipe');
				     var nama = $(this).data('nama');
				     var pers_numb = $(this).data('pers_numb');
				     var sales_pers = $(this).data('sales_pers');
				     var id_plant_group = $(this).data('id_plant_group');
				     $(".modal-body #kode_customer_sales_person").val( id );
				     $(".modal-body #tipe_sales").val( tipe );
				     $(".modal-body #pers_numb_sales").val( pers_numb );
				     $(".modal-body #nama_customer").val( nama );
				     $(".modal-body #sales_pers_sales").val( sales_pers );
				     $(".modal-body #id_plant_group_sales").val(id_plant_group).trigger('change');
				});
    </script>
    <script>
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
	</script>
<div id="widget-box-9"   >
	<div class="col-xs-12">
				<!--<a id="openModalAddDetail" style="border-radius:25px;margin-top: 10px; margin-bottom: 10px;" -->
				<!--			href="#" class="btn btn-xs btn-primary" href="#"  -->
				<!--			href="#" data-toggle="modal" -->
				<!--			data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Sales-->
				<!--</a>-->
				<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
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
				 <div class="input-group col-xs-3 pull-right" style="margin-bottom:5px;margin-top:5px;">
							<input placeholder="Ketik nama customer.." id="myInput" onkeyup="myFunction()" style="width:100%;" class="form-control " type="text">	
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>					
						</div> 
				<!--<table id="dataTables-example" width="100%"  class="table table-striped table-bordered table-hover">-->
				<table width="100%" id="myTable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<!-- <th>Id </th> -->
							<th style="background: #22313F;color:#fff;">Kode Customer</th>
							<th style="background: #22313F;color:#fff;">Nama Customer</th>
							<th style="background: #22313F;color:#fff;">Sales Person</th>
							<th style="background: #22313F;color:#fff;">Divisi</th>
							<th style="width:170px;background: #22313F;color:#fff;">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
		$no = 1;
		foreach($master_sales->result_array() as $data) { ?>
						<tr>
							<td><?php echo $data['kode_customer']; ?></td>
							<td><?php echo $data['nama_customer']; ?></td>
							<td><?php echo $data['sales_pers']; ?></td>
							<td>
								<?php if($data['plant_group_name']==''){echo "Belum Ditentukan";}else{echo $data['plant_group_name'];} ?>
							</td>
							<td style="text-align:center;width:100px;">
								<a id="openModalEditSales1" style="border-radius:25px"
									href="#" class="label label-primary"
									data-id="<?php echo $data['kode_customer']?>" 
									data-nama="<?php echo $data['nama_customer']?>" 
									data-id_plant_group="<?php echo $data['id_plant_group']?>" 
									data-pers_numb="<?php echo $data['pers_numb']?>" 
									data-sales_pers="<?php echo $data['sales_pers']?>" 
									data-tipe="<?php echo "edit"?>" 
									data-toggle="modal" 
									data-target="#ModalEditDetail"><i class="fa fa-edit"> </i> Edit
								</a>
								<!--<a id="openModalDeleteSales" style="border-radius:25px"-->
								<!--	href="#" class="label label-danger"  -->
								<!--	data-id="<?php echo $data['id_sales_person']?>" -->
								<!--	data-id_plant_group="<?php echo $data['id_plant_group']?>"-->
								<!--	data-pers_numb="<?php echo $data['pers_numb']?>" -->
								<!--	data-sales_pers="<?php echo $data['sales_pers']?>" -->
								<!--	data-tipe="<?php echo "hapus"?>" -->
								<!--	data-toggle="modal" -->
								<!--	data-target="#ModalDeleteDetail"><i class="fa fa-trash"></i> Hapus-->
								<!--</a>-->
							</td>
						</tr>
					<?php 	$no++; } ?>
					</tbody>
				</table>
			<!-- <div class="modal fade" id="ModalInputDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Tambah Sales</h4>
								</div>
								<div class="modal-body1">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Sales/save" method="post"/>	
											<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Person Number </label>
												<div class="col-sm-9">
													<input  type="text" Style="uppercase" name="pers_numb" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Sales Person </label>
												<div class="col-sm-9">
													<input  type="text" name="sales_pers" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Divisi </label>
												<div class="col-sm-9">
													<select class='select_kegiatan' name="id_plant_group">
														<?php echo $combo_plant_group; ?>
													</select>
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Simpan
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	 -->
			<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Edit Divisi Sales Person Per Customer</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Sales/save" method="post"/>
											<input id="tipe_sales" type="hidden" name="tipe">
											<input id="kode_customer_sales_person" type="hidden" name="kode_customer">
											<input id="pers_numb_sales" type="hidden" Style="uppercase" name="pers_numb" />
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Customer </label>
												<div class="col-sm-9">
													<input id="nama_customer" type="text" Style="uppercase" name="nama_customer" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Sales Person </label>
												<div class="col-sm-9">
													<input id="sales_pers_sales" type="text" name="sales_pers" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Divisi </label>
												<div class="col-sm-9">
													<select id="id_plant_group_sales" name="id_plant_group">
														<?php echo $combo_plant_group; ?>
													</select>
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button style="border-radius:25px;" class="btn btn-success">
														<i class="ace-icon fa fa-edit bigger-110"></i>
														Simpan
													</button>
													&nbsp; &nbsp; &nbsp;
													<button style="border-radius:25px;" type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
			<!-- <div class="modal fade" id="ModalDeleteDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Hapus Sales</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Sales/hapus" method="post"/>	
											<input id="tipe_sales1" type="hidden" name="tipe">
											<input id="id_sales1" type="hidden" name="id_sales_person">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Person Number </label>
												<div class="col-sm-9">
													<input id="pers_numb_sales1" type="text" Style="uppercase" name="pers_numb" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Sales Person </label>
												<div class="col-sm-9">
													<input id="sales_pers_sales1" type="text" name="sales_pers" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Divisi </label>
												<div class="col-sm-9">
													<select id="id_plant_group_sales1" class='select_kegiatan' name="id_plant_group">
														<?php echo $combo_plant_group; ?>
													</select>
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-danger">
														<i class="ace-icon fa fa-trash bigger-110"></i>
														Hapus
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	 -->
