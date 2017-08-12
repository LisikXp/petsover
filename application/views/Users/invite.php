<?php
//require_once "/include/header-guest.php";
/*$authUrl = 'https://accounts.google.com/o/oauth2/auth';
$authData = array(
'client_id' => '228071030307-l0vfacv1h0ettmrejcusadiohgb9g9jr.apps.googleusercontent.com',
'redirect_uri' => 'http://petsoverload.yaskravo.net/gcontact',
'scope' => 'https://www.google.com/m8/feeds/',
'response_type' => 'code'
);
//ссылка для запроса на авторизацию
$gmailAuthURL = $authUrl.'?'.http_build_query($authData);*/
require_once $_SERVER['DOCUMENT_ROOT'].'/application/views/social_networks/google-api-php-client-2.1.3_PHP54/vendor/autoload.php';
$google_client_id = '228071030307-l0vfacv1h0ettmrejcusadiohgb9g9jr.apps.googleusercontent.com';
$google_client_secret = 'pw4q23Dwdzf9gurYFBQDSA2C';
$google_redirect_uri = 'http://petsoverload.yaskravo.net/gcontact';

///setup new google client
$client = new Google_Client();
$client -> setApplicationName('petsoverload-my-contact');
$client -> setClientid($google_client_id);
$client -> setClientSecret($google_client_secret);
$client -> setRedirectUri($google_redirect_uri);
$client -> setAccessType('online');

$client -> setScopes('https://www.googleapis.com/auth/contacts.readonly');

$googleImportUrl = $client -> createAuthUrl();


?>
<div class="invite">
	<div class="invite-message">
		<h3 class="heading-h3 tac roboto">Miss your friends on Petsfame?</h3>

		<p class="tac">Invite them and their pets, so you never miss them again</p>
	</div>

	<div class="flex-wrapper">
		<input type="text" id="send_email" name="send_email" class="input input-full-width contact-form-input" placeholder="Names or Email Addresses">
		<input type="submit" class="link button button-cta-green contest-button contact-form-button" id="send_email_btn">
	</div>

	<hr class="hr  hr-full-width hr-body">
	<h3 class="heading-h3 tac roboto">More ways to invite your friends</h3>
	<div class="flex-wrapper flex-wrapper-jc-space-between">
		<div class="link button button-gray  button-one-third button-one-third-gmail">
			<p class="no-margin dib" onclick="window.open('<?= $googleImportUrl;?>', 'asdas', 'toolbars=0,width=700,height=600');">
				<span class="hidden-sm hidden-xs hidden-md"> Invite</span>  Gmail <span class="hidden-sm hidden-xs hidden-md"> Contacts</span>
			</p>
		</div>
		<div class="link button button-gray button-one-third button-one-third-copy">
			<p class="no-margin dib" onclick="copyToClipboard('http://petsoverload.yaskravo.net/SignUp#link')">
				<span class="hidden-sm hidden-xs hidden-md"> Copy</span> Link
			</p>
		</div>
		<div class="link button button-gray button-one-third button-one-third-fb sharer" data-sharer="facebook" data-url="http://petsoverload.yaskravo.net/SignUp">
			<p class="no-margin dib">
				<span class="hidden-sm hidden-xs hidden-md ">Share on</span> Facebook
			</p>
		</div>

	</div>
	<div class="invite-hide">
		<a href="#" class="link invite-link-hide" id="hide_this">Hide this</a>
	</div>
</div>
		<!-- Your share button code
		<div class="fb-share-button" data-href="http://petsoverload.yaskravo.net/registration#Share_fb" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://petsoverload.yaskravo.net/registration#Share_fb&src=sdkpreparse">Share on Facebook</a></div> -->

		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.9&appId=889490487857628";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			function copyToClipboard(text) {
				window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
			}

		</script>



