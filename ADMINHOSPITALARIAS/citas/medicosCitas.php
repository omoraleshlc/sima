<?php include("/configuracion/administracionhospitalaria/menufinancieros.php"); ?>
<?php 






//actualizar ******************************************************************************************************
if($_GET['actualizar'] ){ 
//********abro lista

//********cierro lista
//if($myrow1['codMedico'] !=$_POST['codMedico']){ //checo que no haya un codMedico igual
//******************** INSERTAR Y ACTUALIZAR ************************************
$keyCitas = $_GET["keyCitas"]; //paso arreglo de agregar modulos a agregar

for($i=0;$i<=$_GET['bandera'];$i++){
if($keyCitas[$i]){
$sSQL3= "Select * From medicosCitas WHERE keyMC = '".$keyCitas[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);




$agrega = "INSERT INTO medicosCitas (
codMedico,codHora,usuario,fecha,status,hora
) values (
'".$_POST['codMedico']."',
'".$agregar[$i]."',
'".$usuario."',
'".$fecha1."',
'".$status."',
'".$mandoHora."'
)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó el codMedico: ".$_POST['codMedico'];
}
}}


//****************************************************************************************************************************

if($_POST['borrar'] AND $_POST['codMedico']){
$codHora=$_POST['codHora'];
$quitar = $_POST['quitarlos'];
if($quitar){
foreach($quitar as $is => $quitar_articulo){
 $borrame = "DELETE FROM MedicosCitas WHERE codMedico ='".$_POST['codMedico']."' 
AND codHora = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['codMedico']){
$leyenda = "Por favor, escoja el nombre de codMedico que desee eliminar..!";
}



if($_POST['numMedico']){
$sSQL1= "Select * From codMedicos WHERE numMedico= '".$_POST['codMedico']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
} 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.style14 {color: #003366}
-->
</style>
</head>

<body>
<p align="center">
  <label></label>
</p>
<h1 align="center"> Relaci&oacute;n M&eacute;dico &lt;--&gt; Horas Disponibles </h1>
<label>
<form id="form1" name="form1" method="get" action="">
  <p align="center"><?php echo $leyenda; ?></p>
  </label>
  <table width="323" border="0" align="center" class="style12">
    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Escoje el M&eacute;dico</span></strong></th>
    </tr>
    <tr>
      <th scope="col">M&eacute;dico: </th>
      <th width="152" scope="col"><?php 
	  require("/configuracion/componentes/comboAlmacen.php"); 
$entidad='01';
$almacenDestino='HCEX';
$comboAlmacen1=new comboAlmacen();
if(!$almacenDestino){
$almacenDestino=$almacenSolicitante;
}
$comboAlmacen1->despliegaMiniAlmacenGET($entidad,'style7',$almacenDestino,$almacenDestino,$basedatos);

?></th>
    </tr>
    <tr>
      <th colspan="2" scope="col"><label>
        <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$_POST['codMedico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
        <?php echo "Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?>
      </label></th>
    </tr>
</table>
  <p>
 
  </p>
  
  
  <table width="237" border="0" align="center">
    <tr>
      <th width="151" bgcolor="#660066" scope="col"><span class="style11">Hora </span></th>
      <th width="70" bgcolor="#660066" scope="col"><span class="style11">Agregar
      <label></label>
      </span></th>
      <th width="70" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
    </tr>
    <tr>
      <?php   
 $sSQL= "Select * From citas order by keyCitas ASC";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
 $codora=$myrow['keyHora'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
 $sSQL81= "Select * From medicosCitas WHERE almacen ='".$_POST['codMedico']."' and
codHora='".$codora."'	
";
$result81=mysql_db_query($basedatos,$sSQL81);
$myrow81 = mysql_fetch_array($result81);
?>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['codHora'];?></span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
               <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['almacen']; ?>" />

            
               <input name="mandoHora[]" type="hidden" id="mandoHora[]" value="<?php echo $myrow['hora']; ?>" />
      <td bgcolor="<?php echo $color;?>" class="style12"><label>
          <div align="center">
            <input name="keyCitas[]" type="checkbox" class="style12" id="keyCitas[]" 
		value="<?php 
		echo $myrow['keyCitas'];
		?>" />
          </div>
        </label></td>
      <td bgcolor="<?php echo $color;?>" class="style12">
	  <?php if($myrow81['codHora']){ ?>
	  <input name="quitarlos[]" type="checkbox" class="style12" id="quitarlos[]" 
		value="<?php 
		echo $myrow['keyHora'];
		?>" />
		<?php } else { echo "---"; }?>
	  </td>
    </tr>
    <?php }?>
</table>
  <p align="center">
   <input name="bandera" type="hidden" class="style12" id="actualizar" value="<?php echo $bandera;?>" />
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar Hora" />
    <label></label>
    <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
  </p>
  <p>&nbsp;</p>
</form>
</body>
</html>