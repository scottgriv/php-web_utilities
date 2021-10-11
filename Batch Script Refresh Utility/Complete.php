<!DOCTYPE html>
<!-- Developed by: Scott Grivner -->
<!-- Application: Batch Script Refresh Utility -->
<!-- Version: 1.0 -->
<!-- Date Created: 10/05/2016 -->
<!-- Date Last Updated: 10/05/2016 -->
<html>
<head>
		<link rel="icon" 
		type="image/png" 
		href="Logo.ico">
		<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script>
function refresh(){
    // SHOW overlay
    $('#overlay').show();
    // Retrieve data:
    $.ajax({
    url: "",
    context: document.body,
    success: function(s,x){
        $(this).html(s);
		$('#overlay').hide();
    }
});
}

$(document).ready(function(){
    // Create overlay and append to body:
    $('<div id="overlay"/>').css({
        position: 'fixed',
        top: 0,
        left: 0,
        width: '100%',
        height: $(window).height() + 'px',
        opacity:0.4, 
        background: 'lightgray url(loading.gif) no-repeat center'
    }).hide().appendTo('body');

});
</script>
		<style>
			button
				{
				width:200px; 
				height:50px; 
				border: 0;
				background-size: 100%; /* To fill the dimensions of container (button), or */
				background-size: 200px auto; /* to specify dimensions explicitly */
				}
		</style>
</head>
<body onload="refresh();">
<?php

	error_reporting(0);
	set_time_limit(300); 
	
	exec('{DriveLetter}:\{FolderPath}\{Batch File}.bat'); //Replace with the drive letter, folder path, and batch file name you want to run on your server.
	shell_exec('cd /d {DriveLetter}: && {Batch File}bat'); //Replace here as well.
?>
			<div style="text-align:center;">
					<IMG SRC="Logo.png">
			</div>
			<br>
			<div style="text-align:center;"><b>Click the button below to return to original page.</b></div>
			<br>
		<form method="get" action="Update.php">
			<div style="text-align:center;">
				<button type="submit">
					<img src="SuccessBtn.png">
				</button>
			</div>
		</form>
	</body>
</html>