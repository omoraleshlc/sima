<?PHP include("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
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

</head>

<body>
 <h1 align="center" class="titulos">Ver el historial de medicamentos surtidos<label></label>
 </h1>





 <form id="form1" name="form1" method="post" action="">

   <p align="center" class="normal">Periodo</p>
   <p align="center" class="normal">Fecha Inicial

     <label>
     <input name="fechaInicial" type="text" class="normal" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
     </label>
     <input name="button" type="button" class="normal" id="lanzador" value="..." />
     <label></label>
  <span class="normal">
     a la fecha
</span>
     <label>
     <input name="fechaFinal" type="text" class="normal" id="campo_fecha1" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
     </label>
     <input name="button2" type="button" class="normal" id="lanzador1" value="..." />
     <label> <br />
     <br />
     <input name="buscar" type="submit" class="normal" id="search" value="Buscar" />
     </label>

</p>


<?php if($_POST['buscar']){

$fecha=$_POST['fechaInicial']; // tu sabr�s como la obtienes, solo asegurate que tenga este formato
$dias= 30; // los d�as a restar

$fechaI= date("Y-m-d", strtotime("$fecha -$dias day"));
//echo '<br>';
$mes = substr($fechaI, -5,-3);
$year = substr($fechaI, -10,-6);

$fechaInicio=$year.'-'.$mes.'-'.'01';
$fechaFinal=$year.'-'.$mes.'-'.'31';

?>



   <table width="581" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
       <td colspan="7"><img src="/sima/imagenes/bordestablas/borde1.png" alt="" width="581" height="24" align="center"/></td>
     </tr>

     <tr bgcolor="#FFFF00">
       <td width="69" align="center" class="negromid">Hora</td>
       <td width="99" align="center" class="negromid">Fecha</td>
       <td width="116" class="negromid">Concepto</td>
       <td width="166" align="center" class="negromid">FechaCargo</td>
       <td width="131" align="center" class="negromid">Usuario</td>
     </tr>

       <tr bgcolor="#FFFF00">
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
       <td align="center" bgcolor="#FFFFFF" class="negromid">&nbsp;</td>
     </tr>

     <tr bgcolor="#FFFF00">

     </tr>

<?php
 $sSQL= "
SELECT *
FROM
traspasosEspeciales
where

entidad='".$entidad."'
and

almacenDestino='".$_GET['almacen']."'
and
status='done'
 and
 fecha>='".$_POST['fechaInicial']."' and fecha<='".$_POST['fechaFinal']."'
";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$N=$myrow['numCliente'];




$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}





?>
     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
       <td class="codigos" align="center"><?php echo $myrow['hora'];?></td>
       <td height="55" class="normalmid" align="center"><?php echo cambia_a_normal($myrow['fecha']);?></td>
       <td class="normalmid"><span class="normal">
	   <?php

	   echo $myrow['descripcionArticulo'];
	   echo '<br>';
	   echo 'Estado de Factura: '.'<span class="codigos">'.$myrow['statusFactura'].'</span>';
	     echo '<br>';
	   echo $myrow['usuario'];
	   ?>
	   </span></td>

       <td class="precbluemid" align="right">
	   <div align="center">
	   <?php  echo cambia_a_normal($myrow['fechaCargo']);	   ?>
	   </div></td>


       <td class="precredmid" align="right">
	   <div align="center">
	   <?php  echo $myrow['usuario'];	   ?>
	   </div>	   </td>
     </tr>
     <?php }?>
     <tr>
       <td colspan="7">&nbsp;</td>
     </tr>
   </table>
   <table width="500" border="0" align="center">

     <tr>
       <td colspan="4"><img src="/sima/imagenes/bordestablas/borde2.png" width="581" height="24" /></td>
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

</body>
</html>