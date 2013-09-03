<?php require("menuOperaciones.php"); ?>





<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","width=650,height=650,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaAgregar (URL){
   window.open(URL,"ventanaAgregar","width=1024d,height=800,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria10 (URL){
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES")
}
</script>
<?php
if($_GET['keyREPA'] AND $_GET['elimina']=='si'){

$q = "DELETE FROM beneficenciaDepartamentos WHERE entidad='".$entidad."' and departamento='".$_GET['departamento']."'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		echo '<span class="error"><blink>'.'Se eliminaron reporte(s)...'.'</blink></span>';

}
?>

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
 <h1 >&nbsp;</h1>
 <h1 >Catalogo de Pacientes Beneficencias con Expedientes</h1>
 <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

   <table width="605" class="table table-striped">
     <tr >
       <th width="24"  scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>
<th width="197"   scope="col"><div align="left" >
  <div align="left">Descripcion </div>
</div></th>
       <th width="59"  scope="col"><div align="left" >
         <div align="left">Usuario</div>
       </div></th>

       <th width="81"  scope="col"><div align="left" >
         <div align="left">Porcentajes</div>
       </div></th>

       <th width="59"  scope="col"><div align="left" >
         <div align="left">Elimina</div>
       </div></th>
     </tr>




        	    <?php


$sSQL= "Select * From beneficenciaDepartamentos where
entidad='".$entidad."'
    and
    departamento!=''
    group by departamento
order by departamento ASC";




 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$f+=1;

$sSQL3= "Select * From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['departamento']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>





     <tr >
       <td ><?php echo $f;?></td>
       <td ><span >

	   <?php echo $myrow3['descripcion'];?>
	   </span></td>
       <td ><span ><?php echo $myrow['usuario'];?></span></td>
       <td ><span >
        <a href="#" name="status<?php echo $f;?>" id="status<?php echo $f;?>" onClick="javascript:ventanaAgregar('../ventanas/ventanaCatalogoReportes.php?departamento=<?php echo $myrow['departamento']; ?>&keyBD=<?php echo $myrow['keyBD'];?>#status<?php echo $f;?>');"> Editar</a></span></td>
    

       <td >
	   <div align="center" >	    <span >

	   <a name="status<?php echo $f;?>" href="articulosBeneficencia.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&departamento=<?php echo $myrow['departamento']; ?>&elimina=si"><img src="../imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este reporte?') == false){return false;}" /></a>


	   </span></div></td>
     </tr>
     <?php }}?>
   </table>

<p>&nbsp;</p>
   <p align="center">
     <label>
     <input name="nuevo" type="button"  id="nuevo" value="Nueva Beneficencia"
	  onclick="ventanaSecundaria1('../ventanas/ventanaCatalogoReportes.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>')" />
     </label>
   </p>
</form>
 <p align="center">&nbsp;</p>
</body>
</html>