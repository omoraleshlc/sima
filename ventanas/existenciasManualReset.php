<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php"); ?>


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

$ALMACEN=$alma=$_POST['almacenDestino']=$_POST['almacenDestino1']=$_GET['almacen'];


if($_POST['actualizar']){

$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];



  $q = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
           and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $existencias[$i]>0){

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
$karticulos-> movimientoskardex('entrada',$existencia,'AJUSTE A INVENTARIOS','ajusteSuma',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8b['keyPA'],$coder[$i],$entidad,$basedatos);



//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);	
  
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status)
values
('".$coder[$i]."','".$myrow8acd['keyPA']."','".$myrow8acd['gpoProducto']."','".$existencias[$i]."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino1']."','".$myrow3ac['costo']."','','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}//innsertalo







}












$entrance=new entradas();
$entrance=$entrance->entradaInventarios($_POST['almacenDestino1'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);



$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron existencias...';

echo '<script>';
echo 'window.alert("SE AJUSTARON EXISTENCIAS...");';
echo 'window.close();';
echo '</script>';
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
      entidad='".$entidad."'
           and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();

   $q = "DELETE FROM articulosPrecioNivel WHERE 
       entidad='".$entidad."'
           and
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
<h5>*Nota: este proceso borra las existencias anteriores y establece las ingresadas por este formulario..</h5>

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
  
    
<p>&nbsp;</p>
  <img src="../imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="600" border="0" cellspacing="0" cellpadding="3" align="center" class="normalmid">
    <tr>
    
    </tr>
    <tr bgcolor="#FFFF00">
        <td width="10" class="none" align="center">#</td>
      <td width="10" class="none" align="center">Clave</td>
      <td width="200" class="none" align="center">Descripcion</td>
    
 <td width="10" class="none" align="center">ModoVenta</td>
      <td width="10" class="none" align="center">Ajustar</td>
  
      <td width="10" class="none" align="center"></td>
    </tr>
<?php	


$_POST['porArticulo']=$articulo=$_GET['porArticulo'];
if( $_POST['porArticulo']!=NULL){

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
$sSQL4= "Select descripcion from articulos where entidad='".$entidad."' and codigo='".$myrow1['codigo']."' ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);echo mysql_error();
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
      
        
        <td height="10" class="normal">
            <span class="normal">
        <?php  echo $a;?> 
      </span>
        </td>        
        
        
        
        <td height="10" class="normal"><span class="normal"><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td class="normal"><input name="keyPA[]" type="hidden"  value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo ltrim($myrow4['descripcion']);

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



      
        
        
        
        
        
        
        
        
        
        


      <td class="normal"><input name="codigo[]" type="checkbox" id="codigo[]" value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>
  <img src="../imagenes/bordestablas/borde2.png" width="600" height="24" />
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

    <?php if($a>0){?>
    <input class="normalmid" name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" 
    value="Ajustar Existencias" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    <input class="normalmid" name="delete" type="submit" id="delete" value="Quitar de este almacen" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    
    <?php }?>
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>

<br>
<br>

</body>
</html>