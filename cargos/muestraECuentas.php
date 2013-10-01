<?php 

if($myrow1s['credencial']>0){

$sSQL7na= "Select count(*) as totalAlumnos from alumnos";
$result7na=mysql_db_query($basedatos,$sSQL7na);
$myrow7na = mysql_fetch_array($result7na);


$sSQL7na1= "Select * from alumnos where MATRICULA='".$myrow1s['credencial']."'";
$result7na1=mysql_db_query($basedatos,$sSQL7na1);
$myrow7na1 = mysql_fetch_array($result7na1);
?>

<?php //if($seguro==$myrow7na[''] ?>


<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

<p align="center">&nbsp;</p>
<form name="form1" method="post" action="">
    <p align="center">Total de Alumnos con seguro Total: <?php echo $myrow7na['totalAlumnos'];?></p>
    <p align="center"><?php echo $myrow7na1['nombre'];?></p>
    <p align="center">Alumno Inscrito, cursando: <?php echo $myrow7na1['escuela'];?></p>

            
            <!--
            <div align="center">
                
              <img src="<?php echo "../im/".$myrow7na1['MATRICULA'].'.jpg';?>" alt="Alumno" width="100" height="100">  
                
            </div>
            <br>
            -->
            
    <table width="400" class="table table-striped">
      <tr>
          <td ><div align="left" >#</div></td>
        <td ><div align="left" >FolioVenta</div></td>
        <td ><div align="left" >Fecha</div></td>
        <td ><div align="left" >Importe</div></td>
      </tr>

<tr>
<?php	
$fechaInicio=date("Y").'-08-16';
$fechaFinal=date("Y");
$fechaFinal+=1;
$fechaFinal.='-05-25';


$sSQL= "Select * from clientesInternos where entidad='".$entidad."' and credencial='".$myrow1s['credencial']."' 
and seguro='".$seguro."' 
and (fecha >='".$fechaInicio."' and fecha<='".$fechaFinal."' ) 
and
statusCuenta='cerrada' ";
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


?><td ><label><?php echo $a; ?></label></td>
        <td ><label><?php echo $myrow['folioVenta']; ?></label></td>
        <td  ><?php echo cambia_a_normal($myrow['fecha']);?></td>
        <td  ><?php echo '$'.number_format($myrow7c['cargos']-$myrow7a['abonos'],2); ?></td>
      </tr>
      <?php  } //cierra while ?>
    </table>
    <p align="center">&nbsp;</p>
    <table width="355" class="table-forma">
      <tr>
<?php 

$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$seguro."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
$diferencia=$myrow7ab['cantidad']-$totales[0];



if($myrow7ab['seguro']){
$q = "UPDATE clientesInternos set 
limiteSeguro='".$diferencia."'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
}

	  
$sSQL7abc= "Select clientePrincipal,nomCliente from clientes where entidad='".$entidad."'  and numCliente='".$myrow7ab['seguroAlterno']."'  ";
$result7abc=mysql_db_query($basedatos,$sSQL7abc);
$myrow7abc = mysql_fetch_array($result7abc);


$sSQL7abcd= "Select clientePrincipal,nomCliente from clientes where entidad='".$entidad."'  and numCliente='".$seguro."'  ";
$result7abcd=mysql_db_query($basedatos,$sSQL7abcd);
$myrow7abcd = mysql_fetch_array($result7abcd);
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
		
		 echo '$'.number_format($myrow7ab['cantidad']-$totales[0],2);?></td>
		 <?php
		 if($myrow7ab['cantidad'] and ($totales[0]>=$myrow7ab['cantidad'])){
		 //echo '<blink>'.'<span class="codigos">'.'Ya no tiene credito disponible!'.'</span>'.'</blink>';
/* 	  $q = "UPDATE clientesInternos set 
seguro='".$myrow7ab['seguroAlterno']."',
clientePrincipal='".$myrow7abc['clientePrincipal']."'
WHERE 
keyClientesInternos='".$keyClientesInternos."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
echo 'Se transfirio el seguro '; */
?>
<script>
window.alert("IMPOSIBLE SEGUIR HACIENDO CARGOS, SE SUPERO EL LIMITE DE CREDITO");
window.close();
</script>
<?php 
		 }
		 ?>
      </tr>
    </table>
    <p align="center">
	<?php echo $myrow7abcd['nomCliente'];?>
	</p>
    <p align="center">
  <label>
   <input name="load" type="hidden"  id="close"   value="">  
  <input type="submit" name="aceptar" value="Aceptar">
  </label>
</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
<?php }?>