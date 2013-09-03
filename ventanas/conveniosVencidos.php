<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 




if($_POST['actualizar']){

$keyConvenios=$_POST['keyConvenios'];

		for($i=0;$i<=$_POST['bandera'];$i++){





if( $keyConvenios[$i]){

$sql="Update convenios
set
fechaFinal='".$_POST['fechaFinal']."',
fechaModificacion='".$fecha1."',

usuario='".$usuario."'
where 
keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';
}
} ?>
<script>
window.opener.document.forms["form2"].submit();
window.close();
</script>
<?php 
}
?>








 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style11 {color: #000; font-size: 14px; font-weight: normal; }
.style7 {font-size: 14px}
.Estilo24 {font-size: 14px}
.style15 {color: #000}
.style13 {color: #000}
.style16 {font-size: 14px}
.style16 {font-size: 14px}
.style16 {font-size: 14px}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span class="style15">
<?php  
$sSQL23= "Select * From clientes WHERE numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'];

?></span></p>
<p align="center"><span class="style15"><?php echo $leyenda; ?></span></p>
<form id="form2" name="form2" method="post" action="" >
<table width="203" border="0" align="center" class="Estilo24">
  <tr bgcolor="#FFFFFF">
    <th scope="col">&nbsp;</th>
    <td width="71"><div align="left" class="style13">Fecha Final </div></td>
    <td width="116"><label>
      <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlength="9" readonly=""
		  value="<?php
		 if(!$_POST['fechaFinal']){
		 echo $fecha1;
		 }
		 ?>"/>
    </label>
      <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <th width="2" scope="col">&nbsp;</th>
    <td>&nbsp;</td>
    <td><div align="left">
      <label></label>
      <label></label>
      <label></label>
    </div></td>
  </tr>
</table>

<p><table width="200" border="0" align="center">
  <tr>
    <td align="center"><input name="actualizar" type="submit" id="actualiza" value="Actualizar T" /></td>
  </tr>
</table>
&nbsp;</p>
<img src="../imagenes/bordestablas/borde1.png" width="657" height="24" />
<table width="657" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <th width="206" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Deprtamento</span></div></th>
        <th width="259" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Servicio</span></div></th>
        <th width="86" bgcolor="#FFFF00" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Fecha Inicial </span></div></th>
        <th width="82" bgcolor="#FFFF00" class="Estilo24" scope="col"><span class="style11 style13">Fecha Final</span></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
* from convenios 
where
entidad='".$entidad."'
and
numCliente='".$_GET['numCliente']."'
and
fechaFinal<='".$fecha1."'
and
departamento!=''
order by 
departamento ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);


while($myrow = mysql_fetch_array($result)){ 



if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$gpoProducto=$myrow['grupo'];

$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$sSQL3= "
	SELECT 
codigo,costo,keyConvenios,fechaInicial,fechaFinal
FROM
convenios
WHERE 
numCliente='".$_GET['numCliente']."'
and
departamento='".$_POST['almacenDestino1']."'
and
entidad='".$entidad."'
and
codigo='".$myrow['codigo1']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$sSQL34= "
	SELECT 
nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 

entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino1']."'
and
codigo='".$myrow['codigo1']."'";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);



$sSQL34a= "
	SELECT 
descripcion,codigo,keyPA
FROM
articulos
WHERE 

entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."' or codigo='".$myrow['codigo']."'";
$result34a=mysql_db_query($basedatos,$sSQL34a);
$myrow34a = mysql_fetch_array($result34a);



$sSQL34b= "
	SELECT 
descripcion
FROM
almacenes
WHERE 

entidad='".$entidad."'
and
almacen='".$myrow['departamento']."'";
$result34b=mysql_db_query($basedatos,$sSQL34b);
$myrow34b = mysql_fetch_array($result34b);
?>
        <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php 
		if($myrow34b['descripcion']){
		echo $myrow34b['descripcion'];
		}else{
		echo 'Ya no existe';
		}
		?>
          <input name="keyConvenios[]" type="hidden" id="keyConvenios[]"  value="<?php echo $myrow['keyConvenios']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color?>" class="style7"><span class="Estilo24">
          <?php 
				
					echo $myrow34a['descripcion'];
		?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="style7">
          <?php 
	
		echo $myrow['fechaInicial'];
         
		  ?>       </td>
        <td bgcolor="<?php echo $color?>" class="style7">
          <?php 
	
		echo $myrow['fechaFinal'];
         
		  ?>     </td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
  </table>
<img src="../imagenes/bordestablas/borde2.png" width="657" height="24" />
  <p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em><span class="style7">
    <input name="bandera" type="hidden" id="bandera"  value="<?php echo $bandera; ?>" />
  </span></p>
<p align="center">
      <label>
      <?php if($bandera>0){ ?>
      <?php } ?>
      </label>
    </p>


    </form>
  <p></p>
  

</body>
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
    </script> 
	
</html>
