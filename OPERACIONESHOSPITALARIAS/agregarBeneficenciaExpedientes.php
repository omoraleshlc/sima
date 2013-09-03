<?php require("menuOperaciones.php");$ALMACEN=$_GET['datawarehouse']; ?>

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

        if( vacio(F.nombrePaciente.value) == false ) {
                alert("Por Favor, escribe el nombre del paciente!")
                return false
        } else if( vacio(F.deposito.value) == false ) {
                alert("Por Favor, escribe el dep�sito!")
                return false
        } else if( vacio(F.medico.value) == false ) {
                alert("Por Favor, escoje el m�dico responsable del internamiento!")
                return false
        }  else if( vacio(F.cuarto.value) == false ) {
                alert("Por Favor, escoje el cuarto que desees asignar!")
                return false
        }  else if( vacio(F.limiteCredito.value) == false ) {
                alert("Por Favor, escoje el l�mite que desees asignar!")
                return false
        }
}




</script>

<script language=javascript>
function ventanaSecundaria5 (URL){
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria7 (URL){
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria3 (URL){
   window.open(URL,"ventana3","width=800,height=400,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria4 (URL){
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana","width=550,height=180,scrollbars=YES")
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
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Est� Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>

<?php
if($_GET['activar']=='si'){
      $q = "UPDATE pacientes set 
beneficencia='si'
WHERE 
entidad='".$entidad."'
    AND
numCliente='".$_GET['numeroE']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error();
$descripcionA='Se activo la beneficencia del archivo agregar beneficencias, del expediente: '.$_GET['numeroE'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}elseif($_GET['desactivar']=='si'){
         $q = "UPDATE pacientes set 
beneficencia=''
WHERE 
entidad='".$entidad."'
    AND
numCliente='".$_GET['numeroE']."'

";

mysql_db_query($basedatos,$q);
echo mysql_error(); 
$descripcionA='Se desactivo la beneficencia del archivo agregar beneficencias, del expediente: '.$_GET['numeroE'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
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

<body>
<h1>Agregar Beneficencia - Pacientes </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<table width="547" class="table-forma">
  <tr  >
        <td colspan="3">Nuevo Paciente <span ><span >
<a href="javascript:ventanaSecundaria1('../ventanas/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/btns/addpatient.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" /></a></td>

    </tr>
      <tr  >
        <td  ><div align="left" class="negromid">Apellido Paterno, Materno </div></td>
        <td ><label>
        <input name="paciente" type="text"  id="paciente" size="40"
		value="<?php echo $_POST['paciente'];?>"  />
        </label></td>
        <td ><label>
          <input name="mostrar" type="submit"  id="mostrar" value="buscar" />
</label>
&nbsp;
<input name="nombrePaciente2" type="hidden" id="nombrePaciente1" value="<?php echo $_POST['numPaciente'];?>"/>
<input name="nCuenta" type="hidden"  id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
<input name="numeroEx" type="hidden"  id="numeroEx" value="<?php echo $numeroEs= $_POST['numeroEx']; ?>" readonly="" /></td>
    </tr>
    </table>

<div align="center">
  <p><a href="javascript:ventanaSecundaria1(
		'../cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="style1">Busqueda Avanzada</a></p>
  <?php
if(!$_POST['nombres'])  {
    $_POST['nombres']=$_GET['nombres'];
}
  
$nombres=$_POST['paciente'];  
if(($_GET['activar'] and $nombres!= NULL) or $nombres!= NULL or ($_GET['desactivar'] and $nombres!= NULL)){
$sSQL= "
SELECT * FROM
pacientes
where
(entidad='".$entidad."'
AND
(
(CONCAT(nombre1) like '%$nombres%')
or
(CONCAT(apellido1,' ',apellido2) like trim('%$nombres%'))
or
(CONCAT(apellido1,'  ',apellido2) like '%$nombres%')
or
(CONCAT(nombre1) like '%$nombres%')
or
(nombreCompleto like '%$nombres%')
)) or 
        (entidad='".$entidad."'
and
numCliente='".$nombres."'
)
order by
nombreCompleto asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
</div>
<p><a href="javascript:ventanaSecundaria1(
		'../cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="style1"></a></p>
<br />
<table width="553" class="table table-striped">
<tr >
        <th width="17"   scope="col"><div align="left" >
          <div align="center">#</div>
      </div></th>
        <th width="67"  scope="col"><div align="left" >
          <div align="center">Exp.</div>
        </div></th>
      <th width="229"  scope="col"><div align="left" >Paciente</div></th>
      <th width="91"  scope="col"><div align="left" >
        <div align="center">Beneficencia</div>
      </div></th>
      <th width="68"  scope="col"><div align="left" >
        <div align="center">Editar Exp.</div>
      </div></th>
    </tr>
      <tr>
        <?php
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$bandera+="1";


//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente'];

$sSQL33= "Select  * From porcentajeJubilados WHERE keyPacientes = '".$myrow['keyPacientes']."'";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
?>


        <td height="24" bgcolor="<?php echo $color;?>" ><span >
        <?php
			echo $bandera;
		  ?>
        </span></td>

		  <td bgcolor="<?php echo $color;?>" ><span >
		    <?php
			echo $myrow['numCliente'];

		  ?></span></td>
		  <td bgcolor="<?php echo $color;?>" >

		<?php echo $myrow['nombreCompleto']; ?>		</td>
     
                  
                  <td bgcolor="<?php echo $color;?>" >
                  <div align="center">
		  <?php if($myrow['beneficencia']=='si'){ ?>
		  <a href="#" onClick="ventanaSecundaria3('../ventanas/activarBeneficencias.php?numeroE=<?php echo $myrow['numCliente'];?>&codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&keyPacientes=<?php echo $myrow['keyPacientes']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen2=<?php echo $A; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>')"> <img src="/sima/imagenes/btns/addbtn2.png"  width="22" height="22" border="0" /> </a>
		  <?php } else { echo '---'; }?>
                  </div>
                  </td>
     
        <td bgcolor="<?php echo $color;?>"  align="center">


<?php if($myrow['beneficencia']!='si'){ ?>
<a href="agregarBeneficenciaExpedientes.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&numeroE=<?php echo $myrow['numCliente']; ?>&nombres=<?php echo $_POST['nombres']; ?>&activar=si&desactivar=no">
    Activar	
</a>
  <?php } else {?>     
        <a href="agregarBeneficenciaExpedientes.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&numeroE=<?php echo $myrow['numCliente']; ?>&nombres=<?php echo $_POST['nombres']; ?>&desactivar=si&activar=no">
    Desactivar	
</a>    
         <?php 	  }  ?>     
            
            
            
        </td>
    </tr>

      <?php }}?>
    </table>


	<?php if($nombres){ ?>
	<p align="center" ><span >Se encontraron:  <?php echo $bandera;?> registros..   </span></p>
	<?php } ?>
	<p>
	  <input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly=""
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>
  <p>&nbsp;</p>
</body>
</html>