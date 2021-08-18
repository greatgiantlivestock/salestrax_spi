<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Scrapping extends CI_Controller {
	public function index($id="",$idt="") {

		$this->load->helper('url');
		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6) {

			$d['judul'] = "Sales Order";			


			if($id != "") { 

				$d['id_request'] = $id;

				$get_id = $this->db->query("SELECT data1.*,shipping_point.description AS cst_sold FROM(SELECT ro.*, shp.description AS cst_ship FROM request_scrapping ro 

											JOIN mst_user mu ON mu.id_user=ro.id_user 

											JOIN mst_shipping_point shp ON shp.id_shipping_point=ro.id_shp_to) AS data1 

											JOIN mst_shipping_point ON mst_shipping_point.id_shipping_point=data1.id_shp_from

											WHERE id_request='$id'");

				if($get_id->num_rows() > 0) {

					foreach($get_id->result() as $data) {

						$d['request_detail'] = $this->App_model->get_request_detail_scrapping($id);

						$d['combo_ship'] = $this->App_model->get_combo_shp($data->id_shp_to);

						$d['combo_sold'] = $this->App_model->get_combo_shp($data->id_shp_from);

						$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_scrapping($id);

						$d['tanggal_request'] = $data->tanggal_request;

						$d['tanggal_kirim'] = $data->tanggal_kirim;

						$d['catatan'] = $data->catatan;

						$d['title'] = $data->title;

						$d['no_po'] = $data->document_number;

						$d['no_request'] = $data->no_request;

					}

					$d['color'] = 'style="background:#ffffe1;"';

					$d['btn_batal'] = '<a class="btn btn-xs btn-default"  href="'.base_url().'Scrapping">

											<i class="ace-icon fa fa-close"></i>

											<span class="bigger-110">Batal</span>

										</a>';

					$d['btn_name'] = "Ubah";

					$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Ubah Data</button>';

					$d['disable'] = '';

					$d['tipe'] = 'edit';



					if($idt != '') {

						$get_edit = $this->db->query("SELECT * FROM detail_scrapping WHERE id_request='$id'");

						if($get_edit->num_rows() > 0) {

							foreach($get_edit->result() as $data_edit) {

								$d['id_product'] = $data_edit->id_product;

								$d['qty'] = $data_edit->qty;

								$d['combo_satuan'] = $this->App_model->get_combo_satuan($data_edit->satuan);

								// $d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi($data_edit->id_jenis_transaksi);

								$d['combo_product'] = $this->App_model->get_combo_product($data_edit->id_product);

								// $d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point($data_edit->id_shipping_point);

								$d['keterangan'] = $data_edit->keterangan;

								$d['btn_name'] = "Ubah Produk";

								$d['color_edit'] = 'background:#ffffe1;';

								$d['btn_batal_edit'] = '<a class="btn btn-xs btn-danger" style="margin-left: 40px;" href="'.base_url().'Scrapping/index/'.$id.'">

											<i class="ace-icon fa fa-close"></i>

											<span class="bigger-110">Batal</span>

										</a>';

								$d['tipe_detail'] = 'edit';

							}

						} else {

							redirect("error");

						}

					} else {

						$d['id_product'] = '';

						$d['qty'] = '';

						$d['combo_satuan'] = $this->App_model->get_combo_satuan();

						$d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi();

						$d['combo_product'] = $this->App_model->get_combo_product();

						$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();

						$d['keterangan'] = '';

						$d['btn_name'] = "Simpan Produk";

						$d['color_edit'] = '';

						$d['btn_batal_edit'] = '';	

						$d['tipe_detail'] = 'add'	;	

					}

					$d['combo_product'] = $this->App_model->get_combo_product();

					$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();

					$d['readonly'] = '';



				} else {

					redirect("error");

				}

			} else {

				$d['id_request'] = '';

				$d['request_detail'] = $this->App_model->get_request_detail_scrapping();

				$d['combo_ship'] = $this->App_model->get_combo_shp();

				$d['combo_sold'] = $this->App_model->get_combo_shp();

				$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_scrapping();

				$d['tanggal_request'] = date('Y-m-d H-i-s');

				$d['tanggal_kirim'] = '';

				$d['no_hp'] = '';

				$d['catatan'] = '';

				$d['title'] = '';

				$d['no_po'] = '';

				$d['no_request'] = '';

				$d['alamat'] = '';



				$d['tipe'] = "add";

				$d['color'] = "";

				$d['btn_batal'] = '';

				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Tambah Data</button>';

				$d['disable'] = 'disabled';

				$d['readonly'] = 'readonly';

				

				$d['id_product'] = '';

				$d['qty'] = '';

				$d['combo_satuan'] = $this->App_model->get_combo_satuan();

				$d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi();

				$d['combo_product'] = $this->App_model->get_combo_product();

				$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();

				$d['keterangan'] = '';

				$d['color_edit'] = '';

				$d['btn_name'] = "Simpan";

				$d['btn_batal_edit'] = '';

				$d['tipe_detail'] = 'add';

			}

			

			$d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi();

			$d['combo_product'] = $this->App_model->get_combo_product();

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point();

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('scrapping/scrapping_tabel');

			$this->load->view('bottom');

		} else {

			redirect("login");

		}	

	}

	function ambil_data(){

		$modul=$this->input->post('modul');

		$id_product=$this->input->post('id_product');

		$q_plant_group=$this->db->query("SELECT * FROM mst_product WHERE id_product='$id_product'")->row();

		$id_plant_group=$q_plant_group->id_plant_group;

		if($modul=="plant_group"){

			echo $this->App_model->plant_group($id_plant_group);

		}

		if($modul=="pilih_satuan"){

			$get=$this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan 

									WHERE id_product = '$id_product'")->row();

			$satuan=$get->nama_satuan;

			echo strval($satuan);

		}

	}

	public function cetak($id) {

		$get_detail = $this->db->query("SELECT trx_rencana_master.tanggal_rencana, process_detail.id_rencana_header, process_detail.id_rencana_detail, process_detail.qty, process_detail.no_box,process_detail.id_product, mst_product.id_product FROM process_detail LEFT JOIN trx_rencana_master ON trx_rencana_master.id_rencana_header = process_detail.id_rencana_header LEFT JOIN mst_product ON mst_product.id_product = process_detail.id_product WHERE process_detail.id_rencana_header = '$id' ORDER BY process_detail.id_rencana_detail DESC");

		$this->load->library('Zend');

	    $this->zend->load('Zend/Barcode');

		foreach($get_detail->result_array() as $data) {

			$id_product = str_pad($data['id_product'], 3, '0', STR_PAD_LEFT);

			$qty = str_pad($data['qty'], 3, '0', STR_PAD_LEFT);

			$no_box = str_pad($data['no_box'], 3, '0', STR_PAD_LEFT);

			$kode = $data['tanggal_rencana']."-".$no_box."-".$id_product.$qty;

			$file =  Zend_Barcode::draw('code39', 'image', array('text'=>$kode,'font'=>4, array()));

			$store_image = imagepng($file,"./barcode/{$kode}.png");			

			$in['barcode'] = $kode.".png";

			$in['id_rencana_header'] = $id;

			$cek_barcode = $this->db->query("SELECT * FROM tmp_barcode WHERE barcode = '$in[barcode]' AND id_rencana_header='$id'");

			if($cek_barcode->num_rows() <= 0) {

				$this->db->insert("tmp_barcode",$in);
			}

			$this->load->view("barcode/barcode_print");

		}

	}

	public function save() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5" || $this->session->userdata('id_role') == "6") {

			$required = array('tanggal_kirim','id_customer_sold','id_customer_ship');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}

			$tipe = $this->input->post("tipe");	
			$where['id_request'] = $this->input->post('id_request');
			$config['upload_path'] = './upload/scrapping/';
			$config['allowed_types']= 'gif|jpg|png|jpeg|pdf';
			//$config['encrypt_name']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size'] 	= 100000000;
			$config['max_width'] 	= 400000000;
			$config['max_height'] 	= 350000000;

			$this->load->library('upload', $config);		

			if($tipe == "add") {	

				if($error) {

					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");

					redirect("Scrapping");	

				} else {

					$tanggal_request=date("Y-m-d");

					$tanggal_kirim=$this->input->post('tanggal_kirim');

					// if($tanggal_kirim < $tanggal_request){

					// 	$this->session->set_flashdata("error","Tanggal kirim tidak boleh kurang dari ".$tanggal_request);

					// 	redirect("Scrapping");

					// }else{

						if($this->upload->do_upload("file_upload")) {

							$data_upload = $this->upload->data();

							$get_id = $this->db->query("SELECT request_scrapping.no_request FROM (SELECT MAX(id_request) AS id_request FROM request_scrapping) 
													AS proses_lama JOIN request_scrapping ON proses_lama.id_request=request_scrapping.id_request")->row();

							if($get_id == null){

								$no_akhir = "SC.000000.000";

							}else{

								$no_akhir = $get_id->no_request;

							}

							$tanggal = "SC.".date("ymd")."."; 

							date_default_timezone_set('Asia/Jakarta');
							$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);

							$in['id_user'] 	= $this->session->userdata('id_user');

							$in['tanggal_request'] 	= date('Y-m-d H-i-s');

							$in['id_shp_from'] 	= $this->input->post('id_customer_ship');

							$in['id_shp_to'] 	= $this->input->post('id_customer_sold');

							$in['status_request'] 	= 1;

							$in['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

							$in['catatan'] 	= strtoupper($this->input->post('catatan'));

							$in['document_number'] 	= strtoupper($this->input->post('no_po'));

							$in['title'] 	= $data_upload['file_name'];

							$this->db->insert("request_scrapping",$in);

							$last_id = $this->db->insert_id();



							$this->session->set_flashdata("success","Input Request Order Berhasil");

							redirect("Scrapping/index/".$last_id);

						} else if(!$this->upload->do_upload("file_upload")) {

							$get_id = $this->db->query("SELECT request_scrapping.no_request FROM (SELECT MAX(id_request) AS id_request FROM request_scrapping) AS proses_lama

														JOIN request_scrapping ON proses_lama.id_request=request_scrapping.id_request")->row();

							if($get_id == null){

								$no_akhir = "SC.000000.000";

							}else{

								$no_akhir = $get_id->no_request;

							}

							$tanggal = "SC.".date("ymd")."."; 



							$in['no_request'] 	= buatkode($no_akhir, $tanggal, 3);

							$in['id_user'] 	= $this->session->userdata('id_user');

							$in['tanggal_request'] 	= date('Y-m-d H-i-s');

							$in['id_shp_from'] 	= $this->input->post('id_customer_sold');

							$in['id_shp_to'] 	= $this->input->post('id_customer_ship');

							$in['status_request'] 	= 1;

							$in['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

							$in['catatan'] 	= strtoupper($this->input->post('catatan'));

							$in['document_number'] 	= strtoupper($this->input->post('no_po'));



							$this->db->insert("request_scrapping",$in);

							$last_id = $this->db->insert_id();



							$this->session->set_flashdata("success","Input Request Order Berhasil");

							redirect("Scrapping/index/".$last_id);

						}else{

							$this->session->set_flashdata("error",$this->upload->display_errors());

							redirect("Scrapping");

						}	

					// }

				}

			} else if($tipe = 'edit') {

				if($error) {

					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");

					redirect("Scrapping/index/".$this->input->post('id_request'));	

				} else {

					if($this->upload->do_upload("file_upload")) {

						$data_upload = $this->upload->data();



						$in1['status_request'] 	= 1;

						$in1['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

						$in1['catatan'] 	= strtoupper($this->input->post('catatan'));

						$in1['document_number'] 	= strtoupper($this->input->post('no_po'));

						$in1['id_shp_from'] 	= $this->input->post('id_customer_ship');

						$in1['id_shp_to'] 	= $this->input->post('id_customer_sold');

						$in1['title'] 	= $data_upload['file_name'];		



						$this->db->update("request_scrapping",$in1,$where);

						$this->session->set_flashdata("success","Edit Sales Order Berhasil");

						redirect("Scrapping/index/".$this->input->post('id_request'));	

					} else if(!$this->upload->do_upload("file_upload")) {

						$in1['status_request'] 	= 1;

						$in1['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

						$in1['catatan'] 	= strtoupper($this->input->post('catatan'));

						$in1['document_number'] 	= strtoupper($this->input->post('no_po'));

						$in1['id_shp_from'] 	= $this->input->post('id_customer_ship');

						$in1['id_shp_to'] 	= $this->input->post('id_customer_sold');		



						$this->db->update("request_scrapping",$in1,$where);

						$this->session->set_flashdata("success","Edit Sales Order Berhasil");

						redirect("Scrapping/index/".$this->input->post('id_request'));	

					}else{

						$this->session->set_flashdata("error",$this->upload->display_errors());

						redirect("Scrapping");

					}

				}		

			} else {

				redirect("Scrapping");

			}

		} else {

			redirect("login");

		}

	}



	public function save_detail() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5" || $this->session->userdata('id_role') == "6") {

			$required = array('id_request','id_product','qty','satuan','tipe','batch');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}

			$tipe = $this->input->post("tipe");	

			$where['id_detail_request'] = $this->input->post('id_detail_request');


			if($tipe == "add") {

				if($error) {			

					$this->session->set_flashdata("error","Data detail order belum lengkap.");

					redirect("Scrapping/index/".$this->input->post('id_request'));

				}else{
						$nama_satuan=$this->input->post('satuan');

						$qsatuan=$this->db->query("SELECT id_satuan FROM satuan WHERE nama_satuan='$nama_satuan'")->row();
			
						// $in['id_jenis_transaksi'] 	= $this->input->post('id_jenis_transaksi');
			
						$in['id_product'] 	= strtoupper($this->input->post('id_product'));
			
						$in['qty'] 	= $this->input->post('qty');

						$in['batch'] 	= $this->input->post('batch');
			
						$in['satuan'] 	= $this->input->post('satuan');
			
						$in['id_satuan'] 	= $qsatuan->id_satuan;
			
						$in['keterangan'] = $this->input->post('keterangan');
			
						// $in['id_shipping_point'] = $this->input->post('id_shipping_point');

						$in['id_request'] 	= $this->input->post('id_request');				

						$this->db->insert("detail_scrapping",$in);					

						// $last_id = $this->db->insert_id();

						// $qdetReq=$this->db->query("SELECT id_request FROM trx_so_detail WHERE id_detail_request='$last_id'")->row();

						// $inShipping['id_request'] = $qdetReq->id_request;

						// $inShipping['id_detail_request'] = $last_id;

						// $inShipping['id_status_kirim'] = 1;

						// $this->db->insert("shipping",$inShipping);


						$this->session->set_flashdata("success","Input Request Scrapping Detail Berhasil");

						redirect("Scrapping/index/".$this->input->post('id_request'));
				}

			} else if($tipe = 'edit') {

				if($error) {

					$this->session->set_flashdata("error","Data detail order belum lengkap.");

					redirect("Scrapping/index/".$this->input->post('id_request'));	

				} else {	
				    $nama_satuan=$this->input->post('satuan');

        			$qsatuan=$this->db->query("SELECT id_satuan FROM satuan WHERE nama_satuan='$nama_satuan'")->row();

					$in1['batch'] 	= $this->input->post('batch');

					$in1['id_product'] 	= strtoupper($this->input->post('id_product'));

					$in1['qty'] 	= $this->input->post('qty');

					$in1['satuan'] 	= $this->input->post('satuan');

					$in1['id_satuan'] 	= $qsatuan->id_satuan;

					$in1['keterangan'] = $this->input->post('keterangan');

					// $in1['id_shipping_point'] = $this->input->post('id_shipping_point');

					

					$this->db->update("detail_scrapping",$in1,$where);

					$this->session->set_flashdata("success","Edit Request Detail Berhasil");

					redirect("Scrapping/index/".$this->input->post('id_request'));			

				}		

			} else {

				$this->session->set_flashdata("error","Gagal menyimpan");

				redirect("Scrapping");

			}

		} else {

			redirect("login");

		}

	}



	public function hapus($id) {

		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 && $id != null) {

			// $qid_detail=$this->db->query("SELECT id_detail_request FROM trx_so_detail WHERE id_request='$id'");

			// foreach($qid_detail->result_array() as $data) {  

			// 	$this->db->delete("shipping",array('id_detail_request' => $data['id_detail_request']));

			// }

			$this->db->delete("detail_scrapping",array('id_request' => $id));

			$this->db->delete("request_scrapping",array('id_request' => $id));				

			$this->session->set_flashdata("success","Hapus Data Scrapping Berhasil");

			redirect("Scrapping");			

		} else {

			redirect("login");

		}

	}



	public function hapus_detail($id,$idm) {

		if($this->session->userdata('id_role') == 1 || $this->session->userdata('id_role') == 4 || $this->session->userdata('id_role') == 5 || $this->session->userdata('id_role') == 6 && $id != null) {			

			// $this->db->delete("shipping",array('id_detail_request' => $id));		

			$this->db->delete("detail_scrapping",array('id_detail_request' => $id));		

			$this->session->set_flashdata("success","Hapus Data Berhasil");

			redirect("Scrapping/index/".$idm);		

		} else {

			redirect("login");

		}

	}
}









