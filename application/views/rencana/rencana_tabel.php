<html>

	<?php

	$get_id = $this->db->query("SELECT trx_rencana_master.nomor_rencana FROM (SELECT MAX(id_rencana_header) AS id_rencana_header FROM trx_rencana_master) AS proses_lama

								JOIN trx_rencana_master ON proses_lama.id_rencana_header=trx_rencana_master.id_rencana_header")->row();

	if($get_id==''){

		$no_akhir = "0";

	}else{

		$no_akhir = $get_id->nomor_rencana;

	}

	$tanggal = "RCN.".date("ymd",strtotime(date("Y-m-d"))).".";  

	?> 



<head>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">

	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>

	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 

	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->

	<style>
		.ui-autocomplete-input {
		border: none; 
		font-size: 14px;
		width: 300px;
		height: 24px;
		margin-bottom: 5px;
		padding-top: 2px;
		border: 1px solid #DDD !important;
		padding-top: 0px !important;
		z-index: 1511;
		position: relative;
		}
		.ui-menu .ui-menu-item a {
		font-size: 12px;
		}
		.ui-autocomplete {
		position: absolute;
		top: 0;
		left: 0;
		z-index: 1510 !important;
		float: left;
		display: none;
		min-width: 160px;
		width: 160px;
		padding: 4px 0;
		margin: 2px 0 0 0;
		list-style: none;
		background-color: #ffffff;
		border-color: #ccc;
		border-color: rgba(0, 0, 0, 0.2);
		border-style: solid;
		border-width: 1px;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		border-radius: 2px;
		-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		-webkit-background-clip: padding-box;
		-moz-background-clip: padding;
		background-clip: padding-box;
		*border-right-width: 2px;
		*border-bottom-width: 2px;
		}
		.ui-menu-item > a.ui-corner-all {
			display: block;
			padding: 3px 15px;
			clear: both;
			font-weight: normal;
			line-height: 18px;
			color: #555555;
			white-space: nowrap;
			text-decoration: none;
		}
		.ui-state-hover, .ui-state-active {
			color: #ffffff;
			text-decoration: none;
			background-color: #0088cc;
			border-radius: 0px;
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			background-image: none;
		}
	</style>

	<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
	<!-- <script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script> -->
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
		    // $('#search_cus_ship').autocomplete({
            //     source: "<?php echo site_url('SO_customer/get_autocomplete');?>",
     
            //     select: function (event, ui) {
            //         $(this).val(ui.item.label);
            //         // $("#form_search").submit(); 
            //     }
            // });

		});
	</script>
	<script type="text/javascript">



	$(function(){

		$.ajaxSetup({

			type:"POST",

			url: "<?php echo base_url('Rencana/ambil_data') ?>",

			cache: false,

		});



		// $("#provinsi").change(function(){

		// 	var value=$(this).val();

		// 	if(value>0){

		// 		$.ajax({

		// 			data:{modul:'kabupaten',id_karyawan:value},

		// 			success: function(respond){

		// 				$("#kabupaten-kota").html(respond);

		// 			}

		// 		})

		// 	}

		// });



		// $("#kabupaten-kota").change(function(){

		// 	var value=$(this).val();

		// 	if(value>0){

		// 		$.ajax({

		// 			data:{modul:'kecamatan',id_kegiatan:value},

		// 			success: function(respond){

		// 				$("#kecamatan").html(respond);

		// 			}

		// 		})

		// 	}

		// })



		$("#no_rencana").change(function(){

			var value=$(this).val();

			if(value == 0 || value == ""){

				document.location.href="<?php echo base_url(); ?>Rencana";

			}else{

				document.location.href="<?php echo base_url(); ?>Rencana/index/"+value;

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

</head>

	<div class="widget-box" id="widget-box-9">

		<!-- <div class="widget-header">

			<h5 class="widget-title"><i class="fa fa-plus"> </i> <?php echo $judul; ?></h5>

		</div> -->

		<div class="widget-body" id="AppsAll">

			<form class="form-horizontal"  action="<?php echo base_url(); ?>Rencana/save" method="post"/>

			<?php if($tipe == "edit") { ?>		

				<input class="input-sm col-xs-6" type="hidden" name="nomor1" value="<?php echo $nomor_rencana; ?>" readonly>

			<?php } else { ?>

				<input class="input-sm col-xs-6" type="hidden" name="nomor1" value="<?php echo buatkode($no_akhir, $tanggal, 4); ?>" readonly>

			<?php } ?>

			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">

			<input type="hidden" name="id_rencana_header" value="<?php echo $id_rencana_header; ?>">

			<input type="hidden" name="nomor_rencana" value="<?php echo $nomor_rencana; ?>">

			<div class="widget-main">

				<div class="row">

					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td style="width:40%;">

									Tanggal Rencana

								</td>

								<td>

									<div class="input-group col-xs-12">

										<span class="input-group-addon">

											<i class="fa fa-calendar bigger-110"></i>

										</span>

										<input <?php echo $color; ?> class="form-control " type="date" name="tanggal_rencana" value="<?php echo $tanggal_rencana; ?>">						

									</div>

								</td>

							</tr>

							<!--<tr>-->

							<!--	<td style="width:40%;">-->

							<!--		Tanggal Penetapan-->

							<!--	</td>-->

							<!--	<td>-->

							<!--		<div class="input-group col-xs-12">-->

							<!--			<span class="input-group-addon">-->

							<!--				<i class="fa fa-calendar bigger-110"></i>-->

							<!--			</span>-->

							<!--			<input <?php echo $color; ?> id="tgl" class="form-control " type="date" name="tanggal_penetapan" value="<?php echo date("Y-m-d"); ?>">						-->

							<!--		</div>-->

							<!--	</td>-->

							<!--</tr>-->

							<tr>

								<td style="width:40%;">

									Keterangan

								</td>

								<td>

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> style="text-transform:uppercase" id="tgl" class="form-control " type="text" name="keterangan" value="<?php echo $keterangan; ?>">						

									</div>

								</td>

							</tr>			

						</table>

					</div>



					<div class="col-md-6">

						<table class="tbl_input">

							<tr>

								<td style="width:40%;">

								</td>

								<td>

									<div class="input-group col-xs-12">

										<input <?php echo $color; ?> id="tgl" class="form-control " type="hidden" readonly name="nomor_rencana" value="<?php echo $nomor_rencana; ?>">

									</div>

								</td>

							</tr>		

						</table>

					</div>

				</div>

				<div class="row">

					<div class="col-md-12">

						<hr style="margin-top: 10px; margin-bottom: 10px;">

							<?php if(!$id_rencana_header ==''){?>

								<?php if (!$qlock ==''){?>

									<?php if ($qlock->lock =='1'){?>

										<?php echo $btn_notax; ?>

										<a class="btn btn-xs btn-normal" style="border-radius: 25px;" <?php echo $disabled; ?> onclick="return confirm('Yakin ingin hapus data Master rencana ?');" href="<?php echo base_url().'Rencana/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus Semua</a>										

									<?php }else{?>

										<?php echo $btn_nota; ?>

										<a class="btn btn-xs btn-danger" style="border-radius: 25px;" <?php echo $disable; ?> onclick="return confirm('Yakin ingin hapus data Master rencana ?');" href="<?php echo base_url().'Rencana/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus Semua</a>					

									<?php }?>							

								<?php }else{ ?>					

									<?php echo $btn_nota; ?>

									<a class="btn btn-xs btn-danger" style="border-radius: 25px;" <?php echo $disable; ?> onclick="return confirm('Yakin ingin hapus data Master rencana ?');" href="<?php echo base_url().'Rencana/hapus/'.$this->uri->segment(3); ?>"><i class="fa fa-trash"> </i> Hapus Semua</a>					

								<?php } ?>

								<!-- <a class="btn btn-xs btn-success" <?php echo $disable; ?> 

									onclick="return confirm('Salin rencana harus menggunakan tanggal rencana yang baru, tetap lanjutkan?');" 

									href="<?php echo base_url().'Rencana/salin/'.$this->uri->segment(3); ?>"><i class="fa fa-copy"> </i> Salin

								</a> -->

								<a id="openModalCopyRencana" <?php echo $disable?>  

											href="#" class="btn btn-xs btn-success" style="border-radius: 25px;"

											data-id_rencana_header="<?php echo $id_rencana_header ?>" 

											data-toggle="modal" 

											data-target="#ModalCopyRencana"><i class="fa fa-copy"> </i> Salin

										</a>

							<?php } else {?>

								<?php echo $btn_nota; ?>

							<?php }?>							

						<hr style="margin-top: 10px; margin-bottom: 10px;">
    						<select id='no_rencana' style=" width:65%;font-weight: bold;font-size: 1.2em;" style="width:100%; <?php echo $color_edit; ?>" name="id_rencana_header">
    												<?php echo $combo_rencana; ?>
    						</select>

					</div>

				</div>

			</form>



				<div class="space-1"></div>

				<div class="row">



					<div class="col-md-12">

					<?php if($this->session->flashdata('error')) { ?>

                    <div class="alert alert-danger alert-dismissible fade in" role="alert">

                      <button type="button" class="close" data-dismiss="alert"  aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                      <?php echo $this->session->flashdata('error'); ?>

                    </div> 

 					<?php }else if($this->session->flashdata('success')) {?>

						<div class="alert alert-success alert-dismissible fade in" role="alert">

                      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      	</button>

                      	<?php echo $this->session->flashdata('success'); ?>

                    	</div>

					<?php }?>

						<?php if(!$id_rencana_header ==''){?>

								<?php if (!$qlock ==''){?>

									<?php if ($qlock->lock =='1'){?>

										<a id="openModalAddDetail" <?php echo $disabled?> style="margin-top: 10px; margin-bottom: 10px; border-radius: 25px;" 

											href="#" class="btn btn-xs btn-normal"

											data-nomor_rencana="<?php echo $nomor_rencana ?>" data-id_rencana_header="<?php echo $id_rencana_header ?>" 

											data-toggle="modal" 

											data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Detail

										</a>

									<?php }else{?>

										<a id="openModalAddDetail" <?php echo $disable?> style="margin-top: 10px; margin-bottom: 10px; border-radius: 25px;" 

											href="#" class="btn btn-xs btn-primary"

											data-nomor_rencana="<?php echo $nomor_rencana ?>" data-id_rencana_header="<?php echo $id_rencana_header ?>" 

											data-toggle="modal" 

											data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Detail

										</a>

									<?php }?>							

								<?php }else{ ?>					

									<a id="openModalAddDetail" <?php echo $disable?> style="margin-top: 10px; margin-bottom: 10px; border-radius: 25px;" 

										href="#" class="btn btn-xs btn-primary"

										data-nomor_rencana="<?php echo $nomor_rencana ?>" data-id_rencana_header="<?php echo $id_rencana_header ?>" 

										data-toggle="modal" 

										data-target="#ModalInputDetail"><i class="fa fa-plus"> </i> Tambah Detail

									</a>	

								<?php } ?>

						<?php }?>

						<table id="dataTables-example" class="table table-striped table-bordered table-hover">

							<thead>

								<tr>	

									<th style="display:none">Kegiatan</th>

									<th>Customer</th>

									<th >Status</th>

									<th ><center>Act<center></th>

								</tr> 

							</thead>



							<tbody>

								<?php

								$no = 1; 

										foreach($rencana_detail->result_array() as $data) { ?>

										<tr>

											<td style="display:none"><?php echo $data['nama_kegiatan']; ?></td>

											<td><?php echo $data['nama_customer']; ?></td>

											<td>

												<?php if($data['status_rencana']==0){

													echo "Baru";

												}else if($data['status_rencana']==1){

													echo "Checkin";

												}else if($data['status_rencana']==2){

													echo "Selesai";

												}?>

											</td>

											<td>

												<!--<a  class="label label-primary" href="<?php echo base_url().'Rencana/index/'.$data['id_rencana_header'].'/'.$data['id_rencana_detail']; ?>" ><i class="fa fa-edit"> </i> Ubah</a> |-->

												<?php if($data['lock']==0){?>

													<a href="<?php echo base_url().'Rencana/hapus_detail/'.$data['id_rencana_detail'].'/'.$data['id_rencana_header']; ?>" class="label label-danger" style="border-radius: 25px;" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"></i></a>

												<?php }else{?>

													<a <?php echo "disabled"?> href="#" class="label label-normal"><i class="fa fa-lock"> </i></a>

												<?php }?>

											</td>

										</tr>

										<?php  	

											$no++; } ?>

									

							</tbody>							

						</table>

						<?php if(!$id_rencana_header ==''){?>

								<?php if (!$qlock ==''){?>

									<?php if ($qlock->lock =='1'){?>

										<a  class="btn btn-xs btn-normal" <?php echo $disabled; ?> href="<?php echo base_url().'Rencana/selesai/'.$this->uri->segment(3); ?>"><i class="ace-icon fa fa-check"></i><span class="bigger-110">Selesai</span></a>

									<?php }else{?>

										<a class="btn btn-xs btn-success" style=" border-radius: 25px;" <?php echo $disable; ?> onclick="return confirm('Data yang disimpan tidak dapat dirubah kembali. Lanjutkan?');" href="<?php echo base_url().'Rencana/selesai/'.$this->uri->segment(3); ?>"><i class="ace-icon fa fa-check"></i><span class="bigger-110">Selesai</span></a>

									<?php }?>							

								<?php }?>					

						<?php }?>

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

                <h4 class="modal-title" id="myModalLabel">Customer yang Akan Dikunjungi</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Rencana/save_detail" method="post"/>	

						<input id="tipe" type="hidden" name="tipe" value="<?php echo $tipe_detail; ?>" readonly>	

						<input id="id_rencana_header" type="hidden" name="id_rencana_header" value="<?php echo $id_rencana_header; ?>" readonly>			

						<input id="nomor_rencana" type="hidden" name="nomor_rencana" value="<?php echo $nomor_rencana; ?>" readonly>

						

						<input id="id_rencana_detail" type="hidden" name="id_rencana_detail" value="<?php echo $id_rencana_detail; ?>" readonly>		

						<input id="tanggal_rencana" type="hidden" name="tanggal_rencana" value="<?php echo $tanggal_rencana; ?>" readonly>		

						<input id="tanggal_penetapan" type="hidden" name="tanggal_penetapan" value="<?php echo $tanggal_penetapan; ?>" readonly>		

						<input id="keterangan" type="hidden" name="keterangan" value="<?php echo $keterangan; ?>" readonly>				



						<!-- 

						<div class="form-group">

							<label class="col-sm-3 control-label no-padding-right">Kegiatan </label>



							<div class="col-sm-9">

								<select id='kabupaten-kota' class='select_kegiatan' style="width:100%;" name="id_kegiatan" >

									<?php echo $combo_kegiatan; ?>

								</select>

							</div>

						</div> -->

						

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Customer </label>

							<div class="col-sm-9">
								<input type="text" name="nama_customer" class="form-control" id="search_cus_sold" placeholder="ketik kata pencarian dan pilih dari list" style="75%;">
							</div>
						</div>	



						<?php if($this->session->userdata("id_role")==4){?>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Karyawan </label>



								<div class="col-sm-9">

									<select id='provinsi' class='select_karyawan' style="width:100%; " name="id_karyawan" >

										<?php echo $combo_karyawan; ?>

									</select>

								</div>

							</div>

						<?php }?>



						<!-- <div class="form-group">

							<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>



							<div class="col-sm-9">

							<input <?php echo $color; ?> style="text-transform:uppercase" id="tgl" class="form-control " type="text" name="keterangan_detail" value="<?php echo $keterangan_detail; ?>">

							</div>

						</div>										 -->

						<div class="form-group text-center">

							<button class="btn btn-pink btn-xs">Tambah Customer</button>

							<?php echo $btn_batal_edit; ?>

						</div>

					</form>			

			</div>		   

        </div>

    </div>

</div>



<div class="modal fade" id="ModalCopyRencana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Ubah Tanggal Renacana</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Rencana/salin" method="post"/>	

						<input id="id_rencana_header" type="hidden" name="id_rencana_header" value="<?php echo $id_rencana_header; ?>" readonly>				



						<div class="form-group">

							<label class="col-sm-3 control-label no-padding-right"> Tanggal Rencana </label>



							<div class="col-sm-9">

							<input required class="form-control " type="date" name="tanggal_rencana">

							</div>

						</div>																			

						<div class="form-group">

							<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>



							<div class="col-sm-9">

							<input required class="form-control" style="text-transform:uppercase" required type="text" name="keterangan">

							</div>

						</div>																			

						<div class="form-group text-center">

							<button class="btn btn-success btn-xs">Salin Rencana</button>

							<?php echo $btn_batal_edit; ?>

						</div>

					</form>			

			</div>		   

        </div>

    </div>

</div>

</html>