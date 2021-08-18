<div class="col-md-12">					    
	<div class="widget-box widget-color-red" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title">
				<i class="fa fa-truck"></i>
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

					<div class="form-group">
						<label>Nama Karyawan</label>
						<br>
						<br>
						<select style="width:60%;" class="select_karyawan" name="id_karyawan"/>
								<?php echo $combo_tk_personal; ?>
						</select>
					</div>
					

					<div class="form-group">
						<label >No HP</label>
						<input style="width:60%;" class="form-control" name="no_hp" value="<?php echo $no_hp; ?>"/>
					</div>

					<div class="form-group">
						<label>Departemen</label>
						<br>
						<select style="width:60%;" class="select_karyawan" name="id_departemen"/>
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

					<!--
					<div class="form-group">
						<label>RPH</label>
						<select style="width:60%;" class="form-control" name="id_rph"/>
								<?php echo $combo_rph; ?>
						</select>
					</div>
					-->

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