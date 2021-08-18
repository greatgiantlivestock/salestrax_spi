<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sales extends CI_Controller {
	public function index() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$d['master_sales'] = $this->App_model->get_master_sales();
			$d['judul'] = 'Master Sales';	
			$d['tipe'] = "add";		
			// $d['combo_satuan'] = $this->App_model->get_combo_satuan();
			$d['combo_plant_group'] = $this->App_model->get_combo_divisi();
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('sales/sales_tabel.php');
			// $this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
			$required = array('pers_numb','kode_customer','id_plant_group');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['pers_numb'] = $this->input->post('pers_numb');
			$where['kode_customer'] = $this->input->post('kode_customer');
			$in['pers_numb'] 	= $this->input->post('pers_numb');
			$in['kode_customer'] 	= $this->input->post('kode_customer');
			$in['id_plant_group'] 	= $this->input->post('id_plant_group');
			$inEdit['id_plant_group'] 	= $this->input->post('id_plant_group');
			$pers_numb = $this->input->post('pers_numb');
			$kode_customer = $this->input->post('kode_customer');
			$cek_kode 	= $this->db->query("SELECT count(id_sales_division) as jml FROM mst_sales_person_division WHERE pers_numb = '$pers_numb' AND kode_customer='$kode_customer'")->row();
			if($tipe == 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Data yang dibutuhkan belum lengkap");
					redirect("sales");	
				} else {
				    if($cek_kode->jml == 0){
				        $this->db->insert("mst_sales_person_division",$in);
    					$this->session->set_flashdata("success","Edit Sales Person Berhasil");
    					redirect("Sales");
				    }else{
				        $this->db->update("mst_sales_person_division",$inEdit,$where);
    					$this->session->set_flashdata("success","Edit Sales Person Berhasil");
    					redirect("Sales");
				    }
				}		
			} else {
				$this->session->set_flashdata("error","Gagal");
				redirect("Sales");
			}
		} else {
			redirect("login");
		}
	}
	// public function get_row($id) {
	// 	$row = $this->db->query("SELECT * FROM mst_plant_group mpg JOIN mst_shipping_point sp ON mpg.id_plant_group=sp.id_plant_group
	// 	 					WHERE mpg.plant_group_name='$id' AND sp.id_shipping_point>0"); // get the row by querying from your database & further process
	// 	$d['shipping_point'] = $row;
	// 	$d['judul'] = "Detail Shipping Point";
	// 	$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();
	// 	$this->load->view('user/detail_sales_person.php',$d);
	// 	$this->load->view('bottom');
	// }
	// public function hapus() {
	// 	if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {
	// 		$id=$this->input->post('id_sales_person');
	// 		$this->db->delete("sales_person",array('id_sales_person' => $id));			
	// 		$this->session->set_flashdata("success","Hapus Sales Person Berhasil");
	// 		redirect("Sales");			
	// 	} else {
	// 		redirect("login");
	// 	}
	// }
}
