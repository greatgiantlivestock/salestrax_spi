<script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>



<script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>



<script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>

<script>



	$(document).ready(function() {



		$('#dtb').DataTable({



			"dom":'<"toolbar">frtip',



			responsive: true,



			bPaginate: true,



			bLengthChange: false,
            
            "iDisplayLength": 1000,

			bFilter: true,



			bInfo: false,



			bAutoWidth: false,



			order: [[ 1, "desc" ]]



		});



	});



</script>

	<div  id="widget-box-9">

		<div class="widget-body">

		<form class="form-horizontal"  action="<?php echo base_url(); ?>Penjualan/lihat_report" method="post"/>

			<div class="widget-main">

				<div class="row">

					<div class="col-md-8">

						<table class="tbl_input">

							<tr>

								<td>

									Mulai Tanggal 

								</td>

								<td>

									<div class="input-group col-xs-8">

										<span class="input-group-addon">

											<i class="fa fa-calendar bigger-110"></i>

										</span>

										<input <?php echo $color; ?> class="form-control " type="date" name="mulai_tanggal" value="<?php echo $tanggal1; ?>" required>						

									</div>

								</td>



								<td>

									Sampai Tanggal 

								</td>

								<td>

									<div class="input-group col-xs-8">

										<span class="input-group-addon">

											<i class="fa fa-calendar bigger-110"></i>

										</span>

										<input <?php echo $color; ?> class="form-control " type="date" name="sampai_tanggal" value="<?php echo $tanggal2; ?>" required>						

									</div>

								</td>

							</tr>

							<!--<tr>-->

							<!--	<td>-->

							<!--		Customer-->

							<!--	</td>-->

							<!--	<td>-->

							<!--		<select style="width:80%;" <?php echo $color; ?> class="select_customer" name="id_customer" >-->

							<!--			<?php echo $combo_customer; ?>-->

							<!--		</select>-->

							<!--	</td>-->

							<!--</tr>				-->

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

				<div style="margin-bottom: 10px;" class="row">

							<div class="col-md-12 text-center">

								<a class="btn btn-xs btn-primary text-center"

									href="javascript://" onclick="exportStockFisik('xls');"

									<?php echo $disable; ?>>

									<i class="glyphicon glyphicon-export"></i>

									<span class="bigger-110"> Export to Excel</span>

								</a>

							</div>

						</div>

						<table id="dtb" width="100%" class="table table-striped table-bordered table-hover">

							<thead>

								<tr>

									<th style="background: #22313F;color:#fff;">No</th>									

									<th style="background: #22313F;color:#fff;">Customer</th>

									<th style="background: #22313F;color:#fff;">Tanggal Penjualan</th>										

									<th style="background: #22313F;color:#fff;">Nama Produk</th>										

									<th style="background: #22313F;color:#fff;">Qty</th>										

									<th style="background: #22313F;color:#fff;">Batch</th>									

									<th style="background: #22313F;color:#fff;">Tanggal Update</th>									

									<th style="background: #22313F;color:#fff;">Sales</th>

								</tr> 

							</thead>



							<tbody>

								<?php

								$no = 1;

								$jum_total = 0;		

										foreach($q_rekap_biaya->result_array() as $data) { ?>

										<tr>

											<td><?php echo $no; ?></td>						

											<td><?php echo $data['nama_customer']; ?></td>	

											<td><?php echo $data['date_from']; ?></td>						

											<td><?php echo $data['nama_product']; ?></td>						

											<td><?php echo $data['qty']; ?></td>						

											<td><?php echo $data['batch']; ?></td>						

											<td><?php echo $data['date_insert']; ?></td>						

											<td><?php echo $data['nama_karyawan'];?></td>

										</tr>

										<?php

										$no++; } ?>

							</tbody>

							</table>							

						</table>

					</div>

				</div>



			</div>

