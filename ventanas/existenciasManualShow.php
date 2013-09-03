<?PHP require("/configuracion/ventanasEmergentes.php"); $ALMACEN=$alma=$_POST['almacenDestino']=$_POST['almacenDestino1']=$_GET['almacen'];?>





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
<form id="form1" name="form1" method="post">

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
      <td width="10" class="none" align="center">Existencia</td>
  
  
    </tr>
<?php	
$_POST['porArticulo']=$articulo=$_GET['porArticulo'];
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
        <?php
     $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino']."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){    
 $almacen=$myrow29p['almacenExistencias'];    
}













    
//ENtRADAS
  $sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    tipoMov='entrada'
    and
    almacen='".$_POST['almacenDestino']."'

";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS
  $sSQL8ac1s= "
SELECT sum(cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    tipoMov='salida'
    and
    almacen='".$_POST['almacenDestino']."'

";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);


echo $myrow8ac1e['entrada']-$myrow8ac1s['salida'];
    
        
        
        ?>
      </span></td>



      
        
        
        
        
        
        
        
        
        
        


      
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

    
    <input class="normalmid" name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" 
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

<br>
<br>

</body>
</html>