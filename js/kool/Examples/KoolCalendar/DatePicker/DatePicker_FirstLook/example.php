<?php
	require $KoolControlsFolder."/KoolCalendar/koolcalendar.php";	
	
	$datepicker = new KoolDatePicker("datepicker"); //Create calendar object
	$datepicker->scriptFolder = $KoolControlsFolder."/KoolCalendar";//Set scriptFolder
	$datepicker->styleFolder="default";

	$datepicker->Init();
?>

<form id="form1" method="post">	
	<div style="padding-top:20px;padding-bottom:40px;width:650px;">
		Pick a date:
		<br/>
		<?php echo $datepicker->Render();?>
		<div style="padding-top:10px;">
			<input type="submit" value="Submit" />
		</div>
		<div style="padding-top:10px;">
			<?php
				if($datepicker->Value!=null)
				{
					echo "<b>Choosed date:</b> ".$datepicker->Value;
				}
			?>
		</div>		
	</div>
</form>
