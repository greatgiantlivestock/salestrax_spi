<!DOCTYPE html>
<html>
<head>
	<title>REKAP SALESMAN ACTIVITY REPORT</title>

	<style>

	.tbl-inv {
		border-collapse: collapse;
	}
	.tbl-inv th, .tbl-inv td {		
		border: 1px solid #000;
		text-align: center;
		padding: 2px;
	}

	.tbl-invln {
		border-collapse: collapse;
	}
	.tbl-invln td {			
		text-align: center;
		padding: 2px;
	}
	
	</style>
</head>
<body>
<div style="text-align: center">
	<h2 style="margin:0;">Rekap Kegiatan Sales/MD</h2>
</div>

<hr/>
<!-- <div style="text-align: center">
	<h4 style="margin:0;"><u>REKAP BIAYA PENGGANTI KEGIATAN SALES & DELIVERY</u></h4>
	<br><br>
</div> -->

<table >
	<?php $data_ = $detail_visit->row();?>
	<tr>
		<th style="width: 25%;">Nama Sales/MD </th>
		<th style="width: 25%;"> :</th>
		<th style="width: 25%;"><?php echo $data_->nama_karyawan; ?></th>
	</tr>
	
	<tr>
		<th style="width: 25%;">Tanggal Rencana</th>
		<th style="width: 25%;"> :</th>
		<th style="width: 25%;"><?php echo $data_->tanggal_rencana; ?></th>
	</tr>
		
</table>
<br/>

<table class="tbl-inv" cellspacing="0">
				<thead>
						<tr>
							<th style="width:25px;">No</th>									
							<th style="width:125px;">Kunjungan</th>									
							<th style="width:125px;">Checkin</th>									
							<th style="width:125px;">Display</th>									
							<th style="width:125px;">Chiller</th>
							<th style="width:125px;">Kompetitor</th>
							<th style="width:125px;">Aktifitas SPG</th>
						</tr> 
					</thead>

					<tbody>
								<?php
								$no = 1;
								$jum_total = 0;		
										foreach($detail_visit->result_array() as $data) { ?>
										<tr>
											<td style="width:25px;"<?php if($data['prospect'] == 1){?> Style="width:25px; background:#ee8033;"<?php }?>>
												<?php echo $no; ?>
											</td>										
											<td style="width:125px;"<?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php echo $data['nama_customer']; ?>
												<br>
												<?php echo $data['tanggal_checkout']; ?>
											</td>						
											<td style="width:125px;" <?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php if($data['foto']){?>
													<?php if($data['prospect'] == 1){?>
														<img style="width:125px; height:125px"; src="<?php echo base_url(); echo "/upload/prospect/";echo $data['foto']; ?>" border="0"/> <br>
													<?php }else{?>
														<img style="width:125px; height:125px"; src="<?php echo base_url();  echo "/upload/checkin/";echo $data['foto']; ?>" border="0"/> <br>
													<?php }?>
												<?php }?>
											</td>						
											<td style="width:125px;" <?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php if($data['foto_display']){?>
													<img style="width:125px; height:125px"; src="<?php echo base_url();  echo "/upload/display_report/";echo $data['foto_display']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_display']; ?>
												<?php }?>
											</td>						
											<td style="width:125px;" <?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php if($data['foto_chiller']){?>
													<img style="width:125px; height:125px"; src="<?php echo base_url();  echo "/upload/chiller_report/";echo $data['foto_chiller']; ?>" border="0"/> <br>
													<?php echo "Suhu Chiller "; echo $data['suhu']; echo " Derajat C"; ?>
												<?php }?>
											</td>						
											<td style="width:125px;" <?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php if($data['foto_kompetitor']){?>
													<img style="width:125px; height:125px"; src="<?php echo base_url();  echo "/upload/kompetitor_report/";echo $data['foto_kompetitor']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_kompetitor']; ?>
												<?php }?>
											</td>						
											<td style="width:125px;" <?php if($data['prospect'] == 1){?> Style="width:125px; background:#ee8033;"<?php }?>>
												<?php if($data['foto_spg']){?>
													<img style="width:125px; height:125px"; src="<?php echo base_url();  echo "/upload/spg_report/";echo $data['foto_spg']; ?>" border="0"/> <br>
													<?php echo $data['keterangan_spg']; ?>
												<?php }?>
											</td>						
										</tr>
										<?php
										$no++; } ?>
					</tbody>
</table>

<br/>
<br/>
<br/>

<!-- <table cellspacing="0">
	<tr>
		<th style="width: 30%;  font-size: 10px;">
			<p align="center">
				<p>Prepared by</p>
				<br/><br/><br/><br/>
				<p style="margin: 0">_____________________</p>
				<p >Sales Admin</p>
			</p>
		</th>
		<th style="width: 30%; font-size: 10px;">
			<p align="center">
				<p>Acknowledged by,</p>
				<br/><br/><br/><br/>
				<p style="margin: 0">_____________________</p>
				<p >Head Depo</p>
			</p>
		</th>
		<th style="width: 40%; font-size: 10px;">
			<p align="center">
				<p>Approved by</p>
				<br/><br/><br/><br/>
				<p style="margin: 0">______________________________</p>
				<p >Sales Manager / Commercial Manager</p>
			</p>
		</th>
	</tr>
</table> -->
</body>
</html>
