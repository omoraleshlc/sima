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

if($_GET['actualizar'] ){
$uploaddir = 'images/';
$uploadfile = $uploaddir.$random.basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
//**********************************************************


//****************comprueba si ya existe****************/



//actualiza
 $agrega = "UPDATE dx 
set
observaciones='".nl2br($_GET['observaciones'])."'
where
entidad='".$entidad."'
and
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
CI='".$_GET['ci']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>
<script>
window.opener.location.reload(true);
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

  <p align="center"><?php ?></p>
  <form id="form1" name="form1" method="GET" action="" onSubmit="return valida(this);" >

    <table width="520" border="0" align="center" class="style7">
      <tr>
        <td height="14" bgcolor="#660066"><div align="center"><span class="style13">Medicamentos Asignados </span></div></td>
      </tr>
      <tr>
        <td width="514" height="33"><label>
<?php 		
$sql121= "
SELECT medicamentos
FROM
dx
WHERE
entidad='".$entidad."'
and
keyClientesInternos ='".$_GET['keyClientesInternos']."' 
and
ci='".$_GET['ci']."'

";
$result121=mysql_db_query($basedatos,$sql121);
$myrow121= mysql_fetch_array($result121);
echo $myrow121['medicamentos'];
?>
		</label></td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
</body>
</html>
