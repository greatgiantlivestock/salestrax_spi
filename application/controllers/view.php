<?php

if($_POST['id']){

	$id = $_POST['id'];

	$view = $koneksi->query("SELECT * FROM mst_user_shipping_point WHERE id_user='$id'");

	if($view->num_rows){

		$row_view = $view->id_shipping_point

		echo '

		<table class="table table-bordered">

			<tr>

				<th>NAMA LENGKAP</th>

				<td>'.$row_view['id_shipping_point_user'].'</td>

			</tr>

			<tr>

				<th>KELAS</th>

				<td>'.$row_view['description'].'</td>

			</tr>

		</table>

		';

	}

}

?>