<?php
if($_GET['pais']=='MEX'){
$_GET['pais']='mexico';
}
       
$direccion=$_GET['calle'].', '.$_GET['ciudad'].', '.$_GET['pais'];       
require'/var/www/html/sima/js/EasyGoogleMap.class.php';
if($_SERVER['SERVER_NAME']=='10.2.11.250'){
$certificado="ABQIAAAAqs98jRmICtRwulWma7vxmxTFTF7P-_E0jva-NhGNrHHStLgDqRR3DnYPayBtXUnYYIRLvt9PFMAE7w";
} else if($_SERVER['SERVER_NAME']=='10.2.1.201'){
$certificado="ABQIAAAAqs98jRmICtRwulWma7vxmxRV6eBuSv73BnRLJ6QqiCDdBy7fnxQ3PbTAlgzg7Q2Qqsu4QfuW5HESsw";
} else if($_SERVER['SERVER_NAME']=='hlc.sytes.net'){
$certificado="ABQIAAAAqs98jRmICtRwulWma7vxmxTYnsAwSInJt4hbUmTJJJ-a0tbHBhRi8FrcAg0itWz46tzVv4kcupMckg";
}
$gm = & new EasyGoogleMap($certificado);


$gm->SetMarkerIconStyle('STAR');
$gm->SetMapZoom(15);
$gm->SetAddress($direccion);
//$gm->SetInfoWindowText($direccion);

//$gm->SetAddress($_GET['calle'].','.$_GET['ciudad']);
//$gm->SetInfoWindowText("Direccion");
//$gm->SetSideClick($_GET['pais']);
?>
<html>
<head>
<title>EasyGoogleMap</title>
<?php echo $gm->GmapsKey(); ?>
</head>
<body>
<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php echo $gm->GetSideClick(); ?>
<?php echo $gm->UnloadMap(); ?>
</body>
</html>