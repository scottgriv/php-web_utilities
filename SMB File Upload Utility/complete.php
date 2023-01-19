<!DOCTYPE html>
<!-- Author: Scott Grivner -->
<!-- Website: scottgrivner.dev -->
<!-- Abstract: SMB File Upload Utility -->
<html>
<head onload="refresh();">
		<title>SMB File Upload Utility</title>
		<link rel="icon" type="image/png" href="images/favicon.ico">
		<script type="text/javascript" src="resources/jquery-1.11.2.min.js"></script>
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
        background: 'lightgray url(images/loading.gif) no-repeat center'
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

<?php
//Include PHP Mailer API
require_once('resources/PHPMailer-master\PHPMailerAutoload.php');

//Turn error reporting off - turn on only during debugging by commenting out the line below.
//error_reporting(0);
//echo exec('whoami');

$ini = parse_ini_file('resources/config.ini'); 

//Setup Array for accepted document types.
$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

//Aquire file temp name, file full path name, from upload.php post.
$file = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];

//If no file was chosen to upload.
if (empty($file)) {
	 $success = 1;
	 $msg = "Error: You did not select a file, please try again.";
	 
//Check the array above for correct file type.
} else if(!in_array($_FILES['file']['type'],$mimes)){
	 $success = 1;	 
     $msg = "Error: Your file is not .csv format.";	
	 
//Else perform the file move
} else {

//today's date formatted
$today = date("Ymd");

//Name of the file to upload
$remote_file = 'FileName_' . $today . '.csv'; //File name format.

//Server:
 if (move_uploaded_file($file, '//{ServerName}/{FilePath}/' . $remote_file)) { //Directory to drop files.
    
	//If the file was successfully uploaded - Send Email.
	$success = 0;
	$msg = "Successfully uploaded $filename\n";
	
	//Setup Email SMTP Server
	$mail = new PHPMailer();
	$mail->IsSMTP();
	//$mail->SMTPDebug = 1;   --Debug mail errors
	$mail->CharSet="UTF-8";
	$mail->Host = '{ServerName}'; //SMTP Server
	$mail->Port = 25;
	$mail->SMTPAuth = false;

	$mail->From = 'noreply@example.com'; //From Address
	$mail->FromName = 'Upload Complete'; //From Name
	$mail->AddAddress('test@example.com'); //To Address

	$mail->IsHTML(true);
	$mail->Subject = "Upload File Completed";
	$mail->Body = "File Uploaded: $filename\n on " . date('c') . "";
	$mail->Send();

} else {
	
	//Else there was a problem uploading the file, most likely due to user access errors - to debug, turn on error reporting then check the on screen error or the error log file on the server.
	$success = 1;
	$msg = "Error: There was a problem while uploading your file $filename\n, make sure you've uploaded a valid file format.";
}

}

//Log the Date - User - Message/Error:
if ($success==0) {							
	$message1 = '+ + + + + + SUCCESS:++File:' . $filename . '++Message:' . $msg . '';
} else {
	$message1 = '+ + + + + + ERROR:++File:' . $filename . '++Message:' . $msg . '';
}
            
if ($log = fopen('logs/upload_log.log', 'at'))
	{
	
		fwrite($log, date('c') . ' ' . $message1 . PHP_EOL);
		fclose($log);
	}
?>
		<div style="text-align:center;">
			<IMG SRC="images/logo.png"> 
			<IMG SRC="images/logo.png">
			</div>
			<br>
			<div style="text-align:center;">
			<?php if ($success==0) { ?>
			<font color="green">
			<?php } else { ?>
			<font color="red">
			<?php } ?>
			<b><?= $msg ?></b></font></div>
			<br>
			<div style="text-align:center;"><b>Click the button below to return to original page.</b></div>
			<br>
		<form method="get" action="upload.php">
			<div style="text-align:center;">
				<button type="submit">
					<img src="images/ReturnBtn.png">
				</button>
			</div>
		</form>
	</body>
</html>
