
<div class="page-header">
	<h1>
		<i class="fa fa-hdd-o"></i>
		<?php echo $judul; ?>
	</h1>
</div><!-- /.page-header -->

<div style="margin-bottom:20px;margin-top:20px;" class="row">
	<div class="col-sm-12 text-right">
		<a class="btn btn-pink btn-sm" href="<?php echo base_url();?>master_satuan/add"><i class="fa fa-plus"> </i> Tambah Data</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div> 
 		<?php } ?>
 		<?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div> 
 		<?php } ?>

				<table id="sample-table-2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:50px;">No</th>
							<th>Nama Satuan</th>
							<th style="width:120px;">Action</th>
						</tr>
					</thead>

					<tbody>
<?php
		$no = 1;
		foreach($master_satuan->result_array() as $data) { ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_satuan']; ?></td>
							<td style="text-align:center;width:100px;">
								<a class="label label-primary" href="<?php echo base_url().'master_satuan/edit/'.$data['id_satuan']; ?>"><span class="fa fa-edit"></span></a>
								<a class="label label-danger" href="<?php echo base_url().'master_satuan/hapus/'.$data['id_satuan']; ?>" onclick="return confirm('Yakin ingin hapus data ?');"><span class="fa fa-trash"></span></a>
							</td>
						</tr>
<?php 	$no++; } ?>
					</tbody>
				</table>
	</div>
</div>
