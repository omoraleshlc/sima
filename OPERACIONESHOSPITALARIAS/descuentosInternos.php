<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");$ALMACEN=$_GET['datawarehouse']; ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 














<?php
$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos ='".$_GET['keyClientesInternos']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();
$paciente=$myrow1['paciente'];
$exp=$myrow1['exp'];
$descripcionD='Se desactivo la beneficencia del paciente: '.$paciente.', y su expediente es el: '.$exp;
$descripcionA='Se Activo la beneficencia del paciente: '.$paciente.', y su expediente es el: '.$exp;

if($_GET['desactivaBeneficencia']=='si'){
        $agrega = "
UPDATE clientesInternos
set
activaBeneficencia=''
where
keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionD."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

//$sSQL1= "Select * From cargosCuentaPaciente WHERE 
//keyClientesInternos='".$_GET['keyClientesInternos']."' and gpoProducto!='' and status!='transaccion'";
//
//$result1=mysql_db_query($basedatos,$sSQL1);
//while($myrow1 = mysql_fetch_array($result1)){
//        $cantidadBeneficencia=$myrow1['cantidadBeneficencia'];
//    $ivaBeneficencia=$myrow1['ivaBeneficencia'];
//$q = "UPDATE cargosCuentaPaciente set 
//cantidadParticular='".$cantidadBeneficencia."',
//ivaParticular='".$ivaBeneficencia."',
//cantidadBeneficencia=NULL,
//ivaBeneficencia=NULL
//WHERE 
//keyCAP='".$myrow1['keyCAP']."'";
//mysql_db_query($basedatos,$q);
//echo mysql_error();
//
//$q3 = "UPDATE cargosCuentaPaciente set 
//cantidadBeneficencia=NULL,ivaBeneficencia=NULL
//
//WHERE 
//keyCAP='".$myrow1['keyCAP']."'";
//mysql_db_query($basedatos,$q3);
//echo mysql_error();
//}




echo '<span class="error"><blink>'.'Beneficencia Desactivada!'.'</blink></span>';














}elseif($_GET['activa']=='si' and $_GET['keyClientesInternos']!=NULL and $_GET['activaBeneficencia']==NULL){

    $agrega = "
UPDATE clientesInternos
set
activaBeneficencia='si'
where
keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


//$sSQL1= "Select * From cargosCuentaPaciente WHERE 
//keyClientesInternos='".$_GET['keyClientesInternos']."' and gpoProducto!='' and status!='transaccion'";
//
//$result1=mysql_db_query($basedatos,$sSQL1);
//while($myrow1 = mysql_fetch_array($result1)){
//        $cantidadParticular=$myrow1['cantidadParticular'];
//    $ivaParticular=$myrow1['ivaParticular'];
//$q = "UPDATE cargosCuentaPaciente set 
//cantidadBeneficencia='".$cantidadParticular."',
//ivaBeneficencia='".$ivaParticular."'
//
//
//WHERE 
//keyCAP='".$myrow1['keyCAP']."'";
//mysql_db_query($basedatos,$q);
//echo mysql_error();
//
//
//$q3 = "UPDATE cargosCuentaPaciente set 
//cantidadParticular=NULL,ivaParticular=NULL
//
//WHERE 
//keyCAP='".$myrow1['keyCAP']."'";
//mysql_db_query($basedatos,$q3);
//echo mysql_error();
//}

echo '<span class="success"><blink>'.'Beneficencia Activada'.'</blink></span>';
}

?>














<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="get" action="#">
  <h1 > <?php echo $TITULO; ?>Aplicar Beneficencia<label></label>
  Pacientes Internos</h1>
  <p align="center">&nbsp;</p>

  <table width="686"  class="table table-striped">
    <tr >
      <th width="102"   scope="col"><div align="left">Referencia</div></th>
      <th width= "227"   scope="col"><div align="left">Nombre del paciente:</div></th>
      <th   scope="col"><div align="left">Departamento</div></th>
	  <th   scope="col"><div align="left">Estado C </div></th>
	  <th   scope="col"><div align="left">Usuario</div></th>
	  <th   scope="col"><div align="left" ></div></th>
    </tr>
    <tr >
      <?php	



$sSQL= "SELECT *
from clientesInternos
where 
entidad='".$entidad."'
and
(statusCuenta='final' or statusCuenta='revision' )
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
folioVenta!='0'
and
statusDevolucion!='si'
and
(seguro='' or seguro='0')
order by paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
    <tr  > 
      <td  ><?php echo $myrow['folioVenta'];
?></td>


  <td width="227" >


	  	  <?php 


if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?>

      <?php if($myrow['activaBeneficencia']=='si'){
       echo '<br>';
       echo '<span class="precio1">Beneficencia Activa</span>';
      }
          ?>


        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="138" ><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>


      <td width="71" ><span > <a href="javascript:ventanaSecundaria1('../cargos/despliegaCargos.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>')"> Estado Cuenta</a></span></td>
      <td width="71" ><?php
echo $myrow['usuario'];
?></td>


<td width="51" >
<?php if($myrow['activaBeneficencia']==''){ ?>
    <a href="descuentosInternos.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&activa=si&activaBeneficencia=<?php echo $myrow['activaBeneficencia'];?>">
      Aplicar
    </a>
    <?php }elseif($myrow['activaBeneficencia']=='si'){?>
      <a href="descuentosInternos.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&activa=si&desactivaBeneficencia=si">
      Desactivar Beneficencia
    </a>      
      <?php   
    }else{
        echo '---';}?>    </td>
    </tr> 
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>
  <p><a href="javascript:ventanaSecundaria1(
		'../cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="style1">Busqueda Avanzada </a></p>

  <p>&nbsp;</p>
</form>



</body>
</html>