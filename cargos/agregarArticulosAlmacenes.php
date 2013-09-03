<?php  
if($_GET['codigo'] AND ($_GET['del']=='si' or $_GET['activa'])){

	if($_GET['del']=="si"){
$borrame = "DELETE FROM existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();




 $borrameNivel1 = "DELETE FROM articulosPrecioNivel WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."'  ";
mysql_db_query($basedatos,$borrameNivel1);

	} 


}
?>

<?php 
//actualizar ******************************************************************************************************
if(!$_POST['keyPA']){
$_POST['keyPA']=$_GET['keyPA'];
}


$sSQL6="SELECT descripcion,servicio,medico,codigo,gpoProducto,cajaCon
FROM
  articulos
WHERE
keyPA = '".$_POST['keyPA']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  

//*****************CAJA CON******************
  if($myrow6['cajaCon']>0){
  $cantidadTotal=$myrow6['cajaCon'];
  }else{
      $cantidadTotal=1;
  }
//*******************************************  
  
  
if(!$_GET['gpoProducto'])  {
 $_GET['gpoProducto']=$myrow6['gpoProducto'];
 }
 
 
 























?>






















<?php  
if($_GET['codigo'] AND ($_GET['activar']=='si' or $_GET['eliminar']=='si')){

if($_GET['eliminar']=="si"){
$borrame = "DELETE FROM existencias WHERE 
entidad='".$entidad."'
    and
    codigo='".$_GET['codigo']."'
        and
almacen='".$_GET['almacen']."'    

";
mysql_db_query($basedatos,$borrame);
echo mysql_error();



$borrame = "DELETE FROM articulosExistencias WHERE 
entidad='".$entidad."'
    and
    codigo='".$_GET['codigo']."'
        and
almacen='".$_GET['almacen']."'    

";
mysql_db_query($basedatos,$borrame);
echo mysql_error();




$borrame3 = "DELETE FROM articulosPrecioNivel WHERE 
entidad='".$entidad."'
    and
    codigo='".$_GET['codigo']."'
        and
almacen='".$_GET['almacen']."'    

";
mysql_db_query($basedatos,$borrame3);
echo mysql_error();


$tipoMensaje='error';
$encabezado='Exitoso';
$texto='ARTICULO DESACTIVADO!';
	} elseif($_GET['activar']=='si'){

    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$nivel1."','".$nivel3."', '".$id_medico[$i]."','".$_GET['keyPA']."','".$_GET['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();            
            
	$sSQL6="SELECT descripcion,servicio,medico,gpoProducto
FROM
  `articulos`
WHERE
entidad='".$entidad."'
    and
codigo = '".$_GET['codigo']."'  
    
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
       
  
  
  
  	$sSQL6r="SELECT almacen
FROM
  `existencias`
WHERE
entidad='".$entidad."'
    and
codigo = '".$_GET['codigo']."'  
    and
    almacen='".$_GET['almacen']."'
  ";
  $result6r=mysql_db_query($basedatos,$sSQL6r);
  $myrow6r = mysql_fetch_array($result6r);
  
  
if(!$myrow6r['almacen']){
$q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$nivel1."','".$nivel3."', '".$id_medico[$i]."','".$_GET['keyPA']."','".$_GET['almacen']."','".$usuario."','".$fecha."','".$hora."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

  $agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA,tipoVenta,existencia,cantidadTotal,cantidadSurtir,cantidadIndividual,descripcion
) values (
'".$_GET['codigo']."',
'".$_GET['almacen']."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_GET['keyPA']."','','','','','','".$myrow6['descripcion']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='ARTICULO ACTIVADO!';   
}

        }



}
?>





<?php

if( $_POST['anaquel']!=NULL){
    $anaquel=$_POST['anaquel'];$almac=$_POST['almac'];
    for($i=0;$i<=$_POST['bandera'];$i++){

        
        if($anaquel[$i]!=NULL and $almac[$i]!=''){
$q = "UPDATE existencias set 
anaquel='".$anaquel[$i]."'
WHERE 
entidad='".$entidad."'
    AND
codigo='".$_GET['codigo']."' 
AND 
almacen = '".$almac[$i]."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
        }
    }
    
    
}

?>




<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo solo acepta numeros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>



















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

<form id="form2" name="form2" method="POST" >

    <p align="center" >
	<?php 
	$sSQL6="SELECT descripcion,servicio,medico,gpoProducto
FROM
  `articulos`
WHERE
keyPA = '".$_GET['keyPA']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  

  	 $sSQL6b="SELECT *
FROM
gpoProductos
WHERE

codigoGP='".$myrow6['gpoProducto']."'  ";
  $result6b=mysql_db_query($basedatos,$sSQL6b);
  $myrow6b = mysql_fetch_array($result6b);
  echo '</br>';
  echo $myrow6b['descripcionGP'];
  ?>
    
      <input name="keyPA" type="hidden"  id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
</p>

    
    
    
    
    
    <h5>
<a   href="listaAlmacenesTodos.php?almacen=<?php echo $myrow['id_almacen'];?>&del=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=asignarAlmacen&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>" onclick="if(confirm('Esta seguro que deseas quitar todos los almacenes?') == false){return false;}" >               
            
          RESET (Quitar todos los almacenes)
 </a>             
        
    </h5>
    
    
    
    
    
    
    
    
    
    
    
    
    <table width="549" class="table table-striped">
      <tr >
        <th width="26" >#</th>
        <th width="123" >Descripcion</th>
        <th width="94"  align="center">Anaquel</th>
       
        <th width="88"  align="center">Status</th>
        <th width="88"  align="center">Accion</th>
      </tr>
<?php  




$sSQL= "Select * From camposGrupos
 where entidad='".$entidad."' 
 and
 gpoProducto='".$myrow6b['codigoGP']."'  
 group by id_almacen
 ";

 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];


$sSQL61a="SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$myrow['id_almacen']."'
  ";
  $result61a=mysql_db_query($basedatos,$sSQL61a);
  $myrow61a = mysql_fetch_array($result61a);

if($myrow61a['almacenConsumo']!='si'){
  
$sSQL61="SELECT almacen,anaquel
FROM
  existencias
WHERE 
entidad='".$entidad."'
and
keyPA='".$_POST['keyPA']."'  and almacen = '".$myrow['id_almacen']."'

  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  

  

  
$sSQLb="SELECT *
FROM
gpoProductos
WHERE codigoGP='".$_GET['gpoProducto']."'
  ";
  $resultb=mysql_db_query($basedatos,$sSQLb);
  $myrowb = mysql_fetch_array($resultb);
  
 $sSQL6f="SELECT *
FROM
camposGrupos
WHERE
entidad='".$entidad."'
and
 gpoProducto='".$_GET['gpoProducto']."'  and id_almacen = '".$myrow['id_almacen']."'  ";
$result6f=mysql_db_query($basedatos,$sSQL6f);
$myrow6f = mysql_fetch_array($result6f);




 $sSQL7a= "Select * From politicasPrecios where 
    entidad='".$entidad."' 
    and almacen='".$myrow['id_almacen']."' 
        and 
        gpoProducto= '".$_GET['gpoProducto']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();
  ?>
      <tr  >
        <td height="41"><span ><?php echo $bandera;?></span></td>
        <td><span >
          <?php 
		if($myrowa['medico']=='si'){
		echo $myrow61a['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow61a['descripcion'];
		}
                
                
                if(!$myrow7a['porcentaje'] and $myrowb['stock']=='si' ){
                    echo '<br>';
                    echo '<span class="success"><blink>El almacen No tiene una politica de precios definida!</blink></span>';
                }
                
		?>
        </span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
        <input name="id_medico[]" type="hidden" id="id_medico[]" value="<?php echo $myrow61a['id_medico']; ?>" />
        <span class="normal"><br />
        <span class="negro">Cod. Almacen: </span><span ><?php echo $myrow['id_almacen'];?></span></td>
       
        
        
        
                <td align="center">
                    
                    
     <?php if($myrow61['almacen']!='' ){?>                    
         <span >
          
 <input name="almac[]" type="hidden" id="almac[]" value="<?php echo $myrow['id_almacen']; ?>" />        
      
<?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$myrow['id_almacen']."'
order by posicion ASC     
";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel[]" class="" id="almacenDestino" onChange="this.form.submit();" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
 if($myrow61['anaquel'] ==$resCombo['anaquel']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
        <?php } ?>
        </select>
         <?php }else{ echo '---';}?>
        </span></td>
        
        
            
            
            
            
            
            
 
            
        
        
        
        
        
        
        
        
        
       
        <td width="36" align="center" >
           <?php if($myrow61['almacen']!='' ){?>
     <a   href="listaAlmacenesTodos.php?inactiva=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=activado&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>">                  
   
    <img src="../imagenes/btns/aprobar.png"width="20" height="20"></img>
     </a>
<?php }else{?>
    
    <img src="../imagenes/btns/inactivo.png"width="20" height="20"></img>
         <?php } ?>
        </td>        
        
        
        
        
        
        
        
        <td width="36" align="center" >
           <?php if($myrow61['almacen']!='' ){?>
            <a   href="listaAlmacenesTodos.php?almacen=<?php echo $myrow['id_almacen'];?>&eliminar=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=asignarAlmacen&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>">               
   
     <img src="../imagenes/btns/cancelabtn.png"width="20" height="20"></img>
</a>      
         
          <?php }else{ ?>
 <a   href="listaAlmacenesTodos.php?almacen=<?php echo $myrow['id_almacen'];?>&activar=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=asignarAlmacen&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>">               
            
             <img src="../imagenes/btns/addbtn2.png"width="20" height="20"></img>
 </a>            
            
            
<?php } ?></td>        
        
        
        
        
        
        
        

 
   
      
  

             </tr>
        
        

                <?php }} ?>
    </table>
    
    
    
    
    
   
    <p align="center" >

      <label>
        
      </label>
      
      <input name="keyPA" type="hidden"  id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
      <input name="bandera" type="hidden"  id="bandera" value="<?php echo $bandera;?>" />
      
      
	  	        <input name="opcion" type="hidden"  id="opcion" value="<?php echo $_POST['opcion'];?>" />
  </p>
</form>
  <p></p>
  
  <br>
  <br>
</body>
</html>
