<?php include("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>













<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>















<?php
if($_POST['quitars'] and $_POST['extension']>0){
 $sqld = "DELETE FROM facturasAplicadas 
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>';
echo 'window.alert("Extension eliminada");';
echo '</script>';
}
?>









<?php 
if($_POST['asignar'] and $_POST['importe'] and $_POST['gpoProducto']){
$importe=$_POST['importe'];
$gpoProducto=$_POST['gpoProducto'];
$cantidadOriginal=$_POST['cantidadOriginal'];
$reservado=$_POST['reservado'];


for($i=0;$i<=$_POST['bandera'];$i++){








if($importe[$i]>0  ){
if(($cantidadOriginal[$i]-$reservado[$i])>=$importe[$i]){



 $sSQL3a= "Select * From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and gpoProducto='".$gpoProducto[$i]."' and extension='".$_POST['extension']."'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);

if($myrow3a['folioVenta']){
  $sqld = "UPDATE facturasAplicadas set 
status='extensionGrupos',
gpoProducto='".$gpoProducto[$i]." ',
importe='".$importe[$i]."',
porcentajeFacturacion='".$importe[$i]/$cantidadOriginal[$i]."'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
and
gpoProducto='".$gpoProducto[$i]."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
$leyenda= 'Se actualizo la extension';

$sqldd = "UPDATE clientesInternos set 

statusFactura='extension'
where
folioVenta='".$_GET['folioVenta']."'


";
mysql_db_query($basedatos,$sqldd);
echo mysql_error();
}else{
 $sqld = "INSERT INTO facturasAplicadas 
(entidad, 	numFactura ,	nT, 	usuario, 	fecha, 	hora, 	keyMov, 	keyCF, 	importe, 	seguro, 	folioVenta, 	status, 	porcentajeFacturacion, 	extension, 	RFC, gpoProducto)
values
('".$entidad."',0,0,'".$usuario."','".$fecha1."','".$hora1."',0,0,'".$importe[$i]."','".$myrow3['seguro']."','".$_GET['folioVenta']."','extensionGrupos', ' "  .$importe[$i]/$cantidadOriginal[$i]. " ','".$_POST['extension']."',0,'".$gpoProducto[$i]."')";
mysql_db_query($basedatos,$sqld);
echo mysql_error();


 $sqld = "UPDATE clientesInternos set 

statusFactura='extensionGrupos'
where
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
}


}
}
}




}
?>





<?php  
if($_GET['keyAPF'] AND $_GET['inactiva']){

	if($_GET['inactiva']=="inactiva"){
$q = "DELETE FROM facturasAplicadas 
		WHERE keyAPF='".$_GET['keyAPF']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} 


}
?>




<?php
if($_POST['extension']==0){
$_GET['extension']=0;
}
?>


<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  


  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
    
    
</head>



<BODY  >
<?php 
$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<h1 align="center" class="titulos">Facturaci&oacute;n por Extensiones por Grupos </h1>
<p align="center" class="negro">
<?php echo '<blink>'.$leyenda.'</blink>';?>
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left">Folio de Venta</div></th>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left">
        <label>
      <?php print $_GET['folioVenta'];?>
        </label>
        </label>
      </div>      </th>
    </tr>
    
    
    

    <tr>
      <th width="168" bgcolor="#330099" class="normal" scope="col"><div align="left" class="blancomid"><strong>Paciente</strong></div></th>
      <th width="407" bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Compa&ntilde;&iacute;a</td>
<td bgcolor="#FFFFFF" class="normalmid"><label> 
        <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">N&deg; Credencial</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left"><strong>M&eacute;dico</strong></div></th>
      <th bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left">
          <label></label>
          
          <?php 
$sSQL18= "Select descripcion From almacenes WHERE almacen='".$myrow3['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".$rNombre18['descripcion'];?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Fecha Internamiento</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print cambia_a_normal($myrow3['fecha']);?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Dx Entrada</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print $myrow3['dx'];?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Seguro</td>
      <td bgcolor="#FFFFFF" class="normalmid"><label><?php print $myrow3['seguro'];?></label></td>
    </tr>
  </table>
  <p align="center">Extensi&oacute;n
    <select name="extension" id="extension" onChange="this.form.submit();">
      <option
      <?php if($_POST['extension']=='0' or $_GET['extension']=='0')print 'selected="selected"';?>
       value="0">0</option>
      <option
      <?php if($_POST['extension']=='1' or $_GET['extension']=='1' )print 'selected="selected"';?>
       value="1">1</option>
      <option
      <?php if($_POST['extension']=='2'  or $_GET['extension']=='2' )print 'selected="selected"';?>
       value="2">2</option>
      <option
      <?php if($_POST['extension']=='3' or $_GET['extension']=='3')print 'selected="selected"';?>
       value="3">3</option>
      <option
      <?php if($_POST['extension']=='4' or $_GET['extension']=='4')print 'selected="selected"';?>
       value="4">4</option>
      <option
      <?php if($_POST['extension']=='5' or $_GET['extension']=='5')print 'selected="selected"';?>
       value="5">5</option>
      <option
      <?php if($_POST['extension']=='6' or $_GET['extension']=='6' )print 'selected="selected"';?>
       value="6">6</option>
      <option
      <?php if($_POST['extension']=='7' or $_GET['extension']=='7')print 'selected="selected"';?>
       value="7">7</option>
    </select>
  <a href="javascript:ventanaSecundaria5('ventanaAjustarExtensiones.php?entidad=<?php echo $entidad;?>&extension=<?php echo $_POST['extension'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');"></a></p>





<?php if($_POST['extension']==0 and !$_GET['extension']){ ?>
<p align="center">

  
  </p>
<table width="440" height="53" border="1" align="center" bordercolor="#FF0000">
    <tr bgcolor="#330099">
      <th width="142" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Ext</div>
      </div></th>

      <th width="297" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
        <div align="left">Grupo</div>
      </div></th>
      <th width="114" bgcolor="#330099" class="blanco" scope="col"><div align="left" class="blancomid">
          <div align="left">Importe</div>
      </div></th>
    </tr>
    
       
      
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">0</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  ---
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 
		

		

		echo "$".number_format($cargos,2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">1</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  <?php
$sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='1'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);	  

if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>      
      <td bgcolor="<?php echo $color;?>" class="normalmid">
<?php 
echo "$".number_format($myrow3ab['imp'],2);?>	      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">2</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='2'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);


if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">3</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">
	 <?php
	 $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='3'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	 ?>      
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">4</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">    
	  <?php
	  
	  $sSQL3ab= "Select sum(importe) as imp,gpoProducto From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='4'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);


if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
?>  
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">5</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">      
	  <?php
	  
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='5'";
	  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
	  $myrow3ab = mysql_fetch_array($result3ab);
	  
	  
	  if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">6</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">    
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='6'";
	  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
	  $myrow3ab = mysql_fetch_array($result3ab);
	  
if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 

echo "$".number_format($myrow3ab['imp'],2);?>      </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos"><div align="center">7</div></td>
      <td bgcolor="<?php echo $color;?>" class="normalmid">      
	  <?php
	  $sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='7'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);
	  
if($myrow3ab['gpoProducto']){
$sSQL1= "Select descripcionGP From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow3ab['gpoProducto']."' ";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  
	  echo $myrow1['descripcionGP'];
	  }else{
	  echo '---';
	  }
	  ?>
    <td bgcolor="<?php echo $color;?>" class="normalmid"><?php 


echo "$".number_format($myrow3ab['imp'],2);?>    </tr>
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color;?>" class="codigos">&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="right">Disponible:
      </div>
      <td bgcolor="<?php echo $color;?>" class="normalmid"><span class="codigos">
        <?php 

$sSQL3ab= "Select sum(importe) as imp From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

echo "$".number_format($cargos-$myrow3ab['imp'],2);?>
    </span>    </tr>
  </table>

<p>
  <?php } else{?>
</p>


    <table width="716" border="0" align="center">
      <tr>
        <th width="60" bgcolor="#660066" scope="col"><div align="left" class="blanco">Cod. GP</div></th>
        <th width="281" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n de Productos </div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Cantidad</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">facturar</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Reservado</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Disponible</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Status</div></th>
      </tr>
      <tr>
	  
	  <?php   
 $sSQL= "Select  * From gpoProductos where entidad='".$entidad."' ORDER BY activo='activo' DESC";
$result=mysql_db_query($basedatos,$sSQL); 




while($myrow = mysql_fetch_array($result)){
$bandera+=1;	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigoGP'];


$sSQL3a= "Select sum(importe) as io From facturasAplicadas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and gpoProducto='".$myrow['codigoGP']."' and status='extensionGrupos'";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


$sSQL3ad= "Select *,importe as io From facturasAplicadas WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and gpoProducto='".$myrow['codigoGP']."' and extension='".$_POST['extension']."' and status='extensionGrupos'";
$result3ad=mysql_db_query($basedatos,$sSQL3ad);
$myrow3ad = mysql_fetch_array($result3ad);

$sSQL3ad1= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as io From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and gpoProducto='".$myrow['codigoGP']."' and naturaleza='C'  ";
$result3ad1=mysql_db_query($basedatos,$sSQL3ad1);
$myrow3ad1 = mysql_fetch_array($result3ad1);

$sSQL3ad2= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as io From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' and gpoProducto='".$myrow['codigoGP']."' and naturaleza='A'  ";
$result3ad2=mysql_db_query($basedatos,$sSQL3ad2);
$myrow3ad2 = mysql_fetch_array($result3ad2);



$totalImporte[0]+=$myrow3ad['io'];
$err[0]+=$myrow3ad1['io']-$myrow3ad2['io'];
?>
        <td bgcolor="<?php echo $color?>" class="normal"><label> <?php echo $C?> </label>
            </span>
        <input type="hidden" name="gpoProducto[]"  value="<?php echo $C?>"/></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['descripcionGP'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo '$'.number_format($myrow3ad1['io']-$myrow3ad2['io'],2);?>
        <input name="cantidadOriginal[]" type="hidden" id="cantidadVendida" value="<?php echo $myrow3ad1['io']-$myrow3ad2['io']; ?>" /></td>
        <td bgcolor="<?php echo $color?>" class="normal"><input name="importe[]" type="text" id="importe[]" value="<?php echo $myrow3ad['io'];?>" size="8" maxlength="7" <?php if($err<1) echo 'readonly=""';?>  /></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo '$'.number_format($myrow3a['io'],2);?>
        <input name="reservado[]" type="hidden" id="cantidadOriginal[]" value="<?php echo $myrow3a['io']; ?>" /></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo '$'.number_format(($myrow3ad1['io']-$myrow3ad2['io'])-$myrow3a['io'],2);?></td>
        <td bgcolor="<?php echo $color?>" class="normal">
		<?php if($myrow3ad['io']>0){ ?>
		<a   href="facturaExtensionesGrupos.php?extension=<?php echo $_POST['extension']; ?>&inactiva=<?php echo'inactiva'; ?>&folioVenta=<?php echo $_GET["folioVenta"];?>&gpoProducto=<?php echo $myrow['gpoProducto'];?>&keyAPF=<?php echo $myrow3ad['keyAPF'];?>">
		<img src="/sima/imagenes/btns/checkbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas quitar este producto?') == false){return false;}" />		</a>
		<?php }else{ echo '---';}?>		</td>
      </tr>
      <?php }?>
    </table>
  <p align="center">&nbsp;</p>
<p align="center">Cantidad para esta extensi&oacute;n: 
    <label>

    </label>
  <?php echo '$'.number_format($err[0],2);?>  (incluye iva) </p>
  <p align="center">
    <label></label>
    <input type="submit" name="asignar" id="asignar" value="Asignar a Extension"/>
    <input type="submit" name="quitars" id="quitars" value="Quitar Extension" <?php if($myrow3ab['imp']==0){ echo 'disabled=""';}?>/>
  </p>
  
<?php } ?>



  <p align="center"><input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />

  </p>
</form>

<p align="center">
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
      <script>
		new Autocomplete("razonSocial", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/rfcx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>



