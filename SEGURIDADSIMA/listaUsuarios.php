<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=1000,height=800,scrollbars=YES")
}
</script>



<script>
    var myWindow;

function openCenteredWindow(url) {
    var width = 400;
    var height = 300;
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
    var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
    myWindow = window.open(url, "subWind", windowFeatures);
}
</script>



<?php  
if($_GET['usuario'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "DELETE FROM usuarios

		
		WHERE 
                
usuario='".$_GET['usuario']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}


}







if($_GET['usuario'] AND $_GET['erase']=='yes'){


$q = "DELETE FROM usersmodules

		
		WHERE 
                
usuario='".$_GET['usuario']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
echo '<div class="success">Modulos Eliminados!</div>';

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
    
<p align="center" >
    Usuarios Modulos
</p>
    
    
<form id="form1" name="form1" method="post" >
 
    <p>

    <span >
    <?php 
    if(!$_POST['entidades']){$_POST['entidades']=$_GET['entidades'];}
    require("/configuracion/componentes/comboEntidades.php");
	   $entidades=new despliegaEntidades();$entidades->listaEntidades($usuario,$basedatos);
	   ?>
  </span>
  </p>
    
    
	
  <table width="800" class="table table-striped">
<tr >
        <th width="5" align="center" >#</th>

      <th width="225" >Nombre, Apellido(s)</th>
      <th width="50" align="center" >Usuario</th>
      <th width="210" >FechaIngreso</th>
      <th width="110" >FechaSalida</th>
      <th width="50" ></th>
      <th width="50" ></th>
      <th width="50" ></th>
      <th width="50" ></th>
      
            <th width="50" ></th>
    </tr>
      
      
    <?php

if($_POST['entidades']){
$sSQL81= "
SELECT
 *
FROM
usuarios
where
entidad='".$_POST['entidades']."'
order by aPaterno asc
";
if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){
$a+=1;
$E=$myrow81['usuario'];
?>
  
      <tr >
                <td><span ><?php echo $a;?></span></td>

      
      <td><span >
	  
	  <?php echo $myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?>
    </td>
      
                
      <td><span ><?php echo $E;?></span></td>                
                
                
                
                
      <td><span >
<?php 

echo cambia_a_normal($myrow81['fecha']);
?>

          </span></td>
      
      
<td>
<?php 

$yearactual=substr($fecha1,0,4);
$lastin=substr($myrow81['fechaSalida'],0,4);
if($lastin<$yearactual){

echo '<span class="informativo"><blink>'.cambia_a_normal($myrow81['fechaSalida']).'</blink></span>';      
    
}else{

echo '<span >'.cambia_a_normal($myrow81['fechaSalida']).'</span>';
}
?>
</td>
    
      
            <td><span >
                    <a href="javascript:ventanaSecundaria('ventanaUsuariosModulos.php?entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Modulos
                    </a>
          </span></td>
      
                  <td><span >
                    <a href="javascript:ventanaSecundaria('ventanaModulosGlobales.php?entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    ModulosGlobales
                    </a>
          </span></td>
      
      
                        <td><span >
                    <a href="javascript:ventanaSecundaria('ventanaUsuarioRoles.php?entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    AsignarRoles
                    </a>
          </span></td>
      
      
      
                  <td><span >
                    <a href="javascript:ventanaSecundaria('modificaUsuarios.php?entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    EditarCuenta
                    </a>
          </span></td>
      
      
                    <td>
                    <span >
                    <a href="listaUsuarios.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&erase=yes&entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas quitar todos los modulos a este usuario?') == false){return false;}">
                    Reset
                    </a>
                    </span>
                    </td>
      
      

       <td><span >
      <a   href="listaUsuarios.php?usuario=<?php echo $E;?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&gpoProductos=<?php echo $_GET['gpoProductos'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>&entidades=<?php echo $_POST['entidades'];?>"> 
          <img src="../imagenes/btns/stopbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onMouseover="showhint('Presiona aqui para cambiar el status del articulo..', this, event, '150px')" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este registro?') == false){return false;}" /></a>
             </span></td>
      
      
    </tr><?php }}}?>
  </table>

<p>&nbsp;</p>

  </form>

  <p align="center">
    <input name="nuevo" type="button" class="style7" id="nuevo" value="Nuevo Usuario"  onclick="javascript:ventanaSecundaria('modificaUsuarios.php?nuevo=si&codigo=<?php echo $s; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $sE; ?>')"/>
  </p>    
    

</body>
</html>
