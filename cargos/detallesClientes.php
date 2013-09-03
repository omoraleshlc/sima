<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");

?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria3 (URL){
   window.open(URL,"ventana3","width=400,height=400,scrollbars=YES")
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

        if( vacio(F.medico.value) == false ) {
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")
                return false
        } else if( vacio(F.paciente.value) == false ) {
                alert("Por Favor, escribe el nombre del paciente!")
                return false
        } else if( vacio(F.seguro.value) == false ) {
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")
                return false
        }
}
</script>



<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>




 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();

?>

</head>

<body>
 <h1 align="center" class="titulos">Estado de Cuenta<label></label>
 </h1>
    
    <h4>
     <?php echo $_GET['nombre'];?>
    </h4>
    

 <form id="form1" name="form1" method="post" action="">

   <p align="center" >Periodo</p>
   <p align="center" >Fecha Inicial

     <label>
     <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
     </label>
     <input name="button" type="image"src="/sima/imagenes/btns/fecha.png"  id="lanzador"  />
     <label></label>
  <span >
     a la fecha
</span>
     <label>
     <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
     </label>
     <input name="button2" type="image"src="/sima/imagenes/btns/fecha.png"  id="lanzador1"  />
     <label> <br />
     <br />
     <input name="buscar" type="submit"  id="search" value="Buscar" />
     </label>

</p>


<?php if($_POST['buscar']){

$fecha=$_POST['fechaInicial']; // tu sabr�s como la obtienes, solo asegurate que tenga este formato
$dias= 30; // los d�as a restar

$fechaI= date("Y-m-d", strtotime("$fecha -$dias day"));
//echo '<br>';
$mes = substr($fechaI, -5,-3);
$year = substr($fechaI, -10,-6);

$fechaInicio=$year.'-'.$mes.'-'.'01';
$fechaFinal=$year.'-'.$mes.'-'.'31';




$sSQL2= "Select * From entidades WHERE keyEntidades = '".$entidad."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>


<?php if($_POST['fechaFinal']>=$_POST['fechaInicial']){?>
<div id="divContainer">      
   <table width="800" class="formatHTML5">


     <tr class="separator">
       <th ><p align="center">#</p></th>         
       <th  ><p align="center">Folio</p></th>
       <th ><p align="center">Fecha</p></th>
       <th  ><p align="center">Recibo</p></th>
       <th ><p align="center">Descripcion</p></th>
       <th  ><p align="center">Cargos</p></th>
       <th  ><p align="center">Abonos</p></th>
       <th ><p align="center">Saldo</p></th>
       
     </tr>

     <tr >
       <td width="82" align="center"  class="notice" >&nbsp;</td>
       <td width="82" align="center"  class="notice" >
	   <?php
if($myrow2['fechaApertura']!=""){
//echo 'Fecha Apertura: '.cambia_a_normal($myrow2['fechaApertura']);
}
?>
	   </td>
       <td width="385"  class="notice" >Saldo Inicial</td>
       <td width="118" align="center"  class="notice">
<?php

//***********************TRASLADOS A ASEG*******************
$sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$_GET['numCliente']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);


if($_POST['fechaInicial']>$myrow2['fechaApertura']){
$sSQL1c="SELECT sum(precioVenta*cantidad) as cargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$_GET['numCliente']."'
and
(tipoTransaccion='taseg' or tipoTransaccion='tnom' or tipoTransaccion='DEVABOASEG')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$_POST['fechaInicial']."'
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);





//**************************************************************












//**********************ABONOS DE ASEGURADORA***************
$sSQL1a="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$_GET['numCliente']."'
and
(tipoTransaccion='devxaseg' or tipoTransaccion='abaseg' or tipoTransaccion='devxnom')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$_POST['fechaInicial']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow24['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$fecha1."'

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);

/*
echo '<br>';
echo $myrow1cdev['devoluciones'];
echo '<br>';
*/

$c=($myrow1c['cargos']-($myrow1a['abonos']+$myrownc['nc']))+$myrowcp['saldoInicial'];
}else{
$c=$myrowcp['saldoInicial'];
}







$saldosIniciales=$c;
echo '$'.number_format($c,2);
?>	   </td>
       
       
       <td width="82" align="center"  class="notice" >&nbsp;</td>

       <td width="106" align="center"  >&nbsp;</td>
     </tr>

 <?php
 $sSQL= "Select *
 from cargosCuentaPaciente
 where entidad='".$entidad."'
 AND

 clientePrincipal='".$_GET['seguro']."'
 and
fecha1>='".$myrow2['fechaApertura']."'
and
 fecha1>='".$_POST['fechaInicial']."' and fecha1<='".$_POST['fechaFinal']."'
 and
 gpoProducto=''

 order by fecha1 ASC

   ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$N=$myrow['numCliente'];




$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];








if($myrow['tipoTransaccion']=='taseg' or $myrow['tipoTransaccion']=='tnom' or $myrow['tipoTransaccion']=='DEVABOASEG'  ){
     $cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}


 if($myrow['tipoTransaccion']=='devAseg' or $myrow['tipoTransaccion']=='devxaseg' or $myrow['tipoTransaccion']=='abaseg' or $myrow['tipoTransaccion']=='devxnom' ){
      $abonos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
 }


if($myrow['notaCredito']=='si' and $myrow['naturaleza']=='A'){
    $nC[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}






$saldo=($cargos[0]+$c)-$devoluciones[0]-($abonos[0]+$nC[0]);

?>
     <tr  >
       <td  align="center" ><div align="center" ><?php echo $bandera;?></div></td>
       <td  align="center" ><div align="center" ><?php echo $myrow['folioVenta'];?></div></td>
       <td  align="center" ><div align="center" ><?php echo cambia_a_normal($myrow['fecha1']);?></div></td>
       <td >   <div align="center" >


<a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">
<?php echo $myrow['numRecibo'];?></a>

	   </div></td>

           
           
                      <td  >
	   <div align="left" >
	   <?php  echo $myrow['descripcionArticulo'];   ?>
	   </div>
           </td>
           
           
          
           
       <td  align="right">
	  
	   <?php
           
           if($myrow['tipoTransaccion']=='taseg' or $myrow['tipoTransaccion']=='tnom'  or $myrow['tipoTransaccion']=='DEVABOASEG'  or $myrow['tipoTransaccion']=='APNCD'){
                echo '<div align="center" >';
               echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
           echo '</div>';
	  
           
	   }?>
	  </td>


       <td  align="right">
	   


	   <?php 
            if( $myrow['tipoTransaccion']=='abaseg' or $myrow['tipoTransaccion']=='devxaseg'  or $myrow['tipoTransaccion']=='devAseg' or $myrow['tipoTransaccion']=='devxnom'){
           echo '<div align="center" >';
                echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
          echo '</div>';
	  
           
	   }
?>
	   </div>	   </td>


              <td >
	   <div align="center" >
	   <?php  echo '$'.number_format($saldo,2);   ?>
	   </div>	   </td>


              
              
              

     </tr>
     <?php }?>

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
       <tr>
       <td class="notice">Totales</td>
       <td width="100">&nbsp;</td>
       <td width="100">&nbsp;</td>
       <td  width="100">&nbsp;</td>
       <td  width="100">&nbsp;</td>
       <td width="100"><div align="center" ><?php echo '$'.number_format($c+$cargos[0],2);?></div></td>
       <td width="100"><div align="center" ><?php echo '$'.number_format($abonos[0]+$nC[0],2);?></div></td>
     </tr>


     <tr>

       <td class="notice">Saldo</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100"><div align="center" > <?php echo '$'.number_format(($c+$cargos[0])-($abonos[0]+$nC[0]),2);?> </div></td>
     </tr>  
     
     
     
   </table>
</div>







<br /><br />


   <?php }else{
       echo '<div class="error">La fecha inicial debe ser menor a la fecha final!</div>';
   }
   
   
   
   
}
   ?>

   <p align="center">&nbsp;</p>
 </form>
 <p align="center">&nbsp;</p>

<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
</script>

<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>

</body>
</html>