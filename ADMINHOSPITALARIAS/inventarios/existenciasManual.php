<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>


<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
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

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $existencias[$i]>-1){

$sSQL8acd= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

$karticulos=new kardex();
$karticulos-> movimientoskardex($existencia,'AJUSTE A INVENTARIOS','ajuste',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8b['keyPA'],$coder[$i],$entidad,$basedatos);

$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen)
values
('".$coder[$i]."','".$myrow8acd['keyPA']."','".$myrow8acd['gpoProducto']."','".$existencias[$i]."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino1']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}//innsertalo







}
















$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron existencias...';
}





?>











<?php 
if($_POST['actualizar2'] || $_POST['actualizar'] || $_POST['delete']){
    if($_POST['actualizar2']){$descripcion='Presiono el boton actualizar articulos';
    }elseif($_POST['actualizar']){$descripcion='Presiono el boton actualizar existencias';
    }elseif($_POST['delete']){$descripcion='Presiono el boton de eliminar';}
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
?>




<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['delete'] and $_POST['codigo']){
$codigo=$_POST['codigo'];



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($codigo[$i]){

  $q = "DELETE FROM existencias WHERE 
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();

   $q = "DELETE FROM articulosPrecioNivel WHERE 
codigo='".$codigo[$i]."'  
and
almacen='".$_POST['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();


}

}
?>
<script>
window.alert("Se quitaron articulos de este almacen");
</script>
<?php
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se quitaron articulos de este almacen';
}





?>














<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar2']){
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$descripcion=$_POST['descripcion'];
$cBarra=$_POST['cBarra'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($keyPA[$i]!=NULL){
  $q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron datos!';
}?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos"><br />
Ajuste a existencias Manuales <br />
<h5>*Nota: solo se suman las existencias a las ya establecidas..</h5>

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <img src="/sima/imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <th width="114" bgcolor="#FFFF00" scope="col"><div align="left" class="normalmid">
        <div align="right" ><span class="negromid">Datos Articulo </span></div>
      </div></th>
      <th width="474" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style12">
          <input name="porArticulo" type="text" class="camposmid" id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></th>
    </tr>
    <tr class="style7">
      <th bgcolor="#CCCCCC" scope="col"><div align="right" class="normalmid">Almac&eacute;n</div></th>
      <th bgcolor="#CCCCCC" scope="col"> <div align="left">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenStock($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
      </div></th>
    </tr>
    <tr>
      <th height="41" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col"><label>
          <div align="left">
            <input name="buscar" type="image" src="../../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></th>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="600" height="24" />
<p>&nbsp;</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="600" border="0" cellspacing="0" cellpadding="3" align="center" class="normalmid">
    <tr>
    
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="10" class="none" align="center">Clave</td>
      <td width="200" class="none" align="center">Descripcion</td>
    
 <td width="10" class="none" align="center">ModoVenta</td>
      <td width="10" class="none" align="center">Ajustar</td>
      <td width="10" class="none" align="center">Existencias</td>
      <td width="10" class="none" align="center"></td>
    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['porArticulo']){

if($_POST['porArticulo']!='*'){

$sSQL1= "SELECT 
*
FROM 

existencias
WHERE
entidad='".$entidad."' AND
descripcion like '%$articulo%' 
and
almacen='".$_POST['almacenDestino']."'
and
descripcion!=''

order by descripcion ASC
";
} else {
 $sSQL1= "
     select * from existencias
     where
     entidad='".$entidad."'
         and
         almacen='".$_POST['almacenDestino']."'
             and
descripcion!=''
             order by descripcion ASC
";

}

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      
        
        
        <td height="10" class="normal"><span class="normal"><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td class="normal"><input name="keyPA[]" type="hidden"  value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo ltrim($myrow1['descripcion']);

		?>
      </td>
        
        
        
        
        

        
        
        
        





      <td class="normal"><span class="normal">
        
<?php 
	
	  echo $myrow1['modoventa'];
	
	 
		?>
      </span></td>








      <td class="normal"><span class="normal">
        <input name="existencias[]" type="text" class="normal"  value="" size="10" />
      </span></td>



      <td class="normal"><span class="normal">
<?php 
	  $informacionE=new existencias(); 
print $informacionE->informacionExistencias($tipoPaciente,$entidad,$myrow1['codigo'],$_POST['almacenDestino'],$usuario,$fecha,$basedatos);
	 
		?>
      </span></td>
        
        
        
        
        
        
        
        
        
        


      <td class="normal"><input name="codigo[]" type="checkbox" id="codigo[]" value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="600" height="24" />
<p align="center">&nbsp;</p>
  <div align="center" class="informativo"><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>"  />

    
    <input class="normalmid" name="actualizar" type="submit" src="../../imagenes/btns/refresh.png" id="actualizar" 
    value="Ajustar Existencias" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    <input class="normalmid" name="delete" type="submit" id="delete" value="Quitar de este almacen" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>



</body>
</html>