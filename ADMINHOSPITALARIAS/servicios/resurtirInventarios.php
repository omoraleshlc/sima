<?php require('/configuracion/ventanasEmergentes.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=300,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<?php 


if($_GET['nOrden'] and !$_POST['send'] and !$_POST['solicitar']){

$q1 = "DELETE FROM solicitudesxAlmacen where nOrden='".$_GET['nOrden']."'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();

} 

?>





<?php



if($_POST['surtir'] and $_POST['cantidad'] ){

$keySIN=$_POST['keySIN'];
$cantidad=$_POST['cantidad'];





for($i=0;$i<$_POST['bandera'];$i++){

if($cantidad[$i]>0){ 



$sSQL3115y = "Select * From solicitudesxAlmacen WHERE keySIN='".$keySIN[$i]."' ";
$result3115y=mysql_db_query($basedatos,$sSQL3115y);
$myrow3115y = mysql_fetch_array($result3115y);



if($myrow3115y['cantidadFaltante']){
$disponible=$myrow3115y['cantidadSolicitada']-$myrow3115y['cantidadFaltante'];
if($cantidad[$i]<=$disponible){
//update
$actualiza = "update solicitudesxAlmacen 
set
cantidadFaltante='".$cantidad[$i]."'

where
keySIN='".$keySIN[$i]."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//************************VERIFICAR FALTANTES***********************
//Aqui se rompe el ciclo y se cuadra todo


//******************************************************************
//********************ACTUALIZO EXISTENCIAS******************
  $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidad[$i]."'

WHERE 
entidad='".$entidad."' AND
codigo='".$myrow3115y['keyPA']."' 
AND 
almacen = '".$myrow3115y['almacenDestino']."'";

mysql_db_query($basedatos,$q);
echo mysql_error();
//************************************************************
}else{
echo 'La cantidad debe ser menor!';
}

}else{
if($myrow3115y['cantidadSolicitada']>$cantidad[$i]){ 
$actualiza = "update solicitudesxAlmacen 
set
cantidadFaltante='".$cantidad[$i]."'
where
keySIN='".$keySIN[$i]."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//********************ACTUALIZO EXISTENCIAS******************
  $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidad[$i]."'

WHERE 
entidad='".$entidad."' AND
codigo='".$myrow3115y['keyPA']."' 
AND 
almacen = '".$myrow3115y['almacenDestino']."'";

mysql_db_query($basedatos,$q);
echo mysql_error();
//************************************************************
}else if($myrow3115y['cantidadSolicitada']==$cantidad[$i]){
$actualiza = "update solicitudesxAlmacen 
set
cantidadFaltante=NULL,
status='surtido'
where
keySIN='".$keySIN[$i]."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//********************ACTUALIZO EXISTENCIAS******************
  $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidad[$i]."'

WHERE 
entidad='".$entidad."' AND
codigo='".$myrow3115y['keyPA']."' 
AND 
almacen = '".$myrow3115y['almacenDestino']."'";

mysql_db_query($basedatos,$q);
echo mysql_error();
//************************************************************
//************************VERIFICAR FALTANTES***********************
//Aqui se rompe el ciclo y se cuadra todo


//******************************************************************
}
}

}




}



}

?>








<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.Estilo24 {font-size: 10px}
.style18 {font-size: 10px; font-style: italic; }
.style19 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<h1 align="center">&nbsp;</h1>
<h1 align="center">Resurtir Inventarios </h1>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="831" border="0" align="center">
    <tr>
      <th width="53" bgcolor="#660066" scope="col"><div align="center"><span class="style11">keySIN</span></div></th>
      <th width="351" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Descripci&oacute;n</span></div></th>
      <th width="78" bgcolor="#660066" scope="col"><div align="center"><span class="style11">gpoProducto</span></div></th>
      <th width="43" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Status</span></div></th>
      <th width="57" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Solicitada</span></div></th>
      <th width="65" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Faltante</span></div></th>
      <th width="88" bgcolor="#660066" scope="col"><div align="center"><span class="style11">surtir</span></div></th>
      <th width="62" bgcolor="#660066" scope="col"><div align="center"><span class="style11">Cancel</span></div></th>
    </tr>
    <tr>
<?php	



$sSQL18= "
SELECT 
*
FROM
solicitudesxAlmacen
WHERE 
nOrden='".$_GET['nOrden']."'
and
status!='surtido'
";
$result18=mysql_db_query($basedatos,$sSQL18);
while($myrow18 = mysql_fetch_array($result18)){


$b+='1';
$a+='1';

$codigo=$code1=$myrow18['codigo'];


if(!$descripcion){
$descripcion="No existen estos artículos o están inactivos";
}

$sSQL17= "Select * From OC WHERE codigo= '".$code1."' 
and status='solicita' order by keyR DESC
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);




//*********************************************************************************************************
$sSQL8= "
SELECT 
*
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow18['gpoProducto']."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);

if($col){
$color = '#FFCCFF';
$col = "";

} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL8a= "
SELECT 
*
FROM
articulos
WHERE 
keyPA='".$myrow18['keyPA']."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7"><?php echo $myrow18['keySIN'];?>
        <input name="keySIN[]" type="hidden" id="keySIN[]" value="<?php echo $myrow18['keySIN'];?>" />
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><span class="Estilo24"><span class="<?php echo $estilo;?>">
        <?php 
					echo $myrow8a['descripcion'];
		
		?>
      </span> </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><?php echo $myrow8a['gpoProducto'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><?php echo $myrow18['status'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="Estilo24"><?php echo $myrow18['cantidadSolicitada'];?></span></div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="Estilo24"><?php echo $myrow18['cantidadFaltante'];?></span></div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="Estilo24"><span class="style7">
          <?php if($myrow18['status']!='request'){ ?>
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="0" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        <?php } else { ?>
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="0" size="3" maxlength="3"  readonly=""/>
        <?php } ?>
        
      </span></span></div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <?php if($myrow18['status']=='standby'){ ?>
        <span class="Estilo24"> <a   href="resurtirInventarios.php?keyF=<?php echo $myrow18['keyF'];?>&actualizar=<?php echo $actualizar;?>&nOrden=<?php echo $_GET['nOrden'];?>"> <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else{ echo '---';}  ?>
        </span></span></td>
    </tr>
    <?php  } //cierra while ?>
  </table>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div align="center"><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
    <label>
    <input name="surtir" type="submit" class="style12" id="surtir" value="Surtir"    <?php if(!$a>0){
	  echo 'disabled="disabled"';
	  }?>/>
    </label>
    <label></label>
    <span class="style7">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
  </span>
    <label></label>
  </p>
</form>
</body>
</html>