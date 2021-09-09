<style type="text/css">
	pre {
		display: block;
		font-family: Verdana;
		white-space: pre;
		margin: 0;
		padding: 0;
	}
</style>
	<script type="text/javascript">
	$(document).ready(function () {
		$('a').on('click', function () {
			var image = $(this).attr('src');
			$('#myModal').on('show.bs.modal', function () {
				$(".img-responsive").attr("src", image);
			});
		});
		$("#checkAll").click(function () {
			$('input:checkbox').not(this).prop('checked', this.checked);
			var checkBox = document.getElementById("checkAll");
			var table = document.getElementById("dataTables-example");
			var count = table.rows.length;
			var calc = count - 3;
			for(i=1; i<=count; i++){
				if(i<=calc){
					var str = table.rows[i].cells[0].innerHTML;
					if (checkBox.checked == true){
						var url = '<?php echo base_url('Order_list/update_row/')?>'+str;
						console.log(str);
						console.log("masuk row");
					} else if(checkBox.checked == false){
						console.log(str);
						console.log("masuk row1");
						var url = '<?php echo base_url('Order_list/update_row1/')?>'+str;
					} else{
						console.log("link gak jalan");
					}
					$.ajax({
						url: url
					});
				}
			}
		});
	});
	function contoh(x){
		var checkBox = document.getElementById("myCheck");
		var table = document.getElementById("dataTables-example");
		var count = x.parentNode.parentNode.rowIndex;
		var str = table.rows[count].cells[0].innerHTML;
		console.log(str);
		if (checkBox.checked == true){
			var url = '<?php echo base_url('Order_list/update_row/')?>'+str;
			console.log("masuk row");
		} else if(checkBox.checked == false){
			console.log("masuk row1");
			var url = '<?php echo base_url('Order_list/update_row1/')?>'+str;
		} else{
			console.log("link gak jalan");
		}
		$.ajax({
			url: url
		});
	}
	function myFunction() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("myTable");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}       
			}
		}
	</script>
	<script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> 
	</script>
	<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
				bAutoWidth: false , 
				responsive: true,
				bPaginate: false,
				bLengthChange: false,
				bFilter: true,
				bInfo: false,
                "order": [[ 1, "desc" ]]
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#edit_modal').on('show.bs.modal', function (e) {
                var idx = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type : 'post',
                    url : 'editcomplains.php',
                    data :  'idx='+ idx,
                    success : function(data){
                    $('.hasil-data').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
	<!--<script> window.setTimeout(function() { $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 2000); </script> -->
	<div class="widget-box " id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-shopping-cart"> </i> <?php echo $judul; ?></h5>
		</div> -->
		<div class="widget-body" id="AppsAll">
		<form class="form-horizontal"  action="<?php echo base_url(); ?>Order_list/lihat_report" method="post"/>
			<input type="hidden" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>">
			<input type="hidden" name="kode_shipping_point" value="<?php echo $kode_shipping_point; ?>">
			<input type="hidden" name="nama_status_kirim" value="<?php echo $nama_status_kirim; ?>">
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			<div class="widget-main">
				<div class="row">
					<div class="col-md-8">
						<table class="tbl_input">
							<tr>
								<td colspan="6">
									<h3>Tanggal Rencana Kirim</h>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<div class="input-group col-xs-10">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?>  class="form-control " type="date" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" required>						
									</div>
								</td>
								<td style="width:50px">To </td>
								<td colspan="5">
									<div class="input-group col-xs-10">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?>  class="form-control " type="date" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>" required>						
									</div>
								</td>
							</tr>
							<!--
								<?php if ($this->session->userdata("id_role")<=2){?>
								<tr>
									<td>
										Departemen
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_departemen">
											<?php echo $combo_departemen; ?>
										</select>
									</td>
								</tr>				
								<?php }?>	
								<tr>
									<td>
										Nama Sales
									</td>
								</tr>	
								<tr>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_karyawan">
											<?php echo $combo_user; ?>
										</select>
									</td>			
								</tr>
								<tr>
									<td colspan="7">
										Shipping Point
									</td>
									<td colspan="5">
										Shipment Status
									</td>
								</tr>	
							-->
							<tr>
								<td colspan="7">
									<select style="width:90%;" <?php echo $color; ?> name="kode_shipping_point">
										<?php echo $combo_shipping_point; ?>
									</select>
								</td>			
								<td colspan="5">
									<select style="width:100%;" <?php echo $color; ?> name="nama_status_kirim">
										<?php echo $combo_status_kirim; ?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/ style="margin-top: 10px; margin-bottom: 10px;">
						<?php echo $btn_nota; ?>
						<hr/ style="margin-top: 10px; margin-bottom: 10px;">
					</div>
				</div>
			</form>
				<div class="space-10"></div>
				<div class="row">
					<div class="col-md-12">
					<?php if($this->session->flashdata('error_update')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error_update'); ?>
                    </div> 
					<?php }else if($this->session->flashdata('success_update')){ ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success_update'); ?>
                    </div> 
 					<?php } ?>
 						</a>
						<div style="margin-bottom: 20px;" class="row">
							<div class="col-md-12 text-center">	
								<?php if($this->session->userdata("username")!="agus.setiyono@gg-foods.com"){?>
									<a style="border-radius: 25px;" class="btn btn-ms btn-primary text-center" style="margin-top:10px"
										href="javascript://" onclick="exportOrderList('xls');"
										<?php echo $disable; ?>>
										<i class="glyphicon glyphicon-export"></i>
										<span class="bigger-110"> Export to Excel</span>
									</a>
								<?php }?>
							</div>
						</div>
						<div class="col-md-12 text-left">
						<?php if($this->session->userdata("username")=="minar"||$this->session->userdata("username")=="admin.admin"||$this->session->userdata("username")=="Yusuf.tester"||$this->session->userdata("username")=="agus.setiyono@gg-foods.com"){ ?>
								<div class="input-group col-xs-3 pull-right" style="margin-bottom:5px;margin-top:5px;">
									<input placeholder="Ketik nama customer.." id="myInput" onkeyup="myFunction()" style="width:100%;" class="form-control " type="text">	
									<span class="input-group-addon">
										<i class="fa fa-search"></i>
									</span>					
								</div> 
							<div class="col-md-12 text-left" style="height: 500px;overflow-y: scroll;">
								<table id="myTable" width="100%" class="table table-striped table-bordered table-hover" data-page-length='100'>
						<?php }else{ ?>
							<div class="col-md-12 text-left">
								<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover" data-page-length='100'>
						<?php } ?>
								<thead>
									<tr >							
										<th style="background: #22313F;color:#fff;"> Id </th>
										<?php if($this->session->userdata("username")=="agus.setiyono@gg-foods.com"){?>																	
											<th style="background: #22313F;color:#fff;"><input type="checkbox" id="checkAll"/> All </th>
										<?php }?>																
										<th style="font-size:1;background: #22313F;color:#fff;"> Created by   </th>																	
										<th style="font-size:1;background: #22313F;color:#fff;"> Sales Person   </th>																	
										<th style="display:none;background: #22313F;color:#fff;">No. Order</th>							
										<th style="display:none;background: #22313F;color:#fff;">Sold to Party</th>
										<th style="background: #22313F;color:#fff;"> Ship to Party </th>
										<th style="background: #22313F;color:#fff;">Jenis</th>
										<th style="background: #22313F;color:#fff;">Produk</th>
										<th style="background: #22313F;color:#fff;">Qty</th>
										<th style="background: #22313F;color:#fff;">UOM</th>
										<th style="background: #22313F;color:#fff;">Region</th>
										<th style="background: #22313F;color:#fff;">Cluster</th>
										 <th style="background: #22313F;color:#fff;">Alamat</th>
										<th style="background: #22313F;color:#fff;">No. PO</th>	
										<th style="background: #22313F;color:#fff;">File PO</th>		
										<th style="background: #22313F;color:#fff;">Tanggal PO</th>																	
										<th style="background: #22313F;color:#fff;">Tanggal Order</th>																	
										<th style="background: #22313F;color:#fff;">Tanggal Rencana Kirim</th>	
										<th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 1)</th>																	
										<th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 2)</th>																	
										<!-- <th style="background: #22313F;color:#fff;">Jadwal Kirim (hari 3)</th>																	 -->								
										<!-- <th style="background: #22313F;color:#fff;">Tanggal Realisasi Kirim</th>								 -->
										<th style="background: #22313F;color:#fff;">Catatan Customer</th>
										<!-- <th style="background: #22313F;color:#fff;">Ket</th> -->
										<th style="background: #22313F;color:#fff;">Preview</th>
										<th style="background: #22313F;color:#fff;">Shipping Point</th>	
										<!-- <th style="background: #22313F;color:#fff;">Shipment Status</th> -->
										<!-- <th style="background: #22313F;color:#fff;">Sisa Stock H1</th>
										<th style="background: #22313F;color:#fff;">Detail H1</th>
										<th style="background: #22313F;color:#fff;">Sisa Stock H2</th>
										<th style="background: #22313F;color:#fff;">Detail H2</th>
										<th style="background: #22313F;color:#fff;">Sisa Stock H3</th>
										<th style="background: #22313F;color:#fff;">Detail H3</th> -->
										<?php if($this->session->userdata("id_role")==5){?>
										<?php }else{?>
											<!-- <th style="background: #22313F;color:#fff;">Action</th> -->
										<?php }?>
									</tr> 
								</thead>
								<tbody>
									<?php
									$no = 1;
									$jum_total = 0; 
									foreach($q_tarik_data->result_array() as $data) { ?>
										<?php if($data['sts']==1){?>
											<?php if($this->session->userdata("username")=="agus.setiyono@gg-foods.com"){?>
												<tr>				
													<td style="background: #69f2ff;"><?php echo $data['id_detail_request']; ?></td>
													<td style="background: #69f2ff;"><?php echo "R"?></td>								
													<td style="background: #69f2ff;"><?php echo $data['nama']; ?></td>									
													<td style="background: #69f2ff;"><?php echo $data['sname']; ?></td>									
													<td style="display:none;background: #69f2ff;"><?php echo $data['no_request']; ?></td>						
													<td style="display:none;background: #69f2ff;"><?php echo $data['cust_sold']; ?></td>
													<td style="background: #69f2ff;"><?php echo $data['cust_sold']; ?></td>
													<td style="background: #69f2ff;">
														<?php
															if($data['nama_transaksi']=="Penjualan"){
																echo "PO";
															}else if ($data['nama_transaksi']=="Tukar Guling"){
																echo "TG";
															}else{
																echo $data['nama_transaksi'];
															}  
														?>
													</td>
													<td style="background: #69f2ff;">
														<?php 
															if($data['nama_product']=="FG Milk Botol 1 Liter                   "){
																echo "1 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
																echo "2 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
																echo "3 Ltr";
															}else{
																echo $data['nama_product']; 
															}
														?>
													</td>	
													<td  style="background: #69f2ff;"><?php echo $data['qty']; ?></td>											
													<td style="background: #69f2ff;"><?php echo $data['satuan']; ?></td>
													<td style="background: #69f2ff;"><?php echo $data['city']; ?></td>
													<td style="background: #69f2ff;"><?php echo $data['nama_cluster']; ?></td>
													<td  style="background: #69f2ff;"><?php echo $data['alamat']; ?></td>							
													<td style="background: #69f2ff;"><?php echo $data['no_po']; ?></td>		
													<td style="background: #69f2ff;">
														<?php if($data['title']==null){
															echo "";
															}else{?>
																<!-- <a class="label label-success" 
																	href="<?php echo base_url(); ?>Order_list/download/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a> -->
																<a class="label label-success" target="_blank"
																	href="<?php echo base_url(); ?>upload/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a>
															<?php }?>
													</td>					
													<td style="background: #69f2ff;">
														<?php
															echo $data['tanggal_request'];
															$date_ = strtotime($data['tanggal_request']); 
															$dday = date("D", $date_);
															echo " ("; echo strtoupper($dday);  echo ") ";
														?>
													</td>			
													<td style="background: #69f2ff;">
														<?php
															echo $data['tanggal_kirim'];
															$date_1 = strtotime($data['tanggal_kirim']); 
															$dday1 = date("D", $date_1);
															echo " ("; echo strtoupper($dday1);  echo ") "; 
														?>
													</td>
													<td style="background: #69f2ff;">
														<?php 
															if($data['tanggal_shipping']==null){
																echo "";
															}else{
																echo $data['tanggal_shipping'];
																$date_2 = strtotime($data['tanggal_shipping']); 
																$dday2 = date("D", $date_2);
																echo " ("; echo strtoupper($dday2);  echo ") ";
															}
														?>
													</td>
													<td style="background: #69f2ff;"><?php echo $data['catatan']; ?></td>
													<td style="background: #69f2ff;"><?php echo $data['keterangan']; ?></td>
													<td style="background: #69f2ff;">
														<!--
														<img style="width:50px; heigh:50px" 
															data-toggle="modal" 
															data-target="#myModal" 
															src='<?php echo base_url().'upload/'.$data['title']; ?>' 
															alt=''/>
															-->
														<?php if($data['title']==null){
															echo "No file attach";
															}else{?>
																<!--<iframe style="width:100px;" src='<?php echo base_url().'upload/'.$data['title']; ?>'></iframe>-->
																<a href="#myModal" data-toggle="modal" src='<?php echo base_url().'upload/'.$data['title']; ?>'>Preview</a> 
															<?php }?>	
													</td>
													<td style="background: #69f2ff;"><?php echo $data['description']; ?></td>
													<td style="background: #69f2ff;"><?php echo $data['nama_status_kirim']; ?></td>				
														<?php if($this->session->userdata("id_role")==5){?>
														<?php }else{?>
															<!-- <td style="text-align:center;width:100px;">
																<a style="border-radius: 25px;" id="openModalEditShipping1" 
																	href="#" class="btn btn-xs btn-primary" 
																	data-id_request="<?php echo $data['id_request']?>" 
																	data-id_detail_request="<?php echo $data['id_detail_request']?>" 
																	data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
																	data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
																	data-pers_numb1="<?php echo $data['pers_numb1']?>"
																	data-cust_ship="<?php echo $data['cust_ship']?>"
																	data-tipe="<?php echo "edit"?>" 
																	data-toggle="modal" 
																	data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
																</a>
															</td> -->
														<?php }?>
												</tr>
											<?php }else{?>
												<tr>				
													<td><?php echo $data['id_detail_request']; ?></td>								
													<td ><?php echo $data['nama']; ?></td>									
													<td ><?php echo $data['sname']; ?></td>									
													<td style="display:none;"><?php echo $data['no_request']; ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_sold']; ?></td>
													<td>
														<?php
															if($data['nama_transaksi']=="Penjualan"){
																echo "PO";
															}else if ($data['nama_transaksi']=="Tukar Guling"){
																echo "TG";
															}else{
																echo $data['nama_transaksi'];
															}  
														?>
													</td>
													<td>
														<?php 
															if($data['nama_product']=="FG Milk Botol 1 Liter                   "){
																echo "1 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
																echo "2 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
																echo "3 Ltr";
															}else{
																echo $data['nama_product']; 
															}
														?>
													</td>	
													<td><?php echo $data['qty']; ?></td>
													<td><?php echo $data['satuan']; ?></td>
													<td><?php echo $data['city']; ?></td>
													<td><?php echo $data['nama_cluster']; ?></td>
													<td><?php echo $data['alamat']; ?></td>							
													<td><?php echo $data['no_po']; ?></td>		
													<td>
														<?php if($data['title']==null){
															echo "";
															}else{?>
																<!-- <a class="label label-success" 
																	href="<?php echo base_url(); ?>Order_list/download/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a> -->
																<a class="label label-success" target="_blank"
																	href="<?php echo base_url(); ?>upload/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a>
															<?php }?>
													</td>	
													<td><?php if($data['tanggal_po'] != "0000-00-00"){echo $data['tanggal_po'];} ?></td>							
													<td>
														<?php
															echo $data['tanggal_request'];
															$date_3 = strtotime($data['tanggal_request']); 
															$dday3 = date("D", $date_3);
															echo " ("; echo strtoupper($dday3);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
															$date_4 = strtotime($data['tanggal_kirim']); 
															$dday4 = date("D", $date_4);
															echo " ("; echo strtoupper($dday4);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim2'];
														?>
													</td>
													<!-- <td>
														<?php
															echo $data['hari_kirim3'];
														?>
													</td> -->
													<!-- <td>
														<?php 
															if($data['tanggal_shipping']==null){
																echo "";
															}else{
																echo $data['tanggal_shipping'];
																$date_5 = strtotime($data['tanggal_shipping']); 
																$dday5 = date("D", $date_5);
																echo " ("; echo strtoupper($dday5);  echo ") "; 
															}
														?>
													</td> -->
													<td><?php echo $data['catatan']; ?></td>
													<!-- <td><?php echo $data['keterangan']; ?></td> -->
													<td>
														<!--
														<img style="width:50px; heigh:50px" 
															data-toggle="modal" 
															data-target="#myModal" 
															src='<?php echo base_url().'upload/'.$data['title']; ?>' 
															alt=''/>
															-->
														<?php if($data['title']==null){
															echo "No file attach";
															}else{?>
																<!--<iframe style="width:100px;" src='<?php echo base_url().'upload/'.$data['title']; ?>'></iframe>-->
																<a href="#myModal" data-toggle="modal" src='<?php echo base_url().'upload/'.$data['title']; ?>'>Preview</a> 
															<?php }?>	
													</td>
													<td><?php echo $data['description']; ?></td>
													<!-- <td><?php echo $data['nama_status_kirim']; ?></td>			 -->
														<?php if($this->session->userdata("id_role")==5){?>
														<?php }else{?>
															<!-- <td style="text-align:center;width:100px;">
																<a style="border-radius: 25px;" id="openModalEditShipping1" 
																	href="#" class="btn btn-xs btn-primary" 
																	data-id_request="<?php echo $data['id_request']?>" 
																	data-id_detail_request="<?php echo $data['id_detail_request']?>" 
																	data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
																	data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
																	data-pers_numb1="<?php echo $data['pers_numb1']?>" 
																	data-cust_ship="<?php echo $data['cust_ship']?>"
																	data-tipe="<?php echo "edit"?>" 
																	data-toggle="modal" 
																	data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
																</a>
															</td> -->
														<?php }?>
												</tr>
											<?php }?>
										<?php }else{?>
											<?php if($this->session->userdata("username")=="agus.setiyono@gg-foods.com"){?>
											<tr>				
												<td><?php echo $data['id_detail_request']; ?></td>
												<td>
													<input type="checkbox" id="myCheck" onclick="contoh(this)" >
												</td>								
												<td ><?php echo $data['nama']; ?></td>									
													<td ><?php echo $data['sname']; ?></td>									
												<td style="display:none;"><?php echo $data['no_request']; ?></td>						
												<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
												<td><?php echo $data['cust_sold']; ?></td>
												<td>
													<?php
														if($data['nama_transaksi']=="Penjualan"){
															echo "PO";
														}else if ($data['nama_transaksi']=="Tukar Guling"){
															echo "TG";
														}else{
															echo $data['nama_transaksi'];
														}  
													?>
												</td>
												<td>
													<?php 
														if($data['nama_product']=="FG Milk Botol 1 Liter                   "){
															echo "1 Ltr";
														}else if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
															echo "2 Ltr";
														}else if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
															echo "3 Ltr";
														}else{
															echo $data['nama_product']; 
														}
													?>
												</td>	
												<td><?php echo $data['qty']; ?></td>
												<td><?php echo $data['satuan']; ?></td>
												<td><?php echo $data['city']; ?></td>
												<td><?php echo $data['nama_cluster']; ?></td>
												<td><?php echo $data['alamat']; ?></td>							
												<td><?php echo $data['no_po']; ?></td>		
												<td>
													<?php if($data['title']==null){
														echo "";
														}else{?>
															<!-- <a class="label label-success" 
																href="<?php echo base_url(); ?>Order_list/download/<?php echo $data['title']; ?>">
																<i class="glyphicon glyphicon-download"></i>
															</a> -->
															<a class="label label-success" target="_blank"
																href="<?php echo base_url(); ?>upload/<?php echo $data['title']; ?>">
																<i class="glyphicon glyphicon-download"></i>
															</a>
														<?php }?>
												</td>								
												<td>
													<?php
														echo $data['tanggal_request'];
														$date_3 = strtotime($data['tanggal_request']); 
														$dday3 = date("D", $date_3);
														echo " ("; echo strtoupper($dday3);  echo ") "; 
													?>
												</td>
												<td>
													<?php
														echo $data['tanggal_kirim'];
														$date_4 = strtotime($data['tanggal_kirim']); 
														$dday4 = date("D", $date_4);
														echo " ("; echo strtoupper($dday4);  echo ") "; 
													?>
												</td>
												<td>
													<?php 
														if($data['tanggal_shipping']==null){
															echo "";
														}else{
															echo $data['tanggal_shipping'];
															$date_5 = strtotime($data['tanggal_shipping']); 
															$dday5 = date("D", $date_5);
															echo " ("; echo strtoupper($dday5);  echo ") "; 
														}
													?>
												</td>
												<td><?php echo $data['catatan']; ?></td>
												<td><?php echo $data['keterangan']; ?></td>
												<td>
													<!--
													<img style="width:50px; heigh:50px" 
														data-toggle="modal" 
														data-target="#myModal" 
														src='<?php echo base_url().'upload/'.$data['title']; ?>' 
														alt=''/>
														-->
													<?php if($data['title']==null){
														echo "No file attach";
														}else{?>
															<!--<iframe style="width:100px;" src='<?php echo base_url().'upload/'.$data['title']; ?>'></iframe>-->
															<a href="#myModal" data-toggle="modal" src='<?php echo base_url().'upload/'.$data['title']; ?>'>Preview</a> 
														<?php }?>	
												</td>
												<td><?php echo $data['description']; ?></td>
												<td><?php echo $data['nama_status_kirim']; ?></td>
												<?php if($data['id_jenis_transaksi']==1){?>				
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 1 Liter                   ") {
														echo $data['h1']; 
														}?>
													</td>
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 1 Liter                   ") {
														echo $data['r1']; 
														}?>
													</td>
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
														echo $data['h2']; 
														}?>
													</td>
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
														echo $data['r2']; 
														}?>
													</td>
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
															echo $data['h3']; 
														}?>
													</td>
													<td>
														<?php if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
															echo $data['r3']; 
														}?>
													</td>
												<?php }else {?>				
													<td>	
													</td>
													<td>
													</td>
													<td>
													</td>
													<td>	
													</td>
													<td>
													</td>
													<td>
													</td>
												<?php }?>				
													<?php if($this->session->userdata("id_role")==5){?>
													<?php }else{?>
														<!-- <td style="text-align:center;width:100px;">
															<a style="border-radius: 25px;" id="openModalEditShipping1" 
																	href="#" class="btn btn-xs btn-primary" 
																	data-id_request="<?php echo $data['id_request']?>" 
																	data-id_detail_request="<?php echo $data['id_detail_request']?>" 
																	data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
																	data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
																	data-pers_numb1="<?php echo $data['pers_numb1']?>" 
																	data-cust_ship="<?php echo $data['cust_ship']?>"
																	data-tipe="<?php echo "edit"?>" 
																	data-toggle="modal" 
																	data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
																</a>
														</td> -->
													<?php }?>
											</tr>
											<?php }else{?>
												<tr>				
													<td><?php echo $data['id_detail_request']; ?></td>
													<!-- <td>
														<input type="checkbox" id="myCheck" onclick="contoh(this)" >
													</td> -->								
													<td ><?php echo $data['nama']; ?></td>									
													<td ><?php echo $data['sname']; ?></td>									
													<td style="display:none;"><?php echo $data['no_request']; ?></td>						
													<td style="display:none;"><?php echo $data['cust_sold']; ?></td>
													<td><?php echo $data['cust_sold']; ?></td>
													<td>
														<?php
															if($data['nama_transaksi']=="Penjualan"){
																echo "PO";
															}else if ($data['nama_transaksi']=="Tukar Guling"){
																echo "TG";
															}else{
																echo $data['nama_transaksi'];
															}  
														?>
													</td>
													<td>
														<?php 
															if($data['nama_product']=="FG Milk Botol 1 Liter                   "){
																echo "1 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 2 Liter                   "){
																echo "2 Ltr";
															}else if($data['nama_product']=="FG Milk Botol 3 Liter                   "){
																echo "3 Ltr";
															}else{
																echo $data['nama_product']; 
															}
														?>
													</td>	
													<td><?php echo $data['qty']; ?></td>
													<td><?php echo $data['satuan']; ?></td>
													<td><?php echo $data['city']; ?></td>
													<td><?php echo $data['nama_cluster']; ?></td>
													<td><?php echo $data['alamat']; ?></td>							
													<td><?php echo $data['no_po']; ?></td>		
													<td>
														<?php if($data['title']==null){
															echo "";
															}else{?>
																<!-- <a class="label label-success" 
																	href="<?php echo base_url(); ?>Order_list/download/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a> -->
																<a class="label label-success" target="_blank"
																	href="<?php echo base_url(); ?>upload/<?php echo $data['title']; ?>">
																	<i class="glyphicon glyphicon-download"></i>
																</a>
															<?php }?>
													</td>								
													<td><?php if($data['tanggal_po'] != "0000-00-00"){echo $data['tanggal_po'];} ?></td>							
													<td>
														<?php
															echo $data['tanggal_request'];
															$date_3 = strtotime($data['tanggal_request']); 
															$dday3 = date("D", $date_3);
															echo " ("; echo strtoupper($dday3);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['tanggal_kirim'];
															$date_4 = strtotime($data['tanggal_kirim']); 
															$dday4 = date("D", $date_4);
															echo " ("; echo strtoupper($dday4);  echo ") "; 
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim'];
														?>
													</td>
													<td>
														<?php
															echo $data['hari_kirim2'];
														?>
													</td>
													<!-- <td>
														<?php
															echo $data['hari_kirim3'];
														?>
													</td> -->
													<!-- <td>
														<?php 
															if($data['tanggal_shipping']==null){
																echo "";
															}else{
																echo $data['tanggal_shipping'];
																$date_5 = strtotime($data['tanggal_shipping']); 
																$dday5 = date("D", $date_5);
																echo " ("; echo strtoupper($dday5);  echo ") "; 
															}
														?>
													</td> -->
													<td><?php echo $data['catatan']; ?></td>
													<!-- <td><?php echo $data['keterangan']; ?></td> -->
													<td>
														<!--
														<img style="width:50px; heigh:50px" 
															data-toggle="modal" 
															data-target="#myModal" 
															src='<?php echo base_url().'upload/'.$data['title']; ?>' 
															alt=''/>
															-->
														<?php if($data['title']==null){
															echo "No file attach";
															}else{?>
																<!--<iframe style="width:100px;" src='<?php echo base_url().'upload/'.$data['title']; ?>'></iframe>-->
																<a href="#myModal" data-toggle="modal" src='<?php echo base_url().'upload/'.$data['title']; ?>'>Preview</a> 
															<?php }?>	
													</td>
													<td><?php echo $data['description']; ?></td>		
														<?php if($this->session->userdata("id_role")==5){?>
														<?php }else{?>
															<!-- <td style="text-align:center;width:100px;">
																<a style="border-radius: 25px;"  id="openModalEditShipping1" 
																	href="#" class="btn btn-xs btn-primary" 
																	data-id_request="<?php echo $data['id_request']?>" 
																	data-id_detail_request="<?php echo $data['id_detail_request']?>" 
																	data-id_shipping_point="<?php echo $data['id_shipping_point']?>" 
																	data-tanggal_shipping="<?php echo $data['tanggal_kirim']?>" 
																	data-pers_numb1="<?php echo $data['pers_numb1']?>"
																	data-cust_ship="<?php echo $data['cust_ship']?>" 
																	data-tipe="<?php echo "edit"?>" 
																	data-toggle="modal" 
																	data-target="#ModalEditDetail"><i class="fa fa-edit"></i> Update
																</a>
															</td> -->
														<?php }?>
												</tr>
											<?php }?>
										<?php }?>
									<?php $no++; }?>	
								</tbody>	
							</table>
							<div style="margin-bottom: 20px;" class="row">
								<div class="col-md-12 text-center">
									<!--
									<a class="btn btn-ms btn-success text-center" 
										href="<?php echo base_url().'Order_list/cetak/'.$tanggal_mulai.'/'.
										$tanggal_sampai.'/'.$nama_karyawan; ?>" <?php echo $disable; ?> 
										onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); 
										return false;">
										<i class="ace-icon fa fa-print"></i>
										<span class="bigger-110">Print</span>
									</a>
									-->	
									<?php if($this->session->userdata("username")=="agus.setiyono@gg-foods.com"){?>
										<a class="btn btn-ms btn-success text-center" style="margin-top:10px"
											href="#" onclick="window.location.reload();" 
											<?php echo $disable; ?>>
											<i class="glyphicon glyphicon-check"></i>
											<span class="bigger-110"> Tandai Sudah dibaca</span>
										</a>
										<a class="btn btn-ms btn-primary text-center" style="margin-top:10px"
											href="javascript://" onclick="exportOrderList('xls');"
											<?php echo $disable; ?>>
											<i class="glyphicon glyphicon-export"></i>
											<span class="bigger-110"> Export to Excel</span>
										</a>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body text-center">
					<iframe style="width:700px; height:400px" class="img-responsive" src=""></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ModalEditDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div style="border-radius:25px;" class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update Data Customer Order</h4>
								</div>
								<div class="modal-body">
										<form  class="form-horizontal"  action="<?php echo base_url(); ?>Order_list/save" method="post"/>	
											<input id="tipe" type="hidden" name="tipe">
											<input id="id_shipping" type="hidden" name="id_shipping">
											<input id="id_request_ol" type="hidden" name="id_request">
											<input id="id_detail_request" type="hidden" name="id_detail_request">
											<input id="tanggal_mulai1" type="hidden" name="tanggal_mulai">
											<input id="tanggal_sampai1" type="hidden" name="tanggal_sampai">
											<input id="kode_shipping_point1" type="hidden" name="kode_shipping_point">
											<input id="nama_status_kirim1" type="hidden" name="nama_status_kirim">
											<input id="cust_ship" type="hidden" name="cust_ship">
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
															<input id="tgl3" style="width:60%;" class="form-control " type="text" name="tanggal_shipping" required>						
														</div>
													</td>
												</tr>
											</table>
											<div class="clearfix form-actions">
												<div class="col-md-offset-3 col-md-9">
													<button style="border-radius:25px" class="btn btn-ms btn-success">
														<i class="ace-icon fa fa-edit bigger-110"></i>
														Simpan
													</button>
													<!-- &nbsp; &nbsp; &nbsp; -->
													<button type="button" class="btn btn-ms btn-standar" style="border-radius:25px; margin-left: 40px;" data-dismiss="modal"> 
														<i class="ace-icon fa fa-undo bigger-110">	</i>Batal
													</button>
													<!-- <a href="<?php echo base_url(); ?>shipment" class="btn btn-primary" type="reset">
														<i class="ace-icon fa fa-undo bigger-110"></i>
														Batal
													</a>  -->
												 </div>
											</div>					
										</form>			
								</div>		   
						</div>
					</div>
			</div>		 