<!DOCTYPE html>
<!-- Developed by: Scott Grivner -->
<!-- Application: FTP File Upload Utlity -->
<!-- Version: 1.0 -->
<!-- Date Created: 10/07/2016 -->
<!-- Date Last Updated: 10/07/2016 -->
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
</head onload="refresh();">
<?php
require_once('PHPMailer-master\PHPMailerAutoload.php');
//Turn error reporting off - turn on only during debugging by commenting out the line below.
error_reporting(0);
//Setup Array for accepted document types.
$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

//Aquire file temp name, file full path name, username, and password from Upload.php post.
$file = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$ftp_user_name = $_POST['username'];
$ftp_user_pass = $_POST['password'];

//If no file was chosen to upload.
if (empty($file)) {
	 $err = "Error: You did not select a file, please try again.";
	 $msg = '';
//If a username was not entered.
} else if ($ftp_user_name == NULL || $ftp_user_name == '') {
     $err = "Error: You did not enter a username, please try again."; 
	 $msg = '';
//If a password was not entered.
} else if ($ftp_user_pass == NULL || $ftp_user_pass == '') {
     $err = "Error: You did not enter a password please try again.";	  
	 $msg = '';
//If the file size is larger than 50 KB.
} else if ($file > 500000) {
     $err = "Error: File size is too large.";	 	 
	 $msg = '';
//Check the array above for correct file type.
} else if(!in_array($_FILES['file']['type'],$mimes)){
     $err = "Error: Your file is not a .txt format.";	  
	 $msg = '';
//Else perform the FTP connection
} else {

//Name of the file to upload
$remote_file = '{FileName}'; //Replace with your file name ('example.txt').
//iSeries server
$ftp_server ='{ServerName}'; //Replace with your server name.

// set up basic connection
$conn_id = ftp_connect($ftp_server);

//Login with username and password.
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//Change directory.
ftp_chdir($conn_id, '/{Directory}/'); //Directory to put the file.

//Upload a file
if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
	//If the file was successfully uploaded.
	$msg = "Successfully uploaded $filename\n";
	$err = '';
	
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
	$mail->AddAttachment($file , $remote_file);

	$mail->IsHTML(true);
	$mail->Subject = "Upload File Completed " . date('c') . "";
	$mail->Body = "Attached is the uploaded file.";
	$mail->Send();

} else {
	//Else there was a problem uploading the file, most likely due to user access errors - to debug, turn on error reporting then check the on screen error or the error log file on the server.
	$err = "Error: There was a problem while uploading your file $filename\n, make sure you've entered the correct username/password";
	$msg = '';
	
}

//Close the connection
ftp_close($conn_id);

}
//Log the Date - User - Message/Error:
if ($msg != '') {							
	$message1 = '+ + + + + + SUCCESS:++User:' . $ftp_user_name . '++Message:' . $msg . '';
} else {
	$message1 = '+ + + + + + ERROR:++User:' . $ftp_user_name . '++Message:' . $err . '';
}
            
if ($log = fopen('Upload_Log.log', 'at'))
	{
	
		fwrite($log, date('c') . ' ' . $message1 . PHP_EOL);
		fclose($log);
	}

?>
		<div style="text-align:center;">
			<IMG SRC="Logo.png">
			</div>
			<div style="text-align:center;"><font color="green"><b><?= $msg ?></b></font></div>
			<div style="text-align:center;"><font color="red"><b><?= $err ?></b></font></div>
			<br>
			<div style="text-align:center;"><b>Click the button below to return to original page.</b></div>
			<br>
		<form method="get" action="Upload.php">
			<div style="text-align:center;">
				<button type="submit">
					<img src="ReturnBtn.png">
				</button>
			</div>
		</form>
	</body>
</html>
