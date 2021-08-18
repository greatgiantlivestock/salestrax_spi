<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Shipping_point extends CI_Controller {
	public function index() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$d['master_shipping_point'] = $this->App_model->get_master_shipping_point();
			$d['judul'] = 'Master Shipping Point';		
			$d['tipe'] = "add";		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('shipping_point/shipping_point_tabel.php');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}

	}

	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('kode_shipping_point','description','id_plant_group','alias');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_shipping_point'] = $this->input->post('id_shipping_point');
			$in['kode_shipping_point'] 	= strtoupper($this->input->post('kode_shipping_point'));
			$in['description'] 	= $this->input->post('description');
			$in['id_plant_group'] 	= $this->input->post('id_plant_group');
			$in['alias'] 	= $this->input->post('alias');

			$kode_shipping_point = $this->input->post('kode_shipping_point');
			$description = $this->input->post('description');
			$cek_kode 	= $this->db->query("SELECT kode_shipping_point FROM mst_shipping_point WHERE kode_shipping_point = '$kode_shipping_point'");

			if($tipe == "add") {	
				if($cek_kode->num_rows() > 0) {
					$this->session->set_flashdata("error","Kode Shipping Point sudah digunakan, Silahkan yang lain");
					redirect("Shipping_point");	
				}else if($error) {
					$this->session->set_flashdata("error","Inputan Tidak Boleh Kosong");
					redirect("Shipping_point");	
				} else {
					$this->db->insert("Shipping_point",$in);
					$this->session->set_flashdata("success","Input Shipping point Berhasil");
					redirect("Shipping_point");
				}

			} else if($tipe == 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("Shipping_point");	
				} else {
					$this->db->update("Shipping_point",$in,$where);
					$this->session->set_flashdata("success","Edit Shipping point Berhasil");
					redirect("Shipping_point");
				}		

			} else {
				$this->session->set_flashdata("danger","Gagal");
				redirect("Shipping_point");
			}

		} else {
			redirect("login");
		}

	}

	public function hapus() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$id=$this->input->post('id');
			$this->db->delete("Shipping_point_person",array('id' => $id));			
			$this->session->set_flashdata("success","Hapus Shipping_point Person Berhasil");
			redirect("Shipping_point");			
		} else {
			redirect("login");
		}
	}

}

