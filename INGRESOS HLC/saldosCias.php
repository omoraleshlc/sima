<?PHP require("menuOperaciones.php"); 
function noRound($val, $pre = 0) {
    $val = (string) $val;
    if (strpos($val, ".") !== false) {
        $tmp = explode(".", $val);
        $val = $tmp[0] .".". substr($tmp[1], 0, $pre);
    }
    return (float) $val;
} 
?>

<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventanaSecundaria2","width=800,height=600,scrollbars=YES")
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
<meta http-equiv="Content-Type" content="text/html" />


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>


</head>

<body>

 <h1 align="center">&nbsp;</h1>

<h1 align="center"><?php echo utf8_decode('Saldos por compañías');?></h1>
<p>
   Fecha de Apertura <?php 
   $sSQLp= "Select fechaApertura from entidades
WHERE
codigoEntidad='".$entidad."'


";


$resultp=mysql_db_query($basedatos,$sSQLp);
$myrowp = mysql_fetch_array($resultp);
echo cambia_a_normal($myrowp['fechaApertura']);


$_POST['fechaInicial']=$myrowp['fechaApertura'];


 if($_POST['fechaFinal']){
		 $fe= $_POST['fechaFinal'];
		 } else {
		 $fe= $fecha1;
		 }
                 
                 

 if($_POST['fechaMedio']){
		 $feM= $_POST['fechaMedio'];
		 } else {
		 $feM= $fecha1;
		 }                 
   ?>
</p>






 <form id="form2" name="form2" method="post" action="">
 
     
     
    <table width="521" height="211" class="table-forma">     
<tr>
        <td width="1" height="29"  scope="col">&nbsp;</td>
        <td  ><div align="left" >Fecha Inicial </div></td>
      <td ><div align="left">
            <label>
            <input name="fechaMedio" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaMedio']){
		 echo $_POST['fechaMedio'];
		 }else{
                     echo $feM;
                 }
		 ?>"/>
            </label>
            <input name="button" type="button"  id="lanzador" value="..." />
        </div></td>
      </tr>
      <tr>
        <td width="1" height="31"  scope="col">&nbsp;</td>
        <td  ><div align="left" >Fecha Final </div></td>
      <td ><div align="left">
            <label></label>
            <label></label>
            <label>
            <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }else{
                      echo $fe;
                 }
		 ?>"/>
            </label>
            <input name="button1" type="button"  id="lanzador1" value="..." />
        </div></td>
      </tr>
       
     
     
     
<tr>
    <td width="1" height="31"  scope="col">&nbsp;</td>
     <td ><div align="center">
     <input name="buscar" type="submit"  id="search" value="Buscar" />
     </div>
 </td>
     
      <td width="1" height="31"  scope="col">&nbsp;</td>

       </tr>
 </table>
     
     
     
     <br>
         <br>
     
     

  
   <table width="600" class="table table-striped">

         <th width="10"  >#</th>
       
       <th width="100"  ><span >Nombre Aseguradora</span></th>

        <th width="100" >Saldo al Corte</th>  

       <th width="30"  >Detalles</th>

     </tr>
        <?php

$sSQL2= "Select * From entidades WHERE keyEntidades = '".$entidad."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$sSQL24= "
select * from
clientes
where entidad='".$entidad."'
    and
    subCliente=''
    order by nomCliente ASC

";
$result24=mysql_db_query($basedatos,$sSQL24);
while($myrow24 = mysql_fetch_array($result24)){

$a+=1;








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
?>




<td >
<?php

echo $a;
?>
</td>    
    
       <td >
<?php

echo utf8_decode($myrow24['nomCliente']);
?></td>
      
    
     
     
     
  
     
     
     
     
     
<td>
<?php        



if($fecha1>$myrow2['fechaApertura']){
    $sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$myrow24['numCliente']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);
//echo '$'.number_format($myrowcp['saldoInicial'],2);


$sSQL1c="SELECT sum(precioVenta*cantidad) as cargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow24['numCliente']."'
and
(tipoTransaccion='taseg' or tipoTransaccion='tnom' or tipoTransaccion='DEVABOASEG')
and

(fecha1>='".$feM."' and fecha1<='".$fe."')
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
clientePrincipal='".$myrow24['numCliente']."'
and
(tipoTransaccion='devxaseg' or tipoTransaccion='abaseg' )
and

(fecha1>='".$feM."' and fecha1<='".$fe."')

";
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

(fecha1>='".$feM."' and fecha1<='".$fe."')

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);




$c=($myrow1c['cargos']-($myrow1a['abonos']+$myrownc['nc']))+$myrowcp['saldoInicial'];
}else{
$c=$myrowcp['saldoInicial'];
}







$saldosIniciales=$c;
echo '$'.number_format( $c,2);
$totales[0]+=$c;
?>
         
         
         
         
     </td>     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    
    
    
    

      <td >
<a  href="javascript:ventanaSecundaria2('../cargos/detallesClientes.php?nombre=<?php echo $myrow24['nomCliente'];?>&numCliente=<?php echo $myrow24['numCliente'];?>&seguro=<?php echo $myrow24['numCliente'];?>&nombreCliente=<?php echo $myrow24['nomCliente']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
Ver
</a>

      </td>
     </tr>     <?php } ?>
   </table>

     

</form>

<p align="center">
    
<a href="javascript:ventanaSecundaria2('../ventanas/saldosxCIAS.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&fechaCorte=<?php echo $fe;?>')">
-Imprimir Saldos-
</a>  
</p>




 <p align="center">
    
     <?php if($totales[0]!=NULL){?>
     <div align="center" class="success">
     <?php 
     echo '$'.number_format($totales[0],2);?>
     </div>
     <?php } ?>     
     
 </p>





     <br></br>
     <br></br>
     <br></br>

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
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
</body>
</html>