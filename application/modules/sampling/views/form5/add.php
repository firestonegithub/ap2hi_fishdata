   
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

                        echo form_open_multipart('sampling/mainpage/form5_add/'.$namafile,$attributes); 
                              ?>

           <div class="row">
            

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    <input type='hidden' name='namafile' value='<?php echo $namafile; ?>'>

                    
                    <tr>
                            <th width='120px' scope='row'>Kode</th>    
                            <td><input type='text' class='form-control' name='kode' id="kode" value="<?php if( !empty($post['kode']) ){ echo $post['kode']; } ?>" autocomplete=off ></td>
                    </tr>


                    
                       <tr>
                            <th width='120px' scope='row'> deskripsi  </th>    
                            <td><input type='text' class='form-control' name='deskripsi' id="deskripsi" value="<?php if( !empty($post['deskripsi']) ){ echo $post['deskripsi']; } ?>" autocomplete=off ></td>
                    </tr>

                    
                       <tr>
                            <th width='120px' scope='row'>berat </th>    
                            <td><input type='text' class='form-control' name='berat' id="berat" value="<?php if( !empty($post['berat']) ){ echo $post['berat']; } ?>" autocomplete=off ></td>
                    </tr>
            </tbody>

          </table>

        </div>


        

      </div>
    </div> 
  </div>

  <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                 <a href="<?php echo base_url(); ?>sampling/mainpage/form5/<?php echo $namafile; ?>"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>

 </div>