<?php require("menuOperaciones.php"); ?>

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
 window.open(URL,"ventana","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
 window.open(URL,"ventanaSecundaria5","width=150,height=100,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
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

<?php 
if($_POST['apply'] and $_POST['keyClientesInternos']!=NULL){
$keyClientesInternos=$_POST['keyClientesInternos'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyClientesInternos[$i]){
$q1 = "UPDATE clientesInternos set 
statusEstudio='onTransfer',
fechaRecepcion='".$fecha1."',
    

usuarioRecepcion='".$usuario."'

WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}

}
echo '<div class="success">Se recibieron servicios</div>';
}
?>




  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<?php
		 if($_POST['fecha']){
		 $dates= $_POST['fecha'];
		 }else{
                 $dates=    $fecha1;
                 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="60"> 
<body>


<h1 align="center" class="titulos">PROCESAR ORDENES</h1>
<form id="form1" name="form1" method="POST" >
  <h1 align="center"></h1>
  
  <table width="548" class="table table-striped">
      
<tr>
        <td width="100"  >&nbsp;</td>
        <td  ><div align="left" width="46">Fecha</div></td>
      <td width="100"><div align="left">
            
              <label>
            <input name="fecha" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php echo $dates;?>" onChange="this.form.submit();"/>
            </label>
              
              
              
            <input name="button" type="button"  id="lanzador" value="..." />
        </div></td>
      </tr>      
      
      
    <tr >
      <th width="46"  scope="col"><div align="left" > FolioV</div></th>
      <th  scope="col"><div align="left" >Paciente</div></th>
      <th  scope="col"><div align="left" >Aseguradora</div></th>
	  
	  <th  scope="col"><div align="left" >Depto. Solicita</div></th>
	  <th  scope="col"><div align="left" >User</div></th>
	  <th  scope="col"><div align="left" ></div></th>
  <th  scope="col"><div align="left" >Print</div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
    from
    clientesInternos
    where
    entidad='".$entidad."'
        and
    statusEstudio='standby' 
and
(folioVenta!=0 and folioVenta!='')
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
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
      <td  >
	  <?php echo $myrow['folioVenta'];?>
  </td>


      <td width="131" bgcolor="<?php echo $color?>" >
	  <?php echo $myrow['paciente'];?> 
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="111" bgcolor="<?php echo $color?>" ><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?></span></td>

      
      <td width="132" bgcolor="<?php echo $color?>" ><span class="style7">
        <?php
	
				    $sSQL17a= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
echo $myrow17a['descripcion'];
?>
      </span></td>
      <td width="46" bgcolor="<?php echo $color?>" >
  <?php
echo $myrow['usuario'];
?>
</span></td>
<td width="20" bgcolor="<?php echo $color?>" ><label>
  <input type="checkbox" name="keyClientesInternos[]" id="checkbox" value="<?php echo $myrow['keyClientesInternos'];?>" />
</label></td>



<td width="32" bgcolor="<?php echo $color?>" ><div align="center"><a href="javascript:ventanaSecundaria1('../ventanas/lentesopticaPrint.php?folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;paciente=<?php echo $myrow['paciente'];?>')"><img src="/sima/imagenes/btns/printer.png" alt="" width="20" height="20" border="0" /></a>

</div></td>
    </tr>
    <?php  }}?>
    <input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
    <input name="almacen" type="hidden" value="<?php echo $_GET['almacen'];?>" />
  </table>







  <p align="center">
    <label>
    <?php if($bandera>0){ ?>
    <input type="submit" name="apply" id="apply" value="Aplicar Servicio" />
    <?php } ?>
    </label>
  </p>
</form>


  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 

</body>
</html>


