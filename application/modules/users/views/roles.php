    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Roles </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Roles </div>
        <div class="card-body">
          
           <div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalRoles" id="AddDataUserBtn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>


         <table id="manageRolesTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
                
                <thead>
                    <tr>
                        <th> No. </th>
                        <th> Role Name   </th>
                        <th> Role Desc  </th>
                        <th> Action </th>
                    </tr>
                </thead>

                 <tfoot>
                    <tr>
                        <th> No. </th>
                        <th> Role Name   </th>
                        <th> Role Desc  </th>
                        <th> Action </th>
                    </tr>
                 </tfoot>
                
                </table>
          
      </div>
    </div>

  </div>


<!-- Add Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="myModalRoles">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Role Add</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
         <form class="form-horizontal" action="<?php echo $url_add_roles; ?>" method="post" id="AddDataUserForm">

              <div class="modal-body">

              <div class="messages"></div>

                <div class="form-row">
                   <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="role_name" name="role_name"  placeholder="Enter Username" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Desc</label>
                    <input type="text" class="form-control" id="role_desc" name="role_desc"  placeholder="Enter Email" required>
                  </div>
                </div>

              
                		<div >
                   			<div>
                       <label for="exampleInputEmail1">Select This Role Permission </label>
                     </div><br>
                    

                     <?php 
                     $tmp = '';
                     $tmp1 = '';
                     $i=0;
                     foreach($roleLists->result() as $row ){
                      
                        $tmp = $row->group;
                        if($tmp != $tmp1){
                          if($i>0){
                            echo '</div>';
                          }
                          echo '<b>'.$row->group.'</b>';
                          echo '<div class="form-row"> ';
                        }

                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                              <input type='checkbox' name="perm[]" id="perm_id" value='<?php echo $row->perm_id; ?>' /> 
                                </td>
                                <td>
                                 <?php  echo $row->perm_desc ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
            
                      <?php
                          $tmp1 = $row->group;

                        $i++;
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
  <div class="modal fade" tabindex="-1" role="dialog" id="editRoleModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">User Update</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          
   <form class="form-horizontal" action="<?php echo $url_edit_roles; ?>" method="post" id="EditDataUserForm">

              <div class="modal-body">

              <div class="edit-messages"></div>

                <input type="hidden" class="form-control" id="edit_id_role" name="edit_id_role">

                 <div class="form-row">
                   <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="edit_role_name" name="edit_role_name"  placeholder="Enter Username" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Desc</label>
                    <input type="text" class="form-control" id="edit_role_desc" name="edit_role_desc"  placeholder="Enter Email" required>
                  </div>
                </div>


                </div>    
                                     

              
                <div>
                   <div>
                       <label for="exampleInputEmail1">Select This Role Permission </label>
                     </div><br>
                   

                  <?php 
                     $tmp = '';
                     $tmp1 = '';
                     $i=0;
                     $jumRoles = 1;
                     foreach($roleLists->result() as $row ){
                      
                        $tmp = $row->group;
                        if($tmp != $tmp1){
                          if($i>0){
                            echo '</div>';
                          }
                          echo '<b>'.$row->group.'</b>';
                          echo '<div class="form-row"> ';
                          $check = 1;
                        }

                        ?>

                        <div class="form-group col-md-3">
                            <table>
                              <tr>
                                <td>
                         
                              <input type='checkbox' name="edit_perm[]" id="edit_perm_id_<?php echo $row->perm_id; ?>" value='<?php echo $row->perm_id; ?>' /> 

                                </td>
                                <td>
                                 <?php  echo $row->perm_desc ; ?> 
                                 </td>                       
                              </tr>
                            </table>
                        </div>
                         
                      <?php
                                $tmp1 = $row->group;
                                $i++;
                                $jumRoles++;
                          } 
                           echo '</div>';
                      ?>

                   



                    


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
  <div class="modal fade" tabindex="-1" role="dialog" id="disableRoleModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Roles Disable</h5></center>
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
          <button type="submit" class="btn btn-primary" id="hapusBtn">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->


  <script>

$(document).ready(function() {
  

   manageRolesTable = $("#manageRolesTable").DataTable({
        "ajax": "<?php echo $url_list_roles; ?>",
        "order": [],
    "scrollX": true
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
                      console.log(  getCheckedCheckboxesFor("perm_id") ) ; 
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
                            manageRolesTable.ajax.reload(null,false);
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
            url: '<?php echo $urlShowEditroles; ?>',
            type: 'post',
            data: {id : id },
            dataType: 'json',
            success:function(response) {

               console.log(response) ; 
               

              $('#edit_id_role').val(response.messages[0].role_id);
              $('#edit_role_name').val(response.messages[0].role_name);
              $('#edit_role_desc').val(response.messages[0].role_desc);
              
           
               for (var i = 1; i < <?php echo $jumRoles ; ?> ; i++) {
                 
                  document.getElementById("edit_perm_id_" + i ).checked = false;
              }
              
              console.log(response.permissons.length) ; 
              for (var i = 0; i < response.permissons.length ; i++) {
                 
                  document.getElementById("edit_perm_id_" + response.permissons[i].perm_id ).checked = true;
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
                        
                    
                        manageRolesTable.ajax.reload(null,false);
                        
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
                url: '<?php echo $url_disable_roles; ?>',
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
                    
                    manageRolesTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableRoleModal').modal('hide');

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


 function checkAll() { 
        var inputs = document.querySelectorAll('.check2'); 
        for (var i = 0; i < inputs.length; i++) { 
            inputs[i].checked = true; 
        } 
    } 
    //create uncheckall function 
    function uncheckAll() { 
        var inputs = document.querySelectorAll('.check2'); 
        for (var i = 0; i < inputs.length; i++) { 
            inputs[i].checked = false; 
        } 
    } 


</script>