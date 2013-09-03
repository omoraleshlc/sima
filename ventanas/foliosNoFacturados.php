<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
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
 <h1 align="center" >Estado de Cuenta<label></label>
 </h1>
    
    <h1>
     <?php echo $_GET['nombre'];?>
    </h1>
    
 <p align="center"><?php echo $_GET['nombreCliente'];?></p>
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
     <input name="button" type="button"  id="lanzador" value="..." />
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
     <input name="button2" type="button"  id="lanzador1" value="..." />
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



   <table width="500" class="table table-striped" >


     <tr >
       <th  align="center">Folio</th>
       <th  align="center">Fecha</th>
       <th >Concepto</td>
       <th align="center" >Status</th>
       <th align="center" >Cargos</th>
       <th align="center" >Abonos</th>
       <th align="center" >Saldo</th>
       
     </tr>
     <tr >
       <td align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
       <td  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
     </tr>
     <tr >
       <td width="82" align="center"  >&nbsp;</td>
       <td width="82" align="center"  >
	   <?php
if($myrow2['fechaApertura']!=""){
echo cambia_a_normal($myrow2['fechaApertura']);
}
?>
	   </td>
       <td width="385"  >SALDO ANTERIOR</td>
       <td width="118" align="center"  >
       
<?php


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
gpoProducto=''
and
clientePrincipal='".$_GET['numCliente']."'
and
tipoTransaccion='taseg'
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$_POST['fechaInicial']."'
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1a="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$_GET['numCliente']."'
and
tipoTransaccion='abaseg'
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<'".$_POST['fechaInicial']."'

";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
$c=($myrow1c['cargos']-$myrow1a['abonos'])+$myrowcp['saldoInicial'];
}else{
$c=$myrowcp['saldoInicial'];
}







$saldosIniciales=$c;
echo '$'.number_format($c,2);
?>	   </td>
       <td width="106" align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
       <td align="center"  >&nbsp;</td>
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



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}











if($myrow['tipoTransaccion']=='taseg' or $myrow['tipoTransaccion']=='tnom' or $myrow['tipoTransaccion']=='DEVABOASEG'  ){
     $cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}


 if($myrow['tipoTransaccion']=='devxaseg' or $myrow['tipoTransaccion']=='abaseg'  ){
      $abonos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
 }









$saldo=($cargos[0]+$c)-$devoluciones[0]-$abonos[0];
/*
echo 'cargos: '.$cargos[0].' saldo inicial'.$myrowcp['saldoInicial'].'  devolucion'.$devoluciones[0].' abonos'.$abonos[0];
echo  '<br>';
*/
?>
     <tr   >
       <td  align="center"><?php echo $myrow['folioVenta'];?></td>
       <td height="55"  align="center"><?php echo cambia_a_normal($myrow['fecha1']);?></td>
       <td ><span >
	   <?php

	   echo $myrow['descripcionArticulo'];
	   echo '<br>';
	   echo 'Estado de Factura: '.'<span >'.$myrow['statusFactura'].'</span>';
	   echo '<br>';
	   echo $myrow['usuario'];
           echo '<br>';
	   echo '#Movimiento: '.'<span class="precio1">'.$myrow['keyCAP'].'</span>';
           echo '</br>';
           echo 'RECIBO: '.$myrow['numRecibo'];   
           echo '</br>';
	   ?>
	   </span></td>

           
           
           
           
           
           
                  <td  align="right">
	   <div align="center">


<?php 
$sSQLfa= "
SELECT * FROM facturasAplicadas
WHERE 
entidad='".$_GET['entidad']."'
and
clientePrincipal='".$_POST['seguro']."'
    and
folioVenta='".$myrow['folioVenta']."'
";


$resultfa=mysql_db_query($basedatos,$sSQLfa);
$myrowfa = mysql_fetch_array($resultfa);

if($myrowfa['seguro']!=NULL){
echo 'Facturado';
}else{
echo 'Pendiente';
}
?>
	   </div>	   </td>           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
       <td  align="right">
	   <div align="center">
	   <?php
           
           if($myrow['tipoTransaccion']=='taseg' or $myrow['tipoTransaccion']=='tnom'  or $myrow['tipoTransaccion']=='DEVABOASEG'  ){
               echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
           
	  
           
	   }?>
	   </div></td>


           

           
           
           
           
           
       <td  align="right">
	   <div align="center">


	   <?php 
            if( $myrow['tipoTransaccion']=='abaseg' or $myrow['tipoTransaccion']=='devxaseg'){
           echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
          
	  
           
	   }?>
	   </div>	   </td>
       
       
       
       
       
       


              <td  align="right">
	   <div align="center">
	   <?php  echo '$'.number_format($saldo,2);   ?>
	   </div>	   </td>


     </tr>
     <?php }?>
     <tr>
       <td colspan="7"></td>
     </tr>
   </table>










   <table width="500" class="table table-striped">
       
     <tr>
       <td width="76">&nbsp;</td>
       <td width="377">&nbsp;</td>
       <td width="114" ><div align="center" ><?php echo '$'.number_format($c+$cargos[0],2);?></div></td>
       <td width="96" ><div align="center" ><?php echo '$'.number_format($abonos[0],2);?></div></td>
     </tr>


     <tr>
       <td>&nbsp;</td>
       <td >Saldo</td>
       <td colspan="2"><div align="center" > <?php echo '$'.number_format(($c+$cargos[0])-$abonos[0],2);?> </div></td>
     </tr>

   </table>
   <?php } ?>

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