<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php');
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>


<?php  /*
if($_GET['numFactura'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
 $q = "UPDATE facturasAplicadas set
statusPago=''

		WHERE entidad='".$entidad."' and numFactura='".$_GET['numFactura']."' ";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}*/
?>

<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria5 (URL){
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria51 (URL){
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria511 (URL){
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA (URL){
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA2 (URL){
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA1 (URL){
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria5111(URL){
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES")
}
</script>






<?php
/*
if($_POST['aplicar']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['flag'];$i++){

    if($numFactura[$i]!=NULL){
$q = "UPDATE facturasAplicadas set
statusPago='standby',usuario='".$usuario."'
	
		WHERE entidad='".$entidad."' and numFactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Preparado para Aplicarse';
}*/
?>
















<?php
/*
if($_POST['delete']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE facturasAplicadas set
statusPago=''

		WHERE entidad='".$entidad."' and numFactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Se desactivaron facturas para aplicar!';

}*/
?>


  







<?php
if($_GET['aplicar']!=NULL and $_GET['importe']>0 and  $_GET['keyCAP']>0){


 $q = "UPDATE facturasAplicadas set
statusPago='pagado',fechaPago='".$fecha1."',usuarioPago='".$usuario."',numFactura='".$_GET['numFactura']."'

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


                 $q1 = "UPDATE cargosCuentaPaciente set
statusFactura='pagado',pagoCxCKeyCAP='".$_GET['keyCAP']."',fechaPagoCxC='".$fecha1."'

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();


    

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Aplicado Definitivo';


$diferencia=(float) $_GET['importe']-(float) $_GET['i'];

if($diferencia==0){
    $mensaje='Factura Cerrada';
}else{
    $mensaje='Favor de aplicar una nota de credito por: $'.number_format($diferencia,2);
}


echo '
<script>
window.alert("'.$mensaje.'");
window.opener.document.forms["form1"].submit();
window.close();
</script>';
}
?>



  
  

  <script type="text/javascript">

function verifica()
{
if (confirm('Estas seguro que deseas cerrar esta ventana?')) 
  javascript:window.opener.document.forms['form1'].submit();
window.close();
}

</script>
  
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>


   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>
<?php 
if($_POST['fechaInicial']){
		 $date1= $_POST['fechaInicial'];
                 }elseif($_GET['fechaInicial']){
                 $date1= $_GET['fechaInicial'];
		 } else {
		 $date1= $fecha1;
		 }

                 
                 if($_POST['fechaFinal']){
		 $date2= $_POST['fechaFinal'];
                 }elseif($_GET['fechaFinal']){
                 $date2=  $_GET['fechaFinal'];
                 } else {
		 $date2= $fecha1;
		 }
?>

    
    
    
    
 <h1 align="center" >Facturas sin Aplicar</h1>
 
  <h4 align="center" >Por Aplicar: <?php echo '$'.number_format($_GET['i'],2);?></h4>
 
  
  
  
  
  <form id="form1" name="form1" method="post" >
   <div align="center"></div>
   <p align="center">
     <label></label>
     Escojer Fechas</p>
   
   

   
   <table width="200" class="table-forma">
   <tr>
     <td><table width="400" >
       <tr></tr>
       <tr>
         <td scope="col"><div align="left">De:</div></td>
         <td scope="col"><div align="left">
           <input name="fechaInicial" type="text" class="camposmid" id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 echo $date1;
		 ?>"  />
         </div></td>
         <td scope="col"><div align="center">
           <input name="button" type="button" src="../../imagenes/btns/fecha.png" id="lanzador1" value="..." />
         </div></td>
       </tr>
       <tr>
         <td><div align="left">a:</div></td>
         <td><div align="left">
           <input name="fechaFinal" type="text" class="camposmid" id="campo_fecha2" size="11" maxlength="11" readonly=""
		value="<?php
echo $date2;
		 ?>"  />
         </div></td>
         <td><div align="center">
           <input name="button1" type="button" src="../../imagenes/btns/fecha.png" id="lanzador2" value="..." />
         </div></td>
         <td></td>
       </tr>
     </table></td>
   </tr>
   </table>
   
   
   
   
   <p >
  <input type="Submit" value="buscar" />
</p>


   <table width="550" class="table table-striped">
     <tr >
         
       <th width="10"  ><div align="left" >
         <div align="left">#</div>
       </div></th>
         
       <th width="70" ><div align="left" >
         <div >Fecha</div>
       </div></th>
       

       
       <th width="100"  ><div align="left" >
         <div align="left"># Factura</div>
       </div></th>
       
       
       
         <th width="71"  ><div align="left" >
         <div align="left">Importe</div>
       </div></th>


       <th width="54"  ><div align="left" >
         <div align="left">Abonos</div>
       </div></th>
  
         
       <th width="54"  ><div align="left" >
         <div align="left">Saldo</div>
       </div></th>         
         
         
      
          <th width="54"  ><div align="left" >
         <div align="left">Usuario</div>
       </div></th>   
   
         
        <th width="5"  >
         <div align="left">-</div>
  </th>   
         
         
    </tr>




<?php


$sSQL= "Select * From facturasAplicadas
where
entidad='".$entidad."'
    and
    seguro='".$_GET['seguro']."'

and
fecha>='".$date1."' and  fecha<='".$date2."'
and
(statusPago=''or statusPago='standby')
and
status='facturado' 

group by numFactura
order by numFactura ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;


//*************************OPERACIONES*****************************

$sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and


  numFactura='".$myrow['numFactura']."'
          and
    seguro='".$_GET['seguro']."'
  and

  naturaleza='C'
  and
  transaccion!='si'
  and
  status='facturado'
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
  numFactura='".$myrow['numFactura']."'
and

  naturaleza='A'
            and
    seguro='".$_GET['seguro']."'
        and
  transaccion!='si'
  and
  status='facturado'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

//*******************************DESCUENTOS**************************
$sSQL7fac="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
  numFactura='".$myrow['numFactura']."'
group by folioVenta
";
 
  $result7fac=mysql_db_query($basedatos,$sSQL7fac);
  while($myrow7fac = mysql_fetch_array($result7fac)){
 
//**************COASEGUROS******************
   $sSQL7f1="


SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as coaseguro
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
 (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
 and
 numRecibo>0
  ";
 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  $myrow7f1 = mysql_fetch_array($result7f1);

  
$dd[0]=  $myrow7f1['coaseguro'];      
//*********************************************************************      
      

if($myrow7fac['folioVenta']!=NULL){	
if($myrow7fac['seguro']==NULL){	
$sSQL7f1="


SELECT
*
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and

(naturaleza='A' or naturaleza='C')
 ";
 
  	$result7f1=mysql_db_query($basedatos,$sSQL7f1);
  	while($myrow7f1 = mysql_fetch_array($result7f1)){
	$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$myrow7f1['tipoTransaccion']."'";
	$result341=mysql_db_query($basedatos,$sSQL341);
	$myrow341 = mysql_fetch_array($result341);
    
  if($myrow341['noFacturable']=='si' ){
  $noFacturable[0]+=$myrow7f1['cantidadParticular']*$myrow7f1['cantidad'];
  }	
  }
	
	
	
	
}else{
			
		
	
$sSQL7f1="
SELECT
*
FROM
cargosCuentaPaciente
WHERE

entidad='".$entidad."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and
(naturaleza='A' or naturaleza='C')
order by dia ASC
 ";
 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  while($myrow7f1 = mysql_fetch_array($result7f1)){
   	$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$myrow7f1['tipoTransaccion']."'";
        $result341=mysql_db_query($basedatos,$sSQL341);
        $myrow341 = mysql_fetch_array($result341);
    
	if($myrow341['noFacturable']=='si' ){
  	$noFacturable[0]+=$myrow7f1['precioVenta']*$myrow7f1['cantidad'];
  	}
  }
}
}//cierra el while que busca






$totalD=$tasaCero[0]+$tasaIVA[0]+$tasaExento[0]+$sumaIVAS[0];
$totalDescuento= $totalF1*($gravado*'0.01');
//***********************************************


//$pdf->Ln(10); //salto de linea
$sumaDescuento[0]+=$noFacturable[0];
$descuento[0]+=$noFacturable[0];



//Si el cliente pide mostrar coaseguro
//$coaseguro[0]=NULL;
if($descuento[0]>0 and $subTotales[0]>0 and $iva[0]>0){
 $sacarD= $descuento[0]/($subTotales[0]+$iva[0]);
}

$descuentoGlobal=$descuento[0]+$ivades;
$ivades=($iva[0]*$sacarD);
//$tC=$tasaCero[0]*$sacarD;
//$tI=$tasaIVA[0]*$sacarD;
//$tE=$tasaExento[0]*$sacarD;



if($descuento[0]>0){
	$pdf->Ln(15); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,'('.'Descuento'.')',0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0, '-$'.number_format($descuento[0]-$ivades,2),0,0,R);
$pdf->Ln(3); //salto de linea

if($descuento[0]>0 and $tasaIVA[0]>0){
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);

$pdf->Cell(0,0,"(IVA Descuento"."  $".number_format($ivades,2).' )',0,0,M);
}
$pdf->Ln(4); //salto de linea
}
//*******************************************************************
}//DESCUENTOS 








/*
//VERIFICAR SI EXISTEN COSAEGUROS/DEDUCIBLES
$pdf->Ln(4); //salto de linea
$sSQL7fab="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
numFactura='".$myrow['numFactura']."'
group by folioVenta
";
 
  $result7fab=mysql_db_query($basedatos,$sSQL7fab);
  while($myrow7fab = mysql_fetch_array($result7fab)){
$r+=1;
//*******************************COASEGUROS**************************

  

  
  }
*/






  
//********************************************************************
$importe=  ((($myrow7['acumulado']+$myrow7['ivaa'])-($myrow7d['acumulado']-$myrow7d['ivaa']))-($descuento[0]-$ivades))-$dd[0];

?>
<tr   >
    
    
<td align="left"><?php echo $bandera;?></td>    
    
    
<td align="left">
<?php echo cambia_a_normal($myrow['fecha']);?>
</td>


<td align="left">
<?php 
echo $myrow['numFactura'];
echo '<br>';  
    
/*
$sSQL7fac1="SELECT folioVenta
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
    and
numFactura='".$myrow['numFactura']."'
group by folioVenta
";
 
  $result7fac1=mysql_db_query($basedatos,$sSQL7fac1);
  while($myrow7fac1 = mysql_fetch_array($result7fac1)){

echo '<span class="success">'.$myrow7fac1['folioVenta']."</span>";
echo '<br>';  
  
  }*/


   $sSQLab="


SELECT
sum((importe*cantidad)+(iva*cantidad)) as abonos
FROM
facturasAplicadas
WHERE

entidad='".$entidad."'
and
numFactura='".$myrow['numFactura']."'
and
 transaccion='si'
  ";
 
  $resultab=mysql_db_query($basedatos,$sSQLab);
  $myrowab = mysql_fetch_array($resultab);
$abonos=$myrowab['abonos'];











$saldo=$importe-$abonos;
  ?>
</td>
    
           
           
           
           
<td align="left">
<?php echo '$'.number_format( $importe,2);?>
</td>           
           
   
<td align="left">
<?php echo '$'.number_format( $abonos,2);?>
</td>  

<td align="left">
<?php echo '$'.number_format( $saldo,2);?>
</td>  



       <td align="left" >
        <?php echo $myrow['usuario'];?>
    </td>


           
           
           
       
<td align="left" > 
<?php


if($saldo>=-0.97 and $saldo<=0.03){ 

echo '<div align="left">Aplicado</div>';
    
}else{    
if($importe>0){

    
   
    
    
$local= (float) $importe;
$remoto=(float) $_GET['i'];


if($local>=$remoto){

?>
<a onclick="if(confirm('Estas seguro que deseas aplicar pago?') == false){return false;}" href="mostrarFacturas.php?keyAPFRemoto=<?php echo $_GET['keyAPFRemoto'];?>&importe=<?php echo $saldo;?>&i=<?php echo $_GET['i'];?>&keyAPF=<?php echo $myrow['keyAPF'];?>&aplicar=<?php echo 'si';?>&numFactura=<?php echo $myrow['numFactura'];?>&seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&fechaInicial=<?php echo $date1;?>&fechaFinal=<?php echo $date2;?>&keyCAP=<?php echo $_GET['keyCAP'];?>&cantidad=<?php echo $_GET['cantidad'];?>" > 
Aplicar
</a>  
<?php 
}else{
    
echo '---'    ;
}





}else{
   echo '???' ;
}
}
?>
 
</td>
  <?php }?>




    


</tr>
   
  </table>
<?php
/*
echo '<div class="success">Seleccionado: '.'$'.number_format($seleccionado[0],2).'</div>';
echo '<br>';
echo '<div class="success">Abono por: '.'$'.number_format($_GET['cantidad'],2).'</div>';
 * 
 */
?>




<br>
<?php if($bandera< 1){?>
<div align="center" class="error">
No se encontraron registros!
</div>
<?php }?>
</form>
 
 
 
 
 

<p align="center">&nbsp;</p>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha2",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>
</html>