<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	
	public function penjualan() {
		if($this->session->userdata('hak_akses') != "") {		
			$d['judul'] = "Report Penjualan";
			//$id_gudang = $this->session->userdata("id_gudang");
			//$d['combo_product'] = $this->App_model->get_combo_product_rpt();
			//$d['combo_batch'] = $this->App_model->get_combo_batch($id="",$id_gudang);
			$d['penjualan'] = "";
			$d['tgl_awal'] = "";
			$d['checkeda'] = '';
			$d['checkedb'] = '';
			$d['checkedx'] = '';
			$d['checkedz'] = '';
			$d['tgl_akhir'] = "";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report/report_penjualan');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}


	public function lihat_penjualan() {

		$tgl_awal 	= $this->input->post("tgl_awal");
		$tgl_akhir 	= $this->input->post("tgl_akhir");
		$product 	= $this->input->post("product");
		$batch 		= $this->input->post("batch");
		//$opsi		= $this->input->post("opsi");
		//$status		= $this->input->post("status");

		$id_gudang = $this->session->userdata("id_gudang");
		
		$d['judul'] = "Report Penjualan";
		$id_gudang = $this->session->userdata("id_gudang");
		$d['combo_product'] = $this->App_model->get_combo_product_rpt($product);
		$d['combo_batch'] = $this->App_model->get_combo_batch($batch,$id_gudang);
		$d['tgl_awal'] = $tgl_awal;
		$d['tgl_akhir'] = $tgl_akhir;

		if($this->input->post("opsi") == 'promosi') {
			$opsi = '2';
			$opsi2 = '00';
			$d['checkedz'] = 'checked';
			$d['checkedx'] = '';
		}else if($this->input->post("opsi") == 'penjualan') {
			$opsi = '0';
			$opsi2 = '1';
			$d['checkedx'] = 'checked';
			$d['checkedz'] = '';
		}else {
			$opsi = '';
			$opsi2 = '00';
			$d['checked'] = '';
			$d['checkedx'] = '';
			$d['checkedz'] = '';
		}


		if($this->input->post("status_bayar") == 'lunas') {
			$status = '1';
			$d['checkeda'] = 'checked';			
			$d['checkedb'] = '';
		}else if($this->input->post("status_bayar") == 'blunas') {
			$status = '0';
			$d['checkedb'] = 'checked';
			$d['checkeda'] = '';
		}else {
			$status = '';
			$d['checkeda'] = '';
			$d['checkedb'] = '';
		}

		$d['penjualan'] = $this->App_model->get_report_penjualan($id_gudang,$tgl_awal,$tgl_akhir,$product,$opsi,$opsi2,$status,$batch);

		$d['id_gudang'] = $this->session->userdata("id_gudang");


		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('report/report_penjualan');
		$this->load->view('bottom');		
	}



	public function stock_hand() {
		if($this->session->userdata('hak_akses') != "") {		
			$d['judul'] = "Report Stock On Hand";
			$id_gudang = $this->session->userdata("id_gudang");
			$d['combo_gudang'] = $this->App_model->get_combo_gudang_rpt();
			$d['combo_product'] = $this->App_model->get_combo_product_rpt();
			$d['combo_batch'] = $this->App_model->get_combo_batch($id="",$id_gudang);
			$d['stock_hand'] = "";
			$d['tanggal'] = "";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report/report_stock_hand');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	public function lihat_stock_hand($tanggal="",$product="",$batch="") {
		if($this->session->userdata('hak_akses') != "") {		
			$d['judul'] = "Report Stock On Hand";
			$id_gudang = $this->session->userdata("id_gudang");
			$d['combo_gudang'] = $this->App_model->get_combo_gudang_rpt(urldecode($id_gudang));
			$d['combo_product'] = $this->App_model->get_combo_product_rpt(urldecode($product));
			$d['combo_batch'] = $this->App_model->get_combo_batch($batch,$id_gudang);
			$d['id_gudang'] = $this->session->userdata("id_gudang");
			if($product == "null") {
				$product = "";
			} if($batch == "null") {
				$batch = "";
			}

			$d['stock_hand'] = $this->App_model->get_report_stock_hand($tanggal,$id_gudang,urldecode($product),$batch);

			$d['tanggal'] = $tanggal;
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report/report_stock_hand');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	public function proses_stock_hand() {
		$gudang = $this->session->userdata("nama_gudang");
		$product = $this->input->post("product");
		$batch = $this->input->post("batch");
		$tanggal = $this->input->post("tanggal");

		if(empty($product)) {
			$product = "null";
		} if(empty($batch )) {
			$batch = "null";
		}

		redirect("report/lihat_stock_hand/".$tanggal."/".$product."/".$batch);
	}

	public function kartu_stock() {
		if($this->session->userdata('hak_akses') != "") {		
			$d['judul'] = "Report Kartu Stock";
			$id_gudang = $this->session->userdata("id_gudang");
			$d['combo_gudang'] = $this->App_model->get_combo_gudang_rpt();
			$d['combo_product'] = $this->App_model->get_combo_product_rpt();
			$d['combo_batch'] = $this->App_model->get_combo_batch($batch="",$id_gudang);
			$d['kartu_stock'] = "";
			$d['tgl_awal'] = "";
			$d['tgl_akhir'] = "";
			$d['kartu_stock_in'] = "";
			$d['kartu_stock_out'] = "";
			$d['id_gudang'] = "";
			$d['product'] = "";
			$d['batch'] = "";
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report/report_kartu_stock');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	public function proses_kartu_stock() {

		$tgl_awal = $this->input->post("tgl_awal");
		$tgl_akhir = $this->input->post("tgl_akhir");
		$product = $this->input->post("product");
		$batch = $this->input->post("batch");

		if(empty($product)) {
			$product = "null";
		} if(empty($batch )) {
			$batch = "null";
		}

		if(empty($tgl_awal) || empty($tgl_akhir)) {
			$this->session->set_flashdata("error","Tanggal Awal & Tanggal Akhir tidak boleh kosong");
			redirect("report/kartu_stock");
		} else {
			redirect("report/lihat_kartu_stock/".$tgl_awal."/".$tgl_akhir."/".$product."/".$batch);
		}
		
	}

	public function lihat_kartu_stock($tgl_awal,$tgl_akhir,$product="",$batch="") {
		if($this->session->userdata('hak_akses') != "") {	
			if($tgl_awal == "" || $tgl_akhir == "") {
				redirect("error");
			} else { 
				$d['judul'] = "Report Kartu Stock";
				$id_gudang = $this->session->userdata("id_gudang");
				$d['combo_product'] = $this->App_model->get_combo_product_rpt(urldecode($product));
				$d['combo_batch'] = $this->App_model->get_combo_batch($batch,$id_gudang);
				$d['tgl_awal'] = $tgl_awal;
				$d['tgl_akhir'] = $tgl_akhir;

				
				$d['id_gudang'] = $this->session->userdata("id_gudang");
				
				if($product == "null") {
					$product = "";
				} if($batch == "null") {
					$batch = "";
				}

				$d['product'] = urldecode($product);
				$d['batch'] = $batch;
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('report/report_kartu_stock');
				$this->load->view('bottom');
			}
		} else {
			redirect("login");
		}	
	}


	

}
