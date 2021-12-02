
<!-- http://www.vesna.ru/php5/examples/ -->


<h4>CSS Float</h4>

<!--<div>
    Some text to start with

    <div style="float: right; width: 28%;">
        This is text that is set to float:right.
    </div>

    <div style="float: left; width: 54%;">
        This is text that is set to float:left.
    </div>

    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>

    This is text that follows the clear:both.
</div> -->



 <div style="float: left; width: 28%;">
        This is text that is set to float:right.
    </div>

    <div style="float: left; width: 54%;">
        This is text that is set to float:left.
    </div>

    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>


<?php 
$no = 1;
foreach($dataVessel->result() as $row){


	$img = str_replace(".", "_", $row->no_ap2hi); 

?>


<table frame="box" style="table-layout:fixed; width:600px;
						    margin-top: 10px;
						    margin-bottom: 10px;
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

$no++;
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
table thead td { background-color: #000000;
 text-align: center;
}
table tfoot td { background-color: #000000;
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
</style>-->