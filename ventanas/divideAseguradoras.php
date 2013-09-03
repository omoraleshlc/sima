<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
//215430625 maguila
$medico=$_GET['medico'];
?>

  <?php
$sql5= "
SELECT nomCliente,numCliente,clientePrincipal
FROM
clientes
WHERE
entidad='".$entidad."' AND
numCliente='".$_GET['numCliente']."'";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
$aseguradora=$myrow5['clientePrincipal'];
$seguro=$myrow5['numCliente'];




$sSQL455= "Select * from datosfacturacion where entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);






?>


<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=500,scrollbars=YES")
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript>
function ventanaSecundaria110 (URL){
   window.open(URL,"ventanaSecundaria110","width=600,height=600,scrollbars=YES")
}
</script>



<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

  <script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventanaSecundaria4","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="Javascript" type="text/javascript">
function ir_al_final() {
        document.body.scrollTop = document.body.offsetHeight;
}
</script>


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
                alert("Por Favor, escoje como quieres agregar articulos!")
                return false   
        }            
}   
  
  
  
  
</script> 








<?php 

/*
if($_POST['actualizar']  and $_POST['folioVenta']){
$keyCAP=$_POST['keyCAP'];



//**************FACTURAS APLICADAS*********
$quitar= "
DELETE
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and
status='request'
";
//mysql_db_query($basedatos,$quitar);
echo mysql_error();
$quitar1= "
DELETE
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
and
status='request'
";
//mysql_db_query($basedatos,$quitar1);
echo mysql_error();
//*********************************************


for($i=0;$i<$_POST['flag1'];$i++){



if($keyCAP[$i]){


 $sql5d= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
keyCF='".$keyCAP[$i]."'
    and
    random='".$_GET['random']."'
 ";
$result5d=mysql_db_query($basedatos,$sql5d);
$myrow5d= mysql_fetch_array($result5d);

if(!$myrow5d['keyCF']){
 $agrega = "INSERT INTO facturasAplicadas (
entidad,numFactura,nT,usuario,fecha,hora,keyCF,importe,seguro,folioVenta,status,facturacionEspecial,porcentaje,keyMov,random)
values ('".$entidad."','',
'','".$usuario."','".$fecha1."','".$hora1."','".$keyCAP[$i]."','".$myrow5['precioVenta']."','".$seguro."',
'".$_POST['folioVenta']."','request' ,'".$myrow5a['facturacionEspecial']."' ,'".$porcentaje."','".$_GET['keyMOV']."','".$_GET['random']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



//*******ACTUALIZO SOLO EL MOVIMENTO CONTABLE A FACTURAR****************
$actualizad = "UPDATE cargosCuentaPaciente
set
random='".$_GET['random']."'
where

keyCAP='".$keyCAP[$i]."'

";
mysql_db_query($basedatos,$actualizad);
echo mysql_error();
//************************************

$sSQL7="SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as totalCuenta
  FROM
cargosCuentaPaciente
  WHERE
entidad='".$entidad."'
and
  folioVenta='".$_POST['folioVenta']."'
  and
  naturaleza='C'
  and
  gpoProducto=''
  ";

  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT
sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as totalCuenta
  FROM
cargosCuentaPaciente
  WHERE
entidad='".$entidad."'
and
  folioVenta='".$_POST['folioVenta']."'
  and

  naturaleza='A'
  and
  gpoProducto=''


  ";

  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);

  $totalCuenta=$myrow7d['totalCuenta']-$myrow7['totalCuenta'];





//********************************************************************************************************
//********************************************************************************************************






//*************************AGREGAR DATOS DIRECTAMENTE*********************

$sql5a1= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$keyCAP[$i]."'

";
$result5a1=mysql_db_query($basedatos,$sql5a1);
$myrow5a1= mysql_fetch_array($result5a1);
echo mysql_error();

 $sql5a= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
    folioVenta='".$_POST['folioVenta']."'
and
gpoProducto!=''
order by fecha1

";

 
$result5a=mysql_db_query($basedatos,$sql5a);
while($myrow5a= mysql_fetch_array($result5a)){





$transaccion=$myrow5a1['precioVenta']*$myrow5a1['cantidad'];
$porcentaje=$transaccion/$totalCuenta;

     $it=($myrow5a['cantidadParticular']*$myrow5a['cantidad'])*$porcentaje;
    $ivT=($myrow5a['ivaParticular']*$myrow5a['cantidad'])*$porcentaje;









//***********VALIDA GRUPOS PARA INSERTAR
$sql5= "
SELECT *
FROM
facturaGrupos
WHERE
keyCAP='".$keyCAP[$i]."'
    and
    keyCAPMov='".$keyCAP[$i]."'
 ";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
//CIERRA VALIDACION DE GRUPOS


if(!$myrow5['keyCAPMov']){


//INSERTAR MEDICOS***********


//***************************



$agrega = "INSERT INTO facturaGrupos (
entidad,numFactura,gpoProducto,extension,folioVenta,status,importe,iva,tipoTransaccion,keyCAP,naturaleza,keyCAPMov,random)
values ('".$entidad."','".$_POST['folioFactura']."','".$myrow5a['gpoProducto']."',1,
    '".$_POST['folioVenta']."','request' ,'".$it."' ,'".$ivT."','".$myrow5a['tipoPago']."' , '".$myrow5a['keyCAP']."'  ,'".$myrow5a['naturaleza']."',
        '".$keyCAP[$i]."','".$_GET['random']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
 $actualiza = "UPDATE facturaGrupos
set
importe='".$it."',
iva='".$ivT."'
where

keyCAP='".$myrow5a['keyCAP']."'
and
random='".$_GET['random']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

}//insertar
}
}

//*****************************************************************************


}

}
c
?>
<script>
//window.close();
</script>
<?php 

}


*/

?>























<?php 

if($_POST['elimina'] and $_POST['keyIM']){

$keyIM=$_POST['keyIM'];


for($i=0;$i<$_POST['flag1'];$i++){

if($keyIM[$i]){
			
		
	 $sql5= "
SELECT *
FROM
facturaGrupos

WHERE keyNFac='".$keyIM[$i]."'
 ";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
					
				
			
		
	 
$borrame1 = "DELETE FROM facturaGrupos WHERE keyNFac='".$keyIM[$i]."' ";
mysql_db_query($basedatos,$borrame1);
echo mysql_error();




$borrame2 = "DELETE FROM facturasAplicadas WHERE  entidad='".$entidad."' and folioVenta='".$myrow5['folioVenta']."' and numSolicitud='".$_GET['numSolicitud']."'";
mysql_db_query($basedatos,$borrame2);
echo mysql_error();
//************************************************************
}
}

$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Se desactivaron folios de venta';
}

?>



<?php





?>



<?php if($_POST['continue']){ ?>

<script>
javascript:ventanaSecundaria4('escojerImporteParticular.php?random=<?php echo $_GET['random'];?>');

//opener.location.reload();


window.close();
</script>

<?php 
}
?>










<?php

if($_POST['insert']!=NULL){
//EXISTE EL FOLIO DE VENTA?
  $sql5d= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
    and
folioVenta='".$_POST['folioVenta']."' 
and
statusCuenta='cerrada'
and
clientePrincipal='".$_POST['seguro']."'
    and
    gpoProducto=''
group by clientePrincipal
";
$result5d=mysql_db_query($basedatos,$sql5d);
$myrow5d= mysql_fetch_array($result5d);

$sql5= "
SELECT *
FROM
clientes
WHERE
entidad='".$entidad."' 
    AND
folioVenta='".$_POST['folioVenta']."' 
    ";
//$result5=mysql_db_query($basedatos,$sql5);
//$myrow5= mysql_fetch_array($result5);

//	1 	keyIM 	int(11) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	2 	numSolicitud 	int(11) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	3 	folioVenta 	varchar(50) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	4 	status 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	5 	statusDevolucion 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	6 	entidad 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions

if($myrow5d['folioVenta']!=NULL){
    
//EXISTE EN INVOICES MAIN ESE FOLIO?
  $sql5da= "
SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
folioVenta='".$_POST['folioVenta']."' 
and
numSolicitud='".$_GET['numSolicitud']."'
    and
    status='request'

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    
if(!$myrow5da['folioVenta']){
$agrega = "INSERT INTO facturaGrupos (
numSolicitud,folioVenta,status,statusDevolucion,entidad,paciente,fecha,tipoFacturacion,clientePrincipal)
values ('".$_GET['numSolicitud']."','".$myrow5d['folioVenta']."','request',
    '','".$entidad."','".$myrow5['paciente']."','".$myrow5d['fecha1']."','aseguradora','".$myrow5d['clientePrincipal']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{
    $tipoMensaje='error';
$encabezado='Error';
$texto='YA EXISTE ESE FOLIO ...!';
}
}else{
     $tipoMensaje='error';
$encabezado='Error';
$texto='NO EXISTE EL FOLIO ...!';   
}
}



















if($_POST['preview']!='' and $_POST['flag1']>0 and $_POST['facturar']>0){ 
    $importe=$_POST['importe'];
    $folioVenta=$_POST['folioVenta1'];
    $facturar=$_POST['facturar'];
$rfc=$_POST['rfc'];    
    



  












//IF DE IGUALAS              
$sSQL4= "Select * from facturacionconfigurada where entidad='".$entidad."' and clienteprincipal='".$_POST['seguro']."' ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
echo mysql_error();





/*
//ACTUALIZAR ENCABEZA
$actualiza2 = "UPDATE facturasAplicadas
set
numFactura='".$_POST['numFactura']."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();



//ACTUALIZAR ENCABEZA
$actualiza = "UPDATE facturaGrupos
set
numFactura='".$_POST['numFactura']."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();
//CIERRA ACTUALIZA
    
 * 
 * 
 * 
 */






    
$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$rfc=$myrow455['rfc'];

$sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numSolicitud='".$_GET['numSolicitud']."'   ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

if($rfc and !$myrow2a['numSolicitud']){
$sql0 = "INSERT INTO datosfacturacion
(razonSocial,
		calle,
	 	colonia,
	 	ciudad,
	 	estado,
	 	cp,
	 	delegacion,
	 	pais,
	 	entidad,
	 	rfc,
	 	calle1,
	 	numFactura,numSolicitud
                )
values
(
'".$myrow455['razonSocial']."',
'".$myrow455['calle']."','".$myrow455['colonia']."',
    '".$myrow455['ciudad']."','".$myrow455['estado']."',
    '".$myrow455['cp']."','".$myrow455['delegacion']."',
        '".$myrow455['pais']."','".$entidad."','".$myrow455['rfc']."',
            '".$myrow455['calle1']."','".$_POST['numFactura']."','".$_GET['numSolicitud']."')

";

mysql_db_query($basedatos,$sql0);
echo mysql_error();
}
    
    
    


    
    
    
    
for($i=0;$i<=$_POST['flag1'];$i++){
       
        
    
if($facturar[$i]>0 or ($_POST['iguala']=='si' and $myrow4['importe']>0)){
if($facturar[$i]<=$importe[$i] or ($_POST['iguala']=='si' and $myrow4['importe']>0)){  
        

              
              
              
        
$sSQL23= "Select * From paquetes WHERE keyPAQ ='".$myrow4['keypaq']."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 




if($_POST['iguala']=='si' and $myrow4['importe']>0){  //aqui entra el concepto de la iguala        
     $actualiza = "DELETE FROM facturasAplicadas where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."' ";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();                 
    
    
 $sql5da= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
    

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    




if(!$myrow5da['numSolicitud']){    
    
$sSQL= "SELECT 
*
FROM
articulosPaquetes

WHERE entidad='".$entidad."' AND codigoPaquete = '".$rNombre23['codigoPaquete']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);

if($result){
while($myrow = mysql_fetch_array($result)){  
    
    
 $sSQL6="SELECT *
FROM
articulos
WHERE 
entidad='".$entidad."' 
AND
codigo = '".$myrow['codigo']."' 

  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);    
  
  
$sSQL38= "
SELECT 
*
FROM
gpoProductos
WHERE 
codigoGP='".$myrow6['gpoProducto']."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);


if($myrow38['tasaGP']>0){
$iva=$myrow['precioPaquete1']*($myrow38['tasaGP']*0.01);
}




    

    
    		   

 $agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,descripcionGrupo,
entidad,status,fecha,hora,numFactura,codigo,naturaleza,seguro,clientePrincipal,keyCAP,codPaquete,usuario

)
values 
(

'".$_GET['numSolicitud']."','".$folioVenta[$i]."',1,
'".$myrow['precioPaquete1']."','".$iva."','".$myrow6['gpoProducto']."',
    '".$myrow6['descripcion']."','".$myrow38['descripcionGP']."',
        '".$entidad."','request','".$fecha1."','".$hora1."','',
            '".$myrow['codigo']."','C','".$_POST['seguro']."','".$_POST['seguro']."','".$myrow['keyCAP']."',
                '".$rNombre23['codigoPaquete']."'    ,'".$usuario."'   
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();









$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';


    
}//cierra while
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron saldos...';
} //cierra validacion de iguala
}//cierra if             
              
              
              

























        }else{              
//***********CIERRA  VERIFICACION IGUALA
            //echo $facturar[$i].'  '.$importe[$i];
            $porcentaje=$facturar[$i]/$importe[$i];          

          $actualiza = "DELETE FROM facturasAplicadas where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."' ";
//mysql_db_query($basedatos,$actualiza);
echo mysql_error();     
    
    
    
    
             $sSQL= "SELECT
             *
             FROM
             cargosCuentaPaciente
             WHERE 
             entidad='".$entidad."'
             and
             folioVenta='".$folioVenta[$i]."'
             and
             gpoProducto!='' ";



 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
								
							
						
					
					
				
				
			
			
    	
		   
    $sql5da= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
folioVenta='".$folioVenta[$i]."' 
and
numSolicitud='".$_GET['numSolicitud']."'
    and
    keyCAP='".$myrow['keyCAP']."'

";
$result5da=mysql_db_query($basedatos,$sql5da);
$myrow5da= mysql_fetch_array($result5da);    
    


//$porcentaje= round($porcentaje,3);
if($porcentaje>-1 and $porcentaje<0.1){
$precioVenta=$myrow['cantidadAseguradora'];    
$iva=$myrow['ivaAseguradora'];

}else{
$precioVenta=$myrow['cantidadAseguradora']*$porcentaje;
        $iva=$myrow['ivaAseguradora']*$porcentaje;
}














if(!$myrow5da['keyCAP']){
 $agrega = "INSERT INTO facturasAplicadas (
numSolicitud,folioVenta,cantidad,
importe,iva,gpoProducto,descripcionArticulo,descripcionGrupo,
entidad,status,fecha,hora,numFactura,codigo,naturaleza,seguro,clientePrincipal,keyCAP

)
values 
(

'".$_GET['numSolicitud']."','".$folioVenta[$i]."','".$myrow['cantidad']."',
'".$precioVenta."','".$iva."','".$myrow['gpoProducto']."',
    '".$myrow['descripcionArticulo']."','".$myrow['descripcionGrupoProducto']."',
        '".$entidad."','request','".$fecha1."','".$hora1."','',
            '".$myrow['codProcedimiento']."','".$myrow['naturaleza']."','".$_POST['seguro']."','".$_POST['seguro']."','".$myrow['keyCAP']."'
        
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron Folios de Venta';
}else{
 $actualiza = "UPDATE facturasAplicadas
set
importe='".$precioVenta."',
iva='".$iva."'
where
entidad='".$entidad."'
    and
folioVenta='".$myrow5da['folioVenta']."'
and
numSolicitud='".$_GET['numSolicitud']."'
and
keyCAP='".$myrow['keyCAP']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron saldos...';
}
} //ciera while

        }//cierra validacion de la iguala















}else{
$tipoMensaje='error';
$encabezado='Error';
$texto='LA CANTIDAD A FACTURAR DEBE SER MENOR ...!';
}
}
}
    
    
    
 
}


















  
    
    
    
    
    
    
    
  
    
    
    


if($_POST['doit']!=NULL and $_POST['rfc']!=NULL ){

   $sSQLab= "SELECT * FROM entidades where codigoEntidad='".$entidad."' ";
    $resultab=mysql_db_query($basedatos,$sSQLab);
    $myrowab = mysql_fetch_array($resultab); 
if($myrowab['digitosFactura']>0){
   
    

    
    $sSQLaa= "SELECT contador from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."'   and tipoFactura='cxc' ";
    $resultaa=mysql_db_query($basedatos,$sSQLaa);
    $myrowaa = mysql_fetch_array($resultaa);          
    
    
    if(!$myrowaa['contador']){
//GENERAR FACTURA
$q4 = "

    INSERT INTO contadorSeriesFacturas(contador, usuario,entidad,numSolicitud,tipoFactura)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorSeriesFacturas where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$_GET['numSolicitud']."','cxc'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();
    
    

    
    
    $sSQLac= "SELECT contador as topeMaximo from contadorSeriesFacturas where 
    entidad='".$entidad."'
    and    
    numSolicitud='".$_GET['numSolicitud']."' and tipoFactura='cxc'   ";
    $resultac=mysql_db_query($basedatos,$sSQLac);
    $myrowac = mysql_fetch_array($resultac); 
    //echo $myrowac['topeMaximo'];
    //echo '<br>';
    $digitos= strlen($myrowac['topeMaximo']);
    $totalDigitos=$myrowab['digitosFactura']-$digitos;
    $totalDigitos='%0'.$totalDigitos.'s';
    $digtosCompilados = sprintf($totalDigitos, $var); 
    
    $numFactura= $myrowab['prefijoCxC'].$digtosCompilados.$myrowac['topeMaximo'];
       
 //TERMINO GENERAR FACTURA     
    
   $actualiza = "UPDATE facturaGrupos
set
status='facturado',
numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

 $actualiza1 = "UPDATE facturasAplicadas
set
status='facturado',
numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza1);
echo mysql_error();

 $actualiza2 = "UPDATE datosfacturacion
set

numFactura='".$numFactura."'

where
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'
";
mysql_db_query($basedatos,$actualiza2);
echo mysql_error();


echo '<script>';
echo 'window.alert("SE GENERO LA FACTURA: '.$numFactura.'");';
echo '</script>';
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='FOLIO(s) FACTURADOS..';


    //****GENERAR TICKET******
    $qTi = "

    INSERT INTO contadorTicket(contador, usuario,entidad,keyClientesInternos)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorTicket where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."','".$myrow1d['keyClientesInternos']."'

    ";
    mysql_db_query($basedatos,$qTi);
    echo mysql_error();

    //************************
    $sSQLT= "SELECT contador as topeMaximo from contadorTicket where entidad='".$entidad."' and usuario='".$usuario."'order by keyCExt DESC   ";
    $resultT=mysql_db_query($basedatos,$sSQLT);
    $myrowT = mysql_fetch_array($resultT);
    $ticket= $myrowT['topeMaximo'];
    $_POST['observaciones']=preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['observaciones']);
    $vFac='divideAseguradoras';
    include("/configuracion/clases/generarFacturaElectronica.php");
 

}else{
     echo '<script>window.alert("SE GENERO LA FACTURA!");</script>';
}
}else{
     echo '<script>window.alert("FAVOR  DE CONFIGURAR LA ENTIDAD PARA FACTURAR CORRECTAMENTE!");</script>';
}
}





    //************************
    $sSQLT= "SELECT contador as topeMaximo from contadorTicket where entidad='".$entidad."' and usuario='".$usuario."'order by keyCExt DESC   ";
    $resultT=mysql_db_query($basedatos,$sSQLT);
    $myrowT = mysql_fetch_array($resultT);
    $ticket= $myrowT['topeMaximo'];

?>








  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>

<body>
<p align="center" >
  <label>
      <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


  
<form name="dividirCuentas"  method="post">
  

    
    
    
    
    
    <?php 
        $sql5da3= "
SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
numSolicitud='".$_GET['numSolicitud']."'


";
$result5da3=mysql_db_query($basedatos,$sql5da3);
$myrow5da3= mysql_fetch_array($result5da3); ?>
    
    
    
    


 <table width="582" class="table-forma">
    
    
    
    
    
            <tr>    	
        <td width="168"  scope="col"><div align="left">Aseguradora</div></td>
        <td width="407"  scope="col">
      	<div align="left">
        <label>
       <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
		<input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){	echo $_POST['nomSeguro'];}?>" />
        </label>
        </td>        
    	</tr>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <tr>


    	
    	
    	
    <br>
      <td width="168"  scope="col"><div align="left">Agregar Folios de Venta</div></td>
      <td width="407"  scope="col"><div align="left">
        <label>
        <input type="text" name="folioVenta" id="folioVenta" <?php if($myrow5da3['status']=='facturado'){echo  'disabled="disabled"';}?>  />
        </label>
      
        <span >
        
        </span>
        
        
        
        <span >
    
        </span></div>      
        </td>
        
        
        
    </tr>
    
    
    

    
    
     
     <tr>
     </tr>	
     	
    
     <tr>
     <td width="407"  scope="col" colspan="2">	
     <div align="center">
     <span >
     <input  type="submit" name="insert" id="button" value="INSERTAR" <?php if($myrow5da3['status']=='facturado'){echo  'disabled="disabled"';}?>/>
     </span>
     </div>  
     </td>  	
    </tr>
    
    
  </table>





    <br>


 <?php if($_POST['preview'] or $_POST['doit'] and $_POST['seguro']!=NULL){?>

  <table width="200" class="table table-striped">


   
    
    
    
    
           <tr >
      <td>---</td>
      <td>
	    <div align="center" >
	#FOLIOS,NOMBRES	
<input name="paciente" size="60"  value="<?php echo $_POST['paciente'];?>">
	


        </div></td>
    </tr>
    
               
    
    
    
    
    
    <tr >
      <td>---</td>
      <td>
	    <div align="center" >
	Siniestro
<input name="siniestro" size="60"  value="<?php echo $_POST['siniestro'];?>">
	


        </div></td>
    </tr>
    
    
    
    
  
    
    
    
    
    
    
        <tr >
      <td>---</td>
      <td>
	    <div align="center" >
	Credencial
<input name="credencial" size="60"  value="<?php echo $_POST['credencial'];?>">
	


        </div></td>
    </tr>
    

    
    
    
    
      
    
    
    
    


       	
    
    
    
    
       	
       	<tr>
           <td>---</td>
      <td>
	    <div align="center" >
		
		<a href="#" onClick="javascript:ventanaSecundaria5('/sima/cargos/printDetailsGroup.php?siniestro=<?php echo $_POST['siniestro'];?>&credencial=<?php echo $_POST['credencial'];?>&numSolicitud=<?php echo $_GET['numSolicitud'];?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&numFactura=<?php echo $numFactura;?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $_POST['rfc'];?>&tipoPaciente=<?php echo $_GET['tipoPaciente'];?>&paciente=<?php echo $_POST['paciente'];?>');"   />
	       Factura Agrupada
	      </a>
        </div></td>
    </tr>

     <tr ><td>---</td>
      <td>
	  
        <div align="center" ><a href="#" onClick="javascript:ventanaSecundaria2('../cargos/imprimirFolioVentaFactura.php?numSolicitud=<?php echo $_GET['numSolicitud'];?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&numFactura=<?php echo $numFactura;?>&seguro=<?php echo $_GET['numCliente'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_POST['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $_POST['rfc'];?>&tipoPaciente=<?php echo $_GET['tipoPaciente'];?>');" >
          Factura por Folios</a>
          
        </div></td>
         </tr> 
       


     <tr ><td>Observaciones</td>
               <td>
	  <div align="center" >

          <input size="40"  name="observaciones" value="<?php trim($_POST['observaciones']);?>" ></input> 
        </div></td>
         
         
         
    </tr>




<?php
$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
$rfc=$myrow455['rfc'];
$razonSocial=$myrow455['razonSocial'];

?>	  
	  <tr >
      <td >RFC</td>
      <td  ><input name="rfc" type="text"  id="rfc" readonly="readonly"
		value="<?php

		 echo $rfc;

		?>"/></td>
    </tr>


          <tr >
      <td >Razon Social:</td>
      <td ><span >
        <input name="razonSocial" type="text"  id="razonSocial" value="<?php
		if($razonSocial){
		 echo trim($razonSocial);
		}
		?>" size="50" <?php if($myrow5da3['status']=='facturado'){echo  'disabled="disabled"';}?>  readonly=""/>




      </span></td>


 </tr>


<?php 
$sSQL4= "Select * from facturacionconfigurada where entidad='".$entidad."' and clienteprincipal='".$_POST['seguro']."' ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);echo mysql_error();

if($myrow4['importe']>0){?>

           <tr >
      <td >Activar Iguala</td>
      <td ><span >
        <input name="iguala" type="checkbox"  id="checkbox" value="si" <?php if($_POST['iguala']!=NULL){echo  'checked="checked"';}?>  />

<?php echo 'Iguala por: '.'$'.number_format($myrow4['importe'],2);?>


      </span></td>


 </tr>
 <?php }?>
 
 
 
 

      <tr >
          <td>---</td>
                <td>

                  <label>
                      <div >
<a href="#" onClick="ventanaSecundaria1('ventanaModificaRFC.php?folioFactura=<?php echo $_POST['folioFactura']; ?>&random=<?php echo $_GET['random']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')">
               Nuevo RFC
            </a>
                      </div>
        </label>

      </td>

      </tr>

  </table>

  <?php }?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

<p><br>
    </br>
  </p>

  <table width="700" class="table table-striped">
      <tr >
        <th width="4"   scope="col"><div align="left" >
          <div align="center">#</div>
        </div></th>

                  <th width="15"  scope="col"><div align="left" >
          <div align="center">FV</div>
        </div></th>


        <th width="10"  scope="col"><div align="left" >
          <div align="center">Fecha</div>
        </div></th>
        <th width="100"  scope="col"><div align="left" >
          <div align="center">Paciente</div>
        </div></th>
   
   
   
        <th width="20"  scope="col"><div align="left" >
          <div align="center">Importe</div>
        </div></th>
        <th width="10"  scope="col"><div align="left" >
          <div align="center">IVA</div>
        </div></th>
        
                <th width="10"  scope="col"><div align="left" >
          <div align="center">Total</div>
        </div></th>
        

        <th width="20"  scope="col"><div align="left" >
          <div align="center">Facturado</div>
        </div></th>
        
        
                <th width="20"  scope="col"><div align="left" >
          <div align="center">Res/Fact</div>
        </div></th>
        
                <th width="20"  scope="col"><div align="left" >
          <div align="center">Facturar</div>
        </div></th>
        
        
        <th width="5"  scope="col"><div align="left" >
          <div align="center">Elimina</div>
        </div></th>
    </tr>
    
    
    
    
    
    
    

<?php	


 
 $sSQL= "SELECT
 *
FROM
  facturaGrupos
   WHERE 
   entidad='".$entidad."'
   and
numSolicitud='".$_GET['numSolicitud']."'
 ";



 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;





$sql5c= "
SELECT sum(cantidadAseguradora*cantidad) as p,sum(ivaAseguradora*cantidad) as i
FROM
cargosCuentaPaciente
WHERE
entidad =  '".$entidad."'
    and
    folioVenta='".$myrow['folioVenta']."'
        and
        gpoProducto!=''
and
naturaleza='C'

";
$result5c=mysql_db_query($basedatos,$sql5c);
$myrow5c= mysql_fetch_array($result5c);

$sql5a= "
SELECT sum(cantidadAseguradora*cantidad) as pd,sum(ivaAseguradora*cantidad) as id
FROM
cargosCuentaPaciente
WHERE
entidad =  '".$entidad."'
    and
    folioVenta='".$myrow['folioVenta']."'
        and
        gpoProducto!=''
and
naturaleza='A'

";
$result5a=mysql_db_query($basedatos,$sql5a);
$myrow5a= mysql_fetch_array($result5a);

$importe1=$myrow5c['p']-$myrow5a['pd'];
$iva1=$myrow5c['i']-$myrow5a['id'];






  $sSQL7="SELECT 
  SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
  facturasAplicadas
  WHERE
  entidad='".$entidad."'
  and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  folioVenta='".$myrow['folioVenta']."'
  and
  naturaleza='C'
      and
  seguro!=''
  and
  statusDevolucion!='si'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




  $sSQL7d="SELECT 
  SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
  facturasAplicadas
  WHERE
  entidad='".$entidad."'
  and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  folioVenta='".$myrow['folioVenta']."'
  and
  naturaleza='A' 
      and
  seguro!=''
  and
  statusDevolucion!='si'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
   $importeA=($myrow7['acumulado']-$myrow7d['acumulado'])+($myrow7['ivaa']-$myrow7d['ivaa']);
   
   
   
   
   
   
  
  $sSQL7f="SELECT 
  SUM((importe*cantidad) +(iva*cantidad)) as fac
  FROM
  facturasAplicadas
  WHERE
  entidad='".$entidad."'
  and
  folioVenta='".$myrow['folioVenta']."'
  and
  naturaleza='C'
  and
  status='facturado'
      and
  seguro!=''
  and
  statusDevolucion!='si'
  ";
 
  $result7f=mysql_db_query($basedatos,$sSQL7f);
  $myrow7f = mysql_fetch_array($result7f);




 $sSQL7fd="SELECT 
 SUM((importe*cantidad) +(iva*cantidad)) as dev
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  folioVenta='".$myrow['folioVenta']."'
and
  
  naturaleza='A'
  and
  status='facturado'
      and
  seguro!=''
  and
  statusDevolucion!='si'
  ";
 
  $result7fd=mysql_db_query($basedatos,$sSQL7fd);
  $myrow7fd = mysql_fetch_array($result7fd);
  
  $facturado=$myrow7f['fac']-$myrow7fd['dev'];
  
  
  
  

?>
  <tr  >

        <td  >
          <label>
          <div align="center">
            <?php echo $bandera;?>
          </div>
          </label>
      </td>


                <td  >
          <label>
          <div align="center">
              <a href="javascript:ventanaSecundaria4('../cargos/despliegaCargos.php?folioVenta=<?php echo $myrow['folioVenta'];?>');">
            <?php echo $myrow['folioVenta'];?>
              </a>
          </div>
          </label>
      </td>



        <td >
          <div align="center">
      <?php echo cambia_a_normal($myrow['fecha']);?>

        </div>
        </span></td>


        
        <td >
                <div align="left">
                  <?php  
$sSQL23= "Select paciente From clientesInternos WHERE entidad='".$entidad."' and folioVenta ='".$myrow['folioVenta']."' ";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $rNombre23['paciente'];

                  echo '<br>';
                  echo $myrow['clientePrincipal'];
		?>
                </div>
        </td>
    
     
        <td >
            <div align="left">
                  <?php echo '$'.number_format($importe1,2);?>
            </div>
        </td>


	 

         
        <td >
          <div align="center">
             <?php echo '$'.number_format($iva1,2);?>
          </div>       
         </td>
      
         
         
        <td >
          <div align="center">
             <?php echo '$'.number_format($importe1+$iva1,2);?>
          </div>       
         </td>


        <td >
		  <div align="center">
                    <?php echo '$'.number_format($facturado,2);?>
	      </div>
        </td>

        
        
        
                <td >
		  <div align="center">
                    <?php echo '$'.number_format(($importe1+$iva1)-$facturado,2);?>
	      </div>
        </td>
        
        


        <td >
	<div align="center">

        <input name="facturar[]" type="text" size="10"  value="<?php echo number_format(($importe1+$iva1)-$facturado,2);?>"  />
   
	</div>
        </td>
        
        
        
        
          <td >
          <div align="center">
            
            <input name="keyIM[]" type="checkbox"  value="<?php echo $myrow['keyNFac']; ?>" <?php echo $mensaje;?> />
          
          </div></td>
        
        

    </tr>


<input name="importe[]" type="hidden" value="<?php echo $importe1+$iva1; ?>"  />
<input name="folioVenta1[]" type="hidden" value="<?php echo $myrow['folioVenta']; ?>"  />
      <?php  

	  }  //cierra while
	  ?>
  </table>

<p align="center" ><em>
  
  
  <?php if($bandera>0){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?></em></p>






  <?php if($bandera>0){ 
  


if($myrow5da3['status']!='facturado'){
?>
        <input name="preview" type="submit" src="../imagenes/btns/delregistro.png" id="actualiza2" value="Previsualizar" />
       <input name="elimina" type="submit" src="../imagenes/btns/delregistro.png" id="actualiza2" value="Quitar" />

       <input name="flag1" type="hidden" src="../imagenes/btns/delregistro.png" id="flag1" value="<?php echo $bandera;?>" />
   <?php }else{
       echo 'Registros Facturados...';
   }
   
   
   } ?>
    <label>
    
<div align="center">
    
      <?php 
       $sSQL2a= "Select * From datosfacturacion WHERE entidad='".$entidad."' and numfactura='".$_POST['numFactura']."' and rfc like '%$rfc%'  ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

//if($_POST['rfc'] and $_POST['razonSocial'] and $_POST['seguro']  and $_POST['preview']!=NULL and $bandera>0 ){
?>
    <br>
    
        <?php if($myrow5da3['status']!='facturado'){?>
        <blink><input name="doit" type="submit" src="../../imagenes/btns/delregistro.png"  value="FACTURAR" /></blink>
        <?php }else{?>
    <input name="doit" type="submit" src="../../imagenes/btns/delregistro.png" class="titulomed" value="FACTURADO" disabled="disabled" />
    
<?php }

//}?>    
    
  </div>
    </label>

    
</form>
<p></p>
<br>
<br>
      
  <script>
		new Autocomplete("razonSocial", function() {
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
			}

			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/rfcx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $ALMACEN;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
	
	
	  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
    
	
</body>
</html>