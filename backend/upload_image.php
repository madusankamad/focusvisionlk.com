<?php
// Database  
include("includes/dbconn.php");
//-----------------------------------
// prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO images (image_id, image_name, image_path, image_category, image_album_id)
    VALUES (:image_id, :image_name, :image_path, :image_category, :image_album_id)");
    $stmt->bindParam(':image_id', $image_id);
    $stmt->bindParam(':image_name', $image_name);
    $stmt->bindParam(':image_path', $image_path);
	$stmt->bindParam(':image_category', $image_category);
	$stmt->bindParam(':image_album_id', $image_album_id);
//-----------------------------------

?>

<?php 
$max_size = 1024*5000;
$extensions = array('jpeg', 'jpg', 'png');
$dir = 'uploads/';
$count = 0;
$albumId=$_POST['albumId'];

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
      if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir .$filename) ){		  	
		  // insert a row to db
    		$image_id = NULL;
			$image_name = $filename;
			$image_path = $dir .$filename;
			$image_category = NULL;
			$image_album_id = $albumId;
			$stmt->execute();	  
		 //---------------------
			$count++;
		   
		  }
       
  }
	
 echo json_encode(array('count' => $count));
 $conn = null;

}

?>