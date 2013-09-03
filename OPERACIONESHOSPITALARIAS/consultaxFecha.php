<?php require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>




<script language="javascript" type="text/javascript">

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
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script>


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
  <h1 > REPORTE DE VENTAS</h1>
  <table width="454" class="table-forma">
    
    <?php if($_POST['decide']=='cerrado'){?>
    <?php } ?>
    <tr>
      <td  align="center"> Fecha Inicial 
          <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" /> 
          <span >a</span> 
          <label>
          <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
          </label>
          <input name="button1" type="image"src="/sima/imagenes/btns/fecha.png" />      </td>
    </tr>

  </table>
  
          <label>
          <br />
          <input type="submit"  name="buscar" id="button" value="Buscar" />
        </label>
  <p>
<?php 



if($_POST['buscar']){ 
  




$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
almacenIngreso='".$ALMACEN."'
and
folioVenta!=''

and 
(fechaCierre>= '".$_POST['fechaInicial']."' and   fechaCierre<='".$_POST['fechaFinal']."')
and
ventasDirectas!='si'
and
tipoPaciente='externo'
group by folioVenta
order by folioVenta ASC";
 

 
 
 

$result=mysql_db_query($basedatos,$sSQL);
?>
  </p>
  <p align="center">    <br />
  PACIENTES EXTERNOS </p>
 
  <table width="875" class="table table-striped">
    <tr >
        <th width="5" >#</th>
      <th width="45" >Folio</th>
      <th width="208" >Datos Paciente</th>
      <th width="10" >Estudios</th>
      <th width="193" >Seguro / Medico</th>
      <th width="95" >Precio</th>
      <th width="48" >Total</th>
      <th width="74" >Recibo</th>
    </tr>
    
    <?php	


while($myrow = mysql_fetch_array($result)){ 
$a+=1;
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];

$sSQL17= "
	SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);


$sSQL17aa= "
	SELECT
*
FROM
pacientes
WHERE
entidad='".$entidad."'
and
numCliente = '".$myrow['numeroE']."'
";
$result17aa=mysql_db_query($basedatos,$sSQL17aa);
$myrow17aa = mysql_fetch_array($result17aa);
	  ?>
    <tr >

   <td height="20" align="center" >
      <?php echo $a;?>
      </td>


      <td height="74" align="center" >
      <?php echo $myrow['folioVenta'];?>
      </td>
      <td >
      <?php 
echo $myrow17['paciente'];
?>
      <br />
      <?php

      echo cambia_a_normal($myrow17aa['fechaNacimiento']);
      
      ?>
<br />
     <span > Edad: <?php 
if($myrow17['edad']){
echo $myrow17['edad'];
}else{
echo '---';
}
?> </span>
      <span >
      <br />
      Tel&eacute;fono: 
      <?php 
if($myrow17['telefono']){
echo $myrow17['telefono'];
}else{
echo '---';
}
?>
      </br>
          <?php
          if($myrow17['statusDevolucion']=='si'){
              echo '<span class="informativo"><blink>Es una devolucion...</blink></span>';
          }

          ?>


      </span></td>
      <td >
<a
href="#" onClick="ventanaSecundaria1('../ventanas/mostrarMedicamentos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;ci=<?php echo $myrow['CI']; ?>&amp;almacen2=<?php echo $ALMACEN; ?>&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;numCliente=<?php echo $N?>')">
            Ver
            </a>
        <br />
       <span > Hora: 
        <?php 

echo $myrow17['hora'];

?></span>
        <br />
     <span > Atte.: <?php echo $myrow17['usuario'];?></span></td>
      <td >
        <?php 
$sSQL17b= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['seguro']."'
";
$result17b=mysql_db_query($basedatos,$sSQL17b);
$myrow17b = mysql_fetch_array($result17b);
	  
if($myrow['seguro']){
echo $myrow17b['nomCliente'];
}else{
echo 'particular';
}
?>

      <br />
     <span > M&eacute;dico:</span><span >

      <?php 
echo $myrow17['medico'];


?></span>
    </td>
      <td >Part.: 
      <?php 

echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);
$cantidadParticular[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
?>
      <br />
      <span >Aseg.: 
      <?php 

echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
$cantidadAseguradora[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
?></span></td>
      <td align="center" ><?php 

echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);

?></td>

<?php $sSQL18= "
	SELECT 
pacienteRecepcion,fechaRecepcion
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
	  ?>
      <td  align="center"><?php 
echo $myrow18['pacienteRecepcion'];


?>
      <br />



     <?php $sSQL19d= "
	SELECT
numRecibo
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
    and
    gpoProducto=''
";
$result19d=mysql_db_query($basedatos,$sSQL19d);
$myrow19d = mysql_fetch_array($result19d);
	  ?>

      <span  align="center"> <?php
echo $myrow19d['numRecibo'];


?></span></td>
    </tr><?php  }?>
  </table>

<p align="center" >Se encontraron <?php echo $a;?> registros!  particular: <?php echo "$".number_format($cantidadParticular[0],2);?>, y aseguradora: <?php echo "$".number_format($cantidadAseguradora[0],2);?>.</p>

<p>&nbsp;</p>





































<p align="center"> <br /> 

  PACIENTES INTERNOS
</p>

<table width="875" class="table table-striped">
  <tr >
      <th width="45" >#</th>
    <th width="45" >Folio</th>
    <th width="208" >Datos Paciente</th>
    <th width="10" >Estudios</th>
    <th width="50" >Seguro / Medico</th>
    <th width="95" >Precio</th>
    <th width="48" >Total</th>
    <th width="74" >UsuarioR</th>
  </tr>
<?php


$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
almacenDestino='".$ALMACEN."'
and
statusCargo='cargado'

and 
(fechaCargo>= '".$_POST['fechaInicial']."' and   fechaCargo<='".$_POST['fechaFinal']."')
and
ventasDirectas!='si'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
group by folioVenta
order by folioVenta ASC";
 

 
 
 

$result=mysql_db_query($basedatos,$sSQL);



while($myrow = mysql_fetch_array($result)){ 
$b+=1;
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];

$sSQL17= "
	SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  ?>
  <tr >
        <td height="74" align="center" ><?php echo $b;?> </td>
    <td height="74" align="center" ><?php echo $myrow['folioVenta'];?> </td>
    <td ><?php 
echo $myrow17['paciente'];
?>
        <br />
        <span > Edad:
          <?php 
if($myrow17['edad']){
echo $myrow17['edad'];
}else{
echo '---';
}
?>
        </span> <span > <br />
          Tel&eacute;fono:
          <?php 
if($myrow17['telefono']){
echo $myrow17['telefono'];
}else{
echo '---';
}
?>
      </span></td>
    <td >
<a
href="#" onClick="ventanaSecundaria1('../ventanas/mostrarMedicamentos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;ci=<?php echo $myrow['CI']; ?>&amp;almacen2=<?php echo $ALMACEN; ?>&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;numCliente=<?php echo $N?>')">
            Ver
            </a>

        <br />
        <span > Hora:
          <?php 

echo $myrow17['hora'];

?>
        </span> <br />
        <span > Atte.: <?php echo $myrow['usuario'];?></span></td>
    <td ><?php 
$sSQL17= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['seguro']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  
if($myrow['seguro']){
echo $myrow17['nomCliente'];
}else{
echo 'particular';
}
?>
        <br />
        <span > M&eacute;dico:</span><span >
        <?php $sSQL19= "
	SELECT 
medico
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);
	  ?>
        <?php 
echo $myrow19['medico'];


?>
        </span> </td>
    <td >Part.:
      <?php 

echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);
$cantidadParticularI[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
?>
        <br />
        <span >Aseg.:
          <?php 

echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
$cantidadAseguradoraI[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
?>
        </span></td>
    <td align="center" ><?php 

echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);

?></td>
    <?php $sSQL18= "
	SELECT 
pacienteRecepcion,fechaRecepcion
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
	  ?>
    <td  align="center"><?php 
echo $myrow18['pacienteRecepcion'];


?>
        <br />
        <span  align="center">
        <?php 
echo $myrow18['fechaRecepcion'];


?>
        </span></td>
  </tr>
  <?php  }?>
  </table>

<p align="center" class="titulomedio">Se encontraron <?php echo $a;?> registros!  particular: <?php echo "$".number_format($cantidadParticularI[0],2);?>, y aseguradora: <?php echo "$".number_format($cantidadAseguradoraI[0],2);?>.</p>
<p align="center" class="titulomedio">&nbsp;</p>
<p align="center" class="titulomedio">&nbsp;</p>
<p>&nbsp;</p>








































<p align="center"> <br /> 
  VENTAS DIRECTAS
</p>
<table width="875" class="table table-striped">

  <tr >
    <th width="45" >Folio</th>
    <th width="208" >Datos Paciente</th>
    <th width="217" >Estudios</th>
    <th width="193" >Seguro / Medico</th>
    <th width="95" >Precio</th>
    <th width="48" >Total</th>
    <th width="74" >UsuarioR</th>
  </tr>
  <?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
almacenDestino='".$ALMACEN."'
and
statusCargo='cargado'

and 
(fechaCargo>= '".$_POST['fechaInicial']."' and   fechaCargo<='".$_POST['fechaFinal']."')
and
ventasDirectas='si'
order by folioVenta ASC";
 

 
 
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];

$sSQL17= "
	SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  ?>
  <tr >
    <td height="74" align="center" ><?php echo $myrow['folioVenta'];?> </td>
    <td ><?php 
echo $myrow17['paciente'];
?>
        <br />
        <span > Edad:
          <?php 
if($myrow17['edad']){
echo $myrow17['edad'];
}else{
echo '---';
}
?>
        </span> <span > <br />
          Tel&eacute;fono:
          <?php 
if($myrow17['telefono']){
echo $myrow17['telefono'];
}else{
echo '---';
}
?>
      </span></td>
    <td ><?php 
echo $myrow['descripcionArticulo'];
?>
        <br />
        <span > Hora:
          <?php 

echo $myrow17['hora'];

?>
        </span> <br />
        <span > Atte.: <?php echo $myrow['usuario'];?></span></td>
    <td ><?php 
$sSQL17= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$myrow['seguro']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	  
if($myrow['seguro']){
echo $myrow17['nomCliente'];
}else{
echo 'particular';
}
?>
        <br />
        <span > M&eacute;dico:</span><span >
        <?php $sSQL19= "
	SELECT 
medico
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);
	  ?>
        <?php 
echo $myrow19['medico'];


?>
        </span> </td>
    <td >Part.:
      <?php 

echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);
$cantidadParticularVD[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
?>
        <br />
        <span >Aseg.:
          <?php 

echo '$'.number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2);
$cantidadAseguradoraVD[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
?>
        </span></td>
    <td align="center" ><?php 

echo '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2);

?></td>
    <?php $sSQL18= "
	SELECT 
pacienteRecepcion,fechaRecepcion
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta = '".$myrow['folioVenta']."'
";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
	  ?>
    <td  align="center"><?php 
echo $myrow18['pacienteRecepcion'];


?>
        <br />
        <span  align="center">
        <?php 
echo $myrow18['fechaRecepcion'];


?>
        </span></td>
  </tr>
  <?php  }}?>
  <tr>

  </tr>
</table>
<?php if($a>0){?>
<p align="center" class="titulomedio">Se encontraron <?php echo $a;?> registros!  particular: <?php echo "$".number_format($cantidadParticularVD[0],2);?>, y aseguradora: <?php echo "$".number_format($cantidadAseguradoraVD[0],2);?>.</p>
<?php  }?>
<p align="center" class="titulomedio">&nbsp;</p>
</form>

  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>

</html>