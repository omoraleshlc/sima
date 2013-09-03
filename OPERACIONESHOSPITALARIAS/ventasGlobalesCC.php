<?php  require("menuOperaciones.php");
// **************************************************************************
// sample.php - sample script that demonstrates using as-diagrams.php,
// class for drawing gd-less bar diagrams.
//
// Written by Alexander Selifonov,  http://as-works.narod.ru
// Read "as-diagrams.htm" for how-to instructions
// **************************************************************************


require_once('../js/diagramas/as-diagrams.php');
?>
<html>
<HEAD>
<META http-equiv="Content-Type" Content="text/html; charset=windows-1251">


	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</HEAD>
<BODY>
    
    
    
    
    
  <h1 align="center" class="titulos">REPORTES</h1>
    <h3 align="center" class="titulomed">Ventas x centro de costo</h3>
 <form id="form2" name="form2" method="POST" >
   <div align="center"></div>
   <p align="center">
     <label></label></p>
   <h1 align="center" class="titulomedio">Estad&iacute;stica general, a&ntilde;o: 
<?php 
$year= date(Y);

?>


<select name="year" class="titulos">
<option value="">........</option>


<option
<?php if(($year-2)==$_POST['year'])echo 'selected="selected"';?>
 value="<?php echo $year-2;?>"><?php echo $year-2;?></option>



<option
<?php if(($year-1)==$_POST['year'])echo 'selected="selected"';?>
 value="<?php echo $year-1;?>"><?php echo $year-1;?></option>



<option 
<?php if(($year)==$_POST['year'])echo	'selected="selected"';?>
value="<?php echo $year;?>"><?php echo $year;?></option>


</select>

</h1>  

   
   <table >
    <tr  >
      
        <td  ></td>
      
   
      <tr>
        <th height="37" scope="col">&nbsp;</th>
        <th width="129" ><div align="left">Centro de costo</div></th>
        <th width="338" scope="col"><div align="left">
          <?php 
		
		  require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style7',$almacenDestino,$almacenDestino,$basedatos);
?>
        </div></th>
      </tr>
      
      <td >&nbsp;</td>
      
    </tr>
    
    
    
    <tr>
              <td >&nbsp;</td>
     <td  ><div align="left">
        <label>
        <input name="search" type="submit" id="search" value="Buscar" />
        </label>
      </div></td>
    </tr>
   </table>
    

 </form>
 


</body>
</html>    
    
    
    
    
    
    
    
    
<?php
if($_POST['search']!=NULL and $_POST['almacenDestino']!=NULL and $_POST['year']!=NULL){
$data_title = 'Resumen de ventas anuales'; // title for the diagram

// sample data array
/*
$data = array();
$data[] = array(92300, 130550,160330);
$data[] = array(1200,1800,2500);
$data[] = array(1400,2000,2800);
$data[] = array(1900,2900,3900);
$data[] = array(250000,350000,450000);
*/


$data = array();










$year=$_POST['year'];
$clientePrincipal=$_POST['seguro'];











$eneroInicial=$year.'-01-01';
$eneroFinal=$year.'-01-31';

//ENERO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as enero
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$eneroInicial."' and fechaCierre<='".$eneroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$eneroInicial."' and fechaCierre<='".$eneroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$eneroExternos=$myrow['enero']-$myrowd['devoluciones'];






//ENERO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as enero
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$eneroInicial."' and fechaCargo<='".$eneroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
(fechaCargo>='".$eneroInicial."' and fechaCargo<='".$eneroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$eneroInternos=$myrow['enero']-$myrowd['devoluciones'];
$data[] = array($eneroInternos,$eneroExternos,($eneroInternos+$eneroExternos));
//CIERRA ENERO*********************************************














$febreroInicial=$year.'-02-01';
$febreroFinal=$year.'-02-31';
//FEBRERO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as febrero
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$febreroInicial."' and fechaCierre<='".$febreroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$febreroInicial."' and fechaCierre<='".$febreroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$febreroExternos=$myrow['febrero']-$myrowd['devoluciones'];













//FEBRERO INTERNOS
 $sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as febrero
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$febreroInicial."' and fechaCargo<='".$febreroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$febreroInicial."' and fechaCargo<='".$febreroFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$febreroInternos=$myrow['febrero']-$myrowd['devoluciones'];


$data[] = array($febreroInternos,$febreroExternos,($febreroInternos+$febreroExternos));
//CIERRA FEBRERO*********************************************





















$marzoInicial=$year.'-03-01';
$marzoFinal=$year.'-03-31';
//MARZO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as marzo
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$marzoInicial."' and fechaCierre<='".$marzoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$marzoInicial."' and fechaCierre<='".$marzoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$marzoExternos=$myrow['marzo']-$myrowd['devoluciones'];






//MARZO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as marzo
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$marzoInicial."' and fechaCargo<='".$marzoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$marzoInicial."' and fechaCargo<='".$marzoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$marzoInternos=$myrow['marzo']-$myrowd['devoluciones'];


$data[] = array($marzoInternos,$marzoExternos,($marzoInternos+$marzoExternos));
//CIERRA MARZO*********************************************
















$abrilInicial=$year.'-04-01';
$abrilFinal=$year.'-04-31';
//ABRIL EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as abril
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$abrilInicial."' and fechaCierre<='".$abrilFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$abrilInicial."' and fechaCierre<='".$abrilFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$abrilExternos=$myrow['abril']-$myrowd['devoluciones'];






//ABRIL INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as abril
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$abrilInicial."' and fechaCargo<='".$abrilFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$abrilInicial."' and fechaCargo<='".$abrilFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$abrilInternos=$myrow['abril']-$myrowd['devoluciones'];


$data[] = array($abrilInternos,$abrilExternos,($abrilInternos+$abrilExternos));
//CIERRA ABRIL*********************************************


















$mayoInicial=$year.'-05-01';
$mayoFinal=$year.'-05-31';
//MAYO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as mayo
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$mayoInicial."' and fechaCierre<='".$mayoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$mayoInicial."' and fechaCierre<='".$mayoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$mayoExternos=$myrow['mayo']-$myrowd['devoluciones'];






//MAYO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as mayo
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$mayoInicial."' and fechaCargo<='".$mayoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$mayoInicial."' and fechaCargo<='".$mayoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$mayoInternos=$myrow['mayo']-$myrowd['devoluciones'];


$data[] = array($mayoInternos,$mayoExternos,($mayoInternos+$mayoExternos));
//CIERRA MAYO*********************************************




















$junioInicial=$year.'-06-01';
$junioFinal=$year.'-06-31';
//JUNIO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as junio
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$junioInicial."' and fechaCierre<='".$junioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$junioInicial."' and fechaCierre<='".$junioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$junioExternos=$myrow['junio']-$myrowd['devoluciones'];






//JUNIO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as junio
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$junioInicial."' and fechaCargo<='".$junioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$junioInicial."' and fechaCargo<='".$junioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$junioInternos=$myrow['junio']-$myrowd['devoluciones'];


$data[] = array($junioInternos,$junioExternos,($junioInternos+$junioExternos));
//CIERRA JUNIO*********************************************







$julioInicial=$year.'-07-01';
$julioFinal=$year.'-07-31';
//JULIO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as julio
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$julioInicial."' and fechaCierre<='".$julioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$julioInicial."' and fechaCierre<='".$julioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$julioExternos=$myrow['julio']-$myrowd['devoluciones'];






//JULIO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as julio
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$julioInicial."' and fechaCargo<='".$julioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$julioInicial."' and fechaCargo<='".$julioFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$julioInternos=$myrow['julio']-$myrowd['devoluciones'];


$data[] = array($julioInternos,$julioExternos,($julioInternos+$julioExternos));
//CIERRA JULIO*********************************************

















$agostoInicial=$year.'-08-01';
$agostoFinal=$year.'-08-31';
//AGOSTO EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as agosto
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$agostoInicial."' and fechaCierre<='".$agostoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$agostoInicial."' and fechaCierre<='".$agostoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$agostoExternos=$myrow['agosto']-$myrowd['devoluciones'];






//AGOSTO INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as agosto
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$agostoInicial."' and fechaCargo<='".$agostoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$agostoInicial."' and fechaCargo<='".$agostoFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$agostoInternos=$myrow['agosto']-$myrowd['devoluciones'];


$data[] = array($agostoInternos,$agostoExternos,($agostoInternos+$agostoExternos));
//CIERRA AGOSTO*********************************************
























$septiembreInicial=$year.'-09-01';
$septiembreFinal=$year.'-09-31';
//SEPTIEMBRE EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as septiembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$septiembreInicial."' and fechaCierre<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$septiembreInicial."' and fechaCierre<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$septiembreExternos=$myrow['septiembre']-$myrowd['devoluciones'];






//SEPTIEMBRE INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as septiembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$septiembreInicial."' and fechaCargo<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$septiembreInicial."' and fechaCargo<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$septiembreInternos=$myrow['septiembre']-$myrowd['devoluciones'];


$data[] = array($septiembreInternos,$septiembreExternos,($septiembreInternos+$septiembreExternos));
//CIERRA SEPTIEMBRE*********************************************










$septiembreInicial=$year.'-10-01';
$septiembreFinal=$year.'-10-31';
//OCTUBRE EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as octubre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$septiembreInicial."' and fechaCierre<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$septiembreInicial."' and fechaCierre<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$octubreExternos=$myrow['octubre']-$myrowd['devoluciones'];






//OCTUBRE INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as octubre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$septiembreInicial."' and fechaCargo<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$septiembreInicial."' and fechaCargo<='".$septiembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$octubreInternos=$myrow['octubre']-$myrowd['devoluciones'];


$data[] = array($octubreInternos,$octubreExternos,($octubreInternos+$octubreExternos));
//CIERRA OCTUBREs*********************************************













$noviembreInicial=$year.'-11-01';
$noviembreFinal=$year.'-11-31';
//NOVIEMBRE EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as noviembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$noviembreInicial."' and fechaCierre<='".$noviembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$noviembreInicial."' and fechaCierre<='".$noviembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$noviembreExternos=$myrow['noviembre']-$myrowd['devoluciones'];






//NOVIEMBRE INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as noviembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$noviembreInicial."' and fechaCargo<='".$noviembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$noviembreInicial."' and fechaCargo<='".$noviembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$noviembreInternos=$myrow['noviembre']-$myrowd['devoluciones'];


$data[] = array($noviembreInternos,$noviembreExternos,($noviembreInternos+$noviembreExternos));
//CIERRA NOVIEMBRE*********************************************















$diciembreInicial=$year.'-12-01';
$diciembreFinal=$year.'-12-31';
//DICIEMBRE EXTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as diciembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$diciembreInicial."' and fechaCierre<='".$diciembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
tipoPaciente='externo'


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
$sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCierre>='".$diciembreInicial."'  and fechaCierre<='".$diciembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
    and
    tipoPaciente='externo'


";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
$diciembreExternos=$myrow['diciembre']-$myrowd['devoluciones'];






//DICIEMBRE INTERNOS
$sSQL= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as diciembre
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$diciembreInicial."'  and fechaCargo<='".$diciembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')


";


$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
    
 $sSQLd= "
    SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as devoluciones
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
almacenIngreso='".$_POST['almacenDestino']."'
    and
    (fechaCargo>='".$diciembreInicial."'  and fechaCargo<='".$diciembreFinal."')
    and
    gpoProducto!=''
    and
    naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$diciembreInternos=$myrow['diciembre']-$myrowd['devoluciones'];


$data[] = array($diciembreInternos,$diciembreExternos,($diciembreInternos+$diciembreExternos));
//CIERRA DICIEMBRE*********************************************





















$legend_x = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$legend_y = array('Internos','Externos','Totales');

$graph = new CAsBarDiagram;
$graph->bwidth = 100; // set one bar width, pixels
$graph->bt_total = 'Resumen'; // 'totals' column title, if other than 'Totals'
// $graph->showtotals = 0;  // uncomment it if You don't need 'totals' column
$graph->precision = 0;  // decimal precision
// call drawing function
$graph->DiagramBar($legend_x, $legend_y, $data, $data_title);
}
?>
<br>
<br>