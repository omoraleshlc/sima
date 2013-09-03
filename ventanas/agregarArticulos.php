<?php require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); ?>
<? 
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
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php 




if($_POST['actualizar']){

if($_POST['fechaInicial'] and $_POST['fechaFinal']){

$cantidad=$_POST['cantidad'];
$code=$_POST['codigo'];


		for($i=0;$i<=$_POST['flag'];$i++){





if($code[$i]){
$sql5b= "
SELECT *
FROM
articulos
WHERE
entidad='".$entidad."' AND
codigo ='".$code[$i]."'

";
$result5b=mysql_db_query($basedatos,$sql5b);
$myrow5b= mysql_fetch_array($result5b);

$sql5= "
SELECT *
FROM
articulosPaquetes
WHERE
entidad='".$entidad."' AND
codigoPaquete =  '".$_POST['codigoPaquete']."'
and
codigo ='".$code[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
echo mysql_error();

if($myrow5['codigo']){
$sql="Update articulosPaquetes
set
cantidad='".$cantidad[$i]."', 
usuario='".$usuario."'
where 
entidad='".$entidad."' AND
codigoPaquete =  '".$_POST['codigoPaquete']."'
and
codigo ='".$code[$i]."' 
";
//mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='YA EXISTE ESE REGISTRO';
} else {

$agrega = "INSERT INTO articulosPaquetes (
codigo,codigoPaquete,almacen,fecha,fechaInicial,fechaFinal,usuario,entidad,cantidad,descripcionArticulo)
values ('".$code[$i]."','".$_POST['codigoPaquete']."','".$_POST['almacenDestino1']."','".$fecha1."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$entidad."','".$cantidad[$i]."','".$myrow5b['descripcion']."')";
mysql_db_query($basedatos,$agrega);
$leyenda='Registro Agregado';
echo mysql_error();

}
			}//cierra if

		}//cierra for



} else {
echo '<blink>'.'Te falta poner las fechas'.'</blink>';
}

}
?>





<?php 

if($_POST['keyE'] and $_POST['eliminar']){

$keyE=$_POST['keyE'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyE[$i]){
$borrame = "DELETE FROM articulosPaquetes WHERE keyE='".$keyE[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda= "Se eliminaron registro(s) del paquete";
}
}
if(!$_POST['almacenDestino1']){
$_POST['almacenDestino1']=$_POST['almacenDestino11'];
}
echo '<script language="JavaScript" type="text/javascript">
  <!--
   //window.opener.document.forms["form2"].submit();
    //self.close();
  // -->
</script>';
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span >
<?php  
$sSQL23= "Select * From clientes WHERE entidad='".$entidad."' and numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'];

?> </span><span ><?php echo $leyenda; ?></span></p>
<form id="form2" name="form2" method="post" action="" >
 
<table width="482" class="table-forma">
  <tr >
    <td height="37" scope="col">&nbsp;</td>
    <td width="75" scope="col"><div align="left" >Departamento</div></td>
    <td width="392" scope="col"> <div align="left">
      <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style12',$almacenSolicitante,$almacenDestino,$basedatos);
?>
    </div></td>
  </tr>
  <tr >
    <?php if(!$_POST['gpoProducto']){ ?>
    <td width="1" scope="col">&nbsp;</td>
    <td scope="col"><div align="left" >Mini Almac&eacute;n </div></td>
    <td scope="col"><div align="left">
      <?php 
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$_POST['almacenDestino'];
} 



$comboAlmacen1->despliegaMiniAlmacenSS($entidad,'style12',$almacenDestino,$almacenDestino,$basedatos);

?>
    </div></td>
    <?php } ?>
  </tr>
  <tr >
    <td width="1" scope="col">&nbsp;</td>
    <td><div align="left" >Fecha Inicial :</div></td>
    <td><div align="left">
      <label>
        <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
        </label>
      <input name="button" type="image"  id="lanzador" value="..." src="/sima/imagenes/btns/fecha.png" />
    </div></td>
  </tr>
  <tr >
    <td scope="col">&nbsp;</td>
    <td><div align="left" >Fecha Final </div></td>
    <td><label>
      <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
    </label>
      <input name="button1" type="image"  id="lanzador1" value="..." src="/sima/imagenes/btns/fechadate.png"/></td>
  </tr>
  <tr >
    <td width="1" scope="col">&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="left">
      <label></label>
      <label></label>
      <label></label>
      <input name="buscar" type="submit"  id="actualizar" value="Buscar" />
    </div></td>
  </tr>
</table>

<p>&nbsp;</p>

<?php 

if($_POST['buscar'] or $_POST['almacenDestino1']){ ?>
<table width="800" class="table table-striped">
      <tr >
        <th width="51"  scope="col"><div align="left"><span >#</span></div></th>
        <th width="314"  scope="col"><div align="left"><span >Descripci&oacute;n</span></div></th>
        <th width="67"  scope="col"><div align="left"><span >Fecha Inicial </span></div></th>
        <th width="55"  scope="col"><span >Fecha Final</span></th>
        <th width="71"  scope="col"><div align="left"><span >P. Particular </span></div></th>
        <th width="56"  scope="col"><div align="left"><span >IVA</span></div></th>
        <th width="34"  scope="col"><div align="left"><span >Paquete</span></div></th>
        <th width="30"  scope="col"><div align="left"><span >Quitar</span></div></th>
        <th width="27"  scope="col"><div align="left"><span >Status</span></div></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
articulos.gpoProducto as grupo,articulos.codigo as codigo1,articulosPrecioNivel.nivel1,articulosPrecioNivel.nivel3,articulos.descripcion,articulos.keyPA
FROM
articulos,articulosPrecioNivel
WHERE 
articulos.codigo=articulosPrecioNivel.codigo
and
articulos.entidad='".$entidad."'
and
articulosPrecioNivel.almacen='".$_POST['almacenDestino1']."' 
and
articulos.activo='A'
group by articulosPrecioNivel.codigo
order by articulos.descripcion ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result!=NULL){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;


if($col){
$color = '#FFCCFF';
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
*
FROM
articulosPaquetes
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow['codigo1']."'
and
codigoPaquete='".$_GET['codigoPaquete']."'
and
almacen='".$_POST['almacenDestino1']."' 
";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$sSQL40= "
SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$myrow['codigo1']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL40b= "
SELECT *
FROM
gpoProductos
where 
codigoGP='".$myrow40['gpoProducto']."'";
$result40b=mysql_db_query($basedatos,$sSQL40b);
$myrow40b = mysql_fetch_array($result40b);
?>
      <td  bgcolor="<?php echo $color?>" ><span >
          <label> <span >
          <?php 
	
		  $a;
         
		  ?>
		  </span>
		  <?php  echo $a; ?>
        </label>
        </span></td>
        <td bgcolor="<?php echo $color?>" ><span >
                <?php 
					echo $myrow['descripcion'].' '.$gpoProducto;
		?>
        </span></td>
        <td bgcolor="<?php echo $color?>" >
          <?php 
	
		echo $myrow3['fechaInicial'];
         
		  ?>       </td>
        <td bgcolor="<?php echo $color?>" >
          <?php 
	
		echo $myrow3['fechaFinal'];
         
		  ?>     </td>
        <td bgcolor="<?php echo $color?>" ><?php echo "$".number_format($myrow['nivel1'],2);
         
		  ?></td>
        <td bgcolor="<?php echo $color?>" >
          <?php 
		  $iva=new articulosDetalles();
  
		  echo "$".number_format($iva->iva($entidad,"1",$C,$myrow['nivel3'],$basedatos),2);
         
		  ?>        </td>
        <td bgcolor="<?php echo $color?>" ><label>
		<?php if($myrow3['codigo']){ 
		echo '---';
		} else {
		?>
		
		<?php 
                
                if($myrow40b['afectaExistencias']!='si'){?>
          <input name="codigo[]" type="checkbox" id="paquete" value="<?php echo $myrow['codigo1'];?>" />
                <?php }else{ echo '---';}?>
		  <?php } ?>
		  
        </label></td>
        <td bgcolor="<?php echo $color?>" >
		<?php if(!$myrow3['codigo']){ 
		echo '---';
		} else {
		?>
		<input name="keyE[]" type="checkbox" id="keyE[]" value="<?php echo $myrow3['keyE']; ?>" />
		 <?php } ?>		</td>
        
		<td bgcolor="<?php echo $color?>" >
		<?php if($myrow3['codigo']){ ?>
		<img src="/sima/imagenes/solicitado.png" alt="Almacenes" width="12" height="12" border="0" />
		<?php } else { ?>
		<img src="/sima/imagenes/candado.png" alt="Almacenes" width="12" height="12" border="0" />
		<?php } ?>		</td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
  </table>
  <p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em></p>
    <p align="center">
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualiza" value="Agregar a <?php echo $nombreSeguro?>" />
      <input name="eliminar" type="submit"  id="eliminar" value="Eliminar art&iacute;culos" />
      </label>
    </p>
    <?php 
	
	
	} else {
	echo "No se encontraron convenios...";
	}
	
	?>

    <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />

    <input name="seguro" type="hidden" id="seguro"  value="<?php echo $numCliente; ?>" />
    
    <input name="codigoPaquete" type="hidden" id="codigoPaquete"  value="<?php echo $_GET['codigoPaquete']; ?>" />
</form>
  <p></p>
  <br>
  <br>
  
</body>
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
	<?php } ?>
</html>
