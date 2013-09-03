<?PHP require("menuOperaciones.php"); ?>

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




<?php 
if(!$_GET['almacenDestino']){
$_GET['almacenDestino']=$_GET['almacenDestino'];
}
if(!$_GET['almacenDestino1']){
$_GET['almacenDestino1']=$_GET['almacenDestino1'];
}
?>



 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  
  
  
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>

  <h1>Reporte de Descuentos</h1>

<form id="form2" name="form2" method="get" >
<input tyoe="hidden" name="main" value="<?php echo $_GET['main'];?>" />
<input tyoe="hidden" name="datawarehouse" value="<?php echo $_GET['datawarehouse'];?>" />
<input tyoe="hidden" name="warehouse" value="<?php echo $_GET['warehouse'];?>" />
 
<br />
  <table width="557" class="table-forma">
    <tr>
      <td width="165" ><div align="left" >Almacen Principal</div></td>
      <td width="382"><?php 
	  $aCombo= "Select * From almacenes where ventas='si' and entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>        
      
        <option value="">---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($_GET['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td ><span >Mini Almacen</span></td>
      <td><?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_GET['almacenDestino']."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>        
        
        <?php  
					
 $sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['almacenDestino']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
        <option value="<?php echo $_GET['almacenDestino'];?>"><?php echo $myrow1['descripcion'];?></option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option 

		
		<?php 
		 if($_GET['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select></td>
    </tr>
    <tr>
      <td ><div align="left" >Fecha Inicial </div></td>
      <td><div align="left">
          <label>
          <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_GET['fechaInicial']){
		 echo $_GET['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" id="lanzador"/>
      </div></td>
    </tr>
    <tr>
      <td ><div align="left" >Fecha Final </div></td>
      <td><div align="left">
        <label></label>
        <label></label>
        <label>
        <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_GET['fechaFinal']){
		 echo $_GET['fechaFinal'];
		 }
		 ?>"/>
        </label>
        <input name="button1" type="image"src="/sima/imagenes/btns/fecha.png" id="lanzador1" />
      </div></td>
    </tr>

  </table>
  <br />
  <label>
       
        <div align="center">
          <input name="busca" type="submit"  id="button" value="Enviar" />
        </div>
      </label>
  <p>
    <?php if($_GET['busca'] and $_GET['fechaInicial'] and $_GET['fechaFinal']) { ?>
  </p>
  <table  class="table table-striped">

      <tr >
      <th width="49"  scope="col"><div align="center" >
        <div align="left">Folio V</div>
      </div></th>
      <th  scope="col"><div align="left" >
        <div align="left">Nombre del paciente</div>
      </div></th>
     
     
      <th  scope="col"><div align="left" >
        
          <div align="left" >
            <div align="left">Precio Venta</div>
          </div>
      </div></th>
      <th  scope="col"><div align="left" >
        <div align="left">Descuento</div>
      </div></th>
      <th  scope="col"><div align="left" >
        <div align="left">Total Venta</div>
      </div></th>
      <th  scope="col"><div align="left" >
        <div align="left">Tipo Px</div>
      </div></th>
      <th  scope="col"><div align="left" >
        <div align="left">Autoriza</div>
      </div></th>

    </tr>
    <tr>
<?php	





 $sSQL2= "SELECT descripcion
  FROM
medicos
Where descripcion='".$almacenSolicitud."' 

 ";
 
 $sSQL= "SELECT *
  FROM
clientesInternos
Where entidad='".$entidad."' 
and
fecha between '".$_GET['fechaInicial']."' and '".$_GET['fechaFinal']."'
and
(folioVenta!='' and folioVenta!='0')
and
almacen='".$_GET['almacenDestino1']."'
and
descuento='si'
and statusCuenta='cerrada'

order by keyClientesInternos DESC
 ";

 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$a+=1;


if($myrow['seguro']){

$sSQL7="SELECT sum(cantidadAseguradora*cantidad)+sum(ivaAseguradora*cantidad) as efectivo
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$myrow['folioVenta']."'
and
naturaleza='C'
and
(statusDevolucion='no' or statusDevolucion='')

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);

}else{
$sSQL7="SELECT sum(precioVenta*cantidad)+sum(iva*cantidad) as efectivo
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$myrow['folioVenta']."'
and
naturaleza='C'
and
(statusDevolucion='no' or statusDevolucion='')

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
}



 $sSQL7a="SELECT precioVenta
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$myrow['folioVenta']."'
and
naturaleza='A'
and
tipoTransaccion like '%desc%'


  ";
  $result7a=mysql_db_query($basedatos,$sSQL7a);
  $myrow7a = mysql_fetch_array($result7a);
?>
<tr  > 
      <td height="24" bgcolor="<?php echo $color?>" >
        <label>
        <?php echo $myrow['folioVenta']; ?></label>
      </span></td>
      <td width="230" bgcolor="<?php echo $color?>" >
      <a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">      
<?php print $myrow['paciente'];?></span></a></td>

      
      
      <td width="73" align="right" ><?php 
	  $original[0]+=$myrow7['efectivo'];
	  print '$'.number_format($myrow7['efectivo'],2);?></td>
      <td width="73" align="right" ><?php 
	  $descuentosT[0]+=-$myrow7a['precioVenta'];
      print '$'.number_format($myrow7a['precioVenta'],2);?></td>
      <td width="73" align="right" ><?php 
	  $totalDescuento[0]+=$myrow7['efectivo']-$myrow7a['precioVenta'];
	  print '$'.number_format($myrow7['efectivo']-$myrow7a['precioVenta'],2);?></td>
      <td width="73" bgcolor="<?php echo $color?>" ><div align="center"><?php print $myrow['tipoPaciente'];?></div></td>
      <td width="73" bgcolor="<?php echo $color?>" ><?php print $myrow['usuarioDescuento'];?></td>
      
      
    </tr>
        
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />

  </table>
  <p>&nbsp;</p>
  <table width="271" border="0" align="center">
    <tr>
      <th width="126"  scope="col"><div align="left">Total Descuento</div></th>
      <th width="135"  scope="col"><div align="left"><?php print '$'.number_format($descuentosT[0],2);?></div></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center" class="precio1">&nbsp;</p>
  <p align="center" class="precio1"><em>Total Pacientes con Descuento <?php print $a;?></em></p>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p>
    <?php  }?>
  </p>
  <p>&nbsp;</p>
</form>
<p>&nbsp; </p>
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
</body>
</html>
