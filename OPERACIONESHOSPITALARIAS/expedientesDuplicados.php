<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");$almacen=$ALMACEN=$_GET['datawarehouse']; ?>
<?php
$almacenDestino=$almacen;
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
?>
<?php  
if($_GET['numCliente'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
	
	$sSQL1= "Select  * From pacientes WHERE keyPacientes = '".$_GET['keyPacientes']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$agrega = "INSERT INTO pacientesHistoria (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta,entidad,usuario,transaccion
) values (

'".strtoupper($myrow1['nombre1'])."','".strtoupper($myrow1['nombre2'])."','".strtoupper($myrow1['apellido1'])."',
'".strtoupper($myrow1['apellido2'])."','".strtoupper($myrow1['apellido3'])."','".$myrow1['numCliente']."',
'".strtoupper($myrow1['ocupacion'])."','".$myrow1['fechaNacimiento']."',
'".strtoupper($myrow1['pais1'])."','".$myrow1['telefono']."','".strtoupper($myrow1['calle'])."','".$myrow1['cp']."',
'".strtoupper($myrow1['ciudad'])."',
'".strtoupper($myrow1['estado'])."','".strtoupper($myrow1['colonia'])."','".strtoupper($myrow1['religion'])."',
'".strtoupper($myrow1['ecivil'])."','".strtoupper($myrow1['rfc'])."','".strtoupper($myrow1['seguro'])."','".$myrow1['poliza']."','".$myrow1['edad']."','".$uploadfile."',
'".strtoupper($myrow1['sexo'])."','".$nombreCompleto."','".$myrow1['numero']."','".$fecha1."',
'".strtoupper($myrow1['observacionesSexo'])."','".$nCuenta."','".$entidad."','".$usuario."','eliminar')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
	
	
$sql="DELETE FROM pacientes
where
keyPacientes='".$_GET['keyPacientes']."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

$sql="DELETE FROM pacientesDuplicados
where
keyED='".$_GET['keyED']."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
		
		echo 'Se elimino el expediente';
	} 



}
?>


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

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=450,height=170,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria19 (URL){ 
   window.open(URL,"ventana19","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES")
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
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
<h1 align="center">Pacientes Posiblemente Duplicados </h1>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" id="form1" name="form1">
  <p align="center">
    <label></label>
    <?php 	
//inicializo el criterio y recibo cualquier cadena que se desee buscar
$criterio = "";
if ($_GET["criterio"]!="" and $_GET["criterio"]!='*'){
	$txt_criterio = $_GET["criterio"];
	$criterio = " where articulos.entidad='".$entidad."'
	AND
	existencias.almacen='".$ALMACEN."'
	AND
	articulos.codigo=existencias.codigo
	AND
	articulos.gpoProducto='".$gpoProducto."' 
	AND
	(articulos.descripcion like '%" . $txt_criterio . "%' or articulos.descripcion1 like '%" . $txt_criterio . "%') order by articulos.descripcion ASC";
} else if($_GET["criterio"]=='*'){
$criterio = "order by articulos.descripcion ASC";
}



if($_GET['criterio']){
  $ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio;
} else {
 $ssql = "SELECT count(apellido1) as totalRegistros
FROM
pacientesDuplicados 
";
}

$result = mysql_db_query($basedatos,$ssql);
$resultante=mysql_fetch_array($result);
$num_total_registros=$resultante['totalRegistros'];
//$num_total_registros = mysql_num_rows($result);

//Limito la busqueda
if($_GET['registros']==NULL){
$TAMANO_PAGINA = 30;
} else {
$TAMANO_PAGINA=$_GET['registros'];
}
//examino la p�gina a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
		$inicio = 0;
		$pagina=1;
}
else {
	$inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

//miro a ver el n�mero total de campos que hay en la tabla con esa b�squeda

//calculo el total de p�ginas
$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

if($_GET['criterio'] ){
 $ssql = "select *,articulos.activo as active from articulos,existencias " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
} else {
 $ssql = "
SELECT *
FROM
pacientesDuplicados
group by numCliente
order by
apellido1,apellido2  ASC limit " . $inicio . "," . $TAMANO_PAGINA;
}




$result = mysql_db_query($basedatos,$ssql);
if($result and $num_total_registros  ){

?>
  </p>

  <table width="625" class="table table-striped">
    <tr>
      <th width="61"   scope="col"><div align="left"><span >#Mov</span></div></th>
      <th width="61"  scope="col"><div align="left"><span >Expediente</span></div></th>
      <th width="96"  scope="col"><div align="left"><span >Apellido1</span></div></th>
      <th width="109"  scope="col"><div align="left"><span >Apellido2</span></div></th>
      <th width="94"  scope="col"><div align="left"><span >Nombre1</span></div></th>
      <th width="97"  scope="col"><span >Nombre2</span></th>
      <th width="77"  scope="col"><div align="left"><span >Eliminar</span></div></th>
    </tr>
	

	
	
    <tr>
    
      <?php
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;


  

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 

$sSQL1= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$myrow['numCliente']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>



  <td  ><span >
    <?php 

	  echo $myrow['keyED'];
	
	  ?>
  </span></td>

      <td   ><span >
        <label></label>
        <span >
        <?php 

	  echo $myrow['numCliente'];
	
	  ?>
      </span></span></td>
      <td  ><span >
        <?php 

	  echo $myrow['apellido1'];
	
	  ?>
      </span></td>
      <td   ><span >
        <?php 

	  echo $myrow['apellido2'];
	
	  ?>
      </span></td>
      <td   ><span >
        <?php 

	  echo $myrow['nombre1'];
	
	  ?>
      </span></td>
      <td   ><span >
        <?php 

	  echo $myrow1['nombre2'];
	
	  ?>
      </span></td>
      <td   ><div align="center">
       
      <span ><a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&numCliente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_GET['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&keyED=<?php echo $myrow['keyED']; ?>&keyPacientes=<?php echo $myrow1['keyPacientes']; ?>"> <img src="/sima/imagenes/borrar.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar a <?php echo $myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['nombre1']." ".$myrow1['nombre2'];?>?') == false){return false;}" /></a>      </span></div></td>
    </tr>
    <?php }//cierra while?>
  </table>

  <p align="center">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />
    <label></label>
    <input name="gpoProducto1" type="hidden" id="gpoProducto1" value="<?php echo $_GET['gpoProducto1']; ?>" />
    <input name="main" type="hidden" id="main" value="<?php echo $_GET['main']; ?>" />
    <input name="warehouse" type="hidden" id="warehouse" value="<?php echo $_GET['warehouse']; ?>" />
    <input name="datawarehouse" type="hidden" id="datawarehouse" value="<?php echo $_GET['datawarehouse']; ?>" />
</p>
</form>


<div align="center" >
  <p>
<?php
//pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra
echo "Numero de registros encontrados: " . $num_total_registros . "<br>";
echo "Se muestran paginas de " . $TAMANO_PAGINA . " registros cada una<br>";
echo "Mostrando la pagina " . $pagina . " de " . $total_paginas . "<p>";


//construyo la sentencia SQL
/* $ssql = "select * from articulos " . $criterio . " limit " . $inicio . "," . $TAMANO_PAGINA;
echo $ssql . "<p>"; */

/*
$rs = mysql_query($ssql);

 while ($fila = mysql_fetch_object($rs)){
	echo $fila->descripcion . "<br>";
} */

//cerramos el conjunto de resultados y la conexi�n con la base de datos
/* mysql_free_result($rs);
mysql_close($conn); 
 */
//echo "<p>";
$total_paginas=56; //alterado
//muestro los distintos �ndices de las p�ginas, si es que hay varias p�ginas
if ($total_paginas > 1){
	for ($i=1;$i<=$total_paginas;$i++){
		if ($pagina == $i ) {
			//si muestro el �ndice de la p�gina actual, no coloco enlace
			echo $pagina . "  ";
		} else {
			//si el �ndice no corresponde con la p�gina mostrada actualmente, coloco el enlace para ir a esa p�gina
echo "<a href=".$_SERVER['PHP_SELF']."?main=".$_GET['main']."&warehouse=".$_GET['warehouse']."&datawarehouse=".$_GET['datawarehouse']."&pagina=" . $i . "&criterio=" . $txt_criterio . "&registros=" . $_GET['registros'] ."&particular=".$_GET['particular']."&aseguradora=".$_GET['aseguradora']."&desplegar=".$_GET['desplegar'].">". $i ."</a> ";
		}
	}
}

?>
  </p>
  <p>  <a href="javascript:ventanaSecundaria19('/sima/cargos/imprimirPrecios.php?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $ALMACEN; ?>&amp;referido=<?php echo $_GET['referido']; ?>&amp;aseguradora=<?php echo $_GET['aseguradora']; ?>&amp;particular=<?php echo $_GET['particular']; ?>&amp;gpoProducto=<?php echo $gpoProducto; ?>&amp;codigo=<?php echo $C; ?>&amp;almacenes=<?php echo $Cd; ?>')"></a></p>
</div>

</body>
</html>
<?php } else { echo 'No hay registros para mostrar!';}//cierro validacion de MYSQL?>

