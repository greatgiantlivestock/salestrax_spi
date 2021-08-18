<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') <= 2) {
			if($id != ""){
				$d['judul'] = "History Sales Order";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
				$d['nama_karyawan'] = $this->input->post("nama_karyawan");
				$d['karyawan'] = $this->input->post();
				$d['combo_user'] = $this->App_model->get_combo_user_history($this->input->post("nama_karyawan"));
				$d['color'] = '';
				$d['disable'] = '';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}else{
				$d['judul'] = "History Sales Order";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = "";		
				$d['tanggal_sampai'] = "";
				$d['nama_karyawan'] = "";
				$d['karyawan'] = "";
				$d['combo_user'] = $this->App_model->get_combo_user_history();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen_history($this->input->post("nama_karyawan"));
			$d['color'] = '';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			$this->load->view('top',$d);
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "History Sales Order";

			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login_history($this->session->userdata("id_user"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
				
			$this->load->view('top',$d);
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}

	public function lihat_report() {
		if($this->session->userdata('id_role') <= 2) {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_history($this->input->post("nama_karyawan"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
				
			$this->load->view('top',$d);
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen_history($this->input->post("nama_karyawan"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "History Sales Order";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login_history($this->session->userdata("nama"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('history/history_tabel');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}	

	public function cetak($tanggal_mulai="",$tanggal_sampai="",$nama_karyawan="") {
		if($this->session->userdata('id_role') <= 4 || $id != "") {
			$karyawan=str_replace("%20"," ",$nama_karyawan);
			ob_start();
		    $d['tanggal'] = $tanggal_mulai;
		    $d['tanggal1'] = $tanggal_sampai;
			$d['nama_karyawan'] = $karyawan;
		    $d['jual_detail'] = $this->App_model->get_daily_visit($tanggal_mulai,$tanggal_sampai,$karyawan);

			$this->load->view('report/report_daily_visit', $d);
		    $html = ob_get_contents();
		    ob_end_clean();
		        
		    require_once('./asset/html2pdf/html2pdf.class.php');
		    $pdf = new HTML2PDF('P','A4','en');
		    $pdf->WriteHTML($html);
		    $pdf->Output('Data Invoice.pdf', 'F');
		    header("Content-type:application/pdf");
			echo file_get_contents("Data Invoice.pdf"); 
		}else if($this->session->userdata('id_role') == 5 || $id != "") {
			$karyawan=$this->session->userdata('nama');
			ob_start();
		    $d['tanggal'] = $tanggal_mulai;
		    $d['tanggal1'] = $tanggal_sampai;
			$d['nama_karyawan'] = $karyawan;
		    $d['jual_detail'] = $this->App_model->get_daily_visit($tanggal_mulai,$tanggal_sampai,$karyawan);

			$this->load->view('report/report_daily_visit', $d);
		    $html = ob_get_contents();
		    ob_end_clean();
		        
		    require_once('./asset/html2pdf/html2pdf.class.php');
		    $pdf = new HTML2PDF('P','A4','en');
		    $pdf->WriteHTML($html);
		    $pdf->Output('Data Invoice.pdf', 'F');
		    header("Content-type:application/pdf");
			echo file_get_contents("Data Invoice.pdf"); 
		}else {
			redirect("error");
		}
	}
}
