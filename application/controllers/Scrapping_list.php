<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Scrapping_list extends CI_Controller {



	public function index($id="") {

		if($this->session->userdata('id_role') <= 2) {

			if($id != ""){

				$d['judul'] = "History Sales Order";

				$d['tipe'] = "add";

				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

				$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

				$d['id_realisasi'] = $this->input->post("id_realisasi");

				$d['nama_karyawan'] = $this->input->post("nama_karyawan");

				$d['nama_departemen'] = $this->input->post("nama_departemen");

				$d['karyawan'] = $this->input->post();

				$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_user"));

				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

				$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
				$d['combo_realisasi'] = $this->App_model->get_combo_realisasi($this->input->post("id_realisasi"));

				$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

				$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

				$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));

				$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									// $this->input->post("tanggal_mulai"),

									// $this->input->post("tanggal_sampai"),

									$this->input->post("id_shipping_point"),

									$this->input->post("id_realisasi"));

				$d['color'] = '';

				$d['disable'] = '';

				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			}else{

				$d['judul'] = "History Sales Order";

				$d['tipe'] = "add";

				$d['tanggal_mulai'] = "";		

				$d['tanggal_sampai'] = "";

				$d['nama_karyawan'] = "";

				$d['kode_shipping_point'] = "";

				$d['id_realisasi'] = "";

				$d['nama_departemen'] = "";

				$d['karyawan'] = "";

				$d['combo_user'] = $this->App_model->get_combo_user_order_list();

				$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list();

				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name();

				$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

				$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

				$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim();

				$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

				$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data();

				$d['color'] = '';

				$d['disable'] = 'disabled';

				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			}

				

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {

			$d['judul'] = "History Sales Order";

			$d['tipe'] = "add";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['karyawan'] = $this->input->post("nama_karyawan");

			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi($this->input->post("id_realisasi"));

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(


									$this->input->post("id_shipping_point"),

									$this->input->post("id_realisasi"));

			$d['color'] = '';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';



			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '5') {

			$d['judul'] = "History Sales Order";



			$d['tipe'] = "add";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['karyawan'] = $this->input->post("nama_karyawan");

			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									$this->input->post("tanggal_mulai"),

									$this->input->post("tanggal_sampai"),

									$this->input->post("kode_shipping_point"),

									$this->input->post("id_realisasi"),

									$this->input->post("nama_departemen"));

			$d['color'] = '';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '6') {

			$id_user = $this->session->userdata("id_user");

			//$qKodeShipping_point = $this->db->query("SELECT kode_shipping_point FROM mst_shipping_point JOIN mst_user_shipping_point 

			//										ON mst_shipping_point.description = mst_user_shipping_point.description 

			//										WHERE mst_user_shipping_point.id_user='$id_user'")->row();

			//$kode_shipping_point = $qKodeShipping_point->kode_shipping_point;

			$d['judul'] = "History Sales Order";



			$d['tipe'] = "add";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			//$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");	

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['karyawan'] = $this->input->post("nama_karyawan");

			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name_only($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									$this->input->post("tanggal_mulai"),

									$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),

									$this->input->post("id_realisasi"));

			$d['color'] = '';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else {

			redirect("login");

		}	

	}



	function download($filename = NULL) {

		// load download helder

		$this->load->helper('download');

		// read file contents

		$data = file_get_contents(base_url('/upload/'.$filename));

		force_download($filename, $data);

	}



	public function save() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {

			$required = array('id_realisasi','tanggal_realisasi','tipe','id_request');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}

			$tipe = $this->input->post("tipe");	

			$where['id_request'] = $this->input->post('id_request');

			$in['tanggal_realisasi'] 	= $this->input->post('tanggal_realisasi');
			$in['id_realisasi'] 	= $this->input->post('id_realisasi');

			if($tipe == 'edit') {

					$this->db->update("detail_scrapping",$in,$where);

					if($this->session->userdata('id_role') == '4') {

						$id_user = $this->session->userdata("id_user");


						$d['judul'] = "History Sales Order";

						$d['tipe'] = "edit";

						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

						$d['id_realisasi'] = $this->input->post("id_realisasi");

						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name_only($this->input->post("kode_shipping_point"));

						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id($this->input->post("id_shipping_point"));

						$d['combo_realisasi'] = $this->App_model->get_combo_realisasi($this->input->post("id_realisasi"));

						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

						$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

						$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

												$this->input->post("id_shipping_point"),

												$this->input->post("id_realisasi"));

						$d['color'] = 'style="background:#ffffe1;"';

						$d['disable'] = '';

						$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

						

						$this->load->view('top',$d);

						$this->load->view('menu');

						$this->load->view('scrapping_list/scrapping_list_tabel');

						$this->load->view('bottom');

					}else {

						redirect("login");

					}	

			} else {

				redirect("error");

			}

		} else {

			redirect("login");

		}

	}



	public function lihat_report() {

		if($this->session->userdata('id_role') <= 2) {

			$d['judul'] = "History Sales Order";

			$d['tipe'] = "edit";

			// $d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			// $d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['nama_departemen'] = $this->input->post("nama_departemen");

			$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));

			$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									// $this->input->post("tanggal_mulai"),

									// $this->input->post("tanggal_sampai"),

									$this->input->post("kode_shipping_point"),

									$this->input->post("id_realisasi"),

									$this->input->post("nama_departemen"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

				

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');



		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {

			$d['judul'] = "History Sales Order";

			$d['tipe'] = "edit";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id($this->input->post("id_shipping_point"));

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi($this->input->post("id_realisasi"));

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									// $this->input->post("tanggal_mulai"),

									// $this->input->post("tanggal_sampai"),

									$this->input->post("id_shipping_point"),

									$this->input->post("id_realisasi"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '5') {

			$d['judul'] = "History Sales Order";

			$d['tipe'] = "edit";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									$this->input->post("tanggal_mulai"),

									$this->input->post("tanggal_sampai"),

									$this->input->post("kode_shipping_point"),

									$this->input->post("id_realisasi"),

									$this->input->post("nama_departemen"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '6') {

			$id_user = $this->session->userdata("id_user");

			//$qKodeShipping_point = $this->db->query("SELECT kode_shipping_point FROM mst_shipping_point JOIN mst_user_shipping_point 

			//										ON mst_shipping_point.description = mst_user_shipping_point.description 

			//										WHERE mst_user_shipping_point.id_user='$id_user'")->row();

			//$kode_shipping_point = $qKodeShipping_point->kode_shipping_point;



			$d['judul'] = "History Sales Order";

			$d['tipe'] = "edit";

			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		

			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");

			//$d['nama_karyawan'] = $this->input->post("nama_karyawan");

			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");

			$d['id_realisasi'] = $this->input->post("id_realisasi");

			//$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name_only($this->input->post("kode_shipping_point"));

			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();

			$d['combo_realisasi'] = $this->App_model->get_combo_realisasi();

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("id_realisasi"));

			$d['combo_status_kirim_id'] = $this->App_model->get_combo_status_kirim_id();

			$d['q_tarik_data'] = $this->App_model->get_scrapping_list_data(

									$this->input->post("tanggal_mulai"),

									$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),

									$this->input->post("id_realisasi"));

			$d['color'] = 'style="background:#ffffe1;"';

			$d['disable'] = '';

			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';

			

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping_list/scrapping_list_tabel');

			$this->load->view('bottom');

		}else {

			redirect("login");

		}	

	}

}

