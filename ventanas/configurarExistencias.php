<?php require("/configuracion/funciones.php");
//actualizar ******************************************************************************************************
 if(!$_POST['keyPA']){
$_POST['keyPA']=$_GET['keyPA'];
}


//REFRESHING
        $q = "

    INSERT INTO solicitudes(numSolicitud,usuario,fecha,entidad,keyClientesInternos,hora,modulo)
    SELECT(IFNULL((SELECT MAX(numSolicitud)+1 from solicitudes where entidad='".$entidad."'), 1)), '".$usuario."',
    '".$fecha1."','".$entidad."','".$_GET['keyClientesInternos']."','".$hora1."','confExistencias'";
    //mysql_db_query($basedatos,$q);
    echo mysql_error();
    
    
    

$cendis=new whoisCendis();
$aP=$centroDistribucion=$cendis->cendis($entidad,$basedatos);  









if($_POST['quitar'] AND $_POST['keyE1'] ){

    
    
$cantidadSurtir=$_POST['cantidadSurtir'];
$almacen=$_POST['almacen'];
$existencia=$_POST['existencia'];
$keyE=$_POST['keyE1'];
$cantidad=$_POST['mover'];
 $eCendis=$_POST['eCendis'];

for($i=0;$i<=count($keyE);$i++){


    if($keyE[$i]>0){
 $sSQL33= "Select * From existencias WHERE keyE='".$keyE[$i]."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 

$q1a = "DELETE FROM articulosExistencias WHERE
    entidad='".$entidad."'
        and
almacen='".$myrow33['almacen']."'

";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	


  $q1a = "DELETE FROM articulosExistenciasGranel WHERE
    entidad='".$entidad."'
        and
almacen='".$myrow33['almacen']."'

";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}//while
    }

}//for
























































if($_POST['actualizar'] AND $_POST['keyE'] ){

    
    
$cantidadSurtir=$_POST['cantidadSurtir'];
$almacen=$_POST['almacen'];
$existencia=$_POST['existencia'];
$keyE=$_POST['keyE'];
$cantidad=$_POST['mover'];
 $eCendis=$_POST['eCendis'];

for($i=0;$i<=count($keyE);$i++){

    if($keyE[$i]>0){


        

/*
$existencia[$i]=(int) $existencia[$i];
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA, SOLO CAMBIA DE ALMACEN
//QUIEN SALE?
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
almacen='".$aP."'
    and
status='ready' 


order by keyAE ASC
limit 0,$existencia[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ir+=1;				
			


    //echo $ir.' -> '.$existencia[$i];echo '<br>';


$sSQL33= "Select * From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' and almacen='".$almacen[$i]."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 
$myrow33['existencia']=(int) $myrow33['existencia'];
//echo $myrow33['existencia'].'  '.$existencia[$i].'<br>';
if($myrow33['existencia']!=$existencia[$i]){
 $q1a = "UPDATE articulosExistencias set 
almacen='".$almacen[$i]."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	
}
}



*/
      
         $q = "UPDATE existencias set
        existencia='".$existencia[$i]."',cantidadSurtir='".$cantidadSurtir[$i]."'
             
  
            


WHERE
keyE='".$keyE[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
























/*        
if($existencia[$i]>0 ){
    if($existencia[$i]<$eCendis){
 $q = "UPDATE existencias set
        existencia='".$existencia[$i]."'
             
  
            


WHERE
keyE='".$keyE[$i]."'
";
//mysql_db_query($basedatos,$q);
echo mysql_error();

//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA, SOLO CAMBIA DE ALMACEN
//QUIEN SALE?
//

$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
almacen='".$aP."'
    and
status='ready' 


order by keyAE ASC";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ir+=1;				
			


   // echo $ir.' -> '.$cantidad[$i];echo '<br>';

    
    
if($ir<=$existencia[$i]){

$q1a = "UPDATE articulosExistencias set 
almacen='".$almacen[$i]."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	
$exit='si';

}//termina validacion de cantidad
}//termina while



}else{
    echo '<div class="error">ERROR: Tu cantidad no debe ser mayor a la existencia en CENDIS!</div>';
}
}
}  
}
echo '<div  class="success">Existencias Actualizadas!</div>';
if($exit=='si'){
 
?>
<script>
//window.alert("Existencias Actualizadas");
//window.close();
//window.document.forms["form2"].submit();
window.location("listaAlmacenesTodos.php");
</script>

<?php 

}
}















/*
$sSQL33= "Select * From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' and almacen='".$aP."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);    
*/


/*
//ENtRADAS
$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
    tipoMov='entrada'
    and
    almacen='".$aP."'

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
codigo='".$_GET['codigo']."'
    and
    tipoMov='salida'
    and
     almacen='".$aP."'
      
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
$existenciasCendis=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];
*/



  










/*
$sSQL33= "Select * From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' and almacen='".$almacen[$i]."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);       
   
if($cantidad[$i]>0){//solamente entra si hay cantidad


if($myrow33['existencia']>0 AND ($cantidad[$i]<=$myrow33['existencia'])){

    
    
    

    



if($existenciasCendis>0 and $cantidad[$i]<=$existenciasCendis){ 
if($keyE[$i]!=NULL){



//VERIFICO SI HAY DISPONIBILIDAD PARA MOVER
//ENtRADAS
$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
configurarExistencias
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
    tipoMov='entrada'
    and
    almacen='".$almacen[$i]."'

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
configurarExistencias
and
codigo='".$_GET['codigo']."'
    and
    tipoMov='salida'
    and
     almacen='".$almacen[$i]."'
      
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
$existencias=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];




		
		
	

//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA, SOLO CAMBIA DE ALMACEN
//QUIEN SALE?
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
almacen='".$aP."'
    and
status='ready' 


order by keyAE ASC";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ir+=1;				
			


   // echo $ir.' -> '.$cantidad[$i];echo '<br>';

    
    
if($ir<=$cantidad[$i]){

$q1a = "UPDATE articulosExistencias set 
almacen='".$almacen[$i]."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	
}
}











$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='SE ACTUALIZARON DATOS...';

}//cierra validación 
}else{
$mensaje= '<div class="error">LA CANTIDAD A MOVER DEBE SER MENOR QUE LA CONFIGURACION DE EXISTENCIA!</div>';
}
}
}*/
        
        
}//cierra cantidad>0


}
echo '<div class="success">Se hicieron cambios!</div>';
}//cerrar for






//****************************************************************************************************************************








?>






<?php  

/*

if($_GET['aly']!=NULL AND (!$_POST['actualizar'] AND ($_GET['keyE'] AND ($_GET['inactiva']=='si' or $_GET['activar']=='si')))){
$existencia=$_POST['existencia'];
if($_GET['inactiva']=="si"){

    
    $sSQL33= "Select * From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' and almacen='".$_GET['aly']."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);    
    
    
    
    
    
//VERIFICO SI HAY DISPONIBILIDAD PARA MOVER
//ENtRADAS
$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and
    tipoMov='entrada'
    and
almacen='".$_GET['aly']."'

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
codigo='".$_GET['codigo']."'
    and
    tipoMov='salida'
    and
almacen='".$_GET['aly']."'
      
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
$existencias=$myrow8ac1e['entrada']-$myrow8ac1s['salida'];    
    
    
    
 $sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
almacen='".$_GET['aly']."'
    and
status='ready' 
order by keyAE ASC";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ir+=1;				
			

	

//*******************ACTUALIZO EXISTENCIAS***********************
$sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);
    
if($myrow8ac['cajaCon']>0){
    $ct=$existencias*$myrow8ac['cajaCon'];
}else{
    $ct=$existencias;
}

echo $ct;
//****************************************************************





if($ir<=$existencias){
$q1a = "UPDATE articulosExistencias set 
almacen='".$aP."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
//mysql_db_query($basedatos,$q1a); 
echo mysql_error();

}
}

    
    
    
    

	} 
   $mensaje= '<div class="error">EXISTENCIAS ACTUALIZADAS!</div>';  
        }


*/

?>













<?php  
if($_GET['keyE'] AND ($_GET['inactiva']=='si' or $_GET['activar']=='si')){

if($_GET['inactiva']=="si"){
$borrameNivel = "UPDATE existencias
set
existencia='',
tipoVenta='',
ventaGranel='',
cantidadSurtir=''
WHERE
keyE='".$_GET['keyE']."'";
//mysql_db_query($basedatos,$borrameNivel);
echo mysql_error();


$tipoMensaje='error';
$encabezado='Exitoso';
$texto='PRODUCTO A GRANEL DESACTIVADO!';
	} elseif($_GET['activar']=='si'){
        $borrameNivel = "UPDATE existencias
set      

    
    
modoventa='Granel',
tipoVenta='Granel',
ventaGranel='si'

WHERE
keyE='".$_GET['keyE']."'";
//mysql_db_query($basedatos,$borrameNivel);
echo mysql_error();


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='PRODUCTO A GRANEL ACTIVADO!';    
        }



}
?>
















<?php

    if($_POST['transfer']!=NULL and $_POST['keyE']!=NULL){
        
$cantidadSurtir=$_POST['cantidadSurtir'];
$almacen=$_POST['almacen'];
$existencia=$_POST['existencia'];
$keyE=$_POST['keyE'];
$cantidad=$_POST['mover'];
 $eCendis=$_POST['eCendis'];
$sembrar=$_POST['sembrar'];
//print_r($_POST['sembrar']);
 
for($i=0;$i<=count($keyE);$i++){


    if($sembrar[$i]>0){  
        
//PRIMERO CHECO SI ES A GRANEL        
        
    
//AQUI AJUSTA EXISTENCIAS COMO UNA SALIDA, SOLO CAMBIA DE ALMACEN
//QUIEN SALE?
$existencia[$i]=(int) $existencia[$i];
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
almacen='".$centroDistribucion."'
    and
status='ready' 


order by keyAE ASC
limit 0,$sembrar[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){
$ir+=1;				
			


//echo $ir.' -> '.$existencia[$i];echo '<br>';


//SALEN CANTIDADES ENTERAS
$q1a = "UPDATE articulosExistencias set 
almacen='".$almacen[$i]."'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();	





//VERIFICAMOS EL TIPO DE VENTA NORMAL/GRANEL
$sSQL33= "Select * From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."' and almacen='".$almacen[$i]."' ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);   
$tope=(int) $sembrar[$i]*$myrow33['cantidadSurtir'];

if($myrow33['ventaGranel']=='si'){
//CONVERSION A UNIDADES
//A CUANTO EQUIVALE UNA UNIDAD? 
if($tope>0){    
$sSQLy= "
SELECT * 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
and

    
    almacen='".$almacen[$i]."'
    and
status='ready' 
order by keyAE ASC
limit 0,$existencia[$i]
";


$resulty=mysql_db_query($basedatos,$sSQLy);
while($myrowy = mysql_fetch_array($resulty)){

for($irr=0;$irr<$tope;$irr++){

 $agrega = "INSERT INTO articulosExistenciasGranel (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,keyClientesInternos,folioVenta,costo,keyAEVenta,tipo,factura,status)
values
('".$myrowy['codigo']."','".$myrowy['keyPA']."','".$gpoProducto."','1','granel','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$almacen[$i]."','".$keyClientesInternos."','".$folioVenta."','".$myrowy['costo']."','".$myrowy['keyAE']."','".$myrowy['tipo']."',
'".$myrowy['factura']."','ready'	)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}

//TENGO QUE SACAR LAS EXISTENCIAS QUE USE EN EL BOTIQUIN
$q1a = "UPDATE articulosExistencias set 
status='sold'

WHERE
keyAE='".$myrowy['keyAE']."'
";
mysql_db_query($basedatos,$q1a); 
echo mysql_error();
}
}
}


}





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
    
    <h1>
CONFIGURACION DEL PRODUCTO
    </h1>
    
    
    
    
    

    <h3>
<?php 
//MENSAJES
echo $mensaje;
?>
</h3>


<?php
$sSQL33a= "Select codigo From existencias WHERE entidad='".$entidad."' and  codigo='".$_GET['codigo']."'  ";
$result33a=mysql_db_query($basedatos,$sSQL33a);
$myrow33a = mysql_fetch_array($result33a);

if($myrow33a['codigo']){ ?>


<form id="form2" name="form2" method="POST" >

      <p>
 <span >
    
	   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>


<?php 
	echo '</br>';
	$sSQL6="SELECT descripcion,servicio,medico,codigo
FROM
  `articulos`
WHERE
entidad='".$entidad."'
    and
codigo='".$_GET['codigo']."'
 
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  
  //***************EXISTENCIAS CENDIS****************
//ENtRADAS
$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and

    almacen='".$aP."'
        and
        status='ready'

";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);

$eCendis=$myrow8ac1e['entrada']; 
echo '<br>';
  echo 'Existencias en CenDis: '. (int) $eCendis;	 
  ?></span>
        
        <input name="keyPA" type="hidden"  id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
        </p>

    

  <table width="550" class="table table-striped">
        <tr>
          <th width="5" align="left"  class="normal">#</th>
          <th width="100" align="left"  class="normal">Descripcion</th>



<th width="10" align="left" class="normal" >CSurtir</th>
<th width="10" align="left" class="normal" >Maximo</th>
<th width="10" align="left" class="normal" >Sembrar</th>

            <th width="10" align="left" class="normal" >Entero</th>
<th width="10" align="left" class="normal" >Unidades</th>
<th width="1" align="left" class="normal" ></th>
       
        </tr>
<?php 

  
 $sSQL= "Select * From existencias
where entidad='".$entidad."' AND codigo='".$_GET['codigo']."'
and
almacen!='".$aP."'
group by almacen
";

 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];




 $sSQL6="SELECT codigo,nivel1,nivel3,almacen
FROM
  articulosPrecioNivel
WHERE (keyPA='".$_POST['keyPA']."' or codigo='".$_GET['codigo']."')  and almacen = '".$myrow['almacen']."'
and
codigo>0
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);

 
  
  
$sSQL661="SELECT id_medico,descripcion,stock
FROM
  almacenes
WHERE entidad='".$entidad."' AND almacen = '".$myrow['almacen']."'
  ";
  $result661=mysql_db_query($basedatos,$sSQL661);
  $myrow661 = mysql_fetch_array($result661);
  
 
  
$sSQL6f="SELECT *
FROM
camposGrupos
WHERE entidad='".$entidad."' and gpoProducto='".$grupo."'  and id_almacen = '".$myrow['almacen']."'
  ";
  $result6f=mysql_db_query($basedatos,$sSQL6f);
  $myrow6f = mysql_fetch_array($result6f);
 
  
  



 
?>
   
        <tr  >
          <td  align="left">
              <span >
                  <?php 
                  //echo $myrow['keyE'];
                  //echo '<br>';
                  echo $bandera;?>
              </span></td>
          <td><span >
            <?php 
		if($myrow['medico']=='si'){
		echo $myrow661['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow661['descripcion'];
		}
		?></span>
            <br /><span class="negro">Codigo Almacen</span><span class="codigos">
            <?php echo $myrow['almacen'];?>
            <input name="id_medico[]" type="hidden"  value="<?php echo $myrow661['id_medico']; ?>" />
            <input name="almacen[]" type="hidden"  value="<?php echo $myrow['almacen']; ?>" />
            </span></td>

          
          
          
         
                    


          
   
          
          

          
          
     <td align="left">    
<?php if($myrow['ventaGranel']=='si'){?>     
         
         <input type="text" name="cantidadSurtir[]" size="3" value="<?php echo (int) $myrow['cantidadSurtir'];?>" <?php //if($myrow['cantidadSurtir']<1){echo 'readonly=""';}?>/></input>         
<?php     }else{?>
<input type="hidden" name="cantidadSurtir[]" size="3" value="<?php echo (int) $myrow['cantidadSurtir'];?>" <?php //if($myrow['cantidadSurtir']<1){echo 'readonly=""';}?>/></input>         
     <?php }?>
     </td>      
          
          
          
           <td align="left">    
               <?php if($myrow['ventaGranel']=='si'){?> 
               <input type="text" name="existencia[]" size="3" value="<?php echo (int) $myrow['existencia'];?>" <?php //if($myrow['cantidadSurtir']<1){echo 'readonly=""';}?>/></input>         
        <?php     }else{?>
           <input type="hidden" name="existencia[]" size="3" value="<?php echo (int) $myrow['existencia'];?>" <?php //if($myrow['cantidadSurtir']<1){echo 'readonly=""';}?>/></input>         
                <?php }?>
           </td>         
    
            
                      <td align="left">    
               <input type="text" name="sembrar[]" size="3" /></input>         
        </td> 
            
          
          <td align="left">
          <?php 
  //SALIDAS
$sSQL8ac1s= "
SELECT sum(cantidad) as egranel
FROM
articulosExistenciasGranel
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and

    almacen='".$myrow['almacen']."'
      
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s); 
$ee=$myrow8ac1s['egranel'];

//ENtRADAS
$sSQL8ac1e= "
SELECT sum(cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$_GET['codigo']."'
    and

    almacen='".$myrow['almacen']."'
        and
        status='ready'

";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);


$existencia=$myrow8ac1e['entrada'];            
          
if($ee>0 and $myrow['cantidadSurtir']>0){
    echo (int) $ee/$myrow['cantidadSurtir'];
}else{
          echo (int) $existencia;
}
          
          ?>
          </td>
          

     
           <td align="left">
          <?php

if($ee>0){
          echo (int) $ee;}else{echo '---';}?>
          </td>  
          

          <td align="left">
<input type="checkbox" name="keyE1[]" value="<?php echo $myrow['keyE'];?>" /></input>         
          </td>  
          
          
          
          






<input name="keyE[]" type="hidden"  id="actualizar" value="<?php echo $myrow['keyE'];?>" /> 


    </tr>

      <?php }?>
  </table>

<p>&nbsp;</p>
      
	        
<p align="center">
    

    
      <label><span >

      <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
      </span>
          
          
          
<?php if($tipoUsuario=='administrador'){?>  
          
          
      <table>
          <tr><td>
      <input name="actualizar" type="submit"   value="Efectuar Cambios" />
              </td>
        
        <td>
        <input name="transfer" type="Submit"  value="Sembrar" />  
         </td>              
              
              
              <td>
        <input name="quitar" type="submit"  value="Reset" />  
         </td>
              

          </tr>
      </table>
          <?php }else{ ?>
         
              <blink>Solo Administrador puede hacer cambios...</blink>    
          
              <?php }?>
      
      
      
      
      </label>

	
     <input name="opcion" type="hidden"  id="opcion" value="<?php echo $_POST['opcion'];?>" />
      <input name="keyPA" type="hidden"  id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
      <input name="eCendis" type="hidden"  id="existenciasCendis" value="<?php echo $eCendis;?>" />
    </p>
</form>

  <?php } else{ ?>
  
 <span class="error" >EL ARTICULO NO TIENE ALMACENES DEFINIDOS</span>
  
  <?php } ?>


  
  
</body>
</html>