<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); 
$ventana1='ventanaCatalogoAlmacen.php';
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



if($_POST['fv'] and !$_POST['resumen'] ){
 $random=rand(1,900000000);

$q = "insert into contador 
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT * 
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>
<script>
//javascript:ventanaSecundaria511('despliegaxFV.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>');
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
 <h1 align="center" class="titulos">Ventas x Almacen</h1>
 <form id="form2" name="form2" method="post" action="">
   <div align="center"></div>
   <p align="center">
     <label></label>
     Escojer Fechas</p>
<div align="center">Almacen
                 <?php 
                 $aCombo= "Select * From almacenes where ventas='si' and
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" id="almacenDestino" class="normal" />

  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){

		echo 'selected="selected"';
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>

             </div>

<br />
    <div align="center">Ano
         <select name="year" class="normal">
           <option value="">Escoje el Ano</option>
           <option
                          <?php if($_POST['year']==(date("Y")-2))echo 'selected=""';?>
                          value="<?php echo date("Y")-2;?>"><?php echo date("Y")-2;?></option>
           <option
                           <?php if($_POST['year']==(date("Y")-1))echo 'selected=""';?>
                          value="<?php echo date("Y")-1;?>"><?php echo date("Y")-1;?></option>
           <option
                           <?php if($_POST['year']==(date("Y")))echo 'selected=""';?>
                          value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
         </select>
       </div>
       <div align="left">De:</div>
       <select name="inicio" class="normal">
         <option

                       value="">Escoje el Mes</option>
         <option
                       <?php if($_POST['inicio']=='0')echo 'selected=""';?>
                       value="0">Enero</option>
         <option
                       <?php if($_POST['inicio']=='1')echo 'selected=""';?>
                       value="1">Febrero</option>
         <option
                       <?php if($_POST['inicio']=='2')echo 'selected=""';?>
                       value="2">Marzo</option>
         <option
                       <?php if($_POST['inicio']=='3')echo 'selected=""';?>
                       value="3">Abril</option>
         <option
                       <?php if($_POST['inicio']=='4')echo 'selected=""';?>
                       value="4">Mayo</option>
         <option
                       <?php if($_POST['inicio']=='5')echo 'selected=""';?>
                       value="5">Junio</option>
         <option
                       <?php if($_POST['inicio']=='6')echo 'selected=""';?>
                       value="6">Julio</option>
         <option
                       <?php if($_POST['inicio']=='7')echo 'selected=""';?>
                       value="7">Agosto</option>
         <option
                       <?php if($_POST['inicio']=='8')echo 'selected=""';?>
                       value="8">Septiembre</option>
         <option
                       <?php if($_POST['inicio']=='9')echo 'selected=""';?>
                       value="9">Octubre</option>
         <option
                       <?php if($_POST['inicio']=='10')echo 'selected=""';?>
                       value="10">Noviembre</option>
         <option
                       <?php if($_POST['inicio']=='11')echo 'selected=""';?>
                       value="11">Diciembre</option>
       </select>a:
       <select name="fin" class="normal">
         <option

                       value="">Escoje el Mes</option>
         <option
                       <?php if($_POST['fin']=='0')echo 'selected=""';?>
                       value="0">Enero</option>
         <option
                       <?php if($_POST['fin']=='1')echo 'selected=""';?>
                       value="1">Febrero</option>
         <option
                       <?php if($_POST['fin']=='2')echo 'selected=""';?>
                       value="2">Marzo</option>
         <option
                       <?php if($_POST['fin']=='3')echo 'selected=""';?>
                       value="3">Abril</option>
         <option
                       <?php if($_POST['fin']=='4')echo 'selected=""';?>
                       value="4">Mayo</option>
         <option
                       <?php if($_POST['fin']=='5')echo 'selected=""';?>
                       value="5">Junio</option>
         <option
                       <?php if($_POST['fin']=='6')echo 'selected=""';?>
                       value="6">Julio</option>
         <option
                       <?php if($_POST['fin']=='7')echo 'selected=""';?>
                       value="7">Agosto</option>
         <option
                       <?php if($_POST['fin']=='8')echo 'selected=""';?>
                       value="8">Septiembre</option>
         <option
                       <?php if($_POST['fin']=='9')echo 'selected=""';?>
                       value="9">Octubre</option>
         <option
                       <?php if($_POST['fin']=='10')echo 'selected=""';?>
                       value="10">Noviembre</option>
         <option
                       <?php if($_POST['fin']=='11')echo 'selected=""';?>
                       value="11">Diciembre</option>
       </select>


<br /><br />
   
   <?php if($_POST['fv'] and $_POST['year']!='' and $_POST['almacenDestino']!=NULL and $_POST['inicio']!=NULL and $_POST['fin']!=''){ ?>

<div id="encabezado">
<p align="center">Ventas x almacen</p>
</div>

<div id="contener">
<div id="liga1">
&nbsp; <br />
<a href="#" target="_new">
&nbsp;</a><br />

<a href="#" target="_new">
&nbsp;</a>

<div id="liga2">
&nbsp; <br />
<a href="javascript:ventanaSecundariaA('../ventanas/mostrarDatos.php?entidad=<?php echo $entidad;?>&almacenIngreso=<?php echo $_POST['almacenDestino'];?>&year=<?php echo $_POST['year'];?>&inicio=<?php echo $_POST['inicio'];?>&fin=<?php echo $_POST['fin'];?>');">
              Mostrar Datos
           </a><br />

<a href="#" target="_new">
&nbsp;</a>
</div>


<div id="liga3">
&nbsp;<br />
<a href="#" target="_new">
&nbsp;</a><br />

<a href="#" target="_new">
&nbsp;</a>
</div>

</div>
</div>


   
   
   
   
   
   <?php } ?>
   
   <p align="center">
     <input type="hidden" name="bandera" id="bandera" value="<?php echo $a;?>" />
     
     <input type="submit" name="fv" id="fv" value="Generar Reporte" class="normal" />
     <input type="hidden" name="random" id="random" value="<?php echo $random;?>" />
   </p>

</form>
 


</body>
</html>