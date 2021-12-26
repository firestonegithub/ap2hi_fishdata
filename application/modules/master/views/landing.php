
 <div class="container-fluid">
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
     <li class="breadcrumb-item">
       <a href="#">Dashboard</a>
     </li>
     <li class="breadcrumb-item active"> Landing Site Lists </li>
   </ol>
   <!-- Example DataTables Card-->
   <div class="card mb-3">
     <div class="card-header">
       <i class="fa fa-table"></i>  Landing </div>
     <div class="card-body">

         <?php echo $button_add;  ?>

     <table id="manageLandingTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">

     <thead>
         <tr>
             <th> No </th>
             <th> Kode Landing </th>
             <th> Nama Landing  </th>
             <th> Edit </th>
             <th> Delete </th>
         </tr>
     </thead>

      <tfoot>
         <tr>
           <th> No </th>
           <th> Kode Landing </th>
           <th> Nama Landing  </th>
           <th> Edit </th>
           <th> Delete </th>
         </tr>
      </tfoot>

     </table>

   </div>
 </div>
</div>




<!-- Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModalLanding">
<div class="modal-dialog  modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
          <center><h5 class="modal-title">Landing Add</h5></center>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <form class="form-horizontal" action="<?php echo $url_add_landing; ?>" method="post" id="AddDataLandingForm">
     <div class="modal-body">

      <div class="messages"></div>

      <div class="form-group">
        <label for="exampleInputEmail1">Province</label>
         <select class="form-control" name="province" id="province">
             <option value="">Select Province</option>
             <?php foreach($provinceLists->result() as $row){ ?>
              <option value="<?php echo $row->id ; ?>"><?php echo $row->name ; ?></option>
             <?php  } ?>
          </select>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Regencies</label>
         <select class="form-control" name="regencies" id="regencies">
             <option value="">Select Regencies</option>
          </select>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">District</label>
       <select class="form-control" name="district" id="district">
             <option value="">Select District</option>
          </select>
      </div>



            <div class="form-group">
              <label for="exampleInputEmail1">Nama Lokasi Pendaratan</label>
              <input type="text" class="form-control" id="nama_landing" name="nama_landing" placeholder="Enter nama_landing" required>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="editLandingModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Landing Edit</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="<?php echo $url_edit_landing; ?>" method="post" id="editDataLandingForm">
        <div class="modal-body">
        <div class="edit-messages"></div>


        <div class="form-group">
          <label for="exampleInputEmail1">Nama Landing</label>
           <input type="hidden" class="form-control" id="edit_id_landing" name="edit_id_landing">
          <input type="text" class="form-control" id="edit_nama_landing" name="edit_nama_landing"  placeholder="Enter Nama Landing" required>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="disableLandingModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
                <center><h5 class="modal-title">Landing Disable</h5></center>
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


   manageLandingTable = $("#manageLandingTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
    "scrollX": true
    });


    /* Dropdown Dinamic */
    $("#province").change(function(){

         var id = $("#province").val();
        $("#district").html('<option value="">Select District</option>');
         $("#village").html('<option value="">Select Village</option>');

         $.ajax({
             type: "POST",
             dataType: "html",
             url: "<?php echo $select_load_regencies; ?>",
             data: "id="+id,
             success: function(msg){

                 if(msg == ''){
                     $("#regencies").html('<option value="">Select Regencies</option>');

                 }else{
                     $("#regencies").html(msg);
                 }
             }
         });
     });


    $("#regencies").change(function(){
         var id = $("#regencies").val();
         $("#village").html('<option value="">Select Village</option>');
         $.ajax({
             type: "POST",
             dataType: "html",
             url: "<?php echo $select_load_districts; ?>",
             data: "id="+id,
             success: function(msg){
                 if(msg == ''){
                     $("#district").html('<option value="">Select District</option>');
                 }else{
                     $("#district").html(msg);
                 }
             }
         });
     });


     $('#AddDataLandingBtn').on('click',function(){

       $('#AddDataLandingForm')[0].reset();
       $('.form-group').removeClass('has-error').removeClass('has-success');
       $('.text-danger').remove();
       $('.messages').html("");

       $('#AddDataLandingForm').unbind('submit').bind('submit',function(e){
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
                             $('#AddDataLandingForm')[0].reset();
                             //reload the datatables
                             manageLandingTable.ajax.reload(null,false);
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



function editData(id = null){
  if(id){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         $.ajax({
            url: '<?php echo $urlShowEditLanding; ?>',
            type: 'post',
            data: {id : id },
            dataType: 'json',
            success:function(response) {

              $('#edit_id_landing').val(response.messages[0].id_landing);
              $('#edit_nama_landing').val(response.messages[0].nama_landing);
			
              $("#editDataLandingForm").unbind('submit').bind('submit', function(e) {

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


                        manageLandingTable.ajax.reload(null,false);

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



function disableData(id = null) {

   if(id) {

      $("#hapusBtn").unbind('click').bind('click', function() {


          $.ajax({
                url: '<?php echo $url_disable_landing; ?>',
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

                    manageLandingTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableLandingModal').modal('hide');

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
