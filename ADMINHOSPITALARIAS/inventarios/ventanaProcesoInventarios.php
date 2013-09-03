<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 



<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>

<script>
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
</script>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidadTotal'];
$keyPA=$_POST['keyPA'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $ct[$i]>-1){


    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
 
if($myrow8ac['cajaCon']>0){
    $existencia=$ct[$i];
    $cantidadTotal=$ct[$i]*$myrow8ac['cajaCon'];
}else{
    $existencia=$ct[$i];
    $cantidadTotal=$existencia;
}



$sSQL8a= "
SELECT *
FROM
listasinventarios
WHERE
entidad='".$entidad."'
and

almacen='".$_POST['almacenDestino1']."'
and
codigo='".$coder[$i]."'
    and
    keylistas='".$_GET['keylistas']."'
";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);








if($myrow8a['codigo']){
$leyenda= 'Se actualizaron el registro';
 $q = "UPDATE listasinventarios set 
descripcion='".$myrow8ac['descripcion']."',
keylistas='".$_GET['keylistas']."',         
cantidadTotal='".$cantidadTotal."',
fechaA='".$hoy."', 
hora='".$hora."', 
existencia='".$existencia."',
razon='".$razon[$i]."',
         topeMayor=cantidadTotal-totalUnidades,
         topeMenor=totalUnidades

WHERE 
entidad='".$entidad."'
    AND
codigo='".$coder[$i]."' 
AND 
almacen = '".$_POST['almacenDestino1']."'
    and
    keylistas='".$_GET['keylistas']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="Se actualizaron existencias";


//*****************************KARDEX**************************
$karticulos=new kardex();
$karticulos-> movimientoskardex($existencia,'AJUSTE MANUAL','ajuste',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8a['keyPA'],$coder[$i],$entidad,$basedatos);
//*************************************************************





//************************************************
} else {//insertar
//echo 'Se insert� en existencias un nuevo registro';
 $agrega = "INSERT INTO listasinventarios (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,almacenPrincipal,cantidadTotal,keylistas,existencia
) values (
'".$coder[$i]."' ,
'".$alma."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['almacenDestino1']."','".$cantidadTotal."','".$_GET['keylistas']."','".$existencia."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



}//innsertalo



}

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

<h1 align="center" class="titulos">
    <br />
PROCESO DE INVENTARIOS<br />

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
      <?php     $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onchange="this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
      </div></th>
    </tr>
      
      
      
          
      
      
      
      
      
      
      
      
      
      
      
      
      
            
      <tr class="normal">
      <th bgcolor="#CCCCCC" scope="col"><div align="right" class="normalmid">Anaquel</div></th>
      <th bgcolor="#CCCCCC" scope="col"> <div align="left">
          <?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$_POST['almacenDestino']."' order  by anaquel ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel" class="normal" id="almacenDestino" onchange="this.form.submit();"/>        
       <option value="" >---</option>
  <option value="*" >Todos</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
 if($myrow61['anaquel'] ==$resCombo['anaquel'] || $_POST['anaquel']==$resCombo['anaquel']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
        <?php } ?>
        </select>
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
      <td width="10" class="none" align="left">Clave</td>
      <td width="200" class="none" align="left">Descripcion</td>
      <td width="10" class="none" align="left">Costo</td>
    <td width="10" class="none" align="left">Caja</td>
 <td width="10" class="none" align="left">ModoVenta</td>
      <td width="10" class="none" align="left">Entero</td>
            <td width="10" class="none" align="left">Cantidad</td>
      <td width="10" class="none" align="left">Total Piezas</td>
      

      <td width="10" class="none" align="left"></td>
    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['porArticulo'] or $_POST['anaquel']!=NULL){

if($_POST['porArticulo']!='*'){

    
    //filtrar por anaquel
if($_POST['anaquel']=='*'){
    
    
    
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

    
    
}   else{ 

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
anaquel='".$_POST['anaquel']."'
and
descripcion!=''

order by descripcion ASC
";

}










} else {
    
    
    
    //filtrado por anaquel
  if($_POST['anaquel']=='*'){
 
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

  }  else{
 
 
       $sSQL1= "
     select * from existencias
     where
     entidad='".$entidad."'
         and
         almacen='".$_POST['almacenDestino']."'
             and
          anaquel='".$_POST['anaquel']."'   
and
descripcion!=''
             order by descripcion ASC
"; 
 
  }
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











    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);

    $sSQL8acb= "
SELECT * 
FROM
precioArticulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);


$sSQL2= "
SELECT * 
FROM
listasinventarios
WHERE
entidad='".$entidad."'
and
keylistas='".$_GET['keylistas']."'
and
codigo='".$myrow1['codigo']."'
    and
almacen='".$_POST['almacenDestino']."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      
        
        
        <td height="10" class="normal"><span class="normal"><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td class="normal"><input name="keyPA[]" type="hidden"  value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo ltrim($myrow1['descripcion']);
echo '<br>';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

if($myrow1['anaquel']!=NULL){
echo '<br>';
echo '<span class="normal">Anaquel: '.$myrow1['anaquel'].'</span>';
}
		?>
          
          
          
<a  href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>          
      </td>
        
        
        
        
              <td class="normal"><span class="normal">
        
<?php 
	if($myrow8acb['costo']>0){
	  echo '$'.number_format($myrow8acb['costo'],2);
        }else{
            echo '<span class="informativo"><blink>???</blink></span>';
        }
	 
		?>
      </span></td>
        
        
        

        
        
      <td class="normal"><span class="normal">
        
<?php 
	if($myrow8ac['cajaCon']>0){
	  echo $myrow8ac['cajaCon'];
        }else{
            echo 1;
        }
	 
		?>
      </span></td>

        
        





      <td class="normal"><span class="normal">
        
<?php 
	
	  echo $myrow1['modoventa'];
	
	 
		?>
      </span></td>








      <td class="normal"><span class="normal">
     
<?php 
	  if($myrow1['existencia']>0){
	  echo $myrow1['existencia'];
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </span></td>



      <td class="normal"><span class="normal">
<input name="cantidadTotal[]" type="text" class="normal"  value="<?php echo $myrow2['existencia'];?>"></input>
      </span></td>
        
        
        
        
      <td class="normal"><span class="normal">
 <?php echo $myrow2['cantidadTotal'];?>
      </span></td>
       
        
        
        
        
        
        
        
        


      <td class="normal"><input name="codigo[]" type="checkbox" id="codigo[]" value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="600" height="24" />
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