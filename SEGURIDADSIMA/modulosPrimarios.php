<?php require("menuOperaciones.php");


if($_POST['actualizar']!=NULL AND $_POST['name']!=NULL and $_POST['menuname']!=NULL ){

$sSQL1a= "Select * From primarymodules WHERE  entidad='".$_POST['entidades']."' and 
    mainmenu='".$_POST['name']."' 
and
menuname='".$_POST['menuname']."'
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

//	1 	keyc 	int(5) 			No 	None 	AUTO_INCREMENT 	Change Change 	Drop Drop 	More Show more actions
//	2 	menuname 	varchar(30) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	3 	ruta 	varchar(100) 	utf8_spanish_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	4 	entidad 	varchar(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	5 	mainmenu 	varchar(100) 	utf8_spanish_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	6 	submenu 	char(2) 	utf8_spanish_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions

if(!$myrow1a['menuname']){


$agrega = "INSERT INTO primarymodules (
menuname,entidad,submenu,mainmenu,ruta,almacen
) values ('".$_POST['menuname']."','".$_POST['entidades']."','".$_POST['submenu']."','".$_POST['name']."','".$_POST['ruta']."','".$_POST['almacen']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu agregado...';
} else {
$q = "UPDATE primarymodules set 
almacen='".$_POST['almacen']."',
menuname='".$_POST['menuname']."',
    ruta='".$_POST['ruta']."',
        submenu='".$_POST['submenu']."'

WHERE 
keyc='".$_GET['keyc']."'
    
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Nombre del menu modificado...';
}
$_GET['keyc']=NULL;
}






if($_POST['borrar'] AND $_GET['keyc']){
$borrame = "DELETE FROM primarymodules WHERE keyc ='".$_GET['keyc']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL SUBMODULO");
</script>'; 
$_GET['keyc']=NULL;
}





if($_POST['nuevo']!=NULL){
    $_GET['keyc']=NULL;
}


if($_GET['keyc']!=NULL ){
$sSQL2= "Select * From primarymodules WHERE  keyc = '".$_GET['keyc']."' ";
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
 <h1 align="center">Catalogo Modulos Primarios </h1>
 <br></br>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     <input name="main" type="hidden"  id="borrar" value="<?php echo $_GET['main'];?>" />
     <input name="warehouse" type="hidden"  id="borrar" value="<?php echo $_GET['warehouse'];?>" />
     <input name="datawarehouse" type="hidden"  id="borrar" value="<?php echo $_GET['datawarehouse'];?>" />
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
       <td  scope="col">&nbsp;</td>
       <td >Modulo Principal</td>
       <td ><label>
         <?php	 	
if(!$_POST['name'])         {$_POST['name']=$_GET['name'];}

  $sqlNombre11 = "SELECT * from mainmodules
where
entidad='".$_POST['entidades']."'

ORDER BY name ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
         <select name="name"   onchange="javascript:this.form.submit();"/>         
        
         
         <option value="">---</option>
         <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
         <option 
		 <?php if($_POST['name']== $rNombre11["name"]){?>
		 selected="selected"
		  <?php } ?>
		  value="<?php echo $rNombre11["name"];?>"> <?php echo $rNombre11["name"];?></option>
         <?php } ?>
         </select>
      </label>
        </td>
       
       
     </tr>
       
       
       
       
       
       
       
       
       
       <tr >
       <td  scope="col">&nbsp;</td>
       <td >Almacen (Centro de Costo)</td>
       <td ><label>
         <?php	 	


  $sqlNombre11 = "SELECT * from almacenes
where
entidad='".$_POST['entidades']."'
and
activo='A' and miniAlmacen='No'
ORDER BY descripcion ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
         <select name="almacen"   />         
        
         
         <option value="">---</option>
         <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
         <option 
		 <?php if(($_POST['almacen']== $rNombre11["almacen"]) or ($myrow2['almacen']== $rNombre11["almacen"])){?>
		 selected="selected"
		  <?php } ?>
		  value="<?php echo $rNombre11["almacen"];?>"> <?php echo $rNombre11["descripcion"];?></option>
         <?php } ?>
         </select>
      </label>
         </td>
       
       
     </tr>
       
       
       
       
       
       
       
       
       
       
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td >Nombre Modulo Primario</td>
       <td ><span >
         <input name="menuname" type="text"  id="subModulo" value="<?php echo $myrow2['menuname'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       
       
  
       
       

                   <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td ><strong>Contiene SubMenus?</strong></td>
       <td ><span >
         <input name="submenu" type="checkbox"  id="subModulo" value="si" <?php if($myrow2['submenu']=='si'){echo 'checked=""';}?> />
       </span></td>
       
       
       
     </tr>
       
       
       
     <tr >

       <td colspan="3" ><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit"  id="borrar" value="Eliminar SubM&oacute;dulo" />
         <input name="actualizar" type="submit"  id="nuevo" value="Actualizar" />
         
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" />
       </p></td>
     </tr>
   </table>
 
<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From primarymodules 
 where
 entidad='".$_POST['entidades']."'
    and
    mainmenu='".$_POST['name']."'
 order by menuname ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">

   <table width="519" class="table table-striped">
      
      <tr >
          <th width="5" align="left" >#</th>
      <th width="50" align="left" >Descripcion</th>
      <th width="50" align="left" >Almacen</th>
      <th width="10" align="left" >SubMenus</th>
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
       <?php echo $myrow['menuname'];?>         
       </span>
       </td>
           
                  <td bgcolor="<?php echo $color;?>" >
           <span >
<?php 



$sqlNombre11a = "SELECT descripcion from almacenes
where
entidad='".$_POST['entidades']."'
and
almacen='".$myrow['almacen']."'
";
$resultaNombre11a=mysql_db_query($basedatos,$sqlNombre11a);
$rNombre11a=mysql_fetch_array($resultaNombre11a);
       echo $rNombre11a['descripcion'];
       
       ?>         
       </span>
       </td>
           
                             <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php echo $myrow['submenu'];?>         
       </span>
       </td>
       
       
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="modulosPrimarios.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $myrow['keyc']; ?>&name=<?php echo $_POST['name']; ?>&update=<?php echo $update;?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
          
           
        
     </tr>
     <?php }?>
   </table>
   
   
   
   
   
 
</form>
      <?php }?>
 <p align="center">&nbsp;</p>
</body>
</html>
