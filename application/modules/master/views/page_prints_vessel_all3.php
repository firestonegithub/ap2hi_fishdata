
<!-- http://www.vesna.ru/php5/examples/ -->


<!--<h4>CSS Float</h4> -->

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

foreach($dataVessel->result() as $row){


	$img = str_replace(".", "_", $row->no_ap2hi); 
?>


 <div style="float: left; width: 20%;">
<table class="items"  style="float:left;" width="20%"cellpadding="8" border="1">

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
</div>

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
</style> -->