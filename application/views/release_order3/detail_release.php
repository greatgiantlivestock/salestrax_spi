<!-- <script type="text/javascript">
  function form_submit() {
    document.getElementById("release_form").submit();
   }  
</script>					     -->
	<div>
		<div class="widget-body">
			<div class="widget-main">
				<form  class="form-horizontal" id="release_form" action="<?php echo base_url(); ?>Release_order/save" method="post">	
					<input id="tipe" type="hidden" name="tipe">
					<input id="id_request_ol" type="hidden" name="id_request">
					<table class="tbl_input">
						<tr>
							<td colspan="6">
								Shipping Point										
							</td>
							<td colspan="6">
								<div class="input-group col-xs-12">
									<select id="id_shipping_point" style="width:50%;" class='select_customer' name="id_shipping_point" required>
										<?php echo $combo_shipping_point_id; ?>
									</select>					
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								Sales Person
							</td>
							<td colspan="6">
								<div class="input-group col-xs-12">
									<select id="pers_numb1" style="width:50%;" class="select_customer" name="pers_numb1">
										<?php echo $combo_sales_person; ?>
									</select>						
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								Delivery Date
							</td>
							<td colspan="6">
								<div class="input-group col-xs-6">
									<span class="input-group-addon">
										<i class="fa fa-calendar bigger-110"></i>
									</span>
									<input id="tgl3" style="width:60%;" value="$tanggal_kirim" class="form-control " type="text" name="tanggal_shipping" required>	
								</div>
							</td>
						</tr>
					</table>
					<div class="clearfix form-actions">
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