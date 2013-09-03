<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); ?>


<SCRIPT language="javascript">
function imprimir()
{ if ((navigator.appName == "Netscape")) { window.print() ;
}
else
{ var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = "";
}
window.close();
}
</SCRIPT> 




<?php if(!$_POST['print']){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>
<BODY >


<h1 align="center" class="titulos">HOSPITAL LA CARLOTA</h1>
<h4 align="center" class="titulomed">Articulos Surtidos<span class="style7 Estilo3">

<?php
 $sSQL1= "Select * From solicitudesDepartamentos WHERE
     entidad='".$entidad."'
         and
nOrden='".$_GET['nOrden']."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);



?>





</br>

<table width="580" border="0" cellpadding="0" cellspacing="0" align="center">
	  <tr>
	  	<td width="415" align="Center" class="normal"><span class="normal"> Usuario Cargo: <?php echo $usuario;?>
<td width="415" align="Center" class="normal"><span class="normal"> Usuario Solicitante: <?php echo $myrow1['usuario'];?>
<td width="415" align="Center" class="normal"><span class="normal"> Hora Solicitud: <?php echo $myrow1['hora'];?>
	<td width="95" align="left">&nbsp;</td></span></td>
      
    </tr>
    
    
  <tr>
<td width="415" align="Center" class="normal"><span class="normal"> Hora Cargo: <?php echo $hora1;?>  	
<td width="415" align="Center" class="normal"><span class="normal"> Orden: <?php echo $_GET['nOrden'];?>
	<td width="95" align="left">&nbsp;</td></span></td>
      
    </tr>

</table></br>





                

<table>





    
<tr><td class="normal">#</td>
<td class="normal">Fecha</td>
<td class="normal">Descripcion</td>
<td class="normal">Almacen Destino</td>
<td class="normal">Cant</td>
<td class="normal">Costo</td>
</tr>
    <tr>
      
<?php	
if($_GET['nOrden'] !=NULL){



 $sSQL18= "
SELECT 
*
FROM
articulosExistencias
WHERE 
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."' 
   
and
tipoMov='entrada'
group by codigo
";




$result18=mysql_db_query($basedatos,$sSQL18);
if($result18!=NULL){
while($myrow18 = mysql_fetch_array($result18)){
$requi=$myrow18['id_requisicion'];
$id_proveedor=$myrow18['id_proveedor'];
$id_almacen=$myrow18['id_almacen'];
$b+='1';
$a+='1';

if($col){
$color = '#CCCCCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
nOrden='".$_GET['nOrden']."'
    and
codigo='".$myrow18['codigo']."'
    and

        tipoMov='entrada'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);


  
$sSQL8aa= "
SELECT *
FROM
articulos
WHERE
entidad='".$entidad."'
    and
    codigo='".$myrow18['codigo']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);



$sSQL3ac="SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow18['codigo']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
?>

<td bgcolor="<?php echo $color?>">

<div align="left" class="normal">
<?php echo $a;?>
</div>
</td>


      <td bgcolor="<?php echo $color?>"  ><div align="left" class="normal">
          <?php 
	 
	  echo cambia_a_normal($myrow18['fecha']);
	  	 		?>
        </span></div>
        <span class="normal"><label></label>
        <div align="left"></div>
      </span></td>
        
        
        
        
      <td bgcolor="<?php echo $color?>" class="normal"><span class="normal">
        <?php 
					echo $myrow8aa['descripcion'];
		
		?>
        <input name="codigoAlfa[]" type="hidden"  value="<?php echo $code1; ?>" />
        <?php 
	  if($myrow18['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Este articulo es una devolucion]';
	  }
	  ?>      
       </span></td>
        
        
        
                     
      <td bgcolor="<?php echo $color?>" class="normal">
        <div align="left" class="normal">
          <?php 
 $sSQL2= "Select descripcion From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow18['almacen']."';
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
	  echo $myrow2['descripcion'];
	  	 		?>      
        </div></td>



              <td bgcolor="<?php echo $color?>" class="normal">
        <div align="left" class="normal">
          <?php

	  echo $myrowv1['c'];
	  	 		?>
        </div></td>


              <td bgcolor="<?php echo $color?>" class="normal">
        <div align="left" class="normal">
          <?php

	  echo '$'.number_format($myrow18['costo'],2);
	  	 		?>
        </div></td>
  
    </tr>
    <?php  
	

	}}} //cierra while 
	

	
	?>
  </table>
  <div align="center">
    <label><br />
    <input name="print" type="submit" class="normal" id="print" value="Imprimir"   onclick="imprimir();"/>
    </label>
</div>
  <p align="center">&nbsp;</p>
</form>
</body>

</html>
<?php } else { echo 'Datos ya impresos';
echo '<script>';
echo 'close();';
echo '</script>';
} ?>