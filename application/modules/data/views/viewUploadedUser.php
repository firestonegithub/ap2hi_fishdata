

   
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> View Upload User Waktu </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  View Upload User Waktu </div>
        <div class="card-body">
          
        
        <table id="manageListTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> k_landing </th>
                <th> namafile </th>
                <th> thn_sampling </th>
                <th> bln_sampling  </th>
                <th> tgl_sampling </th>
                <th> nama_kapal </th>
                <th> kapten_kapal </th>
                <th> Delete </th>
            </tr>
        </thead>

         <tfoot>
            <tr>
               <th> No. </th>
                <th> k_landing </th>
                <th> namafile </th>
                <th> thn_sampling </th>
                <th> bln_sampling  </th>
                <th> tgl_sampling </th>
                <th> nama_kapal </th>
                <th> kapten_kapal </th>
                <th> Delete </th>
            </tr>
         </tfoot>
        
        </table>

      </div>
    </div> 
  </div>



  <!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="disableListModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Data Disable</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="disable-messages"></div>
          <p>Do you really want to disable ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="hapusBtn">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->


<script>

$(document).ready(function() {
    
   manageListTable = $("#manageListTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
    "scrollX": true
    });


  } );



function disableData(id = null) {
   
   if(id) {
      
      $("#hapusBtn").unbind('click').bind('click', function() {


          $.ajax({
                url: '<?php echo $url_disable_list; ?>',
                type: 'post',
                data: { id : id },
                dataType: 'json',
                success:function(response) {
                  console.log(response);
                     if (response.success == true) {       
                        $(".disable-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
                    
                    manageListTable.ajax.reload(null,false);

                    alert('berhasil');

                    $('#disableListModal').modal('hide');


                    window.location.reload();

                    } else {
                        $(".disable-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }, error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
      }
            });


      }); // click remove btn
    } 
    else {
        alert('Error: Refresh the page again');
    }


}

</script>