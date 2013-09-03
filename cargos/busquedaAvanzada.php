<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php
$campo=$_GET['campoSeguro'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];



?>
<script type="text/javascript">
	function regresar(numeroEx,paciente){
		self.opener.document.form1.numeroEx.value = numeroEx;
				self.opener.document.form1.paciente.value = paciente;
				<?php if($_GET['reload']){ ?>
				window.opener.document.forms["form1"].submit();
				<?php } ?>
		close();
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

<body>
<p align="center"><span >Busqueda Avanzada</span></p>
<form id="form1" name="form1" method="post" action="">

	



<table width="432" >

    <tr align="center" >
      <td width="89"><label>
        <input name="nombre1" type="text"  id="nombre1" size="10"  autocomplete="off"/>
      </label><br /><span>1er Nombre</span></td>
      <td width="87"><input name="nombre2" type="text"  id="nombre2" size="10" autocomplete="off"/><br /><span>2do Nombre</span></td>
      <td width="115"><input name="apellido1" type="text"  id="apellido1" size="10" autocomplete="off"/><br /><span>Apellido Paterno</span></td>
      <td width="113"><input name="apellido2" type="text"  id="apellido2" size="10" autocomplete="off"/><br /><span>Apellido Materno</span></td>
    </tr>

 
  
    <tr>
      <td colspan="4"><div align="center"></br>
        <input name="search" type="submit" id="search" value="Buscar" />
      </div></td>
    </tr>
  </table>
  
  
  
  <?php if($_POST['search'] and ($_POST['nombre1'] or $_POST['nombre2'] or $_POST['apellido1'] or $_POST['apellido2'])){ ?>
  
  <table width="400" >
    <tr >
      <th width="73"  >
        <div align="center">Expediente</div>
      </th>
      <th width="186">
        <div align="center">Nombre</div>
      </th>
    </tr>

<?php 
$nombre1=$_POST['nombre1'];
$nombre2=$_POST['nombre2'];
$apellido1=$_POST['apellido1'];
$apellido2=$_POST['apellido2'];

	 
$sSQL11= "Select * from pacientes where entidad='".$entidad."' 
and

(nombre1 like '$nombre1%'
and
nombre2 like '$nombre2%'
and
apellido1 like '$apellido1%'
and
apellido2 like '$apellido2%')
ORDER BY nombre1,nombre2,apellido1,apellido2 ASC ";




$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 
$r+=1;



//***********traigo cuenta contable

                $sSQL4="select *
                FROM
                porcentajeJubilados
                WHERE
                entidad='".$entidad."'
                and
                numeroE='".$myrow11['numCliente']."'
                and
                tipoPaciente='Ambulatorios' ";
                $result4=mysql_db_query($basedatos,$sSQL4);
                $myrow4 = mysql_fetch_array($result4);
//****************************Terminan las validaciones
?>
<tr  >
  <td  ><a href="javascript:regresar('<?php echo $myrow11['numCliente'];  ?>','<?php echo $myrow11['nombreCompleto']; ?>');"><?php echo $myrow11['numCliente'];  ?></a></td>
  
      <td   >
     
       <a href="javascript:regresar('<?php echo $myrow11['numCliente'];  ?>','<?php echo $myrow11['nombreCompleto']; ?>');">
       <?php
         
     echo $myrow11['nombreCompleto'];

                       if($myrow4['porcentaje']>0){
                $sSQL3="SELECT nomCliente
                FROM
                clientes

                WHERE
                entidad='".$entidad."'
                and
                numCliente='".$myrow4['seguro']."'

                  ";
                $result3=mysql_query($sSQL3);
                $myrow3 = mysql_fetch_array($result3);




          $porcentajeEspecial='El paciente tiene el porcentaje de ayuda del: '.$myrow4['porcentaje'].'%, ';
            $seguro=$myrow3['nomCliente'];
                       }

                   
                          
       ?></a>
      <?php
    
        if($myrow4['porcentaje']>0){
                        echo '<br>';
                        echo $porcentajeEspecial;
                              echo '<br>';
                              echo $seguro;
                            }
      ?>

      </td>
    </tr>
    <?php }}?>
  </table>


    
	
	<?php if($r>0){ ?>
      <div align="center" >Se encontraron <?php echo $r;?> registros.. </div>
	  <?php }else{?>
	        <div align="center" >No se encontraron registros!</div>
	  <?php } ?>
</form>
<p>&nbsp; </p>
</body>
</html>
