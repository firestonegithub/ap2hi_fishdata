
<!-- http://www.vesna.ru/php5/examples/ -->


<?php 

foreach($dataVessel->result() as $row){


	$img = str_replace(".", "_", $row->no_ap2hi); 
?>


<table class="items"  style="margin-top: 10px;margin-bottom: 10px;" width="50%" cellpadding="8" border="1">

	<tr>
		<td colspan="4" >
			<center><img src="<?php echo base_url();?>media/backend/ap2hi_images_logo.png" height="100" weight="100" ></center>
		</td>
	</tr>

	<tr>
		<td align="center"> Vessel Name  </td>
		<td align="center">:</td>
		<td align="center"><?php echo $row->nama_kapal; ?></td>
		<td rowspan="2" >
					<center><img src="<?php echo base_url().'uploads/qr/'.$img ; ?>.png" height="100" weight="100" ></center>
				</td>
	</tr>

	<tr>
		<td align="center">Vessel Number</td>
		<td align="center">:</td>
		<td align="center"><?php echo $row->no_ap2hi ; ?></td>
	</tr>


	<tr style="height: 20px;">
		<td  colspan ="2" >
			<center> http://ifish.ap2hi.org/v2 </center>
		</td>

		<td colspan ="2" >
			<center>http://ap2hi.org </center>
		</td>

	</tr>

</table>


<?php 
}
?>


<!--
<style>
body {font-family: sans-serif;
 font-size: 9pt;
 background: repeat-y scroll left top;
}
h5, p { margin: 0pt;
}
table.items {
 font-size: 9pt;
 border-collapse: collapse;
 border: 3px solid #880000;
}
td { vertical-align: top;
}
table thead td { background-color: #EEEEEE;
 text-align: center;
}
table tfoot td { background-color: #AAFFEE;
 text-align: center;
}
.barcode {
 padding: 1.5mm;
 margin: 0;
 vertical-align: top;
 color: #000000;
}
.barcodecell {
 text-align: center;
 vertical-align: middle;
 padding: 0;
}
</style> -->