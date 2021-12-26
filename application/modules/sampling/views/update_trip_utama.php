      <link rel="stylesheet" href="http://localhost/ap2hi_fishdata/media/backend/vendor/bootstrapDatePicker/datepicker.min.css" />
    <link rel="stylesheet" href="http://localhost/ap2hi_fishdata/media/backend/vendor/bootstrapDatePicker/datepicker3.min.css" />
    <script src="http://localhost/ap2hi_fishdata/media/backend/vendor/bootstrapDatePicker/bootstrap-datepicker.min.js"></script>


    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url()."home/" ?>">Dashboard</a>
        </li>
        <?php if($tripDetail['status_trip'] == '1'){ ?>
        <li class="breadcrumb-item active">  <a href="<?php echo base_url()."sampling/mainpage/samplingapproved" ?>"> Lists Trip </a> </li>
        <?php } ?>

        <?php if($tripDetail['status_trip'] == '2'){ ?>
        <li class="breadcrumb-item active">  <a href="<?php echo base_url()."sampling/mainpage/samplingdraft" ?>"> Lists Trip </a> </li>
         <?php } ?>

        <li class="breadcrumb-item active">  Update Trip </li>
      </ol>


      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Add New Trip <b><?php echo strtoupper($tipe); ?></b> </div>
        <div class="card-body">

            <?php if( count( $notification) > 0 ) { ?>

              <div class="alert alert-warning">
                <center>
                  <?php foreach($notification as $notif){ echo $notif; echo '<br>'; } ;?>
              </center>
              </div>


            <?php } ?>

                <?php if($tripDetail['status_trip'] == '1'){ ?>
                                <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>sampling/mainpage/cancel_approve/<?php echo $namafile; ?>' onclick="return confirm('Are you sure you want to Cancel Approve this Trip ?');" ><span class='fa fa-plus-square-o'> </span>Cancel Approve Data</a>
                              
                <?php } ?>

                <?php if($tripDetail['status_trip'] == '2'){ ?>
                                <a class='pull-right btn btn-warning btn-sm' href='<?php echo base_url(); ?>sampling/mainpage/approve/<?php echo $namafile; ?>' onclick="return confirm('Are you sure you want to Approve this Trip ?');" ><span class='fa fa-plus-square-o'> </span>Approve Data</a>
                                 
                <?php } ?>


        	  <?php echo validation_errors(); ?>
                              <?php 
                               $attributes = array('class'=>'form-horizontal','role'=>'form');

                        echo form_open_multipart('sampling/mainpage/trip_detail/'.$namafile,$attributes); 
                              ?>


        <div class="row">
            

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    <input type='hidden' name='tipe' value='<?php echo $tipe; ?>'>

                    <input type='hidden' name='namafile' value='<?php echo $namafile; ?>'>


                    <tr>
                            <th width='120px' scope='row'>Tempat Pendaratan (*)</th>    
                            <td><select class="form-control" name="k_landing" id="k_landing">
                            	 <option value="">Select Landing</option>
                            	<?php foreach($record_landings->result() as $row){ ?>
                                        <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($tripDetail['k_landing']) ){  if ( $tripDetail['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>
                    
                     
                     <tr>
                            <th width='120px' scope='row'>Nama Perusahaan </th>    
                            <td><select class="form-control" name="k_perusahaan" id="k_perusahaan">
                            	 <option value="">Select Supplier</option>
                            	<?php foreach($record_suppliers->result() as $row){ ?>
                                        <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($tripDetail['k_perusahaan']) ){  if ( $tripDetail['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
                                       <?php  } ?>
                                 </select>
                            </td>
                    </tr>

                    
                    <tr>
                            <th width='120px' scope='row'>Enumerator 1</th>    
                            <td><input type='text' class='form-control' name='enumerator1' id="enumerator1" value="<?php if( !empty($tripDetail['enumerator1']) ){ echo $tripDetail['enumerator1']; } ?>" autocomplete=off></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Enumerator 2</th>    
                            <td><input type='text' class='form-control' name='enumerator2' id="enumerator2" value="<?php if( !empty($tripDetail['enumerator2']) ){ echo $tripDetail['enumerator2']; } ?>" autocomplete=off></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>No Sipi/BPKP</th>    
                            <td><input type='text' class='form-control' name='no_sipi' id="no_sipi" value="<?php if( !empty($tripDetail['no_sipi']) ){ echo $tripDetail['no_sipi']; } ?>" autocomplete=off></td>
                    </tr>

                    <tr>
                            <th width='120px' scope='row'>Nama Kapal From Db</th>    
                            <td><select class="form-control" name="id_vessel" id="id_vessel">
                                   <option value="<?php if( !empty($tripDetail['id_vessel']) ){ echo $tripDetail['id_vessel']; } ?>"><?php if( !empty($tripDetail['id_vessel']) ){ echo $vesselData['nama_kapal'];  }else{ echo 'Select vessel'; } ?> </option>

                                </select></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Nama Kapal</th>    
                            <td><input type='text' class='form-control' name='nama_kapal' id="nama_kapal" value="<?php if( !empty($tripDetail['nama_kapal']) ){ echo $tripDetail['nama_kapal']; } ?>" autocomplete=off></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Nama Kapten</th>    
                            <td><input type='text' class='form-control' name='kapten_kapal' id="kapten_kapal" value="<?php if( !empty($tripDetail['kapten_kapal']) ){ echo $tripDetail['kapten_kapal']; } ?>" autocomplete=off></td>
                    </tr>
					
					           <tr>
                            <th width='120px' scope='row'>Rumpon</th>    
                            <td>
                              <select class='form-control' name='rumpon' id="rumpon">
                                  <option value="" >Silahkan Pilih</option>
                                    <option value="F" <?php if( !empty($tripDetail['rumpon']) ){ if($tripDetail['rumpon'] == "F"){ echo 'selected';  } } ?>>F (Semua di rumpon) </option>
                                    <option value="X" <?php if( !empty($tripDetail['rumpon']) ){ if($tripDetail['rumpon'] == "X"){ echo 'selected';  } } ?>>X (Sebagian di rumpon)</option>
                                    <option value="N" <?php if( !empty($tripDetail['rumpon']) ){ if($tripDetail['rumpon'] == "N"){ echo 'selected';  } } ?>>N (Tidak di rumpon)</option>
                                </select>

                            </td>
                    </tr>
					
					           <tr>
                            <th width='120px' scope='row'>Total Penangkapan </th>    
                            <td><input type='text' class='form-control' name='total_penangkapan' id="total_penangkapan" value="<?php if( !empty($tripDetail['total_penangkapan']) ){ echo $tripDetail['total_penangkapan']; } ?>" autocomplete=off></td>
                    </tr>
					
					           <tr>
                            <th width='120px' scope='row'>Estimasi Ikan Hilang </th>    
                            <td><input type='text' class='form-control' name='est_ikanhilang' id="est_ikanhilang" value="<?php if( !empty($tripDetail['est_ikanhilang']) ){ echo $tripDetail['est_ikanhilang']; } ?>" autocomplete=off></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Daerah Penangkapan  </th>    
                            <td>

                            <div class="row">
                               <div class='col-md-6'>

                              <select class="form-control" name="grid11" id="grid11">
                               <option value="">Select Grid 1</option>
                              <?php foreach($grid_1 as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($tripDetail['grid11']) ){  if ( $tripDetail['grid11'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>


                              <select class="form-control" name="grid21" id="grid21">
                               <option value="">Select Grid 1</option>
                              <?php foreach($grid_1 as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($tripDetail['grid21']) ){  if ( $tripDetail['grid21'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                                  

                                 

                               </div>

                              <div class='col-md-6'>
                                
                              <select class="form-control" name="grid12" id="grid12">
                               <option value="">Select Grid 2</option>
                              <?php for($i=0;$i<=49;$i++){ ?>
                                        <option value="<?php echo $i ; ?>" <?php if( !empty($tripDetail['grid12']) ){  if ( $tripDetail['grid12'] == $i ) { echo 'selected'; } } ?> ><?php echo $i ; ?></option>
                                       <?php  } ?>
                                 </select>

                                 <select class="form-control" name="grid22" id="grid22">
                               <option value="">Select Grid 2</option>
                              <?php for($i=0;$i<=49;$i++){ ?>
                                        <option value="<?php echo $i ; ?>" <?php if( !empty($tripDetail['grid22']) ){  if ( $tripDetail['grid22'] == $i ) { echo 'selected'; } } ?> ><?php echo $i ; ?></option>
                                       <?php  } ?>
                                 </select>
                       

                              </div>              
                            </div>

                            </td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>tgl sampling </th>    
                            <td><input type='text' class='form-control' name='sampling_date' id="sampling_date" value="<?php if( !empty($sampling_date) ){ echo $sampling_date; } ?>" autocomplete=off>
                            </td>
                    </tr>
					 
					<tr>
                            <th width='120px' scope='row'>waktu sampling </th>    
                            <td><input type='time' class='form-control' name='sampling_time' id="sampling_time" value="<?php if( !empty($sampling_time) ){ echo $sampling_time; } ?>" autocomplete=off> </td>
                    </tr>

                    </tbody>
                  </table>
                </div>
        

        		 <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    
                    <tr>
                            <th width='120px' scope='row'>kapasitas mesin</th>    
                            <td><input type='text' class='form-control' name='mesin_kapal' id="mesin_kapal" value="<?php if( !empty($tripDetail['mesin_kapal']) ){ echo $tripDetail['mesin_kapal']; } ?>" autocomplete=off ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Kapasitas kapal (GT)</th>    
                            <td><input type='text' class='form-control' name='gt_kapal' id="gt_kapal" value="<?php if( !empty($tripDetail['gt_kapal']) ){ echo $tripDetail['gt_kapal']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Panjang Kapal (m)</th>    
                            <td><input type='text' class='form-control' name='panjang_kapal' id="panjang_kapal" value="<?php if( !empty($tripDetail['panjang_kapal']) ){ echo $tripDetail['panjang_kapal']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Jumlah Rumpon</th>    
                            <td><input type='text' class='form-control' name='jumlah_rumpon_singgah' id="jumlah_rumpon_singgah" value="<?php if( !empty($tripDetail['jumlah_rumpon_singgah']) ){ echo $tripDetail['jumlah_rumpon_singgah']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Lama trip </th>    
                            <td><input type='text' class='form-control' name='lama_trip' id="lama_trip" value="<?php if( !empty($lama_trip) ){ echo $lama_trip; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Satuan Trip </th>    
                            <td>

                           	<select class="form-control" name="satuan_trip" id="satuan_trip">
                              <option value="" >Silahkan Pilih</option>
                                    <option value="hari" <?php if( !empty($tripDetail['lama_satuan']) ){ if($tripDetail['lama_satuan'] == "hari"){ echo 'selected';  } } ?>> hari </option>
                                     <option value="jam" <?php if( !empty($tripDetail['lama_satuan']) ){ if($tripDetail['lama_satuan'] == "jam"){ echo 'selected';  } } ?>> jam </option>
                                 </select>

                            </td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Ukuran Mata Pancing</th>    
                            <td><input type='text' class='form-control' name='ukuran_pancing' id="ukuran_pancing" value="<?php if( !empty($tripDetail['ukuran_pancing']) ){ echo $tripDetail['ukuran_pancing']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>Alat tangkap lain</th>    
                            <td><input type='text' class='form-control' name='hl_alat_tangkap_lain' id="hl_alat_tangkap_lain" value="<?php if( !empty($tripDetail['hl_alat_tangkap_lain']) ){ echo $tripDetail['hl_alat_tangkap_lain']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>bahan kapal</th>    
                            <td>

                               <select class="form-control" name="bahan_kapal" id="bahan_kapal">
                               <option value="">Select bahan_kapal</option>
                              <?php foreach($bahan_kapal_drop as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($tripDetail['bahan_kapal']) ){  if ( $tripDetail['bahan_kapal'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                            </td>
                    </tr>
                    
                    <tr>
                            <th width='120px' scope='row'>penggunaan bbm</th>    
                            <td><input type='text' class='form-control' name='bbm' id="bbm" value="<?php if( !empty($tripDetail['bbm']) ){ echo $tripDetail['bbm']; } ?>" autocomplete=off ></td>
                    </tr>
					
					          <tr>
                            <th width='120px' scope='row'>teknik cari tuna</th>    
                            <td>

                             <div class="row">
                               <div class='col-md-6'>
    

                                  <select class="form-control" name="teknik_cari_tuna1" id="teknik_cari_tuna1">
                               <option value="">Select teknik_cari_tuna1</option>
                              <?php foreach($teknik_cari_tuna_drop as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($tripDetail['teknik_cari_tuna1']) ){  if ( $tripDetail['teknik_cari_tuna1'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                                </div>

                                


                                 <div class='col-md-6'>
                                

                                  <select class="form-control" name="teknik_cari_tuna2" id="teknik_cari_tuna2">
                               <option value="">Select teknik_cari_tuna2</option>
                              <?php foreach($teknik_cari_tuna_drop as $loop){ ?>
                                        <option value="<?php echo $loop ; ?>" <?php if( !empty($tripDetail['teknik_cari_tuna2']) ){  if ( $tripDetail['teknik_cari_tuna2'] == $loop ) { echo 'selected'; } } ?> ><?php echo $loop ; ?></option>
                                       <?php  } ?>
                                 </select>

                                </div>
                              </div>

                            </td>
                    </tr>

                    <tr>
                            <th width='120px' scope='row'>tgl Berangkat</th>    
                            <td><input type='text' class='form-control' name='tanggal_berangkat' id="tanggal_berangkat" value="<?php if( !empty($tripDetail['tanggal_berangkat']) ){ echo $tripDetail['tanggal_berangkat']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					<tr>
                            <th width='120px' scope='row'>tgl kembali</th>    
                            <td><input type='text' class='form-control' name='tanggal_kembali' id="tanggal_kembali" value="<?php if( !empty($tripDetail['tanggal_kembali']) ){ echo $tripDetail['tanggal_kembali']; } ?>" autocomplete=off  ></td>
                    </tr>

          			</tbody>
                  </table>
                </div>
                  

            <div class='col-md-4'>
                  <table class='table table-condensed table-bordered'>

                  <tbody>

                    
                     <tr>
                            <th width='120px' scope='row'>jumlah hari memancing</th>    
                            <td><input type='text' class='form-control' name='jumlah_hari_memancing' id="jumlah_hari_memancing" value="<?php if( !empty($tripDetail['jumlah_hari_memancing']) ){ echo $tripDetail['jumlah_hari_memancing']; } ?>" autocomplete=off  ></td>
                    </tr>

                    <tr>
                            <th width='120px' scope='row'>Penggunaan Es</th>    
                            <td><input type='text' class='form-control' name='es' id="es" value="<?php if( !empty($tripDetail['es']) ){ echo $tripDetail['es']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					 <tr>
                            <th width='120px' scope='row'>Jumlah Awak Kapal</th>    
                            <td><input type='text' class='form-control' name='jum_awak' id="jum_awak" value="<?php if( !empty($tripDetail['jum_awak']) ){ echo $tripDetail['jum_awak']; } ?>" autocomplete=off  ></td>
                    </tr>

                     <?php if($tipe == 'HL'){ ?>
						
					<tr>
                            <th width='120px' scope='row'>Jumlah Pakura / Sampan (HL)</th>    
                            <td><input type='text' class='form-control' name='jumlah_pakura' id="jumlah_pakura" value="<?php if( !empty($tripDetail['jumlah_pakura']) ){ echo $tripDetail['jumlah_pakura']; } ?>" autocomplete=off  ></td>
                    </tr>

                     <tr>
                            <th width='120px' scope='row'>tipe mata pancing (HL)</th>    
                            <td>

                              <select class='form-control' name='hl_tipe_mata_pancing' id="hl_tipe_mata_pancing">
                                  <option value="" >Silahkan Pilih</option>
                                    <option value="Satu" <?php if( !empty($tripDetail['hl_tipe_mata_pancing']) ){ if($tripDetail['hl_tipe_mata_pancing'] == "Satu"){ echo 'selected';  } } ?>> Satu  </option>
                                    <option value="Banyak" <?php if( !empty($tripDetail['hl_tipe_mata_pancing']) ){ if($tripDetail['hl_tipe_mata_pancing'] == "Banyak"){ echo 'selected';  } } ?>> Banyak  </option>
                                    <option value="Campuran" <?php if( !empty($tripDetail['hl_tipe_mata_pancing']) ){ if($tripDetail['hl_tipe_mata_pancing'] == "Campuran"){ echo 'selected';  } } ?>> Campuran  </option>
                                </select>

                            </td>

                            <input type='hidden' name='pl_kapasitas_ember' value='0'>

                            <input type='hidden' name='pl_jum_pancing' value='0'>


                            
                    </tr>

                	<?php } ?>

                    <?php if($tipe == 'PL'){ ?>
						
					 <tr>
                            <th width='120px' scope='row'>kapasitas ember umpan (PL)</th>    
                            <td><input type='text' class='form-control' name='pl_kapasitas_ember' id="pl_kapasitas_ember" value="<?php if( !empty($tripDetail['pl_kapasitas_ember']) ){ echo $tripDetail['pl_kapasitas_ember']; } ?>" autocomplete=off  ></td>
                    </tr>
					
					 <tr>
                            <th width='120px' scope='row'>jumlah joran (PL)</th>    
                            <td><input type='text' class='form-control' name='pl_jum_pancing' id="pl_jum_pancing" value="<?php if( !empty($tripDetail['pl_jum_pancing']) ){ echo $tripDetail['pl_jum_pancing']; } ?>" autocomplete=off  ></td>

                            <input type='hidden' name='jumlah_pakura' value='0'>

                            <input type='hidden' name='hl_tipe_mata_pancing' value='0'> 

                            
                    </tr>
					 
					 <?php } ?>	
					
          			</tbody>
                  </table>
                </div>
                

        </div>    <!-- End Row -->


       
           

         <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                <a href="<?php echo base_url(); ?>sampling/mainpage/samplingapproved"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
         </div>
    </div>

  </div>	


 <div class="container-fluid">
      <!-- Breadcrumbs-->
            <div class="row">

              <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-calendar"></i>
                    </div>
                    <div class="mr-5"> Form Umpan </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form2 ; ?>"  target="_BLANK">
                    <span class="float-left"><center>Umpan </center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>

               <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-id-badge"></i>
                    </div>
                    <div class="mr-5"> Form Tangkapan Lain </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form3 ; ?>"  target="_BLANK">
                    <span class="float-left"><center>Tangkapan Lain</center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>


               <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-anchor"></i>
                    </div>
                    <div class="mr-5"> Form Kategori Tangkapan Utama </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form4 ; ?>"  target="_BLANK">
                    <span class="float-left"><center>(Tuna < 10kg ) </center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>


               <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-ship"></i>
                    </div>
                    <div class="mr-5"> Form Kategori Tangkapan Utama</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form5 ; ?>"  target="_BLANK">
                    <span class="float-left"><center> (Tuna > 10kg ) </center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>

               <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-tags"></i>
                    </div>
                    <div class="mr-5"> Deskripsi </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form6 ; ?>"  target="_BLANK">
                    <span class="float-left"><center>Deskripsi mengenai sampling</center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>


               <div class="col-xl-4 col-sm-6 mb-4">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-life-buoy"></i>
                    </div>
                    <div class="mr-5"> ETP </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="<?php echo $link_form7 ; ?>"  target="_BLANK">
                    <span class="float-left"><center>Spesies Genting, Terancam Punah and Dilindungi</center> </span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>


               

            </div> 

           </div> 

  <!-- For DatePicker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
 $( function() {
    $( "#tanggal_berangkat" ).datepicker(
    {   
        dateFormat: 'yy-mm-dd', 
        minDate: "-365D",
        maxDate: 0,
        numberOfMonths: 2,
        onSelect: function(selected) {
          $("#tanggal_berangkat").datepicker("option","minDate", selected)
        }
    });

     $( "#tanggal_kembali" ).datepicker({

        dateFormat: 'yy-mm-dd', 
        minDate: "-365D",
        maxDate: 0,
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#tanggal_kembali").datepicker("option","maxDate", selected)
        }

         
     });

        $( "#sampling_date" ).datepicker(
    {   
        dateFormat: 'yy-mm-dd', 
        minDate: "-365D",
        maxDate: 0,
        numberOfMonths: 2
    });


  } );


$(document).ready(function() {

     /* Dropdown Dinamic */
   $("#k_perusahaan").change(function(){

        var id = $("#k_perusahaan").val();
       

       $("#id_vessel").html('<option value="">Select Vessel</option>');

       //alert(id); 

       $('#no_sipi').val('');
       $('#nama_kapal').val('');
       $('#kapten_kapal').val('');
       $('#mesin_kapal').val('');
       $('#bahan_kapal').val('');
       $('#jum_awak').val('');



        $.ajax({
            type: "tripDetail",
            dataType: "html",
            url: "<?php echo $load_vessel_from_id_supplier; ?>",
            data: "id="+id,
            success: function(msg){

                if(msg == ''){
                    $("#id_vessel").html('<option value="">Select Vessel</option>');

                }else{
                    $("#id_vessel").html(msg);                                                     
                }
            },
             error : function(req, status, error) {


         				alert("Fail calling vessel from supplier "+ id);

        },
        });    
    });


   $("#id_vessel").change(function(){

        var id = $("#id_vessel").val();
       
        //alert(id); 


        $.ajax({
            url: "<?php echo $select_vessel_from_id_supplier; ?>",
            type: 'tripDetail',
            data: {id : id },
            dataType: 'json',
            success: function(response){

                console.log(response);

                
                $('#no_sipi').val(response.messages[0].no_sipi);
                $('#nama_kapal').val(response.messages[0].nama_kapal);
                $('#kapten_kapal').val(response.messages[0].nama_kapten);
                $('#mesin_kapal').val(response.messages[0].kapasitas_mesin_utama);
             	$('#bahan_kapal').val(response.messages[0].bahan);
             	$('#jum_awak').val(response.messages[0].jumlah_abk);
            }
        });    
    });

 } );

  </script>