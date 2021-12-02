    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Upload </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Upload </div>
        <div class="card-body">
          
          <?php echo $button_upload ; ?>
          
          <br>

           <div><div class="alert alert-info">
                      <center><strong>Perhatian!</strong> Masukkan file dengan format penamaan : "HL_AP2HI_COMPANYCODE_YYYYMM". </center>
                    </div></div>
           <br>

          <div id="msg"></div>
          <div id="msgInsert"></div>


      </div>
    </div>


     <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Download  </div>
        <div class="card-body">
          
         
          <div id="accordion" role="tablist">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
         Download Templates
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
                    <center>
                      <a href="<?php echo base_url()."media/download/HL_AP2HI_COMPANYCODE_YYYYMM_REVISIRUMPON.xlsx"; ?>" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download Template HL</a> </center>
                    </center>
                    <br>
                    <center>
                      <a href="<?php echo base_url()."media/download/PL_AP2HI_COMPANYCODE_YYYYMM_REVISIRUMPON.xlsx"; ?>" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download Template PL</a> </center>
                    </center>

      </div>
    </div>
  </div>
</div>

      </div>
    </div>

  </div>




          
           <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog  modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                      <center><h5 class="modal-title">Upload</h5></center>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>


                </div>
             
                 <div class="modal-body">
                  <?php //echo form_open_multipart($url_uploadUnloading);  ?>
                    <center>
                    <div class="form-group">
                      <input type="file" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                      <button id="upload" class="btn btn-default">Upload</button>
                    </div> 
                    </center>
                    <div id="msg"></div>
                     <?php //echo form_close(); ?>


                 </div>
                </div>
              </div>
            </div>


<script>
$(document).ready(function() {

  $('#upload').on('click', function () {
                    var file_data = $('#file').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);

                    $('#msg').html("");
                    $('#msgInsert').html("");


                    $.ajax({
                        url: '<?php echo $url_uploadUnloading; ?>', // point to server-side PHP script 
                        dataType :'json',// what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {

                              console.log(response);

                              var text = "";
                              var textInsert = "";

                              if(typeof response.statusInsert !== 'undefined'){


                                  if(typeof response.statusInsert.excellInsert !== 'undefined'){


                                     for (i = 0; i < response.statusInsert.excellInsert.length; i++) {

                                      if(response.statusInsert.excellInsert[i].act == 'Bad'){

                                                                          text += '<div class="alert alert-danger alert-dismissible" role="alert">'+
                                                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.statusInsert.excellInsert[i].notif+
                                                                          '</div>';
                                                                           
                                          }
                                       if(response.statusInsert.excellInsert[i].act == 'Good'){
                                          

                                                                          text += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.statusInsert.excellInsert[i].notif+
                                                                          '</div>';
                                                                          
                                        }

                                      }
                    
                    
                     $('#msg').html(   

                        text

                        );


                                  }

                              }

                              if(typeof response.validator !== 'undefined'){

                              if(typeof response.validator.excellCheck !== 'undefined'){

                                  //console.log(response.validator.excellCheck[0].act);


                                  if(response.validator.excellCheck[0].act == 'Exist'){

                                      //console.log(response.validator.excellCheck[0].namafile);

                                      if (confirm('Gagal Upload Data Monthly karena terindikasi sudah pernah terupload, mohon konfirmasi untuk menghapus data lama')) {

                                       
                                      
                                          $.ajax({
                                                  type: "POST",
                                                  url: '<?php echo $url_uploadUnloadingExsist; ?>',
                                                  data: {namafile : response.validator.excellCheck[0].namafile },
                                                  dataType:'JSON', 
                                                  success: function(response){


                                                        if(typeof response.statusInsert !== 'undefined'){

                                                            if(typeof response.statusInsert.excellInsert !== 'undefined'){
                                                                  
                                                                   for (i = 0; i < response.statusInsert.excellInsert.length; i++) {
                                                                    
                                                                    //console.log(response.statusInsert.excellInsert[0]);  
                                                                      console.log(response.statusInsert.excellInsert[i].act);

                                                                        if(response.statusInsert.excellInsert[i].act == 'Bad'){

                                                                          textInsert += '<div class="alert alert-danger alert-dismissible" role="alert">'+
                                                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.statusInsert.excellInsert[i].notif+
                                                                          '</div>';
                                                                           
                                                                        }
                                                                         if(response.statusInsert.excellInsert[i].act == 'Good'){


                                                                          textInsert += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.statusInsert.excellInsert[i].notif+
                                                                          '</div>';
                                                                          
                                                                        }


                                                                  }



                                                            }
                                                        }


                                                         $('#msgInsert').html(   

                                                                  textInsert

                                                                );
                                                 
                                                  },
                                                   error: function(){
                                                    alert('error input ke database!');
                                                   }
                                                });



                                      }


                                  }


                                  for (i = 0; i < response.validator.excellCheck.length; i++) {

                                      if(response.validator.excellCheck[i].act == 'Bad'){

                                        text += '<div class="alert alert-danger alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.validator.excellCheck[i].notif+
                                        '</div>';
                                         
                                      }
                                       if(response.validator.excellCheck[i].act == 'Good'){


                                        text += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.validator.excellCheck[i].notif+
                                        '</div>';
                                        
                                      }
                                  }


                                 



                                   text += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                        '</div>';


                                   $('#msg').html(   

                                    text

                                  );

                              }

                            }else{
                  
                  
                   text += '<div class="alert alert-danger alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>';


                           $('#msg').html(   

                          text

                          );
                  
                
                }


                           },
                        error: function (response) {
                            $('#msg').html(response.messages); // display error response from the PHP script
                            alert('gagal!'); 
                        }
                   

                 });

        });

    });
</script>