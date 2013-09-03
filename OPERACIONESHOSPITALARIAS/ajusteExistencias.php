<?PHP require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=1000,height=800,scrollbars=YES") 
} 
</script> 

<script>
var myWindow;

function openCenteredWindow(url) {
    var width = 1000;
    var height = 900;
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
    var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
    myWindow = window.open(url, "subWind", windowFeatures);
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
        status = "Este campo solo acepta numeros."
        return false
    }
    status = ""
    return true
}
</script>

<?php 


$window=new ventanasPrototype();
$window->links();
$abrir=new ventanasPrototype();

$hoy = date("d/m/Y");
$hora = date("g:i a");
$cendis=new whoisCendis();
/*
?>




<script>
	
	// Windows with an URL as content
	
	win2 = new Window('dialog2', {title: "AJUSTE DE INVENTARIOS", 
							 bottom:200, left:600, width:800, height:600, 
resizable: true, url: "../ventanas/ventanaInventarios.php?porArticulo=<?php echo $_POST['porArticulo']; ?>&almacenDestino=<?php echo $centroDistribucion=$cendis->cendis($entidad,$basedatos);  ?>&anaquel=<?php echo $_POST['anaquel']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>", showEffectOptions: {duration:3}})
	win2.show();
	win2.setDestroyOnClose();
        

</script>

<?php 
*/









$ventanaCenter=new windowCenter();
$ventanaCenter->mainmenu();






if($_POST['buscar']!=NULL and $_POST['porArticulo']!=NULL  || (is_numeric($_POST['porArticulo'])!=NULL )){?>
<script>
javascript:openCenteredWindow('../ventanas/ventanaAjusteExistencias.php?porArticulo=<?php echo $_POST['porArticulo']; ?>&almacenDestino=<?php echo $centroDistribucion=$cendis->cendis($entidad,$basedatos);  ?>&anaquel=<?php echo $_POST['anaquel']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $_GET['random'];?>&usuario=<?php echo $usuario;?>',ventanaSecundaria2,'1000','1000','yes');
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

<h1 align="center" >
    <br />
AJUSTE DE EXISTENCIAS CENDIS<br />

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

  <table width="600" class="table-forma">
      
      
      
      
    <tr>
      <td width="114"  scope="col"><div align="left" >
        <div align="right" ><span >Datos Articulo </span></div>
      </div></td>
      <td width="474"  scope="col"><div align="left"><span >
          <input name="porArticulo" type="text"  id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></td>
    </tr>
    
      
      
      
      
      
      
      
      
          
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

      
      
      
      
      
      
      
      
      
      

      
      
      
      
      
      
    <tr>
        
      <td height="41"  scope="col">&nbsp;</td>
      <td  scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></td>
    </tr>
  </table>
  
<p>&nbsp;</p>
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
</form>



</body>
</html>