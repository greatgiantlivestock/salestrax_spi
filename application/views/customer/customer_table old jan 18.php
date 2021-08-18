<html> 
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
	<script type="text/javascript">

	$(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo base_url('customer/generate_code') ?>",
			cache: false,
		});

		$("#wilayah").change(function(){
			var value=$(this).val();
			if(value>0){
				$.ajax({
					data:{modul:'generate_kode',id_wilayah:value},
					success: function(respond){
						$("#kode_cust").val(respond);
					}
				})
			}
		});
	})

	</script>
</head>
	<div class="widget-box" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
		</div>
		<div class="widget-body" id="AppsAll">
			<form name="customer_input" class="form-horizontal"  action="<?php echo base_url(); ?>customer/save"   method="post"/>
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<input type="hidden" name="id_customer" value="<?php echo $id_customer; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-4">
						<table class="tbl_input">
						<!--
							<tr>
								<td>
									Kode Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" readonly id='kode_cust' class="form-control " type="text" name="kode_customer" value="<?php echo $kode_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Nama Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="nama_customer" value="<?php echo $nama_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Alamat Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="alamat" value="<?php echo $alamat_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									No HP
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase"  class="form-control " type="number" name="no_hp" value="<?php echo $no_hp; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Nama Usaha
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="nama_usaha" value="<?php echo $nama_usaha; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Wilayah
								</td>
								<td>
									<div class="input-group col-xs-6">
									<select id='wilayah' style="width:200px;font-weight: bold;font-size: 1.2em;" class='select_karyawan pull-right' name="id_wilayah" style="width:100%; <?php echo $color_edit; ?>" >
												<?php echo $combo_wilayah; ?>
									</div>
								</td>
							</tr>				

							<tr>
								<td>
									<?php echo $btn_nota; ?>
									<?php echo $btn_batal; ?>
								</td>
							</tr>	
							-->

							<tr>
								<td colspan='2'>
									<?php if($this->session->flashdata('error')) { ?>
										<div class="alert alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<?php echo $this->session->flashdata('error'); ?>
										</div> 
									<?php } else if ($this->session->flashdata('success')) {?>
										<div class="alert alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
											<?php echo $this->session->flashdata('success'); ?>
										</div> 
									<?php } ?>
								</td>
							</tr>			
						</table>
					</div>

					<div class="col-md-12">
						<a id="openModalAddDetail" style="margin-top: 10px; margin-bottom: 10px;" 
							href="#" class="btn btn-xs btn-primary" href="#"  
							data-nomor_rencana="$nomor_rencana" data-id_rencana_header="$id_rencana_header" data-id_rencana_detail="$id_rencana_detail" 
							data-tanggal_rencana="$tanggal_rencana" data-tanggal_penetapan="tanggal_penetapan" tanggal-keterangan="$keterangan"
							href="#" data-toggle="modal" 
							data-target="#ModalInputCustomer"><i class="fa fa-plus"> </i> Tambah Customer
						</a>
						<table id="sample-table-2" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Nama Customer</th>	
									<th>Alamat</th>
									<th>No HP</th>
									<th><center>Actions<center></th>
								</tr> 
							</thead>

							<tbody>
								<?php
								$no = 1;
								if($customer != "") {
									if(!empty($customer->result_array())) { 
										foreach($customer->result_array() as $data) { ?>
										<tr>
											<td><?php echo $data['nama_customer']; ?></td>
											<td><?php echo $data['alamat']; ?></td>
											<td><?php echo $data['no_hp']; ?></td>
											<td width="170">
												<a  class="label label-primary" href="<?php echo base_url().'customer/index/'.$data['id_customer']; ?>" ><i class="fa fa-edit"> </i> Ubah</a> |
												<a href="<?php echo base_url().'customer/hapus_customer/'.$data['id_customer']; ?>" class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"> </i> Hapus</a>
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
					</div>
				</div>
			</form>
			</div>
		</div>

		<div class="modal fade" id="ModalInputCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Penambahan Customer Baru</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Customer/save" method="post"/>	
						<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
						<input type="hidden" name="id_customer" value="<?php echo $id_customer; ?>">			
						<table class="tbl_input">
							<tr>
								<td>
									Kode Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" readonly id='kode_cust' class="form-control " type="text" name="kode_customer" value="<?php echo $kode_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Nama Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="nama_customer" value="<?php echo $nama_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Alamat Customer
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="alamat" value="<?php echo $alamat_customer; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									No HP
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase"  class="form-control " type="number" name="no_hp" value="<?php echo $no_hp; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									No KTP
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase"  class="form-control " type="number" name="no_hp" value="<?php echo $no_ktp; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Nama Usaha
								</td>
								<td>
									<div class="input-group col-xs-10">
										<input <?php echo $color; ?> style="text-transform:uppercase" class="form-control " type="text" name="nama_usaha" value="<?php echo $nama_usaha; ?>">						
									</div>
								</td>
							</tr>

							<tr>
								<td>
									Wilayah
								</td>
								<td>
									<div class="input-group col-xs-6">
									<select id='wilayah' style="width:200px;font-weight: bold;font-size: 1.2em;" class='select_karyawan pull-right' name="id_wilayah" style="width:100%; <?php echo $color_edit; ?>" >
												<?php echo $combo_wilayah; ?>
									</div>
								</td>
							</tr>				

							<tr>
								<td>
									<?php echo $btn_nota; ?>
								</td>
							</tr>			
						</table>			
					</form>			
			</div>		   
        </div>
    	</div>
	</div>
</html>