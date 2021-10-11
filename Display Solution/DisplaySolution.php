<html>
<!--<meta http-equiv="refresh" content="300">-->
<link rel="icon" 
		type="image/png" 
		href="Logo.ico">
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
</head>
<body>
    
	<!-- Default Logo -->
	<img src="Logo.jpg" width="100%" height="100%" id="rotator"/>

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


