<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_visit extends CI_Controller {

	public function index($id="") {
		if($this->session->userdata('id_role') <= 2) {
			if($id != ""){
				$d['judul'] = "Report Daily Visit";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
				$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
				$d['nama_karyawan'] = $this->input->post("nama_karyawan");
				$d['karyawan'] = $this->input->post();
				$d['combo_user'] = $this->App_model->get_combo_user($this->input->post());
				$d['color'] = '';
				$d['disable'] = '';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
			}else{
				$d['judul'] = "Report Daily Visit";
				$d['tipe'] = "add";
				$d['tanggal_mulai'] = "";		
				$d['tanggal_sampai'] = "";
				$d['nama_karyawan'] = "";
				$d['karyawan'] = "";
				$d['combo_user'] = $this->App_model->get_combo_user();
				$d['color'] = '';
				$d['disable'] = 'disabled';
				$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
			}
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "Report Daily Visit";
			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['color'] = '';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';

			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "Report Daily Visit";

			$d['tipe'] = "add";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
			$d['color'] = '';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
			
			//$d['combo_product'] = $this->App_model->get_combo_product();	
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}

	public function lihat_report() {
		if($this->session->userdata('id_role') <= 2) {
			$d['judul'] = "Report Daily Visit";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user($this->input->post("nama_karyawan"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
				
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');

		}else if($this->session->userdata('id_role') == '3' || $this->session->userdata('id_role') == '4') {
			$d['judul'] = "Report Daily Visit";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_per_departemen($this->input->post("nama_karyawan"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');
		}else if($this->session->userdata('id_role') == '5') {
			$d['judul'] = "Report Daily Visit";
			$d['tipe'] = "edit";
			$d['tanggal_mulai'] = $this->input->post("tanggal_mulai");		
			$d['tanggal_sampai'] = $this->input->post("tanggal_sampai");
			$d['nama_karyawan'] = $this->input->post("nama_karyawan");
			$d['combo_user'] = $this->App_model->get_combo_user_sesuai_login($this->session->userdata("id_user"));
			$d['color'] = 'style="background:#ffffe1;"';
			$d['disable'] = '';
			$d['btn_nota'] = '<button class="btn btn-xs btn-primary"><i class="fa fa-plus"> </i> Lihat Report</button>';
			
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('report_visit/visit_table');
			$this->load->view('bottom');
		}else {
			redirect("login");
		}	
	}	

	public function post_lunas($id) {
		if($id != "") {
			$tgl_lunas = date('Y-m-d');
			$this->db->query("UPDATE keluar_master SET tgl_lunas = '$tgl_lunas' WHERE id_keluarmaster = '$id'");
			redirect("report_visit/index/".$id);
		} else {
			redirect("404");
		}
	}

	public function cetak($tanggal_mulai="",$tanggal_sampai="",$nama_karyawan="") {
		if($this->session->userdata('id_role') <= 4 || $id != "") {
			$karyawan=str_replace("%20"," ",$nama_karyawan);
			ob_start();
		    $d['tanggal'] = $tanggal_mulai;
		    $d['tanggal1'] = $tanggal_sampai;
			$d['nama_karyawan'] = $karyawan;
		    $d['jual_detail'] = $this->App_model->get_daily_visit($tanggal_mulai,$tanggal_sampai,$karyawan);

			$this->load->view('report/report_daily_visit', $d);
		    $html = ob_get_contents();
		    ob_end_clean();
		        
		    require_once('./asset/html2pdf/html2pdf.class.php');
		    $pdf = new HTML2PDF('P','A4','en');
		    $pdf->WriteHTML($html);
		    $pdf->Output('Data Invoice.pdf', 'F');
		    header("Content-type:application/pdf");
			echo file_get_contents("Data Invoice.pdf"); 
		}else if($this->session->userdata('id_role') == 5 || $id != "") {
			$karyawan=$this->session->userdata('nama');
			ob_start();
		    $d['tanggal'] = $tanggal_mulai;
		    $d['tanggal1'] = $tanggal_sampai;
			$d['nama_karyawan'] = $karyawan;
		    $d['jual_detail'] = $this->App_model->get_daily_visit($tanggal_mulai,$tanggal_sampai,$karyawan);

			$this->load->view('report/report_daily_visit', $d);
		    $html = ob_get_contents();
		    ob_end_clean();
		        
		    require_once('./asset/html2pdf/html2pdf.class.php');
		    $pdf = new HTML2PDF('P','A4','en');
		    $pdf->WriteHTML($html);
		    $pdf->Output('Data Invoice.pdf', 'F');
		    header("Content-type:application/pdf");
			echo file_get_contents("Data Invoice.pdf"); 
		}else {
			redirect("error");
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
					redirect("report_visit");	
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
					  /*
					  if($total_print==1){
						$this->session->set_flashdata("error","Anda sudah pernah mencetak laporan atas nama ".$user_rep." pada tanggal ".$tanggal_rep);
						redirect("report_visit");
					  }else{
						  */
						$in['banyak_print'] = $total_print + 1;
						$this->db->insert("report_daily_visit",$in);
						$last_id = $this->db->insert_id();
	
						//$log['id_user'] = $this->session->userdata("id_user");
						//$log['aksi'] = 'tambah';
						//$log['id_gudang'] = $this->session->userdata("id_gudang");
						//$log['keterangan'] = 'Menambah header report_visit dengan nomor '.'<b>'.$in['nomor'].'</b>';
						//$log['tanggal'] = date('Y-m-d h:i');
						//$this->db->insert("log_transaksi",$log);
	
						$this->session->set_flashdata("success","Input report Berhasil");
						redirect("report_visit/index/".$last_id);
					  //}
				}
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Mohon input data dengan lengkap");
					redirect("report_visit");	
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
					  /*
					  if($total_print==1){
						$this->session->set_flashdata("error","Anda sudah pernah mencetak laporan atas nama ".$user_rep." pada tanggal ".$tanggal_rep);
						redirect("report_visit");
					  }else{
						  */
						$in['banyak_print'] = $total_print + 1;
						$this->db->insert("report_daily_visit",$in);
						$last_id = $this->db->insert_id();
	
						//$log['id_user'] = $this->session->userdata("id_user");
						//$log['aksi'] = 'tambah';
						//$log['id_gudang'] = $this->session->userdata("id_gudang");
						//$log['keterangan'] = 'Menambah header report_visit dengan nomor '.'<b>'.$in['nomor'].'</b>';
						//$log['tanggal'] = date('Y-m-d h:i');
						//$this->db->insert("log_transaksi",$log);
	
						$this->session->set_flashdata("success","Input report Berhasil");
						redirect("report_visit/index/".$last_id);
					  //}
				}		
			} else {
				redirect("report_visit");
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


			/*
			$id_product = $this->input->post('id_product');
			$batch = $this->input->post('batch');

			$cek_qty = $this->db->query("SELECT SUM(CASE WHEN transfer_master.jenis_transfer='IN' THEN qty ELSE 0 END) AS stok_in, SUM(CASE WHEN transfer_master.jenis_transfer='OUT' THEN qty ELSE 0 END) AS stok_out
			FROM transfer_detail 
			LEFT JOIN transfer_master ON transfer_master.id_transfermaster = transfer_detail.id_transfermaster 
			LEFT JOIN mst_product ON transfer_detail.id_product = mst_product.id_product WHERE transfer_master.id_gudang = '$id_gudang' AND mst_product.id_product = '$id_product' AND transfer_detail.batch = '$batch'")->row();

			$cek_qty_jual = $this->db->query("SELECT SUM(CASE WHEN jenis_keluar='OUT' THEN qty ELSE 0 END) as stok_jual FROM keluar_detail LEFT JOIN keluar_master ON keluar_master.id_keluarmaster = keluar_detail.id_keluarmaster WHERE keluar_detail.id_product = '$id_product' AND keluar_detail.batch = '$batch' AND keluar_master.id_gudang = '$id_gudang'")->row();
			
			$stok = $cek_qty->stok_in - $cek_qty->stok_out - $cek_qty_jual->stok_jual ;
			*/

			$cek_product = $this->db->query("SELECT * FROM keluar_detail WHERE id_product='$in[id_product]' AND batch = '$in[batch]' AND id_keluarmaster = '$in[id_keluarmaster]'");

			$cek_product_ada = $this->db->query("SELECT * FROM transfer_detail WHERE id_product='$in[id_product]' AND batch = '$in[batch]'");

			$get_nomor = $this->db->query("SELECT nomor FROM keluar_master WHERE id_keluarmaster='$in[id_keluarmaster]'")->row();

			if($tipe == "add") {			
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("report_visit/index/".$this->input->post('id_keluarmaster'));
				} else if($cek_product->num_rows() > 0) {

					$session_input['id_product'] = $in['id_product'];
					$session_input['batch'] = $in['batch'];
					$session_input['id_keluarmaster'] = $in['id_keluarmaster'];
					$session_input['harga'] = $in['harga'];
					$session_input['qty'] = $in['qty'];
					$session_input['error_duplicate'] = TRUE;
					$this->session->set_userdata($session_input);

					//$this->session->set_flashdata("error","Product & Batch sudah ada");
					//redirect("report_visit/index/".$this->input->post('id_keluarmaster'));
					echo '<script>
								alert("Product & Batch sudah ada");
								document.location.href="index/'.$this->input->post('id_keluarmaster').'";
							</script>';


				} else if($cek_product_ada->num_rows() <= 0) {
					$this->session->set_flashdata("error","Product & Batch belum di transfer");
					redirect("report_visit/index/".$this->input->post('id_keluarmaster'));
				}  else {
					$this->db->insert("keluar_detail",$in);


					$log['id_user'] = $this->session->userdata("id_user");
					$log['aksi'] = 'tambah';
					$log['id_gudang'] = $this->session->userdata("id_gudang");
					$log['keterangan'] = 'Menambah produk report_visit pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
					$log['tanggal'] = date('Y-m-d h:i');
					$this->db->insert("log_transaksi",$log);

					$this->session->set_flashdata("success","Input report_visit Detail Berhasil");
					redirect("report_visit/index/".$this->input->post('id_keluarmaster'));
				}
				
				
			} else if($tipe = 'edit') {
				if($error) {
					$this->session->set_flashdata("error","Inputan tidak boleh kosong");
					redirect("report_visit/index/".$this->input->post('id_keluarmaster'));	
				} else {
					$log['id_user'] = $this->session->userdata("id_user");
					$log['aksi'] = 'ubah';
					$log['id_gudang'] = $this->session->userdata("id_gudang");
					$log['keterangan'] = 'Mengubah produk report_visit pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
					$log['tanggal'] = date('Y-m-d h:i');
					$this->db->insert("log_transaksi",$log);

					$this->db->update("keluar_detail",$in,$where);
					$this->session->set_flashdata("success","Edit report_visit Detail Berhasil");
					redirect("report_visit/index/".$this->input->post('id_keluarmaster'));			
				}		
			} else {
				redirect("report_visit");
			}
		} else {
			redirect("login");
		}
	}


	public function hapus($id) {
		if($this->session->userdata('id_role') <= 5 && $id != null) {
			
			//$get_nomor = $this->db->query("SELECT nomor FROM keluar_master WHERE id_keluarmaster='$id'")->row();

			//$log['id_user'] = $this->session->userdata("id_user");
			//$log['aksi'] = 'hapus';
			//$log['id_gudang'] = $this->session->userdata("id_gudang");
			//$log['keterangan'] = 'Menghapus header report_visit dengan nomor '.'<b>'.$get_nomor->nomor.'</b>';
			//$log['tanggal'] = date('Y-m-d h:i');
			//$this->db->insert("log_transaksi",$log);

			$this->db->delete("report_daily_visit",array('id_report_daily' => $id));	
			//$this->db->delete("keluar_detail",array('id_keluarmaster' => $id));				

			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("report_visit");			
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
			$log['keterangan'] = 'Menghapus produk report_visit pada nomor  '.'<b>'.$get_nomor->nomor.'</b>';
			$log['tanggal'] = date('Y-m-d h:i');
			$this->db->insert("log_transaksi",$log);
			
			$this->db->delete("keluar_detail",array('id_keluardetail' => $id));		

			$this->session->set_flashdata("success","Hapus Data Berhasil");
			redirect("report_visit/index/".$idm);		
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
