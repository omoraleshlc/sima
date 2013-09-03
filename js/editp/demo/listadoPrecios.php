<?PHP require("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>Another In-Place Editor, a jQuery Plugin by Dave Hauenstein</title>
        <script type="text/javascript" src="../spec/support/jquery.js"></script>
        <script type="text/javascript" src="../spec/support/jquery.ui.js"></script>
        <script type="text/javascript" src="../lib/jquery.editinplace.js"></script>
        
        <link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen" title="no title" charset="utf-8" />
    </head>

<h1 align="center" class="titulos">Almacen: Rayos X </h1>

        


<form id="form1" name="form1" method="post" action="">
  <table width="716" border="0" align="left">
    <tr>
          <th width="10" bgcolor="#FFFFFF" scope="col"><div align="left" class="blancomid style1">#</div></th>
             <th width="10" bgcolor="#FFFFFF" scope="col"><div align="left" class="blancomid style1">KeyPA</div></th>
      <th width="507" bgcolor="#FFFFFF" scope="col"><div align="left" class="blancomid style1">Descripci&oacute;n</div></th>
      
      <th width="108" bgcolor="#FFFFFF" scope="col"><div align="left">Precio Particular </div></th>
      <th width="87" bgcolor="#FFFFFF" scope="col"><div align="left">Precio Aseguradora </div></th>
    </tr>
    <tr>
<?php	
$ivaGrupo=new articulosDetalles();


$sSQL1= "SELECT 
* 
FROM 
articulos
order by
descripcion ASC
limit 0,100
";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$codigo+=1;
$a+=1;


 $sSQL3a="SELECT *
FROM
existencias
WHERE keyPA='".$myrow1['keyPA']."'

  ";
  $result3a=mysql_db_query($basedatos,$sSQL3a);
  $myrow3a = mysql_fetch_array($result3a);

 $sSQL3ab="SELECT *
FROM
almacenes
WHERE almacen='".$myrow1['almacen']."'

  ";
  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
  $myrow3ab = mysql_fetch_array($result3ab);
  
   $sSQL3ac="SELECT *
FROM
gpoProductos
WHERE codigoGP='".$myrow1['gpoProducto']."'

  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
  
  
  $ivaP=$ivaGrupo-> ivaGPO($entidad,"1",$myrow1['gpoProducto'],$myrow3a['nivel1'],$basedatos);
    $ivaA=$ivaGrupo-> ivaGPO($entidad,"1",$myrow1['gpoProducto'],$myrow3a['nivel3'],$basedatos);
?>
             <td bgcolor="<?php echo $color?>" class="normalmid" align="left"><?php echo $a; ?></td>
           <td bgcolor="<?php echo $color?>" class="normalmid" id="element_id" align="left"><?php echo $myrow1['keyPA']; ?></td>
   
<script type="text/javascript">
/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 * Copyright (c) 2009 Dave Hauenstein
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
$(document).ready(function(){
	

	// Using a callback function to update 2 divs
	$("#<?php echo $myrow1['keyPA']; ?>").editInPlace({
            url: "./server.php"
		//callback: function(element_id,original_element, html, original){
                     
		//	$("#updateDiv1").html("The original html was: " + original);
		//	$("#updateDiv2").html( html);
                //        $("#updateDiv3").html("El ID es el: " + element_id);
		//	return(html);
		//}
	});
	


	
	// If you need to remove an already bound editor you can call

	// > $(selectorForEditors).unbind('.editInPlace')

	// Which will remove all events that this editor has bound. You need to make sure however that the editor is 'closed' when you call this.
	
});
</script>            
        
        <td align="left" id="<?php echo $myrow1['keyPA']; ?>" height="26" bgcolor="<?php echo $color?>" class="normalmid">

  <div align="left" class="blancomid style1">
 <?php echo $myrow1['descripcion']; ?>      
  </div>
        
        </td>
      
      
            
      <td bgcolor="<?php echo $color?>" class="normalmid" align="left"><?php echo '$'.number_format( $myrow3a['nivel1']+$ivaP,2); ?></td>
      <td bgcolor="<?php echo $color?>" class="normalmid" align="left"><?php echo '$'.number_format( $myrow3a['nivel3']+$ivaA,2); ?></td>
    </tr>
    <?php  } //cierra while ?>
  </table>
  <div align="center" class="informativo"><strong>
   
	<?php if($codigo>0){
	echo "Se encontraron $codigo registros..!"; 
	}
	?>
	</strong></div>

</form>
</body>
</html>