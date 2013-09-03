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
<h1 align="center" class="titulos">Consultar Saldos x Aseguradora <?php echo $leyenda; ?>
</h1>
<form name="form2" id="form2" method="post" action="">
  <table width="524" height="72" border="0.2" align="center" cellpadding="0" cellspacing="0" class="enlace">
    <tr valign="top" bordercolor="#FFFFFF" class="catalogo">
      <td height="36" class="normalmid">Seguro</td>
      <td bordercolor="#FFFFFF"><input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="60" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      <td bordercolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr valign="top" bordercolor="#FFFFFF" class="catalogo">
      <td width="185" height="36" class="normalmid"><div align="center"><span class="negro">
        <input name="seguro" type="hidden" class="Estilo24" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		 />
      </span></div>
      <input name="numeroEx" type="hidden" class="Estilo24" id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="" /></td>
      <td width="240" bordercolor="#FFFFFF"><div align="center">
        <label>
        <input name="search" type="submit" id="search" value="Buscar" />
        </label>
      </div></td>
	  
	  
	  

      <td width="97" bordercolor="#FFFFFF"><label></label>
        <div align="center">
      &nbsp;</div></td>
    </tr>
  </table>
</form>


	  	<?php 
	if( $_POST['search'] and $_POST['seguro']){
	
	$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$_POST['seguro']."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
?>
<form name="form1" method="post" action="">
    <p align="center">ESTE SEGURO TIENE UN LIMITE DE: <span class="codigos"><?php echo '$'.number_format($myrow7ab['cantidad'],2);?></span></p>
    <p align="center">Movimientos periodo: <?php echo cambia_a_normal($myrow7n['fechaInicial']).' al '.cambia_a_normal($myrow7n['fechaFinal']);?> </p>
    <table width="644" border="0" align="center">
      <tr>
        <th width="122" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Matricula</div></th>
        <th width="122" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Fecha</div></th>
        <th width="280" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Px</div></th>
        <th width="102" bgcolor="#660066" scope="col"><div align="left" class="blancomid style1">Cantidad</div></th>
      </tr>
      <tr>
        <?php	


$sSQL= "Select * from clientesInternos where entidad='".$entidad."' and seguro='".$_POST['seguro']."'

and (fecha >='".$myrow7n['fechaInicial']."' and fecha<='".$myrow7n['fechaFinal']."' ) 
and 
statusCaja='pagado'

";
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




$sSQL7a1= "Select *  from pacientes where entidad='".$entidad."'  and numCliente='".$myrow['numeroE']."'  ";
$result7a1=mysql_db_query($basedatos,$sSQL7a1);
$myrow7a1 = mysql_fetch_array($result7a1);


$sSQL7a= "Select sum(precioVenta*cantidad) as c  from cargosCuentaPaciente where entidad='".$entidad."'  and folioVenta='".$myrow['folioVenta']."'  and naturaleza='A' and gpoProducto=''  ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);

$sSQL7c= "Select sum(precioVenta*cantidad) as c  from cargosCuentaPaciente where entidad='".$entidad."'  and folioVenta='".$myrow['folioVenta']."'  and naturaleza='C' and gpoProducto=''  ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);



$total=$myrow7a['c']-$myrow7c['c'];






?>

        <td bgcolor="<?php echo $color?>" class="normalmid"><?php 
		if($myrow['credencial']){
		echo $myrow['credencial']; 
		}else{
		echo '---';
		}
		?></td>
        <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo cambia_a_normal($myrow['fecha1']);?></td>
        <td bgcolor="<?php echo $color?>" class="normalmid">
		<?php if(!$myrow7a1['nombreCompleto']){


echo $myrow['paciente'];
echo   '</br>'.'-Sin Expediente-';
} else{
echo $myrow7a1['nombreCompleto'];
}
		?></td>
        <td bgcolor="<?php echo $color?>" class="normalmid">
		<?php 
		if($total>=$myrow7ab['cantidad']){
		echo '<span class="codigos"><blink>'.'$'.number_format($total,2).'</blink></span>'; 
		}else{
		echo '$'.number_format($total,2); 
		}
		?>		</td>
      </tr>
      <?php  } //cierra while ?>
    </table>
    
</form>
	<?php } ?>

	  
	  
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
			return "/sima/cargos/clientesLimites.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	  
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
