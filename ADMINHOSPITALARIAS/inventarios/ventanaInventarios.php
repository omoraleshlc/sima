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
$_POST['porArticulo']=$_GET['porArticulo'];
$_POST['anaquel']=$_GET['anaquel'];
$_POST['almacenDestino']=$_GET['almacenDestino'];

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] and $_POST['conceptoinventarios']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidadTotal'];
$ci=$_POST['conceptoinventarios'];
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$cajaCon=$_POST['cajaCon'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){



//print 'ci:'.$ci[$i].' coder:'.$coder[$i].'  ct:'.$ct[$i];
//echo '<br>';

if($ci[$i]!=NULL AND $coder[$i]!=NULL and $ct[$i]>0){

    //VERIFICO SI NO GUARDA LAS EXISTENCIAS DE OTRO LADO
    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_GET['almacenDestino']."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
 $_GET['almacenDestino']=$myrow29p['almacenExistencias'];
   
}    










$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
entidad='".$entidad."'
and
codigo='".$ci[$i]."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);


if($myrow8acd['naturaleza']=='A'){
    $tipoMov='entrada';
}elseif($myrow8acd['naturaleza']=='C'){
    $tipoMov='salida';
}

//KARDEX
$karticulos=new kardex();
$karticulos-> movimientoskardex($existencia,$myrow8acd['descripcion'],$myrow8acd['tipo'],$usuario,$fecha1,$hora1,$_GET['almacenDestino'],$_GET['almacenDestino'],$myrow8ac['keyPA'],$coder[$i],$entidad,$basedatos);
//CIERRO KARDEX



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen)
values
('".$coder[$i]."','".$keyPA[$i]."','".$gpoProducto[$i]."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','".$tipoMov."',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacenDestino']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$s='si';
}else{
$s=NULL;    
}
}





if($s=='si'){
echo '<script>
window.alert("Existencias actualizadas");
//window.close();
</script>';
}


}//cierra validacion


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
INVENTARIOS<br />

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
  <img src="../../imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="800" border="0" cellspacing="0" cellpadding="3" align="center" class="normalmid">
    <tr>
    
    </tr>
      
      
    <tr bgcolor="#FFFF00">
      <td width="10" class="none" align="left">Clave</td>
      <td width="400" class="none" align="left">Descripcion</td>
      <td width="200" class="none" align="left">Concepto</td>
      <td width="10" class="none" align="left">Costo</td>
    <td width="10" class="none" align="left">Caja</td>
 <td width="10" class="none" align="left">ModoVenta</td>
      <td width="10" class="none" align="left">Unidades</td>
      <td width="10" class="none" align="left">Existencias</td>
      <td width="10" class="none" align="left"></td>
    </tr>
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
    $_POST['almacenDestino']=$myrow29p['almacenExistencias'];    
}

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


//ENtRADAS
    $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    tipoMov='entrada'
    and
    almacen='".$_GET['almacenDestino']."'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

//SALIDAS
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    tipoMov='salida'
    and
    almacen='".$_GET['almacenDestino']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      
        
        
        <td  class="normal"><span class="normal"><?php echo $myrow1['keyE']; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td class="normal">
          <input name="keyPA[]" type="hidden" value="<?php echo $myrow1['keyPA']; ?>" />
          <input name="gpoProducto[]" type="hidden" value="<?php echo $myrow8ac['gpoProducto']; ?>" />
          <input name="cajaCon[]" type="hidden" value="<?php echo $myrow8ac['cajaCon']; ?>" />
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
    <?php 

		echo ltrim($myrow1['descripcion']);
                echo '<br>';
echo '<span class="precio1">'.$myrow1['codigo'].'</span>';
echo '<br>';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

if($myrow1['anaquel']!=NULL){
echo '<br>';
echo '<span class="normal">Anaquel: '.$myrow1['anaquel'].'</span>';
}
		?>
          
          
          
<a  href="javascript:ventanaSecundaria2('../../cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>          
      </td>
        
        
        
        
        
         <td class="normal">
        <?php     
        $aCombo1= "Select * From conceptoinventarios where entidad='".$entidad."'  order by descripcion ASC";
        $rCombo1=mysql_db_query($basedatos,$aCombo1); ?>
        <select name="conceptoinventarios[]"  />        
     <option value="">---</option>
  
        <?php while($resCombo1 = mysql_fetch_array($rCombo1)){ ?>
        
     <option 
		<?php 
	 if($_POST['conceptoinventarios'] ==$resCombo1['codigo']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo1['codigo']; ?>">
                <?php echo $resCombo1['descripcion']; ?>
                </option>
                
        <?php } ?>
        </select>
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
<input name="cantidadTotal[]" type="text" class="normal" size="10"  ></input>
      </span></td>
        
        
        
        
      <td class="normal"><span class="normal">
 <?php 
$informacionE=new existencias(); 
print $informacionE->informacionExistencias($tipoPaciente,$entidad,$myrow1['codigo'],$_GET['almacenDestino'],$usuario,$fecha,$basedatos);
 ?>
      </span></td>
        
        
        


      <td class="normal"><input name="codigo[]" type="checkbox"  value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="600" height="24" />
<p align="center">&nbsp;</p>
  <div align="center" class="precio1"><strong>
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