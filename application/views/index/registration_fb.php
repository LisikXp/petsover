<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/social_networks/Facebook/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";


$fb = new Facebook\Facebook([
  'app_id' => '889490487857628', // Replace {app-id} with your app id
  'app_secret' => 'af96954fb807737b7cd25b410bdc4c2a',
  'default_graph_version' => 'v2.9',
  ]);

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

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


$user = $response->getGraphUser();
/*print_r($user);
echo 'Name: ' . $user['name'];
echo 'email: ' . $user['email'];
echo 'id: ' . $user['id'];
*/
$email = $user['email'];
$name = $user['name'];

$network['facebook'] = 'https://www.facebook.com/'.$user['id'];
$link_prof = serialize($network);
registration_network($email, $name, $link_prof);
/*echo "<img src='//graph.facebook.com/".$user['id']."/picture?type=large'>";
$img = file_get_contents('https://graph.facebook.com/'.$user['id'].'/picture?type=large');
$file = $_SERVER['DOCUMENT_ROOT'].'/img/avatar/'.$user['id'].'.jpg';
file_put_contents($file, $img);*/
if(isset($_SESSION['msg'])){ //  Если есть ОШИБКА
    echo $_SESSION['msg']; // ВЫВОДИМ
    unset ($_SESSION['msg']);} 




    ?>
