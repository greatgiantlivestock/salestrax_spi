<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Msg extends CI_Controller {

	public function index() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {

			$d['master_product'] = $this->App_model->get_msg();

			$d['judul'] = 'Master Product';		

			$d['tipe'] = "add";		

			$d['combo_satuan'] = $this->App_model->get_combo_satuan();

			$d['combo_plant_group'] = $this->App_model->get_combo_plant_group();

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('msg/product_tabel.php');

			$this->load->view('bottom');

		}

		else {

			redirect("login");

		}

	}



	public function add() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {

			$d['judul'] = 'Tambah Master Product';

			$d['tipe'] = 'add';	

			$d['id_product'] = '';		

			$d['kode_product'] = '';

			$d['nama_product'] = '';

			$d['combo_satuan'] = $this->App_model->get_combo_satuan();

			$d['combo_plant_group'] = $this->App_model->get_combo_plant_group();

			$d['konversi_satuan'] = '';

			$d['no_barcode'] = '';

			$this->load->view('top',$d);	

			$this->load->view('menu');

			$this->load->view('msg/product_input');

			$this->load->view('bottom');

		}

		else {

			redirect("login");

		}

	}



	public function edit($id) {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {

			$d['judul'] = 'Edit Master Product';			

			$d['tipe'] = 'edit';

			$where['id_product'] = $id;

			$get_id = $this->db->get_where("mst_product",$where)->row();	

			$d['id_product'] = $get_id->id_product;

			$d['kode_product'] = $get_id->kode_product;

			$d['nama_product'] = $get_id->nama_product;

			$d['combo_satuan'] = $this->App_model->get_combo_satuan($get_id->id_satuan);

			$d['combo_plant_group'] = $this->App_model->get_combo_plant_group($get_id->id_plant_group);

			$d['konversi_satuan'] =  $get_id->konversi_satuan;

			$d['no_barcode'] = $get_id->no_barcode;

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('msg/product_input');

			$this->load->view('bottom');			

		} else {

			redirect("login");

		}

	}





	public function save() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {

			$required = array('msg');

			$error = false;

			foreach($required as $field) {

				if(empty($_POST[$field])) {

					$error = true;

				}

			}

			$tipe = $this->input->post("tipe");	

			$where['id_product'] = $this->input->post('id_product');



			$in['date_input'] 	= date('Y-m-d h.i.s');
			$in['id_user'] 	= $this->session->userdata("id_user");
			$in['msg'] 	= strtoupper($this->input->post('msg'));


			if($tipe == "add") {	

				if($error) {

					$this->session->set_flashdata("error","Inputan Tidak Boleh Kosong");

					redirect("Msg");	

				} else {

					$this->db->insert("message",$in);

					$this->session->set_flashdata("success","Pesan tersimpan");

					redirect("Msg");

				}

			} else {

				$this->session->set_flashdata("success","Gagal");

				redirect("Msg");

			}

		} else {

			redirect("login");

		}

	}



	public function hapus() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4") {

			$id=$this->input->post('id_msg');

			$this->db->delete("message",array('id_msg' => $id));			

			$this->session->set_flashdata("success","Hapus Pesan Berhasil");

			redirect("Msg");			

		} else {

			redirect("login");

		}

	}





}

