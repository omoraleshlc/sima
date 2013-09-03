<?php require('/configuracion/ventanasEmergentes.php'); include('/configuracion/funciones.php');?>
<?php  
if($_GET['keyR'] ){


 $q = "delete from articulosMaquilados

		WHERE keyR='".$_GET['keyR']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();



}
?>
<?php 


if($_POST['send'] and !$_POST['modifica']){
/* $precioSugerido=$_POST['precioSugerido'];
$keyR=$_POST['keyR'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyR[$i]){

$q = "UPDATE OC set 

	status='capturado'
		WHERE keyR='".$keyR[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}

}
$link=new ventanasPrototype();
$mensaje=new ventanasPrototype();
$link->links();
$mensaje->despliegaMensaje('Se hizo una solicitud de compra'); */


?>
<script>

//window.close();
</script>

<?php 
}












if($_POST['descripcion'] and $_POST['keyPA'] and !$_POST['update'] and !$_POST['send']){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
keyPA='".$_POST['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


/* $agregaSaldo = "INSERT INTO articulosMaquilados( id_requisicion,id_almacen,usuario,fecha,hora,status,prioridad,id_proveedor,entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,cantidad,descripcionArticulo

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."','".$_POST['keyPA']."' ,'0.00','0.00','0' ,'".$myrow12['descripcion']."' )";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error(); */

$agregaSaldo = "INSERT INTO articulosMaquilados(codigo, id_almacen,cantidad,usuario,fecha,hora,status,entidad,keyPA,descripcionArticulo,keyPACOM) 
values 
(
'".$myrow12['codigo']."','".$_POST['almacenDestino1']."','1','".$usuario."','".$fecha1."','".$hora1."','request',
'".$entidad."','".$_POST['keyPA']."' ,'".$myrow12['descripcion']."' ,'".$_GET['keyPACOM']."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();

echo 'Articulos Agregados';

}
?>








<?php 
if($_POST['update'] ){ 
$keyR=$_POST['keyR'];
$descripcionArticulo=$_POST['descripcionArticulo'];
$cantidad=$_POST['cantidad'];
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){


/* codigo  	bigint(20)  	 	  	No  	None  	 	  Browse distinct values   	  Change   	  Drop   	  Primary   	  Unique   	  Index   	 Fulltext
	id_almacen 	varchar(255) 	latin1_swedish_ci 		No 	 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	cantidad 	int(11) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	usuario 	varchar(255) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	fecha 	varchar(255) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	hora 	varchar(255) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	status 	varchar(255) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	entidad 	varchar(255) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	keyPA 	bigint(20) 			No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	Fulltext
	descripcionArticulo 	varchar(254) 	latin1_swedish_ci 		No 	None 		Browse distinct values 	Change 	Drop 	Primary 	Unique 	Index 	 */

if($cantidad[$i]>0 ){
 $q = "UPDATE articulosMaquilados 
 set 
 cantidad='".$cantidad[$i]."'
  WHERE keyR='".$keyR[$i]."'";
	mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}
}

echo '<blink>'.'Se modificaron datos'.'</blink>';
}

?>
















<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['send']){
$keyR=$_POST['keyR'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
$keyPA=$_POST['keyPA'];

for($i=0;$i<=$_POST['bandera'];$i++){



if($keyR[$i]!=NULL){



$sSQL3a= "
	SELECT 
codigo,gpoProducto,descripcion
FROM
articulos
WHERE keyPA='".$keyPA[$i]."'";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);

$sSQL3= "
	SELECT 
porcentajeParticular,porcentajeAseguradora
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$myrow3a['gpoProducto']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
//*******************************



//***************************************
if($cantidad[$i]>0 and ($myrow3['porcentajeParticular']>0 and $myrow3['porcentajeAseguradora']>0) and $costo[$i] and $keyR[$i]  ){


$porcentajeParticular=($costo[$i]*$myrow3['porcentajeParticular'])/100;
$porcentajeAseguradora=($costo[$i]*$myrow3['porcentajeAseguradora'])/100;


if($keyPA[$i]){
$q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,cantidadParticular,cantidadAseguradora,descripcionArticulo)
values
('".$myrow3a['codigo']."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'standby'  ,'".$porcentajeParticular."' ,'".$porcentajeAseguradora."' ,'".$myrow3a['descripcion']."'  )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();




//********************ACTUALIZO EXISTENCIAS***********************

$q1a = "UPDATE existencias set 
almacen='".$_GET['departamento']."',
existencia=existencia+'".$cantidad[$i]."'
WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1a); 

}
}











}

} ?>
<script>
window.alert("Factura Enviada");
window.close();
</script>
<?php 
}
?>



















<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo4 {color: #FFFFFF; font-size: 12px; }
.Estilo5 {font-size: 12px}
-->
</style>
</head>

<body>


  <form id="form2" name="form2" method="post" action="">
    <p align="center">Agregar Art&iacute;culos al Producto</p>
    <p align="center"><span class="titulomed"><?php echo $_GET['descripcion'];?></span></p>
    <table width="522" border="0" cellspacing="0" cellpadding="0" align="center" style="border: 1px solid #000000;">
    <tr bgcolor="#FFFF00">
        <td colspan="2" class="normal" scope="col"><div align="center"></div></td>
        <?php 
	  
	  $sSQL12= "
	SELECT razonSocial
FROM
proveedores
WHERE 
entidad='".$entidad."'
and
id_proveedor='".$_GET['proveedor']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
	  ?>
      </tr>
      <tr>
        <th class="style12" scope="col"></th>
        <td class="style12">Almacen <span class="normalmid">
          <?php 
		  
 $aCombo= "Select * From almacenes
where
entidad='".$entidad."' 
and
maquila='si'

  
  order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>

        <option 
		<?php 
 if($_POST['almacenDestino1'] ==$resCombo['almacen']) { 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>


        </span></td>
      </tr>
      <tr>
        <th class="style12" scope="col"></th>
        <td class="style12">&nbsp;</td>
      </tr>
      <tr>
        <th class="style12" scope="col"></th>
        <td class="style12">&nbsp;</td>
      </tr>
      <tr>
        <th class="style12" scope="col"></th>
        <td class="style12">&nbsp;</td>
      </tr>
      
	  
	  <?php if($_POST['almacenDestino1']){ ?>
	  <tr>
	  
        <th class="style12" scope="col"></th>
        <td class="style12">Codigo
          <input name="keyPA" type="text" class="camposmid" id="keyPA"  readonly="" /></td>
      </tr>
      <tr>
        <th width="1" class="style12" scope="col"></th>
        <td class="style12"><span class="style19">
          <textarea name="descripcion" cols="60" class="camposmid" id="descripcion" onChange="this.form.submit();"></textarea>
        </span></td>
      </tr>
	  <?php } ?>
    </table>
	
	
    <p align="center">&nbsp;</p>
	
	<table width="497" border="0" align="center" class="Estilo5" style="border: 1px solid #000000;">
      <tr>
        <td width="68" height="19" class="Estilo5" scope="col"><div align="center" class="normal">
            <div align="left" class="normal">
              <div align="left">keyPA</div>
            </div>
        </div>
        </div></td>
        <td width="283" class="normal" scope="col"><div align="center" class="normal">
          <div align="left" class="normal">
            <div align="left">Descripci&oacute;n</div>
          </div>
        </div></td>
        <td width="80" class="normal" scope="col"><span class="normal">Cantidad</span></td>
        <td width="48" class="normal" scope="col"><div align="center" class="normal">
            <div align="center">Eliminar</div>
        </div></td>
      </tr>
<?php	
$sSQL= "SELECT  
* 
FROM articulosMaquilados
WHERE
entidad='".$entidad."'
and
keyPACOM='".$_GET['keyPACOM']."'

";


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






//*************
?><tr>




        

      <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
      <td height="21" bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow['keyPA'];?>
      <input type="hidden" name="keyR[]" id="keyR[]" value="<?php echo $myrow['keyR'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" class="normal">
		<?php 
		echo $myrow['descripcionArticulo']; 
		echo '<br>';
		
		if($myrow['status']=='notaCredito'){
		echo '<span class="codigos">[Nota de Credito]</span>';		
		}
		?></td>
      <td bgcolor="<?php echo $color;?>" class="normal">

		<input name="cantidad[]" type="text" id="cantidad[]" size="5" value="<?php echo $myrow['cantidad']; ?>"  autocomplete="off" />	  </td>
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="center"><a href="<?php echo $_SERVER['PHP_SELF'];?>?keyR=<?php echo $myrow['keyR'];?>&almacenDestino=<?php echo $_POST['almacenDestino'];?>&almacenDestino1=<?php echo $_POST['almacenDestino1'];?>&keyPACOM=<?php echo $_GET['keyPACOM'];?>&descripcion=<?php echo $_GET['descripcion'];?>"> <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar <?php echo $myrow['descripcion']; ?>?') == false){return false;}" /></a></div></td>
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
    <p>&nbsp;</p>
	
	
	
	
	

	
	
	

	<p align="center">&nbsp;</p>
    <p align="center"><label></label>
    </p>

    <div align="center">
      <label>
      <input name="update" type="submit"  id="agregarArticulos2" value="Actualizar Art&iacute;culos" <?php  if($bandera<1 ){ echo 'disabled=""';}?>/>
      <br />
      </label>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </form>
  <p>&nbsp;    </p>
  <p><script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
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
			return "/sima/cargos/articulosMaquiladosx.php?almacen=<?php echo $_POST['almacenDestino1'];?>&entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>
</body>
</html>
