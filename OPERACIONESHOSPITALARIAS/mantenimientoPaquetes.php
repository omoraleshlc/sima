<?PHP require("menuOperaciones.php"); ?>
<?php
$ventana1='ventanaCatalogoPaquetes.php';
$ventana2='/sima/cargos/ventanitaCambiaPrecioPaquete.php';
$ventana3='despliegaArticulosPaquetes.php';
?>

<?php 
$ventanaCenter=new windowCenter();
echo $ventanaCenter->mainmenu();
?>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<?php





if($usuario AND $entidad AND $_GET['del']){
$borrame = "DELETE FROM paquetes
WHERE 
keyPAQ='".$_GET['keyPAQ']."'
";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$yes='si';
}else{
$yes='no';
}



?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=220,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria21 (URL){ 
   window.open(URL,"ventana21","width=450,height=220,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=900,height=800,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria23 (URL){ 
   window.open(URL,"ventana23","width=900,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventanaSecundaria6","width=1000,height=1000,scrollbars=YES")
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>



</head>

<body>
 <h1  class="titulos">Lista de Paquetes<br /></h1>
 <div align="center"><h3 class="error">(Precio NO INCLUYE IVA) </h3></div>
<p>
   <?php   
 $sSQL= "Select * From paquetes where entidad='".$entidad."'  order by descripcionPaquete ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">
<div id="divContainer">
   <table width="500" class="formatHTML5">
     <tr >
       <th width="5"  scope="col"><div align="left" >#</div></th>
       <th width="258"  scope="col"><div align="left" >Descripci&oacute;n</div></th>
       <th width="99"  scope="col"><div align="left" >Precio Normal </div></th>
       <th width="73"  scope="col"><div align="left" >Fact C</div></th>
       <th width="73"  scope="col"><div align="left" >Editar</div></th>
       <th width="36"  scope="col"><div align="left" >Lista</div></th>
       <th width="50"  scope="col"><div align="left" >Agrega</div></th>
       <th width="56"  scope="col"><div align="left" >Eliminar</div></th>
     </tr>
     <tr>
       <?php	while($myrow = mysql_fetch_array($result)){
$a+=1;
$sSQL7="SELECT SUM(precioPaquete1) as particular,SUM(precioPaquete3) as seguro
FROM
articulosPaquetes
WHERE entidad='".$entidad."' AND
codigoPaquete = '".$myrow['codigoPaquete']."' 
";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
  $sSQL6="SELECT *
FROM
articulosPrecioNivel
WHERE 
entidad='".$entidad."' 
AND
codigo = '".$codigo."' 
AND
almacen='".$myrow7."' 
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
?>
    <tr   >
       <td >
         <label>
    <?php echo $a;?>         </label>
       </span></td>
       <td  >
	   <?php echo $myrow['descripcionPaquete'];?></span></td>


<td   align="right"><?php echo "$".number_format($myrow7['particular'],2);?></td>
<td  ><div align="center"><a href="#" onClick="wopen('../ventanas/agregarSegurosFac.php?keyPAQ=<?php echo $myrow['keyPAQ']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>','popup',600,300);">
            Editar
        </a>
    </div>
</td>

       <td  ><div align="center"><a href="#" onClick="wopen('../ventanas/ventanaCatalogoPaquetes.php?keyPAQ=<?php echo $myrow['keyPAQ']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&numCliente=<?php echo $N?>','popup',600,300)">
                   <img src="../imagenes/btns/editbtn.png" alt="EDITAR CLIENTE <?php echo $myrow['nomCliente'];?>" width="22" height="22" border="0" />
               </a>
           </div></td>
       <td  ><div align="center"><span > <a href="#" onClick="wopen('<?php echo $ventana3;?>?codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>','popup',800,800)"> 
                       <img src="../imagenes/btns/listbtn.png" alt="Listado de Art&iacute;culos" width="22" height="22" border="0" /> 
                   </a> 
               </span>
           </div>
       </td>
       <td  ><div align="center"><span >
	   
<a href="#" onClick="wopen('../ventanas/agregarArticulos.php?codigoPaquete=<?php echo $myrow['codigoPaquete'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>','popup',900,900)"> 
		<img src="../imagenes/btns/addbtn2.png" alt="Listado de Art&iacute;culos" width="22" height="22" border="0" /> </a> </span></div></td>
       <td bgcolor="<?php echo $color;  ?>" ><div align="center">
	   
	   <a href="<?php echo $_SERVER['PHP_SELF']?>?codigo=<?php echo $code; ?>&amp;keyPAQ=<?php echo $myrow['keyPAQ'];?>&amp;activa=<?php echo "activa"; ?>&amp;del=<?php echo $yes; ?>">
	   <img src="../imagenes/btns/cancelabtn.png" alt="INACTIVO" width="22" height="22" border="0"  onclick="if(confirm('�Est�s seguro que deseas eliminar el paquete <?php echo $myrow['descripcionPaquete'];?>?') == false){return false;}" /></a></div></td>
     </tr>
     <?php }?>
   </table>
</div>
</form>
 <p align="center">
   <input name="nuevo" type="button" src="../imagenes/btns/activpaq.png" id="nuevo" value="NuevoPaquete"
	  onclick="wopen('../ventanas/ventanaCatalogoPaquetes.php','popup',600,400);" />
 </p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
</body>
</html>