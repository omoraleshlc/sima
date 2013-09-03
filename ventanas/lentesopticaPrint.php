<?php require('/configuracion/ventanasEmergentes.php');?>














<?php 
/*
 * armazonesPx
#	Name	Type	Collation	Attributes	Null	Default	Extra	Action
	 1	keyARM	int(11)			No	None	AUTO_INCREMENT	  Change	  Drop	 More
	 2	esferaD	decimal(10,2)			No	None		  Change	  Drop	 More
	 3	esferaI	decimal(10,2)			No	None		  Change	  Drop	 More
	 4	cilindroD	decimal(10,2)			No	None		  Change	  Drop	 More
	 5	cilindroI	decimal(10,2)			No	None		  Change	  Drop	 More
	 6	ejeD	decimal(10,2)			No	None		  Change	  Drop	 More
	 7	ejeI	decimal(10,2)			No	None		  Change	  Drop	 More
	 8	adicionD	decimal(10,2)			No	None		  Change	  Drop	 More
	 9	adicionI	decimal(10,2)			No	None		  Change	  Drop	 More
	 10	monoD	decimal(10,2)			No	None		  Change	  Drop	 More
	 11	monoI	decimal(10,2)			No	None		  Change	  Drop	 More
	 12	altD	decimal(10,2)			No	None		  Change	  Drop	 More
	 13	dipLejos	decimal(10,2)			No	None		  Change	  Drop	 More
	 14	dipCerca	decimal(10,2)			No	None		  Change	  Drop	 More
	 15	tipoOjo	varchar(10)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 16	tipoArmazon	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 17	colorArmazon	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 18	nivelTinteArmazon	varchar(15)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 19	gradiente	char(2)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 20	sizeArmazonA	decimal(10,2)			No	None		  Change	  Drop	 More
	 21	sizeArmazonB	decimal(10,2)			No	None		  Change	  Drop	 More
	 22	armazonED	decimal(10,2)			No	None		  Change	  Drop	 More
	 23	armazonDBL	decimal(10,2)			No	None		  Change	  Drop	 More
	 24	prisma1D	decimal(10,2)			No	None		  Change	  Drop	 More
	 25	prismaDireccion1D	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 26	prisma2D	decimal(10,2)			No	None		  Change	  Drop	 More
	 27	prismaDireccion2D	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 28	prisma1I	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 29	prismaDireccion1I	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 30	prisma2I	decimal(10,2)			No	None		  Change	  Drop	 More
	 31	prismaDireccion2I	varchar(30)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 32	keyClientesInternos	int(11)			No	None		  Change	  Drop	 More
	 33	codigoArmazon	int(11)			No	None		  Change	  Drop	 More
	 34	altI	decimal(10,2)			No	None		  Change	  Drop	 More
 */




if($_POST['send']!=NULL and $_POST['codigo']!=NULL and $_POST['descripcion']!=NULL){
$sSQL1= "Select * From armazonesPx where 
keyClientesInternos='".$_GET['keyClientesInternos']."' 


";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);



if(!$myrow1['keyClientesInternos']){
 $agrega = "INSERT INTO armazonesPx (
esferaD,esferaI,cilindroD,cilindroI,ejeD,ejeI,adicionD,adicionI,monoD,monoI,
altD,dipLejos,dipCerca,tipoOjo,tipoArmazon,colorArmazon,nivelTinteArmazon,
gradiente,sizeArmazonA,sizeArmazonB,armazonED,armazonDBL,prisma1D,prismaDireccion1D,
prisma2D,prismaDireccion2D,prisma1I,prismaDireccion1I,prisma2I,prismaDireccion2I,
keyClientesInternos,codigoArmazon,entidad
) values (
'".$_POST['esferaD']."',
'".$_POST['esferaI']."',
'".$_POST['cilindroD']."',
'".$_POST['cilindroI']."',
'".$_POST['ejeD']."',
'".$_POST['ejeI']."',
    '".$_POST['adicionD']."',
        '".$_POST['adicionI']."',
            '".$_POST['monoD']."',
                '".$_POST['monoI']."',
                    '".$_POST['altD']."',
                        '".$_POST['dipLejos']."',
                            '".$_POST['dipCerca']."',
                                '".$_POST['tipoOjo']."',
                                    '".$_POST['tipoArmazon']."',
                                        '".$_POST['colorArmazon']."',
                                            '".$_POST['nivelTinteArmazon']."',
                                                '".$_POST['gradiente']."',
                                                    '".$_POST['sizeArmazonA']."',
                                                        
'".$_POST['sizeArmazonB']."',
    '".$_POST['armazonED']."',
        '".$_POST['armazonDBL']."',
            '".$_POST['prisma1D']."',
                '".$_POST['prismaDireccion1D']."',
                    '".$_POST['prisma2D']."',
                        '".$_POST['prismaDireccion2D']."',
                            '".$_POST['prisma1I']."',
                                '".$_POST['prismaDireccion1I']."',
                                    '".$_POST['prisma2I']."',
                                        '".$_POST['prismaDireccion2I']."',
                                            '".$_GET['keyClientesInternos']."',
                                                '".$_POST['codigo']."','".$entidad."'
                            
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<div class="success">ORDEN AGREGADA</div>';
}  else{          
         
  $agrega = "UPDATE
            armazonesPx
               set
 esferaD='".$_POST['esferaD']."',
esferaI='".$_POST['esferaI']."',
cilindroD='".$_POST['cilindroD']."',
cilindroI='".$_POST['cilindroI']."',
ejeD='".$_POST['ejeD']."',
ejeI='".$_POST['ejeI']."',
 adicionD=   '".$_POST['adicionD']."',
    adicionI=    '".$_POST['adicionI']."',
     monoD=       '".$_POST['monoD']."',
        monoI=        '".$_POST['monoI']."',
          altD=          '".$_POST['altD']."',
            dipLejos=            '".$_POST['dipLejos']."',
               dipCerca=             '".$_POST['dipCerca']."',
                     tipoOjo=           '".$_POST['tipoOjo']."',
            tipoArmazon=               '".$_POST['tipoArmazon']."',
                 colorArmazon=             '".$_POST['colorArmazon']."',
                 nivelTinteArmazon=          '".$_POST['nivelTinteArmazon']."',
              gradiente=                         '".$_POST['gradiente']."',
          sizeArmazonA=                             '".$_POST['sizeArmazonA']."',
                                                        
sizeArmazonB='".$_POST['sizeArmazonB']."',
armazonED=    '".$_POST['armazonED']."',
armazonDBL=       '".$_POST['armazonDBL']."',
prisma1D=            '".$_POST['prisma1D']."',
prismaDireccion1D=      '".$_POST['prismaDireccion1D']."',
prisma2D=                    '".$_POST['prisma2D']."',
prismaDireccion2D=                        '".$_POST['prismaDireccion2D']."',
prisma1I=                      '".$_POST['prisma1I']."',
prismaDireccion1I=               '".$_POST['prismaDireccion1I']."',
prisma2I=                                    '".$_POST['prisma2I']."',
prismaDireccion2I=                                        '".$_POST['prismaDireccion2I']."',
                                       
codigoArmazon=                                                '".$_POST['codigo']."',
entidad=                                                    '".$entidad."'            
           WHERE
           
               keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<div class="success">ORDEN ACTUALIZADA</div>';
}


$agrega = "UPDATE
            clientesInternos
               set
 statusEstudio='standby'         
           WHERE
           
               keyClientesInternos='".$_GET['keyClientesInternos']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




print '<script>';
print 'window.opener.document.forms["form1"].submit();';
print '</script>';
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
    
</head>

<body>
<p>&nbsp;</p>

	  <?php //Abrir campos almacenes 
	  
$sSQL1= "Select * From armazonesPx where 

    keyClientesInternos='".$_GET['keyClientesInternos']."'

";
$result1=mysql_db_query($basedatos,$sSQL1); 
 $myrow1 = mysql_fetch_array($result1);
 
 
 $sSQL4= "Select * From armazones where 
entidad='".$entidad."'
    and
    codigo='".$myrow1['codigoArmazon']."'
    

";
$result4=mysql_db_query($basedatos,$sSQL4); 
 $myrow4 = mysql_fetch_array($result4);
	?>
	  

<form method="post">
<table width="639" class="table-forma">
  <tr>
    <th colspan="14" align="center"  ><p align="center">
   Solicitud: <?php echo $_GET['keyClientesInternos'];echo '<br>';?>     
<?php echo 'PACIENTE: '.$_GET['paciente'];?></p>
        
    </th>
  </tr>
      <tr>
    <td colspan="14" align="center"  >LENTES*</td>
  </tr>
    
  <tr>
    <td colspan="14" align="center"  >
        <?php echo $myrow1['codigoArmazon'];?>
         <?php echo $myrow4['descripcion']; ?>
    </td>
      
      
      
  </tr>
  <tr>
    <td width="3" height="44"  >&nbsp;</td>
    <td width="27"  >Rx.</td>
    <td width="75"  >Esfera</td>
    <td width="75"  >Cilindro</td>
    <td width="75"  >Ejes</td>
    <td colspan="2"  >Adición</td>
    <td width="19"  >&nbsp;</td>
    <td width="88"  >Mono/Dip</td>
    <td colspan="2"  >Alt/Oblea</td>
    <td width="44"  >&nbsp;</td>
    <td width="75"  >Dip</td>
    <td width="1"  >&nbsp;</td>
  </tr>
  <tr>
    <td height="39"  >&nbsp;</td>
    <td  >D:</td>
    
    <td >
        <input  name="esferaD" type="text" id="esferaD" size="10" value="<?php echo $myrow1['esferaD'];?>" />
    </td>
    <td ><input  name="cilindroD" type="text"  size="10" value="<?php echo $myrow1['cilindroD'];?>"/></td>
    <td ><input  name="ejeD" type="text"  size="10" value="<?php echo $myrow1['ejeD'];?>"/></td>
    <td colspan="2" ><input  name="adicionD" type="text" size="10" value="<?php echo $myrow1['adicionD'];?>" /></td>
    <td  >D:</td>
    <td ><input  name="monoD" type="text"  size="10" value="<?php echo $myrow1['monoD'];?>"/></td>
    <td colspan="2" ><input  name="altD" type="text" size="10" value="<?php echo $myrow1['altD'];?>" /></td>
    <td   >Lejos</td>
    <td ><input  name="dipLejos" type="text" size="10" value="<?php echo $myrow1['dipLejos'];?>" /></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td   >I:</td>
    <td ><input  name="esferaI" type="text" size="10" value="<?php echo $myrow1['esferaI'];?>" /></td>
    <td ><input  name="cilindroI" type="text" size="10" value="<?php echo $myrow1['cilindroI'];?>"/></td>
    <td ><input  name="ejeI" type="text" size="10" value="<?php echo $myrow1['ejeI'];?>"/></td>
    <td colspan="2" ><input  name="adicionI" type="text" size="10" value="<?php echo $myrow1['adicionI'];?>"/></td>
    <td  >I:</td>
    <td ><input  name="monoI" type="text" size="10" value="<?php echo $myrow1['monoI'];?>"/></td>
    <td colspan="2" ><input  name="altI" type="text" size="10" value="<?php echo $myrow1['altI'];?>"/></td>
    <td  >Cerca:</td>
    <td  ><input  name="dipCerca" type="text" size="10" value="<?php echo $myrow1['dipCerca'];?>"/></td>
    <td  >&nbsp;</td>
  </tr>
  <tr >
    <th colspan="14" align="center"  >
      <p align="center">  <label for="select5">DEX</label></p></th>
  </tr>
  <tr>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    
    <td align="right"  >
        <select name="tipoOjo">
            <option
                <?php if($myrow1['tipoOjo']=='derecho'){echo 'selected=""';}?>
                value="derecho">derecho</option>
            <option
                <?php if($myrow1['tipoOjo']=='izquierdo'){echo 'selected=""';}?>
                value="izquierdo">izquierdo</option>
        </select>    
    </td>
    
    
    
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
    <td  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="13" align="center"  >ARMAZON</td>
    <td align="center"  >&nbsp;</td>
  </tr>
  <tr>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >&nbsp;</td>
    
    
    <td align="right"  >Tipo</td>
    <td width="52" align="center"  >
        
      <select   name="tipoArmazon" >
      <option
 <?php if($myrow1['tipoArmazon']=='Ranurado'){echo 'selected=""';}?>
          value="Ranurado">Ranurado</option>
      <option 
           <?php if($myrow1['tipoArmazon']=='Perforado'){echo 'selected=""';}?>
          value="Perforado"
          >Perforado</option>
      <option
           <?php if($myrow1['tipoArmazon']=='Metal'){echo 'selected=""';}?>
          value="Metal">Metal</option>
      <option
           <?php if($myrow1['tipoArmazon']=='Plastico'){echo 'selected=""';}?>
          value="Plastico">Plastico</option>
    </select>
    </td>
    
    
    
    
    <td width="3" align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >Nivel de tinte</td>
    
    
    <td width="56" align="center"  >
    <select  name="nivelTinteArmazon" >
      <option
           <?php if($myrow1['nivelTinteArmazon']=='Tono 1'){echo 'selected=""';}?>
          value="Tono 1">Tono 1</option>
      <option
          <?php if($myrow1['nivelTinteArmazon']=='Tono 2'){echo 'selected=""';}?>
          value="Tono 2">Tono 2</option>
      <option
          <?php if($myrow1['nivelTinteArmazon']=='Tono 3'){echo 'selected=""';}?>
          value="Tono 3">Tono 3</option>
    </select></td>
    
    
    
    <td width="9" align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
  </tr>
  <tr>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >&nbsp;</td>
    <td align="right"  >Color</td>
    <td colspan="2" align="left"  >
        
        <select  name="colorArmazon" >
        <option
            <?php if($myrow1['colorArmazon']=='Negro'){echo 'selected=""';}?>
            value="Negro">Negro</option>
        <option
            <?php if($myrow1['colorArmazon']=='Gris'){echo 'selected=""';}?>
            value="Gris">Gris</option>
        <option
            <?php if($myrow1['colorArmazon']=='Verde'){echo 'selected=""';}?>
            value="Verde">Verde</option>
        <option
            <?php if($myrow1['colorArmazon']=='Azul'){echo 'selected=""';}?>
            value="Azul">Azul</option>
        <option
            <?php if($myrow1['colorArmazon']=='Cafe'){echo 'selected=""';}?>
            value="Cafe">Cafe</option>
        <option
            <?php if($myrow1['colorArmazon']=='Amarillo'){echo 'selected=""';}?>
            value="Amarillo">Amarillo</option>
        <option
            <?php if($myrow1['colorArmazon']=='Naranja'){echo 'selected=""';}?>
            value="Naranja">Naranja</option>
        <option
            <?php if($myrow1['colorArmazon']=='Violeta'){echo 'selected=""';}?>
            value="Violeta">Violeta</option>
        <option
            <?php if($myrow1['colorArmazon']=='G-15'){echo 'selected=""';}?>
            value="G-15">G-15</option>
    </select></td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >Gradiente</td>
    <td align="left"  ><input  type="checkbox" name="gradiente" id="checkbox" value="si"  <?php if($myrow1['gradiente']=='si'){echo 'checked=""';}?> /></td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="14" align="center"  >TAMAÑO DE ARMAZON</td>
  </tr>
  <tr>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >A:</td>
    <td colspan="2" align="center">
        <input  name="sizeArmazonA" type="text" size="10" value="<?php echo $myrow1['sizeArmazonA'];?>"/>
    </td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >ED:</td>
    <td colspan="2" align="center"  ><input  name="armazonED" type="text"  size="10" value="<?php echo $myrow1['armazonED'];?>" /></td>
    
    <td colspan="2" rowspan="2" align="center"  >
        <img src="../imagenes/LenteED_27.png" width="98" height="94" />
    </td>
    
    <td align="center"  >&nbsp;</td>
  </tr>
  <tr>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
    <td align="right"  >B:</td>
    
    <td colspan="2" align="center"  >
		<input  name="sizeArmazonB" type="text" size="10" value="<?php echo $myrow1['sizeArmazonB'];?>"/>
    </td>
    
    <td align="center"  >&nbsp;</td>
    <td align="right"  >DBL:</td>
    
    <td colspan="2" align="center"  >
        <input  name="armazonDBL" type="text"  size="10" value="<?php echo $myrow1['armazonDBL'];?>" />
    </td>
    
    
    <td align="center"  >&nbsp;</td>
  </tr>
    
    
  <tr>
    <td colspan="14" align="center"  >ADICIONAL / PRISMA</td>
  </tr>
    
    
    
  <tr>
    <td colspan="14" align="center" ><table  width="783" border="0" align="center" cellpadding="6" cellspacing="0">
      <tr>
        <td colspan="4" align="center"  >OJO DERECHO</td>
        <td colspan="5" align="center"  >OJO IZQUIERDO</td>
      </tr>
      <tr>
        <td colspan="2" align="center"  >Prisma #1</td>
        <td colspan="2" align="center"  >Prisma #2</td>
        <td colspan="3" align="center"  >Prisma #1</td>
        <td colspan="2" align="center"  >Prisma #2</td>
      </tr>
      <tr>
        <td width="58"  >Prisma</td>
        <td width="83"  >		
        <input  name="prisma1D" type="text" size="10" value="<?php echo $myrow1['prisma1D'];?>"/></td>
        <td width="64"  >Prisma </td>
        <td width="143"  >
        <input  name="prisma2D" type="text" size="10" value="<?php echo $myrow1['prisma2D'];?>"/></td>
        <td width="30"  >&nbsp;</td>
        <td width="65"  >Prisma</td>
        <td width="83"  >
        <input  name="prisma1I" type="text" size="10" value="<?php echo $myrow1['prisma1I'];?>"/></td>
        <td width="64"  >Prisma</td>
        <td width="85"  >
        <input  name="prisma2I" type="text" size="10" value="<?php echo $myrow1['prisma2I'];?>"/></td>
      </tr>
      <tr>
        <td  >Direccion</td>
        <td  >

        <select  name="prismaDireccion1D" >
          <option
           <?php if($myrow1['prismaDireccion1D']=='adentro'){echo 'selected=""';}?> value="adentro"> Adentro</option>
          <option  <?php if($myrow1['prismaDireccion1D']=='afuera'){echo 'selected=""';}?> value="afuera">Afuera</option>
          <option  <?php if($myrow1['prismaDireccion1D']=='arriba'){echo 'selected=""';}?> value="arriba">Arriba</option>
          <option  <?php if($myrow1['prismaDireccion1D']=='abajo'){echo 'selected=""';}?> value="abajo">Abajo</option>
        </select></td>
        <td  >Direccion</td>
        <td  >
        
        <select name="prismaDireccion2D"  id="select8">
          <option <?php if($myrow1['prismaDireccion2D']=='adentro'){echo 'selected=""';}?> value="adentro">Adentro</option>
          <option <?php if($myrow1['prismaDireccion2D']=='afuera'){echo 'selected=""';}?> value="afuera">Afuera</option>
          <option <?php if($myrow1['prismaDireccion2D']=='arriba'){echo 'selected=""';}?> value="arriba">Arriba</option>
          <option <?php if($myrow1['prismaDireccion2D']=='abajo'){echo 'selected=""';}?> value="abajo">Abajo</option>
        </select></td>
        <td  >&nbsp;</td>
        <td  >Direccion</td>
        <td  ><select   name="prismaDireccion1I" id="select9">
          <option <?php if($myrow1['prismaDireccion1I']=='adentro'){echo 'selected=""';}?> value="adentro">Adentro</option>
          <option <?php if($myrow1['prismaDireccion1I']=='afuera'){echo 'selected=""';}?> value="afuera">Afuera</option>
          <option <?php if($myrow1['prismaDireccion1I']=='arriba'){echo 'selected=""';}?> value="arriba">Arriba</option>
          <option <?php if($myrow1['prismaDireccion1I']=='abajo'){echo 'selected=""';}?> value="abajo">Abajo</option>
        </select></td>
        <td  >Direccion</td>
        <td ><select  name="prismaDireccion2I" id="select10">
          <option <?php if($myrow1['prismaDireccion2I']=='adentro'){echo 'selected=""';}?> value="adentro">Adentro</option>
          <option <?php if($myrow1['prismaDireccion2I']=='afuera'){echo 'selected=""';}?> value="afuera">Afuera</option>
          <option <?php if($myrow1['prismaDireccion2I']=='arriba'){echo 'selected=""';}?> value="arriba">Arriba</option>
          <option <?php if($myrow1['prismaDireccion2I']=='abajo'){echo 'selected=""';}?> value="abajo">Abajo</option>
        </select></td>
      </tr>
    </table></td>
  </tr>
    

</table>
    

    
    
</form>    
    

</body>
</html>