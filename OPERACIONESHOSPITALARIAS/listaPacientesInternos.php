<?php require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>




<?php 
if(!$_GET['almacenDestino']){
$_GET['almacenDestino']=$_GET['almacenDestino'];
}
if(!$_GET['almacenDestino1']){
$_GET['almacenDestino1']=$_GET['almacenDestino1'];
}
?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  
  
  
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>

  <h1 align="center" class="titulos">Reporte de Cuentas</h1>

<form id="form2" name="form2" method="get" >
<img src="../imagenes/bordestablas/borde1.png" alt="bo1" width="600" height="21" />
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="none">
    <tr>
      <td width="151" height="31" bgcolor="#CCCCCC"><div align="left" class="none">Almacen Principal</div></td>
      <td width="439" bgcolor="#CCCCCC"><?php 
	  $aCombo= "Select * From almacenes where ventas='si' and entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="Estilo24" id="almacenDestino" onChange="javascript:this.form.submit();"/>        
      
        <option value="">---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($_GET['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td height="31" bgcolor="#CCCCCC"><span class="none">Mini Almacen</span></td>
      <td bgcolor="#CCCCCC"><?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_GET['almacenDestino']."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1" class="Estilo24" id="almacenDestino1" onChange="javascript:this.form.submit();"/>        
        
        <?php  
					
 $sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['almacenDestino']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
        <option value="<?php echo $_GET['almacenDestino'];?>"><?php echo $myrow1['descripcion'];?></option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option 

		
		<?php 
		 if($_GET['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select></td>
    </tr>
    <tr>
      <td height="31" bgcolor="#CCCCCC"><div align="left" class="none">Fecha Inicial :</div></td>
      <td bgcolor="#CCCCCC"><div align="left">
          <label>
          <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_GET['fechaInicial']){
		 echo $_GET['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
      </div></td>
    </tr>
    <tr>
      <td height="31" bgcolor="#CCCCCC"><span class="none">Fecha Final </span></td>
      <td bgcolor="#CCCCCC"><label>
        <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_GET['fechaFinal']){
		 echo $_GET['fechaFinal'];
		 }
		 ?>"/>
      </label>
        <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." /></td>
    </tr>
    <tr>
      <td height="52" bgcolor="#CCCCCC"><div align="left" class="none">Escoje Tipo Reporte</div></td>
      <td bgcolor="#CCCCCC"><div align="left">
        <label></label>
        <label></label>
        <label></label>
        <label>
        
        <?php 
	   if (!$_POST['status']) $_POST['status']=$_GET['status']; ?>
         <select name="status" class="style12" id="status" onChange="javascript:this.form.submit();"/>
         
         <option >Selecciona la Opcion</option>
         <option 
		   <?php if($_POST['status']=='Activas')echo 'selected'; ?>
		    value="Activas">Activas</option>
         <option 
		   <?php if($_POST['status']=='Cerradas')echo 'selected'; ?>
		   value="Cerradas">Cerradas</option>
		   <option 
		   		   <option 
		   <?php if($_POST['status']=='Todas')echo 'selected'; ?>
		   value="Todas">Todas</option>
         </select>
         
  
        </label>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><img src="../imagenes/bordestablas/borde2.png" alt="bo2" width="600" height="20" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
          <input name="busca" type="submit" class="none" id="button" value="Enviar" />
        </div>
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center">&nbsp;</p>
  
  
  <?php if($_GET['busca'] and $_GET['fechaInicial'] and $_GET['fechaFinal']) { ?>
  <img src="../imagenes/bordestablas/borde1.png" alt="bo1" width="753" height="21" />
  <table width="753" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo24">
    <tr bgcolor="#330099">
      <th width="52" height="44" bgcolor="#FFFF00" class="none" scope="col"><div align="center" class="none">
        <div align="center">Folio V</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">Nombre del paciente</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">Aseguradora</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">Status</div>
      </div></th>
      <th bgcolor="#FFFF00" class="none" scope="col" >Usuario Autoriza</th>
      <th bgcolor="#FFFF00" class="none" scope="col" >Usuario Cierre</th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">Tipo Px</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">E/C</div>
      </div></th>
      <th bgcolor="#FFFF00" class="style12" scope="col"><div align="left" class="none">
        <div align="center">N/V</div>
      </div></th>
    </tr>
    <tr>
    
    
<?php	




if($_POST['status']=='Activas'){
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
status='activa'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta!='cerrada'
and
almacen = '".$_GET['almacenDestino1']."'
    and
    fecha1>='".$_GET['fechaInicial']."'
        and
fecha1<='".$_GET['fechaFinal']."'
    and
    (solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY paciente ASC";

 }elseif($_POST['status']=='Cerradas'){
 
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."'
    and
status='cerrada'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta='cerrada'
and
almacen = '".$_GET['almacenDestino1']."'
    and
    fecha1>='".$_GET['fechaInicial']."'
        and
fecha1<='".$_GET['fechaFinal']."'

ORDER BY paciente ASC" ;

 }elseif($_POST['status']=='Todas'){
  $sSQL= "SELECT *
FROM
clientesInternos
WHERE entidad='".$entidad."'
    and
status!='cancelada'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCuenta!='cancelada'
and
almacen = '".$_GET['almacenDestino1']."'
    and
    fecha1>='".$_GET['fechaInicial']."'
        and
fecha1<='".$_GET['fechaFinal']."'

ORDER BY paciente ASC" ;;
 }
 ?>    
    
<?php	

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 


$a+=1;

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow31['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($myrow['status']=='cancelado'){
$cancelados[0]+=1;
} else if($myrow['status']=='pendiente'){
$pendientes[0]+=1;
} else if($myrow['status']=='cortesia'){
$cortesia[0]+=1;
} else if($myrow['tipoPaciente']=='interno' and $myrow['status']=='activa'){
$activa[0]+=1;
} else if($myrow['status']=='cerrada'){
$cerradas[0]+=1;
}else if($myrow['status']=='request'){
$request[0]+=1;
}
if($myrow['tipoPaciente']=='externo' and $myrow['statusCaja']=='pagado'){
$statusCaja[0]+=1;
}


?>
<tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" > 
      <td height="24" bgcolor="<?php echo $color?>" class="normal">
        <label>
        <?php echo $myrow['folioVenta']; ?></label>
      </span></td>
      <td width="180" bgcolor="<?php echo $color?>" class="normal"><?php print $myrow['paciente'];?></span></td>
      <td width="179" bgcolor="<?php echo $color?>" class="normal">
	  <?php 
	  
	   $sql5= "
SELECT nomCliente
FROM
clientes
WHERE
numCliente='".$myrow['seguro']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
	  
	  if($myrow5['nomCliente']){
	  print $myrow5['nomCliente'];
	  }else{
	  print 'PARTICULAR';
	  }
	  ?>
      </span></td>
      <td width="43" bgcolor="<?php echo $color?>" class="normal"><?php 
	  
	  print $myrow['statusCuenta'];
	
	  ?></span></td>
      <td width="100" bgcolor="<?php echo $color?>" class="normal"><div align="center">
        <?php 
	  
	  print $myrow['autoriza'];

	  ?>
      </div></td>
      <td width="90" bgcolor="<?php echo $color?>" class="normal"><div align="center">
        <?php 
	  

	  print $myrow['usuario'];


	  ?>
      </div></td>
      <td width="47" bgcolor="<?php echo $color?>" class="normal"><?php print $myrow['tipoPaciente'];?></span></td>
      <td width="31" bgcolor="<?php echo $color?>" class="style12"><div align="center"><a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"><img src="../../imagenes/btns/edocta.png" alt="Pacientes Activos" width="20" height="20" border="0" /></a></div></td>
      <td width="31" bgcolor="<?php echo $color?>" class="style12"><a href="javascript:ventanaSecundaria('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"> <img src="/sima/imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <img src="../imagenes/bordestablas/borde2.png" alt="bo2" width="753" height="20" />
<p align="center" class="precio1"><em>se encontraron <?php print $a;?> registros!</em></p>


  <p align="center">&nbsp;</p>
  <table width="256" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#6666FF">
      <th width="205" height="30" bgcolor="#FFFF00" scope="col"><div align="left" class="normalmid">Cuentas Activas (Internos)</div></th>
      <th width="41" bgcolor="#FFFF00" scope="col"><div align="left" class="negromid">
        <div align="center"><?php print $activa[0];?></div>
      </div></th>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="left" class="normalmid">Cuentas Cerradas (Internos)</div></td>
      <td bgcolor="#FFFFFF"><div align="left" class="negromid">
        <div align="center"><?php print $cerradas[0];?></div>
      </div></td>
    </tr>
    <?php  }}?>
  </table>
  <p align="center">&nbsp;</p>
  <p>
    
  </p>
  <p>&nbsp;</p>
</form>
<p>&nbsp; </p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
</body>
</html>
