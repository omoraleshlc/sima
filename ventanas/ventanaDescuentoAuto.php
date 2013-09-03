<?php require('/configuracion/ventanasEmergentes.php');
require("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","widtd=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript>
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","widtd=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","widtd=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","widtd=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","widtd=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","widtd=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","widtd=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
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
        for ( i = 0; i < q.lengtd; i++ ) {   
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
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,widtd=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>









<?php //transaccion estatica

if($_POST['aplicar'] ){
        
    
   // echo  $_POST['porcentaje']. '  '.$_POST['gpoProducto'].'  '.$_POST['fechaInicial'].'  '.$_POST['fechaFinal'];
    
    
        if($_POST['porcentaje']>0 and $_POST['gpoProducto']!=NULL  and $_POST['fechaInicial'] and $_POST['fechaFinal']){



 $sSQL7a= "Select * From descuentosAutomaticos where entidad='".$entidad."' 
    and
    departamento='".$_GET['almacen2']."'
and 
gpoProducto= '".$_POST['gpoProducto']."'  ";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();


if($myrow7a['departamento']){

echo '<script>';
echo 'window.alert("Ya existe ese descuento");';
echo '</script>';

}else{
$agrega = "
INSERT INTO descuentosAutomaticos (departamento,fechaInicial,fechaFinal,usuario,entidad,gpoProducto,seguro,porcentaje,tipoPaciente,tipoDescuento)
values
('".$_GET['almacen2']."','".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$entidad."',
'".$_POST['gpoProducto']."','".$_POST['seguro']."','".$_POST['porcentaje']."','".$_POST['tipoPaciente']."','".$_POST['tipoDescuento']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo '<script>';
echo 'window.alert("Se hizo el descuento del '.$_POST['porcentaje'].'");';
echo 'window.close();';
echo '</script>';
}



$sSQL7= "Select descripcionGP From gpoProductos where codigoGP='".$_POST['gpoProducto']."'";
$result7=mysql_db_query($basedatos,$sSQL7); 
$myrow7 = mysql_fetch_array($result7);
echo mysql_error();
        }else{
            echo 'TE FALTAN CAMPOS POR LLENAR!';
        }
}
?>








<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
<script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">




<head>

<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>



<BODY  >
<h1 >&nbsp;</h1>
<h1 >Aplicar Descuento Autom&aacute;tico </h1>
<p  >&nbsp;</p>
<form name="form1" method="post"  >
  <div align="center">
    <p>&nbsp;</p>
    <table widtd="423" class="table-forma" >
        
        
        
        
<tr>
        <td widtd="85" scope="col"><div align="left"><span >Tipo Descuento</span></div></td>
        <td widtd="322" scope="col"><div align="left"><span >
   
            <select name="tipoDescuento" >
              <option value="particular">Particular</option>
             <option value="aseguradora">Aseguradora</option>
             <option value="ambos">Ambos</option>
            </select>
        </span></div></td>
      </tr>        
        
        
        
        
        
        
        
        
        
        
      <tr>
        <td widtd="85" scope="col"><div align="left"><span >Grupo de Producto</span></div></td>
        <td widtd="322" scope="col"><div align="left"><span >
            <?php //*********gpoProductos

 $sSQL7= "Select * From gpoProductos  ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
            <select name="gpoProducto" >
              <option value="">ESCOJE EL GRUPO</option>
              <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
              <option 
		   <?php if($_POST['gpoProducto']==$myrow7['codigoGP']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
              <?php } 
		
		?>
            </select>
        </span></div></td>
      </tr>
 
        
      <tr>
        <td>Fecha Inicial</td>
        <td><label>
          <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="10" maxlengtd="10" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
        </label>
          <input name="button" type="button" class="Estilo24" id="lanzador" value="..." /></td>
      </tr>
      <tr>
        <td>Fecha Final</td>
        <td><label>
          <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="10" maxlengtd="10" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
        </label>
          <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." /></td>
      </tr>
     
      <tr>
        <td><div align="left">Porcentaje: </div></td>
        <td><label>
            <div align="left">
              <input name="porcentaje" type="text"  id="porcentaje" size="3"  value="<?php echo $_POST['porcentaje'];?>"  <?php echo $statusD?> autocomplete="off" />
            </div>
          </label>
            <label></label></td>
      </tr>

    </table>
  </div><br /><br />
  
  <input name="aplicar" type="submit"  id="aplicar" value="Aplicar" <?php echo $statusD?> /></td>
 

  <p align="center">&nbsp;</p>
</form>
  <script>
		new Autocomplete("nomSeguro", function() { 
			tdis.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If tde user modified tde text but doesn't select any new item, tden clean tde hidden value.
			if ( tdis.isModified )
				tdis.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if tdis request is not fired by search icon click
			if ( tdis.value.lengtd < 4 && tdis.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + tdis.value;
			// return "completeEmpName.php?q=" + tdis.value;
		});	
	</script>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
</body>
</html>