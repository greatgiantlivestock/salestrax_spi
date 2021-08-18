<div style="padding:10px;">
	<form  class="form-horizontal"  action="<?php echo base_url(); ?>SO_Dairy/save_detail" method="post">	
		<input id="tipe" type="hidden" name="tipe" value="add" readonly>	
		<input id="id_request" type="hidden" name="id_request" value="<?php echo $id_request; ?>" readonly>	
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Produk</label>
				<div class="col-sm-8">
					<?php 
						$username = $this->session->userdata("username");
						if($username == "wulan" || $username == "sartika" || $username == "lim.khim"){?>
						<select id="product" class="select_customer" style="width:100%;" name="id_product">
							<?php echo $combo_product; ?>
						</select>
					<?php }else {?>
						<select id="product" class="select_customer1" style="width:100%;" name="id_product">
							<?php echo $combo_product; ?>
						</select>
					<?php }?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right">Qty </label>
				<div class="col-sm-6">
					<input id="qty" class="form-control " type="text" name="qty" />
					<input id="id_customer_so" class="form-control " type="hidden" name="id_customer_dt" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"> Keterangan </label>
				<div class="col-sm-6">
					<input id="keterangan" class="form-control " type="text" name="keterangan" >
				</div>
			</div>										
			<div class="form-group text-center">
				<button style="border-radius: 25px;background:rgba(0,0,0,0.2);"  class="btn btn-success btn-xs">Simpan</button>
			</div>				
	</form>	
</div>