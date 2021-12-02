
<?php  $err = 'File Harus Format XLS!'; ?>

    <script>
function validateForm(form, err)
{
   var filename=form.filenya.value;
   var ext = filename.split('.').pop();
   ext = ext.toUpperCase();
   if (ext=="XLS") { 
      return true;
   }
  else {
      alert(err);
      return false;
   }   
}

</script>

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Upload Rumpon </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Upload </div>
        <div class="card-body">
          <div class="alert alert-info">
			  <center> UPLOAD RUMPON MODULE </center>
			</div>

			<?php if( count( $notification) > 0 ) { ?>
			<div class="alert alert-warning">
			  <center>
			  	<?php foreach($notification as $notif){ echo $notif; } ;?>
			</center>
			</div>
			<?php } ?>

			<?php if($status == 'success'){  ?>
			<div class="alert alert-success">
			  <center>
			  	Berhasil Upload! 
				</center>
			</div>
			<?php } ?>

				<form action="<?php echo $url_rumponupload ; ?>" enctype="multipart/form-data" method='post' onsubmit="return validateForm(this,'<?php echo $err; ?>')">

      		   <center>
                    <div class="form-group">
                      <input type="file" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                      <button type='submit'  id="upload" class="btn btn-default">Upload</button>
                    </div> 
                </center>

				</form>

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
                      <a href="<?php echo base_url()."media/download/RUMPON_FORM.xlsx"; ?>" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download Template Rumpon</a> </center>
                    </center>
                    <br>
                

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

