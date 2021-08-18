<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana extends CI_Controller {

	public function index($id="",$idt="") {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5") {
			$d['judul'] = "Rencana";			
			$d['processing'] = $this->App_model->get_processing();
			if($id != "") { 
				$d['id_rencana_header'] = $id;
				$get_id = $this->db->query("SELECT * FROM trx_rencana_master WHERE id_rencana_header = '$id'");
				if($get_id->num_rows() > 0) {
					foreach($get_id->result() as $data) {
						$d['rencana_detail'] = $this->App_model->get_rencana_detail($id);
						$d['qlock'] = $this->App_model->get_qlock($id);
						$d['tipe'] = "edit";
						$d['tanggal_rencana'] = $data->tanggal_rencana;
						$d['tanggal_penetapan'] = $data->tanggal_penetapan;
						$d['keterangan'] = $data->keterangan;
						$d['nomor_rencana'] = $data->nomor_rencana;
						//$d['id_rencana_header'] = $data->id_rencana_header;
						$d['combo_rencana'] = $this->App_model->get_combo_rencana($data->id_rencana_header);
					}
					$d['color'] = 'style="background:#ffffe1;"';
					// $d['btn_batal'] = '<a class="btn btn-xs btn-success" style="margin-left: 40px;" href="'.base_url().'Rencana">
					// 						<i class="ace-icon fa fa-check"></i>
					// 						<span class="bigger-110">Selesai</span>
					// 					</a>';
					$d['btn_name'] = "Ubah";
					$d['btn_nota'] = '<button class="btn btn-xs btn-primary" style="border-radius: 25px;background:rgba(0,0,0,0.2);"><i class="fa fa-edit"> </i> Ubah </button>';
					$d['btn_hapus'] = '<a onclick="return confirm();" class="btn btn-xs btn-danger" href="'.base_url().'Rencana/hapus/'.$id.'">
											<i class="ace-icon fa fa-trash"></i>
											<span class="bigger-110">Hapus</span>
										</a>';
					$d['btn_notax'] = '<button disabled class="btn btn-xs btn-normal" style="border-radius: 25px;background:rgba(0,0,0,0.2);"><i class="fa fa-edit"> </i> Ubah </button>';
					$d['btn_copy'] = '<button class="btn btn-xs btn-success"><i class="fa fa-copy"> </i> salin </button>';
					$d['disable'] = '';
					$d['disabled'] = 'disabled';
					$d['tipe'] = 'edit';

					if($idt != '') {
						$get_edit = $this->db->query("SELECT * FROM trx_rencana_detail WHERE id_rencana_detail='$idt'");
						if($get_edit->num_rows() > 0) {
							foreach($get_edit->result() as $data_edit) {
								$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan($data_edit->id_karyawan);
								$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan($data_edit->id_kegiatan);
								$d['combo_customer'] = $this->App_model->get_combo_customer_rencana($data_edit->id_customer);
								$d['keterangan_detail'] = $data_edit->keterangan;
								$d['id_rencana_detail'] = $data_edit->id_rencana_detail;
								$d['nomor_rencana_detail'] = $data_edit->nomor_rencana_detail;
								$d['btn_name'] = "Ubah kegiatan";
								$d['color_edit'] = 'background:#ffffe1;';
								$d['btn_batal_edit'] = '<a class="btn btn-xs btn-danger" style="margin-left: 40px;" href="'.base_url().'Rencana/index/'.$id.'">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span>
										</a>';
								$d['tipe_detail'] = 'edit';
							}
						} else {
							redirect("error");
						}
					} else {
						$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
						$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan();
						$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
						$d['keterangan_detail'] = '';
						$d['btn_name'] = "Tambah Kegiatan";
						$d['color_edit'] = '';
						$d['id_rencana_detail'] = "";
						$d['btn_batal_edit'] = '';	
						$d['tipe_detail'] = 'add'	;	

					}
					$d['readonly'] = '';

				} else {
					redirect("error");
				}
			} else {
				$d['tipe'] = "add";
				$d['color'] = "";
				// $d['btn_batal'] = '';
				$d['tanggal_pasturisasi'] = '';
				$d['nomor_rencana'] = '';
				$d['jenis_processing'] = '';
				$d['keterangan'] = '';
				
				$d['id_rencana_header'] = '';
				$d['id_rencana_detail'] = '';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary" style="border-radius: 25px;background:rgba(0,0,0,0.2)"><i class="fa fa-plus"> </i> Simpan</button>';
				$d['btn_hapus'] = '';
				$d['btn_notax'] = '';
				$d['btn_copy'] = '';
				$d['disable'] = 'disabled';
				$d['disabled'] = 'disabled';
				$d['readonly'] = 'readonly';
				$d['rencana_detail'] = $this->App_model->get_rencana_detail();
				$d['qlock'] = $this->App_model->get_qlock();

				$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
				$d['combo_rencana'] = $this->App_model->get_combo_rencana();
				$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan();
				$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
				$d['keterangan_detail'] = '';
				$d['no_box'] = '';
				$d['qty'] = '';
				$d['tanggal_rencana'] = '';
				$d['color_edit'] = '';
				$d['btn_name'] = "Tambah Kegiatan";
				$d['btn_batal_edit'] = '';
				$d['tipe_detail'] = '';
			}
	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('rencana/rencana_tabel');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	public function index_edit($id="",$idt="") {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3" || $this->session->userdata('id_role') == "5" ) {
			$d['judul'] = "Rencana";			
			$d['processing'] = $this->App_model->get_processing();
			if($id != "") { 
				$d['id_rencana_header'] = $id;
				$get_id = $this->db->query("SELECT * FROM trx_rencana_master WHERE id_rencana_header = '$id'");
				if($get_id->num_rows() > 0) {
					foreach($get_id->result() as $data) {
						$d['rencana_detail'] = $this->App_model->get_rencana_detail($id);
						$d['tipe'] = "edit";
						$d['tanggal_rencana'] = $data->tanggal_rencana;
						$d['keterangan'] = $data->keterangan;
						$d['nomor_rencana'] = $data->nomor_rencana;
						$d['id_rencana_header'] = $data->id_rencana_header;
					}
					$d['color'] = 'style="background:#ffffe1;"';
					$d['btn_batal'] = '<a class="btn btn-xs btn-default" style="margin-left: 40px;" href="'.base_url().'Rencana">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span>
										</a>';
					$d['btn_name'] = "Ubah";
					$d['btn_nota'] = '<button class="btn btn-xs btn-primary" style="border-radius: 25px;background:rgba(0,0,0,0.2);"><i class="fa fa-edit"> </i> Ubah </button>';
					$d['btn_notax'] = '<button disabled style="border-radius: 25px;background:rgba(0,0,0,0.2);" class="btn btn-xs btn-normal"><i class="fa fa-edit"> </i> Ubah </button>';
					$d['btn_copy'] = '<button class="btn btn-xs btn-success"><i class="fa fa-copy"> </i> salin </button>';
					$d['disable'] = '';
					$d['disabled'] = '';

					$d['tipe'] = 'edit';

					if($idt != '') {
						$get_edit = $this->db->query("SELECT * FROM trx_rencana_detail WHERE id_rencana_detail='$idt'");
						if($get_edit->num_rows() > 0) {
							foreach($get_edit->result() as $data_edit) {
								$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan($data_edit->id_karyawan);
								$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan($data_edit->id_kegiatan);
								$d['combo_customer'] = $this->App_model->get_combo_customer_rencana($data_edit->id_customer);
								$d['keterangan_detail'] = $data_edit->keterangan;
								//$d['no_box'] = $data_edit->no_box;
								//$d['qty'] = $data_edit->qty;
								$d['id_rencana_detail'] = $data_edit->id_rencana_detail;
								$d['btn_name'] = "Ubah kegiatan";
								$d['color_edit'] = 'background:#ffffe1;';
								$d['btn_batal_edit'] = '<a class="btn btn-xs btn-danger" style="margin-left: 40px;" href="'.base_url().'Rencana/index/'.$id.'">
											<i class="ace-icon fa fa-close"></i>
											<span class="bigger-110">Batal</span>
										</a>';
								$d['tipe_detail'] = 'edit';
							}
						} else {
							redirect("error");
						}
					} else {
						$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
						$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan();
						$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
						$d['keterangan_detail'] = '';
						$d['btn_name'] = "Tambah Kegiatan";
						$d['color_edit'] = '';
						$d['id_rencana_detail'] = "";
						$d['btn_batal_edit'] = '';	
						$d['tipe_detail'] = 'add'	;	

					}
					$d['readonly'] = '';

				} else {
					redirect("error");
				}
			} else {
				$d['combo_rencana'] = "";
				//$d['combo_gudang_trf'] = $this->App_model->get_combo_gudang_trf();
				$d['tipe'] = "add";
				$d['color'] = "";
				$d['btn_batal'] = '';
				$d['tanggal_pasturisasi'] = '';
				$d['nomor_rencana'] = '';
				$d['jenis_processing'] = '';
				$d['keterangan'] = '';
				
				$d['id_rencana_header'] = "";
				$d['id_rencana_detail'] = "";
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary" style="border-radius: 25px;background:rgba(0,0,0,0.2);><i class="fa fa-plus"> </i> Simpan</button>';
				$d['disable'] = 'disabled';
				$d['readonly'] = 'readonly';
				$d['rencana_detail'] = $this->App_model->get_rencana_detail();
				$d['id_rencana_header'] = '';

				$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
				$d['combo_rencana'] = $this->App_model->get_combo_rencana();
				$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan();
				$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
				$d['keterangan_detail'] = $data_edit->keterangan;
				$d['no_box'] = '';
				$d['qty'] = '';
				$d['tanggal_rencana'] = '';
				$d['color_edit'] = '';
				$d['btn_name'] = "Tambah Kegiatan";
				$d['btn_batal_edit'] = '';
				$d['tipe_detail'] = '';
			}
	
			$this->load->view('top_edit',$d);
			//$this->load->view('menu');
			$this->load->view('rencana/rencana_tabel_edit');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	function ambil_data(){
		$modul=$this->input->post('modul');
		$id_karyawan=$this->input->post('id_karyawan');
		$id_kegiatan=$this->input->post('id_kegiatan');
		$id_rencana_header=$this->input->post('id_rencana_header');
		if($modul=="kabupaten"){
			echo $this->App_model->kabupaten($id_karyawan);
		}else if($modul=="kecamatan"){
			echo $this->App_model->kecamatan($id_kegiatan);
		}else if($modul=="kelurahan"){
			echo $this->App_model->kelurahan($id);
		}else if($modul=="rencana"){
			redirect("Rencana/index_edit/".$id_rencana_header);
		}
	}

	public function cetak($id) {
		$get_detail = $this->db->query("SELECT trx_rencana_master.tanggal_rencana, process_detail.id_rencana_header, process_detail.id_rencana_detail, process_detail.qty, process_detail.no_box,process_detail.id_product, mst_product.nama_product FROM process_detail LEFT JOIN trx_rencana_master ON trx_rencana_master.id_rencana_header = process_detail.id_rencana_header LEFT JOIN mst_product ON mst_product.id_product = process_detail.id_product WHERE process_detail.id_rencana_header = '$id' ORDER BY process_detail.id_rencana_detail DESC");

		$this->load->library('Zend');
	    $this->zend->load('Zend/Barcode');
		foreach($get_detail->result_array() as $data) {
			$id_product = str_pad($data['id_product'], 3, '0', STR_PAD_LEFT);
			$qty = str_pad($data['qty'], 3, '0', STR_PAD_LEFT);
			$no_box = str_pad($data['no_box'], 3, '0', STR_PAD_LEFT);
			$kode = $data['tanggal_rencana']."-".$no_box."-".$id_product.$qty;
			$file =  Zend_Barcode::draw('code39', 'image', array('text'=>$kode,'font'=>4, array()));
	        //$fname = time().$kode;
			$store_image = imagepng($file,"./barcode/{$kode}.png");			
			$in['barcode'] = $kode.".png";
			$in['id_rencana_header'] = $id;
			$cek_barcode = $this->db->query("SELECT * FROM tmp_barcode WHERE barcode = '$in[barcode]' AND id_rencana_header='$id'");
			if($cek_barcode->num_rows() <= 0) {
				$this->db->insert("tmp_barcode",$in);
			}
			
			$this->load->view("barcode/barcode_print");
			//echo $kode."<br/>";
		}
	}

	public function save() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "5" ) {
			$required = array('tanggal_rencana','keterangan');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	

			$where['id_rencana_header'] = $this->input->post('id_rencana_header');
			$in['tanggal_rencana'] 	= $this->input->post('tanggal_rencana');
			$in['keterangan'] 	= strtoupper($this->input->post('keterangan'));
			$in['tanggal_penetapan'] 	= date("Y-m-d");
			$in['id_user_input_rencana'] 	= $this->session->userdata('id_user');
			

			if($tipe == "add") {	
				if($error) {
					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");
					redirect("Rencana");	
				} else {
				    $id_user_inpt = $this->session->userdata('id_user');
				    $tanggal_rencana_inpt=$this->input->post('tanggal_rencana');
					$get_id = $this->db->query("SELECT trx_rencana_master.nomor_rencana FROM (SELECT MAX(id_rencana_header) AS id_rencana_header FROM trx_rencana_master) AS proses_lama
												JOIN trx_rencana_master ON proses_lama.id_rencana_header=trx_rencana_master.id_rencana_header")->row();
					$getRencana = $this->db->query("SELECT count(*) as jml FROM trx_rencana_master where tanggal_rencana='$tanggal_rencana_inpt' and id_user_input_rencana='$id_user_inpt'")->row();
					
					if($getRencana->jml==0){
					    if($get_id == null){
    						$no_akhir = "RCN.000000.000";
    					}else{ 
    						$no_akhir = $get_id->nomor_rencana;
    					}
    					  $tanggal = "RCN.".date("ymd",strtotime($this->input->post('tanggal_rencana')))."."; 
    
    					$in['nomor_rencana'] = buatkode($no_akhir, $tanggal, 3);
    
    					//$in['nomor_rencana']= $this->input->post('nomor_rencana');
    					$this->db->insert("trx_rencana_master",$in);
    					$last_id = $this->db->insert_id();
    					$this->session->set_flashdata("success","Input Rencana Master Berhasil");
    					redirect("Rencana/index/".$last_id);	
    
    					$d['judul'] = "Rencana"; 
    					$d['processing'] = $this->App_model->get_processing();
    					$d['tanggal_penetapan'] = date("Y-m-d");
    					$d['keterangan'] = strtoupper($this->input->post('keterangan'));
    					$d['tanggal_rencana'] = $this->input->post('tanggal_rencana');
    					$d['nomor_rencana'] = buatkode($no_akhir, $tanggal, 4);
    					
    					$d['tipe'] = "edit";
    					$d['color'] = 'style="background:#ffffe1;"';
    					$d['btn_nota'] = '';
    					$d['btn_batal'] = '';	
    					$d['disable'] = '';
    
    					$q_last = $this->db->query("SELECT trx_rencana_master.* FROM (SELECT MAX(id_rencana_header) 
    												AS id_rencana_header FROM trx_rencana_master) AS proses_lama
    												JOIN trx_rencana_master ON proses_lama.id_rencana_header=
    												trx_rencana_master.id_rencana_header")->row();
    
    					$d['id_rencana_header'] = $q_last->id_rencana_header;
    					$d['id_rencana_detail'] = '';
    					
    					$d['combo_rencana']  = $this->App_model->get_combo_rencana($q_last->id_rencana_header);
    					$d['rencana_detail'] = $this->App_model->get_rencana_detail();
    					$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
    					$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan_admin();
    					$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
    					
    					$d['btn_name'] = "Tambah Kegiatan";
    					$d['btn_batal_edit'] = '';
    					$d['tipe_detail'] = 'add';
    					$d['keterangan_detail'] = '';
    
    					$this->load->view('top',$d);
    					$this->load->view('menu');
    					$this->load->view('rencana/rencana_tabel');
    					$this->load->view('bottom');
					}else{
					    $this->session->set_flashdata("error","Data plan visit di tanggal yang sama sudah ada, silahkan mengedit data yang sudah ada untuk menambah atau mengurangi plan visit");
					    redirect("Rencana");
					}
					
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Mohon mengisi data dengan lengkap");
					redirect("Rencana");	
				} else {
					$in['nomor_rencana'] = $this->input->post('nomor_rencana');
					$where['id_rencana_header'] = $this->input->post('id_rencana_header');
					$this->db->update("trx_rencana_master",$in,$where);
					$last_id = $this->input->post('id_rencana_header');
					$this->session->set_flashdata("success","Data Rencana Master Berhasil Diperbarui");
					redirect("Rencana/index/".$last_id);	

					$d['judul'] = "Rencana"; 
					$d['processing'] = $this->App_model->get_processing();
					$d['tanggal_penetapan'] = date("Y-m-d");
					$d['keterangan'] = strtoupper($this->input->post('keterangan'));
					$d['tanggal_rencana'] = $this->input->post('tanggal_rencana');
					$d['nomor_rencana'] = $this->input->post('nomor_rencana');
					
					$d['tipe'] = "edit";
					$d['color'] = 'style="background:#ffffe1;"';
					$d['btn_nota'] = '';
					$d['btn_batal'] = '';	
					$d['disable'] = '';

					$d['id_rencana_header'] = $this->input->post('id_rencana_header');
					$d['id_rencana_detail'] = '';
					
					$d['combo_rencana']  = $this->App_model->get_combo_rencana($q_last->id_rencana_header);
					$d['rencana_detail'] = $this->App_model->get_rencana_detail();
					$d['combo_karyawan'] = $this->App_model->get_combo_karyawan_kegiatan();
					$d['combo_kegiatan'] = $this->App_model->get_combo_kegiatan_admin();
					$d['combo_customer'] = $this->App_model->get_combo_customer_rencana();
					
					$d['btn_name'] = "Tambah Kegiatan";
					$d['btn_batal_edit'] = '';
					$d['tipe_detail'] = 'add';
					$d['keterangan_detail'] = '';

					$this->load->view('top',$d);
					$this->load->view('menu');
					$this->load->view('rencana/rencana_tabel');
					$this->load->view('bottom');
				}		
			} else {
				redirect("Rencana");
			}
		} else{
			redirect("login");
		}
	}

	public function save_detail() {
		if($this->session->userdata('id_role') == 5 ) {
			$required = array('nama_customer','nomor_rencana');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$id_wilayah = $this->session->userdata('id_wilayah');
			$qkeg = $this->db->query("SELECT id_kegiatan FROM mst_kegiatan WHERE id_wilayah='$id_wilayah' AND active='1'")->row();
			$tipe = $this->input->post("tipe");	
			$where['id_rencana_detail'] = $this->input->post('id_rencana_detail');

			$nama_customer = $this->input->post('nama_customer');
			$qcsold = $this->db->query("SELECT count(*) as jml1 FROM mst_customer WHERE nama_customer='$nama_customer'")->row();
			$qsold = $this->db->query("SELECT id_customer FROM mst_customer WHERE nama_customer='$nama_customer'")->row();

			if($qcsold->jml1!=0){
				$in['id_karyawan'] 	= $this->session->userdata('id_karyawan');
				$in['id_kegiatan'] 	= $qkeg->id_kegiatan;
				$in['id_customer'] 	= $qsold->id_customer;
				$in['keterangan'] 	= "";
				$in['active'] 	= "1";
				$in['id_rencana_header'] = $this->input->post('id_rencana_header');
				$id_cst=$this->input->post('nama_customer');
				
		
				if($error) {
					$this->session->set_flashdata("error","Silahkan pilih karyawan, kegiatan, customer dan isi keterangan dengan lengkap");
					redirect("Rencana/index/".$this->input->post('id_rencana_header'));
				} else {	
					$q_rencana_cst = $this->db->query("SELECT kode_customer FROM mst_customer WHERE nama_customer ='$id_cst'")->row();
					$kd_cst=$q_rencana_cst->kode_customer;
					$no_ren=$this->input->post('nomor_rencana');
					$no_rcn_dt = $no_ren."_".$kd_cst;
					$in['nomor_rencana_detail'] = $no_rcn_dt;

					$id_karyawan = $this->session->userdata('id_karyawan');
					$id_kegiatan = $qkeg->id_kegiatan;
					$id_customer = $this->input->post('id_customer');
					$id_rencana_header = $this->input->post('id_rencana_header');

					$q_check=$this->db->query("SELECT COUNT(*) AS jml FROM trx_rencana_detail WHERE id_karyawan='$id_karyawan' 
												AND id_kegiatan='$id_kegiatan' AND id_customer='$id_customer' 
												AND id_rencana_header='$id_rencana_header'")->row();

					if($q_check->jml == 0){
						$this->db->insert("trx_rencana_detail",$in);				
						$this->session->set_flashdata("success","Input Detail Rencana Berhasil");
					}else{
						$this->session->set_flashdata("error","Detail rencana sudah ada ditanggal yang sama");
					}
					redirect("Rencana/index/".$this->input->post('id_rencana_header'));
				}
			}else{
				$this->session->set_flashdata("error","nama customer tidak terdaftar, pilihlah sesuai dengan yang disarankan");
				redirect("Rencana/index/".$this->input->post('id_rencana_header'));
			}
		} else if($this->session->userdata("id_role")==4) {
			$required = array('id_customer','nomor_rencana','id_karyawan');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$id_wilayah = $this->session->userdata('id_wilayah');
			$qkeg = $this->db->query("SELECT id_kegiatan FROM mst_kegiatan WHERE id_wilayah='$id_wilayah' AND active='1'")->row();
			$tipe = $this->input->post("tipe");	
			$where['id_rencana_detail'] = $this->input->post('id_rencana_detail');

			$in['id_karyawan'] 	= $this->input->post('id_karyawan');
			$in['id_kegiatan'] 	= $qkeg->id_kegiatan;
			$in['id_customer'] 	= $this->input->post('id_customer');
			$in['keterangan'] 	= "";
			$in['active'] 	= "1";
			$in['id_rencana_header'] = $this->input->post('id_rencana_header');
			$id_cst=$this->input->post('id_customer');
			
	
			if($error) {
				$this->session->set_flashdata("error","Silahkan pilih karyawan, kegiatan, customer dan isi keterangan dengan lengkap");
				redirect("Rencana/index/".$this->input->post('id_rencana_header'));
			} else {	
				$q_rencana_cst = $this->db->query("SELECT kode_customer FROM mst_customer WHERE id_customer ='$id_cst'")->row();
				$kd_cst=$q_rencana_cst->kode_customer;
				$no_ren=$this->input->post('nomor_rencana');
				$no_rcn_dt = $no_ren."_".$kd_cst;
				$in['nomor_rencana_detail'] = $no_rcn_dt;

				$id_karyawan = $this->input->post('id_karyawan');
				$id_kegiatan = $qkeg->id_kegiatan;
				$id_customer = $this->input->post('id_customer');
				$id_rencana_header = $this->input->post('id_rencana_header');

				$q_check=$this->db->query("SELECT COUNT(*) AS jml FROM trx_rencana_detail WHERE id_karyawan='$id_karyawan' 
											AND id_kegiatan='$id_kegiatan' AND id_customer='$id_customer' 
											AND id_rencana_header='$id_rencana_header'")->row();

				if($q_check->jml == 0){
					$this->db->insert("trx_rencana_detail",$in);				
					$this->session->set_flashdata("success","Input Detail Rencana Berhasil");
				}else{
					$this->session->set_flashdata("error","Detail rencana sudah ada ditanggal yang sama");
				}
				redirect("Rencana/index/".$this->input->post('id_rencana_header'));
			}
		}else{
			redirect("login");
		}
	}

	public function hapus($id) {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3"  || $this->session->userdata('id_role') == "5" && $id != null) {
			$this->db->delete("trx_rencana_detail",array('id_rencana_header' => $id));
			$this->db->delete("trx_rencana_master",array('id_rencana_header' => $id));		
			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("Rencana");			
		} else {
			redirect("login");
		}
	}

	public function salin() {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3"  || $this->session->userdata('id_role') == "5") {
			$id_rencana_header = $this->input->post('id_rencana_header');
			$tanggal_rencana = $this->input->post('tanggal_rencana');
			$qValidate = $this->db->query("SELECT tanggal_rencana FROM trx_rencana_master WHERE id_rencana_header ='$id_rencana_header'")->row();
			if($qValidate->tanggal_rencana==$tanggal_rencana){
				$this->session->set_flashdata("error","Tanggal rencana tidak boleh sama dengan sebelumnya");
				redirect("Rencana/index/".$id_rencana_header);
			}else{
				$in['tanggal_rencana'] 	= $this->input->post('tanggal_rencana');
				$in['keterangan'] 	= strtoupper($this->input->post('keterangan'));
				$in['tanggal_penetapan'] 	= date('Y-m-d');
				$in['id_user_input_rencana'] 	= $this->session->userdata('id_user');

				$get_id = $this->db->query("SELECT trx_rencana_master.nomor_rencana FROM (SELECT MAX(id_rencana_header) AS id_rencana_header FROM trx_rencana_master) AS proses_lama
											JOIN trx_rencana_master ON proses_lama.id_rencana_header=trx_rencana_master.id_rencana_header")->row();
				if($get_id == null){
					$no_akhir = "RCN.000000.000";
				}else{ 
					$no_akhir = $get_id->nomor_rencana;
				}
				$tanggal = "RCN.".date("ymd",strtotime($this->input->post('tanggal_rencana')))."."; 

				$in['nomor_rencana'] = buatkode($no_akhir, $tanggal, 3);
				$this->db->insert("trx_rencana_master",$in);
				
				$last_id = $this->db->insert_id();
				$this->session->set_flashdata("success","Input Rencana Master Berhasil");

				$getDetailCopy = $this->db->query("SELECT * FROM trx_rencana_detail WHERE id_rencana_header='$id_rencana_header'");

				foreach($getDetailCopy->result_array() as $dataCopy){
					$inDt['id_rencana_header'] = $last_id;
					$inDt['id_kegiatan'] 	= $dataCopy['id_kegiatan'];
					$inDt['id_customer'] 	= $dataCopy['id_customer'];
					$inDt['id_karyawan'] 	= $this->session->userdata('id_karyawan');
					$inDt['keterangan'] 	= "";

					$getNoRen = $this->db->query("SELECT nomor_rencana FROM trx_rencana_master WHERE id_rencana_header='$last_id'")->row();
					$no_ren=$getNoRen->nomor_rencana;

					$id_customer = $dataCopy['id_customer'];
					$q_rencana_cst = $this->db->query("SELECT kode_customer FROM mst_customer WHERE id_customer ='$id_customer'")->row();
					$kd_cst=$q_rencana_cst->kode_customer;

					$no_rcn_dt = $no_ren."_".$kd_cst;
					
					$inDt['nomor_rencana_detail'] = $no_rcn_dt;
					$inDt['active'] = "1";
					
					$this->db->insert("trx_rencana_detail",$inDt);
				}
				redirect("Rencana/index/".$last_id);
			}			
		} else {
			redirect("login");
		}
	}

	public function selesai($id) {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4"  || $this->session->userdata('id_role') == "5" && $id != null) {	
			$where['id_rencana_header'] = $id;	
			$in1['lock'] 	= "1";
			$this->db->update("trx_rencana_detail",$in1,$where);
			
			$this->session->set_flashdata("success","Data rencana kunjungan berhasil disimpan");
			redirect("Rencana");			
		} else {
			redirect("login");
		}
	}

	public function hapus_detail($id,$idm) {
		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "3"  || $this->session->userdata('id_role') == "5" && $id != null) {			

			$this->db->delete("trx_rencana_detail",array('id_rencana_detail' => $id));		

			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("Rencana/index/".$idm);		
		} else {
			redirect("login");
		}
	}

}



