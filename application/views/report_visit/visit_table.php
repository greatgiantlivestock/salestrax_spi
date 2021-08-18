	<div class="widget-box widget-color-red" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title"><i class="fa fa-shopping-cart"> </i> <?php echo $judul; ?></h5>
		</div>
		<div class="widget-body">
		<form class="form-horizontal"  action="<?php echo base_url(); ?>penjualan/lihat_report" method="post"/>

			<input type="hidden" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>">
			
			<input type="hidden" name="tipe" value="<?php echo $tipe; ?>">
			
			<div class="widget-main">
				<div class="row">
					<div class="col-md-8">
						<table class="tbl_input">
							<tr>
								<td>
									Tanggal Mulai
								</td>
								<td>
									<div class="input-group col-xs-8">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl" class="form-control " type="text" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>" required>						
									</div>
								</td>

								<td>
									Tanggal Sampai
								</td>
								<td>
									<div class="input-group col-xs-8">
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
										<input <?php echo $color; ?> id="tgl2" class="form-control " type="text" name="tanggal_sampai" value="<?php echo $tanggal_sampai; ?>" required>						
									</div>
								</td>
							</tr>
							<?php if($this->session->userdata('id_role') <= 4){ ?>
								<tr>
									<td>
										Nama Karyawan
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_karyawan">
											<?php echo $combo_user; ?>
										</select>
									</td>
								</tr>
							<?php }else{?>
								<tr>
									<td>
										Nama Karyawan
									</td>
									<td>
										<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="nama_karyawan">
											<?php echo $combo_user; ?>
										</select>
									</td>
								</tr>
							<?php }?>				
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
					<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 					<?php } ?>
 						</a>
						<div style="margin-bottom: 20px;" class="row">
							<div class="col-md-12 text-center">
								
								<a class="btn btn-xs btn-success text-center" 
									href="<?php echo base_url().'penjualan/cetak/'.$tanggal_mulai.'/'.
									$tanggal_sampai.'/'.$nama_karyawan; ?>" <?php echo $disable; ?> 
									onclick="window.open(this.href, 'newwindow', 'width=600, height=470'); 
									return false;">
									<i class="ace-icon fa fa-print"></i>
									<span class="bigger-110">Print</span>
								</a>
								
								<a class="btn btn-xs btn-primary text-center"
									href="javascript://" onclick="exportDailyVisit('xls');"
									<?php echo $disable; ?>>
									<i class="glyphicon glyphicon-export"></i>
									<span class="bigger-110"> Export to Excel</span>
								</a>
								
							</div>
						</div>
						<table id="sample-table-2" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="background: #22313F;color:#fff;">No</th>									
									<th style="background: #22313F;color:#fff;">Nama Sales</th>									
									<th style="background: #22313F;color:#fff;">No Rencana</th>									
									<th style="background: #22313F;color:#fff;">Realisasi</th>									
									<th style="background: #22313F;color:#fff;">Nama Customer</th>									
									<th style="background: #22313F;color:#fff;">Alamat</th>
									<th style="background: #22313F;color:#fff;">No HP</th>
									<th style="background: #22313F;color:#fff;">Nama Usaha</th>
									<th style="background: #22313F;color:#fff;">Waktu Checkin</th>
									<th style="background: #22313F;color:#fff;">Waktu Checkout</th>
									<th style="background: #22313F;color:#fff;">Lokasi Checkin</th>
									<th style="background: #22313F;color:#fff;">Jarak Tempuh</th>
									<th style="background: #22313F;color:#fff;">Kendaraan</th>
								</tr> 
							</thead>

							<tbody>
								<?php
								$no = 1;
								$jum_total = 0;
								if($this->session->userdata("id_role") <=2){
									$q_tarik_data = $this->db->query("SELECT * FROM ((SELECT mu.nama,trm.nomor_rencana,mst.nama_customer,mst.no_hp,
									mst.alamat,mst.nama_usaha,ckout.alamat_gps,ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis 
									FROM mst_customer mst JOIN trx_checkin ckin ON mst.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama_karyawan%'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									UNION
									(SELECT mu.nama,trm.nomor_rencana,tmp.nama_customer,tmp.no_hp,tmp.alamat,tmp.nama_usaha,ckout.alamat_gps,
									ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis
									FROM tmp_customer tmp JOIN trx_checkin ckin ON tmp.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama_karyawan%'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									ORDER BY nama_customer)AS union_ ORDER BY nama");
								}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
									$departemen=$this->session->userdata('id_departemen');
									$q_tarik_data = $this->db->query("SELECT * FROM ((SELECT mu.nama,trm.nomor_rencana,mst.nama_customer,mst.no_hp,
									mst.alamat,mst.nama_usaha,ckout.alamat_gps,ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis 
									FROM mst_customer mst JOIN trx_checkin ckin ON mst.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama_karyawan%' and mu.id_departemen = '$departemen'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									UNION
									(SELECT mu.nama,trm.nomor_rencana,tmp.nama_customer,tmp.no_hp,tmp.alamat,tmp.nama_usaha,ckout.alamat_gps,
									ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis 
									FROM tmp_customer tmp JOIN trx_checkin ckin ON tmp.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama_karyawan%' and mu.id_departemen = '$departemen'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									ORDER BY nama_customer)AS union_ ORDER BY nama");
								}else if($this->session->userdata("id_role") == 5){
									$departemen=$this->session->userdata('id_departemen');
									$nama=$this->session->userdata('nama');
									$q_tarik_data = $this->db->query("SELECT * FROM ((SELECT mu.nama,trm.nomor_rencana,mst.nama_customer,mst.no_hp,
									mst.alamat,mst.nama_usaha,ckout.alamat_gps,ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis 
									FROM mst_customer mst JOIN trx_checkin ckin ON mst.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama%' and mu.id_departemen = '$departemen'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									UNION
									(SELECT mu.nama,trm.nomor_rencana,tmp.nama_customer,tmp.no_hp,tmp.alamat,tmp.nama_usaha,ckout.alamat_gps,
									ckout.jarak,ckin.tanggal_checkin,ckout.tanggal_checkout,ckout.realisasi_kegiatan,nama_jenis 
									FROM tmp_customer tmp JOIN trx_checkin ckin ON tmp.kode_customer=ckin.kode_customer
									JOIN trx_rencana_master trm ON ckin.id_rencana_header = trm.id_rencana_header
									JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin 
									JOIN mst_user mu ON mu.id_user = ckout.id_user
									JOIN jenis_kendaraan jk ON ckout.id_jenis_kendaraan = jk.id_jenis_kendaraan
									WHERE mu.nama LIKE '%$nama%' and mu.id_departemen = '$departemen'
									AND ckout.tanggal_checkout between '$tanggal_mulai 00:00:00' and '$tanggal_sampai 23:59:59')
									ORDER BY nama_customer)AS union_ ORDER BY nama");
								}else{
									redirect("Error");
								}
								
								//if($q_tarik_data != "") {
									//if(!empty($q_tarik_data->result_array())) { 
										
										foreach($q_tarik_data->result_array() as $data) { ?>
										<tr>
											<td><?php echo $no; ?></td>						
											<td><?php echo $data['nama']; ?></td>						
											<td><?php echo $data['nomor_rencana']; ?></td>						
											<td><?php echo $data['realisasi_kegiatan']; ?></td>						
											<td><?php echo $data['nama_customer']; ?></td>						
											<td><?php echo $data['alamat']; ?></td>
											<td><?php echo $data['no_hp']; ?></td>
											<td><?php echo $data['nama_usaha']; ?></td>
											<td><?php echo $data['tanggal_checkin']; ?></td>
											<td><?php echo $data['tanggal_checkout']; ?></td>
											<td><?php echo $data['alamat_gps']; ?></td>
											<td><?php echo $data['jarak'].' Km'; ?></td>
											<td><?php echo $data['nama_jenis']; ?></td>
										</tr>
										<?php
										$no++; } ?>
							</tbody>							
						</table>
					</div>
				</div>

			</div>


		</div>
	</div>


 <div class="modal fade" id="ModalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Input Produk</h4>
            </div>
            <div class="modal-body">

            	<p id="error"></p>

            	 	<form  class="form-horizontal" action="<?php echo base_url(); ?>penjualan/save_detail" method="post"/>
						<input id="tipe" type="hidden" name="tipe" readonly>	
						<input id="id_keluarmaster" type="hidden" name="id_keluarmaster" value="<?php echo $id_keluarmaster; ?>" readonly>			
						<input id="id_keluardetail" type="hidden" name="id_keluardetail" readonly>			

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Product </label>

							<div class="col-sm-9">
								<select class="select2" id="product_jual" style="width:60%;" name="id_product" required>
									<?php echo $combo_product; ?>
								</select>
							</div>
						</div>		

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Harga </label>

							<div class="col-sm-9">
								<input id="harga" style="width:30%;" type="text" name="harga" required/>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Batch </label>

							<div class="col-sm-9">
								<select id="batch" class="select_batch" style="width:60%;" name="batch" required>
									<?php echo $combo_batch; ?>
								</select>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> QTY </label>

							<div class="col-sm-9">
								<input id="qty" style="width:20%;" type="text" name="qty" required/>
							</div>
						</div>		
					
            
	            <div class="modal-footer">
			        <button id="simpan_jual" class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			  </form>
			
			</div>
		   
        </div>
    </div>
</div>

 <div class="modal fade" id="ModalHapusJual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Produk</h4>
            </div>
            <div class="modal-body">

            	 	<form  class="form-horizontal"  action="<?php echo base_url(); ?>penjualan/hapus_detail" method="post" />
						<input id="id_keluarmaster" type="hidden" name="id_keluarmaster" readonly>			
						<input id="id_keluardetail" type="hidden" name="id_keluardetail" readonly>			

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Product </label>

							<div class="col-sm-9">
								<input id="product" style="width:60%;" type="text" name="product" readonly/>
							</div>
						</div>		

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Harga </label>

							<div class="col-sm-9">
								<input id="harga" style="width:60%;" type="text" name="harga" readonly/>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Batch </label>

							<div class="col-sm-9">
								<input id="batch" style="width:60%;" type="text" name="batch" readonly/>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> QTY </label>

							<div class="col-sm-9">
								<input id="qty" style="width:30%;" type="text" name="qty" readonly/>
							</div>
						</div>		
					
            
	            <div class="modal-footer">
			        <button class="btn btn-primary btn-sm">Hapus</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			  </form>
			
			</div>
		   
        </div>
    </div>
</div>


<?php 
	if($this->session->userdata("error_duplicate") == true) { 
		$this->session->unset_userdata('error_duplicate');
?>
<div class="modal fade" id="ModalInput2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Input Produk</h4>
            </div>
            <div class="modal-body">

            	<p id="error"></p>

            	 	<form  class="form-horizontal" action="<?php echo base_url(); ?>penjualan/save_detail" method="post"/>
						<input id="tipe" type="hidden" name="tipe" readonly>	
						<input id="id_keluarmaster" type="hidden" name="id_keluarmaster" value="<?php echo $id_keluarmaster; ?>" readonly>			
						<input id="id_keluardetail" type="hidden" name="id_keluardetail" readonly>			

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Product </label>

							<div class="col-sm-9">
								<select class="select2" id="product_jual2" style="width:60%;" name="id_product" required>
									<?php 
										$get_produk = $this->db->query("SELECT * FROM mst_product ORDER BY nama_product ASC");
										foreach($get_produk->result_array() as $item) { ?>
											<option value="<?php echo $item['id_product']; ?>" <?php if($item['id_product'] == $this->session->userdata("id_product")) { echo 'selected'; } ?>><?php echo $item['nama_product']; ?></option>	 
									<?php } ?>
								</select>
							</div>
						</div>		

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Harga </label>

							<div class="col-sm-9">
								<input id="harga" style="width:30%;" type="text" name="harga" value="<?php echo $this->session->userdata("harga"); ?>" required/>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> Batch </label>

							<div class="col-sm-9">
								<select id="batch2" class="select_batch" style="width:60%;" name="batch" required>
									<?php 
										$get_batch = $this->db->query("SELECT * FROM transfer_detail WHERE id_product = '".$this->session->userdata("id_product")."' GROUP BY batch ORDER BY batch DESC");
										foreach($get_batch->result_array() as $item) { ?>
											<option value="<?php echo $item['batch']; ?>" <?php if($item['batch'] == $this->session->userdata("batch")) { echo 'selected'; } ?>><?php echo $item['batch']; ?></option>	 
									<?php } ?>
								</select>
							</div>
						</div>	

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right"> QTY </label>

							<div class="col-sm-9">
								<input id="qty" style="width:20%;" type="text" name="qty" value="<?php echo $this->session->userdata("qty"); ?>" required/>
							</div>
						</div>		
					
            
	            <div class="modal-footer">
			        <button  class="btn btn-primary btn-sm">Simpan</button>
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
			    </div>

			  </form>
			
			</div>
		   
        </div>
    </div>
</div>

<script type="text/javascript">    
	$(document).ready(function(){
		$("#ModalInput2 #tipe").val("add");
		$('#ModalInput2').modal('show');
	});
</script>

<?php } ?>