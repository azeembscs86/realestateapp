<?php
global $con;
$localhost = 'localhost';
$user = 'matchpro_propertydirect';
$pass = 'Developer@123';
$db = 'matchpro_propertydirect';
$con = mysqli_connect($localhost,$user,$pass,$db);


$getusers = mysqli_query($con,"SELECT DISTINCT `to_uname` FROM `chat_messages` WHERE `seen` = '0'");
while ($getusersIds = mysqli_fetch_array($getusers)) {
        $ids[] = $getusersIds['to_uname'];
}
for ($i=0; $i < count($ids) ; $i++) { 
    $getemails = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `users` WHERE `firstname` = '".$ids[$i]."'"));
    if($getemails['email'] == ''){}else{
        $total_unreadmessage = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `chat_messages` WHERE `to_uname` = '".$ids[$i]."' && `seen` = '0'"));
        $to_emails[] = $getemails['email'];
        //$total_message[] = $total_unreadmessage;
    }
}
// echo '<pre>'; print_r($ids);
// echo '<pre>'; print_r($to_emails);


$subject = "Match Property Direct Message Notification";
$message .= '<p>You have unread messages at MatchPropertyDirect.com, please login to your account and check your messages.</p>';
$message .= '<br><br>Thank you<br><br>';
$message .= '<br>Regards<br>';
$message .= '<br>Match Property Direct<br>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@matchpropertydirect.com>' . "\r\n";

foreach ($to_emails as $key => $value) {
	# code...
//echo $value.'<br>';
$to = $value;
$send = mail($to,$subject,$message,$headers);
// if($send){
// 	echo 'send';
// }
}
?>