<?php require("menuOperaciones.php"); ?>


<script language=javascript> 
function ventana (URL){ 
   window.open(URL,"ventana","width=730,height=500,scrollbars=YES") 
} 
</script> 

<?php



if($_POST['request'] and $_POST['bandera'] and $_POST['keyR'] ){

$keyR=$_POST['keyR'];

for($i=0;$i<=$_POST['bandera'];$i++){




if($keyR[$i]){

$q1 = "UPDATE OC set 
status='aprobado'
WHERE keyR = '".$keyR[$i]."'
";
mysql_db_query($basedatos,$q1);
}
}
print 'Se hizo un movimiento...';
}




?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES") 
} 
</script> 

  
  
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>


<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings);
if(win.window.focus){win.window.focus();}
}

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos">Autorizar Ordenes de Compra </h1>
<p align="center" >  
</span></span></p>
<form id="form1" name="form1" method="post" action="">

  <table width="575" class="table table-striped">
    <tr >
      <th width="107" scope="col"><div align="center" >
        <div align="left"># Req</div>
      </div></th>
      <th width="240" scope="col"><div align="center" >
        <div align="left">Departamento</div>
      </div></th>
      <th width="52" align="center" scope="col"><div align="center" >
        <div align="left">Lista</div>
      </div></th>
      <th width="52" scope="col"><div align="center" >
        <div align="left">Usuario</div>
      </div></th>
      <th width="27" scope="col"><div align="center" ></div></th>
      <th width="71" scope="col"><div align="left"><span >Status</span></div></th>
    </tr>
    <tr>
<?php	

 $sSQL18= "
SELECT 
*
FROM
requisiciones
WHERE 
entidad='".$entidad."'
and
statusCompras='standby'

order by fecha ASC
";






$result18=mysql_db_query($basedatos,$sSQL18);


if($result18){
while($myrow18 = mysql_fetch_array($result18)){
$id_proveedor=$myrow18['id_proveedor'];


$a+=1;


if($myrow18['status']=='cancelado'){
$color='#FF0000';
$style='style11';
}else if($myrow18['status']=='aprobado'){
$color='#006600';
$style='style11';
} else {
if($col){
$color = '#FFCCFF';
$col = "";
$style='style12';
} else {
$color = '#FFFFFF';
$col = 1;
$style='style12';
}
}

$code1=$myrow18['codigo'];

$requisicion=$myrow18['id_requisicion'];
$id_almacen=$myrow18['id_almacen'];
$id_proveedor=$myrow18['id_proveedor'];
if(!$descripcion){
$descripcion="No existen estos articulos o estan inactivos";
}

$sSQL17= "Select razonSocial From proveedores WHERE id_proveedor='".$myrow18['id_proveedor']."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

$sSQL7= "Select * From articulos WHERE codigo= '".$code1."' ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL8= "Select descripcion From almacenes WHERE  almacen='".$myrow18['id_almacen']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);



?>
      <td height="24" bgcolor="<?php echo $color?>"  align="center">
      <label>
      <div align="left"><?php echo $myrow18['id_requisicion']; ?></div>
      </label></td>
      <td bgcolor="<?php echo $color?>" ><div align="left"><?php echo $myrow8['descripcion']; ?></div></td>
      <td bgcolor="<?php echo $color?>" class="<?php echo $style;?>"><div align="left"><a href="javascript:ventanaSecundaria('../ventanas/aprobarOC.php?keyR=<?php echo $myrow18['keyR']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"><img src="../imagenes/btns/printbtn.png" alt="Imprimir " width="22" height="20" border="0" /></a></div></td>
      <td bgcolor="<?php echo $color?>" class="<?php echo $style;?>"><div align="left"><span class="<?php echo $style;?>">
        
        
        <?php 
	 
	  echo $myrow18['usuario'];

	 
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color?>" >
	    <div align="left">
	      <?php if($myrow18['status']=='aprobado' or $myrow18['status']=='cancelado'){?>
	      ---
	      <?php } else { ?>
	      <input name="keyR[]" type="checkbox" id="keyR[]" value="<?php echo $myrow18['keyR'];?>" />
	      <?php } ?>
        </span></div></td>
      <td bgcolor="<?php echo $color?>" > <div align="left"><a href="javascript:nueva('../ventanas/ventanaCambiaStatus.php?keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&seguro=<?php echo $_POST['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&keyR=<?php echo $myrow18['keyR']; ?>&codigo=<?php echo $C; ?>&almacenDestino1=<?php echo $_GET['almacenDestino1'];?>','ventana','300','300','yes')"><?php echo $myrow18['statusCompras'];?>
      </a> </div></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>

<div align="center" ><strong>
    <?php if($a){ 
	echo "Se encontraron $a Registros..!!"; 

	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>
  <p align="center">
      <a> <input name="request" type="image" src="../imagenes/btns/aprobar.png" alt="Imprimir " width="30" height="30" border="0" id="request" value="Solicitar" />Aprobar orden </a>
    <label>
    	

    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
    </label>
    <label></label>

  <span >  </span></p>
  <p align="center"><a href="javascript:ventanaSecundaria('../ventanas/listadoOrdenesImpresion.php?id_requisicion=<?php echo $myrow1['numeroE']; ?>&amp;traspaso=<?php echo $traspaso; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"></a><a href="javascript:ventanaSecundaria('..ventanas/listadoOrdenesImpresion.php?id_requisicion=<?php echo $_POST['nRequisicion']; ?>&amp;id_proveedor=<?php echo $id_proveedor; ?>&amp;id_requisicion=<?php echo $requisicion; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $ali; ?>')"><img src="../imagenes/btns/printbutton.png" alt="Imprimir " width="34" height="34" border="0" />Imprimir</a></p>
</form>

</body>
</html>