<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");


if($_POST['actualizar']!=NULL AND $_POST['name']!=NULL and $_POST['entidades']!=NULL ){
$sSQL1= "Select * From mainmodules WHERE entidad='".$_POST['entidades']."' and name='".$_POST['name']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


if(!$myrow1['name']){


$agrega = "INSERT INTO mainmodules (
name,entidad,ruta
) values ('".$_POST['name']."','".$_POST['entidades']."','".$_POST['ruta']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu agregado...';
} else {
$q = "UPDATE secondarymodules set 

name='".$_POST['name']."',ruta='".$_POST['ruta']."'

WHERE 
entidad='".$_POST['entidades']."'
    and
name='".$_POST['name']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu modificado...';
}
}






if($_POST['borrar'] AND $_GET['keymm']){
$borrame = "DELETE FROM mainmodules WHERE keymm ='".$_GET['keymm']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL MODULO PRINCIPAL");
</script>'; 
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['keySM'] = "";
}


if($_GET['keymm']){
$sSQL2= "Select * From mainmodules WHERE  keymm = '".$_GET['keymm']."' ";
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
 <h1 >Catalogo Modulos Principales </h1>
 <br></br>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     
     
         <p>

    <span >
    <?php
    if(!$_POST['entidades']) {$_POST['entidades']=$_GET['entidades'];}
    require("/configuracion/componentes/comboEntidades.php");
	   $entidades=new despliegaEntidades();$entidades->listaEntidades($usuario,$basedatos);
	   ?>
  </span>
  </p>
     
     
     <?php if($_POST['entidades']!=NULL){?>
     
     
   <p>
     <label></label>
   </p>

   <table width="644" class="table-forma">

  
       
       
            <tr >
   
       <td ><strong>Nombre Modulo Principal</strong></td>
       <td ><span >
         <input name="name" type="text"  id="subModulo" value="<?php echo $myrow2['name'] ?>" size="45" />
       </span></td>
       
       
         
       <td ><strong>Ruta</strong></td>
              <td ><span >
         <input name="ruta" type="text"  id="subModulo" value="<?php echo $myrow2['ruta'] ?>" size="45" />
       </span></td>
     
     </tr>
       

       
       
       
       
     <tr >
      <td  colspan="4"><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit"  id="borrar" value="Eliminar SubM&oacute;dulo" />
         <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar Sub M&oacute;dulo" />
         
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" /></p>
         </td>
     </tr>
   </table>

<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From mainmodules 
 where
 entidad='".$_POST['entidades']."'
     
 order by name ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
   <table width="519" class="table table-striped">
      
      <tr >
          <th width="5" align="left" >#</th>
      <th width="50" align="left" >Descripcion</th>
       <th width="50" align="left" >Ruta</th>
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
       <?php echo $myrow['ruta'];?>         
       </span>
       </td>
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="modulosPrincipales.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawwrehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keymm=<?php echo $myrow['keymm']; ?>&keyc=<?php echo $_POST['keyc']; ?>&amp;usuario=<?php echo $E; ?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
         
           
        
     </tr>
     <?php }?>
   </table>
   
   
   
   
   

</form>
 <?php } ?>
 <p align="center">&nbsp;</p>
</body>
</html>
