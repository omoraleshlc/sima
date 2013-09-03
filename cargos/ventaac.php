<?php require("/configuracion/ventanasEmergentes.php");require('/configuracion/funciones.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=300,scrollbars=YES") 
} 
</script> 








<?php



if($_POST['solicitar'] and $_POST['keyPA'] ){

$keyPA=$_POST['keyPA'];
$cantidad=$_POST['cantidad'];


$sSQL8aa= "
SELECT max(nOrden)+1 as n
FROM
solicitudesDepartamentos
WHERE
entidad='".$entidad."'
  ";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
$n= $myrow8aa['n']; 
if(!$n){
    $n=1;
}


$agrega = "INSERT INTO solicitudesDepartamentos (
usuario,almacen,entidad,fecha,hora,nOrden,status
) values (
'".$usuario."','".$_GET['almacen']."','".$entidad."','".$fecha1."','".$hora1."'
    ,'".$n."','request'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


for($i=0;$i<$_POST['bandera'];$i++){







if($keyPA[$i]>0 and $cantidad[$i]>0){

$sSQL8aa= "Select * From articulos WHERE keyPA= '".$keyPA[$i]."'  ";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
//


for($j=0;$j<$cantidad[$i];$j++){
$agrega = "INSERT INTO movSolicitudes (
codigo,keyPA,gpoProducto,fecha,hora,usuario,entidad,cantidad,descripcion,tipoMov,
keyCAP,nOrden,almacen,status
)
values
(
'".$myrow8aa['codigo']."','".$myrow8aa['keyPA']."','".$myrow8aa['gpoProducto']."',
    '".$fecha1."','".$hora1."','".$usuario."',
        
'".$entidad."','1','".$myrow8aa['descripcion']."',
    'salida','".$myrow8aa['keyCAP']."','".$n."' ,'".$_GET['almacen']."','request'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

//
}
}

?>
<script>
window.alert("Se genero el numero de solicitud: <?php echo $n;?>");
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php
}
?>









<script type="text/javascript">

function comprueba()
{
if (confirm('Estas seguro que deseas enviar la orden ?')) return true;
return false;
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<h1 >Almacen de Consumo </h1>
<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;<em>Almacen</em>
<?php 
	

	
	
$aCombo= "Select * From almacenes where entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'
";
$rCombo=mysql_db_query($basedatos,$aCombo);
$resCombo = mysql_fetch_array($rCombo);
echo  $resCombo['descripcion'];
?>
  </p>

  <table width="684" class="table table-striped">
        <tr >
      <th width="44" >#</th>
      <th width="43" >KeyPA</th>
      <th width="321" >Descripci&oacute;n</th>
      <th width="105"  >gpoProducto</th>
      <th width="45"  >Disponible</th>

      <th width="48"  >Cantidad</th>
    </tr>
    <tr>
<?php	



$sSQL18= "
SELECT 
*
FROM
existencias
WHERE 
entidad='".$entidad."' 
and
almacen='".$_GET['almacen']."'
order by descripcion ASC";
$result18=mysql_db_query($basedatos,$sSQL18);
while($myrow18 = mysql_fetch_array($result18)){
//echo $myrow18['cantidad'];

$b+=1;
$a+=1;


/* $sSQL7= "Select sum(cantidad)  as c From faltantes WHERE keyPA= '".$myrow18['keyPA']."' and almacenSolicitante='".$_POST['almacenDestino']."' and status='venta' and naturaleza='C'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d= "Select sum(cantidad)  as c From faltantes WHERE keyPA= '".$myrow18['keyPA']."' and almacenSolicitante='".$_POST['almacenDestino']."' and status='venta' and naturaleza='A'";
$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d); */


//*********************************************************************************************************




$sSQL8a= "
SELECT 
*
FROM
articulos
WHERE 
entidad='".$entidad."'
and
keyPA='".$myrow18['keyPA']."'

";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a); 

$sSQL8= "
SELECT 
*
FROM
gpoProductos
WHERE 
codigoGP='".$myrow8a['gpoProducto']."'
";
$result8=mysql_db_query($basedatos,$sSQL8);
$myrow8 = mysql_fetch_array($result8);



$cantidadSolicitada[0]+=$myrow8a['cantidadSolicitada'];
?>
    <tr  >
      <td  bgcolor="<?php echo $color?>" ><?php echo $a;?></td>
      <td bgcolor="<?php echo $color?>" ><?php echo $myrow18['keyPA'];?>
      <input name="keyPA[]" type="hidden" id="cantidadOriginal[]" value="<?php echo $myrow18['keyPA']; ?>" /></td>
      <td bgcolor="<?php echo $color?>" >
        <?php 
					echo $myrow18['descripcion'];
		
		?>      </td>
      <td bgcolor="<?php echo $color?>" ><?php echo $myrow8['descripcionGP'];?></td>
      <td bgcolor="<?php echo $color?>" >
<?php 
//ENtRADAS
  $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow18['codigo']."'
    and
    status='ready'
    and
    almacen='".$_GET['almacen']."'

";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);




echo $myrow8ac1e['entrada'];
?>
      </td>


      <td bgcolor="<?php echo $color?>" ><label>
        <input name="cantidad[]" type="text" id="cantidad[]" size="5"  />
      </label></td>
    </tr>
    <?php  } //cierra while ?>
  </table>
 
  <div align="center" ><strong>
    <?php if($a){ 
	echo "Vendiste $vendiste[0] articulos..!!"; 
	}else {
	echo "No hay Registros..!!";
	}
	?>
  </strong></div>
  <p align="center">
    <label>
    <input name="solicitar" type="submit"  id="solicitar" value="Solicitar/Actualizar"    <?php if(!$a>0){
	  echo 'disabled="disabled"';
	  }?>/>
    </label>
    <label></label>
    <span >
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
  </span></p>
  <p align="center">
    <label></label>
  </p>
 
</form>
</body>
</html>
