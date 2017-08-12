<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/social_networks/Facebook/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";

function share_on_fb(){
	$fb = new Facebook\Facebook([
  'app_id' => '889490487857628', // Replace {app-id} with your app id
  'app_secret' => 'af96954fb807737b7cd25b410bdc4c2a',
  'default_graph_version' => 'v2.9',
  ]);

	$linkData = [
	'link' => 'http://petsoverload.yaskravo.net',
	'message' => 'User provided message',
	];

	$helper = $fb->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	try {
  // Returns a `Facebook\FacebookResponse` object
		$response = $fb->post('/me/feed', $linkData,  $accessToken);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	$graphNode = $response->getGraphNode();

	echo 'Posted with id: ' . $graphNode['id'];
}



?>