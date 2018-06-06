<?php

ini_set('display_errors','1');
error_reporting(E_ALL);

require dirname(__DIR__)."/vendor/autoload.php";
require dirname(__DIR__)."/app/config.php";

use Facebook\Authentication\AccessToken;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;

session_start();
$app_id = FB_APP_ID;
$app_secret = FB_APP_SEC;
$page_id = FB_PAGE_ID;


$app = new FacebookApp($app_id, $app_secret);
$fb = new Facebook\Facebook(array(
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.5',
));
//Page access token has been got from get_page_access_token.php
$access_token = FB_ACCESS_TOKEN;

$fb->setDefaultAccessToken($access_token);
$request = $fb->request ( 'GET', '/me/accounts' );
$response = $fb->getClient ()->sendRequest ( $request );
$object = $response->getGraphEdge ();
$array = $object->asArray ();

foreach($array as $one){
    if($one['id'] == $page_id){
        $page_access_token = $one['access_token'];
        break;
    }
}


 

$post_data = array(
	'message' => 'This is a cvzxcvzxcvzxcvjiosnvioasdviasbndvibasdiovbasdoiv.'
);
$request = new FacebookRequest($app, $page_access_token, 'POST', '/' . $page_id . '/feed', $post_data);
// Send the request to Graph
try {
  $response = $fb->getClient()->sendRequest($request);
  $graphNode = $response->getGraphNode();
  echo 'Post ID: ' . $graphNode['id'];
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}