

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

    </script>

<div id="widget-box-9"   >

	<div class="col-xs-12">

				<a id="openModalAddDetail" style="margin-top: 10px; margin-bottom: 10px;" 

							href="#" class="btn btn-xs btn-primary" href="#"  
							href="#" data-toggle="modal" 
							data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Shipping Point

				</a>

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

				<table id="dataTables-example" width="100%"  class="table table-striped table-bordered table-hover">

					<thead>
						<tr>
							<th>Kode Shipping Point </th>
							<th>Shipping Point</th>
							<th>Alias</th>
							<th>Plant Group</th>
							<th style="width:170px;">Action</th>
						</tr>

					</thead>

					<tbody>

<?php

		$no = 1;

		foreach($master_shipping_point->result_array() as $data) { ?>
						<tr>
							<td><?php echo $data['kode_shipping_point']; ?> </td>
							<td><?php echo $data['description']; ?></td>
							<td><?php echo $data['alias']; ?></td>
							<td><?php echo $data['plant_group_name']; ?></td>
							<td style="text-align:center;width:100px;">

								<!-- <a id="openModalEditSales" 
									href="#" class="label label-primary"
									data-id="<?php echo $data['id']?>" 
									data-pers_numb="<?php echo $data['pers_numb']?>" 
									data-sales_pers="<?php echo $data['sales_pers']?>" 
									data-tipe="<?php echo "edit"?>" 
									data-toggle="modal" 
									data-target="#ModalEditDetail"><i class="fa fa-edit"> </i> Edit

								</a>

								<a id="openModalDeleteSales"
									href="#" class="label label-danger"  
									data-id="<?php echo $data['id']?>" 
									data-pers_numb="<?php echo $data['pers_numb']?>" 
									data-sales_pers="<?php echo $data['sales_pers']?>" 
									data-tipe="<?php echo "hapus"?>" 
									data-toggle="modal" 
									data-target="#ModalDeleteDetail"><i class="fa fa-trash"></i> Hapus
								</a> -->

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

										<h4 class="modal-title" id="myModalLabel">Tambah Sales</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping_point/save" method="post"/>	

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

			</div>	



			<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

					<div class="modal-dialog">

						<div class="modal-content">

								<div class="modal-header">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

										<h4 class="modal-title" id="myModalLabel">Edit Sales</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping_point/save" method="post"/>	

											<input id="tipe" type="hidden" name="tipe">

											<input id="id_product" type="hidden" name="id_product">

											

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Person Number </label>



												<div class="col-sm-9">

													<input id="pers_numb" type="text" Style="uppercase" name="pers_numb" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Sales Person </label>



												<div class="col-sm-9">

													<input id="sales_pers" type="text" name="sales_pers" />

												</div>

											</div>

											<div class="clearfix form-actions">

												<div class="col-md-offset-3 col-md-9">

													<button class="btn btn-success">

														<i class="ace-icon fa fa-edit bigger-110"></i>

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

			</div>	



			<div class="modal fade" id="ModalDeleteDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

					<div class="modal-dialog">

						<div class="modal-content">

								<div class="modal-header">

										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

										<h4 class="modal-title" id="myModalLabel">Hapus Sales</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Shipping_point/hapus" method="post"/>	

											<input id="tipe1" type="hidden" name="tipe">

											<input id="id_product1" type="hidden" name="id_product">

											

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Person Number </label>



												<div class="col-sm-9">

													<input id="pers_numb1" type="text" Style="uppercase" name="pers_numb" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Sales Person </label>



												<div class="col-sm-9">

													<input id="sales_pers1" type="text" name="sales_pers" />

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

			</div>	

