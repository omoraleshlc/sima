<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
<?PHP include("/configuracion/clases/editarResultados.php"); ?>
<?PHP include("/configuracion/funciones.php"); ?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=900,height=600,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 



<?php
$cargosTotales=new acumulados(); 
$verificaCargos=new acumulados();


//***********************ABRE
/* $cmdstr4 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."' 
";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);

for ($i = 0; $i < $nrows4; $i++ ){
$NOMBRE= $resulta4['NOMBRE'][$i]." ".$resulta4['AP_PATERNO'][$i]." ".$resulta4['AP_MATERNO'][$i];
} */

///**********************
//**********************CIERRO CAMBIAR ALMACEN******************************

if($_POST['activar']){
$numeroE=$_POST['numeroE'];
foreach($numeroE as $i =>$recorrePila){
$q1 = "UPDATE clientesAmbulatorios set 
entregaExpediente='entregado'
WHERE numeroE = '".$numeroE[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}


if($ID_TIPO=='08'){
$encabezado='DR(a).:';
} else if($ID_TIPO=='09'){
$encabezado='Supervisor:';
} else if($usuario=='omorales'){
$encabezado='Administrador: ';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
.Estilo24 {font-size: 10px}
.Estilo24 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>
<h1 align="center">Consultas Previas </h1>
<p align="center">&nbsp; </p>
<form id="form1" name="form1" method="POST" action="listaOrdenes.php">
<table width="648" border="0" align="center">
    <tr>
      <th height="14" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Expediente</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Hora </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cargo </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Tipo Px</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">DatosPx</span></div></th>
      <th width="33" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cargos</span></div></th>
      <th width="32" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Lista</span></div></th>
      <th width="54" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Agrega DX </span></div></th>
    </tr>
    <tr>
      <?php	




$sSQL1= "SELECT almacen
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
id_medico='".$MEDICO."'
and
almacenPadre='".$ALMACEN."'
";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);



$sSQL= "SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
almacenSolicitud='".$myrow1['almacen']."'
and
status='pendiente'
and
(statusExpediente!='recibido' or statusExpediente!='reservar')
and
expediente='si'
and
fechaSolicitud='".$fecha1."'
order by paciente ASC
";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$tipoPaciente=$myrow['tipoPaciente'];
$a+=1;
$cita=$myrow['cita'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$numeroE=$myrow['numeroE'];$nCuenta=$myrow['nCuenta'];
$sSQL2= "SELECT *
FROM
clientesInternos
WHERE 
numeroE = '".$numeroE."'
and
nCuenta='".$nCuenta."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
 $E=$myrow['keyCAP'];
 $numeroExpediente=$myrow['numeroExpediente'];
 
 
$sSQL4= "SELECT *
FROM
catCitas
WHERE 
keyHora= '".$cita."'

 ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	  ?>
      <td width="60" height="20" bgcolor="<?php echo $color?>" class="style12"><span class="style7">

	  <?php echo $myrow['numeroE']?>
	
	  </span></td>
      <td width="250" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow2['paciente']
?></span></td>
      <td width="49" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['horaSolicitud']?></span></td>
      <td width="47" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	  
	  echo $myrow['usuario'];
	 
?></span></td>
      <td width="46" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['tipoPaciente']
?></span></td>
      <td width="39" bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="style121">
	  <a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $numeroE; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
	  <img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="12" height="12" border="0" /></a></span></span></td>
      <td bgcolor="<?php echo $color;  ?>" class="style12"><div align="center"><img src="/sima/imagenes/edit.jpg" alt="EDITAR CLIENTE <?php echo $myrow['nomCliente'];?>" width="12" height="12" border="0" /></div></td>
      <td bgcolor="<?php echo $color;  ?>" class="style12"><div align="center"><span class="style71"> <a href="#" onClick="ventanaSecundaria3('antecedentesAnteriores.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen2=<?php echo $A; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>')"> <img src="/sima/imagenes/listado.jpg" alt="Listado de Art&iacute;culos" width="12" height="12" border="0" /> </a> </span></div></td>
      <td bgcolor="<?php echo $color;  ?>" class="style12"><div align="center"><span class="style71"> <a href="javascript:ventanaSecundaria2('dxActuales.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><img src="/sima/imagenes/expandir.gif" alt="Almacenes" width="12" height="12" border="0" /></a><a href="#" onClick="ventanaSecundaria3('dxActuales.php?codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"></a> </span></div></td>
    </tr>
    <?php  }}
	
	if(!$a){
	$a='0';
	}
	?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <p align="center"><label></label>
  </p>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
  <input name="almacen1" type="hidden" id="almacen1" value="<?php echo $_POST['almacen']; ?>" />
  <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen1']; ?>" />
  <input name="almacen3" type="hidden" id="almacen3" value="<?php echo $_POST['almacen2']; ?>" />
  <input name="almacen" type="hidden" id="almacen3" value="<?php echo $_POST['almacen3']; ?>" />
</form>

</body>

</html>