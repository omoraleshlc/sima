<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>


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
REPORTE DE EXISTENCIAS<br />

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
    
  <option
      <?php  if($_POST['anaquel']=='*'){echo 'selected=""';}?>
      
      value="*" >Todos</option>
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
            <input name="buscar" type="submit" src="../../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
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
      


    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['buscar'] and ($_POST['porArticulo'] or $_POST['anaquel']!=NULL)){

if($_POST['porArticulo']!='*'){

    
    //filtrar por anaquel
if($_POST['anaquel']=='*'){
    
    
    
$sSQL1= "SELECT 
*
FROM 

existencias,articulos
WHERE
existencias.entidad='".$entidad."' 
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo
order by existencias.descripcion ASC
";

    
    
}   else{ 

$sSQL1= "SELECT 
*
FROM 

articulos,existencias
WHERE
existencias.entidad='".$entidad."' 
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.anaquel='".$_POST['anaquel']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

order by existencias.descripcion ASC
";

}










} else {
    
    
    
    //filtrado por anaquel
  if($_POST['anaquel']=='*'){
 
      $sSQL1= "
     select * from existencias,articulos
     where
     existencias.entidad='".$entidad."'
         and
         existencias.almacen='".$_POST['almacenDestino']."'
             and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

             order by existencias.descripcion ASC
";

  }  else{
 
 
       $sSQL1= "
     select * from existencias,articulos
     where
     existencias.entidad='".$entidad."'
         and
         existencias.almacen='".$_POST['almacenDestino']."'
             and
          existencias.anaquel='".$_POST['anaquel']."'   
and
articulos.descripcion!=''
and
articulos.codigo=existencias.codigo
             order by existencias.descripcion ASC
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
existencias
WHERE
entidad='".$entidad."'
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
      
        
        
        <td height="10" class="normal"><span class="normal">
<?php echo $myrow1['keyPA']; 
echo '<br>';
    echo $myrow8ac['codigo'];
?>
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
		

if($myrow8ac['antibiotico']=='si'){
echo '<br>';
echo '<span class="normal">Antibiotico</span>';
echo '<br>';
}


if($myrow8ac['cbarra']!=NULL){
    echo '<br>';
    echo $myrow8ac['cbarra'];

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
<?php echo $myrow1['existencia'];?>
      </span></td>
        
        
        
        
      <td class="normal"><span class="normal">
 <?php echo $myrow1['cantidadTotal'];?>
      </span></td>
       
        
        
        
        
        
        

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

    

    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>



</body>
</html>