<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SO_Dairy extends CI_Controller {
	public function index($id="",$idt="") {
		$this->load->helper('url');
		$this->load->helper('indo_helper');
		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6) {
			$qmsg = $this->db->query("SELECT msg FROM message order by id_msg desc")->row();
			if($qmsg==""){
				$d['msg'] = "";
			}else{
				$d['msg'] = $qmsg->msg;	
			}
			$d['judul'] = "Sales Order";			
			if($id != "") { 
				$d['id_request'] = $id;
				$get_id = $this->db->query("SELECT data1.*,mst_customer.nama_customer AS cst_sold FROM(SELECT ro.*, mc.nama_customer AS cst_ship FROM trx_so_header ro 
											JOIN mst_user mu ON mu.id_user=ro.id_user 
											JOIN mst_customer mc ON mc.id_customer=ro.id_customer_ship) AS data1 
											JOIN mst_customer ON mst_customer.id_customer=data1.id_customer_sold
											WHERE id_request='$id'");
				if($get_id->num_rows() > 0) {
					foreach($get_id->result() as $data) {
						$d['request_detail'] = $this->App_model->get_request_detail($id);
						$d['combo_ship'] = $this->App_model->get_combo_ship_kode($data->id_customer_ship);
						$d['combo_sold'] = $this->App_model->get_combo_sold_kode($data->id_customer_sold);
						$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_order_PO($id);
						$d['combo_order_reason'] = $this->App_model->get_combo_order_reason($data->order_reason);
						$d['id_customer_ship'] = $data->cst_ship;
						$d['id_customer'] = $data->id_customer_ship;
						$d['id_customer_sold'] = $data->cst_sold;
						$d['tanggal_request'] = $data->tanggal_request;
						$d['tanggal_kirim'] = $data->tanggal_kirim;
						$d['tanggal_po'] = $data->tanggal_po;
						// $d['division'] = $data->division;
						$d['kode_trans'] = $data->kode_trans;
						$d['matgr'] = $data->matgr;
						$d['catatan'] = $data->catatan;
						$d['h1'] = $data->h1;
						$d['h2'] = $data->h2;
						$d['h3'] = $data->h3;
						$d['r1'] = $data->r1;
						$d['r2'] = $data->r2;
						$d['r3'] = $data->r3;
						$d['title'] = $data->title;
						$d['no_po'] = $data->no_po;
						$d['no_request'] = $data->no_request;
					} 
					$d['color'] = 'style="background:#ffffe1;"';
					$d['btn_batal'] = '<a class="btn btn-xs btn-default"  href="'.base_url().'SO_Dairy">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span> 
										</a>';
					$d['btn_name'] = "Ubah";
					$d['btn_nota'] = '<button style="border-radius: 25px;background:rgba(0,0,0,0.2);"  class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Ubah Data</button>';
					$d['disable'] = '';
					$d['disable1'] = '';
					$d['tipe'] = 'edit';
					$d['id_product'] = '';
					$d['qty'] = '';
					$d['keterangan'] = '';
					$d['btn_name'] = "Simpan Produk";
					$d['color_edit'] = '';
					$d['btn_batal_edit'] = '';	
					$d['tipe_detail'] = 'add'	;
					// $mat = $this->db->query("SELECT mp.id_product FROM mst_product mp JOIN trx_so_detail dr ON dr.id_product=mp.id_product WHERE id_request='$id' AND delete_id='0'")->row();
					// if($mat==""){
					// 	$id_product="";
					// }else{
					// 	$id_product=$mat->id_product;
					// 	$d['disable1'] = 'disabled';
					// }
					$mat = $this->db->query("SELECT division FROM mst_product mp JOIN trx_so_detail td ON mp.id_product=td.id_product WHERE td.id_request='$id' AND delete_id='0'")->row();
					if($mat->division==""){
						$division=$this->session->userdata('division');
					}else{
						$division=$mat->division;
						$d['disable1'] = 'disabled';
					}
					$d['combo_product'] = $this->App_model->get_combo_product_matgr($division,"");
					$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();
					$d['readonly'] = '';
					$this->load->view('top',$d);
					$this->load->view('menu');
					$this->load->view('so_susu/so_customer_table_create');
					$this->load->view('bottom');
				} else {
					redirect("error");
				}
			} else {
				$d['id_request'] = '';
				$d['request_detail'] = $this->App_model->get_request_detail();
				$d['combo_ship'] = $this->App_model->get_combo_ship_kode();
				$d['combo_sold'] = $this->App_model->get_combo_sold_kode();
				$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_order_PO();
				$d['combo_order_reason'] = $this->App_model->get_combo_order_reason();
				$d['tanggal_request'] = date('Y-m-d H-i-s');
				$d['tanggal_kirim'] = '';
				$d['tanggal_po'] = '';
				// $d['division'] = '';
				$d['kode_trans'] = '';
				$d['matgr'] = '';
				$d['no_hp'] = '';
				$d['catatan'] = '';
				$d['h1'] = '';
				$d['h2'] = '';
				$d['h3'] = '';
				$d['r1'] = '';
				$d['r2'] = '';
				$d['r3'] = '';
				$d['title'] = '';
				$d['no_po'] = '';
				$d['no_request'] = '';
				$d['alamat'] = '';
				$d['id_customer_ship'] = '';
				$d['id_customer'] = '';
				$d['id_customer_sold'] = '';
				$d['tipe'] = "add";
				$d['color'] = "";
				$d['btn_batal'] = '';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary" style="border-radius: 25px;background:rgba(0,0,0,0.2);" ><i class="fa fa-plus"> </i> Tambah Data</button>';
				$d['disable'] = 'disabled';
				$d['disable1'] = '';
				$d['readonly'] = 'readonly';
				$d['id_product'] = '';
				$d['qty'] = '';
				$d['keterangan'] = '';
				$d['color_edit'] = '';
				$d['btn_name'] = "Simpan";
				$d['btn_batal_edit'] = '';
				$d['tipe_detail'] = 'add';

				$d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi();
				$d['combo_product'] = $this->App_model->get_combo_product_matgr("","");
				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();
				$this->load->view('top',$d);
				$this->load->view('menu');
				$this->load->view('so_susu/so_customer_table');
				$this->load->view('bottom');
			}
		} else {
			redirect("login");
		}	
	}
	public function set_session($id) {
		$session['division'] = $id;  
		$this->session->set_userdata($session); 
	}
	public function set_sessionJ($id) {
		$session['kode_trans'] = $id;  
		$this->session->set_userdata($session); 
	}
	public function get_product($id) {
		$mat = $this->db->query("SELECT division FROM mst_product mp JOIN trx_so_detail td ON mp.id_product=td.id_product WHERE td.id_request='$id' AND delete_id='0'")->row();
		if($mat->division==""){
			$division=$this->session->userdata('division');
		}else{
			$division=$mat->division;
		}
		// $division = $this->session->userdata('division');
		$d['combo_product'] = $this->App_model->get_combo_product_matgr($division,"");
		$d['id_request'] = $id;
		$this->load->view('so_susu/detail_sales.php',$d);
		$this->load->view('bottom1');
	}
	function get_autocomplete(){
		if (isset($_POST['term'])) {
		  	$result = $this->App_model->search_blog($_POST['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'	=> $row->nama_customer,
				);
		     	echo json_encode($arr_result);
		   	}
		}else{
			echo "null";
		}
	}
	function ambil_data(){
		$modul=$this->input->post('modul');
		$id_product=$this->input->post('id_product');
		$id_customer=$this->input->post('id_customer');
		$q_plant_group=$this->db->query("SELECT id_plant_group FROM mst_product WHERE id_product='$id_product'")->row();
		$id_plant_group=$q_plant_group->id_plant_group;
		if($modul=="plant_group"){
			echo $this->App_model->get_plant_group($id_plant_group,$id_customer);
		}
		if($modul=="pilih_satuan"){
			$get=$this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan 
									WHERE id_product = '$id_product'")->row();
			$satuan=$get->nama_satuan;
			echo strval($satuan);
		}
	}
	// public function cetak($id) {
	// 	$get_detail = $this->db->query("SELECT trx_rencana_master.tanggal_rencana, process_detail.id_rencana_header, process_detail.id_rencana_detail, process_detail.qty, process_detail.no_box,process_detail.id_product, mst_product.id_product FROM process_detail LEFT JOIN trx_rencana_master ON trx_rencana_master.id_rencana_header = process_detail.id_rencana_header LEFT JOIN mst_product ON mst_product.id_product = process_detail.id_product WHERE process_detail.id_rencana_header = '$id' ORDER BY process_detail.id_rencana_detail DESC");
	// 	$this->load->library('Zend');
	//     $this->zend->load('Zend/Barcode');
	// 	foreach($get_detail->result_array() as $data) {
	// 		$id_product = str_pad($data['id_product'], 3, '0', STR_PAD_LEFT);
	// 		$qty = str_pad($data['qty'], 3, '0', STR_PAD_LEFT);
	// 		$no_box = str_pad($data['no_box'], 3, '0', STR_PAD_LEFT);
	// 		$kode = $data['tanggal_rencana']."-".$no_box."-".$id_product.$qty;
	// 		$file =  Zend_Barcode::draw('code39', 'image', array('text'=>$kode,'font'=>4, array()));
	// 		$store_image = imagepng($file,"./barcode/{$kode}.png");			
	// 		$in['barcode'] = $kode.".png";
	// 		$in['id_rencana_header'] = $id;
	// 		$cek_barcode = $this->db->query("SELECT * FROM tmp_barcode WHERE barcode = '$in[barcode]' AND id_rencana_header='$id'");
	// 		if($cek_barcode->num_rows() <= 0) {
	// 			$this->db->insert("tmp_barcode",$in);
	// 		}
	// 		$this->load->view("barcode/barcode_print");
	// 	}
	// }
	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5" || $this->session->userdata('id_role') == "6") {
			$required = array('tanggal_kirim','id_customer_ship','kode_trans','tanggal_po');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_request'] = $this->input->post('id_request');
			$config['upload_path'] = './upload/';
			$config['allowed_types']= 'gif|jpg|png|jpeg|pdf';
			//$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size'] 	= 100000000;
			$config['max_width'] 	= 400000000;
			$config['max_height'] 	= 350000000;
			// $customerName = $this->input->post("id_customer_ship");
			// $qValID = $this->db->query("SELECT id_customer FROM mst_customer WHERE nama_customer='$customerName'")->row();
			// $customerID = $qValID->id_customer;
			// $dueDate = $this->input->post("tanggal_kirim");
			$this->load->library('upload', $config);		
			if($tipe == "add") {
				// $qValidationDate = $this->db->query("SELECT count(*)as jml_input_req from trx_so_header where id_customer_ship='$customerID' and tanggal_kirim='$dueDate'")->row();
				// if($qValidationDate->jml_input_req==0){		
				if($error) {
					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");
					redirect("SO_Dairy");	
				} else {
					$tanggal_request=date("Y-m-d");
					$tanggal_kirim=$this->input->post('tanggal_kirim');
					$tanggal_po=$this->input->post('tanggal_po');
					$kode_trans=$this->input->post('kode_trans');
					$division=$this->input->post('division');
					if($kode_trans=="ZSML"){
						$order_reason=$this->input->post('order_reason');
						if($order_reason==""){
							$this->session->set_flashdata("error","Belum ada Order Reason yang dipilih..!");
							redirect("SO_Dairy");
						}else{
							if($tanggal_kirim < $tanggal_request){
								$this->session->set_flashdata("error","Anda tidak diperbolehkan menginput orderan untuk tanggal yang telah lalu..!");
								redirect("SO_Dairy");
							}else{
								$id_customer_ship = $this->input->post("id_customer_ship");
								$id_customer_sold = $this->input->post("id_customer_ship");
								$qship = $this->db->query("SELECT id_customer,nama_customer FROM mst_customer WHERE nama_customer='$id_customer_ship'")->row();
								$qsold = $this->db->query("SELECT id_customer,nama_customer FROM mst_customer WHERE nama_customer='$id_customer_sold'")->row();
								if($qship == '' || $qsold ==''){
									$this->session->set_flashdata("error","Nama customer tidak sesuai.. silahkan input kembali..");
									redirect("SO_Dairy");
								}else{
									if($this->upload->do_upload("file_upload")) {
										$data_upload = $this->upload->data();
										$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
																	JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
										if($get_id == null){
											$no_akhir = "SO.000000.000";
										}else{
											$no_akhir = $get_id->no_request;
										}
										$tanggal = "SO.".date("ymd")."."; 
										date_default_timezone_set('Asia/Jakarta');
										$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
										$in['id_user'] 	= $this->session->userdata('id_user');
										$in['tanggal_request'] 	= date('Y-m-d H-i-s');
										$in['id_customer_ship'] 	= $qship->id_customer;
										$in['id_customer_sold'] 	= $qsold->id_customer;
										$in['status_request'] 	= 1;
										$in['tanggal_kirim'] 	= $tanggal_kirim;
										$in['tanggal_po'] 	= $tanggal_po;
										$in['order_reason'] 	= $order_reason;
										// $in['division'] 	= $division;
										$in['kode_trans'] 	= $kode_trans;
										$in['catatan'] 	= strtoupper($this->input->post('catatan'));
										$in['h1'] 	= $this->input->post('h1');
										$in['h2'] 	= $this->input->post('h2');
										$in['h3'] 	= $this->input->post('h3');
										$in['r1'] 	= $this->input->post('r1');
										$in['r2'] 	= $this->input->post('r2');
										$in['r3'] 	= $this->input->post('r3');
										$in['no_po'] 	= strtoupper($this->input->post('no_po'));
										$in['title'] 	= $data_upload['file_name'];
										/*
										$resize['source_image'] = base_url().'upload/'.$data_upload['file_name'];
										$resize['new_image'] = './upload/';
										$resize['file_path'] = './upload/'.'test.jpg';
										$resize['create_thumb'] = false;
										$resize['maintain_ratio'] = true;
										$resize['width'] = 1000;
										$resize['height'] = 800;
										$resize['overwrite'] = TRUE;
										$this->load->library('image_lib', $resize);
										$this->image_lib->resize();
										$this->load->library('upload', $resize);
										$this->users_model->uploadPic($resize['file_path']);
										*/
										$this->db->insert("trx_so_header",$in);
										$last_id = $this->db->insert_id();
										$this->session->set_flashdata("success","Input Request Order Berhasil");
										redirect("SO_Dairy/index/".$last_id);
									} else if(!$this->upload->do_upload("file_upload")) {
										$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
																	JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
										if($get_id == null){
											$no_akhir = "SO.000000.000";
										}else{
											$no_akhir = $get_id->no_request;
										}
										$tanggal = "SO.".date("ymd")."."; 
										$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
										$in['id_user'] 	= $this->session->userdata('id_user');
										$in['tanggal_request'] 	= date('Y-m-d H-i-s');
										$in['id_customer_ship'] 	= $qship->id_customer;
										$in['id_customer_sold'] 	= $qsold->id_customer;
										$in['status_request'] 	= 1;
										$in['tanggal_kirim'] 	= $tanggal_kirim;
										$in['tanggal_po'] 	= $tanggal_po;
										$in['order_reason'] 	= $order_reason;
										// $in['division'] 	= $division;
										$in['kode_trans'] 	= $kode_trans;
										$in['catatan'] 	= strtoupper($this->input->post('catatan'));
										$in['h1'] 	= $this->input->post('h1');
										$in['h2'] 	= $this->input->post('h2');
										$in['h3'] 	= $this->input->post('h3');
										$in['r1'] 	= $this->input->post('r1');
										$in['r2'] 	= $this->input->post('r2');
										$in['r3'] 	= $this->input->post('r3');
										$in['no_po'] 	= strtoupper($this->input->post('no_po'));
										$this->db->insert("trx_so_header",$in);
										$last_id = $this->db->insert_id();
										$this->session->set_flashdata("success","Input Request Order Berhasil");
										redirect("SO_Dairy/index/".$last_id);
									}else{
										$this->session->set_flashdata("error",$this->upload->display_errors());
										redirect("SO_Dairy");
									}	
								}
							}
						}
					}else{
						if($tanggal_kirim < $tanggal_request){
							$this->session->set_flashdata("error","Anda tidak diperbolehkan menginput orderan untuk tanggal yang telah lalu..!");
							redirect("SO_Dairy");
						}else{
							$id_customer_ship = $this->input->post("id_customer_ship");
							$id_customer_sold = $this->input->post("id_customer_ship");
							$qship = $this->db->query("SELECT id_customer,nama_customer FROM mst_customer WHERE nama_customer='$id_customer_ship'")->row();
							$qsold = $this->db->query("SELECT id_customer,nama_customer FROM mst_customer WHERE nama_customer='$id_customer_sold'")->row();
							if($qship == '' || $qsold ==''){
								$this->session->set_flashdata("error","Nama customer tidak sesuai.. silahkan input kembali..");
								redirect("SO_Dairy");
							}else{
								if($this->upload->do_upload("file_upload")) {
									$data_upload = $this->upload->data();
									$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
																JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
									if($get_id == null){
										$no_akhir = "SO.000000.000";
									}else{
										$no_akhir = $get_id->no_request;
									}
									$tanggal = "SO.".date("ymd")."."; 
									date_default_timezone_set('Asia/Jakarta');
									$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
									$in['id_user'] 	= $this->session->userdata('id_user');
									$in['tanggal_request'] 	= date('Y-m-d H-i-s');
									$in['id_customer_ship'] 	= $qship->id_customer;
									$in['id_customer_sold'] 	= $qsold->id_customer;
									$in['status_request'] 	= 1;
									$in['tanggal_kirim'] 	= $tanggal_kirim;
									$in['tanggal_po'] 	= $tanggal_po;
									// $in['division'] 	= $division;
									$in['kode_trans'] 	= $kode_trans;
									$in['catatan'] 	= strtoupper($this->input->post('catatan'));
									$in['h1'] 	= $this->input->post('h1');
									$in['h2'] 	= $this->input->post('h2');
									$in['h3'] 	= $this->input->post('h3');
									$in['r1'] 	= $this->input->post('r1');
									$in['r2'] 	= $this->input->post('r2');
									$in['r3'] 	= $this->input->post('r3');
									$in['no_po'] 	= strtoupper($this->input->post('no_po'));
									$in['title'] 	= $data_upload['file_name'];
									/*
									$resize['source_image'] = base_url().'upload/'.$data_upload['file_name'];
									$resize['new_image'] = './upload/';
									$resize['file_path'] = './upload/'.'test.jpg';
									$resize['create_thumb'] = false;
									$resize['maintain_ratio'] = true;
									$resize['width'] = 1000;
									$resize['height'] = 800;
									$resize['overwrite'] = TRUE;
									$this->load->library('image_lib', $resize);
									$this->image_lib->resize();
									$this->load->library('upload', $resize);
									$this->users_model->uploadPic($resize['file_path']);
									*/
									$this->db->insert("trx_so_header",$in);
									$last_id = $this->db->insert_id();
									$this->session->set_flashdata("success","Input Request Order Berhasil");
									redirect("SO_Dairy/index/".$last_id);
								} else if(!$this->upload->do_upload("file_upload")) {
									$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
																JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
									if($get_id == null){
										$no_akhir = "SO.000000.000";
									}else{
										$no_akhir = $get_id->no_request;
									}
									$tanggal = "SO.".date("ymd")."."; 
									$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
									$in['id_user'] 	= $this->session->userdata('id_user');
									$in['tanggal_request'] 	= date('Y-m-d H-i-s');
									$in['id_customer_ship'] 	= $qship->id_customer;
									$in['id_customer_sold'] 	= $qsold->id_customer;
									$in['status_request'] 	= 1;
									$in['tanggal_kirim'] 	= $tanggal_kirim;
									$in['tanggal_po'] 	= $tanggal_po;
									// $in['division'] 	= $division;
									$in['kode_trans'] 	= $kode_trans;
									$in['catatan'] 	= strtoupper($this->input->post('catatan'));
									$in['h1'] 	= $this->input->post('h1');
									$in['h2'] 	= $this->input->post('h2');
									$in['h3'] 	= $this->input->post('h3');
									$in['r1'] 	= $this->input->post('r1');
									$in['r2'] 	= $this->input->post('r2');
									$in['r3'] 	= $this->input->post('r3');
									$in['no_po'] 	= strtoupper($this->input->post('no_po'));
									$this->db->insert("trx_so_header",$in);
									$last_id = $this->db->insert_id();
									$this->session->set_flashdata("success","Input Request Order Berhasil");
									redirect("SO_Dairy/index/".$last_id);
								}else{
									$this->session->set_flashdata("error",$this->upload->display_errors());
									redirect("SO_Dairy");
								}	
							}
						}
					}
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");
					redirect("SO_Dairy/index/".$this->input->post('id_request'));	
				} else {
					$tanggal_request=date("Y-m-d");
					$tanggal_kirim=$this->input->post('tanggal_kirim');
					if($tanggal_kirim < $tanggal_request){
						$this->session->set_flashdata("error","Anda tidak diperbolehkan merubah tanggal order menjadi tanggal yang telah lalu..!");
						redirect("SO_Dairy");
					}else{
						$id_customer_ship = $this->input->post("id_customer_ship");
						$id_customer_sold = $this->input->post("id_customer_ship");
						$qship = $this->db->query("SELECT id_customer FROM mst_customer WHERE nama_customer='$id_customer_ship'")->row();
						$qsold = $this->db->query("SELECT id_customer FROM mst_customer WHERE nama_customer='$id_customer_sold'")->row();
						if($qship == '' || $qsold ==''){
							$this->session->set_flashdata("error","Nama customer tidak sesuai.. silahkan input kembali..");
							redirect("SO_Dairy/index/".$this->input->post('id_request'));
						}else{
							if($this->upload->do_upload("file_upload")) {
								$data_upload = $this->upload->data();
								$in1['status_request'] 	= 1;
								$in1['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');
								$in1['catatan'] 	= strtoupper($this->input->post('catatan'));
								$in1['h1'] 	= $this->input->post('h1');
								$in1['h2'] 	= $this->input->post('h2');
								$in1['h3'] 	= $this->input->post('h3');
								$in1['r1'] 	= $this->input->post('r1');
								$in1['r2'] 	= $this->input->post('r2');
								$in1['r3'] 	= $this->input->post('r3');
								$in1['no_po'] 	= strtoupper($this->input->post('no_po'));
								$in['id_customer_ship'] 	= $qship->id_customer;
								$in['id_customer_sold'] 	= $qsold->id_customer;
								$in1['title'] 	= $data_upload['file_name'];		
								$this->db->update("trx_so_header",$in1,$where);
								$this->session->set_flashdata("success","Edit Sales Order Berhasil");
								redirect("SO_Dairy/index/".$this->input->post('id_request'));	
							} else if(!$this->upload->do_upload("file_upload")) {
								$in1['status_request'] 	= 1;
								$in1['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');
								$in1['catatan'] 	= strtoupper($this->input->post('catatan'));
								$in1['h1'] 	= $this->input->post('h1');
								$in1['h2'] 	= $this->input->post('h2');
								$in1['h3'] 	= $this->input->post('h3');
								$in1['r1'] 	= $this->input->post('r1');
								$in1['r2'] 	= $this->input->post('r2');
								$in1['r3'] 	= $this->input->post('r3');
								$in1['no_po'] 	= strtoupper($this->input->post('no_po'));
								$in['id_customer_ship'] 	= $qship->id_customer;
								$in['id_customer_sold'] 	= $qsold->id_customer;		
								$this->db->update("trx_so_header",$in1,$where);
								$this->session->set_flashdata("success","Edit Sales Order Berhasil");
								redirect("SO_Dairy/index/".$this->input->post('id_request'));	
							}else{
								$this->session->set_flashdata("error",$this->upload->display_errors());
								redirect("SO_Dairy");
							}
						}
					}
				}		
			} else {
				redirect("SO_Dairy");
			}
		} else {
			redirect("login");
		}
	}
	public function salin() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "4"  || $this->session->userdata('id_role') == "5") {
			$id_requestCopy = $this->input->post('id_requestCopy');
			$tanggal_kirim = $this->input->post('tanggal_rencanaCopy');
			$qValidate = $this->db->query("SELECT * FROM trx_so_header WHERE id_request ='$id_requestCopy'")->row();
			if($qValidate->tanggal_kirim == $tanggal_kirim){
				$this->session->set_flashdata("error","Tanggal tidak boleh sama dengan sebelumnya");
				redirect("SO_Dairy/index/".$id_requestCopy);
			}else if ($qValidate->tanggal_kirim > $tanggal_kirim){
				$this->session->set_flashdata("error","Tanggal tidak boleh lebih awal dengan sebelumnya");
				redirect("SO_Dairy/index/".$id_requestCopy);
			}else{
				$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
											JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
								if($get_id == null){
									$no_akhir = "SO.000000.000";
								}else{
									$no_akhir = $get_id->no_request;
								}
								$tanggal = "SO.".date("ymd")."."; 
								date_default_timezone_set('Asia/Jakarta');
								$inCopy['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
								$inCopy['id_user'] 	= $this->session->userdata('id_user');
								$inCopy['tanggal_request'] 	= date('Y-m-d H-i-s');
								$inCopy['id_customer_ship'] 	= $qValidate->id_customer_ship;
								$inCopy['id_customer_sold'] 	= $qValidate->id_customer_sold;
								$inCopy['status_request'] 	= 1;
								$inCopy['tanggal_kirim'] 	= $tanggal_kirim;
								$inCopy['catatan'] 	= strtoupper($this->input->post('keteranganCopy'));
								$inCopy['no_po'] 	= strtoupper($this->input->post('no_poCopy'));
								$this->db->insert("trx_so_header",$inCopy);
								$last_idCopy = $this->db->insert_id();
				$this->session->set_flashdata("success","Data order berhasil tersalin");
				$getDetailCopy = $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id_requestCopy'");
				foreach($getDetailCopy->result_array() as $dataCopy){
					if($dataCopy['id_jenis_transaksi']==2){
						$id_request = $last_idCopy;
						$id_product = $dataCopy['id_product'];
						$qty = $dataCopy['qty'];
						$qcustomer = $this->db->query("SELECT id_customer_ship FROM trx_so_header WHERE id_request='$last_idCopy'")->row();
						$id_customer = $qcustomer->id_customer_ship;
						$qStock = $this->db->query("SELECT stock_customer.* FROM(SELECT MAX(id_stock) AS id_stock FROM stock_customer WHERE id_customer = '$id_customer' 
													AND id_product= '$id_product') AS dataMax JOIN stock_customer ON dataMax.id_stock = stock_customer.id_stock")->row();
						$qStock1 = $this->db->query("SELECT count(*) as jml FROM(SELECT MAX(id_stock) AS id_stock FROM stock_customer WHERE id_customer = '$id_customer' 
													AND id_product= '$id_product') AS dataMax JOIN stock_customer ON dataMax.id_stock = stock_customer.id_stock")->row();
							$inStock['id_request'] = $id_request;
							$inStock['id_customer'] = $id_customer;
							$inStock['id_product'] 	= $id_product;
							if($qStock1->jml==0){
								$inStock['qty'] = 0-$qty;
							}else{
								$inStock['qty'] = $qStock->qty-$qty;
							}
							$inStock['tanggal_update'] 	= date('Y-m-d H:i:s');
							$this->db->insert("stock_customer",$inStock);
							$in['id_jenis_transaksi'] 	= $dataCopy['id_jenis_transaksi'];
							$in['id_product'] 	= $dataCopy['id_product'];
							$in['qty'] 	= $dataCopy['qty'];
							$in['satuan'] 	= $dataCopy['satuan'];
							$in['id_satuan'] 	= $dataCopy['id_satuan'];
							$in['keterangan'] = $dataCopy['keterangan'];
							$in['id_shipping_point'] = $dataCopy['id_shipping_point'];
							$in['id_request'] 	= $last_idCopy;				
							$this->db->insert("trx_so_detail",$in);					
								// $last_id = $this->db->insert_id();
							$qdetReq=$this->db->query("SELECT trx_so_detail.* FROM (SELECT MAX(id_detail_request) AS id_detail_request FROM `trx_so_detail` 
														WHERE `id_request` = $last_idCopy) AS detreq1 JOIN trx_so_detail ON detreq1.id_detail_request=trx_so_detail.id_detail_request")->row();
							$inShipping['id_request'] = $qdetReq->id_request;
							$inShipping['id_detail_request'] = $qdetReq->id_detail_request;
							$inShipping['id_status_kirim'] = 1;
							$this->db->insert("trx_shipping",$inShipping);
					}else{
						$in['id_jenis_transaksi'] 	= $dataCopy['id_jenis_transaksi'];
						$in['id_product'] 	= $dataCopy['id_product'];
						$in['qty'] 	= $dataCopy['qty'];
						$in['satuan'] 	= $dataCopy['satuan'];
						$in['id_satuan'] 	= $dataCopy['id_satuan'];
						$in['keterangan'] = $dataCopy['keterangan'];
						$in['id_shipping_point'] = $dataCopy['id_shipping_point'];
						$in['id_request'] 	= $last_idCopy;	
						$this->db->insert("trx_so_detail",$in);					
						// $last_id = $this->db->insert_id();
						$qdetReq=$this->db->query("SELECT trx_so_detail.* FROM (SELECT MAX(id_detail_request) AS id_detail_request FROM `trx_so_detail` 
														WHERE `id_request` = $last_idCopy) AS detreq1 JOIN trx_so_detail ON detreq1.id_detail_request=trx_so_detail.id_detail_request")->row();
						$inShipping['id_request'] = $qdetReq->id_request;
						$inShipping['id_detail_request'] = $qdetReq->id_detail_request;
						$inShipping['id_status_kirim'] = 1;
						$this->db->insert("trx_shipping",$inShipping);
					}
				}
				$this->session->set_flashdata("success","Data order telah tersalin..");
				redirect("SO_Dairy/index/".$last_idCopy);
			}			
		} else {
			redirect("login");
		}
	}
	public function duplicate() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "4"  || $this->session->userdata('id_role') == "5") {
			$id_requestDuplicate = $this->input->post('id_requestDuplicate');
			$jml_duplicate = $this->input->post('jml_duplicate');
			$jml_duplicateplus1 = $jml_duplicate+1;
			$qValidate = $this->db->query("SELECT * FROM trx_so_header WHERE id_request ='$id_requestDuplicate'")->row();
			$date = $qValidate->tanggal_kirim;
			$date1 = strtotime($date);
			for($i=1;$i<$jml_duplicateplus1;$i++){
				$ab=7*$i;
				$dateplus = strtotime("+$ab day", $date1);
				$dateNew = date('Y-m-d',$dateplus);
				$get_id = $this->db->query("SELECT trx_so_header.no_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama
											JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();
								$no_akhir = $get_id->no_request;
								$tanggal = "SO.".date("ymd")."."; 
								date_default_timezone_set('Asia/Jakarta');
								$inCopy['no_request'] 	= buatkode($no_akhir, $tanggal, 3);
								$inCopy['id_user'] 	= $this->session->userdata('id_user');
								$inCopy['tanggal_request'] 	= date('Y-m-d H-i-s');
								$inCopy['id_customer_ship'] 	= $qValidate->id_customer_ship;
								$inCopy['id_customer_sold'] 	= $qValidate->id_customer_sold;
								$inCopy['status_request'] 	= 1;
								$inCopy['tanggal_kirim'] 	= $dateNew;
								$this->db->insert("trx_so_header",$inCopy);
								$last_idCopy = $this->db->insert_id();
				// $this->session->set_flashdata("success","Data order berhasil tersalin");
				$getDetailCopy = $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id_requestDuplicate'");
				foreach($getDetailCopy->result_array() as $dataCopy){
					if($dataCopy['id_jenis_transaksi']==2){
						$id_request = $last_idCopy;
						$id_product = $dataCopy['id_product'];
						$qty = $dataCopy['qty'];
						$qcustomer = $this->db->query("SELECT id_customer_ship FROM trx_so_header WHERE id_request='$last_idCopy'")->row();
						$id_customer = $qcustomer->id_customer_ship;
						$qStock = $this->db->query("SELECT stock_customer.* FROM(SELECT MAX(id_stock) AS id_stock FROM stock_customer WHERE id_customer = '$id_customer' 
													AND id_product= '$id_product') AS dataMax JOIN stock_customer ON dataMax.id_stock = stock_customer.id_stock")->row();
						$qStock1 = $this->db->query("SELECT count(*) as jml FROM(SELECT MAX(id_stock) AS id_stock FROM stock_customer WHERE id_customer = '$id_customer' 
													AND id_product= '$id_product') AS dataMax JOIN stock_customer ON dataMax.id_stock = stock_customer.id_stock")->row();
							$inStock['id_request'] = $id_request;
							$inStock['id_customer'] = $id_customer;
							$inStock['id_product'] 	= $id_product;
							if($qStock1->jml==0){
								$inStock['qty'] = 0-$qty;
							}else{
								$inStock['qty'] = $qStock->qty-$qty;
							}
							$inStock['tanggal_update'] 	= date('Y-m-d H:i:s');
							$this->db->insert("stock_customer",$inStock);
							$in['id_jenis_transaksi'] 	= $dataCopy['id_jenis_transaksi'];
							$in['id_product'] 	= $dataCopy['id_product'];
							$in['qty'] 	= $dataCopy['qty'];
							// $in['lock'] 	= 1;
							$in['satuan'] 	= $dataCopy['satuan'];
							$in['id_satuan'] 	= $dataCopy['id_satuan'];
							$in['keterangan'] = $dataCopy['keterangan'];
							$in['id_shipping_point'] = $dataCopy['id_shipping_point'];
							$in['id_request'] 	= $last_idCopy;				
							$this->db->insert("trx_so_detail",$in);					
								// $last_id = $this->db->insert_id();
							$qdetReq=$this->db->query("SELECT trx_so_detail.* FROM (SELECT MAX(id_detail_request) AS id_detail_request FROM `trx_so_detail` 
														WHERE `id_request` = $last_idCopy) AS detreq1 JOIN trx_so_detail ON detreq1.id_detail_request=trx_so_detail.id_detail_request")->row();
							$inShipping['id_request'] = $qdetReq->id_request;
							$inShipping['id_detail_request'] = $qdetReq->id_detail_request;
							$inShipping['id_status_kirim'] = 1;
							$this->db->insert("trx_shipping",$inShipping);
					}else{
						$in['id_jenis_transaksi'] 	= $dataCopy['id_jenis_transaksi'];
						$in['id_product'] 	= $dataCopy['id_product'];
						$in['qty'] 	= $dataCopy['qty'];
						// $in['lock'] 	= 1;
						$in['satuan'] 	= $dataCopy['satuan'];
						$in['id_satuan'] 	= $dataCopy['id_satuan'];
						$in['keterangan'] = $dataCopy['keterangan'];
						$in['id_shipping_point'] = $dataCopy['id_shipping_point'];
						$in['id_request'] 	= $last_idCopy;	
						$this->db->insert("trx_so_detail",$in);					
						// $last_id = $this->db->insert_id();
						$qdetReq=$this->db->query("SELECT trx_so_detail.* FROM (SELECT MAX(id_detail_request) AS id_detail_request FROM `trx_so_detail` 
														WHERE `id_request` = $last_idCopy) AS detreq1 JOIN trx_so_detail ON detreq1.id_detail_request=trx_so_detail.id_detail_request")->row();
						$inShipping['id_request'] = $qdetReq->id_request;
						$inShipping['id_detail_request'] = $qdetReq->id_detail_request;
						$inShipping['id_status_kirim'] = 1;
						$this->db->insert("trx_shipping",$inShipping);
					}
				}
			}
			$this->session->set_flashdata("success","Data order telah tersalin..");
			redirect("SO_Dairy/index/".$last_idCopy);
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
					redirect("SO_Dairy/index/".$this->input->post('id_request'));
				}else if(preg_match('/^[0-9]+(\\.[0-9]+)?$/', $qtyVal)){
					$kode_trans = $this->session->userdata("kode_trans");
					$id_request = $this->input->post('id_request');
					$qHeadCheck = $this->db->query("SELECT id_customer_ship,no_po,tanggal_kirim FROM trx_so_header WHERE id_request='$id_request'")->row();
					$id_product = $this->input->post('id_product');
					$qCheckB = $this->db->query("SELECT count(*) as jml FROM trx_so_header rs JOIN trx_so_detail dr ON rs.id_request=dr.id_request 
												WHERE id_customer_ship='$qHeadCheck->id_customer_ship' AND tanggal_kirim='$qHeadCheck->tanggal_kirim'
												AND id_product='$id_product' AND kode_trans='$kode_trans' AND dr.delete_id='0'")->row();
					if($qCheckB->jml == '0'){
						$whereUp['id_request'] = $this->input->post('id_request');
						$inUp['tanggal_request'] = date('Y-m-d H:i:s');
						$inUp['id_user_rev'] = $this->session->userdata("id_user");
						$this->db->update("trx_so_header",$inUp,$whereUp);
						$qsatuan=$this->db->query("SELECT mst_product.division,mst_product.satuan FROM mst_product WHERE id_product='$id_product'")->row();
						$qjenis=$this->db->query("SELECT id_jenis_transaksi FROM jenis_transaksi WHERE kode_trans='$kode_trans'")->row();
						$in['id_jenis_transaksi'] 	= $qjenis->id_jenis_transaksi;
						$in['id_product'] 	= $this->input->post('id_product');
						$in['qty'] 	= $this->input->post('qty');
						$in['satuan'] 	= $qsatuan->satuan;
						// $in['id_satuan'] 	= $qsatuan->id_satuan;
						$in['keterangan'] = $this->input->post('keterangan');
						$in['id_request'] 	= $this->input->post('id_request');
						// $matgr = $qsatuan->division;
						$qshipping_p=$this->db->query("SELECT mspc.id_shipping_point FROM trx_so_header rs JOIN mst_shipping_point_customer mspc ON mspc.id_customer=rs.id_customer_ship WHERE id_request='$id_request'")->row();
						// $qspaut = $this->db->query("SELECT sp.id_sales_person FROM trx_so_header rs JOIN mst_customer mc ON rs.id_customer_ship=mc.id_customer JOIN mst_sales_person_division mspd ON mspd.kode_customer=mc.kode_customer JOIN sales_person sp ON sp.pers_numb=mspd.pers_numb WHERE rs.id_request='$id_request' AND mspd.matgr='$matgr'")->row();
						// if($qspaut==''){
						// 	$in['id_sales_person'] = 0;
						// }else{
						// 	$in['id_sales_person'] = $qspaut->id_sales_person;
						// }
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
						$this->db->insert("trx_shipping",$inShipping);
						$this->session->set_flashdata("success","Input Detail PO Berhasil");
					}else{
						if($this->session->userdata("username")=='admin.admin'||$this->session->userdata("username")=='fenda'||$this->session->userdata("username")=='puspita'||$this->session->userdata("username")=='ichbal'||$this->session->userdata("username")=='purwono'||$this->session->userdata("username")=='amrulloh'||$this->session->userdata("username")=='devita.ayu'||$this->session->userdata("username")=='safitri.safitri'){
							$whereUp['id_request'] = $this->input->post('id_request');
							$inUp['tanggal_request'] = date('Y-m-d H:i:s');
							$inUp['id_user_rev'] = $this->session->userdata("id_user");
							$this->db->update("trx_so_header",$inUp,$whereUp);
							$qsatuan=$this->db->query("SELECT mst_product.division,mst_product.satuan FROM mst_product WHERE id_product='$id_product'")->row();
							$qjenis=$this->db->query("SELECT id_jenis_transaksi FROM jenis_transaksi WHERE kode_trans='$kode_trans'")->row();
							$in['id_jenis_transaksi'] 	= $qjenis->id_jenis_transaksi;
							$in['id_product'] 	= $this->input->post('id_product');
							$in['qty'] 	= $this->input->post('qty');
							$in['satuan'] 	= $qsatuan->satuan;
							// $in['id_satuan'] 	= $qsatuan->id_satuan;
							$in['keterangan'] = $this->input->post('keterangan');
							$in['id_request'] 	= $this->input->post('id_request');
							// $matgr = $qsatuan->division;
							$qshipping_p=$this->db->query("SELECT mspc.id_shipping_point FROM trx_so_header rs JOIN mst_shipping_point_customer mspc ON mspc.id_customer=rs.id_customer_ship WHERE id_request='$id_request'")->row();
							// $qspaut = $this->db->query("SELECT sp.id_sales_person FROM trx_so_header rs JOIN mst_customer mc ON rs.id_customer_ship=mc.id_customer JOIN mst_sales_person_division mspd ON mspd.kode_customer=mc.kode_customer JOIN sales_person sp ON sp.pers_numb=mspd.pers_numb WHERE rs.id_request='$id_request' AND mspd.matgr='$matgr'")->row();
							// if($qspaut==''){
							// 	$in['id_sales_person'] = 0;
							// }else{
							// 	$in['id_sales_person'] = $qspaut->id_sales_person;
							// }
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
							$this->db->insert("trx_shipping",$inShipping);
							$this->session->set_flashdata("success","Input Detail PO Berhasil");			
						}else{
							$this->session->set_flashdata("error","Data product dan jenis transaksi yang anda inputkan sudah ada di customer dan tanggal pengiriman yang sama");
						}
					}
					redirect("SO_Dairy/index/".$id_request);
				}else{
					$this->session->set_flashdata("error","Input Qty harus berupa angka. Jika Qty terdapat koma maka ganti koma dengan titik (misal 2,5 menjadi 2.5)");
					redirect("SO_Dairy/index/".$this->input->post('id_request'));
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Data detail order belum lengkap.");
					redirect("SO_Dairy/index/".$this->input->post('id_request'));	
				} else if(preg_match('/^[0-9]+(\\.[0-9]+)?$/', $qtyVal)){
				    $qskrng = $this->db->query("SELECT qty FROM trx_so_detail WHERE id_detail_request='$id_detail_request'")->row();
					$inskrng['qty_old'] = $qskrng->qty;
					$this->db->update("trx_so_detail",$inskrng,$where);
					$whereUp['id_request'] = $this->input->post('id_request');
					$inUp['tanggal_request'] = date('Y-m-d H:i:s');
					$inUp['id_user_rev'] = $this->session->userdata("id_user");
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
					$this->session->set_flashdata("success","Edit Detail Berhasil");
					redirect("SO_Dairy/index/".$this->input->post('id_request'));	
				}else{
					$this->session->set_flashdata("error","Input Qty harus berupa angka. Jika Qty terdapat koma maka ganti koma dengan titik (misal 2,5 menjadi 2.5)");
					redirect("SO_Dairy/index/".$this->input->post('id_request'));
				}			
			} else {
				$this->session->set_flashdata("error","Gagal menyimpan");
				redirect("SO_Dairy");
			}
		} else {
			redirect("login");
		}
	}
	public function hapus($id) {
		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 && $id != null) {
			$qid_detail=$this->db->query("SELECT id_detail_request FROM trx_so_detail WHERE id_request='$id'");
			foreach($qid_detail->result_array() as $data) {  
				// $this->db->delete("trx_shipping",array('id_detail_request' => $data['id_detail_request']));
				$whereDel['id_detail_request'] = $data['id_detail_request'];
    			$inDel['delete_id'] = 1;
			    $inDel['del_user'] = $this->session->userdata("id_user");
    			$this->db->update("trx_shipping",$inDel,$whereDel);
			}
// 			$this->db->delete("trx_so_detail",array('id_request' => $id));
// 			$this->db->delete("trx_so_header",array('id_request' => $id));		
			$whereDel1['id_request'] = $id;
			$inDel['delete_id'] = 1;
			$inDel['del_user'] = $this->session->userdata("id_user");
			$this->db->update("trx_so_detail",$inDel,$whereDel1);
			$this->db->update("trx_so_header",$inDel,$whereDel1);
			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("SO_Dairy");			
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
			$this->db->update("trx_shipping",$inDel,$whereDel);
			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("SO_Dairy/index/".$idm);		
		} else {
			redirect("login");
		}
	}
}
