<?PHP require("menuOperaciones.php"); ?>
<?php


if($_GET['keyAPF']!='' and $_GET['status']=='request'){
$agrega2 = "UPDATE facturasAplicadas set
statusDevolucion='si'


where
entidad='".$entidad."'
    and
numFactura='".$_GET['numFactura']."'";

mysql_db_query($basedatos,$agrega2);
echo mysql_error();

$agrega = "UPDATE facturaGrupos set
statusDevolucion='si'


where
entidad='".$entidad."'
    and
numFactura='".$_GET['numFactura']."'";

mysql_db_query($basedatos,$agrega);
echo mysql_error();


$_POST['buscar']='search';
//$_POST['fechaInicial']=$_GET['fechaInicial'];
//$_POST['fechaFinal']=$_GET['fechaFinal'];
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Factura Cancelada...';
}

?>



<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria11 (URL){
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
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

 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }

?>

<form id="form10" name="form10" method="post" action="#">
  <h1 align="center" >Cancelar Facturas</h1>
  <h3 align="center" >
      <?php
      if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>

  </h3>
  <table width="313" class="table-forma">

    <tr>
      <td width="82"><label>
      <label> Fecha Inicial</label></td>

      <td width="115"><label>
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
   </label></td>
    </tr>


          <tr>
            <td >
            <label> Fecha Final</label></td>
            <td><label>
              <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly="readonly"
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
            </label>
            <input name="lanzador" type="button"  id="lanzador1" value="..." /></td>
    </tr>
    

  </table>
  <br />

        <input name="buscar" type="submit"  id="button" value="Buscar" />
 
        
  <?php if($_POST['buscar'] ){ ?>
<br /><br />


  <table width="800" class="table table-striped" >
    <tr >
      <th width="10"  scope="col"><div align="left">#</div></th>
      <th width="30"  scope="col"><div align="left">Fecha</div></th>
      <th width= "60"  scope="col"><div align="left">Factura</div></th>
      <th width= "300"  scope="col"><div align="left">Aseguradora</div></th>
      <th  scope="col"><div align="left">Importe</div></th>
      <th  scope="col"><div align="left">IVA</div></th>


	  <th  scope="col"><div align="left" >
        <div align="left">Status</div>
      </div></th>
	  <th  scope="col"><div align="left" >
	    <div align="left">---</div>
	  </div></th>
    </tr>
    <tr>



<?php


 $sSQL= "SELECT *
FROM
facturasAplicadas
where
entidad='".$entidad."'
and
fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."'
and
(status='facturado' or status='cancelada')
and
numFactura!=''
group by  numFactura
 ";





if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$a+=1;




$sSQLc= "SELECT *
FROM
facturasAplicadas
where
entidad='".$entidad."'
and
numFactura='".$myrow['numFactura']."'
 ";
$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);


$nT=$myrow['keyClientesInternos'];





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
  naturaleza='C'
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
  ";

  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
?>



         <tr  >

   <td width="10"  >

<div align="center" >
  <div align="left">
    <?php
echo $a;
?>
  </div>
</div></td>



        <td height="24" bgcolor="<?php echo $color?>" ><div align="left"><?php echo cambia_a_normal($myrowc['fecha']);
?></div></td>

 <td   >

<div align="center" >
  <div align="left">
    <?php
echo $myrow['numFactura'];
?>
  </div>
</div></td>



      <td  >
        <div align="left">
          <?php
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT
*
FROM
clientes
WHERE
entidad='".$entidad."'
    and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?>
      </span></div></td>

<td  >

<div align="center" >
  <div align="left">
    <?php
echo '$'.number_format(($myrow7['acumulado'])-($myrow7d['acumulado']),2);
?>
  </div>
</div></td>







<td  ><div align="center" >
  <div align="left">
    <?php
echo '$'.number_format($myrow7['ivaa']-$myrow7d['ivaa'],2);
?>
  </div>
</div></td>



<td  >



    
        <?php if($myrow['statusDevolucion']=='si'){?>
    <div align="left" class="error">
  <?php

	echo 'Devolucion';

?>
</div>
<?php }else{


	echo $myrow['status'];
}
?>



</td>




<td >
 <?php if($myrow['statusDevolucion']!='si'){?>
<a href="cancelacionFactura.php?numFactura=<?php echo $myrow['numFactura'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keyAPF=<?php echo $myrow['keyAPF'];?>&status=request&fechaInicial=<?php  echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>" onClick="if(confirm('Esta seguro que deseas cancelar esta factura?') == false){return false;}" >
Cancelar</a>
    <?php }else{echo '---';}?>


</td>
    </tr>
    <?php  }}}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>

<p>&nbsp;</p>
</form>


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