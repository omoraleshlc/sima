<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
<?php if($MEDICO!=NULL){ ?>

<?PHP require("/configuracion/funciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=1200,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=700,height=600,scrollbars=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 



<?php
$cargosTotales=new acumulados(); 
$verificaCargos=new acumulados();


///**********************
//**********************CIERRO CAMBIAR ALMACEN******************************

if($_POST['activar']){
$numeroE=$_POST['numeroE'];
foreach($numeroE as $i =>$recorrePila){
$q1 = "UPDATE clientesAmbulatorios set 
entregaExpediente='entregado'
WHERE numeroE = '".$numeroE[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}


if($ID_TIPO=='08'){
$encabezado='DR(a).:';
} else if($ID_TIPO=='09'){
$encabezado='Supervisor:';
} else if($usuario=='omorales'){
$encabezado='Administrador: ';
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

</head>

<body>
<?php 
$estilos=new muestraEstilos();
$estilos->styles(); 
?>


<h2 align="center" class="titulomed">Pacientes por Consultar  </h2>

<form id="form1" name="form1" method="POST" >
<table  class="normalmid" align="center" width="300" style="border: 1px solid #80FFFF;">

    <?php
    if($_POST['fechaInicial']) { $fechaInicio=$_POST['fechaInicial'];}else{ $fechaInicio=$fecha1;}

    ?>



     <tr>
       <td class="normalmid">Fecha </td>
       <td><span class="titulo">
         <label>
         <input name="fechaInicial" type="text" class="normal" id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php echo $fechaInicio; ?>" />
         </label>
         <input name="button" type="button" class="normal" id="lanzador" value="..." />


        <input name="mostrar" type="submit" class="normal" id="mostrar2" value="Buscar" />
           </span>
       </td>
          

     </tr>
</th>
</table>
<br></br>












<table  class="normalmid" align="center" width="500" style="border: 1px solid #80FFFF;">
<thead>
<tr class="normalmid"  align="left" onclick="onMouseClickRow('prs_','','#fdfde7', '#ffffff', '#F7F9FB');" onmouseover="onMouseOverRow('prs_','','#fdfde7', '#f9f9e3');" onmouseout="onMouseOutRow('prs_','','','#fdfde7');">

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Hora
        </b>
    </a>
</th>


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Expediente
        </b>
    </a>
</th>


    <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalid" href='javascript:void("abrir");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Nombre
        </b>
    </a>
</th>

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            FechaN
        </b>
    </a>
    
      <img src="sample_2_7_demo.php_files/question_mark.gif" class="normalmid" alt="" title="Muestra La Fecha de Nacimiento">
</th>




<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';">
    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=5&amp;prs_sort_field_by=&amp;prs_sort_field_type=string|numeric&amp;prs_sort_type=asc");' title="Sort">
        <b>Status</b>
    </a>
</th>


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';">
    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=6&amp;prs_sort_field_by=&amp;prs_sort_field_type=numeric&amp;prs_sort_type=asc");' title="Sort">
        <b>TipoPx</b>
    </a>
</th>


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';">
    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=7&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>HClinica</b>
    </a>
</th>

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">
    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=10&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Antecedentes</b>
    </a>
</th>

</tr>
</thead>


<tbody>


<?php



 $sSQL1= "SELECT almacen
FROM
almacenes
WHERE
entidad='".$entidad."'

and
id_medico='".$MEDICO."'
and
(almacenPadre!='' and almacenPadre='".$ALMACEN."')
";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);



$sSQL= "SELECT *
FROM
clientesInternos
WHERE
entidad='".$entidad."'
and
almacenSolicitud='".$myrow1['almacen']."'


and
expediente='si'
and
fechaSolicitud='".$fechaInicio."'
 order by guiaHora ASC
";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$tipoPaciente=$myrow['tipoPaciente'];
$a+=1;
$cita=$myrow['cita'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$numeroE=$myrow['numeroE'];$nCuenta=$myrow['nCuenta'];

$sSQL2= "SELECT *
FROM
pacientes
WHERE
entidad='".$entidad."'
    and
numCliente = '".$numeroE."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
 $E=$myrow['keyCAP'];
 $numeroExpediente=$myrow['numeroExpediente'];

$sql142= "
SELECT keyDiagnostico
FROM
dx
WHERE
keyClientesInternos='".$myrow['keyClientesInternos']."'
and
fecha='".$myrow['fechaSolicitud']."'
   
";
$result142=mysql_db_query($basedatos,$sql142);
$myrow142= mysql_fetch_array($result142);
	  ?>


<tr bgcolor="#ffffff" onMouseOver="bgColor='#87CEFF'" onMouseOut="bgColor='#ffffff'" >

    <td class="normal">
    <?php echo $myrow['horaSolicitud']?>
</td>

<td class="normal">
    <?php echo $myrow['numeroE']?>
</td>

<td class="normal" >

    <a class="normal" href='javascript:prs__doPostBack("edit","22","&amp;prs_page_size=10&amp;prs_p=1");' title="Edit record">
       <?php echo $myrow['paciente'];
if($myrow['status']=='cortesia'){
echo ' [Cortesia]';
}
if($myrow142['keyDiagnostico']){ echo '<span class="style1">'.'  (Revisado)'.'</span>'; }
?>
</a>
</td>


    <td class="normal" >
  
       <?php 
       if($myrow2['fechaNacimiento']!=NULL){
       echo cambia_a_normal($myrow2['fechaNacimiento']);
       }else{
           echo '---';
       }
           ?>
  
</td>

    
<td class="normal" style="">
 <label class="normal">
 <?php 
 if($myrow['statusCaja']=='pagado'){
 echo $myrow['statusCaja'];
 }else{
 echo '---';
 }
 ?>
 </label>
</td>

<td class="normal" style="">
    <label class="normal">
   <?php echo $myrow['tipoPaciente']
?>
    </label></td>

    
<td class="normal" style="">
    <label class="normal">

        <?php if($myrow['statusCaja']=='pagado'){ ?>
<a

	  	

	  href="javascript:ventanaSecundaria2('/sima/EXPEDIENTESCLINICOS/medicos/med/cuadroClinico.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
    Edit
</a>
        <?php } else { ?>
        ---
        <?php } ?>
    </label>
</td>


<td class="normal" style="">
    <label class="normal">

       <a href="#"
	  	 
	  onclick="ventanaSecundaria3('antecedentesAnteriores.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $myrow['numeroE'];?>')">
           Edit
       </a>

</td>


    
</tr>
<?php }} ?>




</tbody>
</table>
</form>






     <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario
});
    </script> 



</body>
</html>
<?php
} else { 
//$link=new ventanasPrototype();
//$mensaje=new ventanasPrototype(); 
//$link->links();
//$mensaje->despliegaMensaje('Lo sentimos, existe alg�n problema con su cuenta, � no tiene cuenta de m�dico; comun�quese a sistemas si tiene �ste derecho.. Gracias!');
echo 'Lo sentimos, existe algun problema con su cuenta, no tiene cuenta de medico; comuniquese a sistemas si tiene este derecho.. Gracias!';
}


?>
