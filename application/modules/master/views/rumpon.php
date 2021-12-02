
 <div class="container-fluid">
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
     <li class="breadcrumb-item">
       <a href="#">Dashboard</a>
     </li>
     <li class="breadcrumb-item active"> Rumpon </li>
   </ol>
   <!-- Example DataTables Card-->
   <div class="card mb-3">
     <div class="card-header">
       <i class="fa fa-table"></i>  Rumpon </div>
     <div class="card-body">

         <?php echo $button_add;  ?>

     <table id="manageRumponTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">

     <thead>
         <tr>
             <th> Kode Rumpon </th>
             <th> Nama Supplier </th>
             <th> Alamat  </th>
             <th> No Sipr </th>
             <th> Daerah Penangkapan </th>
             <th> Daerah Usaha  </th>
             <th> Alat Tangkap  </th>
             <th> Posisi Rumpon </th>
             <th> Bahan </th>
             <th> Edit </th>
             <th> Delete </th>
         </tr>
     </thead>

      <tfoot>
         <tr>
           <th> Kode Rumpon </th>
           <th> Nama Supplier </th>
           <th> Alamat  </th>
           <th> No Sipr </th>
           <th> Daerah Penangkapan </th>
           <th> Daerah Usaha  </th>
           <th> Alat Tangkap  </th>
           <th> Posisi Rumpon </th>
           <th> Bahan </th>
           <th> Edit </th>
           <th> Delete </th>
         </tr>
      </tfoot>

     </table>

   </div>
 </div>
</div>


<div class="container-fluid">
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Rumpon Action  </div>
        <div class="card-body">
         
            


<div id="accordion" role="tablist">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
         Download Rumpon
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
             
             
          <div><center> <a href="<?php echo $excell_rumpon ; ?>" class="btn btn-primary"  >Download Lists</a> </center></div>


      </div>
    </div>
  </div>


</div>



        </div>
    </div>
</div>



<!-- Add Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModalRumpon">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Rumpon Add</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_add_rumpon; ?>" method="post" id="AddDataRumponForm">
       <div class="modal-body">

        <div class="messages"></div>

        <div class="form-group">
          <label>Pilih supplier</label>
            <select class="form-control" name="id_supplier" id="id_supplier" required>
                   <option value="">Select Perusahaan</option>
                   <?php foreach($listSupplier->result() as $row){ ?>
                    <option value="<?php echo $row->id_supplier ; ?>"><?php echo $row->nama_perusahaan ; ?></option>
                   <?php  } ?>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat"  placeholder="Enter alamat" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">No SIPR </label>
          <input type="text" class="form-control" id="no_sipr" name="no_sipr"  placeholder="Enter no_sipr" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Daerah Penangkapan</label>
          <input type="text" class="form-control" id="daerah_penangkapan" name="daerah_penangkapan"  placeholder="Enter daerah_penangkapan" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Daerah Usaha</label>
          <input type="text" class="form-control" id="daerah_usaha" name="daerah_usaha"  placeholder="Enter daerah_usaha" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alat Tangkap</label>
          <input type="text" class="form-control" id="alat_tangkap" name="alat_tangkap"  placeholder="Enter alat_tangkap"  required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Posisi Rumpon</label>
          <input type="text" class="form-control" id="posisi_rumpon" name="posisi_rumpon" placeholder="Enter posisi_rumpon"  required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Bahan</label>
          <input type="text" class="form-control" id="bahan" name="bahan" placeholder="Enter bahan"  required>
        </div>

       </div>

       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit data</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<!-- edit modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editRumponModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Rumpon Edit</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="<?php echo $url_edit_rumpon; ?>" method="post" id="editDataRumponForm">
        <div class="modal-body">
        <div class="edit-messages"></div>

        <div class="form-group">
            <label for="exampleInputEmail1">Supplier Code</label>
           <input type="hidden" class="form-control" id="edit_id_supplier" name="edit_id_supplier">
           <input type="hidden" class="form-control" id="edit_urut" name="edit_urut">

        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alamat</label>
          <input type="text" class="form-control" id="edit_alamat" name="edit_alamat"  placeholder="Enter alamat" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">No SIPR </label>
          <input type="text" class="form-control" id="edit_no_sipr" name="edit_no_sipr"  placeholder="Enter no_sipr" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Daerah Penangkapan</label>
          <input type="text" class="form-control" id="edit_daerah_penangkapan" name="edit_daerah_penangkapan"  placeholder="Enter daerah_penangkapan" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Daerah Usaha</label>
          <input type="text" class="form-control" id="edit_daerah_usaha" name="edit_daerah_usaha" placeholder="Enter daerah_usaha" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Alat Tangkap</label>
          <input type="text" class="form-control" id="edit_alat_tangkap" name="edit_alat_tangkap"  placeholder="Enter alat_tangkap"  required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Posisi Rumpon</label>
          <input type="text" class="form-control" id="edit_posisi_rumpon" name="edit_posisi_rumpon"  placeholder="Enter posisi_rumpon"  required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Bahan</label>
          <input type="text" class="form-control" id="edit_bahan" name="edit_bahan"  placeholder="Enter bahan"  required>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Edit data</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- tutup edit modal -->



  <!-- remove modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="disableRumponModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <center><h5 class="modal-title">Rumpon Disable</h5></center>
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


   manageRumponTable = $("#manageRumponTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
    "scrollX": true
    });


    $('#AddDataRumponBtn').on('click',function(){

      $('#AddDataRumponForm')[0].reset();
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();
      $('.messages').html("");

      $('#AddDataRumponForm').unbind('submit').bind('submit',function(e){
        $('.text-danger').remove();
        $('.messages').html("");
          var form = $(this);

                      var me = $(this);
                        e.preventDefault();
                      if ( me.data('requestRunning') ) {
                        return;
                      }
                      me.data('requestRunning', true);

          $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType :'json',
                    success:function(response){
                        // remove pesan error
                        $('.form-group').removeClass('has-error').removeClass('has-success');

                        if (response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                            //reset form
                            $('#AddDataRumponForm')[0].reset();
                            //reload the datatables
                            manageRumponTable.ajax.reload(null,false);
                        }else{
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                        }
                    }
                    , error: function( xhr, status, error){
                            console.log(xhr.statusText);
                            console.log(error);
                            console.log(status);


                            alert('500 Internal server error !');
                      } ,
                      complete: function() {
                        me.data('requestRunning', false);
                      }
                });

          return false;
      });

    });


});



function editData(urut = null , id_supplier = null){
  if(urut){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         $.ajax({
            url: '<?php echo $urlShowEditRumpon; ?>',
            type: 'post',
            data: {urut : urut , id_supplier : id_supplier },
            dataType: 'json',
            success:function(response) {


              $('#edit_id_supplier').val(response.messages[0].id_supplier);
              $('#edit_urut').val(response.messages[0].urut);
              $('#edit_alamat').val(response.messages[0].alamat);
              $('#edit_no_sipr').val(response.messages[0].no_sipr);
              $('#edit_daerah_penangkapan').val(response.messages[0].daerah_penangkapan);
              $('#edit_daerah_usaha').val(response.messages[0].daerah_usaha);
              $('#edit_alat_tangkap').val(response.messages[0].alat_tangkap);
              $('#edit_posisi_rumpon').val(response.messages[0].posisi_rumpon);
              $('#edit_bahan').val(response.messages[0].bahan);


              $("#editDataRumponForm").unbind('submit').bind('submit', function(e) {

                 $(".text-danger").remove();

                    var form = $(this);
                    var me = $(this);
                        e.preventDefault();
                      if ( me.data('requestRunning') ) {
                        return;
                      }
                      me.data('requestRunning', true);

                   $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: form.serialize(),
                                dataType: 'json',
                                success:function(response) {
                    if (response.success == true) {
                        $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        '</div>');


                        manageRumponTable.ajax.reload(null,false);

                      }else{
                        $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                        '</div>');
                        alert('Gagal');
                      }
                          } ,
                       error: function(xhr, status, error) {
                        console.log(status);
                        console.log(error);
                    },
                      complete: function() {
                        me.data('requestRunning', false);
                      }
                  }); // /ajax



                 return false;

                });


            }  // /success
            , error: function( xhr, status, error){
                console.log(xhr.statusText);
                console.log(error);
                console.log(status);


               alert('500 Internal server error !');
            }
        }); // /fetch selected member info

   } else {
        alert('Error: Refresh the page again');
    }
}



function disableData(urut = null , id_supplier = null) {

   if(id_supplier) {

      $("#hapusBtn").unbind('click').bind('click', function() {


          $.ajax({
                url: '<?php echo $url_disable_rumpon; ?>',
                type: 'post',
                data: { urut : urut , id_supplier : id_supplier },
                dataType: 'json',
                success:function(response) {
                  console.log(response);
                     if (response.success == true) {
                        $(".disable-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                    manageRumponTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableRumponModal').modal('hide');

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
