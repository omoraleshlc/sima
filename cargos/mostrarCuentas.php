<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php'); 
require ('/configuracion/clases/eFV.php'); 


function redondeado ($numero, $decimales) {
   $factor = pow(10, $decimales);
   return (round($numero*$factor)/$factor); } 
   
   
   
?>


<script language=javascript>
function ventanaSecundaria11 (URL){
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES")
}
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>



<?php
$sSQL7e="SELECT paciente,almacen,fechaCierre
FROM
clientesInternos
WHERE
folioVenta='".$FV."'
";
$result7e=mysql_db_query($basedatos,$sSQL7e);
$myrow7e = mysql_fetch_array($result7e);
?>
<body>
 <h1 align="center">
 <?php echo $_GET['descripcion'];  ?>

 </h1>
    <p align="center"><br />
    <?php

    $sSQL7ea="SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and
almacen='".$_GET['almacenDestino']."'
";
$result7ea=mysql_db_query($basedatos,$sSQL7ea);
$myrow7ea = mysql_fetch_array($result7ea);
echo $myrow7ea['descripcion'];

    ?>
    </p>
<form id="form2" name="form2" method="post" >
  <div align="center">

<?php
$sSQL= "Select * From faltantes where entidad='".$entidad."' and usuario='".$_GET['usuario']."'

and
keyPA='".$_GET['keyPA']."' 
and
almacenSolicitante='".$_GET['almacenDestino']."'
and
status='venta'
";
$result=mysql_db_query($basedatos,$sSQL);
?>

</div>
  <table width="514" border="0" align="center">
     <tr>
       <th width="75" ><div align="left"><span class="normalmid">Folio</span></div></th>
       <th width="251" ><div align="left"><span class="normalmid">Paciente</span></div></th>
       <th width="60" ><div align="left"><span class="normalmid">Hora</span></div></th>
       <th width="45" ><div align="left"><span class="normalmid">Fecha</span></div></th>
       <th width="61" ><div align="left"><span class="normalmid">Cantidad</span></div></th>
    </tr>

<?php
while($myrow = mysql_fetch_array($result)){

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



//*******************NORMAL***********************
//$sSQL7="SELECT sum(efectivo) as efectivos,sum(efectivo*porcentaje) as ivar
//FROM
//reportesFinancieros
//WHERE
//random='".$random."'
//and
//folioVenta='".$FV."'
//and
//gpoProducto='".$myrow['gpoProducto']."'
//and
//naturaleza='C'";
//$result7=mysql_db_query($basedatos,$sSQL7);
//$myrow7 = mysql_fetch_array($result7);
//
//$sSQL7d="SELECT sum(efectivo) as efectivos,sum(efectivo*porcentaje) as ivar
//FROM
//reportesFinancieros
//WHERE
//random='".$random."'
//and
//folioVenta='".$FV."'
//and
//gpoProducto='".$myrow['gpoProducto']."'
//and
//naturaleza='A' ";
//$result7d=mysql_db_query($basedatos,$sSQL7d);
//$myrow7d = mysql_fetch_array($result7d);
//
//$despliega='reportexGPOAD';
//****************************************************






$sSQL7c="SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos='".$myrow['keyClientesInternos']."'   ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);
?>
      	  <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
       <td bgcolor="<?php echo $color?>" class="normalmid"><span class="normal">

         <label>
         <?php echo $myrow7c['folioVenta'];?>
         </label>

       </span></td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
	   <span class="normal">
	   <?php echo $myrow7c['paciente'];?>	   </span>

          </td>
    <td bgcolor="<?php echo $color?>" class="normalmid">
    	   <?php


	  echo $myrow['hora1'];
	   ?>
    </td>
       <td bgcolor="<?php echo $color?>" class="normalmid">
           <?php echo cambia_a_normal($myrow['fecha1']); ?>
</td>
       <td bgcolor="<?php echo $color?>" class="normalmid"><div align="center">
         <?php echo $myrow['cantidad']; ?>

       </div></td>
     </tr>


    <?php

	}//cierra while?>


  </table>

  


</form>
 <p align="center">&nbsp;</p>
</body>
</html>