<?php 
require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/social_networks/Facebook/autoload.php";


function fb(){
	$fb = new Facebook\Facebook([
  'app_id' => '889490487857628', // Replace {app-id} with your app id
  'app_secret' => 'af96954fb807737b7cd25b410bdc4c2a',
  'default_graph_version' => 'v2.9',
  ]);

	$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://petsoverload.yaskravo.net/registration_fb', $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
return urldecode($loginUrl);
}

function google(){
 	$client_id = '111868591958-s66k1j89o2mm5cqcvklamrp49hqsojoq.apps.googleusercontent.com'; // Client ID
$client_secret = '9V43jDeQmrFNv8wWfNHmG6Rj'; // Client secret
$redirect_uri = 'http://petsoverload.yaskravo.net/registration_google'; // Redirect URI

$url = 'https://accounts.google.com/o/oauth2/auth';

$params = array(
	'redirect_uri'  => $redirect_uri,
	'response_type' => 'code',
	'client_id'     => $client_id,
	'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
	);

//$linka = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Google</a></p>';
$link = $url . '?' . urldecode(http_build_query($params));
return $link;
}

function twitt(){

	define('CONSUMER_KEY', 'GRxKKEDDrv1oB7Jrh70gB7bh9');
	define('CONSUMER_SECRET', 'XONhRS7gN6ozWSej21q1Hecj64F7fz3FNEjeTAwMaTB5t1y3Hr');

	define('REQUEST_TOKEN_URL', 'https://api.twitter.com/oauth/request_token');
	define('AUTHORIZE_URL', 'https://api.twitter.com/oauth/authorize');
	define('ACCESS_TOKEN_URL', 'https://api.twitter.com/oauth/access_token');
	define('ACCOUNT_DATA_URL', 'https://api.twitter.com/1.1/users/show.json');

	define('CALLBACK_URL', 'http://petsoverload.yaskravo.net/registration_twitter');


// формируем подпись для получения токена доступа
	define('URL_SEPARATOR', '&');

	$oauth_nonce = md5(uniqid(rand(), true));
	$oauth_timestamp = time();

	$params = array(
		'oauth_callback=' . urlencode(CALLBACK_URL) . URL_SEPARATOR,
		'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
		'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
		'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
		'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
		'oauth_version=1.0'
		);

	$oauth_base_text = implode('', array_map('urlencode', $params));
	$key = CONSUMER_SECRET . URL_SEPARATOR;
	$oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(REQUEST_TOKEN_URL) . URL_SEPARATOR . $oauth_base_text;
	$oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// получаем токен запроса
	$params = array(
		URL_SEPARATOR . 'oauth_consumer_key=' . CONSUMER_KEY,
		'oauth_nonce=' . $oauth_nonce,
		'oauth_signature=' . urlencode($oauth_signature),
		'oauth_signature_method=HMAC-SHA1',
		'oauth_timestamp=' . $oauth_timestamp,
		'oauth_version=1.0'
		);
	$url = REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode(CALLBACK_URL) . implode('&', $params);

	$response = file_get_contents($url);
	parse_str($response, $response);

	$oauth_token = $response['oauth_token'];
	$oauth_token_secret = $response['oauth_token_secret'];
	$_SESSION['oauth_token'] = $response['oauth_token'];
	$_SESSION['oauth_token_secret'] = $response['oauth_token_secret'];
// генерируем ссылку аутентификации

	$link = AUTHORIZE_URL . '?oauth_token=' . $oauth_token;

	//echo '<a href="' . $link . '">Аутентификация через Twitter</a>';
	return $link;
}
?>
<a href="<?= fb();?>" class="button button-gray button-login-with button-login-with-fb">

</a>
<a href="<?= twitt();?>" class="button button-gray button-login-with button-login-with-tw">

</a>
<a href="<?= google();?>" class="button button-gray button-login-with button-login-with-gp">

</a>