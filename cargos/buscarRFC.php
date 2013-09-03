<?php 
	// ---------------------------------------------------------------- // 
	// DATABASE CONNECTION PARAMETER 									// 
	// ---------------------------------------------------------------- // 
	// Modify config.php with your DB connection parameters or add them //
	// directly below insted of include('config.php'); 					//
	
	include('/configuracion/ventanasEmergentes.php'); 
	
	
	// ---------------------------------------------------------------- // 
	// SET PHP VAR - CHANGE THEM										// 
	// ---------------------------------------------------------------- // 
	// You can use these variables to define Query Search Parameters:	//
	
	// $SQL_FROM:	is the FROM clausule, you can add a TABLE or an 	//
	// 				expression: USER INNER JOIN DEPARTMENT...			//
	
	// $SQL_WHERE	is the WHER clausule, you can add an table 	 		//
	// 				attribute for ezample name or an 					//
	
	


?>
<?php
	$searchq		=	strip_tags($_GET['q']);
	
	$getRecord_sql	=	"
	SELECT * FROM 
RFC 
where 
entidad='01'
AND
RFC like '%$searchq%'
LIMIT 0,5

	";
	$getRecord		=	mysql_query($getRecord_sql);

	// ---------------------------------------------------------------- // 
	// AJAX Response													// 
	// ---------------------------------------------------------------- // 
	
	// Change php echo $row['name']; and $row['department']; with the	//
	// name of table attributes you want to return. For Example, if you //
	// want to return only the name, delete the following code			//
	// "<br /><?php echo $row['department'];></li>"//
	// You can modify the content of ID element how you prefer			//
	echo '<ul>';
	while ($row = mysql_fetch_array($getRecord)) {?>
		<li><a href="ventanaFacturacionDirecta.php?keyRFC=<?php echo $row['keyRFC']; ?>&folioFactura=<?php echo $_GET['folioFactura'];?>&nT=<?php echo $_GET['nT'];?>&ID_EJERCICIO=<?php echo $ID_EJERCICIO;?>"><?php //echo $row['keyRFC']; ?> <small><?php echo $row['RFC']; ?></small></a></li>
	<?php } 
	echo '</ul>';
	?>
