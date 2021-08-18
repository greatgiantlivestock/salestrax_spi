<div>					    
	<div class="widget-box" id="widget-box-9">
		<!-- <div class="widget-header">
			<h5 class="widget-title">
				<?php echo $judul; ?>
			</h5>
		</div> -->
		<div class="widget-body">
			<div class="widget-main">
				<table id="dataTables-example" width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Customer</th>
							<th>Product</th>
							<th>Qty</th>
							<th>Satuan</th>
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
							<td><?php echo $data['satuan']; ?></td>
						</tr>
		<?php 	$no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>