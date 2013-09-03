<?php require("/configuracion/operacioneshospitalariasmenu/administracion/administracion.php"); ?>
<?PHP require("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
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


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
<title></title>


</head>

<body>

  <p align="center">REPORTE DE CONSULTAS DE MEDICOS (x CITAS) </p>
  <form id="form1" name="form1" method="post" action="">
    <table width="546" border="0" align="center" class="Estilo24">
      <tr>
        <th height="37" scope="col">&nbsp;</th>
        <th width="129" bgcolor="#660066" scope="col"><div align="left"><span class="style13">Departamento Principal: </span></div></th>
        <th width="338" scope="col"><div align="left">
          <?php 
		
		  require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style7',$almacenDestino,$almacenDestino,$basedatos);
?>
        </div></th>
      </tr>
      <tr>
        <th width="1" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial :</div></td>
        <td><div align="left">
            <label>
            <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
            </label>
            <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
        </div></td>
      </tr>
      <tr>
        <th width="1" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Fecha Final </div></td>
        <td><div align="left">
            <label></label>
            <label></label>
            <label>
            <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
            </label>
            <input name="button1" type="image"src="/sima/imagenes/btns/fecha.png"class="Estilo24" id="lanzador1" value="..." />
        </div></td>
      </tr>
      <tr>
        <th width="1" height="33" scope="col">&nbsp;</th>
        <td>&nbsp;</td>
        <td><label>
          <input name="Submit" type="submit" class="Estilo24" value="Desplegar Resumen" />
        </label>
        <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a></td>
      </tr>
    </table>
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
</form>
  <p>&nbsp;</p>
  <table width="593" border="0" align="center">
    <tr>
      <th width="63" height="15" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
      <th width="397" bgcolor="#660066" scope="col"><div align="left"><span class="style11">MEDICO</span></div></th>
      <th width="57" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Cortes&iacute;as </span></div></th>
      <th width="58" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Consultas </span></div></th>
      <?php 
 if($_POST['fechaInicial'] and $_POST['fechaFinal']){     
	   $sql= "
SELECT *
FROM
almacenes
WHERE
activo='A'
and
entidad='".$entidad."' AND
medico =  'si'
and
almacenPadre='".$_POST['almacenDestino']."'

order by descripcion ASC
";
$result=mysql_db_query($basedatos,$sql);
	  
	   ?>
    </tr>
    <tr>
      <?php	while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['almacen'];
$a+=1;
$sql1= "
SELECT count(*) as cantidadConsultas
FROM
clientesInternos
WHERE
entidad='".$entidad."' AND
almacenSolicitud =  '".$A."'
and
fechaSolicitud between '".$_POST['fechaInicial']."' and '".$_POST['fechaFinal']."'
and
(statusExpediente='standby' or statusExpediente='recibido' or statusExpediente='cargado')
and
(status!='cancelado' and status!='cortesia')
";
$result1=mysql_db_query($basedatos,$sql1);
$myrow1 = mysql_fetch_array($result1);



$sql31= "
SELECT count(*) as cortesias
FROM
clientesInternos
WHERE
entidad='".$entidad."' AND
almacenSolicitud =  '".$A."'
and
fechaSolicitud between '".$_POST['fechaInicial']."' and '".$_POST['fechaFinal']."'
and
(statusExpediente='standby' or statusExpediente='recibido' or statusExpediente='cargado')
and
 status='cortesia'
";
$result31=mysql_db_query($basedatos,$sql31);
$myrow31 = mysql_fetch_array($result31);
?>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"> <?php echo $A?> </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71"><?php echo $myrow['descripcion'];?></span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71">
        <?php 
	
		 echo $myrow31['cortesias'];
		
		 ?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style71">
        <?php 
	
		 echo $myrow1['cantidadConsultas'];
		
		 ?>
      </span></td>
    </tr>
    <?php }}?>
  </table>
  <p align="center"><a href="/sima/graficas/ventasxDiaxAlmacen.php" class="style71"></a>
    <input name="nuevo" type="button" class="style71" id="nuevo" value=" Graficar"
	  onclick="ventanaSecundaria1('/sima/graficas/ventasxDiaxAlmacen.php?almacen=<?php echo $_POST['almacenDestino'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>&entidad=<?php echo $entidad;?>')" />
  </p>
</body>
</html>