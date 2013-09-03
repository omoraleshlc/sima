<?php require("/configuracion/ventanasEmergentes.php"); ?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librera principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librera para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script>
function cerrarVentana(){
close();
}
</script>

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
           
        if( vacio(F.nombre1.value) == false ) {   
                alert("Por Favor, escoje el nombre del paciente!")   
                return false   
        } else if( vacio(F.apellido1.value) == false ) {   
                alert("Por Favor, escribe el apellido paterno del paciente!")   
                return false   
        } else if( vacio(F.apellido2.value) == false ) {   
                alert("Por Favor, escribe el apellido materno del paciente!")   
                return false   
        }            
}   
  
  
  
  
</script>

<!-- set focus to a field witd tde name "searchcontent" in my form -->
<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
<SCRIPT LANGUAGE="JavaScript">
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
</SCRIPT>
<?php




if($_POST['actualizar'] and $_POST['MATRICULA'] and $_POST['NOMBRE'] and $_POST['APATERNO'] and $_POST['GENERO']){ 
 $sSQL1= "Select  * From ALUMNOSINSCRITOS WHERE ENTIDAD='".$entidad."' AND MATRICULA = '".$_POST['MATRICULA']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


if(!$myrow1['MATRICULA']){

$agrega = "INSERT INTO ALUMNOSINSCRITOS (
ENTIDAD,MATRICULA,NOMBRE,APATERNO,AMATERNO,GENERO,CARRERA,MODALIDAD,SEGURO,PERIODO,usuario,fecha,hora
) values (
'".$entidad."','".$_POST['MATRICULA']."','".strtoupper($_POST['NOMBRE'])."','".strtoupper($_POST['APATERNO'])."',
'".strtoupper($_POST['AMATERNO'])."','".$_POST['GENERO']."',
'".strtoupper($_POST['CARRERA'])."','Presencial','7054019','1','".$usuario."','".$fecha1."','".$hora1."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error(); 
echo '<script >
window.alert( "EL ALUMNO FUE AGREGADO");
   //window.opener.document.forms["form1"].submit();
//window.close();
</script>';

}else{


 $q = "UPDATE ALUMNOSINSCRITOS set
 
NOMBRE='".strtoupper($_POST['NOMBRE'])."',

APATERNO='".strtoupper($_POST['APATERNO'])."',
AMATERNO='".strtoupper($_POST['AMATERNO'])."',
GENERO='".strtoupper($_POST['GENERO'])."',
CARRERA='".strtoupper($_POST['CARRERA'])."'
WHERE 
MATRICULA='".$_POST['MATRICULA']."' and ENTIDAD='".$entidad."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
//echo 'El paciente fue actualizado';
echo '<script >
window.alert( "EL ALUMNO FUE ACTUALIZADO");
   //window.opener.document.forms["form1"].submit();
//window.close();
</script>';

}
 }







if($_POST['borrar'] AND $_POST['MATRICULA']){
$borrame = "DELETE FROM ALUMNOSINSCRITOS WHERE ENTIDAD='".$entidad."' and MATRICULA ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert ("EL ALUMNO FUE ELIMINADO");
</script>';
}






if(($_POST['MATRICULA'] or $_GET['MATRICULA']) AND !$_POST['nuevo']){
if($_GET['MATRICULA']){
$_POST['MATRICULA']=$_GET['MATRICULA'];
}

if(!$_GET['MATRICULA']){
$sSQL= "Select  * From ALUMNOSINSCRITOS WHERE entidad='".$entidad."' AND MATRICULA='".$_GET['MATRICULA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

}else{
$sSQL= "Select  * From ALUMNOSINSCRITOS WHERE entidad='".$entidad."' AND MATRICULA = '".$_POST['MATRICULA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
}



?>





<script language=javascript> 
function ventanaSecundaria13 (URL){ 
   window.open(URL,"ventana13","width=500,height=500,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=450,height=390,scrollbars=YES") 
} 
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<script src="/sima/js/prototype.js" type="text/javascript"></script>
	<script src="/sima/js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="/sima/js/lightboxXL.js" type="text/javascript"></script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>

<body>

<form id="form1" name="form1" method="post"   >
<p align="center">&nbsp;</p>

<table width="606" class="table-forma">
    <tr >
      <th height="21" colspan="3"  scope="col"><div align="center" >
        
   Datos Personales del Alumnos
      </div></th>
    </tr>
    <tr>
      
	  
	  <td   scope="col"><div align="left" >MATRICULA</div></td>
      <td   scope="col"><div align="left"><span >
<input name="MATRICULA" type="text"  id="nombre2" value="<?php echo $myrow['MATRICULA']; ?>" size="10"
       <?php if($myrow['MATRICULA']!=NULL)echo 'readonly=""';?>
       />
      </span></div></td>

	  
      <td width="210" rowspan="7" align="center" valign="top"   scope="col"><p align="center">
        <?php if($myrow['ruta']!='images/' AND $myrow['ruta']){ ?>
        <a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['NOMBRE']." ".$myrow['APATERNO']; ?>">

<img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="136" height="151" border="2" /></a>
 
 <a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"></a></p>
        <?php } 
		else {?>
			
            <img src='../images/universal.gif' width="136" height="151">
            
			<?php } 
		?>		</td>
    </tr>
    <tr>
	
      <td width="128"   scope="col"><div align="left" >Primer Nombre </div></td>
      <td width="262"   scope="col"><label>
        <div align="left">
          <input name="NOMBRE" type="text"  id="nombre1" value="<?php echo $myrow['NOMBRE']; ?>" size="30" />
        </div>
      </label></td>
    </tr>




    <tr>
      <td  >Apellido Paterno</td>
      <td  ><input name="APATERNO" type="text"  id="apellido1" value="<?php echo $myrow['APATERNO']; ?>" size="30" /></td>
    </tr>


    <tr>
      <td  >Apellido Materno</td>
      <td  ><input name="AMATERNO" type="text"  id="apellido2" value="<?php echo $myrow['AMATERNO']; ?>" size="30" /></td>
    </tr>

     <tr>
      <td  >Genero (sexo)</td>
      <td  >

          <select name="GENERO"  >
              <option value="">---</option>
              <option
                  <?php if($myrow['GENERO']=='F')echo 'selected=""';?>
                  value="F">F</option>
              <option
                  <?php if($myrow['GENERO']=='M')echo 'selected=""';?>
                  value="M">M</option>

          </select>

      </td>



    </tr>




         <tr>
      <td  >Carrera</td>
      <td  >


<input name="CARRERA" type="text"  id="apellido2" value="<?php echo $myrow['CARRERA']; ?>" size="30" /></td>


      </td>



    </tr>



    
    <tr >
      <td height="33" colspan="4" >&nbsp;</td>
    </tr>
</table>








<?php
//solo por el verano

$year=date("Y");
$inicio=$year.'-06-13';
$fin=$year.'-08-12';

//if($fecha1>=$inicio and $fecha1<=$fin){
?>
<table width="578" border="0" align="center"  cellspacing="0">
</table>
  <br>
  <table width="530" border="0" align="center">




    <tr>
      <td width="127" align="center" valign="top"><div align="center">
        <input name="nuevo" type="submit" src="../imagenes/btns/newbutton.png" class="boton1"  id="nuevo3" value="Nuevo" />

        <input name="keyClientesInternos" type="hidden"  id="nuevo" value="<?php echo $_GET['keyClientesInternos'];?>" />
      </div></td>
        
      <td width="129" align="center" valign="top"><div align="center">
        <input name="actualizar" type="submit" src="../imagenes/btns/modifybutton.png" class="boton1" id="actualizar" value="Modificar/Grabar" />
    
      </div></td>


      <td width="128" align="center" valign="top"><div align="center">
        <input name="close" type="submit" src="../../imagenes/btns/close.png"  class="boton1" id="close" value="Cerrar Ventana (x)" onClick="cerrarVentana()">
      </div></td>
    </tr>



        <?php //} else {

         //print '<span class="error">Este modulo solo funciona por el verano..!</span>'   ;

        //}?>





  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

<p>&nbsp;</p>

</body>
 </html>
