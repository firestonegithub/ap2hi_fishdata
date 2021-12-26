   <?php

    $ci = get_instance();

    
    ?>

    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> overview </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  overview </div>
        <div class="card-body">
          


              <div class="table-responsive">




               <table class="table table-bordered">
                    

                    <tr>
                      <td rowspan="2"><center><b>Supplier</b></center></td>
                      <td rowspan="2"><center><b>Tahun</b></center></td>
                      <td rowspan="2"><center><b>Tipe</b></center></td>
                      <td colspan="3"><center><b>Trip Info</b></center></td>
                      <td colspan="11"><center><b>Total Tangkapan (Kg)</b></center></td>
                     </tr>
                    
                    <tr>
                      <td><center><b>Trip</b></center></td>
                      <td><center><b>Solar</b></center></td>
                      <td><center><b>Es</b></center></td>

                      <td><center><b> total_tangkapan </b></center></td>
                      <td><center><b> total_yft </b></center></td>
                      <td><center><b> total_bet </b></center></td>
                      <td><center><b> total_skj </b></center></td>
                      <td><center><b> total_kaw </b></center></td>
                      <td><center><b> total_bycatch </b></center></td>
                      <td><center><b> total_loin_kotor </b></center></td>
                      <td><center><b> total_loin_bersih </b></center></td>
                      <td><center><b> total_jumlah_loin </b></center></td>
                      <td><center><b> total_all_loin </b></center></td>
                      <td><center><b> total_ikanhilang </b></center></td>
                    </tr>

                    <?php 
                       $sw = 0;

                       $jumlah_trip = 0;
                       $total_jumlah_solar = 0; 
                       $total_es = 0;

                       $total_tangkapan = 0;
                       $total_yft = 0;
                       $total_bet = 0;
                       $total_skj = 0;
                       $total_kaw = 0;
                       $total_bycatch = 0;
                       $total_loin_kotor = 0;
                       $total_loin_bersih = 0;
                       $total_jumlah_loin = 0;
                       $total_all_loin = 0;
                       $total_ikanhilang = 0;

                        foreach($results->result() as $res){
                            $teks=''; 
                            $nama_lokasi = '';

                            $query = $ci->Model_statistic->getCount($res->id_supplier) ; 
                            $result_years = $query->row();
                            $result_years->hasil;

                            $jumlah_trip = $jumlah_trip + $res->jumlah_trip ;
                            $total_jumlah_solar = $total_jumlah_solar + $res->total_jumlah_solar ; 
                            $total_es = $total_es + $res->total_es;

                             $total_tangkapan = $total_tangkapan + $res->total_tangkapan ;
                             $total_yft = $total_yft + $res->total_yft ;
                             $total_bet = $total_bet + $res->total_bet ;
                             $total_skj = $total_skj + $res->total_skj ;
                             $total_kaw = $total_kaw + $res->total_kaw ;
                             $total_bycatch = $total_bycatch + $res->total_bycatch;
                             $total_loin_kotor = $total_loin_kotor + $res->total_loin_kotor ;
                             $total_loin_bersih = $total_loin_bersih + $res->total_loin_bersih;
                             $total_jumlah_loin = $total_jumlah_loin + $res->total_jumlah_loin;
                             $total_all_loin = $total_all_loin + $res->total_all_loin;
                             $total_ikanhilang = $total_ikanhilang + $res->total_ikanhilang;


                             if ($sw==0)
                              {
                                $sw=1;
                                $nama_perusahaan=$res->nama_perusahaan;  
                                $teks = $res->nama_perusahaan;   
                                $nama_lokasi = '<td align="center" rowspan = "'.$result_years->hasil.'" ><center>'.$teks.'</center></td>';
                                    
                              }elseif($nama_perusahaan!=$res->nama_perusahaan ){
                                $nama_perusahaan=$res->nama_perusahaan;
                                $teks = $res->nama_perusahaan;  
                                $nama_lokasi = '<td align="center" rowspan = "'.$result_years->hasil.'" ><center>'.$teks.'</center></td>';   
                              }
                      ?>

                      <tr>
                        <td><center> <?php echo $res->nama_perusahaan ;?> </center></td>
                        <td><center> <?php echo $res->tahun ;?> </center></td>
                        <td><center> <?php echo $res->tipe ;?> </center></td>

                        <td><center> <?php echo number_format($res->jumlah_trip) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_jumlah_solar) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_es) ;?> </center></td>

                        <td><center> <?php echo number_format($res->total_tangkapan) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_yft) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_bet) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_skj) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_kaw) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_bycatch) ;?> </center></td>
                         <td><center> <?php echo number_format($res->total_loin_kotor);?>  </center></td>
                        <td><center> <?php echo number_format($res->total_loin_bersih) ;?> </center></td>
                        <td><center> <?php echo number_format($res->total_jumlah_loin) ;?>  </center></td>
                        <td><center> <?php echo number_format($res->total_all_loin) ;?>  </center></td>
                        <td><center> <?php echo number_format($res->total_ikanhilang) ;?>  </center></td>
                      </tr>

                      <?php 
                        }
                      ?>

                      <tr>
                        <td align="center" colspan="3"><b> <center>  </center> </b></td>
                        <td align="center"><b> <center> <?php echo number_format($jumlah_trip);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_jumlah_solar);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_es);  ?> </center></b></td>
                        
                        <td align="center"><b> <center> <?php echo number_format($total_tangkapan);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_yft);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_bet);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_skj);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_kaw);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_bycatch);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_loin_kotor);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_loin_bersih);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_jumlah_loin);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_all_loin);  ?> </center></b></td>
                        <td align="center"><b> <center> <?php echo number_format($total_ikanhilang);  ?> </center></b></td>
                      </tr>

                  </table>




              </div>

           
          
      </div>
    </div>

  </div>