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



   $jud1='Bagian 1. Informasi Umum'; 
   $jud2='Bagian 2. Informasi Kapal Kecil : Bongkar Ke Kapal Utama'; $jud2_1='Nama Kapal / Nama Kapten';
   $jud3='Bagian 3. Informasi Umpan'; $jud3_1='Kategori'; $jud3_2='Total Umpan (Kg)'; $jud3_3='Estimasi Umpan (Kg)'; $jud3_4='Domestik /Import ? '; $jud3_5 = 'Pengadaan Umpan (Beli / Menangkap Sendiri)'; $jud3_6 = 'Berapa Ember';
   $jud4='Bagian 4 : Jenis hasil tangkapan lain (Perkiraan total hasil tangkap)'; $jud4_1='Jumlah Ikan (ekor)'; $jud4_2='Estimasi ?';
   $jud5='Bagian 5. Ringkasan  Per Kategori  Tangkapan utama (Tidak termasuk ikan ukuran besar)'; $jud5_1='Kode'; $jud5_2='Deskripsi'; $jud5_3='Total Berat (Kg.)';
   $jud6='Bagian 6. Random Sampling Panjang Tangkapan Utama (Tidak Termasuk Tuna Ukuran Besar)'; $jud6_1='Kapal/Keranjang'; $jud6_2='No.'; $jud6_3='Kode'; $jud6_4='Berat (Kg)'; $jud6_5='Jumlah'; $jud6_6='Panjang Rata-Rata (Cm)';
   $jud7='Bagian 7. Ringkasan  Per Kategori  Tangkapan utama (Tuna ukuran besar )'; $jud7_1='Kode'; $jud7_2='Deskripsi';  $jud7_3= 'Total Berat (Kg)';
   $jud8='Bagian 8. Tuna Ukuran Besar'; $jud8_1='Kapal/No.'; $jud8_2='Spesies'; $jud8_3='Kode'; $jud8_4='Berat (Kg)'; $jud8_5='Panjang (Cm)';  $jud8_6 = 'Insang'; $jud8_7 = 'Isi Perut'; $jud8_8 = 'Daging Perut';
   $jud8_a1='Utuh'; $jud8_a2='Loin 1'; $jud8_a3='Loin 2'; $jud8_a4='Loin 3'; $jud8_a5='Loin 4'; $jud8_a6='Karkas'; $jud8_a7 = 'Termasuk berat'; $jud8_a8 = 'Loin (Atas)';
   $a1='Lokasi Pendaratan'; $a2='Nama Perusahaan'; $a3='Enumerator 1'; $a4='Enumerator 2';
   $b1='Nama Kapal'; $b2='Nama Kapten'; $b3='Daerah Penangkapan'; $b4='Total Penangkapan (Kg)'; $b5='Estimasi Ikan Hilang (Kg)';
   $c1='Tgl. Sampling'; $c2='Jam Sampling'; $c3='Lama Trip'; $c4='Penggunaan BBM (Liter)';
   $d1='Kap. Kapal (GT)'; $d2='Pjg. Kapal (m)'; $d3='Kapasitas Mesin (PK)'; $d4='Alat Tangkap'; $d5='Penggunaan Es (Kg)'; $d6='Jumlah hari memancing ';
    $e1='Jenis Kait'; $e2='Teknik Tuna'; $e3='Jumlah Awak'; $e4='Bahan Vesel'; $e5='Rumpon'; $e6='Alat Tangkap Troll ?'; $e7='Alat Lain'; $e8='Jumlah Penggunaan Pancing'; $e9='Kapasitas Ember'; 
  $e10='no_sipi';$e11='jumlah_rumpon_singgah';$e12='tanggal_berangkat';$e13='tanggal_kembali';$e14='jumlah_pakura';$e15='deskripsi_foto';$e16='ukuran_pancing'; $e17='Kapasitas Ember Umpan'; $e18='Jumlah Joran';

$mnamafile = $namafile;
$query = "SELECT * from tps_pendaratan p,master_landing t, tab_alattangkap a where namafile='".$mnamafile."' and t.id_landing=p.k_landing and a.k_alattangkap=p.k_alattangkap";
$result = $this->db->query($query)->result(); 
foreach ($result as $record) {
  $mtgl=$record->tgl_sampling;
  $mbulan=$record->bln_sampling;
  $mtahun=$record->thn_sampling;
  $tipe=$record->tipe;

  if ($mbulan<10) {
     $mbulan='0'.$mbulan;
  }

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
  

$path = base_url()."/data/mainpage/";

?>
<?php 
if($tipe == 'HL'){
  echo '<b>DATA HANDLINE</b>';
}elseif($tipe=='PL'){
  echo '<b>DATA POLE & LINE </b>';
}
?>
<div class="overflow-style">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-responsive table-style">
  <colgroup>
    <col width="31" style="width: 23pt">
    <col width="105" span="6" style="width: 79pt">
    <col width="133" style="width: 100pt">
    <col width="129" style="width: 97pt">
  </colgroup>
  <tr height="30" style="height:15.75pt">
    <td colspan="9" height="21" style="height: 15.75pt; width: 948px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo $jud1; ?> </td>
  </tr>
  <tr height="30" style="height: 15.75pt">
    <td colspan="3" height="21" width="241" style="height: 15.75pt; width: 181pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $a1; ?>&nbsp;</td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $a2; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; vertical-align: middle; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $a3; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; vertical-align: middle; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $a4; ?></td>
  </tr>
<?php 

  $isi1=$record->nama_landing;
  //$isi2=$record->k_perusahaan;
  $isi3=$record->enumerator1;
  $isi4=$record->enumerator2;
  $isi5=$record->nama_kapal;
  $isi6=$record->kapten_kapal;
  $isi7=$record->grid1."-".$record->grid2;


      $query = "SELECT * from master_supplier where id_supplier ='".$record->k_perusahaan."'";
      $result = $this->db->query($query)->row_array();
      $isi2 = $result['nama_perusahaan'] ; 
      

?>  
  
  
  <tr height="30" style="height: 15.0pt">
    <td colspan="3" style="height: 23px; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border: .5pt solid windowtext; padding: 0px">
    <?php echo $isi1; ?>
    </td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <?php echo $isi2; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <?php echo $isi3; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <?php echo $isi4; ?></td>
  </tr>
  <tr height="30" style="height: 30.75pt">
    <td colspan="3" style="height: 25px; font-size: 12.0pt; text-align: center; vertical-align: middle; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $b1; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; vertical-align: middle; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $b2; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; vertical-align: middle; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $b3; ?></td>
    <td width="133" style="width: 100pt; font-size: 12.0pt; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24" align="center">
    <p align="center"><?php echo $b4; ?></td>
    <td style="width: 147px; font-size: 12.0pt; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24" align="center">
    <p align="center"><?php echo $b5; ?></td>
  </tr>
  <tr height="30" style="height:18.75pt">
    <td colspan="3" style="height: 23px; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $isi5; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <?php echo $isi6; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" colspan="2" height="22">
    <?php echo $isi7;echo '<br>'; ?>
    <?php 
      
          echo $record->grid;
          echo '<br>';
        
    ?>
    </td>
    <td align="center" style="font-size: 14.0pt; font-weight: 700; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; height:22px">
    <p align="center"><?php $find = strpos($record->total_penangkapan , '.'); if($find == false){ echo number_format($record->total_penangkapan); } else{ echo number_format($record->total_penangkapan,2); }    ?></td>
    <td align="center" style="font-size: 14.0pt; font-weight: 700; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="147" height="22">
    <p align="center"><?php $find = strpos($record->est_ikanhilang , '.'); if($find == false){ echo number_format($record->est_ikanhilang); } else{ echo number_format($record->est_ikanhilang,2); } ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="3" width="241" style="height: 27px; width: 181pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $c1; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="27">
    <?php echo $c2; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="27">
    <?php echo $c3; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="27">
    <?php echo $c4; ?></td>
  </tr>
  <tr height="30" style="height:18.75pt">
    <td align="center" style="height: 21px; font-size: 14.0pt; font-weight: 700; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" colspan="3">
    <p align="center"><?php echo $xtahun; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="22">
    <?php echo $mwaktu; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="22">
    <?php 
     if ($record->lama_satuan=='hari') : $des=number_format($record->lama_hari).' hari';
     else : $des=number_format($record->lama_jam).' jam';
     endif;
     echo $des; ?>
     </td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="22">
    <?php echo  number_format($record->bbm); ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 25px; width: 102pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $d1; ?></td>
    <td width="105" style="width: 79pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24">
    <?php echo $d2; ?></td>
    <td width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $d3; ?></td>
    <td width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $d6; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $d4; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $d5; ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 24px; width: 102pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px">
    <?php echo  $record->gt_kapal; //echo  number_format($record->gt); ?></td>
    <td align="center" width="105" style="width: 79pt; font-size: 14.0pt; font-weight: 700; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <p align="center"><?php $find = strpos($record->panjang_kapal , '.'); if($find == false){ echo number_format($record->panjang_kapal); } else{ echo number_format($record->panjang_kapal,2); }  ?></td>
    <td width="210" style="width: 158pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php $find = strpos($record->mesin_kapal , '.'); if($find == false){ echo number_format($record->mesin_kapal); } else{ echo number_format($record->mesin_kapal,2); }  ?></td>
    <td width="210" style="width: 158pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php if($record->jumlah_hari_memancing != '' && $record->jumlah_hari_memancing != '0' ) { $find = strpos($record->jumlah_hari_memancing , '.'); if($find == false){ echo number_format($record->jumlah_hari_memancing); } else{ echo number_format($record->jumlah_hari_memancing,2); } }  ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->english; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  number_format($record->es); ?></td>
  </tr>
  <?php if($tipe == 'HL') { ?>
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 25px; width: 102pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $e1; ?></td>
    <td width="105" style="width: 79pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24">
    <?php echo $e2; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e3; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e4; ?></td>
    <td colspan="2" style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e5; ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 24px; width: 102pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px">
    <?php echo $record->hl_tipe_mata_pancing; ?></td>
    <td align="center" width="105" style="width: 79pt; font-size: 14.0pt; font-weight: 700; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <p align="center"><?php echo  $record->teknik_cari_tuna; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->jum_awak; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->bahan_kapal; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->rumpon; ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="5" width="136" style="height: 25px; width: 102pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $e6; ?></td>
    <td colspan="5" width="105" style="width: 79pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24">
    <?php echo $e7; ?></td>
  </tr>
  <tr height="30" style="height: 17.25pt">
    <td colspan="5" width="136" style="height: 24px; width: 102pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px">
    <?php echo $record->hl_troll; ?></td>
    <td colspan="5" align="center" width="105" style="width: 79pt; font-size: 14.0pt; font-weight: 700; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <p align="center"><?php echo  $record->hl_alat_tangkap_lain; ?></td>
  </tr>
  
  <?php } elseif($tipe == 'PL') { ?>
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 25px; width: 102pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $e18; ?></td>
    <td width="105" style="width: 79pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24">
    <?php echo $e2; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e3; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e4; ?></td>
    <td  style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e5; ?></td>
    <td  style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e9; ?></td>
  </tr>
  
  <tr height="30" style="height: 17.25pt">
    <td colspan="2" width="136" style="height: 24px; width: 102pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px">
    <?php echo $record->pl_jum_pancing; ?></td>
    <td align="center" width="105" style="width: 79pt; font-size: 14.0pt; font-weight: 700; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <p align="center"><?php echo  $record->teknik_cari_tuna; ?></td>
    <td colspan="2" width="210" style="width: 158pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->jum_awak; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->bahan_kapal; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->rumpon; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo $record->pl_kapasitas_ember; ?></td>
  </tr>
  
  <?php } ?>
  
  
<tr height="30" style="height: 17.25pt">
    <td colspan="4" width="136" style="height: 25px; width: 102pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $e10; ?></td>
    <td width="105" style="width: 79pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="24">
    <?php echo $e11; ?></td>
    <td  width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e12; ?></td>
    <td  width="210" style="width: 158pt; font-size: 12.0pt; text-align: center; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e13; ?></td>
    <td  style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php if($tipe == 'PL'){echo $e17;} ?>
    <?php if($tipe == 'HL'){echo $e14;} ?></td>
    <td  style="font-size: 12.0pt; text-align: center; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" height="25">
    <?php echo $e16; ?></td>
  </tr>
  
   <tr height="30" style="height: 17.25pt">
    <td colspan="4" width="136" style="height: 24px; width: 102pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border: .5pt solid windowtext; padding: 0px">
    <?php echo $record->no_sipi; ?></td>
    <td align="center" width="105" style="width: 79pt; font-size: 14.0pt; font-weight: 700; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" height="23">
    <p align="center"><?php echo  $record->jumlah_rumpon_singgah; ?></td>
    <td  width="210" style="width: 158pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->tanggal_berangkat; ?></td>
    <td  style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->tanggal_kembali; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo  $record->jumlah_pakura; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px" height="24">
    <?php echo $record->ukuran_pancing; ?></td>
  </tr>
  
</table>
<?php
}
?>
<br>


<!-- Form Trip End -->




<!-- Kapal Kecil -->


<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="34" style="width: 26pt">
    <col width="295" style="width: 221pt">
    <col width="99" style="width: 74pt"><col width="95" style="width: 71pt">
    <col width="81" style="width: 61pt">
    <col width="102" style="width: 77pt">
    <col width="96" style="width: 72pt">
  </colgroup>
  <tr height="21" style="height:15.75pt">
    <td colspan="7" height="21" width="802" style="height: 15.75pt; width: 602pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo $jud2;?></td>
  </tr>
  <tr height="69" style="height: 51.75pt">
    <td height="69" style="height: 51.75pt; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3">No.</font></td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $jud2_1;?></font></td>
    <td width="99" style="width: 74pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $b4;?></font></td>
    <td width="95" style="width: 71pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $b5;?></font></td>
    <td width="81" style="width: 61pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $c3;?></font></td>
    <td width="102" style="width: 77pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $c4;?></font></td>
    <td width="96" style="width: 72pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <font size="3"><?php echo $d3;?></font></td>
  </tr>
<?php
$query="select * from tps_kapalkecil where namafile='".$mnamafile."' order by namafile,no_urut";
$res1 = $this->db->query($query)->result();
foreach ($res1 as $rec1) 
{
?>
  <tr height="25" style="height:18.75pt">
    <td height="25" style="height: 18.75pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->no_urut; ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->nama; ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php $find = strpos($rec1->total_penangkapan , '.'); if($find == false){ echo number_format($rec1->total_penangkapan); } else{ echo number_format($rec1->total_penangkapan,2); }  ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo number_format($rec1->est_ikanhilang); ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php 
     if ($rec1->lama_satuan=='H') : $des=number_format($rec1->lama).' hari';
     else : $des=number_format($rec1->lama).' jam';
     endif;
     echo $des; ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo number_format($rec1->bbm); ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: medium none; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo number_format($rec1->mesin); ?>&nbsp;</td>
  </tr>
<?php 
}
?>  
  
</table>

<p style="margin-top: 0; margin-bottom: 0">

&nbsp;</p>

<!-- End Kapal Kecil -->




<!-- Umpan -->



<?php if($tipe == 'HL'){ ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
      <colgroup>
        <col width="64" style="width:48pt">
        <col width="303" style="width: 227pt">
        <col width="110" style="width: 83pt">
        <col width="67" span="2" style="width: 50pt">
        <col width="171" style="width: 128pt">
        <col width="171" style="width: 128pt">
      </colgroup>
      <tr height="21" style="height:15.75pt">
        <td colspan="8" height="21" width="782" style="height: 15.75pt; width: 586pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #8DB4E2">
        <?php echo $jud3; ?></td>
      </tr>
      <tr height="63" style="height:47.25pt">
        <td height="63" width="64" style="height: 47.25pt; width: 48pt; font-size: 12.0pt; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_1; ?></td>
        <td width="303" style="width: 227pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        Species</td>
        <td width="110" style="width: 83pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $b3; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_2; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_3; ?></td>
        <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $d4; ?></td>
        <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_4; ?></td>
         <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; 
         padding-right: 1px; padding-top: 1px; background: #D9D9D9">
         Estimasi Umpan (Ekor)
        </td>
      </tr>
    <?php
    $query="select * from tps_umpan where namafile='".$mnamafile."' order by namafile,k_umpan";
    $res1 = $this->db->query($query)->result();
    foreach ($res1 as $rec1) 
    {
    ?>
      <tr height="25" style="height:18.75pt">
        <td height="25" style="height: 18.75pt; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->k_umpan; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->species; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->rumpon1.'-'.$rec1->rumpon2; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php $find = strpos($rec1->total , '.'); if($find == false){ echo number_format($rec1->total); } else{ echo number_format($rec1->total,2); } ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php $find = strpos($rec1->estimasi , '.'); if($find == false){ echo number_format($rec1->estimasi); } else{ echo number_format($rec1->estimasi,2); } ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->k_alattangkap; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->domestic_import; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->hl_estimasi_ekor_umpan; ?>&nbsp;</td>
      </tr>
    <?php
    } 
    ?>  
    </table>

<?php }elseif($tipe == 'PL'){ ?>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
      <colgroup>
        <col width="64" style="width:48pt">
        <col width="303" style="width: 227pt">
        <col width="110" style="width: 83pt">
        <col width="67" span="2" style="width: 50pt">
        <col width="171" style="width: 128pt">
        <col width="171" style="width: 128pt">
        <col width="171" style="width: 128pt">
      </colgroup>
      <tr height="21" style="height:15.75pt">
        <td colspan="10" height="21" width="782" style="height: 15.75pt; width: 586pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #8DB4E2">
        <?php echo $jud3; ?></td>
      </tr>
      <tr height="63" style="height:47.25pt">
        <td height="63" width="64" style="height: 47.25pt; width: 48pt; font-size: 12.0pt; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_1; ?></td>
        <td width="303" style="width: 227pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        Species</td>
        <td width="110" style="width: 83pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $b3; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_5; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_6; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_2; ?></td>
        <td width="67" style="width: 50pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_3; ?></td>
        <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $d4; ?></td>
        <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        <?php echo $jud3_4; ?></td>
         <td width="171" style="width: 128pt; font-size: 12.0pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
        Jumlah Ember</td>
      </tr>
    <?php
    $query="select * from tps_umpan where namafile='".$mnamafile."' order by namafile,k_umpan";
    $res1 = $this->db->query($query)->result();
    foreach ($res1 as $rec1) 
    {
    ?>
      <tr height="25" style="height:18.75pt">
        <td height="25" style="height: 18.75pt; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->k_umpan; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->species; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->rumpon1.'-'.$rec1->rumpon2; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->pl_pengadaan_umpan; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->pl_jum_ember; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php $find = strpos($rec1->total , '.'); if($find == false){ echo number_format($rec1->total); } else{ echo number_format($rec1->total,2); } ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php $find = strpos($rec1->estimasi , '.'); if($find == false){ echo number_format($rec1->estimasi); } else{ echo number_format($rec1->estimasi,2); } ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->k_alattangkap; ?>&nbsp;</td>
        <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->domestic_import; ?>&nbsp;</td>
         <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
        <?php echo $rec1->pl_jum_ember; ?>&nbsp;</td>
      </tr>
    <?php
    } 
    ?>  
    </table>

<?php }?>
<p style="margin-top: 0; margin-bottom: 0">

&nbsp;</p>





<!-- End Umpan -->



<!-- Bycatch -->


<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="40" style="width: 30pt">
    <col width="317" style="width: 238pt">
    <col width="138" style="width: 104pt">
    <col width="146" style="width: 110pt">
    <col width="148" style="width: 111pt">
  </colgroup>
  <tr height="21" style="height: 15.75pt">
    <td colspan="6" height="21" width="789" style="height: 15.75pt; width: 593pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #8DB4E2">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $jud4; ?>   
    </td>
  </tr>
  <tr height="32" style="height: 24.0pt">
    <td height="32" style="height: 24.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0">No.</td>
    <td style="font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0">Species</td>
    <td style="font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $jud4_1; ?></td>
    <td style="font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $jud8_4; ?></td>
    <td style="font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $jud4_2; ?></td>
      <td style="font-weight: 700; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px; background: #D9D9D9">
    <p style="margin-top: 0; margin-bottom: 0">Kode Panjang</td>
  </tr>
<?php
$query="select * from tps_bycatch left outer join master_fishcode on master_fishcode.fishcode=tps_bycatch.k_species where namafile='".$mnamafile."' order by namafile,tps_bycatch.k_species";
$res1 = $this->db->query($query)->result();
$i=0;
foreach ($res1 as $rec1) 
{
  $i=$i+1;
?>
  <tr height="24" style="height: 18.0pt">
    <td height="24" style="height: 18.0pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $i; ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $rec1->species_name; ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo number_format($rec1->jumlah); ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php $find = strpos($rec1->berat , '.'); if($find == false){ echo number_format($rec1->berat); } else{ echo number_format($rec1->berat,2); }  ?>&nbsp;</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $rec1->estimasi; ?>&nbsp;</td>
     <td style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
    <p style="margin-top: 0; margin-bottom: 0"><?php echo $rec1->kode_panjang; ?>&nbsp;</td>
    
  </tr>
<?php
} 
?>  
  
</table>
<p style="margin-top: 0; margin-bottom: 0">
&nbsp;</p>



<!-- End Bycatch -->




<!-- Ringkasan Ikan Kecil -->



<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="31" style="width: 23pt">
    <col width="105" span="2" style="width: 79pt">
  </colgroup>

  <tr height="24" style="height: 18.0pt">
    <td colspan="3" height="24" style="height: 18.0pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: 1px solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo  $jud5; ?></td>
  </tr>
  <tr height="24" style="height: 18.0pt">
    <td height="24" width="136" style="border:1px solid windowtext; height: 18.0pt; width: 102pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; padding: 0px; background: #D9D9D9; ">
    <?php echo  $jud5_1; ?></td>
    <td width="315" style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo  $jud5_2; ?></td>
    <td width="210" style="border-bottom:1px solid windowtext; width: 158pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo  $jud5_3; ?></td>
  </tr>
<?php
$query="select * from tps_ringkasan_ikankecil where namafile='".$mnamafile."' order by namafile,kode";
$res1 = $this->db->query($query)->result();
foreach ($res1 as $rec1) {
?>
    <tr height='24' style='height: 18.0pt'>
    <td style="border-top:1px solid windowtext; height: 25px; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; ">
    <?php echo $rec1->kode; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->deskripsi; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php $find = strpos($rec1->berat , '.'); if($find == false){ echo number_format($rec1->berat); } else{ echo number_format($rec1->berat,2); }  ?></td>
      </tr>
<?php 
}
?>  
</table><br>

<!-- End Ringkasan Ikan Kecil -->


<!-- Ikan Kecil   -->


<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="31" style="width: 23pt">
    <col width="105" span="5" style="width: 79pt">
    <col width="133" style="width: 100pt">
    <col width="133" style="width: 100pt">
    <col width="129" style="width: 97pt">
  </colgroup>

  <tr height="23" style="height: 17.25pt">
    <td colspan="9" height="23" style="height: 17.25pt; font-size: 12.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo $jud6; ?></td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td colspan="3" height="26" style="height: 19.5pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_1; ?></td>
    <td style="font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" colspan="2">
    YFT</td>
    <td style="font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" colspan="2">
    BET</td>
    <td style="font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9" colspan="2">
    <p align="center">SKJ</td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td height="26" style="height: 19.5pt; width: 75px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_2; ?></td>
    <td style="width: 96px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_3; ?></td>
    <td style="width: 98px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_4; ?></td>
    <td style="width: 77px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_5; ?></td>
    <td style="width: 161px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_6; ?></td>
    <td style="width: 71px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_5; ?></td>
    <td style="width: 147px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_6; ?></td>
    <td style="width: 69px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_5; ?></td>
    <td style="width: 143px; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #D9D9D9">
    <?php echo $jud6_6; ?></td>
  </tr>

<?php
$query="select i.k_kapalkecil,i.nomor,kode,berat,k_species,count(k_species) as jml,avg(panjang) as pjg from tps_keranjang k,tps_ikankecil i where k.namafile='".$mnamafile."' and i.namafile=k.namafile and i.k_kapalkecil=k.k_kapalkecil and i.nomor=k.nomor";
$query=$query." group by i.k_kapalkecil,i.nomor,kode,berat,k_species order by i.k_kapalkecil,i.nomor";
$res1 = $this->db->query($query)->result();
$sw=0; 
foreach ($res1 as $rec1) {
  if ($sw==0) {
    $sw=1;
    $temp=$rec1->nomor;
    $temp1=$rec1->k_kapalkecil;
    $mkode=$rec1->kode;
    $mberat=$rec1->berat;
    $yft1=0; $yft2=0; $bet1=0; $bet2=0; $sjk1=0; $sjk2=0; 
  }
  elseif (($temp!=$rec1->nomor) or ($temp1!=$rec1->k_kapalkecil)) {
    $link=$path."/detailikankecil/";
    $link=$link."".$mnamafile; //namafile
    $link=$link."/".$temp; //nomor
    $link=$link."/".$temp1; //k_kapalkecil
    $link=$link."/".$mkode; //kode
    $link=$link."/".$mberat; //berat
?>
  <tr height="31" style="height: 23.25pt">
    <td height="31" style="height: 23.25pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px" width="75">
    <font size="4"><a href="<?php echo $link;  ?>"><?php echo number_format($temp1).'/'.number_format($temp); ?></a></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="96">
    <font size="4"><?php echo $mkode; ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="98">
    <font size="4"><?php  $find = strpos($mberat , '.'); if($find == false){ echo number_format($mberat); } else{ echo number_format($mberat,2); }   ?></font></td>
    <td align="center" style="font-size: 14.0pt; font-weight: 700; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="77">
    <font size="4"><?php echo number_format($yft1); ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="161">
    <font size="4"><?php echo number_format(floor($yft2)); ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="71">
    <font size="4"><?php echo number_format($bet1); ?></font></td>
    <td style="background-position: 0% 0%; width: 147px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format(floor($bet2)); ?></font></td>
    <td style="background-position: 0% 0%; width: 69px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format($sjk1); ?></font></td>
    <td style="background-position: 0% 0%; width: 143px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format(floor($sjk2)); ?></font></td>
  </tr>
<?php  
    $temp=$rec1->nomor;
    $temp1=$rec1->k_kapalkecil;
    $mkode=$rec1->kode;
    $mberat=$rec1->berat;
    $yft1=0; $yft2=0; $bet1=0; $bet2=0; $sjk1=0; $sjk2=0; 
  }    
  if ($rec1->k_species == "YFT") {
    $yft1=$rec1->jml;
    $yft2=$rec1->pjg;
  }
  else if ($rec1->k_species == "BET") {
    $bet1=$rec1->jml;
    $bet2=$rec1->pjg;
  }
  else {
    $sjk1=$rec1->jml;
    $sjk2=$rec1->pjg;
  }
}
if ($sw!=0) {
        $link=$path."/detailikankecil/";
    $link=$link."".$mnamafile; //namafile
    $link=$link."/".$temp; //nomor
    $link=$link."/".$temp1; //k_kapalkecil
    $link=$link."/".$mkode; //kode
    $link=$link."/".$mberat; //berat
?>
  <tr height="31" style="height: 23.25pt">
    <td height="31" style="height: 23.25pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px" width="75">
    <font size="4"><a href="<?php echo $link;  ?>"><?php echo number_format($temp1).'/'.number_format($temp); ?></a></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="96">
    <font size="4"><?php echo $mkode; ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="98">
    <font size="4"><?php  $find = strpos($mberat , '.'); if($find == false){ echo number_format($mberat); } else{ echo number_format($mberat,2); }   ?></font></td>
    <td align="center" style="font-size: 14.0pt; font-weight: 700; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: middle; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="77">
    <font size="4"><?php echo number_format($yft1); ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="161">
    <font size="4"><?php echo number_format(floor($yft2)); ?></font></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px" width="71">
    <font size="4"><?php echo number_format($bet1); ?></font></td>
    <td style="background-position: 0% 0%; width: 147px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format(floor($bet2)); ?></font></td>
    <td style="background-position: 0% 0%; width: 69px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format($sjk1); ?></font></td>
    <td style="background-position: 0% 0%; width: 143px; font-size: 12.0pt; font-weight: 700; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background-image:none; background-repeat:repeat; background-attachment:scroll" align="center">
    <font size="4"><?php echo number_format(floor($sjk2)); ?></font></td>
  </tr>
<?php 
}
?>
</table><br>


<!--End Ikan Kecil  -->



<!-- Ringkasan IKAN Besaar --> 



<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="31" style="width: 23pt">
    <col width="105" span="2" style="width: 79pt">
  </colgroup>
  

  <tr height="24" style="height: 18.0pt">
    <td colspan="3" height="24" style="height: 18.0pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: 1px solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo $jud7; ?></td>
  </tr>


  <tr height="24" style="height: 18.0pt">
    <td height="24" width="136" style="border:1px solid windowtext; height: 18.0pt; width: 102pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; padding: 0px; background: #D9D9D9; ">
    <?php echo $jud7_1; ?></td>
    <td width="315" style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud7_2; ?></td>
    <td width="315" style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud7_3; ?></td>
  </tr>



<?php
$query="select * from tps_ringkasan_ikanbesar where namafile='".$mnamafile."' order by namafile,kode";
$res1 = $this->db->query($query)->result();
foreach ($res1 as $rec1) {
?>
    <tr height='24' style='height: 18.0pt'>
    <td style="border-top:1px solid windowtext; height: 25px; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; ">
    <?php echo $rec1->kode; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->deskripsi; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php  $find = strpos($rec1->berat , '.'); if($find == false){ echo number_format($rec1->berat); } else{ echo number_format($rec1->berat,2); }  ?></td>
      </tr>
<?php 
}
?>  
</table><br>


<!--End Ringkasan Ikan Besar -->




<!-- Ikan Besar -->




<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="31" style="width: 23pt">
    <col width="31" style="width: 23pt">
    <col width="105" span="2" style="width: 79pt">
  </colgroup>

  <tr height="24" style="height: 18.0pt">
    <td colspan="11" height="24" style="height: 18.0pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: 1px solid windowtext; padding: 0px; background: #8DB4E2">
    <?php echo $jud8; ?></td>
  </tr>
  <tr height="24" style="height: 18.0pt">
    <td style="border:1px solid windowtext; width: 102pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; padding: 0px; background: #D9D9D9" rowspan="2">
    <?php echo $jud8_1; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit" rowspan="2">
    <?php echo $jud8_2; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit" rowspan="2">
    <?php echo $jud8_3; ?></td>
    <td style="border-bottom:1px solid windowtext; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit" colspan="2">
    <?php echo $jud8_a1; ?></td>
    <td style="border-bottom:1px solid windowtext; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit" colspan="2">
    <?php echo $jud8_a8; ?></td>
    <td style="border-bottom:1px solid windowtext; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit" colspan="3">
    <?php echo $jud8_a7; ?></td>
    <td style="border:1px solid windowtext; width: 102pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; padding: 0px; background: #D9D9D9" rowspan="2">
    Kode Panjang</td>
  </tr>
  <tr height="24" style="height: 18.0pt">
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_4; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 158pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_5; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_4; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 158pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_5; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_6; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 158pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_7; ?></td>
    <td style="border-bottom:1px solid windowtext; width: 237pt; font-size: 12.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: 1px solid; border-right: 1px solid black; padding: 0px; background: #D9D9D9; border-top-color:inherit">
    <?php echo $jud8_8; ?></td>

  </tr>
<?php
$query="select * from tps_ikanbesar where namafile='".$mnamafile."' order by namafile,no_ikan";
$res1 = $this->db->query($query)->result();
foreach ($res1 as $rec1) {
?>
    <tr height='24' style='height: 18.0pt'>
    <td style="border-top:1px solid windowtext; height: 25px; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; ">
    <?php echo number_format($rec1->k_kapalkecil).'/'.number_format($rec1->no_ikan); ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->k_species; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->kode; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php  $find = strpos($rec1->berat , '.'); if($find == false){ echo number_format($rec1->berat); } else{ echo number_format($rec1->berat,2); }  ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo number_format($rec1->panjang); ?></td>

    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php  $find = strpos($rec1->loin1_berat , '.'); if($find == false){ echo number_format($rec1->loin1_berat); } else{ echo number_format($rec1->loin1_berat,2); }  ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo number_format($rec1->loin1_panjang); ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->insang; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->isi_perut; ?></td>
    <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->daging_perut; ?></td>
     <td style="border-top:1px solid windowtext; font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: middle; white-space: nowrap; border-left: 1px solid; border-right: 1px solid black; border-bottom: 1px solid windowtext; padding: 0px; " height="25">
    <?php echo $rec1->kode_panjang; ?></td>
      </tr>
<?php 
}
?>  
</table><br>

<!-- End Ikan Besar -->


<!-- Catatan -->

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <tr>
    <td>Catatan : <p></p>
<?php 
   echo $record->deskripsi; 
?>
<!--End Catatan -->


<!-- ETP--> 




<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table-style">
  <colgroup>
    <col width="51" style="width: 38pt"><col width="64" style="width: 48pt">
    <col width="63" style="width: 47pt"><col width="91" style="width: 68pt">
    <col width="94" style="width: 71pt"><col width="74" style="width: 56pt">
    <col width="47" style="width: 35pt"><col width="86" style="width: 65pt">
    <col width="81" style="width: 61pt">
    <col width="65" span="5" style="width: 49pt">
    <col width="64" span="3" style="width:48pt">
    <col width="63" style="width: 47pt"><col width="64" style="width:48pt">
  </colgroup>
  <tr height="31" style="height: 23.25pt">
    <td colspan="19" height="31" width="1295" style="height: 23.25pt; width: 973pt; font-size: 12.0pt; font-weight: 700; text-align: left; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #8DB4E2">
    Bagian 10. Spesies Genting, Terancam Punah and Dilindungi</td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td colspan="2" height="26" style="height: 19.5pt; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Pewawancara</td>
    <td colspan="3" style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_pewawancara; ?></td>
    <td colspan="14" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    &nbsp;</td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td colspan="2" height="26" style="height: 19.5pt; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Umur</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_umur; ?></td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    tahun</td>
    <td colspan="15" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    &nbsp;</td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td colspan="3" height="26" style="height: 19.5pt; text-align: left; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Lama Bekerja</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_lama_tahun; ?></td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    tahun</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_lama_bulan; ?></td>
    <td style="vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    bulan</td>
    <td colspan="12" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    &nbsp;</td>
  </tr>
  <tr height="26" style="height: 19.5pt">
    <td colspan="3" height="26" style="height: 19.5pt; text-align: left; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Jabatan Terakhir</td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_jabatan; ?></td>
    <td colspan="2" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Keterangan</td>
    <td colspan="12" style="font-size: 14.0pt; font-weight: 700; text-align: left; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $record->e_keterangan; ?></td>
  </tr>
  <tr height="41" style="height: 30.75pt">
    <td colspan="3" rowspan="2" height="82" width="178" style="height: 61.5pt; width: 133pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Hewan ETP</td>
    <td rowspan="2" width="91" style="width: 68pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Ada Interaksi</td>
    <td rowspan="2" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    &nbsp;</td>
    <td rowspan="2" width="74" style="width: 56pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Jml / Ekor</td>
    <td rowspan="2" width="47" style="width: 35pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Perki-raan ?</td>
    <td rowspan="2" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    &nbsp;</td>
    <td colspan="5" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Kondisi (Jumlah)</td>
    <td rowspan="2" width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Dibuang (Mati)</td>
    <td rowspan="2" width="64" style="width: 48pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Dimakan</td>
    <td rowspan="2" width="64" style="width: 48pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Dijual</td>
    <td rowspan="2" width="64" style="width: 48pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    Dijadikan Umpan</td>
    <td rowspan="2" width="63" style="width: 47pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Tidak Tahu</td>
    <td rowspan="2" width="64" style="width: 48pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px; background: #95B3D7">
    &nbsp;Kode Species / Seberapa Yakin :</td>
  </tr>
  <tr height="41" style="height: 30.75pt">
    <td height="41" width="81" style="height: 30.75pt; width: 61pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Mati</td>
    <td width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Luka Serius</td>
    <td width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Luka Ringan</td>
    <td width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Tidak Terluka</td>
    <td width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #95B3D7">
    Tidak Tahu</td>
  </tr>
  
<?php
$query="select * from tps_etp where namafile='".$mnamafile."' order by namafile,urut";
$res1 = $this->db->query($query)->result();
foreach ($res1 as $rec1) {
?>  
  
  <tr height="53" style="height: 39.75pt">
    <td colspan="3" rowspan="5" height="176" width="178" style="height: 132.0pt; width: 133pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->k_kelompok; ?></td>
    <td rowspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid black; padding: 0px">
<?php echo $rec1->interaksi; ?>   
    </td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Interaksi</td>
    <td width="74" style="width: 56pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->jml_interaksi; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->est_interaksi; ?></td>
    <td width="86" style="width: 65pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Didaratkan / Dibebaskan</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->d_1; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->d_2; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->d_3; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->d_4; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->d_5; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->dibuang; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->dimakan; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->dijual; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->diumpan; ?></td>
    <td align="right" style="font-size: 14.0pt; font-weight: 700; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <p align="center"><?php echo $rec1->tidak_tahu; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->k_species; ?></td>
  </tr>
  <tr height="46" style="height: 34.5pt">
    <td height="46" style="height: 34.5pt; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Didaratkan</td>
    <td width="74" style="width: 56pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->jml_didaratkan; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->est_didaratkan; ?></td>
    <td width="86" style="width: 65pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Tidak Didaratkan</td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->td_1; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->td_2; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->td_3; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->td_4; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->td_5; ?></td>
    <td width="65" style="width: 49pt; text-align: center; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Nama Lokal</td>
    <td colspan="2" width="128" style="width: 96pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->namalokal; ?></td>
    <td width="64" style="width: 48pt; text-align: center; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Seberapa Yakin:</td>
    <td width="63" style="width: 47pt; font-size: 14.0pt; font-weight: 700; text-align: center; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->yakin_lokal; ?></td>
    <td width="64" style="width: 48pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->yakin_species; ?></td>
  </tr>
  <tr height="27" style="height: 20.25pt">
    <td colspan="6" height="27" width="473" style="height: 20.25pt; width: 356pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Lokasi Interaksi Terjadi</td>
    <td colspan="4" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Alat Tangkap Khusus</td>
    <td rowspan="2" width="65" style="width: 49pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Tangan Kosong</td>
    <td rowspan="2" width="64" style="width: 48pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: .5pt solid windowtext; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Kapal</td>
    <td colspan="4" rowspan="2" width="255" style="width: 191pt; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Lainnya :</td>
  </tr>
  <tr height="25" style="height:18.75pt">
    <td height="25" style="height: 18.75pt; text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Rumpon</td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Perjalanan</td>
    <td style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    Lainnya :</td>
    <td colspan="3" style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->lokasi_interaksi; ?></td>
    <td colspan="2" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: medium none; padding: 0px; background: #EEECE1">
    Spesies ETP</td>
    <td colspan="2" style="text-align: center; vertical-align: middle; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: medium none; padding: 0px; background: #EEECE1">
    Spesies Lain</td>
  </tr>
  <tr height="25" style="height:18.75pt">
    <td height="25" width="91" style="height: 18.75pt; width: 68pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->r1; ?></td>
    <td width="94" style="width: 71pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->r2; ?></td>
    <td width="74" style="width: 56pt; font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; white-space: normal; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; border-left: medium none; border-right: .5pt solid windowtext; border-top: medium none; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->r3; ?></td>
    <td colspan="3" style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px; background: #EEECE1">
    &nbsp;</td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->alat_etp; ?></td>
    <td colspan="2" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->alat_lain; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->tangan; ?></td>
    <td style="font-size: 14.0pt; font-weight: 700; text-align: center; vertical-align: middle; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; white-space: nowrap; border-left: medium none; border-right: .5pt solid windowtext; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->kapal; ?></td>
    <td colspan="4" style="font-size: 14.0pt; font-weight: 700; text-align: center; color: black; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; vertical-align: bottom; white-space: nowrap; border-left: medium none; border-right: .5pt solid black; border-top: .5pt solid windowtext; border-bottom: .5pt solid windowtext; padding: 0px">
    <?php echo $rec1->lainnya; ?></td>
  </tr>
  <tr height="5" style="height: 3.75pt">
    <td height="5" style="height: 3.75pt; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
    <td style="color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Calibri, sans-serif; text-align: general; vertical-align: bottom; white-space: nowrap; border: medium none; padding: 0px; background: #92D050">
    &nbsp;</td>
  </tr>
<?php 
}
?>  
  
</table>


<!-- End ETP -->


</td>
  </tr>
</table>



          </div>
    </div>

  </div>