<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospect extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') <= 5) {
			$d['judul'] = "Customer Prospect";			
			if($id != "") { 
				$d['id_customer'] = $id;
				$get_id = $this->db->query("SELECT * FROM mst_customer WHERE id_customer = '$id'");
				if($get_id->num_rows() > 0) {
					$d['tipe'] = "edit";
					$d['color'] = 'style="background:#ffffe1;"';
					$d['btn_batal'] = '<a class="btn btn-xs btn-default" style="margin-left: 40px;" href="'.base_url().'prospect">
					<i class="ace-icon fa fa-close"></i>
					<span class="bigger-110">Batal</span></a>';
					foreach($get_id->result() as $data) {
						$d['kode_customer'] = $data->kode_customer;
						$d['nama_customer'] = $data->nama_customer;
						$d['alamat_customer'] = $data->alamat;
						$d['no_hp'] = $data->no_hp;
						$d['nama_usaha'] = $data->nama_usaha;
						$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id($data->id_wilayah);
						$d['lats'] = $data->lats;
						$d['longs'] = $data->longs;
					}
					$d['customer'] = $this->App_model->get_customer($id);
					$d['btn_batal_edit'] = '';
					
					$d['btn_name'] = "Ubah";
					$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Ubah Data</button>';
					$d['disable'] = '';

					$d['readonly'] = '';

				} else {
					redirect("error");
				}
			} else {
				$d['tipe'] = "add";
				$d['color'] = "";
				$d['btn_batal'] = '';
				$d['nomor_rencana'] = '';
				$d['kode_customer'] = '';
				$d['nama_customer'] = '';
				$d['alamat_customer'] = '';
				$d['no_hp'] = '';
				$d['customer'] = $this->App_model->get_customer_prospect();
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Tambah Prospect</button>';
				$d['disable'] = 'disabled';
				$d['readonly'] = 'readonly';
				$d['id_customer'] = '';
				$d['nama_usaha'] = '';
				$d['lats'] = '';
				$d['longs'] = '';

				$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id();
				$d['btn_name'] = "Tambah Kegiatan";
				$d['btn_batal_edit'] = '';
			}
	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('prospect/prospect_table');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	public function edit($id="") {
		if($this->session->userdata('id_role') <= 5) {
			$d['judul'] = "Edit Customer";			
			if($id != "") { 
				$d['id_customer'] = $id;
				$get_id = $this->db->query("SELECT * FROM mst_customer WHERE id_customer = '$id'");
				if($get_id->num_rows() > 0) {
					$d['tipe'] = "edit";
					$d['color'] = 'style="background:#ffffe1;"';
					$d['btn_batal'] = '<a class="btn btn-xs btn-default" style="margin-left: 40px;" href="'.base_url().'prospect">
					<i class="ace-icon fa fa-close"></i>
					<span class="bigger-110">Batal</span></a>';
					foreach($get_id->result() as $data) {
						$d['kode_customer'] = $data->kode_customer;
						$d['nama_customer'] = $data->nama_customer;
						$d['alamat_customer'] = $data->alamat;
						$d['no_hp'] = $data->no_hp;
						$d['no_ktp'] = $data->no_ktp;
						$d['nama_usaha'] = $data->nama_usaha;
						$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id($data->id_wilayah);
						$d['combo_status_customer'] = $this->App_model->get_combo_status_customer($data->id_status_customer);
						$d['lats'] = $data->lats;
						$d['longs'] = $data->longs;
					}
					$d['customer'] = $this->App_model->get_customer($id);
					$d['btn_batal_edit'] = '';
					
					$d['btn_name'] = "Ubah";
					$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-edit"> </i> Ubah Data</button>';
					$d['btn_batal'] = '<button class="btn btn-xs btn-normal"><i class="fa fa-mail-reply"> </i>Batal</button>';
					$d['disable'] = '';

					$d['readonly'] = '';

				} else {
					redirect("error");
				}
			}
	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('Prospect/prospect_edit');
			$this->load->view('bottom');
		} else {
			redirect("login");
		}	
	}

	function generate_code(){
		$modul=$this->input->post('modul');
		$id_wilayah=$this->input->post('id_wilayah');

		$max_jml = $this->db->query("SELECT COUNT(id_customer) AS jumlah FROM mst_customer WHERE id_wilayah = $id_wilayah")->row();
		$kode = $this->db->query("SELECT kode_wilayah FROM mst_wilayah WHERE id_wilayah = $id_wilayah")->row();
		
		$kode_cust=$kode->kode_wilayah.str_pad($max_jml->jumlah+1, 5,'0', STR_PAD_LEFT);
		if($modul=="generate_kode"){
			echo strval($kode_cust);
		}
	}

	public function save() {
		if($this->session->userdata('id_role') <= 5) {
			$required = array('id_wilayah','nama_customer','alamat','no_hp','no_ktp');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	

			$in['kode_customer'] 	= $this->input->post('kode_customer');
			$in['nama_customer'] 	= strtoupper($this->input->post('nama_customer'));
			$in['nama_usaha'] 	= strtoupper($this->input->post('nama_usaha'));
			$in['alamat'] 	= strtoupper($this->input->post('alamat'));
			$in['no_hp'] 	= $this->input->post('no_hp');
			$in['no_ktp'] 	= $this->input->post('no_ktp');
			$in['id_wilayah'] = $this->input->post('id_wilayah');
			
			$in['lats'] 	= '0';
			if ($this->input->post('lats') != ""){
				$in['lats'] 	= $this->input->post('lats');
			}

			$in['longs'] 	= '0';
			if ($this->input->post('longs') != ""){
				$in['longs'] 	= $this->input->post('longs');
			}

			if($tipe == "add") {
				$in['id_status_customer'] 	= 1;
				$kode_check=$this->input->post('kode_customer');	
				$nama_check=$this->input->post('nama_customer');	
				$nope_check=$this->input->post('no_hp');	
				$qval1=$this->db->query("SELECT kode_customer from mst_customer where kode_customer ='$kode_check'")->row();

				$qval2=$this->db->query("SELECT * from mst_customer where nama_customer ='$nama_check' AND no_hp ='$nope_check'")->row();
				if($error) {
					$this->session->set_flashdata("error","Gagal, Mohon input data prospect dengan lengkap");
					redirect("Prospect");	
				} else if($qval1->kode_customer != "") {
					$this->session->set_flashdata("error","Data prospect sudah diinput sebelumnya");							
					redirect("Prospect");
				}else{
					if($qval2 == ''){
						$this->db->insert("mst_customer",$in);
						$last_id = $this->db->insert_id();

						$inAlamat['alamat_kirim'] 	= strtoupper($this->input->post('alamat'));
						$inAlamat['id_customer'] 	= $last_id;
						$this->db->insert("alamat_kirim",$inAlamat);

						$this->session->set_flashdata("success","Prospect berhasil dtambahkan");
						redirect("Prospect");
					}else{
						$this->session->set_flashdata("error","Gagal, prospect sudah terdaftar dengan kode ".$qval2->kode_customer);							
						redirect("Prospect");						
					}
				}
			} else if($tipe = 'edit') {
					$in['id_status_customer'] = $this->input->post('id_status_customer');
					$where['id_customer'] = $this->input->post('id_customer');
					$this->db->update("mst_customer",$in,$where);
					$this->session->set_flashdata("success","Edit customer prospect berhasil");
					redirect("prospect");	
						
			} else {
				redirect("prospect");
			}
		} else {
			redirect("login");
		}
	}

	public function save_detail() {
		if($this->session->userdata('id_role') <= 5) {
			$required = array('id_wilayah','kode_customer','nama_customer','alamat','no_hp','nama_usaha');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}

			$tipe = $this->input->post("tipe");
			$in['kode_customer'] 	= $this->input->post('kode_customer');
			$in['nama_customer'] 	= $this->input->post('nama_customer');
			$in['alamat'] 	= $this->input->post('alamat');
			$in['no_hp'] 	= $this->input->post('no_hp');
			$in['lats'] 	= '0';
			$in['longs'] 	= '0';
			$in['id_wilayah'] = $this->input->post('id_wilayah');

			$where['id_customer'] = $this->input->post('id_customer');

			$this->load->library('Zend');
	        $this->zend->load('Zend/Barcode');

			if($tipe == "edit") {	
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("Prospect/index/".$this->input->post('id_customer'));	
				} else {				
					$this->db->update("mst_customer",$in,$where);
					$this->session->set_flashdata("success","Edit processing Detail Berhasil");
					redirect("prospect");			
				}		
			} else {
				redirect("prospect");
			}
		} else {
			redirect("login");
		}
	}

	public function hapus_customer($id) {
		if($this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') <= 5 && $id != null) {			

			//$this->db->delete("alamat_kirim",array('id_customer' => $id));		
			//$this->db->delete("mst_customer",array('id_customer' => $id));

			$in['id_status_customer'] = 0;
			$where['id_customer'] = $id;
			$this->db->update("mst_customer",$in,$where);		

			$this->session->set_flashdata("success","Hapus Data Prospect Berhasil");
			redirect("prospect");		
		} else {
			redirect("login");
		}
	}

}



