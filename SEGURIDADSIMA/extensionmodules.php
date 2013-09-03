<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php
if($_GET['keySM']){
$sSQL2= "Select * From secondarymodules WHERE  keySM = '".$_GET['keySM']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}

//	1 	keyEM 	int(11) 			No 	None 	AUTO_INCREMENT 	Change Change 	Drop Drop 	More Show more actions
//	2 	keyc 	int(11) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	3 	name 	varchar(100) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	4 	ruta 	varchar(250) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	5 	entidad 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	6 	mainmodule 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	7 	mainmodulename 	varchar(100) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions

if($_POST['actualizar']!=NULL AND $_POST['name']!=NULL and $_POST['ruta']!=NULL ){
    
    
    
    
    
    
    
    
 $sSQL1= "Select * From extensionmodules WHERE keyEM='".$_GET['keyEM']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

	


if(!$myrow1['keyc']){
    
    
    
if($_GET['global']=='si'){
    $myrow2['mainmodulename']=$_GET['mainmodulename'];
}    






$agrega = "INSERT INTO extensionmodules (keyc,
name,entidad,mainmodule,mainmodulename,ruta,global
) values ('".$myrow2['keyc']."','".$_POST['name']."','".$_GET['entidades']."',
    '".$myrow2['name']."','".$myrow2['mainmodulename']."','".$_POST['ruta']."',
        'si')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu agregado...';
} else {
$q = "UPDATE extensionmodules set 
ruta='".$_POST['ruta']."',
name='".$_POST['name']."'

WHERE 
keyEM='".$_GET['keyEM']."'
    
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu modificado...';
}
}






if($_POST['borrar'] AND $_GET['keyEM'] and $_POST['name'] and $_POST['ruta']){
$borrame = "DELETE FROM extensionmodules WHERE keyEM ='".$_GET['keyEM']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO LA EXTENSION");
</script>'; 
}

if($_POST['nuevo']){
/** checo si existe**/
$_GET['keyEM'] = "";
}






if($_GET['keyEM']){
$sSQL2a= "Select * From extensionmodules WHERE  keyem = '".$_GET['keyEM']."' ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>
 <h1 align="center">Modulos y Extensiones </h1>

    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     
 
     
   <p>
     <label></label>
   </p>

   <table width="600" class="table-forma">

            <tr >
       <td  scope="col">&nbsp;</td>
       <td >Modulo Principal</td>
       <td ><label>
       <?php echo $myrow2['mainmodulename'];?>
       </label>
         </td>
       
       
     </tr>
       
       
     <tr >
       <td  scope="col">&nbsp;</td>
       <td >Modulo Secundario</td>
       <td ><label>
       <?php echo $myrow2['name'];?>
    </label>
         </td>
       
       
     </tr>
       
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td >Nombre Extension</strong></td>
       <td ><span >
         <input name="name" type="text"  id="subModulo" value="<?php echo $myrow2a['name'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td >Ruta</td>
       <td ><span >
         <input name="ruta" type="text"  id="subModulo" value="<?php echo $myrow2a['ruta'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       
       
       
       
     <tr >

       <td colspan="3" ><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
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
 $sSQL= "Select * From extensionmodules 
 where
entidad='".$_GET['entidades']."'
    and
mainmodule='".$myrow2['name']."'
and
mainmodulename='".$myrow2['mainmodulename']."'
order by name ASC    
";
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
                    <a href="extensionmodules.php?global=<?php echo $_GET['global'];?>&mainmodulename=<?php echo $_GET['mainmodulename'];?>&entidades=<?php echo $_GET['entidades'];?>&keySM=<?php echo $_GET['keySM']; ?>&keyEM=<?php echo $myrow['keyEM']; ?>&amp;usuario=<?php echo $E; ?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
          
           
        <input name="keyEM[]" type="hidden"  id="subModulo" value="<?php echo $myrow2a['keyEM'] ?>" size="55" />
     </tr>
     <?php }?>
   </table>
   

</form>

 

 
 
   <script>
		new Autocomplete("name", function() {
			this.setValue = function( id ) {
				document.getElementsByName("ruta")[0].value = id;
			}

			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/modulesextensionsx.php?mainmodule=<?php echo $myrow2['name'];?>&mainmodulename=<?php echo $myrow2['mainmodulename'];?>&entidad=<?php echo $entidad;?>&almacen=<?php echo $ALMACEN;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>
</body>
</html>
