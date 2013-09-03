<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.clientePrincipal.value) == false ) {   
                alert("Por Favor, escoje el clientePrincipal/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este clientePrincipal!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
	<?php 		
$sSQL7ab="SELECT medicos 
FROM
gpoProductos
WHERE
codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 




<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){

LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<?php
// The message
$message = "Line 1\nLine 2\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
//mail('hlacarlota@', 'My Subject', $message);
?>
<br />
<br />
<form id="form2" name="form2" method="post"><div align="center">
     <h1 class="titulomedio">Consumo Aseguradora del dia: <?php echo cambia_a_normal($_GET['fechaInicial']);?> al <?php echo cambia_a_normal($_GET['fechaFinal']);?></h1>
     <p class="titulomedio"><?php echo $_GET['nomSeguro'];?></p>
     <table class="table table-striped" width="889" >

       <tr>
         <td width="64" bgcolor="#FFFF00" align="center" class="negromid">Exp</td>
         <td width="217" bgcolor="#FFFF00" class="negromid">Paciente</td>
         <td width="83" bgcolor="#FFFF00" class="negromid"><div align="center">0% </div></td>
         <td width="88" bgcolor="#FFFF00" class="negromid" align="center">16% </td>
         <td width="79" bgcolor="#FFFF00" class="negromid" align="center">E</td>
         <td width="83" bgcolor="#FFFF00" class="negromid" align="center">RX</td>
         <td width="97" bgcolor="#FFFF00" class="negromid" align="center">LAB</td>
         <td width="89" bgcolor="#FFFF00" class="negromid" align="center">URG</td>
         <td width="89" bgcolor="#FFFF00" class="negromid" align="center">TOTAL</td>
       </tr>
<?php	

  $sSQL= "SELECT *
FROM
reportesFinancieros 
WHERE entidad='".$entidad."' 
and
random='".$_GET['random']."'
and
numeroE!=0
group by numeroE
order by paciente ASC";


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 


	  ?>
       <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
         <td height="57" align="center" class="normal">
		 <?php echo $myrow['numeroE'];?>		 </td>
         <td class="normal"><span class="normal"><?php echo $myrow['paciente'];?></span></td>
         <td class="normal">
		 <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
tasa=0
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
tasa=0
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
$tasaCero[0]+=$myrowc8['c']-$myrowa8['a'];
$tasaCeroTotal=$myrowc8['c']-$myrowa8['a'];
?>

<?php echo '<span class="normal" align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>		 </td>
         <td align="center" class="normal">
		 		 <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
tasa=16
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
tasa=16
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
$tasaIVA[0]+=$myrowc8['c']-$myrowa8['a'];
$tasaIVATotal=$myrowc8['c']-$myrowa8['a'];
?>

<?php echo '<span class="normal" align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>		 </td>
         <td align="center" class="normal">
<?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
tasa='E'
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
tasa='E'
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
$tasaExento[0]+=$myrowc8['c']-$myrowa8['a'];
$tasaExentoTotal=$myrowc8['c']-$myrowa8['a'];
?>

<?php echo '<span class="normal" align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>		 </td>
         <td align="center" class="normal">
		 <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
almacen='HRX'
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
almacen='HRX'
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
$rayosX[0]+=$myrowc8['c']-$myrowa8['a'];
$rayosXTotal=$myrowc8['c']-$myrowa8['a'];
?>

<?php echo '<span class="normal" align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>		 </td>
         <td align="center" class="normal">
		 		 <?php
//***************************************PRIMERA VEZ***********************************
$sSQLc8= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
almacen='HLAB'
";
$resultc8=mysql_db_query($basedatos,$sSQLc8); 
$myrowc8 = mysql_fetch_array($resultc8);		   

	   
$sSQLa8= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
almacen='HLAB'
";
$resulta8=mysql_db_query($basedatos,$sSQLa8); 
$myrowa8 = mysql_fetch_array($resulta8);	
//************************************************************************************	   
$laboratorio[0]+=$myrowc8['c']-$myrowa8['a'];
$laboratorioTotal=$myrowc8['c']-$myrowa8['a'];
?>

<?php echo '<span class="normal" align="center">'.'$'.number_format($myrowc8['c']-$myrowa8['a'],2).'</span>';?>		 </td>
         <td class="normal" align="center"><?php
//***************************************PRIMERA VEZ***********************************
$sSQLurg= "Select sum(efectivo+iva) as c  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='C'
and
almacen='HURG'
";
$resulturg=mysql_db_query($basedatos,$sSQLurg); 
$myrowurg = mysql_fetch_array($resulturg);		   

	   
$sSQLurgd= "Select sum(efectivo+iva) as a  From reportesFinancieros where entidad='".$entidad."' and random='".$_GET['random']."'    
and
folioVenta='".$myrow['folioVenta']."'
and

naturaleza='A'
and
almacen='HURG'
";
$resulturgd=mysql_db_query($basedatos,$sSQLurgd); 
$myrowurgd = mysql_fetch_array($resulturgd);	
//************************************************************************************	   
$urgencias[0]+=$myrowurg['c']-$myrowurgd['a'];
$urgenciasTotal=$myrowurg['c']-$myrowurgd['a'];


$totales[0]+=$tasaCeroTotal+$tasaIVATotal+$tasaExentoTotal+$rayosXTotal+$laboratorioTotal+$urgenciasTotal;
?>
           <?php echo '<span class="normal" align="center">'.'$'.number_format($myrowurg['c']-$myrowurgd['a'],2).'</span>';?> </td>
		   
		   
		   
		   
		   
		   
		   
         <td class="normal" align="center"><?php echo '<span class="normal" align="center">'.'$'.number_format($tasaCeroTotal+$tasaIVATotal+$tasaExentoTotal+$rayosXTotal+$laboratorioTotal+$urgenciasTotal,2).'</span>';?>		 </td>
       </tr>
       <?php  }}?>
       <tr>
         <td colspan="9">&nbsp;</td>
       </tr>
       <tr>
         <td colspan="2">TOTALES</td>
         <td><span class="normal"><?php echo '<span class="normal" align="center">'.'$'.number_format($tasaCero[0],2).'</span>';?></span></td>
         <td><?php echo '<span class="normal" align="center">'.'$'.number_format($tasaIVA[0],2).'</span>';?></td>
         <td><?php echo '<span class="normal" align="center">'.'$'.number_format($tasaExento[0],2).'</span>';?></td>
         <td><?php echo '<span class="normal" align="center">'.'$'.number_format($rayosX[0],2).'</span>';?></td>
         <td><?php echo '<span class="normal" align="center">'.'$'.number_format($laboratorio[0],2).'</span>';?></td>
         <td><?php echo '<span class="normal" align="center">'.'$'.number_format($urgencias[0],2).'</span>';?></td>
         <td><?php echo '<span class="precio2" align="center">'.'$'.number_format($totales[0],2).'</span>';?></td>
       </tr>

     </table>
     <p class="titulomedio">&nbsp;</p>  
     <p class="titulomedio">&nbsp;</p>
 </div>
</form>

 
</body>
</html>