<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Release_order_check extends CI_Controller {
	public function index($id="") { 
		if($this->session->userdata('id_role') < 5) {
			$d['judul'] = "Release  Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
			$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
			$d['combo_matgr'] = $this->App_model->get_material_group();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_release_order_data_check(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Tampilkan Data Release</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('release_order/order_list_tabel1');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}	
	}
	public function get_row($id) {
        $queryaa = $this->db->query("SELECT kode_customer,pers_numb,dr.id_shipping_point,rs.tanggal_kirim FROM trx_so_detail dr JOIN trx_so_header rs 
                            ON rs.id_request=dr.id_request JOIN sales_person sp ON sp.id_sales_person=dr.id_sales_person 
                            JOIN mst_customer mc ON mc.id_customer=rs.id_customer_ship WHERE dr.id_request='$id' GROUP BY kode_customer")->row();
        
		$in['nilai'] = $queryaa->tanggal_kirim;
		$in['id_request'] = $id;
		$whereRow['id'] = 1;
		$this->db->update("sess_tmp",$in,$whereRow);
		
		$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id($queryaa->id_shipping_point);
		$d['combo_sales_person'] = $this->App_model->get_combo_sales_person($queryaa->kode_customer,$queryaa->pers_numb);
		$d['tanggal_kirim'] = $queryaa->tanggal_kirim;
		$this->load->view('release_order/detail_release.php',$d);
		$this->load->view('bottom1');
	}
	public function get_row1($id) {
        $queryaa = $this->db->query("SELECT dr.id_request,id_detail_request,dr.id_product,keterangan,nama_customer,nama_product,qty,nama_satuan FROM trx_so_detail dr JOIN trx_so_header rs 
                            ON rs.id_request=dr.id_request JOIN mst_product mp ON mp.id_product=dr.id_product
                            JOIN satuan st ON st.id_satuan=mp.id_satuan
							JOIN mst_customer mc ON mc.id_customer=rs.id_customer_ship WHERE dr.id_request='$id'");
		$qcust = $this->db->query("SELECT id_product FROM trx_so_detail WHERE id_request='$id'")->row();
		$d['data_query'] = $queryaa;
		$d['judul'] = "Detail Product";
		$d['id_request'] = $id;
		$id_product = $qcust->id_product;
		$d['combo_product'] = $this->App_model->get_combo_product_matgr($id_product,"");
		
		$this->load->view('release_order/detail_product.php',$d);
		$this->load->view('bottom1');
	}
	public function get_product($id) {
		$mat = $this->db->query("SELECT id_product FROM trx_so_detail WHERE id_request='$id' AND delete_id='0'")->row();
		if($mat==""){
			$id_product="";
		}else{
			$id_product=$mat->id_product;
		}
		$d['combo_product'] = $this->App_model->get_combo_product_matgr($id_product,"");
		$d['id_request'] = $id;
		$this->load->view('release_order/detail_sales.php',$d);
		$this->load->view('bottom1');
	}
	public function get_detail_prd($id) {
        $queryaa = $this->db->query("SELECT nama_customer,nama_product,qty,mp.satuan FROM trx_so_detail dr JOIN trx_so_header rs 
                            ON rs.id_request=dr.id_request JOIN mst_product mp ON mp.id_product=dr.id_product
                            JOIN mst_customer mc ON mc.id_customer=rs.id_customer_ship WHERE dr.id_request='$id' and dr.delete_id=0");
		$d['data_query'] = $queryaa;
		$d['judul'] = "Detail Product";
		
		$this->load->view('release_order/detail_customer.php',$d);
	}
}
