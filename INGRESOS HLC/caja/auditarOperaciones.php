<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); ?>
<?php include('/configuracion/funciones.php'); 
$ventana1='ventanaCatalogoAlmacen.php';
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

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 14px}
.style11 {color: #000; font-size: 14px; font-weight: normal; }
.style12 {font-size: 14px}
.style15 {color: #FFFF99}
.Estilo24 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
.style13 {color: #000}
.style121 {font-size: 14px}
.style121 {font-size: 14px}
-->
</style>
</head>

<body>
 <h1 align="center">Auditar Operaciones Hospitalarias </h1>
 <form id="form2" name="form2" method="post" action="">
   <table width="317" border="0" align="center" class="style121">
     <tr>
       <td width="95"><div align="left" class="none">Fecha Inicial </div></td>
    <td width="190"><div align="left">
           <label>
           <input name="fecha" type="text" class="style71" id="campo_fecha" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fecha']){
		 echo $_POST['fecha'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  onchange="javascript:this.form.submit();"/>
           </label>
           <input name="button" type="button" class="style121" id="lanzador" value="..." />
       </div></td>
     </tr>
   </table>
   
   <p>
     <?php if($_POST['fecha'] and $_POST['fecha']<$fecha1){	?>
   </p>
   <img src="../../imagenes/bordestablas/borde1.png" width="500" height="24" />
   <table width="500" border="0" align="center" cellpadding="3" cellspacing="0" class="style71">
     <tr>
       <th width="63" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left">C&oacute;digo</div></th>
       <th width="247" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left">Descripci&oacute;n</div></th>
       <th width="83" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left">Importe</div></th>
       <th width="83" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left">IVA</div></th>
     </tr>
     <tr>
	 
	 
	 
<?php
 $sSQL= "
SELECT * FROM gpoProductos
WHERE 
entidad='".$entidad."' 
and
activo='activo'
";
 






if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$codigo=$code = $myrow['codigo'];

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$C=$myrow['codigoGP'];
$sSQL7="SELECT SUM(precioVenta) as acumulado,sum(iva) as iva
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 
and
cargosCuentaPaciente.gpoProducto='".$C."'
and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'
and
cargosCuentaPaciente.status!='transaccion'

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
       <td bgcolor="<?php echo $color;?>" ><label> <?php echo $C?> </label>       </td>
       <td  bgcolor="<?php echo $color;?>" >
	   <div align="left"><span class=""> <?php echo $myrow['descripcionGP']; ?></span></div></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $cargos[0]+=$myrow7['acumulado'];
	  echo "$".number_format($myrow7['acumulado'],2);	  
	   ?></td>
       <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php 
	   $iva[0]+=$myrow7['iva'];
	  echo "$".number_format($myrow7['iva'],2);	  
	   ?></td>
       </tr>
     <?php }}?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="500" height="24" />
<p>&nbsp;</p>
   <img src="../../imagenes/bordestablas/borde1.png" width="500" height="24" />
   <table width="500" border="0" align="center" cellpadding="3" cellspacing="0" class="style121">
     <tr bgcolor="#FFFF00">
       <td class="style11"><div align="center"><span class="style71"> Cargos </span></div></td>
       <td height="14" class="style11"><div align="center"><span class="style71"> Abonos</span></div></td>
       <td class="style11"><div align="center">IVA</div></td>
       <td class="style11">% Percentage </td>
       <td class="style11"><div align="center">IVA x Pagar </div></td>
     </tr>
     <tr>
       <td width="97" bgcolor="#FFFFFF" class="style121"><div align="center">
         <?php 
	
		echo "$ ".number_format($cargos[0],2);?>
       </div></td>
       <td width="106" height="23" bgcolor="#FFFFFF" class="style121"><div align="center"><span class="style71">
         <?php 		 
$sSQL71="SELECT SUM(precioVenta) as abonos
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 

and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'
and
status='transaccion'

  ";
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);
$abonos=  $myrow71['abonos'];
		echo "$ ".number_format($myrow71['abonos'],2); 
		?>
       </span></div></td>
       <td width="96" bgcolor="#FFFFFF" class="style121"><div align="center"><span class="style71">
         <?php 		 
$sSQL711="SELECT SUM(iva) as ivaAcumulado
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 

and
cargosCuentaPaciente.fecha1='".$_POST['fecha']."'


  ";
  $result711=mysql_db_query($basedatos,$sSQL711);
  $myrow711 = mysql_fetch_array($result711);
$ivaAcumulado=  $myrow711['ivaAcumulado'];
		echo "$ ".number_format($myrow711['ivaAcumulado'],2); 
		?>
       </span></div></td>
       <td width="96" bgcolor="#FFFFFF" class="style121"><div align="center">
         <?php 
	   if($cargos[0]!=NULL){
		$porcentajeIVA=($abonos/$cargos[0])*100;
        echo "$ ".number_format($porcentajeIVA,6);
	   }
	   ?>
       </div></td>
       <td width="96" bgcolor="#FFFFFF" class="style121"><div align="center">
	   <?php 
	   echo "$ ".number_format($ivaAcumulado*$porcentajeIVA,4);
	   ?></div></td>
     </tr>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="500" height="24" />
   <?php } ?>
   <p>&nbsp;</p>
   <p align="center">&nbsp;</p>
   <img src="../../imagenes/bordestablas/borde1.png" width="552" height="24" />
   <table width="552" border="0" align="center" cellpadding="3" cellspacing="0" class="Estilo24">
     <tr bgcolor="#FFFF00">
       <td class="Estilo24">&nbsp;</td>
       <td class="Estilo24"><div align="center"><span class="style11">Cargos</span></div></td>
       <td height="14" class="Estilo24"><div align="center"><span class="style11">Abonos</span></div></td>
       <td class="Estilo24"><div align="center"><span class="style11">IVA</span></div></td>
       <td class="Estilo24"><div align="center"><span class="style11">TOTAL</span></div></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="left">
	   <a href="#"  onClick="javascript:ventanaSecundaria1('acumuladoEfectivo.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>')">Acumulado Efectivo		</a>
		</div></td>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="center">
         <?php 
  $sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente WHERE 
status='transaccion'
  
  
  and
entidad='".$entidad."' 
and
fecha1='".$fecha1."'
";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
  echo "$".number_format($myrow['acumulado'],2);
	   
	   ?>
       </div></td>
       <td height="23" bgcolor="#FFFFFF" class="Estilo24"><div align="center"><?php echo "$".number_format($acumulado,2); ?></div></td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="center"></div></td>
     </tr>
     <tr bgcolor="#FFFF99">
       <td class="Estilo24"><div align="left">Acumulado Px Internos </div></td>
       <td class="Estilo24"><div align="center">
         <?php 
  $sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente,clientesInternos 
  WHERE 
  clientesInternos.tipoPaciente='interno'
  and
  cargosCuentaPaciente.entidad='".$entidad."' 
AND
(cargosCuentaPaciente.numeroE=clientesInternos.numeroE and cargosCuentaPaciente.nCuenta=clientesInternos.nCuenta)
and
cargosCuentaPaciente.fecha1='".$fecha1."'
";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
  echo "$".number_format($myrow['acumulado'],2);
	   
	   ?>
       </div></td>
       <td height="23" class="Estilo24"><div align="center"><?php echo "$".number_format($acumulado,2); ?></div></td>
       <td class="Estilo24">&nbsp;</td>
       <td class="Estilo24"><div align="center"></div></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="left">
	   <a href="#"  onClick="javascript:ventanaSecundaria1('acumuladoAlmacenes.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>')">
		Acumulado Operaciones		</a>
		x Al </div></td>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="center">
	   
	   <?php 
  $sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente,
  articulosReportesFinancieros WHERE cargosCuentaPaciente.entidad='".$entidad."' 
AND
articulosReportesFinancieros.codigo=cargosCuentaPaciente.codProcedimiento
and
cargosCuentaPaciente.fecha1='".$fecha1."'
";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
  echo "$".number_format($myrow['acumulado'],2);
	   
	   ?>
	   
	   </div></td>
       <td height="23" bgcolor="#FFFFFF" class="Estilo24"><div align="center"></div></td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="center"></div></td>
     </tr>
     <tr bgcolor="#FFFF99">
       <td class="Estilo24">Movtos. CxC </td>
       <td class="Estilo24"><div align="center"></div></td>
       <td height="23" class="Estilo24"><div align="center"></div></td>
       <td class="Estilo24">&nbsp;</td>
       <td class="Estilo24"><div align="center"></div></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="right">Traslados a  CxC </div></td>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="center">
         <?php 
  $sSQL= "Select sum(precioVenta) as acumulado From cargosCuentaPaciente WHERE 
status='transaccion'
  and
  tipoTransaccion='TCIA'
  and
  statusTraslado='trasladado'
  
  and
entidad='".$entidad."' 
and
fecha1='".$fecha1."'
";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
  echo "$".number_format($myrow['acumulado'],2);
	   
	   ?>
       </div></td>
       <td height="23" bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo24"><div align="right">Aplicaciones de Pagos </div></td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td height="23" bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td height="23" bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
     </tr>
     <tr>
       <td width="176" bgcolor="#FFFFFF" class="Estilo24"><span class="style71">Total </span></td>
       <td width="77" bgcolor="#FFFFFF" class="Estilo24"><div align="center">
         <?php 
		$totalAcumulado=new acumulados();
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);?>
       </div></td>
       <td width="85" height="23" bgcolor="#FFFFFF" class="Estilo24"><div align="center"><span class="style71">
         <?php 		 
		$abonos=new acumulados();
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),2); ?>
       </span></div></td>
       <td width="84" bgcolor="#FFFFFF" class="Estilo24">&nbsp;</td>
       <td width="100" bgcolor="#FFFFFF" class="Estilo24"><div align="center">
         <?php 
		  if($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta)<0){
		  $abono=$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta);
		  $abono1=$abono*'-1';
		  }
		  
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)-$abono1,2);
		?>
       </div></td>
     </tr>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="552" height="24" />
<p align="center">&nbsp;</p>
   <p align="center">&nbsp;</p>
   <p align="center">
     <label>
     <input name="nuevo" type="button" class="style7" id="nuevo" value="Nuevo Almac&eacute;n/M&eacute;dico"
	  onclick="ventanaSecundaria1('<?php echo $ventana1;?>')" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>