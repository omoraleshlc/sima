<?PHP require("/configuracion/ventanasEmergentes.php"); ?>


<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>








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

$estilos= new muestraEstilos();
$estilos-> styles();

?>

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />



</head>

<h1 align="center" class="titulos">Mostar Estadisticas Resumen &nbsp;</h1>
<form id="form1" name="form1" method="post">
  <table width="300" border="0" align="center" class="Estilo24">
    <tr>
      <td width="71">Fecha Inicial</td>
      <td width="219"><span class="negromid">
        <label>
        <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }else{
		 echo $fecha1;
		 }
		 ?>"/>
        </label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
      </span></td>
    </tr>
    <tr>
      <td>Fecha Final</td>
      <td><span class="negromid">
        <label>
        <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }else{
		 echo $fecha1;
		 }
		 ?>"/>
        </label>
        <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." />
      </span></td>
    </tr>
    
    
          <tr bgcolor="#CCCCCC">
        <td height="45" class="negromid">&nbsp;</td>
        <td class="negromid">Seguro
          <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td colspan="4"><input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span class="codigos">(Exclusivo Aseguradoras)</span></td>
      </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><span class="negromid">
        <label></label>
        <label> </label>
        <label>
        <input name="show" type="submit" id="show" value="Mostrar" />
        </label>
      </span></td>
    </tr>
  </table>
  
  
  <p>
    <?php if($_POST['show']){ ?>
  </p>
  <p>&nbsp; </p>
  <h1 align="center">PACIENTES EXTERNOS </h1>
  <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center" class="normalmid">
    <tr>
      <td colspan="13">
       
      
      </td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="121" class="negromid">Codigo</td>
      <td width="206" class="negromid">Descripcion</td>
      <td width="214" class="negromid">Departamento</td>
      <td width="114" class="negromid">Grupo Prod </td>

      <td width="17" class="negromid"><div align="center">C</div></td>
      <td width="74" class="negromid"><div align="center">Imp P</div></td>
      <td width="76" class="negromid"><div align="center">iva P </div></td>
      <td width="72" class="negromid"><div align="center">ImpCxC</div></td>
      <td width="62" class="negromid"><div align="center">iva A </div></td>

      <td width="68" class="negromid"><div align="center">Total Importe </div></td>
    </tr>
<?php	


 $sSQL1= "SELECT 
*
FROM

articulosReportes
WHERE
keyREPA='".$_GET['keyREPA']."'

";



$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL6= "Select * From gpoProductos where codigoGP='".$myrow1['gpoProducto']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);



if($_POST['seguro']!='' and $_POST['seguro']!='0'){

$sSQL7="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'

and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_POST['seguro']."'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'
and

naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
clientePrincipal='".$_POST['seguro']."'
";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);


}else{//ES PARTICULAR
   
$sSQL7="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'

and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'

";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'
and

naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'

";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);


}



$cantidadExternos[0]+=$myrow7['c']-$myrow7d['c'];



	  ?>





    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><span class="codigosmid"><?php echo $myrow1['codigo']; ?></span></td>
      <td class="normal"><span class="normal">
<?php 

$sSQL7da= "Select descripcionArticulo From cargosCuentaPaciente where entidad='".$entidad."' 
and
codProcedimiento='".$myrow1['codigo']."' order by keyCAP DESC
";
$result7da=mysql_db_query($basedatos,$sSQL7da); 
$myrow7da = mysql_fetch_array($result7da);
echo mysql_error();
echo $myrow7da['descripcionArticulo']; 
?>

</span></td>
      <td class="normal"><span class="normal">
        <?php 
$sSQL7al= "Select descripcion From almacenes where entidad='".$entidad."' 
and
almacen='".$myrow1['departamento']."' 
";
$result7al=mysql_db_query($basedatos,$sSQL7al); 
$myrow7al = mysql_fetch_array($result7al);
echo mysql_error();



if( $myrow7al['descripcion']!=NULL)	{
echo $myrow7al['descripcion']; 
}else{
    echo 'Articulo Eliminado';
}
?>
      </span></td>
      <td class="normal"><?php //*********gpoProductos
	 
$sSQL7g= "Select descripcionGP From gpoProductos where 

codigoGP='".$myrow1['gpoProducto']."'  ";
$result7g=mysql_db_query($basedatos,$sSQL7g); 
$myrow7g = mysql_fetch_array($result7g);
echo mysql_error();
echo $myrow7g['descripcionGP'];
	  ?>      </td>
 
      <td class="normal">
	    <div align="center">
	      <?php 
	  print $myrow7['c']-$myrow7d['c'];
	  
	  ?>
        </div></td>
      <td class="normal"><div align="center">
        <?php   
	  print  '$'.number_format($myrow7['cP']-$myrow7d['cP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
        <?php 
	  print  '$'.number_format($myrow7['iP']-$myrow7d['iP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
        <?php 
	  print  '$'.number_format($myrow7['cA']-$myrow7d['cA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
        <?php 
	  print  '$'.number_format($myrow7['iA']-$myrow7d['iA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
        <?php 
	  
	  $importeVE[0]+=(($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA']));
	  print  '$'.number_format((($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA'])),2);
	  
	  ?>
      </div></td>
    </tr>
    <?php  }?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><span class="normal">
        <?php 
echo 'Total Cantidad: '.$cantidadExternos[0];
?>
      </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      
    </tr>
    <tr>
      <td colspan="13"><div align="center" class="normal">Total <?php echo '$'.number_format($importeVE[0],2);?></div></td>
    </tr>
    <tr>
      <td colspan="13"></td>
    </tr>
  </table>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h1 align="center">PACIENTES INTERNOS </h1>
  <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center" class="normalmid">
    <tr>
      <td colspan="13"></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="121" class="negromid">Codigo</td>
      <td width="206" class="negromid">Descripcion</td>
      <td width="214" class="negromid">Departamento</td>
      <td width="114" class="negromid">Grupo Prod </td>
      <td width="17" class="negromid"><div align="center">C</div></td>
      <td width="74" class="negromid"><div align="center">Imp P</div></td>
      <td width="76" class="negromid"><div align="center">iva P </div></td>
      <td width="72" class="negromid"><div align="center">ImpCxC</div></td>
      <td width="62" class="negromid"><div align="center">iva A </div></td>
      <td width="68" class="negromid"><div align="center">Total Importe </div></td>
    </tr>
    <?php	


 $sSQL1= "SELECT 
*
FROM

articulosReportes
WHERE
keyREPA='".$_GET['keyREPA']."'

";



$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL6= "Select * From gpoProductos where codigoGP='".$myrow1['gpoProducto']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);





if($_POST['seguro']!='' and $_POST['seguro']!='0'){

    
$sSQL7="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
(fechaCargo >='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'
and
naturaleza='C'
and
ventasDirectas!='si'
and
clientePrincipal='".$_POST['seguro']."'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
(fechaCargo >='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'

and
almacenIngreso='".$myrow1['departamento']."'
and
naturaleza='A'
and
ventasDirectas!='si'
and
clientePrincipal='".$_POST['seguro']."'
";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);





    
    
}else{ //es particular
$sSQL7="SELECT 
    descripcionArticulo,
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
(fechaCargo >='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'
and
naturaleza='C'
and
ventasDirectas!='si'

";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT 
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
(fechaCargo >='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'

and
almacenIngreso='".$myrow1['departamento']."'
and
naturaleza='A'
and
ventasDirectas!='si'

";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);





}	
	


$cantidadInternos[0]+=$myrow7['c']-$myrow7d['c'];




echo mysql_error();


?>
    <tr bgcolor="#ffffff" onmouseover="bgColor='#cccccc'" onmouseout="bgColor='#ffffff'" >
      <td height="48" class="codigos"><span class="codigosmid"><?php echo $myrow1['codigo']; ?></span></td>
      <td class="normal">
<?php 
$sSQL7da= "Select descripcionArticulo From cargosCuentaPaciente where entidad='".$entidad."' 
and
codProcedimiento='".$myrow1['codigo']."' order by keyCAP DESC
";
$result7da=mysql_db_query($basedatos,$sSQL7da); 
$myrow7da = mysql_fetch_array($result7da);
echo mysql_error();
echo $myrow7da['descripcionArticulo']; 
?>      </td>
      <td class="normal"><?php 
$sSQL7al= "Select descripcion From almacenes where entidad='".$entidad."' 
and
almacen='".$myrow1['departamento']."' 
";
$result7al=mysql_db_query($basedatos,$sSQL7al); 
$myrow7al = mysql_fetch_array($result7al);
echo mysql_error();
if($myrow7al['descripcion']!=NULL){
echo $myrow7al['descripcion']; 
}else{
    echo 'Articulo Eliminado';
}
?>      </td>
      <td class="normal"><?php //*********gpoProductos
	 
$sSQL7g= "Select descripcionGP From gpoProductos where 
codigoGP='".$myrow1['gpoProducto']."'  ";
$result7g=mysql_db_query($basedatos,$sSQL7g); 
$myrow7g = mysql_fetch_array($result7g);
echo mysql_error();
echo $myrow7g['descripcionGP'];
	  ?>      </td>
      <td class="normal"><div align="center">
          <?php 
	  print $myrow7['c']-$myrow7d['c'];
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php   
	  print  '$'.number_format($myrow7['cP']-$myrow7d['cP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['iP']-$myrow7d['iP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['cA']-$myrow7d['cA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['iA']-$myrow7d['iA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  
	  $importeVI[0]+=(($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA']));
	  print  '$'.number_format((($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA'])),2);
	  
	  ?>
      </div></td>
    </tr>
    <?php  }?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
<span class="normal">
<?php 
echo $cantidadInternos[0];
?>
	  </span>
	  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="13"><div align="center" class="normal">Total <?php echo '$'.number_format($importeVI[0],2);?></div></td>
    </tr>
    <tr>
      <td colspan="13"></td>
    </tr>
  </table>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h1 align="center">VENTAS DIRECTAS </h1>
  <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center" class="normalmid">
    <tr>
      <td colspan="13"></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="121" class="negromid">Codigo</td>
      <td width="206" class="negromid">Descripcion</td>
      <td width="214" class="negromid">Departamento</td>
      <td width="114" class="negromid">Grupo Prod </td>
      <td width="17" class="negromid"><div align="center">C</div></td>
      <td width="74" class="negromid"><div align="center">Imp P</div></td>
      <td width="76" class="negromid"><div align="center">iva P </div></td>
      <td width="72" class="negromid"><div align="center">ImpCxC</div></td>
      <td width="62" class="negromid"><div align="center">iva A </div></td>
      <td width="68" class="negromid"><div align="center">Total Importe </div></td>
    </tr>
    <?php	


 $sSQL1= "SELECT 
*
FROM

articulosReportes
WHERE
keyREPA='".$_GET['keyREPA']."'

";



$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL6= "Select * From gpoProductos where codigoGP='".$myrow1['gpoProducto']."'";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);





$sSQL7="SELECT 
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'

and
naturaleza='C'
and
ventasDirectas='si'
";


$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

$sSQL7d="SELECT 
sum(cantidad) as c,
sum(precioVenta*cantidad) as efectivo,
sum(iva*cantidad) as ivar,
sum(cantidadParticular*cantidad) as cP,
sum(cantidadAseguradora*cantidad) as cA,
sum(ivaParticular*cantidad) as iP,
sum(ivaAseguradora*cantidad) as iA
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
(fechaCierre >='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."')
and
codProcedimiento='".$myrow1['codigo']."'
and
almacenIngreso='".$myrow1['departamento']."'
and

naturaleza='A'
and
ventasDirectas='si'
";


$result7d=mysql_db_query($basedatos,$sSQL7d);
$myrow7d = mysql_fetch_array($result7d);



$cantidadVentasDirectas[0]+=$myrow7['c']-$myrow7d['c'];
	
	  ?>
    <tr bgcolor="#ffffff" onmouseover="bgColor='#cccccc'" onmouseout="bgColor='#ffffff'" >
      <td height="48" class="codigos"><span class="codigosmid"><?php echo $myrow1['codigo']; ?></span></td>
      <td class="normal"><?php 
$sSQL7da= "Select descripcionArticulo From cargosCuentaPaciente where entidad='".$entidad."' 
and
codProcedimiento='".$myrow1['codigo']."' order by keyCAP DESC
";
$result7da=mysql_db_query($basedatos,$sSQL7da); 
$myrow7da = mysql_fetch_array($result7da);
echo mysql_error();
echo $myrow7da['descripcionArticulo']; 
?>
      </td>
      <td class="normal"><?php 
$sSQL7al= "Select descripcion From almacenes where entidad='".$entidad."' 
and
almacen='".$myrow1['departamento']."' 
";
$result7al=mysql_db_query($basedatos,$sSQL7al); 
$myrow7al = mysql_fetch_array($result7al);
echo mysql_error();

echo $myrow7al['descripcion']; 
?>
      </td>
      <td class="normal"><?php //*********gpoProductos
	 
$sSQL7g= "Select descripcionGP From gpoProductos where
codigoGP='".$myrow1['gpoProducto']."'  ";
$result7g=mysql_db_query($basedatos,$sSQL7g); 
$myrow7g = mysql_fetch_array($result7g);
echo mysql_error();
echo $myrow7g['descripcionGP'];
	  ?>
      </td>
      <td class="normal"><div align="center">
          <?php 
	  print $myrow7['c']-$myrow7d['c'];
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php   
	  print  '$'.number_format($myrow7['cP']-$myrow7d['cP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['iP']-$myrow7d['iP'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['cA']-$myrow7d['cA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  print  '$'.number_format($myrow7['iA']-$myrow7d['iA'],2);
	  
	  ?>
      </div></td>
      <td class="normal"><div align="center">
          <?php 
	  
	  $importeVD[0]+=(($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA']));
	  print  '$'.number_format((($myrow7['cP']-$myrow7d['cP'])+($myrow7['iP']-$myrow7d['iP']))+(($myrow7['cA']-$myrow7d['cA'])+($myrow7['iA']-$myrow7d['iA'])),2);
	  
	  ?>
      </div></td>
    </tr>
    <?php  }?>
    <tr>
      <td colspan="13">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="13"><div align="center" class="normal">Total <?php echo '$'.number_format($importeVD[0],2);?></div></td>
    </tr>
    <tr>
      <td colspan="13"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center">&nbsp;</p>
  <div align="center" class="informativo"><span class="normal">
    
	<?php 
echo 'Total de Servicios: '.($cantidadExternos[0]+$cantidadInternos[0]+$cantidadVentasDirectas[0]);
?>
  </span><span class="normal">
  </span></div>
  <p align="center">
    <label></label>
  </p>
  
  <?php } //termina show?>
  
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
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
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