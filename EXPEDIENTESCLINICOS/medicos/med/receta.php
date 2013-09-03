<?php require('/configuracion/ventanasEmergentes.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
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
                alert("Por Favor, escribe las observaciones del diagnóstico!")   
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

if($_GET['actualizar'] and $_GET['receta']){
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

";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);

//actualiza
if($myrow25['numeroE']){

 $agrega = "UPDATE dx 
set
receta='".$_GET['receta']."',banderaReceta='si'
where
keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
} else {
$agrega = "insert into dx 
(receta,entidad,keyClientesInternos,fecha,hora,usuario,medico,numeroE,nCuenta,numeroExpediente,seguro,banderaReceta) values('".nl2br($_GET['receta'])."','".$entidad."','".$_GET['keyClientesInternos']."','".$fecha1."','".$hora1."','".$usuario."','".$MEDICO."','".$numeroE."','".$nCuenta."','".$numeroE."','".$seguro."','si')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

}
?>
<script>
window.opener.document.forms["form1"].submit();
self.close();
</script>
<?php 
}






?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
.style12 {font-size: 10px}
.style12 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>

<body>

  <p align="center">
  <?php
 $sql25= "
SELECT receta
FROM
dx
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 
and
banderaReceta='si'
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);
?>
  </p>
  <form id="form1" name="form1" method="GET" action="" onSubmit="return valida(this);" >

    <table width="591" border="0" align="center" class="style7">
      <tr>
        <td height="14" colspan="2" bgcolor="#660066"><div align="center"><span class="style13">Indicaciones</span></div></td>
      </tr>
      <tr>
        <td width="156" height="33" bgcolor="#660066">&nbsp;</td>
        <td width="514"><label>
          <textarea name="receta" cols="80" rows="10" wrap="virtual" id="receta"><?php echo $myrow25['receta'];?></textarea>
        </label></td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td><input name="actualizar" type="submit" class="style7" id="actualizar" value="Agregar Indicaciones" onClick="if(confirm('Esta seguro que deseas aplicar este diagnóstico?') == false){return false;}" />
        <a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
        </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <input name="ci" type="hidden" id="ci" value="<?php echo $_GET['ci'];?>" />
        </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <input name="activo" type="hidden" id="activo" value="activo" />
        </a></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>
</html>
