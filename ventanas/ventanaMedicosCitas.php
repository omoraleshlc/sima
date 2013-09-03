<?php include("/configuracion/ventanasEmergentes.php"); 
include("/configuracion/funciones.php"); ?>
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
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
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
                alert("Por Favor, escoje un médico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
                return false   
        }            
}   
</script> 
 <SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<?php



if($_POST['aplicar'] and $_POST['descripcion'] and $_POST['fechaInicial'] and $_POST['fechaFinal']){


$agrega = "INSERT INTO medicosCitasCanceladas (
almacen,descripcion,fechaInicial,fechaFinal,usuario,fecha,entidad) 
values ('".$_POST['medico']."','".$_POST['descripcion']."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$fecha1."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Registro Agregado';
echo '<script type="text/vbscript">
msgbox "Registro Agregado"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>'; 

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>

  <h1 align="center">CANCELAR CITAS DE MEDICOS </h1> <br />
  <form id="form1" name="form1" method="post" action="">


    <table width="490" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="10" bordercolor="1"  scope="col">&nbsp;</td>
        <td width="180" height="52" bordercolor="1"  scope="col"><div align="left"><span >  M&eacute;dico</span></div></th>
        <td width="387"  scope="col"><div align="left">
		
		<?php $sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['id_medico']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
?>
          <input name="medico" type="hidden"  id="medico" size="2" maxlength="2"
		 value="<?php echo $_GET['id_medico'];?>" />
      
          </div>
          <div align="left">
            <label></label>
          </div></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td height="39" ><div align="left" >Descripci&oacute;n:</div></td>
        <td ><label>
          <textarea name="descripcion" cols="40"  id="descripcion"></textarea>
          <div align="left"></div></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td height="32" ><div align="left" >Fecha Inicial :</div></td>
        
      <td ><div align="left">
            <label>
            <input name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
            </label>
            <input name="button" type="button"  id="lanzador" value="..." />
        </div></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td height="35" ><div align="left" >Fecha Final </div></td>
      <td ><div align="left">
            <label></label>
            <label></label>
            <label>
            <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
            </label>
            <input name="button1" type="button"  id="lanzador1" value="..." />
        </div></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
        <td height="33" >&nbsp;</td>
        <td ><input name="Submit2" type="submit"  value="Nuevo" />          <input name="aplicar" type="submit"  id="aplicar" value="Aplicar Fecha" />
          <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="numCliente" type="hidden"  id="numCliente" size="2" maxlength="2"
		 value="<?php echo $_GET['numCliente'];?>">
          </a></td>
      </tr>
    </table>
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
</form>
 </body>
</html>