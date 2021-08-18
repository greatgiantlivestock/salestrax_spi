<html>
	<?php
	$get_id = $this->db->query("SELECT trx_rencana_master.nomor_rencana FROM (SELECT MAX(id_rencana_header) AS id_rencana_header FROM trx_rencana_master) AS proses_lama
								JOIN trx_rencana_master ON proses_lama.id_rencana_header=trx_rencana_master.id_rencana_header")->row();
	$no_akhir = $get_id->nomor_rencana;
	$tanggal = "RCN.".date("ymd",strtotime(date("Y-m-d"))).".";  
	?> 

<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
	<script type="text/javascript">

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

		/*
		$("#kecamatan").change(function(){
			var value=$(this).val();
			if(value>0){
				$.ajax({
					data:{modul:'kelurahan',id:value},
					success: function(respond){
						$("#kelurahan-desa").html(respond);
					}
				})
			} 
		})
		*/
	})

	</script>
</head>
	<div class="widget-box widget-color-red" id="widget-box-9">
		<!--
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
		</div>-->
		<div class="widget-body" id="AppsAll">
			<form class="form-horizontal"  action="<?php echo base_url(); ?>processing/save" method="post"/>
			<?php if($tipe == "edit") { ?>		
			<input class="input-sm col-xs-6" type="hidden" name="nomor1" value="<?php echo $nomor_rencana; ?>" readonly>
			<?php } else { ?>
			<input class="input-sm col-xs-6" type="hidden" name="nomor1" value="<?php echo buatkode($no_akhir, $tanggal, 4); ?>" readonly>
			<?php } ?>
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<input type="hidden" name="id_rencana_header" value="<?php echo $id_rencana_header; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-6">
						<table class="tbl_input">
							<tr>
								<td style="width:150px;">
									Tanggal Rencana
								</td>
								<td>
									<div class="input-group col-xs-6">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl" class="form-control " type="text" name="tanggal_rencana" value="<?php echo $tanggal_rencana; ?>">						
									</div>
								</td>
							</tr>
							<tr>
								<td>
									Tanggal Penetapan
								</td>
								<td>
									<div class="input-group col-xs-6">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl" readonly class="form-control " type="text" name="tanggal_penetapan" value="<?php echo date("Y-m-d"); ?>">						
									</div>
								</td>
							</tr>
							<tr>
								<td>
									Keterangan
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" id="tgl" class="form-control " type="text" name="keterangan" value="<?php echo $keterangan; ?>">						
									</div>
								</td>
							</tr>			
						</table>
					</div>

					<div class="col-md-6">
						<table class="tbl_input">
							<tr>
								<td>
									<center>No. Rencana</center>
								</td>
								<td>
									<div class="input-group col-xs-6">
										<input <?php echo $color; ?> id="tgl" class="form-control " type="text" readonly name="nomor_rencana" value="<?php echo $nomor_rencana; ?>">
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
						<?php echo $btn_batal; ?>
						
						<select id='no_rencana' style="width:400px;font-weight: bold;font-size: 1.2em;" class='select_karyawan pull-right' style="width:100%; <?php echo $color_edit; ?>" name="id_rencana_header">
												<?php echo $combo_rencana; ?>
						</select>
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
									<input id="id_rencana_header" type="hidden" name="id_rencana_header" value="<?php echo $id_rencana_header; ?>" readonly>			
									<input id="id_rencana_detail" type="hidden" name="id_rencana_detail" value="<?php echo $id_rencana_detail; ?>" readonly>		

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Karyawan </label>

										<div class="col-sm-9">
											<select id='provinsi' class='select_karyawan' style="width:100%; <?php echo $color_edit; ?>" name="id_karyawan" <?php echo $disable; ?>>
												<?php echo $combo_karyawan; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Kegiatan </label>

										<div class="col-sm-9">
											<select id='kabupaten-kota' class='select_kegiatan' style="width:100%;<?php echo $color_edit; ?>" name="id_kegiatan" <?php echo $disable; ?>>
												<?php echo $combo_kegiatan; ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Customer </label>

										<div class="col-sm-9">
											<select id='kecamatan' class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="id_customer" <?php echo $disable; ?>>
												<?php echo $combo_customer; ?>
											</select>
										</div>
									</div>						

									<!--
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> No.Krat </label>

										<div class="col-sm-9">
											<input id="no_box" style="width:30%;<?php echo $color_edit; ?>" type="text" name="no_box" value="<?php echo $no_box; ?>" <?php echo $readonly; ?> />
										</div>
									</div>	

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> QTY </label>

										<div class="col-sm-9">
											<input id="qty" style="width:20%;<?php echo $color_edit; ?>" type="text" name="qty" value="<?php echo $qty; ?>" <?php echo $readonly; ?>/>
										</div>
									</div>		
									-->								
			            
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
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nama Karyawan</th>	
									<th>Kegiatan</th>
									<th>Customer</th>
									<th style="width:130px;">Status</th>
									<th style="width:170px;"><center>Actions<center></th>
								</tr> 
							</thead>

							<tbody>
								<?php
								$no = 1;
								if($rencana_detail != "") {
									if(!empty($rencana_detail->result_array())) { 
										foreach($rencana_detail->result_array() as $data) { ?>
										<tr>
											<td><?php echo $data['nama_karyawan']; ?></td>
											<td><?php echo $data['nama_kegiatan']; ?></td>
											<td><?php echo $data['nama_customer']; ?></td>
											<td>
												<?php echo "Belum Terealisasi";?>
											</td>
											<td>
												<a  class="label label-primary" href="<?php echo base_url().'processing/index/'.$data['id_rencana_header'].'/'.$data['id_rencana_detail']; ?>" ><i class="fa fa-edit"> </i> Ubah</a> |
												<a href="<?php echo base_url().'processing/hapus_detail/'.$data['id_rencana_detail'].'/'.$data['id_rencana_header']; ?>" class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"> </i> Hapus</a>
											</td>
										</tr>
										<?php  	
											$no++; } 
									} else { ?>
									<tr>
										<td colspan="5"><center>Belum ada data</center></td>
									</tr>
									<?php	} }
									?>
							</tbody>							
						</table>
						
						<!--
						<center>
							<a class="btn btn-xs btn-success text-center" href="<?php echo base_url().'null/null/'.$id_rencana_header; ?>" target="_blank" <?php echo $disable; ?>>
								<i class="ace-icon fa fa-save"></i>
								<span class="bigger-110">Simpan Rencana</span>
							</a>
						</center>
						-->

					</div>
				</div>
			</div>
		</div>
	</div>
</html>