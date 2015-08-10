<!doctype html>
<html>
<?php 
include("includes/dbconn.php");

$albumID=$_GET['id'];
// Get the album names from the img_category table
	$stmt = $conn->prepare("SELECT image_path FROM images WHERE image_album_id = $albumID");
    $stmt->execute();
?>

<head>
<meta charset="utf-8">
<title>Album Page Template</title>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/styles_main_old.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.lazyload.min.js"></script>

<script type="text/javascript">
	$(function() {
   		 $("img.lazy").lazyload({
			 effect : "fadeIn"
			 
			 });
	});
</script>

</head>

<body>
    <div id="main-wrapper">
    	 <div id="album_page_header">
         	<div id="album_page_mini_logo">Mini Logo</div>
            <div id="album_page_nav">
            	<span><i class="fa fa-chevron-left"></i> <a href="photography.html">Back to Gallery</a></span>
            </div>
            
         </div>
         <div id="album_page_content">
         
         <?php
         $stmt2 = $conn->prepare("SELECT album_name, album_disc FROM album WHERE album_id = $albumID");
    	$stmt2->execute();
		$result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
					foreach($stmt2->fetchAll() as $k=>$v){						
						echo("<h1>".$v['album_name']."</h1><p>".$v['album_disc']."</p>");
									
						}
		 
		 ?>
         	 <div id="second_album_page_images">
              	<?php  
					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					foreach($stmt->fetchAll() as $k=>$v){						
						echo("<div class='album2_image_wrapper'><img  class='lazy'  data-original='".$v['image_path']."' width='100%' height='auto'></div>");
									
						}
						
					$conn = null;	
						
					?>
             
             
             	<!-- Image Block 
                <div class="album2_image_wrapper">
                	<img  class="lazy"  data-original="../images/slider/img-1.jpg" width="100%" height="auto">                
                </div>
                 -->
             </div>
         </div>
        <div id="footer">
<a class="powered-by" href="">Powered by</a>
<div id="social-media-wrapper">
            <ul>
            <li> <a  href="#"><i class="fa fa-facebook"></i></a></li>
              <li> <a  href="#"><i class="fa fa-google-plus"></i></a></li>
                <li> <a  href="#"><i class="fa fa-youtube"></i></a></li>
                <li> <a  href="#"><i class="fa fa-vimeo-square"></i></a></li>
            </ul>
            </div> 
        


</div>
    </div>
</body>
</html>
