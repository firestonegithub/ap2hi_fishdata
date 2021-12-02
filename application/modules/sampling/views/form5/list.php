   
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> <?php echo $page_name; ?> </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  <?php echo $page_name_detail; ?> </div>
        <div class="card-body">
          	

          	   <div class="card-header">
                                <strong class="card-title">Trips Form</strong>
                                <a class='pull-right btn btn-success btn-sm' href='<?php echo base_url(); ?>sampling/mainpage/form5_add/<?php echo $namafile;  ?>'><span class='fa fa-plus-square-o'> </span>Tambahkan Data</a>
                            </div>

        <table id="example" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
         <thead>
            <tr>
                <th> No. </th>
                <th> namafile  </th>
                <th> kode </th>
                <th> deskrisi </th>
                <th> berat  </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
        </thead>

        <tbody>
        
          <?php 
           $i=1;
           foreach ($record->result_array() as $row){
           
          ?>

            <tr>
                <td> <?php echo $i; ?> </td>
                <td> <?php echo $row['namafile'] ?>  </td>
                <td> <?php echo $row['kode'] ?> </td>
                <td> <?php echo $row['deskripsi'] ?> </td>
                <td> <?php echo $row['berat'] ?>  </td>
                <td> <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/form5_update/<?php echo $row['namafile']; ?>/<?php echo $row['kode']; ?>" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a> </td>
                <td> <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/form5_delete/<?php echo $row['namafile']; ?>/<?php echo $row['kode']; ?>" class="btn btn-danger a-btn-slide-text" onclick="return confirm('Are you sure you want to delete this item?');">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a> </td>
            </tr>

          <?php $i++; } ?>

        </tbody>

         <tfoot>
            <tr>
                <th> No. </th>
                <th> namafile  </th>
                <th> kode </th>
                <th> deskrisi </th>
                <th> berat  </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
         </tfoot>
        
        </table>


      </div>
    </div> 
  </div>


<div class="container-fluid">
     
    <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  <?php echo $page_name_detail1; ?> </div>
        <div class="card-body">
          	
        	  <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="card-header">
                               
                                <strong class="card-title">TABLE <?php echo $table1; ?></strong>
                              
                            </div>


                            <div class="card-body">

                              <?php echo $button_add ; ?>

                      <table id="observerform_umpan_detail" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
                            <thead>
                                  <th> No. </th>
                                  <th> kode fao  </th>
                                  <th> berat </th>
                                  <th> panjang </th>
                                  <th> kode panjang </th>
                                  <th> loin berat  </th>
                                  <th> loin panjang </th>
                                  <th> termasuk berat insang  </th>
                                  <th> isi berat  </th>
                                  <th> daging perut  </th>
                                  <th> Edit </th>
                                  <th> Delete </th>
                            </thead>

                             <tfoot>
                                <tr>
                                  <th> No. </th>
                                  <th> kode fao  </th>
                                  <th> berat </th>
                                  <th> panjang </th>
                                  <th> kode panjang </th>
                                  <th> loin berat  </th>
                                  <th> loin panjang </th>
                                  <th> termasuk berat insang  </th>
                                  <th> isi berat  </th>
                                  <th> daging perut  </th>
                                  <th> Edit </th>
                                  <th> Delete </th>
                                </tr>
                             </tfoot>
                            
                            </table>
                              

              <div class='col-md-12'>


              </div>
              </div>
            </div>
          </div>
        </div>
          	  

      </div>
    </div> 
 </div>  


 <!-- Modal -->

 <div class="modal fade" tabindex="-1" role="dialog" id="myModalTable1">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Tambah IkaN bESAR </h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_add_table1; ?>" method="post" id="AddDataTable1Form">
       <div class="modal-body">

        <div class="messages"></div>
        <div class="form-group">
          <label for="exampleInputEmail1">namafile</label>
          <input type="text" class="form-control" id="namafile" name="namafile" value="<?php echo $namafile; ?>" autocomplete=off>
        </div>
  
         <div class="form-group">
          <label for="exampleInputEmail1">k_species</label>
          <select class="form-control" name="k_species" id="k_species">
                                     <option value="">Select Species</option>
                                     <option value="YFT">YFT</option>
                                     <option value="BET">BET</option>
                                     <option value="SKJ">SKJ</option>
                                     <option value="ALB">ALB</option>
                                </select>

        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">berat</label>
          <input type="text" class="form-control" id="berat" name="berat" autocomplete=off>
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">panjang</label>
          <input type="text" class="form-control" id="panjang" name="panjang" autocomplete=off>
        </div>

                      
         <div class="form-group">
          <label for="exampleInputEmail1">kode_panjang</label>
          <select class="form-control" name="kode_panjang" id="kode_panjang">
                                     <option value="">Select Kode Panjang</option>
                                     <option value="FL">FL</option>
                                     <option value="PF">PF</option>
                                     <option value="PS">PS</option>
                                </select>
        </div>

    
         <div class="form-group">
          <label for="exampleInputEmail1">loin1_berat</label>
          <input type="text" class="form-control" id="loin1_berat" name="loin1_berat" autocomplete=off>
        </div>

           <div class="form-group">
          <label for="exampleInputEmail1">loin1_panjang</label>
          <input type="text" class="form-control" id="loin1_panjang" name="loin1_panjang" autocomplete=off>
        </div>

                      
           <div class="form-group">
          <label for="exampleInputEmail1">insang</label>
          <select class="form-control" name="insang" id="insang">
                                     <option value="">Silahkan Pilih</option>
                                     <option value="Y">Ya</option>
                                     <option value="T">Tidak</option>
                                </select>
        </div>
                     
         <div class="form-group">
          <label for="exampleInputEmail1">isi_perut</label>
          <select class="form-control" name="isi_perut" id="isi_perut">
                                     <option value="">Silahkan Pilih</option>
                                     <option value="Y">Ya</option>
                                     <option value="T">Tidak</option>
                                </select>
        </div>
                      
         <div class="form-group">
          <label for="exampleInputEmail1">daging_perut</label>
          <select class="form-control" name="daging_perut" id="daging_perut">
                                     <option value="">Silahkan Pilih</option>
                                     <option value="Y">Ya</option>
                                     <option value="T">Tidak</option>
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

 


  <!-- Modal -->

 <div class="modal fade" tabindex="-1" role="dialog" id="editTable1Modal">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Update observerform_umpan_detail </h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_update_table1; ?>" method="post" id="EditDataTable1Form">
       <div class="modal-body">

        <div class="edit-messages"></div>

         <div class="messages"></div>
        <div class="form-group">
          <label for="exampleInputEmail1">namafile</label>
          <input type="text" class="form-control" id="edit_namafile" name="edit_namafile" autocomplete=off>
        </div>

        <div class="messages"></div>
        <div class="form-group">
          <label for="exampleInputEmail1">no_ikan</label>
          <input type="text" class="form-control" id="edit_no_ikan" name="edit_no_ikan" autocomplete=off>
        </div>
  
         <div class="form-group">
          <label for="exampleInputEmail1">k_species</label>
          <input type="text" class="form-control" id="edit_k_species" name="edit_k_species" autocomplete=off>
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">berat</label>
          <input type="text" class="form-control" id="edit_berat" name="edit_berat" autocomplete=off>
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">panjang</label>
          <input type="text" class="form-control" id="edit_panjang" name="edit_panjang" autocomplete=off>
        </div>

                      
         <div class="form-group">
          <label for="exampleInputEmail1">kode_panjang</label>
          <input type="text" class="form-control" id="edit_kode_panjang" name="edit_kode_panjang" autocomplete=off>
        </div>

    
         <div class="form-group">
          <label for="exampleInputEmail1">edit_loin1_berat</label>
          <input type="text" class="form-control" id="edit_loin1_berat" name="edit_loin1_berat" autocomplete=off>
        </div>

           <div class="form-group">
          <label for="exampleInputEmail1">edit_loin1_panjang</label>
          <input type="text" class="form-control" id="edit_loin1_panjang" name="edit_loin1_panjang" autocomplete=off>
        </div>

                      
           <div class="form-group">
          <label for="exampleInputEmail1">insang</label>
          <input type="text" class="form-control" id="edit_insang" name="edit_insang" autocomplete=off>
        </div>
                     
         <div class="form-group">
          <label for="exampleInputEmail1">isi_perut</label>
          <input type="text" class="form-control" id="edit_isi_perut" name="edit_isi_perut" autocomplete=off>
        </div>
                      
         <div class="form-group">
          <label for="exampleInputEmail1">daging_perut</label>
          <input type="text" class="form-control" id="edit_daging_perut" name="edit_daging_perut" autocomplete=off>
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



<!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="disableTable1Modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Disable</h5></center>
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
    $('#example').DataTable();
} );



$(document).ready(function() {
  
   observerform_umpan_detail = $("#observerform_umpan_detail").DataTable({
    "ajax": "<?php echo $url_load_table ?>",
        "order": [],   
    "scrollX": true
    });




     $('#AddDataTable1Btn').on('click',function(){
        
      $('#AddDataTable1Form')[0].reset();
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();
      $('.messages').html("");
       
      $('#AddDataTable1Form').unbind('submit').bind('submit',function(e){

      
        
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
                            $('#AddDataTable1Form')[0].reset();
                            //reload the datatables
                            observerform_umpan_detail.ajax.reload(null,false);
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











}) ; 



function editData(namafile = null, no_ikan=null ){



  if(namafile){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         //$('#EditDataTable1Form')[0].reset();

         $.ajax({
            url: '<?php echo $url_show_table; ?>',
            type: 'post',
            data: {namafile : namafile , no_ikan : no_ikan  },
            dataType: 'json',
            success:function(response) {

              	$('#edit_namafile').val(response.messages[0].namafile);
              	$('#edit_no_ikan').val(response.messages[0].no_ikan);
              	$('#edit_k_species').val(response.messages[0].k_species);
				        $('#edit_berat').val(response.messages[0].berat);
				        $('#edit_panjang').val(response.messages[0].panjang);
				        $('#edit_kode_panjang').val(response.messages[0].kode_panjang);
        				$('#edit_loin1_berat').val(response.messages[0].loin1_berat);
        				$('#edit_loin1_panjang').val(response.messages[0].loin1_panjang);
        				$('#edit_insang').val(response.messages[0].insang);
        				$('#edit_isi_perut').val(response.messages[0].isi_perut);
                $('#edit_daging_perut').val(response.messages[0].daging_perut);
            
          	
              $("#EditDataTable1Form").unbind('submit').bind('submit', function(e) {

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
                        
                    
                        observerform_umpan_detail.ajax.reload(null,false);
                        
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




    function disableData(namafile = null,  no_ikan=null){

     if(namafile) {
      
      $("#hapusBtn").unbind('click').bind('click', function() {


          $.ajax({
                url: '<?php echo $url_delete_table1; ?>',
                type: 'post',
                data: {namafile : namafile ,  no_ikan : no_ikan  },
                dataType: 'json',
                success:function(response) {
                  console.log(response);
                     if (response.success == true) {       
                        $(".disable-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
                    
                    observerform_umpan_detail.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableTable1Modal').modal('hide');

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