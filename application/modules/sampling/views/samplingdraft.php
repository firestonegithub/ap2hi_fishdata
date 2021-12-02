   
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Trip Approved </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Trip Approved </div>
        <div class="card-body">
          
            <?php echo $button_add;  ?>

        <table id="example" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                <th> No. </th>
                <th> NamaFile  </th>
                <th> Nama Landing </th>
                <th> Nama Perusahaan </th>
                <th> Tgl Sampling  </th>
                <th> Enumerator 1 </th>
                <th> Enumerator 2 </th>
                <th> Nama Kapal </th>
                <th> Kapten Kapal </th>
                <th> GT Kapal </th>
                <th> Tipe </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
        </thead>

        <tbody>
        
          <?php 
            $i=1;
           foreach ($record->result() as $row){
          
          ?>

            <tr>
                <td> <?php echo $i; ?> </td>
                <td> <?php echo $row->namafile; ?>  </td>
                <td> <?php echo $row->nama_landing; ?>  </td>
                <td> <?php echo $row->nama_perusahaan; ?> </td>
                <td> <?php echo $row->thn_sampling."-".sprintf("%02d",$row->bln_sampling)."-".sprintf("%02d",$row->tgl_sampling); ?>  </td>
                <td> <?php echo $row->enumerator1; ?>  </td>
                <td> <?php echo $row->enumerator2; ?>  </td>
                <td> <?php echo $row->nama_kapal ; ?>  </td>
                <td> <?php echo $row->kapten_kapal; ?> </td>
                <td> <?php echo $row->gt_kapal ; ?> </td>
                <td> <?php echo $row->tipe; ?> </td>
                <td> 

                  <?php if($EditDraft){ ?>

                  <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/trip_detail/<?php echo $row->namafile; ?>" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a>

                                 <?php }else{  ?>

                   <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> 

                                 <?php } ?>  

                                 </td>



                <td> 

                  <?php if($DeleteDraft){ ?>

                  <a type="button" href="<?php echo base_url(); ?>/sampling/mainpage/trip_disable/<?php echo $row->namafile; ?>" class="btn btn-danger a-btn-slide-text" onclick="return confirm('Are you sure you want to delete this item?');">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>

                  <?php }else{  ?>

                   <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> 

                                 <?php } ?>  

                                 </td>
            </tr>

          <?php $i++; } ?>

        </tbody>

         <tfoot>
            <tr>
               <th> No. </th>
                <th> NamaFile  </th>
                <th> Nama Landing </th>
                <th> Nama Perusahaan </th>
                <th> Tgl Sampling  </th>
                <th> Enumerator 1 </th>
                <th> Enumerator 2 </th>
                <th> Nama Kapal </th>
                <th> Kapten Kapal </th>
                <th> GT Kapal </th>
                <th> Tipe </th>
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