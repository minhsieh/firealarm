<?php
if (! session_id ()) {
	session_start ();
}
require 'src/Facebook/autoload.php';
$fb = new Facebook\Facebook ( [ 
		'app_id' => '421467198208637', // Replace {app-id} with your app id
		'app_secret' => '1a12bd9cfd2ed33b060737a7544b876d',
		'default_graph_version' => 'v2.9' 
] );

$helper = $fb->getRedirectLoginHelper ();

if (isset ( $_GET ['state'] )) {
	$helper->getPersistentDataHandler ()->set ( 'state', $_GET ['state'] );
}

try {
	$accessToken = $helper->getAccessToken ();
} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage ();
	exit ();
} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage ();
	exit ();
}

if (! isset ( $accessToken )) {
	if ($helper->getError ()) {
		header ( 'HTTP/1.0 401 Unauthorized' );
		echo "Error: " . $helper->getError () . "\n";
		echo "Error Code: " . $helper->getErrorCode () . "\n";
		echo "Error Reason: " . $helper->getErrorReason () . "\n";
		echo "Error Description: " . $helper->getErrorDescription () . "\n";
	} else {
		header ( 'HTTP/1.0 400 Bad Request' );
		echo 'Bad request';
	}
	exit ();
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump ( $accessToken->getValue () );

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client ();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken ( $accessToken );
echo '<h3>Metadata</h3>';
var_dump ( $tokenMetadata );

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId ( '1006190632845671' ); // Replace {app-id} with your app id
                                                      // If you know the user ID this access token belongs to, you can validate it here
                                                      // $tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration ();

if (! $accessToken->isLongLived ()) {
	// Exchanges a short-lived access token for a long-lived one
	try {
		$accessToken = $oAuth2Client->getLongLivedAccessToken ( $accessToken );
	} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
		echo "<p>Error getting long-lived access token: " . $helper->getMessage () . "</p>\n\n";
		exit ();
	}
	
	echo '<h3>Long-lived</h3>';
	var_dump ( $accessToken->getValue () );
}

// get me
$fb->setDefaultAccessToken ( $accessToken );

try {
	$request = $fb->request ( 'GET', '/me?fields=id,name,email,third_party_id,likes,first_name,last_name,birthday,hometown,gender,picture' );
	$response = $fb->getClient ()->sendRequest ( $request );
	$object = $response->getGraphObject ();
	$me = $object->asArray ();
} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage ();
	exit ();
} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage ();
	exit ();
}

echo '<h3>ME</h3>';
echo "<pre>";
print_r ( $me );
echo "</pre>";

file_put_contents('token',$accessToken->getValue ());

?>