   
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
          	

          	   <div class="card-header">
                                <strong class="card-title">Trips Form</strong>
                                <a class='pull-right btn btn-success btn-sm' href='<?php echo base_url(); ?>sampling/mainpage/form3_add/<?php echo $namafile;  ?>'><span class='fa fa-plus-square-o'> </span>Tambahkan Data</a>
                            </div>

        <table id="example" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> namafile  </th>
                <th> k_species </th>
                <th> jumlah </th>
                <th> berat  </th>
                <th> estimasi </th>
                <th> kode_panjang </th>
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
                <td> <?php echo $row['k_species'] ?> </td>
                <td> <?php echo $row['jumlah'] ?> </td>
                <td> <?php echo $row['berat'] ?>  </td>
                <td> <?php echo $row['estimasi'] ?> </td>
                <td> <?php echo $row['kode_panjang'] ?> </td>
                <td> <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/form3_update/<?php echo $row['namafile']; ?>/<?php echo $row['k_species']; ?>" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a> </td>
                <td> <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/form3_delete/<?php echo $row['namafile']; ?>/<?php echo $row['k_species']; ?>" class="btn btn-danger a-btn-slide-text" onclick="return confirm('Are you sure you want to delete this item?');">
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
                <th> k_species </th>
                <th> jumlah </th>
                <th> berat  </th>
                <th> estimasi </th>
                <th> kode_panjang </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
         </tfoot>
        
        </table>

      </div>
    </div> 
  </div>

 
 <script>
$(document).ready(function() {
    $('#example').DataTable();
} );




</script>