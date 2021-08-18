	<div>
		<div class="widget-body" style="border-radius:25px">
			<div class="widget-main">
				<form  class="form-horizontal"  action="<?php echo base_url(); ?>Customer/save_sales" method="post">	
					<input id="tipe" type="hidden" name="tipe">
					<input id="kode_customer" type="hidden" name="kode_customer">			
							<table class="tbl_input">
								<!-- <tr>
									<td colspan="6">
										Kode Customer										
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<input id='kode_customer' class="form-control" readonly type="text" >
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Nama Customer										
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<input class="form-control " readonly type="text" id='nama_customer' >
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Kota										
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<input class="form-control " readonly type="text" id='kota' >
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Alamat										
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<input class="form-control " readonly type="text" id='alamat' >
										</div>
									</td>
								</tr> -->
								<tr>
									<td colspan="6">
										Sales Person										
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<select id="pers_numb" class='select_kegiatan' style="width:100%;" name="pers_numb">
												<?php echo $combo_sales_person; ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Material Group
									</td>
									<td colspan="6">
										<div class="col-sm-9">
											<select id="matgr" class='select_kegiatan' style="width:100%;" name="matgr">
												<?php echo $combo_material_group; ?>
											</select>
										</div>
									</td>
								</tr>
							</table>
							<div class="clearfix form-actions" style="border-radius:25px">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" style="border-radius:25px" class="btn btn-ms btn-success">
										<i class="ace-icon fa fa-edit bigger-110"></i>Simpan
									</button>
									<button type="botton" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
										<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
									</button>
								</div>
							</div>						
					</form>	
			</div>
		</div>
	</div>