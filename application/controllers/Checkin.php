<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class checkin extends CI_Controller {



	public function index() {

		$this->load->library('geocoder');



	}

	

	public function add() {

		date_default_timezone_set('Asia/Jakarta');

		$in['tanggal_checkin'] = date('Y-m-d H-i-s');//$this->input->post("tanggal_checkin");

		$in['nomor_checkin'] = $this->input->post("nomor_checkin");

		$in['id_user'] = $this->input->post("id_user");

		$in['id_rencana_detail'] = $this->input->post("id_rencana_detail");

		$in['id_rencana_header'] = $this->input->post("id_rencana_header");

		$in['kode_customer'] = $this->input->post("kode_customer");

		$in['lats'] = $this->input->post("lats");

		$in['longs'] = $this->input->post("longs");

		$in['foto'] = $this->input->post("foto");

		$lats=$this->input->post('lats');

		$longs=$this->input->post('longs');

		$id_user=$this->input->post('id_user');

		$address= $this->App_model->getaddress($lats,$longs);

		if($address!=0){

			echo $address;

		}else{

			echo "Belum ada alamat";

		}

		$in['jarak'] = 0;


		$in['alamat_gps'] = $address;

		$this->db->insert("trx_checkin",$in);
		
		// $id_rencana_header = $this->input->post("id_rencana_header");
		// $q1 = $this->db->query("SELECT count(*) as jml FROM trx_rencana_detail WHERE lock='0' AND id_rencana_header='$id_rencana_header'")->row();
		// if($q1->jml != 0){
		// 	$where1['id_rencana_header'] = $this->input->post("id_rencana_header");	
		// 	$in1['lock'] 	= "1";
		// 	$this->db->update("trx_rencana_detail",$in1,$where1);
		// }	

		$where_['id_rencana_detail'] = $this->input->post("id_rencana_detail");

		$upd['status_rencana'] = 1;

		$this->db->update("trx_rencana_detail",$upd,$where_);

	}

	

	public function add1() {

		date_default_timezone_set('Asia/Jakarta');

		$in['tanggal_checkin'] = date('Y-m-d H-i-s');//$this->input->post("tanggal_checkin");

		$in['nomor_checkin'] = $this->input->post("nomor_checkin");

		$in['id_user'] = $this->input->post("id_user");

		$in['id_rencana_detail'] = $this->input->post("id_rencana_detail");

		$in['id_rencana_header'] = $this->input->post("id_rencana_header");

		$in['kode_customer'] = $this->input->post("kode_customer");

		$in['lats'] = $this->input->post("lats");

		$in['longs'] = $this->input->post("longs");

		$in['foto'] = $this->input->post("foto");

		$in['prospect'] = 1;

		$lats=$this->input->post('lats');

		$longs=$this->input->post('longs');

		$id_user=$this->input->post('id_user');

		$address= $this->App_model->getaddress($lats,$longs);

		if($address!=0){

			echo $address;

		}else{

			echo "Belum ada alamat";

		}



		$in['jarak'] = 0;



		$in['alamat_gps'] = $address;

		$this->db->insert("trx_checkin",$in);



		$id = $this->input->post("id_rencana_detail");

		$where['id_rencana_detail'] = $id;

		$upd['status_rencana'] = "1";

		$this->db->update("trx_rencana_detail",$upd,$where);

	}

	

	public function updateStock() {

		date_default_timezone_set('Asia/Jakarta');

		$in['date_insert'] = date('Y-m-d H:i:s');

		$in['date_from'] = $this->input->post("date_from");

		$in['date_to'] = $this->input->post("date_to");

		$in['id_product'] = $this->input->post("id_product");

		$in['batch'] = $this->input->post("batch");

		$in['id_rencana_detail'] = $this->input->post("id_rencana_detail");

		$in['qty'] = $this->input->post("jumlah_order");



		$this->db->insert("penjualan",$in);



		$id_rencana_detail = $this->input->post("id_rencana_detail");

		$id_product = $this->input->post("id_product");

		$qty1 = $this->input->post("jumlah_order");



		$data_penjualan = $this->App_model->get_stock_availabel($id_rencana_detail,$id_product);
		$qcount = $this->App_model->get_count_stock_availabel($id_rencana_detail,$id_product);
		
		$qid_cst = $this->db->query("SELECT id_customer FROM trx_rencana_detail WHERE id_rencana_detail='$id_rencana_detail'")->row();

		$in1['tanggal_update'] = date('Y-m-d H:i:s');

		$in1['id_customer'] = $qid_cst->id_customer;

		$in1['id_product'] = $this->input->post("id_product");

		if($qcount->jml==0){
			$in1['qty'] = 0-$qty1;
		}else{
			$in1['qty'] = $data_penjualan->qty-$qty1;
		}

		$this->db->insert("stock_customer",$in1);

		$response = array('error' => 'False');

		echo json_encode($response);	

	}



	public function addcustomer_tmp() {

		date_default_timezone_set('Asia/Jakarta');

		$in['kode_customer'] = $this->input->post("kode_customer");

		$in['nama_customer'] = strtoupper($this->input->post("nama_customer"));

		$in['no_hp'] = $this->input->post("no_hp");

		$in['alamat'] = strtoupper($this->input->post("alamat"));

		$in['nama_usaha'] = strtoupper($this->input->post("nama_usaha"));

		$this->db->insert("tmp_customer",$in);

	}

	public function addcheckout() {

		date_default_timezone_set('Asia/Jakarta');

		$nomor_checkin= $this->input->post("nomor_checkin");

		$q1=$this->db->query("SELECT * from trx_checkin WHERE nomor_checkin='$nomor_checkin'")->row();

		$in['tanggal_checkout'] = date('Y-m-d H-i-s');//$this->input->post("tanggal_checkout");

		$in['nomor_checkin'] = $this->input->post("nomor_checkin");

		$in['id_jenis_kendaraan'] = $this->input->post("id_jenis_kendaraan");

		$in['realisasi_kegiatan'] = $this->input->post("realisasi_kegiatan");

		$in['lats'] = $this->input->post("lats");

		$in['longs'] =$this->input->post("longs");

		$in['id_checkin'] = $q1->id_checkin;

		$in['id_user'] = $this->input->post("id_user");

		$lats=$this->input->post('lats');

		$longs=$this->input->post('longs');

		$id_user=$this->input->post('id_user');

		$address= $this->App_model->getaddress($lats,$longs);

		if($address!=0){

			echo $address;

		}else{

			echo "Belum ada alamat";

		}



		// $q_op = $this->db->query("SELECT id_office FROM office_place WHERE id_user='$id_user'")->row();

		

		// if($q_op->id_office == 1){

		// 	$jarak   = $this->App_model->getjarak($this->input->post("lats"),$this->input->post("longs"));

		// }else if($q_op->id_office == 2){

		// 	$jarak   = $this->App_model->getjarak_villa($this->input->post("lats"),$this->input->post("longs"));

		// }



		// if($jarak!=0){

		// 	echo $jarak;

		// 	$in['jarak'] = $jarak;

		// }else{

		// 	echo "0";

			$in['jarak'] = 0;

		// }



		$in['alamat_gps'] = $address;

		$this->db->insert("trx_checkout",$in);



		$id = $q1->id_rencana_detail;

		$where['id_rencana_detail'] = $id;

		$upd['status_rencana'] = "2";

		$this->db->update("trx_rencana_detail",$upd,$where);

	}



	public function update_generate() {

		$q12 = $this->db->query("SELECT * FROM mst_absen WHERE lokasi LIKE '%Alamat tidak terdeteksi%' OR lokasi ='0'");	

							

		if($this->session->userdata('hak_akses') == "admin") {

			foreach($q12->result_array() as $data_karyawan){

				$id_absen['id_absen']= $data_karyawan['id_absen'];

				$lokasi['lokasi']= $this->App_model->getaddress($data_karyawan['lat'],$data_karyawan['lng']);

				$this->db->update("mst_absen", $lokasi, $id_absen);			

			}

			redirect("absen/generate_location");

		}else {

			redirect("login");

		}

	}

}