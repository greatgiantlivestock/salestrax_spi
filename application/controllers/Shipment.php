<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Shipment extends CI_Controller {

	public function index() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {

			$d['q_tarik_data'] = $this->App_model->get_order_list_data_shipment();

			$d['qCount'] = $this->App_model->get_order_list_data_count_shipment();

			$d['qCount1'] = $this->App_model->get_order_list_data_count_shipment1();

			$d['qCount2'] = $this->App_model->get_order_list_data_count_shipment2();

			$d['judul'] = 'Shipment Status';		

			$d['tipe'] = "edit";		

			$d['combo_status_kirim'] = $this->App_model->get_combo_status_kirim_id();

			$d['combo_shipping_point'] = $this->App_model->get_combo_shipping_point_id();

			$this->load->view('top',$d);

			$this->load->view('menu');

			$this->load->view('shipment/shipment_tabel.php');

			$this->load->view('bottom');

		}

		else {

			redirect("login");

		}

	}



	public function save() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {

			if($this->session->userdata("id_role")==6){

				$required = array('id_request','id_shipping','tanggal_shipping','tipe','id_status_kirim','id_jenis_transaksi','tanggal_kirim');

				$error = false;

				foreach($required as $field) {

					if(empty($_POST[$field])) {

						$error = true;

					}

				}

				$tipe = $this->input->post("tipe");	

				$where['id_request'] = $this->input->post('id_request');

				$where['id_jenis_transaksi'] = $this->input->post('id_jenis_transaksi');



				$in['tanggal_shipping'] 	= $this->input->post('tanggal_shipping');

				$in['id_status_kirim'] 	= $this->input->post('id_status_kirim');

				$in['no_do'] 	= $this->input->post('no_do');

				$in['keterangan_do'] 	= $this->input->post('keterangan_do');



				if($tipe == 'edit') {

					if($error) {

						$this->session->set_flashdata("error","Inputkan kolom dengan lengkap");

						redirect("Shipment");	

					} else {

						if($this->input->post('id_status_kirim')==5){
							$date = $this->input->post('tanggal_kirim');
							$date1 = strtotime($date);
							$dateplus = strtotime("+1 day", $date1);
							$dateNew = date('Y-m-d',$dateplus);

							$inRs['tanggal_kirim'] 	= $dateNew;
							$whereRs['id_request'] = $this->input->post('id_request');
							$this->db->update("trx_so_header",$inRs,$whereRs);
						}


						$this->db->update("shipping",$in,$where);



						$this->session->set_flashdata("success","Shipment Status Updated");

						redirect("Shipment");

					}		

				} else {

					redirect("error");

				}

			}else{

				$required = array('id_request','id_shipping','tanggal_shipping','tipe','id_status_kirim','id_shipping_point','id_detail_request','id_jenis_transaksi','tanggal_kirim');

				$error = false;

				foreach($required as $field) {

					if(empty($_POST[$field])) {

						$error = true;

					}

				}

				$tipe = $this->input->post("tipe");	



				if($tipe == 'edit') {

					if($error) {

						$this->session->set_flashdata("error","Inputkan kolom dengan lengkap");

						redirect("Shipment");	

					} else {

						if($this->input->post('id_status_kirim')==4){							

							if($this->input->post('id_jenis_transaksi')==1 || $this->input->post('id_jenis_transaksi')==2){

								$id_request = $this->input->post("id_request");

								$id_jenis_transaksi = $this->input->post("id_jenis_transaksi");

								$id_shipping_point = $this->input->post("id_shipping_point");

								$qValidate = $this->db->query("select shipping.* from trx_shipping join trx_so_detail on trx_shipping.id_detail_request=

														trx_so_detail.id_detail_request where trx_shipping.id_request= '$id_request' and 

														id_jenis_transaksi='$id_jenis_transaksi'")->row(); 

								if($qValidate->id_status_kirim == 1 || $qValidate->id_status_kirim == 3){

									$id_request_ = $this->input->post('id_request');

									$id_jenis_transaksi_ = $this->input->post('id_jenis_transaksi');

									$q_getDetail = $this->db->query("SELECT trx_so_header.id_customer_ship,trx_so_header.id_request,id_product,qty FROM trx_so_header JOIN trx_so_detail 

																	ON trx_so_header.id_request = trx_so_detail.id_request WHERE trx_so_header.id_request ='$id_request_' AND id_jenis_transaksi='$id_jenis_transaksi_'");

									foreach($q_getDetail->result_array() as $data_in){

										$id_cst = $data_in['id_customer_ship'];

										$id_prd = $data_in['id_product'];

										$maxQty = $this->db->query("SELECT stock_customer.* FROM(SELECT MAX(id_stock) AS id_stock FROM stock_customer 

																	WHERE id_customer = '$id_cst' AND id_product= '$id_prd') AS dataMax JOIN stock_customer 

																	ON dataMax.id_stock = stock_customer.id_stock")->row();

										$mx = $maxQty->qty;							

										$inStock['id_customer'] = $data_in['id_customer_ship'];

										$inStock['id_product'] 	= $data_in['id_product'];

										if($mx == ''){

											$inStock['qty'] = $data_in['qty'];

										}else{

											$inStock['qty'] = $data_in['qty']+$mx;

										}

										$inStock['id_request'] = $data_in['id_request'];

										$inStock['tanggal_update'] 	= date('Y-m-d H:i:s');



										$this->db->insert("stock_customer",$inStock);

									}	

								}



								$qShp =  $this->db->query("SELECT shipping.* FROM trx_shipping JOIN trx_so_detail ON trx_shipping.id_detail_request=trx_so_detail.id_detail_request 

														WHERE trx_shipping.id_request= '$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

								foreach($qShp->result_array() as $dataShp){

									$in['tanggal_shipping'] 	= $this->input->post('tanggal_shipping');

									$in['id_status_kirim'] 	= $this->input->post('id_status_kirim');

									$in['no_do'] 	= $this->input->post('no_do');

									$in['keterangan_do'] 	= $this->input->post('keterangan_do');

									$where['id_shipping'] = $dataShp['id_shipping'];

									$this->db->update("shipping",$in,$where);

								}



								$qDt =  $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

								foreach($qDt->result_array() as $dataDt){

									$in1['id_shipping_point'] 	= $this->input->post('id_shipping_point');

									$where1['id_detail_request'] = $dataDt['id_detail_request'];

									$this->db->update("trx_so_detail",$in1,$where1);

								}



								$this->session->set_flashdata("success","Shipment Status Updated");

								redirect("Shipment");	

							}else{

								$id_request = $this->input->post("id_request");

								$id_jenis_transaksi = $this->input->post("id_jenis_transaksi");

								$id_shipping_point = $this->input->post("id_shipping_point");

								$qShp =  $this->db->query("SELECT shipping.* FROM trx_shipping JOIN trx_so_detail ON trx_shipping.id_detail_request=trx_so_detail.id_detail_request 

														WHERE trx_shipping.id_request= '$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

								foreach($qShp->result_array() as $dataShp){

									$in['tanggal_shipping'] 	= $this->input->post('tanggal_shipping');

									$in['id_status_kirim'] 	= $this->input->post('id_status_kirim');

									$in['no_do'] 	= $this->input->post('no_do');

									$in['keterangan_do'] 	= $this->input->post('keterangan_do');

									$where['id_shipping'] = $dataShp['id_shipping'];

									$this->db->update("shipping",$in,$where);

								}



								$qDt =  $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

								foreach($qDt->result_array() as $dataDt){

									$in1['id_shipping_point'] 	= $this->input->post('id_shipping_point');

									$where1['id_detail_request'] = $dataDt['id_detail_request'];

									$this->db->update("trx_so_detail",$in1,$where1);

								}



								$this->session->set_flashdata("success","Shipment Status Updated");

								redirect("Shipment");

							}

						}else{

							if($this->input->post('id_status_kirim')==5){
								$date = $this->input->post('tanggal_kirim');
								$date1 = strtotime($date);
								$dateplus = strtotime("+1 day", $date1);
								$dateNew = date('Y-m-d',$dateplus);
	
								$inRs['tanggal_kirim'] 	= $dateNew;
								$whereRs['id_request'] = $this->input->post('id_request');
								$this->db->update("trx_so_header",$inRs,$whereRs);
							}

							$id_request = $this->input->post("id_request");

							$id_jenis_transaksi = $this->input->post("id_jenis_transaksi");

							$id_shipping_point = $this->input->post("id_shipping_point");

							$qShp =  $this->db->query("SELECT shipping.* FROM trx_shipping JOIN trx_so_detail ON trx_shipping.id_detail_request=trx_so_detail.id_detail_request 

													WHERE trx_shipping.id_request= '$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

							foreach($qShp->result_array() as $dataShp){

								$in['tanggal_shipping'] 	= $this->input->post('tanggal_shipping');

								$in['id_status_kirim'] 	= $this->input->post('id_status_kirim');

								$in['no_do'] 	= $this->input->post('no_do');

								$in['keterangan_do'] 	= $this->input->post('keterangan_do');

								$where['id_shipping'] = $dataShp['id_shipping'];

								$this->db->update("shipping",$in,$where);

							}



							$qDt =  $this->db->query("SELECT * FROM trx_so_detail WHERE id_request='$id_request' AND id_jenis_transaksi='$id_jenis_transaksi' AND id_shipping_point='$id_shipping_point'");

							foreach($qDt->result_array() as $dataDt){

								$in1['id_shipping_point'] 	= $this->input->post('id_shipping_point');

								$where1['id_detail_request'] = $dataDt['id_detail_request'];

								$this->db->update("trx_so_detail",$in1,$where1);

							}



							$this->session->set_flashdata("success","Shipment Status Updated");

							redirect("Shipment");

						}

					}		

				} else {

					redirect("error");

				}

			}

		} else {

			redirect("login");

		}

	}



	public function get_row($id) {

		$row = $this->db->query("SELECT nama_product, id_detail_request,qty,qty_rev FROM trx_so_detail JOIN trx_so_header 

		ON trx_so_detail.id_request = trx_so_header.id_request JOIN mst_product 

		ON trx_so_detail.id_product = mst_product.id_product WHERE no_request='$id'"); // get the row by querying from your database & further process

		

		$d['detail_order'] = $row;

		$d['judul'] = "Detail Order";

		// $d['combo_shipping_point_user'] = $this->App_model->get_combo_shipping_point_user();

		

		$this->load->view('shipment/detail.php',$d);

		$this->load->view('bottom');

	}



	public function hapus() {

		if($this->session->userdata('id_role') == "1" || $this->session->userdata('id_role') == "4" || $this->session->userdata('id_role') == "6") {

			$id=$this->input->post('id_product');

			$this->db->delete("mst_product",array('id_product' => $id));			

			$this->session->set_flashdata("success","Hapus Master Product Berhasil");

			redirect("Shipment");			

		} else {

			redirect("login");

		}

	}





}

