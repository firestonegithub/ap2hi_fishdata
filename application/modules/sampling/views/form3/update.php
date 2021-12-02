   
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

                        echo form_open_multipart('sampling/mainpage/form3_update/'.$namafile.'/'.$kode_species,$attributes); 
                              ?>

           <div class="row">
            

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    <input type='hidden' name='namafile' value='<?php echo $namafile; ?>'>

                    <input type='hidden' name='k_species_awal' value='<?php echo $kode_species; ?>'>


                    <tr>
                            <th width='120px' scope='row'>Kategori Species</th>    
                            <td><select class="form-control" name="k_species" id="k_species">
                               <option value="">Select k_species</option>
                              <?php foreach($array_species as $key=>$value){ ?>
                                        <option value="<?php echo $key ; ?>" <?php if( !empty($post['k_species']) ){  if ( $post['k_species'] == $key ) { echo 'selected'; } } ?> ><?php echo $value ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>


                    
                       <tr>
                            <th width='120px' scope='row'> jumlah  </th>    
                            <td><input type='number' class='form-control' name='jumlah' id="jumlah" value="<?php if( !empty($post['jumlah']) ){ echo $post['jumlah']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                       <tr>
                            <th width='120px' scope='row'>berat </th>    
                            <td><input type='number' class='form-control' name='berat' id="berat" value="<?php if( !empty($post['berat']) ){ echo $post['berat']; } ?>" autocomplete=off ></td>
                    </tr>

                     
                       <tr>
                            <th width='120px' scope='row'>estimasi</th>    
                            <td>
                              
                              <select class='form-control' name='estimasi' id="estimasi">
                                  <option value="" >Silahkan Pilih</option>
                                    <option value="Y" <?php if( !empty($post['estimasi']) ){ if($post['estimasi'] == "Y"){ echo 'selected';  } } ?>>Y</option>
                                    <option value="T" <?php if( !empty($post['estimasi']) ){ if($post['estimasi'] == "T"){ echo 'selected';  } } ?>>T</option>
                                </select>

                            </td>
                    </tr>

                    <tr>
                            <th width='120px' scope='row'>panjang</th>    
                            <td><input type='text' class='form-control' name='panjang' id="panjang" value="<?php if( !empty($post['panjang']) ){ echo $post['panjang']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                       <tr>
                            <th width='120px' scope='row'>kode_panjang</th>    
                            <td>

                               <select class='form-control' name='kode_panjang' id="kode_panjang">
                                  <option value="" >Silahkan Pilih</option>
                                    <option value="FL" <?php if( !empty($post['kode_panjang']) ){ if($post['kode_panjang'] == "FL"){ echo 'selected';  } } ?>>PL</option>
                                    <option value="PS" <?php if( !empty($post['kode_panjang']) ){ if($post['kode_panjang'] == "PS"){ echo 'selected';  } } ?>>PS</option>
                                    <option value="PF" <?php if( !empty($post['kode_panjang']) ){ if($post['kode_panjang'] == "PF"){ echo 'selected';  } } ?>>PF</option>
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
                <a href="<?php echo base_url(); ?>sampling/mainpage/form3/<?php echo $namafile; ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>

 </div>