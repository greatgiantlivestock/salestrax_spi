<html> 
	<body>
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<!-- <script src="<?php echo base_url();?>asset/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url();?>asset/js/ace/ace.searchbox-autocomplete.js"></script> -->
		<script src="<?php echo base_url();?>asset/js/select2.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
			  $(".select_rph").select2();
			  $(".select_barang").select2();
			  $(".select_karyawan").select2();
			  $(".select_kegiatan").select2();
			  $(".select_customer").select2();
			  $(".select2").select2();
			});
		</script>
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

			$(document).on("click", "#openModalAddCustomer", function () {
				     var id_customer = $(this).data('id_customer');
				     var tipe = $(this).data('tipe');
				     var kode_customer = $(this).data('kode_customer');
				     var nama_customer = $(this).data('nama_customer');
				     var wilayah = $(this).data('wilayah');
				     var alamat = $(this).data('alamat');
				     var status_customer = $(this).data('status_customer');
				     var mst_shipping_point = $(this).data('shipping_point');
				     $(".modal-body #kode_customer12").val( kode_customer );
				     $(".modal-body #nama_customer12").val( nama_customer );
				     $(".modal-body #wilayah12").val(wilayah).trigger('change');
				     $(".modal-body #alamat12").val(alamat).trigger('change');
				     $(".modal-body #status_customer12").val(status_customer).trigger('change');
				     $(".modal-body #shipping_point2").val(shipping_point).trigger('change');
				     $(".modal-body #id_customer12").val(id_customer).trigger('change');
				     $(".modal-body #tipe12").val(tipe).trigger('change');
				});
  		</script>
  		
	</body>
</html> 