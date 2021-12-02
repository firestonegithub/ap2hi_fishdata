    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> vessel Detail </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  vessel Detail </div>
        <div class="card-body">
          <div class="row">

            <div><center>  
                <a type="button" class="btn btn-warning a-btn-slide-text" a href="<?php echo site_url('master/mainpage/doPrintVessel/'.$dataVessel->id_vessel );?>" target="_BLANK">
                                   <span class="fa fa-print" aria-hidden="true" ></span>
                                   <span><strong> Print </strong></span>   
                           </a> 
                 <a type="button" data-toggle="modal" data-target="#editVesselModal" onclick="editData( <?php echo $dataVessel->id_vessel;  ?> )" class="btn btn-primary a-btn-slide-text">
                                        <span class="fa fa-plug" aria-hidden="true"></span>
                                        <span><strong>Edit</strong></span>
                                    </a>
            <?php if( $dataVessel->confirm == 'Confirm') { ?>

                 <a type="button" class="btn btn-success a-btn-slide-text" a href="<?php echo site_url('master/mainpage/confirm_vesssel/'.$dataVessel->id_vessel );?>/UnConfirm">
                                   <span class="fa fa-check" aria-hidden="true" ></span>
                                   <span><strong> UnConfirm </strong></span>   
                           </a> 

            <?php } else { ?>

                <a type="button" class="btn btn-danger a-btn-slide-text" a href="<?php echo site_url('master/mainpage/confirm_vesssel/'.$dataVessel->id_vessel );?>/Confirm" >
                                   <span class="fa fa-dot-circle-o" aria-hidden="true" ></span>
                                   <span><strong> Confirm </strong></span>   
                           </a> 

            <?php } ?>
                  </center>
            </div>


            <div class="col-md-12" style="margin-bottom : 15px; ">
                     <center> <img src="<?php echo base_url();?>media/backend/AP2HI-Logo-Website-2.png"> </center>
            </div>

               <div class="col-md-4">
        	           <?php echo $qrResult; ?>
               </div>

                  <div class="col-md-4">
                    <table>
                      <tr>
                          <td>
                             Nama Kapal 
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->nama_kapal; ?></b>
                           </td>
                        </tr>
                         <tr>
                           <td>
                             No AP2HI
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_ap2hi; ?></b>
                           </td>
                          </tr>
                          <tr>
                            <td>
                            Jenis Kapal
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->jenis_kapal; ?></b>
                           </td>
                          </tr>
                          <tr>
                           <td>
                            Jenis Alat
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->jenis_alat; ?></b>
                           </td>
                          </tr>
                          <tr>
                            <td>
                            Bahan
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->bahan; ?></b>
                           </td>
                          </tr>
                          <tr>
                            <td>
                            Jenis Mesin
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->jenis_mesin_utama; ?></b>
                           </td>
                          </tr>
                            
                          <tr>
                            <td>
                            no_ap2hi
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_ap2hi; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_siup
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->no_siup; ?></b>
                           </td>
                          </tr>


  
                            <tr>
                            <td>
                            no_seafdec
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->jenis_mesin_utama; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_issf
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_issf; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_kkp
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_kkp; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_dkp
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_dkp; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_vic
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_vic; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_nik
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_nik; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            nama_kapal_2tahun
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->nama_kapal_2tahun; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            status_kapal
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->status_kapal; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            ukuran
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->ukuran; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            loa
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->loa; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            kapasitas_mesin_utama
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->kapasitas_mesin_utama; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            kapasitas_palka_ikan
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->kapasitas_palka_ikan; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            kapasitas_palka_umpan
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->kapasitas_palka_umpan; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            vms
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->vms; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            lainnya
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->lainnya; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            irc
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->irc; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            jumlah_pancing
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->jumlah_pancing; ?></b>
                           </td>
                          </tr>

                          
                         

                         


                    </table>
                   </div>

                   <div class="col-md-4">
                    <table>
                      <tr>
                        <td> Supplier </td>
                        <td>
                             :
                           </td>
                        <td> <b><?php echo $dataSupplier->nama_perusahaan;  ?></b></td>
                      </tr>

                       <tr>
                        <td> Tipe Perusahaan </td>
                        <td>
                             :
                           </td>
                        <td>  <b><?php echo $dataSupplier->tipe_perusahaan;  ?></b>  </td>
                      </tr>

                       <tr>
                        <td>Lokasi </td>
                        <td>
                             :
                           </td>
                        <td>  <b><?php echo $dataSupplier->lokasi;  ?></b> </td>
                      </tr>

                       <tr>
                        <td> Alamat </td>
                        <td>
                             :
                           </td>
                        <td> <b><?php echo $dataSupplier->address;  ?></b>  </td>
                      </tr>


                         <tr>
                            <td>
                            jumlah_abk
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->jumlah_abk; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            nama_kapten
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->nama_kapten; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            no_sipi
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_sipi; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            masa_berlaku_sipi
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->masa_berlaku_sipi; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            rfmo
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->rfmo; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            tahun_pembuatan_kapal
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->tahun_pembuatan_kapal; ?></b>
                           </td>
                          </tr>

                             
                          <tr>
                            <td>
                            bendera
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->bendera; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            bendera_2th
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                              <b><?php echo $dataVessel->bendera_2th; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            pelabuhan_pangkalan
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->pelabuhan_pangkalan; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            muat_singgah
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->muat_singgah; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            copy_surat_ijin
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->copy_surat_ijin; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            shark_policy
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->shark_policy; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            terdaftar_iuu
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->terdaftar_iuu; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            kode_etik_pelayaran
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->kode_etik_pelayaran; ?></b>
                           </td>
                          </tr>

                           
                            <tr>
                            <td>
                            no_imo
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->no_imo; ?></b>
                           </td>
                          </tr>

                          
                            <tr>
                            <td>
                            lokasi_pembuatan
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->lokasi_pembuatan; ?></b>
                           </td>
                          </tr> 

                           
                            <tr>
                            <td>
                            status
                           </td>
                           <td>
                             :
                           </td>
                           <td>
                               <b><?php echo $dataVessel->status; ?></b>
                           </td>
                          </tr>

                      

         
                    </table>
                   </div>

          
                   


          </div>
		    </div>
   		</div>

  	</div>




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


<script>

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

</script>