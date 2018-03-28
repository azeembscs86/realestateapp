<?php
// added in v4.0.0
require_once('../config.php');
require_once('../includes/dbcon.php');
require_once('../includes/setting.php');
require_once('../includes/function.php');
checkinstall($config);
$config['lang'] = check_user_lang($config);
require_once('../includes/lang/lang_'.$config['lang'].'.php');
require_once 'autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;


/*$config['lang'] = check_user_lang($config);
require_once('includes/lang/lang_'.$config['lang'].'.php');*/


// init app with app id and secret
FacebookSession::setDefaultApplication( $config['fbappid'],$config['fbappsecret'] );
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper($config['site_url'].'social_login/fblogin.php' );    //Redirect Website Url
try {
    $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
} catch( Exception $ex ) {
    // When validation fails or other local issues
}

// see if we have a session
if ( isset( $session ) ) {
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me?fields=email,first_name,last_name,name,picture,gender' );
    //$request = $facebook->api('/me?fields=email,first_name,last_name');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();

     $fbid = $graphObject->getProperty('id');              // To Get Facebook ID

     $fbfirstname = $graphObject->getProperty('first_name'); // To Get Facebook first name

     $fblastname = $graphObject->getProperty('last_name'); // To Get Facebook last name

     $fbfullname = $graphObject->getProperty('name');    // To Get Facebook full name

     $femail = $graphObject->getProperty('email');       // To Get Facebook email ID

     $fbgender = $graphObject->getProperty('gender');       // To Get Facebook email ID

    if($femail == "")
    {
        $error = "Please add email id in facebook account later try again";
        echo "<script type='text/javascript'>alert('$error');</script>";
        redirect_parent($config['site_url'] ."login.php",true);
        exit();
    }

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $fsmallPic = file_get_contents('https://graph.facebook.com/'.$fbid.'/picture', false, stream_context_create($arrContextOptions));
    $flargePic = file_get_contents('https://graph.facebook.com/'.$fbid.'/picture?type=normal', false, stream_context_create($arrContextOptions));
    $upOne = realpath(dirname(__FILE__) . '/..');
    $random1 = rand(9999,100000);
    $random2 = rand(9999,200000);
    $picname = $random1.$random2;
    $sfile = $upOne.'/storage/user_image/small'.$picname.'.jpg';
    $lfile = $upOne.'/storage/user_image/'.$picname.'.jpg';
    file_put_contents($sfile, $fsmallPic);
    file_put_contents($lfile, $flargePic);


    /* ---- Session Variables -----*/
    $loggedin = array();
    $loggedin = userloginfb($config,$con,$fbfullname,$femail,$fbfirstname,$picname,$fbgender);

    if(!is_array($loggedin))
    {
        $error = $lang['EMAILNOTEXIST'];
        echo "<script type='text/javascript'>alert('$error');</script>";
        redirect_parent($config['site_url'] ."login.php",true);
    }
    elseif($loggedin['status'] == 2)
    {
        $error = $lang['ACCOUNTBAN'];
        echo "<script type='text/javascript'>alert('$error');</script>";
        redirect_parent($config['site_url'] ."login.php",true);
    }
    else
    {
        $_SESSION['id'] = $loggedin['id'];
        $_SESSION['username'] = $loggedin['username'];

        //update_lastactive($config);

        redirect_parent($config['site_url'] ."login.php",true);
    }

}
else {
    $loginUrl = $helper->getLoginUrl( array( 'email', 'user_friends' ) );
    //header("Location: ".$loginUrl);
    echo "<script type='text/javascript'>window.location.href='$loginUrl'</script>";
}
?>