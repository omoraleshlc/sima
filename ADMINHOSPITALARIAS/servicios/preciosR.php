<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php $articulo = $_GET['nomArticulo']; ?>




<?php 
  if($_GET['nomArticulo'] and !$_GET['buscar']){
  $_GET['nomArticulo']=$_GET['nomArticulo'];
  $_GET['buscar']=='yes';
  }
?>







<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=400,scrollbars=YES") 
} 
</script> 





<?php 

if($_GET['modificar']=='yes' and $_GET['codigo'] and $_GET['modificado']=='yes'){

echo $q1 = "UPDATE articulos set 
descripcion='".$_GET['descripcion']."', 
usuario='".$usuario."',
fecha='".$fecha1."'
WHERE 
codigo='".$_GET['codigo']."'";
//mysql_db_query($basedatos,$q1);
echo mysql_error();


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {
	font-size: 9px;
	color: #FFFFFF;
}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style14 {color: #0000FF}
.style18 {font-size: 10px; font-style: italic; }
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center">LISTADO DE ARTICULOS </h1>
<form id="form2" name="form2" method="get" action="">
  <table width="684" border="1" align="center">
    <tr>
      <th width="22" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="156" scope="col"><div align="center"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="484" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="80" 
		  
		  value="<?php if($_GET['nomArticulo']){ echo $_GET['nomArticulo']; }?>"/>
        </span></div>
          <span class="style12">
            </select>
          </span></th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col"><label>
        <div align="left">
            <input name="buscar" type="submit" class="style12" id="buscar" value="buscar" />
            <?php if($_GET['nomArticulo']==='*'){ ?>
			<span class="style18">Este proceso puede demorar varios minutos...</span> 
			<?php } ?>
		</div>
          </label></th>
    </tr>
  </table>
</form>
<p align="center" class="style14">
  <?php	
if($_GET['nomArticulo']){  
$_GET['buscar']='yes';
}  
if(($_GET['buscar'] AND $_GET['nomArticulo'])){	  
	  $articulo = $_GET['nomArticulo'];

if($articulo){ 
if($articulo=='*'){ 
$sSQL="SELECT distinct * FROM articulos
where
 um<>'s'
 
 
 order by descripcion ASC";

} else {

$sSQL= "
SELECT distinct * FROM articulos
WHERE articulos.descripcion LIKE '%$articulo%' and
 articulos.um<>'s'
 
 
 order by articulos.descripcion ASC";
}
} 


if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
</p>
      <form id="form1" name="form1" method="get" action="">
  <p>&nbsp;</p>
  <table width="823" border="1" align="center">
    <tr>
      <th width="69" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="362" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="37" bgcolor="#660066" scope="col"><span class="style11">Almac&eacute;n</span></th>
      <th width="43" bgcolor="#660066" scope="col"><span class="style11">Particular</span></th>
      <th width="55" bgcolor="#660066" scope="col"><span class="style11">Aseguradora</span></th>
      <th width="105" bgcolor="#660066" scope="col"><span class="style11">Modificar A </span></th>
      <th width="106" bgcolor="#660066" scope="col"><span class="style11">Modificar D. </span></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
$totalRegistros+=1;

$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE
codigo = '".$code."'  
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
 $almacenes[$i]=$myrow51['almacen'];

  
  $sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE
codigo = '".$code."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$C=$myrow['codigo'];
 $sSQL7="SELECT *
FROM
  `clientesPrecios`
WHERE
codigo = '".$code."' and numCliente='".$_GET['seguro']."'  
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  if($myrow6['nivel1'] and $myrow6['nivel3']){
  $color='#0000FF';
  $estilo="style11";
  } else {
  $myrow6['nivel1']="Falta Precio";
  $myrow6['nivel3']="Falta Precio";
  $estilo="style12";
  }
  
  if($myrow6['nivel1']=="1" or $myrow6['nivel3']=="1"){
  $color='#FF0000';
  $estilo="style11";
  }

?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
  <?php echo $C?>        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="<?php echo $estilo;?>">
        <label>
		
			  
	  <?php 
	  
	  if($_GET['modificar']=="yes" and $_GET['codigo']==$C ){ 
$modificado="yes";
	  ?>

<input name="descripcion" type="text" class="style12" id="descripcion" value="<?php echo $myrow['descripcion'];?>" size="80" 
onchange="javascript:this.form.submit();"/>

<?php 
} else {
	  echo $myrow['descripcion'];
	  }
	  ?>
        </label>
		
      </span></td>
      <td bgcolor="#FFFFFF" class="style12"><div align="center"><span class="<?php echo $estilo;?>">
        
        
        <a href="javascript:ventanaSecundaria('listaAlmacenes.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_GET['seguro']; ?>&medico=<?php echo $_GET['medico']; ?>&usuario=<?php echo $usuario; ?>')">
          
      <img src="almacen.jpg" alt="Almacenes" width="20" height="20" border="0" /></a>
	  
	  </span></div></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="Estilo24"><span class="<?php echo $estilo;?>">
        <?php 
	  if($myrow6['nivel1']>"1"){
	  echo "$".number_format($myrow6['nivel1'],2); 
	  } else {
	  echo "Asignado manualmente";
	  }
	  
	  ?>
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"></a><span class="<?php echo $estilo;?>">
        <?php 
	  if($myrow6['nivel3']>"1"){
	  echo "$".number_format($myrow6['nivel3'],2); 
	  } else {
	  echo "Asignado manualmente";
	  }
	  
	  ?>
	  
      </span></td>
	  
	
	  
      <td bgcolor="<?php echo $color?>" class="style12">
	  <a href="precios.php?modificado=<?php echo $modificado; ?>&amp;nomArticulo=<?php echo $_GET['nomArticulo']; ?>&amp;modificar=<?php echo "yes"; ?>&amp;codigo=<?php echo $C; ?>">
<img src="si.png" alt="Modificar Art&iacute;culo" 
width="23" height="23" border="0"  
onclick="if(confirm('Deseas modificar el articulo <?php echo $myrow['descripcion'];?>?') == false){return false;}" /></a>
</td>
      <td bgcolor="<?php echo $color?>" class="style12"><a href="modificaA.php?nRequisicion=<?php echo $requisicion; ?>&amp;almacen=
		<?php echo $myrow13['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $ali; ?>"><img src="si.png" alt="Modificaci&oacute;n de Art&iacute;culos, M&aacute;ximo, M&iacute;nimo, Reorden.." width="23" height="23" border="0" /></a></td>
    </tr>
    <?php }}}?>
  </table>
  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />

	 <?php if($modificado=='yes'){	?>
	 <input name="modificado" type="hidden" id="bandera" value="<?php echo $modificado; ?>" />
	  <input name="codigo" type="hidden" id="bandera" value="<?php echo $C;?>" />
	  <input name="descripcion" type="hidden" id="bandera" value="<?php echo $_GET['descripcion'];?>" />
	  <input name="nomArticulo" type="hidden" id="bandera" value="<?php echo $_GET['nomArticulo'];?>" />
	  <input name="modificar" type="hidden" id="bandera" value="<?php echo 'yes';?>" />
	  <?php } ?>
  </p>
</form>
<?php if($totalRegistros){ ?>
<p align="center"><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>