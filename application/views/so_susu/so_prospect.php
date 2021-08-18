<html>

	



<head>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>

	<script type="text/javascript">



	/*

	$(function(){

		$.ajaxSetup({

			type:"POST",

			url: "<?php echo base_url('processing/ambil_data') ?>",

			cache: false,

		});



		$("#provinsi").change(function(){

			var value=$(this).val();

			if(value>0){

				$.ajax({

					data:{modul:'kabupaten',id_karyawan:value},

					success: function(respond){

						$("#kabupaten-kota").html(respond);

					}

				})

			}

		});



		$("#kabupaten-kota").change(function(){

			var value=$(this).val();

			if(value>0){

				$.ajax({

					data:{modul:'kecamatan',id_kegiatan:value},

					success: function(respond){

						$("#kecamatan").html(respond);

					}

				})

			}

		})



		$("#no_rencana").change(function(){

			var value=$(this).val();

			if(value>0){

				$.ajax({

					data:{modul:'rencana',id_rencana_header:value},

					success: function(respond){

						//redirect("processing/index/".id_rencana_header);

						$("#AppsAll").html(respond);

					}

				})

			}

		})

	})

	*/



	</script>

</head>

	<div class="widget-box"  id="widget-box-9" >

		<div class="widget-header">

			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>

		</div>

		<div class="widget-body" id="AppsAll">

			<form class="form-horizontal"  action="<?php echo base_url(); ?>processing/save" method="post"/>

			

				

			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">

			<input type="hidden" name="id_request" value="<?php echo $id_request; ?>">

			<div class="widget-main">

				<div class="row">

					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td style="width:40%;">

									Customer

								</td>

								<td>

									<div class="input-group col-xs-12">

											<select id='kecamatan' class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="kode_customer">

												<?php echo $combo_customer; ?>

											</select>

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;">

									Tanggal Request

								</td>

								<td>

									<div class="input-group col-xs-12">

										<span class="input-group-addon">

											<i class="fa fa-calendar bigger-110"></i>

										</span>

										<input <?php echo $color; ?> id="tgl" readonly class="form-control " type="text" name="tanggal_request" value="<?php echo date("Y-m-d"); ?>">						

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;">

									NO HP

								</td>

								<td>

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> style="text-transform:uppercase" id="tgl" class="form-control " type="number" name="no_hp" value="<?php echo $no_hp; ?>" >						

									</div>

								</td>

							</tr>			

						</table>

					</div>

id_detail_request
id_detail_request
					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td style="width:40%;">

									No. Request

								</td>

								<td>

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> id="no_request" class="form-control " type="text" readonly name="no_request" value="<?php echo $no_request; ?>">

									</div>

								</td>

							</tr>		

						</table>

					</div>

				</div>

				<div class="row">

					<div class="col-md-12">

						<hr style="margin-top: 10px; margin-bottom: 10px;">

							<?php echo $btn_nota; ?>

							<a class="btn btn-xs btn-danger" <?php echo $disable; ?> href="<?php echo base_url().'processing/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus</a>								

						<hr/ style="margin-top: 10px; margin-bottom: 10px;">

					</div>

				</div>

			</form>



				<div class="space-1"></div>

				<div class="row">

					

					<div class="col-md-3">

						<div class="panel panel-default">

  							<div class="panel-body">

			            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>processing/save_detail" method="post"/>

									<input id="tipe" type="hidden" name="tipe" value="<?php echo $tipe_detail; ?>" readonly>	

									<input id="id_request" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>			

									

									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right">Nama Barang </label>



										<div class="col-sm-9">

											<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" <?php echo $disable; ?>>

										</div>

									</div>



									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right">Qty </label>



										<div class="col-sm-9">

											<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="number" name="qty" value="<?php echo $qty; ?>" value="<?php echo $qty; ?>" <?php echo $disable; ?>>

										</div>

									</div>

									

									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right"> Satuan </label>



										<div class="col-sm-9">

											<select id='kecamatan' class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="nama_satuan" <?php echo $disable; ?>>

												<?php echo $combo_satuan; ?>

											</select>

										</div>

									</div>		



									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>



										<div class="col-sm-9">

											<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="keterangan" value="<?php echo $keterangan; ?>" <?php echo $disable; ?>>

										</div>

									</div>										

									<div class="form-group text-center">

										<button class="btn btn-pink btn-xs" <?php echo $disable; ?>><?php echo $btn_name; ?></button>

										<?php echo $btn_batal_edit; ?>

									</div>

						  		</form>

							</div>

						</div>

					</div>



					<div class="col-md-9">

					<?php if($this->session->flashdata('error')) { ?>

                    <div class="alert alert-danger alert-dismissible fade in" role="alert">

                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                      <?php echo $this->session->flashdata('error'); ?>

                    </div> 

 					<?php } ?>

						<table class="table table-striped table-bordered table-hover">

							<thead>

								<tr>

									<th>Barang</th>	

									<th>Qty</th>

									<th>Unit</th>

									<th>Aksi</th>

								</tr> 

							</thead>



							<tbody>

								<?php

								$no = 1;

								if($request_detail != "") {

									if(!empty($request_detail->result_array())) { 

										foreach($request_detail->result_array() as $data) { ?>

										<tr>

											<td><?php echo $data['nama_barang']; ?></td>

											<td><?php echo $data['qty']; ?></td>

											<td><?php echo $data['satuan']; ?></td>

											<td>

												<a  class="label label-primary" href="<?php echo base_url().'processing/index/'.$data['id_request'].'/'.$data['id_trx_so_detail']; ?>" > Ubah</a>

												<a href="<?php echo base_url().'processing/hapus_detail/'.$data['id_trx_so_detail'].'/'.$data['id_request']; ?>" class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');"> Hapus</a>

											</td>

										</tr>

										<?php  	

											$no++; } 

									} else { ?>

									<tr>

										<td colspan="5"><center>Belum ada data</center></td>

									</tr>

									<?php	} 

									}

									?>

							</tbody>					

						</table>



						<table class="table table-striped table-bordered table-hover">

							<thead>

								<tr>

								<a  class="btn btn-success" href="<?php echo base_url().'processing'; ?>" >Selesai</a>

								</tr> 

							</thead>			

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

</html>