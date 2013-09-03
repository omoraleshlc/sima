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
  <h1 align="center" >ESTADO DE FACTURAS
    
  </h1>
    
    <h3>
        Aplicadas y No Aplicadas
    </h3>

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
                  <option >Escoje el tipo de Factura</option>    
                  <option
                      <?php if($_POST['escoje']=='Aplicada'){echo 'selected=""';}?>
                      value="Aplicada">Aplicada</option> 
                  <option
                      <?php if($_POST['escoje']=='Pendiente'){echo 'selected=""';}?>
                      value="Pendiente">Pendiente</option>
              </select>
          </td>
          <td> </td>
         <td> 
             <div align="center">
             <input name="send" type="Submit" src="../../imagenes/btns/fecha.png"  value="Buscar" />
             </div>
             </td>
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
  <th width="74"  scope="col"><div align="left">FechaPago</div></th>
  <th width="100"  scope="col"><div align="left">Factura</div></th>
      <th width= "270"  scope="col"><div align="left">Aseguradora</div></th>
	  
  <th  scope="col"><div align="left">Usuario</div></th>
  <th  scope="col"><div align="left">Importe</div></th>
  <th  scope="col"><div align="left">Iva</div></th>
  <th  scope="col"><div align="left">Total</div></th>
	
    </tr>
    <tr>
      <?php	


if($_POST['escoje']=='Aplicada'){
$sSQL= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and
(fecha>='".$date1."' and fecha<='".$date2."')
    and
    statusPago='pagado'
    and
    seguro!=''
    and
    numFactura>0
    and
    transaccion!='si'
    and
    status='facturado'
    group by numFactura
    order by fecha ASC
"; 
}elseif($_POST['escoje']=='Pendiente'){
 
 $sSQL= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."'
and

(fecha>='".$date1."' and fecha<='".$date2."')
    and
   status='facturado' 
and
    statusPago!='pagado'
    and
    seguro!=''
    and
    numFactura>0
    and
    transaccion!='si'
    and
    status='facturado'
    group by numFactura
order by fecha ASC
";
}

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;



?>

          <td  ><?php echo $a;?></td>
  
      <td ><?php echo cambia_a_normal($myrow['fecha']);?></td>
      
      
      <td >
          <div align="center">    
          <?php 
      if($myrow['fechaPago']!=''){
      echo cambia_a_normal($myrow['fechaPago']);
      }else{
          echo '---';
      }
      ?>
          </div>
          </td>
        
      
      
      <td ><?php echo $myrow['numFactura'];?></td>
      <td ><?php 

$sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['seguro']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];

?>


<br />


</span></td>


      <td >
          <?php 
          if($myrow['usuario']!=NULL){
          echo $myrow['usuario'];
          }else{
              echo '---';
          }
          ?>
      </td>

      
      

<td  align="right">
	   <div align="center">
	   <?php
           if($myrow['transaccion']!='si'){
               if($myrow['numFactura']>0){
$sSQL7="SELECT
sum(importe*cantidad) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numFactura='".$myrow['numFactura']."'
  and
  naturaleza='C'
  and
  transaccion!='si'
  
  
  ";

  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


 $sSQL7d="SELECT
sum(importe*cantidad) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numFactura='".$myrow['numFactura']."'
  and
  naturaleza='A'
  and
  transaccion!='si'
  ";

  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
$dImporte=$myrow7['totalCuenta']-$myrow7d['totalCuenta'];
echo '$'.number_format($myrow7['totalCuenta']-$myrow7d['totalCuenta'],2);
  $importe[0]+=$myrow7['totalCuenta']-$myrow7d['totalCuenta'];
	   }
           }
           ?>
	   </div></td>
           
           
           
           
<td  align="right">
	   <div align="center">
	   <?php
           if($myrow['transaccion']!='si'){
               if($myrow['numFactura']>0){
$sSQLa="SELECT
sum(iva*cantidad) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numFactura='".$myrow['numFactura']."'
  and
  naturaleza='C'
  and
  transaccion!='si'
  
  
  ";

  $resulta=mysql_db_query($basedatos,$sSQLa);
  $myrowa = mysql_fetch_array($resulta);


 $sSQLd="SELECT
sum(iva*cantidad) as totalCuenta
  FROM
facturasAplicadas
  WHERE
entidad='".$entidad."'
and
  numFactura='".$myrow['numFactura']."'
  and
  naturaleza='A'
  and
  transaccion!='si'
  ";

  $resultd=mysql_db_query($basedatos,$sSQLd);
  $myrowd = mysql_fetch_array($resultd);
  
  $diva=$myrowa['totalCuenta']-$myrowd['totalCuenta'];
echo '$'.number_format($myrowa['totalCuenta']-$myrowd['totalCuenta'],2);
  $iva[0]+=$myrowa['totalCuenta']-$myrowd['totalCuenta'];
 
	   }
           }
           ?>
	   </div></td>           
      
      
      
 <td  align="right">
     <div align="center">
     <?php echo '$'.number_format($dImporte+$diva,2);?>    
     </div>
 </td>
    
    </tr> 
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>


</form>
<p>&nbsp;</p>


<div align="center" class="success">
<?php
if($importe[0]>0){
echo 'Importe: $'.number_format($importe[0],2).', Iva: $'.number_format($iva[0],2).', total: '.'$'.number_format($importe[0]+$iva[0],2);
    

}
?>
</div>
   
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