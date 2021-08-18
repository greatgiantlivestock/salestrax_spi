<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekap_salesman extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') <=2) {
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah();
			$d['combo_karyawan'] = $this->App_model->get_combo_user_rekap_sales();
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
			$d['color'] = '';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';

		}else if($this->session->userdata('id_role') ==3 || $this->session->userdata('id_role') ==4){
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_karyawan'] = $this->App_model->get_combo_user_rekap_sales();
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
			$d['color'] = '';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';

		}else if($this->session->userdata('id_role') ==5){
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_karyawan'] = $this->App_model->get_combo_user_rekap_sales($this->session->userdata("nama_karyawan"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
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
		$this->load->view('rekap_salesman/rekap_salesman_table');
		$this->load->view('bottom');
	}

	public function get_map() {
		$id_rencana_detail = $this->input->post("id_rencana_detail");
		$qrealisasi = $this->db->query("SELECT lats,longs FROM trx_checkout ckout JOIN trx_checkin ckin ON ckout.id_checkin=ckin.id_checkin
										JOIN trx_rencana_master trm ON trm.id_rencana_header = ckin.id_rencana_header WHERE id_rencana_detail='$id_rencana_detail'")->row();
		$lat = $qrealisasi->lats;
		$lng = $qrealisasi->longs;
		
		echo '<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
		src="https://maps.google.com/maps?q='.$lat.','.$lng.'&hl=es;z=16&amp;output=embed"></iframe>';
	}

	function ambil_data(){
		$modul=$this->input->post('modul');
		$nama_wilayah=$this->input->post('nama_wilayah');
		if($modul=="get_karyawan"){
			echo $this->App_model->get_karyawan_($nama_wilayah);
		}
	}

	public function get_row($id) {
		// $row = $this->db->query("SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,foto_spg,keterangan_spg,
		// 					foto_chiller,suhu,foto_display, keterangan_display,foto_kompetitor,	md_kompetitor.keterangan AS keterangan_kompetitor
		// 					FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
		// 					JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user JOIN mst_customer mc ON mc.id_customer = trd.id_customer
		// 					JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
		// 					LEFT JOIN md_aktifitas_spg spg ON trd.id_rencana_detail=spg.id_rencana_detail LEFT JOIN md_chiller 
		// 					ON trd.id_rencana_detail=md_chiller.id_rencana_detail LEFT JOIN md_display ON trd.id_rencana_detail=md_display.id_rencana_detail 
		// 					LEFT JOIN md_kompetitor ON trd.id_rencana_detail=md_kompetitor.id_rencana_detail 
		// 					WHERE trm.id_rencana_header='$id'");
		$row = $this->db->query("SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,foto_spg,keterangan_spg,
								foto_chiller,suhu,foto_display, keterangan_display,foto_kompetitor,md_kompetitor.keterangan AS keterangan_kompetitor
								FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
								JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user 
								JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
								JOIN mst_customer mc ON mc.kode_customer = ckin.kode_customer
								LEFT JOIN md_aktifitas_spg spg ON trd.id_rencana_detail=spg.id_rencana_detail LEFT JOIN md_chiller 
								ON trd.id_rencana_detail=md_chiller.id_rencana_detail LEFT JOIN md_display ON trd.id_rencana_detail=md_display.id_rencana_detail 
								LEFT JOIN md_kompetitor ON trd.id_rencana_detail=md_kompetitor.id_rencana_detail 
								WHERE trm.id_rencana_header='$id'
								union
								SELECT trm.*,nama_karyawan,nama_customer,trd.id_customer,status_rencana,active,ckin.*,tanggal_checkout,null as foto_spg,null as keterangan_spg,
								null as foto_chiller,null as suhu,null as foto_display,null as  keterangan_display,null as foto_kompetitor,null as keterangan_kompetitor
								FROM trx_rencana_master trm JOIN trx_rencana_detail trd ON trm.id_rencana_header = trd.id_rencana_header
								JOIN mst_user mu ON trm.id_user_input_rencana=mu.id_user 
								JOIN trx_checkin ckin ON trd.id_rencana_detail=ckin.id_rencana_detail JOIN trx_checkout ckout ON ckin.id_checkin=ckout.id_checkin
								JOIN tmp_customer tmp ON tmp.kode_customer = ckin.kode_customer
								WHERE trm.id_rencana_header='$id'");
		
		$d['detail_visit'] = $row;
		$d['id'] = $id;
		$d['judul'] = "Detail Visit";
		$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();
		
		$this->load->view('rekap_salesman/detail.php',$d);
		$this->load->view('bottom');
	}

	function downloadCheckin($filename = NULL) {
		$this->load->helper('download');
			$data = file_get_contents(base_url('/upload/checkin/'.$filename));
		force_download($filename, $data);
	}
	function downloadProspect($filename = NULL) {
		$this->load->helper('download');
			$data = file_get_contents(base_url('/upload/prospect/'.$filename));
		force_download($filename, $data);
	}
	function downloadDisplay($filename = NULL) {
		$this->load->helper('download');
		$data = file_get_contents(base_url('/upload/display_report/'.$filename));
		force_download($filename, $data);
	}
	function downloadChiller($filename = NULL) {
		$this->load->helper('download');
		$data = file_get_contents(base_url('/upload/chiller_report/'.$filename));
		force_download($filename, $data);
	}
	function downloadKompetitor($filename = NULL) {
		$this->load->helper('download');
		$data = file_get_contents(base_url('/upload/kompetitor_report/'.$filename));
		force_download($filename, $data);
	}
	function downloadSpg($filename = NULL) {
		$this->load->helper('download');
		$data = file_get_contents(base_url('/upload/spg_report/'.$filename));
		force_download($filename, $data);
	}

	public function lihat_report (){
		if($this->session->userdata('id_role') <= 2) {
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "edit";
			$d['tanggal1'] = $this->input->post("mulai_tanggal");
			$d['tanggal2'] = $this->input->post("sampai_tanggal");
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah($this->input->post("nama_wilayah"));
			$d['combo_karyawan'] = $this->App_model->get_combo_user($this->input->post("nama_karyawan"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),$this->input->post("nama_wilayah"),$this->input->post("nama_karyawan"));
			$d['total'] = $this->App_model->get_rekap_salesman_grantot($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),
								  $this->input->post("nama_wilayah"),$this->input->post("nama_karyawan"));
			$d['nama_wilayah'] = $this->input->post("nama_wilayah");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['color'] = 'style="background:#ffffe1;"';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';
		}else if($this->session->userdata('id_role') == 3 || $this->session->userdata('id_role') == 4) {
				
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "edit";
			$d['tanggal1'] = $this->input->post("mulai_tanggal");
			$d['tanggal2'] = $this->input->post("sampai_tanggal");
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah($this->input->post("nama_wilayah"));
			$d['combo_karyawan'] = $this->App_model->get_combo_user_rekap_sales($this->input->post("nama_karyawan"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),$this->input->post("nama_karyawan"));
			$d['total'] = $this->App_model->get_rekap_salesman_grantot($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),$this->input->post("nama_wilayah"),
								  $this->input->post("nama_karyawan"));
			$d['nama_wilayah'] = $this->input->post("nama_wilayah");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['color'] = 'style="background:#ffffe1;"';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';
		}/*else if($this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 4){
			if($this->input->post("nama_wilayah")=="" && $this->input->post("nama_karyawan") != ""){
				$this->session->set_flashdata("error","Mohon pilih wilayah");
				redirect("rekap_salesman");	
			}
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "edit";
			$d['tanggal1'] = $this->input->post("mulai_tanggal");
			$d['tanggal2'] = $this->input->post("sampai_tanggal");
			$d['combo_karyawan'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),
								  $this->input->post("nama_wilayah"),$this->input->post("nama_karyawan"));
			$d['total'] = $this->App_model->get_rekap_salesman_grantot($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),
								  $this->input->post("nama_wilayah"),$this->input->post("nama_karyawan"));
			$d['nama_wilayah'] = $this->input->post("nama_wilayah");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['color'] = 'style="background:#ffffe1;"';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
		}*/else if($this->session->userdata('id_role') == 5){
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "edit";
			$d['tanggal1'] = $this->input->post("mulai_tanggal");
			$d['tanggal2'] = $this->input->post("sampai_tanggal");
			$d['combo_karyawan'] = $this->App_model->get_combo_user_rekap_sales($this->session->userdata("nama_karyawan"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),$this->input->post("nama_karyawan"));
			$d['total'] = $this->App_model->get_rekap_salesman_grantot($this->input->post("mulai_tanggal"),
								  $this->input->post("sampai_tanggal"),
								  $this->input->post("nama_wilayah"),$this->input->post("nama_karyawan"));
			$d['nama_wilayah'] = $this->input->post("nama_wilayah");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['color'] = 'style="background:#ffffe1;"';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$d['btn_detail'] = '<button class="btn btn-xs btn-primary"> Lampiran Gambar</button>';
		}else {
			redirect("login");
		}

		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('rekap_salesman/rekap_salesman_table');
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
