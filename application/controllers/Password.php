<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class password extends CI_Controller {

public function index() {
		if($this->session->userdata('id_role') != "") {
			$d['judul'] = 'Ganti Password';		
			$d['password'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('password/password_input.php');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}

	public function save() {
		if($this->session->userdata('id_role') != "") {
			$required = array('password','password_lama','password_konfirm');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}

			if($error) {
				$this->session->set_flashdata("error","Input kolom dengan lengkap");
				redirect("password");	
			} else {
				$id_user=$this->session->userdata('id_user');
				$qpasslama=$this->db->query("SELECT * FROM mst_user WHERE id_user='$id_user'")->row();

				if($qpasslama->password != md5($this->input->post("password_lama"))){
					$this->session->set_flashdata("error","Password lama anda salah!");
					redirect("password");	
				}else{
					$pass=$this->input->post("password");
					$passconfirm=$this->input->post("password_konfirm");

					if($pass != $passconfirm){
						$this->session->set_flashdata("error","Password baru dan konfirmasi password anda tidak sama");
						redirect("password");
					}else{
						$where['id_user'] 	= $this->session->userdata('id_user');
						$in['password'] = md5($this->input->post("password"));
						$this->db->update("mst_user",$in,$where);
						$this->session->set_flashdata("success","Update Password Berhasil");
						redirect("password");
					}
				}
			}		

		}  else {
			redirect("login");
		}
	}
}
