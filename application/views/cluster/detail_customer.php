<div>					    
	<div class="widget-box" id="widget-box-9">
		<div class="widget-header">
			<h5 class="widget-title">
				<?php echo $judul; ?>
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Kode Customer</th>
							<th>Nama Customer</th>
							<th>Cluster</th>
							<th>Aksi</th>
						</tr>
					</thead>
				<tbody>
		<?php
		$no = 1;
		foreach($cluster_data->result_array() as $data) { ?>
						<tr>
							<td><?php echo $data['kode_customer']; ?></td>
							<td><?php echo $data['nama_customer']; ?></td>
							<td><?php echo $data['nama_cluster']; ?></td>
							<td>
								<a href="<?php echo base_url().'Cluster/hapus_customer/'.
									$data['kode_customer']; ?>" class="label label-danger" 
									onclick="return confirm('Yakin ingin hapus data ?');"><i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
		<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>