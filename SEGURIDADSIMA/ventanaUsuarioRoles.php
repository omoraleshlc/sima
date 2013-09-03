<?php require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>
<script language=javascript>
function ventanaSecundaria20 (URL){
   window.open(URL,"ventanaSecundaria20","width=630,height=800,scrollbars=YES")
}
</script>













<?php



?>


<?php



if($_POST['agregar']){
$codigoRol=$_POST['codigoRol'];

for($i=0;$i<=$_POST['bandera'];$i++){
    
    
if($codigoRol[$i]!=NULL){
$sSQL3= "Select * From usersmodules WHERE entidad='".$_GET['entidades']."' 
    AND
usuario='".$codigoRol[$i]."' 
and
rol='si'
";

$result3=mysql_db_query($basedatos,$sSQL3);

while($myrow3 = mysql_fetch_array($result3)){


        
    if($myrow3['secondary']!=NULL){
    
$sSQL3a= "Select * From usersmodules WHERE entidad='".$_GET['entidades']."' AND

main = '".$myrow3['main']."'
    and
    primario='".$myrow3['primario']."'
        and
        secondary='".$myrow3['secondary']."'
            and
            extension='".$myrow3['extension']."'
and
usuario='".$_GET['usuario']."'

";

$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


/*
keyum
main
primario
secondary
extension
usuario
entidad
global
ro
 * 
 */


if(!$myrow3a['mainmenu']  ){ 
 $agrega = "INSERT INTO usersmodules (

main,primario,secondary,extension,usuario,entidad,rol,codigoRol

) values (

'".$myrow3['main']."','".$myrow3['primario']."','".$myrow3['secondary']."',

'".$myrow3['extension']."',

'".$_GET['usuario']."','".$_GET['entidades']."','si','".$codigoRol[$i]."'

)";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
        $d= 'Permisos agregados...!';
    }else{
         $d= 'Ya existe...!';
    }
    }
}
} 
} 
    
    $tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto=$d;
    
    
}



?>










<?php

if($_POST['borrar']!=NULL AND $_POST['quitar']!=NULL and $_GET['usuario']!=NULL){



$quitar=$_POST['quitar'];



for($i=0;$i<=$_POST['bandera'];$i++){



if($quitar[$i]){

$borrame = "DELETE FROM usersmodules WHERE entidad='".$_GET['entidades']."' and usuario='".$_GET['usuario']."' and 
    
codigoRol='".$quitar[$i]."'";

mysql_db_query($basedatos,$borrame);

echo mysql_error();

$d = "Se elimino el modulo(s)";



 }


}
    $tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto=$d;
}

?>




<SCRIPT LANGUAGE="JavaScript">
<!-- 	
// by Nannette Thacker
// http://www.shiningstar.net
// This script checks and unchecks boxes on a form
// Checks and unchecks unlimited number in the group...
// Pass the Checkbox group name...
// call buttons as so:
// <input type=button name="CheckAll"   value="Check All"
	//onClick="checkAll(document.myform.list)">
// <input type=button name="UnCheckAll" value="Uncheck All"
	//onClick="uncheckAll(document.myform.list)">
// -->

<!-- Begin
function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//  End -->
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8" />
<head>



<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>

<p align="center">

  <label></label>
  <br></br>
  <br></br>
  <span >Roles de Usuario</span></p>





   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label> 





<form  name="myform" method="post" >





  
  <?php echo '<blink>'.$leyenda.'</blink>'; ?>




<br></br>

  <table width="480" class="table table-striped">

    <tr>

      <th width="38" ><div align="left"><span >#</span></div></th>
      


      <th width="275" ><span align="left" >Descripcion</span></th>

      <th width="47" ><div align="left"><span >Agregar</span></div></th>

      <th width="52" ><div align="left"><span >Quitar</span></div></th>

   

    </tr>


<?php



$sSQL= "Select * From roles where entidad='".$entidad."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL);



while($myrow = mysql_fetch_array($result)){

$a+=1;

$codig=	  $myrow['codigo'];

//echo $myrow['total'];



$bandera += 1;

$sSQL3a= "Select rol From usersmodules WHERE entidad='".$_GET['entidades']."' AND

usuario='".$_GET['usuario']."'
and
rol='si'
group by rol
";

$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
?>

      <tr  >
              <td ><div align="left"><span ><?php echo $a;?></span></div></td>

           
 <td height="24"  ><span ><?php echo $myrow['descripcion'];
 
echo '<br>';
		echo $myrow['ruta'];


 ?></span></td>
 

 <td bgcolor="<?php echo $color;?>" >   <span ><label>

        <div align="center">
<?php 
if(!$myrow3a['rol']){?>
 
 <input name="codigoRol[]" type="checkbox"   value="<?php echo $myrow['codigoRol'];?>" />
 <?php }else{ 
 echo '---';       
    
}   ?>                

        </div>

   </label>

 </span> </td>
 

 <td bgcolor="<?php echo $color;?>" ><div align="center"><span >

 </span></div>   <span ><label>

        <div align="center"><?php 
if($myrow3a['rol']){?>
                   <input name="quitar[]" type="checkbox"   value="<?php echo $myrow['codigoRol'];?>" />
<?php }else{
    echo '---';    
}   ?>   
        </div>

   </label>

 </span> </td>
              

    </tr>

    <?php }?>

  </table>


<?php if($a>0){?>
  <p align="center">

    <input name="agregar" type="submit"  id="agregar" value="Agregar M&oacute;dulos" />

    <label></label>

    <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />

	   <input name="bandera" type="hidden"  id="bandera" value="<?php echo $a;?>" />

</p>
<?php }else{ ?>
<div class="error">No se encontraron registros!</div>
<?php } ?>
</form>

<p>&nbsp;</p>





</body>

</html>