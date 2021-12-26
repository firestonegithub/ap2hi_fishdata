<div class="container-fluid">


  
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>


<!-- ----------------- Lenght Frequency ------------------------------------------  -->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> <b> Grafik length frequency per spesies </b> </div>
        <div class="card-body">


  <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
     <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
          <div class="col-sm-10">
          <select class="form-control" id="tipe_gear" name="tipe_gear">
          <option value="">  </option>
          <option value="HL"> HL </option>
          <option value="PL"> PL </option>
     
        </select>
          </div>
      </div>
    <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Species </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="species" name="species">
          <option value=""> </option>
          <option value="YFT"> Thunnus albacares </option>
          <option value="SKJ"> Katsuwonus pelamis </option>
          <option value="ALB"> Thunnus alalunga </option>
          <option value="BET"> Thunnus obesus </option>
       
        </select>
          </div>
      </div>



      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="tahun" name="tahun">

              <option value=""> </option>

                <?php for($i=2015;$i<=date('Y');$i++){ ?>
                    
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                    
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="bulan" name="bulan">

            <option value=""> </option>

                <?php for($i=1;$i<=12;$i++){ ?>
                    
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                    
                <?php } ?>
       
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="tanggal" name="tanggal">

            <option value=""> </option>

                <?php for($i=1;$i<=31;$i++){ ?>
                    
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                    
                <?php } ?>
       
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="k_landing" name="k_landing">

               <option value=""> </option>

              <?php foreach($record_landings->result() as $row){ ?>
                                        <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
                                       <?php  } ?>
       
          </select>
          </div>
      </div>



      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="k_perusahaan" name="k_perusahaan">

             <option value=""> </option>

              <?php foreach($record_suppliers->result() as $row){ ?>
                                        <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
                                       <?php  } ?>
       
          </select>
          </div>
      </div>
  
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphLFD">Search!</button> </center> </div>
  </form>

   <div class="messages"></div>  

          <canvas id="chartDataLFD" width="100%" height="30"></canvas>
          <canvas id="chartDataLFDDinamic" width="100%" height="30"></canvas>
          
        </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>


<!-- ----------------- Weight Frequency ------------------------------------------  -->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> <b> Grafik Weight frequency per spesies </b> </div>
        <div class="card-body">

            <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
     <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
          <div class="col-sm-10">
          <select class="form-control" id="tipe_gear2" name="tipe_gear2">
          <option value="">  </option>
          <option value="HL"> HL </option>
          <option value="PL"> PL </option>
     
        </select>
          </div>
      </div>
    <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Species </label>
          <div class="col-sm-10">
      
           <select class="form-control" id="species2" name="species2">
          <option value=""> </option>
          <option value="YFT"> Thunnus albacares </option>
          <option value="SKJ"> Katsuwonus pelamis </option>
          <option value="ALB"> Thunnus alalunga </option>
          <option value="BET"> Thunnus obesus </option>
       
        </select>
          </div>
      </div>


          <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun2" name="tahun2">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan2" name="bulan2">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal2" name="tanggal2">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing2" name="k_landing2">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan2" name="k_perusahaan2">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>
  
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphWFD">Search!</button> </center> </div>
  </form>

             <div class="messagesWFD"></div>  

          <canvas id="chartDataWFD" width="100%" height="30"></canvas>
          <canvas id="chartDataWFDDinamic" width="100%" height="30"></canvas>
          
        </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>



<div class="row">

      <div class="col-lg-12">
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i><b> Grafik perbandingan komposisi umpan </b> </div>
        <div class="card-body">

     <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
     <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
          <div class="col-sm-10">
          <select class="form-control" id="tipe_gear4" name="tipe_gear4">
          <option value="">  </option>
          <option value="HL"> HL </option>
          <option value="PL"> PL </option>
     
        </select>
          </div>
      </div>


          <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun4" name="tahun4">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan4" name="bulan4">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal4" name="tanggal4">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing4" name="k_landing4">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan4" name="k_perusahaan4">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>

  
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphbaitComp">Search!</button> </center> </div>
  </form>

          <div class="messagesbaitComp"></div>    
          <canvas id="baitComp" width="800" height="450"></canvas>
          <canvas id="baitCompDinamic" width="800" height="450"></canvas>  

          </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>
</div>


</div>






<div class="row">

          <div class="col-lg-6">

    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i><b> Grafik perbandingan komposisi tangkapan </b> </div>
        <div class="card-body">

     <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
     <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
          <div class="col-sm-10">
          <select class="form-control" id="tipe_gear3" name="tipe_gear3">
          <option value="">  </option>
          <option value="HL"> HL </option>
          <option value="PL"> PL </option>
     
        </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun3" name="tahun3">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan3" name="bulan3">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal3" name="tanggal3">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing3" name="k_landing3">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan3" name="k_perusahaan3">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>

  
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphcatchComp">Search!</button> </center> </div>
  </form>

 <div class="messagescatchComp"></div>  

          <canvas id="catchComp" width="800" height="450"></canvas>
          <canvas id="catchCompDinamic" width="100%" height="30"></canvas>

          </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>

      </div>

        <div class="col-lg-6">
          <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> <b> Grafik perbandingan komposisi total hasil tangkapan dan total penggunaan umpan </b></div>
          <div class="card-body">

      <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
       <div class="form-group"> <!-- here add class has-error -->
            <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
            <div class="col-sm-10">
            <select class="form-control" id="tipe_gear5" name="tipe_gear5">
            <option value="">  </option>
            <option value="HL"> HL </option>
            <option value="PL"> PL </option>
       
          </select>
            </div>
        </div>


        <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun5" name="tahun5">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan5" name="bulan5">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal5" name="tanggal5">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing5" name="k_landing5">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan5" name="k_perusahaan5">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>

  
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphpieUmpan">Search!</button> </center> </div>
  </form>
          
          
          <div class="messagespieUmpan"></div>  
           <canvas id="pieUmpan" width="800" height="450"></canvas>
           <canvas id="pieUmpanDinamic" width="800" height="450"></canvas>

          </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>

    </div>
  </div>



  <div class="row">
    <div class="col-lg-12">

      <div class="card mb-3">
        <div class="card-header">
        <i class="fa fa-area-chart"></i> <b> Summary Hasil Sampling </b></div>
          <div class="card-body">

     <form class="form-horizontal" action="<?php echo $url_search_details ; ?>" enctype="multipart/form-data" method='post'>


        <div class="form-group"> <!-- here add class has-error -->
            <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
            <div class="col-sm-10">
            <select class="form-control" id="tipe_gear6" name="tipe_gear6">
            <option value="">  </option>
            <option value="HL" <?php if($post['tipe_gear'] == "HL"){echo "Selected"; } ?> > HL </option>
            <option value="PL" <?php if($post['tipe_gear'] == "PL"){echo "Selected"; } ?>> PL </option>
       
          </select>
            </div>
        </div>    
    
    <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun6" name="tahun6">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>" <?php if($post['tahun'] == $i){ ?> selected="selected" <?php } ?> > <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan6" name="bulan6">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($post['bulan'] == $i){ ?> selected="selected" <?php } ?>> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal6" name="tanggal6">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($post['tanggal'] == $i){ ?> selected="selected" <?php } ?>> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing6" name="k_landing6">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan6" name="k_perusahaan6">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>

       <div class="form-group"> <center> <button type="submit" id = "SummaryHasilSampling"class="btn btn-success">Search!</button> </center> </div>
  </form>

            <b>Catch</b>

             <table id="manageSupplierTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
         <tr>

              <?php foreach($speciesDetails as $key=>$value ) { ?>
                   
                          <th> <?php echo $key ; ?> </th>
                     
              <?php } ?>

        </tr>

        </thead>


                <tr>
                  <?php 
                      $total_kg = 0;
                      foreach($speciesDetails as $key=>$value ) { ?>  
                <td>  <?php echo $value ; ?> Kg </td>
                <?php
                      $total_kg = $total_kg + $value; 
                 } ?>
                </tr>


                <tr>
                  <?php 
                      foreach($speciesDetails as $key=>$value ) { ?>  
                <td>  <?php echo round(($value/$total_kg)*100 , 2) ; ?> % </td>
                <?php
                 } ?>
                </tr>


         <tfoot>
               <tr>

              <?php foreach($speciesDetails as $key=>$value ) { ?>

                <th> <?php echo $key ; ?> </th>

              <?php } ?>

            </tr>
         </tfoot>
        
        </table>



    <b>Bait</b>

    <table id="manageBaitTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
         <tr>


             <?php foreach($baitDetails->result() as $row ) { ?>
                   
                    <th> 
                        <?php 
                          if($row->species == ""){
                            echo "UN"; 
                          }else{
                               echo $row->species ;
                          }
                           ?> 

                    </th>
                     
              <?php } ?>

        </tr>
      </thead>


      <tbody>  
        <tr>

            <?php $total_kg = 0;  ?>
            <?php foreach($baitDetails->result() as $row ) { ?>

              <td>  <?php echo $row->kg; ?> Kg </td>
              <?php $total_kg =  $total_kg  + $row->kg ; ?>

            <?php } ?> 

        </tr>

         <tr>

           <?php foreach($baitDetails->result() as $row ) { ?>

           <td>  <?php echo round(($row->kg/$total_kg)*100, 2 ) ; ?> % </td>

           <?php } ?> 

         </tr>
       </tbody>  

       <tfoot>  
         <tr>

              <?php foreach($baitDetails->result() as $row ) { ?>
                   
                     <th> 

                        <?php 
                          if($row->species == ""){
                            echo "UN"; 
                          }else{
                               echo $row->species ;
                          }
                           ?> 

                    </th>
                     
              <?php } ?>

        </tr>
      </tfoot> 

         </table>


            <b>Etp</b>

                <table id="manageEtpTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">

                  <thead> 
                  <tr>
                     <?php foreach($etpDetails->result() as $row ) { ?>
                       <th> <?php echo $row->k_kelompok ?> </th>
                     <?php } ?>
                  </tr>
                </thead>


                <tbody>

                  <tr>
                     <?php foreach($etpDetails->result() as $row ) { ?>
                       <th> <?php echo $row->jumlah ?> </th>
                     <?php } ?>
                  </tr>
                </tbody>


                <tfoot> 
                  <tr>
                     <?php foreach($etpDetails->result() as $row ) { ?>
                       <th> <?php echo $row->k_kelompok ?> </th>
                     <?php } ?>
                  </tr>
                </tfoot> 

                </table>
          </div>
          </div>

          </div>
   </div>  


    <div class="row">
    <div class="col-lg-12">

      <div class="card mb-3">
        <div class="card-header">
        <i class="fa fa-area-chart"></i> <b> Socio Economic data  </b></div>
          <div class="card-body">



             <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body"> 

  <div class="form-group"> <!-- here add class has-error -->
            <label for="nim" class="col-sm-2 control-label">Pilih Tipe Alat Tangkap</label>
            <div class="col-sm-10">
            <select class="form-control" id="tipe_gear7" name="tipe_gear7">
            <option value="">  </option>
            <option value="HL"> HL </option>
            <option value="PL"> PL </option>
       
          </select>
            </div>
        </div>    
    
    <div class="form-group"> <!-- here add class has-error -->
      <label for="nim" class="col-sm-2 control-label">Pilih Tahun </label>
        <div class="col-sm-10">
         <select class="form-control" id="tahun7" name="tahun7">
          <option value=""> </option>
          <?php for($i=2015;$i<=date('Y');$i++){ ?>
          <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
          <?php } ?>
          </select>
      </div>
    </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Bulan </label>
          <div class="col-sm-10">
           <select class="form-control" id="bulan7" name="bulan7">
            <option value=""> </option>
                <?php for($i=1;$i<=12;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tanggal </label>
          <div class="col-sm-10">
           <select class="form-control" id="tanggal7" name="tanggal7">
            <option value=""> </option>
                <?php for($i=1;$i<=31;$i++){ ?>
                    <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                <?php } ?>
          </select>
          </div>
      </div>


      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Landing </label>
          <div class="col-sm-10">
           <select class="form-control" id="k_landing7" name="k_landing7">
               <option value=""> </option>
              <?php foreach($record_landings->result() as $row){ ?>
                <option value="<?php echo $row->id_landing ; ?>" <?php if( !empty($post['k_landing']) ){  if ( $post['k_landing'] == $row->id_landing ) { echo 'selected'; } } ?> ><?php echo $row->nama_landing ; ?></option>
              <?php  } ?>
          </select>
          </div>
      </div>

      <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan </label>
          <div class="col-sm-10"> 
           <select class="form-control" id="k_perusahaan7" name="k_perusahaan7">
             <option value=""> </option>
              <?php foreach($record_suppliers->result() as $row){ ?>
                <option value="<?php echo $row->id_supplier ; ?>" <?php if( !empty($post['k_perusahaan']) ){  if ( $post['k_perusahaan'] == $row->id_supplier ) { echo 'selected'; } } ?> ><?php echo $row->nama_perusahaan ; ?></option>
              <?php  } ?>   
          </select>
          </div>
      </div>
    
    
    </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraphSocioEconomic">Search!</button> </center> </div>


  </form>




                  <table id="manageVesselTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr> 
        <th>namafile  </th>
        <th>nama_kapal</th>
        <th> gt_kapal </th>
        <th>bbm  </th>
        <th>es  </th>
        <th>lama_hari  </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
        <th>namafile  </th>
        <th>nama_kapal</th>
        <th> gt_kapal </th>
        <th>bbm  </th>
        <th>es  </th>
        <th>lama_hari  </th>
            </tr>
        </tfoot>

    </table>


          </div>
        </div>
      </div>
    </div>

     


<script>
$(document).ready(function() {
  
   manageVesselTable = $("#manageVesselTable").DataTable({
    "ajax": "<?php echo $tripDetails ?>",
        "order": [],
    "scrollX": true
    });

   
   manageBaitTable = $("#manageBaitTable").DataTable({
    "scrollX": true
    });

/*###################################### LFD ##########################################*/  
var ctx = document.getElementById("chartDataLFD");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [ 

    
    <?php foreach($url_lengthFreq as $key=>$value ) { ?>

        "<?php echo $key; ?>" , 

    <?php } ?>

    

     ],
    datasets: [{
      label: '# frequency',
      data: [/* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

       <?php foreach($url_lengthFreq as $key=>$value ) { ?>

                   <?php echo $value; ?> , 

          <?php } ?>

      ],
      backgroundColor: [

      <?php foreach($url_lengthFreq as $key=>$value ) { ?>

      'rgba(255, 99, 132, 0.2)',


      <?php } ?>
        
      ],
      borderColor: [

      <?php foreach($url_lengthFreq as $key=>$value ) { ?>
       
       'rgba(255, 99, 132, 0.2)',

      <?php } ?>

      ],
      borderWidth: 1
    }]
  },
  options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: true,
                text: 'All species, all gear n=' + <?php echo $n_lengthFreq; ?>
            },
        }
});


/*###################################### WFD ##########################################*/ 
var ctx = document.getElementById("chartDataWFD");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [ 

    
    <?php foreach($url_weightFreq as $key=>$value ) { ?>

        "<?php echo $key; ?>" , 

    <?php } ?>

    

     ],
    datasets: [{
      label: '# frequency',
      data: [/* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

       <?php foreach($url_weightFreq as $key=>$value ) { ?>

                   <?php echo $value; ?> , 

          <?php } ?>

      ],
      backgroundColor: [

      <?php foreach($url_lengthFreq as $key=>$value ) { ?>

      'rgba(255, 99, 132, 0.2)',


      <?php } ?>
        
      ],
      borderColor: [

      <?php foreach($url_lengthFreq as $key=>$value ) { ?>
       
       'rgba(255, 99, 132, 0.2)',

      <?php } ?>

      ],
      borderWidth: 1
    }]
  },
  options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: true,
                text: 'All species, all gear n=' + <?php echo $n_lengthFreq; ?>
            },
        }
});



new Chart(document.getElementById("pieUmpan"), {
    type: 'pie',
    data: {
      labels: [
      <?php foreach($baitAndCatch as $loop ) { ?>
           
           "<?php  echo $loop['label']; ?>" ,

         <?php  } ?> ]
      ,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: [ <?php foreach($baitAndCatch as $loop ) { ?>
           
           "<?php  echo $loop['berat']; ?>" ,

         <?php  } ?> ]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});



new Chart(document.getElementById("catchComp"), {
    type: 'horizontalBar',
    data: {
      labels: [

       <?php foreach($url_catchComp as $key=>$value ) { ?>

        "<?php echo $key; ?>" , 

        <?php } ?>

      ],
      datasets: [
        {
          label: "Catch (Kg)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [  

      <?php foreach($url_catchComp as $key=>$value ) { ?>

        "<?php echo $value; ?>" , 

        <?php } ?>

        ]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Weight Composition '
      }
    }
});

});



new Chart(document.getElementById("baitComp"), {
    type: 'horizontalBar',
    data: {
      labels: [

         <?php foreach($url_baitComp as $loop ) { ?>
           
           "<?php  echo $loop['species_name']; ?>" ,

         <?php  } ?>
      ],
      datasets: [
        {
          label: "Weight (Kg)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [
          <?php foreach($url_baitComp as $loop ) { ?>
           
           "<?php  echo $loop['berat']; ?>" ,

         <?php  } ?>
          ]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Bait Composition'
      }
    }
});




  $('#SubmitGraphLFD').on('click',function(){

      var data = new FormData();
      var  tipe_gear = $('#tipe_gear').val();
      var  species = $('#species').val();
      
      data.append('tipe_gear', $("#tipe_gear").val());
      data.append('species', $("#species").val());

      data.append('tahun', $("#tahun").val());
      data.append('bulan', $("#bulan").val());
      data.append('tanggal', $("#tanggal").val());
      data.append('k_landing', $("#k_landing").val());
      data.append('k_perusahaan', $("#k_perusahaan").val());


      if(tipe_gear != '' && species != ''    ){

        $(".messages").html('');

         hideLFD();


                   /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_lengthFreq_dinamic; ?>",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success:function(response){
                                  // remove pesan error
                                  $('.form-group').removeClass('has-error').removeClass('has-success');
                      console.log(response);
                      //console.log(response.dataPoints.label);
                                  if (response.success == 'true') {
                                      $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+ 
                                      '</div>');
                        
                        showFLD(response.dataPoints , response.title);

                            

                       
                        
                                  }else{
                                      $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>HEHEHE</div>');
                        
                        
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

      }else{

        $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data ' +
                              '</div>');

      }

   

   
  }); 

$('#SummaryHasilSampling').on('click',function(){

    alert("Proses search Summary Hasil Sampling") ; 



  }) ; 




    $('#SubmitGraphWFD').on('click',function(){

      var data = new FormData();
      var  tipe_gear = $('#tipe_gear2').val();
      var  species = $('#species2').val();
      
      data.append('tipe_gear', $("#tipe_gear2").val());
      data.append('species', $("#species2").val());
      data.append('tahun', $("#tahun2").val());
      data.append('bulan', $("#bulan2").val());
      data.append('tanggal', $("#tanggal2").val());
      data.append('k_landing', $("#k_landing2").val());
      data.append('k_perusahaan', $("#k_perusahaan2").val());

      if(tipe_gear != '' && species != ''    ){

        $(".messages").html('');

         hideWFD();


                   /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_weightFreq_dinamic; ?>",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success:function(response){
                                  // remove pesan error
                                  $('.form-group').removeClass('has-error').removeClass('has-success');
                      console.log(response);
                      //console.log(response.dataPoints.label);
                                  if (response.success == 'true') {
                                      $(".messagesWFD").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+ 
                                      '</div>');
                        
                        showWLD(response.dataPoints , response.title);

                            

                       
                        
                                  }else{
                                      $(".messagesWFD").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>HEHEHE</div>');
                        
                        
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

      }else{

        $(".messagesWFD").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data ' +
                              '</div>');

      }

   

   
  }); 


    $('#SubmitGraphcatchComp').on('click',function(){

      var data = new FormData();
      var  tipe_gear = $('#tipe_gear3').val();
      
      data.append('tipe_gear', $("#tipe_gear3").val());
      data.append('tahun', $("#tahun3").val());
      data.append('bulan', $("#bulan3").val());
      data.append('tanggal', $("#tanggal3").val());
      data.append('k_landing', $("#k_landing3").val());
      data.append('k_perusahaan', $("#k_perusahaan3").val());

      if(tipe_gear != ''  ){

        $(".messagescatchComp").html('');

         hideCatchComp();


                   /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_catchComp_dinamic; ?>",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success:function(response){
                                  // remove pesan error
                                  $('.form-group').removeClass('has-error').removeClass('has-success');
                      console.log(response);
                      //console.log(response.dataPoints.label);
                                  if (response.success == 'true') {
                                      $(".messagescatchComp").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+ 
                                      '</div>');
                        
                        showCatchComp(response.dataPoints , response.title);

                            

                       
                        
                                  }else{
                                      $(".messagescatchComp").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>HEHEHE</div>');
                        
                        
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

      }else{

        $(".messagescatchComp").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data ' +
                              '</div>');

      }

   

   
  }); 


      $('#SubmitGraphbaitComp').on('click',function(){

      var data = new FormData();
      var  tipe_gear = $('#tipe_gear4').val();


      data.append('tipe_gear', $("#tipe_gear4").val());
      data.append('tahun', $("#tahun4").val());
      data.append('bulan', $("#bulan4").val());
      data.append('tanggal', $("#tanggal4").val());
      data.append('k_landing', $("#k_landing4").val());
      data.append('k_perusahaan', $("#k_perusahaan4").val());


      if(tipe_gear != ''  ){

        alert("running");

        $(".messagesbaitComp").html('');

         hideBaitComp();


                   /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_baitComp_dinamic; ?>",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success:function(response){
                                  // remove pesan error
                                  $('.form-group').removeClass('has-error').removeClass('has-success');
                      console.log(response);
                      //console.log(response.dataPoints.label);
                                  if (response.success == 'true') {
                                      $(".messagesbaitComp").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+ 
                                      '</div>');
                        
                        showBaitComp(response.dataPoints , response.title);

                            

                       
                        
                                  }else{
                                      $(".messagesbaitComp").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>HEHEHE</div>');
                        
                        
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

      }else{

        $(".messagesbaitComp").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data ' +
                              '</div>');

      }

   

   
  }); 



  $('#SubmitGraphSocioEconomic').on('click', function () {


    var data = new FormData();

       var tipe_gear = $('#tipe_gear7').val();
       var tahun = $('#tahun7').val();
       var bulan = $('#bulan7').val();
       var tanggal = $('#tanggal7').val();
       var k_landing = $('#k_landing7').val();
       var k_perusahaan = $('#k_perusahaan7').val();


      var manageVesselTable = $('#manageVesselTable').DataTable( {
        // Clear previous data
        destroy: true,
        /*"ajax": "<?php echo $tripDetailsSearch ?>",*/
        "ajax": {
            "type": "POST",
            "url": "<?php echo $tripDetailsSearch ?>",
            "data": function ( d ) {
                d.tipe_gear = tipe_gear;
                d.tahun = tahun;
                d.bulan = bulan;
                d.tanggal = tanggal;
                d.k_landing = k_landing;
                d.k_perusahaan = k_perusahaan;
                
                // d.custom = $('#myInput').val();
                // etc
            }
             },
        "processing": true,
        "serverSide": true,
        "order": [],
        "scrollX": true
    } );



       alert("masuk !");
  });     


 $('#SubmitGraphpieUmpan').on('click',function(){

      var data = new FormData();
      var  tipe_gear = $('#tipe_gear5').val();
      
      data.append('tipe_gear', $("#tipe_gear5").val());
      data.append('tahun', $("#tahun5").val());
      data.append('bulan', $("#bulan5").val());
      data.append('tanggal', $("#tanggal5").val());
      data.append('k_landing', $("#k_landing5").val());
      data.append('k_perusahaan', $("#k_perusahaan5").val());


      if(tipe_gear != ''  ){

        $(".messagespieUmpan").html('');

         hidepieUmpan();


                   /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_baitAndCatch_dinamic; ?>",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                      if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                      }
                    },
                    success:function(response){
                                  // remove pesan error
                                  $('.form-group').removeClass('has-error').removeClass('has-success');
                      console.log(response);
                      //console.log(response.dataPoints.label);
                                  if (response.success == 'true') {
                                      $(".messagespieUmpan").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+ 
                                      '</div>');
                        
                        showpieUmpan(response.dataPoints , response.title);

                       
                        
                                  }else{
                                      $(".messagespieUmpan").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>HEHEHE</div>');
                        
                        
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

      }else{

        $(".messagespieUmpan").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data ' +
                              '</div>');

      }

   

   
  }); 



/*
$(function() {
    var color = Chart.helpers.color;
    var UserVsMyAppsData = {
        labels: ['29 Sep 2019','30 Sep 2019','01 Oct 2019','02 Oct 2019','03 Oct 2019','04 Oct 2019','05 Oct 2019'],
        datasets: [{
            label: 'Users',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [53,117,79,56,45,89,61]
        }, {
            label: 'My Users',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [43,105,76,50,33,97,52]
        }]
 
    };
 
    var UserVsMyAppsCtx = document.getElementById('UsersVsMyUsers').getContext('2d');
    var UserVsMyApps = new Chart(UserVsMyAppsCtx, {
        type: 'bar',
        data: UserVsMyAppsData,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: false,
                text: ''
            },
        }
    });
});
*/


  function hideLFD(){
    //$( "#chartContainer" ).hide();
    document.getElementById("chartDataLFD").style.display = "none";
  }

  function hideWFD(){
    document.getElementById("chartDataWFD").style.display = "none";
  }

  function hideCatchComp(){
    document.getElementById("catchComp").style.display = "none";
  }

  function hideBaitComp(){
    document.getElementById("baitComp").style.display = "none";
  }

   function hidepieUmpan(){
    document.getElementById("pieUmpan").style.display = "none";
  }


  function showFLD(data, title){

document.getElementById("chartDataLFDDinamic").style.display = "inline";

var ctx = document.getElementById("chartDataLFDDinamic");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: 

      data.label

     ,
    datasets: [{
      label: '# frequency',

      data: /* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

      data.data

      ,
      backgroundColor: [

   
        
      ],
      borderColor: [

  

      ],
      borderWidth: 1
    }]
  },
  options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: true,
                text: title
            },
        }
});


  }



    function showWLD(data, title){

     document.getElementById("chartDataWFDDinamic").style.display = "inline";

var ctx = document.getElementById("chartDataWFDDinamic");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: 

        data.label

     ,
    datasets: [{
      label: '# frequency',
      data: /* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

      data.data

      ,
      backgroundColor: [

     




   
        
      ],
      borderColor: [

    
       


     

      ],
      borderWidth: 1
    }]
  },
  options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: true,
 
            },
            "hover": {
              "animationDuration": 0
            },
             "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },
            title: {
                display: true,
                text: title
            },
        }
});

   }



function showCatchComp(data, title){

document.getElementById("catchCompDinamic").style.display = "inline";

var ctx = document.getElementById("catchCompDinamic");
var myChart = new Chart(document.getElementById("catchCompDinamic"), {
    type: 'horizontalBar',
    data: {
      labels: 

     data.label

      ,
      datasets: [
        {
          label: "Catch (Kg)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data:  

      data.data

        
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: title
      }
    }
});



  }


  function showBaitComp(data, title){

document.getElementById("baitCompDinamic").style.display = "inline";

var ctx = document.getElementById("baitCompDinamic");
var myChart = new Chart(document.getElementById("baitCompDinamic"), {
    type: 'horizontalBar',
    data: {
      labels: 

     data.label

      ,
      datasets: [
        {
          label: "Catch (Kg)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data:  

      data.data

        
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: title
      }
    }
});



  }


  
   function showpieUmpan(data, title){

    document.getElementById("pieUmpanDinamic").style.display = "inline";

    new Chart(document.getElementById("pieUmpanDinamic"), {
    type: 'pie',
    data: {
      labels: [
      <?php foreach($baitAndCatch as $loop ) { ?>
           
           "<?php  echo $loop['label']; ?>" ,

         <?php  } ?> ]
      ,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: [ <?php foreach($baitAndCatch as $loop ) { ?>
           
           "<?php  echo $loop['berat']; ?>" ,

         <?php  } ?> ]
      }]
    },
    options: {
      title: {
        display: true,
        text: title
      }
    }
});

   }


</script>
