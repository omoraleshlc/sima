<?php
	require $KoolControlsFolder."/KoolAjax/koolajax.php";
	$koolajax->scriptFolder = $KoolControlsFolder."/KoolAjax";

	require $KoolControlsFolder."/KoolGrid/koolgrid.php";

	if(isset($_POST["style_select"]))
	{
		$_SESSION["style_select"] = $_POST["style_select"];
	}
	else
	{
		if (!$koolajax->isCallback)
		{
			//Page Init: show default style
			$_SESSION["style_select"] = "default";
		}
	}
		
	$ds = new MySQLDataSource($db_con);//This $db_con link has been created inside KoolPHPSuite/Resources/runexample.php
	$nombreCompleto=$_POST['nombreCompleto'];


$ssql="SELECT  folioVenta,paciente from clientesInternos where entidad='".$entidad."' and paciente like '%$nombreCompleto%'  and statusCaja='pagado'  ";

	$ds->SelectCommand = $ssql;



	$grid = new KoolGrid("grid");
	$grid->scriptFolder = $KoolControlsFolder."/KoolGrid";
	$grid->DataSource = $ds;
	$grid->AjaxEnabled = true;
	$grid->AutoGenerateColumns = true;
	$grid->MasterTable->Pager = new GridPrevNextAndNumericPager();
	$grid->Width = "500px";
	
	$grid->styleFolder=$_SESSION["style_select"];
	$grid->Process();
?>

	
	<div style="padding-top:10px;">
		<?php echo $grid->Render();?>
	</div>

