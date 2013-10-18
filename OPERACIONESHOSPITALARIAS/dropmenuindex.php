<?php require("/configuracion/ventanasEmergentes.php");?>
<link rel="stylesheet" type="text/css" href="../bt/anylinkmenu.css" />

<!--<script type="text/javascript" src="../bt/menucontents.js"></script>-->

<script type="text/javascript" src="../bt/anylinkmenu.js">

/***********************************************
* AnyLink JS Drop Down Menu v2.0- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/.anylinkclass.htm for full source code
***********************************************/

</script>

<script type="text/javascript">

//anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
anylinkmenu.init("menuanchorclass")

</script>


<script>
var anylinkmenu3={divclass:'dropdown-header', inlinestyle:'', linktarget:'secwin'} //Third menu variable. Same precaution.
anylinkmenu3.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
anylinkmenu3.items=[
                <?php	


            $sSQL= "SELECT *
            FROM
            sis_ordenesSOP
            where

            status='done'
            and
            fecha>='2013-01-01'
                and
            fecha<='2013-12-01' 
            ";




            $result=mysql_db_query($basedatos,$sSQL);
            while($myrow = mysql_fetch_array($result)){ 
            $numeroE=$myrow['numeroE'];
            $nCuenta=$myrow['nCuenta'];
            $a4+=1;

            $nT=$myrow['keyClientesInternos'];
            echo '["'.$myrow['descripcionAlmacen'].'", "http://www.dynamicdrive.com/"],';
           ?>
	   
	
<?php } ?>
]
</script>




<!--3rd anchor link-->

<p style="text-align:right"><a href="#" class="menuanchorclass myownclass" rel="anylinkmenu3">Menu Principal</a></p>

