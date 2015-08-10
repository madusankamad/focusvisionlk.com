<!doctype html>
<html><!-- InstanceBegin template="/Templates/FVTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">

<!-- InstanceBeginEditable name="doctitle" -->
<title>Photography</title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/styles_main_old.css"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- InstanceBeginEditable name="head" -->
<?php 
include("includes/dbconn.php");
?>

<script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
<!-- Slider Script -->
<script type="text/javascript">

hs.graphicsDir = 'highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.wrapperClassName = 'controls-in-heading';
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.80;

	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: true,
		overlayOptions: {
			opacity: 1,
			position: 'top right',
			hideOnMouseOut: false
		}
	});
</script>
<!-- Slider Script End-->

<!-- MIX IT UP -->
<script type="text/javascript">
$(function(){
  $('#small-image-box').mixItUp();
});
</script>
<!-- MIX IT UP END-->

<!-- InstanceEndEditable -->
</head>

<body>
<div id="main-wrapper">
	<div id="left-col">
    	<div id="logo"><img src="images/fv_logo.png" width="100%" height="auto" /></div>
        
        <div id="menu-bar">
        	<ul>
            	<li><a href="home.php" class="active">Home</a></li>
                <li><a href="services.html">Our Services</a></li>
                <li><a href="photography.php" >Photography</a></li>
                <li><a href="packages.html">Packages</a></li>
                <li><a href="contact.html">Contact</a></li>            
            </ul>
        </div>
    </div>
    <div id="right-col">
    	<div id="page-content-area">
		<!-- InstanceBeginEditable name="page content area" -->
       <div id="gallery-menu">
       			
				<?php 
				// Get the album names from the img_category table
				$stmt = $conn->prepare("SELECT cat_name FROM img_category");
    			$stmt->execute();				
				?>
            	<ul>
               		<li><button  class="filter active" data-filter="all">All</button></li>
                    <?php  
					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					foreach($stmt->fetchAll() as $k=>$v){						
						echo("<li><button class='filter' data-filter='.".$v['cat_name']."'>".$v['cat_name']."</button></li>");			
						}
						
					?>
                	<!-- <li><button class="sort" data-sort="myorder:asc">Asc</button></li>
  					<li><button class="sort" data-sort="myorder:desc">Desc</button></li>-->
                </ul>
            </div>
        	
        	
            
            <div id="small-image-box">
            	<?php 
				// Get the album names from the img_category table
				$stmt = $conn->prepare("SELECT album_image, album_cat_name, album_id FROM album");
    			$stmt->execute();				
				?>
            
            <!-- Image Block -->
            	 <?php  
					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
					foreach($stmt->fetchAll() as $k=>$v){						
					echo("<div class='small-image mix ".$v['album_cat_name']."' ><a href='".$v['album_image']."' class='highslide' onclick='return hs.expand(this)'><img src='resize.php?h=250&amp w=400&amp img=".$v['album_image']."' alt='Highslide JS'title='Click to enlarge' /></a><div class='highslide-caption'><a href='view_album.php?id=".$v['album_id']."'> View Full Album</a></div> </div>");			
						}
					?>
            	
                <!-- **Image Block END** -->
            		
            
            	<!-- Image Block 
            	<div class="small-image mix weddings" >
                    <a href="images/slider/large/4l.jpg" class="highslide" onclick="return hs.expand(this)">
                    	<img   src="images/slider/thumbs/4.jpg" alt="Highslide JS"title="Click to enlarge" />
                    </a>
                    <div class="highslide-caption"><a href="album_pages/album.html"> View Full Album</a></div>
                </div>
               -->
                
                <?php
                $conn = null;
				?>           
            </div>
            	
                <!-- InstanceEndEditable -->
            
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
<!-- InstanceEnd --></html>
