
<!-- http://www.vesna.ru/php5/examples/ -->

<?php 

foreach($dataVessel->result() as $row){


	$img = str_replace(".", "_", $row->no_ap2hi); 
?>


<table class="items"  style="float:left;" width="80%"cellpadding="8" border="1">

	<tr>
		<td colspan="4" >
			<center><img src="<?php echo base_url();?>media/backend/ap2hi_images_logo.png" height="50" weight="50" ></center>
		</td>
	</tr>

	<tr>
		<td align="center"> <h6>Vessel Name </h6>  </td>
		<td align="center">:</td>
		<td align="center"><h6> <?php echo $row->nama_kapal; ?></h6></td>
		<td rowspan="2" >
					<center><img src="<?php echo base_url().'uploads/qr/'.$img ; ?>.png" height="50" weight="50" ></center>
				</td>
	</tr>

	<tr>
		<td align="center"><h6>Vessel Number</h6></td>
		<td align="center">:</td>
		<td align="center"><h6><?php echo $row->no_ap2hi ; ?></h6></td>
	</tr>


	<tr>
		<td  colspan ="2" >
			<center> <h6>http://ifish.ap2hi.org/v2 </h6></center>
		</td>

		<td colspan ="2" >
			<center><h6>http://ap2hi.org</h6> </center>
		</td>

	</tr>

</table>

<?php 
}
?>
