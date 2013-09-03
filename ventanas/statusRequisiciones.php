<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");





if($_POST['actualizar']){

if($_POST['escoje']!=NULL){

$q = "UPDATE contadorRequisiciones set 
status='".$_POST['escoje']."',
    observaciones='".$_POST['observaciones']."',
        usuarioRecepcion='".$usuario."',horaRecepcion='".$hora1."',fechaRecepcion='".$fecha1."'
    
WHERE 
entidad='".$entidad."'
    and
    contador='".$_GET['nRequisicion']."'


";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


}else{
    echo '<div class="error">Escoje la opcion!</div>';
}



?>



<script >
window.alert("Se cambio el status a: <?php echo $_POST['escoje'];?>");
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        

    <br></br>
    
    
    
    

<form name="form1" method="post" action="">
  <table width="340" class="table-forma">

    <tr>
      <th colspan="2">
      <p align="center" >CAMBIAR EL STATUS DE REQUISICION</p>      </th>
    </tr>
      
  

      
      
        <tr>
            <td ><select name="escoje">
                    <option value="">Escoje</option>    
                    <option value="Aprobada">Aprobada</option>
                    <option value="enProceso">En Proceso</option>
                    <option value="Rechazada">Rechazada</option>
                </select></td>
      <td></td>
    </tr>
      
 
      
      
                   <tr>
            <td ></td>
      <td></td>
    </tr>
      
      
      
  <tr>
      
      <td ><div align="left">Observaciones</div></td>
      <td></td>
    </tr>
      
      

      
          <tr>
   
      <td><div align="left"><textarea name="observaciones" cols="30" rows="5"></textarea></div></td>
        <td></td>
    </tr>
      
      
      
 
  </table>
  <p align="center">
  

    <label>
    <input name="actualizar" type="submit"  id="actualizar" value="Enviar">
    </label>
  </p>
</form>

      
      
      
      
      
      
      
      
      
      
   
    
     



</body>
</html>