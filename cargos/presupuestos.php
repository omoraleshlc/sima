<?php  require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');


//************INSTANCIAMIENTOS******************

$convenios= new validaConvenios();

$global= new validaConvenios();

$tipoConvenioS=new validaConvenios();

$traeSeguro=new verificaSeguro1();

$verificaSaldos1=new verificaSeguro1();

$verificaSaldosInternos=new verificaSeguro1();

$validaJubilados=new validaConvenios();

$porcentajeJubilados=new validaConvenios();

$ivaAseguradora=new ivaCierre();

$ivaParticular=new ivaCierre();

$pagoEfectivo=new ivaCierre();

$descripcion=new articulosDetalles();

$random=rand(10000,10000000000000);

$porcentajeIVA=new articulosDetalles();

$descripcionGrupoProducto=new articulosDetalles();

$ventaPieza=new tipoVentaArticulo();

//***********ALMACEN PRINCIPAL***************/


$sSQL7n= "Select * from periodoAlumnos where entidad='".$entidad."'  and  '".$fecha1."' between fechaInicial and fechaFinal ";
$result7n=mysql_db_query($basedatos,$sSQL7n);
$myrow7n = mysql_fetch_array($result7n);

$sSQL7na1= "Select numMatricula from pacientes where entidad='".$entidad."'  and numCliente='".$_POST['numeroEx']."'  ";
$result7na1=mysql_db_query($basedatos,$sSQL7na1);
$myrow7na1 = mysql_fetch_array($result7na1);

$sSQL7na= "Select * from ALUMNOSINSCRITOS where entidad='".$entidad."'  and MATRICULA='".$myrow7na1['numMatricula']."'  ";
$result7na=mysql_db_query($basedatos,$sSQL7na);
$myrow7na = mysql_fetch_array($result7na);
?>






<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=650,height=700,scrollbars=YES") 
} 
</script>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
$seguro=$_POST['seguro'];
$_GET['numeroE']=$_POST['numeroEx'];

?>
<head>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>




<body>
<h1 align="center" >Hacer Presupuesto<?php echo $leyenda; ?>
</h1>
    
  <br />
    
    
<form name="form2" id="form2" method="post" action="">
  <table width="524" height="125" class="table-forma" >
    <tr valign="middle" >
      <th colspan="3"><p align="center">Datos del Paciente </p></th>
    </tr>
    
        <tr valign="middle" >
    <p align="center">
    <?php 
    $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
       ventas='si'
            and
activo='A'  order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino"  />        
     <option value="">---</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option 
		<?php 
if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } 
                 
                 ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
</p>  
       </tr> 
    
    <tr valign="middle" >
      <td height="49" colspan="3" ><div align="center">
          <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php if($_POST['numeroEx'] and !$_POST['nuevo']){ echo $_POST['numeroEx'];}?>" readonly="" />
      N Exp. Apellido o Nombre</div></td>
    </tr>
	

    <tr valign="top"  >
      <td height="36" >Nombre/Matricula</td>
      <td ><span >
        <input name="paciente" type="text"  id="paciente" value="<?php 
		  if($_POST['paciente'] AND !$_POST['nuevo']){
		  echo $_POST['paciente'];
		  } 
		  ?>" size="60"  />
      </span></td>
      <td >&nbsp;</td>
    </tr>
    <tr valign="top"  >
      <td height="36" >Seguro</td>
      <td ><input name="nomSeguro" type="text"  id="nomSeguro" size="60" 
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
      <td >&nbsp;</td>
    </tr>
    <tr valign="top"  >
      <td width="185" height="36" ><div align="center"><span >
        <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		 />
      </span></div></td>
      <td width="240" >&nbsp;</td>
	  
	  
	  

      <td width="97" >
      &nbsp;</div></td>
    </tr>
  </table>



    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   <h1 align="center"> Paciente</h1>
    
    
    
    <table width="762" class="table-forma" >

    <?php if($ppbI>0){//beneficencia activada?>
        <tr >

      <td colspan="9" align="center" >
          <span >
        <?php echo 'El paciente tiene beneficencia del '.$ppbI.'%'; ?>
          </span></td>

    </tr>
    <?php }?>
    
    
    

    <tr>

     





<?php if($seguro!=NULL){?>
      <td colspan="4"  >Seguro<span >:  

        <?php 

	  

	  $sSQL3113= "Select nomCliente,clientePrincipal From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."' ";

$result3113=mysql_db_query($basedatos,$sSQL3113);

$myrow3113 = mysql_fetch_array($result3113);





$sSQL311= "Select cantidad From segurosLimites WHERE  entidad='".$entidad."' and seguro='".$seguro."' ";

$result311=mysql_db_query($basedatos,$sSQL311);

$myrow311 = mysql_fetch_array($result311);



	  echo $myrow3113['nomCliente'];?>

      </span></td>
<?php }else{?>
      
      
      <td   >Cliente Particular<span >

      

      </span></td>
      
      
      
<?php }?>      
      
      
      
      
      
      
      
      
      <td colspan="2" align="center"  >Limite de Credito</td>

      <td colspan="2" align="center"  >Credito Disponible</td>
 <td width="4" >&nbsp;</td>

    </tr>

    <tr>
      <td width="4" >&nbsp;</td>

      <td width="4" height="28" >&nbsp;</td>
                 



<?php if($db=='si'){     ?>
  <td width="429"  >El paciente es de beneficencia, paga solo el <span >
     <?php echo $P=100-$myrow10a['porcentaje']; ?>%
      </span></td>
  <?php } else{?>
  <td width="429"  ><span >

      </span></td>
      <?php }?>
      
      
      
      <td width="39" colspan="3" ><span ><?php echo "$".number_format($myrow311['cantidad'],2); ?></span></td>

      <td align="center" ><span ><?php echo "$".number_format($myrow321['limiteSeguro'],2); ?></span></td>
      <td align="center" >&nbsp;</td>

    </tr>

    
    

    <tr >

      <td colspan="9" align="center" >ARTICULO A CARGAR</td>

    </tr>

    <tr>

      <td height="27" colspan="9" align="center" > <input  name="nomArticulo" type="text"  id="nomArticulo" size="60" autocomplete="off" 
 /></td>

    </tr>

    <tr>

      <td colspan="9"  align="center">

        <label>
        <input name="search" type="submit" id="search" value="Buscar" />
        </label>

      

      </td>

    </tr>

   

    <tr >

      <td colspan="9">

                      <?php	

	
if(!$_POST['almacenDestino']){
$almacenDestinoB=$_GET['almacen']    ;
}else{
$almacenDestinoB=$_POST['almacenDestino'];
}



	  $articulo=$_POST['nomArticulo'];

    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$almacenDestinoB."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
    $almacenDestinoB=$myrow29p['almacenExistencias'];
    
}





$unidadMedida=new articulosDetalles();



















if($_POST['search']){



if(is_numeric($articulo)){

$sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,

articulos.descripcion1,articulos.sustancia

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND



articulos.gpoProducto!=''

AND



articulos.cbarra='".$articulo."'

AND

articulos.activo='A' 

AND

articulos.codigo=existencias.codigo 

and

existencias.almacen='".$almacenDestinoB."'

order by articulos.descripcion ASC

";  

	  } else {

  $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

AND

articulos.gpoProducto!=''

AND



articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')

AND

articulos.codigo=existencias.codigo and

existencias.almacen='".$almacenDestinoB."'

order by articulos.descripcion ASC

";



}











if(!$articulo and $_POST['buscar']){ 



$sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,
articulos.referido,articulos.laboratorioReferido,articulos.keyPA,articulos.descripcion,

existencias.ventaGranel,existencias.tipoVenta,existencias.cantidadSurtir,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,existencias

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

existencias.almacen='".$almacenDestinoB."'

and

articulos.gpoProducto!=''

AND



articulos.activo='A' 

and

existencias.keyPA=articulos.keyPA

order by articulos.descripcion ASC



";

} 











//********************CONVENIO EXCLUSIVO************************





if(!$articulo and $myrow3113c['numCliente']){

if($myrow3113c['numCliente']){

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,articulos.keyPA,
convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,convenios

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

convenios.departamento='".$almacenDestinoB."'

and

articulos.gpoProducto!=''

AND



articulos.activo='A' 

and

convenios.keyPA=articulos.keyPA

order by articulos.descripcion ASC

group by convenios.keyPA



";

}else{

 $sSQL= "SELECT 

articulos.codigo,articulos.gpoProducto as gpoProductos,articulos.generico,articulos.referido,articulos.laboratorioReferido,
articulos.keyPA,convenios.keyConvenios,convenios.keyPA as simulacion,articulos.descripcion,articulos.antibiotico,
articulos.descripcion1,articulos.sustancia

FROM articulos,convenios

WHERE

(articulos.entidad='".$entidad."' AND existencias.entidad='".$entidad."' )

and

articulos.gpoProducto!=''



AND

articulos.activo='A' and

(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')

AND

articulos.codigo=convenios.codigo and

convenios.almacen='".$almacenDestinoB."'

group by convenios.keyPA

order by articulos.descripcion ASC

";



}

}









//**************************************************************













$result=mysql_db_query($basedatos,$sSQL);

$almacenDestino=$almacenDestinoB;

?>


          
          
          
          
          

        <p align="center"> 

            
            
            
            
            
            
            

            
            
            
            
            
            
            
  <span >

  <?php 

	

	echo $leyenda;

	?>

	</span><?php if($horaSolicitud AND $fechaSolicitud){ ?>

		

		

	    <input name="fechaSolicitud" type="hidden"   value="<?php echo $fechaSolicitud;?>"/>

<input name="horaSolicitud" type="hidden"  value="<?php echo $horaSolicitud;?>" size="10"/>

 

   <?php }  ?>

      

      

      </td>

    </tr>

    <tr >


      <th colspan="6" align="left" >DESCRIPCION</th>
      
      

      
      
      

<?php       

$sSQL7ada1= "Select actualizaPrecios From almacenes where entidad='".$entidad."' and almacen='".$_GET['almacen']."'  ";

$result7ada1=mysql_db_query($basedatos,$sSQL7ada1); 

$myrow7ada1 = mysql_fetch_array($result7ada1);

echo mysql_error();

?>





      <th  align="right" colspan="3" >Precio</th>


      
    </tr>



    <?php 



while($myrow = mysql_fetch_array($result)){ 

$almacen=$almacenDestino;

$bandera+="1";



$sSQL3113cd= "Select descripcionGP From gpoProductos WHERE entidad='".$entidad."' and codigoGP='".$myrow['gpoProductos']."'  ";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);



//$gpoProducto=$myrow3113cd['descripcionGP'];

$gpoProducto=$myrow['gpoProductos'];







$code1=$myrow['codigo'];

$codigo=$myrow['codigo'];

$keyPA=$myrow['keyPA'];



//*************************************CONVENIOS********************************************





$ctaMayor=$myrow12['ctaContable'];

$costoHospital=costoHospital($entidad,$code1,$basedatos);













$codigoUM=$myrow12['um'];

//$seguro=$traeSeguro->traeSeguro($_GET['keyClientesInternos'],$basedatos);



//**********************************CONVENIOS

$convenios= new validaConvenios();

$global= new validaConvenios();

$tipoConvenioS=new validaConvenios();

$traeSeguro=new verificaSeguro1();

$verificaSaldos1=new verificaSeguro1();

$verificaSaldosInternos=new verificaSeguro1();

$validaJubilados=new validaConvenios();

$porcentajeJubilados=new validaConvenios();

$ivaParticular=new ivaCierre();

$priceLevel=new articulosDetalles();

$ventaPieza=new tipoVentaArticulo();

$priceLevel=$priceLevel->precioVentaPresupuestos($seguro,$entidad,$paquete,$myrow['generico'],"1",$numeroPaciente,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);
$precioNormal=$priceLevel;




//*************************CONFIGURACIONES DE VENTAS*********************
 $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacenExistencias='".$almacenDestinoB."'

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacen']!=NULL){

 $almacen=$myrow29p['almacen'];

}
$modoventa=new articulosDetalles();
$priceLevel=$modoventa->modoventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);
$tventa=new articulosDetalles();
$tipoVenta=$tventa->tventa($almacen,$priceLevel,$codigo,$entidad,$keyPA,$basedatos);
//**********************************************************************************







$iva=new articulosDetalles();
$ivaNormal=new articulosDetalles();
$iva=$iva->iva($entidad,"1",$codigo,$priceLevel,$basedatos);  
$ivaNormal=$ivaNormal->iva($entidad,"1",$codigo,$precioNormal,$basedatos); 



//EL ALMACEN ES DE BENEFICENCIA
if($dB=='si' ){
switch ($caso) {

   case "1" : 
        $cantidadBeneficencia=($priceLevel*$ppb);
        $priceLevel=$priceLevel-$cantidadBeneficencia;
        $ivaBeneficencia=($iva*$ppb);
        $iva=$iva-$ivaBeneficencia;
   break;

   case "2" :
              
               $sSQL10a= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby' and departamento='".$almacen."'";
                $result10a=mysql_db_query($basedatos,$sSQL10a);
                $myrow10a = mysql_fetch_array($result10a);


                            $dB='si';
                            $ppb=$myrow10a['porcentaje'];
                            $ppbI=$ppb;
                            $ppb=$ppb*0.01;
                            $gpb=$myrow10a['gpoProducto'];
                            
                            if($gpb=='*' || $gpb==$gpoProducto){//todos l os grupos
                            $cantidadBeneficencia=($priceLevel*$ppb);
                            $priceLevel=$priceLevel-$cantidadBeneficencia;
                            $ivaBeneficencia=($iva*$ppb);
                            $iva=$iva-$ivaBeneficencia;
                           
                            }else{
                              $cantidadBeneficencia=NULL;  
                              $ivaBeneficencia=NULL;
                            }

   break;

   case "3" ://todos los grupos
                //TIPO A
                $sSQLa2a= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                
                ";
                $resultsa2a = mysql_query($sSQLa2a);
                $rowa2a = mysql_fetch_array($resultsa2a);
                
                //TIPO B
                $sSQLa2ab= "Select * From catalogoBD
                where
                entidad='".$entidad."'
                and
                departamento='".$almacen."'
                and
                gpoProducto='".$gpoProducto."'
                ";
                $resultsa2ab = mysql_query($sSQLa2ab);
                $rowa2ab = mysql_fetch_array($resultsa2ab);
                
                
                
                
                if($rowa2a['gpoProducto']=='*'){ 
                $ppb=$rowa2a['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                }elseif($rowa2ab['gpoProducto']!=NULL){
                $ppb=$rowa2ab['porcentaje'];
                $ppb=$ppb*0.01;
                $cantidadBeneficencia=($priceLevel*$ppb);
                $priceLevel=$priceLevel-$cantidadBeneficencia;
                $ivaBeneficencia=($iva*$ppb);
                $iva=$iva-$ivaBeneficencia;
                
                }else{
                        $cantidadBeneficencia=NULL;
                        $ivaBeneficencia=NULL;
                }

                
                
                
                
                
                
                
                
                
   break;


    


   default :
   
   break;
}
}
//CIERRO BENEFICENCIA 


















$um=new articulosDetalles();

$um=$um->um($codigo,$basedatos);  



$cargoAuto=new articulosDetalles();

$cargoAuto=$cargoAuto->cargoAuto($entidad,$codigo,$basedatos);







$informacionExistencias=new existencias();

//$existenciasAjuste=$informacionExistencias->informacionExistencias($myrow321['tipoPaciente'],$entidad,$codigo,$almacen,$usuario,$fecha1,$basedatos);



$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);













//***************PRECIO PUBLICO*******************/

$ventaPublico=$precioNormal+$iva;



//*************************************************/





if($acumuladoGlobal>$priceLevel){

//$acumulado=$acumuladoGlobal-$priceLevel;

$acumulado=$priceLevel;

} else {

$acumulado=$priceLevel;

}















if($seguro ){







if( $tipoConvenio!='No' or $validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){ 







		if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){ 


		  $percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);

			$percent*=0.01;





			$cantidadAseguradora=$priceLevel*$percent;

			$cantidadParticular=$priceLevel-$cantidadAseguradora;

			



			} else { //no son jubilados





if($tipoConvenio=='cantidad'){ 



$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo

$acumulado=$cantidadAseguradora;

$priceLevel=$acumulado;

 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$priceLevel,$basedatos); 

} else if($tipoConvenio=='grupoProducto'){



$cantidadAseguradora=$convenios->validacionConvenios($entidad, "1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$cantidadAseguradora-$priceLevel;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='global'){  


			


$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadParticular=$priceLevel-$cantidadAseguradora;



$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

} else if($tipoConvenio=='precioEspecial'){





if($pagoEfectivo->pagoEfectivo($entidad,$seguro,"1",$keyPA,$almacen,$basedatos)=='si'){ 

$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaParticulart=$ivaParticular->ivaParticular($entidad,"1",$keyPA,$cantidadParticular,$basedatos);

$cantidadAseguradora=NULL;

$ivaAseguradorat=NULL;



} else{



$cantidadAseguradora=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

$cantidadParticular=NULL;

$ivaParticulart=NULL;



}









} else { 

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;

$cantidadAseguradora=NULL;

}





			} //termina validacion dejubiliados













} else {//trae seguro pero no convenio



$cantidadAseguradora=$priceLevel;

$ivaAseguradorat=$iva;

}

}else{

$cantidadParticular=$priceLevel;

$ivaParticulart=$iva;



}



















if($seguro){

$sSQL3113c= "Select * From clientes WHERE  entidad='".$entidad."' and numCliente='".$seguro."'  ";

$result3113c=mysql_db_query($basedatos,$sSQL3113c);

$myrow3113c = mysql_fetch_array($result3113c);



if($myrow3113c['convenioExclusivo']=='si'){

 $sSQL3113cd= "SELECT 

keyPA

FROM convenios

WHERE

keyPA='".$myrow['keyPA']."'

and

departamento='".$almacenDestinoB."'";

$result3113cd=mysql_db_query($basedatos,$sSQL3113cd);

$myrow3113cd = mysql_fetch_array($result3113cd);



if(!$myrow3113cd['keyPA']){

$aviso='Requiere autorizacion medica!';

}



}else{

$aviso='';

}





if($myrow3113c['pagoEfectivo']=='si'){ 

$cantidadAseguradora=NULL;

$ivaAseguradorat=NULL;

$cantidadParticular=$convenios->validacionConvenios($entidad,"1",$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaParticular=$ivaAseguradora->ivaAseguradora($entidad,"1",$keyPA,$cantidadAseguradora,$basedatos);

}

}







  
//************************ANAQUEL********************
$sSQLana= "Select anaquel From existencias WHERE entidad='".$entidad."' and codigo='".$codigo."' and almacen='".$almacen."'  ";

$resultana=mysql_db_query($basedatos,$sSQLana);

$myrowana = mysql_fetch_array($resultana);
//******************************************************
?>

    

    <tr  onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >




    



      <td colspan="6" >

      <?php 

echo $myrow['descripcion'];
                                        echo '<br>';
										echo '<div >['.$myrow3113cd['descripcionGP'].']</div>';
if($myrow['sustancia']!=NULL){
echo '<br>';
	echo '<div >[Sustancia: '.$myrow['sustancia'].']</div>';  
}



//****************************DESCUENTOS AUTOMATICOS**********

$sSQL7ada= "Select * From descuentosAutomaticos where entidad='".$entidad."' 

and departamento='".$_GET['almacen']."' 

and

gpoProducto='".$gpoProducto."'

and (tipoPaciente='externo' or tipoPaciente='ambos') ";

$result7ada=mysql_db_query($basedatos,$sSQL7ada); 

$myrow7ada = mysql_fetch_array($result7ada);

echo mysql_error();







if((!$seguro or $myrow455['baseParticular']=='si') and ($myrow7ada['gpoProducto']=='*' || $myrow7ada['gpoProducto']==$gpoProducto)){ 



$cantidadParticularOriginal=$cantidadParticular;

$ivaOriginalParticular=$ivaParticulart;

$cantidadAseguradoraOriginal=$cantidadAseguradora;

$ivaOriginalAseguradora=$ivaAseguradorat;



$descuentoP=$cantidadParticular*($myrow7ada['porcentaje']*0.01);

$cantidadParticular-=$descuentoP;

$descuentoIvaP=$ivaParticulart*($myrow7ada['porcentaje']*0.01);

$ivaParticulart-=$descuentoIvaP;



$descuentoA=$cantidadAseguradora*($myrow7ada['porcentaje']*0.01);

$cantidadAseguradora-=$descuentoA;

$descuentoIvaA=$ivaAseguradorat*($myrow7ada['porcentaje']*0.01);

$ivaAseguradorat-=$descuentoIvaA;

echo '</br>';

echo $descripcionDescuentoGlobal= 'Descuento '. $myrow7ada['porcentaje'].'%';
}
?>

                

                







      

      </td>



      


























      <td align="right" colspan="3">

      <?php 



if($cantidadAseguradora>0){ 

echo "$".number_format($cantidadAseguradora+$ivaAseguradorat,2);

} else if($cantidadParticular>0){

echo "$".number_format($cantidadParticular+$ivaParticulart,2);

}

?>

      

      </td>
















      
      

      <?php 

$mouseOver='onmouseover';

$mouseOut='onMouseOut';

?>

    </tr>

    <?php } //cierra while?>





  </table>

       <?php } ?>
    
    
    
    
    
    </form>
    
    
    
    
    
    
    
    
    

	  
	  
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
			if ( this.value.length < 1 && this.isNotClick ) 
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
			return "/sima/cargos/pacientesx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
        <br>
        <br>
</body>
</html>
