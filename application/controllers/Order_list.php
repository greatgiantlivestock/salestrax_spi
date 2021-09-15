<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_list extends CI_Controller {
	public function index($id="") {
		if($this->session->userdata('id_role') <= 2) {
			if($id != ""){
				$d['judul'] = "History Sales Order";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
				$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
				$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
				$d['nama_karyawan'] = $this->input->post("nama_karyawan");
				$d['nama_departemen'] = $this->input->post("nama_departemen");
				$d['karyawan'] = $this->input->post();
				$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_user"));
				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
				$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
				$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
				$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
				$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
				$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}else{
				$d['judul'] = "History Sales Order";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = "";		
				$d['tanggal_sampai'] = "";
				$d['nama_karyawan'] = "";
				$d['kode_shipping_point'] = "";
				$d['nama_status_kirim'] = "";
				$d['nama_departemen'] = "";
				$d['karyawan'] = "";
				$d['combo_user'] = $this->App_model->get_combo_user_order_list();
				$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list();
				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1();
				$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
				$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim();
				$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
				$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '6') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}
	public function update_row($id) {
		// $row = $this->db->query("SELECT * FROM mst_user_shipping_point WHERE id_user='$id'"); 
		// $d['shipping_point'] = $row;
		// $d['judul'] = "Detail Shipping Point";
		// $d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();		
		// $this->load->view('user/detail.php',$d);
		// $this->load->view('bottom');
		$in['sts'] = 1;
		$whereRow['id_detail_request'] = $id;
		$this->db->update("trx_so_detail",$in,$whereRow);
	}
	public function update_row1($id) {
		// $row = $this->db->query("SELECT * FROM mst_user_shipping_point WHERE id_user='$id'"); 
		// $d['shipping_point'] = $row;
		// $d['judul'] = "Detail Shipping Point";
		// $d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();		
		// $this->load->view('user/detail.php',$d);
		// $this->load->view('bottom');
		$in['sts'] = 0;
		$whereRow['id_detail_request'] = $id;
		$this->db->update("trx_so_detail",$in,$whereRow);
	}
	function download($filename = NULL) {
		// load download helder
		$this->load->helper('download');
		// read file contents
		$data = file_get_contents(base_url('/upload/'.$filename));
		force_download($filename, $data);
	}
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {
			$required = array('tanggal_shipping','tipe','id_shipping_point','id_detail_request');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_request'] = $this->input->post('id_request');
			$idrq = $this->input->post('id_request');
			$qidrq = $this->db->query("SELECT id_customer_ship FROM trx_so_header WHERE id_request='$idrq'")->row();
			$where1['id_customer'] = $qidrq->id_customer_ship;
			$where2['id_detail_request'] = $this->input->post('id_detail_request');
			$in['tanggal_kirim'] 	= $this->input->post('tanggal_shipping');
			$in1['pers_numb1'] 	= $this->input->post('pers_numb1');
			$persnumb1 	= $this->input->post('pers_numb1');
			$qpersnm = $this->db->query("SELECT sales_pers FROM sales_person WHERE pers_numb='$persnumb1'")->row();
			$in1['sales_pers1'] 	= $qpersnm->sales_pers;
			$in2['id_shipping_point'] 	= $this->input->post('id_shipping_point');
			if($tipe == 'edit') {
				if($error){
					$this->session->set_flashdata("error_update","Inputkan kolom dengan lengkap");
					//redirect("Order_list/lihat_report");	
					if($this->session->userdata('id_role') <= 2) {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['nama_departemen'] = $this->input->post("nama_departemen");
						$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));
						$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '5') {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '6') {
						$id_user = $this->session->userdata("id_user");
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1_only($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else {
						redirect("login");
					}
				}else{
					$this->db->update("trx_so_header",$in,$where);
					$this->db->update("mst_customer",$in1,$where1);
					$this->db->update("trx_so_detail",$in2,$where2);
					$this->session->set_flashdata("success_update","Shipment Status Updated");
					//redirect("Order_list/lihat_report");
					if($this->session->userdata('id_role') <= 2) {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['nama_departemen'] = $this->input->post("nama_departemen");
						$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));
						$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '5') {
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '6') {
						$id_user = $this->session->userdata("id_user");
						$d['judul'] = "History Sales Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1_only($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('order_list/order_list_tabel');
						$this->load->view('bottom');
					}else {
						redirect("login");
					}
				}		
			} else {
				redirect("error");
			}
		} else {
			redirect("login");
		}
	}
	public function lihat_report() {
		if($this->session->userdata('id_role') <= 2) {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['nama_departemen'] = $this->input->post("nama_departemen");
			$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));
			$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '6') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name1($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_order_list_data_desc(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('order_list/order_list_tabel');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}
}
