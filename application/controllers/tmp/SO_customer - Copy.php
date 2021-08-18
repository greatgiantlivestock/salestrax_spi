<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class SO_customer extends CI_Controller {



	public function index($id="",$idt="") {

		$this->load->helper('url');



		if($this->session->userdata('id_role') <= 5) {

			$d['judul'] = "SO Customer";			

			//$d['SO_customer'] = $this->App_model->get_SO_customer();

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
 trx_so_detail 
						$d['combo_sold'] = $this->App_model->get_combo_sold_kode($data->id_customer_sold);

						$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_order($id);

						//$d['combo_alamat_kirim'] = $this->App_model->get_combo_alamat_kirim($data->id_alamat_kirim);

						//$d['alamat'] = $data->alamat;

						$d['tanggal_request'] = $data->tanggal_request;

						$d['tanggal_kirim'] = $data->tanggal_kirim;

						$d['catatan'] = $data->catatan;

						$d['no_po'] = $data->no_po;

						$d['no_request'] = $data->no_request;

					}

					$d['color'] = 'style="background:#ffffe1;"';

					$d['btn_batal'] = '<a class="btn btn-xs btn-default"  href="'.base_url().'SO_customer">

											<i class="ace-icon fa fa-close"></i>

											<span class="bigger-110">Batal</span>

										</a>';

					$d['btn_name'] = "Ubah";

					$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Ubah Data</button>';

					$d['disable'] = '';

					$d['tipe'] = 'edit';



					if($idt != '') {

						$get_edit = $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id'");

						if($get_edit->num_rows() > 0) {

							foreach($get_edit->result() as $data_edit) {

								$d['id_product'] = $data_edit->id_product;

								$d['qty'] = $data_edit->qty;

								$d['combo_satuan'] = $this->App_model->get_combo_satuan($data_edit->satuan);

								$d['combo_jenis_transaksi'] = $this->App_model->get_combo_jenis_transaksi($data_edit->id_jenis_transaksi);

								$d['combo_product'] = $this->App_model->get_combo_product($data_edit->id_product);

								$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point($data_edit->id_shipping_point);

								//$d['combo_alamat_kirim'] = $this->App_model->get_combo_alamat_kirim($data_edit->id_alamat_kirim);

								$d['keterangan'] = $data_edit->keterangan;

								$d['btn_name'] = "Ubah Produk";

								$d['color_edit'] = 'background:#ffffe1;';

								$d['btn_batal_edit'] = '<a class="btn btn-xs btn-danger" style="margin-left: 40px;" href="'.base_url().'SO_customer/index/'.$id.'">

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

						//$d['combo_alamat_kirim'] = $this->App_model->get_combo_alamat_kirim($data_edit->id_alamat_kirim);

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

				$d['request_detail'] = $this->App_model->get_request_detail();

				$d['combo_ship'] = $this->App_model->get_combo_ship_kode();

				$d['combo_sold'] = $this->App_model->get_combo_sold_kode();

				$d['combo_nomor_order'] = $this->App_model->get_combo_nomor_order();

				//$d['combo_alamat_kirim'] = '';

				$d['tanggal_request'] = date("Y-m-d");

				$d['tanggal_kirim'] = '';

				$d['no_hp'] = '';

				$d['catatan'] = '';

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

				//$d['combo_alamat_kirim'] = '';

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

			$this->load->view('so/so_customer_table');

			$this->load->view('bottom');

		} else {

			redirect("login");

		}	

	}



	function ambil_data(){

		$modul=$this->input->post('modul');

		//$kode_customer=$this->input->post('kode_customer');

		$id_product=$this->input->post('id_product');

		/*

		if($modul=="customer_pilih"){

			$get=$this->db->query("SELECT * FROM mst_customer WHERE kode_customer = '$kode_customer'")->row();

			$alamat=$get->alamat;

			echo strval($alamat);

		}

		*/

		if($modul=="pilih_satuan"){

			$get=$this->db->query("SELECT * FROM mst_product JOIN satuan ON mst_product.id_satuan=satuan.id_satuan WHERE id_product = '$id_product'")->row();

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

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5") {

			$required = array('tanggal_kirim','id_customer_sold','id_customer_ship');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}

			$tipe = $this->input->post("tipe");	


 trx_so_detail 
			$where['id_request'] = $this->input->post('id_request');



			$config['upload_path'] = './upload/';

			$config['allowed_types']= 'xls|xlsx';

			$config['encrypt_name']	= TRUE;

			$config['remove_spaces']	= TRUE;	

			$config['max_size']     = '0';



			$this->load->library('upload', $config);

			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));			



			if($tipe == "add") {	

				if($error) {

					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");

					redirect("SO_customer");	

				} else {

					$tanggal_request=date("Y-m-d");;

					$tanggal_kirim=$this->input->post('tanggal_kirim');

					if($tanggal_kirim < $tanggal_request){

						$this->session->set_flashdata("error","Tanggal kirim tidak boleh kurang dari ".$tanggal_request);

						redirect("SO_customer");

					}else{

						if($this->upload->do_upload("file_upload")) {

							//$tnggl_req=date("ymd",strtotime($this->input->post('tanggal_request')));

							$get_id = $this->db->query("SELECT trx_so_header.id_request FROM (SELECT MAX(id_request) AS id_request FROM trx_so_header) AS proses_lama

														JOIN trx_so_header ON proses_lama.id_request=trx_so_header.id_request")->row();

							if($get_id->id_request==null){

								$no_akhir = 1;

							}else{

								$no_akhir = $get_id->id_request+1;

							}

							$kunci = "RQ.".$no_akhir; 



							$in['no_request'] 	= $kunci;//buatkode($no_akhir, $kunci, 4);

							$in['id_user'] 	= $this->session->userdata('id_user');

							$in['tanggal_request'] 	= date("Y-m-d");

							$in['id_customer_ship'] 	= $this->input->post('id_customer_ship');

							$in['id_customer_sold'] 	= $this->input->post('id_customer_sold');

							$in['status_request'] 	= 1;

							$in['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

							$in['catatan'] 	= strtoupper($this->input->post('catatan'));

							$in['no_po'] 	= strtoupper($this->input->post('no_po'));



							$this->db->insert("trx_so_header",$in);

							$last_id = $this->db->insert_id();

							//$this->db->insert("pengiriman",$in);

							//$last_id = $this->db->insert_id();

							$data	= $this->upload->data();



							$inputFileType = IOFactory::identify("./upload/".$data['file_name']);

							$objReader = IOFactory::createReader($inputFileType);

							$objPHPExcel = $objReader->load("./upload/".$data['file_name']);



							$sheet = $objPHPExcel->getSheet(0);

							$highestRow = $sheet->getHighestRow();

							$highestColumn = $sheet->getHighestColumn();



							/*

							for ($row = 2; $row <= $highestRow; $row++){                  

								$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);   



								$inDT['id_pengiriman'] = $last_id;

								$inDT['nota'] = $rowData[0][5];

								$inDT['eartag'] = $rowData[0][0];

								$inDT['shipment'] = $rowData[0][1];

								$inDT['material_description'] = $rowData[0][8];

								$inDT['rfid'] = $rowData[0][2];

								$inDT['berat'] = $rowData[0][4];

								$inDT['customer'] = $rowData[0][7];

								$inDT['no_kendaraan'] = $rowData[0][9];

								

								$cek = $this->db->query("SELECT rfid FROM pengiriman_detail WHERE rfid = '$inDT[rfid]'");

								if($cek->num_rows() > 0) {

									$this->session->set_flashdata("error", "RFID <b>".$inDT['rfid']." </b>Sudah Digunakan, Periksa Kembali");

									$this->db->delete("pengiriman",array("id_pengiriman"=>$last_id));

									@unlink("./upload/".$data['file_name']);

									redirect("pengiriman_sapi");

								} else {

									$this->db->insert("pengiriman_detail",$inDT);

								}		                		

							}

							*/

							@unlink("./upload/".$data['file_name']);

							//redirect("pengiriman_sapi/tampil/".$last_id);

							$this->session->set_flashdata("success","Input Request Order Berhasil");

							redirect("SO_customer/index/".$last_id);

						} else {

							$this->session->set_flashdata("error",$this->upload->display_errors());

							redirect("pengiriman_sapi");

						}	

					}

				}

			} else if($tipe = 'edit') {

				if($error) {

					$this->session->set_flashdata("error","Inputan (nomor_rencana, tanggal, jenis SO_customer, gudang) tidak boleh kosong");

					redirect("SO_customer/index/".$this->input->post('id_request'));	

				} else {

					//$ex_nomor_rencana = explode(".", $this->input->post('nomor_rencana'));

					//$fix_nomor_rencana = $ex_nomor_rencana[0].".".date('ymd',strtotime($this->input->post('tanggal'))).".".$ex_nomor_rencana[2];

					//$in['nomor_rencana'] = $fix_nomor_rencana;

					//$in1['id_customer'] 	= $qcust->id_customer;

					$in1['status_request'] 	= 1;

					$in1['tanggal_kirim'] 	= $this->input->post('tanggal_kirim');

					$in1['catatan'] 	= strtoupper($this->input->post('catatan'));

					$in1['no_po'] 	= strtoupper($this->input->post('no_po'));

					$this->db->update("trx_so_header",$in1,$where);

					$this->session->set_flashdata("success","Edit Sales Order Berhasil");

					redirect("SO_customer/index/".$this->input->post('id_request'));	

				}		

			} else {

				redirect("SO_customer");

			}

		} else {

			redirect("login");

		}

	}



	public function save_detail() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5") {

			$required = array('id_request','id_jenis_transaksi','id_product','qty','satuan','tipe','id_shipping_point');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}



			$nama_satuan=$this->input->post('satuan');

			$qsatuan=$this->db->query("SELECT id_satuan FROM satuan WHERE nama_satuan='$nama_satuan'")->row();



			$tipe = $this->input->post("tipe");	

			$where['id_detail_request'] = $this->input->post('id_detail_request');



			$in['id_jenis_transaksi'] 	= $this->input->post('id_jenis_transaksi');

			$in['id_product'] 	= strtoupper($this->input->post('id_product'));

			$in['qty'] 	= $this->input->post('qty');

			$in['satuan'] 	= $this->input->post('satuan');

			$in['id_satuan'] 	= $qsatuan->id_satuan;

			$in['keterangan'] = $this->input->post('keterangan');

			$in['id_shipping_point'] = $this->input->post('id_shipping_point');



			if($tipe == "add") {

				if($error) {			

					$this->session->set_flashdata("error","Data detail order belum lengkap.");

					redirect("SO_customer/index/".$this->input->post('id_request'));

				}else{

					$in['id_request'] 	= $this->input->post('id_request');				

					$this->db->insert("trx_so_detail",$in);					



					$last_id = $this->db->insert_id();

					$inShipping['id_detail_request'] = $last_id;

					$inShipping['id_status_kirim'] = 1;

					$this->db->insert("shipping",$inShipping);



					$this->session->set_flashdata("success","Input Request Detail Berhasil");

					redirect("SO_customer/index/".$this->input->post('id_request'));

				}

			} else if($tipe = 'edit') {

				if($error) {

					$this->session->set_flashdata("error","Data detail order belum lengkap.");

					redirect("SO_customer/index/".$this->input->post('id_request'));	

				} else {				

					$in1['id_jenis_transaksi'] 	= $this->input->post('id_jenis_transaksi');

					$in1['id_product'] 	= strtoupper($this->input->post('id_product'));

					$in1['qty'] 	= $this->input->post('qty');

					$in1['satuan'] 	= $this->input->post('satuan');

					$in1['id_satuan'] 	= $qsatuan->id_satuan;

					$in1['keterangan'] = $this->input->post('keterangan');

					$in1['id_shipping_point'] = $this->input->post('id_shipping_point');

					

					$this->db->update("trx_so_detail",$in1,$where);

					$this->session->set_flashdata("success","Edit Request Detail Berhasil");

					redirect("SO_customer/index/".$this->input->post('id_request'));			

				}		

			} else {

				$this->session->set_flashdata("error","Gagal menyimpan");

				redirect("SO_customer");

			}

		} else {

			redirect("login");

		}

	}



	public function hapus($id) {

		if($this->session->userdata('id_role') <= 5 && $id != null) {

			$qid_detail=$this->db->query("SELECT id_detail_request FROM trx_so_detail WHERE id_request='$id'");

			foreach($qid_detail->result_array() as $data) {  

				$this->db->delete("shipping",array('id_detail_request' => $data['id_detail_request']));

			}

			$this->db->delete("trx_so_detail",array('id_request' => $id));

			$this->db->delete("trx_so_header",array('id_request' => $id));				

			$this->session->set_flashdata("success","Hapus Data Berhasil");

			redirect("SO_customer");			

		} else {

			redirect("login");

		}

	}



	public function hapus_detail($id,$idm) {

		if($this->session->userdata('id_role') <= 5 && $id != null) {			

			$this->db->delete("shipping",array('id_detail_request' => $id));		

			$this->db->delete("trx_so_detail",array('id_detail_request' => $id));		

			$this->session->set_flashdata("success","Hapus Data Berhasil");

			redirect("SO_customer/index/".$idm);		

		} else {

			redirect("login");

		}

	}





}









