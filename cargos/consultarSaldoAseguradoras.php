<?php  require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');


$sSQL7n= "Select * from periodoAlumnos where entidad='".$entidad."'  and  '".$fecha1."' between fechaInicial and fechaFinal ";
$result7n=mysql_db_query($basedatos,$sSQL7n);
$myrow7n = mysql_fetch_array($result7n);

$sSQL7na1= "Select numMatricula from pacientes where entidad='".$entidad."'  and numCliente='".$_POST['numeroEx']."'  ";
$result7na1=mysql_db_query($basedatos,$sSQL7na1);
$myrow7na1 = mysql_fetch_array($result7na1);

$sSQL7na= "Select * from ALUMNOSINSCRITOS where entidad='".$entidad."'  and MATRICULA='".$myrow7na1['numMatricula']."'  ";
$result7na=mysql_db_query($basedatos,$sSQL7na);
$myrow7na = mysql_fetch_array($result7na);
?>

<script language="javascript" type="text/javascript">   

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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el depósito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el médico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el límite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit()
{
var agree=confirm("Está Ud. seguro de cambiar a este paciente de cama?");
var bandera;
if (agree)
	return true ;
else
	return false ;
}
// -->
</script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();


?>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>
<h1 align="center" class="titulos">Consultar Saldos por Aseguradora </h1>
<?php echo $leyenda; ?>
<div align="center"></div>
<form name="form2" id="form2" method="post" action="">
  <p>
    <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="78"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
    <span class="negromid">
    <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
  </span></p>
  <p>&nbsp;  </p>
</form>


	  	<?php 
	if($_POST['numeroEx']){
?>
<form name="form1" method="post" action="">
    <p align="center"><?php echo $alumno;?></p>
    <p align="center">Alumno Inscrito, cursando: <?php echo $myrow7na['CARRERA'];?></p>
    <p align="center">Movimientos periodo: <?php echo cambia_a_normal($myrow7n['fechaInicial']).' al '.cambia_a_normal($myrow7n['fechaFinal']);?> </p>
    <table width="400" border="0" align="center">
      <tr>
        <th width="74" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">FolioVenta</div></th>
        <th width="311" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Fecha</div></th>
        <th width="101" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Cantidad</div></th>
      </tr>
      <tr>
        <?php	


$sSQL= "Select * from clientesInternos where entidad='".$entidad."' and numeroE='".$_POST['numeroEx']."' and tipoPaciente='externo' 

and (fecha >='".$myrow7n['fechaInicial']."' and fecha<='".$myrow7n['fechaFinal']."' ) 
and
folioVenta!=''
and
statusCaja='pagado'";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL7c= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as cargos  from cargosCuentaPaciente where entidad='".$entidad."'  and folioVenta='".$myrow['folioVenta']."' and naturaleza='C'  and gpoProducto!=''  ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);

$sSQL7a= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as abonos  from cargosCuentaPaciente where entidad='".$entidad."'  and folioVenta='".$myrow['folioVenta']."'  and naturaleza='A' and gpoProducto!=''  ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);

$totales[0]+=($myrow7c['cargos']-$myrow7a['abonos']);


?>
        <td bgcolor="<?php echo $color?>" class="codigosmid"><label><?php echo $myrow['folioVenta']; ?></label></td>
        <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo cambia_a_normal($fecha1);?></td>
        <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo '$'.number_format($myrow7c['cargos']-$myrow7a['abonos'],2); ?></td>
      </tr>
      <?php  } //cierra while ?>
    </table>
    <p align="center">&nbsp;</p>
    <table width="355" border="1" align="center">
      <tr>
	  <?php 
$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$_GET['seguro']."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
	  
	  $sSQL7abc= "Select clientePrincipal,nomCliente from clientes where entidad='".$entidad."'  and numCliente='".$myrow7ab['seguroAlterno']."'  ";
$result7abc=mysql_db_query($basedatos,$sSQL7abc);
$myrow7abc = mysql_fetch_array($result7abc);
	  ?>
	  
        <td width="166">Limite</td>
        <td width="17">&nbsp;</td>
        <td width="150"><?php echo '$'.number_format($myrow7ab['cantidad'],2);?></td>
      </tr>
      <tr>
        <td>Saldo Actual </td>
        <td>&nbsp;</td>
        <td><?php echo '$'.number_format($totales[0],2);?></td>
      </tr>
      <tr>
        <td>Credito Disponible </td>
        <td>&nbsp;</td>
        <td><?php
		$diferencia=$myrow7ab['cantidad']-$totales[0];
		 echo '$'.number_format($myrow7ab['cantidad']-$totales[0],2);?></td>

      </tr>
    </table>
    <p>&nbsp;</p>
    <p align="center">
  <label>
   <input name="load" type="hidden"  id="close"   value="">
  </label>
</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

</form>
	<?php } ?>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
	    <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	
</body>
</html>