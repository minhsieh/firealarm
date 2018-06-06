<?php
require_once 'src/Medoo.php';

$database = new \Medoo\Medoo([
		'database_type' => 'mysql',
		'database_name' => 'ts-emt',
		'server' => 'localhost',
		'username' => 'ts-emt',
		'password' => 'ts-emt1234',
		'charset' => 'utf8',
		'port' => 3306,
]);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>即時消防-新北市</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		body {
		  padding-top: 50px;
		}
		.starter-template {
		  padding: 40px 15px;
		  text-align: center;
		}
	</style>
  </head>

  <body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">即時消防 - 新北市</a>
        </div>
      </div>
    </nav>

    <div class="container">
    	<div class="starter-template">
    		<div class="jumbotron">
				<h1>即時消防案件資訊</h1>
				<p>本粉絲專頁提供新北市消防消防局最新案件資訊貼文，如欲追蹤更詳細請至專頁查看，並按個讚給予支持。</p>
				<p><a class="btn btn-primary btn-lg" href="https://www.facebook.com/即時消防-新北市-113165399264137/" role="button">即時消防-新北市</a></p>
			</div>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.9&appId=421467198208637";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			
			<div class="fb-page" data-href="https://www.facebook.com/&#x5373;&#x6642;&#x6d88;&#x9632;-&#x65b0;&#x5317;&#x5e02;-113165399264137/" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/&#x5373;&#x6642;&#x6d88;&#x9632;-&#x65b0;&#x5317;&#x5e02;-113165399264137/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/&#x5373;&#x6642;&#x6d88;&#x9632;-&#x65b0;&#x5317;&#x5e02;-113165399264137/">即時消防-新北市</a></blockquote></div>
    	</div>

    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '421467198208637',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
  </body>
</html>
