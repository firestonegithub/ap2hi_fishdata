    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Vessel </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Vessel </div>
        <div class="card-body">
          

          <?php echo $button_add; ?>
          
      <table id="manageVesselTable" border="1" class="table-style table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
        <th>No Urut </th>
        <th>kode_kapal_ap2hi</th>
        <th>Nama Kapal </th>
        <th>Nama Mitra AP2HI </th>
        <th>Nama Pemilik </th>
        <th>AP2HI No.</th>
        <th>SEAFDEC No.</th>
        <th>ISSF No.</th>
        <th>KKP No.</th>
        <th>DKP No.</th>
        <th>VIC No.</th>
        <th>Nama Kapal 2 Thn ?</th>
        <th>Status Kapal </th>
        <th>Jenis Kapal </th>
        <th>Jenis Alat Pancing </th>
        <th>Ukuran (GT)</th>
        <th>LOA (Meter)</th>
        <th>Bahan Kapal</th>
        <th>Jenis Mesin Utama </th>
        <th>Kapasitas Mesin Utama (PK)</th>
        <th>Kapasitas Palka Ikan (Ton)</th>
        <th>Kapasitas Palka Umpan (Ember)</th>
        <th>VMS </th>
        <th>Lainnya </th>
        <th>IRC Signal </th>
        <th>Jumlah Pancing </th>
        <th>Jumlah ABK </th>
        <th>Nama Kapten </th>
        <th>No. SIPI/SIKPI</th>
        <th>Masa Berlaku SIPI/SIKPI</th>
        <th>RFMO</th>
        <th>Tahun Pembuatan Kapal </th>
        <th>Bendera </th>
        <th>Bendera 2Th ?</th>
        <th>Pelabuhan Pangkalan </th>
        <th>Muat Singgah </th>
        <th>Copy Surat Ijin </th>
        <th>Shark Policy </th>
        <th>Terdaftar IUU </th>
        <th>Kode etik Pelayaran</th> 
        <th>Edit </th>
        <th>Delete </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
        <th>No Urut </th>
        <th>kode_kapal_ap2hi</th>
        <th>Nama Kapal </th>
        <th>Nama Mitra AP2HI </th>
        <th>Nama Pemilik </th>
        <th>AP2HI No.</th>
        <th>SEAFDEC No.</th>
        <th>ISSF No.</th>
        <th>KKP No.</th>
        <th>DKP No.</th>
        <th>VIC No.</th>
        <th>Nama Kapal 2 Thn ?</th>
        <th>Status Kapal </th>
        <th>Jenis Kapal </th>
        <th>Jenis Alat Pancing </th>
        <th>Ukuran (GT)</th>
        <th>LOA (Meter)</th>
        <th>Bahan Kapal</th>
        <th>Jenis Mesin Utama </th>
        <th>Kapasitas Mesin Utama (PK)</th>
        <th>Kapasitas Palka Ikan (Ton)</th>
        <th>Kapasitas Palka Umpan (Ember)</th>
        <th>VMS </th>
        <th>Lainnya </th>
        <th>IRC Signal </th>
        <th>Jumlah Pancing </th>
        <th>Jumlah ABK </th>
        <th>Nama Kapten </th>
        <th>No. SIPI/SIKPI</th>
        <th>Masa Berlaku SIPI/SIKPI</th>
        <th>RFMO</th>
        <th>Tahun Pembuatan Kapal </th>
        <th>Bendera </th>
        <th>Bendera 2Th ?</th>
        <th>Pelabuhan Pangkalan </th>
        <th>Muat Singgah </th>
        <th>Copy Surat Ijin </th>
        <th>Shark Policy </th>
        <th>Terdaftar IUU </th>
        <th>Kode etik Pelayaran</th> 
        <th>Edit </th>
        <th>Delete </th>
            </tr>
        </tfoot>

    </table>


      </div>
    </div>

  </div>


<div class="container-fluid">
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Vessel Details  </div>
        <div class="card-body">
         
            


<div id="accordion" role="tablist">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
         Upload Vessel
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
                    <?php echo $button_upload; ?>

                                 
                                      <!--<center>
                                            <div class="form-group">
                                               <form class="form-horizontal" action="<?php echo $urlUploadVessels; ?>" method="post" enctype="multipart/form-data">
                                                  <input type="file" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                                      <button class="btn btn-default">Upload</button>
                                                  </form>
                                            </div> 
                                             </center>-->
                                  
                    <div id="msg"></div>

                    <div><div class="alert alert-info">
                      <center><strong>Perhatian!</strong> Masukkan file dengan format penamaan : "KodeSupplier_TahunBulanTanggal". </center>
                    </div></div>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
         Download List Vessels
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
         
          <div><center> <a href="<?php echo $excell_vessel ; ?>" class="btn btn-primary"  >Download Lists</a> </center></div>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
           Download Template Excell
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
         <div><center> <a href="<?php echo $download_template ; ?>" class="btn btn-primary"  >Download Template</a> </center></div>
      </div>
    </div>
  </div>


   <div class="card">
    <div class="card-header" role="tab" id="headingFour">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseFour" role="button" aria-expanded="false" aria-controls="collapseFour">
           Download QR
        </a>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
      <div class="card-body">
         <div><center> <a href="<?php echo $qr_vessel_all ; ?>" class="btn btn-primary"  >Download QR All Vessel</a> </center></div>
      </div>
    </div>
  </div>
</div>



        </div>
    </div>
</div>



 <div class="modal fade" tabindex="-1" role="dialog" id="myModalVessel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <center><h5 class="modal-title">Vessel Add</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form class="form-horizontal" action="<?php echo $url_add_vessel; ?>" method="post" id="AddDataVesselForm">
       <div class="modal-body">

        <div class="messages"></div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="surat-tab" data-toggle="tab" href="#surat" role="tab" aria-controls="profile" aria-selected="false">Surat</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="penomoran-tab" data-toggle="tab" href="#penomoran" role="tab" aria-controls="contact" aria-selected="false">Penomoran</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="form-group">
                      <label>Pilih supplier</label>
                        <select class="form-control" name="id_supplier" id="id_supplier" required>
                               <option value="">Select Perusahaan</option>
                               <?php foreach($listSupplier->result() as $row){ ?>
                                <option value="<?php echo $row->id_supplier ; ?>"><?php echo $row->nama_perusahaan ; ?></option>
                               <?php  } ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label>Nama Kapal</label>
                      <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" placeholder="" required>
                    </div>

                    <div class="form-group">
                      <label>No AP2HI</label>
                      <input type="text" class="form-control" id="no_ap2hi_manual" name="no_ap2hi_manual" placeholder="">
                    </div>
            
                    <div class="form-group">
                      <label>nama_pemilik</label>
                      <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>nama_kapal_2tahun</label>
                      <input type="text" class="form-control" id="nama_kapal_2tahun" name="nama_kapal_2tahun" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>status_kapal</label>
                      <input type="text" class="form-control" id="status_kapal" name="status_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_kapal</label>
                      <input type="text" class="form-control" id="jenis_kapal" name="jenis_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_alat</label>
                      <input type="text" class="form-control" id="jenis_alat" name="jenis_alat" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>ukuran</label>
                      <input type="text" class="form-control" id="ukuran" name="ukuran" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>loa</label>
                      <input type="text" class="form-control" id="loa" name="loa" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bahan</label>
                      <input type="text" class="form-control" id="bahan" name="bahan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_mesin_utama</label>
                      <input type="text" class="form-control" id="jenis_mesin_utama" name="jenis_mesin_utama" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_mesin_utama</label>
                      <input type="text" class="form-control" id="kapasitas_mesin_utama" name="kapasitas_mesin_utama" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_palka_ikan</label>
                      <input type="text" class="form-control" id="kapasitas_palka_ikan" name="kapasitas_palka_ikan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_palka_umpan</label>
                      <input type="text" class="form-control" id="kapasitas_palka_umpan" name="kapasitas_palka_umpan" placeholder="">
                    </div>

                    <div class="form-group"> 
                      <label>vms</label>
                      <input type="text" class="form-control" id="vms" name="vms" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>lainnya</label>
                      <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>irc</label>
                      <input type="text" class="form-control" id="irc" name="irc" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jumlah_pancing</label>
                      <input type="text" class="form-control" id="jumlah_pancing" name="jumlah_pancing" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jumlah_abk</label>
                      <input type="text" class="form-control" id="jumlah_abk" name="jumlah_abk" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>nama_kapten</label>
                      <input type="text" class="form-control" id="nama_kapten" name="nama_kapten" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>lokasi_pembuatan</label>
                      <input type="text" class="form-control" id="lokasi_pembuatan" name="lokasi_pembuatan" placeholder="">
                    </div>


                </div>
              <div class="tab-pane fade" id="surat" role="tabpanel" aria-labelledby="surat-tab">

                     <div class="form-group">
                      <label>no_siup</label>
                      <input type="text" class="form-control" id="no_siup" name="no_siup" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_seafdec</label>
                      <input type="text" class="form-control" id="no_seafdec" name="no_seafdec" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_issf</label>
                      <input type="text" class="form-control" id="no_issf" name="no_issf" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_kkp</label>
                      <input type="text" class="form-control" id="no_kkp" name="no_kkp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_dkp</label>
                      <input type="text" class="form-control" id="no_dkp" name="no_dkp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_vic</label>
                      <input type="text" class="form-control" id="no_vic" name="no_vic" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_nik</label>
                      <input type="text" class="form-control" id="no_nik" name="no_nik" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_sipi</label>
                      <input type="text" class="form-control" id="no_sipi" name="no_sipi" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>masa_berlaku_sipi</label>
                      <input type="text" class="form-control" id="masa_berlaku_sipi" name="masa_berlaku_sipi" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>rfmo</label>
                      <input type="text" class="form-control" id="rfmo" name="rfmo" placeholder="">
                    </div>


              </div>
              <div class="tab-pane fade" id="penomoran" role="tabpanel" aria-labelledby="penomoran-tab">

                    <div class="form-group">
                      <label>tahun_pembuatan_kapal</label>
                      <input type="text" class="form-control" id="tahun_pembuatan_kapal" name="tahun_pembuatan_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bendera</label>
                      <input type="text" class="form-control" id="bendera" name="bendera" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bendera_2th</label>
                      <input type="text" class="form-control" id="bendera_2th" name="bendera_2th" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>pelabuhan_pangkalan</label>
                      <input type="text" class="form-control" id="pelabuhan_pangkalan" name="pelabuhan_pangkalan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>muat_singgah</label>
                      <input type="text" class="form-control" id="muat_singgah" name="muat_singgah" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>copy_surat_ijin</label>
                      <input type="text" class="form-control" id="copy_surat_ijin" name="copy_surat_ijin" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>shark_policy</label>
                      <input type="text" class="form-control" id="shark_policy" name="shark_policy" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>terdaftar_iuu</label>
                      <input type="text" class="form-control" id="terdaftar_iuu" name="terdaftar_iuu" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kode_etik_pelayaran</label>
                      <input type="text" class="form-control" id="kode_etik_pelayaran" name="kode_etik_pelayaran" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_imo</label>
                      <input type="text" class="form-control" id="no_imo" name="no_imo" placeholder="">
                    </div>


              </div>
            </div>

        </div>

       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit data</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- edit modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editVesselModal">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Vessel Edit</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" action="<?php echo $url_edit_vessel; ?>" method="post" id="editDataVesselForm">
        <div class="modal-body">
        <div class="edit-messages"></div>

                            <ul class="nav nav-tabs" id="myTabEdit" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab-edit" data-toggle="tab" href="#homeEdit" role="tab" aria-controls="home" aria-selected="true">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="surat-tab-edit" data-toggle="tab" href="#suratEdit" role="tab" aria-controls="profile" aria-selected="false">Surat</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="penomoran-tab-edit" data-toggle="tab" href="#penomoranEdit" role="tab" aria-controls="contact" aria-selected="false">Penomoran</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContentEdit">
              <div class="tab-pane fade show active" id="homeEdit" role="tabpanel" aria-labelledby="home-tab-edit">

                   
                       <input type="hidden" class="form-control" id="edit_id_vessel" name="edit_id_vessel" placeholder="" readonly>
                    

                    <div class="form-group">
                      <label>Nama Kapal</label>
                      <input type="text" class="form-control" id="edit_nama_kapal" name="edit_nama_kapal" placeholder="" required>
                    </div>

                    <div class="form-group">
                      <label>No AP2HI</label>
                      <input type="text" class="form-control" id="edit_no_ap2hi_manual" name="edit_no_ap2hi_manual" placeholder="">
                    </div>
            
                    <div class="form-group">
                      <label>nama_pemilik</label>
                      <input type="text" class="form-control" id="edit_nama_pemilik" name="edit_nama_pemilik" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>nama_kapal_2tahun</label>
                      <input type="text" class="form-control" id="edit_nama_kapal_2tahun" name="edit_nama_kapal_2tahun" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>status_kapal</label>
                      <input type="text" class="form-control" id="edit_status_kapal" name="edit_status_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_kapal</label>
                      <input type="text" class="form-control" id="edit_jenis_kapal" name="edit_jenis_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_alat</label>
                      <input type="text" class="form-control" id="edit_jenis_alat" name="edit_jenis_alat" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>ukuran</label>
                      <input type="text" class="form-control" id="edit_ukuran" name="edit_ukuran" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>loa</label>
                      <input type="text" class="form-control" id="edit_loa" name="edit_loa" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bahan</label>
                      <input type="text" class="form-control" id="edit_bahan" name="edit_bahan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jenis_mesin_utama</label>
                      <input type="text" class="form-control" id="edit_jenis_mesin_utama" name="edit_jenis_mesin_utama" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_mesin_utama</label>
                      <input type="text" class="form-control" id="edit_kapasitas_mesin_utama" name="edit_kapasitas_mesin_utama" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_palka_ikan</label>
                      <input type="text" class="form-control" id="edit_kapasitas_palka_ikan" name="edit_kapasitas_palka_ikan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kapasitas_palka_umpan</label>
                      <input type="text" class="form-control" id="edit_kapasitas_palka_umpan" name="edit_kapasitas_palka_umpan" placeholder="">
                    </div>

                    <div class="form-group"> 
                      <label>vms</label>
                      <input type="text" class="form-control" id="edit_vms" name="edit_vms" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>lainnya</label>
                      <input type="text" class="form-control" id="edit_lainnya" name="edit_lainnya" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>irc</label>
                      <input type="text" class="form-control" id="edit_irc" name="edit_irc" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jumlah_pancing</label>
                      <input type="text" class="form-control" id="edit_jumlah_pancing" name="edit_jumlah_pancing" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>jumlah_abk</label>
                      <input type="text" class="form-control" id="edit_jumlah_abk" name="edit_jumlah_abk" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>nama_kapten</label>
                      <input type="text" class="form-control" id="edit_nama_kapten" name="edit_nama_kapten" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>lokasi_pembuatan</label>
                      <input type="text" class="form-control" id="edit_lokasi_pembuatan" name="edit_lokasi_pembuatan" placeholder="">
                    </div>


                </div>
              <div class="tab-pane fade" id="suratEdit" role="tabpanel" aria-labelledby="surat-tab-edit">

                     <div class="form-group">
                      <label>no_siup</label>
                      <input type="text" class="form-control" id="edit_no_siup" name="edit_no_siup" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_seafdec</label>
                      <input type="text" class="form-control" id="edit_no_seafdec" name="edit_no_seafdec" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_issf</label>
                      <input type="text" class="form-control" id="edit_no_issf" name="edit_no_issf" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_kkp</label>
                      <input type="text" class="form-control" id="edit_no_kkp" name="edit_no_kkp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_dkp</label>
                      <input type="text" class="form-control" id="edit_no_dkp" name="edit_no_dkp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_vic</label>
                      <input type="text" class="form-control" id="edit_no_vic" name="edit_no_vic" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_nik</label>
                      <input type="text" class="form-control" id="edit_no_nik" name="edit_no_nik" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_sipi</label>
                      <input type="text" class="form-control" id="edit_no_sipi" name="edit_no_sipi" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>masa_berlaku_sipi</label>
                      <input type="text" class="form-control" id="edit_masa_berlaku_sipi" name="edit_masa_berlaku_sipi" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>rfmo</label>
                      <input type="text" class="form-control" id="edit_rfmo" name="edit_rfmo" placeholder="">
                    </div>


              </div>
              <div class="tab-pane fade" id="penomoranEdit" role="tabpanel" aria-labelledby="penomoran-tab-edit">

                    <div class="form-group">
                      <label>tahun_pembuatan_kapal</label>
                      <input type="text" class="form-control" id="edit_tahun_pembuatan_kapal" name="edit_tahun_pembuatan_kapal" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bendera</label>
                      <input type="text" class="form-control" id="edit_bendera" name="edit_bendera" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>bendera_2th</label>
                      <input type="text" class="form-control" id="edit_bendera_2th" name="edit_bendera_2th" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>pelabuhan_pangkalan</label>
                      <input type="text" class="form-control" id="edit_pelabuhan_pangkalan" name="edit_pelabuhan_pangkalan" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>muat_singgah</label>
                      <input type="text" class="form-control" id="edit_muat_singgah" name="edit_muat_singgah" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>copy_surat_ijin</label>
                      <input type="text" class="form-control" id="edit_copy_surat_ijin" name="edit_copy_surat_ijin" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>shark_policy</label>
                      <input type="text" class="form-control" id="edit_shark_policy" name="edit_shark_policy" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>terdaftar_iuu</label>
                      <input type="text" class="form-control" id="edit_terdaftar_iuu" name="edit_terdaftar_iuu" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>kode_etik_pelayaran</label>
                      <input type="text" class="form-control" id="edit_kode_etik_pelayaran" name="edit_kode_etik_pelayaran" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>no_imo</label>
                      <input type="text" class="form-control" id="edit_no_imo" name="edit_no_imo" placeholder="">
                    </div>


              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Edit data</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- tutup edit modal -->


  <!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="disableVesselModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
              <center><h5 class="modal-title">Vessel Disable</h5></center>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="disable-messages"></div>
          <p>Do you really want to disable ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="hapusBtn">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

<script>

$(document).ready(function() {
    
   manageVesselTable = $("#manageVesselTable").DataTable({
        "ajax": "<?php echo $url_load_table ?>",
        "order": [],
    "scrollX": true
    });


   $('#upload').on('click', function () {
                    var file_data = $('#file').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: '<?php echo $urlUploadVessels; ?>', // point to server-side PHP script 
                        dataType :'json',// what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            // display success response from the PHP script
                            alert('Berhasil Upload!'); 

                            if (response.success == true) {
                                var text = "";

                                text += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                        '</div>';
                                 

                                  for (i = 0; i < response.status.excell.length; i++) {

                                      console.log(response.status.excell);

                                      if(response.status.excell[i].act == 'Bad'){

                                        text += '<div class="alert alert-danger alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.status.excell[i].notif+
                                        '</div>';
                                         
                                      }
                                       if(response.status.excell[i].act == 'Good'){


                                        text += '<div class="alert alert-success alert-dismissible" role="alert">'+
                                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                          '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.status.excell[i].notif+
                                        '</div>';
                                        
                                      }
                                  }


                                  $('#msg').html(   

                                    text

                                  );

                                  $("#file").val("");
                                  manageVesselTable.ajax.reload(null,false);

                            }else{

                                 $('#msg').html(


                                  '<div class="alert alert-danger alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                  '</div>'

                                  );

                            }
                        },
                        error: function (response) {
                            $('#msg').html(response.messages); // display error response from the PHP script
                            alert('gagal!'); 
                        }
                    });
                });

    $('#AddDataVesselBtn').on('click',function(){

       $('#AddDataVesselForm')[0].reset();
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();
      $('.messages').html("");

      
      $('#AddDataVesselForm').unbind('submit').bind('submit',function(e){
        $('.text-danger').remove();
        $('.messages').html("");
          var form = $(this);

                      var me = $(this);
                        e.preventDefault();
                      if ( me.data('requestRunning') ) {
                        return;
                      }
                      me.data('requestRunning', true);

                $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType :'json',
                    success:function(response){
                        // remove pesan error
                        $('.form-group').removeClass('has-error').removeClass('has-success');

                        if (response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                            //reset form 
                            $('#AddDataVesselForm')[0].reset();
                            //reload the datatables
                            manageVesselTable.ajax.reload(null,false);
                        }else{
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                        }
                    }
                    , error: function( xhr, status, error){
                            console.log(xhr.statusText);
                            console.log(error);
                            console.log(status);


                            alert('500 Internal server error !');
                      } ,
                      complete: function() {
                        me.data('requestRunning', false);
                      } 
                });

                return false;    
            });
        
    });

} );


function editData(id = null){
  if(id){
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

         $.ajax({
            url: '<?php echo $urlShowEditVessel; ?>',
            type: 'post',
            data: { id : id },
            dataType: 'json',
            success:function(response) {

                $('#edit_id_vessel').val(response.messages[0].id_vessel);
                $('#edit_nama_kapal').val(response.messages[0].nama_kapal);
                $('#edit_no_ap2hi_manual').val(response.messages[0].no_ap2hi_manual);
                $('#edit_nama_pemilik').val(response.messages[0].nama_pemilik);
                $('#edit_nama_kapal_2tahun').val(response.messages[0].nama_kapal_2tahun);
                $('#edit_status_kapal').val(response.messages[0].status_kapal );
                $('#edit_jenis_kapal').val(response.messages[0].jenis_kapal );
                $('#edit_jenis_alat').val(response.messages[0].jenis_alat );
                $('#edit_ukuran').val(response.messages[0].ukuran );
                $('#edit_loa').val(response.messages[0].loa );
                $('#edit_bahan').val(response.messages[0].bahan );
                $('#edit_jenis_mesin_utama').val(response.messages[0].jenis_mesin_utama);
                $('#edit_kapasitas_mesin_utama').val(response.messages[0].kapasitas_mesin_utama );
                $('#edit_kapasitas_palka_ikan').val(response.messages[0].kapasitas_palka_ikan );
                $('#edit_kapasitas_palka_umpan').val(response.messages[0].kapasitas_palka_umpan );
                $('#edit_vms').val(response.messages[0].vms );
                $('#edit_lainnya').val(response.messages[0].lainnya );
                $('#edit_irc').val(response.messages[0].irc );
                $('#edit_jumlah_pancing').val(response.messages[0].jumlah_pancing );
                $('#edit_jumlah_abk').val(response.messages[0].jumlah_abk);
                $('#edit_nama_kapten').val(response.messages[0].nama_kapten );
                $('#edit_lokasi_pembuatan').val(response.messages[0].lokasi_pembuatan);

                $('#edit_no_siup').val(response.messages[0].no_siup );
                $('#edit_no_seafdec').val(response.messages[0].no_seafdec);
                $('#edit_no_issf').val(response.messages[0].no_issf );
                $('#edit_no_kkp').val(response.messages[0].no_kkp );
                $('#edit_no_dkp').val(response.messages[0].no_dkp );
                $('#edit_no_vic').val(response.messages[0].no_vic );
                $('#edit_no_nik').val(response.messages[0].no_nik );
                $('#edit_no_sipi').val(response.messages[0].no_sipi );
                $('#edit_masa_berlaku_sipi').val(response.messages[0].masa_berlaku_sipi );
                $('#edit_rfmo').val(response.messages[0].rfmo );

                $('#edit_tahun_pembuatan_kapal').val(response.messages[0].tahun_pembuatan_kapal);
                $('#edit_bendera').val(response.messages[0].bendera);
                $('#edit_bendera_2th').val(response.messages[0].bendera_2th);
                $('#edit_pelabuhan_pangkalan').val(response.messages[0].pelabuhan_pangkalan );
                $('#edit_muat_singgah').val(response.messages[0].muat_singgah );
                $('#edit_copy_surat_ijin').val(response.messages[0].copy_surat_ijin);
                $('#edit_shark_policy').val(response.messages[0].shark_policy );
                $('#edit_terdaftar_iuu').val(response.messages[0].terdaftar_iuu );
                $('#edit_kode_etik_pelayaran').val(response.messages[0].kode_etik_pelayaran);
                $('#edit_no_imo').val(response.messages[0].no_imo );
      
                     
                
                     $("#editDataVesselForm").unbind('submit').bind('submit', function(e) {
                        $(".text-danger").remove();


                                var form = $(this);
                                var me = $(this);
                                e.preventDefault();
                                  if ( me.data('requestRunning') ) {
                                    return;
                                  }
                                  me.data('requestRunning', true);

                           $.ajax({
                                        url: form.attr('action'),
                                        type: form.attr('method'),
                                        data: form.serialize(),
                                        dataType: 'json',
                                        success:function(response) {
                            if (response.success == true) {
                                $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                '</div>');
                                
                            
                                manageVesselTable.ajax.reload(null,false);
                                
                              }else{
                                $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                '</div>');
                                alert('Gagal');
                              }
                                  } ,
                               error: function(xhr, status, error) {
                                console.log(status);
                                console.log(error);
                            },
                              complete: function() {
                                me.data('requestRunning', false);
                              } 
                          }); // /ajax

                        return false;
                       
                    });
            

            }  // /success
            , error: function( xhr, status, error){
                console.log(xhr.statusText);
                console.log(error);
                console.log(status);


               alert('500 Internal server error !');
            }
                
    }); 

   } else {
        alert('Error: Refresh the page again');
    }
}


function disableData(id = null) {
   
   if(id) {
      
      $("#hapusBtn").unbind('click').bind('click', function() {

          $.ajax({
                url: '<?php echo $url_disable_vessel; ?>',
                type: 'post',
                data: { id : id },
                dataType: 'json',
                success:function(response) {
                  console.log(response);
                     if (response.success == true) {       
                        $(".disable-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
                    
                    manageVesselTable.ajax.reload(null,false);
                    alert('berhasil');
                    $('#disableVesselModal').modal('hide');

                    } else {
                        $(".disable-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }, error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
      }
            });


      }); // click remove btn
    } 
    else {
        alert('Error: Refresh the page again');
    }


}



</script>