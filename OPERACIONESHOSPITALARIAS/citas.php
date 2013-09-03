<?php require("menuOperaciones.php"); $ALMACEN=$_GET['datawarehouse'];

if(!$ALMACEN){
    echo '<script>';
    echo 'window.alert("NO TIENE ALMACEN DEFINIDO");';
    echo '</script>';
}else{
?>



<script language=javascript> 
function ventanaSecundaria10(URL){ 
   window.open(URL,"ventanaSecundaria10","width=600,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=1100,height=700,scrollbars=YES") 
} 
</script> 

<?php  
if($_GET['keyAlmacenes'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE almacenes set 

		activo='I'
		WHERE keyAlmacenes='".$_GET['keyAlmacenes']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>


<?php
//*************************HAGO LIMPIEZA****************************
		$q = "DELETE  FROM citasTemporales 
		WHERE fechaSolicitud<'".$fecha1."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		
//********************************************************	

//***********************ABRE
/* $cmdstr4 = "select * from PEDRO.USUARIO WHERE LOGIN = '".$usuario."' 
";
$parsed4 = ociparse($db_conn, $cmdstr4);
ociexecute($parsed4);	 
$nrows4 = ocifetchstatement($parsed4,$resulta4);

for ($i = 0; $i < $nrows4; $i++ ){
$NOMBRE= $resulta4['NOMBRE'][$i]." ".$resulta4['AP_PATERNO'][$i]." ".$resulta4['AP_MATERNO'][$i];
} */

///**********************
//**********************CIERRO CAMBIAR ALMACEN******************************





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />





<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>


</head>

<body>
<form id="form1" name="form1" method="post" >
  <p><span class="titulomedio" align="center">Escoge la Especialidad para agregar la cita</span></p>
  <p>
    <?php 
	  $aCombo= "Select * From especialidades where
entidad='".$entidad."'  order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
    <select name="especialidad" class="camposmid" id="especialidad"  onchange="this.form.submit();"/>
    
</p>
  <option value="">Escoge</option>
<option value="*" 
   <?php if($_POST['especialidad']=='*')echo 'selected=""';?>     
        >Todos</option>
<?php while($resCombo = mysql_fetch_array($rCombo)){ 	?>
<option 
<?php if($resCombo['codigo']==$_POST['especialidad'])echo 'selected=""';?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        
<?php } ?></select>
<div align="center">
    <a href="#" onClick="javascript:ventanaSecundaria1('../ventanas/espera.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&medico=<?php echo $myrow['almacen']; ?>&almacen=<?php echo $ALMACEN; ?>')">
    <br />
    Lista de Espera </a>
    </div>

<br />



<?php if( $_POST['especialidad']!=NULL){
echo '


<table class="table table-striped" width="850"  >
<tr >
<th  scope="col"><div align="center" class="negromid">#</div></th>
      <th  scope="col"><div align="center" class="negromid">Desc</div></th>
      <th  scope="col"><div align="center" class="negromid">Medico</span></div></th>
      <th  scope="col"><div align="center"><span class="negromid">Especialidad</span></div></th>
      <th  scope="col"><span class="negromid">Conf</span></th>
      <th  scope="col"><div align="center"><span class="negromid">Cargos</span></div></th>
      <th  scope="col"><div align="center" class="negromid">Ausencia</div></th>
      <th  scope="col"><div align="center" class="negromid">Status</div></th>
      </tr>';

                      
                      


if ($_POST['especialidad']=="*"){
$sSQL= "SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacenPadre='".$ALMACEN."'
and
medico = 'si'  
and
activo='A'


order by descripcion ASC

 ";
} else {
$sSQL= "SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacenPadre='".$ALMACEN."'
and
medico = 'si'  
and
activo='A'

and
especialidad='".$_POST['especialidad']."'
order by descripcion ASC

 ";
}
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;
$cita=$myrow['cita'];




?>
                      
                      
                      
                      
                      
                      
                <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >         
                      
                    <td  class="normal"><span class="negro"><?php echo $a;?></span>   
                      <td  class="normal"><span class="negro">
                        <?php
  
if($myrow['cambiarDescripcion']=='si'){

?>
                        <a href="#" onClick="javascript:ventanaSecundaria10('../cargos/ventanaCambiaDescripcionAlmacen.php?almacen=<?php echo $myrow['almacen']; ?>&amp;almacenPrincipal=<?php echo $ALMACEN; ?>')">Desc</a>
                        <?php } else{ echo '---';}?>
              </span>      </td>
                      
                      
                      
                      
                      <td  class="normal">
                        <a href="#medicos<?php echo $a;?>" name="medicos<?php echo $a;?>" onClick="javascript:ventanaSecundaria1('../ventanas/ventanaCambiaCitas.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;id_medico=<?php echo $myrow['id_medico']; ?>&almacen=<?php echo $ALMACEN; ?>')">
<?php 
	
//	$sSQL455z= "Select * from almacenesTemp where
//fecha='".$fecha1."'
//and
//almacen='".$myrow['almacen']."'
//and
//almacenPrincipal='".$ALMACEN."'
//order by keyAT DESC
//
//";
//$result455z=mysql_db_query($basedatos,$sSQL455z);
//$myrow455z = mysql_fetch_array($result455z);


 $sSQLg= "SELECT *
  FROM
medicos
WHERE 
entidad='".$entidad."'
    and
    numMedico='".$myrow['id_medico']."'
 ";

$resultg=mysql_db_query($basedatos,$sSQLg);
$myrowg = mysql_fetch_array($resultg);  
echo $myrowg['nombreCompleto'];
echo '<br>';
echo 'Referencia: '.$myrow['id_medico'];

	

	  
?></a>	  </td>
                      
                      
                      
                      
                      
                      <td  align="center" class="negro">
<?php 
                      
                        
$sSQLa= "Select descripcion From especialidades where
entidad='".$entidad."'
AND
codigo='".$myrow['especialidad']."'";
$resulta=mysql_db_query($basedatos,$sSQLa); 
$myrowa = mysql_fetch_array($resulta);
if($myrowa['descripcion']){
	   echo $myrowa['descripcion'];
	   }else{
	   echo '---';
	   }
	   ?>
      </td>
<td  align="center" class="negro"><a href="#configuracion<?php echo $a;?>" name="configuracion<?php echo $a;?>" id="configuracion<?php echo $a;?>" onClick="javascript:ventanaSecundaria1('../ventanas/citasMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenDestino=<?php echo $myrow['almacen']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;id_medico=<?php echo $myrow['id_medico']; ?>')">Configurar Horario</a></td>
<td width="77" align="center" class="negro"><a href="#cargos<?php echo $a;?>" name="cargos<?php echo $a;?>" onClick="javascript:ventanaSecundaria1('../ventanas/confirmarCita.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;id_medico=<?php echo $myrow['id_medico']; ?>&amp;almacenDestino=<?php echo $myrow['almacen']; ?>&amp;almacen=<?php echo $ALMACEN; ?>')"> HacerCargos</a></td>
                      
                      
                      
                      
                      <td  align="center" class="negro"><?php
$sSQL6= "Select usuario,descripcion,fechaInicial,fechaFinal From medicosCitasCanceladas where
entidad='".$entidad."'
AND
almacen='".$myrow['almacen']."'
AND
( DATE(NOW()) between fechaInicial and fechaFinal) 
";

$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);
if($myrow6['usuario']){

echo $myrow6['descripcion'].'<br>Atte: '.$myrow6['usuario'] ; 

?>
                       
                        <?php } else { ?>
                        <a href="#ausencia<?php echo $a;?>" name="ausencia<?php echo $a;?>" onClick="javascript:ventanaSecundaria1('../ventanas/ventanaMedicosNotas.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;almacenDestino=<?php echo $myrow['almacen']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&id_medico=<?php echo $myrow['almacen']; ?>')">Anotar Ausencia</a>
              <?php } ?></td>
                      
                      <td  align="center" class="negro">
                        
                    <span class="Estilo24"> <a  href="citas.php?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyAlmacenes=<?php echo $myrow['keyAlmacenes'];?>#status<?php echo $a;?>" name="status<?php echo $a;?>"> <img src="/sima/imagenes/btns/checkbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas desactivar al medico: <?php echo $myrow['descripcion'];
?>?') == false){return false;}" /></a>      </span></td>
                    </tr>
                    <tr>
                      
                    </tr>
                    <?php  }}
	
	if(!$a){
	$a='0';
	}

	?>
                    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
                    </table>
                    <br>
                        <br></br>   
                       
<?php }}?>                  
</form>
     <div  align="center"><?php echo 'Se encontraron: '.$a.' registros...';?></div>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
</body>

</html>
