<?php
require dirname(__DIR__)."/vendor/autoload.php";
require dirname(__DIR__)."/app/config.php";

ini_set('display_errors','1');
error_reporting(E_ALL);
session_start();

use Spiders\NTFDFireSpider;
use Medoo\Medoo;
use Facebook\Authentication\AccessToken;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;

$logger = new Katzgrau\KLogger\Logger(dirname(__DIR__).'/logs');
$spider = new NTFDFireSpider;
$alarms = $spider->getFireAlarms();


//Check if process is running;
if(file_exists(PID_PATH)){
    $pid = file_get_contents(PID_PATH);
    if (file_exists( "/proc/$pid" )){
        $logger->info("[process exist check] pid: ".$pid);
        exit;
    }else{
        @unlink(PID_PATH);
    }
}
file_put_contents(PID_PATH,getmypid());
//Check End


$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => $config['db_database'],
    'server' => $config['db_host'],
    'charset' => 'utf8',
    'username' => $config['db_username'],
    'password' => $config['db_password']
]);

foreach($alarms as $alarm){
    try{
        $al_count = $db->count('alarms', ['time' => $alarm['time'] , 'location' => $alarm['location']]);
        if($al_count == 0){
            $db->insert('alarms',[
                'time' => $alarm['time'],
                'type' => $alarm['type'],
                'team' => $alarm['team'],
                'status' => $alarm['status'],
                'location' => $alarm['location'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            $message = $alarm['type']."\n".$alarm['time']."\n出動分隊：".$alarm['team']."\n案件地點：".$alarm['location']."\n\n\n#即時消防\n#".$alarm['team'];
            $types = explode("-",$alarm['type']);
            if(!empty($types[0])){
                $message = $message."\n#".$types[0];
            }
            if(!empty($types[1])){
                $message = $message."\n#".$types[1];
            }
            $post_id = postToPage($message);
            echo "[success post] post_id: ".$post_id.PHP_EOL;
            $logger->info("[success] ".$alarm['type']." ".$alarm['team']." post_id: ".$post_id);
            sleep(2);
        }
    }catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        $logger->error('Graph returned an error: ' . $e->getMessage());
    }catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        $logger->error('Facebook SDK returned an error: ' . $e->getMessage());
    }catch(Exception $ex){
        echo 'Exception error: '.$ex->getMessage();
        $logger->error('Exception error: '.$ex->getMessage());
    }    
}

@unlink(PID_PATH);

function postToPage($msg){
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

    if(empty($page_access_token)){
        exit;
    }

    $post_data = array(
        'message' => $msg
    );
    $request = new FacebookRequest($app, $page_access_token, 'POST', '/' . $page_id . '/feed', $post_data);

    $response = $fb->getClient()->sendRequest($request);
    $graphNode = $response->getGraphNode();
    //echo 'Post ID: ' . $graphNode['id'];
    return $graphNode['id'];
}