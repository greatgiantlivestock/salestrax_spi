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
			$d['combo_matgr'] = $this->App_model->get_material_group();
			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim($this->input->post("nama_status_kirim"));
			$d['combo_sales_person'] = $this->App_model->get_combo_sales_person();
			$d['combo_cluster'] = $this->App_model->get_combo_cluster_release();
			$d['q_tarik_data'] = $this->App_model->get_release_order_data(
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
			$this->load->view('release_order/order_list_tabel');
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}	
	}
	public function lihat_report() { 
		if($this->session->userdata('id_role') < 5) {
			$d['judul'] = "Release  Order";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['kode_shipping_point'] = $this->input->post("kode_shipping_point");
			$d['combo_matgr'] = $this->App_model->get_material_group();
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
			$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Tampilkan Data Release</button>';
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
		$this->load->view('bottom');
	}
	public function get_row1($id) {
        $queryaa = $this->db->query("SELECT dr.id_request,id_detail_request,dr.id_product,keterangan,nama_customer,nama_product,qty,mp.satuan as nama_satuan FROM trx_so_detail dr JOIN trx_so_header rs 
                            ON rs.id_request=dr.id_request JOIN mst_product mp ON mp.id_product=dr.id_product
							JOIN mst_customer mc ON mc.id_customer=rs.id_customer_ship WHERE dr.id_request='$id' and dr.delete_id=0");
		$qcust = $this->db->query("SELECT division FROM trx_so_detail trd JOIN mst_product mp ON trd.id_product=mp.id_product WHERE id_request='$id'")->row();
		$d['data_query'] = $queryaa;
		$d['judul'] = "Detail Product";
		$d['id_request'] = $id;
		$id_product = $qcust->division;
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
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {
			$required = array('tanggal_shipping','tipe','id_shipping_point','id_request','cluster_id','kode_customer');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			
			if($tipe == 'edit') {
				if($error){
					$this->session->set_flashdata("error_update","Inputkan kolom dengan lengkap");
					if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
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
						$d['combo_matgr'] = $this->App_model->get_material_group();
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
					}else {
						redirect("login");
					}
				}else{
					$kode_customer = $this->input->post("kode_customer");
					$cluster_id = $this->input->post("cluster_id");
					$qCls = $this->db->query("SELECT cluster_description as nama_cluster FROM mst_cluster WHERE cluster_id='$cluster_id'")->row();
					$in['tanggal_kirim'] = $this->input->post("tanggal_shipping");
					$in2['id_shipping_point'] = $this->input->post("id_shipping_point");
					$in3['cluster_id'] = $cluster_id;
					$in3['kode_customer'] = $kode_customer;
					$in3['nama_cluster'] = $qCls->nama_cluster;
					$qCkCls = $this->db->query("SELECT count(*)as jml FROM mst_customer_cluster WHERE kode_customer='$kode_customer'")->row();
					$where['id_request'] = $this->input->post("id_request");
					$where3['kode_customer'] = $this->input->post("kode_customer");
					if($qCkCls->jml==0){
						$this->db->insert("mst_customer_cluster",$in3);	
					}else{
						$this->db->update("mst_customer_cluster",$in3,$where3);
					}
					$this->db->update("trx_so_header",$in,$where);
					$this->db->update("trx_so_detail",$in2,$where);
					$this->session->set_flashdata("success_update","Data Berhasil Dilengkapi..");
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
						$d['combo_matgr'] = $this->App_model->get_material_group();
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
						$d['combo_matgr'] = $this->App_model->get_material_group();
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
						$d['combo_matgr'] = $this->App_model->get_material_group();
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
						$d['combo_matgr'] = $this->App_model->get_material_group();
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
			$date = date("Ymd_His");
			if($this->input->post("ck_id_detail") != ''){
				foreach($this->input->post("ck_id_detail") as $data_id) {
					$noorder = $data_id;
					$nosstx = 1000000000+(int)$noorder;
					$qdata1=$this->db->query("SELECT id_detail_request,nama_product,qty FROM trx_so_detail dr JOIN mst_product mp ON dr.id_product=mp.id_product WHERE id_request='$noorder' AND delete_id=0 order by urutan ASC");
					foreach($qdata1->result_array() as $rows){
						$data_id_detail = $rows['id_detail_request'];
						$fp = fopen("../interface/To/SO_".$date.".txt","a") or die("Unable to open file!");
						$fp1 = fopen("../interface/To_backup/SO_".$date.".txt","a") or die("Unable to open file!");
						$qRelease=$this->App_model->get_release_order_final($data_id_detail)->row(); 
						$data1 = $nosstx;
						$data2 = $qRelease->kode_trans;
						$data3 = $qRelease->kode_customer;
						$data4 = $qRelease->sales_office;
						$data5 = $qRelease->no_po."                    ";
						$data6 = $qRelease->tanggal_po;
						$data6a = date("Ymd",strtotime($data6));
						$data7 = $qRelease->tanggal_kirim;
						$data7a = date("Ymd",strtotime($data7));
						$data8 = $qRelease->kode_product."               ";
						$data9 = $qRelease->qty;
						$data9a = strpos($data9,'.');
						$data9b = strpos($data9,',');
						if($data9a==''){
							if($data9b==''){
								$data9c = '00000000'.$data9.'00';
							}else{
								$data9c = '00000000'.number_format((float)$data9, 2, '', '');
							}
						}else{
							$data9c = '00000000'.number_format((float)$data9, 2, '', '');
						}
						$data10 = $qRelease->satuan."   ";
						$data11 = $qRelease->kode_shipping_point."    ";
						$data12 = $qRelease->division;
						if($qRelease->order_reason==''){
							$data13 = "   ";
						}else{
							$data13 = $qRelease->order_reason;
						}
						// $data12 = '000'.$qRelease->urutan;
						$dataClus = $qRelease->nama_cluster;
						$content = substr($data1,0,10).$data2.$data3.$data4.substr($data5,0,20).$data6a.$data7a.substr($data8,0,15).substr($data9c,-8).substr($data10,0,3).substr($data11,0,4).$data13.$data12."\n";
						if($data11 != '    ' && $data6a != '19700101' && $data7a != '19700101' && $dataClus != ''){
							fwrite($fp,$content);
							fclose($fp);
							fwrite($fp1,$content);
							fclose($fp1);
							$inRelease['release_id'] = 1;
							$whereRelease['id_detail_request'] = $data_id_detail;
							$this->db->update("trx_so_detail",$inRelease,$whereRelease);

							$this->session->set_flashdata("success_update","Release Data Order Sukses");
						}else{
							fclose($fp);
							fclose($fp1);
							unlink("../interface/To/SO_".$date.".txt");
							unlink("../interface/To_backup/SO_".$date.".txt");
							$this->session->set_flashdata("error_update","Data Order Gagal Dirilis, Pastikan Shipping Point dan Cluster Sudah Ditentukan");
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
	public function save_detail() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5" || $this->session->userdata('id_role') == "6") {
			$required = array('id_request','id_product','qty','tipe');
			$qtyVal= $this->input->post('qty');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_detail_request'] = $this->input->post('id_detail_request');
			$id_detail_request = $this->input->post('id_detail_request');
			if($tipe == "add") {
				if($error) {			
					$this->session->set_flashdata("error","Data detail order belum lengkap");
					redirect("Release_order");
				}else if(preg_match('/^[0-9]+(\\.[0-9]+)?$/', $qtyVal)){
					$whereUp['id_request'] = $this->input->post('id_request');
					$inUp['tanggal_request'] = date('Y-m-d H:i:s');
					$inUp['id_user_rev'] = $this->user->session->userdata("id_user");
					$this->db->update("trx_so_header",$inUp,$whereUp);
					$id_product = $this->input->post('id_product');
					$id_request = $this->input->post('id_request');
					$qsatuan=$this->db->query("SELECT mst_product.matgr,satuan.id_satuan, satuan.nama_satuan FROM satuan JOIN mst_product on satuan.id_satuan=mst_product.id_satuan WHERE id_product='$id_product'")->row();
					$in['id_jenis_transaksi'] 	= 1;
					$in['id_product'] 	= strtoupper($this->input->post('id_product'));
					$in['qty'] 	= $this->input->post('qty');
					$in['satuan'] 	= $qsatuan->nama_satuan;
					$in['id_satuan'] 	= $qsatuan->id_satuan;
					$in['keterangan'] = $this->input->post('keterangan');
					$in['id_request'] 	= $this->input->post('id_request');
					$matgr = $qsatuan->matgr;
					$qshipping_p=$this->db->query("SELECT mspc.id_shipping_point FROM trx_so_header rs JOIN mst_shipping_point_customer mspc ON mspc.id_customer=rs.id_customer_ship WHERE id_request='$id_request' AND mspc.matgr='$matgr'")->row();
					$qspaut = $this->db->query("SELECT sp.id_sales_person FROM trx_so_header rs JOIN mst_customer mc ON rs.id_customer_ship=mc.id_customer JOIN mst_sales_person_division mspd ON mspd.kode_customer=mc.kode_customer JOIN sales_person sp ON sp.pers_numb=mspd.pers_numb WHERE rs.id_request='$id_request' AND mspd.matgr='$matgr'")->row();
					if($qspaut==''){
						$in['id_sales_person'] = 0;
					}else{
						$in['id_sales_person'] = $qspaut->id_sales_person;
					}
					if($qshipping_p==''){
						$in['id_shipping_point'] = 0;
					}else{
						$in['id_shipping_point'] = $qshipping_p->id_shipping_point;
					}
					$this->db->insert("trx_so_detail",$in);					
					$last_id = $this->db->insert_id();
					$qdetReq=$this->db->query("SELECT id_request FROM trx_so_detail WHERE id_detail_request='$last_id'")->row();
					$inShipping['id_request'] = $qdetReq->id_request;
					$inShipping['id_detail_request'] = $last_id;
					$inShipping['id_status_kirim'] = 1;
					$this->db->insert("shipping",$inShipping);
					$this->session->set_flashdata("success_update","Input Request Detail Berhasil");
					redirect("Release_order");
				}else{
					$this->session->set_flashdata("error_update","Input Qty harus berupa angka. Jika Qty terdapat koma maka ganti koma dengan titik (misal 2,5 menjadi 2.5)");
					redirect("Release_order");
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error_update","Data detail order belum lengkap.");
					redirect("Release_order");	
				} else if(preg_match('/^[0-9]+(\\.[0-9]+)?$/', $qtyVal)){
				    $qskrng = $this->db->query("SELECT qty FROM trx_so_detail WHERE id_detail_request='$id_detail_request'")->row();
					$inskrng['qty_old'] = $qskrng->qty;
					$this->db->update("trx_so_detail",$inskrng,$where);
					$whereUp['id_request'] = $this->input->post('id_request');
					$inUp['tanggal_request'] = date('Y-m-d H:i:s');
					$inUp['id_user_rev'] = $this->user->session->userdata("id_user");
					$this->db->update("trx_so_header",$inUp,$whereUp);

					$id_product = $this->input->post('id_product');
					$id_request = $this->input->post('id_request');
					$qsatuan=$this->db->query("SELECT mst_product.matgr,satuan.id_satuan, satuan.nama_satuan FROM satuan 
										JOIN mst_product on satuan.id_satuan=mst_product.id_satuan WHERE id_product='$id_product'")->row();
					$in1['id_jenis_transaksi'] 	= 1;
					$in1['id_product'] 	= strtoupper($this->input->post('id_product'));
					$in1['qty'] 	= $this->input->post('qty');
					$in1['satuan'] 	= $qsatuan->nama_satuan;
					$in1['id_satuan'] 	= $qsatuan->id_satuan;
					$in1['keterangan'] = $this->input->post('keterangan');
					$matgr = $qsatuan->matgr;
					$qshipping_p=$this->db->query("SELECT mspc.id_shipping_point FROM trx_so_header rs JOIN mst_shipping_point_customer mspc ON mspc.id_customer=rs.id_customer_ship WHERE id_request='$id_request' AND mspc.matgr='$matgr'")->row();
					$qspaut = $this->db->query("SELECT sp.id_sales_person FROM trx_so_header rs JOIN mst_customer mc ON rs.id_customer_ship=mc.id_customer JOIN mst_sales_person_division mspd ON mspd.kode_customer=mc.kode_customer JOIN sales_person sp ON sp.pers_numb=mspd.pers_numb WHERE rs.id_request='$id_request' AND mspd.matgr='$matgr'")->row();
						if($qspaut==''){
							$in1['id_sales_person'] = 0;
						}else{
							$in1['id_sales_person'] = $qspaut->id_sales_person;
						}
						if($qshipping_p==''){
							$in1['id_shipping_point'] = 0;
						}else{
							$in1['id_shipping_point'] = $qshipping_p->id_shipping_point;
						}
					$this->db->update("trx_so_detail",$in1,$where);
					$this->session->set_flashdata("success_update","Edit Detail Berhasil");
					redirect("Release_order");		
				}else{
					$this->session->set_flashdata("error_update","Input Qty harus berupa angka. Jika Qty terdapat koma maka ganti koma dengan titik (misal 2,5 menjadi 2.5)");
					redirect("Release_order");
				}			
			} else {
				$this->session->set_flashdata("error_update","Gagal menyimpan");
				redirect("Release_orde");
			}
		} else {
			redirect("login");
		}
	}
	public function hapus_detail($id,$idm) {
		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 && $id != null) {			
			$whereDel['id_detail_request'] = $id;
			$inDel['delete_id'] = 1;
			$inDel['del_user'] = $this->session->userdata("id_user");
			$this->db->update("trx_so_detail",$inDel,$whereDel);
			$this->db->update("shipping",$inDel,$whereDel);
			$this->session->set_flashdata("success_update","Hapus Data Berhasil");
			redirect("Release_order");		
		} else {
			redirect("login");
		}
	}
}
