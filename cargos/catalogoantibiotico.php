<?PHP require("/configuracion/ventanasEmergentes.php"); ?>

<script language=javascript> 
function ventanaSecundaria31 (URL){ 
   window.open(URL,"ventanaSecundaria31","width=800,height=700,scrollbars=YES") 
} 
</script> 
<?php






if($_POST['actualizar']  ){
    
    
if(  $_POST['cedula'] and $_GET['keyClientesInternos']!=NULL and $_POST['tratamientocontinuo']!=NULL){    
  $sSQL1= "Select * From antibioticos WHERE entidad='".$entidad."' and keyClientesInternos='".$_GET['keyClientesInternos']."' and keyPA='".$_GET['keyPA']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);




//# 	Column 	Type 	Collation 	Attributes 	Null 	Default 	Extra 	Action
//	1 	keyanti 	int(11) 			No 	None 	AUTO_INCREMENT 	Change Change 	Drop Drop 	More Show more actions
//	2 	fechaentrada 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	3 	proveedor 	varchar(20) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	4 	direccion 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	5 	numfactura 	varchar(20) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	6 	numlote 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	7 	cantidadpiezae 	int(4) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	8 	fechasello 	varchar(10) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	9 	nombremedico 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	10 	cedula 	varchar(30) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	11 	direccionmedico 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	12 	universidad 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	13 	paciente 	varchar(200) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	14 	piezas 	int(7) 			No 	None 		Change Change 	Drop Drop 	More Show more actions
//	15 	tratamientocontinuo 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
//	16 	entidad 	char(2) 	utf8_spanish2_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions



if(!$myrow1['keyClientesInternos']){




$agrega = "INSERT INTO antibioticos (
fechaentrada,
proveedor,
direccion,
numfactura,
numlote,
cantidadpiezae,
fechasello,
nombremedico,
cedula,
universidad,
paciente,
piezas,
tratamientocontinuo,
entidad,
keyClientesInternos,
usuario,
fechacaptura,
horacaptura,
status,
direccionmedico,keyCAP,numeroE,especialidad,fechafinal,keyPA,almacen,fechacaducidad,grupo
) values (
'".$_POST['fechaentrada']."',
'".$_POST['proveedor']."',
'".$_POST['direccion']."',
'".$_POST['numfactura']."',
    '".$_POST['numlote']."',
'".$_POST['cantidadpiezae']."',



    '".$_POST['fechasello']."',
'".$_POST['nombremedico']."',
    '".$_POST['cedula']."',
        '".$_POST['universidad']."',
'".$_GET['paciente']."',
    '".$_GET['cantidadpiezas']."',
        '".$_POST['tratamientocontinuo']."',
    '".$entidad."',
        '".$_GET['keyClientesInternos']."',
            '".$usuario."',
                '".$fecha1."',
                    '".$hora1."',
                        'standby',
                        '".$_POST['direccion']."',
                            '".$_GET['keyCAP']."',
                                 '".$_GET['numeroE']."','".$_POST['especialidad']."','".$_POST['fechafinal']."','".$_GET['keyPA']."','".$_GET['almacen']."',
                                         '".$_POST['fechacaducidad']."','".$_POST['grupo']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script>
window.alert( "SE AGREGO EL MEDICO!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';




} else {


//fechasello,
//nombremedico,
//cedula,
//universidad,
//paciente,
//piezas,
//tratamientocontinuo,
//entidad,
//keyClientesInternos,
//usuario,
//fechacaptura,
//horacaptura,
//status,
//direccionmedico

 $q = "UPDATE antibioticos set
     grupo='".$_POST['grupo']."',
     piezas='".$_GET['cantidadpiezas']."',
     numlote='".$_POST['numlote']."',
          fechacaducidad='".$_POST['fechacaducidad']."',
     fechafinal='".$_POST['fechafinal']."',
     especialidad='".$_POST['especialidad']."',
    fechasello='".$_POST['fechasello']."',
    nombremedico='".$_POST['nombremedico']."',
cedula='".$_POST['cedula']."',
universidad='".$_POST['universidad']."',

tratamientocontinuo='".$_POST['tratamientocontinuo']."',
direccionmedico='".$_POST['direccion']."'


WHERE
entidad='".$entidad."'
    and
keyClientesInternos='".trim($_GET['keyClientesInternos'])."'
    and
    keyPA='".$_GET['keyPA']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>
window.alert( "SE ACTUALIZARON DATOS!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';

$sSQL= "Select * From medicos WHERE entidad='".$entidad."' AND numMedico = '".$_POST['numMedico']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}


}else{
    echo '<div class="error">Los Campos -Cedula- y -Tipo de Tratamiento- no pueden quedar vacios!</div>';
}
}














if($_POST['borrar'] AND $_GET['keyMedico']){
$borrame = "DELETE FROM antibioticos WHERE keyMedico='".$_GET['keyMedico']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script>
window.alert( "SE ELIMINARON DATOS!");
</script>';

}

?>



 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

</head>

<body onLoad="MM_preloadImages('/sima/imagenes/bordestablas/btns/newbtn.png')">
<h1 align="center" > FORMULARIO DE ANTIBIOTICOS<br />
<br />
</h1>
    
    
    
    
    
    
    
    
<?php 
$sSQL31= "Select * From antibioticos WHERE entidad='".$entidad."' and keyClientesInternos='".$_GET['keyClientesInternos']."' and keyPA='".$_GET['keyPA']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if(!$_POST['cedula']){
    $_POST['cedula']=$myrow31['cedula'];
}



$paciente=$myrow31['paciente'];



$sSQL= "Select * From articulos WHERE  keyPA = '".$_GET['keyPA']."' or keyPA='".$myrow['keyPA']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
?>
    
    
    <form id="form1" name="form1" method="post"  >




<table width="348" >
<tr>
         
       

    <td width="118" align="right"><div align="center"><input name="actualizar" type="Submit" src='/sima/imagenes/bordestablas/btns/refreshbtn.png' class="Estilo24" id="actualizar" value="Agregar/Actualizar" />
    </div></td>
 
  </tr>

</table>




<div align="right"></div>






<table width="618" class="table-forma">





    <tr >
      <th colspan="3"  scope="col"><div align="left" class="">
        <div align="center" >Datos Generales</div>
      </div>        </th>
    </tr>
    <tr >
      <td  scope="col"><div align="left" >Nombre Paciente</div></td>
<td  scope="col"><div align="left" ><?php echo $_GET['paciente'];?></div></td>

<td  scope="col">&nbsp</td>
<tr >
      <td width="149"  scope="col"><div align="left" >Cantidad</div></td>
    <td width="270" scope="col"><label>
<div align="left" >
           <?php echo round($_GET['cantidadpiezas'],3);?>
</div>
      </label></td>
<td  scope="col">&nbsp</td>
    </tr>



<tr >
      <td width="149"  scope="col"><div align="left">Antibiotico</div></td>
    <td width="270" scope="col"><label>
<div align="left" >
           <?php echo $_GET['descripcion'];?>
</div>
      </label></td>
      
      <td  scope="col">&nbsp</td>
    </tr>
    
    
    
    <tr>
      <td width="149" class="Estilo24" scope="col"><div align="left" class="negromid">Grupo</div></td>
    <td width="270" class="Estilo24" scope="col"><label>
            
            
<?php             
$sSQL= "Select * From articulos WHERE  keyPA = '".$_GET['keyPA']."'  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
<div align="left" >
         <select name="grupo" >
                  <option
                      <?php if($myrow['grupo']=='' or $myrow31['grupo']=='' or $_POST['grupo']=='' ){echo'selected=""';}?>
                      value="">Escoje</option>
                  
                  <option
                      <?php if($myrow['grupo']=='I' or $myrow31['grupo']=='I' or $_POST['grupo']=='I'){echo'selected=""';}?>
                      value="I">I</option>
                      
                  
                  <option
                      <?php if($myrow['grupo']=='II' or $myrow31['grupo']=='II' or $_POST['grupo']=='II'){echo'selected=""';}?>
                      value="II">II</option>
                       
                                    
                      <option
                      <?php if($myrow['grupo']=='III' or  $myrow31['grupo']=='III' or $_POST['grupo']=='III'){echo'selected=""';}?>
                      value="III">III</option>
                                                      
                     <option
                      <?php if($myrow['grupo']=='IV' or $myrow31['grupo']=='IV' or $_POST['grupo']=='IV'){echo'selected=""';}?>
                      value="IV">IV</option>
                                                                                    
                        <option
                      <?php if($myrow['grupo']=='V' or $myrow31['grupo']=='V'  or $_POST['grupo']=='V'){echo'selected=""';}?>
                      value="V">V</option>
                                                  
                                                                     <option
                      <?php if($myrow['grupo']=='VI'  or $myrow31['grupo']=='VI' or $_POST['grupo']=='VI'){echo'selected=""';}?>
                      value="VI">VI</option>
                                                                         
                                                        
                                                        
              </select>
</div>
      </label></td>
      
      <td  scope="col">&nbsp</td>
    </tr>
    
    
    
    

<tr >
      <td width="149"  scope="col"><div align="left" class="negromid">Numero Lote</div></td>
    <td width="270" scope="col"><label>
<div align="left" >
           <input name="numlote" type="text"  value="<?php 
          if($myrow31['numlote']!=NULL){
          echo $myrow31['numlote']; 
          }else if($_POST['numlote']!=NULL){
          echo $_POST['numlote'];     
          }
          
          ?>" size="10" />
</div>
      </label></td>
      <td  scope="col">&nbsp</td>
    </tr>

<tr>
      <td width="149"  scope="col"><div align="left" >Fecha Sello Antibiotico</div></td>
    <td width="270" scope="col"><label>

            <input name="fechasello" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($myrow31['fechasello']){
		 echo $myrow31['fechasello'];
		 }else if($_POST['fechasello']){
                     echo $_POST['fechasello'];
                 }else{
                     echo $fecha1;
                 }
		 ?>"/>
            </label>
            <input name="button" type="button"  id="lanzador" value="..." />

    </td>
    
    <td  scope="col">&nbsp</td>
    </tr>

<tr >
      <td width="149"  scope="col"><div align="left" >Fecha Caducidad</div></td>
    <td width="270" scope="col"><label>
<div align="left" >
            <input name="fechacaducidad" type="text"  id="campo_fecha2" size="9" maxlength="9" readonly=""
		value="<?php
		 if($myrow31['fechacaducidad']){
		 echo $myrow31['fechacaducidad'];
		 }else{
                     echo $_POST['fechacaducidad'];
                 }
		 ?>"/>
            </label>
            <input name="button" type="button"  id="lanzador2" value="..." />

    </td>
    
    <td  scope="col">&nbsp</td>
    </tr>






    <tr >
      <td >Tipo Tratamiento</td>
      <td >
        <label>
 
            <select name ="tratamientocontinuo">
                <option value="">Escoje</option>
                <option
                    <?php if($myrow31['tratamientocontinuo']=='Completo' or $_POST['tratamientocontinuo']=='Completo'){echo 'selected=""';} ?>
                    value="Completo">Completo</option>
                <option
                    <?php if($myrow31['tratamientocontinuo']=='Incompleto' or $_POST['tratamientocontinuo']=='Incompleto'){echo 'selected=""';} ?>
                    value="Incompleto">Incompleto</option>
            </select>
      
       
        </label></td>
        <td  scope="col">&nbsp</td>
    </tr>




<tr >
      <td width="149" scope="col"><div align="left" class="negromid">*Opcional si el tratamiento es incompleto, escoja la fecha de terminacion</div></td>
    <td width="270"  scope="col"><label>
<div align="left" >
            <input name="fechafinal" type="text" class="normal" id="campo_fecha1" size="9" maxlength="9" readonly=""
		value="<?php
		 if($myrow31['fechafinal']){
		 echo $myrow31['fechafinal'];
		 }else{
                     echo $_POST['fechafinal'];
                 }
		 ?>"/>
                        <input name="button" type="button" class="normal" id="lanzador1" value="..." />

    </td>
    
    <td  scope="col">&nbsp</td>
    </tr>



<?php
if( $_POST['cedula']!=NULL){
 $sSQL31= "Select * From medicosantibioticos WHERE entidad='".$entidad."' and cedula='".$_POST['cedula']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
}

?>






    <tr>
      <th height="20" colspan="3" ><div align="center">Informacion Medico</div></th>
    </tr>
    

    <tr>
      <td >Nombre del Medico</td>
      <td >
         
          <input name="nombremedico" type="text" class="normalmid" onchange="javascript:this.form.submit();"  value="<?php 
          if($myrow31['nombremedico']!=NULL){
          echo $myrow31['nombremedico']; 
          }else{
          echo $myrow31['nombreCompleto'];     
          }
          
          ?>" size="45" /></td>
<td  scope="col">&nbsp</td>
    </tr>

    
    
        <tr>
      <td >Cedula Profesional</td>
    
      <td>
      <input name="cedula" type="hidden"  id="cedula" value="<?php echo $myrow31['cedula']; ?>" size="15"  />     
         <?php echo $myrow31['cedula']; ?>
      </td>
      
      
      
      
      <td >
          <a href="#"   onclick="javascript:ventanaSecundaria31('ventanaModificarMedicos.php?keyMedico=<?php echo $myrow31['keyMedico'];?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $N?>')">
    
        -Nuevo/Editar-
    
    </a>
      </td>
    </tr>
    
    
    

    <tr>
      <td >Especialidad</td>
      <td >
      	 <?php 
         $aCombo= "Select * From especialidades where 
entidad='".$entidad."'  
and
codigo='".$myrow31['especialidad']."'
";
$rCombo=mysql_db_query($basedatos,$aCombo); 
        $resCombo = mysql_fetch_array($rCombo);
        echo $resCombo['descripcion'];
         
         ?>
          
      </td>
      <td  scope="col">&nbsp</td>
    </tr>


    <tr>
      <td >Direccion</td>
      <td >
         
         <?php 
         if($myrow31['direccionmedico']){
         echo $myrow31['direccionmedico'];
         }else{
             echo $myrow31['direccion'];
         }
         ?>
       <input name="direccion" type="hidden"   value="<?php 
         if($myrow31['direccionmedico']){
         echo $myrow31['direccionmedico'];
         }else{
             echo $myrow31['direccion'];
         }
         ?>"  />
      </td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Universidad de donde Egreso</td>
      <td ><?php echo $myrow31['universidad']; ?>
      <input name="universidad" type="hidden"   value="<?php echo $myrow31['universidad']; ?>"  />
      </td>
      <td >&nbsp;</td>
    </tr>





    </tr>

  </table>
  

  
</form>




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
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
    <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha2",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario
});
</script>



  <script>
		new Autocomplete("nombremedico", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("cedula")[0].value = id;
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
			return "/sima/cargos/medicosantibioticosx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $_GET['almacen'];?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
