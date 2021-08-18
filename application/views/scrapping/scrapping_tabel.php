<style type="text/css">

    body {

        margin: 0;

        padding: 0;

    }

d

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

</style>

<html>

<head>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>

	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 

	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->

	<script type="text/javascript">

	$(function(){

		$.ajaxSetup({

			type:"POST",

			url: "<?php echo base_url('Scrapping/ambil_data') ?>",

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

				document.location.href="<?php echo base_url(); ?>Scrapping";

			}else{

				document.location.href="<?php echo base_url(); ?>Scrapping/index/"+value;

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

		<div class="widget-body" id="AppsAll">

			<form class="form-horizontal"  action="<?php echo base_url(); ?>Scrapping/save" method="post" enctype="multipart/form-data">

			

			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">

			<input type="hidden" name="id_request" value="<?php echo $id_request; ?>">

			<div class="widget-main">

				<div class="row">

					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td>

									<div class="input-group col-xs-12">

											<select class='select_customer' id='no_rencana' style="width:100%;<?php echo $color_edit; ?>" name="nomor_order">

												<?php echo $combo_nomor_order; ?>

											</select>

									</div>

								</td>

							</tr>

						<!--	<tr>

								<td class="center">

									Or

								</td>

							</tr>	-->	

						</table>

					</div>

				</div>				



				<div class="row">

					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td style="width:40%;" colspan="2">

									Dikirim dari

								</td>

							</tr>

							<tr>

								<td colspan="2">

									<div class="input-group col-xs-12">

											<select  class='select_customer' style="width:75%;<?php echo $color_edit; ?>" name="id_customer_sold">

												<?php echo $combo_sold; ?>

											</select>

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;" colspan="2">

									Dikirim Untuk

								</td>

							</tr>

							<tr>

								<td colspan="2">

									<div class="input-group col-xs-12">

											<select  class='select_customer' style="width:75%;<?php echo $color_edit; ?>" name="id_customer_ship">

												<?php echo $combo_ship; ?>

											</select>

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;" colspan="2">

									Tanggal Pengiriman 

								</td>

							</tr>

							<tr>

								<td colspan="2">

									<div class="input-group col-xs-12">

										<span class="input-group-addon">

											<i class="fa fa-calendar bigger-110"></i>

										</span>

										<input style="width:35%;" <?php echo $color; ?> id="tgl2"  class="form-control " name="tanggal_kirim" value="<?php echo $tanggal_kirim; ?>"required>						

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;" colspan="2">

									No. Document

								</td>

							</tr>	

							<tr>		

								<td colspan="2">

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " name="no_po" value="<?php echo $no_po; ?>" >						

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;" colspan="2">

									Catatan 

								</td>

							</tr>	

							<tr>		

								<td colspan="2">

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " name="catatan" value="<?php echo $catatan; ?>" >						

									</div>

								</td>

							</tr>

							<tr>

								<td style="width:40%;" colspan="2">

									Upload File (Gambar atau Pdf)

								</td>

							</tr>	

							<tr>		

								<td colspan="2" >

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?>  class="form-control " type="file" name="file_upload" value="<?php echo $title; ?>"  >						

									</div>

								</td>

							</tr>

							<?php if($title!=null){?>

								<tr>

									<td style="width:40%;">

										Document

									</td>

								</tr>

								<tr>

									<td>

										<div class="input-group col-xs-12">

											<input <?php echo $color; ?>  class="form-control "  value="<?php echo $title; ?>"  >						

										</div>

									</td>

								</tr>

							<?php }?>

						</table>

					</div>

				</div>

				<div class="row">

					<div class="col-md-12">

						<hr style="margin-top: 10px; margin-bottom: 10px;">

							<?php echo $btn_nota; ?>

							<a class="btn btn-xs btn-danger" <?php echo $disable; ?> onclick="return confirm('Hapus data Request?');" href="<?php echo base_url().'Scrapping/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus</a>								

						<hr style="margin-top: 10px; margin-bottom: 10px;">

					</div>

				</div>

			</form>



				<div class="space-1"></div>

				<div class="row">

					<div class="col-md-12">

					<?php if($this->session->flashdata('error')) { ?>

                    <div class="alert alert-danger alert-dismissible fade in" role="alert">

                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                      <?php echo $this->session->flashdata('error'); ?>

                    </div> 

 					<?php } ?>

					 	<a id="openModalAddDetail" <?php echo $disable?> style="margin-top: 10px; margin-bottom: 10px;" 

							href="#" class="btn btn-xs btn-primary" 

							data-nomor_rencana="$nomor_rencana" data-id_rencana_header="$id_rencana_header" data-id_rencana_detail="$id_rencana_detail" 

							data-tanggal_rencana="$tanggal_rencana" data-tanggal_penetapan="tanggal_penetapan" tanggal-keterangan="$keterangan"

						    data-toggle="modal" data-tipe="add"

							data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Detail

						</a>

						<div class="col-md-12 text-left">

							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='100'>

								<thead>

									<tr>	

										<!-- <th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;no-padding;color:#fff;">    Trx    </pre></th>	 -->

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">          Produk          </pre></th>	

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">  Qty  </pre></th>

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">  Batch  </pre></th>

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Unit</pre></th>

										<!-- <th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Dikirim dari</pre></th> -->

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Ket</pre></th>

										<th style="background: #22313F;color:#fff;"><pre style="border:0px;background: #22313F;color:#fff;">Aksi</pre></th>

									</tr> 

								</thead>



								<tbody>

									<?php

									$no = 1; 

											foreach($request_detail->result_array() as $data) { ?>

											<tr class="odd gradeX">

												<!-- <td><?php echo $data['nama_transaksi']; ?><i class="glyphicon glyphicon-chevron-down"></i></td> -->

												<td><?php echo $data['nama_product']; ?></td>

												<td><?php echo $data['qty']; ?></td>

												<td><?php echo $data['batch']; ?></td>

												<td><?php echo $data['nama_satuan']; ?></td>

												<!-- <td><?php echo $data['description']; ?></td> -->

												<td><?php echo $data['keterangan']; ?></td>

												<td>

													<a id="openModalEditDetail" href="#" class="label label-primary" 

														data-id_detail_request="<?php echo $data['id_detail_request']; ?>" 

														data-batch="<?php echo $data['batch']; ?>" 

														data-satuan="<?php echo $data['satuan']; ?>" 

														data-id_product="<?php echo $data['id_product']; ?>" 

														data-qty="<?php echo $data['qty']; ?>" 

														data-keterangan="<?php echo $data['keterangan']; ?>" 

														data-tipe="edit"

														data-toggle="modal" 

														data-target="#ModalEditDetail">

													<i class="fa fa-edit"></i></a> 

													<a href="<?php echo base_url().'Scrapping/hapus_detail/'.$data['id_detail_request'].'/'.$data['id_request']; ?>" class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"></i></a>

												</td>

											</tr>

											<?php  	

												$no++; } ?>

								</tbody>					

							</table>

							<table class="table table-striped table-bordered table-hover">

								<thead>

									<tr>

									<a style="margin-top: 10px;" <?php echo $disable; ?> class="btn btn-success" href="<?php echo base_url().'Scrapping'; ?>" >Selesai</a>

									</tr> 

								</thead>			

							</table>

						</div>

					</div>

				</div>

			</div>

		</div>

		

		<div class="modal fade" id="ModalInputDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Detail Scrapping</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Scrapping/save_detail" method="post"/>	

						<input id="tipe" type="hidden" name="tipe" readonly>	

						<input id="id_request" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>			

							

							<script type="text/javascript">

								$(function(){

									$.ajaxSetup({

										type:"POST",

										url: "<?php echo base_url('Scrapping/ambil_data') ?>",

										cache: false,

									});



									$("#product").change(function(){

										var value=$(this).val();

										if(value !=""){

											$.ajax({

												data:{modul:'pilih_satuan',id_product:value},

												success: function(respond){

													$("#satuan").val(respond);

												}

											})



											$.ajax({

												data:{modul:'plant_group',id_product:value},

												success: function(respond){

													$("#shipping_point").html(respond);

												}

											})

										}

									});

								})

							</script>

							

							<!-- <div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Jenis Transaksi </label>

								<div class="col-sm-6">

									<select id="jenis_transaksi" style="width:100%;<?php echo $color_edit; ?>" name="id_jenis_transaksi" <?php echo $disable; ?>>

										<?php echo $combo_jenis_transaksi; ?>

									</select>

								</div>

							</div> -->

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Produk</label>

								<div class="col-sm-6">

									<select id="product" class="select_kegiatan" style="width:100%;<?php echo $color_edit; ?>" name="id_product">

										<?php echo $combo_product; ?>

									</select>

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Satuan </label>

								<div class="col-sm-6">

									<input id="satuan" <?php echo $color; ?> style="text-transform:uppercase" class="form-control "  

									name="satuan" readonly>

								</div>

							</div>		



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Qty </label>

								<div class="col-sm-6">

									<input id="qty" class="form-control " type="text" name="qty" >

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Batch </label>

								<div class="col-sm-6">

									<input class="form-control " name="batch" />

								</div>

							</div>



							<!-- <div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Dikirim dari</label>

								<div class="col-sm-6">

									<select id="shipping_point"  style="width:100%;<?php echo $color_edit; ?>" name="id_shipping_point">

										<?php echo $combo_shipping_point; ?>

									</select>

								</div>

							</div> -->



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>

								<div class="col-sm-6">

									<input id="keterangan" class="form-control " type="text" name="keterangan" <?php echo $disable; ?>>

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



	<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Detail Scrapping</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Scrapping/save_detail" method="post"/>	

						<input id="tipe1" type="hidden" name="tipe" readonly>	

						<input id="id_request1" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>			

						<input id="id_detail_request1" type="hidden" name="id_detail_request" readonly>			

							

							<script type="text/javascript">

								$(function(){

									$.ajaxSetup({

										type:"POST",

										url: "<?php echo base_url('Scrapping/ambil_data') ?>",

										cache: false,

									});



									$("#product").change(function(){

										var value=$(this).val();

										if(value !=""){

											$.ajax({

												data:{modul:'pilih_satuan',id_product:value},

												success: function(respond){

													$("#satuan").val(respond);

												}

											})

										}

									});

								})

							</script>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Jenis Transaksi </label>

								<div class="col-sm-9">

									<select id="jenis_transaksi1" class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="id_jenis_transaksi" <?php echo $disable; ?>>

										<?php echo $combo_jenis_transaksi; ?>

									</select>

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Produk</label>

								<div class="col-sm-9">

									<select id="product1" class='select_kegiatan' style="width:100%;<?php echo $color_edit; ?>" name="id_product">

										<?php echo $combo_product; ?>

									</select>

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Satuan </label>

								<div class="col-sm-6">

									<input id="satuan1" <?php echo $color; ?> style="text-transform:uppercase" class="form-control "  

									name="satuan" readonly>

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Batch </label>

								<div class="col-sm-9">

									<input id="batch1" type="date" <?php echo $color; ?> style="text-transform:uppercase" class="form-control "  

									name="batch">

								</div>

							</div>		



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Qty </label>

								<div class="col-sm-9">

									<input id="qty1" class="form-control " type="text" name="qty" <?php echo $color; ?>/>

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

	</div

</html>