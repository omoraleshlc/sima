<?php
//$numCliente= exec('ls /images/');
//$ruta='ls /images/'.$numCliente.'/';
//$imagen=exec($ruta);
//$sFile = '/images/'.$numCliente.'/'.$imagen;
//$imagedata = GetFileData($sFile); //load the file in 4k chunks
/*=======THE OUTPUT=========*/
$numCliente= exec('ls /images/');

$username = "omorales";
$password = "wolf3333";
$host = "localhost";
$database = "sima";

// Make the connect to MySQL or die
// and display an error.
$link = mysql_connect($host, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// Select your database
mysql_select_db ($database);  


		if(is_numeric($numCliente)){
		$sSQL4="select *
                FROM
                pacientes
		where 
		numCliente='".$numCliente."'
		";
                $result4=mysql_query($sSQL4);
                $myrow4 = mysql_fetch_array($result4);
		//echo $myrow4['nombreCompleto'];
}

$ruta='ls /images/'.$numCliente.'/';
$rutaO='/images/'.$numCliente.'/';
$creaArchivo=exec($ruta.'>/cronos/file.txt');
$lineas=exec('wc -l  /cronos/file.txt');



$file=fopen("/cronos/file.txt","r") or exit("Unable to open file!");
while(!feof($file))
  {
    
    

   $i= fgets($file);
  if($i!=NULL){
$rutas=$rutaO.$i;
  

//CODIGO ORIGINAL
// Make sure the user actually 
// selected and uploaded a file
//$filename = '/images/103009/image_11-01-2011_1.jpg';
$filename='/images/103009/ovidio.jpg';
//$filename='/images/'.$numCliente.'/'.$i;
$handle = fopen($filename, "r");
$data = fread($handle, filesize($filename));

    $data = addslashes($data);
     fclose($handle);

  $query = "INSERT INTO tbl_images ";
     $query .= "(image) VALUES ('$data')";
    $results = mysql_query($query, $link);
     

    
     }
  }
fclose($file);
print "Thank you, your file has been uploaded.";






//CODIGO ORIGINAL
// Make sure the user actually 
// selected and uploaded a file
//if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
//
//      // Temporary file name stored on the server
//      $tmpName  = $_FILES['image']['tmp_name'];  
//       
//      // Read the file 
//      $fp      = fopen($tmpName, 'r');
//      $data = fread($fp, filesize($tmpName));
//      $data = addslashes($data);
//      fclose($fp);
//      
//
//      // Create the query and insert
//      // into our database.
//      $query = "INSERT INTO tbl_images ";
//      $query .= "(image) VALUES ('$data')";
//      $results = mysql_query($query, $link);
//      
//      // Print results
//      print "Thank you, your file has been uploaded.";
//      
//}
//else {
//   print "No image selected/uploaded";
//}
//
//// Close our MySQL Link
//mysql_close($link);
?>  

<?php
//$file='/cronos/file.txt';
//$f=fopen($file,'rb');
//$data='';
//while(!feof($f))
//    $data.=fread($f,$size);
//fclose($f);
?> 



<?php
//  $img_base = base directory structure for thumbnail images
//  $w_dst = maximum width of thumbnail
//  $h_dst = maximum height of thumbnail
//  $n_img = new thumbnail name
//  $o_img = old thumbnail name
//$img_base='/images/103009/';
//
//function convertPic($img_base, $w_dst, $h_dst, $n_img, $o_img)
//  {ini_set('memory_limit', '100M');   //  handle large images
//   unlink($img_base.$n_img);         //  remove old images if present
//   unlink($img_base.$o_img);
//   $new_img = $img_base.$n_img;
//    
//   $file_src = $img_base."ovidio.jpg";  //  temporary safe image storage
//   unlink($file_src);
//   move_uploaded_file($_FILES['Filedata']['tmp_name'], $file_src);
//             
//   list($w_src, $h_src, $type) = getimagesize($file_src);     // create new dimensions, keeping aspect ratio
//   $ratio = $w_src/$h_src;
//   if ($w_dst/$h_dst > $ratio) {$w_dst = floor($h_dst*$ratio);} else {$h_dst = floor($w_dst/$ratio);}
//
//   switch ($type)
//     {case 1:   //   gif -> jpg
//        $img_src = imagecreatefromgif($file_src);
//        break;
//      case 2:   //   jpeg -> jpg
//        $img_src = imagecreatefromjpeg($file_src);
//        break;
//      case 3:  //   png -> jpg
//        $img_src = imagecreatefrompng($file_src);
//        break;
//     }
//   $img_dst = imagecreatetruecolor($w_dst, $h_dst);  //  resample
//  
//   imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $w_dst, $h_dst, $w_src, $h_src);
//   imagejpeg($img_dst, $new_img);    //  save new image
//
//   unlink($file_src);  //  clean up image storage
//   imagedestroy($img_src);       
//   imagedestroy($img_dst);
//  }
//
//$p_id = (Integer) $_POST[uid];
//$ver = (Integer) $_POST[ver];
//$delver = (Integer) $_POST[delver];
//convertPic("/images/103009/otls.jpg", 150, 150, "u".$p_id."v".$ver.".jpg", "u".$p_id."v".$delver.".jpg");

?>