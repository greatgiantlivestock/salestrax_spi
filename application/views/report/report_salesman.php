<!DOCTYPE html>
<html>
<head>
	<title>DAILY VISIT CUSTOMER</title>

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
	<h4 style="margin:0;"><u>DAILY VISIT CUSTOMER</u></h4>
	
</div>

<table >
	<tr>
		<th style="width: 50%;">Nama </th>
		<th style="width: 50%;"> :</th>
		<th style="width: 50%;"><?php echo $nama_karyawan; ?></th>
	</tr>
	<tr>
		<th style="width: 25%;">Tanggal</th>
		<th style="width: 25%;"> :</th>
		<th style="width: 25%;"><?php echo $tanggal; ?></th>
	</tr>
</table>
<br/>

<table class="tbl-inv" cellspacing="0">
	<tr>
		<th style="width: 5%;">NO</th>
		<th style="width: 25%;">NAMA CUSTOMER</th>
		<th style="width: 35%;">ALAMAT</th>
		<th style="width: 15%;">NO HP</th>
		<th style="width: 20%;">NAMA USAHA</th>
	</tr>
	
	<?php $no = 1; foreach($jual_detail->result_array() as $data) {  ?>
	<tr>
		<td><?php echo $no; ?></td>
		<td style="text-align: left;"><?php echo $data['nama_customer']; ?> </td>
		<td style="text-align: left;"><?php echo $data['alamat']; ?></td>
		<td><?php echo $data['no_hp']; ?></td>
		<td style="text-align: left;"><?php echo $data['nama_usaha']; ?></td>
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
		<td style="padding:15px;width: 520px;"">
			<p>Mengetahui <br> Pelaksana</p>
			<br/><br/><br/><br/>
			<p style="margin: 0">_____________________</p>
			<p ><?php echo $nama_karyawan; ?></p>
		</td>
		<td style="width: 300px;">
			<p>Mengetahui <br>Kepala Divisi</p>
			<br/><br/><br/><br/>
			<p style="margin: 0">_____________________</p>
			<p >Nama Kepala Divisi</p>
		</td>
	</tr>
</table>
</body>
</html>
