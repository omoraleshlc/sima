<?php require("menuOperaciones.php"); ?>
<?php 
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
  
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
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA2 (URL){ 
   window.open(URL,"ventanaSecundariaA2","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundariaA1 (URL){ 
   window.open(URL,"ventanaSecundariaA1","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria5111(URL){ 
   window.open(URL,"ventanaSecundaria5111","width=800,height=600,scrollbars=YES") 
} 
</script>






<?php 



if($_GET['fv'] and $_GET['mes'] ){
// $random=rand(1,900000000);
//
//$q = "insert into contador
//(
//usuario,random)
//values
//('".$usuario."','".$random."')";
//mysql_db_query($basedatos,$q);
//echo mysql_error();
//
//$sSQL7ab="SELECT *
//FROM
//contador
//WHERE
//usuario='".$usuario."'
//and
//random='".$random."'
//order by keyConta DESC
//
//";
//$result7ab=mysql_db_query($basedatos,$sSQL7ab);
//$myrow7ab = mysql_fetch_array($result7ab);
?>
<script>
//javascript:ventanaSecundaria511('/sima/cargos/generarReporte.php?almacen=<?php echo $_GET['datawarehouse'];?>&year=<?php echo $_GET['year']; ?>&mes=<?php echo $_GET['mes']; ?>&random=<?php echo $random;?>');
//window.alert("Se genero el numero de reporte: <?php print $myrow7ab['random'];?>");

</script>
<?php 
}
?>













<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
    
 <br />
 <h1 align="center" class="titulos">REPORTE GLOBAL POR ASEGURADORAS</h1>
 
 <form  name="form2" method="post" >
   <div align="center"></div>
   <p align="center">
     <label></label></p>
   

   
 <span class="precio1">Estad&iacute;stica General, a&ntilde;o:
<?php 

$yearActual= date(Y);
//$yearActual="2050";
$sSQL7ab="SELECT fechaApertura
FROM
entidades
WHERE
codigoEntidad='".$entidad."'";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

$yearApertura= substr($myrow7ab['fechaApertura'],0,4);

$totalYears= $yearActual-$yearApertura;

?>
             <select name="year" onChange="this.form.submit();">
             <option value=""><?php echo utf8_decode("Escoje el Año");?></option>
             
   <?php for($i=0;$i<=$totalYears;$i++){ ?>
             
             <option
                 <?php if($yearApertura+$i==$_POST['year']){echo 'selected="selected"';}?>
                 value="<?php echo $yearApertura+$i;?>"><?php echo $yearApertura+$i;?></option>
     <?php }?>
 </select>
       </span>
       
       
       
       
       
       
       
      

        
       
<br />
<br />
<br /><br />



<?php if($myrow7ab['fechaApertura']!=NULL ){
    
    if($_POST['year']!=NULL){
    ?>





<?php if($_POST['fv']!=NULL){?>
   <div id="encabezado">
<p align="center">Reportes</p>
</div>

<div id="contener">
<div id="liga1">
&nbsp; <br />
	   <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=01&year=<?php echo $_POST['year']; ?>&mes=enero')">
               Enero
           </a>
<br />

<a href="#">
&nbsp;</a>

<div id="liga2">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=02&year=<?php echo $_POST['year']; ?>&mes=febrero')">
Febrero
           </a><br />

<a href="#">
&nbsp;</a>
</div>


<div id="liga3">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=03&year=<?php echo $_POST['year']; ?>&mes=marzo')">
Marzo
           </a><br />

<a href="#" >
&nbsp;</a>
</div>

           
           
           
           
           
<div id="liga1">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=04&year=<?php echo $_POST['year']; ?>&mes=abril')">
Abril
           </a><br />

<a href="#" >
&nbsp;</a>
</div>           
           
           
           
           
 <div id="liga2">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=05&year=<?php echo $_POST['year']; ?>&mes=mayo')">
Mayo
           </a><br />

<a href="#" >
&nbsp;</a>
</div>            
           
         
           
           
           
           
<div id="liga3">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=06&year=<?php echo $_POST['year']; ?>&mes=junio')">
Junio
           </a><br />

<a href="#" >
&nbsp;</a>
</div>             
           
           
        
           
           
           
           
           
           
<div id="liga1">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=07&year=<?php echo $_POST['year']; ?>&mes=julio')">
Julio
           </a><br />

<a href="#" >
&nbsp;</a>
</div>             
           
           
           
           
           
<div id="liga2">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=08&year=<?php echo $_POST['year']; ?>&mes=agosto')">
Agosto
           </a><br />

<a href="#" >
&nbsp;</a>
</div>             
        
           
           
           
           
           
<div id="liga3">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=09&year=<?php echo $_POST['year']; ?>&mes=septiembre')">
Septiembre
           </a><br />

<a href="#" >
&nbsp;</a>
</div>             
           
           
     
           
           
<div id="liga1">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=10&year=<?php echo $_POST['year']; ?>&mes=octubre')">
Octubre
           </a><br />

<a href="#" >
&nbsp;</a>
</div>             
           
  
           
           
<div id="liga2">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=11&year=<?php echo $_POST['year']; ?>&mes=noviembre')">
Noviembre
           </a><br />

<a href="#" >
&nbsp;</a>
</div>  
           
           
           

           
<div id="liga3">
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desglocexAseguradora.php?mesNumerico=12&year=<?php echo $_POST['year']; ?>&mes=diciembre')">
Diciembre
           </a><br />

<a href="#" >
&nbsp;</a>
</div>  
           
           
         
           

           </br>      
       </br>    
              </br>    
             
           
           
           
           
           
<div id="liga2" class="sucess"
&nbsp; <br />
           <a href="javascript:ventanaSecundaria51('../ventanas/desgloceGlobalxAseguradora.php?almacen=<?php echo $_GET['datawarehouse'];?>&amp;year=<?php echo $_POST['year']; ?>&amp;mes=<?php echo $_GET['mes']; ?>&amp;random=<?php echo $random;?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>')">
TODOS LOS MESES
           </a><br />

<a href="#" >
&nbsp;</a>
</div>                
           
           
           
</div>
   </div>


   <?php
    }
    ?>

     <p>&nbsp;   </p>
     <p>&nbsp;</p>
     <p>
            
       
  
              </br>    
                     </br>    
                            </br>    
                                   </br>    
                                          </br>    
                                                 </br>    
                                                        </br>    
                                                               </br>    
                                                                      </br>    
                                                                             </br>    
                                                                                    </br>    
                                                                                           </br>    
       <input type="submit" name="fv" id="fv" value="Generar Reporte" />
               </p>
               
               
               
<?php } }else{
    echo '<div class="error">NO TIENE FECHA DE APERTURA ESTA ENTIDAD!</div>';
}   ?> 
            
 </form>
 


</body>
</html>