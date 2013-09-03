<?php include("/configuracion/ventanasEmergentes.php"); ?>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendario/calendar-system.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendario/calendar-setup.js"></script> 

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
<?php
$hora[1] = "8:30 am";
$hora[2] = "9:00 am";
$hora[3] = "9:30 am";
$hora[4] = "10:00 am";
$hora[5] = "10:30 am";
$hora[6] = "11:00 am";
$hora[7] = "11:30 am";
$hora[8] = "12:00 am";
$hora[9] = "2:00 pm";
$hora[10] = "2:30 pm";
$hora[11] = "3:00 pm";
$hora[12] = "3:30 pm";
$hora[13] = "4:00 pm";
$hora[14] = "4:30 pm";
$hora[15] = "5:00 pm";
$hora[16] = "5:30 pm";
$hora[17] = "6:00 pm";


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
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="">
  <h1 align="center">Lista de M&eacute;dicos -&gt; Citas </h1>
  <table width="491" border="1" align="center">
    <tr>
      <th width="115" class="style12" scope="col"><div align="left">N&uacute;mero del M&eacute;dico </div></th>
      <th width="360" class="style12" scope="col"><div align="left">
        <select name="numMedico1" class="style12" id="numMedico1"  onchange="form.submit()"/>        
<?php
$sqlNombre = "SELECT * From medicos ORDER BY apellido1 ASC";
$resultaNombre=mysql_db_query($basedatos,$sqlNombre); ?>

<?php if(!$_POST['numMedico1']){
$_POST['numMedico1']=$_GET['numMedico1'];
}
?>




<?php if($_POST['numMedico1']){ 
?>			
<option value="<?php echo $_POST['numMedico1'];?>"><?php echo $_POST['numMedico1'];?></option>
<?php }else {?>
<option value=""></option>
<?php }?>


  <?php 
 
 
 while( $rNombre=mysql_fetch_array($resultaNombre)){
   ?>
<option value="<?php echo $rNombre["numMedico"];?>"><?php echo $rNombre["apellido1"]." ".$rNombre["apellido2"]." ".$rNombre["nombre1"];?></option>
        <?php } ?>
        </select>
      </div></th>
    </tr>
    <tr>
      <th colspan="2" class="style12" scope="col">Fecha: 
        <input name="fecha" type="text" class="style12" id="campo_fecha"
	  value="<?php 
	  if($_POST['fecha']){
	  echo $_POST['fecha'];
	  } else {
	  if($myrow3['hoy']){
	  echo $myrow3['hoy'];
	  } else {
	  echo $fecha1; }} ?>" size="30" readonly="" onChange="javascript:this.form.submit();"/>
        <label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
        </label></th>
    </tr>
    <tr>
      <th colspan="2" class="style12" scope="col"><label> M&eacute;dico:
<?php
$sSQL7= "SELECT *
FROM
medicos WHERE numMedico = '".$_POST['numMedico1']."' 

";

 
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
?>

<?php if($_POST['numMedico1']){ ?>
        <input name="textfield" type="text" class="style12" size="50"  readonly="" 
value="<?php echo "Dr(a): ".$myrow7["nombre1"]." ".$myrow7["apellido1"]." ".$myrow7["apellido2"];?>"/>
<?php } ?>
      </label></th>
    </tr>
  </table>
  <p>
  <label>
  <div align="center">
  </label>
</form>
<form id="form1" name="form1" method="post" action="modificaCitas.php">
  <input name="numMedico" type="hidden" id="numMedico" value="<?php echo $_POST['numMedico1']; ?>" />
  <span class="style12"><span class="style7">
  <input name="paciente" type="hidden" id="nombrePaciente2" value="<?php  echo $myrow['paciente']; ?>" />
  </span></span>
  <span class="style12">
  <input name="codHora" type="hidden" id="codHora" value="<?php echo $myrow['cita'];?>"/>
  </span>
  <span class="style12"><span class="style7">
  <input name="numeroE" type="hidden" id="numeroE" value="<?php echo $myrow['numeroE']; ?>" />
  </span></span>
  <table width="305" border="1" align="center">
    <tr>
      <th width="99" height="16" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Hora/Modificar</span></th>
      <th width="190" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Nombre del paciente:</span></th>
    </tr>
    <tr>
<?php	

if(!$_POST['fecha']){
$_POST['fecha']=$fecha1;
}

$sSQL= "
SELECT distinct * FROM clientesAmbulatorios 
WHERE
medico = '".$_POST['numMedico1']."'
and fecha='".$_POST['fecha']."'

order by cita ASC 
";

 
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$citas=$myrow['cita'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$citas=$myrow['cita'];
$sSQL3= "SELECT *
FROM
MedicosCitas WHERE codHora = '".$citas."' 
";

 
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$H=$myrow3['hora'];
?>
      <td height="36" bgcolor="<?php echo $color;?>" class="style12">&nbsp;
        <label>
        <input name="hora" type="submit" class="style12" id="hora" value="<?php echo $H?>"/>
      </label></td>
      
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php 
	if($myrow['paciente']){
	 echo $myrow['paciente'];
	 } else {
	 echo "Disponible";
	 }
	 
	  ?>
      </span></td>
    </tr>
	
	
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12">
  <?php }?>
  <span class="style7">
<input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />  
  </span></span>

</form>
<p>&nbsp; </p>
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>
</html>