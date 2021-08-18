<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function index() {
		if($this->session->userdata('id_role') != "") {		
			$bulan = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
				);
			$d['judul'] = "Dashboard";
			$d['date'] = $bulan[date("m")];
			$d['dataCall'] = $this->App_model->getAllShipment();
		//	$d['dataShipment'] = $this->App_model->getAllShipment();
			$this->load->view('top',$d);
			// $this->load->view('menu');
			$this->load->view('dashboard/dashboard');
			// $this->load->view('bottom');
		} else {
			redirect("Login");
		}	
	}
}
