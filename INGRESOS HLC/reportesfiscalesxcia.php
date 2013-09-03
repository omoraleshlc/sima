<?PHP require("menuOperaciones.php"); ?>


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
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>
 <h1 align="center" class="titulos">Estado de Cuenta<label></label>
 </h1>
    
    <h4>
     <?php echo $_GET['nombre'];?>
    </h4>
    

 <form method="post" >

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


</p>

   
   
<table>     
    <tr >
        <td height="45" >&nbsp;</td>
        <td >Seguro
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td colspan="4"><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span >(Exclusivo Aseguradoras)</span></td>
      </tr>     
    
</table>   
   
     <label> <br />
     <br />
     <input name="buscar" type="submit"  id="search" value="Buscar" />
     </label>   
   
   

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


   

   <table width="500" class="table table-striped">


     <tr >
       <th  align="center"><p align="center">#</p></th>         
       <th  align="center"><p align="center">Factura/Recibo</p></th>
       <th  align="center"><p align="center">Fecha</p></th>
       
       <th align="center" ><p align="center">Cargos</p></th>
       <th align="center" ><p align="center">Abonos</p></th>
       <th align="center" ><p align="center">Saldo</p></th>
     </tr>

     <tr >
       <td width="82" align="center"  class="notice" >&nbsp;</td>
       <td width="82" align="center"  class="notice" >
	   <?php
if($myrow2['fechaApertura']!=""){
//echo cambia_a_normal($myrow2['fechaApertura']);
}
?>
	   </td>
       <td width="385"  class="notice" >SALDO INICIAL</td>
       <td width="118" align="center"  class="notice">
<?php


$sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$_POST['seguro']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);



if($_POST['fechaInicial']>$myrow2['fechaApertura']){
$sSQL1c="SELECT sum(importe*cantidad) as cargos

FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
transaccion!='si'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$myrow2['fechaApertura']."' and fecha<'".$_POST['fechaInicial']."'
    and
    naturaleza='C'
    and
    status='facturado'
    and
numFactura>0
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);



$sSQL1dev="SELECT sum(importe*cantidad) as devoluciones

FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$_POST['seguro']."'
and
transaccion!='si'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$myrow2['fechaApertura']."' and fecha<'".$_POST['fechaInicial']."'
    and
    naturaleza='A'
    and
    status='facturado'
    
";
$result1dev=mysql_db_query($basedatos,$sSQL1dev);
$myrow1dev = mysql_fetch_array($result1dev);





$sSQL1a="SELECT sum(importe*cantidad)  as abonos

FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and

clientePrincipal='".$_POST['seguro']."'
and
transaccion='si'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$myrow2['fechaApertura']."' and fecha<'".$_POST['fechaInicial']."'

";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
$c=(($myrow1c['cargos']-$myrow1dev['devoluciones'])-$myrow1a['abonos'])+$myrowcp['saldoInicial'];
}else{ 
$c=$myrowcp['saldoInicial'];
}







$saldosIniciales=$c;
echo '$'.number_format($c,2);
?>	   </td>
       
       
       <td width="82" align="center"  class="notice" >&nbsp;</td>
  
       
       
       
       <td width="82" align="center"  class="notice" >&nbsp;</td>       
       <td width="106" align="center"  >&nbsp;</td>
     </tr>

<?php
$sSQL= "Select 
*
from facturasAplicadas
where 
(
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."'
and
status='facturado'
and
transaccion!='si'


)
OR
(
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
fechaPago>='".$myrow2['fechaApertura']."'
and
fechaPago>='".$_POST['fechaInicial']."' and fechaPago<='".$_POST['fechaFinal']."'
and

transaccion='si'
and
statusPago='pagado'


)
group  by numSolicitud
order by fecha ASC

   ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;




















/*
echo 'cargos: '.$cargos[0].' saldo inicial'.$myrowcp['saldoInicial'].'  devolucion'.$devoluciones[0].' abonos'.$abonos[0];
echo  '<br>';
*/
?>
     <tr  >
       <td  align="center"><?php echo $bandera;?></td>
       <td  align="center">
           <?php 
           if($myrow['transaccion']=='si'){
             
if($myrow['numRecibo']>0){
  echo $myrow['numRecibo'];  
}   else{            
$sSQL7s="SELECT
numRecibo
  FROM
cargosCuentaPaciente
  WHERE
keyCAP='".$myrow['keyCAP']."'
  
  
  
  ";

  $result7s=mysql_db_query($basedatos,$sSQL7s);
  $myrow7s = mysql_fetch_array($result7s);
           echo $myrow7s['numRecibo'];
}
           }else{
               


            echo $myrow['numFactura'];
           }
           ?>
       </td>
       <td height="55"  align="center">
       <?php 
       
       echo cambia_a_normal($myrow['fecha']);
       if($myrow['notaCredito']){
           echo '<br>';
           print "NotaCredito";
       }
       ?>
       </td>


       <td  align="right">
	   <div align="center">
	   <?php
           if($myrow['transaccion']!='si'){
               if($myrow['numFactura']!=NULL){
$sSQL7="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."'
    and
    numSolicitud='".$myrow['numSolicitud']."'
  and
  naturaleza='C'
  and
  transaccion!='si'
  
  
  ";

  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


 $sSQL7d="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
fecha>='".$myrow2['fechaApertura']."'
and
fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."'
    and
    numSolicitud='".$myrow['numSolicitud']."'
  and
  naturaleza='A'
  and
  transaccion!='si'
  ";

  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
echo '$'.number_format($myrow7['totalCuenta']-$myrow7d['totalCuenta'],2);
  $cargos[0]+=$myrow7['totalCuenta']-$myrow7d['totalCuenta'];
	   }
           }
           ?>
	   </div></td>


       <td  align="right">
	   <div align="center">


	   <?php 
           
           if($myrow['transaccion']=='si'){
               
           $sSQL7b="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numSolicitud='".$myrow['numSolicitud']."'
  and
  naturaleza='C'
  and
  transaccion='si'
and
clientePrincipal='".$_POST['seguro']."'
and
fechaPago>='".$myrow2['fechaApertura']."'
and
fechaPago>='".$_POST['fechaInicial']."' and fechaPago<='".$_POST['fechaFinal']."'
and
statusPago='pagado'
  
  ";

  $result7b=mysql_db_query($basedatos,$sSQL7b);
  $myrow7b = mysql_fetch_array($result7b);


$sSQL7bd="SELECT
sum((importe*cantidad)+(iva*cantidad)) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
clientePrincipal='".$_POST['seguro']."'
and
fechaPago>='".$myrow2['fechaApertura']."'
and
fechaPago>='".$_POST['fechaInicial']."' and fechaPago<='".$_POST['fechaFinal']."'
and
  numSolicitud='".$myrow['numSolicitud']."'
  and
  naturaleza='A'
  and
  transaccion='si'
  and
statusPago='pagado'
  ";

  $result7bd=mysql_db_query($basedatos,$sSQL7bd);
  $myrow7bd = mysql_fetch_array($result7bd);    
           
               
           $abono[0]+=($myrow7bd['totalCuenta']-$myrow7b['totalCuenta']);
           $despliega=($myrow7bd['totalCuenta']-$myrow7b['totalCuenta']);
           echo '$'.number_format($despliega,2);
 	   }          
           
           
          /* 
          if($myrow['tipoTransaccion']=='devxaseg' or $myrow['tipoTransaccion']=='abaseg'  ){
          //$abonos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
          }*/

         
           $saldo=(($cargos[0]+$c)-$devoluciones[0])-$abono[0];
           ?>
	   </div>
       </td>


              <td  align="right">
	   <div align="center">
	   <?php  echo '$'.number_format($saldo,2);   ?>
	   </div>	   </td>


     </tr>
     <?php }?>

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
       <tr>
        <td class="notice">Totales</td>
       <td width="100">&nbsp;</td>
       <td width="100">&nbsp;</td>

       <td width="100"><div align="center" ><?php echo '$'.number_format($c+$cargos[0],2);?></div></td>
       <td width="100"><div align="center" ><?php echo '$'.number_format($abono[0],2);?></div></td>
     </tr>


     <tr>

       <td class="notice">Saldo</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>

       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100">&nbsp;</td>
       <td class="notice" width="100"><div align="center" > <?php echo '$'.number_format(($c+$cargos[0])-$abono[0],2);?> </div></td>
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
