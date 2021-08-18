<!-- <script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js')?>"></script>
<script src="<?php echo base_url('vendor/jquery/jquery-1.11.3.min.js')?>"></script> -->
<script>
    var my_time;
    $(document).ready(function() {
      setTimeout(function() {
      }, 200);
      pageScroll();
      $("#contain").mouseover(function() {
        clearTimeout(my_time);
      }).mouseout(function() {
        pageScroll();
      });
    });
    function pageScroll() {
      var objDiv = document.getElementById("contain");
      objDiv.scrollTop = objDiv.scrollTop + 1;
      $('p:nth-of-type(1)').html('scrollTop : ' + objDiv.scrollTop);
      $('p:nth-of-type(2)').html('scrollHeight : ' + objDiv.scrollHeight);
      if (objDiv.scrollTop == (objDiv.scrollHeight - 561)) {
        objDiv.scrollTop = -100;
      }
      my_time = setTimeout('pageScroll()', 100);
    }
</script>
<style>
  body {
    font-family: 'helvetica';
  }
  #contain {
    height: 83vh;
    overflow-y: hidden;
  }
  #contain1 {
    height: 4vh;
    overflow-y: hidden;
  }
  /* #table_scroll {
    width: 100%;
    margin-top: 100px;
    margin-bottom: 100px;
    border-collapse: collapse;
  }
  #table_scroll thead th {
    padding: 10px;
    background-color: #ea922c;
    color: #fff;
  }
  #table_scroll tbody td {
    padding: 10px;
    background-color: #ed3a86;
    color: #fff;
  } */
</style>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
          "dom":'<"toolbar">frtip',
          // scrollY:        '80vh',
          // scrollCollapse: true,
          bAutoWidth: false , 
          responsive: true,
          bPaginate: false,
          bLengthChange: false,
          bFilter: true,
          bInfo: false,
          order: [[ 0, "asc" ]]
        });
        $('#dataTables1').DataTable({
          "dom":'<"toolbar">frtip',
          // scrollY:        '4vh',
          // scrollCollapse: true,
          bAutoWidth: false , 
          responsive: true,
          bPaginate: false,
          bLengthChange: false,
          bFilter: true,
          bInfo: false,
          order: [[ 0, "asc" ]]
        });
    });
</script>
<?php
  $sec = "200";
?>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo base_url(); ?>Dashboard'">
<div class="col-md-12">              
  <div class="widget-box">
    <div class="widget-body">
      <div class="widget-main"> 
      <div class="row" >
        <div class="col-md-12" id="contain1" >
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1" data-page-length='100'>
          <thead>
            <tr>
              <th style="width: 10%">No</th>
              <th style="width: 10%">Sales</th>
              <th style="width: 10%">Wilayah</th>
              <th style="width: 20%">Ship to Party</th>
              <th style="width: 10%">Tanggal Request</th>
              <th style="width: 10%">Rencana Kirim</th>
              <th style="width: 10%">Realisasi Kirim</th>
              <th style="width: 10%">Jenis</th>
              <th style="width: 10%">Status Kirim</th>
            </tr>
          </thead>
        </table>
        </div>
        <div class="col-md-12" id="contain" >
          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" data-page-length='100'>
            <tbody>
              <?php
                $no=1;
                foreach($dataCall->result_array() as $data){?>
                <tr>
                  <td style="width: 10%"> <?php echo $no;?></td>
                  <td style="width: 10%"> <?php echo $data['nama'];?></td>
                  <td style="width: 10%"> <?php echo $data['nama_wilayah'];?></td>
                  <td style="width: 20%"> <?php echo $data['cust_ship'];?></td>
                  <td style="width: 10%"> <?php echo $data['tanggal_request'];?></td>
                  <td style="width: 10%"> <?php echo $data['tanggal_kirim'];?></td>
                  <td style="width: 10%"> <?php echo $data['tanggal_shipping'];?></td>
                  <td style="width: 10%"> <?php echo $data['nama_transaksi'];?></td>
                  <td style="width: 10%"> <?php echo $data['nama_status_kirim'];?></td>
                </tr>
              <?php 
              $no++;
              }?>
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>