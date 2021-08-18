<!DOCTYPE html>
<html>
<head>
	<title>REPORT RENCANA</title>

	<style>

	.tbl-inv {
		border-collapse: collapse;
	}
	.tbl-inv th, .tbl-inv td {		
		border: 1px solid #000;
		text-align: center;
		padding: 5px;
	}

	.tbl-invln {
		border-collapse: collapse;
	}
	.tbl-invln td {			
		text-align: center;
		padding: 5px;
	}
	
	</style>
</head>
<body>
<div style="text-align: center">
	<h2 style="margin:0;">PT Great Giant Livestock</h2>
</div>

<hr/>
<br/>
<div style="text-align: center">
	<h4 style="margin:0;"><u>REPORT RENCANA</u></h4>
	<br><br>
</div>

<table >
	<!--
	<tr>
		<th style="width: 50%;">Nama </th>
		<th style="width: 50%;"> :</th>
		<th style="width: 50%;"><?php echo $nama_karyawan; ?></th>
	</tr>-->
	<tr>
		<th style="width: 25%;">Tanggal</th>
		<th style="width: 25%;"> :</th>
		<th style="width: 25%;"><?php echo $tanggal; echo " sampai "; echo "$tanggal1";?></th>
	</tr>
</table>
<br/>

<table class="tbl-inv">
	<tr>
		<th style="width: 3%;  font-size: 10px;"><p>NO</p></th>
		<th style="width: 20%;  font-size: 10px;"><p>NOMOR RENCANA</p></th>
		<th style="width: 20%;  font-size: 10px;"><p>NAMA SALES</p></th>
		<th style="width: 20%;  font-size: 10px;"><p>NAMA CUSTOMER</p></th>
		<th style="width: 15%;  font-size: 10px;"><p>TANGGAL RENCANA</p></th>
		<th style="width: 15%;  font-size: 10px;"><p>STATUS REALISASI</p></th>
	</tr>
	
	<?php $no = 1; foreach($rencana_detail->result_array() as $data) {  ?>
	<tr>
		<td><?php echo $no; ?></td>
		<td style="text-align: left; font-size: 10px;"><?php echo $data['nomor_rencana']; ?> </td>
		<td style="text-align: left; font-size: 10px;"><?php echo $data['nama']; ?> </td>
		<td style="text-align: left; font-size: 10px;"><?php echo $data['nama_customer']; ?></td>
		<td style="text-align: left; font-size: 10px;"><?php echo $data['tanggal_rencana']; ?></td>
		<td>
			<?php 
				if($data['status_rencana'] =='0'){
					echo "Belum terealisasi";
				}else if ($data['status_rencana'] =='1'){
					echo "Checkin";
				}else if($data['status_rencana'] == '2'){
					echo "Checkout (Terealisasi)";
				}else{
					echo "Rencana Dibatalkan";
				}?>
		</td>
	</tr>
	<?php 
	$no++;
	} ?>
</table>

<br/>
<br/>
<br/>

<table>
	<tr>
		<td style="padding:15px;width: 520px;">
			<p>Mengetahui <br> </p>
			<br/><br/><br/><br/>
			<?php 
				if($nama_karyawan==""){
					echo '<span style="color:#ffffff;text-align:center;">nama</span>';
				}else{
					echo $nama_karyawan;
				}  ?>
			<p style="margin: 0">_____________________</p>
			<p ><?php echo "Pelaksana"; ?></p>
		</td>
		<td style="width: 300px;">
			<p>Mengetahui <br> </p>
			<br/><br/><br/><br/>
			<?php echo '<span style="color:#ffffff;text-align:center;">nama</span>'; ?>
			<p style="margin: 0">_____________________</p>
			<p ><?php echo "Kepala Divisi"; ?></p>
		</td>
	</tr>
</table>
</body>
</html>
