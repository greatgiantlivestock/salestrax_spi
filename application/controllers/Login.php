<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller {



	public function index() {

		if($this->session->userdata('id_role')==0) {

			$this->load->view('login');			

		} else {

			redirect('Dashboard');			

		}	

	}



	public function cobaLogin() {

		$in['username'] = $this->input->post("username");

		$in['password'] = $this->input->post("password");

		$this->App_model->cekLogin($in);

	}



	public function login_member() {

		$in['username'] = $this->input->post("username");

		$in['password'] = $this->input->post("password");

		$in['mac'] = $this->input->post("mac");

		$this->App_model->cekLoginAndroid($in);

	}

	

	public function login_AR() {

		$in['username'] = $this->input->post("username");

		$in['password'] = $this->input->post("password");

		$in['token'] = $this->input->post("token");

		$this->App_model->cekLoginAndroidAR($in);

	}
	
	
	public function ceksvr() {
		$in = $this->input->post("token");
		$this->App_model->ceksvr1($in);

	}
	
	
	public function logout() {
		$in = $this->input->post("token");
		$this->App_model->setLogoutAR($in);
	}




	public function login_member1() {

		$in['username'] = $this->input->post("username");

		$in['password'] = $this->input->post("password");

		$in['mac'] = $this->input->post("mac");

		$this->App_model->cekLoginAndroid1($in);

	}

}

