<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
	public function index() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$d['master_product'] = $this->App_model->get_master_product();
			$d['judul'] = 'Master Product';		
			$d['tipe'] = "add";		
			$d['combo_satuan'] = $this->App_model->get_combo_satuan();
			$d['combo_plant_group'] = $this->App_model->get_combo_plant_group();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('product/product_tabel.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_product','nama_product');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_product'] = $this->input->post('id_product');
			$in['tampilkan'] 	= $this->input->post('tampilkan');
			if($tipe == 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Data tidak lengkap");
					redirect("Product");	
				} else {					
					$this->db->update("mst_product",$in,$where);
					$this->session->set_flashdata("success","Edit Master Product Berhasil");
					redirect("Product");
				}		
			} else {
				$this->session->set_flashdata("error","Gagal");
				redirect("Product");
			}
		} else {
			redirect("login");
		}
	}
}
