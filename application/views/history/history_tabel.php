	<div class="widget-box " id="widget-box-9">

		<div class="widget-header">

			<h5 class="widget-title"><i class="fa fa-shopping-cart"> </i> <?php echo $judul; ?></h5>

		</div>

		<div class="widget-body">

		<form class="form-horizontal"  action="<?php echo base_url(); ?>History/lihat_report" method="post"/>



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

							</tr>



							<tr>

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
 trx_so_detail 
						</table>

					</div>

				</div>

				<div class="row">
 trx_so_detail 
					<div class="col-md-12">

						<hr/ style="margin-top: 10px; margin-bottom: 10px;">

						<?php echo $btn_nota; ?>

						<hr/ style="margin-top: 10px; margin-bottom: 10px;">

					</div> trx_so_detail 

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

								

								<a class="btn btn-xs btn-primary text-center"

									href="javascript://" onclick="exportHistory('xls');"

									<?php echo $disable; ?>>

									<i class="glyphicon glyphicon-download"></i>

									<span class="bigger-110"> Download</span>

								</a>

								

							</div>

						</div>

						<table id="sample-table-2" class="table table-striped table-bordered table-hover">

							<thead>

								<tr>									

									<th style="background: #22313F;color:#fff;">Sales</th>									

									<th style="background: #22313F;color:#fff;">Cst</th>									

									<th style="background: #22313F;color:#fff;">Prod</th>									

									<th style="background: #22313F;color:#fff;">Qty</th>									

									<th style="background: #22313F;color:#fff;">Unit</th>

								</tr> 

							</thead>



							<tbody>

								<?php

								$no = 1;

								$jum_total = 0;

								if($this->session->userdata("id_role") <=2){

									$q_tarik_data = $this->db->query("SELECT * FROM trx_so_header rs JOIN trx_so_detail dr 

																		ON rs.id_request = dr.id_request JOIN mst_user mu ON mu.id_user = rs.id_user

																		JOIN mst_customer mc ON mc.id_customer = rs.id_customer 

																		JOIN satuan s ON s.id_satuan=dr.id_satuan 

																		WHERE tanggal_request BETWEEN '$tanggal_mulai' and '$tanggal_sampai'

																		AND nama LIKE '%$nama_karyawan%'");

								}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){

									$departemen=$this->session->userdata('id_departemen');

									$q_tarik_data = $this->db->query("SELECT * FROM trx_so_header rs JOIN trx_so_detail dr 

																		ON rs.id_request = dr.id_request JOIN mst_user mu ON mu.id_user = rs.id_user

																		JOIN mst_customer mc ON mc.id_customer = rs.id_customer

																		JOIN satuan s ON s.id_satuan=dr.id_satuan  

																		WHERE tanggal_request BETWEEN '$tanggal_mulai' and '$tanggal_sampai'

																		AND id_departemen='$departemen' AND nama LIKE '%$nama_karyawan%'");

								}else if($this->session->userdata("id_role") == 5){

									$departemen=$this->session->userdata('id_departemen');

									$nama=$this->session->userdata('nama');

									$q_tarik_data = $this->db->query("SELECT * FROM trx_so_header rs JOIN trx_so_detail dr 

																		ON rs.id_request = dr.id_request JOIN mst_user mu ON mu.id_user = rs.id_user

																		JOIN mst_customer mc ON mc.id_customer = rs.id_customer

																		JOIN satuan s ON s.id_satuan=dr.id_satuan 

																		WHERE tanggal_request BETWEEN '$tanggal_mulai' and '$tanggal_sampai'

																		AND id_departemen='$departemen' AND nama LIKE '%$nama%'");

								}else{

									redirect("Error");

								}		

									foreach($q_tarik_data->result_array() as $data) { ?>

									<tr>				

										<td><?php echo $data['nama']; ?></td>						

										<td><?php echo $data['nama_customer']; ?></td>						

										<td><?php echo $data['nama_product']; ?></td>						

										<td><?php echo $data['qty']; ?></td>						

										<td><?php echo $data['nama_satuan']; ?></td>

									</tr>

									<?php } ?>

							</tbody>							

						</table>

					</div>

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