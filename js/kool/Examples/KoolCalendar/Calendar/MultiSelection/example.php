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

	//MultiView setting
	$cal->MultiViewColumns = 2;
	$cal->MultiViewRows = 1;	

	//Multi Selection setting
	$cal->EnableMultiSelect = true; //Enable MultiSelection
	$cal->UseColumnHeadersAsSelectors = true; //Able to select multi date by clicking to column header
	$cal->UseRowHeadersAsSelectors = true; //Able to select multi date by clicking to row header
	$cal->ShowViewSelector = true;
	
	//Init calendar before render
	$cal->Init();
?>

<form id="form1" method="post">	
	<div style="padding-top:20px;padding-bottom:40px;width:650px;<?php if ($style_select=="black") echo "background:#333"; ?>">
		<?php echo $koolajax->Render();?>
		<?php echo $cal->Render();?>
	</div>
</form>
