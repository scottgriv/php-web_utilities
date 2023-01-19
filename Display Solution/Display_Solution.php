<!DOCTYPE html>
<!-- Author: Scott Grivner -->
<!-- Website: scottgrivner.dev -->
<!-- Abstract: Display Solution -->
<html>
<!--<meta http-equiv="refresh" content="300">-->
<?php
	ini_set('MAX_EXECUTION_TIME', -1);
	$ini = parse_ini_file('config.ini'); 						//This must point to the directory the config file is in
	$directory = $ini['directory']; 						    //image folder directory from config file			
	$countDirect = $ini['countDirect']; 						//image folder directory from config file		
	$extension = $ini['extension'];  						    //extension format from config file
	$seconds = $ini['seconds'];		 						    //seconds to switch between images from config file
    $file_count = count(glob("$countDirect/*$extension"));		//file count for the number of images in the image directory
?>
<head>
    <title>Display Solution</title>
    <link rel="icon" type="image/png" href="docs/images/favicon.ico">
</head>
<body>
    
<!-- Default Logo - Change the width/height to 100% to fit the images over the entire screen -->
<img src="docs/images/logo.jpg" width="10%" height="10%" id="rotator"/>

<script type="text/javascript">
(function() {
    var rotator = document.getElementById('rotator'), 			//get the element
        dir = '<?php echo $directory . '/' ?>';     			//images folder
        delayInSeconds = <?php echo $seconds ?>,                //delay in seconds
        num = 01,                                     			//start number
        len = <?php echo $file_count ?>;             			//limit by counting the number of files in the directory
    setInterval(function(){                           			//interval changer
        rotator.src = dir + num + '<?php echo $extension ?>';   //change image
        num = (num === len + 1) ? location.reload() : ++num;    //reset if last image reached
    }, delayInSeconds * 1000);						 
}());
</script>
</body>
</html>


