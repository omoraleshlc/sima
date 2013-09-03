<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=900,height=800,scrollbars=YES") 
} 
</script> 



<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>

<script>
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
</script>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if(($_POST['buscar']!=NULL and $_POST['porArticulo']!=NULL and $_POST['almacenDestino']!=NULL) || (is_numeric($_POST['porArticulo'])!=NULL and $_POST['almacenDestino']!=NULL)){?>
<script>
    javascript:ventanaSecundaria2('ventanaInventarios.php?porArticulo=<?php echo $_POST['porArticulo']; ?>&almacenDestino=<?php echo $_POST['almacenDestino']; ?>&anaquel=<?php echo $_POST['anaquel']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>');
</script>    

<?php     
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos">
    <br />
INVENTARIOS<br />

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <img src="/sima/imagenes/bordestablas/borde1.png" width="600" height="24" />
  <table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
      
      
      
      
    <tr>
      <th width="114" bgcolor="#FFFF00" scope="col"><div align="left" class="normalmid">
        <div align="right" ><span class="negromid">Datos Articulo </span></div>
      </div></th>
      <th width="474" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style12">
          <input name="porArticulo" type="text" class="camposmid" id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></th>
    </tr>
    
      
      
      
      
      <tr class="style7">
      <th bgcolor="#CCCCCC" scope="col"><div align="right" class="normalmid">Almac&eacute;n</div></th>
      <th bgcolor="#CCCCCC" scope="col"> <div align="left">
      <?php     $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onchange="this.form.submit();"/>        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
      </div></th>
    </tr>
      
      
      
          
      
      
      
      
      
      
      
      
      
      
      
      
      
            
      <tr class="normal">
      <th bgcolor="#CCCCCC" scope="col"><div align="right" class="normalmid">Anaquel</div></th>
      <th bgcolor="#CCCCCC" scope="col"> <div align="left">
          <?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$_POST['almacenDestino']."' order  by anaquel ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel" class="normal" id="almacenDestino" onchange="this.form.submit();"/>        
       <option value="" >---</option>
       <option
           <?php
            if($_POST['anaquel']=='*')echo 'selected=""';            
            ?>
           value="*">Todos</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option
            
            <?php
            if($_POST['anaquel']==$resCombo['anaquel'])echo 'selected=""';            
            ?>
            
            value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
        <?php } ?>
        </select>
      </div></th>
    </tr>
      
      
      
      

      
      
      
      
      
      
      
      
      
      

      
      
      
      
      
      
    <tr>
        
      <th height="41" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
      <th bgcolor="#CCCCCC" scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" src="../../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></th>
    </tr>
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="600" height="24" />
<p>&nbsp;</p>
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</form>



</body>
</html>