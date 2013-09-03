<?PHP require("/configuracion/ventanasEmergentes.php"); ?>

<SCRIPT LANGUAGE="JavaScript">
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
</SCRIPT>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
  
</script> 

<SCRIPT LANGUAGE="JavaScript">
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
</SCRIPT>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<?php 
$sSQL1= "Select * From statusCaja where entidad='".$entidad."' and keyCatC='".$_POST['codigoCaja']."' and numCorte='".$_POST['numCorte']."' and status='cerrada' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
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

<body>
    <br></br>
<h1 align="center" class="titulos">Reporte de Cajeros  </h1>
<form id="form1" name="form1" method="post" action="">
 
  <table width="453" class="table-forma">
    <tr>
      <th colspan="2"  scope="col"><p align="center">Imprimir Reporte de Caja</p></th>
    </tr>
    <tr>
     
      <td   scope="col"><div align="right"><strong>Caja</strong></div></td>
      <td   scope="col"><label>
          <div align="left">
            <label>
            <?php 
	  $aCombo= "Select * From catCajas where
entidad='".$entidad."'  order by descripcionCaja ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
            <select name="codigoCaja"  id="codigoCaja"  onchange="javascript:this.form.submit();"/>
         
            <option value="" >---</option>
            <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
            <option 
		<?php 
		if($_POST['codigoCaja']==$resCombo['keyCatC']){
		
		echo 'selected="selected"';		
		}   ?>
		value="<?php echo $resCombo['keyCatC']; ?>"><?php echo $resCombo['descripcionCaja']; ?></option>
            <?php } ?>
            </select>
            </label>
</div>
        </label></td>
    </tr>

    <tr>
      <td  scope="col"><div align="right"><b>Numero de Corte</b></div></td>
      <td  scope="col"><div align="left">
        <input name="numCorte" type="text"  id="numCorte" value="<?php echo $_POST['numCorte'];?>"  autocomplete="off"/>
      </div></td>
    </tr>
    <tr>
      <td  scope="col"><p>&nbsp;</p>      </td>
      <td valign="middle"  scope="col"><div align="left">
        <input name="search" type="submit"  id="search" value="Buscar" src="../imagenes/btns/searchbutton.png"/>
      
	  </div></td>
      
    </tr>
	
	<?php 
	if($_POST['search'] and $myrow1['status'] ){ ?>
    <tr>
      <td   scope="col"><div align="right"><b>Cajero</b></div></td>
      <td   scope="col"><div align="left">
          <label></label>
          <label></label>
      <?php echo $myrow1['usuario'];?>
	  </div></td>
    </tr>
    <tr>
      <td ><div align="right" ><b>Fecha Apertura</b></div></td>
      <td ><?php  
	  if($myrow1['fechaApertura']){
	  echo $myrow1['fechaApertura']; 
	  } else {
	  echo '---';
	  }
	   ?></td>
    </tr>
    <tr>
      <td ><div align="right" ><b>Hora Apertura</b></div></td>
      <td ><?php 
	  if($myrow1['horaApertura']){
	  echo $myrow1['horaApertura'];
	  } else {
	  echo '---';
	  }
	    ?></td>
    </tr>
    <tr>
      <td  scope="col"><div align="right" ><b>Fecha Cierre </b></div></td>
      <td  scope="col"><div align="left">
        <?php 
	  if($myrow1['fechaCorte']){
	  echo $myrow1['fechaCorte'];
	  } else {
	  echo '---';
	  }
	    ?>
      </div></td>
    </tr>
    <tr>
      <td  scope="col"><div align="right" ><b>Hora Cierre</b> </div></td>
      <td  scope="col"><div align="left">
        <?php 
	  if($myrow1['horaCorte']){
	  echo $myrow1['horaCorte'];
	  } else {
	  echo '---';
	  }
	    ?>
      </div></td>
    </tr>

    <tr>
      <td  scope="col"><a href="javascript:ventanaSecundaria1('imprimeCorteCompleto.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;numeroE=<?php echo $numeroE; ?>&amp;usuario=<?php echo $usuario; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;entidad=<?php echo $entidad; ?>&amp;numCorte=<?php echo $myrow1['numCorte']; ?>&codigoCaja=<?php echo $_POST['codigoCaja'];?>')"></a></td>
      <td  >&nbsp;</td>
    </tr>
    <tr>
      <td height="36" >&nbsp;</td>
      <td height="36" >
          <span class="titulo1">
              <input value="IMPRIMIR CORTE" type="button" onClick="javascript:ventanaSecundaria1('imprimirFoliosCobrados.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;numeroE=<?php echo $numeroE; ?>&amp;usuario=<?php echo $usuario; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;entidad=<?php echo $entidad; ?>&amp;numCorte=<?php echo $myrow1['numCorte']; ?>&amp;codigoCaja=<?php echo $_POST['codigoCaja']; ?>')">
    </span>

      </td>
    </tr>

    <tr>
      <td height="36" >&nbsp;</td>
      <td height="36" ><div align="center">
          <label></label>
          <div align="left">
            <?php }
?>
          </div>
          <label></label>
      </div></td>
    </tr>
  </table>

</form>
<p align="center">&nbsp;</p>

</body>
</html>

