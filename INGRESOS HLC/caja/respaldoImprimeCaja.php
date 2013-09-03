<?php include("/configuracion/conf.php"); ?>
<?php 
/* header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=movimientos.pdf"); */
?> 

<?php
$modulo = "listaOrdenes.caja";
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>


<?php 
//***********tRAIGO VARIABLES A VARIABLES*********
$articulos=$_POST['descripcionArticulos'];
$pUnitario=$_POST['importeCliente1'];
$cantidad=$_POST['cantidad'];
$codigoArticulo=$_POST['codigoArticulo'];
$banderaSeguro=$_POST['banderaSeguro'];
$TASAA=$_POST['TASAARTICULOS'];
//**********CIERRO VARIABLES A VARIABLES**********
//********traigo centro de costos y libro*********
$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' ";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

for ($i = 0; $i < $nrows1; $i++ ){
$ID_LIBRO = $results1['ID_LIBRO'][$i];
$ID_EJERCICIO = $results1['ID_EJERCICIO'][$i];
} 
$sSQL19= "SELECT *
  FROM
almacenes 
WHERE almacen ='".$_POST['almacen']."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);
$ID_CCOSTO=$myrow19['ID_CCOSTO'];

//****************cierro centro de costos y libro**

$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);
$numeroPoliza=$myrowC['numeroPoliza'];




if(is_numeric($numeroPoliza)){

$s="A";
$sSQL9= "SELECT *
  FROM
movimientos
WHERE RECIBO ='".$_POST['recibo']."' AND FECHA='".$fecha1."' AND STATUS is not null
 ";
$result9=mysql_db_query($basedatos,$sSQL9);
$myrow9 = mysql_fetch_array($result9);
echo mysql_error();

if(!$myrow9['STATUS']){

$sSQL6= "Select * From usuarios WHERE usuario = '".$usuario."'";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
$ejercicio=$myrow6['ejercicio'];
$bandera=$_POST['paso_bandera'];
$reporteSeguro=$_POST['reporteSeguro'];

for($i=0;$i<$bandera;$i++){

$sSQL10= "Select * From movimientos WHERE FOLIO = '".$numeroPoliza."'";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
$FOLIO=$myrow10['FOLIO'];
$REFERENCIA=$myrow10['REFERENCIA'];
$REFERENCIA+='1';
$banderaSeguro1=$_POST['banderaSeguro1'];
$descripcionProcedimientos=$_POST['descripcionProcedimiento'];
$costoProcedimiento=$_POST['reporteCliente'];
$codigoProcedimiento=$_POST['codigoProcedimiento'];
$TASAP=$_POST['TASAPROCEDIMIENTOS'];
$ivaProcedimientos=$_POST['ivaProcedimientos'];
$status="A";
//echo "tasaP".$TASAP[$i];
$numeroMovimientoP+='1';
if($descripcionProcedimientos[$i]!=""){
$costoProcedimiento[$i];
$statProc="activo";
$q = "UPDATE clientesAmbulatorios set 
status='".$statProc."'
WHERE 
numeroE='".$_POST['numeroE']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
if($banderaSeguro1[$i]!=null){

//inserta a cxc la cantidad
$agregaP = "INSERT INTO cxc ( 
poliza,seguro, cliente,codigo,descripcion,	importe,almacen,usuario,fecha,numeroE
) values (
'".$numeroPoliza."',
'".$_POST['seguro']."',
'".$_POST['paciente']."',
'".$codigoProcedimiento[$i]."',
'".$descripcionProcedimientos[$i]."',
'".$banderaSeguro1[$i]."',
'".$ID_CCOSTO."',
'".$usuario."',
'".$fecha1."',
'".$_POST['numeroE']."'
)";
mysql_db_query($basedatos,$agregaP);
echo mysql_error();

}
//**********verifico numero de movimiento*****************
$sSQLC2= "Select * from aperturaCaja";
$resultC2=mysql_db_query($basedatos,$sSQLC2);
$myrowC2 = mysql_fetch_array($resultC2);
$consecutivoMovimiento=$myrowC2['consecutivo'];
//*******************************************************************
if($consecutivoMovimiento=='0'){
$quo = "UPDATE aperturaCaja set 
consecutivo='1'
";
mysql_db_query($basedatos,$quo);
echo mysql_error();
$consecutivoMovimiento='1';
$sSQLC12= "Select max(recibo) as numeroRecibo From aperturaCaja";
$resultC12=mysql_db_query($basedatos,$sSQLC12);
$myrowC12 = mysql_fetch_array($resultC12);
$consecutivoRecibo=$myrowC12['numeroRecibo'];
$consecutivoRecibo+='1';
$quo1 = "UPDATE aperturaCaja set 
recibo1='".$consecutivoRecibo."'
";
mysql_db_query($basedatos,$quo1);
echo mysql_error();
} else {
$sSQLC1= "Select max(consecutivo) as numeroMovimiento From aperturaCaja";
$resultC1=mysql_db_query($basedatos,$sSQLC1);
$myrowC1 = mysql_fetch_array($resultC1);

$sSQLC12= "Select max(recibo1) as numeroRecibo From aperturaCaja";
$resultC12=mysql_db_query($basedatos,$sSQLC12);
$myrowC12 = mysql_fetch_array($resultC12);
$consecutivoRecibo=$myrowC12['numeroRecibo'];
$consecutivoRecibo+='1';
$consecutivoMovimiento=$myrowC1['numeroMovimiento'];
$consecutivoMovimiento+='1';
$quo = "UPDATE aperturaCaja set 
consecutivo='".$consecutivoMovimiento."'
";
mysql_db_query($basedatos,$quo);
echo mysql_error();
$quo1 = "UPDATE aperturaCaja set 
recibo1='".$consecutivoRecibo."'
";
mysql_db_query($basedatos,$quo1);
echo mysql_error();
}
//echo "numero de Movimeiento".$NUMMOVIMIENTO=$consecutivoMovimiento;
//**********cierro verificacion numero de movimiento*****************

//inserta movimientos procedimientos
$agrega = "INSERT INTO movimientos ( 
POLIZA,NUMMOVTO,ID_EJERCICIO, ID_LIBRO,	ID_CCOSTO,	FOLIO,	FECHA,	CODIGO,DESCRIPCION,IMPORTE,TASA,NATURALEZA,	REFERENCIA,	
REFERENCIA2,	ID_CTAMAYORM,	ID_CCOSTOM,	ID_AUXILIARM,	STATUS,	ID_EJERCICIOM,	ID_EJERCICIOM2,	ID_EJERCICIOM3,	TIPO_CUENTA,ID_EJERCICIO2,RECIBO,CTO_COSTO,NUMEROE
) values (
'".$numeroPoliza."',
'".$consecutivoMovimiento."',
'".$ID_EJERCICIO."',
'".$ID_LIBRO."',
'".$ID_CCOSTO."',
'".$consecutivoRecibo."',
'".$_POST['fecha']."',
'".$codigoProcedimiento[$i]."',
'".$descripcionProcedimientos[$i]."',
'".$costoProcedimiento[$i]."',
'".$ivaProcedimientos[$i]."',
'".$REFERENCIA."','".$usuario."',
'".$_POST['servicioMedico']."','".$_POST['papanicolau']."',
'".$_POST['materiales']."','".$al."','".'P'."','".$al."','".$al."','".$al."','".$al."','".$al."','".$_POST['recibo']."',
'".$_POST['almacen']."','".$_POST['numeroE']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


}
} //cierra insertar procedimientos

//*********************BANDERAS DE MATERIALES
$bandera1=$_POST['paso_bandera1'];
//***************************CIERRO VANDERAS A MATERIALES

for($ii=0;$ii<$bandera1;$ii++){
$sSQL10= "Select * From movimientos WHERE FOLIO = '".$numeroPoliza."'";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
$FOLIO=$myrow10['FOLIO'];

$REFERENCIA=$myrow10['REFERENCIA'];
$REFERENCIA+='1';


//echo "tassaaA".$TASAA[$ii];
if($articulos[$ii]!=""){
//echo $articulos[$i]."\n";
$statArt="activo";
$q1 = "UPDATE clientesAmbulatorios set 
status='".$statArt."'
WHERE 
numeroE='".$_POST['numeroE']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
if($banderaSeguro!=null){
//inserta a cxc la cantidad
$agregaM = "INSERT INTO cxc ( 
poliza,seguro, cliente,codigo,descripcion,	importe,almacen,cantidad,usuario,fecha,numeroE
) values (
'".$numeroPoliza."',
'".$_POST['seguro']."',
'".$_POST['paciente']."',
'".$codigoProcedimiento[$i]."',
'".$descripcionProcedimientos[$i]."',
'".$costoProcedimiento[$i]."',
'".$ID_CCOSTO."',
'".$cantidad[$ii]."',
'".$usuario."',
'".$fecha1."',
'".$_POST['numeroE']."'
)";
mysql_db_query($basedatos,$agregaM);
echo mysql_error();
}
//cierra cxc
//**********verifico numero de movimiento*****************
$sSQLC2= "Select * from aperturaCaja";
$resultC2=mysql_db_query($basedatos,$sSQLC2);
$myrowC2 = mysql_fetch_array($resultC2);
$consecutivoMovimiento=$myrowC2['consecutivo'];
//*******************************************************************
if($consecutivoMovimiento=='0'){
$quo = "UPDATE aperturaCaja set 
consecutivo='1'
";
mysql_db_query($basedatos,$quo);
echo mysql_error();
$consecutivoMovimiento='1';
$sSQLC12= "Select max(recibo) as numeroRecibo From aperturaCaja";
$resultC12=mysql_db_query($basedatos,$sSQLC12);
$myrowC12 = mysql_fetch_array($resultC12);
$consecutivoRecibo=$myrowC12['numeroRecibo'];
$consecutivoRecibo+='1';
$quo1 = "UPDATE aperturaCaja set 
recibo1='".$consecutivoRecibo."'
";
mysql_db_query($basedatos,$quo1);
echo mysql_error();
} else {
$sSQLC1= "Select max(consecutivo) as numeroMovimiento From aperturaCaja";
$resultC1=mysql_db_query($basedatos,$sSQLC1);
$myrowC1 = mysql_fetch_array($resultC1);

$sSQLC12= "Select max(recibo1) as numeroRecibo From aperturaCaja";
$resultC12=mysql_db_query($basedatos,$sSQLC12);
$myrowC12 = mysql_fetch_array($resultC12);
$consecutivoRecibo=$myrowC12['numeroRecibo'];
$consecutivoRecibo+='1';
$consecutivoMovimiento=$myrowC1['numeroMovimiento'];
$consecutivoMovimiento+='1';
$quo = "UPDATE aperturaCaja set 
consecutivo='".$consecutivoMovimiento."'
";
mysql_db_query($basedatos,$quo);
echo mysql_error();
$quo1 = "UPDATE aperturaCaja set 
recibo1='".$consecutivoRecibo."'
";
mysql_db_query($basedatos,$quo1);
echo mysql_error();
}
//echo "numero de Movimeiento".$NUMMOVIMIENTO=$consecutivoMovimiento;
//**********cierro verificacion numero de movimiento*****************

$agrega = "INSERT INTO movimientos ( 
POLIZA,NUMMOVTO,ID_EJERCICIO, ID_LIBRO,	ID_CCOSTO,	FOLIO,FECHA,	CODIGO,DESCRIPCION,IMPORTE,TASA,NATURALEZA,	REFERENCIA,	
REFERENCIA2,	ID_CTAMAYORM,	ID_CCOSTOM,	ID_AUXILIARM,	STATUS,	ID_EJERCICIOM,	ID_EJERCICIOM2,	ID_EJERCICIOM3,	TIPO_CUENTA,ID_EJERCICIO2,CANTIDAD,RECIBO,CTO_COSTO,NUMEROE

) values (
'".$numeroPoliza."',
'".$NUMMOVIMIENTO."',
'".$ID_EJERCICIO."',
'".$ID_LIBRO."',
'".$ID_CCOSTO."',
'".$consecutivoRecibo."',
'".$_POST['fecha']."',
'".$codigoArticulo[$ii]."',
'".$articulos[$ii]."',
'".$pUnitario[$ii]."',
'".$TASAA[$ii]."',
'".$REFERENCIA."','".$usuario."',
'".$_POST['servicioMedico']."','".$_POST['papanicolau']."',
'".$_POST['materiales']."','".$al."','".'P'."','".$al."','".$al."','".$al."','".$al."','".$al."','".$cantidad[$ii]."',
'".$_POST['recibo']."','".$_POST['almacen']."','".$_POST['numeroE']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

}//cierro validacion de status
} //cierro validacion de poliza


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}

-->
</style>
</head>

<body>
<h1 align="center">&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="964" height="0" border="0" align="center" cellpadding="0" cellspacing="0" class="style12">
    <tr>
      <th width="85" class="style12" scope="col"><div align="center"><span class="style11 style14">Cantidad</span></div></th>
      <th width="533" class="style12" scope="col"><div align="center"><span class="style11 style14">Art&iacute;culo/Procedimiento</span></div></th>
      <th width="64" class="style12" scope="col"><div align="center"><span class="style11 style14">Almac&eacute;n</span></div></th>
      <th width="84" class="style12" scope="col"><span class="style11 style14">Precio Unitario </span></th>
      <th width="84" class="style12" scope="col"><div align="center">IVA</div></th>
      <th width="98" class="style12" scope="col"><div align="center"><span class="style11 style14">Precio Unitario </span></div></th>
    </tr>
    <tr>
<?php 
$sSQL= "SELECT *
FROM
movimientos
WHERE NUMEROE ='".$_POST['numeroE']."' 
 ";
$result=mysql_db_query($basedatos,$sSQL);
$flag=$_POST['paso_bandera']+$_POST['paso_bandera1'];

while($myrow = mysql_fetch_array($result)){
echo mysql_error();
$r+=1;
?>
      <td bgcolor="<?php echo $color; ?>" class="style12"><div align="center"><span class="style7">
      <?php 
	  if($myrow['CANTIDAD']!=null){
	  echo $cantidad=$myrow['CANTIDAD'];
	  } else {
	  $cantidad=0;
	  echo "N/A";
	  }
	  ?>
      </span></div></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><div align="center"><span class="style7">
<?php echo $myrow['DESCRIPCION'];?></span></div></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><div align="center"><span class="style7"><?php echo $myrow['CTO_COSTO'];?></span></div></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><span class="style7">
        <?php 
	 if(	$myrow['TASA']){
	  $importes=(($myrow['IMPORTE']/100)*$myrow['TASA']);
	  $importes=$myrow['IMPORTE']-$importes;
	  } else {
	  $importes=$myrow['IMPORTE'];
	  }
	  echo "$".number_format($importes,2);?>
      </span></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><div align="center"><span class="style7"><?php 
	  $IVA=$myrow['TASA'];
	  echo "$".number_format($IVA,2);
	  ?></span></div></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><div align="center"><span class="style7">

      </span><span class="style7">
      <?php 
	  $importe=$myrow['IMPORTE'];
	  echo "$".number_format($myrow['IMPORTE'],2);?>
      </span></div></td>
    </tr>
    
    <?php 
$sTotal[0]+=$importe;
} //cierro ultimo paso de while
	 
	 
	  ?>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="146" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="3" class="style12" scope="col"><div align="center"><span class="style11 style13 style14">Totales</span></div>
        <div align="center"></div>
      <div align="center"></div></th>
  </tr>
  <tr>
    <td width="62" bgcolor="#FFFFFF" class="style12"><div align="right">Total </div></td>
    <td width="30" bgcolor="#FFFFFF" class="style12">&nbsp;</td>
    <td width="54" bgcolor="#FFFFFF" class="style12"><div align="left"><span class="style7">
      <?php 
	$sTotal = $sTotal[0]; 
	echo "$".number_format($sTotal,2);
	?>
    </span></div></td>
  </tr>
</table>
<?php } else {
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>

<p>&nbsp;</p>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>