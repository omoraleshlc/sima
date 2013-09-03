<?PHP require("menuOperaciones.php"); ?>

<script language=javascript>
function ventanaSecundaria10 (URL){
   window.open(URL,"ventanaSecundaria10","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>




<form id="form10" name="form10" method="POST" >
  <h1 align="center" >PAGOS APLICADOS Y NO APLICADOS
    
  </h1>

<table width="200" class="table-forma">
   <tr>
     <td><table width="250" >
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
         
         
          <td> 
              <select name="escoje">
                  <option >Escoje el tipo de pago</option>    
                  <option
                      <?php if($_POST['escoje']=='pagados'){echo 'selected=""';}?>
                      value="pagados">Aplicados</option> 
                  <option
                      <?php if($_POST['escoje']=='noPagados'){echo 'selected=""';}?>
                      value="noPagados">No Aplicados</option>
              </select>
          </td>
         
         <td> <input name="send" type="Submit" src="../../imagenes/btns/fecha.png"  value="Buscar" /></td>
       </tr>
     </table></td>
   </tr>
   </table>    
    
    <br>
    <br>
    <?php if($_POST['send']!=NULL and $_POST['escoje']!=NULL){?>
  <table width="562" class="table table-striped">
    <tr>
         <th width="10"  scope="col"><div align="left">#</div></th>
      <th width="74"  scope="col"><div align="left">Fecha</div></th>
      <th width= "270"  scope="col"><div align="left">Aseguradora</div></th>
  <th  scope="col"><div align="left">Cajero</div></th>
	  <th  scope="col"><div align="right">Importe</div></th>
	  

	
    </tr>
    <tr>
      <?php	


if($_POST['escoje']=='pagados'){
 $sSQL= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoTransaccion='abaseg' or tipoTransaccion='DEVABOASEG' )
and
(fechaPagoCxC>='".$date1."' and fechaPagoCxC<='".$date2."')
    and
    statusFactura='pagado'
order by fecha1 DESC
"; 
}elseif($_POST['escoje']=='noPagados'){
 
  $sSQL= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoTransaccion='abaseg' or tipoTransaccion='DEVABOASEG' )
and
(fecha1>='".$date1."' and fecha1<='".$date2."')
    and
    statusFactura!='pagado'
order by fecha1 DESC
";
}

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


?>

          <td height="24" bgcolor="<?php echo $color?>" ><?php echo $a;?></td>
      <td height="24" bgcolor="<?php echo $color?>" ><?php echo cambia_a_normal($myrow['fecha1']);?></td>


      <td width="270" bgcolor="<?php echo $color?>" ><?php 

		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['clientePrincipal']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];

?>


<br />

<span > Recibo: </span>
	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirNumeroRecibo.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;folioFactura=<?php echo $_POST['folioFactura']; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;hora1=<?php echo $hora1; ?>&amp;fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&amp;credencial=<?php echo $_POST['credencial'];?>&amp;siniestro=<?php echo $_POST['siniestro'];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>','ventana7','800','600','yes');">

<?php print $myrow['numRecibo'];?>
              </a>
</span></td>

      <td width="71"  ><?php echo $myrow['usuario'];?></td>      
      
      <td width="71" align="right" ><?php
echo '$'.number_format( $myrow['precioVenta']*$myrow['cantidad'],2);
?></td>

      
    
    </tr> 
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>

<p>&nbsp;</p>
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