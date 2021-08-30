<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_model extends CI_Model {
	public function cekLogin($in) {
		$username = $in['username'];
		$password = md5($in['password']);
		$q_login = $this->db->query("SELECT * FROM mst_user WHERE username='$username' AND password='$password' AND id_aplikasi='2'");
		if($q_login->num_rows() > 0) {
			foreach($q_login->result() as $data) { 
				$session['nama'] = $data->nama;
				$session['nama_login'] = $data->nama;
				$session['username'] = $data->username;
				$session['id_user'] = $data->id_user;
				$session['id_role'] = $data->id_role;
				$session['id_departemen'] = $data->id_departemen;
				$session['id_wilayah'] = $data->id_wilayah;
				$session['id_karyawan'] = $data->id_karyawan;
				$session['nama_karyawan'] = $data->nama_karyawan;
				$session['id_region'] = $data->id_region;
				$this->session->set_userdata($session);
				redirect("Dashboard");
			}
		}  else {
			$this->session->set_flashdata("error","Gagal Login, Username dan Password Salah");
			redirect("Login");
		}
	}
	public function cekLoginAndroid($in) {
		$username = $in['username'];
		$password = md5($in['password']);
		$mac = $in['mac'];
		$q_awo = $this->db->query("SELECT * FROM mst_user WHERE username='$username' AND password='$password' AND id_aplikasi='2'");
		if($q_awo->num_rows() > 0) {
			foreach($q_awo->result() as $data) {
				if($data->mac != $mac) {
					$res['out']['response'] = 'successy';
				} else {
					$res['out']['response'] = 'success';
				}
				$res['out']['id_awo'] = $data->id_karyawan;
				$res['out']['id_user'] = $data->id_user;
				$res['out']['nama_awo'] = $data->nama_karyawan;
				$res['out']['no_hp']=$data->no_hp;
				$res['out']['id_wilayah']=$data->id_wilayah;
				echo json_encode($res);
			}
		} else {
			$res['out']['response'] = 'successx';
			$res['out']['id_awo'] = "";
			$res['out']['id_user'] = "";
			$res['out']['nama_awo'] = "";
			$res['out']['no_hp'] = "";
			$res['out']['id_wilayah'] = "";
			echo json_encode($res);
		}
	}
	public function cekLoginAndroid1($in) {
		$username = $in['username'];
		$password = md5($in['password']);
		$mac = $in['mac'];
		$q_awo = $this->db->query("SELECT * FROM mst_user WHERE username='$username' AND password='$password' AND id_aplikasi='2'");
		if($q_awo->num_rows() > 0) {
			foreach($q_awo->result() as $data) {
				if($data->mac1 != $mac) {
					$res['out']['response'] = 'successy';
				} else {
					$res['out']['response'] = 'success';
				}
				$res['out']['id_awo'] = $data->id_karyawan;
				$res['out']['id_user'] = $data->id_user;
				$res['out']['nama_awo'] = $data->nama_karyawan;
				$res['out']['no_hp']=$data->no_hp;
				$res['out']['id_wilayah']=$data->id_wilayah;
				echo json_encode($res);
			}
		} else {
			$res['out']['response'] = 'successx';
			$res['out']['id_awo'] = "";
			$res['out']['id_user'] = "";
			$res['out']['nama_awo'] = "";
			$res['out']['no_hp'] = "";
			$res['out']['id_wilayah'] = "";
			echo json_encode($res);
		}
	}
	public function cekLoginAndroidAR($in) {
		$username = $in['username'];
		$password = md5($in['password']);
		$token = $in['token'];
		$q_awo = $this->db->query("SELECT * FROM master_pengguna WHERE username='$username' AND password='$password' AND id_aplikasi='2'");
		if($q_awo->num_rows() > 0) {
			foreach($q_awo->result() as $data) {
				$res['out']['response'] = 'success';
				$res['out']['id_karyawan'] = $data->id_karyawan;
				$res['out']['id_user'] = $data->id_user;
				$res['out']['nama_karyawan'] = $data->nama_karyawan;
				$res['out']['no_hp']=$data->no_hp;
				$res['out']['id_wilayah']=$data->id_wilayah;
				$res['out']['id_role']=$data->id_role;
				$res['out']['id_departemen']=$data->id_departemen;
				$res['out']['username']=$username;
				$res['out']['password']=$password;
				echo json_encode($res);
			}
			$inToken['token'] = $token;
			$inToken['username'] = $username;
			$inToken['active'] = 1;
			$inToken['date_insert'] = date("Y-m-d");
		    $this->db->insert("master_perangkat",$inToken);
		} else {
			$res['out']['response'] = 'successx';
			$res['out']['id_awo'] = "";
			$res['out']['id_user'] = "";
			$res['out']['nama_awo'] = "";
			$res['out']['no_hp'] = "";
			$res['out']['id_wilayah'] = "";
			echo json_encode($res);
		}
	}
	public function ceksvr1($in) {
		$q_awo = $this->db->query("SELECT master_perangkat.active FROM (SELECT max(id) as id FROM master_perangkat WHERE token='$in')as maxs JOIN master_perangkat ON master_perangkat.id=maxs.id");
		if($q_awo->num_rows() > 0) {
			foreach($q_awo->result() as $data) {
				$res['out']['response'] = 'success';
				$res['out']['active'] = $data->active;
				echo json_encode($res);
			}
		} else {
			$res['out']['response'] = 'successx';
			$res['out']['active'] = "";
			echo json_encode($res);
		}
	}	
	public function setLogoutAR($in) {
	   // $token = $in['token'];
	    $q = $this->db->query("DELETE FROM master_perangkat WHERE token='$in'");
	    return $q;
	}
	public function get_log($id_gudang) {
		$q = $this->db->query("SELECT mst_user.nama,mst_gudang.nama_gudang,log_transaksi.keterangan,log_transaksi.tanggal FROM log_transaksi LEFT JOIN mst_user ON mst_user.id_user = log_transaksi.id_user LEFT JOIN mst_gudang ON mst_gudang.id_gudang = log_transaksi.id_gudang WHERE log_transaksi.id_gudang = '$id_gudang' ORDER BY log_transaksi.id_log DESC");
		return $q;
	}
	public function get_barcode() {
		$q = $this->db->query("SELECT tmp_barcode.barcode,mst_product.nama_product FROM tmp_barcode JOIN process_master 
								ON tmp_barcode.id_rencana_header=process_master.id_rencana_header JOIN process_detail 
								ON process_master.id_rencana_header = process_detail.id_rencana_header JOIN mst_product 
								ON process_detail.id_product = mst_product.id_product 
								ORDER BY tmp_barcode.id_temp DESC");
		return $q;
	}
	public function get_master_customer() {
		$q = $this->db->query("SELECT * FROM mst_customer LEFT JOIN mst_group_customer ON mst_customer.id_group_customer = mst_group_customer.id_group_customer ORDER BY mst_customer.id_customer DESC");
		return $q;
	}
	public function get_master_gudang() {
		$q = $this->db->query("SELECT * FROM mst_gudang ORDER BY id_gudang DESC");
		return $q;
	}
	public function get_Master_group_customer() {
		$q = $this->db->query("SELECT * FROM mst_group_customer ORDER BY id_group_customer DESC");
		return $q;
	}
	public function get_master_satuan() {
		$q = $this->db->query("SELECT * FROM mst_satuan ORDER BY id_satuan DESC");
		return $q;
	}
	function search_blog($title){
		$this->db->like('nama_customer', $title , 'both');
		$this->db->order_by('nama_customer', 'ASC');
		$this->db->limit(10);
		return $this->db->get('mst_customer')->result();
	}
	public function get_master_harga($id) {
		$q = $this->db->query("SELECT mst_harga.id_harga, mst_harga.harga, mst_product.nama_product, mst_customer.nama_customer FROM mst_harga LEFT JOIN mst_product ON mst_harga.id_product = mst_product.id_product LEFT JOIN mst_customer ON mst_customer.id_customer = mst_harga.id_customer WHERE mst_harga.id_gudang = '$id' ORDER BY id_harga DESC");
		return $q;
	}
	public function get_processing() {
		$q = $this->db->query("SELECT trx_rencana_master.id_rencana_header, trx_rencana_master.nomor_rencana, trx_rencana_master.tanggal_penetapan, 
		trx_rencana_master.tanggal_rencana, trx_rencana_master.keterangan FROM trx_rencana_master ORDER BY trx_rencana_master.id_rencana_header DESC");
		return $q;
	}
	public function get_rencana_detail($id='') {
		if ($this->session->userdata("id_role")==5){
			$uid = $this->session->userdata('id_user'); 
			$q = $this->db->query("SELECT trx_rencana_detail.*, mst_kegiatan.nama_kegiatan,mst_customer.nama_customer, nama_karyawan 
							FROM trx_rencana_detail JOIN mst_user ON mst_user.id_karyawan = trx_rencana_detail.id_karyawan 
							JOIN mst_kegiatan ON trx_rencana_detail.id_kegiatan=mst_kegiatan.id_kegiatan
							JOIN mst_customer ON trx_rencana_detail.id_customer=mst_customer.id_customer
							WHERE trx_rencana_detail.id_rencana_header = '$id' AND id_user ='$uid'
							ORDER BY trx_rencana_detail.id_rencana_detail DESC ");
		}else if($this->session->userdata("id_role")==4){
			$q = $this->db->query("SELECT trx_rencana_detail.*, mst_kegiatan.nama_kegiatan,mst_customer.nama_customer, nama_karyawan 
							FROM trx_rencana_detail JOIN mst_user ON mst_user.id_karyawan = trx_rencana_detail.id_karyawan 
							JOIN mst_kegiatan ON trx_rencana_detail.id_kegiatan=mst_kegiatan.id_kegiatan
							JOIN mst_customer ON trx_rencana_detail.id_customer=mst_customer.id_customer
							WHERE trx_rencana_detail.id_rencana_header = '$id'
							ORDER BY trx_rencana_detail.id_rencana_detail DESC ");
		}
		return $q;
	}
	public function get_qlock($id='') {
		$q = $this->db->query("SELECT * FROM trx_rencana_detail WHERE id_rencana_header='$id'")->row();
		return $q;
	}
	public function get_stock_availabel($id_rencana_detail='',$id_product='') {
		$q = $this->db->query("SELECT data_max.* from (select stock_customer.* from (select max(id_stock) as id_stock from stock_customer 
		group by id_customer,id_product) as max_stock join stock_customer on max_stock.id_stock=stock_customer.id_stock) 
		as data_max join trx_rencana_detail on data_max.id_customer=trx_rencana_detail.id_customer 
		WHERE id_rencana_detail='$id_rencana_detail' AND id_product='$id_product'")->row();
		return $q;
	}
	public function get_count_stock_availabel($id_rencana_detail='',$id_product='') {
		$q = $this->db->query("SELECT count(*) as jml from (select stock_customer.* from (select max(id_stock) as id_stock from stock_customer 
		group by id_customer,id_product) as max_stock join stock_customer on max_stock.id_stock=stock_customer.id_stock) 
		as data_max join trx_rencana_detail on data_max.id_customer=trx_rencana_detail.id_customer 
		WHERE id_rencana_detail='$id_rencana_detail' AND id_product='$id_product'")->row();
		return $q;
	}
	public function get_request_detail($id="") {
		$q = $this->db->query("SELECT * FROM trx_so_detail 
		JOIN jenis_transaksi ON trx_so_detail.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi
		JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
		JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=trx_so_detail.id_shipping_point
		WHERE id_request='$id' AND delete_id=0 ORDER BY id_detail_request  DESC");
		return $q;
	}
	public function get_request_detail_scrapping($id="") {
		$q = $this->db->query("SELECT * FROM detail_scrapping JOIN satuan ON detail_scrapping.id_satuan = satuan.id_satuan 
		JOIN mst_product ON mst_product.id_product=detail_scrapping.id_product
		WHERE id_request='$id' ORDER BY id_detail_request  DESC");
		return $q;
	}
	public function get_biaya($id="") {
		$q = $this->db->query("SELECT mb.*,kg.nama_kegiatan,wl.nama_wilayah,rl.level_jabatan FROM mst_biaya mb 
						JOIN mst_kegiatan kg ON mb.id_kegiatan=kg.id_kegiatan JOIN mst_wilayah wl 
						ON wl.id_wilayah=kg.id_wilayah JOIN role rl ON mb.id_role=rl.id_role
						ORDER BY wl.nama_wilayah ASC");
		return $q;
	}
	public function get_kegiatan_list($id="") {
		$q = $this->db->query("SELECT mk.*,wil.nama_wilayah,dep.nama_departemen FROM mst_kegiatan mk JOIN mst_wilayah wil 
						ON mk.id_wilayah=wil.id_wilayah JOIN mst_departemen dep ON dep.id_departemen=mk.id_departemen 
						ORDER BY mk.id_wilayah, mk.nama_kegiatan ASC");
		return $q;
	}
	public function get_customer($id="") {
		// $q = $this->db->query("SELECT data3.*, data4.id_sales_division, data4.jml1 FROM (SELECT data1.*,jml,id_shipping_point_customer FROM(
		// 				SELECT mst_customer.*,nama_wilayah,nama_status FROM mst_customer 
		// 				JOIN mst_wilayah ON mst_customer.id_wilayah=mst_wilayah.id_wilayah 
		// 				JOIN status_customer ON mst_customer.id_status_customer = status_customer.id_status_customer 
		// 				GROUP BY mst_customer.id_customer ORDER BY id_customer DESC)AS data1
		// 				LEFT JOIN (SELECT id_customer,id_shipping_point_customer, COUNT(*) AS jml FROM mst_shipping_point_customer 
		// 				GROUP BY id_customer) AS data2 ON data1.id_customer=data2.id_customer) as data3 
		// 				LEFT JOIN (SELECT id_sales_division,kode_customer, COUNT(*) AS jml1 FROM mst_sales_person_division GROUP BY kode_customer) as data4 ON data3.kode_customer=data4.kode_customer
		// 				WHERE pers_numb1 != '00000000' ORDER BY id_shipping_point_customer DESC");
		$q = $this->db->query("SELECT mc.*,nama_cluster,COUNT(id_shipping_point_customer) AS jml,cluster_id FROM mst_customer mc LEFT JOIN  mst_customer_cluster mcc 
						ON mc.kode_customer=mcc.kode_customer LEFT JOIN mst_shipping_point_customer msp ON mc.kode_customer=msp.kode_customer 
						WHERE pers_numb1 <> '00000000' GROUP BY mc.kode_customer ");
		return $q;
	}
	public function get_customer_alamat_kirim($id="") {
		$q = $this->db->query("SELECT * FROM mst_customer mu JOIN alamat_kirim ak ON mu.id_customer=ak.id_customer 
							JOIN mst_wilayah mw on mw.id_wilayah=mu.id_wilayah WHERE ak.id_customer='$id'");
		return $q;
	}
	public function get_customer_prospect($id="") {
		$q = $this->db->query("SELECT mst_customer.*,nama_wilayah,nama_status FROM mst_customer 
							JOIN mst_wilayah ON mst_customer.id_wilayah=mst_wilayah.id_wilayah 
							JOIN status_customer ON mst_customer.id_status_customer = status_customer.id_status_customer 
							WHERE id_customer !=0 AND mst_customer.id_status_customer =1");
		return $q;
	}
	public function get_master_product() {
		$q = $this->db->query("SELECT * FROM mst_product ORDER BY mst_product.id_product DESC");
		return $q;
	}
	public function get_cluster() {
		$q = $this->db->query("SELECT mc.*,count(mcc.id_customer)as jml1,region_desc FROM mst_cluster mc LEFT JOIN mst_customer_cluster mcc ON mc.cluster_id=mcc.cluster_id GROUP BY mc.cluster_id ORDER BY cluster_description ASC");
		return $q;
	}
	public function get_master_sales() {
		$q = $this->db->query("SELECT data1.*, mpg.plant_group_name FROM (SELECT data_master.*, mspd.id_plant_group FROM (SELECT sp.pers_numb,sp.sales_pers,
		                    mc.kode_customer,mc.nama_customer FROM sales_person sp JOIN mst_customer mc ON sp.pers_numb=mc.pers_numb1 WHERE mc.pers_numb1 !='00000000' UNION
		                    SELECT sp.pers_numb,sp.sales_pers,mc.kode_customer,mc.nama_customer FROM sales_person sp JOIN mst_customer mc 
		                    ON sp.pers_numb=mc.pers_numb2 WHERE mc.pers_numb2 !='00000000')as data_master LEFT JOIN mst_sales_person_division mspd 
		                    ON data_master.pers_numb=mspd.pers_numb AND data_master.kode_customer=mspd.kode_customer) as data1 LEFT JOIN mst_plant_group mpg 
		                    ON data1.id_plant_group=mpg.id_plant_group");
		return $q;
	}
	public function get_master_shipping_point() {
		$q = $this->db->query("SELECT * FROM mst_shipping_point WHERE id_shipping_point>0");
		return $q;
	}
	public function get_master_user() {
		$q = $this->db->query("SELECT * FROM
								    mst_user
								    INNER JOIN mst_gudang 
								        ON (mst_user.id_gudang = mst_gudang.id_gudang) ORDER BY mst_user.id_user DESC");
		return $q;
	}
	public function get_product_by_modal() {
		$q = $this->db->query("SELECT process_detail.id_product,process_master.batch,process_detail.qty,process_detail.no_box,process_detail.id_processdetail, mst_product.nama_product FROM process_detail LEFT JOIN process_master ON process_master.id_rencana_header = process_detail.id_rencana_header LEFT JOIN mst_product ON process_detail.id_product = mst_product.id_product ORDER BY process_detail.id_processdetail DESC");
		return $q;
	}
	public function get_msg() {
		$q = $this->db->query("SELECT * FROM message msg join mst_user mu ON msg.id_user=mu.id_user order by id_msg desc limit 10");
		return $q;
	}
	public function get_penjualan($id) {
		$q = $this->db->query("SELECT keluar_master.id_keluarmaster,keluar_master.nomor, keluar_master.tanggal, keluar_master.jenis_keluar, keluar_master.status_bayar, keluar_master.tgl_lunas, keluar_master.keterangan, mst_customer.nama_customer FROM keluar_master LEFT JOIN mst_customer ON mst_customer.id_customer = keluar_master.id_customer WHERE keluar_master.id_gudang = '$id' ORDER BY keluar_master.id_keluarmaster DESC");
		return $q;
	}
	public function get_penjualan_detail($id) {
		$q = $this->db->query("SELECT keluar_detail.id_keluardetail,keluar_detail.id_keluarmaster, keluar_detail.id_product, keluar_detail.batch, keluar_detail.harga, keluar_detail.qty, mst_product.nama_product,mst_satuan.nama_satuan FROM keluar_detail LEFT JOIN mst_product ON mst_product.id_product = keluar_detail.id_product LEFT JOIN mst_satuan ON mst_satuan.id_satuan = mst_product.id_satuan  WHERE keluar_detail.id_keluarmaster = '$id' ORDER BY keluar_detail.id_keluardetail DESC");
		return $q;
	}
	public function get_daily_visit($id) {
		$q_user=$this->db->query("SELECT id_user,tanggal,tanggal1 FROM report_daily_visit WHERE id_report_daily=$id")->row();
		$id_user=$q_user->id_user;
		$tanggal=$q_user->tanggal;
		$tanggal1=$q_user->tanggal1;
		$q = $this->db->query("SELECT * FROM ((SELECT mst.nama_customer,mst.no_hp,mst.alamat,mst.nama_usaha,ckout.alamat_gps,ckout.tanggal_checkout 
							FROM mst_customer mst JOIN trx_checkin ckin ON mst.kode_customer=ckin.kode_customer
							JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin WHERE ckout.id_user='$id_user'
							AND ckout.tanggal_checkout between '$tanggal 00:00:00' and '$tanggal1 23:59:59')
							UNION
							(SELECT tmp.nama_customer,tmp.no_hp,tmp.alamat,tmp.nama_usaha,ckout.alamat_gps,ckout.tanggal_checkout 
							FROM tmp_customer tmp JOIN trx_checkin ckin ON tmp.kode_customer=ckin.kode_customer
							JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin WHERE ckout.id_user='$id_user'
							AND ckout.tanggal_checkout between '$tanggal 00:00:00' and '$tanggal1 23:59:59')
							ORDER BY nama_customer)AS union_");
		return $q;
	}
	public function getaddress($lats,$longs){
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lats).','.trim($longs).'&sensor=false';
		$json = @file_get_contents($url);
		$data=json_decode($json);
		$status = $data->status;
		if($status=="OK")
		return $data->results[0]->formatted_address;
		else
		return false;
	}
	public function get_user() {
		$q = $this->db->query("SELECT * FROM (SELECT mu.id_user,mu.no_hp,mu.nama,mu.username,mu.password,mu.mac,mu.mac1,mu.id_wilayah,
							mu.id_aplikasi,mu.id_karyawan,mu.nama_karyawan,os,dept.*,rl.id,rl.id_role,rl.nama_role,rl.level_jabatan AS jabatan 
							FROM mst_user mu JOIN mst_departemen dept ON dept.id_departemen=mu.id_departemen 
							JOIN role rl ON rl.id_role = mu.id_role 
							WHERE mu.id_aplikasi='2' AND rl.id_aplikasi='2') AS data_user 
							LEFT JOIN (SELECT id_user as a, COUNT(id_shipping_point_user) AS jml FROM mst_user_shipping_point  GROUP BY a) AS bnyk_shipping_point
							ON data_user.id_user=bnyk_shipping_point.a ORDER BY data_user.id_user DESC");
		return $q;
	}
	public function get_shipping_point($id="") {
		$q = $this->db->query("SELECT * FROM mst_user_shipping_point WHERE id_user='$id'");
		return $q;
	}
	public function get_combo_user($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah");
		$hasil .= '<option selected="selected" value>Pilih User</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_user) {
				$hasil .= '<option value="'.$h->id_user.'" selected="selected">'.$h->nama_karyawan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_user.'">'.$h->nama_karyawan.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_rencana($nama="") {
		$hasil = "";
		$q = $this->db->query("SELECT id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah WHERE id_aplikasi='2'");
		$hasil .= '<option selected="selected" value>Pilih User</option>';
		foreach($q->result() as $h) {
			if($nama == $h->nama_karyawan) {
				$hasil .= '<option value="'.$h->id_user.'" selected="selected">'.$h->nama_karyawan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_user.'">'.$h->nama_karyawan.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_rencana_available($nama="") {
		$hasil = "";
		$q = $this->db->query("SELECT id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN trx_rencana_detail ON mst_user.id_karyawan=trx_rencana_detail.id_karyawan
							WHERE id_aplikasi='2' GROUP BY id_user");
		$hasil .= '<option selected="selected" value>Pilih User</option>';
		foreach($q->result() as $h) {
			if($nama == $h->nama_karyawan) {
				$hasil .= '<option value="'.$h->nama_karyawan.'" selected="selected">'.$h->nama_karyawan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_karyawan.'">'.$h->nama_karyawan.'</option>';
			}
		}
		return $hasil;
	}
	public function get_data_print($id="") {
		$q = "";
		$q = $this->db->query("SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,foto_spg,keterangan_spg,
								foto_chiller,suhu,foto_display, keterangan_display,foto_kompetitor,md_kompetitor.keterangan AS keterangan_kompetitor
								FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
								JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user 
								JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
								JOIN mst_customer mc ON mc.kode_customer = ckin.kode_customer
								LEFT JOIN md_aktifitas_spg spg ON trd.id_rencana_detail=spg.id_rencana_detail LEFT JOIN md_chiller 
								ON trd.id_rencana_detail=md_chiller.id_rencana_detail LEFT JOIN md_display ON trd.id_rencana_detail=md_display.id_rencana_detail 
								LEFT JOIN md_kompetitor ON trd.id_rencana_detail=md_kompetitor.id_rencana_detail 
								WHERE trm.id_rencana_header='$id'
								union
								SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,null as foto_spg,null as keterangan_spg,
								null as foto_chiller,null as suhu,null as foto_display,null as  keterangan_display,null as foto_kompetitor,null as keterangan_kompetitor
								FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
								JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user 
								JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
								JOIN tmp_customer tmp ON tmp.kode_customer = ckin.kode_customer
								WHERE trm.id_rencana_header='$id'");
		return $q;
	}
	public function get_combo_user_order_list($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mst_user.id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN trx_so_header 
							ON trx_so_header.id_user=mst_user.id_user GROUP BY mst_user.id_user");
		$hasil .= '<option selected="selected" value>Pilih Sales</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_user) {
				$hasil .= '<option value="'.$h->id_user.'" selected="selected">'.$h->nama_karyawan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_user.'">'.$h->nama_karyawan.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_history($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah
							WHERE id_aplikasi='2'");
		$hasil .= '<option selected="selected" value>Pilih User</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama) {
				$hasil .= '<option value="'.$h->nama.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_per_departemen($id="") {
		$hasil = "";
		$id_departemen=$this->session->userdata('id_departemen');
		$q = $this->db->query("SELECT mst_user.id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
								ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
								ON mst_user.id_departemen=mst_departemen.id_departemen JOIN trx_so_header 
								ON trx_so_header.id_user=mst_user.id_user 
								WHERE mst_user.id_departemen='$id_departemen' GROUP BY mst_user.id_user");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_user) {
				$hasil .= '<option value="'.$h->id_user.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_user.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_rekap_sales($nama="") {
		$nama_karyawan = $this->session->userdata("nama_karyawan");
		$hasil = "";
		if($this->session->userdata("id_role")==5){
			$q = $this->db->query("SELECT mst_user.id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
							ON mst_user.id_departemen=mst_departemen.id_departemen JOIN trx_rencana_detail 
							ON trx_rencana_detail.id_karyawan=mst_user.id_karyawan WHERE nama_karyawan = '$nama_karyawan' GROUP BY mst_user.id_user");
		}else{
			$q = $this->db->query("SELECT mst_user.id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
							ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
							ON mst_user.id_departemen=mst_departemen.id_departemen JOIN trx_rencana_detail 
							ON trx_rencana_detail.id_karyawan=mst_user.id_karyawan GROUP BY mst_user.id_user");
		}
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($nama == $h->nama_karyawan) {
				$hasil .= '<option value="'.$h->nama_karyawan.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_karyawan.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_per_departemen_history($id="") {
		$hasil = "";
		$id_departemen=$this->session->userdata('id_departemen');
		$q = $this->db->query("SELECT * FROM mst_user JOIN mst_wilayah
								ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
								ON mst_user.id_departemen=mst_departemen.id_departemen
								WHERE mst_user.id_departemen='$id_departemen' AND id_aplikasi='2'");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama) {
				$hasil .= '<option value="'.$h->nama.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_sesuai_login($id="") {
		$hasil = "";
		$id_user=$this->session->userdata('id_user');
		$q = $this->db->query("SELECT id_user,nama_karyawan,nama_wilayah FROM mst_user JOIN mst_wilayah
								ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
								ON mst_user.id_departemen=mst_departemen.id_departemen
								WHERE mst_user.id_user='$id_user'");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_user) {
				$hasil .= '<option value="'.$h->id_user.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_user.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_user_sesuai_login_history($id="") {
		$hasil = "";
		$nama=$this->session->userdata('nama');
		$q = $this->db->query("SELECT * FROM mst_user JOIN mst_wilayah
								ON mst_wilayah.id_wilayah=mst_user.id_wilayah JOIN mst_departemen 
								ON mst_user.id_departemen=mst_departemen.id_departemen
								WHERE mst_user.nama='$nama'");
		$hasil .= '<option value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_user) {
				$hasil .= '<option value="'.$h->nama.'" selected="selected">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama.'">'.$h->nama_karyawan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_role($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM role WHERE id_aplikasi='2' ORDER BY nama_role ASC");
		$hasil .= '<option value>Pilih login role</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_role) {
				$hasil .= '<option value="'.$h->id_role.'" selected="selected">'.$h->nama_role.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_role.'">'.$h->nama_role.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_wilayah($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_wilayah WHERE id_wilayah !=0 ORDER BY nama_wilayah ASC");
		$hasil .= '<option selected="selected" value>Pilih Wilayah</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_wilayah) {
				$hasil .= '<option value="'.$h->id_wilayah.'" selected="selected">'.$h->nama_wilayah.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_wilayah.'">'.$h->nama_wilayah.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_wilayah_id($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_wilayah WHERE id_wilayah !=0 ORDER BY nama_wilayah ASC");
		$hasil .= '<option selected="selected" value>Pilih Wilayah</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_wilayah) {
				$hasil .= '<option value="'.$h->id_wilayah.'" selected="selected">'.$h->nama_wilayah.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_wilayah.'">'.$h->nama_wilayah.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_region_id($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM region_user");
		$hasil .= '<option selected="selected" value>Pilih Region</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_region) {
				$hasil .= '<option value="'.$h->id_region.'" selected="selected">'.$h->region.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_region.'">'.$h->region.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shipping_point_user($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_shipping_point ORDER BY description ASC");
		$hasil .= '<option selected="selected" value>Semua</option>';
		foreach($q->result() as $h) {
			if($id == $h->description) {
				$hasil .= '<option value="'.$h->description.'" selected="selected">'.$h->description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->description.'">'.$h->description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_tk_personal($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT `id_karyawan`,`no_index`,`nama_karyawan`,`tempat_lahir`,`telp_mobile` FROM tk_personal ORDER BY nama_karyawan ASC");
		$hasil .= '<option>Pilih karyawan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_karyawan) {
				$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama_karyawan."  || ".$h->no_index.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama_karyawan."  || ".$h->no_index.'</option>';
			}
		}
		return $hasil;
	}
	public function get_order_list_data($tanggal_mulai="",$tanggal_sampai="",$kode_shipping_point="",$nama_status_kirim="",$nama_departemen="") {
		//PERHATIKAN GROUP BY
		if($this->session->userdata("id_role") <=2){
			$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											WHERE tanggal_kirim BETWEEN '$tanggal_mulai' AND '$tanggal_sampai'
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND nama_departemen LIKE '%$nama_departemen%' ORDER BY id_request DESC");
		}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($q_user_shipment->jml != 0){
				$id_user=$this->session->userdata("id_user");
				// $q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
				// $departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
                                            SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
                                            SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
                                            data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.sts,
                                            data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.kode_product,
                                            data2.nama_transaksi,sales_pers1,pers_numb1,data2.cust_sold,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
                                            data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
                                            SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
                                            SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
                                            rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,sts,dr.keterangan,
                                            dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,
                                            jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
                                            JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
                                            JOIN mst_user mu ON mu.id_user = rs.id_user
                                            JOIN satuan s ON s.id_satuan=dr.id_satuan
                                            JOIN mst_product mp ON mp.id_product=dr.id_product
                                            JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
                                            JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND tanggal_kirim BETWEEN '$tanggal_mulai' AND '$tanggal_sampai') AS data1
                                            JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
                                            JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
                                            JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
                                            JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
                                            JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
                                            WHERE mst_user_shipping_point.id_user = '$id_user'
                                            AND data5.kode_shipping_point LIKE '%$kode_shipping_point%'
                                            AND data5.nama_status_kirim LIKE '%$nama_status_kirim%'  
                                            ORDER BY id_request DESC");
			}else{
				$departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0  AND tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai') AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");	
			}
		}else if($this->session->userdata("id_role") == 5){
			$departemen=$this->session->userdata('id_departemen');
			$nama=$this->session->userdata('nama');
			$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0 AND tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai') AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											AND nama LIKE '%$nama%'
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");
		}else if($this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			$departemen=$this->session->userdata('id_departemen');
			$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
											JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											WHERE data5.tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai'
											AND data5.kode_shipping_point LIKE '%$kode_shipping_point%'
											AND data5.nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_desc($tanggal_mulai="",$tanggal_sampai="",$kode_shipping_point="",$nama_status_kirim="",$nama_departemen="") {
		//PERHATIKAN GROUP BY
		if($this->session->userdata("id_role") <=2){
			$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											WHERE tanggal_kirim BETWEEN '$tanggal_mulai' AND '$tanggal_sampai'
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND nama_departemen LIKE '%$nama_departemen%' ORDER BY id_request DESC");
		}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($q_user_shipment->jml != 0){
				$id_user=$this->session->userdata("id_user");
				// $q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
				// $departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
                                            SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
                                            SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
                                            data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.sts,
                                            data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.kode_product,
                                            data2.nama_transaksi,data2.cust_sold,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
                                            data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
                                            SELECT data1.*, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
                                            SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
                                            rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,sts,dr.keterangan,
                                            dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,
                                            jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
                                            JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
                                            JOIN mst_user mu ON mu.id_user = rs.id_user
                                            JOIN mst_product mp ON mp.id_product=dr.id_product
                                            JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
                                            JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND tanggal_kirim BETWEEN '$tanggal_mulai' AND '$tanggal_sampai') AS data1
                                            JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											LEFT JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
                                            JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
                                            LEFT JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
                                            JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
                                            JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
                                            WHERE mst_user_shipping_point.id_user = '$id_user'
                                            AND data5.description LIKE '%$kode_shipping_point%'
                                            AND data5.nama_status_kirim LIKE '%$nama_status_kirim%'  
                                            ORDER BY id_request DESC");
			}else{
				$departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0  AND tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai') AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");	
			}
		}else if($this->session->userdata("id_role") == 5){
			$departemen=$this->session->userdata('id_departemen');
			$nama=$this->session->userdata('nama');
			$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0 AND tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai') AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											AND nama LIKE '%$nama%'
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");
		}else if($this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			$departemen=$this->session->userdata('id_departemen');
			$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
											JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											WHERE data5.tanggal_kirim BETWEEN '$tanggal_mulai' and '$tanggal_sampai'
											AND data5.kode_shipping_point LIKE '%$kode_shipping_point%'
											AND data5.nama_status_kirim LIKE '%$nama_status_kirim%'
											AND id_departemen='$departemen'  ORDER BY id_request DESC");
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_release_order_data($tanggal_mulai="",$tanggal_sampai="",$kode_shipping_point="",$nama_status_kirim="",$nama_departemen="") {
		if($this->session->userdata("id_role") <=2){
			$q_tarik_data = $this->db->query("SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,sts,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,jt.jenis_order,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim
											WHERE tanggal_kirim BETWEEN '$tanggal_mulai' AND '$tanggal_sampai'
											AND kode_shipping_point LIKE '%$kode_shipping_point%'
											AND nama_status_kirim LIKE '%$nama_status_kirim%'
											AND jenis_order=1 AND nama_departemen LIKE '%$nama_departemen%' ORDER BY id_request DESC");
		}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
		    $dateFilter = date('Y-m-d');
		    $datebesok = date('Y-m-d', strtotime($dateFilter. ' + 2 days'));
			$id_user=$this->session->userdata("id_user");
			$nama1=$this->session->userdata("nama_karyawan");
			$username=$this->session->userdata("username");
			$q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($q_user_shipment->jml != 0){
				if($username=='admin.admin'){
					// $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
					// 	SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
					// 	SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
					// 	data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
					// 	data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
					// 	data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
					// 	data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
					// 	SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
					// 	SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
					// 	rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
					// 	dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
					// 	jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
					// 	JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
					// 	JOIN mst_user mu ON mu.id_user = rs.id_user
					// 	JOIN mst_product mp ON mp.id_product=dr.id_product
					// 	JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
					// 	JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
					// 	JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
					// 	JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
					// 	JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
					// 	JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
					// 	JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
					// 	JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
					// 	WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi <= 2
					// 	ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person GROUP BY id_request");				
					$q_tarik_data = $this->db->query("SELECT data1.*,nama_cluster,cluster_id FROM(SELECT rs.id_request,rs.tanggal_po,rs.tanggal_kirim,
							rs.catatan,rs.no_po,rs.order_reason,dr.qty,rs.kode_trans,cluster_description,
							dr.satuan,dr.id_shipping_point,mu.nama,mp.nama_product,mp.kode_product,mp.division,msp.kode_shipping_point,msp.description,
							jt.nama_transaksi,jt.jenis_order,mc.id_customer,mc.kode_customer,nama_customer AS cust_sold,mc.sales_office FROM trx_so_header rs 
							JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
							JOIN mst_user mu ON mu.id_user = rs.id_user
							JOIN mst_shipping_point_customer mscp ON mscp.id_customer=rs.id_customer_ship
							JOIN mst_shipping_point msp ON msp.id_shipping_point=mscp.id_shipping_point
							JOIN mst_product mp ON mp.id_product=dr.id_product
							JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
							JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  
							LEFT JOIN mst_customer_cluster mcc ON mcc.kode_customer=mc.kode_customer
							LEFT JOIN mst_cluster cls ON cls.cluster_id=mcc.cluster_id
							WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0' and jenis_order=1 
							GROUP BY rs.id_customer_ship,rs.id_request) AS data1 LEFT JOIN mst_customer_cluster mcc ON data1.id_customer=mcc.id_customer");				
				}else{
				    if($username=='ichbal'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama <> 'PUSPITA SARI KUSTIANTI' AND nama <> 'IS PRAMONO'AND nama <> 'FENDA MARTIN SULISTYANINGTYAS' AND nama <> 'AMRULLOH' 
    						AND nama <> 'CARIN PUSPA SARI' AND nama <> 'LENI SEPTIANA' AND nama <> 'PRAMONO BUDI CAHYADI' AND nama <> 'ROSYDA DILIANTI KANIA' AND nama <> 'EVI HAPIDAH'  AND nama <> 'KIKI BAEHAKI' AND nama <> 'DANIEL ORTEGA'
    						AND nama <> 'DEWI NOVITASARI' AND nama <> 'SELA WAHYUNI' AND nama <> 'GITA KAMELIA' AND nama <> 'PUPUT SYAHFITRI' AND nama <> 'PURWONO' AND nama <> 'RANI FEBRIYANTI' GROUP BY id_request");
				    }else if($username=='puspita'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PUSPITA SARI KUSTIANTI' or nama = 'IS PRAMONO' GROUP BY id_request");
				    }else if($username=='dewi.novitasari'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PRAMONO BUDI CAHYADI' or nama = 'CARIN PUSPA SARI'  or nama = 'LENI SEPTIANA' or nama='DEWI NOVITASARI' or nama='PURWONO'  or nama='ANNO ANTHONI' GROUP BY id_request");
				    }else if($username=='puput.syahfitri'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PRAMONO BUDI CAHYADI' or nama = 'PURWONO' GROUP BY id_request");
				    }else if($username=='rani'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PRAMONO BUDI CAHYADI' or nama = 'PURWONO' GROUP BY id_request");
				    }else if($username=='adminggl.bandung'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'SELA WAHYUNI' or nama = 'GITA KAMELIA' or nama = 'NEVI DWI RIZKIRAHAYU' or nama = 'KIKI BAEHAKI' or nama = 'ROSYDA DILIANTI KANIA'  GROUP BY id_request");
				    }else if($username=='kiki.baehaki'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'SELA WAHYUNI' or nama = 'GITA KAMELIA' or nama = 'NEVI DWI RIZKIRAHAYU' or nama = 'KIKI BAEHAKI' or nama = 'ROSYDA DILIANTI KANIA'  GROUP BY id_request");
				    }else if($username=='amrulloh'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'NEVI DWI RIZKIRAHAYU' or nama = 'AMRULLOH' or nama = 'GITA KAMELIA' or nama = 'KIKI BAEHAKI' or nama='SELA WAHYUNI' or nama='ROSYDA DILIANTI KANIA'  GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else{
    					$q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama='$nama1'  GROUP BY id_request");
				    }
				}
			}else{
				$departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
											data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.release_id,data2.sts,
											data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.kode_product,
											data2.nama_transaksi,sales_pers1,pers_numb1,data2.cust_sold,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
											data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
											SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
											rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.release_id,sts,dr.keterangan,
											dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_ship  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id=0) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
											JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
											JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											ORDER BY id_request DESC");	
			}
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_release_order_data_check($tanggal_mulai="",$tanggal_sampai="",$kode_shipping_point="",$nama_status_kirim="",$nama_departemen="") {
		if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
		    // $dateFilter = date('Y-m-d');
		    // $datebesok = date('Y-m-d', strtotime($dateFilter. ' + 2 days'));
			$id_user=$this->session->userdata("id_user");
			$nama1=$this->session->userdata("nama_karyawan");
			$username=$this->session->userdata("username");
			$q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($q_user_shipment->jml != 0){
				if($username=='admin.admin'){
					$q_tarik_data = $this->db->query("SELECT data1.*,nama_cluster,cluster_id FROM(SELECT rs.id_request,rs.tanggal_po,rs.tanggal_kirim,
					rs.catatan,rs.no_po,rs.order_reason,dr.qty,rs.kode_trans,cluster_description,
					dr.satuan,dr.id_shipping_point,mu.nama,mp.nama_product,mp.kode_product,mp.division,msp.kode_shipping_point,msp.description,
					jt.nama_transaksi,mc.id_customer,mc.kode_customer,nama_customer AS cust_sold,mc.sales_office FROM trx_so_header rs 
					JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
					JOIN mst_user mu ON mu.id_user = rs.id_user
					JOIN mst_shipping_point_customer mscp ON mscp.id_customer=rs.id_customer_ship
					JOIN mst_shipping_point msp ON msp.id_shipping_point=mscp.id_shipping_point
					JOIN mst_product mp ON mp.id_product=dr.id_product
					JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
					JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  
					LEFT JOIN mst_customer_cluster mcc ON mcc.kode_customer=mc.kode_customer
					LEFT JOIN mst_cluster cls ON cls.cluster_id=mcc.cluster_id
					WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1'
					GROUP BY rs.id_customer_ship,rs.id_request) AS data1 LEFT JOIN mst_customer_cluster mcc ON data1.id_customer=mcc.id_customer LIMIT 1000");				
				}else{
				    if($username=='ichbal'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama <> 'PUSPITA SARI KUSTIANTI' AND nama <> 'FENDA MARTIN SULISTYANINGTYAS' AND nama <> 'AMRULLOH' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else if($username=='dewi.novitasari'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PRAMONO BUDI CAHYADI' or nama = 'CARIN PUSPA SARI' or nama = 'LENI SEPTIANA' or nama='DEWI NOVITASARI' or nama = 'PURWONO' or nama='ANNO ANTHONI'  GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else if($username=='adminggl.bandung'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'SELA WAHYUNI' or nama = 'GITA KAMELIA' or nama = 'NEVI DWI RIZKIRAHAYU' or nama = 'KIKI BAEHAKI' or nama = 'ROSYDA DILIANTI KANIA' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else if($username=='puput.syahfitri'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PURWONO' or nama = 'PUPUT SYAHFITRI' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else if($username=='rani'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'PURWONO' or nama = 'PUPUT SYAHFITRI' or nama = 'RANI FEBRIYANTI' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else if($username=='amrulloh'){
				        $q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama = 'NEVI DWI RIZKIRAHAYU' or nama = 'AMRULLOH' or nama = 'GITA KAMELIA' or nama = 'KIKI BAEHAKI' or nama='SELA WAHYUNI' or nama='ROSYDA DILIANTI KANIA'  GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }else{
    					$q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    						SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    						SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.id_customer_ship as id_customer,data2.tanggal_kirim,data2.catatan,data2.no_po,
    						data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    						data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.matgr,data2.kode_product,
    						data2.nama_transaksi,data2.kode_cust_sold,data2.cust_sold,data2.kode_cust_ship,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    						data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    						SELECT data1.*,mst_customer.kode_customer AS kode_cust_ship,nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    						SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    						rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    						dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.matgr,mp.kode_product,
    						jt.nama_transaksi,kode_customer AS kode_cust_sold,nama_customer AS cust_sold FROM trx_so_header rs 
    						JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    						JOIN mst_user mu ON mu.id_user = rs.id_user
    						JOIN satuan s ON s.id_satuan=dr.id_satuan
    						JOIN mst_product mp ON mp.id_product=dr.id_product
    						JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    						JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='1') AS data1
    						JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
							JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
    						JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    						JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    						JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    						JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    						WHERE mst_user_shipping_point.id_user = '$id_user' AND id_jenis_transaksi ='1'
    						ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person 
    						WHERE nama='$nama1' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
				    }
				}
			}else{
				$departemen=$this->session->userdata('id_departemen');
				$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
											data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.release_id,data2.sts,
											data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.kode_product,
											data2.nama_transaksi,sales_pers1,pers_numb1,data2.cust_sold,data2.cust_ship,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
											data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
											SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
											SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
											rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.release_id,sts,dr.keterangan,
											dr.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id=0) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship
											JOIN mst_customer_cluster mcc ON mcc.kode_customer=mst_customer.kode_customer)AS data2 
											JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
											JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											ORDER BY id_request DESC");	
			}
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	// public function get_release_order_final($id="") {
	// 	if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
	// 		$id_user=$this->session->userdata("id_user");
	// 		$q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
	// 		if($q_user_shipment->jml != 0){
	// 			$q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
    //                                         SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
    //                                         SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
    //                                         data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.id_sales_person,data2.release_id,data2.sts,
    //                                         data2.keterangan,data2.satuan,data2.id_shipping_point,data2.urutan,data2.nama,data2.nama_product,data2.kode_product,data2.mat_group,data2.division,
    //                                         data2.nama_transaksi,data2.cust_sold,data2.cust_ship,kode_ship,kode_sold,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
    //                                         data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
    //                                         SELECT data1.*,nama_customer AS cust_ship,mst_customer.kode_customer AS kode_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
    //                                         SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
    //                                         rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.id_sales_person,dr.release_id,sts,dr.keterangan,
    //                                         mp.satuan,mp.urutan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,mp.division,mp.matgr as mat_group,
    //                                         jt.nama_transaksi,nama_customer AS cust_sold, kode_customer AS kode_sold FROM trx_so_header rs 
    //                                         JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
    //                                         JOIN mst_user mu ON mu.id_user = rs.id_user
    //                                         JOIN mst_product mp ON mp.id_product=dr.id_product
    //                                         JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
    //                                         JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id=0) AS data1
    //                                         JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)AS data2 
    //                                         JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
    //                                         JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
    //                                         JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
    //                                         JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
    //                                         WHERE mst_user_shipping_point.id_user = '$id_user'
    //                                         ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person WHERE id_detail_request='$id'");
	// 		}else{
	// 			$departemen=$this->session->userdata('id_departemen');
	// 			$q_tarik_data = $this->db->query("SELECT data_final.*,sales_pers,pers_numb FROM(SELECT data5.* FROM (SELECT data4.*, nama_status_kirim FROM (
	// 										SELECT data3.*,id_status_kirim,tanggal_shipping FROM (
	// 										SELECT data2.id_request,data2.no_request,data2.tanggal_request,data2.tanggal_kirim,data2.catatan,data2.no_po,
	// 										data2.title,data2.h1,data2.h2,data2.h3,data2.r1,data2.r2,data2.r3,data2.id_detail_request,data2.id_jenis_transaksi,data2.qty,data2.release_id,data2.sts,
	// 										data2.keterangan,data2.satuan,data2.id_shipping_point,data2.nama,data2.nama_product,data2.kode_product,data2.mat_group,data2.division,
	// 										data2.nama_transaksi,sales_pers1,pers_numb1,data2.cust_sold,data2.cust_ship,kode_ship,kode_sold,data2.alamat,data2.city,data2.nama_cluster,data2.hari_kirim,
	// 										data2.hari_kirim2,data2.hari_kirim3,description,kode_shipping_point FROM(
	// 										SELECT data1.*,sales_pers1,pers_numb1, nama_customer AS cust_ship,mst_customer.kode_customer AS kode_ship, alamat,city,nama_cluster,hari_kirim,hari_kirim2,hari_kirim3 FROM(
	// 										SELECT rs.id_request,rs.no_request,rs.id_user,rs.tanggal_request,rs.id_customer_ship,rs.tanggal_kirim,
	// 										rs.catatan,rs.no_po,rs.title,rs.h1,rs.h2,rs.h3,rs.r1,rs.r2,rs.r3,dr.id_detail_request,dr.id_jenis_transaksi,dr.qty,dr.release_id,sts,dr.keterangan,
	// 										mp.satuan,dr.id_shipping_point,mu.nama,mu.id_wilayah,mp.nama_product,mp.kode_product,mp.matgr as mat_group,mp.division,
	// 										jt.nama_transaksi,nama_customer AS cust_sold, kode_customer AS kode_sold  FROM trx_so_header rs 
	// 										JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
	// 										JOIN mst_user mu ON mu.id_user = rs.id_user
	// 										JOIN mst_product mp ON mp.id_product=dr.id_product
	// 										JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
	// 										JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id=0) AS data1
	// 										JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)AS data2 
	// 										JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
	// 										JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
	// 										JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim) AS data5
	// 										JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
	// 										ORDER BY id_request DESC) AS data_final JOIN sales_person ON sales_person.id_sales_person=data_final.id_sales_person WHERE id_detail_request='$id'");	
	// 		}
	// 	}else{
	// 		redirect("Error");
	// 	}
	// 	return $q_tarik_data;
	// }
	public function get_release_order_final($id="") {
		if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
			// $id_user=$this->session->userdata("id_user");
			// $q_user_shipment = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			// if($q_user_shipment->jml != 0){
				$q_tarik_data = $this->db->query("SELECT rs.id_request,rs.tanggal_po,rs.tanggal_kirim,
							rs.catatan,rs.no_po,rs.order_reason,dr.qty,rs.kode_trans,
							dr.satuan,dr.id_shipping_point,dr.id_detail_request,mu.nama,mp.nama_product,mp.kode_product,mp.division,msp.kode_shipping_point,msp.description,
							jt.nama_transaksi,mc.id_customer,mc.kode_customer,nama_customer AS cust_sold,mc.sales_office FROM trx_so_header rs 
							JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
							JOIN mst_user mu ON mu.id_user = rs.id_user
							JOIN mst_shipping_point_customer mscp ON mscp.id_customer=rs.id_customer_ship
							JOIN mst_shipping_point msp ON msp.id_shipping_point=mscp.id_shipping_point
							JOIN mst_product mp ON mp.id_product=dr.id_product
							JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
							JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0' AND id_detail_request='$id'");
			// }else{
			// 	$departemen=$this->session->userdata('id_departemen');
			// 	$q_tarik_data = $this->db->query("SELECT rs.id_request,rs.tanggal_po,rs.tanggal_kirim,
			// 				rs.catatan,rs.no_po,rs.order_reason,dr.qty,rs.kode_trans,
			// 				dr.satuan,dr.id_shipping_point,dr.id_detail_request,mu.nama,mp.nama_product,mp.kode_product,mp.division,msp.kode_shipping_point,msp.description,
			// 				jt.nama_transaksi,mc.id_customer,mc.kode_customer,nama_customer AS cust_sold,mc.sales_office FROM trx_so_header rs 
			// 				JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
			// 				JOIN mst_user mu ON mu.id_user = rs.id_user
			// 				JOIN mst_shipping_point_customer mscp ON mscp.id_customer=rs.id_customer_ship
			// 				JOIN mst_shipping_point msp ON msp.id_shipping_point=mscp.id_shipping_point
			// 				JOIN mst_product mp ON mp.id_product=dr.id_product
			// 				JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
			// 				JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold  WHERE rs.delete_id=0 AND dr.delete_id=0  AND release_id='0' AND id_detail_request='$id'");	
			// }
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_scrapping_list_data($id_shipping_point="",$id_realisasi="") {
		//PERHATIKAN GROUP BY
		if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
				$q_tarik_data = $this->db->query("SELECT data1.*, description AS cust_ship FROM(SELECT rs.no_request,rs.id_user,rs.tanggal_request,
										rs.id_shp_from,rs.id_shp_to,rs.status_request,rs.tanggal_kirim,rs.catatan,rs.document_number,rs.title,ds.*,mu.nama,mu.username,
										mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, s.nama_satuan,mp.nama_product,mp.kode_product,
										description AS cust_sold FROM request_scrapping rs JOIN detail_scrapping ds ON rs.id_request = ds.id_request 
										JOIN mst_user mu ON mu.id_user = rs.id_user JOIN satuan s ON s.id_satuan=ds.id_satuan JOIN mst_product mp 
										ON mp.id_product=ds.id_product JOIN mst_shipping_point sp ON sp.id_shipping_point = rs.id_shp_from
										) AS data1 JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data1.id_shp_to
										WHERE id_shp_from='$id_shipping_point' AND id_realisasi LIKE '%$id_realisasi%'  ORDER BY id_request DESC");
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_shipment() {
		if($this->session->userdata("id_role") == 1){
			$q_tarik_data = $this->db->query("SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC");
		}else if($this->session->userdata("id_role") == 4 || $this->session->userdata("id_role") == 6){
			$id_user = $this->session->userdata("id_user");
			$qmushp = $this->db->query("SELECT count(*) as sum_ FROM mst_user_shipping_point WHERE id_user = '$id_user'")->row();
			$dateFilter = date('Y-m-d');
			if($qmushp->sum_ != 0){
				$q_tarik_data = $this->db->query("SELECT * FROM (SELECT data_shipment.* FROM(SELECT cust_ship,description,id_plant_group,alias,no_request,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,id_plant_group,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment)
											AS data_shipment JOIN mst_user_shipping_point
											ON data_shipment.description = mst_user_shipping_point.description 
											-- WHERE mst_user_shipping_point.id_user='$id_user'  and id_status_kirim <> 2 untuk menghilangkan yang sudah terkirim
											WHERE mst_user_shipping_point.id_user='$id_user'
											GROUP BY no_request,nama_transaksi,cust_ship, DATE(tanggal_request) ORDER BY tanggal_request DESC) as dataNfilter 
											WHERE tanggal_kirim <= '$dateFilter' and id_status_kirim <> 2");
			}else{
				$q_tarik_data = $this->db->query("SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 AND dr.delete_id=0) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment WHERE id_status_kirim !='2' GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC");
			}
		}
		// else if($this->session->userdata("id_role") == 6){
		// 	$id_user=$this->session->userdata("id_user");
		// 	$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
		// 	$q_tarik_data = $this->db->query("SELECT data5.* FROM (SELECT cust_ship,no_request,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
		// 									tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
		// 									id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
		// 									SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
		// 									SELECT data2.*,description,alias,kode_shipping_point FROM(
		// 									SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
		// 									dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
		// 									dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
		// 									mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
		// 									s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
		// 									jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
		// 									JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
		// 									JOIN mst_user mu ON mu.id_user = rs.id_user
		// 									JOIN satuan s ON s.id_satuan=dr.id_satuan
		// 									JOIN mst_product mp ON mp.id_product=dr.id_product
		// 									JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
		// 									JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
		// 									JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
		// 									JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
		// 									AS data2 JOIN mst_shipping_point 
		// 									ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
		// 									JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
		// 									JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim )
		// 									AS data_shipment GROUP BY cust_ship, DATE(tanggal_request))AS data5
		// 									JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
		// 									WHERE mst_user_shipping_point.id_user='$id_user' GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC");
		// }
		else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_shipment1() {
		if($this->session->userdata("id_role") == 1){
			$q_tarik_data = $this->db->query("SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC");
		}else if($this->session->userdata("id_role") == 4 || $this->session->userdata("id_role") == 6){
			$id_user = $this->session->userdata("id_user");
			$qmushp = $this->db->query("SELECT count(*) as sum_ FROM mst_user_shipping_point WHERE id_user = '$id_user'")->row();
			$dateFilter = date('Y-m-d');
			if($qmushp->sum_ != 0){
				$q_tarik_data = $this->db->query("SELECT data_shipment.* FROM(SELECT cust_ship,description,alias,no_request,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment)
											AS data_shipment JOIN mst_user_shipping_point
											ON data_shipment.description = mst_user_shipping_point.description 
											-- WHERE mst_user_shipping_point.id_user='$id_user'  and id_status_kirim <> 2 untuk menghilangkan yang sudah terkirim
											WHERE mst_user_shipping_point.id_user='$id_user'
											GROUP BY no_request,nama_transaksi,cust_ship, DATE(tanggal_request) ORDER BY tanggal_request DESC");
			}else{
				$q_tarik_data = $this->db->query("SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,no_do,keterangan_do,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											id_jenis_transaksi,nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,no_do,keterangan_do,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment WHERE id_status_kirim !='2' GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC");
			}
		}
		else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_count_shipment() {
		if($this->session->userdata("id_role") == 1){
			$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,no_request,tanggal_kirim,catatan,id_shipping,
										tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
										nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
										SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
										SELECT data2.*,description,alias,kode_shipping_point FROM(
										SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
										dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
										dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
										mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
										s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
										jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
										JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
										JOIN mst_user mu ON mu.id_user = rs.id_user
										JOIN satuan s ON s.id_satuan=dr.id_satuan
										JOIN mst_product mp ON mp.id_product=dr.id_product
										JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
										JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
										JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
										JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
										AS data2 JOIN mst_shipping_point 
										ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
										JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
										JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
										AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
										WHERE jml_data.id_status_kirim = '1'")->row();
		}else if($this->session->userdata("id_role") == 4){
			$id_user = $this->session->userdata("id_user");
			$qmushp = $this->db->query("SELECT COUNT(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($qmushp->jml > 0){
				$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data_shipment.* FROM(SELECT cust_ship,description,alias,no_request,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi)
											AS data_shipment JOIN mst_user_shipping_point
											ON data_shipment.description = mst_user_shipping_point.description 
											WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='1' ORDER BY tanggal_request DESC) AS shipping")->row();
			}else{
				$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
										tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
										nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
										SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
										SELECT data2.*,description,alias,kode_shipping_point FROM(
										SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
										dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
										dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
										mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
										s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
										jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
										JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
										JOIN mst_user mu ON mu.id_user = rs.id_user
										JOIN satuan s ON s.id_satuan=dr.id_satuan
										JOIN mst_product mp ON mp.id_product=dr.id_product
										JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
										JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
										JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
										JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
										AS data2 JOIN mst_shipping_point 
										ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
										JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
										JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
										AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
										WHERE jml_data.id_status_kirim = '1'")->row();
			}
		}else if($this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data5.* FROM (SELECT cust_ship,no_request,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi)AS data5
											JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='1' ORDER BY tanggal_request DESC) AS shipping")->row();
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_count_shipment1() {
		if($this->session->userdata("id_role") == 1){
			$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,no_request,tanggal_kirim,catatan,id_shipping,
										tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
										nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
										SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
										SELECT data2.*,description,alias,kode_shipping_point FROM(
										SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
										dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
										dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
										mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
										s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
										jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
										JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
										JOIN mst_user mu ON mu.id_user = rs.id_user
										JOIN satuan s ON s.id_satuan=dr.id_satuan
										JOIN mst_product mp ON mp.id_product=dr.id_product
										JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
										JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
										JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
										JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
										AS data2 JOIN mst_shipping_point 
										ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
										JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
										JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
										AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
										WHERE jml_data.id_status_kirim = '2'")->row();
		}else if($this->session->userdata("id_role") <=4){
			$id_user = $this->session->userdata("id_user");
			$qmushp = $this->db->query("SELECT COUNT(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($qmushp->jml != 0){
				$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data_shipment.* FROM(SELECT cust_ship,description,alias,no_request,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi)
											AS data_shipment JOIN mst_user_shipping_point
											ON data_shipment.description = mst_user_shipping_point.description 
											WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='2' ORDER BY tanggal_request DESC) AS shipping
											-- SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data5.* FROM (	
											-- SELECT cust_ship,description,tanggal_request,tanggal_kirim,catatan,id_shipping,
											-- tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											-- nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											-- SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											-- SELECT data2.*,description,kode_shipping_point FROM(
											-- SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											-- dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											-- dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											-- mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											-- s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											-- jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											-- JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											-- JOIN mst_user mu ON mu.id_user = rs.id_user
											-- JOIN satuan s ON s.id_satuan=dr.id_satuan
											-- JOIN mst_product mp ON mp.id_product=dr.id_product
											-- JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											-- JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											-- JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											-- JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											-- AS data2 JOIN mst_shipping_point 
											-- ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											-- JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											-- JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim WHERE data4.id_status_kirim='2')
											-- AS data_shipment GROUP BY cust_ship)AS data5
											-- JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											-- WHERE mst_user_shipping_point.id_user='$id_user') AS shipping
											")->row();
			}else{
				$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
											WHERE jml_data.id_status_kirim = '2'")->row();
			}
			/*$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT cust_ship,description,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim WHERE data4.id_status_kirim='2')
											AS data_shipment GROUP BY cust_ship) AS shipping")->row();*/
		}else if($this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data5.* FROM (SELECT cust_ship,no_request,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
			tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
			nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
			SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
			SELECT data2.*,description,alias,kode_shipping_point FROM(
			SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
			dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
			dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
			mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
			s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
			jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
			JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
			JOIN mst_user mu ON mu.id_user = rs.id_user
			JOIN satuan s ON s.id_satuan=dr.id_satuan
			JOIN mst_product mp ON mp.id_product=dr.id_product
			JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
			JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
			JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
			JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
			AS data2 JOIN mst_shipping_point 
			ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
			JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
			JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
			AS data_shipment GROUP BY no_request,nama_transaksi)AS data5
			JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
			WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='2' ORDER BY tanggal_request DESC) AS shipping")->row();
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_order_list_data_count_shipment2() {
		if($this->session->userdata("id_role") == 1){
			$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,no_request,tanggal_kirim,catatan,id_shipping,
										tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
										nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
										SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
										SELECT data2.*,description,alias,kode_shipping_point FROM(
										SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
										dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
										dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
										mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
										s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
										jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
										JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
										JOIN mst_user mu ON mu.id_user = rs.id_user
										JOIN satuan s ON s.id_satuan=dr.id_satuan
										JOIN mst_product mp ON mp.id_product=dr.id_product
										JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
										JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
										JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
										JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
										AS data2 JOIN mst_shipping_point 
										ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
										JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
										JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
										AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
										WHERE jml_data.id_status_kirim = '4'")->row();
		}else if($this->session->userdata("id_role") <=4){
			$id_user = $this->session->userdata("id_user");
			$qmushp = $this->db->query("SELECT COUNT(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			if($qmushp->jml != 0){
				$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data_shipment.* FROM(SELECT cust_ship,description,alias,no_request,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi)
											AS data_shipment JOIN mst_user_shipping_point
											ON data_shipment.description = mst_user_shipping_point.description 
											WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='4' ORDER BY tanggal_request DESC) AS shipping
											-- SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data5.* FROM (	
											-- SELECT cust_ship,description,tanggal_request,tanggal_kirim,catatan,id_shipping,
											-- tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											-- nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											-- SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											-- SELECT data2.*,description,kode_shipping_point FROM(
											-- SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											-- dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											-- dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											-- mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											-- s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											-- jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											-- JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											-- JOIN mst_user mu ON mu.id_user = rs.id_user
											-- JOIN satuan s ON s.id_satuan=dr.id_satuan
											-- JOIN mst_product mp ON mp.id_product=dr.id_product
											-- JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											-- JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											-- JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											-- JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											-- AS data2 JOIN mst_shipping_point 
											-- ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											-- JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											-- JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim WHERE data4.id_status_kirim='2')
											-- AS data_shipment GROUP BY cust_ship)AS data5
											-- JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
											-- WHERE mst_user_shipping_point.id_user='$id_user') AS shipping
											")->row();
			}else{
				$q_tarik_data = $this->db->query("SELECT COUNT(*) AS bnyk_pengiriman FROM(SELECT cust_ship,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,no_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,alias,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
											AS data_shipment GROUP BY no_request,nama_transaksi ORDER BY tanggal_request DESC) AS jml_data 
											WHERE jml_data.id_status_kirim = '4'")->row();
			}
			/*$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT cust_ship,description,tanggal_request,tanggal_kirim,catatan,id_shipping,
											tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
											nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
											SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
											SELECT data2.*,description,kode_shipping_point FROM(
											SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
											dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
											dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
											mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
											s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
											jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
											JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
											JOIN mst_user mu ON mu.id_user = rs.id_user
											JOIN satuan s ON s.id_satuan=dr.id_satuan
											JOIN mst_product mp ON mp.id_product=dr.id_product
											JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
											JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
											JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
											AS data2 JOIN mst_shipping_point 
											ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
											JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
											JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim WHERE data4.id_status_kirim='2')
											AS data_shipment GROUP BY cust_ship) AS shipping")->row();*/
		}else if($this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$q_user_shipment = $this->db->query("SELECT description FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			$q_tarik_data = $this->db->query("SELECT COUNT(cust_ship) AS bnyk_pengiriman FROM(SELECT data5.* FROM (SELECT cust_ship,no_request,description,alias,tanggal_request,tanggal_kirim,catatan,id_shipping,
			tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
			nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
			SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
			SELECT data2.*,description,alias,kode_shipping_point FROM(
			SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,
			dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
			dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
			mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
			s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
			jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
			JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
			JOIN mst_user mu ON mu.id_user = rs.id_user
			JOIN satuan s ON s.id_satuan=dr.id_satuan
			JOIN mst_product mp ON mp.id_product=dr.id_product
			JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
			JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
			JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
			JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
			AS data2 JOIN mst_shipping_point 
			ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
			JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
			JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
			AS data_shipment GROUP BY no_request,nama_transaksi)AS data5
			JOIN mst_user_shipping_point ON data5.description = mst_user_shipping_point.description
			WHERE mst_user_shipping_point.id_user='$id_user' AND id_status_kirim='4' ORDER BY tanggal_request DESC) AS shipping")->row();
		}else{
			redirect("Error");
		}
		return $q_tarik_data;
	}
	public function get_detail_kunjungan($id_rencana_header=""){
		$q_detail = $this->db->query("SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,foto_spg,keterangan_spg,foto_chiller,suhu,foto_display, 
									keterangan_display,foto_kompetitor,	md_kompetitor.keterangan AS keterangan_kompetitor
									FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
									JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user JOIN mst_customer mc ON mc.id_customer = trd.id_customer
									JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
									LEFT JOIN md_aktifitas_spg spg ON trd.id_rencana_detail=spg.id_rencana_detail LEFT JOIN md_chiller 
									ON trd.id_rencana_detail=md_chiller.id_rencana_detail LEFT JOIN md_display ON trd.id_rencana_detail=md_display.id_rencana_detail 
									LEFT JOIN md_kompetitor ON trd.id_rencana_detail=md_kompetitor.id_rencana_detail 
									WHERE trm.id_rencana_header='$id_rencana_header'");
		return $q_detail;
	}
	public function get_rekap_salesman($tanggal1="",$tanggal2="",$nama_karyawan="") {
		if($this->session->userdata("id_role") <=2){
// 			$q_rekap_biaya = $this->db->query("SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
// 			FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
// 			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
// 			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
// 			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
// 			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
// 			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
// 			JOIN mst_user mu ON ckout.id_user=mu.id_user
// 			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
// 			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
// 			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
// 			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
// 			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
// 			WHERE ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' AND '$tanggal2 23:59:59' 
// 			AND mw.nama_wilayah LIKE '%$nama_wilayah'
// 			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
// 			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
// 			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
// 			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
// 			ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
// 			YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
// 			JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
// 			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
// 			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
// 			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
// 			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
// 			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
// 			JOIN mst_user mu ON ckout.id_user=mu.id_user
// 			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
// 			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
// 			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
// 			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
// 			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
// 			WHERE ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' AND '$tanggal2 23:59:59' 
// 			AND mw.nama_wilayah LIKE '%$nama_wilayah'
// 			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
// 			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
// 			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
// 			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
// 			ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
// 			ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
// 			AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan");
// 			return $q_rekap_biaya;
		}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
			$wilayah = $this->session->userdata("id_wilayah");
			$id_departemen = $this->session->userdata("id_departemen");
			// $q_rekap_biaya = $this->db->query("SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
			// FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			// FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			// mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			// FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			// FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			// JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			// JOIN mst_user mu ON ckout.id_user=mu.id_user
			// JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			// JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			// JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			// JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			// JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			// WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			// AND '$tanggal2 23:59:59' 
			// GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			// AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			// AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			// OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			// ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
			// YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
			// JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			// FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			// mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			// FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			// FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			// JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			// JOIN mst_user mu ON ckout.id_user=mu.id_user
			// JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			// JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			// JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			// JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			// JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			// WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			// AND '$tanggal2 23:59:59' 
			// GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			// AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			// AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			// OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			// ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
			// ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
			// AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan");
			$q_rekap_biaya = $this->db->query("SELECT no_filter.*,nama_karyawan FROM (SELECT data_actual.*, tanggal_checkin, tanggal_checkout from (SELECT data_rencana.*,jml_visit_realisasi from 
			(SELECT data1.id_rencana_header, count(id_rencana_detail) as jml_visit,tanggal_rencana,id_karyawan from 
			(SELECT trm.nomor_rencana,trm.tanggal_penetapan,trm.tanggal_rencana,trm.keterangan as keterangan_header,trd.* from trx_rencana_master trm 
			join trx_rencana_detail trd on trm.id_rencana_header = trd.id_rencana_header)as data1 group by id_rencana_header)as data_rencana left join
			(SELECT data2.id_rencana_header, COUNT(id_rencana_detail) AS jml_visit_realisasi FROM 
			(SELECT trm.nomor_rencana,trm.tanggal_penetapan,trm.tanggal_rencana,trm.keterangan AS keterangan_header,trd.* FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header)AS data2 WHERE status_rencana='2' group by id_rencana_header)as data_realisasi 
			on data_rencana.id_rencana_header = data_realisasi.id_rencana_header group by data_rencana.id_rencana_header) as data_actual left join 
			(SELECT min_.*,tanggal_checkout from (SELECT data_min_ckin.id_rencana_header, tanggal_checkin from (SELECT id_rencana_header,min(id_checkin)as min_ckin from
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header join trx_checkin ckin on trd.id_rencana_detail=ckin.id_rencana_detail
			join trx_checkout ckout on ckin.id_checkin=ckout.id_checkin) as data_waktu group by id_rencana_header) as data_min_ckin join 
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin)as data_waktu on data_min_ckin.id_rencana_header=data_waktu.id_rencana_header and 
			data_min_ckin.min_ckin=data_waktu.id_checkin)as min_ join
			(SELECT data_max_ckout.id_rencana_header, tanggal_checkout FROM (SELECT id_rencana_header,Max(id_checkout)AS max_ckout FROM
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin) AS data_waktu  group by id_rencana_header) AS data_max_ckout JOIN 
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin)AS data_waktu ON data_max_ckout.id_rencana_header=data_waktu.id_rencana_header AND 
			data_max_ckout.max_ckout=data_waktu.id_checkout)as max_ on min_.id_rencana_header = max_.id_rencana_header)as min_max_waktu 
			on data_actual.id_rencana_header=min_max_waktu.id_rencana_header)as no_filter JOIN mst_user ON no_filter.id_karyawan=mst_user.id_karyawan 
			WHERE nama_karyawan LIKE '%$nama_karyawan%' AND tanggal_rencana between '$tanggal1' AND '$tanggal2'");
			return $q_rekap_biaya;
		}else if($this->session->userdata("id_role") == 5){
			// $wilayah = $this->session->userdata("id_wilayah");
			// $id_departemen = $this->session->userdata("id_departemen");
			// $id_user = $this->session->userdata("id_user");
			// $q_rekap_biaya = $this->db->query("SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
			// FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			// FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			// mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			// FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			// FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			// JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			// JOIN mst_user mu ON ckout.id_user=mu.id_user
			// JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			// JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			// JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			// JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			// JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			// WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			// AND '$tanggal2 23:59:59' AND mu.id_user='$id_user'
			// GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			// AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			// AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			// OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			// ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
			// YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
			// JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			// FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			// mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			// FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			// FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			// JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			// JOIN mst_user mu ON ckout.id_user=mu.id_user
			// JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			// JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			// JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			// JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			// JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			// WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			// AND '$tanggal2 23:59:59'  AND mu.id_user='$id_user'
			// GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			// AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			// AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			// OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			// ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
			// ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
			// AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan");
			// return $q_rekap_biaya;
			$nama_karyawan_me = $this->session->userdata("nama_karyawan");
			$q_rekap_biaya = $this->db->query("SELECT no_filter.*,nama_karyawan FROM (SELECT data_actual.*, tanggal_checkin, tanggal_checkout from (SELECT data_rencana.*,jml_visit_realisasi from 
			(SELECT data1.id_rencana_header, count(id_rencana_detail) as jml_visit,tanggal_rencana,id_karyawan from 
			(SELECT trm.nomor_rencana,trm.tanggal_penetapan,trm.tanggal_rencana,trm.keterangan as keterangan_header,trd.* from trx_rencana_master trm 
			join trx_rencana_detail trd on trm.id_rencana_header = trd.id_rencana_header)as data1 group by id_rencana_header)as data_rencana left join
			(SELECT data2.id_rencana_header, COUNT(id_rencana_detail) AS jml_visit_realisasi FROM 
			(SELECT trm.nomor_rencana,trm.tanggal_penetapan,trm.tanggal_rencana,trm.keterangan AS keterangan_header,trd.* FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header)AS data2 WHERE status_rencana='2' group by id_rencana_header)as data_realisasi 
			on data_rencana.id_rencana_header = data_realisasi.id_rencana_header group by data_rencana.id_rencana_header) as data_actual left join 
			(SELECT min_.*,tanggal_checkout from (SELECT data_min_ckin.id_rencana_header, tanggal_checkin from (SELECT id_rencana_header,min(id_checkin)as min_ckin from
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header join trx_checkin ckin on trd.id_rencana_detail=ckin.id_rencana_detail
			join trx_checkout ckout on ckin.id_checkin=ckout.id_checkin) as data_waktu group by id_rencana_header) as data_min_ckin join 
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin)as data_waktu on data_min_ckin.id_rencana_header=data_waktu.id_rencana_header and 
			data_min_ckin.min_ckin=data_waktu.id_checkin)as min_ join
			(SELECT data_max_ckout.id_rencana_header, tanggal_checkout FROM (SELECT id_rencana_header,Max(id_checkout)AS max_ckout FROM
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin) AS data_waktu  group by id_rencana_header) AS data_max_ckout JOIN 
			(SELECT trm.id_rencana_header,ckin.id_checkin,ckout.id_checkout,tanggal_checkin,tanggal_checkout FROM trx_rencana_master trm 
			JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail
			JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin)AS data_waktu ON data_max_ckout.id_rencana_header=data_waktu.id_rencana_header AND 
			data_max_ckout.max_ckout=data_waktu.id_checkout)as max_ on min_.id_rencana_header = max_.id_rencana_header)as min_max_waktu 
			on data_actual.id_rencana_header=min_max_waktu.id_rencana_header)as no_filter JOIN mst_user ON no_filter.id_karyawan=mst_user.id_karyawan 
			WHERE nama_karyawan LIKE '%$nama_karyawan_me%' AND tanggal_rencana between '$tanggal1' AND '$tanggal2'");
			return $q_rekap_biaya;
		} 
	}
	public function get_stock_fisik_history($tanggal1="",$tanggal2="",$id_customer="") {
	    $wilayah = $this->session->userdata("id_wilayah");
	    $nama=$this->session->userdata("nama_karyawan");
	    $id_role=$this->session->userdata("id_role");
	    if ($id_role==5){
	        $q_rekap_biaya = $this->db->query("SELECT nama_customer,nama_product, sf.batch,sf.date_update,sf.qty,nama_karyawan FROM stock_fisik sf
    									JOIN mst_product mp ON sf.id_product=mp.id_product
    									JOIN trx_rencana_detail trd ON sf.id_rencana_detail=trd.id_rencana_detail
    									JOIN mst_customer mc ON mc.id_customer=trd.id_customer
    									JOIN mst_user mu ON trd.id_karyawan=mu.id_karyawan WHERE mc.id_wilayah='$wilayah' AND nama_karyawan='$nama'
    									AND sf.date_update between '$tanggal1' AND '$tanggal2'");
	    }else{
    		$q_rekap_biaya = $this->db->query("SELECT nama_customer,nama_product, sf.batch,sf.date_update,sf.qty,nama_karyawan FROM stock_fisik sf
    									JOIN mst_product mp ON sf.id_product=mp.id_product
    									JOIN trx_rencana_detail trd ON sf.id_rencana_detail=trd.id_rencana_detail
    									JOIN mst_customer mc ON mc.id_customer=trd.id_customer
    									JOIN mst_user mu ON trd.id_karyawan=mu.id_karyawan WHERE mc.id_wilayah='$wilayah' 
    									AND sf.date_update between '$tanggal1' AND '$tanggal2'");
	    }
		return $q_rekap_biaya;
	}
	public function get_penjualan_history($tanggal1="",$tanggal2="",$id_customer="") {
	    $wilayah = $this->session->userdata("id_wilayah");
		$q_rekap_biaya = $this->db->query("SELECT nama_customer,nama_product, pj.batch,pj.date_insert,pj.qty,pj.date_from,pj.date_to,
									nama_karyawan FROM penjualan pj
									JOIN mst_product mp ON pj.id_product=mp.id_product
									JOIN trx_rencana_detail trd ON pj.id_rencana_detail=trd.id_rencana_detail
									JOIN mst_customer mc ON mc.id_customer=trd.id_customer
									JOIN mst_user mu ON trd.id_karyawan=mu.id_karyawan WHERE mc.id_wilayah='$wilayah' 
									AND pj.date_from between '$tanggal1' AND '$tanggal2' OR mc.id_wilayah='$wilayah' 
									AND pj.date_to between '$tanggal1' AND '$tanggal2'");
		return $q_rekap_biaya;
	}
	public function get_rekap_salesman_grantot($tanggal1="",$tanggal2="",$nama_wilayah="",$nama_karyawan="") {
		if($this->session->userdata("id_role") <=2){
			$q_rekap_biaya = $this->db->query("SELECT SUM(nilai_biaya) AS grand_tot FROM(SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
			FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' AND '$tanggal2 23:59:59' 
			AND mw.nama_wilayah LIKE '%$nama_wilayah'
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
			YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
			JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' AND '$tanggal2 23:59:59' 
			AND mw.nama_wilayah LIKE '%$nama_wilayah'
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
			ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
			AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan) AS report_rekap")->row();
			return $q_rekap_biaya;
		}else if($this->session->userdata("id_role") == 3 || $this->session->userdata("id_role") == 4){
			$wilayah = $this->session->userdata("id_wilayah");
			$id_departemen = $this->session->userdata("id_departemen");
			$q_rekap_biaya = $this->db->query("SELECT SUM(nilai_biaya) AS grand_tot FROM(SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
			FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			AND '$tanggal2 23:59:59' 
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
			YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
			JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			AND '$tanggal2 23:59:59' 
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
			ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
			AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan) AS report_rekap")->row();
			return $q_rekap_biaya;
		}else if($this->session->userdata("id_role") == 5){
			$wilayah = $this->session->userdata("id_wilayah");
			$id_departemen = $this->session->userdata("id_departemen");
			$id_user = $this->session->userdata("id_user");
			$q_rekap_biaya = $this->db->query("SELECT SUM(nilai_biaya) AS grand_tot FROM(SELECT double_dat.* FROM (SELECT MAX(berlaku_mulai) AS max_,id_karyawan,tanggal_checkout 
			FROM(SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			AND '$tanggal2 23:59:59' AND mu.id_user='$id_user'
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS data_harga_doble GROUP BY id_karyawan,
			YEAR(data_harga_doble.tanggal_checkout),MONTH(data_harga_doble.tanggal_checkout),DAY(data_harga_doble.tanggal_checkout))AS valid 
			JOIN (SELECT * FROM (SELECT mb.nilai_biaya,mb.berlaku_mulai,data_.* 
			FROM (SELECT ckout.id_user,trm.nomor_rencana,trm.tanggal_rencana,ckout.tanggal_checkout, ckout.id_jenis_kendaraan,
			mu.id_role,mk.id_kegiatan, tp.nama_karyawan,tp.id_karyawan, COUNT(ckin.kode_customer) AS juml_customer, SUM(ckout.jarak) AS jarak_tempuh 
			FROM (SELECT id_checkin, tanggal_checkin, id_rencana_detail, kode_customer 
			FROM trx_checkin GROUP BY tanggal_checkin,kode_customer) AS ckin 
			JOIN trx_checkout ckout ON ckin.id_checkin = ckout.id_checkin 
			JOIN mst_user mu ON ckout.id_user=mu.id_user
			JOIN mst_wilayah mw ON mu.id_wilayah=mw.id_wilayah
			JOIN tk_personal tp ON tp.id_karyawan=mu.id_karyawan
			JOIN trx_rencana_detail trd ON ckin.id_rencana_detail=trd.id_rencana_detail
			JOIN trx_rencana_master trm ON trd.id_rencana_header=trm.id_rencana_header
			JOIN mst_kegiatan mk ON trd.id_kegiatan=mk.id_kegiatan
			WHERE mu.id_departemen ='$id_departemen' AND mu.id_wilayah ='$wilayah' AND ckout.tanggal_checkout BETWEEN '$tanggal1 00:00:00' 
			AND '$tanggal2 23:59:59'  AND mu.id_user='$id_user'
			GROUP BY ckout.id_user,YEAR(ckout.tanggal_checkout),MONTH(ckout.tanggal_checkout),DAY(ckout.tanggal_checkout))
			AS data_ JOIN mst_biaya mb ON data_.id_kegiatan=mb.id_kegiatan 
			AND data_.id_role=mb.id_role)AS data_rekap_all WHERE id_jenis_kendaraan = 3 AND data_rekap_all.juml_customer >= 3 
			OR id_jenis_kendaraan = 3 AND data_rekap_all.jarak_tempuh >= 5  
			ORDER BY data_rekap_all.tanggal_checkout ASC) AS double_dat 
			ON valid.max_=double_dat.berlaku_mulai AND valid.id_karyawan=double_dat.id_karyawan 
			AND valid.tanggal_checkout=double_dat.tanggal_checkout WHERE nama_karyawan LIKE '%$nama_karyawan%' ORDER BY nama_karyawan) AS report_rekap")->row();
			return $q_rekap_biaya;
		}
	}
	public function get_penjualan_detail_modal($id) {
		$q = $this->db->query("SELECT keluar_detail.id_keluardetail,keluar_detail.id_keluarmaster, keluar_detail.id_product, keluar_detail.batch, keluar_detail.qty, mst_product.nama_product,keluar_master.tanggal FROM keluar_detail LEFT JOIN keluar_master ON keluar_master.id_keluarmaster = keluar_detail.id_keluarmaster LEFT JOIN mst_product ON mst_product.id_product = keluar_detail.id_product WHERE keluar_master.id_gudang = '$id' ORDER BY keluar_detail.id_keluardetail DESC");
		return $q;
	}
	// public function getAllKunjunganSlaes($id="") {
	// 	$q = $this->db->query("SELECT * FROM (SELECT id_request,id_user,COUNT(*) AS callw FROM 
	// 						(SELECT id_request,mu.id_user,nama,nama_wilayah FROM trx_so_header rs JOIN mst_user mu ON rs.id_user=mu.id_user 
	// 						JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah)AS data_ GROUP BY id_user) AS data_call 
	// 						JOIN (SELECT id_request,mu.id_user,nama,nama_wilayah FROM trx_so_header rs JOIN mst_user mu ON rs.id_user=mu.id_user 
	// 						JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah) AS data_order ON data_call.id_request = data_order.id_request");
	// 	return $q;
	// }
	public function getAllShipment($id="") {
		date_default_timezone_set("Asia/Bangkok");
		$dateNow = date('Y-m-d');
		$wilayah = $this->session->userdata('id_wilayah');
		$id_karyawan = $this->session->userdata('id_karyawan');
		if ($this->session->userdata("id_role") <=3){
// 			$q = $this->db->query("SELECT nama,nama_wilayah,wil_cust,wil_user,cust_ship,description,date(tanggal_request) as tanggal_request,tanggal_kirim,catatan,id_shipping,
// 								tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,
// 								nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
// 								SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
// 								SELECT data2.*,description,kode_shipping_point FROM(
// 								SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,nama_wilayah,mc.id_wilayah AS wil_cust,mu.id_wilayah AS wil_user,
// 								dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
// 								dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
// 								mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
// 								s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
// 								jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
// 								JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
// 								JOIN mst_user mu ON mu.id_user = rs.id_user
// 								JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah
// 								JOIN satuan s ON s.id_satuan=dr.id_satuan
// 								JOIN mst_product mp ON mp.id_product=dr.id_product
// 								JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
// 								JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
// 								JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 and dr.delete_id=0) AS data1
// 								JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
// 								AS data2 JOIN mst_shipping_point 
// 								ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
// 								JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
// 								JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim )
// 								AS data_shipment WHERE id_status_kirim='1' GROUP BY id_request,nama_transaksi");
            $q = $this->db->query("SELECT nama,nama_wilayah,wil_cust,wil_user,cust_ship,description,date(tanggal_request) as tanggal_request,tanggal_kirim,catatan,id_shipping,
								tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,id_karyawan,
								nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
								SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
								SELECT data2.*,description,kode_shipping_point FROM(
								SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,nama_wilayah,mc.id_wilayah AS wil_cust,mu.id_wilayah AS wil_user,
								dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
								dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
								mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
								s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
								jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
								JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
								JOIN mst_user mu ON mu.id_user = rs.id_user
								JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah
								JOIN satuan s ON s.id_satuan=dr.id_satuan
								JOIN mst_product mp ON mp.id_product=dr.id_product
								JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
								JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
								JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 and dr.delete_id=0) AS data1
								JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
								AS data2 JOIN mst_shipping_point 
								ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
								JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
								JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim )
								AS data_shipment WHERE wil_cust='$wilayah' AND id_status_kirim='1' AND id_karyawan='$id_karyawan' GROUP BY id_request,nama_transaksi");
		}
		else if($this->session->userdata("id_role") ==5){
			$q = $this->db->query("SELECT nama,nama_wilayah,wil_cust,wil_user,cust_ship,description,date(tanggal_request) as tanggal_request,tanggal_kirim,catatan,id_shipping,
								tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,id_karyawan,
								nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
								SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
								SELECT data2.*,description,kode_shipping_point FROM(
								SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,nama_wilayah,mc.id_wilayah AS wil_cust,mu.id_wilayah AS wil_user,
								dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
								dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
								mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
								s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
								jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
								JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
								JOIN mst_user mu ON mu.id_user = rs.id_user
								JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah
								JOIN satuan s ON s.id_satuan=dr.id_satuan
								JOIN mst_product mp ON mp.id_product=dr.id_product
								JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
								JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
								JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 and dr.delete_id=0) AS data1
								JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
								AS data2 JOIN mst_shipping_point 
								ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
								JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
								JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim )
								AS data_shipment WHERE wil_cust='$wilayah' AND id_status_kirim='1' AND id_karyawan='$id_karyawan' GROUP BY id_request,nama_transaksi");
		}else if($this->session->userdata("id_role") == 4 || $this->session->userdata("id_role") == 6){
			$id_user=$this->session->userdata("id_user");
			$dateFilter = date('Y-m-d');
			// $q_user_shipping_point = $this->db->query("SELECT count(*) as jml FROM mst_user_shipping_point WHERE id_user='$id_user'")->row();
			// if($q_user_shipping_point->jml > 0 ){
				$q = $this->db->query("SELECT * FROM (SELECT data_fix.* FROM (SELECT nama,nama_wilayah,wil_cust,wil_user,cust_ship,description,date(tanggal_request) as tanggal_request,tanggal_kirim,catatan,id_shipping,
								tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,id_karyawan,
								nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
								SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
								SELECT data2.*,description,kode_shipping_point FROM(
								SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,nama_wilayah,mc.id_wilayah AS wil_cust,mu.id_wilayah AS wil_user,
								dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
								dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
								mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
								s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
								jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
								JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
								JOIN mst_user mu ON mu.id_user = rs.id_user
								JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah
								JOIN satuan s ON s.id_satuan=dr.id_satuan
								JOIN mst_product mp ON mp.id_product=dr.id_product
								JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
								JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
								JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold WHERE rs.delete_id=0 and dr.delete_id=0) AS data1
								JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
								AS data2 JOIN mst_shipping_point 
								ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
								JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
								JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim)
								AS data_shipment WHERE wil_cust='$wilayah' GROUP BY id_request,nama_transaksi)AS data_fix
								JOIN mst_user_shipping_point ON data_fix.description=mst_user_shipping_point.description 
								WHERE mst_user_shipping_point.id_user = '$id_user') as data_complete WHERE tanggal_kirim='$dateFilter'");
			// }else{
			// 	$q = $this->db->query("SELECT nama,nama_wilayah,wil_cust,wil_user,cust_ship,description,date(tanggal_request) as tanggal_request,tanggal_kirim,catatan,id_shipping,
			// 					tanggal_shipping,id_status_kirim,id_detail_request,id_shipping_point,id_request,id_karyawan,
			// 					nama_transaksi,nama_status_kirim FROM(SELECT data4.*, nama_status_kirim FROM (
			// 					SELECT data3.*, id_shipping,id_status_kirim,tanggal_shipping FROM (
			// 					SELECT data2.*,description,kode_shipping_point FROM(
			// 					SELECT data1.*, nama_customer AS cust_ship FROM(SELECT rs.*,nama_wilayah,mc.id_wilayah AS wil_cust,mu.id_wilayah AS wil_user,
			// 					dr.id_detail_request,dr.id_product,dr.qty,dr.id_satuan,dr.keterangan,
			// 					dr.id_jenis_transaksi,dr.satuan,dr.id_shipping_point,mu.nama,mu.username,
			// 					mu.no_hp,mu.id_wilayah,mu.id_karyawan,mu.id_departemen,mu.id_role, 
			// 					s.nama_satuan,mp.nama_product,mp.kode_product,dpt.nama_departemen,
			// 					jt.nama_transaksi,nama_customer AS cust_sold FROM trx_so_header rs 
			// 					JOIN trx_so_detail dr ON rs.id_request = dr.id_request 
			// 					JOIN mst_user mu ON mu.id_user = rs.id_user
			// 					JOIN mst_wilayah mw ON mw.id_wilayah=mu.id_wilayah
			// 					JOIN satuan s ON s.id_satuan=dr.id_satuan
			// 					JOIN mst_product mp ON mp.id_product=dr.id_product
			// 					JOIN mst_departemen dpt ON dpt.id_departemen=mu.id_departemen
			// 					JOIN jenis_transaksi jt ON jt.id_jenis_transaksi=dr.id_jenis_transaksi
			// 					JOIN mst_customer mc ON mc.id_customer = rs.id_customer_sold) AS data1
			// 					JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_ship)
			// 					AS data2 JOIN mst_shipping_point 
			// 					ON mst_shipping_point.id_shipping_point=data2.id_shipping_point) AS data3
			// 					JOIN trx_shipping ON trx_shipping.id_detail_request = data3.id_detail_request) AS data4
			// 					JOIN status_kirim ON status_kirim.id_status_kirim = data4.id_status_kirim )
			// 					AS data_shipment WHERE wil_cust='$wilayah' AND id_status_kirim='1' GROUP BY id_request,nama_transaksi");
			// }
		}
		return $q;
	}
	public function get_retur($id) {
		$q = $this->db->query("SELECT retur_master.id_returmaster,retur_master.nomor, retur_master.tanggal,retur_master.keterangan, mst_customer.nama_customer FROM retur_master LEFT JOIN mst_customer ON mst_customer.id_customer = retur_master.id_customer WHERE retur_master.id_gudang = '$id' ORDER BY retur_master.id_returmaster DESC");
		return $q;
	}
	public function get_retur_detail($id) {
		$q = $this->db->query("SELECT retur_detail.id_returdetail,retur_detail.id_returmaster, retur_detail.id_product, retur_detail.batch, retur_detail.qty, mst_product.nama_product FROM retur_detail LEFT JOIN mst_product ON mst_product.id_product = retur_detail.id_product WHERE retur_detail.id_returmaster = '$id' ORDER BY retur_detail.id_returdetail DESC");
		return $q;
	}
	public function get_tmp_barcode_print() {
		$q = $this->db->query("SELECT tmp_barcode_print.copy,tmp_barcode_print.gambar,tmp_barcode_print.id_processdetail, mst_product.nama_product,process_detail.id_product,process_master.batch FROM tmp_barcode_print 
				LEFT JOIN process_detail ON process_detail.id_processdetail = tmp_barcode_print.id_processdetail 
				LEFT JOIN process_master ON process_master.id_rencana_header = process_detail.id_rencana_header 
				LEFT JOIN mst_product ON mst_product.id_product = process_detail.id_product");
		return $q;
	}
	public function get_transfer($id) {
		$q = $this->db->query("SELECT transfer_master.id_transfermaster,transfer_master.gudang_transfer, transfer_master.nomor, transfer_master.tanggal, transfer_master.jenis_transfer, transfer_master.keterangan, mst_gudang.nama_gudang FROM transfer_master LEFT JOIN mst_gudang ON mst_gudang.id_gudang = transfer_master.gudang_transfer WHERE transfer_master.id_gudang = '$id' ORDER BY transfer_master.id_transfermaster DESC");
		return $q;
	}
	public function get_transfer_detail($id) {
		$q = $this->db->query("SELECT transfer_detail.id_transferdetail,transfer_detail.id_transfermaster, transfer_detail.id_product, transfer_detail.batch, transfer_detail.qty,transfer_detail.no_box, mst_product.nama_product FROM transfer_detail LEFT JOIN mst_product ON mst_product.id_product = transfer_detail.id_product WHERE transfer_detail.id_transfermaster = '$id' ORDER BY transfer_detail.id_transferdetail DESC");
		return $q;
	}
	public function get_report_stock_hand($date,$gudang,$product,$batch) {
		$q = $this->db->query("SELECT transfer_detail.id_transferdetail, mst_gudang.nama_gudang, transfer_detail.batch, mst_product.id_product, mst_product.kode_product,mst_product.nama_product,mst_product.konversi_satuan,mst_satuan.nama_satuan,transfer_detail.qty, 
			SUM(CASE WHEN transfer_master.jenis_transfer='IN' THEN qty ELSE 0 END) AS stok_in, 
			SUM(CASE WHEN transfer_master.jenis_transfer='OUT' THEN qty ELSE 0 END) AS stok_out
			FROM transfer_detail 
			LEFT JOIN transfer_master ON transfer_master.id_transfermaster = transfer_detail.id_transfermaster
			LEFT JOIN mst_gudang ON transfer_master.id_gudang = mst_gudang.id_gudang
			LEFT JOIN mst_product ON transfer_detail.id_product = mst_product.id_product
			LEFT JOIN mst_satuan ON mst_satuan.id_satuan = mst_product.id_satuan WHERE transfer_master.tanggal <= '$date' AND mst_gudang.id_gudang = '$gudang' AND (mst_product.nama_product LIKE '%$product%' AND transfer_detail.batch LIKE '%$batch%')
			GROUP BY transfer_detail.id_product, transfer_detail.batch, transfer_master.id_gudang ORDER BY transfer_master.id_gudang ASC");
		return $q;
	}
	public function get_report_penjualan($id_gudang,$tgl_awal,$tgl_akhir,$product,$opsi,$opsi2,$status,$batch) {
		$q = $this->db->query("SELECT keluar_master.nomor, keluar_master.tanggal,keluar_master.keterangan, keluar_master.status_bayar,keluar_master.nama_customer as N_customer,mst_customer.nama_customer as NM_customer, keluar_detail.batch, keluar_detail.harga, keluar_detail.qty, mst_product.nama_product,mst_product.konversi_satuan, mst_satuan.nama_satuan FROM keluar_detail 
			LEFT JOIN keluar_master ON keluar_master.id_keluarmaster = keluar_detail.id_keluarmaster
			LEFT JOIN mst_customer ON mst_customer.id_customer = keluar_master.id_customer
			LEFT JOIN mst_product ON mst_product.id_product = keluar_detail.id_product 
			LEFT JOIN mst_satuan ON mst_satuan.id_satuan = mst_product.id_satuan WHERE keluar_master.id_gudang = '$id_gudang' AND keluar_master.tanggal >= '$tgl_awal' AND keluar_master.tanggal <= '$tgl_akhir' AND (mst_product.nama_product LIKE '%$product%' AND keluar_detail.batch LIKE '%$batch%' AND keluar_master.status_bayar LIKE '%$status%' AND keluar_master.status_bayar LIKE '%$opsi%' OR keluar_master.status_bayar LIKE '%$opsi2%') ORDER BY keluar_master.tanggal DESC");
		return $q;
	}
	public function get_combo_nota($id="") {
		$hasil = "";
		$id_gudang = $this->session->userdata("id_gudang");
		$q = $this->db->query("SELECT id_keluarmaster,nomor,status_bayar,tanggal FROM keluar_master WHERE id_gudang='$id_gudang' ORDER BY id_keluarmaster DESC");
		$hasil .= '<option selected="selected" value>Pilih Nota</option>';
		foreach($q->result() as $h) {
			$ex_tanggal = explode("-",$h->tanggal);
			$fix_tanggal = $ex_tanggal[2]."/".$ex_tanggal[1]."/".$ex_tanggal[0];
			if($h->status_bayar == '1') {
				$status_bayar = 'Lunas';
			} else if($h->status_bayar == '0') {
				$status_bayar = 'Tagihan';
			}
			else if($h->status_bayar == '2') {
				$status_bayar = 'Promosi';
			}
			if($id == $h->id_keluarmaster) {
				$hasil .= '<option value="'.$h->id_keluarmaster.'" selected="selected">'.$h->nomor.' - '.$fix_tanggal.' ['.$status_bayar.']</option>';
			} else {
				$hasil .= '<option value="'.$h->id_keluarmaster.'">'.$h->nomor.' - '.$fix_tanggal.' ['.$status_bayar.']</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_trf($id,$id_gudang) {
		$hasil = "";
		$q = $this->db->query("SELECT id_transfermaster,nomor,tanggal,jenis_transfer FROM transfer_master WHERE id_gudang='$id_gudang' ORDER BY id_transfermaster DESC");
		$hasil .= '<option selected="selected" value>Pilih Nomor</option>';
		foreach($q->result() as $h) {
			$ex_tanggal = explode("-",$h->tanggal);
			$fix_tanggal = $ex_tanggal[2]."/".$ex_tanggal[1]."/".$ex_tanggal[0];
			if($id == $h->id_transfermaster) {
				$hasil .= '<option value="'.$h->id_transfermaster.'" selected="selected">'.$h->nomor.' - '.$fix_tanggal.' - '.$h->jenis_transfer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_transfermaster.'">'.$h->nomor.' - '.$fix_tanggal.' - '.$h->jenis_transfer.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_prc($id,$id_gudang) {
		$hasil = "";
		$q = $this->db->query("SELECT id_rencana_header,nomor,tgl_pasturisasi FROM process_master WHERE id_gudang='$id_gudang' ORDER BY id_rencana_header DESC");
		$hasil .= '<option selected="selected" value>Pilih Nomor</option>';
		foreach($q->result() as $h) {
			$ex_tanggal = explode("-",$h->tgl_pasturisasi);
			$fix_tanggal = $ex_tanggal[2]."/".$ex_tanggal[1]."/".$ex_tanggal[0];
			if($id == $h->id_rencana_header) {
				$hasil .= '<option value="'.$h->id_rencana_header.'" selected="selected">'.$h->nomor.' - '.$fix_tanggal.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_rencana_header.'">'.$h->nomor.' - '.$fix_tanggal.'</option>';
			}
		}
		return $hasil;
	}
	/*
	public function get_combo_satuan($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_satuan");
		$hasil .= '<option selected="selected" value>Pilih Satuan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_satuan) {
				$hasil .= '<option value="'.$h->id_satuan.'" selected="selected">'.$h->nama_satuan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_satuan.'">'.$h->nama_satuan.'</option>';
			}
		}
		return $hasil;
	}
	*/
	public function get_combo_gudang($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_gudang");
		$hasil .= '<option selected="selected" value>Pilih Gudang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_gudang) {
				$hasil .= '<option value="'.$h->id_gudang.'" selected="selected">'.$h->nama_gudang.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_gudang.'">'.$h->nama_gudang.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_gudang_rpt($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_gudang");
		$hasil .= '<option selected="selected" value="">[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_gudang) {
				$hasil .= '<option value="'.$h->nama_gudang.'" selected="selected">'.$h->nama_gudang.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_gudang.'">'.$h->nama_gudang.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_gudang_trf($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_gudang");
		$hasil .= '<option selected="selected" value>Pilih Gudang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_gudang) {
				$hasil .= '<option value="'.$h->id_gudang.'" selected="selected">'.$h->nama_gudang.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_gudang.'">'.$h->nama_gudang.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_gudang_trf2($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_gudang");
		$hasil .= '<option selected="selected" value>Pilih Gudang</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_gudang) {
				$hasil .= '<option value="'.$h->id_gudang.'" selected="selected">'.$h->nama_gudang.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_gudang.'">'.$h->nama_gudang.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_product($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product WHERE tampilkan='1' ORDER BY nama_product ASC");
		$hasil .= '<option selected="selected" value>Pilih Product</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_product) {
				$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product.'</option>';
			}
		}
		return $hasil;
	}
	// public function get_combo_product_matgr($prod,$id) {
	// 	if($prod==""){
	// 		$matgr = $this->session->userdata('matgr');
	// 	}else{
	// 		$qmt = $this->db->query("SELECT matgr FROM mst_product WHERE id_product='$prod' GROUP BY matgr")->row();
	// 		if($qmt==""){
	// 			$matgr = $this->session->userdata('matgr');
	// 		}else{
	// 			$matgr = $qmt->matgr;
	// 		}
	// 	}
	// 	$hasil = "";
	// 	$q = $this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan WHERE matgr='$matgr' AND tampilkan='1' ORDER BY nama_product ASC ");
	// 	$hasil .= '<option selected="selected" value>Pilih Product</option>';
	// 	foreach($q->result() as $h) {
	// 		if($id == $h->id_product) {
	// 			$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product." || ".$h->kode_product.'</option>';
	// 		} else {
	// 			$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product." || ".$h->kode_product.'</option>';
	// 		}
	// 	}
	// 	return $hasil;
	// }
	public function get_combo_product_matgr($prod,$id) {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product WHERE tampilkan='1' AND division='$prod' ORDER BY nama_product ASC");
		$hasil .= '<option selected="selected" value>Pilih Product</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_product) {
				$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product." || ".$h->kode_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product." || ".$h->kode_product.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_product_dairy($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan WHERE division='34' ORDER BY nama_product ASC ");
		$hasil .= '<option selected="selected" value>Pilih Product</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_product) {
				$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_product_meat($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan WHERE division='33' ORDER BY nama_product ASC ");
		$hasil .= '<option selected="selected" value>Pilih Product</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_product) {
				$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shipping_point($id="") {
		$hasil = "";
		if($this->session->userdata("id_role")==6){
			$id_user = $this->session->userdata("id_user");
			$q = $this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN mst_user_shipping_point 
								WHERE mst_shipping_point.description=mst_user_shipping_point.description AND id_user='$id_user'
								GROUP BY id_shipping_point");
			$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
			foreach($q->result() as $h) {
				if($id == $h->kode_shipping_point) {
					$hasil .= '<option value="'.$h->kode_shipping_point.'" selected="selected">'.$h->description.'</option>';
				} else {
					$hasil .= '<option value="'.$h->kode_shipping_point.'">'.$h->description.'</option>';
				}
			}
		}else{
			$q = $this->db->query("SELECT * FROM mst_shipping_point");
			$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_shipping_point) {
					$hasil .= '<option value="'.$h->id_shipping_point.'" selected="selected">'.$h->description.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_shipping_point.'">'.$h->description.'</option>';
				}
			}
		}
		return $hasil;
	}
	public function get_material_group($id="") {
		$hasil = "";
		$id_user = $this->session->userdata("id_user");
		$q = $this->db->query("SELECT matgr,matdesc FROM mst_product group by matgr");
		$hasil .= '<option selected="selected" value>Pilih Material Group</option>';
		foreach($q->result() as $h) {
			if($id == $h->matgr) {
				$hasil .= '<option value="'.$h->matgr.'" selected="selected">'.$h->matdesc.'</option>';
			} else {
				$hasil .= '<option value="'.$h->matgr.'">'.$h->matdesc.'</option>';
			}
		}
		return $hasil;
	}
	public function get_cluster_list($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT cluster_id,cluster_description FROM mst_cluster");
		$hasil .= '<option selected="selected" value>Pilih Cluster</option>';
		foreach($q->result() as $h) {
			if($id == $h->cluster_id) {
				$hasil .= '<option value="'.$h->cluster_id.'" selected="selected">'.$h->cluster_description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->cluster_id.'">'.$h->cluster_description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shipping_point_name($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN trx_so_detail WHERE mst_shipping_point.id_shipping_point=trx_so_detail.id_shipping_point
								GROUP BY id_shipping_point");
		$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_shipping_point) {
				$hasil .= '<option value="'.$h->kode_shipping_point.'" selected="selected">'.$h->description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_shipping_point.'">'.$h->description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shipping_point_name1($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN trx_so_detail WHERE mst_shipping_point.id_shipping_point=trx_so_detail.id_shipping_point
								GROUP BY id_shipping_point");
		$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
		foreach($q->result() as $h) {
			if($id == $h->description) {
				$hasil .= '<option value="'.$h->description.'" selected="selected">'.$h->description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->description.'">'.$h->description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shipping_point_id($id="") {
		$hasil = "";
		if($this->session->userdata("id_role")==6){
			$q = $this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN mst_user_shipping_point 
								WHERE mst_shipping_point.description=mst_user_shipping_point.description
								GROUP BY id_shipping_point");
			$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_shipping_point) {
					$hasil .= '<option value="'.$h->id_shipping_point.'" selected="selected">'.$h->description.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_shipping_point.'">'.$h->description.'</option>';
				}
			}
		}else{
			$q = $this->db->query("SELECT * FROM mst_shipping_point GROUP BY id_shipping_point");
			$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_shipping_point) {
					$hasil .= '<option value="'.$h->id_shipping_point.'" selected="selected">'.$h->description.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_shipping_point.'">'.$h->description.'</option>';
				}
			}
		}
		return $hasil;
	}
	public function get_combo_realisasi($id="") {
		$hasil = "";
			$q = $this->db->query("SELECT * FROM jenis_realisasi");
			$hasil .= '<option selected="selected" value>Status Realisasi</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_realisasi) {
					$hasil .= '<option value="'.$h->id_realisasi.'" selected="selected">'.$h->nama_realisasi.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_realisasi.'">'.$h->nama_realisasi.'</option>';
				}
			}
		return $hasil;
	}
	public function get_combo_shipping_point_name_only($id="") {
		$hasil = "";
		$id_user = $this->session->userdata("id_user");
		$q = $this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN mst_user_shipping_point 
							WHERE mst_shipping_point.description=mst_user_shipping_point.description AND id_user='$id_user'
							GROUP BY id_shipping_point");
		$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_shipping_point) {
				$hasil .= '<option value="'.$h->kode_shipping_point.'" selected="selected">'.$h->description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_shipping_point.'">'.$h->description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_status_kirim($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM status_kirim ORDER BY nama_status_kirim");
		$hasil .= '<option selected="selected" value>Pilih Status</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_status_kirim) {
				$hasil .= '<option value="'.$h->nama_status_kirim.'" selected="selected">'.$h->nama_status_kirim.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_status_kirim.'">'.$h->nama_status_kirim.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_status_kirim_id($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM status_kirim ORDER BY nama_status_kirim");
		$hasil .= '<option selected="selected" value>Pilih Status</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_status_kirim) {
				$hasil .= '<option value="'.$h->id_status_kirim.'" selected="selected">'.$h->nama_status_kirim.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_status_kirim.'">'.$h->nama_status_kirim.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_sales_person($kode_customer="",$pers_numb="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM sales_person WHERE id_sales_person > 0 and pers_numb <>' 0000000'");
		$hasil .= '<option selected="selected" value>Sales Person</option>';
		foreach($q->result() as $h) {
			if($pers_numb == $h->pers_numb) {
				$hasil .= '<option value="'.$h->pers_numb.'" selected="selected">'.$h->sales_pers.'</option>';
			} else {
				$hasil .= '<option value="'.$h->pers_numb.'">'.$h->sales_pers.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_departemen_karyawan($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_departemen ORDER BY nama_departemen ASC");
		//$hasil .= '<option value>Pilih departemen</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_departemen) {
				$hasil .= '<option value="'.$h->id_departemen.'"selected="selected">'.$h->nama_departemen.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_departemen.'">'.$h->nama_departemen.'</option>';
			}
		}
		return $hasil;
	}
	function get_combo_karyawan(){
		$this->db->order_by('nama_karyawan','ASC');
		$provinces= $this->db->get('tk_personal');
		return $provinces->result_array();
	}
	function get_combo_karyawan_($id=""){
		$hasil = "";
		$q = $this->db->query("SELECT * FROM tk_personal");
		$hasil .= '<option selected="selected" value>Pilih Karyawan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_karyawan) {
				$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama_karyawan." (".$h->no_index.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama_karyawan." (".$h->no_index.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_karyawan_kegiatan($id="") {
		$hasil = "";
		$id_role = $this->session->userdata("id_role");
		$id_karyawan = $this->session->userdata("id_karyawan");
		$id_departemen = $this->session->userdata("id_departemen");
		if($id_role == '1'){
			$q = $this->db->query("SELECT * FROM mst_user");
			$hasil .= '<option selected="selected" value>Pilih karyawan</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_karyawan) {
					$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama.'</option>';
				}
			}
			return $hasil;
		}else if($id_role == '3'){
			$q = $this->db->query("SELECT * FROM mst_user
			WHERE id_departemen='$id_departemen'");
			$hasil .= '<option selected="selected" value>Pilih karyawan</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_karyawan) {
					$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama.'</option>';
				}else {
					$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama.'</option>';
				}
			}
			return $hasil;
		}else if($id_role == '4'){
			$q = $this->db->query("SELECT * FROM mst_user where id_aplikasi='2'");
			$hasil .= '<option selected="selected" value>Pilih karyawan</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_karyawan) {
					$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama.'</option>';
				}else {
					$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama.'</option>';
				}
			}
			return $hasil;
		}else if($id_role == '5'){
			$q = $this->db->query("SELECT * FROM mst_user WHERE id_karyawan='$id_karyawan' AND id_role='5'");
			$hasil .= '<option selected="selected" value>Pilih karyawan</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_karyawan) {
					$hasil .= '<option value="'.$h->id_karyawan.'" selected="selected">'.$h->nama.'</option>';
				}else {
					$hasil .= '<option value="'.$h->id_karyawan.'">'.$h->nama.'</option>';
				}
			}
			return $hasil;
		}
	}
	public function get_combo_rencana($id="") {
		if($this->session->userdata("id_role")==5){
			$id_karyawan=$this->session->userdata("id_karyawan");
			$id_user_inpt=$this->session->userdata("id_user");
			$hasil = "";
// 			$q = $this->db->query("SELECT trm.* FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header=trd.id_rencana_header 
// 								WHERE id_karyawan='$id_karyawan' GROUP BY id_rencana_header ORDER BY id_rencana_header DESC");
			$q = $this->db->query("SELECT trm.* FROM trx_rencana_master trm  
								WHERE id_user_input_rencana='$id_user_inpt' GROUP BY tanggal_rencana ORDER BY id_rencana_header DESC");
			$hasil .= '<option selected="selected" value>Pilih rencana untuk edit</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_rencana_header) {
					$hasil .= '<option value="'.$h->id_rencana_header.'" selected="selected">'."Rencana tanggal ".$h->tanggal_rencana.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_rencana_header.'">'."Rencana tanggal ".$h->tanggal_rencana.'</option>';
				}
			}
		}else if($this->session->userdata("id_role")==4){
			$hasil = "";
			$q = $this->db->query("SELECT trm.*, nama_karyawan FROM trx_rencana_master trm join trx_rencana_detail trd on trm.id_rencana_header=trd.id_rencana_header 
								join mst_user mu on mu.id_karyawan = trd.id_karyawan GROUP BY trm.id_rencana_header ORDER BY id_rencana_header DESC ");
			$hasil .= '<option selected="selected" value>Pilih rencana</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_rencana_header) {
					$hasil .= '<option value="'.$h->id_rencana_header.'" selected="selected">'."Rencana ".$h->nama_karyawan." tanggal ".$h->tanggal_rencana.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_rencana_header.'">'."Rencana ".$h->nama_karyawan." tanggal ".$h->tanggal_rencana.'</option>';
				}
			}
		}
		return $hasil;
	}
	public function get_combo_customer($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_customer ");
		$hasil .= '<option selected="selected" value>Pilih Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_customer) {
				$hasil .= '<option value="'.$h->kode_customer.'" selected="selected">'.$h->nama_customer." (".$h->city.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_customer.'">'.$h->nama_customer." (".$h->city.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customer_rencana($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_customer ");
		$hasil .= '<option selected="selected" value>Pilih Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_customer) {
				$hasil .= '<option value="'.$h->id_customer.'" selected="selected">'.$h->nama_customer." (".$h->city.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_customer.'">'.$h->nama_customer." (".$h->city.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customer_stock($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mst_customer.* FROM mst_customer JOIN stock_customer ON mst_customer.id_customer=stock_customer.id_customer 
							GROUP BY mst_customer.id_customer ORDER BY nama_customer");
		$hasil .= '<option selected="selected" value>Pilih Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_customer) {
				$hasil .= '<option value="'.$h->id_customer.'" selected="selected">'.$h->nama_customer." (".$h->city.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_customer.'">'.$h->nama_customer." (".$h->city.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customer_stock_fisik($id="") {
		$id_karyawan = $this->session->userdata("id_karyawan");
		$id_role = $this->session->userdata("id_role");
		$id_wilayah = $this->session->userdata("id_wilayah");
		$hasil = "";
		if($id_role == 5){
			$q = $this->db->query("SELECT mc.* FROM mst_customer mc JOIN trx_rencana_detail trd ON mc.id_customer=trd.id_customer 
						JOIN stock_fisik sf ON trd.id_rencana_detail=sf.id_rencana_detail WHERE trd.id_karyawan='$id_karyawan' 
						GROUP BY mc.id_customer ORDER BY mc.nama_customer");
		}else{
			$q = $this->db->query("SELECT mc.* FROM mst_customer mc JOIN trx_rencana_detail trd ON mc.id_customer=trd.id_customer 
						JOIN stock_fisik sf ON trd.id_rencana_detail=sf.id_rencana_detail where id_wilayah ='$id_wilayah' 
						GROUP BY mc.id_customer ORDER BY mc.nama_customer");
		}
		$hasil .= '<option selected="selected" value>[Semua]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_customer) {
				$hasil .= '<option value="'.$h->id_customer.'" selected="selected">'.$h->nama_customer." (".$h->city.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_customer.'">'.$h->nama_customer." (".$h->city.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_satuan($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM satuan");
		$hasil .= '<option selected="selected" value>Pilih Satuan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_satuan) {
				$hasil .= '<option value="'.$h->id_satuan.'" selected="selected">'.$h->nama_satuan.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_satuan.'">'.$h->nama_satuan.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_cluster($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_customer");
		$hasil .= '<option selected="selected" value>Ketik_Nama_Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_customer) {
				$hasil .= '<option value="'.$h->kode_customer.'" selected="selected">'.$h->nama_customer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_customer.'">'.$h->nama_customer.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_cluster_release($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_cluster");
		$hasil .= '<option selected="selected" value>Ketik_Nama_Cluster</option>';
		foreach($q->result() as $h) {
			if($id == $h->cluster_id) {
				$hasil .= '<option value="'.$h->cluster_id.'" selected="selected">'.$h->cluster_description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->cluster_id.'">'.$h->cluster_description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_clusterC($id="") {
		$hasil = "";
		$region = $this->session->userdata('sample_cluster');
		$q = $this->db->query("SELECT * FROM mst_customer WHERE REGION='$region'");
		$hasil .= '<option selected="selected" value>Ketik_Nama_Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_customer) {
				$hasil .= '<option value="'.$h->kode_customer.'" selected="selected">'.$h->nama_customer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_customer.'">'.$h->nama_customer.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_clusterCl($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_cluster WHERE region='$id'");
		$hasil .= '<option selected="selected" value>Pilih_Cluster</option>';
		foreach($q->result() as $h) {
			if($id == $h->cluster_id) {
				$hasil .= '<option value="'.$h->cluster_id.'" selected="selected">'.$h->cluster_description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->cluster_id.'">'.$h->cluster_description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_region($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT region,region_desc FROM mst_customer GROUP BY region ORDER BY region_desc ASC");
		$hasil .= '<option selected="selected" value>Pilih_Region</option>';
		foreach($q->result() as $h) {
			if($id == $h->region) {
				$hasil .= '<option value="'.$h->region.'" selected="selected">'.$h->region_desc.'</option>';
			} else {
				$hasil .= '<option value="'.$h->region.'">'.$h->region_desc.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_plant_group($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_plant_group");
		$hasil .= '<option selected="selected" value>Pilih Plant Group</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_plant_group) {
				$hasil .= '<option value="'.$h->id_plant_group.'" selected="selected">'.$h->plant_group_name.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_plant_group.'">'.$h->plant_group_name.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_divisi($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_plant_group");
		$hasil .= '<option selected="selected" value>Pilih Divisi</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_plant_group) {
				$hasil .= '<option value="'.$h->id_plant_group.'" selected="selected">'.$h->plant_group_name.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_plant_group.'">'.$h->plant_group_name.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_jenis_transaksi($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM jenis_transaksi where id_jenis_transaksi =2");
		$hasil .= '<option selected="selected" value>Jenis transaksi</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_jenis_transaksi) {
				$hasil .= '<option value="'.$h->id_jenis_transaksi.'" selected="selected">'.$h->nama_transaksi.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_jenis_transaksi.'">'.$h->nama_transaksi.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_jenis_transaksi_kode($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM jenis_transaksi where id_jenis_transaksi =2");
		$hasil .= '<option selected="selected" value>Jenis transaksi</option>';
		foreach($q->result() as $h) {
			if($id == $h->kode_trans) {
				$hasil .= '<option value="'.$h->kode_trans.'" selected="selected">'.$h->nama_transaksi.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_trans.'">'.$h->nama_transaksi.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_jenis_transaksi_PO($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM jenis_transaksi where id_jenis_transaksi = 1");
		$hasil .= '<option selected="selected" value>Jenis transaksi</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_jenis_transaksi) {
				$hasil .= '<option value="'.$h->id_jenis_transaksi.'" selected="selected">'.$h->nama_transaksi.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_jenis_transaksi.'">'.$h->nama_transaksi.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_sales_person1($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM sales_person");
		$hasil .= '<option selected="selected" value>Sales Person</option>';
		foreach($q->result() as $h) {
			if($id == $h->pers_numb) {
				$hasil .= '<option value="'.$h->pers_numb.'" selected="selected">'.$h->sales_pers.'</option>';
			} else {
				$hasil .= '<option value="'.$h->pers_numb.'">'.$h->sales_pers.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_sales_person2($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM sales_person");
		$hasil .= '<option selected="selected" value>Sales Person</option>';
		foreach($q->result() as $h) {
			if($id == $h->pers_numb) {
				$hasil .= '<option value="'.$h->pers_numb.'" selected="selected">'.$h->sales_pers.'</option>';
			} else {
				$hasil .= '<option value="'.$h->pers_numb.'">'.$h->sales_pers.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_status_customer($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM status_customer");
		$hasil .= '<option selected="selected" value>Status Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_status_customer) {
				$hasil .= '<option value="'.$h->id_status_customer.'" selected="selected">'.$h->nama_status.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_status_customer.'">'.$h->nama_status.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_wilayah_id_($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_wilayah ");
		$hasil .= '<option selected="selected" value>Pilih Wilayah</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_wilayah) {
				$hasil .= '<option value="'.$h->id_wilayah.'" selected="selected">'.$h->nama_wilayah.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_wilayah.'">'.$h->nama_wilayah.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customer_kode($id="") {
		$hasil = "";
		$id_wilayah=$this->session->userdata("id_wilayah");
		$q = $this->db->query("SELECT * FROM mst_customer WHERE id_status_customer !=0 AND id_wilayah='$id_wilayah'");
		$hasil .= '<option selected="selected" value>Pilih Customer</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_customer) {
				$hasil .= '<option value="'.$h->kode_customer.'" selected="selected">'.$h->nama_customer." - (".$h->kode_customer.") - ".$h->city.'</option>';
			} else {
				$hasil .= '<option value="'.$h->kode_customer.'">'.$h->nama_customer." - (".$h->kode_customer.") - ".$h->city.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_customerCluster($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_customer WHERE region='$id'");
		$hasil .= '<option selected="selected" value>Pilih Customer</option>';
		foreach($q->result() as $h) {
			$hasil .= '<option value="'.$h->kode_customer.'">'.$h->nama_customer.'</option>';
		}
		return $hasil;
	}
	public function get_combo_ship_kode($id="") {
		$hasil = "";
		$id_wilayah=$this->session->userdata("id_wilayah");
		$q = $this->db->query("SELECT * FROM mst_customer WHERE id_status_customer =2 AND id_wilayah='$id_wilayah'");
		$hasil .= '<option selected="selected" value>Pilih Ship to Party</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_customer) {
				$hasil .= '<option value="'.$h->id_customer.'" selected="selected">'.substr($h->nama_customer,0,20)." - (".$h->city.") ".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_customer.'">'.substr($h->nama_customer,0,20)." - (".$h->city.") ".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_sold_kode($id="") {
		$hasil = "";
		$id_wilayah=$this->session->userdata("id_wilayah");
		$q = $this->db->query("SELECT * FROM mst_customer WHERE id_status_customer =2 AND id_wilayah='$id_wilayah'");
		$hasil .= '<option selected="selected" value>Pilih Sold  to Party</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_customer) {
				$hasil .= '<option value="'.$h->id_customer.'" selected="selected">'.substr($h->nama_customer,0,20)." - (".$h->city.") ".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_customer.'">'.substr($h->nama_customer,0,20)." - (".$h->city.") ".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_shp($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_shipping_point");
		$hasil .= '<option selected="selected" value>Pilih Shipping Point</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_shipping_point) {
				$hasil .= '<option value="'.$h->id_shipping_point.'" selected="selected">'.$h->description.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_shipping_point.'">'.$h->description.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_alamat_kirim($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM alamat_kirim");
		$hasil .= '<option selected="selected" value>Pilih Alamat Kirim</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_alamat_kirim) {
				$hasil .= '<option value="'.$h->id_alamat_kirim.'" selected="selected">'.$h->alamat_kirim.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_alamat_kirim.'">'.$h->alamat_kirim.'</option>';
			}
		}
		return $hasil;
	}
	public function get_alamat_kirim_customer($id="") {
		$hasil = "";
		$qcustomer= $this->db->query("SELECT id_customer FROM mst_customer WHERE kode_customer='$id'")->row();
		$id_customer= $qcustomer->id_customer;
		$q = $this->db->query("SELECT * FROM alamat_kirim WHERE id_customer ='$id_customer'");
		$hasil .= '<option selected="selected" value>Pilih Alamat Kirim</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_alamat_kirim) {
				$hasil .= '<option value="'.$h->id_alamat_kirim.'" selected="selected">'.$h->alamat_kirim.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_alamat_kirim.'">'.$h->alamat_kirim.'</option>';
			}
		}
		return $hasil;
	}
// public function get_combo_nomor_order($id="") {
// 		$hasil = "";
// 		$id_user=$this->session->userdata("id_user");
// 		$id_role=$this->session->userdata("id_role");
// 		$id_departemen=$this->session->userdata("id_departemen");
// 		if($id_role<=2){
// 			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
// 			mst_customer.id_customer = trx_so_header.id_customer_ship  ORDER BY id_request DESC ");
// 			$hasil .= '<option selected="selected" value>Edit data orderan disini</option>';
// 			foreach($q->result() as $h) {
// 				if($id == $h->id_request) {
// 					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
// 				} else {
// 					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
// 				}
// 			}
// 		}else if($id_role<=4){
// 			$q = $this->db->query("SELECT mst_customer.nama_customer,trx_so_header.tanggal_kirim,trx_so_header.id_request FROM trx_so_header JOIN mst_customer ON 
// 			mst_customer.id_customer = trx_so_header.id_customer_ship JOIN mst_user ON trx_so_header.id_user=mst_user.id_user 
// 			join trx_shipping on trx_so_header.id_request = trx_shipping.id_request  
// 			WHERE trx_so_header.delete_id=0 and id_status_kirim <> 2  group by trx_so_header.id_request ORDER BY trx_so_header.id_request DESC limit 2000");
// 			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
// 			foreach($q->result() as $h) {
// 				if($id == $h->id_request) {
// 					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
// 				} else {
// 					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
// 				}
// 			}
// 		}else if($id_role==5){
// 			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
// 			mst_customer.id_customer = trx_so_header.id_customer_ship WHERE trx_so_header.delete_id=0 and id_user='$id_user' ORDER BY id_request DESC");
// 			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
// 			foreach($q->result() as $h) {
// 				if($id == $h->id_request) {
// 					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")". '</option>';
// 				} else {
// 					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
// 				}
// 			}
// 		} else if($id_role==6){
// 			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
// 			mst_customer.id_customer = trx_so_header.id_customer_ship WHERE trx_so_header.delete_id=0 and id_user='$id_user' ORDER BY id_request DESC");
// 			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
// 			foreach($q->result() as $h) {
// 				if($id == $h->id_request) {
// 					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
// 				} else {
// 					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
// 				}
// 			}
// 		} else {
// 			redirect("Login");
// 		}
// 		return $hasil;
// 	}
public function get_combo_nomor_order($id="") {
		$hasil = "";
		$id_user=$this->session->userdata("id_user");
		$id_role=$this->session->userdata("id_role");
		$id_departemen=$this->session->userdata("id_departemen");
		if($id_role<=2){
			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
			mst_customer.id_customer = trx_so_header.id_customer_ship ORDER BY id_request DESC ");
			$hasil .= '<option selected="selected" value>Edit data orderan disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				}
			}
		}else if($id_role<=4){
			$q = $this->db->query("SELECT mst_customer.nama_customer,trx_so_header.tanggal_kirim,trx_so_header.id_request FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN mst_user ON trx_so_header.id_user=mst_user.id_user 
								JOIN trx_so_detail on trx_so_detail.id_request=trx_so_header.id_request
                                WHERE trx_so_header.delete_id=0 AND id_jenis_transaksi = 2  GROUP BY trx_so_header.id_request 
                                ORDER BY trx_so_header.id_request DESC limit 1000");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
				} else {
					// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		}else if($id_role==5){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
								JOIN trx_so_detail on trx_so_detail.id_request=trx_so_header.id_request
                                WHERE trx_so_header.delete_id=0 AND id_jenis_transaksi = 2 AND id_user='$id_user' GROUP BY id_request ORDER BY id_request DESC LIMIT 1000");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")". '</option>';
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
				} else {
					// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		} else if($id_role==6){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi > 2 ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				}
			}
		} else {
			redirect("Login");
		}
		return $hasil;
}
public function get_combo_nomor_order_PO($id="") {
	$hasil = "";
	$id_user=$this->session->userdata("id_user");
	$id_role=$this->session->userdata("id_role");
	$id_departemen=$this->session->userdata("id_departemen");
	if($id_role<=2){
		$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
		mst_customer.id_customer = trx_so_header.id_customer_ship  ORDER BY id_request DESC ");
		$hasil .= '<option selected="selected" value>Edit data orderan disini</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_request) {
				$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
			}
		}
	}else if($id_role<=4){
		$q = $this->db->query("SELECT mst_customer.nama_customer,trx_so_header.tanggal_kirim,trx_so_header.id_request FROM trx_so_header 
							JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
							JOIN mst_user ON trx_so_header.id_user=mst_user.id_user 
							JOIN trx_so_detail on trx_so_detail.id_request=trx_so_header.id_request
							JOIN jenis_transaksi ON jenis_transaksi.id_jenis_transaksi=trx_so_detail.id_jenis_transaksi
							WHERE trx_so_header.delete_id=0 AND jenis_order=1  GROUP BY trx_so_header.id_request 
							ORDER BY trx_so_header.id_request DESC limit 300");
		$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_request) {
				// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
			} else {
				// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
			}
		}
	}else if($id_role==5){
		$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
							JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
							JOIN trx_so_detail on trx_so_detail.id_request=trx_so_header.id_request
							JOIN jenis_transaksi ON jenis_transaksi.id_jenis_transaksi=trx_so_detail.id_jenis_transaksi
							WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND jenis_order=1 GROUP BY trx_so_header.id_request ORDER BY id_request DESC LIMIT 1000");
		$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_request) {
				// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")". '</option>';
				$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
			} else {
				// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
			}
		}
	} else if($id_role==6){
		$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
							JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
							JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
							WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi > 1 ORDER BY id_request DESC");
		$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_request) {
				$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
			}
		}
	} else {
		redirect("Login");
	}
	return $hasil;
}
public function get_combo_order_reason($id="") {
	$hasil = "";
	$id_user=$this->session->userdata("id_user");
	$id_role=$this->session->userdata("id_role");
	$id_departemen=$this->session->userdata("id_departemen");
		$q = $this->db->query("SELECT * FROM order_reason WHERE kode_trans='ZSML'");
		$hasil .= '<option selected="selected" value>Pilih Reason</option>';
		foreach($q->result() as $h) {
			if($id == $h->order_reason) {
				$hasil .= '<option value="'.$h->order_reason.'" selected="selected">'.$h->reason_desc. '</option>';
			} else {
				$hasil .= '<option value="'.$h->order_reason.'">'.$h->reason_desc.'</option>';
			}
		}
	return $hasil;
}
public function get_combo_order_reason_non($id="") {
	$hasil = "";
	$id_user=$this->session->userdata("id_user");
	$id_role=$this->session->userdata("id_role");
	$id_departemen=$this->session->userdata("id_departemen");
		$q = $this->db->query("SELECT * FROM order_reason WHERE kode_trans='ZFRG'");
		$hasil .= '<option selected="selected" value>Pilih Reason</option>';
		foreach($q->result() as $h) {
			if($id == $h->order_reason) {
				$hasil .= '<option value="'.$h->order_reason.'" selected="selected">'.$h->reason_desc. '</option>';
			} else {
				$hasil .= '<option value="'.$h->order_reason.'">'.$h->reason_desc.'</option>';
			}
		}
	return $hasil;
}
public function get_combo_nomor_order_dairy($id="") {
		$hasil = "";
		$id_user=$this->session->userdata("id_user");
		$id_role=$this->session->userdata("id_role");
		$id_departemen=$this->session->userdata("id_departemen");
		if($id_role<=2){
			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
			mst_customer.id_customer = trx_so_header.id_customer_ship  ORDER BY id_request DESC ");
			$hasil .= '<option selected="selected" value>Edit data orderan disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				}
			}
		}else if($id_role<=4){
			$q = $this->db->query("SELECT mst_customer.nama_customer,trx_so_header.tanggal_kirim,trx_so_header.id_request FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN mst_user ON trx_so_header.id_user=mst_user.id_user 
                                JOIN trx_shipping ON trx_so_header.id_request = trx_shipping.id_request  
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_status_kirim <> 2 AND id_jenis_transaksi = 1 AND division='34'
                                GROUP BY trx_so_header.id_request 
                                ORDER BY trx_so_header.id_request DESC limit 1000");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
				} else {
					// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		}else if($id_role==5){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi = 1 AND division='34' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		} else if($id_role==6){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi = 1 AND division='34' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				}
			}
		} else {
			redirect("Login");
		}
		return $hasil;
}
public function get_combo_nomor_order_meat($id="") {
		$hasil = "";
		$id_user=$this->session->userdata("id_user");
		$id_role=$this->session->userdata("id_role");
		$id_departemen=$this->session->userdata("id_departemen");
		if($id_role<=2){
			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
			mst_customer.id_customer = trx_so_header.id_customer_ship  ORDER BY id_request DESC ");
			$hasil .= '<option selected="selected" value>Edit data orderan disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				}
			}
		}else if($id_role<=4){
			$q = $this->db->query("SELECT mst_customer.nama_customer,trx_so_header.tanggal_kirim,trx_so_header.id_request FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN mst_user ON trx_so_header.id_user=mst_user.id_user 
                                JOIN trx_shipping ON trx_so_header.id_request = trx_shipping.id_request  
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_status_kirim <> 2 AND id_jenis_transaksi = 1 AND division='33'
                                GROUP BY trx_so_header.id_request 
                                ORDER BY trx_so_header.id_request DESC limit 1000");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
					// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
				} else {
					// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		}else if($id_role==5){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi = 1 AND division='33' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					// $hasil .= '<option value="'.$h->id_request.'" selected="selected">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")". '</option>';
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")". '</option>';
				} else {
					// $hasil .= '<option value="'.$h->id_request.'">'."Dikirim ke ".substr($h->nama_customer,0,20)." Tanggal (".$h->tanggal_kirim.")".'</option>';
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)." ".$h->tanggal_kirim." (".$h->id_request.")".'</option>';
				}
			}
		} else if($id_role==6){
			$q = $this->db->query("SELECT trx_so_header.id_request,nama_customer,tanggal_kirim FROM trx_so_header 
                                JOIN mst_customer ON mst_customer.id_customer = trx_so_header.id_customer_ship 
                                JOIN trx_so_detail ON trx_so_detail.id_request=trx_so_header.id_request
                                JOIN mst_product ON mst_product.id_product=trx_so_detail.id_product
                                WHERE trx_so_header.delete_id=0 AND id_user='$id_user' AND id_jenis_transaksi = 1 AND division='33' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				}
			}
		} else {
			redirect("Login");
		}
		return $hasil;
}
	public function get_combo_nomor_scrapping($id="") {
		$hasil = "";
		$id_user=$this->session->userdata("id_user");
		$id_role=$this->session->userdata("id_role");
		$id_departemen=$this->session->userdata("id_departemen");
		if($id_role<=2){
			$q = $this->db->query("SELECT * FROM request_scrapping rs JOIN mst_shipping_point sp ON rs.id_shp_to=sp.id_shipping_point");
			$hasil .= '<option selected="selected" value>Edit Scrapping Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->description,0,20).'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->description,0,20).'</option>';
				}
			}
		}else if($id_role<=4){
			$q = $this->db->query("SELECT * FROM request_scrapping rs JOIN mst_shipping_point sp ON rs.id_shp_to=sp.id_shipping_point");
			$hasil .= '<option selected="selected" value>Edit Scrapping Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.$h->description.'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.$h->description.'</option>';
				}
			}
		}else if($id_role==5){
			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
			mst_customer.id_customer = trx_so_header.id_customer_ship WHERE id_user='$id_user' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")". '</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				}
			}
		} else if($id_role==6){
			$q = $this->db->query("SELECT * FROM trx_so_header JOIN mst_customer ON 
			mst_customer.id_customer = trx_so_header.id_customer_ship WHERE id_user='$id_user' ORDER BY id_request DESC");
			$hasil .= '<option selected="selected" value>Edit Order Disini</option>';
			foreach($q->result() as $h) {
				if($id == $h->id_request) {
					$hasil .= '<option value="'.$h->id_request.'" selected="selected">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				} else {
					$hasil .= '<option value="'.$h->id_request.'">'.substr($h->nama_customer,0,20)."  (".substr($h->tanggal_request,0,10).")".'</option>';
				}
			}
		} else {
			redirect("Login");
		}
		return $hasil;
	}
	public function get_combo_kegiatan($id="") {
		$hasil = "";
		$wid =  $this->session->userdata("id_wilayah");
		$q = $this->db->query("SELECT mk.*,wil.nama_wilayah FROM mst_kegiatan mk JOIN mst_wilayah wil 
								ON mk.id_wilayah=wil.id_wilayah WHERE active='1' AND mk.id_wilayah='$wid'");
		$hasil .= '<option selected="selected" value>Pilih kegiatan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_kegiatan) {
				$hasil .= '<option value="'.$h->id_kegiatan.'" selected="selected">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_kegiatan.'">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	/*
	public function get_kegiatan($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT mk.*,wil.nama_wilayah FROM mst_kegiatan mk JOIN mst_wilayah wil 
		ON mk.id_wilayah=wil.id_wilayah WHERE wil.id_wilayah='$id'");
		$hasil .= '<option selected="selected" value>Pilih kegiatan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_wilayah) {
				$hasil .= '<option value="'.$h->id_kegiatan.'" selected="selected">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_kegiatan.'">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	*/
	public function get_kegiatan_dept($id_dept) {
		$hasil = "";
		$q = $this->db->query("SELECT mk.*,wil.nama_wilayah FROM mst_kegiatan mk JOIN mst_wilayah wil 
		ON mk.id_wilayah=wil.id_wilayah WHERE id_departemen='$id_dept'");
		$hasil .= '<option selected="selected" value>Pilih kegiatan</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_wilayah) {
				$hasil .= '<option value="'.$h->id_kegiatan.'" selected="selected">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_kegiatan.'">'.$h->nama_kegiatan."  (".$h->nama_wilayah.")".'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_level($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM role ORDER BY id_role");
		$hasil .= '<option selected="selected" value>Pilih Level</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_role) {
				$hasil .= '<option value="'.$h->id_role.'" selected="selected">'.$h->nama_role.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_role.'">'.$h->nama_role.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_departemen($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_departemen ORDER BY nama_departemen ASC");
		$hasil .= '<option selected="selected" value>Pilih Departemen</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_departemen) {
				$hasil .= '<option value="'.$h->id_departemen.'" selected="selected">'.$h->nama_departemen.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_departemen.'">'.$h->nama_departemen.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_departemen_order_list($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_departemen ORDER BY nama_departemen ASC");
		$hasil .= '<option selected="selected" value>Pilih Departemen</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_departemen) {
				$hasil .= '<option value="'.$h->nama_departemen.'" selected="selected">'.$h->nama_departemen.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_departemen.'">'.$h->nama_departemen.'</option>';
			}
		}
		return $hasil;
	}
function kabupaten($provId=""){
	$qid_wilayah=$this->db->query("SELECT mu.id_wilayah,tp.departemen FROM tk_personal tp JOIN mst_user mu ON tp.id_karyawan=mu.id_karyawan WHERE tp.id_karyawan='$provId'")->row();
	$id_wilayah_=$qid_wilayah->id_wilayah;
	$id_departemen_=$qid_wilayah->departemen;
	$kabupaten .='<option selected="selected" value>Pilih Kegiatan</pilih>';
	$qkegiatan_=$this->db->query("SELECT mk.*,wil.nama_wilayah FROM mst_kegiatan mk JOIN mst_wilayah wil 
								ON mk.id_wilayah=wil.id_wilayah WHERE mk.id_wilayah='$id_wilayah_' AND mk.id_departemen='$id_departemen_'");
	foreach ($qkegiatan_->result_array() as $data ){
		$kabupaten.= "<option value='$data[id_kegiatan]'>$data[nama_kegiatan]  ($data[nama_wilayah])</option>";
	}
	return $kabupaten;
}
function get_plant_group($id="",$idc=""){
	$plant_group="";
	if($this->session->userdata("id_role")==6){
		$plant_group .='<option selected="selected" value>Pilih Shipping Point</pilih>';
		$qshipping_point=$this->db->query("SELECT mst_shipping_point.* FROM mst_shipping_point JOIN mst_user_shipping_point 
										ON mst_shipping_point.description=mst_user_shipping_point.description WHERE id_plant_group='$id'");
		foreach ($qshipping_point->result_array() as $data ){
			$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
		}
	}else{
		$plant_group .='<option selected="selected" value>Pilih Shipping Point</pilih>';
		// $qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point WHERE id_plant_group='$id'");
		// foreach ($qshipping_point->result_array() as $data ){
		// 	$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
		// }
		if($this->session->userdata("id_wilayah")==3020){
			if($id==4){//id plant group susu
				if($this->session->userdata("id_region")==3){
					$qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
					foreach ($qshipping_point->result_array() as $data ){
						$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
					}
				}else{
					$qckmsc = $this->db->query("SELECT count(*) as jml FROM mst_shipping_point_customer WHERE id_customer='$idc'")->row();
					if($qckmsc->jml==0){
						$qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
						foreach ($qshipping_point->result_array() as $data ){
							$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
						}
					}else{
						$qshipping_point=$this->db->query("SELECT sp.id_shipping_point,sp.description 
													FROM mst_customer mc JOIN mst_shipping_point_customer msc ON mc.id_customer=msc.id_customer 
													JOIN mst_shipping_point sp ON sp.id_shipping_point=msc.id_shipping_point WHERE sp.id_plant_group='$id' 
													AND mc.id_customer='$idc'");
						foreach ($qshipping_point->result_array() as $data ){
							$plant_group.= '<option value="'.$data[id_shipping_point].'" selected="selected">'.$data[description].'</option>';
						}
					}
				}
			}else if($id==3){//id plant daging
				// $qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
				// foreach ($qshipping_point->result_array() as $data ){
				// 	$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
				// }
				if($this->session->userdata("id_region")==3){
					$qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
					foreach ($qshipping_point->result_array() as $data ){
						$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
					}
				}else{
					$qckmsc = $this->db->query("SELECT count(*) as jml FROM mst_shipping_point_customer WHERE id_customer='$idc'")->row();
					if($qckmsc->jml==0){
						$qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
						foreach ($qshipping_point->result_array() as $data ){
							$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
						}
					}else{
						$qshipping_point=$this->db->query("SELECT sp.id_shipping_point,sp.description 
													FROM mst_customer mc JOIN mst_shipping_point_customer msc ON mc.id_customer=msc.id_customer 
													JOIN mst_shipping_point sp ON sp.id_shipping_point=msc.id_shipping_point WHERE sp.id_plant_group='$id' 
													AND mc.id_customer='$idc'");
						foreach ($qshipping_point->result_array() as $data ){
							$plant_group.= '<option value="'.$data[id_shipping_point].'" selected="selected">'.$data[description].'</option>';
						}
					}
				}
			}
		}else{
			$qshipping_point=$this->db->query("SELECT * FROM mst_shipping_point");
			foreach ($qshipping_point->result_array() as $data ){
				$plant_group.= "<option value='$data[id_shipping_point]'>$data[description]</option>";
			}
		}
	}
	return $plant_group;
}
function kecamatan($kabId){
	$qid_wilayah=$this->db->query("SELECT id_wilayah FROM mst_kegiatan WHERE id_kegiatan='$kabId'")->row();
	$id_wilayah_=$qid_wilayah->id_wilayah;
	$kecamatan .='<option selected="selected" value>Pilih Kegiatan</pilih>';
	$qcustomer_=$this->db->query("SELECT mc.*,wil.nama_wilayah FROM mst_customer mc JOIN mst_wilayah wil 
								ON mc.id_wilayah=wil.id_wilayah WHERE mc.id_wilayah='$id_wilayah_'");
	foreach ($qcustomer_->result_array() as $data ){
		$kecamatan.= "<option value='$data[id_customer]'>$data[nama_customer]  ($data[nama_wilayah])</option>";
	}
	return $kecamatan;
}
/*
function kelurahan($kecId){
	$kelurahan="<option value='0'>--pilih--</pilih>";
	$this->db->order_by('name','ASC');
	$kel= $this->db->get_where('villages',array('district_id'=>$kecId));
	foreach ($kel->result_array() as $data ){
		$kelurahan.= "<option value='$data[id]'>$data[name]</option>";
	}
	return $kelurahan;
}
*/
	public function get_combo_product_rpt($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product");
		$hasil .= '<option selected="selected" value="">[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->nama_product) {
				$hasil .= '<option value="'.$h->nama_product.'" selected="selected">'.$h->nama_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->nama_product.'">'.$h->nama_product.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_product_rptJual($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_product");
		$hasil .= '<option selected="selected" value>[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_product) {
				$hasil .= '<option value="'.$h->id_product.'" selected="selected">'.$h->nama_product.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_product.'">'.$h->nama_product.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_group_customer($id="") {
		$hasil = "";
		$q = $this->db->query("SELECT * FROM mst_group_customer");
		$hasil .= '<option selected="selected" value>Pilih Group</option>';
		foreach($q->result() as $h) {
			if($id == $h->id_group_customer) {
				$hasil .= '<option value="'.$h->id_group_customer.'" selected="selected">'.$h->nama_group_customer.'</option>';
			} else {
				$hasil .= '<option value="'.$h->id_group_customer.'">'.$h->nama_group_customer.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_batch($id="",$id_gudang) {
		$hasil = "";
		$q = $this->db->query("SELECT transfer_detail.batch FROM transfer_detail LEFT JOIN transfer_master ON transfer_master.id_transfermaster = transfer_detail.id_transfermaster WHERE transfer_master.id_gudang='$id_gudang' GROUP BY transfer_detail.batch ORDER BY transfer_detail.batch DESC");
		$hasil .= '<option selected="selected" value="">[SEMUA]</option>';
		foreach($q->result() as $h) {
			if($id == $h->batch) {
				$hasil .= '<option value="'.$h->batch.'" selected="selected">'.$h->batch.'</option>';
			} else {
				$hasil .= '<option value="'.$h->batch.'">'.$h->batch.'</option>';
			}
		}
		return $hasil;
	}
	public function get_combo_batch_jual($id="",$id_gudang) {
		$hasil = "";
		$q = $this->db->query("SELECT transfer_detail.batch FROM transfer_detail LEFT JOIN transfer_master ON transfer_master.id_transfermaster = transfer_detail.id_transfermaster WHERE transfer_master.id_gudang='$id_gudang' GROUP BY transfer_detail.batch ORDER BY transfer_detail.batch DESC");
		$hasil .= '<option selected="selected" value="">Pilih Batch</option>';
		foreach($q->result() as $h) {
			if($id == $h->batch) {
				$hasil .= '<option value="'.$h->batch.'" selected="selected">'.$h->batch.'</option>';
			} else {
				$hasil .= '<option value="'.$h->batch.'">'.$h->batch.'</option>';
			}
		}
		return $hasil;
	}
}