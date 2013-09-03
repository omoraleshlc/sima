<?php require('/configuracion/ventanasEmergentes.php');
require("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?>






<?php  
if($_GET['gpoProducto'] AND ($_GET['del']=='si' and $_GET['keyPP']!=NULL)){

	
$q = "DELETE FROM politicasPrecios 
		WHERE keyPP='".$_GET['keyPP']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='REGISTRO ELIMINADO...';
}
?>






<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript>
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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



<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
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

if($_POST['aplicar']!=NULL and $_POST['rangoInicial']>0 and $_POST['rangoFinal']>0 and $_POST['porcentaje']>0 and $_GET['gpoProducto']!=NULL){




$sSQL7a= "Select * From politicasPrecios where 
    entidad='".$entidad."' 
and
gpoProducto= '".$_GET['gpoProducto']."'


";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();



$agrega = "
INSERT INTO politicasPrecios (gpoProducto,rangoInicial,rangoFinal,usuario,fecha,hora,porcentaje,almacen,entidad)
values
('".$_GET['gpoProducto']."','".$_POST['rangoInicial']."','".$_POST['rangoFinal']."','".$usuario."','".$fecha1."',
'".$hora1."','".$_POST['porcentaje']."','".$_GET['almacen']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='SE AGREGO EL '.$_POST['porcentaje'].'%...';
    






}

//$sSQL7= "Select * From politicasPrecios where entidad='".$entidad."' and almacen='".$_GET['almacen']."'";
//$result7=mysql_db_query($basedatos,$sSQL7); 
//$myrow7 = mysql_fetch_array($result7);
//echo mysql_error();
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
<h1 align="center" class="titulos">&nbsp;</h1>
<h1 align="center" class="titulos">Aplicar Politica al departamento</h1>
<?php echo $_GET['descripcion'];?>

<p align="center" class="negro">
  <div align="center" class="error">  
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>    
    </div>
</p>

<form id="form1" name="form1" method="post">
    
  <div align="center">
    <p><?php echo $_GET['descripcionGP'];?></p>
    
    
    
    
    
    <table width="200" class="table-forma">
      <tr>
        
      </tr>

      

      
      
      
      <tr>
        <td>Rango Inicial</td>
        <td><label>
          <input name="rangoInicial" type="text"  id="rangoInicial" size="10" 
		value="<?php
		 
                     echo $myrow7['rangoInicial'];
                 
		 ?>"/>
        </label>
         </td>
      </tr>
      
      
      
      <tr>
        <td>Rango Final</td>
        
        
        
        <td><label>
          <input name="rangoFinal" type="text"  id="rangoFinal" size="10" 
		  value="<?php
		 
                     echo $myrow7['rangoFinal'];
                 
		 ?>"/>
        </label>
         
        </td>
        
      </tr>
      
      

      
      
      
      <tr>
        <td><div align="left">Porcentaje </div></td>
        <td><label>
            <div align="left">
              <input name="porcentaje" type="text"  id="porcentaje" size="5"  value="<?php echo $myrow7['porcentaje'];?>"  autocomplete="off" />%
            </div>
          </label>
            <label></label></td>
      </tr>
  
    </table>
    <br /><br />
    <input name="aplicar" type="submit"  id="aplicar" value="Aplicar" <?php echo $statusD?> />
  </div>
 
<br />
  <p align="center">
      
       <table width="300" class="table table-striped">
     <tr >
       <th width="26" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>

         

         
         


         
         <th width="41"  scope="col"><div align="center" >
         <div align="center">Inicial</div>
       </div></th>
         

       <th width="41"  scope="col"><div align="center" >
         <div align="center">Final</div>
       </div></th>
       
       
              <th width="20"  scope="col"><div align="center" >
         <div align="center">Porcentaje</div>
       </div></th>
       
       <th width="41"  scope="col"><div align="center" >
         <div align="center">Eliminar</div>
       </div></th>
     </tr>
     
     
     
     
<?php   

$sSQL= "Select * From politicasPrecios 
    where
    entidad='".$entidad."'
        and
        gpoProducto='".$_GET['gpoProducto']."'
order by rangoInicial ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;


/*
$sSQL7a= "Select * From politicasPrecios where entidad='".$entidad."' and 
almacen='".$myrow['almacen']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();
*/
?> 





   <tr >
       
         
         <td ><?php echo $f;?></td> 
       
       

       
       
       
       
       
       
       
       
       
       
              <td >
	   

         <div align="center">
           
<?php echo $myrow['rangoInicial'];?>
         
       </div></td>
       
       
       

		
		
       <td >
	   
	    
         <div align="center">
           
<?php echo $myrow['rangoFinal'];?>

             
       </div></td>
       
       
       
       
       		
       <td >
	   
	    
         <div align="center">
           
<?php echo $myrow['porcentaje'];?>

             
       </div></td>
       
       
       
       
       
       
       
              <td >
	   
	    
         <div align="center">
           
             <a  href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria1('/sima/ventanas/ventanaAsignarPoliticas.php?gpoProducto=<?php echo $myrow['gpoProducto']; ?>&del=si&descripcionGP=<?php echo $_GET['descripcionGP']; ?>&amp;keyPP=<?php echo $myrow['keyPP']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
            
            Eliminar
              
             </a>

             
       </div></td>
       
       
     </tr>
     <?php }}?>
   </table>
      
  </p>
</form>
<br>
<br>
</body>
</html>