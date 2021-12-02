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
            

             <div class="input-group input-append date" id="datePicker">
                <input type="text" class="form-control" name="date" />
                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
            </div>

            <br>
            <br>

             <table id="listUploadTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> kode_upload </th> 
                <th> kode_trip </th>
                <th> id_supplier </th>
                <th> id_vessel </th>
                <th> nama_kapal </th>
                <th> pelabuhan_pangkalan </th>
                <th> tipe </th>
                <th> tahun </th>
                <th> bulan </th>
                <th> tanggal_berangkat </th>
                <th> tanggal_kembali </th>
                <th> urut  </th>
                <th> total_tangkapan </th>
                <th> yft </th>
                <th> bet </th>
                <th> skj </th>
                <th> kaw </th>
                <th> bycatch </th>
                <th> loin_kotor </th>
                <th> loin_bersih </th>
                <th> jumlah_loin </th>
                <th> lainnya </th>
                <th> ikanhilang </th>
                <th> etp </th>
                <th> wpp_penangkapan </th>
                <th> jenis_solar </th>
                <th> jumlah_solar </th>
                <th> es </th>
                <th> uang_trip </th>
                <th> catch_certificate </th>
                <th> namafile </th>
                <th> total_loin </th>
                <th> pengguna </th>
                <th> date_upload </th>
                <th> rumpon </th>
            </tr>
        </thead>

         <tfoot>
            <tr>
               <th> kode_upload </th> 
                <th> kode_trip </th>
                <th> id_supplier </th>
                <th> id_vessel </th>
                <th> nama_kapal </th>
                <th> pelabuhan_pangkalan </th>
                <th> tipe </th>
                <th> tahun </th>
                <th> bulan </th>
                <th> tanggal_berangkat </th>
                <th> tanggal_kembali </th>
                <th> urut  </th>
                <th> total_tangkapan </th>
                <th> yft </th>
                <th> bet </th>
                <th> skj </th>
                <th> kaw </th>
                <th> bycatch </th>
                <th> loin_kotor </th>
                <th> loin_bersih </th>
                <th> jumlah_loin </th>
                <th> lainnya </th>
                <th> ikanhilang </th>
                <th> etp </th>
                <th> wpp_penangkapan </th>
                <th> jenis_solar </th>
                <th> jumlah_solar </th>
                <th> es </th>
                <th> uang_trip </th>
                <th> catch_certificate </th>
                <th> namafile </th>
                <th> total_loin </th>
                <th> pengguna </th>
                <th> date_upload </th>
                <th> rumpon </th>
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




    $('#datePicker')
        .datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years", 
            minViewMode: "years"
        })
        .on('changeYear', function(e){ 
             var currYear = String(e.date).split(" ")[3];

             console.log(currYear);
             listUploadTable.destroy();    
             listUploadTable = $("#listUploadTable").DataTable({
                "ajax": "<?php echo $url_load_table ?>"+ currYear ,
                "order": [],
                "scrollX": true
            });

            
           });



});
</script>