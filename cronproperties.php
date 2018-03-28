<?php
global $con;
$localhost = 'localhost';
$user = 'matchpro_propertydirect';
$pass = 'Developer@123';
$db = 'matchpro_propertydirect';
$con = mysqli_connect($localhost,$user,$pass,$db);


$getproperti = mysqli_query($con,"SELECT * FROM `emt_properties` where `pay_subscription` <> 0 && `days_counter` <> 0");
while ($showproperti = mysqli_fetch_array($getproperti)) {
		$counter = ($showproperti['days_counter']+1);

		if($showproperti['monthly_subscription'] == '1month' && $showproperti['days_counter'] < 30){

			 $update_properti = mysqli_query($con,"UPDATE `emt_properties` SET `days_counter` = '" . $counter . "' where `ID` = '" . $showproperti['id'] . "'"); 		

			if($showproperti['days_counter'] > 22){
				$getemail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `users` where `id` = '" . $showproperti['user_id'] . "'"));
				$to = $getemail['email'];
				//$to = 'matchdirect@yopmail.com';
	            $subject = "Match Property Direct Notify";
	            $message .= 'Dear Property Owner,<br><br>';
	            $message .= 'This is just a friendly reminder that your selected subscription plan at MatchPropertyDirect.com is going to end within a week. Please visit our site and renew/update your subscription plan accordingly.<br><br>';
	            $message .= 'Thankyou<br><br>';
	            $message .= 'Regards,<br>';
	            $message .= 'Match Property Direct';
	            $headers = "MIME-Version: 1.0" . "\r\n";
	            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	            $headers .= 'From: <info@matchpropertydirect.com>' . "\r\n";
	            $send = mail($to,$subject,$message,$headers);
			}
				//echo 'yes';
		}else if($showproperti['monthly_subscription'] == '6month' && $showproperti['days_counter'] < 182){

			$update_properti = mysqli_query($con,"UPDATE `emt_properties` SET `days_counter` = '" . $counter . "' where `ID` = '" . $showproperti['id'] . "'");	

			if($showproperti['days_counter'] > 174){
				$getemail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `users` where `id` = '" . $showproperti['user_id'] . "'"));
				$to = $getemail['email'];
				//$to = 'matchdirect@yopmail.com';
	            $subject = "Match Property Direct Notify";
	            $message .= 'Dear Property Owner,<br><br>';
	            $message .= 'This is just a friendly reminder that your selected subscription plan at MatchPropertyDirect.com is going to end within a week. Please visit our site and renew/update your subscription plan accordingly.<br><br>';
	            $message .= 'Thankyou<br><br>';
	            $message .= 'Regards,<br>';
	            $message .= 'Match Property Direct';
	            $headers = "MIME-Version: 1.0" . "\r\n";
	            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	            $headers .= 'From: <info@matchpropertydirect.com>' . "\r\n";
	            $send = mail($to,$subject,$message,$headers);
			}

		}else if($showproperti['monthly_subscription'] == '12month' && $showproperti['days_counter'] < 365){

			$update_properti = mysqli_query($con,"UPDATE `emt_properties` SET `days_counter` = '" . $counter . "' where `ID` = '" . $showproperti['id'] . "'");	

			if($showproperti['days_counter'] > 357){
				$getemail = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `users` where `id` = '" . $showproperti['user_id'] . "'"));
				$to = $getemail['email'];
				//$to = 'matchdirect@yopmail.com';
	            $subject = "Match Property Direct Notify";
	            $message .= 'Dear Property Owner,<br><br>';
	            $message .= 'This is just a friendly reminder that your selected subscription plan at MatchPropertyDirect.com is going to end within a week. Please visit our site and renew/update your subscription plan accordingly.<br><br>';
	            $message .= 'Thankyou<br><br>';
	            $message .= 'Regards,<br>';
	            $message .= 'Match Property Direct';
	            $headers = "MIME-Version: 1.0" . "\r\n";
	            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	            $headers .= 'From: <info@matchpropertydirect.com>' . "\r\n";
	            $send = mail($to,$subject,$message,$headers);
			}

		}else{

			$update_properti = mysqli_query($con,"UPDATE `emt_properties` SET `monthly_subscription` = 1,`pay_subscription` = 0,`days_counter` = 0 where `ID` = '" . $showproperti['id'] . "'");
		
		}
        //echo $showproperti['title'].'<br>';
}
?>