<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_user extends CI_Controller {

	public function index() {
		if($this->session->userdata('hak_akses') == "0" ) {
			$d['master_user'] = $this->App_model->get_master_user();
			$d['judul'] = 'Master user';		
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('master_user/user_tabel');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function add() {
		if($this->session->userdata('hak_akses') == "0" ) {
			$d['judul'] = 'Tambah Master user';
			$d['tipe'] = 'add';	
			$d['id_user'] = '';	
			$d['nama'] = '';
			$d['username'] = '';
			$d['password'] = '';
			$d['combo_gudang'] = $this->App_model->get_combo_gudang();
			$d['tipe_akun'] = '';
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('master_user/user_input');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function edit($id) {
		if($this->session->userdata('hak_akses') == "0" ) {
			$d['judul'] = 'Edit Master user';			
			$d['tipe'] = 'edit';
			$where['id_user'] = $id;
			$get_id = $this->db->get_where("mst_user",$where)->row();	
			$d['id_user'] = $get_id->id_user;
			$d['nama'] = $get_id->nama;
			$d['username'] = $get_id->username;
			$d['password'] = $get_id->password;
			$d['tipe_akun'] = $get_id->hak_akses;
			$d['combo_gudang'] = $this->App_model->get_combo_gudang($get_id->id_gudang);
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('master_user/user_input');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}


	public function save() {
		if($this->session->userdata('hak_akses') == "0" ) {
			$required = array('nama','username','password','id_gudang');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_user'] = $this->input->post('id_user');

			$in['nama'] 	= $this->input->post('nama');
			$in['username'] 	= $this->input->post('username');
			$in['password'] 	= md5($this->input->post('password'));
			$in['id_gudang'] 	= $this->input->post('id_gudang');
			$in['hak_akses'] 	= $this->input->post('tipe_akun');

			if($tipe == "add") {		

				if($error) {
					$this->session->set_flashdata("error","Inputan Nama user Tidak Boleh Kosong");
					redirect("master_user/add");	
				} else {
					$this->db->insert("mst_user",$in);
					$this->session->set_flashdata("success","Input Master user Berhasil");
					redirect("master_user");
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan Nama user tidak boleh kosong");
					redirect("master_user/edit/".$this->input->post('id_user'));	
				} else {
					$this->db->update("mst_user",$in,$where);
					$this->session->set_flashdata("success","Edit Master user Berhasil");
					redirect("master_user");
				}		
			} else {
				redirect("master_user");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('hak_akses') == "0"  && $id != null) {
			$this->db->delete("mst_user",array('id_user' => $id));				
			$this->session->set_flashdata("success","Hapus Master user Berhasil");
			redirect("master_user");			
		} else {
			redirect("login");
		}
	}


}
