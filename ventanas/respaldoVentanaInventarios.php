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


$hoy = date("d/m/Y");
$hora = date("g:i a");

if(!$_POST['almacenDestino']){
    $_POST['almacenDestino']=$_GET['almacenDestino'];
}
















if($_POST['actualizar'] ){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidad'];
$ci=$_POST['conceptoinventarios'];
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$cajaCon=$_POST['cajaCon'];
$existenciaCendis=$_POST['existenciaCendis'];







 $sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
entidad='".$entidad."'
and
codigo='".$_POST['conceptoinventarios']."'";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);


if($myrow8acd['naturaleza']=='A'){
    $tipoMov='entrada';
    $aly=$_POST['almacenDestino'];
    $alyMain=$_GET['almacenDestino'];
}elseif($myrow8acd['naturaleza']=='C'){
    $tipoMov='salida';
    
    $alyMain=$_POST['almacenDestino'];
    $aly=$_GET['almacenDestino'];
}
$n=$myrow8acd['naturaleza'];
















if($_POST['conceptoinventarios']!=''){


    
if($action=='insert'){
//for    
for($i=0;$i<$_POST['flag'];$i++){

    //actualizo kardex
    //echo 'inserto';
    




//KARDEX
$karticulos=new kardex();
$karticulos-> movimientoskardex($tipoMov,$ct[$i],$myrow8acd['descripcion'],$myrow8acd['tipoMovimiento'],$usuario,$fecha1,$hora1,$_POST['almacenDestino'],$_POST['almacenDestino'],$myrow8ac['keyPA'],$coder[$i],$entidad,$basedatos);
//CIERRO KARDEX







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
('".$coder[$i]."','".$keyPA[$i]."','".$gpoProducto[$i]."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','".$tipoMov."',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino']."','".$myrow3ac['costo']."',
    '','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();









//**********ACTUALIZA KARDEX**************
$actualizaK=new ActualizaKardex();
$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********s
//
//
//
//******************************************
$f=1;

}//cierra for




if($f!=NULL){
echo '<div class="success">Inventario Ajustado!</div>'; }
    }elseif($action=='update'){//cierro insertar
//while

for($j=0;$j<=$_POST['flag'];$j++){
    
if($coder[$j]!=NULL){
    
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA***********
//QUIEN SALE?
    
    
   
    
if($ct[$j]>0){
   
    
if($existenciaCendis[$j]>=$ct[$j]){    
 $sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$j]."'
and

    
    almacen='".$alyMain."'
    and
status='ready' 
order by keyAE ASC";


$resulty=mysql_db_query($basedatos,$sSQLy);
$i=0;
while($myrowy = mysql_fetch_array($resulty)){
$i+=1;				
			
		



if($i<=$ct[$j]){
 $q1a = "UPDATE articulosExistencias set 
almacen='".$aly."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();  
$r+=1;
 }
} //termina while

}else{//validacion de la cantidad que intentas cargar
    echo '<div class="error">La cantidad que intentas cargar debe ser menor!</div>';
}//cierra validacion de cantidad en stock

  }//cantidad > 0  
    
}//validacion de coder
        
    }

    }//cierra for


if($r>0){
echo '<div class="success">Articulos Transferidos!</div>'; 
}

}else{//cierra validacion del ajuste

   echo '<div class="error">Escoje el motivo del ajuste!</div>'; 
    
}



//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($_POST['almacenDestino'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);


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




if($_POST['delete'] ){
$codigo=$_POST['codigo'];

if(count($_POST['codigo'])>0){

for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($codigo[$i]!=NULL){

 $q = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
          and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();




}
}//cierra for

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
echo '<div class="success">Se quitaron articulos de este almacen!</div>';


}else{//validacion del array codigo
    echo '<div class="error">Escoje el articulo para remover existencias!</div>';
}





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

<h1 align="center" >
    <br />
TRASPASO (SEMBRADO) DE ALMACENES<br />

<h4>
    <?php echo $_GET['porArticulo'];?>
</h4>

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
    
    
    
    
    
    <form id="form1" name="form1" method="post" >
    
    
    
    
    
    
<table border = "1">
<tr>
<td>CENDIS</td>
<td> <img src="../images/animatedArrow.png" alt="Transferir" width="20" height="20"></img></td>
<td>
<?php    


$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  onChange="this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
if($_POST['almacenDestino']==$resCombo['almacen']){
		
		echo 'selected="selected"';		
		} else  ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>    
    
</td>
</tr>
    
<tr>
<td>Concepto</td>
<td></td>
<td><?php     
        $aCombo1= "Select * From conceptoinventarios where entidad='".$entidad."'  order by descripcion ASC";
        $rCombo1=mysql_db_query($basedatos,$aCombo1); ?>
          <br>
      
          <select name="conceptoinventarios"  class="normal"/>        
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
        </select></td>
</tr>    
    
  
</table>
    
    
    
    
    
        
        
    <br></br>
        
        
        
    
    

 

  <table width="600" class="table table-striped">
   

      
      
    <tr >
      <th width="10"  align="left">Clave</th>
      <th width="400"  align="left">Descripcion</th>

  

      <th width="10"  align="left">ECendis</th>
      <th width="10"  align="left">Cantidad</th>
      <th width="10"  align="left">EBot</th>
       <th width="10"  align="left"></th>
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

existencias,articulos
WHERE
(
existencias.entidad='".$entidad."' AND
articulos.descripcion like '%$articulo%' 
and
existencias.almacen='".$_POST['almacenDestino']."'
and

existencias.codigo=articulos.codigo
) 
OR
(existencias.entidad='".$entidad."'
    and
    existencias.codigo='".$articulo."'
and
existencias.almacen='".$_POST['almacenDestino']."'
    and
    existencias.codigo=articulos.codigo
)
order by articulos.descripcion ASC
";

    
    
}   else{ 

$sSQL1= "SELECT 
*
FROM 

articulos,existencias
WHERE
existencias.entidad='".$entidad."' AND
articulos.descripcion like '%$articulo%' 
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.anaquel='".$_POST['anaquel']."'
and
articulos.descripcion!=''
and
existencias.codigo=articulos.codigo
order by articulos.descripcion ASC
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
articulos.codigo=existencias.codigo
             order by articulos.descripcion ASC
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
articulos.codigo=existencias.codigo
             order by articulos.descripcion ASC
"; 
 
  }
}

$result1=mysql_db_query($basedatos,$sSQL1);
$cant=mysql_num_rows($result1);

if($cant>0){



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
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


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
$existenciaCendis=$myrow8ac1e['entrada']-$myrow8ac1s['salida']
?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr  >
      
        
        
        <td  ><?php echo $myrow1['keyE']; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
    </td>
      <td >
          <input name="keyPA[]" type="hidden" value="<?php echo $myrow1['keyPA']; ?>" />
          <input name="gpoProducto[]" type="hidden" value="<?php echo $myrow8ac['gpoProducto']; ?>" />
          <input name="cajaCon[]" type="hidden" value="<?php echo $myrow8ac['cajaCon']; ?>" />
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
    <?php 

		echo ltrim($myrow1['descripcion']);
                echo '<br>';
echo '<span class="precio1">'.$myrow1['codigo'].'</span>';
echo '<br>';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

?> 
          
          
          
          
<?php           
     if($myrow1['anaquel']!=NULL){
echo '<br>';
echo '<span >Anaquel: '.$myrow1['anaquel'].'</span>';
}
		?>
 
          <a  href="javascript:ventanaSecundaria2('../../sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>  
          
          
          
          
      </td>
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        

        
        
<td ><span >
<input type="hidden" name="existenciaCendis[]" value="<?php echo $existenciaCendis; ?>"></input>
<?php echo $existenciaCendis; ?>
</span></td>
        

        
<td ><span >
        <?php
        
        if($existenciaCendis>-1){
        echo '<input type="text" name="cantidad[]" size="3"></input>';
        }else{
            echo '<input type="hidden" name="cantidad[]" size="3"></input>';
        echo '<div class="error" style="height:10;width:30">Error!</div>'; 
        }?>
</span></td> 
        

        
        
<td ><span >
<?php 



if($_POST['almacenDestino']!=$_GET['almacenDestino']){
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
    almacen='".$_POST['almacenDestino']."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();


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
    almacen='".$_POST['almacenDestino']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
$existenciaBotiquin=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];
echo $existenciaBotiquin;
}else{
    echo '---';
}
?>
</span></td> 
        


      <td ><input name="codigo[]" type="checkbox"  value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }

    
    
}else{ echo '<div class="error">Error! No se encontro el articulo!</div>'; ?>
    
   <script>
   //window.alert("NO SE ENCONTRO EL ARTICULO!");
   //window.close();
   </script>
<?php }
    
    }?>
    <tr>
     
    </tr>
  </table>
 
<p align="center">&nbsp;</p>
  <div align="center" ><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="flag" type="hidden"  value="<?php echo $a; ?>"  />

    <?php if($a>0){?>
    <input  name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" 
    value="Ajustar Existencias" />
    
    <input  name="delete" type="submit" id="delete" value="Reset Existencias"></input>
	<?php }else{
            
        }
	?> 
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>


<br></br>


</body>
</html>