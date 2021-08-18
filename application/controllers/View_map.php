$this->load->library('googlemaps');

$config['center'] = '37.4419, -122.1419';
$config['zoom'] = 'auto';
$this->googlemaps->initialize($config);

$marker = array();
$marker['position'] = '37.429, -122.1519';
$marker['infowindow_content'] = '1 - Hello World!';
$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '37.409, -122.1319';
$marker['draggable'] = TRUE;
$marker['animation'] = 'DROP';
$this->googlemaps->add_marker($marker);

$marker = array();
$marker['position'] = '37.449, -122.1419';
$marker['onclick'] = 'alert("You just clicked me!!")';
$this->googlemaps->add_marker($marker);
$data['map'] = $this->googlemaps->create_map();

$this->load->view('view_file', $data);

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_map extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') <=2) {
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah();
			$d['combo_karyawan'] = $this->App_model->get_combo_user();
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
			$d['color'] = '';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Lihat Report</button>';

		}else if($this->session->userdata('id_role') ==3 || $this->session->userdata('id_role') ==4){
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_karyawan'] = $this->App_model->get_combo_user_per_departemen();
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
			$d['color'] = '';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Lihat Report</button>';

		}else if($this->session->userdata('id_role') ==5){
			$d['judul'] = "Rekap Biaya Pengganti Kegiatan Sales & Delivery";
			$d['tipe'] = "add";
			$d['tanggal1'] = "";
			$d['tanggal2'] = "";
			$d['combo_karyawan'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
			$d['q_rekap_biaya'] = $this->App_model->get_rekap_salesman();
			$d['total'] = $this->App_model->get_rekap_salesman_grantot();
			$d['nama_wilayah'] = "";
			$d['nama_karyawan'] = "";
			$d['color'] = '';
			$d['btn_name'] = "Lihat Report";
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Lihat Report</button>';
		}else {
			redirect("login");
		}
			
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('rekap_salesman/rekap_salesman_table');
		$this->load->view('bottom');
	}
}
