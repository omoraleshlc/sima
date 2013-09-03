<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");


if($_POST['actualizar']!=NULL AND $_POST['name']!=NULL and $_POST['keyc']!=NULL ){
$sSQL1= "Select * From secondarymodules WHERE entidad='".$_POST['entidades']."' and keyc='".$_POST['keyc']."' and name='".$_POST['name']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select * From primarymodules WHERE  keyc='".$_POST['keyc']."' ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);


if(!$myrow1['keyc']){


$agrega = "INSERT INTO secondarymodules (keyc,
name,entidad,mainmodule,mainmodulename
) values ('".$_POST['keyc']."','".$_POST['name']."','".$_POST['entidades']."','si','".$myrow1a['menuname']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu agregado...';
} else {
//$q = "UPDATE secondarymodules set 
//
//name='".$_POST['name']."'
//
//WHERE 
//entidad='".$_POST['entidades']."'
//    and
//keyc='".$_POST['keyc']."' and
//name=    
//";
//mysql_db_query($basedatos,$q);
//echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Ya existe ese nombre...';
}
}






if($_POST['borrar'] AND $_POST['keySM']){
$borrame1 = "DELETE FROM secondarymodules WHERE keySM ='".$_POST['keySM']."'";
mysql_db_query($basedatos,$borrame1);
echo mysql_error();

 $borrame2 = "DELETE FROM primarymodules WHERE keySM ='".$_POST['keySM']."'";
//mysql_db_query($basedatos,$borrame2);
echo mysql_error();

 $borrame3 = "DELETE FROM extensionmodules WHERE keyc ='".$_GET['keyc']."'";
//mysql_db_query($basedatos,$borrame3);
echo mysql_error();

echo '<script >
window.alert( "SE ELIMINO EL SUBMODULO");
</script>'; 
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['keySM'] = "";
}


if($_GET['keySM']){
$sSQL2= "Select * From secondarymodules WHERE  keySM = '".$_GET['keySM']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}


$keyEntidades=$_POST['codigoEntidad'];


if($_POST['actualizar'] AND $keyEntidades ){
$sSQL1= "Select * From entidades WHERE codigoEntidad = '".$_POST['codigoEntidad']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoEntidad']){
if($_POST['codigoEntidad']!=$myrow1['codigoEntidad']){

$agrega = "INSERT INTO entidades (
codigoEntidad,descripcionEntidad,fechaApertura
) values ('".$_POST['codigoEntidad']."','".$_POST['descripcionEntidad']."','".$_POST['fechaApertura']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script ">
msgbox "SE AGREGO UNA ENTIDAD"
</script>'; 
}} else {
$q = "UPDATE entidades set 

descripcionEntidad='".$_POST['descripcionEntidad']."',
    fechaApertura='".$_POST['fechaApertura']."'

WHERE 
keyEntidades='".$keyEntidades."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script >
window.alert( "SE MODIFICO ENTIDAD");
</script>'; 
}
}

if($_POST['borrar'] AND $keyEntidades){
$borrame = "DELETE FROM entidades WHERE keyEntidades ='".$keyEntidades."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL MODULO RAIZ");
</script>'; 
}




if($_POST['codigoEntidad2']){
$sSQL2= "Select * From entidades WHERE keyEntidades = '".$_POST['codigoEntidad2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>



<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=630,height=800,scrollbars=YES")
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
 <h1 align="center">Catalogo Modulos Globales </h1>
 <br></br>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     
     
         <p>

    <span class="normalmid">
  

  </span>
  </p>
     
     

     
   <p>
     <label></label>
   </p>

   <table width="644" class="table-forma">

     
       
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td ><strong>Nombre Modulo Global</strong></td>
       <td ><span >
         <input name="name" type="text"  id="subModulo" value="<?php echo $myrow2['name'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       

       
       
       
       
     <tr >

       <td  colspan="3"><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit"  id="borrar" value="Eliminar SubM&oacute;dulo" />
         <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar Sub M&oacute;dulo" />
     
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" />
         </p></td>
     </tr>
   </table>

<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From mainmodules 
 where
global='si'
 order by name ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">

   <table width="519" class="table table-striped">
      
      <tr >
          <th width="5" align="left" >#</th>
      <th width="50" align="left" >Descripcion</th>
      <th width="10" align="left" >---</th>
      <th width="10" align="left" >---</th>
    </tr>
     
       <?php	while($myrow = mysql_fetch_array($result)){$b+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['keySM'];
?>
       <tr>

             <td bgcolor="<?php echo $color;?>" ><span >
         <label>
       <?php echo $b;?>
         </label>
       </span></td>
           
           
   
       

       <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php echo $myrow['name'];?>         
       </span>
       </td>
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="modulosSecundarios.php?mainmodulename=<?php echo $myrow['name'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $_POST['keyc']; ?>&amp;usuario=<?php echo $E; ?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="javascript:ventanaSecundaria('extensionmodules.php?global=si&mainmodulename=<?php echo $myrow['name'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Add
                    </a>
        
       </span>
       </td>           
           
        
     </tr>
     <?php }?>
   </table>
   
   
   
   
   

</form>

 <p align="center">&nbsp;</p>
</body>
</html>



















