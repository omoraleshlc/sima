<?php  class editarResultados{
 
public function editaResultados($entidad,$reporteReportes,$fecha1,$ventana,$TITULO,$ALMACEN,$basedatos){
?>
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
function ventanaSecundaria (URL){ 
 window.open(URL,"ventana","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=600,height=330,scrollbars=YES,resizable=YES, maximizable=YES") 
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>


<?php 
if($_POST['fechaInicial']){
		 $date= $_POST['fechaInicial'];
		 }else{
		 $date=$fecha1;
		 }
?>
<body>
<form id="form1" name="form1" method="post" >
  <h1 align="center" class="titulos">Autorizaciones </h1>
  <p align="center">
    <label>
    <select name="autorizaciones" id="autorizaciones" onChange="this.form.submit();">
	      <option value="">Escoje</option>
      <option
	  <?php if($_POST['autorizaciones']=='Pendientes')echo 'selected=""';?>
	   value="Pendientes">Pendientes</option>
      <option
	  	  <?php if($_POST['autorizaciones']=='Recibidas')echo 'selected=""';?>
	   value="Recibidas">Recibidas</option>
    </select>
    </label>
  </p>
  <p align="center">
    <label>
    <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 echo $date;
		 ?>" onChange="this.form.submit();"/>
    </label>
    <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
</p>
  <p>
    <?php if($_POST['autorizaciones']){ ?>
  </p>
  <table width="554" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="5"><img src="/sima/imagenes/bordestablas/borde1.png" width="555" height="27" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="61" class="negromid" align="center">Orden</td>
      <td width="185" class="negromid" align="left">Paciente</td>
      <?php if($_POST['autorizaciones']=='Pendientes'){ ?>
      <td width="52" class="negromid" align="center">Recibir</td>
      <?php } ?>
      <?php if($_POST['autorizaciones']=='Recibidas'){ ?>
      <td width="158" class="negromid" align="left">Px Recepcion</td>
      <td width="99" class="negromid" align="left">Fecha/Hora</td>
      <?php } ?>
    </tr>
    
<?php	
if($_POST['autorizaciones']=='Pendientes'){
echo $sSQL= "sELECT * FROM cargosCuentaPaciente 
WHERE entidad='".$entidad."' 
and fecha1='".$date."' 
and almacenDestino='".$ALMACEN."'
and statusRecepcion=''
and (folioVenta!='' or folioVenta!=0 or folioVenta!=null)
GROUP BY folioVenta
ORDER BY folioVenta ASC



 ";
}else{
$sSQL= "sELECT * FROM cargosCuentaPaciente 
WHERE entidad='".$entidad."' 
and fecha1='".$date."' 
and statusRecepcion='recibido'
GROUP BY folioVenta
ORDER BY folioVenta ASC
 ";

}


if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$keyCAP=$myrow['keyCAP'];
$codigo=$myrow['codProcedimiento'];
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$tipoPaciente=$myrow['tipoPaciente'];

	  ?>    
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
      <td height="44" class="precbluemid" align="center"><?php echo $myrow['folioVenta'];?></td>
      <td class="normalmid"><?php 
	  
	  $sSQL2a= "sELECT * FROM clientesInternos
WHERE entidad='01' 
and folioVenta='".$myrow['folioVenta']."'" ;

$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);
	  
	  echo $myrow2a['paciente']; 
	  
	  ?>
      </br>
     <span class="normal"> Tipo Paciente: </span><span class="negro"><?php echo $myrow['tipoPaciente'];?></span>
     </br>
     <span class="normal">Usuario:</span> <span class="codigos"><?php echo $myrow['usuario'];?></span>
      
      </td>
      <?php if($_POST['autorizaciones']=='Pendientes'){ ?>
      <td class="normalmid" align="center"><a   href="javascript:ventanaSecundaria8('../../cargos/entregarServicio.php?keyCAP=<?php echo $keyCAP; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"> Recibir </a> </td>
      <?php } ?>
      <?php if($_POST['autorizaciones']=='Recibidas'){ ?>
      <td align="left" class="normalmid"><?php echo $myrow['pacienteRecepcion'];?></td>
      <td class="codigos" align="center">
     <span class="normal" align="left">Fecha: </span><span class="negro"><?php echo cambia_a_normal($myrow2a['fechaRecepcion']);?></span>
      </br>
    <span class="normal">Hora: </span><span class="negro">  <?php echo $myrow2a['horaRecepcion'];?></span>
      
      </td>
       <?php } ?>
    </tr>
    <tr><?php  }}}?>
      <td colspan="5"><img src="/sima/imagenes/bordestablas/borde2.png" width="555" height="25" /></td>
      
    </tr>
  </table>
  <p>&nbsp; </p>
  

  </p>
</form>
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 

</body>
</html>
<?php
}
}

?>