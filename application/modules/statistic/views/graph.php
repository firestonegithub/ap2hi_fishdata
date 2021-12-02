    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> graph </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  graph </div>
        <div class="card-body">
          

  <form class="form-horizontal" method="post" id="searchGraph">
       <div class="modal-body">
     <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Perusahaan</label>
          <div class="col-sm-10">
          <select class="form-control" id="kode_perusahaan" name="kode_perusahaan">
          <option value="">  </option>
          <?php foreach($listsSupplier->result() as $row){  ?>
                <option value="<?php echo $row->id_supplier; ?>"><?php echo $row->nama_perusahaan; ?></option>
          <?php } ?>
        </select>
          </div>
      </div>
    <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tahun</label>
          <div class="col-sm-10">
      
           <select class="form-control" id="tahun" name="tahun">
          <option value=""> </option>
          <?php foreach($listsTahun->result() as $row){  ?>
                <option value="<?php echo $row->tahun; ?>"><?php echo $row->tahun; ?></option>
          <?php } ?>
        </select>
          </div>
      </div>
    <div class="form-group"> <!-- here add class has-error -->
          <label for="nim" class="col-sm-2 control-label">Pilih Tipe Grafik</label>
          <div class="col-sm-10">
           <select class="form-control" id="tipe" name="tipe">
          <option value="">  </option>
          <option value="catchComp"> Catch Composition Pie  </option>
          <option value="catchMonth"> Catch Per Month   </option>
          <?php if($role_active == 'Administrator'){ ?>
          <option value="hlpl"> HL PL Total Catch Comparison   </option>
            <option value="totalall"> Total Catch All Member   </option>
            <option value="totalallbar"> Total Catch All Member Years    </option>
             <option value="vessel"> Vessels   </option>
          <?php } ?>
         
        </select>
          </div>
      </div>
     </div>
     <div class="form-group"> <center> <button type="button" class="btn btn-success" id="SubmitGraph">Check it Out!</button> </center> </div>
  </form>



  
 <div class="messages"></div>  


 <div id="chartContainer" ></div>


 <div id="chartContainer2" ></div>




          
      </div>
    </div>

  </div>







<script type="text/javascript">
$(document).ready(function() {
  
  $('#SubmitGraph').on('click',function(){

      
      var data = new FormData();
      var  kode_perusahaan = $('#kode_perusahaan').val();
      var  tahun = $('#tahun').val();
      var  tipe = $('#tipe').val();
      
      data.append('kode_perusahaan', $("#kode_perusahaan").val());
      data.append('tahun', $("#tahun").val());
      data.append('tipe', $("#tipe").val());
      
      console.log(data);


      if(tipe == 'hlpl' || tipe == 'totalall' || tipe == 'totalallbar' || tipe == 'vessel'   ){


            hideAll();

        //jika total all tidak berisi tahun
        if(tipe == 'totalall' && tahun ==''){

             $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data Tahun' +
                              '</div>');


        }else{


          /*Ajax Awal  */
           $.ajax({
                    type: "POST",
                    url: "<?php echo $url_get_graph; ?>",
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
                                  if (response.success == 'true') {
                                      $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                      '</div>');
                        
                        
                          /*  Check data tipe yamg masuk */
                          if(tipe == 'hlpl'){

                            hlpl(response.dataPoints); 

                          }

                           if(tipe == 'totalall'){

                            totalall(response.dataPoints , response.tahun); 

                          }

                          if(tipe == 'totalallbar'){

                              totalallbar(response.dataPoints)

                          }

                          if(tipe == 'vessel'){

                              vessel(response.dataPoints)

                          }
                      
                          /*  Check data tipe yamg masuk */


                        //ShowAll();
                        
                                  }else{
                                      $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                      '</div>');
                        
                        
                              hideAll();
                        
                        
                                  }
                              }
                          });
          /*Ajax Akhir */

        }
       

      }
      else if(kode_perusahaan && tahun && tipe){
                
        $.ajax({
          type: "POST",
          url: "<?php echo $url_get_graph; ?>",
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
                        if (response.success == 'true') {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
              
              
              if(tipe == 'catchComp'){
                catchCompostion( response.nama_perusahaan , response.tahun, response.dataPoints  );
                
              }else if(tipe == 'catchMonth'){
                //alert('ajax');
                //alert(JSON.stringify( response.dataPoints , null, 4 ) )  ;
                catchCompMonthly(response.nama_perusahaan , response.tahun , response.dataPoints );
                
              }
              
              //ShowAll();
              
                        }else{
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
              
              
              hideAll();
              
              
                        }
                    }
                });
                
        
      }else{
        console.log('Isikan data!');
         $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Isikan Data' +
                              '</div>');
        hideAll();
      }
        

  
  }); 

  
  
  function hideAll(){
    //$( "#chartContainer" ).hide();
    document.getElementById("chartContainer").style.display = "none";
  }

  
  function ShowAll(){
    //$( "#chartContainer" ).show();
    document.getElementById("chartContainer").style.display = "inline";
  }
  
  
  
  function catchCompostion(nama_perusahaan , tahun , dataPoints){
    
     $( "#chartContainer" ).show();
      var chart = new CanvasJS.Chart("chartContainer",
          {
            theme: "theme2",
            title:{
              text: nama_perusahaan + ' Tahun ' + tahun
            },
            exportFileName: "Catch Composition " + tahun,
            exportEnabled: true,
            animationEnabled: true,   
            data: [
            {       
              type: "pie",
              showInLegend: true,
              toolTipContent: "{name}: <strong>{y} Kg</strong>",
              indexLabel: "{name} {y} Kg",
              dataPoints: dataPoints
            }]
          });
          chart.render();
      
  
  
  }
  
  function catchCompMonthly(nama_perusahaan , tahun , dataPoints , array_yft , array_bet , array_skj, array_hilang , array_bycatch){
    console.log(dataPoints);
    console.log(dataPoints['YFT']);
    $( "#chartContainer" ).show();
   var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title:{
      text: "Catch Composition Per Month "  + nama_perusahaan + ' Tahun ' + tahun
    },  
    axisY: {
      title: "Month",
      titleFontColor: "#4F81BC",
      lineColor: "#4F81BC",
      labelFontColor: "#4F81BC",
      tickColor: "#4F81BC"
    },
    axisY2: {
      title: "Total Kg",
      titleFontColor: "#C0504E",
      lineColor: "#C0504E",
      labelFontColor: "#C0504E",
      tickColor: "#C0504E"
    },  
    toolTip: {
      shared: true
    },
    legend: {
      cursor:"pointer",
      itemclick: toggleDataSeries
    },
    data: [
    {
        type: "column",
        name: "Yellow Fin Tuna",
        legendText: "YFT",
        showInLegend: true, 
        dataPoints: dataPoints['YFT']
    } , 
    {
      type: "column", 
      name: "Big Eye Tuna",
      legendText: "BET",
      showInLegend: true,
      dataPoints:dataPoints['BET']
    } , 
    {
      type: "column", 
      name: "Skip Jack Tuna",
      legendText: "SKJ",
      showInLegend: true,
      dataPoints:dataPoints['SKJ']
    } , 
    {
      type: "column", 
      name: "Lost Fish",
      legendText: "Lost Fish",
      showInLegend: true,
      dataPoints:dataPoints['HILANG']
    } , 
    {
      type: "column", 
      name: "Bycatch",
      legendText: "Bycatch",
      showInLegend: true,
      dataPoints:dataPoints['BYCATCH']
    }
    
    ]
  });
  chart.render();
  
  }


  function hlpl(dataPoints){


    console.log('hlpl');
        $( "#chartContainer" ).show();
        console.log(dataPoints['HL']);
      var chart = new CanvasJS.Chart("chartContainer", {
      theme:"light2",
      animationEnabled: true,
      title:{
        text: "HL PL Catch Comparison"
      },
       axisX: {
          title: "Tahun"
        },
       axisY: {
          title: "kG"
        },
      toolTip: {
        shared: "true"
      },
      legend:{
        cursor:"pointer",
        itemclick : toggleDataSeries
      },
      data: [
      {
        type: "spline", 
        showInLegend: true,
        name: "HL",
        dataPoints: 
          dataPoints['HL']
      },
      {
        type: "spline", 
        showInLegend: true,
        name: "PL",
        dataPoints: 
          dataPoints['PL']
      },
      
      ]
    });
    chart.render();

  }


  function totalall(dataPoints , tahun){
     $( "#chartContainer" ).show();
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title: {
            text: "Total Tangkap All Members Tahun " + tahun
          },
          data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"Kg\"",
            indexLabel: "{label} {y}",
            dataPoints: dataPoints
          }]
        });
        chart.render();

  }


  function totalallbar(dataPoints){

     $( "#chartContainer" ).show();

        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
          text: "Catch Composition of AP2HI Members (In Kg)"
        },
        axisX: {
          title: "Tahun"
        },
        axisY: {
          title: "Total Tangkapan Kg"
        },
        legend: {
          cursor:"pointer",
          itemclick : toggleDataSeries
        },
        toolTip: {
          shared: true,
          content: toolTipFormatter
        },
        data: [{
          type: "bar",
          showInLegend: true,
          name: "YFT",
          color: "red",
          dataPoints: dataPoints['YFT']
        },
        {
          type: "bar",
          showInLegend: true,
          name: "SKJ",
          color: "blue",
          dataPoints:  dataPoints['BET']
        },
        {
          type: "bar",
          showInLegend: true,
          name: "BET",
          color: "green",
          dataPoints:  dataPoints['SKJ']
        },
        {
          type: "bar",
          showInLegend: true,
          name: "LostFish",
          color: "yellow",
          dataPoints:  dataPoints['HILANG']
        }, 

        {
          type: "bar",
          showInLegend: true,
          name: "Bycatch",
          color: "#A57164",
          dataPoints:  dataPoints['BYCATCH']
        }
        ]
      });
      chart.render();

  }


  function vessel(dataPoints){

  $( "#chartContainer" ).show();


      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
          text: "HL PL",
          horizontalAlign: "left"
        },
        data: [{
          type: "doughnut",
          startAngle: 60,
          //innerRadius: 60,
          indexLabelFontSize: 17,
          indexLabel: "{label} - {y}",
          toolTipContent: "<b>{label}:</b> {y} ",
          dataPoints: dataPoints
        }]
      });
      chart.render();

  }






  function toolTipFormatter(e) {
  var str = "";
  var total = 0 ;
  var str3;
  var str2 ;
  for (var i = 0; i < e.entries.length; i++){
    var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
    total = e.entries[i].dataPoint.y + total;
    str = str.concat(str1);
  }
  str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
  str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
  return (str2.concat(str)).concat(str3);
}


  function toggleDataSeries(e) {
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    }
    else {
      e.dataSeries.visible = true;
    }
    chart.render();
  }
  
  
  
  
  });
</script>