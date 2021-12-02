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


    if($k_perusahaan != ""){

    	 $mk_tpi = $k_perusahaan;
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








     if($k_perusahaan != '')
     {

     		$query = "SELECT * from master_supplier where id_supplier ='".$mk_tpi."'";
			$result = $this->db->query($query)->row_array();
			$nama_perusahaan = $result['nama_perusahaan'] ; 


    		?>


    		<table border="0" bgcolor="#FFFFFF" width="100%" style="padding:5px 15px">
				<tr>
					<td bgcolor="#FFFFFF" width="250">Tempat Pendaratan Kapal</td>
					<td bgcolor="#FFFFFF" width="3">:</td>
					<td><?php echo $nama_perusahaan ; ?></td>
				</tr>
			
				<tr>
					<td bgcolor="#FFFFFF" width="170">Tahun </td>
					<td bgcolor="#FFFFFF" width="3">:</td>
					<td><?php echo $tahun ; ?></td>
				</tr>
			</table>

			<?php 
  if ($mbulan=='xxx')
  {
    $c1='Tahun';
    $c2=$mtahun;
    $c3='Bulan';
  }
  else
  {
    $c1='Bulan';
    $c2=$mn_bulan.' '.$mtahun;
    $c3='Tgl';
  }
?>	


<table border="1" width="100%" class="table-style">
	<tr>
		<td colspan="6" align="center" bgcolor="#CCCCCC">
		<p align="center"><b>Informasi Pendaratan</b></td>
		<td colspan="5" align="center" bgcolor="#CCCCCC">
		<p align="center"><b>Informasi Tangkapan (Kg)</b></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#CCCCCC">
		<b>Pendaratan Kapal</b></td>
		<td colspan="2" align="center" bgcolor="#CCCCCC">
		<b>Jumlah Trip</b></td>
		<td colspan="2" align="center" bgcolor="#CCCCCC">
		<b>Penggunaan</b></td>
		<td align="center" rowspan="2" bgcolor="#CCCCCC"><b>Total </b></td>
		<td align="center" bgcolor="#CCCCCC" colspan="2"><b>Utama 
		(Tuna)</b></td>
		<td align="center" bgcolor="#CCCCCC" rowspan="2"><b>Samping</b></td>
		<td align="center" rowspan="2" bgcolor="#CCCCCC"><b>Hilang</b></td>
		
	</tr>
	<tr>
		<td align="center" bgcolor="#CCCCCC"><b><?php echo $c3; ?></b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Jumlah</b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Hari</b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Jam</b></td>
		<td align="center" bgcolor="#CCCCCC"><b>BBM (Liter)</b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Es (Kg) </b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Jenis I</b></td>
		<td align="center" bgcolor="#CCCCCC"><b>Jenis II</b></td>
		
	</tr>

	<?php
  if ($mbulan=='xxx')
  {
    $query = "select bln_sampling,n_bulan,sum(bbm) as bbm, sum(es) as es,";
    $query = $query."count(bln_sampling) as landing,sum(total_penangkapan) as tangkapan,sum(est_ikanhilang) as hilang, sum(lama_hari) as lama_hari, sum(lama_jam) as lama_jam";
    $query = $query." from tps_pendaratan,tab_bulan where k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun.' and tab_bulan.k_bulan=tps_pendaratan.bln_sampling'."  and status_trip = '1' ";
    $query = $query." group by bln_sampling,n_bulan order by bln_sampling,n_bulan";
  }
  else
  {
    $query = "select tgl_sampling,sum(bbm) as bbm, sum(es) as es,";
    $query = $query."count(tgl_sampling) as landing,sum(total_penangkapan) as tangkapan,sum(est_ikanhilang) as hilang, sum(lama_hari) as lama_hari, sum(lama_jam) as lama_jam";
    $query = $query." from tps_pendaratan where k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun.' and bln_sampling='.$mbulan."  and status_trip = '1' ";
    $query = $query." group by tgl_sampling order by tgl_sampling";
  }
 
  
  $result = $this->db->query($query)->result(); ;
  $x1=0; $x2=0; $x3=0; $x4=0; $x5=0; 
  $y1=0; $y2=0; $y3=0; $y4=0; $y5=0; 

?>


    		<?php
    

  foreach ($result as $record) 
  {
?>
	<tr>
		<?php
          if ($mbulan=='xxx')
          {
    		$sql="select sum(tps_bycatch.berat) as berat from tps_bycatch,tps_pendaratan where tps_bycatch.namafile=tps_pendaratan.namafile";
    		$sql=$sql." and k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun." and bln_sampling=".$record->bln_sampling."  and status_trip = '1' ";
          }
          else
          {
    		$sql="select sum(tps_bycatch.berat) as berat from tps_bycatch,tps_pendaratan where tps_bycatch.namafile=tps_pendaratan.namafile";
  		    $sql=$sql." and k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun." and bln_sampling=".$mbulan." and tgl_sampling=".$record->tgl_sampling."  and status_trip = '1' ";
          }
 		  $res1 = $this->db->query($sql)->result(); ;
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

          if ($mbulan=='xxx')
          {
    		$sql="select sum(tps_ikanbesar.berat) as berat from tps_ikanbesar,tps_pendaratan where tps_ikanbesar.namafile=tps_pendaratan.namafile";
  		    $sql=$sql." and k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun." and bln_sampling=".$record->bln_sampling."  and status_trip = '1' ";
          }
          else
          {
    		$sql="select sum(tps_ikanbesar.berat) as berat from tps_ikanbesar,tps_pendaratan where tps_ikanbesar.namafile=tps_pendaratan.namafile";
  		    $sql=$sql." and k_perusahaan='".$mk_tpi."' and thn_sampling=".$mtahun." and bln_sampling=".$mbulan." and tgl_sampling=".$record->tgl_sampling."  and status_trip = '1' ";
          }

  		  $res1 = $this->db->query($sql)->result(); 
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
          
          
          $x1=$x1+$record->landing;
          $x2=$x2+$record->lama_hari;
          $x3=$x3+$record->lama_jam;
          $x4=$x4+$record->bbm;
          $x5=$x5+$record->es;
          $y1=$y1+$kecil+$besar+$bycatch;
          $y2=$y2+$kecil;
          $y3=$y3+$besar;
          $y4=$y4+$bycatch;
          $y5=$y5+$record->hilang;
          if ($mbulan=='xxx')
          {
          	?>

          	<td align="center" ><a href="<?php echo base_url()."data/mainpage/samplinglists_supplier/".$mk_tpi."/".$mtahun."/".$record->bln_sampling; ?>"><?php echo $record->n_bulan; ?></a></td>

          <?php 
		?>
		<?php
          }
          else
          {
          	?>
           	<td align="center"><a href="<?php echo base_url()."data/mainpage/samplinglists_supplier_tgl/".$mk_tpi."/".$mtahun."/".$mbulan."/".$record->tgl_sampling; ?>"><?php echo $record->tgl_sampling; ?></a></td>
 
		<?php
           
        ?>    
       <?php
            
          }
        ?> 
        
        
		<td align="center"><?php echo number_format($record->landing); ?></td>
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
		<td align="center" bgcolor="#CCCCCC"><b>Total</b></td>
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



	 <?php } ?>


































              </div>          
      </div>







    </div>

  </div>
