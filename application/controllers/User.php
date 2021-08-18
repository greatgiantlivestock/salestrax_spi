<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class user extends CI_Controller {
function __construct(){
	parent::__construct();
	$this->load->database();
	$this->load->helper(array('url'));
	$this->load->model('App_model');
}
public function index($id="") {
	if($this->session->userdata('id_role') == "1") {
		if($id != ""){
			$get_id = $this->db->query("SELECT * FROM mst_user mu JOIN tk_personal tp ON mu.id_karyawan=tp.id_karyawan
										JOIN mst_departemen dept ON dept.id_departemen=mu.id_departemen 
										JOIN role rl ON rl.id_role = mu.id_role WHERE mu.id_aplikasi='2' 
										AND rl.id_aplikasi='2' AND mu.id_user='$id'
										ORDER BY mu.id_karyawan DESC");
			foreach($get_id->result() as $data) {
				$d['combo_role'] = $this->App_model->get_combo_role($data->id_role);
				$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id($data->id_wilayah);
				$d['combo_region'] = $this->App_model->get_combo_region_id($data->id_region);
				$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user($data->description);
				$d['combo_departemen'] = $this->App_model->get_combo_departemen($data->id_departemen);
				//$data['combo_tk_personal']=$this->App_model->get_combo_karyawan($data->id_karyawan);	
				$d['combo_karyawan']=$this->App_model->get_combo_karyawan_($data->id_karyawan);
				$d['id_user'] = $data->id_user;
				$d['nama_karyawan'] = $data->nama_karyawan;
				$d['no_hp'] = $data->no_hp;
			}
			$d['user'] = $this->App_model->get_user();
			$d['judul'] = 'Master User';	
			$d['tipe'] = 'edit';
			$d['btn_tamb'] = '<a class="btn btn-xs btn-primary" style="margin-left: 40px;" href="'.base_url().'penjualan">
			<i class="ace-icon fa fa-close"></i>
			<span class="bigger-110">Tambah</span></a>';
			$d['btn_edit'] = '<a class="btn btn-xs btn-primary" style="margin-left: 40px;" href="'.base_url().'penjualan">
			<i class="ace-icon fa fa-close"></i>
			<span class="bigger-110">Edit</span></a>';
			$d['mac'] = '';
			$d['mac1'] = '';
			$d['username'] = '';
			$d['password'] = '';
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('user/user_tabel.php');
			$this->load->view('bottom');
		}else{
			$d['btn_tambah'] = '<a id="openModalEditOpname" href="#" class="btn btn-xs btn-primary" 
			data-kegiatan="" data-departemen="" data-wilayah="" href="#" data-toggle="modal" 
			data-target="#ModalInputUser"><span> </span> Tambah User</a>';
			$d['btn_edit'] = '<a id="openModalEditOpname" href="#" class="btn btn-xs btn-success" 
			data-kegiatan="" data-departemen="" data-wilayah="" href="#" data-toggle="modal" 
			data-target="#ModalInputUser"><span> </span> Edit</a>';
			$d['btn_batal'] = '<a class="btn btn-standar" style="margin-left: 40px;" href="'.base_url().'User">
									<i class="ace-icon fa fa-undo bigger-110"></i>Batal</a>';
			$d['btn_nota'] = '<button class="btn btn-success"><i class="ace-icon fa fa-check bigger-110"></i>Simpan</button>';
			$d['btn_delete'] = '<button class="btn btn-danger"><i class="ace-icon fa fa-trash bigger-110"></i>Hapus</button>';
			$d['user'] = $this->App_model->get_user();
			$d['judul'] = 'Master User';	
			$d['tipe'] = 'add';
			$d['id_user'] = '';
			$d['nama_karyawan'] = '';
			$d['no_hp'] = '';
			$d['mac'] = '';
			$d['mac1'] = '';
			$d['username'] = '';
			$d['password'] = '';
			$d['combo_role'] = $this->App_model->get_combo_role();
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id();
			$d['combo_region'] = $this->App_model->get_combo_region_id();
				$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();
			$d['combo_departemen'] = $this->App_model->get_combo_departemen();
			$data['combo_tk_personal']=$this->App_model->get_combo_karyawan();	
			$d['combo_karyawan']=$this->App_model->get_combo_karyawan_();	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('user/user_tabel.php');
			$this->load->view('bottom');
		}
	}else {
		redirect("login");
	}
}
	public function get_row($id) {
		$row = $this->db->query("SELECT * FROM mst_user_shipping_point WHERE id_user='$id'"); // get the row by querying from your database & further process
		$d['shipping_point'] = $row;
		$d['judul'] = "Detail Shipping Point";
		$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();
		$this->load->view('user/detail.php',$d);
		$this->load->view('bottom');
	}
	public function add() {
		if($this->session->userdata('id_role') == "1") {
			$d['judul'] = 'Tambah Data Karyawan';	
			$d['tipe'] = 'add';
			$d['id_user'] = '';
			$d['nama_karyawan'] = '';
			$d['no_hp'] = '';
			$d['mac'] = '';
			$d['mac1'] = '';
			$d['username'] = '';
			$d['password'] = '';
			$d['combo_role'] = $this->App_model->get_combo_role();
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id();
			$d['combo_region'] = $this->App_model->get_combo_region_id();
				$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();
			$d['combo_departemen'] = $this->App_model->get_combo_departemen();
			$data['combo_tk_personal']=$this->App_model->get_combo_karyawan();
			$this->load->view('top',$d);	
			$this->load->view('menu');
			$this->load->view('user/user_input',$data);
			$this->load->view('bottom');
		}
		else {
			redirect("login");
		}
	}
	function ambil_data(){
		$modul=$this->input->post('modul');
		$id=$this->input->post('id_karyawan');
		$get=$this->db->query("SELECT id_karyawan,departemen,telp_mobile FROM tk_personal WHERE id_karyawan = '$id'")->row();
		$id_karyawan= $get->id_karyawan;
		$departemen= $get->departemen;
		$no_hp=$get->telp_mobile;
		if($modul=="departemen"){
			echo $this->App_model->get_combo_departemen_karyawan($departemen);
		}
		if($modul=="no_hp"){
			echo strval($no_hp);
		}
	}
	public function edit($id="") {
		if($this->session->userdata('id_role') == "1" && $id != null) {
			$where['id_user'] = $id;
			$get_id = $this->db->get_where("mst_user",$where)->row();		
			$d['judul'] = 'Edit Data Karyawan';			
			$d['tipe'] = 'edit';
			$d['id_user'] = $get_id->id_user;
			$d['no_hp'] = $get_id->no_hp;
			$d['username'] = $get_id->username;
			$d['password'] = $get_id->password;
			$d['mac'] = $get_id->mac;
			$d['mac1'] = $get_id->mac1;
			$d['combo_departemen'] = $this->App_model->get_combo_departemen($get_id->id_departemen);
			$d['combo_role'] = $this->App_model->get_combo_role($get_id->id_role);
			$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id($get_id->id_wilayah);
			$d['combo_region'] = $this->App_model->get_combo_region_id($get_id->id_region);
			$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user($data->description);
			$d['combo_tk_personal'] = $this->App_model->get_combo_tk_personal($get_id->id_karyawan);
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('user/user_edit');
			$this->load->view('bottom');			
		} else {
			redirect("login");
		}
	}
	public function edit_password() {
		$id_user = $this->input->post("id_user");
		$password = md5($this->input->post("password"));
		$this->db->set('password', $password); 
		$this->db->where('id_user', $id_user); 
		$this->db->update('mst_user');  
	}
	public function save() {
		if($this->session->userdata('id_role') == "1") {
			$required = array('id_karyawan','id_departemen','id_role','username','password','id_wilayah','ulangi_password');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$required1 = array('id_karyawan','id_departemen','id_role','username','id_wilayah');
			$error1 = false;
			foreach($required1 as $field) {
				if(empty($_POST[$field])) {
					$error1 = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_user'] = $this->input->post('id_user');
			$in['no_hp'] = $this->input->post('no_hp');
			$in['username'] = $this->input->post('username');
			$in['id_aplikasi'] = "2";
			$in['mac'] = $this->input->post('imei1');
			$in['mac1'] = $this->input->post('imei2');
			$id_karyawan=$this->input->post('id_karyawan');
			$tp=$this->db->query("SELECT nama_karyawan FROM tk_personal WHERE id_karyawan='$id_karyawan'")->row();
			if(!empty($this->input->post('mac'))) {				
				$in['mac'] = $this->input->post('mac');
				$in['mac1'] = $this->input->post('mac1');
			}
			if($tipe == "add") {
					if($error) {
						$this->session->set_flashdata("error","Mohon input data dengan lengkap");
						redirect("user");	
					} else {
						if($this->input->post('password') != $this->input->post('ulangi_password')){
							$this->session->set_flashdata("error","Password dan konfirmasi password tidak sama..");
							redirect("user");
						}else{
							$in['id_role'] = $this->input->post('id_role');
							$in['password'] = md5($this->input->post('password'));
							$in['id_departemen'] = $this->input->post('id_departemen');
							$in['id_karyawan'] = $id_karyawan;
							$in['nama'] = $tp->nama_karyawan;
							$in['nama_karyawan'] = $tp->nama_karyawan;
							$in['id_wilayah'] = $this->input->post('id_wilayah');
							$this->db->insert("mst_user",$in);
							if($this->input->post('description') != ''){
								$last_id = $this->db->insert_id();
								$inShp['id_user'] = $last_id;
								$inShp['description'] = $this->input->post('description');
								$this->db->insert("mst_user_shipping_point",$inShp);
							}
							$this->session->set_flashdata("success","Input Data Karyawan Berhasil");
							redirect("User");
						}
					}		
			} elseif($tipe == "edit") {
				if($error1) {
					$this->session->set_flashdata("error","Inputkan data dengan lengkap");
					redirect("user");	
				} else {					
					$in1['no_hp'] = $this->input->post('no_hp');
					$in1['username'] = $this->input->post('username');
					$in1['id_departemen'] = $this->input->post('id_departemen');
					$in1['id_role'] = $this->input->post('id_role');
					$in1['id_karyawan'] = $this->input->post('id_karyawan');
					$in1['nama'] = $tp->nama_karyawan;
					$in1['nama_karyawan'] = $tp->nama_karyawan;
					$in1['id_wilayah'] = $this->input->post('id_wilayah');
					$in2['description'] = $this->input->post('description');
					$this->db->update("mst_user",$in1,$where);
					$this->db->update("mst_user_shipping_point",$in2,$where);
					$this->session->set_flashdata("success","Edit Data Karyawan Berhasil");
					redirect("User");
				}		
			} else {
				redirect("user");
			}
		} else {
			redirect("error");
		}
	}
	public function saveOS() {
		if($this->session->userdata('id_role') == "1") {
			$required_os = array('nama_karyawan','id_departemen','id_role','username','password','id_wilayah','ulangi_password','id_region');
			$error_os = false;
			foreach($required_os as $field) {
				if(empty($_POST[$field])) {
					$error_os = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$where['id_user'] = $this->input->post('id_user');
			$in['no_hp'] = $this->input->post('no_hp');
			$in['mac'] = $this->input->post('imei1');
			$in['mac1'] = $this->input->post('imei2');
			$in['username'] = $this->input->post('username');
			$in['id_aplikasi'] = "2";
			$in['os'] = 1;
			$genKarOS=$this->db->query("SELECT * FROM (SELECT MAX(id_user) AS id_user FROM mst_user WHERE os='1') AS data_max_id JOIN mst_user ON data_max_id.id_user = mst_user.id_user")->row();
			$countKarOS=$this->db->query("SELECT count(*) AS banyak FROM (SELECT MAX(id_user) AS id_user FROM mst_user WHERE os='1') AS data_max_id JOIN mst_user ON data_max_id.id_user = mst_user.id_user")->row();
			if($countKarOS->banyak == 0){
				$id_karyawanOS = 10000;
			}else{
				$id_karyawanOS = intval($genKarOS->id_karyawan) + 1;
			}
			if(!empty($this->input->post('mac'))) {				
				$in['mac'] = $this->input->post('mac');
				$in['mac1'] = $this->input->post('mac1');
			}
			if($tipe == "addOS") {
				if($error_os) {
					$this->session->set_flashdata("error","Mohon input data dengan lengkap");
					redirect("User");	
				} else {
					if($this->input->post('password') != $this->input->post('ulangi_password')){
						$this->session->set_flashdata("error","Password dan konfirmasi password tidak sama..");
						redirect("User");
					}else{
						$in['id_role'] = $this->input->post('id_role');
						$in['password'] = md5($this->input->post('password'));
						$in['id_departemen'] = $this->input->post('id_departemen');
						$in['id_karyawan'] = $id_karyawanOS;
						$in['nama'] = strtoupper($this->input->post('nama_karyawan'));
						$in['nama_karyawan'] = strtoupper($this->input->post('nama_karyawan'));
						$in['id_wilayah'] = $this->input->post('id_wilayah');
						$in['id_region'] = $this->input->post('id_region');
						$this->db->insert("mst_user",$in);
						if($this->input->post('description') != ''){
							$last_id = $this->db->insert_id();
							$inShp['id_user'] = $last_id;
							$inShp['description'] = $this->input->post('description');
							$this->db->insert("mst_user_shipping_point",$inShp);
						}
						$this->session->set_flashdata("success","Input Data Karyawan Berhasil");
						redirect("user");
					}
				}		
			}else if($tipe == "editOS") {
				if($error1) {
					$this->session->set_flashdata("error","Inputkan data dengan lengkap");
					redirect("user");	
				} else {					
					$in1['no_hp'] = $this->input->post('no_hp');
					$in1['username'] = $this->input->post('username');
					$in1['id_departemen'] = $this->input->post('id_departemen');
					$in1['id_role'] = $this->input->post('id_role');
					$in1['id_karyawan'] = $this->input->post('id_karyawan');
					$in1['nama'] = $tp->nama_karyawan;
					$in1['id_wilayah'] = $this->input->post('id_wilayah');
					$in2['description'] = $this->input->post('description');
					$this->db->update("mst_user",$in1,$where);
					$this->db->update("mst_user_shipping_point",$in2,$where);
					$this->session->set_flashdata("success","Edit Data Karyawan Berhasil");
					redirect("User");
				}		
			} else  {
				redirect("login");
			}
		} else {
			redirect("error");
		}
	}
	public function save_shipping_point() {
		if($this->session->userdata('id_role') == "1") {
			$required = array('id_user','description');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	
			$in['id_user'] = $this->input->post('id_user');
			$in['description'] = $this->input->post('description');
			if($tipe == "add") {
				if($error) {
					redirect("user");	
				} else {
					$this->db->insert("mst_user_shipping_point",$in);
					$this->session->set_flashdata("success","Input Data hipping Point Berhasil");
					redirect("user");
				}
			} elseif($tipe == "edit") {
					/*if($error1) {
						$this->session->set_flashdata("error","Inputkan data dengan lengkap");
						redirect("user");	
					} else {					
						$in1['no_hp'] = $this->input->post('no_hp');
						$in1['username'] = $this->input->post('username');
						$in1['id_departemen'] = $this->input->post('id_departemen');
						$in1['id_role'] = $this->input->post('id_role');
						$in1['id_karyawan'] = $this->input->post('id_karyawan');
						$in1['nama'] = $tp->nama_karyawan;
						$in1['id_wilayah'] = $this->input->post('id_wilayah');
						$in2['description'] = $this->input->post('description');
						$this->db->update("mst_user",$in1,$where);
						$this->db->update("mst_user_shipping_point",$in2,$where);
						$this->session->set_flashdata("success","Edit Data Karyawan Berhasil");
						redirect("user");
					}*/	
			} else {
				redirect("user");
			}
		} else {
			redirect("error");
		}
	}
	public function edit_shipping_point($id=""){
		$get_id = $this->db->query("SELECT * FROM mst_user mu JOIN tk_personal tp ON mu.id_karyawan=tp.id_karyawan
										JOIN mst_departemen dept ON dept.id_departemen=mu.id_departemen 
										JOIN role rl ON rl.id_role = mu.id_role WHERE mu.id_aplikasi='2' 
										AND rl.id_aplikasi='2' AND mu.id_user='$id'
										ORDER BY mu.id_karyawan DESC");
			foreach($get_id->result() as $data) {
				$d['combo_role'] = $this->App_model->get_combo_role($data->id_role);
				$d['combo_wilayah'] = $this->App_model->get_combo_wilayah_id($data->id_wilayah);
				$d['combo_region'] = $this->App_model->get_combo_region_id($data->id_region);
				$d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user($data->description);
				$d['combo_departemen'] = $this->App_model->get_combo_departemen($data->id_departemen);	
				$d['combo_karyawan']=$this->App_model->get_combo_karyawan_($data->id_karyawan);
				$d['id_user'] = $data->id_user;
				$d['nama_karyawan'] = $data->nama_karyawan;
				$d['no_hp'] = $data->no_hp;
			}
			$d['shipping_point'] = $this->App_model->get_shipping_point();
			$d['judul'] = 'Edit Shipping Point';	
			$d['btn_tamb'] = '<a class="btn btn-xs btn-primary" style="margin-left: 40px;" href="'.base_url().'penjualan">
			<i class="ace-icon fa fa-close"></i>
			<span class="bigger-110">Tambah</span></a>';
			$d['btn_edit'] = '<a class="btn btn-xs btn-primary" style="margin-left: 40px;" href="'.base_url().'penjualan">
			<i class="ace-icon fa fa-close"></i>
			<span class="bigger-110">Edit</span></a>';
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('user/edit_shipping_point_user');
		$this->load->view('bottom');
	}
	public function hapus() {
		$id=$this->input->post('id_user');
		if($this->session->userdata('id_role') == "1") {
			$this->db->delete("mst_user_shipping_point",array('id_user' => $id));				
			$this->db->delete("mst_user",array('id_user' => $id));				
			$this->session->set_flashdata("success","Hapus Data Karyawan Berhasil");
			redirect("user");			
		} else {
			redirect("login");
		}
	}
	public function hapus_shippig_point($id="") {
		if($this->session->userdata('id_role') == "1") {
			$this->db->delete("mst_user_shipping_point",array('id_shipping_point_user' => $id));				
			$this->session->set_flashdata("success","Hapus Data Shipping Point Berhasil");
			redirect("user");			
		} else {
			redirect("login");
		}
	}
}
