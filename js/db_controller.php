<?PHP
/*
* Easy Grid
*
* @package easygrid
* @author $Author: sheiko $  
* @version $Id: db_controller.php, v 1.5 2007/02/27 15:58:15 sheiko Exp $ 
* @copyright (c) Dmitry Sheiko http://www.cmsdevelopment.com 
*/ 

/**
* Grid Controller Class 
* @package Easy Grid
* @author $Author: sheiko $ 
*/

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "test");
define("DB_TABLENAME", "sample");

class Grid {
	
	var $DataSourceFile;
	var $GridContent;
	var $Fields;
	var $Offset = 0;
	var $Limit = 20;
	var $Length = 0;
	var $Filter = array();
	var $OrderBy = array();
	var $db;
	
	/** 
    * Class Constructor
    * @return object
    */ 	
	
	function Grid() {
		$this->GridContent = array();
		if(isset($_POST["offset"])) $this->Offset = $_POST["offset"];
		if(isset($_POST["filter_field"])) $this->Filter["field"] = $_POST["filter_field"];
		if(isset($_POST["filter_value"])) $this->Filter["value"] = $_POST["filter_value"];
		if(isset($_POST["orderby"])) $this->OrderBy["field"] = $_POST["orderby"];
		if(isset($_POST["direction"])) $this->OrderBy["direction"] = $_POST["direction"];
		if(isset($_POST["limit"])) $this->Limit = $_POST["limit"];
		if(isset($_POST["fields"])) $this->Fields = split(",", preg_replace("/,$/is", "", $_POST["fields"]));
		
		return $this;
	}

	
	/** 
    * Data getting
    * 
    * @return boolean
    */ 		
	function getData() {
		
		// Connect DB
 		$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Could not connect : " . mysql_error()); 
    	mysql_select_db(DB_NAME) or die("Could not select database"); 

   		$result = mysql_query("SELECT * FROM ".DB_TABLENAME) or die("Query failed : " . mysql_error()); 
   		$this->Length = mysql_num_rows($result); 
   		
		if($this->Offset<0) $this->Offset=0;
		if($this->Offset>$this->Length) $this->Offset=0;
		if($this->Limit>$this->Length) $this->Limit = $this->Length;
		
		//Apply filters
		$filter_str = "";
		if($this->Filter)  $filter_str = " WHERE ".$this->Filter["field"]." LIKE '{$this->Filter["value"]}%' ";
		// Build SQL
   		$sql = "SELECT * FROM ".DB_TABLENAME." ".$filter_str." ".($this->OrderBy?" ORDER by ".$this->OrderBy["field"]." ".$this->OrderBy["direction"]:"")." LIMIT {$this->Offset},{$this->Limit}";
   		
   		$result = mysql_query($sql)  or die("Query failed : " . mysql_error()); 
   		$key = 0;
 		while ($line = pg_fetch_array($result, MYSQL_ASSOC)) { 
			foreach($this->Fields as $Index => $Field) { 
				$this->GridContent[$key][$Field]=$line[$Field]; 
			}
			$key++;
   		}

   		mysql_close($link); 
	}

	/** 
    * Respond with JSON generation
    * 
    * @return boolean
    */ 		
	function execRespond() {
		
		if($this->Length==0) return false;
		$out = '{
		"tlength" : '.$this->Length.',
		"columns" : [';
		foreach($this->Fields as $Field) { $out .= '"'.$Field.'",'; }
		$out = preg_replace("/,$/is","", $out);
		$out .= '],';
		$out .= '"value" : [';
		
		for($i=0;$i<count($this->GridContent);$i++) {
			$line = '{';
			foreach($this->Fields as $Index => $Field) { 
				$line .= '"'.$Field.'":"'.addslashes($this->GridContent[$i][$Field]).'",'; 
			}
			$line = preg_replace("/,$/is","", $line);
			$line .= '},';
			$out .= $line;
		}
		$out = preg_replace("/,$/is","", $out);
		$out .= ']}';
		print $out;
	}
}

header("Content-type: text/html; charset=UTF-8");
$grid = new Grid();
$grid->getData();
$grid->execRespond();
?>