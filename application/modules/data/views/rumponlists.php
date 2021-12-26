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
          <i class="fa fa-table"></i>  Lists </div>
        <div class="card-body">
            

        


             <table id="listUploadTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> kode_upload </th> 
                <th> urutan </th>
                <th> nama_supplier </th>
                <th> alamat </th>
                <th> no_sipr </th>
                <th> daerah_penangkapan </th>
                <th> daerah_usaha </th>
                <th> alat_tangkap </th>
                <th> posisi_rumpon </th>
                <th> bahan </th>
                <th> nama_kapal </th>
   
            </tr>
        </thead>

         <tfoot>
            <tr>
                <th> kode_upload </th> 
                <th> urutan </th>
                <th> nama_supplier </th>
                <th> alamat </th>
                <th> no_sipr </th>
                <th> daerah_penangkapan </th>
                <th> daerah_usaha </th>
                <th> alat_tangkap </th>
                <th> posisi_rumpon </th>
                <th> bahan </th>
                <th> nama_kapal </th>
            </tr>
         </tfoot>
        
        </table>

         
      </div>
    </div>

  </div>



<script>


$(document).ready(function() {




   listUploadTable = $("#listUploadTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
        "scrollX": true
    });





});
</script>