<!DOCTYPE html>
<!-- Author: Scott Grivner -->
<!-- Website: scottgrivner.dev -->
<!-- Abstract: FTP File Upload Utility -->
<html>
<head>
    <title>FTP File Upload Utility</title>
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script>
function refresh(){
    // SHOW overlay
    $('#overlay').show();
    // Retrieve data:
    $.ajax({
    url: "complete.php",
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
<body>
<div style="text-align:center;">
<IMG SRC="logo.png"></div>
<br>
<div style="text-align:center;"><b>Select File to Upload:</b></div>
<div style="text-align:center;">
<form action="complete.php" enctype="multipart/form-data" method="post">
<br>
Filename: <input type="file" name="file">
<br>
<br>
Username: <input type="text" name="username">
<br>
<br>
Password: <input type="password" name="password">
<br>
<br>
<button input type="submit" onclick="refresh();"><img src="UploadBtn.png"></button>
</form>
</div>
</body>
</html>
