<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Release_order extends CI_Controller {
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
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['q_tarik_data'] = $this->App_model->get_release_order_data(
									$this->input->post("tanggal_mulai"),
									$this->input->post("tanggal_sampai"),
									$this->input->post("kode_shipping_point"),
									$this->input->post("nama_status_kirim"),
									$this->input->post("nama_departemen"));
			$d['color'] = '';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('release_order/order_list_tabel');
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
		$d['data_query'] = $queryaa;
		$d['judul'] = "Detail Product";
		$d['combo_product'] = $this->App_model->get_combo_product_dairy();
		
		$this->load->view('release_order/detail_product.php',$d);
	}
	public function get_detail_prd($id) {
        $queryaa = $this->db->query("SELECT nama_customer,nama_product,qty,nama_satuan FROM trx_so_detail dr JOIN trx_so_header rs 
                            ON rs.id_request=dr.id_request JOIN mst_product mp ON mp.id_product=dr.id_product
                            JOIN satuan st ON st.id_satuan=mp.id_satuan
                            JOIN mst_customer mc ON mc.id_customer=rs.id_customer_ship WHERE dr.id_request='$id'");
		$d['data_query'] = $queryaa;
		$d['judul'] = "Detail Product";
		
		$this->load->view('release_order/detail_customer.php',$d);
	}
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {
			$required = array('tanggal_shipping','tipe','id_shipping_point','id_request','pers_numb1');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_request'] = $this->input->post('id_request');
			// $where2['id_detail_request'] = $this->input->post('id_detail_request');
			$in['tanggal_kirim'] 	= $this->input->post('tanggal_shipping');
			$persnumb1 	= $this->input->post('pers_numb1');
			$qpersnm = $this->db->query("SELECT id_sales_person FROM sales_person WHERE pers_numb='$persnumb1'")->row();
			$in2['id_sales_person'] 	= $qpersnm->id_sales_person;
			$in2['id_shipping_point'] 	= $this->input->post('id_shipping_point');
			if($tipe == 'edit') {
				if($error){
					$this->session->set_flashdata("error_update","Inputkan kolom dengan lengkap");
					if($this->session->userdata('id_role') <= 2) {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['nama_departemen'] = $this->input->post("nama_departemen");
						$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));
						$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '5') {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '6') {
						$id_user = $this->session->userdata("id_user");
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name_only($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else {
						redirect("login");
					}
				}else{
					$this->db->update("trx_so_header",$in,$where);
					$this->db->update("trx_so_detail",$in2,$where);
					$this->session->set_flashdata("success_update","Shipment Status Updated");
					if($this->session->userdata('id_role') <= 2) {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['nama_departemen'] = $this->input->post("nama_departemen");
						$d['combo_user'] = $this->App_model->get_combo_user_order_list($this->input->post("nama_karyawan"));
						$d['combo_departemen'] = $this->App_model->get_combo_departemen_order_list($this->input->post("nama_departemen"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '5') {
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['nama_karyawan'] = $this->input->post("nama_karyawan");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),
												$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"),
												$this->input->post("nama_departemen"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else if($this->session->userdata('id_role') == '6') {
						$id_user = $this->session->userdata("id_user");
						$d['judul'] = "Release  Order";
						$d['tipe'] = "edit";
						$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
						$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
						$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
						$d['nama_status_kirim'] = $this->input->post("nama_status_kirim");
						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_name_only($this->input->post("kode_shipping_point"));
						$d['combo_shipping_point_id'] = $this->App_model->get_combo_shipping_point_id();
						$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
						$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
						$d['q_tarik_data'] = $this->App_model->get_release_order_data(
												$this->input->post("tanggal_mulai"),
												$this->input->post("tanggal_sampai"),$this->input->post("kode_shipping_point"),
												$this->input->post("nama_status_kirim"));
						$d['color'] = 'style="background:#ffffe1;"';
						$d['disable'] = '';
						$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
						$this->load->view('top',$d);
						$this->load->view('menu');
						$this->load->view('release_order/order_list_tabel');
						$this->load->view('bottom');
					}else {
						redirect("login");
					}
				}		
			} else {
				redirect("error");
			}
		} else {
			redirect("login");
		}
	}
    public function release() {
		if($this->session->userdata('id_role') <= 4) {
			$date = date("Ymd");
			if($this->input->post("ck_id_detail") != ''){
				foreach($this->input->post("ck_id_detail") as $data_id) {
					// $this->db->update("trx_so_detail",array('release_id' => '1'),array('id_detail_request' => $data_id));
					$noorder = $data_id;
					$qdata1=$this->db->query("SELECT id_detail_request FROM trx_so_detail WHERE id_request='$data_id'");
					foreach($qdata1->result_array() as $rows){
						$data_id_detail = $rows['id_detail_request'];
						$fp = fopen("../interface/To/PO_".$noorder."_".$date.".txt","a") or die("Unable to open file!");
						$qRelease=$this->App_model->get_release_order_final($data_id_detail)->row(); 
						$data1 = $qRelease->id_request."                              ";
						$data2 = $qRelease->division;
						$data3 = $qRelease->kode_ship;
						$data4 = $qRelease->no_po."                                        ";
						$data5 = $qRelease->tanggal_kirim;
						$data6 = $qRelease->pers_numb;
						$data7 = $qRelease->kode_product;
						$data8 = $qRelease->mat_group;
						$data9 = $qRelease->qty;
						$data9a = strpos($data9,'.');
						$data9b = strpos($data9,',');
						if($data9a==''){
							if($data9b==''){
								$data9c = '000000000000000'.$data9.'00';
							}else{
								$data9c = '000000000000000'.number_format((float)$data9, 2, '', '');
							}
						}else{
							$data9c = '000000000000000'.number_format((float)$data9, 2, '', '');
						}
						$data10 = $qRelease->satuan."   ";
						$data11 = $qRelease->kode_shipping_point."     ";
						$content = substr($data1,0,10).substr($data4,0,20).date("Ymd",strtotime($data5)).$data8.$data3.$data6.$data2.substr($data11,0,4).$data7.substr($data10,0,3).substr($data9c,-15)."\n";
						if($data6 != '00000000' || $data11 != '         '){
							fwrite($fp,$content);
							fclose($fp);
							$inRelease['release_id'] = 1;
							$whereRelease['id_detail_request'] = $data_id_detail;
							$this->db->update("trx_so_detail",$inRelease,$whereRelease);
							$this->session->set_flashdata("success_update","Release Sukses");
						}else{
							fclose($fp);
							unlink("../interface/To/PO_".$noorder."_".$date.".txt");
							$this->session->set_flashdata("error_update","Sebagian Data Order Gagal Dirilis, Pastikan Shipping Point dan Sales Person Sudah Ditentukan");
						}
					}
				}
				redirect("Release_order");	
			}else{
				$this->session->set_flashdata("error_update","Belum ada data yang dipilih, silahkan pilih data release terlebih dahulu");
				redirect("Release_order");
			}	
		} else {
			redirect("login");
		}
	}
}
