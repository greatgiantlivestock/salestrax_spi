		<script src="<?php echo base_url();?>asset/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url();?>asset/js/select2.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
			  <?php $q = $this->db->query("SELECT nilai,id_request FROM sess_tmp WHERE id='1'")->row(); ?>
			  <?php $q1 = $this->db->query("SELECT kode_customer FROM sess_tmp WHERE id='2'")->row(); ?>
			//   $(".select_rph").select2();
			//   $(".select_barang").select2();
			//   $(".select_karyawan").select2();
			//   $(".select_kegiatan").select2();
			  $(".select_customer").select2();
			  $(".select_customer1").select2();
			  $(".select_customer2").select2();
			  $(".select_customer3").select2();
			  $(".select_customer4").select2();
			  $(".select_customer5").select2();
			//   $(".select2").select2();
			  $(".modal-body #tgl3").val('<?php echo $q->nilai; ?>');
			  $(".modal-body #id_request_ol").val('<?php echo $q->id_request; ?>');
			  $(".modal-body #tipe").val('edit');
			  $(".modal-bodya #kode_customer").val('<?php echo $q1->kode_customer; ?>');
			  $(".modal-bodya #tipe").val('add');
			});
			$(document).on("click", "#openModalEditDetail", function () {
				     var id_request = $(this).data('id_request');
				     var id_detail_request = $(this).data('id_detail_request');
				     var tipe = $(this).data('tipe');
				     var id_product = $(this).data('id_product');
				     var keterangan = $(this).data('keterangan');
				     var qty = $(this).data('qty');
				     $(".modal-body #id_request11").val( id_request );
				     $(".modal-body #id_detail_request11").val( id_detail_request );
				     $(".modal-body #qty11").val( qty );
				     $(".modal-body #tipe11").val( tipe );
					 $(".modal-body #product11").val(id_product).trigger('change');
				     $(".modal-body #keterangan11").val(keterangan).trigger('change');
				});
			$(document).on("click", "#openModalAddDetail1", function () {
				     var id_request = $(this).data('id_request');
				     var tipe = $(this).data('tipe');
				     $(".modal-body #id_request12").val( id_request );
				     $(".modal-body #tipe12").val( tipe );
				});
		</script>
		<!-- <script type="text/javascript">
			$(document).ready(function() {
			  <?php $q1 = $this->db->query("SELECT kode_customer FROM sess_tmp WHERE id='2'")->row(); ?>
			  $(".modal-bodya #kode_customer112").val('<?php echo $q1->kode_customer; ?>');
			  $(".modal-bodya #tipe").val('add');
			});
		</script> -->
		<script type="text/javascript">
		    $(function () {
		      $('#tgl').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })
		      $('#tgl2').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })		        
		      $('#tgl3').datetimepicker({
		        format: 'YYYY-MM-DD'
		      })		        
		    });
  		</script>
			<script type="text/javascript">
				$(document).on("click", "#openModalEditShipping13", function () {
				    //  var id_status_kirim = $(this).data('id_status_kirim');
				    //  var kode_customer = $(this).data('kode_customer');
				    //  var tipe = $(this).data('tipe');
				    //  var id_shipping = $(this).data('id_shipping');
				    //  var id_detail_request = $(this).data('id_detail_request');
				    //  var id_request = $(this).data('id_request');
				    //  var id_shipping_point = $(this).data('id_shipping_point');
				    //  var tanggal_shipping = $(this).data('tanggal_shipping');
				    //  var tanggal_mulai = $(this).data('tanggal_mulai');
				    //  var tanggal_sampai = $(this).data('tanggal_sampai');
				    //  var kode_shipping_point = $(this).data('kode_shipping_point');
				    //  var nama_status_kirim = $(this).data('nama_status_kirim');
				    //  var pers_numb1 = $(this).data('pers_numb1');
				    //  var cust_ship = $(this).data('cust_ship');
				//      $(".modal-body #id_status_kirim").val(id_status_kirim).trigger('change');
				// 	 $(".modal-body #tipe").val(tipe);
				//      $(".modal-body #id_shipping").val(id_shipping);
				//      $(".modal-body #id_detail_request").val(id_detail_request);
				//      $(".modal-body #id_request_ol").val(id_request);
				    //  $(".modal-body #tgl3").val(tanggal_shipping);
				    //  $(".modal-body #tanggal_mulai1").val(tanggal_mulai);
				    //  $(".modal-body #tanggal_sampai1").val(tanggal_sampai);
				    //  $(".modal-body #kode_shipping_point1").val(kode_shipping_point);
				    //  $(".modal-body #nama_status_kirim1").val(nama_status_kirim);
				    //  $(".modal-body #id_shipping_point").val(id_shipping_point).trigger('change');
				    //  $(".modal-body #pers_numb1").val(pers_numb1).trigger('change');
				    //  $(".modal-body #cust_ship").val(cust_ship);
				});
			</script>
	</body>
</html> 