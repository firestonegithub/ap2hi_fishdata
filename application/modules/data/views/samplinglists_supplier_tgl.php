<?php 
	$mk_tpi = $k_perusahaan;
	$mtahun = $tahun;
	$mbulan = $bulan;
	$mtgl   = $tgl;
	$thn=$tahun;
	

	 $a1="Tgl. Pendaratan Kapal";
     $a2='Tempat Pendaratan';
     $b1='Pendaratan Kapal';
     $b2='Total Berat (Kg)';
     $b3='Ikan Kecil';
     $b4='Ikan Besar';
     $c1='Jam';
     $c2='Nama Kapal';
     $c3='Total';
     $c4='Hilang';
     $c5='Pjg';
     $c6='Berat';
     $jml='Jml';
     $cat='Catatan : [Pjg] = Panjang Rata-Rata (Cm), [Berat] = Total Berat';
	 $info = 'Klik untuk informasi detail' ;

	if ($mbulan=="01") { 
	   $xtahun = $mtgl." Januari " .$mtahun; 
	} elseif ($mbulan=="02") { 
	   $xtahun = $mtgl." Februari " .$mtahun; 
	} elseif ($mbulan=="03") { 
	   $xtahun = $mtgl." Maret " .$mtahun; 
	} elseif ($mbulan=="04") { 
	  $xtahun = $mtgl." April " .$mtahun; 
	} elseif ($mbulan=="05") { 
	  $xtahun = $mtgl." Mei " .$mtahun; 
	} elseif ($mbulan=="06") { 
	  $xtahun = $mtgl." Juni " .$mtahun; 
	} elseif ($mbulan=="07") { 
	  $xtahun = $mtgl." Juli " .$mtahun; 
	} elseif ($mbulan=="08") { 
	  $xtahun = $mtgl." Agustus " .$mtahun; 
	} elseif ($mbulan=="09") { 
	   $xtahun = $mtgl." September " .$mtahun; 
	} elseif ($mbulan=="10") { 
	   $xtahun = $mtgl." Oktober " .$mtahun; 
	} elseif ($mbulan=="11") { 
	  $xtahun = $mtgl." November " .$mtahun; 
	} elseif ($mbulan=="12") { 
	  $xtahun = $mtgl." Desember " .$mtahun;
	}



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

        	<?php 


        	$query = "SELECT * from master_supplier where id_supplier ='".$mk_tpi."'";
			$result = $this->db->query($query)->result();
			foreach ($result as $record) {
			?>

	
			<table border="0" width="100%" style="padding:10px 10px;">
				<tr>
					<td width="152"><?php echo $a2; ?></td>
					<td width="5">:</td>
		
					<td><?php echo $record->nama_perusahaan; ?></td>
		
				</tr>
				<tr>
					<td width="152"><?php echo $a1; ?></td>
					<td width="5">:</td>
					<td><?php echo $xtahun; ?></td>
				</tr>
			</table>
			<?php
			}
			?>



        	<div class="overflow-style">
<table border="1" width="100%" class="table-style">
	<tr>
		<td colspan="2" bgcolor="#CCCCFF" rowspan="2" align="center">
		<p align="center"><b><?php echo $b1; ?></b></td>
		<td align="center" colspan="2" bgcolor="#CCCCFF" rowspan="2"><b><?php echo $b2; ?></b></td>
		<td colspan="3" align="center" bgcolor="#CCCCFF" ><b><?php echo $b3; ?></b></td>
		<td colspan="9" align="center" bgcolor="#CCCCFF" ><b><?php echo $b4; ?></b></td>
	</tr>
	<tr>
		<td  align="center" bgcolor="#CCCCFF"><b>YFT</b></td>
		<td  align="center" bgcolor="#CCCCFF"><b>BET</b></td>
		<td align="center"  bgcolor="#CCCCFF"><b>SKJ</b></td>
		<td colspan="3" bgcolor="#CCCCFF" align="center">
		<p align="center"><b>YFT</b></td>
		<td colspan="3" bgcolor="#CCCCFF" align="center">
		<p align="center"><b>BET</b></td>
		<td colspan="3" bgcolor="#CCCCFF" align="center">
		<p align="center"><b>ALB</b></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c1; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c2; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c3; ?></b></td>
		
		
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c4; ?></b></td>
		
		
		
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $jml; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c5; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $jml; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c5; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $jml; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c5; ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo $c6; ?></b></td>
	</tr>

<?php


	
$query = "SELECT namafile,k_perusahaan,jam_sampling,mnt_sampling,nama_kapal, total_penangkapan as tot1, est_ikanhilang as est , tipe from tps_pendaratan where k_perusahaan='".$mk_tpi."' and thn_sampling=".$thn." and bln_sampling=".$mbulan." and tgl_sampling=".$mtgl."  and status_trip = '1'  order by jam_sampling,mnt_sampling";
$result = $this->db->query($query)->result();
$mt1=0; $mt3=0; $mt4=0;
$k1=0; $k2=0; $k3=0; $k4=0; $k5=0; $k6=0; $jk2=0; $jk4=0; $jk6=0;
$b1=0; $b2=0; $b3=0; $b4=0; $b5=0; $b6=0; $jb2=0; $jb5=0;
$b7=0; $b8=0; $b9=0; $jb6=0;
$total_berat_yft = 0; $total_berat_bet = 0; $total_berat_sjk = 0;

$urut=0;
foreach ($result as $record) {

$lanj='Y';



if ($record->jam_sampling<10) {
   $mwaktu="0".$record->jam_sampling;
}
else {
   $mwaktu=$record->jam_sampling;
}

if ($record->mnt_sampling<10) {
   $mwaktu=$mwaktu.":0".$record->mnt_sampling;
}
else {
   $mwaktu=$mwaktu.":".$record->mnt_sampling;
}

$mt1=$mt1+1;
$mt3=$mt3+$record->tot1;
$mt4=$mt4+$record->est;
?>
	<tr>
<?php 
if ($lanj=='Y') {
	$link=base_url()."data/mainpage/detailnamafile/".$record->namafile; 
?>
		<td><p align="center"><a href="<?php echo $link;  ?>"><?php echo $mwaktu;?></a>		
<?php 
}
else
{
?>
		<td><p align="center"><?php echo $mwaktu;?>		

<?php 
}
?>



		</td>
		<td>
		<p align="center">
<?php 

  echo $record->nama_kapal;

?>



</td>
		<td >
		<p align="center"><?php echo number_format($record->tot1);?></td>
		
	
		<td ><p align="center"><?php echo number_format($record->est);?></td>
	
<?php



$query = "select k_species,count(k_species) as jml, avg(i.panjang) as pjg , sum(kalkulasi_berat) as berat from tps_pendaratan p,tps_keranjang k,tps_ikankecil i where p.namafile=k.namafile and i.namafile=k.namafile and i.nomor=k.nomor and 
k_perusahaan='".$mk_tpi."' and thn_sampling=".$thn." and bln_sampling=".$mbulan." and tgl_sampling=".$mtgl." and jam_sampling=".$record->jam_sampling." and mnt_sampling=".$record->mnt_sampling."  and status_trip = '1'  group by k_species";

$res = $this->db->query($query)->result(); 
$yft1=0; $yft2=0; $yft3=0;
$bet1=0; $bet2=0; $bet3=0;
$sjk1=0; $sjk2=0; $sjk3=0;
$summary_yft = 0; $summary_bet = 0; $summary_skj = 0;
foreach ($res as $rec) {
   if ($rec->k_species=='YFT') {
      $yft1=$rec->jml;
      $yft2=$rec->pjg;
	  $yft3=$rec->berat;
	  }
   elseif ($rec->k_species=='BET') {
      $bet1=$rec->jml;
      $bet2=$rec->pjg;
	  $bet3=$rec->berat;
	  }
   elseif ($rec->k_species=='SKJ')  {
      $sjk1=$rec->jml;
      $sjk2=$rec->pjg;
	  $sjk3=$rec->berat;
	  }
}

//Ikan Kecil Summary Start 
	$query="select k_species , sum (total_berat_all)  as total_berat_all from tps_pendaratan p , tps_total_ikankecil t ";
	$query=$query." where t.namafile = p.namafile ";
	$query=$query." and k_perusahaan='".$mk_tpi."'";
	$query=$query." and thn_sampling=".$thn." and bln_sampling=".$mbulan." and tgl_sampling=".$mtgl." and jam_sampling=".$record->jam_sampling." and mnt_sampling=".$record->mnt_sampling."  and status_trip = '1'  group by k_species ";
	$res = $this->db->query($query)->result(); 
	foreach ($res as $rec) {
		if ($rec->k_species=='YFT') {
			 $summary_yft  = $rec->total_berat_all;
		
		}
		
		elseif ($rec->k_species=='BET') {
			 $summary_bet  = $rec->total_berat_all;
		}
		
		 elseif ($rec->k_species=='SKJ') {
			$summary_skj = $rec->total_berat_all;
		 }
		
	}
	
	//Ikan Kecil Summary End

$k1=$k1+$yft1;
$total_berat_yft = $total_berat_yft + $summary_yft;
if ($yft1!=0)
{
  $k2=$k2+$yft2;
  $jk2=$jk2+1;
}
$k3=$k3+$bet1;
$total_berat_bet = $total_berat_bet + $summary_bet;
if ($bet1!=0)
{
  $k4=$k4+$bet2;
  $jk4=$jk4+1;
}  
$k5=$k5+$sjk1;
$total_berat_sjk = $total_berat_sjk + $summary_skj;
if ($sjk1!=0)
{
  $k6=$k6+$sjk2;
  $jk6=$jk6+1;
}  
?>
		
		<td align="center"  ><?php echo number_format($summary_yft); ?></td>
		<td align="center"  ><?php echo number_format($summary_bet); ?></td>
		<td align="center"  ><?php echo number_format($summary_skj); ?></td>
<?php

$query = "select k_species,count(k_species) as jml, avg(i.panjang) as pjg, sum(berat) as berat from tps_pendaratan p,tps_ikanbesar i where p.namafile=i.namafile and k_perusahaan='".$mk_tpi."' and thn_sampling=".$thn." and bln_sampling=".$mbulan." and tgl_sampling=".$mtgl." and jam_sampling=".$record->jam_sampling." and mnt_sampling=".$record->mnt_sampling."  and status_trip = '1'  group by k_species";

$res = $this->db->query($query)->result(); 
$yft1=0; $yft2=0; $yft3=0;
$bet1=0; $bet2=0; $bet3=0;
$alb1=0; $alb2=0; $alb3=0;
foreach ($res as $rec) {
   if ($rec->k_species=='YFT') {
      $yft1=$rec->jml;
      $yft2=$rec->pjg; 
      $yft3=$rec->berat; }
   elseif ($rec->k_species=='BET') {
      $bet1=$rec->jml;
      $bet2=$rec->pjg; 
      $bet3=$rec->berat; }
   
   elseif ($rec->k_species=='ALB') {
      $alb1=$rec->jml;
      $alb2=$rec->pjg; 
      $alb3=$rec->berat; }
?>
<?php
}
$b1=$b1+$yft1;
if ($yft1!=0)
{
  $b2=$b2+$yft2;
  $jb2=$jb2+1;
}  
$b3=$b3+$yft3;
$b4=$b4+$bet1;
if ($bet1!=0)
{
  $b5=$b5+$bet2;
  $jb5=$jb5+1;
}  
$b6=$b6+$bet3;

$b7=$b7+$alb1;
if ($alb1!=0)
{
  $b8=$b8+$alb2;
  $jb6=$jb6+1;
}  
$b9=$b9+$alb3;
?>
		<td align="center"  ><?php echo number_format($yft1); ?></td>
		<td align="center"  ><?php echo number_format($yft2); ?></td>
		<td align="center"  ><?php echo number_format($yft3); ?></td>
		<td align="center"  ><?php echo number_format($bet1); ?></td>
		<td align="center"  ><?php echo number_format($bet2); ?></td>
		<td align="center"  ><?php echo number_format($bet3); ?></td>
		<td align="center"  ><?php echo number_format($alb1); ?></td>
		<td align="center"  ><?php echo number_format($alb2); ?></td>
		<td align="center"  ><?php echo number_format($alb3); ?></td>
	</tr>
<?php
}
$t1=0; $t2=0; $t3=0; $t4=0; $t5=0; $t6=0;
if ($jk2!=0)
{
   $t1=$k2/$jk2;
} 
if ($jk4!=0)
{
   $t2=$k4/$jk4;
} 
if ($jk6!=0)
{
   $t3=$k6/$jk6;
} 
if ($jb2!=0)
{
   $t4=$b2/$jb2;
} 
if ($jb5!=0)
{
   $t5=$b5/$jb5;
}
if ($jb6!=0)
{
   $t6=$b8/$jb6;
} 
?>

	<tr>
		<td bgcolor="#CCCCFF" align="center" colspan="2"><b><?php echo number_format($mt1); ?></b></td>
		<td bgcolor="#CCCCFF" align="center" >
		<p align="center"><b><?php echo number_format($mt3); ?></b></td>
		
	
		<td bgcolor="#CCCCFF" align="center" >
		<p align="center"><b><?php echo number_format($mt4); ?></b></td>
	
		
		
		<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($total_berat_yft); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($total_berat_bet); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($total_berat_sjk); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($b1); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($t4); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($b3); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($b4); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($t5); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"  ><b><?php echo number_format($b6); ?></b></td>
		
			<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($b7); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($t6); ?></b></td>
		<td bgcolor="#CCCCFF" align="center"><b><?php echo number_format($b9); ?></b></td>
	</tr>

</table>

<p><font size="1"><?php echo $cat; ?></font></p>
</div>


































        	</div>
    </div>

  </div>