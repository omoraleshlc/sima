<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?PHP include("/configuracion/funciones.php"); ?>
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

$ali=$ALMACEN;
$sSQL6= "Select * From listaOC WHERE entidad='".$entidad."' AND nRequisicion='".$_POST['ordenesActivas']."' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
if($myrow6['id_proveedor']){
$_POST['id_proveedor']=$myrow6['id_proveedor'];
}


if($_POST['solicitar'] AND $_POST['request'] and $_POST['id_proveedor'] ){


$codigo=$_POST['request'];
$cantidad=$_POST['cantidad'];
$code1=$_POST['codigoAlfa'];
$banderaCantidad=$_POST['banderaCantidad'];
$oc=$_POST['oc'];







for($i=0;$i<$_POST['pasoBandera'];$i++){

$sSQL2= "Select sum(cantidadComprar) as acumulado From OC WHERE 
entidad='".$entidad."' and
codigo= '".$code1[$i]."' and status='solicita' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);



$sSQL3= "Select * From existencias WHERE 
entidad='".$entidad."' AND
codigo= '".$code1[$i]."' and almacen='".$ali."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($myrow2['acumulado']<=$myrow3['maximo']){



if($_POST['ordenesActivas']){


$requisicion=$_POST['ordenesActivas'];
}else {
$sSQL1= "Select max(nRequisicion)+1 as Requisicion From listaOC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$requisicion=$myrow1['Requisicion'];

} 

if(!$requisicion){
$requisicion=1;
}

$sSQL6= "Select * From existencias WHERE codigo= '".$code1[$i]."' and almacen='".$ali."' ";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);

if($cantidad[$i]<=$myrow6['maximo']){

$s=$banderaCantidad[$i]+1;
if( $ali and $cantidad[$i] ){//validacion de almacen

if($code1[$i]){//validacion de cantidad



$agregaSaldo = "INSERT INTO OC ( codigo,id_almacen,usuario,fecha,hora,ID_EJERCICIO,cantidadComprar,status,id_requisicion,prioridad,statusCompras,id_proveedor,entidad
) values ('".$code1[$i]."','".$ali."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$cantidad[$i]."','solicita','".$requisicion."',
'".$_POST['prioridad']."','comprar','".$_POST['id_proveedor']."','".$entidad."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
$estado="insertado";
$leyenda="Se generó o se actualizó la órden de compra: ".$requisicion;
}//cierra validacion de cantidad
}//cierra validacion del almacen


}else {//excede el maximo
$estado="";
echo '<script type="text/vbscript">
msgbox "LA CANTIDAD QUE ESTAS SOLICITANDO EXCEDE EL MAXIMO PERMITIDO DE EXISTENCIAS DEL ALMACEN!!"
</script>';
}//for
}else{
$leyenda="ESTAS SUPERANDO EL LIMITE DE COMPRAS, AJUSTA TU MAXIMO SI QUIERES SEGUIR!!";


}
} 



if($estado=='insertado'){
?>
<script type="text/vbscript">

msgbox "SE GENERO/ACTUALIZO LA ORDEN DE COMPRA: <?php echo $requisicion;?>"
</script>
<?php 
//Checo si existe ya la requisicion
$sSQL= "Select * From listaOC WHERE entidad='".$entidad."' and nRequisicion= '".$requisicion."'";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if(!$myrow['nRequisicion']){
$agregaReq = "INSERT INTO listaOC ( nRequisicion,id_almacen,usuario,fecha,hora,ID_EJERCICIO,prioridad,status,id_proveedor,entidad
) values ('".$requisicion."','".$ali."',
'".$usuario."','".$fecha1."','".$hora1."','".$ID_EJERCICIOM."','".$prioridad."','solicita','".$_POST['id_proveedor']."','".$entidad."')";
mysql_db_query($basedatos,$agregaReq);
echo mysql_error();
}
}




}






if($_GET['id_requisicion'] AND $_GET['elimina']=='yes'){


//for($i=0;$i<=$_POST['pasoBandera'];$i++){
$remover = "update listaOC
set
status='cancelado'
where 
entidad='".$entidad."' and
nRequisicion='".$_GET['id_requisicion']."' and id_almacen ='".$ali."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();
$remover = "update OC 
set
status='cancelado'
where 
entidad='".$entidad."' and
id_requisicion='".$_GET['id_requisicion']."' and id_almacen ='".$ali."'";
mysql_db_query($basedatos,$remover);
echo mysql_error();


//}
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

<h1 align="center">Generar una OC directa </h1>
<form id="form2" name="form2" method="post" action="">
  <table width="726" border="0" align="center">
    <tr>
      <th width="25" bgcolor="#FFCCFF" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="54" bgcolor="#FFCCFF" class="style7" scope="col"><div align="left"><span class="Estilo24">Art&iacute;culo </span></div></th>
      <th width="625" bgcolor="#FFCCFF" class="style7" scope="col"><div align="left"><span class="Estilo24">
        <input name="nomArticulo" type="text" class="Estilo24" id="nomArticulo" size="80" 
		  
		  value="<?php if($_POST['nomArticulo']){ echo $_POST['nomArticulo']; }?>"/>
        </span><span class="Estilo24">
          </select>
      </span></div></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th class="style7" scope="col"><div align="left">Proveedor:</div></th>
      <th class="style7" scope="col"><div align="left">
        <input name="id_proveedor" type="text" class="Estilo24" id="id_proveedor"   readonly=""
		value="<?php if($_POST['id_proveedor']){ echo $_POST['id_proveedor'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        <span class="Estilo24">
          <input name="agregarCargos3" type="submit" class="Estilo24" id="agregarCargos3"  onclick="javascript:ventanaSecundaria1(
		'/sima/cargos/agregarProveedores.php?campoDespliega=<?php echo "nomProveedor"; ?>&amp;forma=<?php echo "form2"; ?>&amp;campoProveedor=<?php echo "id_proveedor"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="P">
      </span><span class="Estilo24">

	   <input name="nomProveedor" type="text" class="Estilo24" id="nomProveedor" size="80" 
		  
		  value="<?php  echo $_POST['nomProveedor']; ?>"  readonly=""/>
 
		
      </span><span class="Estilo24">
     
      </span><span class="Estilo24">
     
      </span></div></th>
    </tr>
    <tr>
      <th bgcolor="#FFCCFF" scope="col">&nbsp;</th>
      <th bgcolor="#FFCCFF" class="style7" scope="col"><div align="left"><em>OC Activas</em></div></th>
      <th bgcolor="#FFCCFF" class="style7" scope="col"><div align="left"><em>
        <?php 
   
   $aCombo= "Select * From listaOC where entidad='".$entidad."' and status='solicita' order by nRequisicion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="ordenesActivas" class="Estilo24" id="ordenesActivas" onChange="javascript:this.form.submit();"/>
        
    
        <?php if($_POST['ordenesActivas']){ ?>
        <option value="<?php echo $_POST['ordenesActivas'];?>"><?php echo $_POST['ordenesActivas'];?></option>
        <option value="">---</option>
        <?php }?>
        <option value="0">Nueva OC</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 

		?>
        <option value="<?php 	
		echo $resCombo['nRequisicion']; 
		
		?>">
          <?php 	
		echo $resCombo['nRequisicion']; 
		
		?>
          </option>
        <?php } ?>
        </select>
      </em></div></th>
    </tr>
    <tr>
      <th height="24" scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><div align="left">
	  <input name="buscar" type="submit" class="Estilo24" id="buscar" value="buscar" 
	  <?php if(!$_POST['id_proveedor']){
	  //echo 'disabled="disabled"';
	  }?>
	  />
          <?php if($_POST['nomArticulo']==='*'){ ?>
          <span class="style18">Este proceso puede demorar varios minutos...</span>
          <?php } ?>
          <input name="nomPoveedor" type="hidden" id="nomPoveedor" value="<?php echo $_POST['nomProveedor']; ?>" />
      </div>
      </label></th>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
</form>
<p align="center" class="style19"><?php echo $leyenda;?>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <div align="center"></div>
  <table width="645" border="0" align="center">
    <tr>
      <th width="54" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="337" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="17" bgcolor="#660066" scope="col"><span class="style11">UM</span></th>
      <th width="27" bgcolor="#660066" scope="col"><span class="style11">Existe</span></th>
      <th width="36" bgcolor="#660066" scope="col"><span class="style11">M&aacute;ximo</span></th>
      <th width="36" bgcolor="#660066" scope="col"><span class="style11">Reorden</span></th>

      <th width="41" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
      <th width="32" bgcolor="#660066" scope="col"><span class="style11">Solicita</span></th>
      <th width="27" bgcolor="#660066" scope="col"><span class="style11">Status</span></th>
    </tr>
    <tr>
<?php	

if(!$requisicion){
$requisicion=$_POST['ordenesActivas'];
}

if($_POST['nomArticulo']){
$articulo=$_POST['nomArticulo'];
$sSQL18= "
SELECT 
*
FROM
articulos,existencias
WHERE 
articulos.entidad='".$entidad."' AND
existencias.almacen='".$ALMACEN."' 
and
existencias.codigo=articulos.codigo 
and
(articulos.descripcion LIKE '%$articulo%' or articulos.descripcion1 LIKE '%$articulo%' )
order by existencias.codigo 
";
$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$disponible=$myrow18['existencia']-$myrow18['reorden'];
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


$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);


//*********************************************************************************************************
$sSQL8= "
SELECT 
*
FROM
existencias
WHERE 
existencias.entidad='".$entidad."' AND
existencias.almacen='".$ALMACEN."' 
and

existencias.existencia >=existencias.reorden
and 
existencias.reorden is not null 
and 
existencias.reorden <>'0'
and 
existencias.codigo='".$code1."'

order by existencias.codigo ASC
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

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7"><?php echo $code1?></span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><span class="Estilo24">
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $code1; ?>" />
        <span class="<?php echo $estilo;?>">
        <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
      </span> </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
 
       
<?php 
	  if($myrow7['um']){
	  echo $myrow7['um'];
	  } else {
	  echo "Sin UM";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['existencia']>0){
	  echo $myrow18['existencia'];
	  } else {
	  echo "Sin Existencia";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['maximo']){
	  echo $myrow18['maximo'];
	  } else {
	  echo "Sin Máximo";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow18['reorden']){
	  echo $myrow18['reorden'];
	  } else {
	  echo "Sin Reorden";
	  }
	 
		?>
      </span></td>
	  

		
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label></label>
        <span class="Estilo24">
        <input name="cantidad[]" type="text" class="style7" id="cantidad[]" value="0" size="3" maxlength="3" onKeyPress="return checkIt(event)"/>
        <input name="cantidadBandera[]" type="hidden" id="cantidadBandera[]" value="<?php echo $b; ?>" />
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style7">
        <input name="request[]" type="checkbox" id="request[]" value="<?php echo $code1?>"
	 />
      </span></span></td>
      

	  
	  <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24">
        <?php if(	  !$myrow17['id_requisicion']){ ?>
        <img src="sinSolicitar.png" alt="No se ha generado una requisicion para este art&iacute;culo" width="23" height="23" />
        <?php } else { ?>
        <img src="solicitado.png" alt="Ya tiene una requisicion" width="23" height="23" />
        <?php } ?>
      </span></td>
    </tr>
    <?php  }}} //cierra while ?>
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

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    <input name="solicitar" type="submit" class="style12" id="solicitar" value="Solicitar/Actualizar"    <?php if(!$_POST['id_proveedor']){
	  echo 'disabled="disabled"';
	  }?>/>
    </label>
    <label></label>
    <input name="nomArticulo" type="hidden" id="nomArticulo" value="<?php echo $_POST['nomArticulo']; ?>" />
    <input name="nomArticulo2" type="hidden" id="nomArticulo2" value="<?php echo $_POST['nomArticulo']; ?>" />
  </p>
  <p align="center">
    <input name="id_proveedor" type="hidden" id="id_proveedor" value="<?php echo $_POST['id_proveedor']; ?>" />
    <input name="ordenesActivas" type="hidden" id="ordenesActivas" value="<?php echo $_POST['ordenesActivas']; ?>" />
    <input name="nomPoveedor" type="hidden" id="nomPoveedor" value="<?php echo $_POST['nomProveedor']; ?>" />
  </p>
</form>
</body>
</html>