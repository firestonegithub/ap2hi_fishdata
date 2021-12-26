
<?php 

foreach($dataVessel->result() as $row){


	$img = str_replace(".", "_", $row->no_ap2hi); 
?>

<table frame="box" style="table-layout:fixed; width:600px;
						    margin-top: 100px;
						    margin-bottom: 100px;
						    background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;">

	<tr style="height: 20px;">
		<td colspan="4" style="border-bottom: 1pt solid black; border-top: 1pt solid black;border-right: 1pt solid black;border-left: 1pt solid black;" >
			<center><img src="<?php echo base_url();?>media/backend/ap2hi_images_logo.png" height="100" weight="400" ></center>
		</td>
	</tr>

	<tr style="height: 20px; ">

		<td style="border-left: 1pt solid black;">
				Vessel Name
		</td>

		<td>
				:
		</td>

		<td>
				<?php echo $row->nama_kapal; ?>
		</td>

		<td rowspan="2" style="border-right: 1pt solid black;" >
			<center><img src="<?php echo base_url().'uploads/qr/'.$img ; ?>.png" height="100" weight="100" ></center>
		</td>
	</tr>
		

	<tr style="height: 20px;">

		<td style="border-left: 1pt solid black;">
				Vessel Number
		</td>

		<td>
				:
		</td>

		<td>
				<?php echo $row->no_ap2hi ; ?>
		</td> 

	</tr>

	<tr style="height: 20px;">
		<td  colspan ="2" style="border-left: 1pt solid black; border-bottom: 1pt solid black;" >
			<center> http://ifish.ap2hi.org/v2 </center>
		</td>

		<td colspan ="2" style="border-right: 1pt solid black; border-bottom: 1pt solid black;">
			<center>http://ap2hi.org </center>
		</td>

	</tr>


</table>
<?php 
}
?>


