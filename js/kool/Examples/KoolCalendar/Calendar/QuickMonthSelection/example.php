<?php
	require $KoolControlsFolder."/KoolCalendar/koolcalendar.php";
	require $KoolControlsFolder."/KoolAjax/koolajax.php";
	$koolajax->scriptFolder = $KoolControlsFolder."/KoolAjax";
	
	
	$cal = new KoolCalendar("cal"); //Create calendar object
	$cal->scriptFolder = $KoolControlsFolder."/KoolCalendar";//Set scriptFolder
	$cal->styleFolder="default";
	
	//Enable Ajax
	$cal->AjaxEnabled = true;
	$cal->AjaxLoadingImage = $KoolControlsFolder."/KoolAjax/loading/2.gif";

	//Enable Quick Month Selection
	$cal->EnableQuickMonthSelect = true;

	//Init calendar before render
	$cal->Init();
?>

<form id="form1" method="post">
	<i>*Note:</i> Click to header text to open quick month selector.	
	<div style="padding-top:20px;padding-bottom:40px;width:650px;<?php if ($style_select=="black") echo "background:#333"; ?>">
		<?php echo $koolajax->Render();?>
		<?php echo $cal->Render();?>
	</div>
</form>
