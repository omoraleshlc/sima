<?php require("/configuracion/ventanasEmergentes.php"); ?>




<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventana2","width=600,height=800,scrollbars=YES")
}
</script>


<?php


if($_POST['agrega'] AND $_POST['rfc'] and $_POST['razonSocial']){


 $sSQL1= "Select RFC,keyRFC From datosFiscalesEntidades where
entidad='".$entidad."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['RFC'] ){
 $agrega = "UPDATE RFC
set

razonSocial='".$_POST['razonSocial']."',
calle='".$_POST['calle']."',
colonia='".$_POST['colonia']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
cp='".$_POST['cp']."',
    delegacion='".$_POST['delegacion']."',

pais='".$_POST['pais']."'


where
entidad='".$entidad."'

";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
 <!--
window.alert("REGISTROS ACTUALIZADOS");
window.close();
window.opener.document.forms["form1"].submit();
  // -->
</script>';

} else {
 $agrega = "INSERT INTO datosFiscalesEntidades (
    
razonSocial,calle,colonia,ciudad,estado,cp,delegacion,pais,entidad,RFC,calle1
) values (
'".$_POST['razonSocial']."','".$_POST['calle']."','".$_POST['colonia']."',
    '".$_POST['ciudad']."','".$_POST['estado']."','".$_POST['cp']."',
'".$_POST['delegacion']."','".$_POST['pais']."','".$entidad."','".$_POST['rfc']."',
'".$_POST['calle1']."'
)
    ";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
 <!--
window.alert("REGISTROS AGREGADOS");
window.close();
window.opener.document.forms["form1"].submit();
  // -->
</script>';
}

//razonSocial 	calle 	colonia 	ciudad 	estado 	cp 	delegacion 	pais 	entidad 	RFC 	calle1






}



?>








<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="../css/images/style.css" rel="stylesheet" type="text/css" />
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<form id="form1" name="form1" method="POST"  >
   <p>
     <label></label></p>
   <div align="center">
     <h1>EDITAR DATOS FISCALES</h1>
     <h1><?php echo $_GET['entity'];?></h1>
     <table width="539" class="table-forma">
<?php
if(!$_POST['rfc']){$_POST['rfc']=trim($_GET['RFC']);}


//if($_POST['rfc']){
$sSQL2= "Select * From datosFiscalesEntidades WHERE entidad='".$_GET['entidad']."'   ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
//}
?>


         
               
         
         
         
         
         

     <tr >
       <td  ></td>
       <td  ><span >
         <label>
      
         </label>

       </span></td>
     </tr>         
         
         
         
              <tr >
       <td  >RFC:</td>
       <td  ><span >
         <label>
         <input type="text" name="rfc"  value="<?php

		 echo $myrow2['RFC'];
		 ?>" />
         </label>

       </span></td>
     </tr>
         
     <tr   >
       <td   scope="col"><div align="left" >Raz&oacute;n Social</div></td>
       <td   scope="col"><div align="left" >
<textarea name="razonSocial" cols="40" wrap="virtual" id="razonSocial" autocomplete="off"  ><?php echo trim($myrow2['razonSocial']);?></textarea>
           </span></div></td>
     </tr>
     <tr   >
       <td   scope="col"><div align="left">Calle</div></td>
       <td   scope="col"><div align="left"><span >
           <input name="calle" type="text"  id="calle" value="<?php

echo $myrow2['calle'];
		  ?>" size="40" autocomplete="off" <?php if($myrow2['calle']){ echo 'class="Estilo1"';}?>  />
       </span></div></td>
     </tr>
     <tr   >
       <td   scope="col"><div align="left" >Colonia</div></td>
       <td   scope="col"><div align="left"><span >
           <input name="colonia" type="text"  id="colonia" value="<?php
echo $myrow2['colonia'];

		  ?>" size="40" autocomplete="off" <?php if($_POST['colonia']){ echo 'class="Estilo1"';}?>  />
       </span></div></td>
     </tr>
     <tr   >
       <td   scope="col"><div align="left" >Ciudad</div></td>
       <td   scope="col"><div align="left"><span >
           <input name="ciudad" type="text"  id="ciudad" value="<?php

echo $myrow2['ciudad'];

		  ?>" size="40" autocomplete="off" <?php if($_POST['ciudad']){ echo 'class="Estilo1"';}?>  />
       </span></div></td>
     </tr>
     <tr   >
       <td   scope="col"><div align="left" >Estado</div></td>
       <td   scope="col"><div align="left"><span >
           <input name="estado" type="text"  id="rfc6" value="<?php
echo $myrow2['estado'];

		  ?>" size="21" maxlength="21" autocomplete="off" <?php if($_POST['estado']){ echo 'class="Estilo1"';}?>  />
       </span></div></td>
     </tr>
     <tr   >
       <td   scope="col"><div align="left" >CP</div></td>
       <td   scope="col"><div align="left"><span >
           <input name="cp" type="text" id="cp" maxlength="7" value="<?php

echo $myrow2['cp'];

		  ?>" size="7" autocomplete="off" <?php if($_POST['cp']){ echo 'class="Estilo1"';}?>  />
       </span></div></td>
     </tr>
     <tr >
       <td  >Pais:</td>
       <td  ><span >
         <input name="pais" type="text"  id="pais" value="<?php echo trim($myrow2['pais']); ?>" />
       </span></td>
     </tr>
     <tr >
       <td height="38"  >Delegacion:</td>
       <td  ><span >
         <input name="delegacion" type="text"  id="delegacion" value="<?php echo $myrow2['delegacion']; ?>" size="60"/>
       </span></td>
     </tr>




   </table>
  </div>
   <p align="center">
     <label>
     <input name="agrega" type="submit"  id="agrega" value="Agregar/Actualizar" />
     </label>


  </p>
</form>

</body>

</html>