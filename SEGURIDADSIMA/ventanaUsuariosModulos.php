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

    $road=$_POST['road'];
    
    
    for($i=0;$i<=$_POST['bandera'];$i++){
        
        
        
        
        
if($road[0]>0){
  $sSQL3= "Select * From usersmodules WHERE entidad='".$_GET['entidades']."' AND

main = '".$_POST['mainmenu']."'
    and
    primario='".$_POST['menuname']."'
        and
        secondary='".$_POST['mainmodule']."'
            and
            extension='".$road[$i]."'
and
usuario='".$_GET['usuario']."'

";

$result3=mysql_db_query($basedatos,$sSQL3);

$myrow3 = mysql_fetch_array($result3);        
        
        
        
       if(!$myrow3['extension']){ 
$agrega = "INSERT INTO usersmodules (

main,primario,secondary,extension,usuario,entidad

) values (

'".$_POST['mainmenu']."','".$_POST['menuname']."','".$_POST['mainmodule']."',

'".$road[$i]."',

'".$_GET['usuario']."','".$_GET['entidades']."'

)";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
        $d= 'Permisos agregados...!';
    }else{
         $d= 'Ya existe...!';
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



if($quitar[$i]>0){

 $borrame = "DELETE FROM usersmodules WHERE keyum='".$quitar[$i]."'";

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

  <table width="612" class="table-forma">

    <tr>

      <th width="199"  scope="col"><span >Modulo Principal</span></th>
      <th width="199" scope="col"><span >Modulo Primario</span></th>

      <th width="200" scope="col"><span >Modulo Secundario</span></th>

    </tr>


    <tr>

      <td width="199" height="35" scope="col"><?php
 $aCombo= "Select * From primarymodules where
entidad='".$_GET['entidades']."'
    group by mainmenu
order by mainmenu ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 
?>
        <select name="mainmenu" multiple="multiple" size="10"   id="menuname" onChange="this.form.submit();" />

        <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
if($_POST['mainmenu'] ==$resCombo['mainmenu']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['mainmenu']; ?>"><?php echo $resCombo['mainmenu']; ?></option>
        <?php } ?>
      </select></td>
        

      <td width="199" scope="col"><?php
$aCombo= "Select * From primarymodules where
entidad='".$_GET['entidades']."'
    and
    mainmenu='".$_POST['mainmenu']."'
    group by menuname
order by mainmenu ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 
?>
        <select name="menuname" multiple="multiple" size="10"   id="almacenDestino" onChange="this.form.submit();" />
 
        <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
if($_POST['menuname'] ==$resCombo['menuname']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['menuname']; ?>"><?php echo $resCombo['menuname']; ?></option>
        <?php } ?>
      </select></td>
        


      <td width="200" scope="col"><?php
 $aCombo= "Select * From extensionmodules where
entidad='".$_GET['entidades']."'
   and mainmodulename='".$_POST['menuname']."'
group by mainmodule
";
$rCombo=mysql_db_query($basedatos,$aCombo); 
?>
        <select name="mainmodule" multiple="multiple"   id="mainmodule" size="10" onChange="this.form.submit();" />

        <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
if($_POST['mainmodule'] ==$resCombo['mainmodule']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['mainmodule']; ?>"><?php echo $resCombo['mainmodule']; ?></option>
      <?php } ?></td>

    </tr>

  </table>

<br />

  <?php echo '<blink>'.$leyenda.'</blink>'; ?>







<?php if($_POST['mainmenu']!=NULL and $_POST['menuname']!=NULL and $_POST['mainmodule']!=NULL){ ?>
    

    
<input type="submit" name="set" value="Poner Todos" 
>
    
<input type="submit" name="unset" value="Quitar Todos" 
       >


 <br />   
<br />
  <table width="480" class="table table-striped">

    <tr>

      <th width="38" ><div align="left"><span >#</span></div></th>
      


      <th width="275" ><span align="left" >Descripcion</span></th>

      <th width="47" ><div align="left"><span >Agregar</span></div></th>

      <th width="52" ><div align="left"><span >Quitar</span></div></th>

   

    </tr>


<?php



$sSQL= "Select * From extensionmodules Where entidad='".$_GET['entidades']."'
   
and 
mainmodulename='".$_POST['menuname']."'
and

mainmodule='".$_POST['mainmodule']."'
    order by  name ASC
";

$result=mysql_db_query($basedatos,$sSQL);



while($myrow = mysql_fetch_array($result)){

$a+=1;

$codig=	  $myrow['codigo'];

//echo $myrow['total'];



$bandera += 1;



  $sSQL3= "Select * From usersmodules WHERE entidad='".$_GET['entidades']."' AND

main = '".$_POST['mainmenu']."'
    and
    primario='".$_POST['menuname']."'
        and
        secondary='".$_POST['mainmodule']."'
            and
            extension='".$myrow['keyEM']."'
and
usuario='".$_GET['usuario']."'

";

$result3=mysql_db_query($basedatos,$sSQL3);

$myrow3 = mysql_fetch_array($result3); 
?>

      <tr  >
              <td ><div align="left"><span ><?php echo $a;?></span></div></td>


 <td height="24"  ><span ><?php echo $myrow['name'];
 
echo '<br>';
		echo $myrow['ruta'];


 ?></span></td>
 

 <td bgcolor="<?php echo $color;?>" >   <span ><label>

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



  <p align="center">

    <input name="agregar" type="submit"  id="agregar" value="Agregar M&oacute;dulos" />

    <label></label>

    <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />

	   <input name="bandera" type="hidden"  id="bandera" value="<?php echo $a;?>" />

</p>



</form>

<p>&nbsp;</p>


<?php } ?>


</body>

</html>