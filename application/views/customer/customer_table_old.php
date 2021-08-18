<html> 
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>
</head>
	<div class="widget-box widget-color-red" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-truck"> </i> <?php echo $judul; ?></h5>
		</div>
		<div class="widget-body" id="AppsAll">
				<div class="space-1"></div>
				<div class="row">
					
					<div class="col-md-3">
						<div class="panel panel-default">
  							<div class="panel-body">
			            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>customer/save_detail" method="post"/>
									<input id="tipe" type="hidden" name="tipe" value="<?php echo $tipe; ?>" readonly>	
									<input id="id_customer" type="hidden" name="id_customer" value="<?php echo $id_customer; ?>" readonly>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Kode Customer</label>
										<div class="form-group">
											<input <?php echo $color; ?> class="form-controll" type="text" name="kode_customer" value="<?php echo $kode_customer;?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Nama Customer </label>

										<div class="col-sm-9">
											<input <?php echo $color; ?> class="form-control" style="text-transform:uppercase" id="nama_customer" type="text" name="nama_customer" value="<?php echo $nama_customer; ?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Alamat Customer </label>

										<div class="col-sm-9">
											<input <?php echo $color; ?> class="form-control" name="alamat" type="text" value="<?php echo $alamat_customer;?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> No HP </label>

										<div class="col-sm-9">
										<input <?php echo $color; ?> style="text-transform:uppercase"  class="form-control " type="number" name="no_hp" value="<?php echo $no_hp; ?>">
										</div>
									</div>	

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Nama Usaha </label>

										<div class="col-sm-9">
											<input <?php echo $color; ?> class="form-control" name="nama_usaha" type="text" value="<?php echo $nama_usaha;?>"/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Wilayah </label>

										<div class="col-sm-9">
											<select id='kecamatan' class='select_customer' style="width:100%;<?php echo $color_edit; ?>" name="id_wilayah" <?php echo $disable; ?>>
												<?php echo $combo_wilayah; ?>
											</select>
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
						<table id="sample-table-2" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Nama Customer</th>	
									<th>Alamat</th>
									<th>No HP</th>
									<th style="width:170px;"><center>Actions<center></th>
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
											<td>
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
			</div>
		</div>
	</div>
</html>