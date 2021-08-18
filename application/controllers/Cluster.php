<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cluster extends CI_Controller {
	public function index() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$d['master_cluster'] = $this->App_model->get_cluster();
			$d['master_shipping_point'] = $this->App_model->get_master_shipping_point();
			$d['judul'] = 'Master Product';		
			$d['tipe'] = "add";		
			$d['combo_cluster'] = $this->App_model->get_combo_cluster();
			$d['combo_region'] = $this->App_model->get_combo_region();
			$d['combo_satuan'] = $this->App_model->get_combo_satuan();
			$d['combo_plant_group'] = $this->App_model->get_combo_plant_group();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('cluster/cluster_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	// function set_session($value){
	// 	$this->session->set_userdata('sample_cluster',$value);
	// 	echo 'Session set!';
	// 	echo $this->session->userdata('sample_cluster');
    //     return;
	// }
	public function get_row($id) {
		$row = $this->db->query("SELECT nama_customer,mcc.nama_cluster,mcc.kode_customer FROM mst_customer_cluster mcc JOIN mst_customer mc 
								ON mcc.kode_customer=mc.kode_customer WHERE cluster_id ='$id'");
		$d['cluster_data'] = $row;
		$d['judul'] = "Detail Customer Cluster";
		$this->load->view('cluster/detail_customer.php',$d);
	}
	public function get_row1($id) {
		$row = $this->db->query("SELECT * FROM mst_cluster WHERE cluster_id ='$id'")->row();
		$d['cluster_id'] = $row->cluster_id;
		$d['cluster_desc'] = $row->cluster_description;
		$d['combo_cluster'] = $this->App_model->get_combo_customerCluster($row->region);
		$d['judul'] = "Detail Customer Cluster";
		$this->load->view('cluster/add_customer.php',$d);
	}
	public function save_cluster() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('cluster_description','region');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$in['cluster_description'] 	= strtoupper($this->input->post('cluster_description'));
			$region = $this->input->post('region');
			$in['region'] 	= $region;
			$reg = $this->db->query("SELECT region_desc FROM mst_customer WHERE region='$region'")->row();
			$in['region_desc'] 	= $reg->region_desc;
			if($error) {
					$this->session->set_flashdata("error","Data tidak lengkap");
					redirect("Cluster");	
			}else {
				$this->db->insert("mst_cluster",$in);
				$this->session->set_flashdata("success","Input Master Cluster Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function tambah_customer() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('cluster_description','cluster_id','kode_customer');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$in['nama_cluster'] 	= strtoupper($this->input->post('cluster_description'));
			$in['cluster_id'] 	= $this->input->post('cluster_id');
			$in['kode_customer'] 	= $this->input->post('kode_customer');
			$kode 	= $this->input->post('kode_customer');
			if($error) {
					$this->session->set_flashdata("error","Data inputan tidak lengkap");
					redirect("Cluster");	
			}else {
				$cCek = $this->db->query("SELECT count(*)as jml FROM mst_customer_cluster WHERE kode_customer='$kode'")->row();
				if($cCek->jml=="0"){
					$this->db->insert("mst_customer_cluster",$in);
					$this->session->set_flashdata("success","Data Customer Berhasil Ditambah");
					redirect("Cluster");
				}else{
					$this->session->set_flashdata("error","Customer Sudah Memiliki Cluster");
					redirect("Cluster");
				}
			}
		} else {
			redirect("login");
		}
	}
	public function save_shp() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_shipping_point','description','alias');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$in['kode_shipping_point'] 	= strtoupper($this->input->post('kode_shipping_point'));
			$in['description'] 	= $this->input->post('description');
			$in['alias'] 	= $this->input->post('alias');
			if($error) {
					$this->session->set_flashdata("error","Data tidak lengkap");
					redirect("Cluster");	
			}else {
				$this->db->insert("mst_shipping_point",$in);
				$this->session->set_flashdata("success","Input Master Shipping Point Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function editShp() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('id_shipping_point','kode_shipping_point','description','alias');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['id_shipping_point'] = $this->input->post('id_shipping_point');
			$in['kode_shipping_point'] = $this->input->post('kode_shipping_point');
			$in['description'] = $this->input->post('description');
			$in['alias'] = $this->input->post('alias');
			if($error) {
					$this->session->set_flashdata("error","Ubah Data Gagal");
					redirect("Cluster");	
			}else {
				$this->db->update("mst_shipping_point",$in,$where);
				$this->session->set_flashdata("success","Ubah Data Shipping Point Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function edit_cluster() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('cluster_id','cluster_description','region');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$where['cluster_id'] = $this->input->post('cluster_id');
			$in['cluster_description'] = strtoupper($this->input->post('cluster_description'));
			$region = $this->input->post('region');
			$in['region'] = $region;
			$reg = $this->db->query("SELECT region_desc FROM mst_customer WHERE region='$region'")->row();
			$in['region_desc'] 	= $reg->region_desc;
			if($error) {
					$this->session->set_flashdata("error","Ubah Data Gagal");
					redirect("Cluster");	
			}else {
				$this->db->update("mst_cluster",$in,$where);
				$this->session->set_flashdata("success","Ubah Data Cluster Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function hapusShp() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('id_shipping_point');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$id = $this->input->post('id_shipping_point');
			if($error) {
					$this->session->set_flashdata("error","Gagal Menghapus");
					redirect("Cluster");	
			}else {
				$this->db->delete("mst_shipping_point",array('id_shipping_point' => $id));
				$this->session->set_flashdata("success","Hapus Data Shipping Point Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function hapus_cluster() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('cluster_id');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$id = $this->input->post('cluster_id');
			if($error) {
					$this->session->set_flashdata("error","Gagal Menghapus");
					redirect("Cluster");	
			}else {
				$this->db->delete("mst_cluster",array('cluster_id' => $id));
				$this->session->set_flashdata("success","Hapus Data Cluster Berhasil");
				redirect("Cluster");
			}
		} else {
			redirect("login");
		}
	}
	public function hapus_customer($id="") {
		if($this->session->userdata('id_role') == "4") {
			$this->db->delete("mst_customer_cluster",array('kode_customer' => $id));				
			$this->session->set_flashdata("success","Hapus Data Customer Cluster Berhasil");
			redirect("Cluster");			
		} else {
			redirect("login");
		}
	}
}
