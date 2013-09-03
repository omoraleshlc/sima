<?php require("/configuracion/ventanasEmergentes.php");require('/configuracion/funciones.php');?>
<?php
$numCliente=$_GET['seguro'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>



<?php  
if($_GET['keyE'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="si"){
$q = "DELETE  FROM articulosPaquetes 
		WHERE keyE='".$_GET['keyE']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>







<?php 




if($_POST['actualizar']){

$codigo=$_POST['codigo'];
$precioPaquete1=$_POST['precioPaquete1'];
$precioPaquete3=$_POST['precioPaquete3'];
$almacen=$_POST['almacen'];
$cantidad=$_POST['cantidad'];		
$tipoArticulo=$_POST['tipoArticulo'];		
$iva=new articulosDetalles();		
for($i=0;$i<=$_POST['flag'];$i++){



//$iva->iva($entidad,$cantidad[$i],$codigo[$i],$precioPaquete1[$i],$basedatos);

if($codigo[$i] and $precioPaquete1[$i] ){



$sql="Update articulosPaquetes
set
precioPaquete1='".$precioPaquete1[$i]."',
ivaPrecioPaquete1='".$iva->iva($entidad,$cantidad[$i],$codigo[$i],$precioPaquete1[$i],$basedatos)."',
precioPaquete3='".$precioPaquete3[$i]."',
usuario='".$usuario."',
fecha='".$fecha1."',
cantidad='".$cantidad[$i]."',
hora='".$hora1."',
tipoArticulo='".$tipoArticulo[$i]."'
where 
codigoPaquete='".$_GET['codigoPaquete']."'
and
entidad='".$entidad."'
and
codigo='".$codigo[$i]."' 
and 
almacen='".$almacen[$i]."'


";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';

}
}//cierra if
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
  // -->
</script>';

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='REGISTROS ACTUALIZADOS...';
}//cierra for

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
<?php 
if($_POST['quitar']!=null and ($usuario AND $entidad AND $_GET['codigoPaquete']!=NULL)){
 $borrame = "DELETE FROM articulosPaquetes WHERE 
keyE ='".$_GET['keyE']."'

";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
  // -->
</script>';
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='REGISTROS ELIMINADOS...';

$yes='si';
}else{
$yes='no';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>

    
       <p>
       
   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>       
       
   </p>
    
    
    
<p align="center">

    
    
    
  <span class="titulomed"><?php 
$sSQL23= "Select * From paquetes WHERE entidad='".$entidad."' and codigoPaquete ='".$_GET['codigoPaquete']."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $rNombre23['descripcionPaquete'];
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';
echo '<blink>'.$leyenda.'</blink>';
?> </span><span class="success">Nota Importante: Los precios deben estar SIN IVA (En Caso de llevar) </span></p>
<form id="form2" name="form2" method="post" action="#" >
  
    
    <div id="divContainer">
    <table width="909"  class="formatHTML5">
      <tr>
        <th width="10"  ><div align="left"><span >#</span></div></th>
        <th width="310"  ><div align="left"><span >Descripcion</span></div></th>
        
     
        <th width="53" ><div align="left"><span >PV</span></div></th>
        <th width="45"  ><div align="left"><span > Cantidad </span></div></th>
        <th width="47"  ><div align="left"><span > P Venta </span></div></th>
        <th width="41"  ><div align="left"><span >IVA</span></div></th>
        <th width="41"  ><div align="left"><span >Tipo</span></div></th>
        <th width="41"  ><div align="left"><span >Elimina</span></div></th>
      </tr>

<?php	
$sSQL= "SELECT 
 *
FROM
 articulosPaquetes

 WHERE entidad='".$entidad."' AND codigoPaquete = '".$_GET['codigoPaquete']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;


$almacen=$myrow['almacen'];
$codigo=$myrow['codigo'];
$checaModuloScript2= "Select * from articulos WHERE codigo = '".$codigo."' ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
echo mysql_error();

$sSQL7="SELECT *
FROM
articulosPrecioNivel
WHERE entidad='".$entidad."' AND
codigo = '".$codigo."' 
AND
almacen='".$almacen."' 
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sql5= "
SELECT *
FROM
convenios
WHERE
entidad='".$entidad."' AND
numCliente =  '".$rNombre23['seguro']."'
AND 
codigo ='".$codigo."' 
AND
tipoConvenio='cantidad'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

$sSQL40= "
SELECT gpoProducto
FROM
articulos
where 
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'";
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
      
      
           <tr  >
        <td   >
          <label> 
              <span >
          <?php 
	
		  $C=$myrow['codigo'];?>
       
		
          <?php echo $a?>         
                
                
                
          <input name="codigo[]" type="hidden" id="codigo[]" value="<?php echo $myrow['codigo'];?>" />
        </span>
               </label>
        </td>
               
               
               
               
               
               
        <td ><span >
          <?php 

	  if(!$myrow['precioPaquete1'] and !$myrow['precioPaquete3']){
	  $leyenda='<blink>'.' [Precios en paquete no actualizados.. Presionar Boton Actualizar!]'.'<blink>';
	  }
	  
	  
	  if($resulScripModulo2['descripcion']){
	  

	  echo $resulScripModulo2['descripcion']." ".$leyenda;
	  } else {
	  echo "El articulo existe en los convenios pero no en el inventario!!!";
	  }
          
          echo '<br>';
          echo $myrow40b['descripcionGP'];
	  ?>

                <br></br>
                          <?php 
$sql25= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."' AND

almacen='".$myrow['almacen']."'
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);
		  
if($myrow['almacen']){
echo '['.$myrow25['descripcion'].']';
} else {
echo "---";
}
?>
                
                
                  <input name="almacen[]" type="hidden" id="almacen[]" value="<?php echo $myrow['almacen'];?>" />
        </span></td>
               
               
                     
         
               

               
               
               
               
        <td ><span ><?php 
	  echo "$".number_format($myrow7['nivel1'],2); 
	  

	  ?>
&nbsp;</span></td>
               
               
               
               
        <td >
		<span >
		<input name="cantidad[]" type="text"  id="precioPaquete1[]" size="3" value="<?php 
		if($myrow['cantidad']){
		echo $myrow['cantidad'];
		} else {
		echo 1;
		}
		?>" />		
                </span>
        </td>
               
               
               
        <td >
            <span >
            <input name="precioPaquete1[]" type="text"  id="precioPaquete1" size="5" value="<?php 
		if($myrow['precioPaquete1']){
		echo $myrow['precioPaquete1'];
		} else {
		echo $myrow7['nivel1'];
		}
		?>" />
            </span>
        </td>
               
               
               
               
        <td >
            <span >
		<?php echo "$".number_format($myrow['ivaPrecioPaquete1'],2);?>
            </span>
		</td>
               
               
               
       
               <td ><label>
            <span >                
            <select name="tipoArticulo[]"  id="tipoArticulo">
		  
		  <option value="">---</option>
           
            <option
			<?php if($myrow['tipoArticulo']=='opcional') echo 'selected=""';?>
			 value="opcional">opcional</option>
            </select>
            </span>
            </label></td>
               
               
               
        <td ><div align="center" > 
                <a href="despliegaArticulosPaquetes.php?codigo=<?php echo $code; ?>&amp;codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;keyE=<?php echo $myrow['keyE']; ?>&amp;del=<?php echo $yes; ?>&inactiva=si"> 
                    <img src="/sima/imagenes/borrar.png" alt="INACTIVO" width="20" height="20" border="0"  onclick="if(confirm('Estas seguro que deseas eliminar el Articulo? <?php echo $myrow['descripcionPaquete'];?>?') == false){return false;}" />
                </a></div></td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
  </table>
    </div>
    
    
    
    
    
    
    
    <p align="center">&nbsp;</p>
    <p align="center" ><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em></p>
    <p align="center">
      <label>
      <input name="actualizar" type="submit"  id="actualiza" value="Actualizar" />
	  <input name="flag" type="hidden"  id="actualiza" value="<?php echo $a;?>" />
      <input name="quitar" type="submit"  id="quitar" value="Eliminar art&iacute;culos" />
	  <?php } ?>
      </label>
    </p>
</form>
  <p></p>
  
  <br></br>
</body>
</html>
