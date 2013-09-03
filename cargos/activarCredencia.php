<?php require('/configuracion/ventanasEmergentes.php');?>





<?php  
if($_GET['keyCredencial'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE pacientesCredenciales set 

		status=''
		WHERE keyCredencial='".$_GET['keyCredencial']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE pacientesCredenciales set 

		status='A'
		WHERE keyCredencial='".$_GET['keyCredencial']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=600,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



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
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 





<?php include("/configuracion/funciones.php"); ?>



<?php



if($_POST['cargos'] AND $_POST['seguro'] and $_POST['tipoCredencial'] and $_POST['fechaInicial'] and $_POST['fechaFinal']){


$sSQL1= "Select * From pacientesCredenciales WHERE entidad='".$entidad."' and numeroE='".$_POST['numeroE']."' and seguro = '".$_POST['seguro']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select * From pacientesCredenciales WHERE entidad='".$entidad."' and credencial='".$_POST['credencial']."' and seguro = '".$_POST['seguro']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

if(!$myrow1['keyCredencial']){

$sSQL1s= "Select count(*) as dependientes From pacientesCredenciales WHERE entidad='".$entidad."' and numeroE='".$_POST['numeroE']."' and seguro = '".$_POST['seguro']."'";
$result1s=mysql_db_query($basedatos,$sSQL1s);
$myrow1s = mysql_fetch_array($result1s);


$sSQL1d= "Select SUM(numCredencial) as numeroCredencial From pacientesCredenciales WHERE entidad='".$entidad."' and tipoPaciente='responsable'";
$result1d=mysql_db_query($basedatos,$sSQL1d);
$myrow1d = mysql_fetch_array($result1d);

if(!$myrow1d['numeroCredencial']){
$myrow1d['numeroCredencial']=1;
}

$agrega = "INSERT INTO pacientesCredenciales (
numeroE,tipoCredencial,fechaInicial,fechaFinal,seguro,status,entidad,usuario,tipoPaciente,numCredencial
) values ('".$_POST['numeroE']."','".$_POST['tipoCredencial']."','".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$_POST['seguro']."','A','".$entidad."','".$usuario."','responsable','".$myrow1d['numeroCredencial']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$sSQL2a= "Select numCredencial From pacientesCredenciales order by keyCredencial DESC";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

echo 'Transacción agregada'; ?>
<script>
window.alert( "SE GENERO LA CREDENCIAL: <?php echo $myrow2a['numCredencial'];?>");
</script>
<?php 
} else {  ?>
<script>
window.alert( "EL PACIENTE SOLO PUEDE TENER UNA CREDENCIAL POR SEGURO, GRACIAS! ");
</script>
<?php 
}
}




?>


<?php	

$sSQL33= "SELECT 
* 
FROM pacientes
WHERE keyPacientes='".$_GET['keyPacientes']."'
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();

 
 ?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.Estilo24 {font-size: 12px}
-->
</style>

<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style15 {font-size: 10px}
.style15 {font-size: 10px}
-->
</style>
<head>
<style type="text/css" media="screen">
			body {
				font: 11px arial;
			}
			.suggest_link {
				background-color: #FFFFFF;
				padding: 2px 6px 2px 6px;
			}
			.suggest_link_over {
				background-color: #3366CC;
				padding: 2px 6px 2px 6px;
			}
			#search_suggest {
	position: absolute;
	background-color: #FFFFFF;
	text-align: left;
	border: 1px solid #000000;
	left: 748px;
	top: 60px;
			}
			.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}		
		.Estilo25 {font-size: 10px}
.Estilo25 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
</style>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />




<body>

<h1 align="center">ACTIVAR CREDENCIAL</h1>
<form id="form1" name="form1" method="post" >
    <table width="482" align="center" cellpadding="1" cellspacing="1" class="style7">
      <tr>
        <th width="2" class="Estilo24" scope="col">&nbsp;</th>
        <th width="127" class="Estilo24" scope="col"><div align="left"><strong>Paciente</strong></div></th>
        <th width="341" class="Estilo24" scope="col"> <div align="left"> <?php echo $myrow33['nombreCompleto'];?></div></th>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th class="Estilo24" scope="col"><div align="left">Expediente:</div></th>
        <th class="Estilo24" scope="col"><div align="left"><?php echo $myrow33['numCliente'];?><span class="negromid">
          <input name="numeroE" type="hidden" class="camposmid" id="seguro2"   readonly=""
		value="<?php echo $myrow33['numCliente'];?>" />
        </span></div></th>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="482" align="center" cellpadding="1" cellspacing="1" class="style7">
      <tr>
        <th width="2" class="Estilo24" scope="col">&nbsp;</th>
        <th width="127" class="Estilo24" scope="col"><div align="left"><strong>Seguro </strong><span class="negromid">
          <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></div></th>
        <th width="341" class="Estilo24" scope="col"><div align="left">
          <input name="nomSeguro" type="text" class="style7" id="nomSeguro"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>" size="80"/>
        </div></th>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th class="Estilo24" scope="col"><div align="left">Tipo de Credencial</div></th>
        <th class="Estilo24" scope="col"><div align="left">
        <?php 
$sqlNombre11 = "SELECT codigoTC from tipoCredencial 
ORDER BY codigoTC ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="tipoCredencial" class="Estilo24" id="medico" onchange="this.form.submit();" />  
<option value="">Tipo Credencial</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
  <?php if($_POST['tipoCredencial']==$rNombre11["codigoTC"])echo 'selected=""'; ?>
      value="<?php echo $rNombre11["codigoTC"];?>"> <?php echo $rNombre11["codigoTC"];?></option>
  <?php } ?>
</select>
        </div></th>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th class="Estilo24" scope="col"><div align="left">Fecha Inicial</div></th>
        <th class="Estilo24" scope="col"><div align="left">
          <label>
          <input name="fechaInicial" type="text" class="style15" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
          </label>
          <input name="button" type="button" class="style15" id="lanzador" value="..." />
</div></th>
      </tr>
      <tr>
        <th class="Estilo24" scope="col">&nbsp;</th>
        <th class="Estilo24" scope="col"><div align="left">Fecha Final</div></th>
        <th class="Estilo24" scope="col"><div align="left">
          <label>
          <input name="fechaFinal" type="text" class="style15" id="campo_fecha1" size="10" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
          </label>
          <input name="button1" type="button" class="style15" id="lanzador1" value="..." />
</div></th>
      </tr>

   
	  
	  
	  
      <tr>
        <th height="36" colspan="4" class="Estilo24" scope="col"><label>
          <input name="cargos" type="submit" class="Estilo24" id="cargos" value="Activar Credencial" />
        </label>
        <div align="center"></div></th>
      </tr>
      <tr>
        <th height="5" colspan="4" class="Estilo24" scope="col"><label>

          </label></th></tr>
  </table>
  <p>&nbsp;</p>
    <table width="738" border="0" align="center" class="style7">
      <tr>
        <th width="63" bgcolor="#660066" class="style14" scope="col"><div align="left">Expediente</div></th>
        <th width="62" bgcolor="#660066" class="style14" scope="col"><div align="left" class="blanco">
            <div align="left"># Credencial</div>
        </div></th>
        <th width="176" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="blanco">Seguro</span></div></th>
        <th width="66" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="blanco">Tipo</span> Px</div></th>
        <th width="66" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="blanco">Tipo</span></div></th>
        <th width="64" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="blanco">Fecha Inicial</span></div></th>
        <th width="61" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="blanco">Fecha Final</span></div></th>
        <th width="67" bgcolor="#660066" class="style14" scope="col"><div align="left">Dependientes</div></th>
        <th width="40" bgcolor="#660066" class="style14" scope="col"><div align="left">Imprime</div></th>
        <th width="31" bgcolor="#660066" class="style14" scope="col"><div align="left" class="blanco">
            <div align="left">Status</div>
        </div></th>
      </tr>
      <tr>
      
        <?php	
		
		$sSQL="select * from pacientesCredenciales where entidad='".$entidad."' and numeroE='".$myrow33['numCliente']."'";
		
		$result=mysql_db_query($basedatos,$sSQL);
		while($myrow = mysql_fetch_array($result)){
	   $a+=1;
	   
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL33a= "SELECT 
nomCliente
FROM clientes
WHERE entidad='".$entidad."' and numCliente='".$myrow['seguro']."'
";
$result33a=mysql_db_query($basedatos,$sSQL33a);
$myrow33a = mysql_fetch_array($result33a);


?>
  <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['numeroE'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['numCredencial'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow33a['nomCliente'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['tipoPaciente'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['tipoCredencial'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['fechaInicial'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['fechaFinal'];?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/ventanaAgregarDependientes.php?numCredencial=<?php echo $myrow['numCredencial'];?>&amp;forma=<?php echo "F"; ?>&amp;keyPacientes=<?php echo $myrow['keyPacientes']; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>')"><img src="/sima/imagenes/edit.jpg" alt="credencial" width="12" height="12" border="0" /></a></td>
        <td bgcolor="<?php echo $color?>" class="normal"><div align="left"><span class="style121"> <a href="javascript:ventanaSecundaria1('imprimirCredencial.php?almacen=<?php echo $almacen; ?>&amp;forma=<?php echo "F"; ?>&amp;keyPacientes=<?php echo $myrow['keyPacientes']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"> <img src="/sima/imagenes/camera.jpg" alt="credencial" width="24" height="24" border="0" /> </a> </span></div></td>
        <td bgcolor="<?php echo $color?>" class="normal"><label></label>
            </span>
            <div align="center"><span class="style71">
              <?php if($myrow['status']=='A'){ ?>
              </span> <span class="Estilo24"> <a 
		
		href="<?php echo $_SERVER['PHP_SELF'];?>?keyCredencial=<?php echo $myrow['keyCredencial'];?>&keyPacientes=<?php echo $_GET['keyPacientes']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_GET['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;gpoProducto=<?php echo $_GET['gpoProducto1'];?>&amp;almacenDestino=<?php echo $_GET['almacenDestino'];?>&amp;almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;gpoProducto1=<?php echo $_GET['gpoProducto1'];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> <img src="/sima/imagenes/newicons/active_icon.jpg" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
              <?php } else { ?>
              <a
			 
			   href="<?php echo $_SERVER['PHP_SELF'];?>?keyCredencial=<?php echo $myrow['keyCredencial'];?>&keyPacientes=<?php echo $_GET['keyPacientes']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_GET['tipoAlmacen']; ?>&amp;codigo=<?php echo $C?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;gpoProducto=<?php echo $_GET['gpoProducto1'];?>&amp;almacenDestino=<?php echo $_GET['almacenDestino'];?>&amp;almacenDestino1=<?php echo $_GET['almacenDestino1'];?>&amp;gpoProducto1=<?php echo $_GET['gpoProducto1'];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> <img src="/sima/imagenes/newicons/delete_icon.jpg" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
              <?php } ?>
            </span></div></td>
      </tr>
      <?php if($myrow['defaultExternos']=='si'){
echo 'checked'.$myrow['keyTT'];
} ?>
      <?php }?>
    </table>




</form>
  
    <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPermitenCredenciales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
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