<?php
global $con;
$localhost = 'localhost';
$user = 'matchpro_propertydirect';
$pass = 'Developer@123';
$db = 'matchpro_propertydirect';
$con = mysqli_connect($localhost,$user,$pass,$db);



$getemail = mysqli_query($con,"SELECT * FROM emt_usernotification where customer_status = 0");
while ($getemailData = mysqli_fetch_array($getemail)) {
	$emails[] = $getemailData;
}
$j = 0;
for ($i=0; $i < count($emails) ; $i++) { 
 //$checkdata = mysqli_query($con,"SELECT * FROM emt_properties WHERE title LIKE '%".$emails[$i]['search_txt']."%'"); 
  $checkdata = mysqli_query($con,"SELECT * FROM `emt_properties` WHERE sale_price = '".$emails[$i]['minprice']."' or city = '".$emails[$i]['city_name']."' or bedrooms = '".$emails[$i]['bedrooms_no']."' or bathrooms = '".$emails[$i]['bathrooms_no']."' or category_id = '".$emails[$i]['categoryid']."' or garages = '".$emails[$i]['garages_no']."' or beach_right = '".$emails[$i]['beachright']."' or gated_property = '".$emails[$i]['gatedproperty']."' limit 5 ");
if(mysqli_num_rows($checkdata) > 0 )
    {   
      $datamatch = mysqli_query($con,"SELECT * FROM `emt_properties` WHERE sale_price = '".$emails[$i]['minprice']."' or city = '".$emails[$i]['city_name']."' or bedrooms = '".$emails[$i]['bedrooms_no']."' or bathrooms = '".$emails[$i]['bathrooms_no']."' or category_id = '".$emails[$i]['categoryid']."' or garages = '".$emails[$i]['garages_no']."' or beach_right = '".$emails[$i]['beachright']."' or gated_property = '".$emails[$i]['gatedproperty']."' limit 5 ");
        ${"propertyData$i"} = array();
        while ($s_data = mysqli_fetch_array($datamatch))
        {
            ${"propertyData$i"}[] = $s_data;
        } 
        senemail(${"propertyData$i"},$emails[$i]['customer_email'],$emails[$i]['id']);
  } 
}

function senemail($arr,$email,$id){
    //echo $email.'<br>';
    //echo '<pre>'; print_r($arr);    
   //$to = $email;

    $to = $email; 
    $subject = "Match Property Direct Search Match";
    $message .='<div style="width:800px; margin:0 auto; background-color:#f5f5f5; box-shadow:2px 2px 2px 2px grey; padding:20px;">';
    $message .= '<p style="text-align:center; font-size:30px;">Find your Matching Property.</p>';         
     $message .= '<div style="text-align:center; margin:0 auto;  width:100%;"><img src="https://www.matchpropertydirect.com/img/site-logo-default-dark.png"  style="display:block; margin:0 auto;"  width="200" height="87" /></div></br>';
    foreach ($arr as $key => $value) {
   
      $message .='<div style="display:inline-block; width:100%;">';  
        
      $message .= '<h3 style="font-size:16px; text-align:center; padding-top:10px;">'. $value['title'].'</h3>'.'<br>';
      
    $message .='<div style="display:inline-flex; width:100%; text-align:center;">';  
      $message .= '<p style="width:30%; display:inline-block; font-size:16px; text-transform:uppercase;">'.'bedrooms '.$value['bedrooms'].'</p>'.'<br>';
      $message .= '<p style="width:30%; display:inline-block; font-size:16px; text-transform:uppercase;">'.'bathrooms '.$value['bathrooms'].'</p>'.'<br>';
      $message .= '<p style="width:30%; display:inline-block; font-size:16px; text-transform:uppercase;">'.'City '.$value['city'].'</p>'.'<br>';
    $message .='</div>';  
        
        $message .='</div>';
  
    $message .='<div style="display:inline-flex; width:100%; text-align:center;">';      
        $message .= '<a  style="height: 43px; width: 40%; line-height: 43px; margin:0 auto; padding: 0 10px; background-color: #3b9dcc !important; color: #fff!important; font-size:16px;" href="https://www.matchpropertydirect.com/show/'.$value['slug'].'" target="_blank">View Details</a><br>';    }
        $message .= '<a style="height: 43px; width: 40%; line-height: 43px;  margin:0 auto; padding: 0 10px; background-color: #ff6c2c !important; color: #fff!important; font-size:16px;" href="https://www.matchpropertydirect.com/unsubscribe/'.$id.'" target="_blank">Unsubscribe</a>';
    $message .='</div>';
    
    $message .= '<br><h4 style=" padding-top: 40px; margin-bottom: 0px; 
    line-height: 0px;">Regards</h4><br>';
    $message .= '<br><a href="https://www.matchpropertydirect.com" style="padding-top: 0px;
    font-size: 21px;
    line-height: 10px;">Match Property Direct</a><br>';
    $message .='</div>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <info@matchpropertydirect.com>' . "\r\n";
    mail($to,$subject,$message,$headers);
}
?>
