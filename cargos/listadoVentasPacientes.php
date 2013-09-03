<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php'); ?>

  <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
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
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
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


<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-system.css" title="win2k-cold-1" />
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
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>


<form  method="POST" >
  <table width="481" class="table-forma">
    <tr valign="middle" >
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left"><span >
        <input name="button2" type="button"   id="lanzador1" value="fecha Inicial"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></div></td>
      <td scope="col">
        
        <div align="left">
          <table width="342" >
            <tr valign="middle" >
              <td  scope="col"><div align="left">
                  <input name="fechaInicial" type="text" class="campos" id="campo_fecha1"
	  value="<?php 
	  if($_POST['fechaInicial'] or $_GET['fechaSol']){
	  if($_POST['fechaInicial']){
	  echo $fecha2=$_POST['fechaInicial'];
	  }else{
	  echo $fecha2=$_GET['fechaSol'];
	  }
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" />
                  </div></td>
            </tr>
          </table>
      </div></td>
    </tr>
    <tr valign="middle" >
      <td  scope="col">&nbsp;</td>
      <td  scope="col"><div align="left"><span >
        <input name="button" type="button"   id="lanzador" value="fecha Final"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></div></th>
      <td scope="col"><div align="left">
        <input name="fechaFinal" type="text" class="campos" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaFinal'] or $_GET['fechaSol']){
	  if($_POST['fechaFinal']){
	  echo $fecha2=$_POST['fechaFinal'];
	  }else{
	  echo $fecha2=$_GET['fechaSol'];
	  }
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly=""/>
      </div></td>
    </tr>

  
  
  </table><br />
          <div align="center">
          <label>
          <input name="buscar" type="submit" id="buscar" value="Buscar" />
          </label>
        </div>
  
  <br />
  <?php if($_POST['buscar'] and ($_POST['fechaInicial']<=$_POST['fechaFinal'])){ ?>
  <h1 align="center">Abonos a Cuentas Aseguradoras/Otros </h1>
  <table width="500" class="table table-striped">
    <tr>
      <th width="96"  scope="col"><div align="left"><span >Movimiento </span></div></th>
      <th  scope="col"><div align="left"><span >Fecha</span></div></th>
      <th  scope="col"><div align="left"><span >Descripci&oacute;n</span></div></th>
      <th  scope="col"><div align="left"><span >Recibo</span></div></th>
      <th  scope="col"><div align="left"><span >Cajero</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."' 
and
(descripcionTransaccion='pagosCxC' or descripcionTransaccion='pagosOtros')
and
fecha1 between '".$_POST['fechaInicial']."' and '".$_POST['fechaFinal']."'
order by fecha1
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" >
	  <span >
	  <?php echo $myrow['keyCAP'];?>	  </span>	  </td>


      <td width="136" bgcolor="<?php echo $color?>" ><span ><?php echo cambia_a_normal($myrow['fecha1']);?></span></td>
      <td width="662" bgcolor="<?php echo $color?>" >
	    <?php
echo $myrow['descripcionArticulo'];
?></td>

      <td width="91" bgcolor="<?php echo $color?>" >
	  	  <a href="javascript:nueva('/sima/INGRESOS HLC/caja/imprimirReciboCxC.php?entidad=<?php echo $entidad;?>&keyCAP=<?php echo $myrow['keyCAP'];?>&seguro=<?php echo $myrow['clientePrincipal'];?>','ventana7','800','600','yes');">
	  <?php echo $myrow['numRecibo'];?>
	  </a>
	  </td>
      <td width="136" bgcolor="<?php echo $color?>" ><span >
  <?php
echo $myrow['usuario'];
?>
</span></td>
</tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
<?php } ?>





  <p>&nbsp;</p>
</form>
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script>

<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>
</html>


