<?php require('/configuracion/ventanasEmergentes.php'); ?>
<?php  
if($_GET['keyFC'] AND $_GET['del']=='si'){


$q = "delete from facturacionconfigurada

		WHERE keyFC='".$_GET['keyFC']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();




}
?>





















<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria17 (URL){ 
   window.open(URL,"ventanaSecundaria17","width=800,height=400,scrollbars=YES")
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>


  <form id="form1" name="form1" method="post" >

      
    <p align="center" >
        <a href="javascript:ventanaSecundaria17('agregaSeguros.php?keyPAQ=<?php echo $_GET['keyPAQ'];?>&id_factura=<?php echo $_GET['id_factura'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>')">
            CARGAR SEGURO
        </a></p>
	
	
	

    <table width="500" class="table table-striped">
      <tr >
            <th width="68"   scope="col">
                
                  <div align="left">#
                </div>
            </th>
        <th width="283"  scope="col">
            <div align="left">Aseguradora</div>
         </th>

          
        <th width="91"  scope="col"> 
            <div align="left"> Importe Fac</div>
       </th>



        <th width="48"  scope="col">
            <div align="center">Eliminar</div>
      </th>

        
      </tr>
<?php	
$sSQL= "SELECT  
* 
FROM facturacionconfigurada
WHERE
entidad='".$entidad."'
and
keypaq='".$_GET['keyPAQ']."'

";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;





?>

   
      <tr>

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
        <td height="21" bgcolor="<?php echo $color;?>" ><?php echo $bandera;?></td>
        <td bgcolor="<?php echo $color;?>" >
		<?php 
		echo $myrow['descripcioncliente'];
		?>
		</td>
        <td bgcolor="<?php echo $color;?>" ><?php echo $myrow['importe'];?></td>

        <td bgcolor="<?php echo $color;?>" >
            <div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?keyFC=<?php echo $myrow['keyFC']; ?>&del=si">
                    <img src="../imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar <?php echo $myrow['descripcion']; ?>?') == false){return false;}" />
                </a></div></td>
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>

<p>&nbsp;</p>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
	
	
	$sSQL39es= "
	SELECT 
*
FROM
listaOC
WHERE 
entidad='".$entidad."'
and
nRequisicion='".$_GET['req']."'";
$result39es=mysql_db_query($basedatos,$sSQL39es);
$myrow39es = mysql_fetch_array($result39es);
	
	
	?>
	
	
	 

    
    <p align="center">&nbsp;</p>
    <p align="center"><label></label>
    </p>




  </form>
  <p>&nbsp;    </p>
  <p><script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
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
			return "/sima/cargos/articulosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>
</body>
</html>
