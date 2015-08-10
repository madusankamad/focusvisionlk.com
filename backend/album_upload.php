<!doctype html>
<?php 
include("includes/dbconn.php");

	$stmt = $conn->prepare("SELECT cat_name FROM img_category");
    $stmt->execute();
?>


<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>Multiple File Upload with progress bar</title>

  <!-- styles -->
  <link rel="stylesheet" type="text/css" href="css/pure-min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<div class="container">  

  <!-- status message will be appear here -->
  <div class="status"></div>
  
  <!-- multiple file upload form -->
  <h1> Create Album</h1>
  <form action="upload_album.php" method="post" enctype="multipart/form-data" class="pure-form">
  	
    <label>Album Name</label> : <input type="text" name="albumName" placeholder="album_name"/><br><br>
    <label>Album Name Category</label>
    	<select name="catName" >      
    	<?php  
		// set the resulting array to associative
    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach($stmt->fetchAll() as $k=>$v){
			echo("<option value='".$v['cat_name']."'>{$v['cat_name']}</option>");			
			}
			$conn = null;
		?>
    </select>
    <br><br>
    <input type="file" name="files[]" id="files"><br><br>
    <input type="submit" value="Create Album" class="pure-button pure-button-primary">
  </form>
  
  <!-- progress bar -->
  <div class="progress">
    <div class="bar"></div >
    <div class="percent">0%</div >
  </div>

</div>

  <!-- javascript dependencies -->
  <script src="../js/jquery.min.js"></script>
 <script src="../js/jquery.form.min.js"></script>
  <!-- main script -->
  <script src="js/image_upload.js"></script>
 

</body>
</html>