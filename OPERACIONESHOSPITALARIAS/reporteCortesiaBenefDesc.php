<?php require("menuOperaciones.php"); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.clientePrincipal.value) == false ) {   
                alert("Por Favor, escoje el clientePrincipal/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este clientePrincipal!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 




<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
  




<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
        
        
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script language="javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
jQuery("#ocultarmostrar").click(function(){


var a = jQuery("#caja");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

jQuery("#ocultarmostrar-").click(function(){


var a = jQuery("#caja");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

jQuery("#ocultarmostrar2").click(function(){


var a = jQuery("#caja2");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

jQuery("#ocultarmostrar2-").click(function(){


var a = jQuery("#caja2");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

jQuery("#ocultarmostrar3").click(function(){


var a = jQuery("#caja3");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

jQuery("#ocultarmostrar3-").click(function(){


var a = jQuery("#caja3");

var propiedad = a.css("display");
if (propiedad=="block"){
a.css("display", "none");
}else{
a.css("display", "block");
}
})

})

</script> 

<script>

function mostrardiv() {

div = document.getElementById('flotante');

div.style.display ='';

div = document.getElementById('mostrarDiv');

div.style.display ='none';

}

function cerrar() {

div = document.getElementById('flotante');

div.style.display='none';

div = document.getElementById('mostrarDiv');

div.style.display ='';

}


function mostrardiv2() {

div = document.getElementById('flotante2');

div.style.display ='';

div = document.getElementById('mostrarDiv2');

div.style.display ='none';

}

function cerrar2() {

div = document.getElementById('flotante2');

div.style.display='none';

div = document.getElementById('mostrarDiv2');

div.style.display ='';

}

function mostrardiv3() {

div = document.getElementById('flotante3');

div.style.display ='';

div = document.getElementById('mostrarDiv3');

div.style.display ='none';

}

function cerrar3() {

div = document.getElementById('flotante3');

div.style.display='none';

div = document.getElementById('mostrarDiv3');

div.style.display ='';

}
</script>
</head>

<body >
 <h1 align="center" >
 <div align="center"></div>
<form id="form2" name="form2" method="POST">
 <div align="center">
   
   <h1>REPORTE CORTESIAS BENEFICENCIAS DESCUENTOS</h1>
   
   <h3><?php //echo $_POST['medico'];?></h3>
   

   <table width="500" class="table-forma">
    <tr >
       <td><span >Fecha Inicial </span></td>
       <td>
       <input name="fechaInicial" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaInicial']){
	  echo $fecha2=$_POST['fechaInicial'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" readonly="" />
       
       <span ><span >
         <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png"/>
       </span></span>
       
       </td>
     </tr>
     
     
     
     <tr >
       <td><span >Fecha Final </span></td>
       <td>
      <input name="fechaFinal" type="text"  id="campo_fecha1"
	  value="<?php 
	  if($_POST['fechaFinal']){
	  echo $fecha2=$_POST['fechaFinal'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>"  readonly="" />
       
       <span >
         <input name="button2" type="image"  id="lanzador1" value="cargar"  src="../imagenes/btns/fechadate.png"/>
       </span>
       </td>
     </tr>
     
     

     
     
        </table>
   
   <br>
   
      <span >
         <input type="submit" name="mostrar" id="mostrar" value="Buscar" />
       </span>


   

   
   
   
   <br>
   
  <div id="mostrarDiv"><a href="javascript:mostrardiv();" id="ocultarmostrar"><h1>Cortesias Ver detalles +</h1></a></div>
  <div id="flotante" style="display:none;"><a href="javascript:cerrar();" id="ocultarmostrar-"><h1>Cortesias Ver detalles -</h1></a></div>
   <br>
   
   <div id="caja" style="display:none">
       
     
       <span >
<input type="button" name="Print" id="mostrar" value="Print" onClick="javascript:ventanaSecundaria1('../ventanas/printCortesias.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')"/>
       </span>     
       
       
<?php if($_POST['mostrar']!=NULL){ ?>
   <table width="730" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
    </th>
         
         
         <th width="60" >
         <div align="left">Fecha</div>
       </th>
         
       <th width="450" >
         <div align="left">Medico</div>
      </th>         

       <th width="390" >
           <div align="left">Paciente</div>
    </th>
    
           <th width="52" >
         <div align="left">Folio</div>
      </th>
    
 <!--th width="400" ><div align="left" >TipoPago</div></th-->    
 <!--<th width="60" ><div align="left" >TipoCobro</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <!--th width="60" ><div align="left" >Rec/Mov</div></th-->
   
 <th width="60" ><div align="right" >Importe</div></th>   
   
      </tr>
<?php 	
//$medico=$_POST['medico'];

    
 
$ssql= "SELECT folioVenta,fechaCierre FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'  
and
fechaCierre>='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."'
and

statusCuenta='cerrada'
and
statusCortesia='si'
and
tipoPaciente='externo'
group by folioVenta
order by folioVenta ASC
";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];



  
$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select numRecibo From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and numRecibo!=0
group by numRecibo        
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);



$sSQL1ab= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as cortesias From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
        gpoProducto!=''
        and
        naturaleza='C'
";
$result1ab=mysql_db_query($basedatos,$sSQL1ab);
$myrow1ab = mysql_fetch_array($result1ab);

$sSQL1ad= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as devCortesias From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
        gpoProducto!=''
        and
        naturaleza='A'
";
$result1ad=mysql_db_query($basedatos,$sSQL1ad);
$myrow1ad = mysql_fetch_array($result1ad);

//medicos!
$sSQL1nm= "Select * from medicos WHERE entidad='".$entidad."' 
    and numMedico='".$myrow1['medico']."' 

";
$result1nm=mysql_db_query($basedatos,$sSQL1nm);
$myrow1nm = mysql_fetch_array($result1nm);


?>
      
          <tr >
              
              
<td align="left" >
<?php 
	echo $totalRegistros;
	  ?>
</td>
              
              
              
<td align="left" >
<?php 
if($myrow['fechaCierre']!=NULL){
	echo cambia_a_normal($myrow['fechaCierre']);
}else{
    echo '---';
}
	  ?>
</td>
              
              
<td align="left" >
             
             <?php 
	echo utf8_decode($myrow1nm['nombreCompleto']);
	  ?></td>
         





<td align="left" >
           <?php 



echo utf8_decode($myrow1['paciente']);


//echo $myrow['almacenSolicitante'];
	  ?></td>


<td align="left" >
             
             <?php 
	echo $myrow['folioVenta'];
	  ?></td>
       
       
<!--td align="left" >
        <?php    

?>
       </td-->
       
       
       
       
    <!--    
<td align="left" >
<?php
if($myrow['cantidadAseguradora']>0){
echo 'CxC';
}

if($myrow['cantidadParticular']>0){
    

if($myrow['cantidadAseguradora']>0){    
echo ','; 
}
echo 'Particular';
}
?>	   

	</td>       
   </td-->      
       
       
    <!--td   align="left" >
<?php
if($myrow['naturaleza']=='C'){
echo 'Normal';
}elseif($myrow['naturaleza']=='A'){
echo 'Devolucion'    ;
}
?>	   

	</td-->        
        
        
        
        
          
        
        
        
        
        
       
<!--td align="left" >
<?php 
if($myrow['tipoPaciente']=='externo'){
echo 'R'.$myrow1a['numRecibo'];
}else{
echo 'M'.$myrow['keyCAP'];    
}
?>	   

	</td-->

        
        
        
        
<td align="right" >
<?php


print '$'.number_format($myrow1ab['cortesias']-$myrow1ad['devCortesias'],2);
$imp[0]+=$myrow1ab['cortesias'];
$devs[0]+=$myrow1ab['devCortesias'];


?>	   
            </div>
	</td>        
        


    
      </tr>

      <?php }}?>       
     <tr >
       
    <td colspan="5" width="2" >
    <div align="left"><b>Totales</b></div>
    </td>
        
    
    <td width="2" >
    <div align="right"><b><?php 

	 echo '$'.number_format($imp[0]-$devs[0],2);

	  ?></b></div>
    </td>    
   
 </tr>
 

   </table>
       
       
       </div>
    
    <table>
        <tr>
            <th>Total de Cortesias</th>
            <th align="left" >
<?php 
	echo $totalRegistros;
	  ?>
</th>
<th>Total Importes</th>
<th>    <div align="right"><?php 

	 echo '$'.number_format($imp[0]-$devs[0],2);

	  ?></div>
    </th>
        </tr>
        
    </table>
    
      <br />
      

         <br>
              <br>
              
              
 <div id="mostrarDiv2"><a href="javascript:mostrardiv2();" id="ocultarmostrar2"><h1>Beneficencias Ver detalles +</h1></a></div>
  <div id="flotante2" style="display:none;"><a href="javascript:cerrar2();" id="ocultarmostrar2-"><h1>Beneficencias Ver detalles -</h1></a></div>
  

   <br>
   
    <div id="caja2" style="display:none">
        
               <span >
<input type="button" name="Print" id="mostrar" value="Print" onClick="javascript:ventanaSecundaria1('../ventanas/printBenef.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')"/>
       </span>    
<?php if($_POST['mostrar']!=NULL){ ?>
        
        
        
   <table width="730" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
    </th>
         
         
         <th width="60" >
         <div align="left">Fecha</div>
       </th>
       

       <th width="390" >
           <div align="left">Paciente</div>
    </th>
    
           <th width="52" >
         <div align="left">Folio</div>
      </th>
    
 <!--th width="400" ><div align="left" >TipoPago</div></th-->    
 <!--<th width="60" ><div align="left" >TipoCobro</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <!--th width="60" ><div align="left" >Rec/Mov</div></th-->
   
 <th width="60" ><div align="right" >Importe</div></th>   
   
      </tr>
<?php 	
//$medico=$_POST['medico'];

    
 
$ssql= "SELECT * FROM cargosCuentaPaciente
WHERE
(entidad='".$entidad."'  
and
fechaCierre>='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."'
and

statusCuenta='cerrada'
and
statusBeneficencia='si'


and
tipoPaciente='externo')

OR

(entidad='".$entidad."'  
and
fechaCargo>='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."'
and


statusBeneficencia='si'

and

statusDevolucion!='si'
and
(tipoPaciente='interno' or tipoPaciente='urgencias'))

group by folioVenta
order by folioVenta ASC
";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros2+=1;

$codigo=$code = $myrow['codigo'];
  
$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select numRecibo From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and numRecibo!=0
group by numRecibo        
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);



$sSQL1ab= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as beneficencias From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
and
statusBeneficencia='si'
and
naturaleza='A'
and
gpoProducto=''
";
$result1ab=mysql_db_query($basedatos,$sSQL1ab);
$myrow1ab = mysql_fetch_array($result1ab);

$sSQL1ad= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as devBeneficencias From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
    and
statusBeneficencia='si'
and
naturaleza='C'
and
gpoProducto=''
";
$result1ad=mysql_db_query($basedatos,$sSQL1ad);
$myrow1ad = mysql_fetch_array($result1ad);


?>
      
          <tr >
              
              
<td align="left" >
<?php 
	echo $totalRegistros2;
	  ?>
</td>
              
              
              
<td align="left" >
<?php 
if($myrow['fechaCierre']!=NULL){
	echo cambia_a_normal($myrow['fechaCierre']);
}else{
    echo '---';
}
	  ?>
</td>
              


<td align="left" >
           <?php 



echo utf8_decode($myrow1['paciente']);


//echo $myrow['almacenSolicitante'];
	  ?></td>


<td align="left" >
             
             <?php 
	echo $myrow['folioVenta'];
	  ?></td>
       
       
<!--td align="left" >
        <?php    

?>
       </td-->
       
       
       
       
    <!--    
<td align="left" >
<?php
if($myrow['cantidadAseguradora']>0){
echo 'CxC';
}

if($myrow['cantidadParticular']>0){
    

if($myrow['cantidadAseguradora']>0){    
echo ','; 
}
echo 'Particular';
}
?>	   

	</td>       
   </td-->      
       
       
    <!--td   align="left" >
<?php
if($myrow['naturaleza']=='C'){
echo 'Normal';
}elseif($myrow['naturaleza']=='A'){
echo 'Devolucion'    ;
}
?>	   

	</td-->        
        
        
        
        
          
        
        
        
        
        
       
<!--td align="left" >
<?php 
if($myrow['tipoPaciente']=='externo'){
echo 'R'.$myrow1a['numRecibo'];
}else{
echo 'M'.$myrow['keyCAP'];    
}
?>	   

	</td-->

        
        
        
        
<td align="right" >
<?php


print '$'.number_format($myrow1ab['beneficencias']-$myrow1ad['devBeneficencias'],2);
$impBen[0]+=$myrow1ab['beneficencias'];
$devsBen[0]+=$myrow1ab['devBeneficencias'];


?>	   
         
	</td>        
        


    
      </tr>

      <?php }}?>    
     <tr >
       
    <td colspan="4" width="2" >
    <div align="left"><b>Totales</b></div>
    </td>
        
    
    <td width="2" >
    <div align="right"><b><?php 

	 echo '$'.number_format($impBen[0]-$devsBen[0],2);

	  ?></b></div>
    </td>    
   
 </tr>
 
   
   </table>
   
   
   </div>
   
       <table>
        <tr>
            <th>Total de Beneficencias</th>
            <th align="left" >
<?php 
	echo $totalRegistros2;
	  ?>
</th>
<th>Total Importes</th>
<th>        <div align="right"><?php 

	 echo '$'.number_format($impBen[0]-$devsBen[0],2);

	  ?></div>
    </th>
        </tr>
        
    </table>
      <br />

         <br>
              <br>
              
              
  <div id="mostrarDiv3"><a href="javascript:mostrardiv3();" id="ocultarmostrar3"><h1>Descuentos Ver detalles +</h1></a></div>
  <div id="flotante3" style="display:none;"><a href="javascript:cerrar3();" id="ocultarmostrar3-"><h1>Descuento Ver detalles -</h1></a></div>              
              
    
   <br>
     
   <div id="caja3" style="display:none">
       
   
               <span >
<input type="button" name="Print" id="mostrar" value="Print" onClick="javascript:ventanaSecundaria1('../ventanas/printDescuentos.php?fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')"/>
       </span>        
<?php if($_POST['mostrar']!=NULL){ ?>
   <table width="730" class="table table-striped">
     <tr >
         
                  <th width="2" >
         <div align="left">#</div>
    </th>
         
         
         <th width="60" >
         <div align="left">Fecha</div>
       </th>
         

       <th width="390" >
           <div align="left">Paciente</div>
    </th>

    
           <th width="52" >
         <div align="left">Folio</div>
      </th>
    
 <!--th width="400" ><div align="left" >TipoPago</div></th-->    
 <!--<th width="60" ><div align="left" >TipoCobro</div></th>-->
 <!--th width="66" ><div align="left" >StatusCuenta</div></th-->
    <!--th width="60" ><div align="left" >Rec/Mov</div></th-->
   
 <th width="60" ><div align="right" >Importe</div></th>   
   
      </tr>
<?php 	
//$medico=$_POST['medico'];

    
 
$ssql= "SELECT * FROM cargosCuentaPaciente
WHERE
(entidad='".$entidad."'  
and
fechaCierre>='".$_POST['fechaInicial']."' and fechaCierre<='".$_POST['fechaFinal']."'
and

statusCuenta='cerrada'
and
statusDescuento='si'
)

OR

(entidad='".$entidad."'  
and
fechaCargo>='".$_POST['fechaInicial']."' and fechaCargo<='".$_POST['fechaFinal']."'
and


statusDescuento='si'
and
(tipoPaciente='interno' or tipoPaciente='urgencias'))

group by folioVenta
order by folioVenta ASC
";


$result = mysql_db_query($basedatos,$ssql);

while($myrow = mysql_fetch_array($result)){

$totalRegistros3+=1;

$codigo=$code = $myrow['codigo'];



  
$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

$sSQL1a= "Select numRecibo From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and numRecibo!=0
group by numRecibo        
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);




$sSQL1ab= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as descuentos From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
statusDescuento='si'
and
        naturaleza='A'
        and
        gpoProducto=''
        
";
$result1ab=mysql_db_query($basedatos,$sSQL1ab);
$myrow1ab = mysql_fetch_array($result1ab);

$sSQL1ad= "Select sum((precioVenta*cantidad)+(iva*cantidad)) as devDescuentos From cargosCuentaPaciente WHERE entidad='".$entidad."' 
    and folioVenta='".$myrow['folioVenta']."' 
        and
        gpoProducto=''
        and
        naturaleza='C'
";
$result1ad=mysql_db_query($basedatos,$sSQL1ad);
$myrow1ad = mysql_fetch_array($result1ad);



 $sSQL1b1= "SELECT * FROM almacenes
WHERE
entidad='".$_GET['entidad']."'
and
almacen='".$myrow['almacen']."'  ";
 

$result1b1=mysql_db_query($basedatos,$sSQL1b1);
$myrow1b1 = mysql_fetch_array($result1b1);


?>
      
          <tr >
              
              
<td align="left" >
<?php 
	echo $totalRegistros3;
	  ?>
</td>
              
              
              
<td align="left" >
<?php 
if($myrow['fechaCierre']!=NULL){
	echo cambia_a_normal($myrow['fechaCierre']);
}else{
    echo '---';
}
	  ?>
</td>
              

<td align="left" >
           <?php 



echo utf8_decode($myrow1['paciente']);


//echo $myrow['almacenSolicitante'];
	  ?></td>



<td align="left" >
             
             <?php 
	echo $myrow['folioVenta'];
	  ?></td>
       
       
<!--td align="left" >
        <?php    

?>
       </td-->
       
       
       
       
    <!--    
<td align="left" >
<?php
if($myrow['cantidadAseguradora']>0){
echo 'CxC';
}

if($myrow['cantidadParticular']>0){
    

if($myrow['cantidadAseguradora']>0){    
echo ','; 
}
echo 'Particular';
}
?>	   

	</td>       
   </td-->      
       
       
    <!--td   align="left" >
<?php
if($myrow['naturaleza']=='C'){
echo 'Normal';
}elseif($myrow['naturaleza']=='A'){
echo 'Devolucion'    ;
}
?>	   

	</td-->        
        
        
        
        
          
        
        
        
        
        
       
<!--td align="left" >
<?php 
if($myrow['tipoPaciente']=='externo'){
echo 'R'.$myrow1a['numRecibo'];
}else{
echo 'M'.$myrow['keyCAP'];    
}
?>	   

	</td-->

        
        
        
        
<td align="right" >
<?php


print '$'.number_format($myrow1ab['descuentos']-$myrow1ad['devDescuentos'],2);
$impDesc[0]+=$myrow1ab['descuentos'];
$devsDesc[0]+=$myrow1ab['devDescuentos'];


?>	   
            </div>
	</td>        
        


    
      </tr>

      <?php }}?>     
     <tr >
       
    <td colspan="4" width="2" >
    <div align="left"><b>Totales</b></div>
    </td>
        
    
    <td width="2" >
    <div align="right"><b><?php 

	 echo '$'.number_format($impDesc[0]-$devsDesc[0],2);

	  ?></b></div>
    </td>    
   
 </tr>
 
  
   </table>
   </div>
   
          <table>
        <tr>
            <th>Total de Descuentos</th>
            <th align="left" >
<?php 
	echo $totalRegistros3;
	  ?>
</th>
<th>Total Importes</th>
<th>            <div align="right"><?php 

	 echo '$'.number_format($impDesc[0]-$devsDesc[0],2);

	  ?></div>
    </th>
        </tr>
        
    </table>
   
      <br />
      
         <br />
      
      
   
               <br />
      
         <br />
      
      
         <br />
      
      
      
      
      
      
      
      
      
      
   
 </div>
</form>

<div align="center">
  <script>
		new Autocomplete("nomMedico", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("medico")[0].value = id;
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
			return "../cargos/medicosCedulax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>

  <script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del boton que lanzara el calendario 
}); 
 </script>
   <script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador1"     // el id del boton que lanzara el calendario 
}); 
 </script>
</div>
</body>
</html>