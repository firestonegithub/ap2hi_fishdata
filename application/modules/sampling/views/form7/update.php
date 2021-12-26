   
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">  <a href="<?php echo base_url()."sampling/mainpage/samplingapproved" ?>"> Lists Trip </a> </li>
        <li class="breadcrumb-item active">  <a href="<?php echo base_url()."sampling/mainpage/trip_detail/".$namafile ?>"> Trip Detail </a> </li>
        <li class="breadcrumb-item active"> <?php echo $page_name; ?> </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  <?php echo $page_name_detail; ?> </div>
        <div class="card-body">
          	
           <?php echo validation_errors(); ?>
                              <?php 
                               $attributes = array('class'=>'form-horizontal','role'=>'form');

                        echo form_open_multipart('sampling/mainpage/form7_update/'.$namafile,$attributes); 
                              ?>

           <div class="row">
            

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    <input type='hidden' name='namafile' value='<?php echo $namafile; ?>'>

                    
                    <tr>
                            <th width='120px' scope='row'> Pewawancara </th>    
                            <td><input type='text' class='form-control' name='e_pewawancara' id="e_pewawancara" value="<?php if( !empty($post['e_pewawancara']) ){ echo $post['e_pewawancara']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                     <tr>
                            <th width='120px' scope='row'> Umur </th>    
                            <td><input type='text' class='form-control' name='e_umur' id="e_umur" value="<?php if( !empty($post['e_umur']) ){ echo $post['e_umur']; } ?>" autocomplete=off ></td>
                    </tr>

                     
                     <tr>
                            <th width='120px' scope='row'> Lama Tahun Bekerja   </th>    
                            <td><input type='text' class='form-control' name='e_lama_tahun' id="e_lama_tahun" value="<?php if( !empty($post['e_lama_tahun']) ){ echo $post['e_lama_tahun']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                     <tr>
                            <th width='120px' scope='row'> Lama Bulan Bekerja </th>    
                            <td><input type='text' class='form-control' name='e_lama_bulan' id="e_lama_bulan" value="<?php if( !empty($post['e_lama_bulan']) ){ echo $post['e_lama_bulan']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                     <tr>
                            <th width='120px' scope='row'> Jabatan Terakhir </th>    
                            <td><input type='text' class='form-control' name='e_jabatan' id="e_jabatan" value="<?php if( !empty($post['e_jabatan']) ){ echo $post['e_jabatan']; } ?>" autocomplete=off ></td>
                    </tr>

                     
                     <tr>
                            <th width='120px' scope='row'> Keterangan </th>    
                            <td><input type='text' class='form-control' name='e_keterangan' id="e_keterangan" value="<?php if( !empty($post['e_keterangan']) ){ echo $post['e_keterangan']; } ?>" autocomplete=off ></td>
                    </tr>

                 
                    
            </tbody>

          </table>

        </div>


        

      </div>

        <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                <a href="<?php echo base_url(); ?>sampling/mainpage/trip_detail/<?php echo $namafile; ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>

    </form>
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
                                  <th> no. </th>
                                  <th> urut  </th>
                                  <th> k_species </th>
                                  <th> jml_interaksi </th>
                                  <th> jml_didaratkan </th>
                                  <th> est_interaksi  </th>
                                  <th> est_didaratkan </th>
                                  <th> Edit </th>
                                  <th> Delete </th>
                            </thead>

                             <tfoot>
                                <tr>
                                  <th> no. </th>
                                  <th> urut  </th>
                                  <th> k_species </th>
                                  <th> jml_interaksi </th>
                                  <th> jml_didaratkan </th>
                                  <th> est_interaksi  </th>
                                  <th> est_didaratkan </th>
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
            <center><h5 class="modal-title">Tambah ETP </h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_add_table1; ?>" method="post" id="AddDataTable1Form">
  <div class="modal-body">

        <div class="messages"></div>

        <div class="form-group">
          <label for="exampleInputEmail1">namafile</label>
          <input type="text" class="form-control" id="namafile" name="namafile" value="<?php echo $namafile; ?>"  autocomplete=off>
        </div>


          
        <div class="form-group">
          <label for="exampleInputEmail1">urut</label>
          <input type="text" class="form-control" id="urut" name="urut"  autocomplete=off>
        </div>

           
        <div class="form-group">
          <label for="exampleInputEmail1">k_species</label>
          <input type="text" class="form-control" id="k_species" name="k_species"  autocomplete=off>
        </div>

          
        <div class="form-group">
          <label for="exampleInputEmail1">jml_interaksi</label>
          <input type="text" class="form-control" id="jml_interaksi" name="jml_interaksi"  autocomplete=off>
        </div>

          
        <div class="form-group">
          <label for="exampleInputEmail1">jml_didaratkan</label>
          <input type="text" class="form-control" id="jml_didaratkan" name="jml_didaratkan"  autocomplete=off>
        </div>

           
        <div class="form-group">
          <label for="exampleInputEmail1">est_interaksi</label>
          <input type="text" class="form-control" id="est_interaksi" name="est_interaksi"  autocomplete=off>
        </div>
           
        <div class="form-group">
          <label for="exampleInputEmail1">est_didaratkan</label>
          <input type="text" class="form-control" id="est_didaratkan" name="est_didaratkan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_1</label>
          <input type="text" class="form-control" id="d_1" name="d_1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_2</label>
          <input type="text" class="form-control" id="d_2" name="d_2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_3</label>
          <input type="text" class="form-control" id="d_3" name="d_3"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_4</label>
          <input type="text" class="form-control" id="d_4" name="d_4"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_5</label>
          <input type="text" class="form-control" id="d_5" name="d_5"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_1</label>
          <input type="text" class="form-control" id="td_1" name="td_1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_2</label>
          <input type="text" class="form-control" id="td_2" name="td_2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_3</label>
          <input type="text" class="form-control" id="td_3" name="td_3"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_4</label>
          <input type="text" class="form-control" id="td_4" name="td_4"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_5</label>
          <input type="text" class="form-control" id="td_5" name="td_5"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dibuang</label>
          <input type="text" class="form-control" id="dibuang" name="dibuang"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dimakan</label>
          <input type="text" class="form-control" id="dimakan" name="dimakan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dijual</label>
          <input type="text" class="form-control" id="dijual" name="dijual"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">diumpan</label>
          <input type="text" class="form-control" id="diumpan" name="diumpan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">tidak_tahu</label>
          <input type="text" class="form-control" id="tidak_tahu" name="tidak_tahu"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">k_kelompok</label>
          <input type="text" class="form-control" id="k_kelompok" name="k_kelompok"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">namalokal</label>
          <input type="text" class="form-control" id="namalokal" name="namalokal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">yakin_lokal</label>
          <input type="text" class="form-control" id="yakin_lokal" name="yakin_lokal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">yakin_species</label>
          <input type="text" class="form-control" id="yakin_species" name="yakin_species"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">lokasi_interaksi</label>
          <input type="text" class="form-control" id="lokasi_interaksi" name="lokasi_interaksi"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r1</label>
          <input type="text" class="form-control" id="r1" name="r1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r2</label>
          <input type="text" class="form-control" id="r2" name="r2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r3</label>
          <input type="text" class="form-control" id="r3" name="r3"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">alat_etp</label>
          <input type="text" class="form-control" id="alat_etp" name="alat_etp"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">alat_lain</label>
          <input type="text" class="form-control" id="alat_lain" name="alat_lain"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">tangan</label>
          <input type="text" class="form-control" id="tangan" name="tangan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">kapal</label>
          <input type="text" class="form-control" id="kapal" name="kapal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">lainnya</label>
          <input type="text" class="form-control" id="lainnya" name="lainnya"  autocomplete=off>
        </div>
  

          <div class="form-group">
          <label for="exampleInputEmail1">interaksi</label>
          <input type="text" class="form-control" id="interaksi" name="interaksi"  autocomplete=off>
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
          <input type="text" class="form-control" id="edit_namafile" name="edit_namafile" value="<?php echo $namafile; ?>"  autocomplete=off>
        </div>


          
        <div class="form-group">
          <label for="exampleInputEmail1">urut</label>
          <input type="text" class="form-control" id="edit_urut" name="edit_urut"  autocomplete=off>
        </div>

           
        <div class="form-group">
          <label for="exampleInputEmail1">k_species</label>
          <input type="text" class="form-control" id="edit_k_species" name="edit_k_species"  autocomplete=off>
        </div>

          
        <div class="form-group">
          <label for="exampleInputEmail1">jml_interaksi</label>
          <input type="text" class="form-control" id="edit_jml_interaksi" name="edit_jml_interaksi"  autocomplete=off>
        </div>

          
        <div class="form-group">
          <label for="exampleInputEmail1">jml_didaratkan</label>
          <input type="text" class="form-control" id="edit_jml_didaratkan" name="edit_jml_didaratkan"  autocomplete=off>
        </div>

           
        <div class="form-group">
          <label for="exampleInputEmail1">est_interaksi</label>
          <input type="text" class="form-control" id="edit_est_interaksi" name="edit_est_interaksi"  autocomplete=off>
        </div>
           
        <div class="form-group">
          <label for="exampleInputEmail1">est_didaratkan</label>
          <input type="text" class="form-control" id="edit_est_didaratkan" name="edit_est_didaratkan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_1</label>
          <input type="text" class="form-control" id="edit_d_1" name="edit_d_1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_2</label>
          <input type="text" class="form-control" id="edit_d_2" name="edit_d_2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_3</label>
          <input type="text" class="form-control" id="edit_d_3" name="edit_d_3"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_4</label>
          <input type="text" class="form-control" id="edit_d_4" name="edit_d_4"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">d_5</label>
          <input type="text" class="form-control" id="edit_d_5" name="edit_d_5"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_1</label>
          <input type="text" class="form-control" id="edit_td_1" name="edit_td_1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_2</label>
          <input type="text" class="form-control" id="edit_td_2" name="edit_td_2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_3</label>
          <input type="text" class="form-control" id="edit_td_3" name="edit_td_3"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_4</label>
          <input type="text" class="form-control" id="edit_td_4" name="edit_td_4"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">td_5</label>
          <input type="text" class="form-control" id="edit_td_5" name="edit_td_5"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dibuang</label>
          <input type="text" class="form-control" id="edit_dibuang" name="edit_dibuang"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dimakan</label>
          <input type="text" class="form-control" id="edit_dimakan" name="edit_dimakan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">dijual</label>
          <input type="text" class="form-control" id="edit_dijual" name="edit_dijual"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">diumpan</label>
          <input type="text" class="form-control" id="edit_diumpan" name="edit_diumpan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">tidak_tahu</label>
          <input type="text" class="form-control" id="edit_tidak_tahu" name="edit_tidak_tahu"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">k_kelompok</label>
          <input type="text" class="form-control" id="edit_k_kelompok" name="edit_k_kelompok"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">namalokal</label>
          <input type="text" class="form-control" id="edit_namalokal" name="edit_namalokal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">yakin_lokal</label>
          <input type="text" class="form-control" id="edit_yakin_lokal" name="edit_yakin_lokal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">yakin_species</label>
          <input type="text" class="form-control" id="edit_yakin_species" name="edit_yakin_species"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">lokasi_interaksi</label>
          <input type="text" class="form-control" id="edit_lokasi_interaksi" name="edit_lokasi_interaksi"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r1</label>
          <input type="text" class="form-control" id="edit_r1" name="edit_r1"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r2</label>
          <input type="text" class="form-control" id="edit_r2" name="edit_r2"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">r3</label>
          <input type="text" class="form-control" id="edit_r3" name="edit_r3"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">alat_etp</label>
          <input type="text" class="form-control" id="edit_alat_etp" name="edit_alat_etp"  autocomplete=off>
        </div>
           
          <div class="form-group">
          <label for="exampleInputEmail1">alat_lain</label>
          <input type="text" class="form-control" id="edit_alat_lain" name="edit_alat_lain"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">tangan</label>
          <input type="text" class="form-control" id="edit_tangan" name="edit_tangan"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">kapal</label>
          <input type="text" class="form-control" id="edit_kapal" name="edit_kapal"  autocomplete=off>
        </div>
          
          <div class="form-group">
          <label for="exampleInputEmail1">lainnya</label>
          <input type="text" class="form-control" id="edit_lainnya" name="edit_lainnya"  autocomplete=off>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">interaksi</label>
          <input type="text" class="form-control" id="edit_interaksi" name="edit_interaksi"  autocomplete=off>
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

       alert('test0');
       
      $('#AddDataTable1Form').unbind('submit').bind('submit',function(e){

        alert('test');
        
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
                            //$('#AddDataTable1Form')[0].reset();
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




function editData(namafile = null, urut=null ){



  if(namafile){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         //$('#EditDataTable1Form')[0].reset();

         $.ajax({
            url: '<?php echo $url_show_table; ?>',
            type: 'post',
            data: {namafile : namafile , urut : urut  },
            dataType: 'json',
            success:function(response) {

     
                  $('#edit_namafile').val(response.messages[0].namafile);  
                  $('#edit_urut').val(response.messages[0].urut); 
                  $('#edit_k_species').val(response.messages[0].k_species);  
                  $('#edit_jml_interaksi').val(response.messages[0].jml_interaksi); 
                  $('#edit_jml_didaratkan').val(response.messages[0].jml_didaratkan); 
                  $('#edit_est_interaksi').val(response.messages[0].est_interaksi);  
                  $('#edit_est_didaratkan').val(response.messages[0].est_didaratkan);  
                  $('#edit_d_1').val(response.messages[0].d_1); 
                  $('#edit_d_2').val(response.messages[0].d_2); 
                  $('#edit_d_3').val(response.messages[0].d_3); 
                  $('#edit_d_4').val(response.messages[0].d_4); 
                  $('#edit_d_5').val(response.messages[0].d_5); 
                  $('#edit_td_1').val(response.messages[0].td_1); 
                  $('#edit_td_2').val(response.messages[0].td_2); 
                  $('#edit_td_3').val(response.messages[0].td_3); 
                  $('#edit_td_4').val(response.messages[0].td_4); 
                  $('#edit_td_5').val(response.messages[0].td_5); 
                  $('#edit_dibuang').val(response.messages[0].dibuang); 
                  $('#edit_dimakan').val(response.messages[0].dimakan); 
                  $('#edit_dijual').val(response.messages[0].dijual); 
                  $('#edit_diumpan').val(response.messages[0].diumpan); 
                  $('#edit_tidak_tahu').val(response.messages[0].tidak_tahu); 
                  $('#edit_k_kelompok').val(response.messages[0].k_kelompok); 
                  $('#edit_namalokal').val(response.messages[0].namalokal); 
                  $('#edit_yakin_lokal').val(response.messages[0].yakin_lokal); 
                  $('#edit_yakin_species').val(response.messages[0].yakin_species); 
                  $('#edit_lokasi_interaksi').val(response.messages[0].lokasi_interaksi); 
                  $('#edit_r1').val(response.messages[0].r1); 
                  $('#edit_r2').val(response.messages[0].r2); 
                  $('#edit_r3').val(response.messages[0].r3); 
                  $('#edit_alat_etp').val(response.messages[0].alat_etp);  
                  $('#edit_alat_lain').val(response.messages[0].alat_lain);  
                  $('#edit_tangan').val(response.messages[0].tangan); 
                  $('#edit_kapal').val(response.messages[0].kapal); 
                  $('#edit_lainnya').val(response.messages[0].lainnya); 
                  $('#edit_interaksi').val(response.messages[0].interaksi); 
            
            
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



  function disableData(namafile = null,  urut=null){

     if(namafile) {
      
      $("#hapusBtn").unbind('click').bind('click', function() {


          $.ajax({
                url: '<?php echo $url_delete_table1; ?>',
                type: 'post',
                data: {namafile : namafile ,  urut : urut  },
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
