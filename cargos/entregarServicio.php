<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 



<?php 




if($_POST['actualizar'] and $_POST['pacienteRecepcion'] and  $_GET['folioVenta']){ 
//************DECLARAMOS CLASES*********
$q = "UPDATE clientesInternos set 
pacienteRecepcion='".$_POST['pacienteRecepcion']."',
horaRecepcion='".$hora1."',
fechaRecepcion='".$fecha1."',
usuarioRecepcion='".$usuario."',
statusRecepcion='recibido'

WHERE 
entidad='".$entidad."' AND
folioVenta='".$_GET['folioVenta']."'  ";

mysql_db_query($basedatos,$q);
echo mysql_error();

$q = "UPDATE cargosCuentaPaciente set 
statusRecepcion='recibido'

WHERE 
entidad='".$entidad."' AND
folioVenta='".$_GET['folioVenta']."' and statusRecepcion='' ";

mysql_db_query($basedatos,$q);
echo mysql_error();

?>
<script>
window.alert("Se entrego un servicio...");
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



<style type="text/css">
<!--
.Estilo24 {font-size: 13px}
-->
</style>
<body >
<form name="form1" method="post">
  <p align="center" class="titulos"><strong> Entregar Servicio</strong><?php
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
  <img src="/sima/imagenes/bordestablas/borde1.png" width="508" height="24" />
  <table width="508" border="0" align="center" cellpadding="4" cellspacing="0" class="style71">
    <tr bgcolor="#CCCCCC">
      <th width="214" height="101" scope="col"><div align="left" class="Estilo24">Nombre quien recibe servicio </div></th>
      <th width="278" scope="col"><div align="left">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div></th>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="508" height="24" />
  <p align="center"><label>
    <input name="actualizar" type="image" src="../imagenes/btns/refresh.png" id="actualizar" value="Aplicar Cambios">
  </label></p>
</form>
<p>&nbsp;</p>
</body>
 