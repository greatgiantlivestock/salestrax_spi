<div class="widget-box"  id="widget-box-9" >

	<div class="widget-header">

		<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>

	</div>

	<div class="widget-body" id="AppsAll">

		<form class="form-horizontal"  action="<?php echo base_url(); ?>user/save" method="post" enctype="multipart/form-data">

			<input id="tipe" type="hidden" value="edit" name="tipe" readonly>	

			<input id="id_user" type="hidden" value="$id_user" name="id_user" readonly>			

					

			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

				<div class="col-sm-9">

					<select style="width:60%;" class='select_karyawan' name="id_karyawan">

						<?php echo $combo_karyawan; ?>

					</select>

				</div>

			</div>

							

			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

				<div class="col-sm-9">

					<input style="width:80%;" class="form-control" type="text" name="no_hp" >

				</div>

			</div>



			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

				<div class="col-sm-9">

					<select style="width:60%;" class='form-control' name="id_departemen">

						<?php echo $combo_departemen; ?>

					</select>

				</div>

			</div>		



			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right">Login Role Sebagai </label>

				<div class="col-sm-9">

					<select style="width:60%;" class="select_karyawan" name="id_role"/>

						<?php echo $combo_role; ?>

					</select>

				</div>

			</div>



			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>

				<div class="col-sm-9">

					<select class='select_kegiatan' style="width:60%;" name="id_wilayah">

						<?php echo $combo_wilayah; ?>

					</select>

				</div>

			</div>	



			<div class="form-group">

				<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>

				<div class="col-sm-9">

					<select class='select_kegiatan' style="width:60%;" name="description">

						<?php echo $combo_shipping_point_user; ?>

					</select>id_detail_request

				</div>

			</div>		

		</form>



	<div class="space-1"></div>

	<div class="row">

		<div class="col-md-12">

		<?php if($this->session->flashdata('success')) { ?>

			<div class="alert alert-success alert-dismissible fade in" role="alert">

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<?php echo $this->session->flashdata('success'); ?>

			</div> 

 		<?php }else if($this->session->flashdata('error')) { ?>

			<div class="alert alert-danger alert-dismissible fade in" role="alert">

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<?php echo $this->session->flashdata('error'); ?>

			</div> 

		<?php }?>

		 

			<a id="openModalAddDetail" style="margin-top: 10px; margin-bottom: 10px;" 

				href="#" class="btn btn-xs btn-primary" 

				data-toggle="modal" data-tipe="add"

				data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Shipping Point

			</a>

			

			<div class="col-md-12 text-left">

				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

					<thead>

						<tr>	

							<th style="background: #22313F;color:#fff;width:200px">No</th>	

							<th style="background: #22313F;color:#fff;width:200px">Shipping Point</th>	

							<th style="background: #22313F;color:#fff;width:50px">Aksi</th>

						</tr> 

					</thead>



					<tbody>

						<?php

						$no = 1; 

							foreach($shipping_point->result_array() as $data) { ?>

							<tr class="odd gradeX">

								<td><?php echo $no;?></td>

								<td><?php echo $data['description']; ?></td>

								<td>

									<a id="openModalEditDetail" href="#" class="label label-primary" 

										data-id_shipping_point_user="<?php echo $data['id_shipping_point']; ?>" 

										data-description="<?php echo $data['description']; ?>" 

										data-tipe="edit"

										data-toggle="modal" 

										data-target="#ModalAddShp">

										<i class="fa fa-edit"></i>

									</a> 

									<a href="<?php echo base_url().'SO_customer/hapus_detail/'.

									$data['id_trx_so_detail'].'/'.$data['id_request']; ?>" class="label label-danger" 

									onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"></i></a>

								</td>

							</tr>

							<?php  	

							$no++; } ?>

					</tbody>					

				</table>

				<table class="table table-striped table-bordered table-hover">

					<thead>

						<tr>

							<a style="margin-top: 10px;" class="btn btn-success" href="<?php echo base_url().'SO_customer'; ?>" >Selesai</a>

						</tr> 

					</thead>			

				</table>

						</div>

					</div>

				</div>

			</div>

		</div>

		<!--modal-->