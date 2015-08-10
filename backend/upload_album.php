<?php
// Database  
include("includes/dbconn.php");
//-----------------------------------
// prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO album (album_id, album_name, album_image, album_cat_name)
    VALUES (:album_id, :album_name, :album_image, :album_cat_name)");
    $stmt->bindParam(':album_id', $album_id);
    $stmt->bindParam(':album_name', $album_name);
    $stmt->bindParam(':album_image', $album_image);
	$stmt->bindParam(':album_cat_name', $album_cat_name);
	
//-----------------------------------

?>

<?php 
$max_size = 1024*5000;
$extensions = array('jpeg', 'jpg', 'png');
$dir = 'images/album/';
$count = 0;
$albumName=$_POST['albumName'];
$catName=$_POST['catName'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files']))
{
  // loop all files
  foreach ( $_FILES['files']['name'] as $i => $name )
  {
    // if file not uploaded then skip it
    if ( !is_uploaded_file($_FILES['files']['tmp_name'][$i]) )	
      continue;

      // skip large files
    if ( $_FILES['files']['size'][$i] >= $max_size )	
      continue;

    // skip unprotected files
    if( !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) )
	    continue;

    // now we can move uploaded files
		$filename=time()."_".$name;
      if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], "../".$dir .$filename) ){		  	
		  // insert a row to db
    		$album_id = NULL;
			$album_name = $albumName;
			$album_image = $dir .$filename;
			$album_cat_name = $catName;			
			$stmt->execute();	  
		 //---------------------
			$count++;
		   
		  }
       
  }
	
 echo json_encode(array('count' => $count));
 $conn = null;

}

?>