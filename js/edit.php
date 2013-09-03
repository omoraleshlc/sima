<?php
	/**
	 * This file saves the edited text in the database/file
	 */
	if ($_POST['id'] == 'desc' ) {

		$content = $_POST['content'];

$q1 = "UPDATE articulos set 
descripcion='".$content."'


WHERE keyPA='".$keyPA[$i]."'";
pg_query($basedatos,$q1);
echo mysql_error();	
}	
?>