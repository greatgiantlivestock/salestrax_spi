<script type="text/javascript">
	function hide_detail(){
		$('#ModalEditDetailReleaseDairy').modal('hide');
	}
	function hide_detail1(){
		$('#ModalAddDetailReleaseDairy').modal('hide');
	}
	
// 	function contoh1(x){ 
// 			var url = '<?php echo base_url('Release_order/get_product/')?>'+x;
// 			$.ajax({
// 					type: 'get',
// 					url: url,
// 					success: function (msg) {
// 						$('.modal-body-product').html(msg);
// 					}
// 			});
// 		}
</script>
<div>					    
	<div class="widget-box" id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title">
				<?php echo $judul; ?>
			</h5>
		</div> -->
		<div>
			<a style="margin-left:15px;margin-top:15px;border-radius: 25px;background:rgba(0,0,0,0.2);" id="openModalAddDetail1"   
				href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-tipe="add" data-id_request="<?php echo $id_request; ?>"
				data-target="#ModalAddDetailReleaseDairy"><i class="fa fa-plus"> </i> Tambah Detail
			</a>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Customer</th>
							<th>Product</th>
							<th>Qty</th>
							<th>Satuan</th>
							<th>Aksi</th>
						</tr>
					</thead>
				<tbody>
		<?php
		$no = 1;
		foreach($data_query->result_array() as $data) { ?>
						<tr>
							<td><?php echo $data['nama_customer']; ?></td>
							<td><?php echo $data['nama_product']; ?></td>
							<td><?php echo $data['qty']; ?></td>
							<td><?php echo $data['nama_satuan']; ?></td>
							<td>
								<a style="border-radius:25px;" id="openModalEditDetail" 
									href="#" class="label label-primary" 
									data-id_request="<?php echo $data['id_request']; ?>"
									data-id_detail_request="<?php echo $data['id_detail_request']; ?>"
									data-id_product="<?php echo $data['id_product']; ?>" 
									data-qty="<?php echo $data['qty']; ?>" 
									data-keterangan="<?php echo $data['keterangan']; ?>" 
									data-tipe="edit" data-toggle="modal" data-target="#ModalEditDetailReleaseDairy">
									<i class="fa fa-edit"></i>
								</a> 
								<!-- <a style="border-radius:25px;" id="openModalEditDetail" 
									href="#" class="label label-primary" 
									data-id_detail_request="<?php echo $data['id_detail_request']; ?>"
									data-id_product="<?php echo $data['id_product']; ?>" 
									data-qty="<?php echo $data['qty']; ?>" 
									data-keterangan="<?php echo $data['keterangan']; ?>" 
									data-tipe="edit" data-toggle="modal" data-target="#ModalEditDetailReleaseMeat">
									<i class="fa fa-edit"></i>
								</a>  -->
								<a style="border-radius:25px;" 
									href="<?php echo base_url().'Release_order/hapus_detail/'.$data['id_detail_request'].'/'.$data['id_request']; ?>" 
									class="label label-danger" onclick="return confirm('Yakin ingin hapus data ?');">
									<i class="fa fa-trash"></i>
								</a> 
							</td>
						</tr>
		<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ModalEditDetailReleaseDairy"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px;" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Detail Order</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Release_order/save_detail" method="post">	
						<input id="tipe11" type="hidden" name="tipe" value="edit" readonly>				
						<input id="id_detail_request11" type="hidden" name="id_detail_request">							
						<input id="id_request11" type="hidden" name="id_request">							
							<table class="tbl_input">
								<tr>
									<td colspan="6">
										Produk										
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<?php 
												$username = $this->session->userdata("username");
												if($username == "wulan"){?>
												<select id="product11" class="select_customer" name="id_product">
													<?php echo $combo_product; ?>
												</select>
											<?php }else {?>
												<select id="product11" name="id_product">
													<?php echo $combo_product; ?>
												</select>
											<?php }?>				
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Qty
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<input id="qty11" class="form-control " type="text" name="qty">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Keterangan
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<input id="keterangan11" class="form-control " type="text" name="keterangan">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="12">
										<div class="input-group col-xs-12 text-center">
											<button type="botton" class="btn btn-ms btn-success" style="border-radius:25px;"> 
												<i class="ace-icon fa fa-save bigger-110">	</i>Simpan
											</button>
											<a class="btn btn-ms btn-warning" style="border-radius:25px; margin-left: 40px;" onclick="hide_detail()"> 
												<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
											</a>
										</div>
									</td>
								</tr>
							</table>
					</form>			
			</div>		   
        </div>
		</div>
	</div>
	<div class="modal fade" id="ModalAddDetailReleaseDairy"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div style="border-radius:25px;" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Input Detail Order</h4>
            </div>
            <div class="modal-body">
            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>Release_order/save_detail" method="post">	
						<input id="tipe12" type="hidden" name="tipe" readonly>								
						<input id="id_request12" type="hidden" name="id_request" >							
							<table class="tbl_input">
								<tr>
									<td colspan="6">
										Produk										
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<?php 
												$username = $this->session->userdata("username");
												if($username == "wulan"){?>
												<select id="product11" class="select_customer" name="id_product">
													<?php echo $combo_product; ?>
												</select>
											<?php }else {?>
												<select id="product11" name="id_product">
													<?php echo $combo_product; ?>
												</select>
											<?php }?>				
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Qty
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<input id="qty11" class="form-control " type="text" name="qty">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										Keterangan
									</td>
									<td colspan="6">
										<div class="input-group col-xs-6">
											<input id="keterangan11" class="form-control " type="text" name="keterangan">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="12">
										<div class="input-group col-xs-12 text-center">
											<button type="botton" class="btn btn-ms btn-success" style="border-radius:25px;"> 
												<i class="ace-icon fa fa-save bigger-110">	</i>Simpan
											</button>
											<a class="btn btn-ms btn-warning" style="border-radius:25px; margin-left: 40px;" onclick="hide_detail1()"> 
												<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
											</a>
										</div>
									</td>
								</tr>
							</table>
					</form>			
			</div>		   
        </div>
		</div>
	</div>
	<!--<div id="ModalAddDetailReleaseDairy" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
 <!--   <div class="modal-dialog">-->
 <!--       <div style="border-radius:25px;" class="modal-content">-->
 <!--           <div class="modal-header">-->
 <!--               <button type="button" onclick="hide_detail1()" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
 <!--               <h4 class="modal-title" id="myModalLabel">Input Detail Order</h4>-->
 <!--           </div>-->
 <!--           <div class="modal-body-product">-->
            	 			 
	<!--		</div>		   -->
 <!--       </div>-->
 <!--   </div>-->
	<!--</div>-->