<?PHP require("menuOperaciones.php"); ?>



<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=800,height=900,scrollbars=YES") 
} 
</script> 


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




if($_POST['add']){
$alma=$_POST['departamento'];
$existenciaInicial = $_POST['existenciaInicial'];
$razon=$_POST['razon'];
$costo=$_POST['costo'];
$coder=$_POST['codigo'];

  $q = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
           and
almacen='".$_POST['almacenDestino']."'
 ";

//mysql_db_query($basedatos,$q);
echo mysql_error();

//print_r($_POST['codigo']);

for($i=0;$i<=count($_POST['codigo']);$i++){




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







//$karticulos=new kardex();
//$karticulos-> movimientoskardex('entrada',$existencia,'AJUSTE A INVENTARIOS','ajusteSuma',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8b['keyPA'],$coder[$i],$entidad,$basedatos);


	
  
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status)
values
('".$coder[$i]."','".$myrow8acd['keyPA']."','".$myrow8acd['gpoProducto']."','".$existencias[$i]."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino1']."','".$myrow3ac['costo']."','','Normal','standby')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();








$q = "UPDATE existencias set
existenciaInicial='".$existenciaInicial[$i]."',costoInicial='".$costo[$i]."'
             
  
            


WHERE
entidad='".$entidad."'
    and
codigo='".$coder[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();














}












//$entrance=new entradas();
//$entrance=$entrance->entradaInventarios($_POST['almacenDestino1'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);



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



















<?php

if($_POST['conversion']!=NULL){
$sSQL3ae= "
	SELECT 
almacen
FROM
almacenes
where
entidad='".$entidad."'
    and
    centroDistribucion='si'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);

if(!$almacen){
	$almacen=$myrow3ae['almacen'];
}

	if($_POST['anaquel']!=NULL){
$sSQLy= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$_POST['departamento']."'
and
anaquel='".$_POST['anaquel']."'
and
status=''
";
        }else{
$sSQLy= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and
almacen='".$_POST['departamento']."'
and
status=''
";            
        }

$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){

	for($i=0;$i<$myrowy['cantidad'];$i++){
if($myrowy['tipoMov']=='entrada'){$stat='ready';}
if($myrowy['codigo']!=NULL){
    

$sSQL13= "
SELECT *
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."' order by keyC DESC";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);      	   

if($costo>0){
$c=$costo;   
}   else{
$c=$myrow13['costo'];
} 



$agrega = "INSERT INTO articulosExistencias (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,factura,tipo,status,costo,nOrden,numSolicitud)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$myrowy['gpoProducto']."',1,'".$myrowy['tipoVenta']."','".$entidad."','".$myrowy['tipoMov']."',
    '".$fecha1."','".$hora1."','".$usuario."','".$myrowy['almacen']."','".$factura."','".$myrowy['tipo']."','".$stat."','".$myrow13['costo']."',
'".$myrowy['nOrden']."','".$myrowy['numSolicitud']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//actualizar registros

if($flag=='si'){
//AFECTO KARDEX  *******************************************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    




/*
if($myrow8ac['cajaCon']>0){
    $ct=$cantidad*$myrow8ac['cajaCon'];
}else{
    $ct=$cantidad;
}
*/



$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE

codigo='".$codigoInv."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);

//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowy['codigo']."'
    and
      status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
//***********************CIERRO EXISTENCIAS***************

  $q1ab = "INSERT INTO kardex 
(kc,evento,descripcion,descripcionevento,naturaleza,usuario,fecha,hora,entidad,
keyPA,almacenSolicitante,almacenDestino,costo,cantidad,cantidadtotal,
descripcionArticulo,existencia,existenciaTotal,otro,gpoProducto,tipoMovimiento,
almacenConsumo,io,cajaCon,status,cbarra,numSolicitud)
values
('".$myrowy['codigo']."','".$codigoInv."',
    '".$myrow8acd['tipoMovimiento']."',
    '".$myrow8acd['descripcion']."','".$myrow8acd['naturaleza']."',
        '".$usuario."','".$fecha1."',
        '".$hora1."',
    '".$entidad."','".$myrow8ac['keyPA']."','".$almacen."',
        '".$almacen."',
        '".$c."',
        1,1,'".$myrow8ac['descripcion']."','".$myrow8ac1e['entrada']."',
            '".$myrow8ac1e['entrada']."',
        '".$myrow8acd['otro']."','".$myrow8acd['descripcion']."',
            '".$myrow8acd['tipoMovimiento']."',
            '".$myrowk['almacenConsumo']."','ENTRADA',
                '".$myrow8ac['cajaCon']."','final','".$myrow8ac['cbarra']."',
                '".$numSolicitud."'
         )";

mysql_db_query($basedatos,$q1ab);
echo mysql_error();
//CIERRO AFECTACION DE KARDEX************************************************

}      
}
}


$q1a = "UPDATE entradaArticulos set 
status='registrado'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}
}
?>

















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
<style>
    input{ 
text-align:right; 
}


.inpu{
   font-size: 0.875em;
}
</style>
</head>

<h1 align="center" ><br />
Ajuste a existencias Manuales [Arranque de Inventarios]<br />


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
  
  
  
   
  
  

  
  
  
  
 
  <table width="600" class="table-forma">

     
  
      
      
      
      
      
      
      
      
    <tr >
        <td>
   <p align="center"><div align="left"><span >Almacen
   </span> </div>
       <div align="center">
     <?php 
	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
     <select name="departamento" class="camposmid" id="departamento"  onchange="this.form.submit();"/>
 <option value="">Escoje</option>
     
     <?php while($resCombo = mysql_fetch_array($rCombo)){ 	?>
     <option 
<?php if($_POST['departamento']==$resCombo['almacen'])echo 'selected=""';?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
     <?php } ?>
     </select>
   </div>
   </p>
        </td>
        
        
        
        
    </tr>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
<?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' 
and
almacen='".$_POST['departamento']."'
   group by tipoAnaquel
   order by tipoAnaquel ASC

";
$rCombo=mysql_db_query($basedatos,$aCombo); 
$resCombo = mysql_fetch_array($rCombo);

  




if($resCombo['tipoAnaquel']!=NULL){
?>        
      
      
      
      
      <tr>
          <td>Anaquel
              <div align="center">
                <?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' 
and
almacen='".$_POST['departamento']."'
   group by tipoAnaquel
   order by tipoAnaquel ASC

";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
     <select name="anaquel" class="camposmid" id="anaquel" onChange="this.form.submit();" />
     <option value="" <?php if(!$_POST['anaquel'])echo 'selected=""';?>>Escoje la Opcion</option>
     <?php while($resCombo = mysql_fetch_array($rCombo)){ 	
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  entidad='".$entidad."'
      and
  codigoAnaquel='".$resCombo['tipoAnaquel']."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
       
         ?>
     <option 
<?php if($_POST['anaquel']==$resCombo['anaquel'])echo 'selected=""';?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $myrow12['tipoAnaquel'].' ['.$resCombo['anaquel'].']'; ?></option>
     <?php } ?>
     </select>
              </div>
          </td>
      </tr>
  <?php }?>    
      
      

  </table>

<p>&nbsp;</p>
  
  
  
<?php 

if($_POST['departamento']!=NULL){

    if($_POST['anaquel']==11 or $_POST['anaquel']==10 or $_POST['anaquel']==13){
$sSQL= "Select * From existencias,articulos where
existencias.entidad='".$entidad."'
    and
    almacen='".$_POST['departamento']."'
    and
    existencias.anaquel='".$_POST['anaquel']."'
        and
        existencias.codigo=articulos.codigo
        and
        articulos.activo='A'
        and
        articulos.sustancia!=''
order by articulos.sustancia ASC";  
$especial=TRUE;
}else{
    if($_POST['anaquel']!=NULL){
$sSQL= "Select * From existencias,articulos where
existencias.entidad='".$entidad."'
    and
    almacen='".$_POST['departamento']."'
    and
    existencias.anaquel='".$_POST['anaquel']."'
        and
        existencias.codigo=articulos.codigo
        and
        articulos.activo='A'
        and
        articulos.descripcion!=''
order by articulos.descripcion ASC";
    }else{
    $sSQL= "Select * From existencias,articulos where
existencias.entidad='".$entidad."'
and
    almacen='".$_POST['departamento']."'
        and
        existencias.codigo=articulos.codigo
        and
        articulos.activo='A'
        and
        articulos.descripcion!=''
order by articulos.descripcion ASC";    
    }


}
?>


<table>
    
    <tr>
     
        
    </tr>
    
    
    
    
    <tr>
        <td>
 <input name="add" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="Grabar" />
        </td>
        <td>
            
        </td>
           <td>
            
        </td>
        <td>
            <input type="button" value="Imprimir" onClick="javascript:ventanaSecundaria1('../ventanas/printListaExistencias.php?almacen=<?php echo $_POST['departamento'];?>&anaquel=<?php echo $_POST['anaquel'];?>')"></input>            
            
            

        </td>
        
        <td>
<input name="conversion" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="Conversion a SIMA" />                
            
        </td>
     
        
        
        
    </tr>
    
</table>



   
  
    <br>


<br></br>


<?php if($especial==TRUE){
    echo '*Nota: este anaquel estan ordenado por sustancia!';
}?>


<table width="700" class="table table-striped">
     <tr >
       <th width="5" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>
<th width="20"  scope="col"><div align="left" >
  <div align="left">FechaA</div>
</div></th>
       <th width="200"><div align="left" >
         <div align="left">Descripcion</div>
       </div></th>
       <th width="30" ><div align="left" >
         <div align="left">Cantidad</div>
       </div></th>
     
            <th width="30"><div align="left" >
         <div align="left">Costo</div>
       </div></th>
         
         
       <th width="30" ><div align="left" >
       <div align="left">Total</div>
       </div></th>
        
         
      <th width="30" ><div align="left" >
       <div align="left">Status</div>
       </div></th>         
         
     </tr>
     
     
     
     
        	    <?php   
				

 
 
 

$result=mysql_db_query($basedatos,$sSQL);
 if(count($result)>0){
while($myrow = mysql_fetch_array($result)){ 
    
    
    $sSQL11= "SELECT 
 *
FROM
  articulos
  WHERE 
  entidad='".$entidad."' 
  AND
  codigo='".$myrow['codigo']."'
  ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$f+=1;

if($myrow11['descripcion']!=NULL){
    
//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$myrow['codigo']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
?> 





     <tr>
       <td ><?php echo $f;?></td> 
       <td ><span >

	   <?php 
           if($myrow11['fecha']!=NULL){
           echo cambia_a_normal($myrow11['fecha']);}else{echo '---';}?>	 
	   </span></td>
       
           <td ><span >
           <?php 
           if($especial==TRUE){
           echo $myrow11['sustancia'];    
           }else{
           echo $myrow11['descripcion'];}?></span>
       </td>
       
                  <td ><?php $totalExistencia[0]+= $myrow['existenciaInicial'];?>
                      <span >
                          <input name="existenciaInicial[]" type="text" size="5" class="inpu" autocomplete="off"
                              value="<?php echo $myrow['existenciaInicial'];?>">
                          </input>
                      </span>
       </td>
       
       
       
       
       
                 <td ><?php $totalCosto[0]+= $myrow3ac['costo'];?>
                     <div align="right">
                          <?php echo '$'.number_format($myrow3ac['costo'],2);?>
                     </div>
                          </input>
                      </span>
       </td> 
       
       
                   <td >
                       <div align="right">
                          <?php
                          $total[0]+=$myrow['existenciaInicial']*$myrow3ac['costo'];
                          echo '$'.number_format($myrow['existenciaInicial']*$myrow3ac['costo'],2);?>
                         
                      </div>
       </td> 
       
       <td>
       <div align="right">
             <?php 
  if($myrow['status']!=''){
  
  echo $myrow['status'];
  }else{
      echo 'standby';
  }
  
  ?>
       </div>
       </td>
       
     </tr>
    
    <input name="codigo[]" type="hidden" value="<?php echo $myrow['codigo'];?>"></input>
     <?php }}}?>
    
    
    <tr>
        <td>
         TOTALES  
     </td>
             <td>
        
     </td>
             <td>

     </td>
        
        
<td><div align="center">
     <?php echo $totalExistencia[0];?>
    </div>
     </td>

        
        
      <td>
     <?php //echo '$'.number_format($totalCosto[0],2);?> 
     </td>
        
     <td>
         <div align="right">
     <?php echo '$'.number_format($total[0],2);?> 
         </div>
     </td>
        
        
        
             <td>
         <div align="right">
     <?php echo '$'.number_format($total[0],2);?> 
         </div>
     </td>
     </tr>
   </table>
<?php }?>



<?php if($f>0){?>
<br></br>

<br></br>

<div align="center">
               <input name="add" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="Grabar" />
                 </div> 
 
</table>
<?php }?>
</form>

<br>
<br>

</body>
</html>