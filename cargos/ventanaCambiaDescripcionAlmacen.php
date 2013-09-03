<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 



<?php 




if($_POST['actualizar'] and $_POST['descripcion'] and $_GET['almacen'] and $_GET['almacenPrincipal']){ 
//************DECLARAMOS CLASES*********

$q = "INSERT INTO almacenesTemp (descripcion,almacen,almacenPrincipal,fecha,hora,usuario)
values
('".$_POST['descripcion']."','".$_GET['almacen']."','".$_GET['almacenPrincipal']."','".$fecha1."','".$hora1."','".$usuario."')";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
?>
<script>
window.alert("Se actualizaron datos...");
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 
}
?>



<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>




<body >
<form name="form1" method="post">
  <p align="center" class="titulos"><strong> Cambiar Descripci&oacute;n</strong><?php
  $sSQL= "SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
  
  ?>
  </p>
  <table width="364" border="3" align="center" cellpadding="1" cellspacing="1" >
    <tr>
      <td width="105" scope="col" style="background-color:#CCC"><div align="left" ><h1>Nueva Descripci&oacute;n</h1></div></td>
      <td width="249" scope="col" style="background-color:#CCC"><div align="left">
      <?php
	  
$sSQL455z= "Select * from almacenesTemp where
fecha='".$fecha1."'
and
almacen='".$_GET['almacen']."'
and
almacenPrincipal='".$_GET['almacenPrincipal']."'
order by keyAT DESC

";
$result455z=mysql_db_query($basedatos,$sSQL455z);
$myrow455z = mysql_fetch_array($result455z);
	  
	  if($myrow455z['keyAT']){
	  $desc=$myrow455z['descripcion'];
	  }else{
	  $desc=$myrow['descripcion'];
	  }
	  ?>
      
      
<textarea name="descripcion" cols="40" class="camposmid" id="descripcion"><?php echo $desc;?></textarea>
          </div>
      </label></td>
    </tr>
  </table>
  <p align="center"><label>
  <input name="actualizar" type="submit"  id="actualizar" value="Aplicar Cambios" />
   <!--input name="actualizar" type="image" src="../imagenes/btns/refresh.png" id="actualizar" value="Aplicar Cambios"-->
    </label></p>
</form>
<p>&nbsp;</p>
</body>
 