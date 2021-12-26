<div class="container-fluid">


  
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><?php echo $countSupplierActive->jumlah; ?> Total Suppliers</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $url_supllier ; ?>" target="_BLANK">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><?php echo $countVesselActive->jumlah; ?> Total Vessels</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $url_vessel ; ?>" target="_BLANK">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><?php echo $countUnloading->jumlah; ?> Total Unloading</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $url_unloading; ?>" target="_BLANK">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">2 Tipe Graph</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?php echo $url_graph ; ?>" target="_BLANK">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Total Kg Per Month <?php echo date('Y'); ?></div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Total Kg Per Company <?php echo date('Y'); ?></div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                  <canvas id="myBarChart" width="100" height="50"></canvas>
                </div>
                <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary"><?php echo round($data_graph1_val['total_catch']); ?> Kg </div>
                  <div class="small text-muted">Total all catch (Kg) this year</div>
                  <hr>
                  <div class="h4 mb-0 text-warning"><?php echo $data_graph1_val['total_supplier']; ?></div>
                  <div class="small text-muted">Total Supplier Active this year</div>
                  <hr>
                  
                </div>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Card Columns Example Social Feed-->
         
          
          <!-- /Card Columns-->
        </div>
       
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Vessels Per Supplier <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
          
        </div>
      </div>


      <!-- Example DataTables Card-->
  
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> List Company </div>
        <div class="card-body">
          <div class="table-responsive">
            

               <table id="manageSupplierTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> Code Supplier  </th>
                <th> Supplier Name </th>
                <th> Supplier Type  </th>
                <th> Location </th>
            </tr>
        </thead>

         <tfoot>
            <tr>
               <th> No. </th>
               <th> Code Supplier  </th>
               <th> Supplier Name </th>
               <th> Supplier Type  </th>
               <th> Location </th>
            </tr>
         </tfoot>
        
        </table>


          </div>
        </div>
        <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>

    </div>


    <div class="row">

    <div class="col-lg-6">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Tipe Supplier Graph <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="myPieChartSuppTipe" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>

      <div class="col-lg-6">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Komposisi Tangkapan Tahun <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="myPieChartKomposisiTangkap" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>

    </div>

   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Trend Tangkapan dan Jumlah Kapal Tangkap <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="chartTangkapanKapal" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>



   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Data Produksi Member AP2HI dari awal sampai tahun berjalan </div>
            <div class="card-body">
              <canvas id="chartDataProduksi" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>




   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Lokasi dan total tangkapan  </div>
            <div class="card-body">


              <div class="row">
                <div class="col-lg-6">

                  <div id="googleMap" style="width:100%;height:400px;"></div>

                </div>
                

                <div class="col-lg-6">

       
     <table id="manageTotalTangkapan" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> Tahun  </th>
                <th> Total Kg Tangkapan </th>
        </thead>


        <tbody>
          <?php $i = 1 ; ?>
          <?php foreach($url_data_graph7 as $key=>$value ) {  ?>
            <tr>
                <td> <?php echo $i; ?> </td>
                <td> <?php echo $key;  ?>  </td>
                <td> <?php echo number_format($value);  ?> </td>
          <?php $i++ ; ?>
          <?php } ?>
        </tbody>

         <tfoot>
            <tr>
              <th> No. </th>
              <th> Tahun </th>
              <th> Total Kg Tangkapan </th>
            </tr>
         </tfoot>
        
        </table>

                </div>
            </div>
            


            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>



   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Komposisi Tangkapan </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ( $url_data_graph8 as $key=>$values){
                  ?>  
                   <div class="col-lg-4">
                    <center><h1><b><?php echo $key ; ?></b></h1></center>
                   <canvas id="komposisi_<?php echo $key; ?>" width="100%" height="100"></canvas>
                    </div>
                <?php 
                } ?>
              </div>

            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>



   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Tren tangkapan & jumlah kapal tangkap seluruh tahun </div>
            <div class="card-body">
              <div class="row">
                
                   <div class="col-lg-12">

                   <canvas id="trendTangkapan" width="100%" height="50"></canvas>

                    </div>
               
              </div>

            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>



<div class="row">
      <div class="col-lg-6">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Update Vessel Member per tahun ini <?php echo date('Y'); ?> </div>
            <div class="card-body">
              <div class="row">

                        <canvas id="jumlahHLPL" width="100%" height="50"></canvas>
         
                     
              </div>

            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>

         <div class="col-lg-6">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Tangkapan HL & PL  per tahun ini <?php echo date('Y'); ?> </div>
            <div class="card-body">
              <div class="row">
                
                   

                              <canvas id="tangkapanHLPL" width="100%" height="50"></canvas>

                    
               
              </div>

            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>



   <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-12">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Ratio Umpan All Member </div>
            <div class="card-body">
              <div class="row">
                
                   <div class="col-lg-12">

                   <canvas id="rationUmpan" width="100%" height="50"></canvas>

                    </div>
               
              </div>

            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");?></div>
          </div>
          <!-- Example Notifications Card-->
        </div>
      </div>
</div>


      <div class="row">
        <div class="col-lg-6">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Catch per Unit Effort Unloading <?php echo date('Y'); ?></div>
            <div class="card-body">
            
                <canvas id="cpue" width="100%" height="100"></canvas>
                
              
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
        </div>
       
        <div class="col-lg-6">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Fuel Utils <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="fuel" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
          
        </div>

      </div>




       <div class="row">
        <div class="col-lg-6">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Recent Activity Unloading <?php echo date('Y'); ?></div>
            <div class="card-body">
            
                 <table id="manageRecentUnloadingTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
                  <thead>
                      <tr>
                          <th> No. </th>
                          <th> Date </th>
                          <th> Kode Upload </th>
                          <th> Kode Trip </th>
                          <th> Supplier </th>
                      </tr>
                  </thead>

                   <tbody>
                  <?php 
                  $i=1;
                     foreach($url_data_graph13->result() as $row){
                      ?>
                      <tr>
                          <td> <?php echo $i; ?> </td>
                          <td> <?php echo $row->tanggal_kembali;  ?>  </td>
                          <td> <?php echo $row->kode_upload;  ?>  </td>
                          <td> <?php echo $row->kode_trip;  ?>  </td>
                          <td> <?php echo $row->nama_perusahaan;  ?>  </td>
                      </tr>
                    <?php $i++ ; ?>
                  <?php 
                     }

                  ?>
                   <tbody>

                   <tfoot>
                      <tr>
                          <th> No. </th>
                          <th> Date </th>
                          <th> Kode Upload </th>
                          <th> Kode Trip </th>
                          <th> Supplier </th>
                      </tr>
                   </tfoot>
                  
              </table>
                
              
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
        </div>
       
        <div class="col-lg-6">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Recent Activity Sampling <?php echo date('Y'); ?></div>
            <div class="card-body">
              

                  <table id="manageRecentSamplingTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
                  <thead>
                      <tr>
                          <th> No. </th>
                          <th> Namafile </th>
                          <th> Supplier </th>
                          <th> Tgl Impor</th>
                          <th> Total Tangkap </th>
                      </tr>
                  </thead>


                  <tbody>
                  <?php 
                  $i=1;
                     foreach($url_data_graph14->result() as $row){
                      ?>
                      <tr>
                          <td> <?php echo $i; ?> </td>
                          <td> <?php echo $row->namafile;  ?>  </td>
                          <td> <?php echo $row->nama_perusahaan;  ?>  </td>
                          <td> <?php echo $row->tgl_impor;  ?>  </td>
                          <td> <?php echo $row->total_penangkapan;  ?>  </td>
                      </tr>
                    <?php $i++ ; ?>
                  <?php 
                     }

                  ?>
                   <tbody>

                   <tfoot>
                      <tr>
                          <th> No. </th>
                          <th> Namafile </th>
                          <th> Supplier </th>
                          <th> Tgl Impor</th>
                          <th> Total Tangkap  </th>
                      </tr>
                   </tfoot>
                  
              </table>


            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
          
        </div>

      </div>




         <div class="row">
        <div class="col-lg-6">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Recent Activity Vessels <?php echo date('Y'); ?></div>
            <div class="card-body">
            
                 <table id="manageRecentVesselsTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
                  <thead>
                      <tr>
                          <th> No. </th>
                          <th> Perusahaan </th>
                          <th> Nama Kapal </th>
                          <th> No AP2HI</th>
                          <th> Create Date </th>
                      </tr>
                  </thead>

                   <tbody>
                  <?php 
                  $i=1;
                     foreach($url_data_graph17->result() as $row){
                      ?>
                      <tr>
                          <td> <?php echo $i; ?> </td>
                          <td> <?php echo $row->nama_perusahaan;  ?>  </td>
                          <td> <?php echo $row->nama_kapal;  ?>  </td>
                          <td> <?php echo $row->no_ap2hi;  ?>  </td>
                          <td> <?php echo $row->created_date;  ?>  </td>
                      </tr>
                    <?php $i++ ; ?>
                  <?php 
                     }

                  ?>
                   <tbody>

                   <tfoot>
                      <tr>
                          <th> No. </th>
                          <th> Perusahaan </th>
                          <th> Nama Kapal </th>
                          <th> No AP2HI</th>
                          <th> Create Date </th>
                      </tr>
                      </tr>
                   </tfoot>
                  
              </table>
                
              
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
        </div>
       
        <div class="col-lg-6">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Users Logs <?php echo date('Y'); ?></div>
            <div class="card-body">
              <canvas id="#" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated <?php echo date("F j, Y, g:i a");  ?></div>
          </div>
          <!-- Example Notifications Card-->
          
        </div>

      </div>



<script>

function myMap() {

var mapProp= {
  center:new google.maps.LatLng( -5.2018543,  128.4820647),
  zoom:5,
  minZoom: 4,
  mapTypeId: 'hybrid'
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);


}


$(document).ready(function() {
  

   manageSupplierTable = $("#manageSupplierTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
    "scrollX": true
    });



   manageTotalTangkapan = $("#manageTotalTangkapan").DataTable({
    "scrollX": true
    });


   manageRecentUnloadingTable = $("#manageRecentUnloadingTable").DataTable({
    "scrollX": true,
     "pageLength": 5
    });


     manageRecentSamplingTable = $("#manageRecentSamplingTable").DataTable({
    "scrollX": true,
     "pageLength": 5
    });


   manageRecentVesselsTable = $("#manageRecentVesselsTable").DataTable({
    "scrollX": true,
     "pageLength": 5
    });

   // Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
    <?php foreach($url_data_graph1 as $key=>$value ) { ?>
        "<?php echo $key; ?>", 
    <?php } ?>
        ],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: [
         <?php foreach($url_data_graph1 as $key=>$value ) { ?>
              <?php echo $value; ?>, 
        <?php } ?>
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          //max: 40000,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
// -- Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
        <?php foreach($url_data_graph2 as $key=>$value ) { ?>
            "<?php echo $key; ?>", 
        <?php } ?>
    ],
    datasets: [{
      label: "Revenue",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [ 

        <?php foreach($url_data_graph2 as $key=>$value ) { ?>
              <?php echo $value; ?>, 
        <?php } ?>


      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          //max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
// -- Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [
         <?php foreach($url_data_graph3 as $key=>$value ) { ?>
            "<?php echo $key; ?>", 
        <?php } ?>
    ],
    datasets: [{
      data: [
        <?php foreach($url_data_graph3 as $key=>$value ) { ?>
              <?php echo $value; ?>, 
        <?php } ?>
      ],
      backgroundColor: [
						'#007bff', 
                        '#dc3545', 
                        '#ffc107', 
                        '#28a745',
                        '#FFFFCC',
                        '#330000',
                        '#990000',
                        '#FF3333',
                        '#FF9999',
                        '#FFCCCC',
                        '#331900',
                        '#663300',
                        '#FF8000',
                        '#FFFF99',
                        '#663300',
                        '#6B8E23',
                        '#7CFC00',
                        '#7FFF00',
                        '#ADFF2F',
                        '#006400',
                        '#008000',
                        '#228B22',
                        '#00FF00',
                        '#32CD32',
                        '#8FBC8F',
                        '#AFEEEE',
                        '#191970',
                        '#EE82EE',
                        '#FF00FF',
                        '#C71585',
                        '#DB7093',
                        '#FF69B4',
                        '#FAFAD2',
                        '#8B4513',
                        '#A0522D',
                        '#F8F8FF',
                        '#FFFFF0',
                        '#silver',
                        '#98FB98',
                        '#F0E68C',
                        '#BDB76B',
                        '#DAA520',
                        '#FF6347',
                        '#B22222'
	  ],
    }],
  },
});



// -- Pie Chart Example
var ctx = document.getElementById("myPieChartSuppTipe");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [
         <?php foreach($url_data_graph4 as $key=>$value ) { ?>
            "<?php echo $key; ?>", 
        <?php } ?>
    ],
    datasets: [{
      data: [
        <?php foreach($url_data_graph4 as $key=>$value ) { ?>
              <?php echo $value; ?>, 
        <?php } ?>
      ],
      backgroundColor: [
            '#007bff', 
                        '#dc3545', 
                        '#ffc107', 
                        '#28a745',
                        '#FFFFCC',
                        '#330000',
                        '#990000',
                        '#FF3333',
                        '#FF9999',
                        '#FFCCCC',
                        '#331900',
                        '#663300',
                        '#FF8000',
                        '#FFFF99',
                        '#663300',
                        '#6B8E23',
                        '#7CFC00',
                        '#7FFF00',
                        '#ADFF2F',
                        '#006400',
                        '#008000',
                        '#228B22',
                        '#00FF00',
                        '#32CD32',
                        '#8FBC8F',
                        '#AFEEEE',
                        '#191970',
                        '#EE82EE',
                        '#FF00FF',
                        '#C71585',
                        '#DB7093',
                        '#FF69B4',
                        '#FAFAD2',
                        '#8B4513',
                        '#A0522D',
                        '#F8F8FF',
                        '#FFFFF0',
                        '#silver',
                        '#98FB98',
                        '#F0E68C',
                        '#BDB76B',
                        '#DAA520',
                        '#FF6347',
                        '#B22222'
    ],
    }],
  },
});



new Chart(document.getElementById("myPieChartKomposisiTangkap"), {
    type: 'pie',
    data: {
      labels: [<?php foreach($url_data_graph5 as $key=>$value ) { ?>
            "<?php echo $key; ?>", 
        <?php } ?>],
      datasets: [{
        label: "Komposisi (Total)",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", '#B22222' , '#BDB76B','#DAA520','#FF6347',],
        data: [ <?php foreach($url_data_graph5 as $key=>$value ) { ?>
                          <?php echo $value; ?>, 
                <?php } ?> ]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Komposisi Tangkapan'
      }
    }
});


var ctx = document.getElementById("chartTangkapanKapal");
var mixedChart = new Chart(ctx, {
  type: 'bar',
  data: {
    datasets: [
        {
          label: 'Total tangkapan',
          data: [ <?php foreach($url_data_graph6["totalCatchPerMonth"] as $key=>$value ) { ?>
              <?php echo $value; ?>, 
            <?php } ?>] //total tangkapan
        }, 
        {
          label: 'Jumlah trip ',
          data: [ <?php foreach($url_data_graph6["totalCatchPerMonth"] as $key=>$value ) { ?>
              <?php echo $value; ?>, 
            <?php } ?>], //jum trip 
          type: 'line'
        }

        ],
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August' , "Sept" , "Okt" , "Nov" , "Dec"]
  }
});




var ctx = document.getElementById("chartDataProduksi");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [ 
    /* "2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12" , */
    <?php foreach($url_data_graph7 as $key=>$value ) { ?>

        "<?php echo $key; ?>" , 

    <?php } ?>

     ],
    datasets: [{
      label: '# of Kg Data Produksi',
      data: [/* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

           <?php foreach($url_data_graph7 as $key=>$value ) { ?>

                   <?php echo $value; ?> , 

          <?php } ?>

      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      xAxes: [{
        ticks: {
          maxRotation: 90,
          minRotation: 80
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});




 <?php foreach ( $url_data_graph8 as $key=>$values){
  ?>

  var ctx = document.getElementById("komposisi_<?php echo $key; ?>");
  var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: {
    labels: [
    <?php foreach($values as $key1=>$val1 ) { ?>
        "<?php echo $key1; ?>", 
    <?php } ?>
        ],
    datasets: [{
      data: [
         <?php foreach($values as $key1=>$val1 ) { ?>
              <?php echo $val1; ?>, 
        <?php } ?>
      ],
      backgroundColor: [
            '#007bff', 
                        '#dc3545', 
                        '#ffc107', 
                        '#28a745',
                        '#FFFFCC',
                        '#330000',
                        '#990000',
                        '#FF3333',
                        '#FF9999',
                        '#FFCCCC',
                        '#331900',
                        '#663300',
                        '#FF8000',
                        '#FFFF99',
                        '#663300',
                        '#6B8E23',
                        '#7CFC00',
                        '#7FFF00',
                        '#ADFF2F',
                        '#006400',
                        '#008000',
                        '#228B22',
                        '#00FF00',
                        '#32CD32',
                        '#8FBC8F',
                        '#AFEEEE',
                        '#191970',
                        '#EE82EE',
                        '#FF00FF',
                        '#C71585',
                        '#DB7093',
                        '#FF69B4',
                        '#FAFAD2',
                        '#8B4513',
                        '#A0522D',
                        '#F8F8FF',
                        '#FFFFF0',
                        '#silver',
                        '#98FB98',
                        '#F0E68C',
                        '#BDB76B',
                        '#DAA520',
                        '#FF6347',
                        '#B22222'
    ],
    }],
  },

});

<?php 
  }
?>





//trendTangkapan
/*
var ctx = document.getElementById("trendTangkapan").getContext("2d");

var data = {
  labels: ["Chocolate", "Vanilla", "Strawberry"],
  datasets: [{
    label: "Blue",
    backgroundColor: "blue",
    data: [3, 7, 4]
  }, {
    label: "Red",
    backgroundColor: "red",
    data: [4, 3, 5]
  }, {
    label: "Green",
    backgroundColor: "green",
    data: [7, 2, 6]
  }]
};

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
        }
      }]
    }
  }
});
*/


<?php $colour1 = array('red' , 'green' , 'blue' , 'yellow'); ?>

<?php $colour2 = array('red' , 'orange' , 'green' , 'yellow'); ?>

var chartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July' , 'August' , 'Sept' , 'Oct' , 'Nov' , 'Dec'],
      datasets: [

      <?php 
      $i=0;
      foreach($url_data_graph9["totalTripPerMonth"] as $key => $value){

           ?> 

      {
        type: 'line',
        label: 'Total Trip <?php echo $key; ?>',
        borderColor: window.chartColors.<?php echo $colour1[$i] ; ?>,
        borderWidth: 2,
        fill: false,
        data: [
          <?php  foreach($value as $nilai){ ?>

              <?php echo $nilai; ?> * 10000 ,   

          <?php } ?>
        ]
      }, 


      <?php $i++; } ?>

        


       <?php 
       $i=0;
      foreach($url_data_graph9["totalCatchPerMonth"] as $key => $value){

           ?> 

      {
        type: 'bar',
        label: 'Total Tangkapan <?php echo $key; ?>',
        backgroundColor: window.chartColors.<?php echo $colour2[$i] ; ?>,
        data: [
           <?php  foreach($value as $nilai){ ?>

              <?php echo $nilai; ?> ,   

          <?php } ?>
        ]
      }

      ,

        <?php $i++; } ?>




      ]

    };

var ctx = document.getElementById('trendTangkapan').getContext('2d');
      window.myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'Trend Tangkapan dan Jumlah Trip kapal tangkap'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          },
          elements: {
            line: {
                tension: 0, // disables bezier curves
            }
        }
        }
      });


   
var ctx = document.getElementById("jumlahHLPL");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [ 
    /* "2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12" , */
    <?php foreach($url_data_graph10 as $key=>$value ) { ?>

        "<?php echo $key; ?>" , 

    <?php } ?>

     ],
    datasets: [{
      label: '# of Tipe Alat Tangkap',
      data: [/* 12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1 , */ 

           <?php foreach($url_data_graph10 as $key=>$value ) { ?>

                   <?php echo $value; ?> , 

          <?php } ?>

      ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      xAxes: [{
        ticks: {
          maxRotation: 90,
          minRotation: 80
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});




  // x : tahun , y: tangkapan , line : hl , pl tipe kapal 
  var ctx = document.getElementById("tangkapanHLPL");
   var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
    labels: [

        <?php 

          foreach($url_data_graph11 as $key=>$value ) {

        ?>

            <?php echo $key; ?> , 

        <?php 

          }
        ?>

    ],
    datasets: [
      { 
        data: [

             <?php 

          foreach($url_data_graph11 as $key=>$value ) {

              foreach ($value as $key1 => $value1) {
                  
                  if($key1 == 'PL'){

                    echo $value1.",";
                  }

              }

          }

        ?>


        ],
        label: "PL",
        borderColor: "#3e95cd",
        fill: false
      }, 
      { 
        data: [

                     <?php 

          foreach($url_data_graph11 as $key=>$value ) {

              foreach ($value as $key1 => $value1) {
                  
                  if($key1 == 'HL'){

                    echo $value1.",";
                  }

              }

          }

        ?>

        ],
        label: "HL",
        borderColor: "#8e5ea2",
        fill: false
      }, 
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Tangkapan Pole&Line dan Handline'
    },
    elements: {
            line: {
                tension: 0, // disables bezier curves
            }
        }
  }
});



var chartData = {
      labels: [

        <?php foreach($url_data_graph12 as $key=>$value){ ?>

          '<?php echo $key ?>' , 

        <?php } ?>

      ],
      datasets: [



      {
        type: 'line',
        label: 'Total Tangkapan <?php echo $key; ?>',
        borderColor: window.chartColors.blue ,
        borderWidth: 2,
        fill: false,
        data: [
          <?php  foreach($url_data_graph12 as $key=>$value){ ?>

              <?php echo $value['total_tangkapan']; ?>  ,   

          <?php } ?>
        ]
      }, 


    

      {
        type: 'bar',
        label: 'Total Umpan <?php echo $key; ?>',
        backgroundColor: window.chartColors.red,
        data: [
             <?php  foreach($url_data_graph12 as $key=>$value){ ?>

              <?php echo $value['total_umpan']; ?>  ,   

          <?php } ?>
        ]
      }

      ,

        




      ]

    };
   

// x : tahun , y : total kg , bar : total kg umpan
var ctx = document.getElementById("rationUmpan");
window.mixedChart = new Chart(ctx, {
  type: 'bar',
  data: chartData,
    options: {
          responsive: true,
          title: {
            display: true,
            text: 'Trend Tangkapan dan Jumlah Trip kapal tangkap'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          },
          elements: {
            line: {
                tension: 0, // disables bezier curves
            }
        }
        }
});




});











var data = {
  labels: [
  <?php foreach($url_data_graph15->result() as $row){  ?>
  
    "<?php echo $row->bulan?>",

  <?php } ?>
  ],
  datasets: [{
    label: "Kg/l",
    data: [

      <?php foreach($url_data_graph15->result() as $row){  ?>
	
          <?php 
		  if( $row->jumlah_solar <= 0 || $row->total_tangkapan <= 0  ){
				echo '0';  
		  }else{
				echo round($row->total_tangkapan/$row->jumlah_solar);  
		  }
		  
		  ?>,
		  

      <?php } ?>

    ],
  }]
};
 
var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};



var ctx = document.getElementById("cpue");
var lineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: chartOptions
});


var data = {
  labels: [
  <?php foreach($url_data_graph16->result() as $row){  ?>
  
    "<?php echo $row->bulan?>",

  <?php } ?>
  ],
  datasets: [{
    label: "Kg/l",
    data: [

      <?php foreach($url_data_graph16->result() as $row){  ?>
  
          <?php echo $row->jumlah_solar;  ?>,

      <?php } ?>

    ],
  }]
};
var ctx = document.getElementById("fuel");
var myBarChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: data,
    options: chartOptions
});

</script>
