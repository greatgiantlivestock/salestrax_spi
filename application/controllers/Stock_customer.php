<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_customer extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') == 5){
			$nama_karyawan = $this->session->userdata("nama_karyawan");
			if($id !=""){
				$d['judul'] = "Report Rencana";
				$d['tipe'] = "add";
				$d['id_customer'] = "";
				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
				$d['nama_karyawan'] = $nama_karyawan;
				$d['karyawan'] = $this->input->post("nama_karyawan");
				$d['combo_customer'] = $this->App_model->get_combo_customer_stock();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}else{
				$d['judul'] = "Report Rencana";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = "";		
				$d['tanggal_sampai'] = "";
				$d['nama_karyawan'] = "";
				$d['karyawan'] = "";
				$d['id_customer'] = "";
				$d['combo_customer'] = $this->App_model->get_combo_customer_stock();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('stock_customer/report_rencana_table');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') <= 4 || $this->session->userdata('id_role') == 6) {
			if($id !=""){
				$d['judul'] = "Report Rencana";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
				$d['nama_karyawan'] = $this->input->post("nama_karyawan");
				$d['karyawan'] = $this->input->post("nama_karyawan");
				$d['combo_customer'] = $this->App_model->get_combo_customer_stock();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['id_customer'] = "";
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}else{
				$d['judul'] = "Report Rencana";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = "";		
				$d['tanggal_sampai'] = "";
				$d['nama_karyawan'] = "";
				$d['karyawan'] = "";
				$d['id_customer'] = "";
				$d['combo_customer'] = $this->App_model->get_combo_customer_stock();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			}
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('stock_customer/report_rencana_table');
			$this->load->view('bottom');
		}else{
			redirect("login");
		}	
	}

	public function lihat_report() {
		if($this->session->userdata('id_role') <= 2) {
			$d['judul'] = "Report Rencana";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_customer'] = $this->App_model->get_combo_customer_stock($this->input->post("id_customer"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('stock_customer/report_rencana_table');
			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') ==3 || $this->session->userdata('id_role') ==4 || $this->session->userdata('id_role') ==6) {
			$d['judul'] = "Report Rencana";
			$d['tipe'] = "edit";
			$d['id_customer'] = $this->input->post("id_customer");
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_customer'] = $this->App_model->get_combo_customer_stock($this->input->post("id_customer"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('stock_customer/report_rencana_table');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') ==5){
			$nama_karyawan =  $this->session->userdata("nama_karyawan");
			$d['judul'] = "Report Rencana";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $nama_karyawan;
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_customer'] = $this->App_model->get_combo_customer_stock();
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = 'disabled';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-search"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('stock_customer/report_rencana_table');
			$this->load->view('bottom');
		}else{
			redirect("login");
		}	
	}	

	public function post_lunas($id) {
		if($id != "") {
			$tgl_lunas = date('Y-m-d');
			$this->db->query("UPDATE keluar_master SET tgl_lunas = '$tgl_lunas' WHERE id_keluarmaster = '$id'");
			redirect("penjualan/index/".$id);
		} else {
			redirect("404");
		}
	}

	public function cetak($tanggal_mulai="",$tanggal_sampai="",$nama_karyawan="") {
		if($this->session->userdata('id_role') <= 5 || $id != "") {
			$karyawan=str_replace("%20"," ",$nama_karyawan);
			ob_start();

		    $d['tanggal'] = $tanggal_mulai;
		    $d['tanggal1'] = $tanggal_sampai;
			$d['nama_karyawan'] = $karyawan;
		    $d['rencana_detail'] = $this->App_model->get_rencana_report_detail($tanggal_mulai,$tanggal_sampai,$karyawan);

			$this->load->view('report/report_rencana', $d);
		    $html = ob_get_contents();
		    ob_end_clean();
		        
		    require_once('./asset/html2pdf/html2pdf.class.php');
		    $pdf = new HTML2PDF('P','A4','en');
		    $pdf->WriteHTML($html);
		    $pdf->Output('Data Invoice.pdf', 'F');
		    header("Content-type:application/pdf");
			echo file_get_contents("Data Invoice.pdf"); 

		}
	}


	public function save() {
		if($this->session->userdata('id_role') <= 5) {
			$required = array('tanggal_mulai','tanggal_sampai','id_user');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");		
			$in['tanggal'] 	= $this->input->post('tanggal_mulai');
			$in['tanggal1'] 	= $this->input->post('tanggal_sampai');
			$in['id_user'] 	= $this->input->post('id_user');

			if($tipe == "add") {	
				if($error) {
					$this->session->set_flashdata("error","Mohon input data dengan lengkap");
					redirect("penjualan");	
				} else {
					$id_usr=$this->input->post('id_user');
					$tanggal_=$this->input->post('tanggal_mulai');
					$tanggal_1=$this->input->post('tanggal_sampai');
					$get_jumlah = $this->db->query("SELECT banyak_print FROM report_daily_visit WHERE id_user='$id_usr' AND tanggal BETWEEN '$tanggal_' AND '$tanggal_1'")->row();
					$res_report = $this->db->query("SELECT tp.nama_karyawan, rdv.tanggal, rdv.tanggal1 FROM tk_personal tp JOIN mst_user mu 
											ON tp.id_karyawan=mu.id_karyawan JOIN report_daily_visit rdv
											ON rdv.id_user=mu.id_user WHERE mu.id_user='$id_usr'")->row();
					$user_rep = $res_report->nama_karyawan;
					$tanggal_rep = $res_report->tanggal;
					$tanggal_rep1 = $res_report->tanggal1;
  					$total_print = $get_jumlah->banyak_print;

						$in['banyak_print'] = $total_print + 1;
						$this->db->insert("report_daily_visit",$in);
						$last_id = $this->db->insert_id();
	
						$this->session->set_flashdata("success","Input report Berhasil");
						redirect("penjualan/index/".$last_id);
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Mohon input data dengan lengkap");
					redirect("penjualan");	
				} else {
					$id_usr=$this->input->post('id_user');
					$tanggal_=$this->input->post('tanggal_mulai');
					$tanggal_1=$this->input->post('tanggal_sampai');
					$get_jumlah = $this->db->query("SELECT banyak_print FROM report_daily_visit WHERE id_user='$id_usr' AND tanggal BETWEEN '$tanggal_' AND '$tanggal_1'")->row();
					$res_report = $this->db->query("SELECT tp.nama_karyawan, rdv.tanggal, rdv.tanggal1 FROM tk_personal tp JOIN mst_user mu 
											ON tp.id_karyawan=mu.id_karyawan JOIN report_daily_visit rdv
											ON rdv.id_user=mu.id_user WHERE mu.id_user='$id_usr'")->row();
					$user_rep = $res_report->nama_karyawan;
					$tanggal_rep = $res_report->tanggal;
					$tanggal_rep = $res_report->tanggal1;
  					$total_print = $get_jumlah->banyak_print;
						$in['banyak_print'] = $total_print + 1;
						$this->db->insert("report_daily_visit",$in);
						$last_id = $this->db->insert_id();
						$this->session->set_flashdata("success","Input report Berhasil");
						redirect("penjualan/index/".$last_id);
				}		
			} else {
				redirect("penjualan");
			}
		} else {
			redirect("login");
		}
	}

	public function save_detail() {
		if($this->session->userdata('id_role') <= 5) {
			$id_gudang = $this->session->userdata("id_gudang");
			$required = array('qty','batch','id_product');
			$error = false;
			foreach($required as $field) {
				if(empty($_POST[$field])) {
					$error = true;
				}
			}
			$tipe = $this->input->post("tipe");	

			$where['id_keluardetail'] = $this->input->post('id_keluardetail');

			$in['id_product'] 	= $this->input->post('id_product');
			$in['qty'] 	= $this->input->post('qty');
			$in['batch'] 	= $this->input->post('batch');
			$in['harga'] 	= $this->input->post('harga');
			$in['id_keluarmaster'] = $this->input->post('id_keluarmaster');

			$cek_product = $this->db->query("SELECT * FROM keluar_detail WHERE id_product='$in[id_product]' AND batch = '$in[batch]' AND id_keluarmaster = '$in[id_keluarmaster]'");

			$cek_product_ada = $this->db->query("SELECT * FROM transfer_detail WHERE id_product='$in[id_product]' AND batch = '$in[batch]'");

			$get_nomor = $this->db->query("SELECT nomor FROM keluar_master WHERE id_keluarmaster='$in[id_keluarmaster]'")->row();

			if($tipe == "add") {			
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("penjualan/index/".$this->input->post('id_keluarmaster'));
				} else if($cek_product->num_rows() > 0) {

					$session_input['id_product'] = $in['id_product'];
					$session_input['batch'] = $in['batch'];
					$session_input['id_keluarmaster'] = $in['id_keluarmaster'];
					$session_input['harga'] = $in['harga'];
					$session_input['qty'] = $in['qty'];
					$session_input['error_duplicate'] = TRUE;
					$this->session->set_userdata($session_input);

					echo '<script>
								alert("Product & Batch sudah ada");
								document.location.href="index/'.$this->input->post('id_keluarmaster').'";
							</script>';


				} else if($cek_product_ada->num_rows() <= 0) {
					$this->session->set_flashdata("error","Product & Batch belum di transfer");
					redirect("penjualan/index/".$this->input->post('id_keluarmaster'));
				}  else {
					$this->db->insert("keluar_detail",$in);


					$log['id_user'] = $this->session->userdata("id_user");
					$log['aksi'] = 'tambah';
					$log['id_gudang'] = $this->session->userdata("id_gudang");
					$log['keterangan'] = 'Menambah produk penjualan pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
					$log['tanggal'] = date('Y-m-d h:i');
					$this->db->insert("log_transaksi",$log);

					$this->session->set_flashdata("success","Input penjualan Detail Berhasil");
					redirect("penjualan/index/".$this->input->post('id_keluarmaster'));
				}
				
				
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("penjualan/index/".$this->input->post('id_keluarmaster'));	
				} else {
					$log['id_user'] = $this->session->userdata("id_user");
					$log['aksi'] = 'ubah';
					$log['id_gudang'] = $this->session->userdata("id_gudang");
					$log['keterangan'] = 'Mengubah produk penjualan pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
					$log['tanggal'] = date('Y-m-d h:i');
					$this->db->insert("log_transaksi",$log);

					$this->db->update("keluar_detail",$in,$where);
					$this->session->set_flashdata("success","Edit penjualan Detail Berhasil");
					redirect("penjualan/index/".$this->input->post('id_keluarmaster'));			
				}		
			} else {
				redirect("penjualan");
			}
		} else {
			redirect("login");
		}
	}


	public function hapus($id) {
		if($this->session->userdata('id_role') <= 5 && $id != null) {
			
			$this->db->delete("report_daily_visit",array('id_report_daily' => $id));	

			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("penjualan");			
		} else {
			redirect("login");
		}
	}

	public function hapus_detail() {
		if($this->session->userdata('id_role') <= 5) {
		

			$id = $this->input->post("id_keluardetail");
			$idm = $this->input->post("id_keluarmaster");

			$get_nomor = $this->db->query("SELECT nomor FROM keluar_master WHERE id_keluarmaster='$idm'")->row();

			$log['id_user'] = $this->session->userdata("id_user");
			$log['aksi'] = 'hapus';
			$log['id_gudang'] = $this->session->userdata("id_gudang");
			$log['keterangan'] = 'Menghapus produk penjualan pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
			$log['tanggal'] = date('Y-m-d h:i');
			$this->db->insert("log_transaksi",$log);
			
			$this->db->delete("keluar_detail",array('id_keluardetail' => $id));		

			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("penjualan/index/".$idm);		
		} else {
			redirect("login");
		}
	}

	public function cekDouble() {
		$id_product = $this->input->post("product");
		$batch = $this->input->post("batch");
		$id_keluarmaster = $this->input->post("id_keluarmaster");

		$cek_product = $this->db->query("SELECT * FROM keluar_detail WHERE id_product='$id_product' AND batch = '$batch' AND id_keluarmaster = '$id_keluarmaster'");

		if($cek_product->num_rows() > 0) {
			echo 'true';
		} 
	}

	public function ambil_batch() {
		$id_product = $this->input->post("product");
		$q = $this->db->query("SELECT * FROM transfer_detail WHERE id_product = '$id_product' GROUP BY batch ORDER BY batch DESC");
		if($q->num_rows() > 0) {
			foreach($q->result_array() as $item) {
				echo '<option value="'.$item['batch'].'">'.$item['batch'].'</option>';
			}
		}	
	}




}
