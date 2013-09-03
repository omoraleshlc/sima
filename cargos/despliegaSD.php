<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<?php
$numeroE=$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacenSolicitante=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoCargo=$_GET['tipoCargo'];
$almacenDestino=$_GET['almacenDestino'];
?>



<?php  
if($_GET['keyCAP'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE cargosCuentaPaciente set 
status='cancelado',folioVenta='',keyClientesInternos=''
		WHERE 
		keyCAP='".$_GET['keyCAP']."'
		";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
}
?>



<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES") 
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
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el departamento!")   
                return false   
        } else if( vacio(F.tipoUM.value) == false ) {   
                alert("Por Favor, escoje si es un servicio o si son artículos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el artículo o servicio para solicitar!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<?php 



//************************* AGREGAR PACIENTE AMBULATORIO **************************



if($_POST['insertarArticulos'] ){ //*************************PRESIONO INSERTAR ARTICULOS******************





$codigo=$_POST['codigoArt'];
$cantidad=$_POST['cantidad'];
$agregarA=$_POST['agregarA'];
$codigoBeta=$_POST['codigoBeta'];
$codigoGamma=$_POST['codigoGamma'];
$um=$_POST['um'];
$codigoLC=$_POST['coder'];



for($i=0; $i<$_POST['bandera'];$i++){ //********************FOR
$b+=1;
$codigo[$i]=$codigoBeta[$i];




$sSQL29= "SELECT *
FROM
cargosCuentaPaciente
where
keyCAP='".$codigoGamma[$i]."' 

";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);




if( is_numeric($cantidad[$i]) and $cantidad[$i] >0 AND $myrow29['cantidad']>=$cantidad[$i] ){
$faltantes=$myrow29['cantidad'];
$cc=$myrow29['cantidad'];
$ccT=$cantidad[$i]-$cc;
if($ccT=='0'){

$statusCargo='cargado';
} else {
$cc-=$cantidad[$i];
$statusCargo='standby';
}
//***************************ajuste de existencias**************************

$q = "UPDATE cargosCuentaPaciente set 
transferencia='si',
random='".$_POST['rand']."',
statusImpresion='standby',usuarioImpresion='".$usuario."',
cantidad='".$cc."', 
statusCargo='".$statusCargo."',
horaCargo='".$hora1."',
fechaCargo='".$fecha1."',
usuarioCargo='".$usuario."'


WHERE keyCap = '".$codigoGamma[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();


if($myrow29['statusDevolucion']=='si'){
$q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cc."',
razon=NULL
WHERE 
entidad='".$entidad."'
and
keyPA='".$myrow29['keyPA']."'
AND 
almacen = '".$myrow29['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
}

?>

<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirServicios.php?numeroE=<?php echo $numeroE; ?>&codigo=<?php echo $myrow['codProcedimiento']; ?>&nCuenta=<?php echo $nCuenta ?>&paciente=<?php echo $_POST['paciente']; ?>&orden=<?php echo $E; ?>&hora1=<?php echo $hora1; ?>&almacen=<?php echo $_GET['almacenDestino']; ?>&folioVenta=<?php echo $_GET['folioVenta'];?>&rand=<?php echo $_POST['rand'];?>&usuario=<?php echo $_POST['usuarioSolicita'];?>');
</script>
<?php 





//****************saco la cuenta contable de la forma en que ingresa*****************
insertarRegistros($agregarA[$i],$almacen,$cantidad[$i],$fecha1,$ID_EJERCICIOM,$usuario,$basedatos);
?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    //self.close();
  // -->
</script>

<script>
close();
</script>
<?php 

}
}
//*****************************************************CIERRO ALMA**************************************************



}





?>




 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 

<?php
		if($_POST['fechaInicial']){
		 $date=$_POST['fechaInicial'];
		 }else{
		 $date=$fecha1;
		 }
		 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>
<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>

<body>
<p align="center" class="titulos">
Usuario que surtio: <?php echo $usuario;?>
  <label></label>
  <?php	
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
(
entidad='".$entidad."'
and
usuarioCargo='".$usuario."'
and
fechaCargo='".$date."'
and 
statusCargo='cargado'
and
almacenDestino='".$almacenDestino."'
and
naturaleza='C') or (
entidad='".$entidad."'
and

usuarioCargo='".$usuario."'
and
fechaCargo='".$date."'
and 
statusCargo='cargado'
and
almacenDestino='".$almacenDestino."'
and
naturaleza='A'
and
status='devolucion' and statusDevolucion='si'
)
";



?>
</p>
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
<p align="center"><span class="titulo">
  <label>Escojer Fecha
  <input onChange="this.form.submit();" name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php echo $date;?>"/>
  </label>
  <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
</span></p>
<table width="772" border="0" align="center">
      <tr>
        <td width="50" bgcolor="#FFFFFF" scope="col"><div align="left" class="style1">
          <div align="left"># </div>
        </div></td>
        <td width="205" bgcolor="#FFFFFF" scope="col" class="blanco"><div align="left" class="style1">Paciente</div></td>
        <td width="129" height="19" bgcolor="#FFFFFF" class="blanco style1" scope="col"><div align="center" class="style1">Fecha de Levantamiento de Muestra</div>
        </div></td>
        <td width="259" bgcolor="#FFFFFF" scope="col" class="blanco"><div align="left" class="style1">Descripci&oacute;n</div></td>
        <td bgcolor="#FFFFFF" scope="col"><div align="left" class="style1">
            <div align="center">Almacen Solicitante</div>
        </div></td>
        <td width="52" bgcolor="#FFFFFF" scope="col" class="blanco"><div align="left" class="style1">Usuario</div></td>
        <td width="25" bgcolor="#FFFFFF" scope="col" class="blanco"><div align="left" class="style1">C</div></td>
      </tr>
      <tr>
    
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$code1=$myrow['codProcedimiento'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
entidad='".$entidad."'
and
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

$ctaMayor=$myrow12['ctaContable'];
$costoHospital=costoHospital($code1,$basedatos);

$ctaContable=centroCosto($medico,$basedatos);
$centroCostoAlmacen=centroCostoAlmacen($almacenDestino,$basedatos);
//$priceLevel=validacionConvenios($precioLevel,$code1,$almacenDestino,$gpoProducto,$seguro,$basedatos);

//*/****************************************Cierro validacion de convenios************************

//cierro descuento


$sSQL4= "
SELECT 
  *
FROM
existencias
WHERE 
entidad='".$entidad."'
and
codigo = '".$code1."'
and 
almacen='".$almacenDestino."'
and
(reorden <=maximo and reorden >=minimo) 
and
existencia >'0'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$codigoUM=$myrow12['um'];
$sSQL13= "Select distinct * From umVentas
 where
id_um='".$codigoUM."' 
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
 $sSQL2= "Select distinct * From cargosCuentaPaciente
 where
numeroE='".$numeroPaciente."'  and nCuenta='".$nCuenta."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);



$sSQL4c= "
SELECT 
folioVenta,paciente
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."'";
$result4c=mysql_db_query($basedatos,$sSQL4c);
$myrow4c = mysql_fetch_array($result4c);
?>

    <td bgcolor="<?php echo $color;?>" class="codigo"><div align="left"  class="codigos">
      <?php 
		  print $myrow['keyCAP'];
		
		  ?>
    </span></div></td>

        <td bgcolor="<?php echo $color;?>" class="normal" >
		<?php echo $myrow4c['paciente'].'</br>' ; 
        print '['.$myrow4c['folioVenta'].']';?>        </td>
        <td height="24" bgcolor="<?php echo $color;?>" ><span class="style7"><label></label>
          <div align="left" class="normal">
            <?php 
		  print cambia_a_normal($myrow['fechaSolicitud']). " ".$myrow['horaSolicitud'];
		
		  ?>
          </div>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="left" class="normal">     
          <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        </span></div>
              <span class="Estilo1">
        	  <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Se solicito devolucion para este articulo]';
	  }
	  ?>
      </span>        </td>
        <td width="90" bgcolor="<?php echo $color?>" class="normal" align="center"><?php 
		$sSQL8ab= "
SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacenSolicitante']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);
echo $myrow8ab['descripcion'];
?>
            </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="codigos">
          <?php 
		  print $myrow['usuario'];
		
		  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center" class="normal"><?php echo $myrow['cantidad'];

?></div>
        <div align="center"></div></td>
      </tr>
      <?php }?>
  </table>
  
  
  
<p>
      <?php 
 
 //*********************************************TERMINA TABLA**************************************************
 
 ?>
      <span class="Estilo24"><span class="style7">
      
  </span></span></p>
    <p>
      <label>
      <div align="center">
        <hr width="600" size="0" />
  <p align="center">&nbsp; </p>
		  <input name="rand" type="hidden" id="rand" value="<?php echo rand(10000,100000000); ?>"/>
        <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
        <input name="usuarioSolicita" type="hidden" id="numPaciente" value="<?php echo $_GET['usuario']; ?>" />
</form>
<p></p>
  
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
    </script> 
</body>
</html>
