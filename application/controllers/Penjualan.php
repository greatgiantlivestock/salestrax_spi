<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Penjualan extends CI_Controller {



	public function index($id="") {

		if($this->session->userdata('id_role') <=6){

			$d['judul'] = "Penjualan";

			$d['tipe'] = "add";

			$d['tanggal1'] = "";

			$d['tanggal2'] = "";

			$d['combo_customer'] = $this->App_model->get_combo_customer_stock_fisik();

			$d['q_rekap_biaya'] = $this->App_model->get_penjualan_history();

			$d['color'] = '';

			$d['btn_name'] = "Lihat Report";

			$d['disable'] = 'disabled';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';

		}else {

			redirect("login");

		}

			

		$this->load->view('top',$d);

		$this->load->view('menu');

		$this->load->view('penjualan/stock_fisik_table');

		$this->load->view('bottom');

	}



	public function lihat_report (){

		if($this->session->userdata('id_role') <= 4) {

			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";

			$d['tipe'] = "edit";

			$d['tanggal1'] = $this->input->post("mulai_tanggal");

			$d['tanggal2'] = $this->input->post("sampai_tanggal");

			$d['id_customer'] = $this->input->post("id_customer");

			$d['combo_customer'] = $this->App_model->get_combo_customer_stock_fisik($this->input->post("id_customer"));

			$d['q_rekap_biaya'] = $this->App_model->get_penjualan_history($this->input->post("mulai_tanggal"),

								  $this->input->post("sampai_tanggal"),$this->input->post("id_customer"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['btn_name'] = "Lihat Report";

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';

		}else if($this->session->userdata('id_role') == 5||$this->session->userdata('id_role') == 6){

			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";

			$d['tipe'] = "edit";

			$d['tanggal1'] = $this->input->post("mulai_tanggal");

			$d['tanggal2'] = $this->input->post("sampai_tanggal");

			$d['id_customer'] = $this->input->post("id_customer");

			$d['combo_customer'] = $this->App_model->get_combo_customer_stock_fisik($this->input->post("id_customer"));

			$d['q_rekap_biaya'] = $this->App_model->get_penjualan_history($this->input->post("mulai_tanggal"),

								  $this->input->post("sampai_tanggal"),$this->input->post("id_customer"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['btn_name'] = "Lihat Report";

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';

		}



		$this->load->view('top',$d);

		$this->load->view('menu');

		$this->load->view('penjualan/stock_fisik_table');

		$this->load->view('bottom');

	}



	public function cetak($id_rencana_header="") {

		if($this->session->userdata('id_role') <=5 || $id != "") {

			ob_start();



			$d['detail_visit'] = $this->App_model->get_data_print($id_rencana_header);

			

			$this->load->view('report/report_rekap_salesman', $d);

		    $html = ob_get_contents();

		    ob_end_clean();

		        

		    require_once('./asset/html2pdf/html2pdf.class.php');

		    $pdf = new HTML2PDF('L','A4','en');

		    $pdf->WriteHTML($html);

		    $pdf->Output('Data Invoice.pdf', 'F');

		    header("Content-type:application/pdf");

			echo file_get_contents("Data Invoice.pdf"); 

		}

	}

	

	// public function cetak() {

	// 	if($this->session->userdata('id_role') <=5 || $id != "") {

	// 		ob_start();

	// 		$tanggal1 = $this->session->userdata("tanggal_rekap1");

	// 		$tanggal2 = $this->session->userdata("tanggal_rekap2");

	// 		$nama_wilayah = $this->session->userdata("wilayah_rekap");

	// 		$nama = $this->session->userdata("karyawan_rekap");

			

	// 	    $d['mulai_tanggal'] = $this->session->userdata("tanggal_rekap1");

	// 	    $d['sampai_tanggal'] = $this->session->userdata("tanggal_rekap2");

	// 	    $d['nama_karyawan'] = $this->session->userdata("karyawan_rekap");

	// 		$d['nama_wilayah'] = $this->session->userdata("wilayah_rekap");

	// 		if($nama != "" && $nama_wilayah ==""){

	// 			$wilayah = $this->db->query("SELECT nama_wilayah FROM mst_user JOIN mst_wilayah ON mst_user.id_wilayah

	// 			= mst_wilayah.id_wilayah WHERE nama LIKE '$nama'")->row();

	// 			$d['nama_wilayah'] = $wilayah->nama_wilayah;

	// 		}

			

	// 		$d['jual_detail'] = $this->App_model->get_rekap_salesman($tanggal1,$tanggal2,$nama_wilayah,$nama);

	// 		$d['grand_tot'] = $this->App_model->get_rekap_salesman_grantot($tanggal1,$tanggal2,$nama_wilayah,$nama);

			

	// 		$this->load->view('report/report_rekap_salesman', $d);

	// 	    $html = ob_get_contents();

	// 	    ob_end_clean();

		        

	// 	    require_once('./asset/html2pdf/html2pdf.class.php');

	// 	    $pdf = new HTML2PDF('P','A4','en');

	// 	    $pdf->WriteHTML($html);

	// 	    $pdf->Output('Data Invoice.pdf', 'F');

	// 	    header("Content-type:application/pdf");

	// 		echo file_get_contents("Data Invoice.pdf"); 

	// 	}

	// }

}

