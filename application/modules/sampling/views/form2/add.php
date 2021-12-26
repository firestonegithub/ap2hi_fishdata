   
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
          	
           <?php echo validation_errors(); ?>
                              <?php 
                               $attributes = array('class'=>'form-horizontal','role'=>'form');

                        echo form_open_multipart('sampling/mainpage/form2_add/'.$namafile,$attributes); 
                              ?>

           <div class="row">
            

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    <input type='hidden' name='namafile' value='<?php echo $namafile; ?>'>


                    <tr>
                            <th width='120px' scope='row'>Kategori Umpan</th>    
                            <td><select class="form-control" name="k_umpan" id="k_umpan">
                               <option value="">Select k_umpan</option>
                              <?php foreach($k_umpan as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($post['k_umpan']) ){  if ( $post['k_umpan'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>


                   

                     <tr>
                            <th width='120px' scope='row'> Jenis Species Umpan </th>    
                            <td><select class="form-control" name="species" id="species">
                               <option value="">Select species</option>
                              <?php foreach($species as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($post['species']) ){  if ( $post['species'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>

                     <tr>
                             <th width='120px' scope='row'>Daerah Penangkapan  </th>    
                            <td>

                            <div class="row">
                               <div class='col-md-6'>

                              <select class="form-control" name="grid1" id="grid1">
                               <option value="">Select Grid 1</option>
                              <?php foreach($grid_1 as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($post['grid1']) ){  if ( $post['grid1'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                               </div> 

                               <div class='col-md-6'>
                                
                              <select class="form-control" name="grid2" id="grid2">
                               <option value="">Select Grid 2</option>
                              <?php for($i=0;$i<=49;$i++){ ?>
                                        <option value="<?php echo $i ; ?>" <?php if( !empty($post['grid2']) ){  if ( $post['grid2'] == $i ) { echo 'selected'; } } ?> ><?php echo $i ; ?></option>
                                       <?php  } ?>
                                 </select>

                              

                              </div> 


                            </div>

                            </td>
                    </tr>

              


                    
                       <tr>
                            <th width='120px' scope='row'>Jumlah Ember Umpan (Buah) </th>    
                            <td><input type='number' class='form-control' name='pl_jum_ember' id="pl_jum_ember" value="<?php if( !empty($post['pl_jum_ember']) ){ echo $post['pl_jum_ember']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                       <tr>
                            <th width='120px' scope='row'>Estimasi Umpan (Kg) </th>    
                            <td><input type='number' class='form-control' name='estimasi' id="estimasi" value="<?php if( !empty($post['estimasi']) ){ echo $post['estimasi']; } ?>" autocomplete=off ></td>
                    </tr>

                     
                       <tr>
                            <th width='120px' scope='row'>Estimasi Umpan  (Ekor)</th>    
                            <td><input type='number' class='form-control' name='hl_estimasi_ekor_umpan' id="hl_estimasi_ekor_umpan" value="<?php if( !empty($post['hl_estimasi_ekor_umpan']) ){ echo $post['hl_estimasi_ekor_umpan']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                       <tr>
                            <th width='120px' scope='row'>Alat Tangkap Umpan</th>    
                            <td>


                               <select class="form-control" name="k_alattangkap" id="k_alattangkap">
                               <option value="">Select Alat Tangkap </option>
                              <?php foreach($k_alattangkap as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($post['k_alattangkap']) ){  if ( $post['k_alattangkap'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>


            </tbody>

          </table>

        </div>


        

      </div>
    </div> 
  </div>

  <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                <a href="<?php echo base_url(); ?>sampling/mainpage/form2/<?php echo $namafile; ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>

 </div>