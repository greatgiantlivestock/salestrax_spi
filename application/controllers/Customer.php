<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
	public function index($id="") {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$d['judul'] = "Master Customer";			
			if($id != "") { 
				$d['id_customer'] = $id;
				$d['id_customer_ship'] = '$id';
				$d['tipe'] = "add";
				$d['btn_batal'] = '<a class="btn btn-standar" style="margin-left: 40px;" href="'.base_url().'customer">
									<i class="ace-icon fa fa-undo bigger-110"></i>Batal</a>';
				$d['btn_nota'] = '<button class="btn btn-success"><i class="ace-icon fa fa-check bigger-110"></i>Simpan</button>';
				$d['btn_delete'] = '<button class="btn btn-danger"><i class="ace-icon fa fa-trash bigger-110"></i>Hapus</button>';
				$d['customer'] = $this->App_model->get_customer();
				$d['disable'] = 'disabled';
				$d['readonly'] = 'readonly';
				$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id();
				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();
				$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
				$d['combo_material_group'] = $this->App_model->get_cluster_list();
				$d['btn_name'] = "Master Customer";
			} else {
				$d['tipe'] = "add";
				$d['color'] = "";
				$d['btn_batal'] = '<a class="btn btn-standar" style="margin-left: 40px;" href="'.base_url().'customer">
									<i class="ace-icon fa fa-undo bigger-110"></i>Batal</a>';
				$d['btn_nota'] = '<button class="btn btn-success"><i class="ace-icon fa fa-check bigger-110"></i>Simpan</button>';
				$d['btn_delete'] = '<button class="btn btn-danger"><i class="ace-icon fa fa-trash bigger-110"></i>Hapus</button>';
				$d['nomor_rencana'] = '';
				$d['kode_customer'] = '';
				$d['nama_customer'] = '';
				$d['alamat_customer'] = '';
				$d['no_hp'] = '';
				$d['id_customer_ship'] = '';
				$d['customer'] = $this->App_model->get_customer();
				$d['disable'] = 'disabled';
				$d['readonly'] = 'readonly';
				$d['id_customer'] = '';
				$d['nama_usaha'] = '';
				$d['lats'] = '';
				$d['longs'] = '';
				$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id();
				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();
				$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
				$d['combo_material_group'] = $this->App_model->get_cluster_list();
				$d['btn_name'] = "Tambah Kegiatan";
				$d['btn_batal_edit'] = '';
			}
			$this->load->view('top',$d);
			$this->load->view('customer/customer_table');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}
	public function get_row($id) {
		$row = $this->db->query("SELECT id_shipping_point_customer,description,matdesc,nama_customer FROM mst_shipping_point_customer mspc
								JOIN mst_customer mc ON mspc.id_customer=mc.id_customer WHERE mc.kode_customer='$id'"); // get the row by querying from your database & further process
		$d['shipping_point'] = $row;
		$d['judul'] = "Detail Shipping Point";
		$this->load->view('customer/detail_customer.php',$d);
	}
	public function get_row1($id) {
		$row = $this->db->query("SELECT id_sales_division,sales_pers,matdesc,nama_customer FROM mst_sales_person_division mspc
								JOIN mst_customer mc ON mspc.kode_customer=mc.kode_customer JOIN sales_person sp ON sp.pers_numb=mspc.pers_numb 
								WHERE mc.kode_customer='$id'"); // get the row by querying from your database & further process
		$d['sales_person'] = $row;
		$d['judul'] = "Detail Sales Person";
		$this->load->view('customer/detail_sales.php',$d);
	}
	public function get_cluster($id) {
		$row = $this->db->query("SELECT * FROM mst_customer WHERE id_customer='$id'")->row(); 
		// $d['sales_person'] = $row;
		$d['id_customerCl'] = $row->id_customer;
		$d['kode_customerCl'] = $row->kode_customer;
		$d['nama_customerCl'] = $row->nama_customer;
		$d['cityCl'] = $row->city;
		$d['tipe12'] = "add";
		$d['alamatCl'] = $row->alamat;
		$d['combo_material_group'] = $this->App_model->get_combo_clusterCl($row->region);
		$d['judul'] = "Update Cluster";
		$this->load->view('customer/update_cluster.php',$d);
	}
	public function get_row2($id) {
		$in['kode_customer'] = $id;
		$whereRow['id'] = 2;
		$this->db->update("sess_tmp",$in,$whereRow);
		$d['combo_sales_person'] = $this->App_model->get_combo_sales_person($id,"");
		$d['combo_material_group'] = $this->App_model->get_material_group();
		$this->load->view('customer/detail_sales_input.php',$d);
		$this->load->view('bottom1');
	}
	public function get_row3($id) {
		$in['kode_customer'] = $id;
		$whereRow['id'] = 2;
		$this->db->update("sess_tmp",$in,$whereRow);
		$d['combo_sales_person'] = $this->App_model->get_combo_sales_person($id,"");
		$d['combo_material_group'] = $this->App_model->get_material_group();
		$this->load->view('customer/detail_sales_input.php',$d);
		$this->load->view('bottom1');
	}
	public function hapus_shippig_point($id="") {
		if($this->session->userdata('id_role') == "4") {
			$this->db->delete("mst_shipping_point_customer",array('id_shipping_point_customer' => $id));				
			$this->session->set_flashdata("success","Hapus Data Shipping Point Berhasil");
			redirect("Customer");			
		} else {
			redirect("login");
		}
	}
	public function hapus_sales_person($id="") {
		if($this->session->userdata('id_role') == "4") {
			$this->db->delete("mst_sales_person_division",array('id_sales_division' => $id));				
			$this->session->set_flashdata("success","Hapus Data Sales Person Berhasil");
			redirect("Customer");			
		} else {
			redirect("login");
		}
	}
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_customer','id_shipping_point');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			// $required1 = array('id_shipping_point','matgr');
			// $error1 = false;
			// foreach($required1 as $field1) {
			// 	if(empty($_POST[$field1])) {
			// 		$error1 = true;
			// 	}
			// }
			$tipe = $this->input->post("tipe");	
			$in['kode_customer'] 	= $this->input->post('kode_customer');
			$in['nama_customer'] 	= strtoupper($this->input->post('nama_customer'));
			$in['no_hp'] 	= $this->input->post('no_hp');
			$in['nama_usaha'] 	= strtoupper($this->input->post('nama_usaha'));
			$in['id_wilayah'] = $this->input->post('id_wilayah');
			$in['city'] = strtoupper($this->input->post('city'));
			$in['alamat'] 	= strtoupper($this->input->post('alamat'));
			$in['no_ktp'] 	= $this->input->post('no_ktp');
			$pers_numb1 = $this->input->post('pers_numb1');
			$pers_numb2 = $this->input->post('pers_numb2');
			if($pers_numb1==""){
				$in['pers_numb1'] 	= '00000000';
				$in['sales_pers1'] 	= 'Belum Ada';
			}else{
				$q1 = $this->db->query("SELECT sales_pers FROM sales_person WHERE pers_numb='$pers_numb1'")->row();
				$in['pers_numb1'] 	= $this->input->post('pers_numb1');
				$in['sales_pers1'] 	= $q1->sales_pers;
			}
			// if($pers_numb2==""){
			// 	$in['pers_numb2'] 	= '00000000';
			// 	$in['sales_pers2'] 	= 'Belum Ada';
			// }else{
			// 	$q2 = $this->db->query("SELECT sales_pers FROM sales_person WHERE pers_numb='$pers_numb2'")->row();
			// 	$in['sales_pers2'] 	= $q2->sales_pers;
			// 	$in['pers_numb2'] 	= $this->input->post('pers_numb2');
			// }
			if($tipe == "add") {
				if($error){
					$this->session->set_flashdata("error","Gagal, Anda belum menentukan trx_shipping point..");
					redirect("customer");
				}else{
					$in3['id_customer'] 	= $this->input->post('id_customer');
					$in3['kode_customer'] 	= $this->input->post('kode_customer');
					$in3['id_shipping_point'] 	= $this->input->post('id_shipping_point');
					// $in3['matgr'] 	= $this->input->post('matgr');
					$id_shipping_point 	= $this->input->post('id_shipping_point');
					// $matgr 	= $this->input->post('matgr');
					$qshp = $this->db->query("SELECT description FROM mst_shipping_point WHERE id_shipping_point='$id_shipping_point'")->row();
					// $qmatgr = $this->db->query("SELECT matdesc FROM mst_product WHERE matgr='$matgr' GROUP BY matgr")->row();
					$in3['description'] 	= $qshp->description;
					// $in3['matdesc'] 	= $qmatgr->matdesc;
					$this->db->insert("mst_shipping_point_customer",$in3);
					$this->session->set_flashdata("success","Shipping point berhasil dtambahkan");
					redirect("Customer");
				}
			} else if($tipe = 'edit') {
					$in['id_status_customer'] = $this->input->post('id_status_customer');
					$in['id_shipping_point'] = $this->input->post('id_shipping_point');
					$where['id_customer'] = $this->input->post('id_customer');
					$this->db->update("mst_customer",$in,$where);
					$this->session->set_flashdata("success","Edit customer Berhasil");
					redirect("customer");	
			} else if($tipe = 'hapus'){
				$del['id_status_customer'] = 0;
				$whereDelete['id_customer'] = $this->input->post('id_customer');;
				$this->db->update("mst_customer",$del,$whereDelete);
				$this->session->set_flashdata("success","Hapus Data Customer Berhasil");
				redirect("customer");
			}else {
				redirect("customer");
			}
		} else {
			redirect("login");
		}
	}
	public function edit() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_customer','cluster_id');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			if($error){
				$this->session->set_flashdata("error","Gagal, Data tidak lengkap");
				redirect("Customer");
			}else{
				$cluster_id=$this->input->post('cluster_id');
				$kode_customer=$this->input->post('kode_customer');
				$qC = $this->db->query("SELECT cluster_description FROM mst_cluster WHERE cluster_id='$cluster_id'")->row();
				$in['kode_customer'] 	= $kode_customer;
				$in['nama_cluster'] 	= $qC->cluster_description;
				$in['cluster_id'] 	= $cluster_id;

				$qCC = $this->db->query("SELECT count(*)as jml FROM mst_customer_cluster WHERE kode_customer='$kode_customer'")->row();
				
				if($qCC->jml == 0) {
						$this->db->insert("mst_customer_cluster",$in);
						$this->session->set_flashdata("success","Update Cluster Berhasil");
						redirect("Customer");	
				}else{
					$where['kode_customer'] = $kode_customer;
					$this->db->update("mst_customer_cluster",$in,$where);
					$this->session->set_flashdata("success","Update Cluster Berhasil");
					redirect("Customer");
				}
			}
		} else {
			redirect("login");
		}
	}
	public function save_sales() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_customer','pers_numb','matgr');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");
			if($tipe == "add") {
				if($error){
					$this->session->set_flashdata("error","Gagal, Anda belum menentukan sales person atau material group..");
					redirect("customer");
				}else{
					$insL['kode_customer'] 	= $this->input->post('kode_customer');
					$insL['matgr'] 	= $this->input->post('matgr');
					$insL['pers_numb'] 	= $this->input->post('pers_numb');
					$matgr 	= $this->input->post('matgr');
					$qmatgr = $this->db->query("SELECT matdesc FROM mst_product WHERE matgr='$matgr' GROUP BY matgr")->row();
					$insL['matdesc'] 	= $qmatgr->matdesc;
					$this->db->insert("mst_sales_person_division",$insL);
					$this->session->set_flashdata("success","Sales person berhasil dtambahkan");
					redirect("Customer");
				}
			} else {
				redirect("customer");
			}
		} else {
			redirect("login");
		}
	}
}
