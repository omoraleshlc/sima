<?php //include("/configuracion/conf.php"); ?>

<?php require("conexion.php"); $articulo = $_POST['nomArticulo']; ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 

<?php 

if($_POST['ajustar'] and $_POST['seguro']){
$precioAseguradora=$_POST['precioAseguradora'];
$precioParticular=$_POST['precioParticular'];
$codigo=$_POST['codigo'];



for($i=0;$i<=$_POST['bandera']; $i++){
//*********VERIFCO EXISTENCIA******
$sSQL21= "Select * From clientesPrecios
WHERE numCliente = '".$_POST['seguro']."' AND codigo='".$codigo[$i]."'";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);
echo mysql_error();
//*************** EXISTEN *********************************
//echo $precioParticular[$i]." ".$precioAseguradora[$i]." ".$codigo[$i].'</br>';
if($myrow21['numCliente']){ //si existe actualiza
if($codigo[$i]){
$q = "UPDATE clientesPrecios set 
usuario = '".$usuario."',
fecha='".$fecha1."',
ip = '".$ip."',
precioParticular='".$precioParticular[$i]."',
precioAseguradora='".$precioAseguradora[$i]."'
WHERE numCliente = '".$_POST['seguro']."' AND codigo = '".$codigo[$i]."'";
mysql_db_query($basedatos,$q);
$leyenda='Se actualizaron precios';
}
} else { //si no inserta
if($codigo[$i]){
$agrega1 = "INSERT INTO clientesPrecios (
numCliente,codigo,usuario,fecha,ip,precioParticular,precioAseguradora
) values ('".$_POST['seguro']."','".$codigo[$i]."','".$usuario."',
'".$fecha1."','".$ip."','".$precioParticular[$i]."','".$precioAseguradora[$i]."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
$leyenda='Se agregaron precios';
}
}  //cierro validacion si existe o no en la tabla


} //cierro for

} //cierro validacion


if($_POST['eliminadoooos'] AND $_POST['seguro'] AND $_POST['elimina']){
$codigo=$_POST['codigo'];

$borrame = "DELETE FROM clientesPrecios WHERE numCliente ='".$_POST['seguro']."'
and codigo='".$code."'
";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda='Se eliminaron precios';
}
?>


<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escribe el nombre del artículo!")   
                return false   
        }          
}   
  
  
  
  
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.style13 {
	color: #0000FF;
	font-weight: bold;
}
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center">AGREGAR PRECIOS PARA CLIENTES </h1>
<form id="form2" name="form2" method="post" action="">
  <table width="502" border="1" align="center">
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col"><div align="left" class="style12">Cliente</div></th>
      <th scope="col"><div align="left"><span class="style12">
        <?php 
	 
$sSQL1= "Select distinct * From clientes ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
        <select name="seguro" class="Estilo24" id="seguro" onChange="javascript:this.form.submit();"/>
        
        
        <?php 		if($_POST['seguro']!=null){ ?>
        <option value="<?php echo $_POST['seguro']; ?>"><?php echo $_POST['seguro']; ?></option>
        <?php } ?>
		  <option value="">ESCOJE EL CLIENTE.....</option>
        <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
        <option value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['nomCliente']; ?></option>
        <?php } ?>
        </select>
      </span></div></th>
    </tr>
    <tr>
	<?php 
	$sSQL2= "Select distinct * From clientes WHERE numCliente ='".$_POST['seguro']."'";
$result2=mysql_db_query($basedatos,$sSQL2); 
$myrow2 = mysql_fetch_array($result2)
	?>
      <th colspan="3" class="style13 Estilo24" scope="col"><?php echo $myrow2['nomCliente'];?></th>
    </tr>
    <tr>
      <th width="22" scope="col"><input name="escoje" type="radio" value="porarticulo" checked="checked" /></th>
      <th width="212" scope="col"><div align="left"><span class="style12">Escribe el nombre del art&iacute;culo </span></div></th>
      <th width="160" scope="col"><div align="left"><span class="style12">
          <input name="nomArticulo" type="text" class="style12" id="nomArticulo" size="40" value="<?php if($_POST['nomArticulo']) echo $_POST['nomArticulo']; ?>"/>
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
            <a href="javascript:ventanaSecundaria('listaAlmacenes.php?codigo=<?php echo $_POST['codigo']; ?>')"></a>
            <label>
            <input name="Submit" type="submit" class="style12" value="Buscar Agregados" onClick="javascript:ventanaSecundaria('consultaPrecioClientes.php?codigo=<?php echo $_POST['codigo']; ?>')">
            </label>
          </div>
        </label></th>
    </tr>
  </table>
</form>
<?php if($leyenda){ ?>
<p align="center" class="style13">Leyenda: <?php echo $leyenda; ?></p>
<?php } ?>

      <?php	
	  $articulo = $_POST['nomArticulo'];
if(($_POST['buscar'] || $_POST['ajustar'] || $_POST['seguro']) AND $_POST['nomArticulo']){


 
$sSQL= "
SELECT * FROM clientesPrecios

 WHERE descripcion LIKE '%$articulo%' and
 activo='A'
 order by descripcion ASC";

 
if($result=mysql_db_query($basedatos,$sSQL)){
echo mysql_error();

?>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="619" border="1" align="center">
    <tr>
      <th width="87" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo</span></th>
      <th width="339" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="89" bgcolor="#660066" scope="col"><span class="style11">Costo Particular </span></th>
      <th width="76" bgcolor="#660066" scope="col"><span class="style11">Costo seguradora </span></th>
    </tr>
    <tr>

<?php
while($myrow = mysql_fetch_array($result)){
$bandera+=1;
$code = $myrow['codigo'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
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
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <label>
    <?php echo $C?>        </label>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcion']; ?></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
	  if($myrow5['costo']){
	  echo "$".number_format($myrow5['costo'],"2");
	  } else {
	  echo "N/A";
	  }
	  ?>
        <span class="Estilo24">
        <input name="precioParticular[]" type="hidden" class="Estilo24" id="precioParticular" 
		value="<?php 
		if($myrow5['costo']){
		echo $myrow5['costo']; } else {
		echo "0";
		}
		?>" size="5"/>
      </span></span></td>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
      
        <label>
        <input name="precioAseguradora[]" type="text" class="style12" value="<?php echo $myrow6['nivel3']; ?>" size="5"/>
        <span class="Estilo24">
        <input name="bandera" type="hidden" class="Estilo24" value="<?php echo $bandera; ?>" size="5"/>
        </span></label>
        <input name="codigo[]" type="hidden" id="codigo[]" value="<?php echo $C?>" />
      </span></td>
    </tr>
    <?php }}}?>
  </table>
  <p align="center">
    <label><?php if($C){ ?>
    <input name="eliminar" type="submit" class="Estilo24" id="eliminar" value="Eliminar" />
    <input name="ajustar" type="submit" class="style12" id="ajustar" value="Ajustar Precios" />
    <?php } ?>
	</label>
    <span class="Estilo24"><span class="style7">
    <input name="nomArticulo" type="hidden" id="nomArticulo" value="<?php echo $_POST['nomArticulo']; ?>" />
  </span></span><span class="Estilo24"><span class="style7">
  <input name="seguro" type="hidden" id="seguro" value="<?php echo $_POST['seguro']; ?>" />
  </span></span></p>
</form>
<p>&nbsp;</p>
</body>
</html>
