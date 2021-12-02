   
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Supplier </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Supplier </div>
        <div class="card-body">
          
            <?php echo $button_add;  ?>

        <table id="manageSupplierTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> Code Supplier  </th>
                <th> Code AP2HI  </th>
                <th> Supplier Name </th>
                <th> Supplier Type  </th>
                <th> Location </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
        </thead>

         <tfoot>
            <tr>
               <th> No. </th>
               <th> Code Supplier  </th>
               <th> Code AP2HI  </th>
               <th> Supplier Name </th>
               <th> Supplier Type  </th>
               <th> Location </th>
              <th> Edit </th>
               <th> Delete </th>
            </tr>
         </tfoot>
        
        </table>

      </div>
    </div> 
  </div>

  
<!-- Add Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModalSupplier">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Supplier Add</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_add_supplier; ?>" method="post" id="AddDataSupplierForm">
       <div class="modal-body">

        <div class="messages"></div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Code</label>
          <input type="text" class="form-control" id="kode_name" name="kode_name" placeholder="Enter supplier code" style="text-transform: uppercase" maxlength="4" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">AP2HI Supplier Code</label>
          <input type="text" class="form-control" id="kode_ap2hi" name="kode_ap2hi"  placeholder="Enter AP2HI Code" required>
        </div>


        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Name</label>
          <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"  placeholder="Enter Supplier Name" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Type</label>
          <input type="text" class="form-control" id="tipe_perusahaan" name="tipe_perusahaan"  placeholder="Enter Supplier Type" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Location</label>
          <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Enter Supplier Location" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter Supplier Address" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Country</label>
           <select class="form-control" name="country" id="country">
               <option value="">Select Country</option>
               <?php foreach($countryLists->result() as $row){ ?>
                <option value="<?php echo $row->id ; ?>"><?php echo $row->country_name ; ?></option>
               <?php  } ?>
            </select>
        </div>

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
          <label for="exampleInputEmail1">Village</label>
           <select class="form-control" name="village" id="village">
               <option value="">Select Village</option>
            </select>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="editSupplierModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Supplier Edit</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="<?php echo $url_edit_supplier; ?>" method="post" id="editDataSupplierForm">
        <div class="modal-body">
        <div class="edit-messages"></div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Code</label>
           <input type="hidden" class="form-control" id="edit_id_supplier" name="edit_id_supplier">
           <input type="text" class="form-control" id="edit_kode_name" name="edit_kode_name" placeholder="Enter supplier code" style="text-transform: uppercase" maxlength="4" required readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Kode AP2HI</label>
          <input type="text" class="form-control" id="edit_kode_ap2hi" name="edit_kode_ap2hi"  placeholder="Enter Kode Ap2hi" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Name</label>
          <input type="text" class="form-control" id="edit_nama_perusahaan" name="edit_nama_perusahaan"  placeholder="Enter Supplier Name" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Type</label>
          <input type="text" class="form-control" id="edit_tipe_perusahaan" name="edit_tipe_perusahaan"  placeholder="Enter Supplier Type" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Location</label>
          <input type="text" class="form-control" id="edit_lokasi" name="edit_lokasi" placeholder="Enter Supplier Location" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Supplier Address</label>
          <input type="text" class="form-control" id="edit_address" name="edit_address" placeholder="Enter Supplier Address" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Country</label>
           <select class="form-control" name="edit_country" id="edit_country">
               <option value="">Select Country</option>
               <?php foreach($countryLists->result() as $row){ ?>
                <option value="<?php echo $row->id ; ?>"><?php echo $row->country_name ; ?></option>
               <?php  } ?>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Province</label>
           <select class="form-control" name="edit_province" id="edit_province">
               <option value="">Select Province</option>
               <?php foreach($provinceLists->result() as $row){ ?>
                <option value="<?php echo $row->id ; ?>"><?php echo $row->name ; ?></option>
               <?php  } ?>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Regencies</label>
           <select class="form-control" name="edit_regencies" id="edit_regencies">
               <option value="">Select Regencies</option>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">District</label>
         <select class="form-control" name="edit_district" id="edit_district">
               <option value="">Select District</option>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Village</label>
           <select class="form-control" name="edit_village" id="edit_village">
               <option value="">Select Village</option>
            </select>
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
  <div class="modal fade" tabindex="-1" role="dialog" id="disableSupplierModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Supplier Disable</h5></center>
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
  

   manageSupplierTable = $("#manageSupplierTable").DataTable({
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

   $("#district").change(function(){
        var id = $("#district").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_villages; ?>",
            data: "id="+id,
            success: function(msg){
                if(msg == ''){
                    $("#village").html('<option value="">Select Village</option>');
                }else{
                    $("#village").html(msg);                                                     
                }
            }
        });    
    });
    /* End Dropdown Dinamic */

    /* Dropdown Dinamic Edit */
    $("#edit_province").change(function(){

        var id = $("#edit_province").val();
       $("#edit_district").html('<option value="">Select District</option>');
        $("#edit_village").html('<option value="">Select Village</option>');
       // mengirim dan mengambil data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_regencies; ?>",
            data: "id="+id,
            success: function(msg){
               // jika tidak ada data
                if(msg == ''){
                    $("#edit_regencies").html('<option value="">Select Regencies</option>');

                }else{
                    $("#edit_regencies").html(msg);                                                     
                }
            }
        });    
    });


   $("#edit_regencies").change(function(){
        var id = $("#edit_regencies").val();
        $("#edit_village").html('<option value="">Select Village</option>');
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_districts; ?>",
            data: "id="+id,
            success: function(msg){
                if(msg == ''){
                    $("#edit_district").html('<option value="">Select District</option>');
                }else{
                    $("#edit_district").html(msg);                                                     
                }
            }
        });    
    });

   $("#edit_district").change(function(){
        var id = $("#edit_district").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_villages; ?>",
            data: "id="+id,
            success: function(msg){
                if(msg == ''){
                    $("#edit_village").html('<option value="">Select Village</option>');
                }else{
                    $("#edit_village").html(msg);                                                     
                }
            }
        });    
    });
    /* End Dropdown Dinamic Edit */

   
    $('#AddDataSupplierBtn').on('click',function(){
        
      $('#AddDataSupplierForm')[0].reset();
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();
      $('.messages').html("");
       
      $('#AddDataSupplierForm').unbind('submit').bind('submit',function(e){
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
                            $('#AddDataSupplierForm')[0].reset();
                            //reload the datatables
                            manageSupplierTable.ajax.reload(null,false);
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

} );


   function getRegencies(province , regencies){
      $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_regencies_edit; ?>",
            data: "province="+province+"&regencies="+regencies,
            success: function(msg){

                if(msg == ''){
                    $("#edit_regencies").html('<option value="">Select Regencies</option>');
                }else{
                    $("#edit_regencies").html(msg);                                                     
                }
            }
        }); 
   }
   function getDistrict(regencies , district){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_district_edit; ?>",
            data: "regencies="+regencies+"&district="+district,
            success: function(msg){

                if(msg == ''){
                    $("#edit_district").html('<option value="">Select District</option>');
                }else{
                    $("#edit_district").html(msg);                                                     
                }
            }
        }); 
   }
   function getVillage(district , village){
       $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo $select_load_villages_edit; ?>",
            data: "district="+district+"&village="+village,
            success: function(msg){

                if(msg == ''){
                    $("#edit_village").html('<option value="">Select District</option>');
                }else{
                    $("#edit_village").html(msg);                                                     
                }
            }
        }); 
   }

function editData(id = null){
  if(id){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         $.ajax({
            url: '<?php echo $urlShowEditSupplier; ?>',
            type: 'post',
            data: {id : id },
            dataType: 'json',
            success:function(response) {

              $('#edit_id_supplier').val(response.messages[0].id_supplier);
              $('#edit_kode_name').val(response.messages[0].kode_name);
              $('#edit_kode_ap2hi').val(response.messages[0].kode_ap2hi);
              $('#edit_nama_perusahaan').val(response.messages[0].nama_perusahaan);
              $('#edit_tipe_perusahaan').val(response.messages[0].tipe_perusahaan);
              $('#edit_lokasi').val(response.messages[0].lokasi);
              $('#edit_address').val(response.messages[0].address);
              $('#edit_country').val(response.messages[0].country);
              $('#edit_province').val(response.messages[0].province);
              $('#edit_regencies').val(response.messages[0].regencies);
              $('#edit_district').val(response.messages[0].district);
              $('#edit_village').val(response.messages[0].village);

              getRegencies(response.messages[0].province , response.messages[0].regencies)
              getDistrict(response.messages[0].regencies , response.messages[0].district)
              getVillage(response.messages[0].district , response.messages[0].village)

              $("#editDataSupplierForm").unbind('submit').bind('submit', function(e) {

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
                        
                    
                        manageSupplierTable.ajax.reload(null,false);
                        
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
                url: '<?php echo $url_disable_supplier; ?>',
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
                    
                    manageSupplierTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableSupplierModal').modal('hide');

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