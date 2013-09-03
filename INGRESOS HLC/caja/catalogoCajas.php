<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); ?>

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
           
        if( vacio(F.codigoCaja.value) == false ) {   
                alert("Por Favor, escoje el codigoCaja/departamento!")   
                return false   
        } else if( vacio(F.descripcionCaja.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este codigoCaja!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   
  
  
  
  
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 

<?php

if(!$_POST['variable']){
$_POST['variable']='no';
}

if($_POST['defaultExternos']){
$defaultE='si';
} else {
$defaultE='no';
}


if($_POST['actualizar'] AND $_POST['codigoCaja'] ){
if(!$_POST['permisoEspecial']){
$_POST['permisoEspecial']='no';
}

$sSQL1= "Select * From catCajas WHERE entidad='".$entidad."' and codigoCaja = '".$_POST['codigoCaja']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoCaja']){
if($_POST['codigoCaja']!=$myrow1['codigoCaja']){

$agrega = "INSERT INTO catCajas (
codigoCaja,descripcionCaja,status,entidad
) values ('".$_POST['codigoCaja']."','".$_POST['descripcionCaja']."','A','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Transaccion agregada';
echo '<script>
msgbox "ESTE TIPO DE TRANSACCION HA SIDO AGREGADO EXITOSAMENTE! "
</script>';
}} else {
$q = "UPDATE catCajas set 
descripcionCaja='".$_POST['descripcionCaja']."', 

status='".$_POST['status']."'
WHERE 
entidad='".$entidad."'
and
codigoCaja='".$_POST['codigoCaja']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Transaccion modificada';
echo ' <script>
window.alert( "ESTA CAJA HA SIDO MODIFICADA! ");
</script>';

}
}

if($_POST['borrar'] AND $_POST['codigoCaja']){
$borrame = "DELETE FROM catCajas WHERE entidad='".$entidad."' and codigoCaja ='".$_POST['codigoCaja']."'";
mysql_db_query($basedatos,$borrame);


echo mysql_error();
echo 'La transaccion debera ser removida manualmente!';
echo 'script>
window.alert( "ESTE CAJA HA SIDO ELIMINADA! ");
</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['codigoCaja'] = "";
}


if(!$_POST['codigoCaja2']){
$_POST['codigoCaja2']=$_GET['codigoCaja2'];
}

if($_GET['keyCatC']!=NULL){
$sSQL2= "Select * From catCajas WHERE keyCatC= '".$_GET['keyCatC']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}




if($_POST['establecer'] ){
$defaultExternos=$_POST['defaultExternos'];
$q = "UPDATE catCajas set 
defaultExternos='no',
banderaEfectivo=NULL,
banderaCredito=NULL,
banderaCortesia=NULL
";
mysql_db_query($basedatos,$q);
echo mysql_error();

$q = "UPDATE catCajas set 
defaultExternos='si'

WHERE 

keyTT='".$defaultExternos."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

$banderaEfectivo=$_POST['banderaEfectivo'];
$banderaCredito=$_POST['banderaCredito'];
$banderaCortesia=$_POST['banderaCortesia'];
$keyTT=$_POST['keyTT'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($banderaEfectivo[$i]){

$q = "UPDATE catCajas set 
banderaEfectivo='si'

WHERE 

keyTT='".$banderaEfectivo[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
} 

if($banderaCredito[$i]){//cierra bandera efectivo
$q = "UPDATE catCajas set 
banderaCredito='si'

WHERE 

keyTT='".$banderaCredito[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
if($banderaCortesia[$i]){//cierra bandera cortesia
$q = "UPDATE catCajas set 
banderaCortesia='si'

WHERE 

keyTT='".$banderaCortesia[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}

} //cierra for


}
?>
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
 <h1 align="center" class="titulos">Catalogo de Cajas </h1>
 <form id="form1" name="form1" method="post" action="" >
   <p>
     <label></label>
   </p>
   <img src="../../imagenes/bordestablas/borde1.png" width="616" height="24" />
   <table width="616" border="0" align="center" cellpadding="3" cellspacing="0">
     <tr>
       <th width="9" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <th width="101" bgcolor="#CCCCCC" class="normal" scope="col"><div align="left">Codigo Caja </div>         
         <label></label></th>
       <th width="492" bgcolor="#CCCCCC" class="style12" scope="col">
         <div align="left" class="style18">
           <input name="codigoCaja" type="text" class="campos" id="codigoCaja" value="<?php echo $myrow2['codigoCaja']?>" 
size="10" <?php if($myrow2['codigoCaja']){ echo 'readonly=""';}?> autocomplete="off"/>
       </div></th>
     </tr>
     <tr>
       <th width="9" bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Descripcion</td>
       <td bgcolor="#CCCCCC" class="style12"><input name="descripcionCaja" type="text" class="campos" id="descripcionCaja" 
	   value ="<?php echo $myrow2['descripcionCaja']?>" size="60"/></td>
     </tr>
     <tr>
       <th bgcolor="#CCCCCC" class="normal" scope="col">&nbsp;</th>
       <td bgcolor="#CCCCCC" class="normal">Activa</td>
       <td bgcolor="#CCCCCC" class="style12">
         <label>
          <input name="status" type="hidden" id="status" value="A" />
         </label>
       </td>
     </tr>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="616" height="24" />
<p>&nbsp;</p>
   <table width="36%" border="0" align="center" cellpadding="0" cellspacing="10">
     <tr valign="middle">
       <td><span class="Estilo24">
         <input name="actualizar" type="submit" class="style18" id="actualizar" value="Alta/Modificar" src="../../imagenes/btns/modifybutton.png"/>
       </span></td>
       <td><span class="Estilo24">
         <input name="borrar" type="submit" class="style18" id="borrar" value="Eliminar" src="../../imagenes/btns/deletebutton.png"/>
       </span></td>
       <td valign="top"><p class="Estilo24">
         <input name="nuevo" type="submit" class="style18" id="nuevo" value="Nuevo" src="../../imagenes/btns/newbutton.png"/>
         </p>
       </td>
     </tr>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From catCajas where entidad='".$entidad."' order by codigoCaja ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> </p>
 <form id="form2" name="form2" method="post" action="">
   <img src="../../imagenes/bordestablas/borde1.png" width="307" height="24" />
   <table width="307" border="0" align="center" cellpadding="3" cellspacing="0">
     <tr>
       <th width="77" bgcolor="#FFFF00" scope="col"><div align="left" class="none">Codigo</div></th>
       <th width="171" bgcolor="#FFFF00" scope="col"><div align="left" class="none">Descripcion</div></th>
      
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
	   $a+=1;
	   
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['codigoCaja'];
$ventana='catalogoTT.php';
?>
       <td bgcolor="<?php echo $color?>" class="normal">
	 
<a href="catalogoCajas?warehouse=<?php echo $_GET['warehouse'];?>&keyCatC=<?php echo $myrow['keyCatC'];?>">
<img src="/sima/imagenes/expandir.gif" width="12" height="12" border="0">
<?php echo $A?>
 </a>


       <input name="keyTT[]" type="hidden"   value="<?php echo $myrow['keyTT'];?>" />
       </td>
       <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['descripcionCaja'];?></td>

     </tr>
	 <?php if($myrow['defaultExternos']=='si'){
echo 'checked'.$myrow['keyTT'];
} ?>
	 
     <?php }?>
   </table>
   <img src="../../imagenes/bordestablas/borde2.png" width="307" height="24" />
   <p align="center">
     <label>
     <input name="bandera" type="hidden"  value="<?php echo $a;?>" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>