<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php 





if($_POST['dx'] and $_POST['enviar'] ){





//**************************
if($_GET['keyClientesInternos']){

$q1 = "UPDATE clientesInternos set 
dx='".$_POST['dx']."'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
 }
//********************************************

 


 
echo '<script language="JavaScript" type="text/javascript">

  window.alert( "Se agrego un DX ");
window.opener.document.forms["form2"].submit();
  window.close();

</script>';
}




?>






  
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=800,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 

if($_GET['keyClientesInternos']){
$sSQL10= "SELECT *
FROM
clientesInternos
WHERE (keyClientesInternos='".$_GET['keyClientesInternos']."' or keyClientesInternos='".$_POST['keyClientesInternos']."')
order by keyClientesInternos desc
";

$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">

.a{
bgcolor: #FF0000;
font-family: Arial;
font-size: 1.2em;
font-weight: bold;
display: block
}
.hover{
bgcolor: #FF0000;
display: block
font-family: Arial;
font-size: 1.2em;
font-weight: bold;
}
.select{
bgcolor: #FF0000;
font-family: Arial;
font-size: 1.2em;
font-weight: bold;
display: block
} 

.lista_de_vehiculos{
 width: 100px;
}

OPTION.vehiculo{
 width:400px;
 color:red; 
}

</style>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();

?>


<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<body>


<form id="form1" name="citas" method="post" action="">
  <p>&nbsp;</p>
  <h1>Agregar Dx</h1>
  
  <table width="428" border="0" align="center"  >


    <tr >

      <td width="98"  scope="col"><div align="left" ><b >M&eacute;dico</b></div></td>
      <td width="318"  scope="col"><label>
        <div align="left">
		<?php echo $_GET['medico'];?>		</div>
      </label></td>
    </tr>


   <tr >
      <td colspan="3" >&nbsp;</td>
    </tr>


    <tr >
      <td ><b>Expediente</b></td>
      
      
      <td >

                <?php
		  
		  echo $myrow10['numeroE'];
	
		  ?>
      </td>


      <td width="1">&nbsp;</td>
    </tr>




      <tr >
	
	
	
      <td ><b>Paciente </b></td>
      <td ><?php
		
		  echo $myrow10['paciente'];
		
		  ?></td>
      <td>&nbsp;</td>
    </tr>


   <tr >
      <td height="16" colspan="3" ><b>Dx</b></td>
    </tr>

      
 <tr >
      <td height="16" colspan="3" ><label>
    <label>
          <textarea name="dx" cols="80" rows="4" wrap="virtual" ><?php echo $myrow10['dx'];?></textarea>
          </label>

        <div align="center">
          <p>
            <input name="enviar" type="submit"  id="enviar" value="Agregar" />
            <span class="titulomedio">
            <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro']){ echo $_POST['seguro'];} else { echo "0";}?>">
            </span></p>
        </div>
      </label></td>
    </tr>
  </table>

</form>

<p>
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroE")[0].value = id;
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
			return "/sima/cargos/pacientesx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script></p>
</body>

</html>
