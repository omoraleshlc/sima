<?php require("/configuracion/ventanasEmergentes.php"); 
require("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=400,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=900,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 

<?php

//echo $_POST['aplicarPaquete'].' '.$_POST['codigoPaquete'].' '.$_POST['paciente'];

if($_POST['aplicarPaquete'] and $_POST['nomSeguro'] and $_POST['seguro'] and $_POST['importe']){

 $sSQL4= "Select * from facturacionconfigurada where entidad='".$entidad."' and clienteprincipal='".$_POST['seguro']."'";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

//# 	Column 	Type 	Collation 	Attributes 	Null 	Default 	Extra 	Action
//	1 	keyFC 	int(11) 			No 	None 	AUTO_INCREMENT 	Change Change 	Drop Drop 	More Show more actions
//	2 	clienteprincipal 	varchar(20) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	3 	descripcioncliente 	varchar(50) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	4 	keypaq 	int(11) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	5 	usuario 	varchar(15) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	6 	fecha 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	7 	entidad 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions

if(!$myrow4['clienteprincipal']){
 $agrega = "INSERT INTO facturacionconfigurada (
clienteprincipal,descripcioncliente,keypaq,usuario,fecha,importe,entidad)
values ('".$_POST['seguro']."','".$_POST['nomSeguro']."','".$_GET['keyPAQ']."',
'".$usuario."','".$fecha1."','".$_POST['importe']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//echo 'El Paquete Fue agregado al paciente';






?>

<script>
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 
} else {

echo 'Este paquete ya lo asignaste...';
}
}

?>


<script language="JavaScript" type="text/javascript">
/*<![CDATA[*/

function Disable(cb,but){
 var cbs=document.getElementsByName(cb.name);
 but=cbs[0].form[but]
 but.setAttribute('disabled','disabled');
 for (var zxc0=0;zxc0<cbs.length;zxc0++){
  if (cbs[zxc0].checked){
   but.removeAttribute('disabled');
   break;
  }
 }

}
/*]]>*/
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<head>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>

<body>
<?php 
?>
  <h1 align="center" class="">Agregar Seguros a Facturacion Configurada (relacion de un seguro a un paquete solamente)</h1>
  <h1 align="center"> <?php echo $myrow1['nombreCompleto'];?></h1>
<form id="form1" name="form1" method="post" action="#">

  <table width="585" class="table-forma">
    <tr>
      <td valign="top">Seguro
      <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="80"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      <td height="46" valign="top"><span class="negromid">
          <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
      </span></td>
    </tr>

      <tr>
      <td width="371" valign="top">
	    <p>Importe</p>
	    <p>
	      <input name="importe"  type="text" class="camposmid" id="descripcionPaquete"  size="20" value="<?php echo $_POST['importe'];?>" />
      </p></td>

    </tr>

      
    <tr>
      <td height="33" colspan="2"><div align="left">
          <input name="aplicarPaquete" type="Submit"  src="../../imagenes/btns/aplypaq.png" id="aplicarPaquete" value="Agregar"   />
        

      </div></td>
	  


	
<script>
//alert(" Hi"+document.getElementById("status"));
</script>
    </tr>
  </table>

</form>
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
 </body>
</html>