	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
				iDisplayLength:20,
                "order": [[ 0, "desc" ]]
            });
        });
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
				iDisplayLength:20,
                "order": [[ 0, "desc" ]]
            });
        });
        function contoh1(x){
			var url = '<?php echo base_url('Shipping/get_row/')?>'+x;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-shp1').html(msg);
					}
			});
		}
        function contoh2(x){
			var url = '<?php echo base_url('Shipping/get_row1/')?>'+x;
			$.ajax({
					type: 'get',
					url: url,
					success: function (msg) {
						$('.modal-body-addcust').html(msg);
					}
			});
		}
		// function updateDiv(){ 
		// 		$( "#cluster_modal" ).load(window.location.href + " #cluster_modal" );
		// 	}
    </script>
<div id="widget-box-12"   >
		<!-- <div class="widget-header">
			<h5 class="widget-title">
				<i class="fa fa-truck"></i>
				<?php echo $judul; ?>
			</h5>
		</div> -->
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
		<div class="col-xs-7">
				<a id="openModalAddDetail" style="border-radius:10px; margin-top: 10px; margin-bottom: 10px;" 
					href="#" class="btn btn-xs btn-primary" href="#"  
					href="#" data-toggle="modal" 
					data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Cluster
				</a>
				<div class="input-group col-xs-3 pull-right" style="margin-bottom:5px;margin-top:5px;">
							<!-- <input placeholder="Cari cluster.." id="myInput" onkeyup="myFunction()" style="width:100%;" class="form-control " type="text">	 -->
							<!-- <span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>					 -->
						</div> 
				<table id="myTable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="60px" style="background: #22313F;color:#fff;">Id Cluster</th>
							<th style="background: #22313F;color:#fff;">Nama Cluster</th>
							<th style="background: #22313F;color:#fff;">Region</th>
							<th style="background: #22313F;color:#fff;">Jumlah Customer</th>
							<th style="width:170px;background: #22313F;color:#fff;">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
		$no = 1;
		foreach($master_cluster->result_array() as $data) { ?>
						<tr>
							<td><?php echo $data['cluster_id']; ?> </td>
							<td><?php echo $data['cluster_description']; ?></td>
							<td><?php echo $data['region_desc']; ?></td>
							<td style="text-align:center;width:90px;">
								<?php 	if($data['jml1']==null){ 
									echo "Belum ada";?>
									<?php 
										}else{?>
											<?php 
												if($data['jml1']=="0"){ 
													echo "0";
												}else{
													echo $data['jml1']; ?>
													<a href="#" 
														data-toggle="modal"
														data-target="#modalDetailShp1" 
														onclick="contoh1(<?php echo $data['cluster_id']; ?>)">
														Detail
													</a>
											<?php
												} ?>
									<?php }?>
							</td>
							<td style="text-align:center;width:300px;">
								<!-- <a style="border-radius:10px" id="openModalEditCCluster"
									href="#" class="label label-success"
									data-id="<?php echo $data['cluster_id']?>"
									data-desc="<?php echo $data['cluster_description']?>"
									data-region="<?php echo $data['region']?>"
									data-tipe="<?php echo "edit"?>"
									data-toggle="modal"
									data-target="#ModalEditDetail"><i class="fa fa-plus"> </i> Tambah Customer
								</a> -->
								<a onclick="contoh2(<?php echo $data['cluster_id'];?>);" style="border-radius: 25px;background:rgba(0,0,0,0.2);"  
									href="#" class="label btn-success" data-toggle="modal" data-tipe="add"
									data-target="#ModalEditDetail"><i class="fa fa-plus"> </i> Tambah Customer
								</a>
								<a style="border-radius:10px" id="openModalEditCluster"
									href="#" class="label label-primary"
									data-cluster_id="<?php echo $data['cluster_id']?>"
									data-cluster_description="<?php echo $data['cluster_description']?>"
									data-region="<?php echo $data['region']?>"
									data-tipe="<?php echo "edit"?>"
									data-toggle="modal"
									data-target="#ModalEditC"><i class="fa fa-edit"> </i> Edit
								</a>
								<a style="border-radius:10px" id="openModalDeleteCluster"
									href="#" class="label label-danger" 
									data-cluster_id="<?php echo $data['cluster_id']?>"
									data-cluster_description="<?php echo $data['cluster_description']?>"
									data-tipe="<?php echo "hapus"?>"
									data-toggle="modal"
									data-target="#ModalHapusC"><i class="fa fa-trash"></i> Hapus
								</a>
							</td>
						</tr>
					<?php 	$no++; } ?>
					</tbody>
				</table>
			<div class="modal fade" id="ModalInputDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Tambah Cluster</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/save_cluster" method="post"/>	
											<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Region </label>
												<div class="col-sm-9">
													<select class="select_customer1" name="region" required>
														<?php echo $combo_region; ?>
													</select>
												</div>
											</div>		
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Nama Cluster </label>
												<div class="col-sm-9">
													<input type="text" style="text-transform:uppercase" name="cluster_description" />
												</div>
											</div>		
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" style="border-radius:10px;">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Simpan
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
			<div id="modalDetailShp1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Detail Customer</h4>
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
			<div class="modal fade" id="ModalHapusC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Hapus Cluster</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/hapus_cluster" method="post"/>	
											<input id="cluster_idH" type="hidden" name="cluster_id">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Nama Cluster </label>
												<div class="col-sm-9">
													<input id="cluster_descH" type="text" name="cluster_description" />
												</div>
											</div>		
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-danger" style="border-radius:10px;">
														<i class="ace-icon fa fa-trash bigger-110"></i>
														Hapus
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
			<div class="modal fade" id="ModalEditC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Ubah Cluster</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/edit_cluster" method="post"/>	
											<input id="cluster_idE" type="hidden" name="cluster_id">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Region </label>
												<div class="col-sm-9">
													<select id="region_cluster" class="select_customer1" name="region" required>
														<?php echo $combo_region; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Nama Cluster </label>
												<div class="col-sm-9">
													<input id="cluster_descE" type="text" style="text-transform:uppercase" name="cluster_description" />
												</div>
											</div>		
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" style="border-radius:10px;">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Ubah
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
			<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Tambah Customer</h4>
								</div>
								<div class="modal-body-addcust">		
								</div>		   
						</div>
					</div>
			</div>	
		</div>
		<div class="col-xs-5">
				<a style="border-radius:10px; margin-top: 10px; margin-bottom: 10px;" 
					href="#" class="btn btn-xs btn-primary" href="#"  
					href="#" data-toggle="modal" 
					data-target="#ModalInputshp"><i class="fa fa-plus"> </i> Tambah Shipping Point
				</a>

			<table id="dataTables-example" width="100%"  class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="background: #22313F;color:#fff;">Kode Shipping Point </th>
					<th style="background: #22313F;color:#fff;">Shipping Point</th>
					<th style="background: #22313F;color:#fff;">Alias</th>
					<th style="background: #22313F;color:#fff;">Action</th>
				</tr>

			</thead>
			<tbody>
			<?php
				$no = 1;
			foreach($master_shipping_point->result_array() as $data) { ?>
				<tr>
					<td style="text-align:center;width:90px;"><?php echo $data['kode_shipping_point']; ?> </td>
					<td><?php echo $data['description']; ?></td>
					<td><?php echo $data['alias']; ?></td>
					<td style="text-align:center;width:170px;">
						<a style="border-radius:10px;" id="openModalEditShp" 	
							href="#" class="label label-primary"  
							data-id="<?php echo $data['id_shipping_point']?>" 
							data-kode="<?php echo $data['kode_shipping_point']?>" 
							data-desc="<?php echo $data['description']?>" 
							data-alias="<?php echo $data['alias']?>" 
							data-tipe="<?php echo "hapus"?>" 
							data-toggle="modal" 
							data-target="#ModalEditShp"><i class="fa fa-edit"> </i> Edit
						</a>
						<a style="border-radius:10px;" id="openModalDeleteShp"
							href="#" class="label label-danger"  
							data-id="<?php echo $data['id_shipping_point']?>" 
							data-kode="<?php echo $data['kode_shipping_point']?>" 
							data-desc="<?php echo $data['description']?>" 
							data-alias="<?php echo $data['alias']?>" 
							data-tipe="<?php echo "hapus"?>" 
							data-toggle="modal" 
							data-target="#ModalDeleteShp"><i class="fa fa-trash"></i> Hapus
						</a>
					</td>

				</tr>

			<?php 	$no++; } ?>
			</tbody>
		</table>	
		<div class="modal fade" id="ModalInputshp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Tambah Shipping Point</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/save_shp" method="post"/>	
											<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Kode Shipping Point </label>
												<div class="col-sm-8">
													<input type="text" style="text-transform:uppercase" name="kode_shipping_point" />
												</div>
											</div>		
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Nama Shipping Point </label>
												<div class="col-sm-8">
													<input type="text" name="description" />
												</div>
											</div>		
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Alias Shipping Point </label>
												<div class="col-sm-8">
													<input type="text" name="alias" />
												</div>
											</div>		
											<div class="clearfix form-actions">
												<div class="col-md-offset-4 col-md-8">
													<button class="btn btn-info" style="border-radius:10px;">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Simpan
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>
			<div class="modal fade" id="ModalDeleteShp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Hapus Shipping Point</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/hapusShp" method="post">	
											<input id="id_shp" type="hidden" name="id_shipping_point">
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Kode Shipping Point </label>
												<div class="col-sm-8">
													<input id="kodeShp" type="text" Style="uppercase" name="kode_shipping_point" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Nama Shipping Point  </label>
												<div class="col-sm-8">
													<input id="descShp" type="text" name="description" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Alias Shipping Point</label>
												<div class="col-sm-8">
													<input id="aliasShp" type="text" name="alias" />
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-danger" style="border-radius:10px;">
														<i class="ace-icon fa fa-trash bigger-110"></i>
														Hapus
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
			<div class="modal fade" id="ModalEditShp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Ubah Shipping Point</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping/editShp" method="post">	
											<input id="id_shpE" type="hidden" name="id_shipping_point">
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Kode Shipping Point </label>
												<div class="col-sm-8">
													<input id="kodeShpE" type="text" Style="uppercase" name="kode_shipping_point" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Nama Shipping Point  </label>
												<div class="col-sm-8">
													<input id="descShpE" type="text" name="description" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label no-padding-right"> Alias Shipping Point</label>
												<div class="col-sm-8">
													<input id="aliasShpE" type="text" name="alias" />
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn btn-info" style="border-radius:10px;">
														<i class="ace-icon fa fa-trash bigger-110"></i>
														Ubah
													</button>
													&nbsp; &nbsp; &nbsp;
													<button type="button" class="btn btn-standar" style="margin-left: 40px;border-radius:10px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
												</div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>	
		</div>	
