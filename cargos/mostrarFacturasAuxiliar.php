<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include('/configuracion/funciones.php');
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
if($_POST['aplicar']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
 $q = "UPDATE auxiliarfacturacion set
status='standby'
	
		WHERE entidad='".$entidad."' and numfactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Preparado para Aplicarse';
}
?>
















<?php
if($_POST['delete']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE auxiliarfacturacion set
status='request'

		WHERE entidad='".$entidad."' and numfactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
    }
}

$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Se desactivaron facturas para aplicar!';

}
?>


  







<?php
if($_POST['aplicarDefinitivo'] and $_POST['numFactura']){
$numFactura=$_POST['numFactura'];

for($i=0;$i<=$_POST['bandera'];$i++){

    if($numFactura[$i]){
$q = "UPDATE auxiliarfacturacion set
status='pagado'

		WHERE entidad='".$entidad."' and numfactura='".$numFactura[$i]."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


                $q1 = "UPDATE cargosCuentaPaciente set
statusFactura='pagado',pagoCxCKeyCAP='".$_GET['keyCAP']."',fechaPagoCxC='".$fecha1."'

		WHERE keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();


                }
}


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Registro Aplicado Definitivo';

echo '
<script>
//window.alert("PAGO APLICADO!");
//window.close();
window.opener.document.forms["form1"].submit();
</script>';
}
?>




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


 <h1 align="center" class="titulos">Aplicar Pagos, facturacion manual</h1>
 <form id="form2" name="form2" method="post" action="">
   <div align="center"></div>
   <p align="center">
     <label></label>
     Escojer Fechas</p>
   <table width="200" border="1" align="center" cellpadding="1" cellspacing="1">
     <tr>
       <th scope="col"><div align="left">De:</div></th>
       <th scope="col"><div align="left">
         <input name="fechaInicial" type="text" class="camposmid" id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></th>
       <th scope="col"><div align="center">
         <input name="button" type="button" src="../../imagenes/btns/fecha.png" id="lanzador1" value="..." />
       </div></th>
     </tr>
     <tr>
       <td><div align="left">a:</div></td>
       <td><div align="left">
         <input name="fechaFinal" type="text" class="camposmid" id="campo_fecha2" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></td>
       <td><div align="center">
         <input name="button1" type="button" src="../../imagenes/btns/fecha.png" id="lanzador2" value="..." />
       </div></td>

       <td>
           <input type="submit" value="buscar"></input>

       </td>

     </tr>
   </table>

 



















<p >&nbsp;</p>

<select name="choose" onchange="this.form.submit()">
    <option >Escoje</option>
    <option
        <?php if($_POST['choose']=='Todos')echo 'selected=""';?>

        value="Todos">Todos</option>
    <option
        <?php if($_POST['choose']=='Reservados')echo 'selected=""';?>
        value="Reservados">Reservados</option>

        <option
        <?php if($_POST['choose']=='Pagados')echo 'selected=""';?>
        value="Pagados">Pagados</option>
</select>

<?php if($_POST['choose']!= NULL){?>

   
   
    <table width="200" border="0" align="center" class="style12">
     <tr bgcolor="#330099">
       <th width="74" scope="col"><div align="left" class="blanco">
         <div align="left">Fecha</div>
       </div></th>
       <th width="200" scope="col"><div align="left" class="blanco">
         <div align="left"># Factura</div>
       </div></th>
       <th width="20" scope="col"><div align="left" class="blanco">
         <div align="left"></div>
       </div></th>

     <th width="100" scope="col"><div align="left" class="blanco">
         <div align="left">Facturado</div>
       </div></th>

          <th width="100" scope="col"><div align="left" class="blanco">
         <div align="left">Status</div>
       </div></th>
    </tr>




<?php
if($_POST['choose']!='Escoje'){
if($_POST['choose']=='Todos'){
$sSQL= "Select * From auxiliarfacturacion
where
entidad='".$entidad."'
    and
    seguro='".$_GET['seguro']."'
        and
        fecha>='".$_POST['fechaInicial']."' and  fecha<='".$_POST['fechaFinal']."'
            and
            status='request'
group by numfactura
order by numfactura ASC
";
}else if($_POST['choose']=='Reservados'){
  $sSQL= "Select * From auxiliarfacturacion
where
entidad='".$entidad."'
        and
    seguro='".$_GET['seguro']."'
        and
        seguro!=''
and
fecha>='".$_POST['fechaInicial']."' and  fecha<='".$_POST['fechaFinal']."'
and
status='standby'
group by numFactura
order by numFactura ASC
";

}else if($_POST['choose']=='Pagados'){
$sSQL= "Select * From auxiliarfacturacion
where
entidad='".$entidad."'
        and
    seguro='".$_GET['seguro']."'
and
fecha>='".$_POST['fechaInicial']."' and  fecha<='".$_POST['fechaFinal']."'
and
status='pagado'

group by numFactura
order by numFactura ASC
";

}

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;



$sSQL455= "Select sum(precioventa+iva) as facturado from auxiliarfacturacion where entidad='".$entidad."'
    
and
numfactura='".$myrow['numfactura']."'";

$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);





$sSQL4= "Select status,precioventa,iva from auxiliarfacturacion where entidad='".$entidad."'
and
numfactura='".$myrow['numfactura']."'";

$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);


if($myrow4['status']=='standby'){
$seleccionado[0]+=$myrow4['precioventa']+$myrow4['iva'];
}


?>
<tr bgcolor="#FFFFFF"  >
       <td class="normal">


	   <?php echo cambia_a_normal($myrow['fecha']);?>


	   </td>


       <td class="normal">


	<?php echo $myrow['numfactura'];?>
	 

	   </td>




       <td height="29" class="normal">

<?php if( $myrow['status']!='pagado'){ ?>
    <input name="numFactura[]" type="checkbox" value="<?php echo $myrow['numfactura'];?>" class="normal"></input>
    <?php } ?>

       </td>

    <td height="29" class="normal">
        <?php echo '$'.number_format($myrow455['facturado'],2);?>
    </td>

       <td height="29" class="normal">
        <?php echo $myrow4['statusPago'];?>
    </td>
</tr>
     <?php }?>
  </table>





<?php if($_POST['choose']!='Pagados'){ ?>
<p >&nbsp;</p>
<div align="center" class="normal">
<br>
    <?php

 $sSQL455= "Select sum(precioventa+iva) as io from auxiliarfacturacion where entidad='".$entidad."'
and
numfactura='".$myrow['numfactura']."'
and
status='standby'
";

$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

    ?>

    Seleccionado: <?php echo '$'.number_format($seleccionado[0],2);?>
</br>

<br>
    a Aplicar: <?php echo '$'.number_format($_GET['cantidad'],2);?>
</br>

    <br>

    Diferencia: <?php echo '$'.number_format($_GET['cantidad']-$seleccionado[0],2);?>
</br>

</div>


<p >&nbsp;</p>
<input name="bandera" value="<?php echo $bandera;?>" type="hidden"></input>

<?php if($_POST['choose']=='Todos'){ ?>
<input name="aplicar" value="Selecciona Facturas" type="submit"></input>
<?php } ?>


<?php
$diferencia=($_GET['cantidad'] - $seleccionado[0]);
?>



<?php if($_POST['choose']=='Reservados' and ($diferencia>-1 and $diferencia<1) ){?>
<input name="aplicarDefinitivo" value="Aplicar Definitivo" type="submit"></input>
<?php } ?>


<?php if($_POST['choose']=='Reservados'  ){?>
<input name="delete" value="Quitar" type="submit"></input>
<?php } ?>
<?php } ?>


  <?php }//cierra validacion de choose
}
  ?>


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