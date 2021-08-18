

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

	<script type="text/javascript">

		$(function(){

			$.ajaxSetup({

				type:"POST",

				url: "<?php echo base_url('user/ambil_data') ?>",

				cache: false,

			});

			$("#nama_karyawan_list").change(function(){

				var value=$(this).val();

				if(value>0){

					$.ajax({

						data:{

							modul:'departemen',id_karyawan:value

						},

						success: function(respond){

							$("#nama_departemen_list").html(respond);

						}

					})

				}

			});



			$("#nama_karyawan_list").change(function(){

				var value=$(this).val();

				if(value>0){

					$.ajax({

						data:{

							modul:'no_hp',id_karyawan:value

						},

						success: function(respond){

							$("#no_hp_list").val(respond);

						}

					})

				}

			});



			// $('#view_detail').click(function() {

			// 	var req_id = $(this).attr('req_id');

			// 	//console.lg(req_id);

			// 	console.log(req_id);

			// 	var url = '<?php echo base_url('user/get_row/')?>'+req_id;

			// 	$.ajax({

			// 		type: 'get',

			// 		url: url,

			// 		success: function (msg) {

			// 			$('.modal-body').html(msg);

			// 		}

			// 	});

			// });



		})



		function contoh(x){

			var table = document.getElementById("dataTables-example");

			var count = x.parentNode.parentNode.rowIndex;

			var str = table.rows[count].cells[0].innerHTML;

			var req_id = str.substring(0,4);



			//console.log(str.substring(0,4));

			var url = '<?php echo base_url('user/get_row/')?>'+req_id;

			$.ajax({

					type: 'get',

					url: url,

					success: function (msg) {

						$('.modal-shp').html(msg);

					}

			});

		}

	</script>



<div>					    

	<div class="widget-box" id="widget-box-9">

		<div class="widget-header">

			<h5 class="widget-title">

				<i class="fa fa-truck"></i>

				<?php echo $judul; ?>

			</h5>

		</div>

		<div class="widget-body">

			<div class="widget-main">

				<div style="margin-bottom:20px;" class="row">

					<div class="col-md-12">

						<a id="openModalEditOpname" href="#" class="btn btn-xs btn-primary" 

						data-kegiatan="" data-departemen="" data-wilayah="" href="#" data-toggle="modal" 

						data-target="#ModalInputUser"><span class="fa fa-plus"> </span> Tambah User</a>



						<a id="openModalEditOpname" href="#" class="btn btn-xs btn-success" 

						data-kegiatan="" data-departemen="" data-wilayah="" href="#" data-toggle="modal" 

						data-target="#ModalInputUserOS"><span class="fa fa-plus"> </span> Tambah User (OS)</a>

					</div>

				</div>

					<?php if($this->session->flashdata('success')) { ?>

						<div class="alert alert-success alert-dismissible fade in" role="alert">

						<button type="button" class="close" data-dismiss="alert" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

						<?php echo $this->session->flashdata('success'); ?>

						</div> 

 					<?php }else if($this->session->flashdata('error')){ ?>

						<div class="alert alert-danger alert-dismissible fade in" role="alert">

						<button type="button" class="close" data-dismiss="alert" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

						<?php echo $this->session->flashdata('error'); ?>

						</div>

					<?php }?>

				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">

					<thead>

						<tr>

							<th>Id User</th>

							<th>Nama Karyawan</th>

							<th>Nomor HP</th>

							<th>Username</th>

							<th>Departemen</th>

							<th>Shipping Point</th>

							<th>Role</th>

							<th>Karyawan</th>

							<th >Action</th>

						</tr>

					</thead>

				<tbody>

		<?php

		$no = 1;

		foreach($user->result_array() as $data) { ?>

						<tr>

							<td><?php echo $data['id_user']; ?><i class="glyphicon glyphicon-chevron-down"></i></td>

							<td><?php echo $data['nama_karyawan']; ?></td>

							<td><?php echo $data['no_hp']; ?></td>

							<td><?php echo $data['username']; ?></td>

							<td><?php echo $data['nama_departemen']; ?></td>

							<td>

								<?php 

								if($data['jml']==null){ 

									echo "[No Filter]";?>

								<?php 

								}else{?>

									<?php echo $data['jml'];?>  

									<!-- <a class="label label-normal" href="#" 

										data-toggle="modal"

										data-target="#modalDetailShp" id="view_detail"

										onclick="contoh(this)" req_id="<?php //echo $data['id_user']; ?>">

										Detail

									</a> -->

									<a href="#" 

										data-toggle="modal"

										data-target="#modalDetailShp" 

										onclick="contoh(this)">

										Detail

									</a>

								<?php

								} ?>

							</td>

							<td><?php echo $data['nama_role']; ?></td>

							<td>

								<?php 

									if($data['os']==1){ 

										echo "Outsource";

									}else if ($data['os']==0){

										echo "GGL";

									}

								?>

							</td>

							<td style="text-align:center;">

								

								<a id="openModalEditUser" href="#" class="label label-primary" 

									data-tipe="<?php echo "edit"; ?>" 

									data-id_user="<?php echo $data['id_user'];?>" 

									data-id_karyawan="<?php echo $data['id_karyawan'];?>" 

									data-no_hp="<?php echo $data['no_hp'];?>" 

									data-id_departemen="<?php echo $data['id_departemen'];?>" 

									data-id_role="<?php echo $data['id_role'];?>"

									data-id_wilayah="<?php echo $data['id_wilayah'];?>"

									data-username="<?php echo $data['username'];?>" 

									href="#" data-toggle="modal" 

									data-target="#ModalEditUser"> <i class="fa fa-edit"></i>

								</a>

								<a id="openAddShippingPoint" href="#" class="label label-success" 

									data-tipe="<?php echo "add"; ?>" 

									data-id_user="<?php echo $data['id_user'];?>" 

									data-id_karyawan="<?php echo $data['id_karyawan'];?>" 

									data-no_hp="<?php echo $data['no_hp'];?>" 

									data-id_departemen="<?php echo $data['id_departemen'];?>" 

									data-id_role="<?php echo $data['id_role'];?>"

									data-id_wilayah="<?php echo $data['id_wilayah'];?>"

									data-username="<?php echo $data['username'];?>" 

									href="#" data-toggle="modal" 

									data-target="#ModalAddShippingPoint"> <i class="fa fa-plus"></i>

								</a>

								<a id="openModalDeleteUser" href="#" class="label label-danger" 

									data-tipe="<?php echo "hapus"; ?>" 

									data-id_user="<?php echo $data['id_user'] ?>" 

									data-id_karyawan="<?php echo $data['id_karyawan']?>" 

									data-no_hp="<?php echo $data['no_hp']?>" 

									data-id_departemen="<?php echo $data['id_departemen']?>" 

									data-id_role="<?php echo $data['id_role']?>"

									data-id_wilayah="<?php echo $data['id_wilayah']?>"

									data-username="<?php echo $data['username']?>" 

									href="#" data-toggle="modal" 

									data-target="#ModalDeleteUser"> <i class="fa fa-trash"></i> 

								</a>

							

								<!--<a class="btn btn-xs btn-primary" href="<?php echo base_url().'user/edit/'.$data['id_user']; ?>"><span class="icon-trash"></span>Edit</a>-->

								<!--<a class="btn btn-xs btn-danger" href="<?php echo base_url().'user/hapus/'.$data['id_user']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="icon-trash"></span>Hapus</a>-->

							</td>

						</tr>

		<?php 	$no++; } ?>

					</tbody>

				</table>

			</div>

		</div>

	</div>



	<div class="modal fade" id="ModalInputUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

			<script type="text/javascript">

				$(function(){

					$.ajaxSetup({

						type:"POST",

						url: "<?php echo base_url('user/ambil_data') ?>",

						cache: false,

					});

					$("#karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'departemen',id_karyawan:value

								},

								success: function(respond){

									$("#departemen").html(respond);

								}

							})

						}

					});



					$("#karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'no_hp',id_karyawan:value

								},

								success: function(respond){

									$("#nope").val(respond);

								}

							})

						}

					});

				})

			</script>

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Tambah User</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/save" method="post"/>	

						<input type="hidden" name="tipe" value="<?php echo "add";?>" readonly>		

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

								<div class="col-sm-9">

									<select id="karyawan" style="width:60%;" class='select_karyawan' name="id_karyawan">

										<?php echo $combo_karyawan; ?>

									</select>

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

								<div class="col-sm-9">

									<input id="nope" style="width:80%;" class="form-control" type="text" name="no_hp" >

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

								<div class="col-sm-9">

									<select id="departemen" style="width:60%;" class='form-control' name="id_departemen">

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

								<label class="col-sm-3 control-label no-padding-right"> Region </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="id_region">

										<?php echo $combo_region; ?>

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

								<label class="col-sm-3 control-label no-padding-right"> Kota </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="id_city">

										<?php echo $combo_wilayah; ?>

									</select>

								</div>

							</div>	

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="description">

										<?php echo $combo_shipping_point_user; ?>

									</select>

								</div>

							</div>	

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 1 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei1">

							</div>

							</div>										
								<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 2 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei2">

								</div>

							</div>							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Username </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="username">

								</div>

							</div>										

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Password </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="password" name="password">

								</div>

							</div>										

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Ulangi Password </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control" type="password" name="ulangi_password">

								</div>

							</div>

							<div>												

								<div class="clearfix form-actions">

										<div class="col-md-offset-3 col-md-12">

											<?php echo $btn_nota; ?>

											<!--<?php echo $btn_batal; ?>-->

											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 

														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal

													</button>

										</div>

								</div>

							</div>								

					</form>			

			</div>		   

        </div>

		</div>

	</div>



	<div class="modal fade" id="ModalInputUserOS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Tambah User OS</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/saveOS" method="post"/>	

						<input type="hidden" name="tipe" value="<?php echo "addOS";?>" readonly>		

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

								<div class="col-sm-9">

									<input style="width:80%;text-transform:uppercase;" class="form-control" type="text" name="nama_karyawan" >

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

								<div class="col-sm-9">

									<input id="nope" style="width:80%;" class="form-control" type="text" name="no_hp" >

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

								<div class="col-sm-9">

									<select id="departemen" class='select_customer' style="width:60%;" class='form-control' name="id_departemen">

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

								<label class="col-sm-3 control-label no-padding-right"> Region </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="id_region">

										<?php echo $combo_region; ?>

									</select>

								</div>

							</div>	

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="description">

										<?php echo $combo_shipping_point_user; ?>

									</select>

								</div>

							</div>								

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 1 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei1">

								</div>

							</div>										
							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 2 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei2">

								</div>

							</div>										
							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Username </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="username">

								</div>

							</div>										

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Password </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="password" name="password">

								</div>

							</div>										

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Ulangi Password </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control" type="password" name="ulangi_password">

								</div>

							</div>

							<div>												

								<div class="clearfix form-actions">

										<div class="col-md-offset-3 col-md-12">

											<?php echo $btn_nota; ?>

											<!--<?php echo $btn_batal; ?>-->

											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 

														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal

													</button>

										</div>

								</div>

							</div>								

					</form>			

			</div>		   

        </div>

		</div>

	</div>



	<div class="modal fade" id="ModalEditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

			<script type="text/javascript">

				$(function(){

					$.ajaxSetup({

						type:"POST",

						url: "<?php echo base_url('user/ambil_data') ?>",

						cache: false,

					});

					$("#id_karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'departemen',id_karyawan:value

								},

								success: function(respond){

									$("#id_departemen").html(respond);

								}

							})

						}

					});

				})

			</script>



            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Edit User</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/save" method="post"/>	

						<input id="tipe" type="hidden" name="tipe" readonly>	

						<input id="id_user" type="hidden" name="id_user" readonly>			

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

								<div class="col-sm-9">

									<select id="id_karyawan" style="width:60%;" class='select_karyawan' name="id_karyawan">

										<?php echo $combo_karyawan; ?>

									</select>

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

								<div class="col-sm-9">

									<input id="no_hp" style="width:80%;" class="form-control" type="text" name="no_hp" >

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

								<div class="col-sm-9">

									<select id="id_departemen" style="width:60%;" class='form-control' name="id_departemen">

										<?php echo $combo_departemen; ?>

									</select>

								</div>

							</div>		



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Login Role Sebagai </label>

								<div class="col-sm-9">

									<select id="id_role" style="width:60%;" class="select_karyawan" name="id_role"/>

											<?php echo $combo_role; ?>

									</select>

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>

								<div class="col-sm-9">

									<select id="id_wilayah" class='select_kegiatan' style="width:60%;" name="id_wilayah">

										<?php echo $combo_wilayah; ?>

									</select>

								</div>

							</div>	

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 1 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei1">

							</div>

							</div>										
								<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> IMEI 2 </label>

								<div class="col-sm-9">

									<input style="width:80%;" class="form-control " type="text" name="imei2">

								</div>

							</div>

							<!-- <div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="description">

										<?php echo $combo_shipping_point_user; ?>

									</select>

								</div>

							</div>								 -->

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Username </label>

								<div class="col-sm-9">

									<input id="username" style="width:80%;" class="form-control " type="text" name="username">

								</div>

							</div>

							<div>												

								<div class="clearfix form-actions">

										<div class="col-md-offset-3 col-md-12">

											<?php echo $btn_nota; ?>

											<!--<?php echo $btn_batal; ?>-->

											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 

														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal

													</button>

										</div>

								</div>

							</div>								

					</form>			

			</div>		   

        </div>

		</div>

	</div>



	<div class="modal fade" id="ModalAddShippingPoint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

			<script type="text/javascript">

				$(function(){

					$.ajaxSetup({

						type:"POST",

						url: "<?php echo base_url('user/ambil_data') ?>",

						cache: false,

					});

					$("#id_karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'departemen',id_karyawan:value

								},

								success: function(respond){

									$("#id_departemen").html(respond);

								}

							})

						}

					});

				})

			</script>



            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Add Shipping Point</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/save_shipping_point" method="post"/>	

						<input id="tipe_shp" type="hidden" name="tipe" readonly>	

						<input id="id_user_shp" type="hidden" name="id_user" readonly>			

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

								<div class="col-sm-9">

									<select id="id_karyawan_shp" disabled style="width:60%;" class='select_karyawan' name="id_karyawan">

										<?php echo $combo_karyawan; ?>

									</select>

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

								<div class="col-sm-9">

									<input id="no_hp_shp" disabled style="width:80%;" class="form-control" type="text" name="no_hp" >

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

								<div class="col-sm-9">

									<select id="id_departemen_shp" disabled style="width:60%;" class='form-control' name="id_departemen">

										<?php echo $combo_departemen; ?>

									</select>

								</div>

							</div>		



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Login Role Sebagai </label>

								<div class="col-sm-9">

									<select id="id_role_shp" disabled style="width:60%;" class="select_karyawan" name="id_role"/>

											<?php echo $combo_role; ?>

									</select>

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>

								<div class="col-sm-9">

									<select id="id_wilayah_shp" disabled class='select_kegiatan' style="width:60%;" name="id_wilayah">

										<?php echo $combo_wilayah; ?>

									</select>

								</div>

							</div>	

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Shipping Point </label>

								<div class="col-sm-9">

									<select class='select_kegiatan' style="width:60%;" name="description">

										<?php echo $combo_shipping_point_user; ?>

									</select>

								</div>

							</div>	

							<div>												

								<div class="clearfix form-actions">

										<div class="col-md-offset-3 col-md-12">

											<?php echo $btn_nota; ?>

											<!--<?php echo $btn_batal; ?>-->

											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 

														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal

													</button>

										</div>

								</div>

							</div>								

					</form>			

			</div>		   

        </div>

		</div>

	</div>



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



	<div class="modal fade" id="ModalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    	<div class="modal-dialog">

        <div class="modal-content">

			<script type="text/javascript">

				$(function(){

					$.ajaxSetup({

						type:"POST",

						url: "<?php echo base_url('user/ambil_data') ?>",

						cache: false,

					});

					$("#id_karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'departemen',id_karyawan:value

								},

								success: function(respond){

									$("#id_departemen1").html(respond);

								}

							})

						}

					});



					$("#id_karyawan").change(function(){

						var value=$(this).val();

						if(value>0){

							$.ajax({

								data:{

									modul:'no_hp',id_karyawan:value

								},

								success: function(respond){

									$("#no_hp1").val(respond);

								}

							})

						}

					});

				})

			</script>

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Hapus User</h4>

            </div>

            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>User/hapus" method="post"/>	

						<input id="tipe1" type="hidden" name="tipe" readonly>	

						<input id="id_user1" type="hidden" name="id_user" readonly>			

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Nama Karyawan </label>

								<div class="col-sm-9">

									<select id="id_karyawan1" style="width:60%;" class='select_karyawan' name="id_karyawan">

										<?php echo $combo_karyawan; ?>

									</select>

								</div>

							</div>

							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Nomor HP</label>

								<div class="col-sm-9">

									<input id="no_hp1" style="width:80%;" class="form-control" type="text" name="no_hp" >

								</div>

							</div>



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Departemen </label>

								<div class="col-sm-9">

									<select id="id_departemen1" style="width:60%;" class='form-control' name="id_departemen">

										<?php echo $combo_departemen; ?>

									</select>

								</div>

							</div>		



							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right">Login Role Sebagai </label>

								<div class="col-sm-9">

									<select id="id_role1" style="width:60%;" class="select_karyawan" name="id_role"/>

											<?php echo $combo_role; ?>

									</select>

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>

								<div class="col-sm-9">

									<select id="id_wilayah1" class='select_kegiatan' style="width:60%;" name="id_wilayah">

										<?php echo $combo_wilayah; ?>

									</select>

								</div>

							</div>							

							<div class="form-group">

								<label class="col-sm-3 control-label no-padding-right"> Username </label>

								<div class="col-sm-9">

									<input id="username1" style="width:80%;" class="form-control " type="text" name="username">

								</div>

							</div>										

							<div>												

								<div class="clearfix form-actions">

										<div class="col-md-offset-3 col-md-12">

											<?php echo $btn_delete; ?>

											<!--<?php echo $btn_batal; ?>-->

											<button type="button" class="btn btn-standar" style="margin-left: 40px;" data-dismiss="modal"> 

														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal

													</button>

										</div>

								</div>

							</div>								

					</form>			

			</div>		   

        </div>

		</div>

	</div>