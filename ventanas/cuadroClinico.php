<?php require('/configuracion/ventanasEmergentes.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=600,height=600,scrollbars=YES") 
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
           
        if( vacio(F.observaciones.value) == false ) {   
                alert("Por Favor, escribe las observaciones del diagn�stico!")   
                return false   
        } else if( vacio(F.receta.value) == false ) {   
                alert("Por Favor, escribe la receta!")   
                return false   
        }         
}   
</script> 



<?php
$random=rand(3, 15);

$sql2= "
SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);
$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];

$paciente=$myrow2['paciente'];

if($_GET['actualizar'] ){
$uploaddir = 'images/';
$uploadfile = $uploaddir.$random.basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
//**********************************************************


//****************comprueba si ya existe****************/

$sql25= "
SELECT numeroE
FROM
dx
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 
and
banderaCI=''
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);

//actualiza
if($myrow25['numeroE']){

 $agrega = "UPDATE dx 
set

variablesSubjetivas='".$_GET['variablesSubjetivas']."',
variablesObjetivas='".$_GET['variablesObjetivas']."',
analisisVariables='".$_GET['analisisVariables']."',
planTratamiento='".$_GET['planTratamiento']."',
banderaCuadro='si'
where
keyClientesInternos='".$_GET['keyClientesInternos']."'
    
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
print '<script>window.alert("Registro Modificado");window.close();</script>';
} else {
 $agrega = "insert into dx 
(observaciones,entidad,keyClientesInternos,fecha,hora,usuario,medico,numeroE,nCuenta,numeroExpediente,seguro,banderaCuadro,variablesSubjetivas,variablesObjetivas,analisisVariables,planTratamiento) values('".nl2br($_GET['observaciones'])."','".$entidad."','".$_GET['keyClientesInternos']."','".$fecha1."','".$hora1."','".$usuario."','".$MEDICO."','".$numeroE."','".$nCuenta."','".$numeroE."','".$seguro."','si','".$_GET['variablesSubjetivas']."','".$_GET['variablesObjetivas']."','".$_GET['analisisVariables']."','".$_GET['planTratamiento']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

}
?>
<script>
window.opener.document.forms["form1"].submit();
//close();
</script>
<?php 
}






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

<p align="center">
<?php
$sql25= "
SELECT *
FROM
dx
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 

";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);
?>
</p>

  <form id="form1" name="form1" method="GET" action="" onSubmit="return valida(this);" >


    <table width="832" border="0" align="center" class="normal" style="border: 1px solid #80FFFF;">
      <tr>
        <td height="14" colspan="3" align="center" valign="middle" >
            <div align="center">
            <p class="normalmid">HX Cuadro Clinico </p>
        </div>
        </td>
      </tr>

      <tr>
        <td >
            <div align="center">
                <span class="normalmid">
                    Sintomas del Paciente
                </span>
            </div>
        </td>

        <td>
            <textarea name="variablesSubjetivas" cols="80" rows="7" wrap="virtual" id="variablesSubjetivas" <?php if($myrow25['banderaCuadro']=='si'){ echo 'readonly=""';} ?>/>
<?php echo ltrim($myrow25['variablesSubjetivas']);?>
            </textarea>
        </td>

          <td height="33">
              <p>

              </p>
          </td>
      </tr>
        
      <tr>
        <td >
            <div align="center">
                <span class="normalmid">
                    Examen Fisico y Resultados
                </span>
            </div>
        </td>

          <td>
              <textarea name="variablesObjetivas" cols="80" rows="7" wrap="virtual" id="variablesObjetivas" <?php if($myrow25['banderaCuadro']=='si'){ echo 'readonly=""';} ?> />
<?php echo ltrim($myrow25['variablesObjetivas']);?>
              </textarea>
          </td>

        <td height="33">
            <p>
                &nbsp;
            </p>
        </td>
      </tr>
        
      <tr>
        <td bgcolor=>
            <div align="center">
                <span class="normalmid">Diagnostico de los Problemas Clinicos 
                </span>
            </div>
        </td>


        <td>
            <textarea name="analisisVariables" cols="80" rows="7" wrap="virtual" id="analisisVariables" <?php if($myrow25['banderaCuadro']=='si'){ echo 'readonly=""';} ?>/>
<?php echo ltrim($myrow25['analisisVariables']);?>
            </textarea>
        </td>

        <td height="33">
            <p>&nbsp;</p>
        </td>
      </tr>


      <tr>
        <td width="129" >
            <div align="center" class="normal">
                Tratamiento y
                <br />
Plan A Seguir </div>            
        </td>

          
        <td width="504">
            <textarea name="planTratamiento" cols="80" rows="7" wrap="virtual" class="normal" id="planTratamiento" <?php if($myrow25['banderaCuadro']=='si'){ echo 'readonly=""';} ?>/>
<?php echo ltrim($myrow25['planTratamiento']);?>
            </textarea>
        </td>

        <td width="185" height="33">
            <p class="normal">&nbsp;</p>
        </td>
      </tr>

      <tr>

          <td >
            <div align="center">
          <p class="normal">
              Diagnosticos Definitivos </p>
          </div>
        </td>

        <td><?php 		
$sql121= "
SELECT banderaCI
FROM
dx
WHERE

keyClientesInternos ='".$_GET['keyClientesInternos']."' 


";
$result121=mysql_db_query($basedatos,$sql121);
$myrow121= mysql_fetch_array($result121);

?>
          <?php if(!$myrow121['banderaCI']){ ?>
          <a 
		   onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Agregar c&oacute;digos Internacionales';?>&lt;/div&gt;')" onMouseOut="UnTip()"
		  href="javascript:ventanaSecundaria1('agregarCodigoInternacional.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')">(Sin agregar) </a>
          <?php } else {  ?>
C&oacute;digo Internacional <a 
					onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Editar c&oacute;digo internacional';?>&lt;/div&gt;')" onMouseOut="UnTip()"
					href="javascript:ventanaSecundaria1('agregarCodigoInternacional.php?keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>&amp;ci=<?php echo $_GET['ci']; ?>&amp;keyDiagnostico=<?php echo $myrow25['keyDiagnostico']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>')"> (Editar) </a>
<?php } ?></td>
        <td height="33" valign="top"><p class="Estilo24">&nbsp;</p>
        <p class="normalmid">&nbsp;</p>        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
            <input name="actualizar" type="submit" class="normal" id="actualizar" value="Guardar Cuadro Cl&iacute;nico" onClick="if(confirm('Esta seguro que deseas aplicar el SOAP?') == false){return false;}" <?php if($myrow25['banderaCuadro']=='si'){ echo 'disabled=""';} ?>/>
          <a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
          </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="ci" type="hidden" id="ci" value="<?php echo $_GET['ci'];?>" />
          </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="activo" type="hidden" id="activo" value="activo" />
          </a></td>
        <td height="33">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td height="33">&nbsp;</td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>
</html>
