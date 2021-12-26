    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Lists </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Sampling data User by bulan tahun</div>
        <div class="card-body">



    <form class="form-horizontal" action="<?php echo base_url()."/data/mainpage/update_upload_user" ?>" method="post" id="AddDataRumponForm" enctype='multipart/form-data'>
       <div class="modal-body">

        <div class="messages"></div>

        <div class="form-group">
          <label>Pilih Bulan</label>
            <select class="form-control" name="bulan" id="bulan" required>
                   <option value="">Select Bulan</option>
                   <?php 
                    $bulans = array('Januari' , 'Februari','Maret','April','Mei','Juni','July','Agustus','September','Oktober','November', 'Desember'); 
                    $i=1;
                    foreach($bulans as $bulan){
                      ?>
                      <option value="<?php echo $i; ?>" > <?php echo $bulan; ?> </option>
                    <?php 
                    $i++;
                    }

                   ?>
            </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Tahun</label>
          <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo date('Y'); ?>"  placeholder="Enter tahun" required>
        </div>

       

       </div>

       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit data</button>
        </div>
    </form>




             </div>
    </div>














      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Sampling data User by Namafile</div>
        <div class="card-body">



      <form class="form-horizontal" action="<?php echo base_url()."/data/mainpage/update_upload_user" ?>" method="post" id="AddDataRumponForm" enctype='multipart/form-data'>
       <div class="modal-body">

        <div class="messages"></div>


        <div class="form-group">
          <label for="exampleInputEmail1">Namafile</label>
          <input type="text" class="form-control" id="namafile" name="namafile"   placeholder="Enter Namafile" required>
        </div>

       

       </div>

       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit data</button>
        </div>
    </form>




             </div>
    </div>
  </div>