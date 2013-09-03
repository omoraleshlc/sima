<?php include('/configuracion/ventanasEmergentes.php'); ?>
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
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción de este almacen!")   
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
if($_POST['actualizar'] AND $_POST['almacen'] ){
$sSQL1= "Select * From almacenes WHERE almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){

$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,id_medico
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'No','Si','".$_POST['almacenDestino']."','A','no','".$_GET['medico']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ALMACEN AGREGADO EXITOSAMENTE "
</script>';
?>
<script>
close();
   </script>
   <script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<?php 
}} else {
$q = "UPDATE almacenes set 
descripcion='".$_POST['descripcion']."', 
tieneCuartos='".$_POST['tieneCuartos']."',
ctaContable='".$_POST['ctaContable']."',
usuario='".$usuario."',
fecha1='".$fecha1."',
ID_CCOSTO='".$_POST['ctaContable']."',
modulo='".$_POST['modulo']."',
activo='".$_POST['activo']."',
miniAlmacen='".$_POST['miniAlmacen']."',almacenPadre='".$_POST['almacenDestino']."',
stock='".$_POST['stock']."'
WHERE 
almacen='".$_POST['almacen']."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "YA EXISTE EL ALMACEN "
</script>';
?>
<script>
close();
   </script>
   <script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<?php 
}
}

if($_POST['borrar'] AND $_POST['almacen']){
$borrame = "DELETE FROM almacenes WHERE almacen ='".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
$borrame1 = "DELETE FROM usuariosAlmacenes WHERE almacen ='".$_POST['almacen']."' and usuario='".$usuario."'";
mysql_db_query($basedatos,$borrame1);

echo mysql_error();
echo '<script type="text/vbscript">
msgbox "ESTE ALMACEN HA SIDO ELIMINADO: "
</script>';
}

if($_POST['agregar']){
/** checo si existe**/
$_POST['almacen'] = "";
}


if($_POST['almacen2'] AND !$_POST['nuevo']){
$sSQL2= "Select * From almacenes WHERE almacen = '".$_POST['almacen2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>
 <h1 align="center">M&eacute;dicos Almac&eacute;n(Cto. Costo) </h1>
 <form id="form1" name="form1" method="post" action="" >
   <p align="center">
     <label>
	 <?php
	 $sSQL1= "Select * From medicos WHERE numMedico= '".$_GET['medico']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['nombre1']." ".$myrow1['apellido1']." ".$myrow1['apellido2'];
	 ?>
	 </label>
   </p>
   <table width="513" border="0" align="center">
 
       <th width="119" bgcolor="#FFCCFF" class="style12" scope="col">
	   <div align="left">C&oacute;digo</div></th>
       <th width="357" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left">
           <input name="almacen" type="text" class="style12" id="almacen" value="<?php echo $myrow2['almacen']?>" 
size="60" <?php if($myrow2['almacen']){ echo 'readonly=""';}?> autocomplete="off"/>
         </div></th></tr>
     <tr>
       <td class="style12">Descripci&oacute;n del Procedimiento:</td>
       <td class="style12"><input name="descripcion" type="text" class="style12" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="60" autocomplete="off"></td>
     </tr>
     <tr>
       <td class="style12">Cto. Costo: </td>
       <td class="style12"><span class="Estilo24">
         <input name="ctaContable" type="text" class="Estilo24" id="ctaContable" 
	   value ="<?php echo $myrow2['ctaContable']?>" readonly=""/>
         <input name="ID_CCOSTO" type="button" class="Estilo24" id="ID_CCOSTO"  onclick="javascript:ventanaSecundaria1('/sima/cargos/ctoCosto.php?numeroE=<?php echo $numPaciente; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;campoSeguro=<?php echo "ctaContable"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="C">
       </span></td>
     </tr>
    
       <td bgcolor="#FFCCFF" class="style12">Activo:</td>
       <td bgcolor="#FFCCFF" class="style12"><select name="activo" class="Estilo24" id="activo">
        
         <option
		 <?php if($myrow2['activo']=="A"){ ?>
		 selected="selected"
		 <?php } ?>
		  value="A">A</option>
         <option
		  <?php if($myrow2['activo']=="I"){ ?>
		  selected="selected"
		  <?php } ?>
		  value="I">I</option>
       </select></td>
     </tr>
	 
	 
	 


	
	 
	
     <tr>
       <td class="style12">Almac&eacute;n Prinicipal </td>
       <td class="style12"><span class="Estilo24">
         <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenSS('style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
</span></td>
     </tr>
			
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12"><span class="Estilo24">
       <input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Agregar Almac&eacute;n" />
         </span>
</td>
     </tr>
   </table>
   <p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_POST['almacen2'];?>" />
   </p>
 </form>

 <p align="center">&nbsp;</p>
</body>
</html>