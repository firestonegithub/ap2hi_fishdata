    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> User </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  User </div>
        <div class="card-body">
          
           <div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalUser" id="AddDataUserBtn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>


         <table id="manageUsersTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
                
                <thead>
                    <tr>
                        <th> No. </th>
                        <th> Username   </th>
                        <th> Role  </th>
                        <th> Action </th>
                    </tr>
                </thead>

                 <tfoot>
                    <tr>
                        <th> No. </th>
                        <th> Username   </th>
                        <th> Role  </th>
                        <th> Action </th>
                    </tr>
                 </tfoot>
                
                </table>
          
      </div>
    </div>

  </div>


<!-- Add Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModalUser">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">User Add</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
         <form class="form-horizontal" action="<?php echo $url_add_user; ?>" method="post" id="AddDataUserFormm">

              <div class="modal-body">

              <div class="messages"></div>

                <div class="form-row">
                   <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  placeholder="Enter Username" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="email" name="email"  placeholder="Enter Email" required>
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" id="password" name="password"  placeholder="Enter Password" required>
                  </div>
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Address  </label>
                    <input type="text" class="form-control" id="address" name="address"  placeholder="Enter Address" required>
                  </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Telp</label>
                    <input type="text" class="form-control" id="telp" name="telp"  placeholder="Enter Telp" required>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile"  placeholder="Enter Mobile" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">State</label>
                    <select id="inputState" name="nationality" class="form-control">
                          <option selected>Choose Nationality...</option>
                           <?php foreach($countryLists->result() as $row){ ?>
                          <option value="<?php echo $row->id ; ?>"><?php echo $row->country_name ; ?></option>
                         <?php  } ?>
                    </select>
                    </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Role Level </label>
                      <select id="role" name="role" class="form-control">
                          <option selected>Choose Role...</option>
                          <?php foreach($roleLists->result() as $row){ ?>
                          <option value="<?php echo $row->role_id ; ?>"><?php echo $row->role_name ; ?></option>
                         <?php  } ?>
                    </select>
                  </div>
                </div>    
                                     

              
                <div id="showSupp" style="display:none">
                   <div>
                       <label for="exampleInputEmail1">Select This Supplier Role Belong to .. </label>
                     </div><br>
                    <div class="form-row"> 

                     <?php foreach($suppLists->result() as $row ){
                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                              <input type='checkbox' name="supp_id[]" id="supp_id" value='<?php echo $row->id_supplier; ?>' /> 
                                </td>
                                <td>
                                 <?php  echo $row->nama_perusahaan ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
            
                      <?php
                          } 
                      ?>

                    </div>
          
          
           <div>
                       <label for="exampleInputEmail1"><b>Select This Landing Role Belong to .. </b> </label>
                     </div><br>
                    <div class="form-row"> 

                     <?php foreach($landingLists->result() as $row ){
                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                              <input type='checkbox' name="landing_id[]" id="landing_id" value='<?php echo $row->id_landing; ?>' /> 
                                </td>
                                <td>
                                 <?php  echo $row->nama_landing ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
            
                      <?php
                          } 
                      ?>

                    </div>
          
          
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
  <div class="modal fade" tabindex="-1" role="dialog" id="editUserModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">User Update</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          
   <form class="form-horizontal" action="<?php echo $url_edit_user; ?>" method="post" id="EditDataUserForm">

              <div class="modal-body">

              <div class="edit-messages"></div>

                <div class="form-row">
                   <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Username</label>
                     <input type="hidden" class="form-control" id="edit_id_user" name="edit_id_user">
                    <input type="text" class="form-control" id="edit_username" name="edit_username"  placeholder="Enter Username" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"  placeholder="Enter Email" required>
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="edit_name" name="edit_name"  placeholder="Enter Name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" id="edit_password" name="edit_password"  placeholder="Enter Password">
                  </div>
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Address  </label>
                    <input type="text" class="form-control" id="edit_address" name="edit_address"  placeholder="Enter Address" required>
                  </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Telp</label>
                    <input type="text" class="form-control" id="edit_telp" name="edit_telp"  placeholder="Enter Telp" required>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="text" class="form-control" id="edit_mobile" name="edit_mobile"  placeholder="Enter Mobile" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">State</label>
                    <select id="edit_nationality" name="edit_nationality" class="form-control">
                          <option selected>Choose Nationality...</option>
                           <?php foreach($countryLists->result() as $row){ ?>
                          <option value="<?php echo $row->id ; ?>"><?php echo $row->country_name ; ?></option>
                         <?php  } ?>
                    </select>
                    </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Role Level </label>
                      <select id="edit_role" name="edit_role" class="form-control">
                          <option selected>Choose Role...</option>
                          <?php foreach($roleLists->result() as $row){ ?>
                          <option value="<?php echo $row->role_id ; ?>"><?php echo $row->role_name ; ?></option>
                         <?php  } ?>
                    </select>
                  </div>
                </div>    
                                     

              
                <div id="showSuppEdit" style="display:none">
                   <div>
                       <label for="exampleInputEmail1">Select This Supplier Role Belong to .. </label>
                     </div><br>
                    <div class="form-row"> 

                     <?php 
                     $jumSupp = 1;
                     foreach($suppLists->result() as $row ){

                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                              <input type='checkbox' name="edit_supp_id[]" id='edit_supp_id_<?php echo $row->id_supplier; ?>' value='<?php echo $row->id_supplier; ?>' /> 
                                </td>
                                <td>
                                 <?php  echo $row->nama_perusahaan ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
                         
                      <?php
                                $jumSupp++;
                          } 
                      ?>

                    </div>







                    <div>
                       <label for="exampleInputEmail1"><b>Select This Landing Role Belong to ..</b> </label>
                     </div><br>
                    <div class="form-row"> 
                    <?php $jumLanding = 1; ?>
                     <?php foreach($landingLists->result() as $row ){
                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                              <input type='checkbox' name="edit_landing_id[]" id='edit_landing_id_<?php echo $row->id_landing; ?>' value='<?php echo $row->id_landing; ?>' /> 
                                </td>
                                <td>
                                 <?php  echo $row->nama_landing ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
            
                      <?php
                          $jumLanding++;

                          } 
                      ?>

                    </div>

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
  <!-- tutup edit modal -->


  <!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="disableUserModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">User Disable</h5></center>
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
  

   manageUsersTable = $("#manageUsersTable").DataTable({
        "ajax": "<?php echo $url_list_users; ?>",
        "order": [],
    "scrollX": true
    });

   document.getElementById('role').addEventListener('change', function () {
     
      if( this.value == 2 || this.value == 3 ||  this.value == 4 ){
        var style = 'block';
        $("input[name='supp_id']:checkbox").prop('checked',false);
      }else{
        var style = 'none';
      }
     
      document.getElementById('showSupp').style.display = style;
    });


   document.getElementById('edit_role').addEventListener('change', function () {
      if( this.value == 2 || this.value == 3 ||  this.value == 4 ){
        var style = 'block';
        $("input[name='supp_id']:checkbox").prop('checked',false);
      }else{
        var style = 'none';
      }
     
      document.getElementById('showSuppEdit').style.display = style;
    });








function getCheckedCheckboxesFor(checkboxName) {
    var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    return values;
}


    $('#AddDataUserBtn').on('click',function(){
        
      $('#AddDataUserForm')[0].reset();
      document.getElementById('showSupp').style.display = 'none';
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();
      $('.messages').html("");
       
      $('#AddDataUserForm').unbind('submit').bind('submit',function(e){
        $('.text-danger').remove();
        $('.messages').html("");
          var form = $(this);
                      
                      var me = $(this);
                        e.preventDefault();
                      if ( me.data('requestRunning') ) {
                        return;
                      }
                      me.data('requestRunning', true);
                    
                      console.log("masuk");    
                      console.log(  getCheckedCheckboxesFor("supp_id") ) ; 
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
                            $('#AddDataUserForm')[0].reset();
                            //reload the datatables
                            manageUsersTable.ajax.reload(null,false);
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






    function editData(id = null){
      
      if(id){

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         $.ajax({
            url: '<?php echo $urlShowEditUser; ?>',
            type: 'post',
            data: {id : id },
            dataType: 'json',
            success:function(response) {

               //console.log(response) ; 
               document.getElementById('showSuppEdit').style.display = 'none';
               

              $('#edit_id_user').val(response.messages[0].id_user);
              $('#edit_name').val(response.messages[0].name);
              $('#edit_username').val(response.messages[0].username);
              $('#edit_email').val(response.messages[0].email);
              $('#edit_password').val("");
              $('#edit_address').val(response.messages[0].address);
              $('#edit_telp').val(response.messages[0].no_telp);
              $('#edit_mobile').val(response.messages[0].no_hp);
              $('#edit_nationality').val(response.messages[0].nationality);
              $('#edit_role').val(response.messages[0].role_id);
              if( response.messages[0].role_id == 2 ) {
                document.getElementById('showSuppEdit').style.display = 'block';
              }
              if( response.messages[0].role_id == 3 ) {
                document.getElementById('showSuppEdit').style.display = 'block';
              }
              if( response.messages[0].role_id == 4 ) {
                document.getElementById('showSuppEdit').style.display = 'block';
              }

              //console.log(response.messages[0].supplier_data) ; 
              var supplier_data = response.messages[0].supplier_data;
              if(supplier_data != ""){
              var supplier_data1 = JSON.parse(supplier_data);
              for (var i = 1; i < <?php echo $jumSupp ; ?> ; i++) {
                 
                  document.getElementById("edit_supp_id_" + i ).checked = false;
              }

              for (var i = 0; i < supplier_data1.length ; i++) {
                 
                  document.getElementById("edit_supp_id_" + supplier_data1[i] ).checked = true;
              }
              }


              //console.log(response.messages[0].landing_data) ; 
              if(landing_data != ""){
              var landing_data = response.messages[0].landing_data;
              var landing_data1 = JSON.parse(landing_data);
             
              for (var i = 0; i < landing_data1.length ; i++) {
                  
                  document.getElementById("edit_landing_id_" + landing_data1[i] ).checked = true;
              }
              }
             
              
              $("#EditDataUserForm").unbind('submit').bind('submit', function(e) {

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
                        
                    
                        manageUsersTable.ajax.reload(null,false);
                        
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
                url: '<?php echo $url_disable_user; ?>',
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
                    
                    manageUsersTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableUserModal').modal('hide');

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