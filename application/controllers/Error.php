<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index() {
		if($this->session->userdata('id_role') != '') {		
			$d['judul'] = "404 Not Found";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('404');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}


}
