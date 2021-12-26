   <?php

    $ci = get_instance();

    
    ?>




    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"> Sampling Uploaded Lists </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>  Sampling Uploaded Lists </div>
        <div class="card-body">
          

              <div class="table-responsive">
					<div class="overflow-style">


    <?php 


    if($k_tpi != ""){

    	 $mk_tpi = $k_tpi;
	     $mtahun = $tahun ; 

    	 if ($bulan != "")
			    {
			      $mbulan=$bulan;
			      $mn_bulan=$bulan;
			    }
			    else
			    {
			      $mbulan='xxx';
			    }

    }else{


    	 $mk_tpi='';


    }






?>

              </div>          
      </div>


<!-- SULLIER START -->

<?php if( $tahun == '' && $k_tpi == '' ){ ?>

     <div class="table-responsive" style="margin-top:50px">
					<div class="overflow-style">
<?php 

	$addition = ''; 

 if(count($user->list_supp) > 0){

 		$addition .=" and master_supplier.id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

 }	


  $query = "select tps_pendaratan.k_perusahaan,nama_perusahaan ,tipe_perusahaan ,thn_sampling,sum(bbm) as bbm, sum(es) as es,";
  $query = $query."count(tps_pendaratan.k_perusahaan) as supplier  ,sum(total_penangkapan) as tangkapan,sum(est_ikanhilang) as hilang, sum(lama_hari) as lama_hari, sum(lama_jam) as lama_jam  ";
  $query = $query."from tps_pendaratan, master_supplier where master_supplier.id_supplier=tps_pendaratan.k_perusahaan  ".$addition."  and status_trip = '1' ";
  $query = $query."group by tps_pendaratan.k_perusahaan ,nama_perusahaan ,tipe_perusahaan ,thn_sampling order by tps_pendaratan.k_perusahaan,nama_perusahaan,thn_sampling ";

  $result = $this->db->query($query)->result(); ;


  $sw=0;
  $x1=0; $x2=0; $x3=0; $x4=0; $x5=0; 
  $y1=0; $y2=0; $y3=0; $y4=0; $y5=0; 
?>

					<table border="1" width="100%" class="table-style">
						<tr>
							<td colspan="7" align="center" bgcolor="#CCCCCC">
							<p align="center"><b>Informasi Pendaratan</b></td>
							<td colspan="5" align="center" bgcolor="#CCCCCC">
							<p align="center"><b>Informasi Tangkapan (Kg)</b></td>
						</tr>
						<tr>
							<td colspan="3" align="center" bgcolor="#CCCCCC">
							<b>Pendaratan Kapal</b></td>
							<td colspan="2" align="center" bgcolor="#CCCCCC">
							<b>Jumlah Trip</b></td>
							<td colspan="2" align="center" bgcolor="#CCCCCC">
							<b>Penggunaan</b></td>
							<td align="center" rowspan="2" bgcolor="#CCCCCC"><b>Total </b></td>
							<td align="center" bgcolor="#CCCCCC" colspan="2"><b>Utama (Tuna)</b></td>
							<td align="center" bgcolor="#CCCCCC" rowspan="2"><b>Samping</b></td>
							<td align="center" rowspan="2" bgcolor="#CCCCCC"><b>Hilang</b></td>
							
						</tr>
						<tr>
							<td align="center" bgcolor="#CCCCCC"><b>Perusahaan</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Tahun</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Jumlah</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Hari</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Jam</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>BBM (Liter)</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Es (Kg) </b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Jenis I</b></td>
							<td align="center" bgcolor="#CCCCCC"><b>Jenis II</b></td>	
						</tr>


												<?php 

																	 foreach ($result as $record) 
												  {
													//for rowspan
													$query = "select count(distinct(thn_sampling)) as hasil from tps_pendaratan where k_perusahaan = '".$record->k_perusahaan."'  and status_trip = '1' " ; 
													$result_years = $this->db->query($query)->row(); 
													$teks='';
													$nama_lokasi = '';
													  if ($sw==0)
													  {
														$sw=1;
														$mn_tpi=$record->nama_perusahaan;
														$teks=$record->nama_perusahaan;
															
															$nama_lokasi = '<td align="center" rowspan = "'.$result_years->hasil.'" ><center>'.$teks.'</center></td>';
													  }
													  elseif ($mn_tpi!=$record->nama_perusahaan )
													  {
														$mn_tpi=$record->nama_perusahaan;
															
															$teks=$record->nama_perusahaan;
															
															$nama_lokasi = '<td align="center" rowspan = "'.$result_years->hasil.'" ><center>'.$teks.'</center></td>';
													  }
													//end for rowspan  

												?>
													<tr>
														<?php
												  		  $sql="select sum(tps_bycatch.berat) as berat from tps_bycatch,tps_pendaratan where tps_bycatch.namafile=tps_pendaratan.namafile";
												  		  $sql=$sql." and k_perusahaan='".$record->k_perusahaan."' and thn_sampling=".$record->thn_sampling."  and status_trip = '1' ";
												  		  $res1 = $this->db->query($sql)->result(); 
												  		  if ($result) 
												  		  {
												  		    foreach ($res1 as $rec1)
												            {
												              $bycatch=$rec1->berat;
												            }
												          }
												          else
												          {
												            $bycatch=0;
												          } 

												  		  $sql="select sum(tps_ikanbesar.berat) as berat from tps_ikanbesar,tps_pendaratan where tps_ikanbesar.namafile=tps_pendaratan.namafile";
												  		  $sql=$sql." and k_perusahaan='".$record->k_perusahaan."' and thn_sampling=".$record->thn_sampling."  and status_trip = '1' ";
												  		  $res1 =$this->db->query($sql)->result(); 
												  		  if ($result) 
												  		  {
												  		    foreach ($res1 as $rec1)
												            {
												              $besar=$rec1->berat;
												            }
												          }
												          else
												          {
												            $besar=0;
												          } 
												          
												          if ($besar+$bycatch > $record->tangkapan)
												          {
												             $kecil=0;
												          }
												          else
												          {
												            $kecil=$record->tangkapan-$besar-$bycatch;
												          }
												          
												          $x1=$x1+$record->supplier;
												          $x2=$x2+$record->lama_hari;
												          $x3=$x3+$record->lama_jam;
												          $x4=$x4+$record->bbm;
												          $x5=$x5+$record->es;
												          $y1=$y1+$kecil+$besar+$bycatch;
												          $y2=$y2+$kecil;
												          $y3=$y3+$besar;
												          $y4=$y4+$bycatch;
												          $y5=$y5+$record->hilang;
														?>
														<?php echo $nama_lokasi ?>
														<td align="center" ><a href="<?php echo base_url()."data/mainpage/samplinglists_supplier/".$record->k_perusahaan."/".$record->thn_sampling; ?>"><?php echo $record->thn_sampling; ?></a></td>
														<td align="center"><?php echo number_format($record->supplier); ?></td>
														<td align="center"><?php echo number_format($record->lama_hari); ?></td>
														<td align="center"><?php echo number_format($record->lama_jam); ?></td>
														<td align="center"><?php echo number_format($record->bbm); ?></td>
														<td align="center"><?php echo number_format($record->es); ?></td>
														<td align="center"><?php echo number_format($kecil+$besar+$bycatch); ?></td>
														<td align="center"><?php echo number_format($kecil); ?></td>
														<td align="center"><?php echo number_format($besar); ?></td>
														<td align="center"><?php echo number_format($bycatch); ?></td>
														<td align="center"><?php echo number_format($record->hilang); ?></td>
													
												       </tr>
												<?php
												  }
												?>




													<tr>
															<td align="center" bgcolor="#CCCCCC" colspan="2"><b>Total</b></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($x1); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($x2); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($x3); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($x4); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($x5); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($y1); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($y2); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($y3); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($y4); ?></td>
															<td align="center" bgcolor="#CCCCCC"><?php echo number_format($y5); ?></td>
														</tr>
					</table>



              </div>          
      </div>

<?php } ?>

<!-- Supplier End -->




    </div>

  </div>
