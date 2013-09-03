<?php require('/configuracion/ventanasEmergentes.php');?>
<?php require('/configuracion/funciones.php');

if($_POST['cargos']){ //validacion de vigencia de credenciales




//DEBE EXISTIR EN LA BASE DE DATOS POR LO TANTO REQUIERE EXPEDIENTE
$sSQL10= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['seguro']."' ";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
//**************************************************




if($_POST['eFisico']){
$exp='si';
$fechaSol=$fecha1;
}

$sSQL4f= "Select credenciales from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result4f=mysql_db_query($basedatos,$sSQL4f);
$myrow4f = mysql_fetch_array($result4f);

if($myrow4f['credenciales']=='si'){ //checo que el cliente tenga credenciales activado


$sSQL45z= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' and (numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' and status='A')
AND
fechaFinal >= '".$fecha1."'
and
fechaInicial <= '".$fecha1."' 
";
$re=mysql_db_query($basedatos,$sSQL45z);
$si = mysql_fetch_array($re);


if(!$si['usuario']){ 

$sSQL45z1= "Select usuario,fechaInicial,fechaFinal,keyCredencial from pacientesCredenciales where entidad='".$entidad."' 
and numeroE='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."' 
";
$re1=mysql_db_query($basedatos,$sSQL45z1);
$si1 = mysql_fetch_array($re1);
?>
<script>
window.alert("La credencial: #<?php echo $si1['keyCredencial'];?> expir?z en: <?php echo cambia_a_normal($si1['fechaFinal']);?>, por lo cual est? bloqueada o cancelada..!");
window.close();
</script>
<?php }
}
}



if($_GET['almacen']){
$ALMACEN=$_GET['almacen'];
} else {
$_GET['almacen']=$ALMACEN;
}
?>

<script language=javascript> 
function ventanaSecundaria100 (URL){ 
   window.open(URL,"ventana100","width=600,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librer?a principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librer?a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



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
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=900,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria56 (URL){ 
   window.open(URL,"ventanaSecundaria56","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<?php 

if(!$_POST['nomSeguro']){
$_POST['seguro']='';
}








$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenio=new validaConvenios();
$verificaSaldos=new verificaSeguro();

$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();


if($_POST['keyClientesInternos']!=NULL){
$seguro=$traeSeguro->traeSeguro($_POST['keyClientesInternos'],$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);
}


                $sSQLa2= "Select * From almacenes
                where entidad='".$entidad."' and  almacen='".$_GET['almacen']."'
                
                
                ";
                $resultsa2 = mysql_query($sSQLa2);
                $rowa2 = mysql_fetch_array($resultsa2);

if($rowa2['llenadoEspecial']!=NULL){
    $llenadoEspecial='si';
}













if($_POST['cargos']){
		
		
		
		    $q4 = "

    INSERT INTO contadorCI(contador, usuario,entidad)
    SELECT(IFNULL((SELECT MAX(contador)+1 from contadorCI where entidad='".$entidad."'), 1)), '".$usuario."','".$entidad."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

    $sSQL= "SELECT
    contador
    FROM contadorCI
    WHERE
    entidad='".$entidad."'
    and
    usuario ='".$usuario."'
    order by contador DESC
    ";

    $result=mysql_db_query($basedatos,$sSQL);
    $myrow = mysql_fetch_array($result);
    $numSolicitud= $myrow['contador'];
	
		
		
	

//BENEFICENCIAS

                $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_POST['numeroEx']."'
                and
                fecha='".$fecha1."' and status='standby'
                and
                departamento='".$_GET['almacen']."'
                ";
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                
                
                
                
                if($rowa['numeroE']!=NULL AND $rowa['fecha']==$fecha1 ){
                  $beneficencia=NULL;$statusBeneficencia=NULL;
                    $porcentaje=$rowa['porcentaje'];

                }elseif($_POST['beneficencia']=='si'){
                    $statusBeneficencia='si';
                    $porcentaje=100;

                }else{
                    $beneficencia=NULL;$statusBeneficencia=NULL;

                }




//REVISANDO QUE NO ESTE BLOQUEADA LA CUENTA
$sSQL455= "Select * from pacientesCandados where (entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' and seguro='".$_POST['seguro']."')
OR
(entidad='".$entidad."' and numeroEx='".$_POST['numeroEx']."' )
";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['numeroEx']){ ?>
<script>
window.alert("Oops! Lo sentimos, la cuenta del paciente: <?php echo $myrow455['nombreCompleto'];?> esta bloqueada! por este motivo: <?php echo $myrow455['observaciones'];?>, le sugerimos cargar a otro seguro o arreglar su situacion en admisiones!! Gracias..");
window.close();
</script>


<?php 
}



if($_POST['nomSeguro']){
$sSQL455= "Select nomCliente,clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
if(!$myrow455['clientePrincipal']){
echo '<script>';
echo 'window.alert("Oops! hay un problema con el seguro, revisa bien y vuelve a llenar datos!");';
echo 'window.close();';
echo '</script>';
}
}




if($_POST['nomSeguro'] and $_POST['cortesia']){

echo '<script>';
echo 'window.alert("Oops! Imposible hacer cargos cuando es cortesia y tiene seguro, revisa bien y vuelve a llenar datos!");';
echo 'window.close();';
echo '</script>';

}




$sSQL7m= "Select requiereExpediente from clientes where entidad='".$entidad."' and numCliente='".$myrow455['clientePrincipal']."'";
$result7m=mysql_db_query($basedatos,$sSQL7m);
$myrow7m = mysql_fetch_array($result7m);




if($myrow7m['requiereExpediente']=='si' and !$_POST['numeroEx']){ //Requiere que se escriba el expediente
?>
<script>
window.alert("Esta aseguradora requiere que se busque al paciente por expediente, gracias!");
close();
</script>
<?php 
}else{
$sSQL7= "Select * from pacientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);








$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$_POST['numeroE']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroPaciente'];
if($_POST['nuevo']){
$_POST['paciente']="";
}














//$sSQL4= "Select * from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroEx']."' ";
//$result4=mysql_db_query($basedatos,$sSQL4);
//$myrow4 = mysql_fetch_array($result4);
//$nCuenta = $myrow4['nCuenta']+1;


if($_POST['cortesia']=='si'){
$status='cortesia';

}else{
$status='request';

}

//*************genero orden aleatoria*********
//$nOrden=rand(0,100000);
//if($nOrden1){
//$nOrdenT=$nOrden1;
//} else {
//$nOrdenT=$nOrden;
//}
 
 
 




//*****************cierro orden*****************


$sSQL45= "Select * from clientesInternos where keyClientesInternos ='".$_GET['keyClientesInternos']."'";
$result45=mysql_db_query($basedatos,$sSQL45);
$myrow45 = mysql_fetch_array($result45);

//**********SOLO ESTUDIANTES**************
$sSQL7a= "Select numMatricula from pacientes where entidad='".$entidad."'  and  numCliente='".$_POST['numeroEx']."'     ";
$result7a=mysql_db_query($basedatos,$sSQL7a);
$myrow7a = mysql_fetch_array($result7a);


if($myrow7a['numMatricula']){
$sSQL7c= "Select * from ALUMNOSINSCRITOS where ENTIDAD='".$entidad."'  and  MATRICULA='".$myrow7a['numMatricula']."'  and MODALIDAD='Presencial'   ";
$result7c=mysql_db_query($basedatos,$sSQL7c);
$myrow7c = mysql_fetch_array($result7c);

$sSQL7ab= "Select * from segurosLimites where entidad='".$entidad."'  and seguro='".$_POST['seguro']."'  ";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);

if($myrow7ab['seguro'] and $myrow7c['MATRICULA']){
$_POST['credencial']=$myrow7c['MATRICULA'];
$despliegaEC='si';
$estudiante='si';
}else{
$despliegaEC=NULL;
$estudiante=NULL;
}
}
//***************************************






if($myrow45['numeroE']){


if($_POST['edad']=='prepago'){

echo 'El paciente es de prepago';

} else {

$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$q = "UPDATE clientesInternos set 
numSolicitud='".$numSolicitud."',
autoriza='".$usuario."',    
llenadoEspecial='".$llenadoEspecial."',
    tipoBeneficencia='".$_POST['tipoBeneficencia']."',
    activaBeneficencia='".$statusBeneficencia."',
        porcentaje='".$porcentaje."',
statusCortesia='".$_POST['cortesia']."',

seguro='".$_POST['seguro']."',
credencial='".$_POST['credencial']."',
fecha='".$fecha1."',
hora='".$hora1."',
status='".$status."',
tipoPaciente='externo',
dependencia='".$_POST['dependencia']."',
entidad='".$entidad."',
statusExpediente='request',
edad='".$_POST['edad']."',
diagnostico='".$_POST['diagnostico']."',
estudiante='".$estudiante."',

clientePrincipal='".$cP."',
statusPaciente='".$_POST['statusPaciente']."',
empleado='".$_POST['empleado']."',
despliegaEC='".$despliegaEC."',
descuento='".$_POST['descuento']."',
observaciones='".$_POST['observaciones']."',
    beneficencia='".$beneficencia."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
}


?>

<script language="JavaScript" type="text/javascript">
javascript:nueva('/sima/cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $_POST['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>','ventanaSecundaria20','1000','800','yes');

//opener.location.reload(true); aqui?
window.close();

</script>
<?php





} else {
if($_POST['cargos']  AND $_POST['paciente']){
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_POST['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

if($myrow455['clientePrincipal']){
$cP=trim($myrow455['clientePrincipal']);
}else{
$cP='';
}


$d='Ingreso el paciente: '.$_POST['paciente'].', con el numero de expediente: '.$_POST['numeroEx'].', y con el seguro: '.$_POST['seguro'].', '.$_POST['nomSeguro'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$d."','".$ALMACEN."','".$ALMACEN."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,diagnostico,telefono,folioVenta,clientePrincipal,statusPaciente,
tipoAccidente,
fechaAccidente,
horaAccidente,
lugarAccidente,
llegoHospital,
ministerio,
motivoConsulta,
alergiaT,
alergiaP,
alergiaR,
alergiaPA,
tiposAlergias,
peso,dx,empleado,expediente,fechaSolicitud,despliegaEC,naturaleza,estudiante,descuento,statusCortesia,activaBeneficencia,porcentaje,
tipoBeneficencia,llenadoEspecial,autoriza,numSolicitud
) values (
'".$_POST['numeroEx']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'".$status."',
'".$_POST['cita']."',
'".$ALMACEN."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','request','".$_POST['dependencia']."','".$entidad."','".$_POST['diagnostico']."','".$_POST['telefono']."','',
'".$cP."','".$_POST['statusPaciente']."',
'".$_POST['tipoAccidente']."',
'".$_POST['fechaAccidente']."',
'".$_POST['horaAccidente']."',
'".$_POST['lugarAccidente']."',
'".$_POST['llegoHospital']."',
'".$_POST['ministerio']."',
'".$_POST['motivoConsulta']."',
'".$_POST['alergiaT']."',
'".$_POST['alergiaP']."',
'".$_POST['alergiaR']."',
'".$_POST['alergiaPA']."',
'".$_POST['tiposAlergias']."',
'".$_POST['peso']."',
'".$_POST['dx']."',
'".$_POST['empleado']."','".$exp."','".$fechaSol."','".$despliegaEC." ','D','".$estudiante."','".$_POST['descuento']."','".$_POST['cortesia']."',
    '".$statusBeneficencia."','".$porcentaje."','".$_POST['tipoBeneficencia']."','".$llenadoEspecial."','".$usuario."','".$numSolicitud."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();






$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
numSolicitud='".$numSolicitud."'

";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos'];
$leyenda='SE GENERO LA ORDEN #'.$numSolicitud;




?>




<script>
javascript:nueva('/sima/cargos/agregaArticulos.php?numeroE=<?php echo $myrow1['numeroE']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacen=<?php echo $ALMACEN; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow1['keyClientesInternos'];?>&tipoPaciente=<?php echo 'externo';?>&folioVenta=<?php echo $myrow1['folioVenta']; ?>&load=activated','ventanaSecundaria20','1000','800','yes');
close();
</script>
<?php 
} else {
//echo "YA DISTE DE ALTA ESA NOTA DE CARGO, ESCOJE EL EXPEDIENTE NUEVO";
}
}
}//cierro actualizar nota de venta

//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************


}
?>


<?php 

if($_POST['quitar']){
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$codigo[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}

}
$nOrden1=$nOrdenT;
?>






<?php	
if($_POST['verCargos']){ 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();
if($myrow33['numeroE'] and !$_POST['nuevo']){
$numeroE1=$myrow33['numeroE'];
 } 
} 
 ?>



<?php 
$sSQL4= "Select * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=700,scrollbars=YES") 
} 
</script> 

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<head>





<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />


</head>













<body>
<?php 




$sSQL39= "SELECT *
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

?>
    

    
<div>
  <form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <p><span  align="center">Departamento: <?php echo $myrow39['descripcion']; ?></span></p>
    <table width="635" class="table-forma">

      <tr >
        <td width="4" >&nbsp;</td>
        <td width="94" >Apellidos del Paciente</td>
        <td colspan="3"><div align="left">
 <strong>
  
            </strong>
            <?php if($myrow4['numeroE']){ ?>
            <input name="paciente" type="text"  id="paciente" value="<?php 
		echo $myrow4['paciente'];
		  ?>" size="60"  />
            <?php } else { ?>
            <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60"   />
            <a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a>
            <!-- 
          <input name="M22" type="button" class="style15" id="M22"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/listaPacientesPrepago.php?campoDespliega=<?php echo "paciente"; ?>&forma=<?php echo "form1"; ?>&campo=<?php echo "numeroEx"; ?>&fechaNac=<?php echo "keyClientesInternos"; ?>&edad=<?php echo "edad"; ?>')" value="PP" />
        </div></th>-->
            <?php } ?>
            <br />
            <span >     Estudiantes UM, Jubilados, Dependientes UM, por favor escoge el EXPEDIENTE<br /></span>           
        </div></td>
        
        
        <td width="112">
        	<a href="javascript:ventanaSecundaria56('/sima/cargos/busquedaAvanzada.php?campoDespliega=<?php echo "descripcionPaquete"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "numeroEx"; ?>&amp;seguro=<?php echo "paciente"; ?>')" class="none">
		<div >
		Busqueda Avanzada 
		</div>
		</a>
          <?php if($myrow4['numeroE']){ ?>
          <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php echo $myrow4['numeroE'];?>" readonly="readonly" />
          <?php } else { ?>
          <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="readonly" />
          <?php } ?>
          <input name="edad2" type="hidden"  id="edad2" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
          <label>
            <input name="fechaNac" type="hidden"  id="fechaNac" size="10"  readonly="" value="<?php 
		  if($_POST['fechaNac'] and !$_POST['fechaNac']){
		  echo $_POST['fechaNac'];
		  } 
		  ?>"/>
        </label></td>
      </tr>
      <tr >
        <td height="45" >&nbsp;</td>
        <td >Seguro
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
        </span></td>
        <td colspan="4"><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        <span >(Exclusivo Aseguradoras)</span></td>
      </tr>
      
      
      
      <tr >
        <td height="39">&nbsp;</td>
        <td >Promocion</td>
        <td><label>
          <input name="descuento" type="checkbox" id="descuento" value="si" /> 
          <span >[ Al presentar volante valido] </span>
        </label></td>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      
       <?php if( $rowa2['beneficencia']=='si'){?>
      
            <tr >
        <td height="39">&nbsp;</td>
        <td >Beneficencia</td>
        <td><label>
          <input name="beneficencia" type="checkbox" id="beneficencia" value="si" /> 
          <span >El cargo ira al 100%</span>
        </label></td>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      
      <?php }?>
      
      <tr >
        <td height="39">&nbsp;</td>
        <td >Empleado</td>
        <td width="204"><input name="empleado" type="text"  id="empleado" 
	value="<?php 
	if($_POST['empleado'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['credencial']){
	echo $myrow33['credencial']; 
	}
	?>" size="30" /></td>
        <td width="114" >Credencial / Nomina</td>
        <td width="122"><input name="credencial" type="text"  id="credencial" 
	value="<?php 
	if($_POST['credencial'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['credencial']){
	echo $myrow33['credencial']; 
	}
	?>" size="20" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr >
        <td height="24">&nbsp;</td>
        <td >Expediente</td>
        
        <td><input name="eFisico" type="checkbox" id="eFisico" value="si" <?php if($myrow33['cortesia']=='si'){echo 'checked=""'; }?>/>
        <span >(Si solicita expediente fisico)</span></td>
        
        <td >Cortesia<span >
        <input name="cortesia" type="checkbox" id="cortesia" value="si" <?php if($myrow33['cortesia']=='si'){echo 'checked=""'; }?>/>
        </span></td>
        
        
        <td>&nbsp;</td>
        <td>&nbsp;</td>

        
      </tr>
      
      
      
      
      <?php 
      if($myrow39['tipoBeneficencia']=='si'){?>
        <tr >
        <td height="24">&nbsp;</td>
               <td>&nbsp;</td>
        <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       <td ><b>Beneficencia Auto</b><span >
        <input name="tipoBeneficencia" type="checkbox" id="cortesia" value="si" <?php if($myrow39['tipoBeneficencia']=='si'){echo 'checked=""'; }?>/>
        </span></td> 
       
      </tr>
      <?php } ?>
      
      
      <tr >
        <td height="29">&nbsp;</td>
        <td >Dependencia</td>
        <td colspan="3"><span >
          <input name="dependencia" type="text"  id="dependencia" 
	value="<?php 
	if($_POST['dependencia'] and !$_POST['nuevo']){
	echo $_POST['dependencia'];
	} else if($myrow33['dependencia']){
	echo $myrow33['dependencia']; 
	}
	?>" size="60" />
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        
      </tr>
      <tr >
        <td height="24">&nbsp;</td>
        <td >Observaciones</td>
        <td colspan="3"><textarea name="observaciones" cols="57" rows="3" wrap="virtual"  id="observaciones"></textarea></td>
        <td>&nbsp;</td>
      </tr>
      <tr >
        <td height="24" colspan="6"   align="center"><h1>Opciones de Seguro</h1></td>
      </tr>
      <tr >
        <td height="26">&nbsp;</td>
        <td >N&deg; de Poliza</td>
        <td><input type="text" name="numPoliza" id="numPoliza" /></td>
        <td><span >Status Paciente</span></td>
        <td><span >
          <select name="statusPaciente" id="statusPaciente">
            <option value="">---</option>
            <option
            <?php if($_POST['statusPaciente']=='DH')echo 'selected=""';?>
             value="DH">DH</option>
            <option
            <?php if($_POST['statusPaciente']=='BE')echo 'selected=""';?>
             value="BE">BE</option>
            <option
            <?php if($_POST['statusPaciente']=='BH')echo 'selected=""';?>
             value="BH">BH</option>
            <option
            <?php if($_POST['statusPaciente']=='BI')echo 'selected=""';?>
             value="BI">BI</option>
          </select>
        </span></td>
        <td>&nbsp;</td>
      </tr>
      <tr >
        <td>&nbsp;</td>
        <td >N&deg; Siniestro</td>
        <td><span >
          <input type="text" name="numSiniestro" id="numSiniestro" />
        </span></td>
        <td>
        <?php 
//$sSQL1= "Select * From clientesInternos WHERE usuario = '".$usuario."' order by keyClientesInternos DESC ";
//$result1=mysql_db_query($basedatos,$sSQL1);
//$myrow1 = mysql_fetch_array($result1);
?>
	<input name="fechaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['fechaSolicitud'];?>" />
	<input name="horaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['horaSolicitud'];?>" />        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>

    </table>
  
	  <?php //Abrir campos almacenes 
	  
	  $sSQL1= "Select keyC From camposAlmacenes where 
 id_almacen='".$ALMACEN."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
	  ?>
	  
	  <?php //cierra campos almacenes ?>
	  
	  
	  
	  
     <label>

          </label>
          <label>


			</label>          
			
		
		  <div align="center"><strong>
            <input name="almacenImporte" type="hidden" id="almacenImporte" value="<?php echo $_POST['almacenImporte']; ?>"/>
            </strong>
            <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>"/>
            <input name="pacientes" type="hidden" id="pacientes" value="<?php echo $_POST['paciente']; ?>" />
            <input name="PACIENTED" type="hidden" id="PACIENTED" value="<?php echo $_POST['paciente']; ?>" />
            <input name="FOLIOD" type="hidden" id="PACIENTED" value="<?php echo $Folio[0]; ?>" />
            <input name="keyClientesI" type="hidden" id="FOLIOD" value="<?php echo $keyClientesI; ?>" />
            <input name="pagina" type="hidden" id="keyClientesI" value="<?php echo $pagina; ?>" />
            <input name="nOrden" type="hidden" id="pagina" value="<?php echo $nOrden; ?>" />
		    <input name="keyClientesInternos" type="hidden" id="nOrden" value="<?php echo $_GET['keyClientesInternos']; ?>" />
		  </div>


  
  <p>
    <?php //Abrir campos almacenes 
 $sSQL14= "Select codigoCampo From campos,camposAlmacenes where 
 camposAlmacenes.id_almacen='".$ALMACEN."' 
 and
 campos.keyC=camposAlmacenes.keyC";
 $result14=mysql_db_query($basedatos,$sSQL14); 
 while($myrow14 = mysql_fetch_array($result14)){
  $codigoCampo[]=$myrow14['codigoCampo'];
 }
	  ?>

    <?php if($codigoCampo[0]=='cedad'){ ?>
  
  <table width="402" class="table-forma">

	  <tr >
	    <td colspan="5" align="center" >Datos Adicionales del Paciente</td>
      </tr>
	  <tr >
	    <td width="4" height="27">&nbsp;</td>
	    <td width="71" >

        
        Edad</td>
	    <td width="184"><input name="edad" type="text"  id="edad" 
	value="<?php 

	if($_POST['edad'] and !$_POST['nuevo']){
	echo $_POST['credencial'];
	} else if($myrow33['edad']){
	echo $myrow33['edad']; 
	}
	?>" size="3" />



    </td>
	
	
	
	
	
	    <td width="115">&nbsp;</td>
	    <td width="156">&nbsp;</td>
      </tr>
	  <tr >
	    <td>&nbsp;</td>
	    <td >

        M&eacute;dico</td>
	    <td colspan="2"><input name="medico" type="text"  id="medico" 
	value="<?php 
	if($_POST['medico'] and !$_POST['nuevo']){
	echo $_POST['medico'];
	} else if($myrow33['medico']){
	echo $myrow33['medico']; 
	}
	?>" />

    </td>
	
	
	
	
	    <td>&nbsp;</td>
      </tr>
	  <tr >
	    <td>&nbsp;</td>
	    <td >

        Diagn&oacute;stico</td>
	    <td colspan="2"><textarea name="diagnostico" cols="40" wrap="off"  id="diagnostico"><?php 
	if($_POST['diagnostico'] and !$_POST['nuevo']){
	echo $_POST['diagnostico'];
	} else if($myrow33['diagnostico']){
	echo $myrow33['diagnostico']; 
	}
	?>
          </textarea>
          
</td>

	    <td>&nbsp;</td>
      </tr>
	  
	  
	  <tr >
	    <td height="27">&nbsp;</td>
	    <td >

        Tel&eacute;fono</td>
	    <td colspan="2"><input name="telefono" type="text"  id="telefono" 
	value="<?php 
	if($_POST['telefono'] and !$_POST['nuevo']){
	echo $_POST['telefono'];
	} else if($myrow33['telefono']){
	echo $myrow33['telefono']; 
	}
	?>" />

    </td>
	    <td>&nbsp;</td>
      </tr>


    </table>

  	  <?php } ?>
  
  
<p>&nbsp;</p>
  <p>
    <?php //Abrir campos almacenes 
 $sSQL14= "Select codigoCampo From campos,camposAlmacenes where 
 camposAlmacenes.id_almacen='".$ALMACEN."' 
 and
 campos.keyC=camposAlmacenes.keyC";
 $result14=mysql_db_query($basedatos,$sSQL14); 
 while($myrow14 = mysql_fetch_array($result14)){
 $codigoCampo[]=$myrow14['codigoCampo'];
 }
 
 
 

	  ?>
	  
	  
	  
	  
	  
    <?php if($codigoCampo[4]=='ccedulamed'){ ?>
  </p>

  <table width="437" class="table-forma">
    <tr >
      <td colspan="5" align="center" >Solo para ser llenado en la Venta de Antiobioticos</td>
    </tr>
    <tr >
      <td width="4" height="27">&nbsp;</td>
      <td width="92" >
        Cedula Profesional</td>
      <td width="197"><input name="cedula" type="text"  id="cedula" 
	value="<?php 

	if($_POST['cedula'] and !$_POST['nuevo']){
	echo $_POST['cedula'];
	} else if($myrow33['cedula']){
	echo $myrow33['cedula']; 
	}
	?>" size="15" />
</td>






      <td width="81">&nbsp;</td>
      <td width="63">&nbsp;</td>
    </tr>
    
    
    
    
    
    
    
    <tr >
      <td>&nbsp;</td>
      <td >
        M&eacute;dico</td>
      
      
      
      <td colspan="2"><input name="medico3" type="text"  id="medico3" 
	value="<?php 
	if($_POST['medico'] and !$_POST['nuevo']){
	echo $_POST['medico'];
	} else if($myrow33['medico']){
	echo $myrow33['medico']; 
	}
	?>" />
</td>





      <td>&nbsp;</td>
    </tr>
    <tr >
      <td>&nbsp;</td>
            <td>&nbsp;</td>
    </tr>
    <tr >
      <td height="27">&nbsp;</td>
      <td >
        Direccion del Medico</td>
      <td colspan="2"><input name="dirmedico2" type="text"  id="dirmedico2" 
	value="<?php 
	if($_POST['dirmedico'] and !$_POST['nuevo']){
	echo $_POST['dirmedico'];
	} else if($myrow33['dirmedico']){
	echo $myrow33['dirmedico']; 
	}
	?>" />
       </td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td height="19" colspan="5" >&nbsp;</td>
    </tr>
    <?php } ?>
  </table>
  
  
  
  
  
  
  
  
  
      <?php //Abrir campos almacenes 
	  
  $sSQL1a= "Select registroUrgencias From almacenes where entidad='".$entidad."'
	  and
 almacen='".$ALMACEN."' 
";
$result1a=mysql_db_query($basedatos,$sSQL1a); 
$myrow1a = mysql_fetch_array($result1a);
if($myrow1a['registroUrgencias']=='si'){ 
	  ?>
 

  <p>

  </p>
  <table width="665" class="table-forma">
    
    
    

    
    
    
    <tr >
      <th colspan="5" align="center" ><p align="center">Datos del Paciente</p></th>
      </tr>
    
    
    
    
    <tr >
      <td width="5" height="27">&nbsp;</td>
      <td width="160"><span >Tipo de Accidente</span></td>
      <td colspan="3"><input name="tipoAccidente" type="text"  id="tipoAccidente"
		   value="" size="60" /></td>
      </tr>
    
    
    
    
    
    
    <tr >
      <td>&nbsp;</td>
      <td >Fecha Accidente</td>
      <td width="100"><input name="fechaAccidente" type="text"  id="fechaAccidente" value="" size="15" /></td>
      <td width="126"><span >Hora Accidente </span></td>
      <td width="329"><input name="horaAccidente" type="text"  id="horaAccidente" value="" size="10" /> 
        <span >Avis&oacute; al Ministerio? </span>
        <input name="ministerio" type="checkbox" id="ministerio" value="si" <?php 
		  if($_POST['ministerio']){echo 'checked=""';}
		  ?> /></td>
    </tr>
    
    
    
    
    <tr >
      <td>&nbsp;</td>
      <td >Lugar Accidente</td>
      <td colspan="3">&nbsp;</td>
      </tr>
    <tr >
      <td>&nbsp;</td>
      <td><span >&iquest;C&oacute;mo lleg&oacute; al Hospital?</span></td>
      <td colspan="3"><textarea name="llegoHospital" cols="57" rows="4" wrap="physical"  id="llegoHospital"></textarea>
        <textarea name="lugarAccidente" cols="57"  id="lugarAccidente"></textarea></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td >Motivo de Consulta</td>
      <td colspan="3"><textarea name="motivoConsulta" cols="57" wrap="virtual"  id="motivoConsulta"></textarea></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td><span >Alergias (Si Tiene) </span></td>
      <td colspan="3"><textarea name="tiposAlergias" cols="57"  id="tiposAlergias"></textarea></td>
    </tr>
    <tr >
      <td height="27">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" >T 
        <input name="alergiaT" type="checkbox" id="alergiaT" value="si" <?php 
		  if($_POST['alergiaT'])echo 'checked=""';
		  ?>  />
		  
		   
        P
        <input name="alergiaP" type="checkbox" id="alergiaP" value="si" <?php 
		  if($_POST['alergiaP'])echo 'checked=""';
		  ?>/>
		  
		  
		   
        R
        <input name="alergiaR" type="checkbox" id="alergiaR" value="si" <?php 
		  if($_POST['alergiaR'])echo 'checked=""';


		  ?>/> 
		  
		  
		  
        PA
        <input name="alergiaPA" type="checkbox" id="alergiaPA" value="si" <?php 
		  if($_POST['alergiaPA'])echo 'checked=""';
		  ?>/></td>
		  
		  
		  
      <td><span >Peso
        <input name="peso" type="text"  id="peso" value="<?php if($_POST['peso'])echo $_POST['peso'];?>" size="10"/>
      </span>
      

       <?php } ?>
      </td>
    </tr>
    
    
    
    
    
      <tr >
      <td>&nbsp;</td>
      <td >
          <div align="center" >
          Diagnostico
          </div>
          </td>
      <td colspan="3"><textarea name="dx" cols="57" wrap="virtual" class="combosmid" id="dx"></textarea></td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
</table>
<p>&nbsp;</p>







<table width="427" border="0" align="center">
         <tr>
           <td width="166"><div align="center">
             <input name="cargos" type="submit" src="/sima/imagenes/btns/new_cargos2.png" id="hacerCargos" value="Agregar Nota de Cargo" />
           </div></td>
           <td width="93"><div align="center"></div></td>
           <td width="154"><div align="center">
             <?php //cierra campos almacenes ?>
             <input name="nuevo" type="submit" src="/sima/imagenes/btns/new_limpia.png"  id="nuevo2" value="Nuevo" />
           </div></td>
      </tr>
</table>








	   <p>&nbsp;</p>
<div align="center"></div>
  <p>&nbsp;</p>
</form>

 </div>



  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
    
    
    
    
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&almacen=<?php echo $_GET['almacen'];?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
