<?php require("menuOperaciones.php"); ?> 



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
           
        if( vacio(F.keyTCred.value) == false ) {   
                alert("Por Favor, escoje el keyTCred/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este keyTCred!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventana1 (URL){ 
   window.open(URL,"ventana1","width=700,height=400,scrollbars=YES") 
} 
</script> 

<?php



if(!$_POST['nuevo'] AND $_POST['actualizar'] AND ($_POST['keyTCred'] or $_POST['codigoTC']) and $_POST['descripcion'] ){


$sSQL1= "Select * From tipoCredencial WHERE keyTCred = '".$_POST['keyTCred']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoTC']){

$agrega = "INSERT INTO tipoCredencial (
codigoTC,descripcion,status,costoNormal,costoAdicional,entidad,maximoAdicional,random
) values ('".$_POST['codigoTC']."','".$_POST['descripcion']."','A','".$_POST['costoNormal']."','".$_POST['costoAdicional']."','".$entidad."','".$_POST['maximoAdicional']."','".$random."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Transacción agregada';
echo '<script>
window.alert( "SE AGREGO EL TIPO DE CREDENCIAL! ");
</script>';
$sSQL2a= "Select random From tipoCredencial order by keyTCred DESC ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);
}else {
$q = "UPDATE tipoCredencial set 
descripcion='".$_POST['descripcion']."', 
costoNormal='".$_POST['costoNormal']."',
costoAdicional='".$_POST['costoAdicional']."',
status='".$_POST['status']."',
maximoAdicional='".$_POST['maximoAdicional']."'
WHERE 
keyTCred='".$_POST['keyTCred']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Transacción modificada';
echo '<script>';
echo 'window.alert("SE MODIFICO EL TIPO DE CREDENCIAL! ");';
echo '</script>';


}
}





if($_POST['borrar'] AND $_POST['keyTCred']){
$borrame = "DELETE FROM tipoCredencial WHERE keyTCred ='".$_POST['keyTCred']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo 'La transacción deberá ser removida manualmente!';
echo '<script >
window.alert("SE ELIMINO EL TIPO DE CREDENCIAL! "=;
</script>';
}



if(!$_POST['nuevo']){
$sSQL2= "Select * From tipoCredencial WHERE keyTCred = '".$_GET['keyTCred']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}




?>

<?php if($_POST['crear']){ ?>
<script>
javascript:ventana1('ventanaAgregaCredencial.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow1['folioVenta']; ?>');
close();
</script>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilo= new muestraEstilos();
$estilo-> styles();
?>
</head>

<body>

 <h1 >Cat&aacute;logo de Tipos de Credencial</h1>
 <p>
   <?php   
 $sSQL= "Select * From tipoCredencial order by keyTCred ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
<form id="form2" name="form2" method="post" >

  <table width="645" class="table table-striped">
    <tr>
      <th width="113"   scope="col"><div align="left" >
        <div align="left">Tipo Credencial</div>
      </div></th>
      <th width="160"  scope="col"><div align="left" >
        <div align="left">Descripci&oacute;n</div>
      </div></th>
      <th width="80"  scope="col"><div align="left"><span >C.Normal</span></div></th>
      <th width="71"  scope="col"><div align="left"><span >C. Normal</span></div></th>
       <th width="138"  scope="col"><span >M&aacute;x. Adicionales </span></th>
      <th width="42"  scope="col"><div align="left"><span >Status</span></div></th>
      <th width="41"  scope="col"><div align="left" >
      <div align="left">Editar</div>
      </div></th>
    </tr>
    <tr>
     
      <?php	while($myrow = mysql_fetch_array($result)){
	   $a+=1;
	   
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['keyTCred'];
$ventana='catalogoTT.php';
?>
 <td height="19" bgcolor="<?php echo $color?>" ><?php echo $myrow['codigoTC'];?></td>
      <td bgcolor="<?php echo $color?>" ><?php echo $myrow['descripcion'];?>
      <input type="hidden" name="keyTCred" id="keyTCred" value="<?php echo $myrow['keyTCred'];?>" /></td>
       <td bgcolor="<?php echo $color?>" ><?php echo '$'.number_format($myrow['costoNormal'],2);?></td>
       <td bgcolor="<?php echo $color?>" ><?php echo '$'.number_format($myrow['costoAdicional'],2);?></td>
       <td bgcolor="<?php echo $color?>" ><?php echo $myrow['maximoAdicional'];?></td>
      <td bgcolor="<?php echo $color?>" ><?php if($myrow['status']){
echo $myrow['status'];
} else {
echo "I";
}?></td>
      <td bgcolor="<?php echo $color?>" >
        <label></label>
      </span>
      <a href="javascript:ventana1('ventanaAgregaCredencial.php?keyTCred=<?php echo $myrow['keyTCred'];?>')">
      <img src="../imagenes/expandir.gif" width="12" height="12" border="0" />      </a>      </td>
    </tr>
    <?php if($myrow['defaultExternos']=='si'){
echo 'checked'.$myrow['keyTT'];
} ?>
	 
    <?php }?>
  </table>

	
  <p align="center">
    <label></label>
     <label>
     <input type="submit" name="crear" id="crear" value="Nueva Credencial" />
     </label>
  </p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>