<?php
require_once  $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";

$client_id = '111868591958-s66k1j89o2mm5cqcvklamrp49hqsojoq.apps.googleusercontent.com'; // Client ID
$client_secret = '9V43jDeQmrFNv8wWfNHmG6Rj'; // Client secret
$redirect_uri = 'http://petsoverload.yaskravo.net/registration_google'; // Redirect URI
if (isset($_GET['code'])) {
	$result = false;

	$params = array(
		'client_id'     => $client_id,
		'client_secret' => $client_secret,
		'redirect_uri'  => $redirect_uri,
		'grant_type'    => 'authorization_code',
		'code'          => $_GET['code']
		);

	$url = 'https://accounts.google.com/o/oauth2/token';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);
	curl_close($curl);

	$tokenInfo = json_decode($result, true);
}
if (isset($tokenInfo['access_token'])) {
	$params['access_token'] = $tokenInfo['access_token'];

	$userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
	if (isset($userInfo['id'])) {
		$userInfo = $userInfo;
		$result = true;
	}
}
if ($result) {
	
	/*echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
	echo "Имя пользователя: " . $userInfo['name'] . '<br />';
	echo "Email: " . $userInfo['email'] . '<br />';
	echo "Ссылка на профиль пользователя: " . $userInfo['link'] . '<br />';
	echo "Пол пользователя: " . $userInfo['gender'] . '<br />';
	echo '<img src="' . $userInfo['picture'] . '" />'; echo "<br />";*/

	$email = $userInfo['email'];
	$name = $userInfo['name'];
	
	$network['google'] = $userInfo['link'];
	$link_prof = serialize($network);
	registration_network($email, $name, $link_prof);
} ?>