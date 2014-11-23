<?php
define('FACEBOOK_SDK_V4_SRC_DIR','Facebook/');
require_once('autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookAuthorizationException;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;


require_once('secrets.php');
FacebookSession::setDefaultApplication($fbAppId, $fbAppSecret);
$session = new FacebookSession($fbAccessToken);

?>
