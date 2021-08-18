

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

		<!-- <div class="widget-header">

			<h5 class="widget-title">

				<i class="fa fa-truck"></i>

				<?php echo $judul; ?>

			</h5>

		</div> -->

	<div class="col-xs-12">

				<a id="openModalAddDetail" style="margin-top: 10px; margin-bottom: 10px;" 

							href="#" class="btn btn-xs btn-primary" href="#"  

							data-nomor_rencana="$nomor_rencana" data-id_rencana_header="$id_rencana_header" data-id_rencana_detail="$id_rencana_detail" 

							data-tanggal_rencana="$tanggal_rencana" data-tanggal_penetapan="tanggal_penetapan" tanggal-keterangan="$keterangan"

							href="#" data-toggle="modal" 

							data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Buat Pesan

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

							<th>Id Product</th>

							<th>Pembuat Pesan</th>

							<th>Pesan</th>

							<th>Tanggal Input</th>

							<th style="width:170px;">Action</th>

						</tr>

					</thead>



					<tbody>

<?php

		$no = 1;

		foreach($master_product->result_array() as $data) { ?>

						<tr>

							<td><?php echo $data['id_msg']; ?> </td>

							<td><?php echo $data['nama']; ?></td>

							<td><?php echo $data['msg']; ?></td>

							<td><?php echo $data['date_input']; ?></td>

							<td style="text-align:center;width:100px;">

								<a id="openModalDeleteProduct"

									href="#" class="label label-danger"  

									data-id_msg="<?php echo $data['id_msg']?>" 

									data-tipe="<?php echo "hapus"?>" 

									data-toggle="modal" 

									data-target="#ModalDeleteDetail"><i class="fa fa-trash"></i> Hapus

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

										<h4 class="modal-title" id="myModalLabel">Tambah Pesan pemnberitahuan</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Msg/save" method="post"/>	

											<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">

											<div class="form-group">

												<div class="col-sm-12">

													<textarea class ="col-sm-12" name="msg" placeholder="Ketik pesan anda disini..."></textarea>

												</div>

											</div>				

											

											<div class="clearfix form-actions">

												<div class="col-md-offset-3 col-md-9">

													<button class="btn btn-info">

														<i class="ace-icon fa fa-check bigger-110"></i>

														Simpan

													</button>



													&nbsp; &nbsp; &nbsp;

													<!--

														<a href="<?php echo base_url(); ?>Product" class="btn btn-danger" type="reset">

														<i class="ace-icon fa fa-undo bigger-110"></i>

														Batal

														</a>

													-->

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

										<h4 class="modal-title" id="myModalLabel">Edit Product</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Msg/save" method="post"/>	

											<input id="tipe" type="hidden" name="tipe">

											<input id="id_product" type="hidden" name="id_product">

											

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Kode Product </label>



												<div class="col-sm-9">

													<input id="kode_product" type="text" Style="uppercase" name="kode_product" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Nama Product </label>



												<div class="col-sm-9">

													<input id="nama_product" type="text" name="nama_product" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Satuan </label>



												<div class="col-sm-4">

													<select id="satuan" class="select_customer" name="id_satuan">

														<?php echo $combo_satuan; ?>

													</select>

												</div>

											</div>	



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Plant Group </label>



												<div class="col-sm-9">

													<select id="plant_group" class="select_customer" name="id_plant_group">

														<?php echo $combo_plant_group; ?>

													</select>

												</div>

											</div>

											

											<div class="clearfix form-actions">

												<div class="col-md-offset-3 col-md-9">

													<button class="btn btn-success">

														<i class="ace-icon fa fa-edit bigger-110"></i>

														Simpan

													</button>



													&nbsp; &nbsp; &nbsp;

													<!--

														<a href="<?php echo base_url(); ?>Product" class="btn btn-primary" type="reset">

														<i class="ace-icon fa fa-undo bigger-110"></i>

														Batal

														</a>

													-->

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

										<h4 class="modal-title" id="myModalLabel">Hapus Product</h4>

								</div>

								<div class="modal-body">

										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Msg/hapus" method="post"/>	

											<input id="tipe1" type="hidden" name="tipe">

											<input id="id_product1" type="hidden" name="id_product">

											

											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Kode Product </label>



												<div class="col-sm-9">

													<input id="kode_product1" type="text" Style="uppercase" name="kode_product" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Nama Product </label>



												<div class="col-sm-9">

													<input id="nama_product1" type="text" name="nama_product" />

												</div>

											</div>



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Satuan </label>



												<div class="col-sm-4">

													<select id="satuan1" class="select_customer" name="id_satuan">

														<?php echo $combo_satuan; ?>

													</select>

												</div>

											</div>	



											<div class="form-group">

												<label class="col-sm-3 control-label no-padding-right"> Plant Group </label>



												<div class="col-sm-9">

													<select id="plant_group1" class="select_customer" name="id_plant_group">

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

													<!--

														<a href="<?php echo base_url(); ?>Product" class="btn btn-primary" type="reset">

														<i class="ace-icon fa fa-undo bigger-110"></i>

														Batal

														</a>

													-->

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

