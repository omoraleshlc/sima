<?PHP require("menuOperaciones.php"); ?>


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
$anaquel=$_POST['anaquel'];
$costo=$_POST['costo'];



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]!=NULL  AND $alma!=NULL and ($anaquel[$i]!=NULL or $costo[$i]>0)){
$sSQL3a= "
	SELECT 
codigo,gpoProducto,descripcion
FROM
articulos
WHERE
entidad='".$entidad."'
    and
codigo='".$codigo[$i]."'";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


if($anaquel[$i]!=NULL){
$leyenda= 'Se actualizaron el registro';
 $q = "UPDATE existencias set 
anaquel='".$anaquel[$i]."'

WHERE 
entidad='".$entidad."'
    AND
codigo='".$coder[$i]."' 
AND 
almacen = '".$_POST['almacenDestino1']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="Se actualizaron existencias";
}


if($costo[$i]>0){
   $q1a = "INSERT INTO precioArticulos 
(codigo,costo,usuario,fecha,hora,entidad,keyPA,ID_EJERCICIO,status,
cantidadParticular,cantidadAseguradora,descripcionArticulo)
values
('".$coder[$i]."','".$costo[$i]."','".$usuario."','".$fecha1."','".$hora1."',
    '".$entidad."','".$keyPA[$i]."','".$ID_EJERCICIOM."' ,'request'  ,'".$porcentajeParticular."' ,
        '".$porcentajeAseguradora."' ,'".$myrow3a['descripcion']."'  )";

mysql_db_query($basedatos,$q1a);
echo mysql_error();
} 



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
//mysql_db_query($basedatos,$agrega);
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

  $q = "DELETE FROM existencias WHERE  entidad='".$entidad."'
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
//mysql_db_query($basedatos,$q1);
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

<h1 align="center" ><br />
REPORTE DE ANAQUELES <br />

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
<form id="form" name="form" method="post" action="">
  
    
    
    
    
  
  <table width="600" class="table-forma">
      
      
      <tr >
      <td scope="col"><div align="right" >Almacen</div></td>
      <td  scope="col"> <div align="left">
<?php
              $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino"  />        
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
      </div></td>
    </tr>
      
      
      
    <tr>
      <td width="114"  scope="col"><div align="left" >
        <div align="right" ><span >Escoje el anaquel</span></div>
      </div></td>
      <td width="474"  scope="col"><div align="left"><span >
         
 <?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$_POST['almacenDestino']."' order  by anaquel ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel"  />        
    
  <option
      <?php  if($_POST['anaquel']=='*'){echo 'selected=""';}?>
      
      value="*" >Todos</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
 if($_POST['anaquel'] ==$resCombo['anaquel'] ){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
        <?php } ?>
        </select>                 
                  
                  
                  
      </span></div></td>
    </tr>
      
      
      
    
    <tr>
      <td height="41"  scope="col">&nbsp;</td>
      <td scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
        
	
          </div>
        </label></td>
    </tr>
  </table>
  

  
  
  
  
  
  
  
  
<p>&nbsp;</p>

  <table width="600" class="table table-striped" >

    <tr >
         <th width="10"  align="center">#</th>
      <th width="10"  align="center">Clave</th>
      <th width="200"  align="center">Descripcion</th>
    <th width="10"  align="center">Anaquel</th>
 <th width="10"  align="center">CajaCon</th>
   
      <th width="10"  align="center">Costo</th>
      <th width="10"  align="center">PrecioV</th>
      <th width="10"  align="center">IVA</th>
      <th width="10"  align="center">Editar</th>
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
if( $_POST['anaquel']!=NULL){

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
             limit 0,100
";    
}else{
  $sSQL1= "
     select * from existencias
     where
     entidad='".$entidad."'
         and
         almacen='".$_POST['almacenDestino']."'
             and
anaquel='".$_POST['anaquel']."'
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








$sSQL12r= "
	SELECT *
FROM
  articulos
WHERE 
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."'
";
$result12r=mysql_db_query($basedatos,$sSQL12r);
$myrow12r = mysql_fetch_array($result12r);
$gpoProducto=$myrow12r['gpoProducto'];


if($myrow12r['descripcion']!=NULL){






$sSQL39e= "
	SELECT 
*
FROM
gpoProductos
WHERE 

codigoGP='".$myrow12r['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);










$sSQL12= "
	SELECT *
FROM
  precioArticulos
WHERE 
entidad='".$entidad."'
    and
codigo='".$myrow1['codigo']."' order by keyC DESC
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);



$sSQL12a= "
	SELECT *
FROM
  articulosPrecioNivel
WHERE 
entidad='".$entidad."'
    and
almacen='".$_POST['almacenDestino']."'
        and
codigo='".$myrow1['codigo']."'
";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);
?>
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr  >
      
           <td height="10" ><span ><?php echo $a; ?>
         
      </span></td>     
        
        <td height="10" ><span ><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      
        
        
        
        <td ><input name="keyPA[]" type="hidden" id="keyPA[]" value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo $myrow12r['descripcion'];

		?>
      </td>
        
        
        
        
  <td >
       <?php 

		echo $myrow1['anaquel'];

		?>
        </td>

        
        
          <td >
       <?php 
                if($myrow12r['cajaCon']>0){
		echo $myrow12r['cajaCon'];
                }

		?>
        </td>
        
        
        













        
        
              <td ><span >
        
<?php 
	  if($myrow12['costo']>0){
	  echo '$'.number_format($myrow12['costo'],2);
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </span></td>
        
        
                      <td ><span >
        
<?php 
	  if($myrow12a['nivel1'] >0){
	  echo '$'.number_format($myrow12a['nivel1'],2);
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </span></td>
        
        
        
        
                      <td ><span >
        
<?php 
	  if($myrow39e['tasaGP']>0){
          $p=$myrow12a['nivel1']*($myrow39e['tasaGP']*0.01);
	  echo '$'.number_format($p,2);
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </span></td>
        
        


      <td >---</td>
    </tr>
    <?php  } }}?>
    <tr>
     
    </tr>
  </table>

<p align="center">&nbsp;</p>
  <div align="center" class="notice"><strong>
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