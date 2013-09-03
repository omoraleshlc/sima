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


<script>
function cerrar(){

close();
}
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {
	color: #FFFFFF;
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
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
and
banderaCuadro='si'
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);
?></p>
  <form id="form1" name="form1" method="GET" action="" onSubmit="return valida(this);" >

    <table width="719" height="606" border="0" align="center" class="style7">
      <tr>
        <td height="14" colspan="2" align="center" valign="middle" bgcolor="#660066"><div align="center">
          <p class="style13">HX Cuadro Cl&iacute;nico </p>
          </div></td>
      </tr>
      <tr>
        <td bgcolor="#660066"><div align="center"><span class="style13">Variables Subjetivas </span></div></td>
        <td height="110"><p>
     <?php echo $myrow25['variablesSubjetivas'];?>
        </p>        </td>
      </tr>
      <tr>
        <td bgcolor="#660066"><div align="center"><span class="style13">Variables Objetivas </span></div></td>
        <td height="104"><p>
      <?php echo ltrim($myrow25['variablesObjetivas']);?>
        </p>        </td>
      </tr>
      <tr>
        <td bgcolor="#660066"><div align="center"><span class="style13">An&aacute;lisis de Variables </span></div></td>
        <td height="102"><p>
        <?php echo ltrim($myrow25['analisisVariables']);?></p>        </td>
      </tr>
      <tr>
        <td width="129" bgcolor="#660066"><div align="center" class="style13">Plan de Tratamiento </div>
</td>
        <td width="576" height="109"><label><br>
<?php echo ltrim($myrow25['planTratamiento']);?>
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td height="33"><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
          </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="ci" type="hidden" id="ci" value="<?php echo $_GET['ci'];?>" />
          </a><a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_GET['seguro']; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="activo" type="hidden" id="activo" value="activo" />
          <label>
          <input name="Submit" type="button" class="style7" value="Cerrar" onClick="cerrar();" />
          </label>
          </a></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>
</html>
