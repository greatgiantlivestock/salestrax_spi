<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/jquery.min.js') ?>"></script>

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
	})
</script>
</head>

<div class="col-md-12">					    
	<div class="widget-box">
		<div class="widget-header header-color-blue">
			<h5 class="bigger lighter">
				<i class="fa fa-table"></i>
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 <?php } ?>
				<form action="<?php echo base_url(); ?>user/save" method="post"/>
					<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
					<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

					<div class='form-group'>
						<label>Nama Karyawan</label>
						<br>
						<select style="width:60%;" class='select_karyawan' id='nama_karyawan_list' name="id_karyawan">
							<option value='0'>Pilih Karyawan</option>
							<?php 
								foreach ($combo_tk_personal as $prov) {
								echo "<option value='$prov[id_karyawan]'>$prov[nama_karyawan] || $prov[no_index]</option>";
								}
							?>
						</select>
					</div>				

					<div class="form-group">
						<label >No HP</label>
						<br>
						<input style="width:60%;" type="text" class="select" id='no_hp_list' name="no_hp" id='no_hp_list'/>
					</div>

					<div class='form-group'>
						<label>Departemen</label>
						<br>
						<select style="width:60%;" class='form-control'  id='nama_departemen_list' name="id_departemen">
							<?php echo $combo_departemen; ?>
						</select>
					</div>
					
					<div class="form-group">
						<label>Login role sebagai</label>
						<br>
						<select style="width:60%;" class="select_karyawan" name="id_role"/>
								<?php echo $combo_role; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Wilayah</label>
						<br>
						<select style="width:60%;" class="select_karyawan" name="id_wilayah"/>
								<?php echo $combo_wilayah; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Username</label>
						<input style="width:40%;" class="form-control" type="text" name="username" value="<?php echo $username; ?>"/>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input style="width:40%;" class="form-control" type="password" name="password" value="<?php echo $password; ?>"/>
					</div>

					<div class="form-group">
						<label>Ulangi Password</label>
						<input style="width:40%;" class="form-control" type="password" name="ulangi_password" value="<?php echo $password; ?>"/>
					</div>

					<div class="form-group">
						<label>IMEI 1</label>
						<input style="width:40%;" class="form-control" type="text" lenght='20' name="mac" value="<?php echo $mac; ?>"/>
					</div>

					<div class="form-group">
						<label>IMEI 2</label>
						<input style="width:40%;" class="form-control" type="text" lenght='20' name="mac1" value="<?php echo $mac1; ?>"/>
					</div>

					<div class="form-group">
						<button class="btn btn-info btn-small">
							<i class="fa fa-save bigger-110"></i>
							Simpan
						</button>
						&nbsp; &nbsp; &nbsp;
						<a class="btn btn-small" href="<?php echo base_url(); ?>user">
							<i class="fa fa-undo bigger-110"></i>
							Batal
						</a>
					</div>	
				</form>
			</div>
		</div>
	</div>
</div>