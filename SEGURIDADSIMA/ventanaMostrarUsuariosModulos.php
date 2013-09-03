<?php require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>
<script language=javascript>
function ventanaSecundaria20 (URL){
   window.open(URL,"ventanaSecundaria20","width=630,height=800,scrollbars=YES")
}
</script>













<?php

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//if($_POST['agregar']){
//
//$secundario=$_POST['secundario'];
//
//
//
//
//
//for($i=0;$i<=$_POST['bandera'];$i++){
//
//
//
//if($secundario[$i]){
//
// $sSQL3= "Select * From ModulosUsuarios1 WHERE entidad='".$_GET['entidades']."' AND
//
//raiz = '".$_POST['moduloRaiz']."'
//
//and
//
//usuario='".$_GET['usuario']."'
//
//and
//
//secundario = '".$secundario[$i]."'";
//
//$result3=mysql_db_query($basedatos,$sSQL3);
//
//$myrow3 = mysql_fetch_array($result3);
//
//
//
//
//
//if(!$myrow3['keyMU']){
//
//
//
//$agrega = "INSERT INTO ModulosUsuarios1 (
//
//raiz,secundario,usuario,fecha,entidad
//pero 
//) values (
//
//'".$_POST['moduloRaiz']."',
//
//'".$secundario[$i]."',
//
//'".$_GET['usuario']."','".$fecha1."','".$_GET['entidades']."'
//
//)";
//
//mysql_db_query($basedatos,$agrega);
//
//echo mysql_error();
//
//}else{
//
//$leyenda='Ya existe ese modulo';
//
//}
//
//}
//
//}
//
//}
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



?>


<?php

//
//
//if($_POST['agregar']){
//
//    $road=$_POST['road'];
//    
//    
//    for($i=0;$i<=$_POST['bandera'];$i++){
//        
//        
//        
//        
//        
//if($road[0]>0){
//  $sSQL3= "Select * From usersmodules WHERE entidad='".$_GET['entidades']."' AND
//
//main = '".$_POST['mainmenu']."'
//    and
//    primario='".$_POST['menuname']."'
//        and
//        secondary='".$_POST['mainmodule']."'
//            and
//            extension='".$road[$i]."'
//and
//usuario='".$_GET['usuario']."'
//
//";
//
//$result3=mysql_db_query($basedatos,$sSQL3);
//
//$myrow3 = mysql_fetch_array($result3);        
//        
//        
//        
//       if(!$myrow3[0]){ 
//$agrega = "INSERT INTO usersmodules (
//
//main,primario,secondary,extension,usuario,entidad
//
//) values (
//
//'".$_POST['mainmenu']."','".$_POST['menuname']."','".$_POST['mainmodule']."',
//
//'".$road[$i]."',
//
//'".$_GET['usuario']."','".$_GET['entidades']."'
//
//)";
//
//mysql_db_query($basedatos,$agrega);
//
//echo mysql_error();
//        $d= 'Permisos agregados...!';
//    }else{
//         $d= 'Ya existe...!';
//    }
//    }
//    }
//    
//    
//    $tipoMensaje='registrosAgregados';
//$encabezado='Exitoso';
//$texto=$d;
//    
//    
//}



?>










<?php

if($_POST['borrar']!=NULL AND $_POST['quitar']!=NULL and $_GET['usuario']!=NULL){



$quitar=$_POST['quitar'];



for($i=0;$i<=$_POST['bandera'];$i++){



if($quitar[$i]>0){

$borrame = "DELETE FROM usersmodules WHERE keyum='".$quitar[$i]."'";

//mysql_db_query($basedatos,$borrame);

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

  <span >Permisos Usuarios Modulos</span></p>





   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label> 



<label>

<form  name="myform" method="post" >



  </label>

  

    
    
    
    
    
    
  <p align="center">

  <?php echo '<blink>'.$leyenda.'</blink>'; ?>

  &nbsp;</p>



  <table width="480" class="table table-striped">

    <tr>

      <th width="38" ><div align="left"><span >#</span></div></th>
      


      <th width="275" ><span align="left" >Descripcion</span></th>

      <th width="47" ><div align="left"><span >Agregar</span></div></th>

      <th width="52" ><div align="left"><span >Quitar</span></div></th>

   

    </tr>





<?php



 $sSQL= "Select * From usersmodules Where entidad='".$_GET['entidades']."'
and
usuario='".$_GET['usuario']."'
    group by  mainmodule
    order by  secondary ASC
";

$result=mysql_db_query($basedatos,$sSQL);



while($myrow = mysql_fetch_array($result)){

$a+=1;

$codig=	  $myrow['codigo'];

//echo $myrow['total'];



$bandera += 1;



  $sSQL3= "Select * From extensionmodules WHERE entidad='".$_GET['entidades']."' AND


and
usuario='".$_GET['usuario']."'
mainmodulename='".$myrow['mainmodule']."'
    and
    mainmodule='".$myrow['mainmodulename']."'
";

$result3=mysql_db_query($basedatos,$sSQL3);

$myrow3 = mysql_fetch_array($result3); 
?>





      <tr >
              <td ><div align="left"><span ><?php echo $a;?></span></div></td>





 <td height="24"  ><span ><?php echo $myrow['main'];
 
echo '<br>';
		echo $myrow['primario'];
echo '<br>';
		echo $myrow['secondary'];
                

 ?></span></td>
 
 
 
 

 <td bgcolor="<?php echo $color;?>" ><div align="center"><span >

 </span></div>   <span ><label>

        <div align="center">
<?php 
if($myrow3['keyum']!=NULL){
 echo '---';    
 }else{ ?>
    
    <input name="road[]" type="checkbox"   value="<?php echo $myrow['keyEM'];?>" <?php if($_POST['set']!=NULL){echo  'checked=""';}?>/>
<?php }   ?>                

        </div>

   </label>

 </span> </td>
 
 
 
              
              
              
              

 <td bgcolor="<?php echo $color;?>" ><div align="center"><span >

 </span></div>   <span ><label>

        <div align="center">
<?php if($myrow3[0]!=NULL){?>
                   <input name="quitar[]" type="checkbox"   value="<?php echo $myrow3['keyum'];?>" <?php if($_POST['unset']!=NULL){echo  'checked=""';}?>/>
<?php }else{
    echo '---';    
}   ?>   
        </div>

   </label>

 </span> </td>
              
              
              
              
             



    </tr>

    <?php }?>

  </table>


<?php if($a>0){
echo '<p align="center">

    <input name="agregar" type="submit"  id="agregar" value="Agregar M&oacute;dulos" />

    <label></label>

    <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />

	  

</p>';
}?>

 <input name="bandera" type="hidden"  id="bandera" value="<?php echo $a;?>" />
</form>

<p>&nbsp;</p>





</body>

</html>