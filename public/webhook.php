<?php

require_once 'Pagetool.php';

// if(empty($_REQUEST['secret']) && $_REQUEST['secret'] != 'thisisagoodshit'){
// 	exit;
// }

$accessToken = file_get_contents('token');

$pt = new Pagetool;
$pt->setToken($accessToken);
$newToken = $pt->getPageToken('113165399264137');
//echo $newToken;
$pt->setToken($newToken);
$result = $pt->sendPost($_REQUEST['message']);

echo json_encode(['message' => $_REQUEST['message']]);